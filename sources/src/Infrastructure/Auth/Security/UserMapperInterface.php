<?php

declare(strict_types=1);

namespace App\Infrastructure\Auth\Security;

use App\Domain\Auth\Entity\User;

interface UserMapperInterface
{
    public function toAuthenticatedUser(User $user): AuthenticatedUser;
}
