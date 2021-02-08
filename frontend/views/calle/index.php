<?php
use yii\helpers\Html;
use yii\grid\GridView;
$this->title='Calles registradas en el sistema';
?>
<h3 class="page-header"><?=Html::encode($this->title);?></h3>
<?=GridView::widget([
		'dataProvider'=>$dataProvider
	]);?>
<?=Html::a('Registrar calle',['calle/nuevo'],['class'=>'btn btn-primary btn-lg']);?>