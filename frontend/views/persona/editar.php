<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

$this->title='Actualizar datos del Jefe de familia';
?>

<div class="btn-group">
	<?=Html::a('Registros',['persona/index'],['class'=>'btn btn-primary btn-lg']);?>
</div>

<h3 class="page-header"><?=Html::encode($this->title);?></h3>
<div class="well">
	<?php $form=ActiveForm::begin([
		'id'=>'form',
		//'enableClientValidation'=>true,
		//'enableAjaxValidation' => true,
		'options'=>['enctype'=>'multipart/form-data']
	]); ?>

	<h3 class="text-center">Datos Personales</h3>

	<div class="row">
		<div class="col-md-3">
			<div class="clearfix">
				<div id="divimg" style="display:none">
                    <img class="img-responsive" id="imgSalida">
                </div>
			</div>
			<?=$form->field($persona,'img')->fileInput(['accept'=>'image/*']);?>
		</div>
		<div class="col-md-3">
			<?=$form->field($persona,'nacionalidad')->dropDownList(
				['V'=>'Venezolana','E'=>'Extranjero'],
				['prompt'=>'Seleccione']
			);?>
			<?=$form->field($persona,'segundo_nombre')->textInput(['placeholder'=>'Segundo Nombre']);?>
			<?=$form->field($persona,'categoria_id')->dropDownList($categoria,['prompt'=>'-- Seleccione --']);?>
			<?=$form->field($telefono,'telffijo')->textInput(['placeholder'=>'Telefono fijo']);?>
			<?php //echo "<pre>";var_dump($telefono);die; ?>
			<?=$form->field($persona,'estado_civil_id')->dropDownList($estado_civil,['prompt'=>'-- Seleccione --']);?>
		</div>
		<div class="col-md-3">
			<?=$form->field($persona,'cedula')->textInput(['placeholder'=>'12.345.678']);?>
			<?=$form->field($persona,'primer_apellido')->textInput(['placeholder'=>'Primer Apellido']);?>
			<?=$form->field($persona,'fecha_nacimiento')->widget(DatePicker::classname(), [
				'options' => ['placeholder' => 'Fecha de Nacimiento'],
				'type' => DatePicker::TYPE_INPUT,
				'pluginOptions' => [
					'autoclose'=>true,
					'format' => 'yyyy-mm-dd'
				]
			]); ?>
			<?=$form->field($telefono,'telfmovil')->textInput(['placeholder'=>'Celular']);?>

		</div>
		<div class="col-md-3">
			<?=$form->field($persona,'primer_nombre')->textInput(['placeholder'=>'Primer Nombre']);?>
			<?=$form->field($persona,'segundo_apellido')->textInput(['placeholder'=>'Segundo Apellido']);?>
			<?=$form->field($persona,'lugar_nacimiento')->textInput(['placeholder'=>'Lugar de Nacimiento']);?>
			<?=$form->field($persona,'sexo')->radioList(['M'=>'Masculino','F'=>'Femenino']);?>
		</div>
	</div>

	<h3 class="text-center">Datos de la pareja</h3>

	<div class="row">
		<div class="col-md-6">
			<?=$form->field($familiar,'cedula')->textInput(['placeholder'=>'Cedual de la pareja']);?>
			<!--<?//=$form->field($personapareja, 'cedulapareja')->widget(\yii\jui\AutoComplete::classname(),[
				'clientOptions' => [
					//'source' => $cedula,
					'source' => ['12345678','87654321'],
				],
				'options'=>['class'=>'form-control','placeholder'=>'Cedula de pareja']
			]);?>-->
		</div>
		<div class="col-md-6">
			<?=$form->field($parentesco,'nombparent')->dropDownList(
                [
                    'concuvino/a'=>'Concuvino/a',
                    'esposo/a'=>'Esposo/a',
                ],
                ['prompt'=>'-- Seleccione --']
            )->label('Parentesco con Pareja');?>
		</div>
	</div>

	<h3 class="text-center">Estudios</h3>

	<div class="row">
		<div class="col-md-4">
			<?=$form->field($estudios,'nivelinstruccion')->dropDownList($nivel_instruccion,['prompt'=>'-- Seleccione --']);?>
		</div>
		<div class="col-md-4">
			<?=$form->field($estudios,'profesion')->textInput(['placeholder'=>'Profesión']);?>
		</div>
		<div class="col-md-4">
			<?=$form->field($estudios,'nombestudio')->textInput(['placeholder'=>'¿Estudia? Especifique']);?>
		</div>
	</div>

	<h3 class="text-center">Datos de Trabajo</h3>

	<div class="row">
		<div class="col-md-2">
			<?=$form->field($trabajo,'trabaja')->checkboxList(
				['0' => 'No', '1' => 'Si'],
				[
					'data-toggle'=>'button',
					'itemOptions'=>[
						//'id'=>'checkboxtrabaja',
						'class'=>'checkboxtrabaja',
					]
				]
			)->label('¿Trabaja?'); ?>
		</div>
		<div id="cuerpotrabajo" style="display:none;">
			<div class="col-md-5">
				<?=$form->field($trabajo,'antiguedad')->textInput(['placeholder'=>'Antiguedad']);?>
				<?=$form->field($trabajo,'lugartrabajo')->textInput(['placeholder'=>'Lugar de Trabajo']);?>
			</div>
			<div class="col-md-5">
				<?=$form->field($trabajo,'sueldomensual')->textInput(['placeholder'=>'Ingreso mensual']);?>
				<?=$form->field($trabajo,'cargo')->textInput(['placeholder'=>'Cargo']);?>
			</div>
		</div>
	</div>

	<h3 class="text-center">Datos de Salud</h3>

	<div class="row">
		<div class="col-md-6">
			<?=$form->field($enfermedad,'nombenf')->textInput(['placeholder'=>'Nombre de enfermedad']);?>
		</div>
		<div class="col-md-6">
			<?=$form->field($enfermedad,'tratamiento')->textInput(['placeholder'=>'Tratamiento']);?>
		</div>
		<div class="col-md-6">
			<?=$form->field($discapacidad,'nombdisca')->textInput(['placeholder'=>'Nombre de discapacidad']);?>
		</div>
	</div>

	<h3 class="text-center">Dato Social</h3>

	<div class="row">
		<div class="col-md-6">
			<?=$form->field($politica,'movsocial')->textInput(['placeholder'=>'Moviemiento social']);?>
		</div>
		<div class="col-md-6">
			<?=$form->field($politica,'mision')->textInput(['placeholder'=>'Misión']);?>
		</div>
	</div>

	<h3 class="text-center">Datos de la Casa</h3>

	<div class="row">
		<div class="col-md-6">
			<?=$form->field($casa,'ncasa')->textInput(['placeholder'=>'N# de Casa']);?>
			<?=$form->field($direccion,'calle_id')->dropDownList(
				$calle,
				['prompt'=>'-- Seleccione --']
			);?>
			<?=$form->field($pago,'pagocasa')->textInput(['placeholder'=>'Pago de Alquiler']);?>
			<?=$form->field($casa,'tippiso')->dropDownList(
				[
					'cemento'=>'Cemento',
					'ceramica'=>'Ceramica',
					'madera'=>'madera'
				],
				['prompt'=>'-- Seleccione --']
			);?>
		</div>
		<div class="col-md-6">
			<?=$form->field($casa,'nombre')->textInput(['placeholder'=>'Nombre de la Casa']);?>
			<?=$form->field($casa,'tipcasa')->dropDownList(
				['alquilada'=>'Alquilada','propia'=>'Propia'],
				['prompt'=>'-- Seleccione --']
			);?>
			<?=$form->field($casa,'tipconstruccion')->dropDownList(
				[
					'laminas de zinc'=>'Laminas de Zinc',
					'carton piedra'=>'Carton piedra',
					'madera'=>'Madera',
					'bloques'=>'Bloques',
					'ladrillos'=>'Ladrillos'
				],
				['prompt'=>'-- Seleccione --']
			);?>
			<?=$form->field($casa,'tiptecho')->dropDownList(
				[
					'laminas de zinc'=>'Laminas de Zinc',
					'laminas de acerolit'=>'Laminas de Acerolit',
					'Platabanda'=>'Platabanda',
					'madera'=>'Madera'
				],
				['prompt'=>'-- Seleccione --']
			);?>
		</div>
	</div>

	<h3 class="text-center">Divisiones de la Casa</h3>

	<div class="row">
		<div class="col-md-3">
			<?=$form->field($casa,'bano')->radioList(['0' => 'No', '1' => 'Si'])->label('¿Tiene Baño?');?>
		</div>
		<div class="col-md-3">
			<?=$form->field($casa,'cuarto')->radioList(['0' => 'No', '1' => 'Si'])->label('¿Tiene Cuartos?');?>
		</div>
		<div class="col-md-3">
			<?=$form->field($casa,'sala')->radioList(['0' => 'No', '1' => 'Si'])->label('¿Tiene Sala?');?>
		</div>
		<div class="col-md-3">
			<?=$form->field($casa,'comedor')->radioList(['0' => 'No', '1' => 'Si'])->label('¿Tiene comedor?');?>
		</div>
	</div>

	<h3 class="text-center">Datos de Mascotas</h3>

	<div class="row">
		<div class="col-md-3">
			<?=$form->field($mascota,'perro')->radioList(['0' => 'No', '1' => 'Si'])->label('¿Tiene Perro?');?>
		</div>
		<div class="col-md-3">
			<?=$form->field($mascota,'gato')->radioList(['0' => 'No', '1' => 'Si'])->label('¿Tiene Gato?');?>
		</div>
		<div class="col-md-3">
			<?=$form->field($mascota,'aves')->radioList(['0' => 'No', '1' => 'Si'])->label('¿Tiene Ave?');?>
		</div>
		<div class="col-md-3">
			<?=$form->field($mascota,'otros')->radioList(['0' => 'No', '1' => 'Si'])->label('¿Otra especie?');?>
		</div>
	</div>

	<h3 class="text-center">Cantidad de Bienes de la Casa</h3>

	<div class="row">
		<div class="col-md-4">
			<?=$form->field($inmuebles,'camas')->textInput();?>
			<?=$form->field($inmuebles,'lavadora')->textInput();?>
			<?=$form->field($inmuebles,'aireacondicionado')->textInput();?>
		</div>
		<div class="col-md-4">
			<?=$form->field($inmuebles,'cocinas')->textInput();?>
			<?=$form->field($inmuebles,'computadora')->textInput();?>
			<?=$form->field($inmuebles,'nevera')->textInput();?>
		</div>
		<div class="col-md-4">
			<?=$form->field($inmuebles,'tv')->textInput();?>
		</div>
	</div>

	<h3 class="text-center">Servicios en Casa</h3>

	<div class="row">
		<div class="col-md-4">
			<?=$form->field($servicios,'luz')->radioList(['0' => 'No', '1' => 'Si'])->label('¿Cuenta con Luz?');?>
			<?=$form->field($servicios,'gas')->radioList(['0' => 'No', '1' => 'Si'])->label('¿Cuenta con Gas?');?>
		</div>
		<div class="col-md-4">
			<?=$form->field($servicios,'aguasblancas')->radioList(['0' => 'No', '1' => 'Si'])->label('¿Cuenta con Aguas blancas?');?>
			<?=$form->field($servicios,'cloacas')->radioList(['0' => 'No', '1' => 'Si'])->label('¿Cuenta con Aguas negras?');?>
		</div>
		<div class="col-md-4">
			<?=$form->field($servicios,'internet')->radioList(['0' => 'No', '1' => 'Si'])->label('¿Cuenta con Internet?');?>
		</div>
	</div>

	<h3 class="text-center">Datos de Embarcación o Negocio</h3>

	<div class="row">
		<div class="col-md-3">
			<?=$form->field($embneg,'posee_emb')->radioList(['0' => 'No', '1' => 'Si'])->label('¿Poseé Embarcación?');?>
			<?=$form->field($embneg,'operativa')->radioList(['0' => 'No', '1' => 'Si'])->label('¿Esta operativa?');?>
			<?=$form->field($embneg,'poseeconcesion')->radioList(['0' => 'No', '1' => 'Si'])->label('¿Poseé concesión?');?>
		</div>
		<div class="col-md-6">
			<?=$form->field($embneg,'propietario')->radioList(['0' => 'No', '1' => 'Si'])->label('¿Es propietario?');?>
			<?=$form->field($embneg,'matricula')->textInput();?>
		</div>
		<div class="col-md-3">
			<?=$form->field($embneg,'datosdueno')->textInput();?>
			<?=$form->field($embneg,'poseenegocio')->textInput();?>
		</div>
	</div>

	<div class="form-group">
		<?=Html::submitButton('Registrar',['class'=>'btn btn-primary btn-lg']);?>
	</div>
	<?php $form->end();?>
