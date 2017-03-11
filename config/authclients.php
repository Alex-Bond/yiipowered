<?php
return [
    'github' => [
        'class' => \yii\authclient\clients\GitHub::class,
        'clientId' => getenv('GITHUB_CLIENT_ID'),
        'clientSecret' => getenv('GITHUB_CLIENT_SECRET'),
        'scope' => 'user:email',
    ],
];