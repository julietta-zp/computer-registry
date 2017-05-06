<?php

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="user-index">
<?php
    $gridColumns = [
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'attribute'=>'username',
            'value'=>function ($model, $key, $index, $widget) {
                return $model->username;
            },
            'vAlign'=>'middle',
            'format'=>'raw',
            'width'=>'150px',
            'noWrap'=>true
        ],
        [
            'attribute'=>'last_name',
            'value'=>function ($model, $key, $index, $widget) {
                return $model->last_name;
            },
            'vAlign'=>'middle',
            'format'=>'raw',
            'width'=>'150px',
            'noWrap'=>true
        ],
        [
            'attribute'=>'first_name',
            'value'=>function ($model, $key, $index, $widget) {
                return $model->first_name;
            },
            'vAlign'=>'middle',
            'format'=>'raw',
            'width'=>'150px',
            'noWrap'=>true
        ],
        [
            'attribute'=>'role',
            'value'=>function ($model, $key, $index, $widget) {
                return $model->role;
            },
            'vAlign'=>'middle',
            'format'=>'raw',
            'width'=>'150px',
            'noWrap'=>true
        ],
        [
            'class'=>'kartik\grid\ActionColumn',
            'template' => '{view} {update} {user/change-password} {delete}',
            'buttons' => [
                'user/change-password' => function ($url) {
                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-lock"> </span>', $url, [ 'title' => 'Change Password', 'data-pjax' => '0', ] );
                },
                'delete' => function ($url, $model) {
                    return \yii\helpers\Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('yii', 'Delete'),
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete ' . strtolower($model->formName()) . ' ' . $model->first_name . ' ' . $model->last_name . '?'),
                        'data-method' => 'post',
                    ]);
                },
            ]
        ]
    ];
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
        'toolbar' =>  [
            ['content'=>
                \yii\helpers\Html::a('<i class="glyphicon glyphicon-plus"></i> Add', ['create'], ['class' => 'btn btn-success'])
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
