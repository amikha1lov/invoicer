<?php

declare(strict_types=1);

namespace App\Infrastructure\Auth\Http;

use App\Application\Auth\UseCase\RegisterUseCase;
use App\Application\Auth\UseCase\RegisterUseCaseRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

class RegisterController extends AbstractController
{
    public function __construct(
        private readonly RegisterUseCase $registerUseCase
    ) {
    }

    #[Route(path:'/auth/register', name: 'register', methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] RegisterUseCaseRequest $request): JsonResponse
    {
        try {
            $response = ($this->registerUseCase)($request);
            return $this->json($response, 201);
        } catch (Throwable $exception) {
            $errorResponse = [
                'message' => $exception->getMessage(),
            ];
            return $this->json($errorResponse, 400);
        }
    }
}
