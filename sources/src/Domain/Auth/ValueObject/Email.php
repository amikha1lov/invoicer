<?php

declare(strict_types=1);

namespace App\Domain\Auth\ValueObject;

class Email
{
    private string $value;

    public function __construct(string $value)
    {
        $this->assertEmailValid($value);
        $this->value = $value;
    }

    public function getEmail(): string
    {
        return $this->value;
    }

    private function assertEmailValid(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Неверный адрес электронной почты');
        }
    }
}