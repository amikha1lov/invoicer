<?php

declare(strict_types=1);

namespace App\Application\Auth\UseCase;

class LoginUseCaseResponse
{
    public function __construct(
        public readonly string $token,
    )
    {
    }
}