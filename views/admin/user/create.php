<?php 
use yii\helpers\Html;

$this->title = "Create new User"
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="pull-right">
                    <?= Html::a('Back', ['index'], ['class' => 'btn btn-default']) ?>
                </div>
            </div>
            <div class="card-body">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
</div>