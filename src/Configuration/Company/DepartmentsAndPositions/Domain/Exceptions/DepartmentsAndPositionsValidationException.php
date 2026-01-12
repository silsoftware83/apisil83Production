<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Domain\Exceptions;

use DomainException;

final class DepartmentsAndPositionsValidationException extends DomainException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
