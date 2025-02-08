<?php

declare(strict_types=1);

namespace App\Domain\Auth\Entity;

class User
{
    private ?int $id = null;
    private string $email;
    private string $password;

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}