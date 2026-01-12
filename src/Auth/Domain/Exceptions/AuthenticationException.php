<?php

namespace Src\Auth\Domain\Exceptions;

use DomainException;

final class AuthenticationException extends DomainException
{
    public function __construct(string $message = 'Authentication failed')
    {
        parent::__construct($message);
    }
}
