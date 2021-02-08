<?php
namespace frontend\models;

use Yii;
use yii\base\Model;

class ClaveForm extends Model{
	public $clave_anterior;
	public $clave_nueva;
	public $repetir_clave;

	public function rules(){
		return [
			[['clave_anterior','clave_nueva','repetir_clave'],'required','message'=>'Campo requerido'],
			['clave_anterior','exist','targetClass'=>'frontend\\models\\Usuario','filter'=>function($model){
				return $model->where(['id'=>yii::$app->user->identity->id,'clave'=>md5($this->clave_anterior)]);
			},'message'=>'Clave incorrecta'],
			['clave_nueva','compare','compareAttribute'=>'clave_anterior','operator'=>'!=','message'=>'La nueva clave debe ser distinta a la clave anterior'],
			['repetir_clave','compare','compareAttribute'=>'clave_nueva','operator'=>'==','message'=>'No coinciden ambas claves']
		];
	}

	public function attributeLabels(){
		return [
			'clave_anterior'=>'Introduzca su clave actual',
			'clave_nueva'=>'Introduzca su nueva clave',
			'repetir_clave'=>'Introduzca de nuevo la nueva clave'
		];
	}
}
?>