<?php

declare(strict_types=1);

namespace App\Infrastructure\Invoice\Persistence\Doctrine\Mapper;

use App\Domain\Invoice\Entity\Bank;
use App\Domain\Invoice\Entity\Client;
use App\Domain\Invoice\Entity\Invoice;
use App\Domain\Invoice\Entity\InvoiceItem;
use App\Domain\Invoice\Entity\Supplier;
use App\Domain\Invoice\Factory\InvoiceFactoryInterface;
use App\Infrastructure\Invoice\Persistence\Doctrine\Entity\DoctrineBank;
use App\Infrastructure\Invoice\Persistence\Doctrine\Entity\DoctrineClient;
use App\Infrastructure\Invoice\Persistence\Doctrine\Entity\DoctrineInvoice;
use App\Infrastructure\Invoice\Persistence\Doctrine\Entity\DoctrineInvoiceItem;
use App\Infrastructure\Invoice\Persistence\Doctrine\Entity\DoctrineSupplier;
use DateTimeImmutable;

readonly class DoctrineInvoiceMapper
{
    public function __construct(
        private InvoiceFactoryInterface $invoiceFactory
    )
    {
    }

    public function toDoctrine(Invoice $invoice): DoctrineInvoice
    {
        // TODO serializer
        $doctrineClient = (new DoctrineClient())
            ->setAddress($invoice->getClient()->getAddress())
            ->setName($invoice->getClient()->getName());

        $doctrineSupplier = (new DoctrineSupplier())
            ->setAddress($invoice->getSupplier()->getAddress())
            ->setName($invoice->getSupplier()->getName());

        $doctrineBank = (new DoctrineBank())
            ->setName($invoice->getBank()->getName())
            ->setKpp($invoice->getBank()->getKpp())
            ->setBik($invoice->getBank()->getBik())
            ->setInn($invoice->getBank()->getInn())
            ->setAccountNumber($invoice->getBank()->getAccountNumber());

        $doctrineInvoice = (new DoctrineInvoice())
            ->setClient($doctrineClient)
            ->setSupplier($doctrineSupplier)
            ->setBank($doctrineBank)
            ->setDate(\DateTime::createFromImmutable(new DateTimeImmutable($invoice->getDate())))
            ->setNumber($invoice->getNumber());

        $doctrineInvoiceItems = \array_map(function (InvoiceItem $invoiceItem) use ($doctrineInvoice) {
            return (new DoctrineInvoiceItem())
                ->setName($invoiceItem->getName())
                ->setPrice($invoiceItem->getPrice())
                ->setQuantity($invoiceItem->getQuantity())
                ->setInvoice($doctrineInvoice);
        },$invoice->getItems());

        $doctrineInvoice->setItems($doctrineInvoiceItems);

        return $doctrineInvoice;
    }

    public function fromDoctrine(DoctrineInvoice $invoice): Invoice
    {

        $domainClient = new Client();
        $domainClient->setName($invoice->getClient()->getName());
        $domainClient->setAddress($invoice->getClient()->getAddress());
        $domainClient->setId($invoice->getClient()->getId());

        $domainSupplier = new Supplier();
        $domainSupplier->setName($invoice->getSupplier()->getName());
        $domainSupplier->setAddress($invoice->getSupplier()->getAddress());
        $domainSupplier->setId($invoice->getSupplier()->getId());

        $domainBank = new Bank();
        $domainBank->setId($invoice->getBank()->getId());
        $domainBank->setName($invoice->getBank()->getName());
        $domainBank->setKpp($invoice->getBank()->getKpp());
        $domainBank->setBik($invoice->getBank()->getBik());
        $domainBank->setInn($invoice->getBank()->getInn());

        return (new Invoice(
            $domainClient,
            $domainSupplier,
            $domainBank,
            DateTimeImmutable::createFromMutable($invoice->getDate()),
            $invoice->getNumber(),
            $invoice->getItems()
        ));
    }
}