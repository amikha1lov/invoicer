<?php

declare(strict_types=1);

namespace App\Infrastructure\Invoice\Http;

use App\Application\Invoice\UseCase\SubmitInvoiceUseCase;
use App\Application\Invoice\UseCase\SubmitInvoiceUseCaseRequest;
use App\Application\Invoice\UseCase\SubmitInvoiceUseCaseResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

class InvoiceController extends AbstractController
{
    public function __construct(
        private readonly SubmitInvoiceUseCase $useCase,
        private readonly MessageBusInterface  $messageBus
    )
    {
    }

    #[Route(path: '/invoice', name: 'invoice', methods: ['POST'])]
    public function __invoke(#[MapRequestPayload] SubmitInvoiceUseCaseRequest $request): JsonResponse
    {
        try {
            $event = ($this->useCase)($request);
            $this->messageBus->dispatch(
                $event,
                [
                    new AmqpStamp('notification.invoice.created')
                ]
            );

            $response = new SubmitInvoiceUseCaseResponse($event->getInvoice()->getId());

            return $this->json($response, 201);
        } catch (Throwable $exception) {
            $errorResponse = [
                'message' => $exception->getMessage(),
            ];
            return $this->json($errorResponse, 400);
        }
    }
}