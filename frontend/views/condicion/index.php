<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CondicionislaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Personal penalizado';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="condicionisla-index">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class'=>'yii\\grid\\ActionColumn',
                'header'=>'Acciones',
                'headerOptions'=>['class'=>'text-primary'],
                'template'=>'{marcar}{view}',
                'buttons'=>[
                    'marcar'=>function($id,$model,$url){
                        return Html::a(
                            Html::tag(
                                'span',
                                null,
                                ['class'=>'glyphicon glyphicon-file']
                            ),
                            ['condicion/marcarpersonal','id'=>$model->id]
                        );
                    },
                    'view'=>function($id,$model,$url){
                        return Html::a(
                            Html::tag(
                                'span',
                                null,
                                ['class'=>'glyphicon glyphicon-plus']
                            ),
                            ['condicion/familiar','id'=>$model->id]
                        );
                    },
                ],
            ],
            ['class' => 'yii\grid\SerialColumn'],
            'persona_id',
            'status',
            'f_registro',
            'time_expulsion',
        ],
    ]); ?>


</div>
