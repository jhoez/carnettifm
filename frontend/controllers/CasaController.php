<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use frontend\models\Calle;
use frontend\models\Casa;
use frontend\models\CasaForm;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\data\SqlDataProvider;

class CasaController extends Controller{
	public function behaviors(){
		return [
			'access'=>[
				'class'=>AccessControl::className(),
				'only'=>['index','nuevo'],
				'rules'=>[
					[
						'actions'=>['index','nuevo'],
						'allow'=>true,
						'roles'=>['@']
					]
				]
			]
		];
	}

	public function actionIndex(){
		$dataProvider=new SqlDataProvider([
				'sql'=>'
					select
						casa.id as id,
						casa.nombre as casa,
						calle.nombre as calle,
						pers.primer_nombre
					from casa
					right join direccion dir on casa.id = dir.casa_id
					right join calle on calle.id = dir.calle_id
					right join persona pers on dir.persona_id = pers.id
				',
				'pagination'=>[
					'pageSize'=>yii::$app->params['max_per_page'],
				],
				'sort'=>[
					'attributes'=>[
						'id'=>[
							'asc'=>['id'=>SORT_ASC],
							'desc'=>['id'=>SORT_DESC],
						],
						'casa'=>[
							'asc'=>['casa'=>SORT_ASC],
							'desc'=>['casa'=>SORT_DESC],
						],
						'calle'=>[
							'asc'=>['calle'=>SORT_ASC],
							'desc'=>['calle'=>SORT_DESC],
						]
					]
				]
			]);
		return $this->render('index',['dataProvider'=>$dataProvider]);
	}

	public function actionNuevo(){
		$model=new CasaForm();
		if ($model->load(yii::$app->request->post())){
			if ($model->validate()){
				$casa=new Casa();
				$casa->nombre=strtoupper($model->nombre);
				$casa->calle_id=$model->calle_id;
				$casa->save();
				yii::$app->session->setFlash('success','Se ha registrado la casa correctamente');
				return $this->redirect(['site/index']);
			}
		}
		$calles=ArrayHelper::map(Calle::find()->asArray()->all(),'id','nombre');
		return $this->render('nuevo',['model'=>$model,'calles'=>$calles]);
	}
}
?>
