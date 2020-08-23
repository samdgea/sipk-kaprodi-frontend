<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Faculty */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Faculties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="faculty-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'name',
            'description:ntext',
            // 'created_at',
            // 'updated_at',
        ],
    ]) ?>

    <br><br>

    <p>
        <?= Html::a('Create Major', ['admin/major/create', 'faculty_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $majorDataProvider,
        // 'filterModel' => $majorSearchModel,
        'layout' => "{items}\n{pager}\n{summary}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'faculty_id',
            // [
            //     'attribute' => 'faculty_id',
            //     'label' => 'Faculty',
            //     'format' => 'html',
            //     'value' => function($model) {
            //         return "<a href='/admin/faculty/view?id={$model->faculty_id}'>{$model->faculty->name}</a>";
            //     }
            // ],
            'name',
            'description:ntext',
            'created_at',
            'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '<div class="col-md-12 text-center"><div class="btn-group">{view} {update} {delete}</div></div>',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to(["admin/major/" . $action . "?id=" . $key]);
                },
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
