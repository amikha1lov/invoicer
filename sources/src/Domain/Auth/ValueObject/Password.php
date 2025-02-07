<?php

declare(strict_types=1);

namespace App\Domain\Auth\ValueObject;

class Password
{
    private string $value;

    public function __construct(string $value)
    {
        $this->assertValidPassword($value);
        $this->value = $value;
    }

    public function getPassword(): string
    {
        return $this->value;
    }

    private function assertValidPassword(string $value): void
    {
        if (mb_strlen($value) < 6) {
            throw new \InvalidArgumentException('Пароль не может быть меньше 6 символов');
        }
    }
}