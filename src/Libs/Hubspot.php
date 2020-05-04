<?php

namespace Rawson\Shared\Libs;

use Rawson\Shared\Libs\Traits\GeneratesCacheKeys;
use Cache;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Exception;
use Log;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use SevenShores\Hubspot\Exceptions\BadRequest;
use SevenShores\Hubspot\Factory as HubspotFactory;

class Hubspot
{
    use GeneratesCacheKeys;

    private $key;
    public $api;

    private static function makeOptions(Collection $options): Collection
    {
        return $options->map(function ($e) {
            return [
                'label' => $e,
                'value' => $e,
            ];
        });
    }

    public static function makeProperty(string $name, $value): object
    {
        return (object) [
            'property' => $name,
            'value' => $value,
        ];
    }

    public static function makeProperties(array $properties): array
    {
        $return = [];
        foreach ($properties as $k => $v) {
            $return[] = self::makeProperty($k, $v);
        }

        return $return;
    }

    public static function mergeMultiString(string $first, string $second, string $glue = ';'): string
    {
        $first = collect(explode($glue, $first));
        $second = collect(explode($glue, $second));

        $merge = $first->merge($second)->unique()->implode($glue);
        return trim($merge, $glue);
    }

    public static function propertiesObjectToKV(object $rawProperties): array
    {
        $properties = [];
        foreach ($rawProperties as $key => $data) {
            $properties[$key] = $data->value;
        }

        return $properties;
    }

    public static function formatDate(string $date): string
    {
        $date = Carbon::parse($date, 'UTC');
        $date = Carbon::create($date->year, $date->month, $date->day, 0, 0, 0, 'UTC');
        return $date->timestamp * 1000;
    }

    public static function splitName(string $name): array
    {
        $names = collect(explode(' ', $name));

        return [
            'first_name' => $names->shift(),
            'last_name' => $names->implode(' '),
        ];
    }

    public static function rt3BusinessTypeToPropertyZone(?string $businessType): string
    {
        switch ($businessType) {
            case 'Rawson Auctions':
                return 'Auction';
            case 'Rawson Commercial':
                return 'Commercial';
            case 'Rawson Projects':
                return 'New Development';
            default:
                return 'Residential';
        }
    }

    public function __construct(string $key = null)
    {
        $this->key = $key ?: config('hubspot.key');
        $this->api = HubspotFactory::create($this->key);
    }

    private function keyGetContactPropertyOptions(string $name): string
    {
        return self::key([ 'getContactPropertyOptions', $name, ], [ $this->key, ]);
    }

    private function getHubContactProperties(): Collection
    {
        $options = $this->api->contactProperties()->all();
        return collect($options->data)
            ->reject(function ($e) {
                return $e->readOnlyValue
                    // || $e->readOnlyDefinition
                    // || $e->hubspotDefined
                    || $e->hidden
                    || $e->calculated
                    || $e->deleted
                    ;
            })
            ->reject(function ($e) {
                return Str::of($e->name)->startsWith([
                    'hs_',
                    'hubspot_',
                    'lifecyclestage',
                ]);
            })
            ->pluck('name')
            ;
    }

    public function getHubContactPropertiesCached(): Collection
    {
        $key = self::key([ __FUNCTION__, ], [ $this->key, ]);
        return Cache::remember($key, CarbonInterval::day(), function () {
            return $this->getHubContactProperties();
        });
    }

    public function contactPropertyHasOption(string $name, string $option): bool
    {
        return $this->getContactPropertyOptions($name)->contains($option);
    }

    public function getContactPropertyOptions(string $name): Collection
    {
        $key = $this->keyGetContactPropertyOptions($name);
        return Cache::remember($key, CarbonInterval::hours(6), function () use ($name) {
            $response = $this->api->contactProperties()->get($name);
            return collect($response->options)->pluck('value');
        });
    }

    public function addContactPropertyOption(string $name, string $option)
    {
        $option = trim($option);
        $data = object_get($this->api->contactProperties()->get($name), 'data');
        $options = collect($data->options)->pluck('label');

        /* Disabling this as it's fine to add from 0 existing options.
        if (!$options->count()) {
            throw new Exception('addContactPropertyOption returned no options! Aborting for safety.');
        }
        */

        if ($options->contains($option)) {
            return;
        } else {
            Log::debug(sprintf('%s adding option [%s] to property [%s]', self::class, $option, $name));
        }

        // Don't modify these existing params.
        unset($data->readOnlyValue);
        unset($data->readOnlyDefinition);
        unset($data->mutableDefinitionNotDeletable);
        unset($data->hidden);

        Cache::forget($this->keyGetContactPropertyOptions($name));

        $data->options = self::makeOptions($options->push($option)->unique()->values());
        return $this->api->contactProperties()->update($name, (array) $data);
    }

