<?php

declare(strict_types=1);

namespace App\Infrastructure\Invoice\Persistence\Doctrine\Entity;

use App\Infrastructure\Auth\Persistence\Doctrine\Entity\UserAwareEntityInterface;
use App\Infrastructure\Auth\Persistence\Doctrine\Entity\UserTrait;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: "invoices")]
class DoctrineInvoice implements UserAwareEntityInterface
{

    use UserTrait;

    #[ManyToOne(targetEntity: DoctrineBank::class, cascade: ["persist"])]
    #[JoinColumn(name: "bank_id", referencedColumnName: "id", onDelete: "CASCADE")]
    private ?DoctrineBank $bank = null;

    #[ManyToOne(targetEntity: DoctrineClient::class, cascade: ["persist"])]
    #[JoinColumn(name: "client_id", referencedColumnName: "id", onDelete: "CASCADE")]
    private ?DoctrineClient $client = null;

    #[ManyToOne(targetEntity: DoctrineSupplier::class, cascade: ["persist"])]
    #[JoinColumn(name: "supplier_id", referencedColumnName: "id", onDelete: "CASCADE")]
    private ?DoctrineSupplier $supplier = null;

    #[OneToMany(targetEntity: DoctrineInvoiceItem::class, mappedBy: 'invoice', cascade: ["persist"])]
    private iterable $items;

    #[Id]
    #[Column]
    #[GeneratedValue]
    private ?int $id = null;

    #[Column(type: 'string')]
    private string $number;

    #[Column(type: 'date')]
    private \DateTime $date;

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): DoctrineInvoice
    {
        $this->date = $date;
        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): DoctrineInvoice
    {
        $this->number = $number;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): DoctrineInvoice
    {
        $this->id = $id;
        return $this;
    }

    public function getItems(): iterable
    {
        return $this->items;
    }

    public function setItems(iterable $items): static
    {
        $this->items = $items;
        return $this;
    }

    public function getSupplier(): ?DoctrineSupplier
    {
        return $this->supplier;
    }

    public function setSupplier(?DoctrineSupplier $supplier): DoctrineInvoice
    {
        $this->supplier = $supplier;
        return $this;
    }

    public function getClient(): ?DoctrineClient
    {
        return $this->client;
    }

    public function setClient(?DoctrineClient $client): DoctrineInvoice
    {
        $this->client = $client;
        return $this;
    }

    public function getBank(): ?DoctrineBank
    {
        return $this->bank;
    }

    public function setBank(?DoctrineBank $bank): DoctrineInvoice
    {
        $this->bank = $bank;
        return $this;
    }
}