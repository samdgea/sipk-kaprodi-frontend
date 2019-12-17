<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;

$this->title = 'User Management'
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="pull-right">
                    <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
            <div class="card-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'first_name',
                        'last_name',
                        'user_name',
                        'email_address:email',
                        [
                            'attribute' => 'account_status',
                            'label' => 'Account Status',
                            'filter'=> [
                                User::ACCOUNT_ACTIVE => "Active",
                                User::ACCOUNT_BLOCKED => "Blocked",
                                User::ACCOUNT_INACTIVE => "Non Active"
                            ],
                            'value' => function($model) {
                                return ($model->account_status == User::ACCOUNT_ACTIVE) ? 'Active' : (($model->account_status == User::ACCOUNT_BLOCKED) ? 'Blocked' : 'Non Active');
                            } 
                        ],
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
                    ]
                ]); ?>
            </div>
        </div>
    </div>
</div>