    public function getOwnerIDFromEmail(string $email): ?int
    {
        $key = self::key([ 'getOwnerIDFromEmail', ], [ $email, $this->key, ]);
        $owners = Cache::remember($key, CarbonInterval::hours(6), function () use ($email) {
            $response = $this->api->owners()->all([
                'email' => $email,
                'includeInactive' => false,
            ]);

            return object_get($response, 'data', []);
        });

        if (count($owners) < 1) {
            return null;
        }

        return object_get($owners[0], 'ownerId');
    }

    public function getContactPropertiesByEmail(string $email): array
    {
        try {
            $response = $this->api->contacts()->getByEmail($email);
            $rawProperties = object_get($response, 'data.properties');
        } catch (BadRequest $e) {
            // 404 is fine, just return empty.
            if ($e->getCode() == 404) {
                return [];
            }

            throw $e;
        }

        return self::propertiesObjectToKV($rawProperties);
    }

    public function getContactPropertiesByID(string $id): array
    {
        $response = $this->api->contacts()->getById($id);
        $rawProperties = object_get($response, 'data.properties');
        return self::propertiesObjectToKV($rawProperties);
    }

    public function getEmailSubscriptionStatus(string $email, string $portalID = null): object
    {
        $portalID = $portalID ?: config('hubspot.portal_id');
        $response = $this->api->emailSubscription()->subscriptionStatus($email, $portalID);
        return data_get($response, 'data');
    }

    /*
     * Jump through a bunch of hoops so that if the contact exists we
     * don't flatten existing values.
     */
    public function mergeIfExists(array $contact): array
    {
        if (!data_get($contact, 'email')) {
            return $contact;
        }

        $existing = $this->getContactPropertiesByEmail(data_get($contact, 'email'));
        if (!$existing) {
            return $contact;
        }

        $fieldsToSkipIfSet = [
            'beds',
            'baths',
            'price_from',
            'price_max',
            'size_from',
            'size_to',
        ];

        foreach ($fieldsToSkipIfSet as $e) {
            if (data_get($existing, $e)) {
                unset($contact[$e]);
            }
        }

        $fieldsToMerge = [
            'areas',
            'lead_type',
            'linked_agents',
            'linked_office',
            'lead_source',
            'property_24_references',
            'private_property_references',
        ];

        foreach ($fieldsToMerge as $e) {
            if (data_get($contact, $e) && data_get($existing, $e)) {
                $contact[$e] = self::mergeMultiString(data_get($contact, $e, ''), data_get($existing, $e, ''));
            }
        }

        // Do this separately because the glue is , not ;
        if (data_get($contact, 'enquiry_listing_references') && data_get($existing, 'enquiry_listing_references')) {
            $contact['enquiry_listing_references'] = self::mergeMultiString(
                data_get($contact, 'enquiry_listing_references', ''),
                data_get($existing, 'enquiry_listing_references', ''),
                ','
            );
        }

        return $contact;
    }

    public function getContactByID(int $vid): object
    {
        return $this->api->contacts()->getById($vid)->data;
    }

    public function getContactByIDCached(int $vid): object
    {
        $key = self::key([ 'getContactByID', $vid, ], [ $this->key, ]);
        return Cache::remember($key, CarbonInterval::day(), function () use ($vid) {
            return $this->getContactByID($vid);
        });
    }

    public function ensurePropertyOptionExists(string $name, string $value): string
    {
        if (!$this->contactPropertyHasOption($name, $value)) {
            $this->addContactPropertyOption($name, $value);
        }

        return $value;
    }

    public function ensurePropertyOptionsExist(string $name, Collection $options): Collection
    {
        return $options->map(function ($e) use ($name) {
            return $this->ensurePropertyOptionExists($name, $e);
        });
    }

    public function makeMultiString(string $name, Collection $options, bool $validate = true): string
    {
        if ($validate) {
            $options->each(function ($e) use ($name) {
                $this->ensurePropertyOptionExists($name, $e);
            });
        }

        return $options->implode(';');
    }

    public function rejectProperties(array $properties): array
    {
        $hubProperties = $this->getHubContactPropertiesCached()->toArray();

        return array_filter($properties, function ($e) use ($hubProperties) {
            return in_array($e, $hubProperties);
        }, ARRAY_FILTER_USE_KEY);
    }
}
