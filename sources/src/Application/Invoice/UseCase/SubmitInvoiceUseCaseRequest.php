<?php

declare(strict_types=1);

namespace App\Application\Invoice\UseCase;

use App\Domain\Invoice\ValueObject\Bank;
use App\Domain\Invoice\ValueObject\Client;
use App\Domain\Invoice\ValueObject\Item;
use App\Domain\Invoice\ValueObject\Supplier;

class SubmitInvoiceUseCaseRequest
{
    public function __construct(
        public Client   $client,
        public Supplier $supplier,
        public Bank     $bank,
        public string   $number,
        public array    $items,
    ) {
        if (count($this->items) === 0) {
            throw new \InvalidArgumentException('Количество услуг/ товаров должно было больше нуля');
        }

        $this->items = array_map(fn ($item) => new Item(
            $item['name'],
            $item['quantity'],
            $item['price']
        ), $this->items);
    }
}
