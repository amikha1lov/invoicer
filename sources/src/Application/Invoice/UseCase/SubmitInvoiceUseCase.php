<?php

declare(strict_types=1);

namespace App\Application\Invoice\UseCase;

use App\Application\Invoice\Factory\InvoiceFactory;
use App\Domain\Invoice\Event\InvoicePersistedEvent;
use App\Domain\Invoice\Repository\InvoiceRepositoryInterface;

readonly class SubmitInvoiceUseCase
{
    public function __construct(
        private InvoiceFactory             $invoiceFactory,
        private InvoiceRepositoryInterface $invoiceRepository
    )
    {
    }

    public function __invoke(SubmitInvoiceUseCaseRequest $request): InvoicePersistedEvent
    {
        $invoice = $this->invoiceFactory->create(
            $request->client,
            $request->supplier,
            $request->bank,
            $request->number,
            $request->items
        );

        $this->invoiceRepository->save($invoice);

        return new InvoicePersistedEvent($invoice);
    }
}