<?php

declare(strict_types=1);

namespace App\Auth\Domain\Entity;

class User
{
    private string $ulid;
    private string $email;
    private string $password;
    public function setUlid(string $ulid): static
    {
        $this->ulid = $ulid;

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

    public function getUlid(): string
    {
        return $this->ulid;
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