<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?php if ($this->context->action->id == 'create'): ?>
        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    <?php endif; ?>

    <?= $form->field($model, 'role')->dropDownList([ User::ROLE_USER => 'user', User::ROLE_ADMIN => 'admin']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Edit', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>