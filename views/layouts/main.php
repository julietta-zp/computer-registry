<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => array_filter([
            Yii::$app->user->isGuest ?
                ['label' => 'Sign Up', 'url' => ['/auth/signup']] :
                false,
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/auth/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/auth/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ]),
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?php
        if (!Yii::$app->user->isGuest){

                echo \yii\bootstrap\Nav::widget([
                    'options' => ['class' => 'nav nav-pills nav-stacked col-md-3'],
                    'encodeLabels' => false,
                    'items' => array_filter([
                        [
                            'label' => '<span class="glyphicon glyphicon-user"></span> Users',
                            'url' => ['/user/index'],
                            'visible' => Yii::$app->user->can('manageUsers'),
                        ],
                        [
                            'label' => '<span class="glyphicon glyphicon-hdd"></span> Computers',
                            'url' => ['/computer/index'],
                            'active'=>\Yii::$app->controller->id == 'computer',
                        ],
                        [
                            'label' => '<span class="glyphicon glyphicon-cd"></span> Applications',
                            'url' => ['/application/index'],
                            'active'=>\Yii::$app->controller->id == 'application',

                        ]
                    ])
                ]);

        }
        ?>
        <div class="col-md-9">
            <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
