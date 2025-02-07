<?php

declare(strict_types=1);

namespace App\Infrastructure\Notification\Persistence\Doctrine\Entity;

use App\Infrastructure\Auth\Persistence\Doctrine\Entity\UserAwareEntityInterface;
use App\Infrastructure\Auth\Persistence\Doctrine\Entity\UserTrait;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: "telegram_users")]
class DoctrineTelegram implements UserAwareEntityInterface
{

    use UserTrait;

    #[Id]
    #[Column]
    #[GeneratedValue]
    private ?int $id = null;

    #[Column(type: "string", length: 50, unique: true)]
    private string $chatId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getChatId(): string
    {
        return $this->chatId;
    }

    public function setChatId(string $chatId): void
    {
        $this->chatId = $chatId;
    }
}