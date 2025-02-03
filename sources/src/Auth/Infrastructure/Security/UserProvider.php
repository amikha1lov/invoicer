<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Security;

use App\Auth\Domain\Entity\User;
use App\Auth\Domain\Repository\UserRepositoryInterface;
use App\Auth\Infrastructure\Exceptions\LoadUserByIdentifierException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{

    public function __construct(
        private readonly UserMapper $userMapper,
        private readonly UserRepositoryInterface $userRepository,
    )
    {
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $user;
    }

    public function supportsClass(string $class): bool
    {
        return User::class === $class;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->userRepository->findByEmail($identifier);

        if ($user === null) {
            throw new LoadUserByIdentifierException('Пользователь не найден');
        }

        return $this->userMapper->toAuthenticatedUser($user);
    }
}