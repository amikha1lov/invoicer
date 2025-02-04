<?php

declare(strict_types=1);

namespace App\Auth\Application\UseCase;

use App\Auth\Application\Exceptions\AuthenticationException;
use App\Auth\Application\Exceptions\UserNotFoundException;
use App\Auth\Application\JWT\JWTManagerInterface;
use App\Auth\Application\PasswordHasher\PasswordHasherInterface;
use App\Auth\Domain\Repository\UserRepositoryInterface;

class LoginUseCase
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly JWTManagerInterface $jwtManager,
        private readonly PasswordHasherInterface $passwordHasher,
    )
    {
    }

    public function __invoke(LoginUseCaseRequest $request): LoginUseCaseResponse
    {
        $user = $this->userRepository->findByEmail($request->email);

        if(!$user) {
            throw new UserNotFoundException('Пользователь не найден');
        }

        if (!$this->passwordHasher->isValid($user, $request->password)) {
            throw new AuthenticationException('Неверный логин или пароль');
        }

        $token = $this->jwtManager->encode($user);

        return new LoginUseCaseResponse($token);
    }
}