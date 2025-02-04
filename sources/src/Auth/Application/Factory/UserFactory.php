<?php

declare(strict_types=1);

namespace App\Auth\Application\Factory;

use App\Auth\Application\PasswordHasher\PasswordHasherInterface;
use App\Auth\Domain\Entity\User;
use App\Auth\Domain\Factory\UserFactoryInterface;
use App\Auth\Domain\Ulid\UlidGeneratorInterface;

class UserFactory implements UserFactoryInterface
{
    public function __construct(
        private readonly UlidGeneratorInterface  $ulidGenerator,
        private readonly PasswordHasherInterface $passwordHasher,
    )
    {
    }

    public function create(string $email, string $password): User
    {
        $user = (new User())
            ->setUlid($this->ulidGenerator->generate())
            ->setEmail($email);

        $user->setPassword($this->passwordHasher->hash($user, $password));

        return $user;
    }
}