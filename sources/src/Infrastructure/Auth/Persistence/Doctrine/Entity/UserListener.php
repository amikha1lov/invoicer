<?php

declare(strict_types=1);

namespace App\Infrastructure\Auth\Persistence\Doctrine\Entity;

use App\Infrastructure\Auth\Persistence\Doctrine\Mapper\DoctrineUserMapper;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Symfony\Bundle\SecurityBundle\Security;

class UserListener
{
    public function __construct(
        protected EntityManagerInterface $entityManager,
        protected DoctrineUserMapper     $userMapper,
        protected Security     $security
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
            $this->security
                ->getToken()
                ->getUser()
                ->getId()
        );

        $entity->setUser($userReference);
    }
}