<?php

declare(strict_types=1);

namespace App\Domain\Invoice\ValueObject;

class Item
{
    private string $name;
    private int $quantity;
    private float $price;

    public function __construct(string $name, int $quantity, float $price)
    {
        $this->assertNameValid($name);
        $this->assertQuantityValid($quantity);
        $this->assertPriceValid($price);
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPrice(): float
    {
        return $this->price;
    }


    private function assertNameValid(string $value): void
    {
        if (mb_strlen($value) < 2) {
            throw new \InvalidArgumentException('Название товара/услуги должно содержать хотя бы 2 символа');
        }
    }

    private function assertQuantityValid(int $value): void
    {
        if ($value < 1) {
            throw new \InvalidArgumentException('Количество товара / услуги должно быть больше нуля');
        }
    }

    private function assertPriceValid(float $value): void
    {
        if ($value < 1) {
            throw new \InvalidArgumentException('Цена товара услуги должна быть больше нуля');
        }
    }
}
