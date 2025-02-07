<?php

declare(strict_types=1);

namespace App\Application\Invoice\Factory;

use App\Domain\Invoice\Entity\Invoice;
use App\Domain\Invoice\Factory\InvoiceFactoryInterface;
use App\Domain\Invoice\ValueObject\Bank;
use App\Domain\Invoice\ValueObject\Client;
use App\Domain\Invoice\ValueObject\Supplier;
use DateTimeImmutable;

class InvoiceFactory implements InvoiceFactoryInterface
{
    public function create(Client $client, Supplier $supplier, Bank $bank, string $number): Invoice
    {
        $clientEntity = new \App\Domain\Invoice\Entity\Client();
        $clientEntity->setName($client->getName());
        $clientEntity->setAddress($client->getAddress());

        $supplierEntity = new \App\Domain\Invoice\Entity\Supplier();
        $supplierEntity->setName($supplier->getName());
        $supplierEntity->setAddress($supplier->getAddress());

        $bankEntity = new \App\Domain\Invoice\Entity\Bank();
        $bankEntity->setName($bank->getName());
        $bankEntity->setBik($bank->getBik());
        $bankEntity->setInn($bank->getInn());
        $bankEntity->setKpp($bank->getKpp());
        $bankEntity->setAccountNumber($bank->getAccountNumber());

        return (new Invoice(
            $clientEntity,
            $supplierEntity,
            $bankEntity,
            new DateTimeImmutable(),
            $number,
            []
        ));
    }
}