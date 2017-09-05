<?php

namespace Rawson\Shared\Tests\Helpers;

use PHPUnit\Framework\TestCase;

class CollectExplodeTest extends TestCase
{
    public function testSingleGood()
    {
        $result = collectExplode('jimmy');
        $this->assertEquals($result->count(), 1);
        $this->assertEquals($result->first(), 'jimmy');

        $result = collectExplode('jimmy', ';');
        $this->assertEquals($result->count(), 1);
        $this->assertEquals($result->first(), 'jimmy');
    }

    public function testSingleBad()
    {
        $result = collectExplode('jimmy, ');
        $this->assertEquals($result->count(), 1);
        $this->assertEquals($result->first(), 'jimmy');

        $result = collectExplode(' jimmy ,');
        $this->assertEquals($result->count(), 1);
        $this->assertEquals($result->first(), 'jimmy');

        $result = collectExplode(' jimmy ;', ';');
        $this->assertEquals($result->count(), 1);
        $this->assertEquals($result->first(), 'jimmy');
    }

    public function testDoubleGood()
    {
        $result = collectExplode('jimmy,jones');
        $this->assertEquals($result->count(), 2);
        $this->assertEquals($result->get(1), 'jones');

        $result = collectExplode('jimmy;jones', ';');
        $this->assertEquals($result->count(), 2);
        $this->assertEquals($result->get(1), 'jones');
    }

    public function testDoubleBad()
    {
        $result = collectExplode(' jimmy , jones ');
        $this->assertEquals($result->count(), 2);
        $this->assertEquals($result->first(), 'jimmy');
        $this->assertEquals($result->get(1), 'jones');

        $result = collectExplode(' jimmy ;jones', ';');
        $this->assertEquals($result->count(), 2);
        $this->assertEquals($result->first(), 'jimmy');
        $this->assertEquals($result->get(1), 'jones');

        $result = collectExplode(' jimmy ; jones', ';');
        $this->assertEquals($result->count(), 2);
        $this->assertEquals($result->first(), 'jimmy');
        $this->assertEquals($result->get(1), 'jones');
    }
}
