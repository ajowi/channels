<?php

namespace NotificationChannels\BongatechSMSNotification;

use NotificationChannels\BongatechSMSNotificationChannel\Exceptions\CouldNotSendNotification;
use Illuminate\Notifications\Notification;
use BongaTech\Api\BongaTech;
use BongaTech\Api\Models\Sms;
use NotificationChannels\BongatechSMSNotification\Exceptions\CouldNotSendNotification as ExceptionsCouldNotSendNotification;

class BongatechSMSNotificationChannel
{
    protected $sender_id, $client;
    public function __construct()
    {
        $this->client = new BongaTech(config('services.bongatech.token'), config('services.bongatech.api_version'));
        $this->sender_id = config('services.bongatech.sender_id');
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \NotificationChannels\:channel_namespace\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toBongatechSMSNotification($notifiable);
        if (!$recipient = $notifiable->routeNotificationFor('BongatechSMSNotification')) {
            return $recipient = $message->getSmsTo();
        }

        $sms = new Sms(
            $this->sender_id,
            $recipient,
            $message->getBody(),
            rand(3,4)
        );

        $response = $this->client->sendSMS($sms);
        if($response['status'] == false)
            throw ExceptionsCouldNotSendNotification::serviceRespondedWithAnError($response['message']);

    }
}
