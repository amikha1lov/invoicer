<?php

declare(strict_types=1);

namespace App\Application\Notification\Factory;

use App\Domain\Notification\Entity\Telegram;
use App\Domain\Notification\Factory\TelegramUserFactoryInterface;
use App\Domain\Shared\Ulid\UlidGeneratorInterface;

class TelegramUserFactory implements TelegramUserFactoryInterface
{
    public function __construct(
        private readonly UlidGeneratorInterface  $ulidGenerator,
    )
    {
    }

    public function create(string $userId, string $chatId): Telegram
    {
        return (new Telegram())
            ->setUlid($this->ulidGenerator->generate())
            ->setUser($userId)
            ->setChatId($chatId);
    }
}