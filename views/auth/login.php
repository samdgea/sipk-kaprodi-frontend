<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login'; ?>

<div class="container">
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fa fa-sign-in"></i>&nbsp;Sign in to Application</h5>
                </div>
                <div class="card-body">
                    <p>Please fill out the following fields to login:</p>

                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        // 'layout' => 'horizontal',
                        'fieldConfig' => [
                            'template' => "<div class=\"row\"><div class=\"col-md-12\">{label}{input}\n<span class=\"text-danger\">{error}</span></div></div>",
                            'labelOptions' => ['class' => 'col-lg-1 control-label'],
                        ],
                    ]); ?>

                    <?= $form->field($model, 'username', [
                        'labelOptions' => ['class' => 'control-label']
                    ])->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password', [
                        'labelOptions' => ['class' => 'control-label']
                    ])->passwordInput() ?>

                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    <div class="form-group">
                        <div class="col-lg-offset-1 col-lg-11">
                            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
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