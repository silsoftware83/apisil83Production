<?php

namespace Src\Configuration\Security\Domain\Exceptions;

use DomainException;

final class SecurityNotFoundException extends DomainException
{
    public function __construct(int $id)
    {
        parent::__construct("Security with ID {$id} not found");
    }
}
