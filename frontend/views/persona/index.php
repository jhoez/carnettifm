<?php
use yii\helpers\Html;
use yii\grid\GridView;
use frontend\assets\JqueryUiAsset;

JqueryUiAsset::register($this);

$this->title='Listado de personas registradas para carnetizacion';
?>
<div class="btn-group">
	<?=Html::a('Registrar Jefe de Familia',['persona/nuevo'],['class'=>'btn btn-primary btn-lg']);?>
	<?=Html::a('Informe diario',['persona/reporte'],['class'=>'btn btn-default btn-lg','target'=>'_blank']);?>
</div>

<h3 class="page-header"><?=Html::encode($this->title);?></h3>


<div class="row">
	<?=GridView::widget([
		'dataProvider'=>$dataProvider,
		'filterModel'=>$searchModel,
		//'tableOptions'=>['class'=>'table table-striped table-hover table-bordered'],
		'columns'=>[
			[
				'class'=>'yii\\grid\\ActionColumn',
				'header'=>'Acciones',
				'headerOptions'=>['class'=>'text-primary'],
				'template'=>'{pdf}{editar}{familiar}{grupofamiliar}{pruebacovid}',
				'buttons'=>[
					'pdf'=>function($id,$model,$url){
						return Html::a(
							Html::tag(
								'span',
								null,
								['class'=>'glyphicon glyphicon-file']
							),
							['persona/reporte','id'=>$model->id]
						);
					},
					'editar'=>function($id,$model,$url){
						return Html::a(
							Html::tag(
								'span',
								null,
								['class'=>'glyphicon glyphicon-edit']
							),
							['persona/editar','id'=>$model->id]
						);
					},
					'familiar'=>function($id,$model,$url){
						return Html::a(
							Html::tag(
								'span',
								null,
								['class'=>'glyphicon glyphicon-plus']
							),
							['persona/familiar','id'=>$model->id]
						);
					},
					'grupofamiliar'=>function($id,$model,$url){
						return Html::a(
							Html::tag(
								'span',
								null,
								['class'=>'glyphicon glyphicon-eye-open']
							),
							['persona/grupofamiliar','id'=>$model->id]
						);
					},
					'pruebacovid'=>function($id,$model,$url){
						return Html::a(
							Html::tag(
								'span',
								null,
								['class'=>'glyphicon glyphicon-asterisk']
							),
							['persona/pruebacovid','id'=>$model->id]
						);
					}
				],
			],
			[
				'label'=>'Cedula',
				'attribute'=>'cedula',
				'value'=>function($data){
					return $data->cedula;
				}
			],
			[
				'label'=>'Nombres',
				'attribute'=>'primer_nombre',
				'value'=>function($data){
					return $data->primer_nombre.' '. $data->segundo_nombre;
				}
			],
			[
				'label'=>'Apellidos',
				'attribute'=>'primer_apellido',
				'value'=>function($data){
					return $data->primer_apellido.' '.$data->segundo_apellido;
				}
			],
			//'cedula:text:Cedula',
			[
				'label'=>'Fecha de nacimiento',
				'attribute'=>'fecha_nacimiento',
				'format'=>'text',
				'filterInputOptions'=>['class'=>'form-control form-fecha'],
				'value'=>function($data){
					return  $data->fecha_nacimiento;
				}
			],
			[
				'header'=>'Edad',
				'headerOptions'=>['class'=>'text-primary'],
				'format'=>'html',
				'value'=>function($model){
					return $model->getEdad();
				}
			],
			'lugar_nacimiento:text:Lugar de Nacimiento',
			[
				'label'=>'Estado Civil',
				'format'=>'text',
				'attribute'=>'estado_civil',
				'filter'=>$estado_civil,
				'value'=>function($data){
					return $data->getEstadoCivil();
				}
			],
			[
				'label'=>'Calle',
				'format'=>'text',
				'attribute'=>'nombre',
				'value'=>function($data){
					return $data->getCalle()['nombre'];
				}
			],
			[
				'label'=>'Casa',
				'format'=>'text',
				'attribute'=>'ncasa',
				'value'=>function($data){
					return $data->getCasa()['ncasa'];
				}
			],
			[
                'label'=>'Categoria',
                'format'=>'text',
                'attribute'=>'categoria',
                'filter'=>$categoria,
                'value'=>function($data){
                    return $data->getCategoria()['nombre'];
                }
            ],
		]
	]);?>
</div>
