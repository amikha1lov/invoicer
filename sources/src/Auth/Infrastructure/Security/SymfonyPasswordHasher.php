<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Security;

use App\Auth\Application\PasswordHasher\PasswordHasherInterface;
use App\Auth\Domain\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface as SymfonyHasher;

class SymfonyPasswordHasher implements PasswordHasherInterface
{
    public function __construct(
        private readonly SymfonyHasher       $passwordHasher,
        private readonly UserMapperInterface $userMapper
    )
    {
    }

    public function hash(User $user, string $password): string
    {
        $symfonyUser = $this->userMapper->toAuthenticatedUser($user);
        return $this->passwordHasher->hashPassword($symfonyUser, $password);
    }

    public function isValid(User $user, string $password): bool
    {
        $symfonyUser = $this->userMapper->toAuthenticatedUser($user);
        return $this->passwordHasher->isPasswordValid($symfonyUser, $password);
    }
}