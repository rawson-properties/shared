<?php

namespace Rawson\Shared\Libs;

use Illuminate\Support\Collection;
use StdClass;

class LightProxy
{
    private static function factory(): PassportClient
    {
        return new PassportClient(
            config('services.lightproxy.url'),
            config('services.lightproxy.client_id'),
            config('services.lightproxy.client_secret')
        );
    }

    public static function getDeedOffices(): Collection
    {
        return collect([
            'B' => 'Bloemfontein',
            'C' => 'Cape Town',
            'J' => 'Johannesburg',
            'K' => 'Kimberley',
            'W' => 'King William\'s Town',
            'N' => 'Pietermaritzburg',
            'T' => 'Pretoria',
            'V' => 'Vryburg',
            'U' => 'Umtata',
            'M' => 'Mpumalanga',
        ]);
    }

    public static function getProvinces(): Collection
    {
        return collect([
            '1' => 'Limpopo',
            '2' => 'Free State',
            '3' => 'Northern Cape',
            '4' => 'Western Cape',
            '5' => 'Kwazulu Natal',
            '6' => 'Mpumalanga',
            '7' => 'North West',
            '8' => 'Gauteng',
            '9' => 'Eastern Cape',
            '10' => 'Farms',
        ]);
    }

    public static function propertyFind(int $id): Collection
    {
        return collect(self::factory()->get('/property/' . $id));
    }

    public static function propertyReport(int $id): StdClass
    {
        return self::factory()->get(sprintf('/property/%s/report', $id));
    }

    public static function propertyWhere(array $params): Collection
    {
        $url = '/property/where?' . http_build_query($params);
        return collect(self::factory()->get($url));
    }

    public static function suburbReport(int $id): StdClass
    {
        return self::factory()->get(sprintf('/suburb/%s/report', $id));
    }

    public static function estates(string $query): Collection
    {
        return collect(self::factory()->get('/estates?q=' . $query));
    }

    public static function sectionals(string $query): Collection
    {
        return collect(self::factory()->get('/sectionals?q=' . $query));
    }

    public static function suburbs(string $query): Collection
    {
        return collect(self::factory()->get('/suburbs?q=' . $query));
    }

    public static function streets(string $query, int $subID = null): Collection
    {
        $url = sprintf('/streets?q=%s&id=%s', $query, $subID);
        return collect(self::factory()->get($url));
    }
}
