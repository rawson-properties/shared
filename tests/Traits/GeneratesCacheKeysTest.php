<?php

namespace Rawson\Shared\Tests\Traits;

use Rawson\Shared\Libs\Traits\GeneratesCacheKeys;
use PHPUnit_Framework_TestCase;

class GeneratesCacheKeysTest extends PHPUnit_Framework_TestCase
{
    use GeneratesCacheKeys;

    public function testEmpty()
    {
        $result = self::key();
        $this->assertEquals($result, self::class);
    }

    public function testBasic()
    {
        $result = self::key([ 'testBasic', ]);
        $this->assertEquals($result, sprintf('%s::testBasic', self::class));
    }

    public function testBasicDouble()
    {
        $result = self::key([ 'testBasic', 'testDouble' ]);
        $this->assertEquals($result, sprintf('%s::testBasic::testDouble', self::class));
    }

    public function testUnsave()
    {
        $result = self::key([ 'testUnsafe', ], [ 'testUnsafe', ]);
        $this->assertEquals($result, sprintf('%s::testUnsafe::%s', self::class, md5('testUnsafe')));
    }

    public function testUnsafeDouble()
    {
        $result = self::key([ 'testUnsafe', ], [ 'testUnsafe', 'testUnsafe', ]);
        $this->assertEquals($result, sprintf('%s::testUnsafe::%s::%s', self::class, md5('testUnsafe'), md5('testUnsafe')));
    }
}
