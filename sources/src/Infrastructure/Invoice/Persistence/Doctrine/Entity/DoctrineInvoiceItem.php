<?php

declare(strict_types=1);

namespace App\Infrastructure\Invoice\Persistence\Doctrine\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: "invoice_items")]
class DoctrineInvoiceItem
{
    #[Id]
    #[GeneratedValue]
    #[Column]
    private int $id;

    #[Column(type: 'string', length: 255)]
    private string $name;

    #[Column(type: 'integer')]
    private int $quantity;

    #[Column(type: 'string')]
    private string $price;

    #[ManyToOne(targetEntity: DoctrineInvoice::class, inversedBy: 'items')]
    #[JoinColumn(name: 'invoice_id', referencedColumnName: 'id')]
    private DoctrineInvoice $invoice;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): DoctrineInvoiceItem
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): DoctrineInvoiceItem
    {
        $this->name = $name;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): DoctrineInvoiceItem
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): DoctrineInvoiceItem
    {
        $this->price = $price;
        return $this;
    }

    public function getInvoice(): DoctrineInvoice
    {
        return $this->invoice;
    }

    public function setInvoice(DoctrineInvoice $invoice): DoctrineInvoiceItem
    {
        $this->invoice = $invoice;
        return $this;
    }
}