<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

$this->title='Documentos de: '.$persona->cedula.' '.$persona->primer_nombre.' '.$persona->primer_apellido;
?>

<h3 class="page-header"><?=Html::encode($this->title);?></h3>
<?=GridView::widget([
		'dataProvider'=>$dataProvider,
		'columns'=>[
			[
				'class'=>'yii\\grid\\ActionColumn',
				'header'=>'Opciones',
				'headerOptions'=>['class'=>'text-primary'],
				'contentOptions'=>['width'=>'20%'],
				'buttons'=>[
					'descarga'=>function($url,$model,$id){
						return Html::a(Html::tag('span',null,['class'=>'glyphicon glyphicon-download']),['persona/descarga','id'=>$model->id]);
					},
					'vista'=>function($url,$model,$id){
						return Html::a(Html::tag('span',null,['class'=>'glyphicon glyphicon-eye-open']),['persona/vista','id'=>$model->id],['target'=>'_blank']);
					}
				],
				'template'=>'{descarga} {vista}'
			],
			'nombre:text:Documento'
		]
	]);?>

<div class="well">
	<?php $form=ActiveForm::begin([
		'id'=>'form',
		'enableClientValidation'=>true,
		'enableAjaxValidation'=>false,
		'options'=>['class'=>'form-horizontal']
	]);?>
	<?php $template='<div class="col-md-offset-3 col-md-2">{label}</div><div class="col-md-4">{input}{error}</div>';?>
	<?=$form->field($model,'id')->hiddenInput()->label(false);?>
	<?=$form->field($model,'nombre',['template'=>$template])->textInput();?>
	<?=$form->field($model,'archivo',['template'=>$template])->fileInput(['accept'=>'application/pdf,image/*']);?>
	<?=$form->field($model,'persona_id')->hiddenInput()->label(false);?>
	<?=$form->field($model,'usuario_id')->hiddenInput()->label(false);?>
	<div class="form-group">
			<div class="col-md-offset-3 col-md-6">
				<div class="btn-group">
					<?=Html::submitInput('Subir',['class'=>'btn btn-primary']);?>
					<?=Html::a('Listar datos de persona',['persona/editar','id'=>yii::$app->request->get('id')],['class'=>'btn btn-info']);?>
					<?=Html::a('Volver al listado',['persona/index'],['class'=>'btn btn-default ']);?>
				</div>
			</div>
	</div>
	<?php $form->end();?>
</div>