<?php

declare(strict_types=1);

namespace App\Application\Auth\Factory;

use App\Application\Auth\PasswordHasher\PasswordHasherInterface;
use App\Domain\Auth\Entity\User;
use App\Domain\Auth\Factory\UserFactoryInterface;
use App\Domain\Auth\ValueObject\Email;
use App\Domain\Auth\ValueObject\Password;
use App\Domain\Shared\Ulid\UlidGeneratorInterface;

class UserFactory implements UserFactoryInterface
{
    public function __construct(
        private readonly PasswordHasherInterface $passwordHasher,
    )
    {
    }

    public function create(string $email, string $password): User
    {

        $user = (new User())
            ->setEmail(
                (new Email($email))
                    ->getEmail()
            )->setPassword($password); // TODO убрать

        $hashedPassword = $this->passwordHasher->hash($user,
            (new Password($password))
                ->getPassword());

        $user->setPassword($hashedPassword);

        return $user;
    }
}