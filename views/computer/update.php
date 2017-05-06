<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Computer */

$this->title = 'Edit Computer: ' . $model->computer_name;
?>
<div class="computer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'applications' => $applications,
        'applicationModel' => $applicationModel,
    ]) ?>

</div>
