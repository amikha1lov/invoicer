<?php

declare(strict_types=1);

namespace App\Infrastructure\Auth\Security;

use App\Domain\Auth\Context\CurrentUserInterface;
use App\Domain\Auth\Entity\User;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthenticatedUser implements UserInterface, PasswordAuthenticatedUserInterface, CurrentUserInterface
{
    public function __construct(
        public ?int   $id = null,
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

    public static function fromDomainUser(User $user): static
    {
        return new static($user->getId(), $user->getEmail(), $user->getPassword());
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getId(): int
    {
        return $this->id;
    }
}