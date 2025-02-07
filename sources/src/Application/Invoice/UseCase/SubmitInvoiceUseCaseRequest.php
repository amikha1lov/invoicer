<?php

declare(strict_types=1);

namespace App\Application\Invoice\UseCase;

use App\Domain\Invoice\ValueObject\Bank;
use App\Domain\Invoice\ValueObject\Client;
use App\Domain\Invoice\ValueObject\Supplier;

readonly class SubmitInvoiceUseCaseRequest
{
    public function __construct(
        public Client   $client,
        public Supplier $supplier,
        public Bank     $bank,
        public string   $number
    )
    {
    }
}