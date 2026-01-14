<?php

namespace Src\Employee\PersonalData\PersonalInformation\Domain\Exceptions;

use DomainException;

final class PersonalDataValidationException extends DomainException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
