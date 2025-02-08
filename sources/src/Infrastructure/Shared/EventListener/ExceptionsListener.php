<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionsListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        $data = [
            'message' => $exception->getMessage(),
            'error' => true,
        ];
        $statusCode = $exception instanceof HttpExceptionInterface ? $exception->getStatusCode() : 500;

        $response = new JsonResponse($data, $statusCode);
        $event->setResponse($response);
    }
}
