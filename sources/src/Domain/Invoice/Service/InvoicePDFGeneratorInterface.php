<?php

declare(strict_types=1);

namespace App\Domain\Invoice\Service;

use App\Domain\Invoice\Entity\Invoice;

interface InvoicePDFGeneratorInterface
{
    public function generate(Invoice $invoice): string;
}