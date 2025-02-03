<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Ulid;

use App\Auth\Domain\Ulid\UlidGeneratorInterface;
use Symfony\Component\Uid\Ulid as SymfonyUlid;

class Ulid implements UlidGeneratorInterface
{

    public function generate(): string
    {
        return SymfonyUlid::generate();
    }
}