<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Condicionisla */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="condicionisla-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'f_registro')->textInput() ?>

    <?= $form->field($model, 'time_expulsion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'persona_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
