<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Condicionisla */

$this->title = 'Update Condicionisla: ' . $model->idcond;
$this->params['breadcrumbs'][] = ['label' => 'Condicionislas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcond, 'url' => ['view', 'id' => $model->idcond]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="condicionisla-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
