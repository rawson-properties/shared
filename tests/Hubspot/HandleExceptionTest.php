<?php

namespace Rawson\Shared\Tests\Hubspot;

use Rawson\Shared\Libs\Exceptions\Hubspot\InvalidEmail;
use Rawson\Shared\Libs\Exceptions\Hubspot\InvalidOption;
use Rawson\Shared\Libs\Exceptions\Hubspot\PropertyDoesntExist;
use Rawson\Shared\Libs\Hubspot;
use SevenShores\Hubspot\Exceptions\BadRequest;
use PHPUnit\Framework\TestCase;

class HandleExceptionTest extends TestCase
{
    public function testDefault()
    {
        $ex = new BadRequest('', 400);

        $this->assertInstanceOf(BadRequest::class, Hubspot::handleBadRequest($ex));
    }

    public function testInvalidEmail()
    {
        $exampleMessage = file_get_contents(__DIR__ . '/data/exceptions/invalid_email.txt');
        $ex = new BadRequest($exampleMessage, 400);

        $this->assertInstanceOf(InvalidEmail::class, Hubspot::handleBadRequest($ex));
    }

    public function testInvalidOption()
    {
        $exampleMessage = file_get_contents(__DIR__ . '/data/exceptions/invalid_option.txt');
        $ex = new BadRequest($exampleMessage, 400);

        $this->assertInstanceOf(InvalidOption::class, Hubspot::handleBadRequest($ex));
    }

    public function testPropetyDoesntExist()
    {
        $exampleMessage = file_get_contents(__DIR__ . '/data/exceptions/property_doesnt_exist.txt');
        $ex = new BadRequest($exampleMessage, 400);

        $this->assertInstanceOf(PropertyDoesntExist::class, Hubspot::handleBadRequest($ex));
    }
}
