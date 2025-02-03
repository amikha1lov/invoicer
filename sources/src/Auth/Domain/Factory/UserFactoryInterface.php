<?php

declare(strict_types=1);

namespace App\Auth\Domain\Factory;

use App\Auth\Domain\Entity\User;

interface UserFactoryInterface
{
    public function create(string $email, string $password): User;
}