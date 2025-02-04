<?php

declare(strict_types=1);

namespace App\Auth\Application\PasswordHasher;

use App\Auth\Domain\Entity\User;

interface PasswordHasherInterface
{
    public function hash(User $user,string $password): string;
    public function isValid(User $user,string $password): bool;
}