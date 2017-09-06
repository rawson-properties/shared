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

    public static function mergeMultiString(string $first, string $second): string
    {
        $first = collect(explode(';', $first));
        $second = collect(explode(';', $second));

        $merge = $first->merge($second)->unique()->implode(';');
        return trim($merge, ';');
    }

    public static function getContactProperties(string $email): array
    {
        try {
            $hubspot = new self();
            $rawProperties = object_get($hubspot->api->contacts()->getByEmail($email), 'data.properties');
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

    public static function getContactByID(int $vid): StdClass
    {
        return Cache::remember(self::key([ 'getContactByID', $vid, ]), 10, function () use ($vid) {
            $h = new self();
            $response = $h->api->contacts()->getById($vid);
            return $response->data;
        });
    }

    public static function ensurePropertyOptionExists(string $name, string $value): string
    {
        $hubspot = new self();
        if (!$hubspot->contactPropertyHasOption($name, $value)) {
            $hubspot->addContactPropertyOption($name, $value);
        }

        return $value;
    }

    public static function makeMultiString(string $name, Collection $options, bool $validate = true): string
    {
        if ($validate) {
            $options->each(function ($e) use ($name) {
                Hubspot::ensurePropertyOptionExists($name, $e);
            });
        }

        return $options->implode(';');
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

    public static function getOwnerIDFromEmail(string $email): ?int
    {
        $key = self::key([ 'getOwnerIDFromEmail', ], [ $email, ]);
        $owners = Cache::remember($key, 15, function () use ($email) {
            $h = new self();
            $response = $h->api->owners()->all([
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
        // @TODO: Maybe update this to be config('hubspot.key') if the package registers config?
        $this->api = HubspotFactory::create($key ?: config('services.hubspot.key'));
    }

    public function contactPropertyHasOption(string $name, string $option): bool
    {
        return $this->getContactPropertyOptions($name)->contains($option);
    }

    public function getContactPropertyOptions(string $name): Collection
    {
        return Cache::remember(self::key([ 'getContactPropertyOptions', $name, ]), 60, function () use ($name) {
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

        Cache::forget(self::key([ 'getContactPropertyOptions', $name, ]));

        $data->options = self::makeOptions($options->push($option)->unique()->values());
        return $this->api->contactProperties()->update($name, (array) $data);
    }
}
