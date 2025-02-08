<?php

declare(strict_types=1);

namespace App\Domain\Invoice\Entity;

class InvoiceItem
{
    private ?int $id = null;

    private string $name;

    private int $quantity;

    private float $price;

    private Invoice $invoice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): InvoiceItem
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): InvoiceItem
    {
        $this->name = $name;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): InvoiceItem
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): InvoiceItem
    {
        $this->price = $price;
        return $this;
    }

    public function getInvoice(): Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(Invoice $invoice): InvoiceItem
    {
        $this->invoice = $invoice;
        return $this;
    }

    public function getTotal(): float|int
    {
        return $this->quantity * $this->price;
    }
}