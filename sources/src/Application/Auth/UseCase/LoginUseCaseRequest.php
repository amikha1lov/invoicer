<?php

declare(strict_types=1);

namespace App\Application\Auth\UseCase;

class LoginUseCaseRequest
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    )
    {
    }
}