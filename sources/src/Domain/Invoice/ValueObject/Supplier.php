<?php

declare(strict_types=1);

namespace App\Domain\Invoice\ValueObject;

class Supplier
{
    private string $name;
    private string $address;

    public function __construct(string $name, string $address)
    {
        $this->assertNameValid($name);
        $this->assertAddressValid($address);
        $this->name = $name;
        $this->address = $address;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getName(): string
    {
        return $this->name;
    }

    private function assertNameValid(string $value): void
    {
        if (mb_strlen($value) < 2) {
            throw new \InvalidArgumentException('Название поставщика должно содержать хотя бы 2 символа');
        }
    }

    private function assertAddressValid(string $value): void
    {
        if (mb_strlen($value) < 2) {
            throw new \InvalidArgumentException('Адрес поставщика должно содержать хотя бы 2 символа');
        }
    }
}
