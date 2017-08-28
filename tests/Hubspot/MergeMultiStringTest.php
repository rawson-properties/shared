<?php

namespace Rawson\Shared\Tests\Hubspot;

use Rawson\Shared\Libs\Hubspot;
use PHPUnit_Framework_TestCase;

class MergeMultiStringTest extends PHPUnit_Framework_TestCase
{
    public function testMergeMultiString()
    {
        $result = Hubspot::mergeMultiString('', '');
        $this->assertEquals($result, '');

        $result = Hubspot::mergeMultiString('first', '');
        $this->assertEquals($result, 'first');

        $result = Hubspot::mergeMultiString('first', 'second');
        $this->assertEquals($result, 'first;second');

        $result = Hubspot::mergeMultiString('first', 'second;second');
        $this->assertEquals($result, 'first;second');

        $result = Hubspot::mergeMultiString('first;second', 'first;second');
        $this->assertEquals($result, 'first;second');
    }
}
