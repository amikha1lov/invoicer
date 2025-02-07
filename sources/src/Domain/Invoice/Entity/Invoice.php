<?php

declare(strict_types=1);

namespace App\Domain\Invoice\Entity;

use App\Domain\Auth\Entity\User;
use DateTimeImmutable;

class Invoice
{
    private ?int $id = null;
    private ?User $user = null;

    public function __construct(
        private Client            $client,
        private Supplier          $supplier,
        private Bank              $bank,
        private DateTimeImmutable $date,
        private string            $number,
        private iterable          $items,
    )
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Invoice
    {
        $this->id = $id;
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): Invoice
    {
        $this->user = $user;
        return $this;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): Invoice
    {
        $this->client = $client;
        return $this;
    }

    public function getSupplier(): Supplier
    {
        return $this->supplier;
    }

    public function setSupplier(Supplier $supplier): Invoice
    {
        $this->supplier = $supplier;
        return $this;
    }

    public function getBank(): Bank
    {
        return $this->bank;
    }

    public function setBank(Bank $bank): Invoice
    {
        $this->bank = $bank;
        return $this;
    }

    public function getDate(): string
    {
        return $this->date->format('Y-m-d');
    }

    public function setDate(DateTimeImmutable $date): Invoice
    {
        $this->date = $date;
        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): Invoice
    {
        $this->number = $number;
        return $this;
    }

    public function getItems(): iterable
    {
        return $this->items;
    }

    public function setItems(iterable $items): Invoice
    {
        $this->items = $items;
        return $this;
    }

}