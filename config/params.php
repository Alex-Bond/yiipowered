<?php

return [
    'adminEmail' => getenv('ADMIN_EMAIL'),
    'notificationEmail' => getenv('NOTIFICATION_EMAIL'),
    'supportEmail' => getenv('SUPPORT_EMAIL'),
    'user.passwordResetTokenExpire' => 3600,
    'user.rememberMeDuration' => 3600 * 24 * 30,

    'languages' => [
        'en' => ['en-US', 'English'],
        'ru' => ['ru-RU', 'Русский'],
    ],

    'project.pagesize' => 9,

    'image.size.full' => [1608, 1056],
    'image.size.thumbnail' => [402, 264],
];
