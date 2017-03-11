<?php
return [
    'class' => \baibaratsky\yii\rollbar\Rollbar::class,
    'accessToken' => getenv('ROLLBAR_ACCESS_TOKEN'),
];