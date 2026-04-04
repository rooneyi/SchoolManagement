<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TelegramLogger
{
    protected string $botToken;

    protected string $chatId;

    public function __construct()
    {
        $this->botToken = config('services.telegram_bot_token');
        $this->chatId = config('services.telegram_chat_id');
    }

    public function log(string $message): void
    {
        $url = "https://api.telegram.org/bot{$this->botToken}/sendMessage";
        Http::post($url, [
            'chat_id' => $this->chatId,
            'text' => $message,
        ]);
    }
}
