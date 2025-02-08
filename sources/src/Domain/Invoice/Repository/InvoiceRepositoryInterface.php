<?php

declare(strict_types=1);

namespace App\Domain\Invoice\Repository;

use App\Domain\Auth\Entity\User;
use App\Domain\Invoice\Entity\Invoice;

interface InvoiceRepositoryInterface
{
    public function save(Invoice $invoice): void;
    public function findById(int $id): ?Invoice;
}
