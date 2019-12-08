<?php

// comment out the following two lines when deployed to production
$_yii_env = (!empty(getenv('YII_ENV'))) ? getenv('YII_ENV') : 'dev';
$_yii_debug = (!empty(getenv('YII_DEBUG'))) ? filter_var(getenv('YII_DEBUG'), FILTER_VALIDATE_BOOLEAN) : true;

defined('YII_DEBUG') or define('YII_DEBUG', $_yii_debug);
defined('YII_ENV') or define('YII_ENV', $_yii_env);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
