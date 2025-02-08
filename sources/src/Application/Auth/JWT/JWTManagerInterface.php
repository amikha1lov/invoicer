<?php

declare(strict_types=1);

namespace App\Application\Auth\JWT;

use App\Domain\Auth\Entity\User;
use stdClass;

interface JWTManagerInterface
{
    public function encode(User $user): string;
    public function decode(string $token): StdClass;
}
