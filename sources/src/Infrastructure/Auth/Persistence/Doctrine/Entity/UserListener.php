<?php

declare(strict_types=1);

namespace App\Infrastructure\Auth\Persistence\Doctrine\Entity;

use App\Domain\Auth\Context\CurrentUserInterface;
use App\Infrastructure\Auth\Persistence\Doctrine\Mapper\DoctrineUserMapper;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\PrePersistEventArgs;

class UserListener
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
        protected DoctrineUserMapper     $userMapper
    )
    {
    }

    public function prePersist(PrePersistEventArgs $args): void
    {
        $entity = $args->getObject();

        if (($entity instanceof UserAwareEntityInterface) === false) {
            return;
        }

        $userReference = $this->entityManager->getReference(
            DoctrineUser::class,
            1 // TODO понять как правильно получить тут текущего юзера
        );

        $entity->setUser($userReference);
    }
}