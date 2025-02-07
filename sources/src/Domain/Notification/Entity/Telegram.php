<?php

declare(strict_types=1);

namespace App\Domain\Notification\Entity;

class Telegram
{
    private string $chatId;
    private ?int $id = null;
    public function getChatId(): string
    {
        return $this->chatId;
    }

    public function setChatId(string $chatId): static
    {
        $this->chatId = $chatId;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }
}