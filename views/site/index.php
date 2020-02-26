<?php

use app\models\Faculty;
use practically\chartjs\Chart;
use yii\helpers\ArrayHelper;
use app\models\Major;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Dashboard';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <h1>Fakultas Teknik</h1>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <?= Html::beginForm(); ?>
                        <?= Html::dropDownList(
                            'faculty', 
                            '',
                            ArrayHelper::map(
                                Faculty::find()->all(), 
                                'id', 
                                'name'
                            ),
                            [
                                'class' => 'form-control'
                            ]
                            ); ?>
                        <?= Html::endForm(); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <?= Html::beginForm(); ?>
                        <?= Html::dropDownList(
                            'major', 
                            '',
                            ArrayHelper::map(
                                Major::find()->where(['faculty_id' => 1])->all(), 
                                'id', 
                                'name'
                            ),
                            [
                                'class' => 'form-control'
                            ]
                            ); ?>
                        <?= Html::endForm(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">        
                        <?= Chart::widget([
                            'type' => Chart::TYPE_BAR,
                            'datasets' => [
                                [
                                    'label' => 'Mahasiswa',
                                    'data' => [
                                        '2016' => 28,
                                        '2017' => 30,
                                        '2018' => 93,
                                        '2019' => 20,
                                        '2020' => 0
                                    ]
                                ]
                            ]
                        ]); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">   
                        <?= Chart::widget([
                                'type' => Chart::TYPE_BAR,
                                'datasets' => [
                                    [
                                        'label' => 'Dosen',
                                        'data' => [
                                            '2016' => 28,
                                            '2017' => 30,
                                            '2018' => 93,
                                            '2019' => 20,
                                            '2020' => 0
                                        ]
                                    ]
                                ]
                            ]); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
