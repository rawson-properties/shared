<?php

namespace Rawson\Shared\Tests\Traits;

use Rawson\Shared\Libs\Traits\GeneratesCacheKeys;
use PHPUnit\Framework\TestCase;

class GeneratesCacheKeysTest extends TestCase
{
    use GeneratesCacheKeys;

    public function testEmpty()
    {
        $result = self::key();
        $this->assertEquals($result, sprintf('%s::testEmpty', self::class));
    }

    public function testBasic()
    {
        $result = self::key();
        $this->assertEquals($result, sprintf('%s::testBasic', self::class));
    }

    public function testBasicDouble()
    {
        $result = self::key([ 'testBasic', 'testDouble' ]);
        $this->assertEquals($result, sprintf('%s::testBasicDouble::testBasic::testDouble', self::class));
    }

    public function testUnsafe()
    {
        $result = self::key([ 'testUnsafe', ], [ 'testUnsafe', ]);
        $this->assertEquals($result, sprintf('%s::testUnsafe::testUnsafe::%s', self::class, md5('testUnsafe')));
    }

    public function testUnsafeDouble()
    {
        $result = self::key([ 'testUnsafe', ], [ 'testUnsafe', 'testUnsafe', ]);
        $this->assertEquals(
            $result,
            sprintf(
                '%s::testUnsafeDouble::testUnsafe::%s::%s',
                self::class,
                md5('testUnsafe'),
                md5('testUnsafe'),
            ),
        );
    }
}
