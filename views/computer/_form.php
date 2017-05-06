<?php

use yii\helpers\Html;
use \kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Computer */
/* @var $form yii\widgets\ActiveForm */
/* @var $applicationModel app\models\Application*/
?>

<div class="computer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'computer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($applicationModel, 'id')->multiSelect($applications)->label('Applications') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Edit', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
