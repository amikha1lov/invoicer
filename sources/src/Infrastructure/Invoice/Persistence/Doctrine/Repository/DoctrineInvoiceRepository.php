<?php

declare(strict_types=1);

namespace App\Infrastructure\Invoice\Persistence\Doctrine\Repository;

use App\Domain\Auth\Entity\User;
use App\Domain\Invoice\Entity\Invoice;
use App\Domain\Invoice\Repository\InvoiceRepositoryInterface;
use App\Infrastructure\Auth\Persistence\Doctrine\Mapper\DoctrineUserMapper;
use App\Infrastructure\Invoice\Persistence\Doctrine\Entity\DoctrineInvoice;
use App\Infrastructure\Invoice\Persistence\Doctrine\Mapper\DoctrineInvoiceMapper;
use Doctrine\ORM\EntityManagerInterface;

readonly class DoctrineInvoiceRepository implements InvoiceRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private DoctrineInvoiceMapper  $mapper,
        private DoctrineUserMapper  $userMapper
    )
    {
    }

    public function save(Invoice $invoice): void
    {
        $doctrineInvoice = $this->mapper->toDoctrine($invoice);

        if (\is_null($doctrineInvoice->getId()) === false) {
            $doctrineReference = $this->entityManager->getReference(DoctrineInvoice::class, $doctrineInvoice->getId());

            if ($this->entityManager->contains($doctrineReference) === false) {
                $this->entityManager->persist($doctrineInvoice);
            }
        } else {
            $this->entityManager->persist($doctrineInvoice);
        }

        $this->entityManager->flush();
        $invoice->setId($doctrineInvoice->getId());
        $invoice->setUser($this->userMapper->fromDoctrine($doctrineInvoice->getUser()));
    }

    public function findById(int $id): ?Invoice
    {
        $doctrineEntity = $this->entityManager
            ->getRepository(DoctrineInvoice::class)
            ->find($id);

        return $this->getOneOrNothing($doctrineEntity);
    }

    private function getOneOrNothing(?DoctrineInvoice $invoice): ?Invoice
    {
        return $invoice ? $this->mapper->fromDoctrine($invoice) : null;
    }

}