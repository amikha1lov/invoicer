<?php

declare(strict_types=1);

namespace App\Infrastructure\Auth\Security;

use App\Domain\Auth\Entity\User;
use App\Domain\Auth\Repository\UserRepositoryInterface;
use App\Infrastructure\Auth\Exceptions\LoadUserByIdentifierException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

readonly class UserProvider implements UserProviderInterface
{
    public function __construct(
        private UserMapper              $userMapper,
        private UserRepositoryInterface $userRepository,
    ) {
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
