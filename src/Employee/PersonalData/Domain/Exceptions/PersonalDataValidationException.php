<?php

namespace Src\Employee\PersonalData\Domain\Exceptions;

use DomainException;

final class PersonalDataValidationException extends DomainException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
