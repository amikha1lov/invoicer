<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCase;

class LoginUseCaseRequest
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
    )
    {
    }
}