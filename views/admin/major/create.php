<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Major */

$this->title = 'Create Major';
$this->params['breadcrumbs'][] = ['label' => 'Majors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$faculty = "";
if (!empty($facultyModel) && $facultyModel->id) {
    $faculty = "- " . $facultyModel->name;
}
?>
<div class="major-create">

    <h1><?= Html::encode($this->title . " " . $faculty) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'facultyModel' => $facultyModel
    ]) ?>

</div>
