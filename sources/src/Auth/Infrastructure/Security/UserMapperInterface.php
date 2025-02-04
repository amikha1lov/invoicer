<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Security;

use App\Auth\Domain\Entity\User;

interface UserMapperInterface
{
    public function toAuthenticatedUser(User $user): AuthenticatedUser;
}