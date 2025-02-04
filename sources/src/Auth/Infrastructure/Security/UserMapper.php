<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Security;

use App\Auth\Domain\Entity\User;

class UserMapper implements UserMapperInterface
{
    public function toAuthenticatedUser(User $user): AuthenticatedUser
    {
        return AuthenticatedUser::fromDomainUser($user);
    }
}