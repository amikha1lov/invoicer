<?php

declare(strict_types=1);

namespace App\Application\Auth\UseCase;

use App\Application\Auth\Exceptions\UserExistException;
use App\Application\Auth\JWT\JWTManagerInterface;
use App\Domain\Auth\Factory\UserFactoryInterface;
use App\Domain\Auth\Repository\UserRepositoryInterface;

class RegisterUseCase
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly JWTManagerInterface $jwtManager,
        private readonly UserFactoryInterface $userFactory,
    )
    {
    }

    public function __invoke(RegisterUseCaseRequest $request): RegisterUseCaseResponse
    {
        $user = $this->userRepository->findByEmail($request->email);

        if ($user) {
            throw new UserExistException('Пользователь уже существует');
        }

        $user = $this->userFactory->create($request->email, $request->password);

        $this->userRepository->save($user);

        $token = $this->jwtManager->encode($user);

        return new RegisterUseCaseResponse($token);
    }
}