</div>

<?php
$js = <<<JS
	$(".checkboxtrabaja").on( 'change', function() {
	    if( $(this).is(':checked') ) {
			document.getElementById('cuerpotrabajo').style.display = 'block';
	    } else {
			document.getElementById('cuerpotrabajo').style.display = 'block';
	    }
	});

	// Cargar la imagen
    // Obtener referencia al input y a la imagen
    const divimg = document.getElementById('divimg');
    const imgselec = document.querySelector("#persona-img");
    const viewimagen = document.querySelector("#imgSalida");

    // Escuchar cuando cambie
    imgselec.addEventListener('change', () => {
        divimg.style.display= 'block';
        // Los archivos seleccionados, pueden ser muchos o uno
        const archivos = imgselec.files;
        // Si no hay archivos salimos de la función y quitamos la imagen
        if (!archivos || !archivos.length) {
            viewimagen.src = "";
            return;
        }
        // Ahora tomamos el primer archivo, el cual vamos a previsualizar
        const primerArchivo = archivos[0];
        // Lo convertimos a un objeto de tipo objectURL
        const objectURL = URL.createObjectURL(primerArchivo);
        // Y a la fuente de la imagen le ponemos el objectURL
        viewimagen.src = objectURL;
    });
JS;
$this->registerJs($js, \yii\web\View::POS_READY);

?>
