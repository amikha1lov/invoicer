<?php

declare(strict_types=1);

namespace App\Application\Auth\UseCase;

use App\Application\Auth\Exceptions\AuthenticationException;
use App\Application\Auth\Exceptions\UserNotFoundException;
use App\Application\Auth\JWT\JWTManagerInterface;
use App\Application\Auth\PasswordHasher\PasswordHasherInterface;
use App\Domain\Auth\Repository\UserRepositoryInterface;

class LoginUseCase
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly JWTManagerInterface $jwtManager,
        private readonly PasswordHasherInterface $passwordHasher,
    ) {
    }

    public function __invoke(LoginUseCaseRequest $request): LoginUseCaseResponse
    {
        $user = $this->userRepository->findByEmail($request->email);

        if (!$user) {
            throw new UserNotFoundException('Пользователь не найден');
        }

        if (!$this->passwordHasher->isValid($user, $request->password)) {
            throw new AuthenticationException('Неверный логин или пароль');
        }

        $token = $this->jwtManager->encode($user);

        return new LoginUseCaseResponse($token);
    }
}
