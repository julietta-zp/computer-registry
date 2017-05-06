<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Application */

$this->title = 'Add new Application';
?>
<div class="application-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'computers' => $computers,
        'computerModel' => $computerModel,
    ]) ?>

</div>
