<?php
    declare(strict_types=1);

    namespace Stolfam\Telegram;

    /**
     * Class TelegramBot
     * @package Stolfam\Telegram
     */
    class TelegramBot
    {
        private string $botToken;

        /**
         * TelegramBot constructor.
         * @param string $botToken
         */
        public function __construct(string $botToken)
        {
            $this->botToken = $botToken;
        }

        /**
         * Sends plain text.
         *
         * @param string      $message
         * @param string      $chatId
         * @param string|null $parseMode
         */
        public function sendMessage(string $message, string $chatId, ?string $parseMode = ParseMode::MARKDOWN): void
        {
            $bot_url = "https://api.telegram.org/bot$this->botToken/";

            // parse mode
            if (!empty($parseMode)) {
                $parseMode = "parse_mode=" . $parseMode . "&";
            }

            $url = $bot_url . "sendMessage?chat_id=" . $chatId . "&" . $parseMode . "text=" . urlencode($message);
            file_get_contents($url);
        }

        /**
         * Returns updates.
         *
         * You can use it for obtaining Chat ID of the channel/group.
         *
         * @return array
         */
        public function getUpdates(): array
        {
            $data = file_get_contents("https://api.telegram.org/bot$this->botToken/getUpdates");
            if (!empty($data)) {
                return json_decode($data, true);
            }

            return [];
        }
    }