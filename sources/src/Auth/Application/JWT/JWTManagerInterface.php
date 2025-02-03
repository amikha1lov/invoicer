<?php

declare(strict_types=1);

namespace App\Auth\Application\JWT;

use App\Auth\Domain\Entity\User;
use stdClass;

interface JWTManagerInterface
{
    public function encode(User $user): string;
    public function decode(string $token): StdClass;
}