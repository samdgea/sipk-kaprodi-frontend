<?php 
/**
 *  =========================================================
 *  Paper Dashboard 2 - v2.0.0
 *  =========================================================
 *
 *  Product Page: https://www.creative-tim.com/product/paper-dashboard-2
 *  Copyright 2019 Creative Tim (https://www.creative-tim.com)
 *  Licensed under MIT (https://github.com/creativetimofficial/paper-dashboard/blob/master/LICENSE)
 *
 *  Coded by Creative Tim
 *
 *  =========================================================
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
 */
use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use app\assets\AppAsset;
use yii\helpers\ArrayHelper;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset=""<?= Yii::$app->charset ?>" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <link rel="apple-touch-icon" sizes="76x76" href="<?= Url::base() ?>/img/apple-icon.png">
        <link rel="icon" type="image/png" href="<?= Url::base() ?>/img/favicon.png">
        <?php $this->registerCsrfMetaTags() ?>
        
        <title><?= Html::encode($this->title . " - " . Yii::$app->params['application_name']) ?></title>

        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet"> 
    
        <?php $this->head() ?>   
    </head>
    <body>
        <?php $this->beginBody() ?>
        <!-- Start div.wrapper -->
        <div class="wrapper ">
            <!-- Start div.sidebar -->
            <div class="sidebar" data-color="white" data-active-color="danger">
                <!-- Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow" -->
                <div class="logo">
                    <a href="http://www.creative-tim.com" class="simple-text logo-mini">
                        <div class="logo-image-small">
                            <img src="<?= Url::base() ?>/img/logo-small.png">
                        </div>
                    </a>
                    <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                        <?= Yii::$app->params['application_name'] ?>
                        <!-- <div class="logo-image-big">
                            <img src="<?= Url::base() ?>/assets/img/logo-big.png">
                        </div> -->
                    </a>
                </div>
                <!-- End div.logo -->
                <div class="sidebar-wrapper">
                    <?php 
                        $items = [
                            [
                                'label' => '<i class="nc-icon nc-bank"></i> <p>Home</p>', 
                                'url' => ['/site/index']
                            ],
                            // [
                            //     'label' => '<i class="nc-icon nc-single-02"></i> <p>About</p>', 
                            //     'url' => ['/site/about']
                            // ],
                            // [
                            //     'label' => '<i class="nc-icon nc-single-02"></i> <p>Contact</p>', 
                            //     'url' => ['/site/contact']
                            // ],
                        ];

                        $items_admin = [
                            [
                                'label' => '<i class="nc-icon nc-badge"></i> <p>User Management</p>',
                                'url' => ['/admin/user/index']
                            ], [
                                'label' => '<i class="nc-icon nc-settings-gear-65"></i> <p>Role Management</p>',
                                'url' => ['/admin/role/index']
                            ], [
                                'label' => '<i class="nc-icon nc-hat-3"></i> <p>Major Management</p>',
                                'url' => ['/admin/major/index']
                            ]
                        ];

                        if (Yii::$app->user->can('super-admin'))
                            $items = ArrayHelper::merge($items, $items_admin);
                    ?>
                    <?php
                        echo Nav::widget([
                            'options' => ['class' => 'nav'],
                            'items' => $items,
                            'encodeLabels' => false,
                        ]); 
                    ?>
                </div>
                <!-- End div.sidebar-wrapper -->
            </div>  
            <!-- End div.sidebar -->
            <!-- Start div.main-panel -->
            <div class="main-panel">

                <!-- Start nav.navbar -->
                <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
                    <div class="container-fluid">
                        <div class="navbar-wrapper">
                            <div class="navbar-toggle">
                                <button type="button" class="navbar-toggler">
                                    <span class="navbar-toggler-bar bar1"></span>
                                    <span class="navbar-toggler-bar bar2"></span>
                                    <span class="navbar-toggler-bar bar3"></span>
                                </button>
                            </div>
                            <a class="navbar-brand" href="#pablo"><?= Html::encode($this->title) ?></a>
                        </div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-bar navbar-kebab"></span>
                            <span class="navbar-toggler-bar navbar-kebab"></span>
                            <span class="navbar-toggler-bar navbar-kebab"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navigation">
                            <ul class="navbar-nav">
                                <li class="nav-item btn-rotate dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="accountDropMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="nc-icon nc-circle-10"></i>
                                        <p style="padding-right: 5px;">
                                            <span>Hola, <?= Yii::$app->user->identity->first_name ?>!</span>
                                        </p>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropMenu">
                                        <a class="dropdown-item" href="<?= Url::toRoute('@profile/index'); ?>">My Profile</a>
                                        <?= 
                                        Html::beginForm(['/site/logout'], 'post') .
                                        Html::submitButton(
                                            'Logout',
                                            ['class' => 'btn-link dropdown-item']
                                        ) .
                                        Html::endForm();
                                        // <a class="dropdown-item" href="#">Logout</a>
                                        ?>
                                        
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->


                <!-- Start div.content -->
                <div class="content">
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div>
                <!-- End div.content -->

                <!-- Start Footer -->
                <footer class="footer footer-black  footer-white ">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- <nav class="footer-nav">
                                <ul>
                                    <li>
                                        <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>
                                    </li>
                                    <li>
                                        <a href="http://blog.creative-tim.com/" target="_blank">Blog</a>
                                    </li>
                                    <li>
                                        <a href="https://www.creative-tim.com/license" target="_blank">Licenses</a>
                                    </li>
                                </ul>
                            </nav> -->
                            <div class="credits ml-auto">
                                <span class="copyright">
                                    <?= Yii::$app->params['application_name'] ?> v.<?= Yii::$app->params['application_version'] ?>
                                    &copy; 2020, made with <i class="fa fa-heart heart"></i> by <a href="<?= Yii::$app->params['application_dev_website'] ?>" target="_blank"><?= Yii::$app->params['application_dev_name'] ?></a>
                                </span>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->
            </div>
            <!-- End div.main-panel -->
        </div>
<?php 
$js=<<< JS
    jQuery(".alert").animate({opacity: 1.0}, 1000).delay(5000).fadeOut("slow");
JS;

$this->registerJs($js, yii\web\View::POS_READY);
?>
        <!-- End div.wrapper -->
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>