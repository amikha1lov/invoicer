<?php

declare(strict_types=1);

namespace App\Domain\Notification\Factory;

use App\Domain\Notification\Entity\Telegram;

interface TelegramUserFactoryInterface
{
    public function create(string $userId, string $chatId): Telegram;
}