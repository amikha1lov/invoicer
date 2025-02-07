<?php

declare(strict_types=1);

namespace App\Domain\Invoice\Service;

use App\Domain\Invoice\Entity\Invoice;

interface InvoiceMailerInterface
{
    public function sendInvoice(Invoice $invoice, string $pdfContent): void;
}