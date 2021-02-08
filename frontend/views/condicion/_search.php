<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CondicionislaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="condicionisla-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idcond') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'f_registro') ?>

    <?= $form->field($model, 'time_expulsion') ?>

    <?= $form->field($model, 'persona_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
