<?php

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ComputerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="computer-index">

<?php
    $gridColumns = [
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'attribute'=>'computer_name',
            'value'=>function ($model, $key, $index, $widget) {
                return $model->computer_name;
            },
            'vAlign'=>'middle',
            'format'=>'raw',
            'width'=>'150px',
            'noWrap'=>true
        ],
        [
            'attribute'=>'ip_address',
            'value'=>function ($model, $key, $index, $widget) {
                return $model->ip_address;
            },
            'vAlign'=>'middle',
            'format'=>'raw',
            'width'=>'150px',
            'noWrap'=>true
        ],
        [
            'attribute'=>'login',
            'value'=>function ($model, $key, $index, $widget) {
                return $model->login;
            },
            'vAlign'=>'middle',
            'format'=>'raw',
            'width'=>'150px',
            'noWrap'=>true
        ],
        [
            'attribute'=>'password',
            'value'=>function ($model, $key, $index, $widget) {
                return $model->password;
            },
            'vAlign'=>'middle',
            'format'=>'raw',
            'width'=>'150px',
            'noWrap'=>true
        ],
        [
            'attribute'=>'application_id',
            'value'=>function ($model, $key, $index, $widget) {
                return implode(', ', \yii\helpers\ArrayHelper::getColumn($model->applications, 'app_name'));
            },
            'vAlign'=>'middle',
            'format'=>'raw',
            'width'=>'150px',
            'noWrap'=>true,
            'label' => 'Applications'
        ],
        [
            'class'=>'kartik\grid\ActionColumn',
            'template' => (Yii::$app->user->can('update') && Yii::$app->user->can('delete')) ?
                '{view} {update} {delete}' : '{view}',
            'buttons' => [
                'delete' => function ($url, $model) {
                    return \yii\helpers\Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('yii', 'Delete'),
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete ' . strtolower($model->formName()) . ' ' . $model->computer_name . '?'),
                        'data-method' => 'post',
                    ]);
                },
            ]
        ],
    ];
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
        'toolbar' =>  [
            ['content'=>
                (Yii::$app->user->can('create')) ?
                \yii\helpers\Html::a('<i class="glyphicon glyphicon-plus"></i> Add', ['create'], ['class' => 'btn btn-success'])
                : false
            ],
            '{export}',
            '{toggleData}'
        ],
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
        'floatHeader' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],
    ]);
?>
</div>
