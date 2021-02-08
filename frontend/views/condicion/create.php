<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Condicionisla */

$this->title = 'Create Condicionisla';
$this->params['breadcrumbs'][] = ['label' => 'Condicionislas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="condicionisla-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
