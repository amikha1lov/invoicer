<?php

declare(strict_types=1);

namespace App\Infrastructure\Invoice\Messenger;

use App\Domain\Invoice\Event\InvoicePersistedEvent;
use App\Domain\Invoice\Service\InvoiceMailerInterface;
use App\Domain\Invoice\Service\InvoicePDFGeneratorInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class InvoicePersistedEventHandler
{
    public function __construct(
        private readonly InvoicePDFGeneratorInterface $pdfGenerator,
        private readonly InvoiceMailerInterface       $mailer
    ) {
    }

    public function __invoke(InvoicePersistedEvent $event): void
    {
        $invoice = $event->getInvoice();
        $pdfContent = $this->pdfGenerator->generate($invoice);

        $this->mailer->sendInvoice($invoice, $pdfContent);
    }
}
