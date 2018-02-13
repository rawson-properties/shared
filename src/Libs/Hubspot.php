<?php

namespace Rawson\Shared\Libs;

use Rawson\Shared\Libs\Traits\GeneratesCacheKeys;
use Cache;
use Carbon\Carbon;
use Exception;
use Log;
use Illuminate\Support\Collection;
use SevenShores\Hubspot\Exceptions\BadRequest;
use SevenShores\Hubspot\Factory as HubspotFactory;
use StdClass;

class Hubspot
{
    use GeneratesCacheKeys;

    public $api;

    private static function keyGetContactPropertyOptions(string $name): string
    {
        return self::key([ 'getContactPropertyOptions', $name, ], [ $this->api->client->key, ]);
    }

    private static function makeOptions(Collection $options): Collection
    {
        return $options->map(function ($e) {
            return [
                'label' => $e,
                'value' => $e,
            ];
        });
    }

    public static function makeProperty(string $name, $value): StdClass
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

    /*
     * Try to parse the full message in BadRequest for useful detail
     */
    public static function handleBadRequest(BadRequest $e): BadRequest
    {
        $message = $e->getMessage();
        $message = substr($message, strpos($message, '{"status":'));
        $json = json_decode($message);

        // If we fail decoding throw the original ex
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw $e;
        }

        // If there's no validationResults, throw original e
        try {
            $validationError = $json->validationResults[0];
        } catch (Exception $ex) {
            throw $e;
        }

        $error = sprintf(
            '%s for %s: %s',
            $validationError->error,
            $validationError->name,
            substr($validationError->message, 0, strpos($validationError->message, ' was not one of'))
        );

        throw new BadRequest($error, $e->getCode(), $e);
    }

    public static function formatDate(string $date): string
    {
        return (new Carbon($date . ' utc'))->startOfDay()->timestamp * 1000;
    }

    public static function splitName(string $name): array
    {
        $names = collect(explode(' ', $name));

        return [
            'first_name' => $names->shift(),
            'last_name' => $names->implode(' '),
        ];
    }

    public function __construct(string $key = null)
    {
        $this->api = HubspotFactory::create($key ?: config('hubspot.key'));
    }

    public function contactPropertyHasOption(string $name, string $option): bool
    {
        return $this->getContactPropertyOptions($name)->contains($option);
    }

    public function getContactPropertyOptions(string $name): Collection
    {
        return Cache::remember(self::keyGetContactPropertyOptions($name), 60, function () use ($name) {
            $response = $this->api->contactProperties()->get($name);
            return collect($response->options)->pluck('value');
        });
    }

    public function addContactPropertyOption(string $name, string $option)
    {
        $data = object_get($this->api->contactProperties()->get($name), 'data');
        $options = collect($data->options)->pluck('label');

        if (!$options->count()) {
            throw new Exception('addContactPropertyOption returned no options! Aborting for safety.');
        }

        if ($options->contains($options)) {
            return;
        } else {
            Log::debug(sprintf('%s adding option [%s] to property [%s]', self::class, $option, $name));
        }

        // Don't modify these existing params.
        unset($data->readOnlyValue);
        unset($data->readOnlyDefinition);
        unset($data->mutableDefinitionNotDeletable);
        unset($data->hidden);

        Cache::forget(self::keyGetContactPropertyOptions($name));

        $data->options = self::makeOptions($options->push($option)->unique()->values());
        return $this->api->contactProperties()->update($name, (array) $data);
    }

    public function getOwnerIDFromEmail(string $email): ?int
    {
        $key = self::key([ 'getOwnerIDFromEmail', ], [ $email, $this->api->client->key, ]);
        $owners = Cache::remember($key, 15, function () use ($email) {
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

    public function getContactProperties(string $email): array
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

        $properties = [];
        foreach ($rawProperties as $key => $data) {
            $properties[$key] = $data->value;
        }

        return $properties;
    }

    /*
     * Jump through a bunch of hoops so that if the contact exists we
     * don't flatten existing values.
     */
    public function mergeIfExists(array $contact): array
    {
        $existing = $this->getContactProperties(array_get($contact, 'email'));
        if (!$existing) {
            return $contact;
        }

        $fieldsToMerge = [
            'lead_type',
            'linked_agents',
            'linked_office',
            'lead_source',
            'property_24_references',
            'private_property_references',
        ];

        foreach ($fieldsToMerge as $e) {
            if (array_get($contact, $e) || array_get($existing, $e)) {
                $contact[$e] = self::mergeMultiString(array_get($contact, $e) ?: '', array_get($existing, $e) ?: '');
            }
        }

        // Do this separately because the glue is , not ;
        if (array_get($contact, 'enquiry_listing_references') || array_get($existing, 'enquiry_listing_references')) {
            $contact['enquiry_listing_references'] = self::mergeMultiString(
                array_get($contact, 'enquiry_listing_references', ''),
                array_get($existing, 'enquiry_listing_references', ''),
                ','
            );
        }

        $contact['newsletter'] = (array_get($contact, 'newsletter') == 'Yes' || array_get($existing, 'newsletter') == 'Yes') ? 'Yes' : 'No';

        return $contact;
    }

    public function getContactByID(int $vid): StdClass
    {
        $key = self::key([ 'getContactByID', $vid, ], [ $this->api->client->key, ]);

        return Cache::remember($key, 10, function () use ($vid) {
            $response = $this->api->contacts()->getById($vid);
            return $response->data;
        });
    }

    public function ensurePropertyOptionExists(string $name, string $value): string
    {
        if (!$this->contactPropertyHasOption($name, $value)) {
            $this->addContactPropertyOption($name, $value);
        }

        return $value;
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
}
