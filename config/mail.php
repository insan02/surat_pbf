<?php

return [

/*
|--------------------------------------------------------------------------
| Default Mailer
|--------------------------------------------------------------------------
|
| Laravel supports several mail "transport" drivers to be used while
| sending an e-mail. You may specify which one you're using throughout
| your application here. By default, Laravel is setup for SMTP mail.
|
| Supported: "smtp", "sendmail", "mailgun", "ses",
|            "postmark", "log", "array"
|
*/

'default' => env('MAIL_MAILER', 'smtp'),

/*
|--------------------------------------------------------------------------
| Mailers
|--------------------------------------------------------------------------
|
| Here you may configure all of the mailers used by your application plus
| their respective settings. Several examples have been configured for
| you and you are free to add your own as your application requires.
|
| Supported: "smtp", "sendmail", "mailgun", "ses",
|            "postmark", "log", "array"
|
*/

'mailers' => [
    'smtp' => [
        'transport' => 'smtp',
        'host' => env('MAIL_HOST', 'smtp.gmail.com'),
        'port' => env('MAIL_PORT', 587),
        'encryption' => env('MAIL_ENCRYPTION', 'tls'),
        'username' => env('MAIL_USERNAME'),
        'password' => env('MAIL_PASSWORD'),
        'timeout' => null,
        'auth_mode' => null,
    ],

    'ses' => [
        'transport' => 'ses',
    ],

    'mailgun' => [
        'transport' => 'mailgun',
    ],

    'postmark' => [
        'transport' => 'postmark',
    ],

    'sendmail' => [
        'transport' => 'sendmail',
        'path' => '/usr/sbin/sendmail -bs',
    ],

    'log' => [
        'transport' => 'log',
        'channel' => env('MAIL_LOG_CHANNEL'),
    ],

    'array' => [
        'transport' => 'array',
    ],
],

/*
|--------------------------------------------------------------------------
| Global "From" Address
|--------------------------------------------------------------------------
|
| You may wish for all e-mails sent by your application to be sent from
| the same address. Here, you may specify a name and address that is
| used globally for all e-mails that are sent by your application.
|
*/

'from' => [
    'address' => env('MAIL_FROM_ADDRESS', 'aanalamin987@gmail.com'),
    'name' => env('MAIL_FROM_NAME', 'Laravel'),
],

/*
|--------------------------------------------------------------------------
| Markdown Mail Settings
|--------------------------------------------------------------------------
|
| If you are using Markdown based email rendering, you may configure your
| theme and component paths here, allowing you to customize the design
| of the emails. Or, you may simply stick with the Laravel defaults!
|
*/

'markdown' => [
    'theme' => 'default',

    'paths' => [
        resource_path('views/vendor/mail'),
    ],
],

];
