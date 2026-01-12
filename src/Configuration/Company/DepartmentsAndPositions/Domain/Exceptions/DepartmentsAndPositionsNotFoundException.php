<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Domain\Exceptions;

use DomainException;

final class DepartmentsAndPositionsNotFoundException extends DomainException
{
    public function __construct(int $id)
    {
        parent::__construct("DepartmentsAndPositions with ID {$id} not found");
    }
}
