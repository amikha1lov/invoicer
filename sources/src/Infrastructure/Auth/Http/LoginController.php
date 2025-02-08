<?php

declare(strict_types=1);

namespace App\Infrastructure\Auth\Http;

use App\Application\Auth\UseCase\LoginUseCase;
use App\Application\Auth\UseCase\LoginUseCaseRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

class LoginController extends AbstractController
{
    public function __construct(
        private readonly LoginUseCase $loginUseCase
    )
    {
    }

    #[Route(path:'/auth/login', name: 'login',  methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] LoginUseCaseRequest $request): JsonResponse
    {
        try {
            $response = ($this->loginUseCase)($request);
            return $this->json($response, 201);
        } catch (Throwable $exception) {
            $errorResponse = [
                'message' => $exception->getMessage(),
            ];
            return $this->json($errorResponse, 400);
        }
    }
}