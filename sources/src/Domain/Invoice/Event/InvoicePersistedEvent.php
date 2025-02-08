<?php

declare(strict_types=1);

namespace App\Domain\Invoice\Event;

use App\Domain\Invoice\Entity\Invoice;

class InvoicePersistedEvent
{
    public function __construct(
        protected Invoice $invoice
    ) {
    }

    public function getInvoice(): Invoice
    {
        return $this->invoice;
    }

}
