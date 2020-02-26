<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/core/bootstrap.min.css',
        'css/paper-dashboard/paper-dashboard.css?v=2.0.0',
        // 'css/demo.css'
    ];
    public $js = [
        'js/core/bootstrap.min.js',
        'js/paper-dashboard/paper-dashboard.min.js?v=2.0.0',
        '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js'
        // 'js/demo.js'
    ];
    public $depends = [
        'yii\web\YiiAsset'
    ];
    
    public function init()
    {
        parent::init();
        // resetting BootstrapAsset to not load own css files
        \Yii::$app->assetManager->bundles['yii\\bootstrap\\BootstrapAsset'] = [
            'css' => [],
            'js' => []
        ];
    }
}
