<?php

namespace Rawson\Shared\Libs;

use Illuminate\Support\Collection;

class LightProxy
{
    protected static function factory(): PassportClient
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

    public static function propertyFind(int $id, int $timeout = 5): Collection
    {
        return collect(self::factory()->get('/property/' . $id, $timeout));
    }

    public static function propertyReport(int $id, int $timeout = 5): object
    {
        $url = sprintf('/property/%s/report', $id);
        return self::factory()->get($url, $timeout);
    }

    public static function propertyWhere(array $params, int $timeout = 5): Collection
    {
        $url = '/property/where?' . http_build_query($params);
        return collect(self::factory()->get($url, $timeout));
    }

    public static function suburbReport(int $id, int $timeout = 5): object
    {
        $url = sprintf('/suburb/%s/report', $id);
        return self::factory()->get($url, $timeout);
    }

    public static function estates(string $query, int $timeout = 5): Collection
    {
        return collect(self::factory()->get('/estates?q=' . $query, $timeout));
    }

    public static function sectionals(string $query, int $timeout = 5): Collection
    {
        return collect(self::factory()->get('/sectionals?q=' . $query, $timeout));
    }

    public static function sectionalReport(int $id, int $timeout = 5): object
    {
        $url = sprintf('/sectional/%s/report', $id);
        return self::factory()->get($url, $timeout);
    }

    public static function suburbs(string $query, int $timeout = 5): Collection
    {
        return collect(self::factory()->get('/suburbs?q=' . $query, $timeout));
    }

    public static function streets(string $query, int $subID = null, int $timeout = 5): Collection
    {
        $url = sprintf('/streets?q=%s&id=%s', $query, $subID);
        return collect(self::factory()->get($url, $timeout));
    }
}
