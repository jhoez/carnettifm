<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

$this->title = 'Datos de examen COVID-19';

?>

<div class="btn-group">
    <?=Html::a('Registros',['persona/index'],['class'=>'btn btn-primary btn-lg']);?>
</div>

<h1 class="text-center"><?=Html::encode($this->title) ?></h1>


<div class="row clearfix">
    <div class="col-md-offset-3 col-md-6">
        <?php $form=ActiveForm::begin([
            'id'=>'prueba',
            'enableClientValidation'=>true,
        ]); ?>
        <?=$form->field($pruebacovid,'persona_id')->hiddenInput(['value'=>$param])->label(false);?>

    	<div class="row">
    		<div class="col-md-6">
    			<?= $form->field($pruebacovid, 'prueba_1')->radioList(
    				['0' => 'No', '1' => 'Si']
    			)->label('¿Le hicieron la prueba del COVID-19?');?>
    		</div>
    		<div class="col-md-6">
    			<?= $form->field($pruebacovid, 'resultado1')->radioList(
    				['0' => 'Negativo', '1' => 'Positivo']
    			)->label('¿Resultado de prueba del COVID-19?');?>
    		</div>
    		<div class="col-md-6">
    			<?=$form->field($pruebacovid, 'f_prueba1')->widget(DatePicker::classname(), [
    			    'options' => ['placeholder' => 'Fecha de 1ra prueba'],
    				'type' => DatePicker::TYPE_INPUT,
    			    'pluginOptions' => [
    			        'autoclose'=>true,
    					'format' => 'yyyy-mm-dd'
    			    ]
    			])->label('¿Fecha de prueba del COVID-19?'); ?>
    		</div>
    	</div>

        <div class="form-group">
            <?=Html::submitButton('Registrar',['class'=>'btn btn-primary btn-lg']);?>
        </div>
        <?php $form->end();?>
    </div>
</div>
