<?php

namespace Rawson\Shared\Libs\Exceptions\Hubspot;

use SevenShores\Hubspot\Exceptions\BadRequest;

class InvalidEmail extends BadRequest
{
    public function __construct(string $message, int $code, BadRequest $original)
    {
        $message = str_after($message, 'Email address ');
        $message = str_before($message, ' ');

        return parent::__construct($message, $code, $original);
    }
}
