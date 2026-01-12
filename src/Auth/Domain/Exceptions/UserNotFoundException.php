<?php

namespace Src\Auth\Domain\Exceptions;

use DomainException;

final class UserNotFoundException extends DomainException
{
    public function __construct(string $identifier)
    {
        parent::__construct("User with identifier '{$identifier}' not found");
    }
}
