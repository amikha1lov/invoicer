<?php

declare(strict_types=1);

namespace App\Domain\Auth\Factory;

use App\Domain\Auth\Entity\User;

interface UserFactoryInterface
{
    public function create(string $email, string $password): User;
}
