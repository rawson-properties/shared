<?php

namespace Rawson\Shared\Libs\Exceptions\Hubspot;

use Illuminate\Support\Str;
use SevenShores\Hubspot\Exceptions\BadRequest;

class InvalidEmail extends BadRequest
{
    public function __construct(string $message, int $code, BadRequest $original)
    {
        $message = Str::after($message, 'Email address ');
        $message = Str::before($message, ' ');

        return parent::__construct($message, $code, $original);
    }
}
