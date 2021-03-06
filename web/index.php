<?php

require(__DIR__ . '/../vendor/autoload.php');

$dotenv = new \Dotenv\Dotenv(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
$dotenv->load();

defined('YII_DEBUG') or define('YII_DEBUG', getenv('YII_DEBUG'));
defined('YII_ENV') or define('YII_ENV', getenv('YII_ENV'));

require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../config/web-bootstrap.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
