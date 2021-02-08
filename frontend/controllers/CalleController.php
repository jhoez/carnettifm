<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Calle;
use frontend\models\CalleForm;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

class CalleController extends Controller{
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
		$dataProvider=new ActiveDataProvider([
				'query'=>Calle::find(),
				'pagination'=>[
					'pageSize'=>yii::$app->params['max_per_page'],
				]
			]);
		return $this->render('index',['dataProvider'=>$dataProvider]);
	}

	public function actionNuevo(){
		$model=new CalleForm();
		if ($model->load(yii::$app->request->post())){
			if ($model->validate()){
				$calle=new Calle();
				$calle->nombre=strtoupper($model->nombre);
				$calle->save();
				yii::$app->session->setFlash('success','Se ha registrado la calle correctamente');
				return $this->redirect(['site/index']);
			}
		}
		return $this->render('nuevo',['model'=>$model]);
	}
}
?>