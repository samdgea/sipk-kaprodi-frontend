<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Faculty;

/* @var $this yii\web\View */
/* @var $model app\models\Major */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="major-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'faculty_id')->textInput() ?>

    <?php 
        if (!empty($facultyModel) && $facultyModel->id) {
            echo $form->field($model, 'faculty_id')->hiddenInput([
                'value' => $facultyModel->id
            ])->label(false);
        } else {
            echo $form->field($model, 'faculty_id')->widget(Select2::class, [
                'model' => $model,
                'attribute' => 'id', 
                'data' => ArrayHelper::map(Faculty::find()->all(), 'id', 'name'),
                'options' => ['placeholder' => ' --- ']
            ])->label('Faculty');
        }
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php // $form->field($model, 'created_at')->textInput() ?>

    <?php // $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
