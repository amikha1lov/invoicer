<?php

declare(strict_types=1);

namespace App\Infrastructure\Auth\Persistence\Doctrine\Mapper;

use App\Domain\Auth\Entity\User;
use App\Infrastructure\Auth\Persistence\Doctrine\Entity\DoctrineUser;
use Symfony\Component\Serializer\SerializerInterface;

class DoctrineUserMapper
{
    public function __construct(
        private readonly SerializerInterface $serializer
    )
    {
    }

    public function toDoctrine(User $user): DoctrineUser
    {
        $normalized = \array_filter($this->serializer->normalize($user)); // попробовать также с invoice

        return $this->serializer
            ->denormalize($normalized, DoctrineUser::class);
    }

    public function fromDoctrine(DoctrineUser $user): User
    {
        $normalized = \array_filter($this->serializer->normalize($user));// попробовать также с invoice

        return $this->serializer
            ->denormalize($normalized, User::class);
    }
}