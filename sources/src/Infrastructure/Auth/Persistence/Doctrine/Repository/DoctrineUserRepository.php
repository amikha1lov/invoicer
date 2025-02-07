<?php

declare(strict_types=1);

namespace App\Infrastructure\Auth\Persistence\Doctrine\Repository;

use App\Domain\Auth\Entity\User;
use App\Domain\Auth\Repository\UserRepositoryInterface;
use App\Infrastructure\Auth\Persistence\Doctrine\Entity\DoctrineUser;
use App\Infrastructure\Auth\Persistence\Doctrine\Mapper\DoctrineUserMapper;
use Doctrine\ORM\EntityManagerInterface;

readonly class DoctrineUserRepository implements UserRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private DoctrineUserMapper $mapper
    )
    {
    }

    public function save(User $user): void
    {
        $doctrineUser = $this->mapper->toDoctrine($user);

        if (\is_null($doctrineUser->getId()) === false) {
            $doctrineReference = $this->entityManager->getReference(DoctrineUser::class, $doctrineUser->getId());

            if ($this->entityManager->contains($doctrineReference) === false) {
                $this->entityManager->persist($doctrineUser);
            }
        } else {
            $this->entityManager->persist($doctrineUser);
        }

        $this->entityManager->flush();
        $user->setId($doctrineUser->getId());
    }

    public function findById(int $id): ?User
    {
        $doctrineEntity = $this->entityManager
            ->getRepository(DoctrineUser::class)
            ->find($id);

        return $this->getOneOrNothing($doctrineEntity);
    }

    public function findByEmail(string $email): ?User
    {
        $doctrineEntity = $this->entityManager
            ->getRepository(DoctrineUser::class)
            ->findOneBy(['email' => $email]);

        return $this->getOneOrNothing($doctrineEntity);
    }

    private function getOneOrNothing(?DoctrineUser $user): ?User
    {
        return $user ? $this->mapper->fromDoctrine($user) : null;
    }
}