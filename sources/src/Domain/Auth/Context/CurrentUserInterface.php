<?php

declare(strict_types=1);

namespace App\Domain\Auth\Context;

interface CurrentUserInterface
{
    public function getId(): int;
}