#  BongaTech SMS notifications channel for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-notification-channels/bongatech-sms-notification.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/bongatech-sms-notification)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/laravel-notification-channels/bongatech-sms-notification/master.svg?style=flat-square)](https://travis-ci.org/laravel-notification-channels/bongatech-sms-notification)
[![Quality Score](https://img.shields.io/scrutinizer/g/laravel-notification-channels/bongatech-sms-notification.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/bongatech-sms-notification)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/laravel-notification-channels/bongatech-sms-notification/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/bongatech-sms-notification/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-notification-channels/bongatech-sms-notification.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/bongatech-sms-notification)

This package makes it easy to send [BongaTech SMS](link to service) notifications with Laravel.


## Contents

- [Requirements](#requirements)
- [Installation](#installation)
	- [Setting up the BongaTech SMS Notification service](#setting-up-the-BongaTech SMS Notification-service)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

## Requirements

- [Sign up](https://bulk.bongatech.co.ke) for a Bongatech SMS account
- Generate your API token in integration settings

## Installation

You can install the package via composer:

``` bash
composer require laravel-notification-channels/bongatech-sms-notification
```

This package will register itself automatically with Laravel 5.5 and up trough Package auto-discovery.

### Manual installation

You can install the service provider for Laravel 5.4 and below:

```php
// config/app.php
'providers' => [
    ...
    NotificationChannels\BongatechSMSNotification\BongatechSMSNotificationServiceProvider::class,
],
```

### Setting up the BongaTech SMS Notification service

Add your Bongatech API Token, API version and sender ID to your `config/services.php`:

```php
// config/services.php
...
'bongatech' => [
    'token' => env('BONGATECH_TOKEN'),
    'api_version' => env('BONGATECH_API_VERSION'),
    'sender_id' => env('BONGATECH_SENDER_ID'),
],
...
```

## Usage

Now you can use the channel in your `via()` method inside the notification:

``` php
use NotificationChannels\BongatechSMSNotification\BongatechSMSNotificationChannel;
use NotificationChannels\BongatechSMSNotification\BongatechSMSNotificationMessage;
use Illuminate\Notifications\Notification;

class WelcomeAboard extends Notification
{
    public function via($notifiable)
    {
        return [BongatechSMSNotificationChannel::class];
    }

    public function toBongatechSMSNotification($notifiable)
    {
        return (new BongatechSMSNotificationMessage)
                    ->sms_to('0712345678')
                    ->body('SMS message body.');
    }
}
```


You can let your Notification know which recipient phone number to use by adding the `routeNotificationForBongatechSMSNotification` method to your Notifiable model.


```php
public function routeNotificationForongatechSMSNotification()
{
    return '254712345678';
}
```

### Available Message methods

- `body('')`: Accepts a string value for the message body.
- `sms_to('')`: Accepts a string value of the recipient's phone number.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [David Ajowi](https://github.com/ajowi)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
