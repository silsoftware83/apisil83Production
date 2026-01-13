<?php

namespace Src\Employee\Directory\Domain\Exceptions;

use DomainException;

final class DirectoryNotFoundException extends DomainException
{
    public function __construct(int $id)
    {
        parent::__construct("Directory with ID {$id} not found");
    }
}
