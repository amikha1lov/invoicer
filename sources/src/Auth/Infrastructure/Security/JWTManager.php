<?php

declare(strict_types=1);

namespace App\Auth\Infrastructure\Security;

use App\Auth\Application\JWT\JWTManagerInterface;
use App\Auth\Domain\Entity\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;

class JWTManager implements JWTManagerInterface
{
    public function encode(User $user): string
    {
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600;
        $payload = [
            'iat' => $issuedAt,
            'exp' => $expirationTime,
            'email' => $user->getEmail()
        ];
        $key = 'psDwMLW76aefLA5Cw/7IRu/o8OM5/AOFMUlLZSqo6kokfJdJGptSau97IctejQGcSxOrXhTLUmS5gcGolEZkjg=='; // вынести в .env и создать новый

        return JWT::encode($payload, $key, 'HS256');
    }

    public function decode(string $token): StdClass
    {
        $key = 'psDwMLW76aefLA5Cw/7IRu/o8OM5/AOFMUlLZSqo6kokfJdJGptSau97IctejQGcSxOrXhTLUmS5gcGolEZkjg==';
        return JWT::decode($token, new Key($key, 'HS256'));
    }
}