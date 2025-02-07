<?php

declare(strict_types=1);

namespace App\Application\Auth\PasswordHasher;

use App\Domain\Auth\Entity\User;

interface PasswordHasherInterface
{
    public function hash(User $user,string $password): string;
    public function isValid(User $user,string $password): bool;
}