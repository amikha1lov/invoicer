<?php

declare(strict_types=1);

namespace App\Application\Invoice\UseCase;

readonly class SubmitInvoiceUseCaseResponse
{
    public function __construct(
        public int $invoiceId,
    )
    {
    }
}