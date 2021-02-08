<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        [
            'label'=>'Registros',
            'items'=>[
                [
                    'label'=>'Personas',
                    'url'=>['persona/index'],
                    //'visible'=>''
                ],
                [
                    'label'=>'Personal penalizado',
                    'url'=>['condicion/index'],
                    //'visible'=>''
                ],
                [
                    'label'=>'Calles',
                    'url'=>['calle/index'],
                    //'visible'=>''
                ],
                [
                    'label'=>'Casas',
                    'url'=>['casa/index'],
                    //'visible'=>''
                ]
            ]
        ],
        [
            'label'=>yii::$app->user->identity->username,
            'items'=>[
                [
                    'label'=>'Adm. Usuarios',
                    'url'=>['usuario/index'],
                    //'visible'=>''
                ],
                [
                    'label'=>'Adm. permisos',
                    'url'=>['/admin'],
                    //'visible'=>''
                ],
                ['label'=>'Actualizar clave','url'=>['usuario/actualizarclave','id'=>yii::$app->user->identity->iduser]],
                ['label'=>'Desconectar','url'=>['login/logout']]
            ],
        ]
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode('Desarrollado por la Direccion de tecnologias de informacion del Territorio Insular Francisco de Miranda') ?> <?= date('Y') ?></p>

        <p class="pull-right">TIFM</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
