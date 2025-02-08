<?php

declare(strict_types=1);

namespace App\Infrastructure\Auth\Security;

use App\Application\Auth\JWT\JWTManagerInterface;
use App\Domain\Auth\Entity\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

readonly class JWTManager implements JWTManagerInterface
{
    public function __construct(
        private ParameterBagInterface $env
    )
    {
    }

    public function encode(User $user): string
    {
        $issuedAt = time();
        $expirationTime = $issuedAt + 86400;
        $payload = [
            'iat' => $issuedAt,
            'exp' => $expirationTime,
            'email' => $user->getEmail()
        ];

        return JWT::encode($payload, $this->env->get('jwtToken'), 'HS256');
    }

    public function decode(string $token): StdClass
    {
        return JWT::decode($token, new Key($this->env->get('jwtToken'), 'HS256'));
    }
}