<?php

namespace Src\TimeAndLocation\Domain\Exceptions;

use DomainException;

final class TimeAndLocationNotFoundException extends DomainException
{
    public function __construct(int $id)
    {
        parent::__construct("TimeAndLocation with ID {$id} not found");
    }
}
