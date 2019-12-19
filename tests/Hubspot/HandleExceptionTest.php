<?php

namespace Rawson\Shared\Tests\Hubspot;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Rawson\Shared\Libs\Exceptions\Hubspot\InvalidEmail;
use Rawson\Shared\Libs\Exceptions\Hubspot\InvalidOption;
use Rawson\Shared\Libs\Exceptions\Hubspot\PropertyDoesntExist;
use Rawson\Shared\Libs\Hubspot;
use SevenShores\Hubspot\Exceptions\BadRequest;
use PHPUnit\Framework\TestCase;

class HandleExceptionTest extends TestCase
{
    public function testNoPrevious()
    {
        $ex = new BadRequest('', 400);
        $this->assertInstanceOf(BadRequest::class, Hubspot::handleBadRequest($ex));
    }

    public function testDefault()
    {
        $req = new Request('GET', '');
        $res = new Response(200, [], '');
        $ex = new BadRequest('', 400, new ClientException('', $req, $res));

        $this->assertInstanceOf(BadRequest::class, Hubspot::handleBadRequest($ex));
    }

    public function testInvalidEmail()
    {
        $req = new Request('GET', '');
        $res = new Response(200, [], file_get_contents(__DIR__ . '/data/exceptions/invalid_email.json'));
        $ex = new BadRequest('', 400, new ClientException('', $req, $res));

        $this->assertInstanceOf(InvalidEmail::class, Hubspot::handleBadRequest($ex));
    }

    public function testInvalidOption()
    {
        $req = new Request('GET', '');
        $res = new Response(200, [], file_get_contents(__DIR__ . '/data/exceptions/invalid_option.json'));
        $ex = new BadRequest('', 400, new ClientException('', $req, $res));

        $this->assertInstanceOf(InvalidOption::class, Hubspot::handleBadRequest($ex));
    }

    public function testPropetyDoesntExist()
    {
        $req = new Request('GET', '');
        $res = new Response(200, [], file_get_contents(__DIR__ . '/data/exceptions/property_doesnt_exist.json'));
        $ex = new BadRequest('', 400, new ClientException('', $req, $res));

        $this->assertInstanceOf(PropertyDoesntExist::class, Hubspot::handleBadRequest($ex));
    }
}
