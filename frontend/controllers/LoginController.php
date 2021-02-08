<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Usuario;
use frontend\models\LoginForm;

class LoginController extends Controller{
	public $layout='login';
	public function actionIndex(){
		$model=new LoginForm();
		if ($model->load(yii::$app->request->post())){
			if ($model->validate()){
				$usuario = Usuario::find()->where(['username'=>$model->usuario])->andWhere(['password'=>$model->clave])->one();
				if ( $usuario['username'] == $model->usuario && $usuario['password'] == $model->clave ){
					yii::$app->user->login($usuario);
					yii::$app->session->setFlash('success','Ha ingresado al sistema correctamente');
					return $this->redirect(['site/index']);
				}else{
					yii::$app->session->setFlash('danger','Usuario o clave incorrectos');
					return $this->redirect(['login/index']);
				}
			}
		}
		return $this->render('index',['model'=>$model]);
	}

	public function actionLogout(){
		yii::$app->user->logout();
		return $this->redirect(['login/index']);
	}
}
?>
