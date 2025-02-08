<?php

declare(strict_types=1);

namespace App\Domain\Invoice\Entity;

class Bank
{
    private ?int $id = null;

    private string $name;

    private string $bik;

    private string $inn;

    private string $kpp;

    private string $accountNumber;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getBik(): string
    {
        return $this->bik;
    }

    public function setBik(string $bik): void
    {
        $this->bik = $bik;
    }

    public function getInn(): string
    {
        return $this->inn;
    }

    public function setInn(string $inn): void
    {
        $this->inn = $inn;
    }

    public function getKpp(): string
    {
        return $this->kpp;
    }

    public function setKpp(string $kpp): void
    {
        $this->kpp = $kpp;
    }

    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }
    public function setAccountNumber(string $accountNumber): void
    {
        $this->accountNumber = $accountNumber;
    }
}
