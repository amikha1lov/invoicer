<?php

declare(strict_types=1);

namespace App\Domain\Notification\Repository;

use App\Domain\Notification\Entity\Telegram;

interface TelegramUserRepositoryInterface
{
    public function save(Telegram $telegramUser):void;
    public function findByUserId(string $userId): ?Telegram;
    public function setChat(Telegram $telegramUser, string $chatId): ?Telegram;
}