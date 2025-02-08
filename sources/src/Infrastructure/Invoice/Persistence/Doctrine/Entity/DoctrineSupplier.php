<?php

declare(strict_types=1);

namespace App\Infrastructure\Invoice\Persistence\Doctrine\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: "suppliers")]
class DoctrineSupplier
{
    #[Id]
    #[GeneratedValue]
    #[Column]
    private int $id;

    #[Column(type: 'string', length: 255)]
    private string $name;

    #[Column(type: 'string', length: 255)]
    private string $address;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): DoctrineSupplier
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): DoctrineSupplier
    {
        $this->name = $name;
        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): DoctrineSupplier
    {
        $this->address = $address;
        return $this;
    }
}
