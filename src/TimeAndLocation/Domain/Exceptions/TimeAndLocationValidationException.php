<?php

namespace Src\TimeAndLocation\Domain\Exceptions;

use DomainException;

final class TimeAndLocationValidationException extends DomainException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
