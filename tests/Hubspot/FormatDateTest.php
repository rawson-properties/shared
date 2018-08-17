<?php

namespace Rawson\Shared\Tests\Hubspot;

use Rawson\Shared\Libs\Hubspot;
use PHPUnit\Framework\TestCase;

class FormatDateTest extends TestCase
{
    public function testFormatDate()
    {
        $this->assertEquals(Hubspot::formatDate('2018-08-17T16:32:37+02:00'), 1534464000000);
        $this->assertEquals(Hubspot::formatDate('2018-08-16T17:04:51+02:00'), 1534377600000);
    }
}
