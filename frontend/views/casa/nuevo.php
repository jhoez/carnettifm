<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title='Registro de nueva casa';
?>
<h3 class="page-header"><?=Html::encode($this->title);?></h3>
<div class="well">
	<?php $form=ActiveForm::begin([
		'id'=>'form',
		'enableClientValidation'=>true,
		'enableAjaxValidation'=>false
	]);?>
	<?=$form->field($model,'calle_id')->dropDownList($calles,['prompt'=>'Seleccione']);?>
	<?=$form->field($model,'nombre')->textInput();?>
	<div class="form-group">
		<?=Html::submitInput('Registrar',['class'=>'btn btn-lg btn-primary']);?>
	</div>
	<?php $form->end();?>
</div>
