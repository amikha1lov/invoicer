<?php

declare(strict_types=1);

namespace App\Auth\Application\Factory;

use App\Auth\Domain\Entity\User;
use App\Auth\Domain\Factory\UserFactoryInterface;
use App\Auth\Domain\Ulid\UlidGeneratorInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

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
        return (new User())
            ->setUlid($this->ulidGenerator->generate())
            ->setEmail($email)
            ->setPassword($this->passwordHasher->hash($password));
    }
}