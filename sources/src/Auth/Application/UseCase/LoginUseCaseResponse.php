<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCase;

class LoginUseCaseResponse
{
    public function __construct(
        public readonly string $token,
    )
    {
    }
}