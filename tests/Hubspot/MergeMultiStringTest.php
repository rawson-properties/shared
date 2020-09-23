<?php

namespace Rawson\Shared\Tests\Hubspot;

use Rawson\Shared\Libs\HubspotHelpers;
use PHPUnit\Framework\TestCase;

class MergeMultiStringTest extends TestCase
{
    public function testMergeMultiString()
    {
        $result = HubspotHelpers::mergeMultiString('', '');
        $this->assertEquals($result, '');

        $result = HubspotHelpers::mergeMultiString('first', '');
        $this->assertEquals($result, 'first');

        $result = HubspotHelpers::mergeMultiString('first', 'second');
        $this->assertEquals($result, 'first;second');

        $result = HubspotHelpers::mergeMultiString('first', 'second;second');
        $this->assertEquals($result, 'first;second');

        $result = HubspotHelpers::mergeMultiString('first;second', 'first;second');
        $this->assertEquals($result, 'first;second');

        $result = HubspotHelpers::mergeMultiString('first', 'second', ',');
        $this->assertEquals($result, 'first,second');
    }
}
