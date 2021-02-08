<?php

use yii\helpers\Html;

if ( $persona != null ):
?>
<div class="text-right">Fecha: <?=date("d/m/Y");?></div>
<br>
<h2 class="text-center">Resumen de vida</h2>
<h1 class="text-center">Detalle del Jefe de Familia</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center" colspan="12">Datos Personales</th>
        </tr>
        <tr>
            <th style="background:#121" colspan="2">Foto</th>
            <th style="background:#121">Nacionalidad</th>
            <th style="background:#121">Cedula</th>
            <th style="background:#121">Primer Nombre</th>
            <th style="background:#121">Segundo Nombre</th>
            <th style="background:#121">Primer Apellido</th>
            <th style="background:#121">Segundo Apellido</th>
            <th style="background:#121">Edad</th>
            <th style="background:#121">Categoria</th>
            <th style="background:#121">Fecha nacimiento</th>
            <th style="background:#121">Lugar de Nacimiento</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td rowspan="3" colspan="2"><?=Html::img(Yii::$app->getBasePath().'/web/foto/'.$persona->foto,['width'=>'150','height'=>'200']);?></td>
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
        <tr>
            <th style="background:#121">Telefono Fijo</th>
            <th style="background:#121">Telefono Movil</th>
            <th style="background:#121">Estado Civil</th>
            <th style="background:#121">Calle</th>
            <th style="background:#121">Casa</th>
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

    <thead>
        <tr>
            <th class="text-center" colspan="12">Datos de la pareja</th>
        </tr>
        <tr>
            <th style="background:#121">Cedula</th>
            <th style="background:#121">Nombre y apellido</th>
            <th style="background:#121">Parentesco</th>
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

    <thead>
        <tr>
            <th class="text-center" colspan="12">Datos de Estudios</th>
        </tr>
        <tr>
            <th style="background:#121">Nivel de Instrucción</th>
            <th style="background:#121">Profesión</th>
            <th style="background:#121">Estudia</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?=$persona->getestudios()['nivelinstruccion'];?></td>
            <td><?=$persona->getestudios()['profesion'];?></td>
            <td><?=$persona->getestudios()['nombestudio'];?></td>
        </tr>
    </tbody>

    <thead>
        <tr>
            <th class="text-center" colspan="12">Datos de Trabajo</th>
        </tr>
        <tr>
            <th style="background:#121">Trabaja</th>
            <th style="background:#121">Antiguedad</th>
            <th style="background:#121">Lugar de Trabajo</th>
            <th style="background:#121">Sueldo Mensual</th>
            <th style="background:#121">Cargo de Trabajo</th>
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

    <thead>
        <tr>
            <th class="text-center" colspan="12">Datos de Salud</th>
        </tr>
        <tr>
            <th style="background:#121">¿Padece alguna enfermedad?</th>
            <th style="background:#121">¿Toma tratamiento?</th>
            <th style="background:#121">Nombre de Discapacidad</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?=$persona->getenfermedad()['nombenf'];?></td>
            <td><?=$persona->getenfermedad()['tratamiento'];?></td>
            <td><?=$persona->getdiscapacidad()['nombdisca'];?></td>
        </tr>
    </tbody>

    <thead>
        <tr>
            <th class="text-center" colspan="12">Datos Examenes COVID-19</th>
        </tr>
        <tr>
            <th style="background:#121">¿Le hicieron la prueba del COVID-19?</th>
            <th style="background:#121">¿Resultado de prueba del COVID-19?</th>
            <th style="background:#121">¿Fecha de prueba del COVID-19?</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($persona->getpruebacovid() as $data): ?>
            <tr>
                <td><?=$data->prueba_1 == 1 ? 'Si' : 'No';?></td>
                <td><?=$data->resultado1 == 1 ? 'Positivo' : 'Negativo';?></td>
                <td><?=$data->f_prueba1;?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<table class="table table-bordered">
    <thead>
		<tr>
			<th class="text-center" colspan="12">Datos Social</th>
		</tr>
        <tr>
            <th style="background:#121">¿Participa en algún movimiento social?</th>
            <th style="background:#121">¿Esta inscrito en alguna misión?</th>
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
			<th class="text-center" colspan="12">Datos de la Casa</th>
		</tr>
        <tr>
			<th style="background:#121">N# de Casa</th>
			<th style="background:#121">Nombre de la Casa</th>
			<th style="background:#121">Calle</th>
			<th style="background:#121">¿La Vivienda es?</th>
			<th style="background:#121">¿Cuanto paga por alquiler?</th>
			<th style="background:#121">Tipo de construcción</th>
            <th style="background:#121">Tipo de piso</th>
            <th style="background:#121">Tipo de techo</th>
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
			<th class="text-center" colspan="12">Divisiones de la Casa</th>
		</tr>
        <tr>
			<th style="background:#121">¿Cuenta con Baño?</th>
			<th style="background:#121">¿Cuenta con Cuartos?</th>
			<th style="background:#121">¿Cuenta con Sala?</th>
            <th style="background:#121">¿Cuenta con Comedor?</th>
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
			<th class="text-center" colspan="12">Datos de Mascotas</th>
		</tr>
        <tr>
			<th style="background:#121">¿Tiene Perro?</th>
			<th style="background:#121">¿Tiene Gato?</th>
			<th style="background:#121">¿Tiene Aves?</th>
            <th style="background:#121">¿Otra especie?</th>
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
			<th class="text-center" colspan="12">Cantidad de bienes de la Casa</th>
		</tr>
        <tr>
			<th style="background:#121">¿Cantidad de Camas?</th>
			<th style="background:#121">¿Cantidad de Cocinas?</th>
			<th style="background:#121">¿Cantidad de Neveras?</th>
			<th style="background:#121">¿Cantidad de Lavadoras?</th>
			<th style="background:#121">¿Cantidad de Computadoras?</th>
			<th style="background:#121">¿Cantidad de TV?</th>
			<th style="background:#121">¿Cantidad de Aire Acondicionados?</th>
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
			<th class="text-center" colspan="12">Servicios en la Casa</th>
		</tr>
        <tr>
			<th style="background:#121">¿Cuenta con Luz?</th>
			<th style="background:#121">¿Cuenta con Aguas Blancas?</th>
			<th style="background:#121">¿Cuenta con Internet?</th>
			<th style="background:#121">¿Cuenta con Gas?</th>
			<th style="background:#121">¿Cuenta con Aguas Negras?</th>
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

    <thead>
		<tr>
			<th class="text-center" colspan="12">Datos de Embarcacion o Negocio</th>
		</tr>
        <tr>
			<th style="background:#121">¿Poseé Embarcación?</th>
			<th style="background:#121">¿Es propietario?</th>
			<th style="background:#121">¿Datos del dueño?</th>
			<th style="background:#121">¿Esta operativa?</th>
			<th style="background:#121">Matricula de Embarcación</th>
            <th style="background:#121">¿Poseé negocio en los Roques?</th>
            <th style="background:#121">¿Poseé concesión?</th>
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
<?php endif; ?>
