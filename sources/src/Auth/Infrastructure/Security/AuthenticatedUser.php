<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Security;

use App\Auth\Domain\Entity\User;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthenticatedUser implements UserInterface, PasswordAuthenticatedUserInterface
{

    public function __construct(
        public string $ulid,
        public string $email,
        public string $password
    )
    {
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public static function fromDomainUser(User $user): self
    {
        return new static($user->getUlid(), $user->getEmail(), $user->getPassword());
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }
}