<?php

declare(strict_types=1);

namespace App\Domain\Invoice\Factory;

use App\Domain\Invoice\Entity\Invoice;
use App\Domain\Invoice\ValueObject\Bank;
use App\Domain\Invoice\ValueObject\Client;
use App\Domain\Invoice\ValueObject\Supplier;

interface InvoiceFactoryInterface
{
    public function create(Client $client, Supplier $supplier, Bank $bank, string $number, array $items): Invoice;
}