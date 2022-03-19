<?php

namespace NotificationChannels\BongatechSMSNotification\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function serviceRespondedWithAnError($response)
    {
        return new static("Bongatech service responded with an error: {$response}'");
    }
}
