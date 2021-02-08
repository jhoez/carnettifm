<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\date\DatePicker;

$this->title='Registro de los Roques';
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
			<?=$form->field($telefono,'telffijo')->textInput(['placeholder'=>'0212-123-45-67']);?>
			<?=$form->field($persona,'estado_civil_id')->dropDownList($estado_civil,['prompt'=>'-- Seleccione --']);?>
		</div>
		<div class="col-md-3">
			<!--<?php//=$form->field($persona,'cedula',['enableAjaxValidation'=>true])->textInput();?>-->
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
			<?=$form->field($telefono,'telfmovil')->textInput(['placeholder'=>'0416-123-45-67']);?>

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
			<?=$form->field($personapareja,'cedulapareja')->textInput(['placeholder'=>'Cedual de la pareja']);?>
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
                    'concuvino'=>'Concuvino',
					'concuvina'=>'Concuvina',
                    'esposo'=>'Esposo',
                    'esposa'=>'Esposa',
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
			<?= $form->field($trabajo,'trabaja')->checkboxList(
				['0' => 'NO', '1' => 'SI'],
				[
					'itemOptions'=>[
						'id'=>'checkboxtrabaja',
						//'class'=>'checkboxtrabaja',
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

	<h3 class="text-center">Datos Examenes COVID-19</h3>

	<div class="row">
		<div class="col-md-6">
			<?= $form->field($pruebacovid, 'prueba_1')->checkboxList(
				[0 => 'NO', 1 => 'SI'],
				['itemOptions'=>['id'=>'checkboxcovid']]
			)->label('¿Le hicieron la prueba del COVID-19?');?>
		</div>
		<div id="cuerpocovid" style="display:none;">
			<div class="col-md-6">
				<?= $form->field($pruebacovid, 'resultado1')->checkboxList(
					[0 => 'Negativo', 1 => 'Positivo']
				)->label('¿Resultado de prueba del COVID-19?');?>
			</div>
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
			<?=$form->field($casa,'bano')->radioList([0 => 'NO', 1 => 'SI'])->label('¿Tiene Baño?');?>
		</div>
		<div class="col-md-3">
			<?=$form->field($casa,'cuarto')->radioList([0 => 'NO', 1 => 'SI'])->label('¿Tiene Cuartos?');?>
		</div>
		<div class="col-md-3">
			<?=$form->field($casa,'sala')->radioList([0 => 'NO', 1 => 'SI'])->label('¿Tiene Sala?');?>
		</div>
		<div class="col-md-3">
			<?=$form->field($casa,'comedor')->radioList([0 => 'NO', 1 => 'SI'])->label('¿Tiene comedor?');?>
		</div>
	</div>

	<h3 class="text-center">Datos de Mascotas</h3>

	<div class="row">
		<div class="col-md-3">
			<?=$form->field($mascota,'perro')->radioList([0 => 'NO', 1 => 'SI'])->label('¿Tiene Perro?');?>
		</div>
		<div class="col-md-3">
			<?=$form->field($mascota,'gato')->radioList([0 => 'NO', 1 => 'SI'])->label('¿Tiene Gato?');?>
		</div>
		<div class="col-md-3">
			<?=$form->field($mascota,'aves')->radioList([0 => 'NO', 1 => 'SI'])->label('¿Tiene Ave?');?>
		</div>
		<div class="col-md-3">
			<?=$form->field($mascota,'otros')->radioList([0 => 'NO', 1 => 'SI'])->label('¿Otra especie?');?>
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
			<?=$form->field($servicios,'luz')->radioList([0 => 'NO', 1 => 'SI'])->label('¿Cuenta con Luz?');?>
			<?=$form->field($servicios,'gas')->radioList([0 => 'NO', 1 => 'SI'])->label('¿Cuenta con Gas?');?>
		</div>
		<div class="col-md-4">
			<?=$form->field($servicios,'aguasblancas')->radioList([0 => 'NO', 1 => 'SI'])->label('¿Cuenta con Aguas blancas?');?>
			<?=$form->field($servicios,'cloacas')->radioList([0 => 'NO', 1 => 'SI'])->label('¿Cuenta con Aguas negras?');?>
		</div>
		<div class="col-md-4">
			<?=$form->field($servicios,'internet')->radioList([0 => 'NO', 1 => 'SI'])->label('¿Cuenta con Internet?');?>
		</div>
	</div>

	<h3 class="text-center">Datos de Embarcación o Negocio</h3>

	<div class="row">
		<div class="col-md-3">
			<?=$form->field($embneg,'posee_emb')->radioList([0 => 'NO', 1 => 'SI'])->label('¿Poseé Embarcación?');?>
			<?=$form->field($embneg,'operativa')->radioList([0 => 'NO', 1 => 'SI'])->label('¿Esta operativa?');?>
			<?=$form->field($embneg,'poseeconcesion')->radioList([0 => 'NO', 1 => 'SI'])->label('¿Poseé concesión?');?>
		</div>
		<div class="col-md-6">
			<?=$form->field($embneg,'propietario')->radioList([0 => 'NO', 1 => 'SI'])->label('¿Es propietario?');?>
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

<script type="text/javascript">
// captura el evento del primer selector
/*window.addEventListener('load',function(){
	var checkboxtrabaja = document.querySelector('#checkboxtrabaja');
	checkboxtrabaja.addEventListener('click', function(e) {
		e.preventDefault();
		alert(checkboxtrabaja.value);
		if (checkboxtrabaja.value == 1) {
			document.getElementById('cuerpotrabajo').style.display = 'block';
		}else {
			document.getElementById('cuerpotrabajo').style.display = 'none';
		}
	});

	var checkboxcovid = document.querySelector('#checkboxcovid');
	checkboxcovid.addEventListener('click', function(e) {
		e.preventDefault();
		if (checkboxcovid.value == 1) {
			document.getElementById('cuerpocovid').style.display = 'block';
		}else {
			document.getElementById('cuerpocovid').style.display = 'none';
		}
	});
});*/
</script>

<?php
$js = <<<JS
    function functiontrabaja() {
        //var result=[];
        //$('input[type="checkbox"]:checked').each(function(index,checkbox){
        //    result.push($(checkbox).val());
        //});
		if ($('input[type="checkbox"]:checked').val() == 1) {
			document.getElementById('cuerpotrabajo').style.display = 'block';
		}else {
			document.getElementById('cuerpotrabajo').style.display = 'none';
		}
    }
    $(document).on("click",'#checkboxtrabaja',functiontrabaja);

	function functioncovid() {
		if ($('input[type="checkbox"]:checked').val() == 1) {
			document.getElementById('cuerpocovid').style.display = 'block';
		}else {
			document.getElementById('cuerpocovid').style.display = 'none';
		}
    }
    $(document).on("click",'#checkboxcovid',functioncovid);

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
