<?php 
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

$this->title = "View Detail User #{$model->id}"
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="pull-right">
                    <?= Html::a('Back', ['index'], ['class' => 'btn btn-default']) ?>
                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </div>
            <div class="card-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'first_name',
                        'last_name',
                        'user_name',
                        'email_address:email',
                        // 'password_hashed',
                        [
                            'label' => 'Account Status',
                            'value' => ($model->account_status == User::ACCOUNT_ACTIVE) ? 'Active' : (($model->account_status == User::ACCOUNT_BLOCKED) ? 'Blocked' : 'Non Active')
                        ],
                        'created_at',
                        'updated_at',
                        // 'email_verification_hash:email',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>