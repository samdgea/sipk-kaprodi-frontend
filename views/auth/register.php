<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Register'; ?>

<div class="container">
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fa fa-history"></i>&nbsp;Sign up</h5>
                </div>
                <div class="card-body">
                    <p>Hi, nice to meet you :)</p>

                    <?php $form = ActiveForm::begin([
                        'id' => 'register-form',
                        // 'layout' => 'horizontal',
                        'fieldConfig' => [
                            'template' => "<div class=\"row\"><div class=\"col-md-12\">{label}{input}\n<span class=\"text-danger\">{error}</span></div></div>",
                        ],
                    ]); ?>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'first_name', [
                                'template' => "{label}{input}\n<span class=\"text-danger\">{error}</span>",
                            ])->textInput(['autofocus' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'last_name', [
                                'template' => "{label}{input}\n<span class=\"text-danger\">{error}</span>",
                            ])->textInput() ?>
                        </div>
                    </div>

                    <?= $form->field($model, 'email', [
                        'labelOptions' => ['class' => 'control-label']
                    ])->textInput(['type'=>'email']) ?>

                    <?= $form->field($model, 'user_name', [
                        'labelOptions' => ['class' => 'control-label']
                    ])->textInput() ?>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'password', [
                                'template' => "{label}{input}\n<span class=\"text-danger\">{error}</span>",
                                'labelOptions' => ['class' => 'control-label']
                            ])->passwordInput() ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'password_repeat', [
                                'template' => "{label}{input}\n<span class=\"text-danger\">{error}</span>",
                                'labelOptions' => ['class' => 'control-label']
                            ])->passwordInput() ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-1 col-lg-11">
                            <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>

                    <!-- <div class="col-lg-offset-1" style="color:#999;">
                        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
                        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>