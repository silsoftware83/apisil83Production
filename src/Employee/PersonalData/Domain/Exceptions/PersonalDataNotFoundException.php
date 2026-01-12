<?php

namespace Src\Employee\PersonalData\Domain\Exceptions;

use DomainException;

final class PersonalDataNotFoundException extends DomainException
{
    public function __construct(int $id)
    {
        parent::__construct("PersonalData with ID {$id} not found");
    }
}
