<?php

declare(strict_types=1);

namespace FondBot\Drivers\Telegram;

use FondBot\Channels\ChannelManager;
use Illuminate\Support\ServiceProvider;

class TelegramServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        /** @var ChannelManager $manager */
        $manager = $this->app[ChannelManager::class];

        $manager->extend('telegram', function () {
            return new TelegramDriver;
        });

        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\SetWebhookCommand::class,
            ]);
        }
    }
}
