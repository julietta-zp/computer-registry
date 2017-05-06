<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Computer */

$this->title = 'Add new Computer';

?>
<div class="computer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'applications' => $applications,
        'applicationModel' => $applicationModel,
    ]) ?>

</div>
