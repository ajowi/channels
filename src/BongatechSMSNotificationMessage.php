<?php

namespace NotificationChannels\BongatechSMSNotification;

use Illuminate\Support\Arr;

class BongatechSMSNotificationMessage
{
    private $body, $sms_to;
    /**
     * @param string $body
     *
     * @return $this
     */
    public function body(string $body)
    {
        $this->body = trim($body);
        return $this;
    }

    /**
     * @param string $body
     *
     * @return $this
     */
    public function sms_to(string $sms_to)
    {
        $this->sms_to = $sms_to;
        return $this;
    }

    /**
     *
     * @return $this->sms_to
     */
    public function getSmsTo()
    {
        return $this->sms_to;
    }

     /**
     *
     * @return $this->body
     */
    public function getBody()
    {
        return $this->body;
    }
}
