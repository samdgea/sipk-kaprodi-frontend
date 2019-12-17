<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name'); ?>

    <?= $form->field($model, 'last_name'); ?>

    <?= $form->field($model, 'user_name'); ?>

    <?= $form->field($model, 'email_address'); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>