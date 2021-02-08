<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\widgets\Alert;
?>

<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<div class="panel panel-default">
			<div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Bienvenidos al sistema</div>
			<div class="panel-body">
				<?=Alert::widget();?>
				<?php $form=ActiveForm::begin([
					'id'=>'form',
					'enableClientValidation'=>true,
					'enableAjaxValidation'=>false
				]);?>
				<?=$form->field($model,'usuario')->textInput(['placeholder'=>'Ingrese el usuario']);?>
				<?=$form->field($model,'clave')->passwordInput(['placeholder'=>'Ingrese la clave']);?>
				<div class="form-group">
					<?=Html::submitInput('Ingresar',['class'=>'btn btn-primary btn-lg btn-block']);?>
				</div>
				<?php $form->end();?>
			</div>
		</div>
	</div>
</div>
