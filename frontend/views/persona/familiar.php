<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

$this->title = 'Registro de familiar';

?>

<div class="btn-group">
    <?=Html::a('Registros',['persona/index'],['class'=>'btn btn-primary btn-lg']);?>
    <?=Html::a('Registrar Jefe de familia',['persona/nuevo'],['class'=>'btn btn-primary btn-lg']);?>
</div>

<h1 class="text-center"><?=Html::encode($this->title) ?></h1>


<div class="well">
    <?php $form=ActiveForm::begin([
        'id'=>'formfamiliar',
        'enableClientValidation'=>true,
        'options'=>['enctype'=>'multipart/form-data']
    ]); ?>

    <div class="row">
        <div class="col-md-4">
            <?=$form->field($personafamiliar,'nacionalidad')->dropDownList(
                ['V'=>'Venezolana','E'=>'Extranjero'],
                ['prompt'=>'Seleccione']
            );?>
            <?=$form->field($personafamiliar,'primer_nombre')->textInput(['placeholder'=>'Primer Nombre'])->label('Nombre');?>
            <?=$form->field($personafamiliar,'fecha_nacimiento')->widget(DatePicker::classname(), [
				'options' => ['placeholder' => 'Fecha de Nacimiento'],
				'type' => DatePicker::TYPE_INPUT,
				'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
				]
			]);?>
            <?=$form->field($telefono,'telffijo')->textInput(['placeholder'=>'0212-123-45-67']);?>
        </div>
        <div class="col-md-4">
            <?=$form->field($personafamiliar,'cedula')->textInput(['placeholder'=>'12.345.678']);?>
            <?=$form->field($personafamiliar,'primer_apellido')->textInput(['placeholder'=>'Primer Apellido'])->label('Apellido');?>
            <?=$form->field($personafamiliar,'lugar_nacimiento')->textInput(['placeholder'=>'Lugar de Nacimiento']);?>
            <?=$form->field($personafamiliar,'estado_civil_id')->dropDownList($estado_civil,['prompt'=>'-- Seleccione --']);?>
        </div>
        <div class="col-md-4">
            <?=$form->field($personafamiliar,'categoria_id')->dropDownList($categoria,['prompt'=>'-- Seleccione --']);?>
            <?=$form->field($personafamiliar,'sexo')->radioList(['M'=>'Masculino','F'=>'Femenino']);?>
            <?=$form->field($telefono,'telfmovil')->textInput(['placeholder'=>'0416-123-45-67']);?>
            <?=$form->field($parentesco,'nombparent')->dropDownList(
                [
                    'hijo/a'=>'Hijo/a',
                    'hermano/a'=>'Hermano/a',
                    'padre'=>'Padre',
                    'madre'=>'Madre',
                ],
                ['prompt'=>'-- Seleccione --','onchange'=>'ObtenerValorParentesco()']
            )->label('Parentesco con el jefe de familia');?>
        </div>
    </div>

    <div id="cipareja" style="display:none">
        <h3 class="text-center">Cedula de Padre/Madre</h3>
        <div class="row">
            <div class="col-md-6">
                <?=$form->field($familiar,'cedula')->textInput(['placeholder'=>'12.345.678'])->label('Cedula');?>
            </div>
        </div>
    </div>


    <h3 class="text-center">Estudios</h3>

    <div class="row">
        <div class="col-md-6">
            <?=$form->field($estudios,'nivelinstruccion')->dropDownList($nivel_instruccion,['prompt'=>'-- Seleccione --']);?>
        </div>
        <div class="col-md-6">
            <?=$form->field($estudios,'nombestudio')->textInput(['placeholder'=>'¿Estudia? Especifique'])->label('¿Que carrera universitaria te gustaria estudiar?');?>
        </div>
    </div>

    <div class="form-group">
        <?=Html::submitButton('Registrar',['class'=>'btn btn-primary btn-lg']);?>
    </div>
    <?php $form->end();?>
</div>

<script type="text/javascript">
    function ObtenerValorParentesco()
    {
        var select = document.getElementById('parentesco-nombparent');
		var valor = select.options[select.selectedIndex].value;
        var cedula = document.getElementById('personafamiliar-cedula');
		//alert(valor);
		//var valor = select.options[select.selectedIndex].innerText;// devuelve la opción del select no el valor
		if (valor == 'hijo/a' && cedula.value == '') {
            document.getElementById('cipareja').style.display = 'block';
            cedula.value = '----';
			cedula.style.display = 'none';
		}else {
			cedula.style.display = 'block';
		}
    }
</script>
