<?php

$params = require(__DIR__ . '/params.php');

$languages = [];
foreach ($params['languages'] as $id => $data) {
    $languages[$id] = $data[0];
}

$config = [
    'id' => 'yiipowered',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => 'project/index',
    'bootstrap' => ['log'],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
        ],
        'request' => [
            'cookieValidationKey' => getenv('COOKIE_VALIDATION_KEY'),
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => getenv('MAILER_FILE_TRANSFER'),
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => getenv('SMTP_HOST'),
                'username' => getenv('SMTP_USERNAME'),
                'password' => getenv('SMTP_PASSWORD'),
                'port' => getenv('SMTP_PORT'),
                'encryption' => getenv('SMTP_ENCRYPTION')
            ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [
                        'project' => 'project.php',
                        'user' => 'user.php',
                    ],
                ],
            ],
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => require __DIR__ . '/authclients.php',
        ],
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => $languages,
            'ignoreLanguageUrlPatterns' => [
                '~^site/auth~' => '~^auth~',
            ],
            'enableDefaultLanguageUrlCode' => true,

            'enablePrettyUrl' => true,
            'rules' => require __DIR__ . '/urls.php',
            'showScriptName' => false,

            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
            ],
        ],

        'assetManager' => [
            'appendTimestamp' => true,
        ],
    ],
    'params' => $params,
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
} elseif (!empty(getenv('ROLLBAR_ACCESS_TOKEN'))) {
    $config['bootstrap'][] = 'rollbar';
    $config['components']['errorHandler']['class'] = 'baibaratsky\yii\rollbar\web\ErrorHandler';
}

if (!empty(getenv('ROLLBAR_ACCESS_TOKEN'))) {
    $config['components']['rollbar'] = require __DIR__ . '/rollbar.php';
}

return $config;
