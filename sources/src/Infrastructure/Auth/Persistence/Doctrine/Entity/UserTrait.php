<?php

namespace App\Infrastructure\Auth\Persistence\Doctrine\Entity;

use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

trait UserTrait
{
    #[ManyToOne(targetEntity: DoctrineUser::class, cascade: ["persist"])]
    #[JoinColumn(name: "user_id", referencedColumnName: "id", onDelete: "CASCADE")]
    private ?DoctrineUser $user = null;

    public function getUser(): ?DoctrineUser
    {
        return $this->user;
    }

    public function setUser(?DoctrineUser $user): static
    {
        $this->user = $user;

        return $this;
    }
}