<?php

declare(strict_types=1);

namespace App\Auth\Domain\Ulid;

interface UlidGeneratorInterface
{
    public function generate(): string;
}