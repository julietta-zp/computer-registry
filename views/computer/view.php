<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Computer */

$this->title = $model->computer_name;
?>
<div class="computer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->can('update') && Yii::$app->user->can('delete')): ?>
        <p>
            <?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete ' . strtolower($model->formName()) . ' ' . $this->title . '?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php endif; ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'computer_name',
            'ip_address',
            'login',
            'password:ntext',
            [
                'attribute' => 'applications',
                'value'=> implode(', ', \yii\helpers\ArrayHelper::getColumn($model->applications, 'app_name')),
            ],
        ],
    ]) ?>
</div>
