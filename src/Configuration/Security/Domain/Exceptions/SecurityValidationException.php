<?php

namespace Src\Configuration\Security\Domain\Exceptions;

use DomainException;

final class SecurityValidationException extends DomainException
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
