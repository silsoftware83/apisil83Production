<?php

namespace Src\Employee\Directory\Domain\Exceptions;

use DomainException;

final class DirectoryValidationException extends DomainException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
