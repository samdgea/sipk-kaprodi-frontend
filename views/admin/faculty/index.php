<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Search\FacultySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Faculties';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faculty-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Faculty', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name',
            'description:ntext',
            'created_at',
            'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '<div class="col-md-12 text-center"><div class="btn-group">{view} {update} {delete}</div></div>',
                'buttons' => [
                    'view' => function($url, $model) {
                        $icon = Html::tag('span', '', ['class' => 'nc-icon nc-zoom-split']);
                        return Html::a($icon, $url, ['title' => 'View', 'aria-label' => 'View', 'data-pjax' => '0', 'class' => 'btn btn-default btn-sm']);
                    },
                    'update' => function($url, $model) {
                        $icon = Html::tag('span', '', ['class' => 'nc-icon nc-ruler-pencil']);
                        return Html::a($icon, $url, ['title' => 'Update', 'aria-label' => 'Update', 'data-pjax' => '0', 'class' => 'btn btn-success btn-sm']);
                    }, 
                    'delete' => function($url, $model) {
                        $icon = Html::tag('span', '', ['class' => 'nc-icon nc-simple-remove']);
                        return Html::a($icon, $url, [
                            'title' => 'Delete', 
                            'aria-label' => 'Delete', 
                            'data-pjax' => '0', 
                            'class' => 'btn btn-danger btn-sm',
                            'data-confirm' => 'Are you sure you want to delete this item?',
                            'data-method' => 'post'
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>


</div>
