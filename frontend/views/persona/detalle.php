<?php

use yii\helpers\Html;

$this->title = 'Detalle';

?>

<div class="btn-group">
	<?=Html::a('Registros',['persona/index'],['class'=>'btn btn-primary btn-lg']);?>
</div>

<h1 class="text-center">Detalle del Jefe de Familia</h1>

<table class="table table-bordered">
	<thead>
		<!-- datos personales -->
		<tr>
			<th class="text-center bg-primary" colspan="10">Datos Personales</th>
		</tr>
        <tr class="bg-info">
			<th>Nacionalidad</th>
            <th>Cedula</th>
			<th>Primer Nombre</th>
            <th>Segundo Nombre</th>
			<th>Primer Apellido</th>
            <th>Segundo Apellido</th>
			<th>Edad</th>
			<th>Categoria</th>
            <th>Fecha nacimiento</th>
			<th>Lugar de Nacimiento</th>
        </tr>
    </thead>
    <tbody>
        <tr>
			<td><?=$persona->nacionalidad == 'V' ? 'Venezolano' : 'Extrajero';?></td>
            <td><?=$persona->cedula;?></td>
            <td><?=$persona->primer_nombre;?></td>
			<td><?=$persona->segundo_nombre;?></td>
			<td><?=$persona->primer_apellido;?></td>
            <td><?=$persona->segundo_apellido;?></td>
			<td><?=$persona->getEdad();?></td>
			<td><?=$persona->getCategoria()->nombre;?></td>
            <td><?=$persona->fecha_nacimiento;?></td>
            <td><?=$persona->lugar_nacimiento;?></td>
        </tr>
    </tbody>
	<thead>
        <tr class="bg-info">
			<th>Telefono Fijo</th>
			<th>Telefono Movil</th>
            <th>Estado Civil</th>
            <th>Calle</th>
            <th>Casa</th>
        </tr>
    </thead>
    <tbody>
        <tr>
			<td><?php  foreach($persona->gettelf() as $data){ echo $data->telffijo; } ?></td>
			<td><?php  foreach($persona->gettelf() as $data){ echo $data->telfmovil; } ?></td>
            <td><?=$persona->getEstadoCivil();?></td>
            <td><?=$persona->getCalle()['nombre'];?></td>
            <td><?=$persona->getCasa()['nombre'];?></td>
        </tr>
    </tbody>
	<!-- Datos de la pareja -->
	<thead>
		<tr>
			<th class="text-center bg-primary" colspan="10">Datos de la pareja</th>
		</tr>
        <tr class="bg-info">
			<th>Cedula</th>
			<th>Nombre y apellido</th>
            <th>Parentesco</th>
        </tr>
    </thead>
    <tbody>
        <tr>
			<td>
				<?=$persona->getparentpareja()->getfampareja()['primer_nombre'] != null ?
				 	$persona->getparentpareja()->getfampareja()['cedula'] :
					$persona->getparentpareja()['cedula'];
				?>
			</td>
            <td>
				<?=$persona->getparentpareja()->getfampareja()['primer_nombre'] != null ?
				 	$persona->getparentpareja()->getfampareja()['primer_nombre'] .' '.
					$persona->getparentpareja()->getfampareja()['primer_apellido'] :
					'';
				?>
			<td>
				<?=$persona->getparentpareja()->getfamparentesco()['nombparent'];?>
			</td>
        </tr>
    </tbody>
	<!-- Datos de estudios -->
	<thead>
		<tr>
			<th class="text-center bg-primary" colspan="10">Datos de Estudios</th>
		</tr>
        <tr class="bg-info">
            <th>Nivel de Instrucción</th>
            <th>Profesión</th>
            <th>Estudia</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?=$persona->getestudios()['nivelinstruccion'];?></td>
            <td><?=$persona->getestudios()['profesion'];?></td>
            <td><?=$persona->getestudios()['nombestudio'];?></td>
        </tr>
    </tbody>
	<!-- Datos de trabajo -->
	<thead>
		<tr>
			<th class="text-center bg-primary" colspan="10">Datos de Trabajo</th>
		</tr>
        <tr class="bg-info">
            <th>Trabaja</th>
            <th>Antiguedad</th>
            <th>Lugar de Trabajo</th>
            <th>Sueldo Mensual</th>
            <th>Cargo de Trabajo</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?=$persona->gettrabajo()['trabaja'] == 1 ? 'Si' : 'No';?></td>
            <td><?=$persona->gettrabajo()['antiguedad'];?></td>
            <td><?=$persona->gettrabajo()['lugartrabajo'];?></td>
            <td><?=$persona->gettrabajo()['sueldomensual'];?></td>
            <td><?=$persona->gettrabajo()['cargo'];?></td>
        </tr>
    </tbody>
	<!-- Datos de salud -->
	<thead>
		<tr>
			<th class="text-center bg-primary" colspan="10">Datos de Salud</th>
		</tr>
        <tr class="bg-info">
            <th>¿Padece alguna enfermedad?</th>
            <th>¿Toma tratamiento?</th>
            <th>Nombre de Discapacidad</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?=$persona->getenfermedad()['nombenf'];?></td>
            <td><?=$persona->getenfermedad()['tratamiento'];?></td>
            <td><?=$persona->getdiscapacidad()['nombdisca'];?></td>
        </tr>
    </tbody>
	<!-- Datos Examenes COVID-19 -->
	<thead>
		<tr>
			<th class="text-center bg-primary" colspan="10">Datos Examenes COVID-19</th>
		</tr>
        <tr class="bg-info">
            <th>¿Le hicieron la prueba del COVID-19?</th>
            <th>¿Resultado de prueba del COVID-19?</th>
            <th>¿Fecha de prueba del COVID-19?</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($persona->getpruebacovid() as $data): ?>
			<tr>
	            <td><?=$data->prueba_1 == true ? 'Si' : 'No';?></td>
				<td><?=$data->resultado1 == true ? 'Positivo' : 'Negativo';?></td>
	            <td><?=$data->f_prueba1;?></td>
	        </tr>
        <?php endforeach; ?>
    </tbody>
	<!-- Datos social -->
	<thead>
		<tr>
			<th class="text-center bg-primary" colspan="10">Datos Social</th>
		</tr>
        <tr class="bg-info">
            <th>¿Participa en algún movimiento social?</th>
            <th>¿Esta inscrito en alguna misión?</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?=$persona->getenfermedad()['nombenf'];?></td>
            <td><?=$persona->getenfermedad()['tratamiento'];?></td>
        </tr>
    </tbody>
	<!-- Datos de la Casa -->
	<thead>
		<tr>
			<th class="text-center bg-primary" colspan="10">Datos de la Casa</th>
		</tr>
        <tr class="bg-info">
			<th>N# de Casa</th>
			<th>Nombre de la Casa</th>
			<th>Calle</th>
			<th>¿La Vivienda es?</th>
			<th>¿Cuanto paga por alquiler?</th>
			<th>Tipo de construcción</th>
            <th>Tipo de piso</th>
            <th>Tipo de techo</th>
        </tr>
    </thead>
    <tbody>
        <tr>
			<td><?=$persona->getdireccion()->getcasa()['ncasa'];?></td>
			<td><?=$persona->getdireccion()->getcasa()['nombre'];?></td>
			<td><?=$persona->getdireccion()->getcalle()['nombre'];?></td>
			<td><?=$persona->getdireccion()->getcasa()['tipcasa'];?></td>
			<td><?=$persona->getdireccion()->getcasa()->getpago()['pagocasa'];?></td>
			<td><?=$persona->getdireccion()->getcasa()['tipconstruccion'];?></td>
            <td><?=$persona->getdireccion()->getcasa()['tippiso'];?></td>
            <td><?=$persona->getdireccion()->getcasa()['tiptecho'];?></td>
        </tr>
    </tbody>
	<!-- Disiones de la Casa -->
	<thead>
		<tr>
			<th class="text-center bg-primary" colspan="10">Divisiones de la Casa</th>
		</tr>
        <tr class="bg-info">
			<th>¿Cuenta con Baño?</th>
			<th>¿Cuenta con Cuartos?</th>
			<th>¿Cuenta con Sala?</th>
            <th>¿Cuenta con Comedor?</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?=$persona->getdireccion()->getcasa()['bano'] == true ? 'Si' : 'No';?></td>
			<td><?=$persona->getdireccion()->getcasa()['cuarto'] == true ? 'Si' : 'No';?></td>
			<td><?=$persona->getdireccion()->getcasa()['sala'] == true ? 'Si' : 'No';?></td>
            <td><?=$persona->getdireccion()->getcasa()['comedor'] == true ? 'Si' : 'No';?></td>
        </tr>
    </tbody>
	<!-- Datos de Mascotas -->
	<thead>
		<tr>
			<th class="text-center bg-primary" colspan="10">Datos de Mascotas</th>
		</tr>
        <tr class="bg-info">
			<th>¿Tiene Perro?</th>
			<th>¿Tiene Gato?</th>
			<th>¿Tiene Aves?</th>
            <th>¿Otra especie?</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?=$persona->getmascota()['perro'] == true ? 'Si' : 'No';?></td>
			<td><?=$persona->getmascota()['gato'] == true ? 'Si' : 'No';?></td>
			<td><?=$persona->getmascota()['aves'] == true ? 'Si' : 'No';?></td>
            <td><?=$persona->getmascota()['otros'] == true ? 'Si' : 'No';?></td>
        </tr>
    </tbody>
	<!-- Cantidad de bienes de la casa -->
	<thead>
		<tr>
			<th class="text-center bg-primary" colspan="10">Cantidad de bienes de la Casa</th>
		</tr>
        <tr class="bg-info">
			<th>¿Cantidad de Camas?</th>
			<th>¿Cantidad de Cocinas?</th>
			<th>¿Cantidad de Neveras?</th>
			<th>¿Cantidad de Lavadoras?</th>
			<th>¿Cantidad de Computadoras?</th>
			<th>¿Cantidad de TV?</th>
			<th>¿Cantidad de Aire Acondicionados?</th>
        </tr>
    </thead>
    <tbody>
        <tr>
			<td><?=$persona->getdireccion()->getcasa()->getinmuebles()['camas'];?></td>
			<td><?=$persona->getdireccion()->getcasa()->getinmuebles()['cocinas'];?></td>
			<td><?=$persona->getdireccion()->getcasa()->getinmuebles()['nevera'];?></td>
			<td><?=$persona->getdireccion()->getcasa()->getinmuebles()['lavadora'];?></td>
			<td><?=$persona->getdireccion()->getcasa()->getinmuebles()['computadora'];?></td>
			<td><?=$persona->getdireccion()->getcasa()->getinmuebles()['tv'];?></td>
			<td><?=$persona->getdireccion()->getcasa()->getinmuebles()['aireacondicionado'];?></td>
        </tr>
    </tbody>
	<!-- Servicios en la Casa -->
	<thead>
		<tr>
			<th class="text-center bg-primary" colspan="10">Servicios en la Casa</th>
		</tr>
        <tr class="bg-info">
			<th>¿Cuenta con Luz?</th>
			<th>¿Cuenta con Aguas Blancas?</th>
			<th>¿Cuenta con Internet?</th>
			<th>¿Cuenta con Gas?</th>
			<th>¿Cuenta con Aguas Negras?</th>
        </tr>
    </thead>
    <tbody>
        <tr>
			<td><?=$persona->getdireccion()->getcasa()->getservicios()['luz'] == true ? 'Si' : 'No';?></td>
			<td><?=$persona->getdireccion()->getcasa()->getservicios()['aguasblancas'] == true ? 'Si' : 'No';?></td>
			<td><?=$persona->getdireccion()->getcasa()->getservicios()['internet'] == true ? 'Si' : 'No';?></td>
			<td><?=$persona->getdireccion()->getcasa()->getservicios()['gas'] == true ? 'Si' : 'No';?></td>
			<td><?=$persona->getdireccion()->getcasa()->getservicios()['cloacas'] == true ? 'Si' : 'No';?></td>
        </tr>
    </tbody>
	<!-- Datos de Embarcacion o Negocio -->
	<thead>
		<tr>
			<th class="text-center bg-primary" colspan="10">Datos de Embarcacion o Negocio</th>
		</tr>
        <tr class="bg-info">
			<th>¿Poseé Embarcación?</th>
			<th>¿Es propietario?</th>
			<th>¿Datos del dueño?</th>
			<th>¿Esta operativa?</th>
			<th>Matricula de Embarcación</th>
            <th>¿Poseé negocio en los Roques?</th>
            <th>¿Poseé concesión?</th>
        </tr>
    </thead>
    <tbody>
        <tr>
			<td><?=$persona->getembneg()['posee_emb'] == true ? 'Si' : 'No';?></td>
			<td><?=$persona->getembneg()['propietario'] == true ? 'Si' : 'No';?></td>
			<td><?=$persona->getembneg()['datosdueno'];?></td>
			<td><?=$persona->getembneg()['operativa'] == true ? 'Si' : 'No';?></td>
			<td><?=$persona->getembneg()['matricula'];?></td>
            <td><?=$persona->getembneg()['poseenegocio'];?></td>
            <td><?=$persona->getembneg()['poseeconcesion'] == true ? 'Si' : 'No';?></td>
        </tr>
    </tbody>
</table>
