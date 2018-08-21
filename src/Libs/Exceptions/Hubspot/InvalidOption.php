<?php

namespace Rawson\Shared\Libs\Exceptions\Hubspot;

use SevenShores\Hubspot\Exceptions\BadRequest;
use StdClass;

class InvalidOption extends BadRequest
{
    public function __construct(StdClass $validationError, int $code, BadRequest $original)
    {
        $option = str_before($validationError->message, ' ');
        $message = sprintf('%s for %s', $option, $validationError->name);

        return parent::__construct($message, $code, $original);
    }
}
