<?php

namespace NotificationChannels\BongatechSMSNotification;

use Illuminate\Support\ServiceProvider;
use BongaTech\Api\BongaTech;
use BongaTech\Api\Models\Sms;

class BongatechSMSNotificationProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(BongatechSMSNotificationChannel::class)
            ->needs(BongaTech::class)
            ->give(function () {
                return new BongaTech(config('services.bongatech.token'), config('services.bongatech.api_version'));
            });

    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
