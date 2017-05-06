<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Change Password for User: ' . $model->username;
?>

<div class="change-password-form">

    <h3><?= Html::encode($this->title) ?></h3>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'value' => '', 'placeholder' => 'Enter new password'])->label('Password') ?>

    <div class="form-group">
        <?= Html::submitButton('Change Password', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
