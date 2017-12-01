<?php

namespace Rawson\Shared\Tests\Helpers;

use PHPUnit\Framework\TestCase;

class SAIDtoDateTest extends TestCase
{
    /**
     * Using http://www.legalcity.net/Index.cfm as reference.
     */
    public function testSaIdToDate()
    {
        $this->assertTrue(function_exists('sa_id_to_date'));
        $this->assertNull(sa_id_to_date('zef'));

        $date = sa_id_to_date('5401285083049');
        $this->assertEquals($date->year, 1954);
        $this->assertEquals($date->month, 1);
        $this->assertEquals($date->day, 28);

        $date = sa_id_to_date('4805075072007');
        $this->assertEquals($date->year, 1948);
        $this->assertEquals($date->month, 5);
        $this->assertEquals($date->day, 7);

        $date = sa_id_to_date('8710075050084');
        $this->assertEquals($date->year, 1987);
        $this->assertEquals($date->month, 10);
        $this->assertEquals($date->day, 7);
    }
}
