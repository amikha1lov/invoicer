<?php

declare(strict_types=1);

namespace App\Infrastructure\Auth\Persistence\Doctrine\Entity;

use App\Infrastructure\Notification\Persistence\Doctrine\Entity\DoctrineTelegram;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: "users")]
class DoctrineUser
{
    #[Id]
    #[Column]
    #[GeneratedValue]
    private ?int $id = null;

    #[Column(type: "string")]
    private string $email;

    #[Column(type: "string")]
    private string $password;

    #[OneToOne(targetEntity: DoctrineTelegram::class, mappedBy: "user")]
    private ?DoctrineTelegram $telegramUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getTelegramUser(): ?DoctrineTelegram
    {
        return $this->telegramUser;
    }

    public function setTelegramUser(?DoctrineTelegram $telegramUser): void
    {
        $this->telegramUser = $telegramUser;
    }


}