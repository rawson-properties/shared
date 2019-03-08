<?php

namespace Rawson\Shared\Libs\Exceptions\Hubspot;

use Illuminate\Support\Str;
use SevenShores\Hubspot\Exceptions\BadRequest;

class InvalidOption extends BadRequest
{
    public function __construct(object $validationError, int $code, BadRequest $original)
    {
        $option = Str::before($validationError->message, ' ');
        $message = sprintf('%s for %s', $option, $validationError->name);

        return parent::__construct($message, $code, $original);
    }
}
