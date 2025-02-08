<?php

declare(strict_types=1);

namespace App\Infrastructure\Invoice\Persistence\Doctrine\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: "banks")]
class DoctrineBank
{
    #[Id]
    #[GeneratedValue]
    #[Column]
    private int $id;

    #[Column(type: 'string', length: 255)]
    private string $name;

    #[Column(type: 'string', length: 20)]
    private string $bik;

    #[Column(type: 'string', length: 20)]
    private string $inn;

    #[Column(type: 'string', length: 20)]
    private string $kpp;

    #[Column(type: 'string', length: 20)]
    private string $accountNumber;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): DoctrineBank
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): DoctrineBank
    {
        $this->name = $name;
        return $this;
    }

    public function getBik(): string
    {
        return $this->bik;
    }

    public function setBik(string $bik): DoctrineBank
    {
        $this->bik = $bik;
        return $this;
    }

    public function getInn(): string
    {
        return $this->inn;
    }

    public function setInn(string $inn): DoctrineBank
    {
        $this->inn = $inn;
        return $this;
    }

    public function getKpp(): string
    {
        return $this->kpp;
    }

    public function setKpp(string $kpp): DoctrineBank
    {
        $this->kpp = $kpp;
        return $this;
    }

    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    public function setAccountNumber(string $accountNumber): DoctrineBank
    {
        $this->accountNumber = $accountNumber;
        return $this;
    }
}
