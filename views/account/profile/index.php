<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = "My Profile";
?>
<div class="row">
    <div class="col-md-4">
        <div class="card card-user">
            <div class="image">
                <img src="/img/damir-bosnjak.jpg" alt="...">
            </div>
            <div class="card-body">
                <div class="author">
                    <p>
                        <img class="avatar border-gray" src="/img/mike.jpg" alt="...">
                        <h5 class="title"><?= $model->first_name . " " . $model->last_name ?></h5>
                    </p>
                    <p class="description">
                        @<?= $model->user_name ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
		<div class="container">
			<div class="col-md-12">
				<div class="card card-user">
					<div class="card-header">
						<h5 class="card-title">Edit Profile</h5>
					</div>
					<div class="card-body">
						<?php $form = ActiveForm::begin([
							'fieldConfig' => [
								'template' => "<div class=\"row\"><div class=\"col-md-12\">{label}{input}\n<span class=\"text-danger\">{error}</span></div></div>",
							]
						]); ?>

						<div class="row">
							<div class="col-md-6">
								<?= $form->field($model, 'first_name', [
									'template' => "{label}{input}\n<span class=\"text-danger\">{error}</span>",
									'labelOptions' => ['class' => 'control-label']
								])->textInput(['autofocus' => true]); ?>
							</div>
							<div class="col-md-6">
								<?= $form->field($model, 'last_name', [
									'template' => "{label}{input}\n<span class=\"text-danger\">{error}</span>",
									'labelOptions' => ['class' => 'control-label']
								]); ?>
							</div>
						</div>  

						<?= $form->field($model, 'user_name')->textInput(); ?>

						<?= $form->field($model, 'email_address')->textInput(['type' => 'email', 'readonly' => true]); ?>

						<div class="form-group">
							<div class=" col-lg-12">
								<?= Html::submitButton('Update', ['class' => 'btn btn-primary pull-right', 'name' => 'update-profile']) ?>
							</div>
						</div>
					
						<?php ActiveForm::end(); ?>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="card" data-background-color="red">
					<div class="card-header">
						<h5 class="card-title" style="color: #ffffff;">Change Password</h5>
					</div>
					<div class="card-body">
						<?php $form2 = ActiveForm::begin([
							'fieldConfig' => [
								'template' => "<div class=\"row\"><div class=\"col-md-12\">{label}{input}\n<span class=\"text-gray\">{error}</span></div></div>",
							]
						]); ?>

						<?= $form2->field($model_change, 'old_password', [
							'labelOptions' => ['style' => 'color: #ffffff;']
						])->passwordInput(); ?>

						<div class="row">
							<div class="col-md-6">
								<?= $form2->field($model_change, 'new_password', [
									'template' => "{label}{input}\n<span class=\"text-gray\">{error}</span>",
									'labelOptions' => ['style' => 'color: #ffffff;']
								])->passwordInput(); ?>
							</div>
							<div class="col-md-6">
								<?= $form2->field($model_change, 'new_password_repeat', [
									'template' => "{label}{input}\n<span class=\"text-gray\">{error}</span>",
									'labelOptions' => ['style' => 'color: #ffffff;']
								])->passwordInput(); ?>
							</div>
						</div>  

						<div class="form-group">
							<div class=" col-lg-12">
								<?= Html::submitButton('Change Password', ['class' => 'btn btn-primary pull-right', 'name' => 'update-password']) ?>
							</div>
						</div>

						<?php ActiveForm::end(); ?>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>