<?php

namespace frontend\models;

use Yii;

class Personapareja extends \yii\db\ActiveRecord
{
    public $cedulapareja;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.persona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['cedulapareja'],'required'],
            [['cedulapareja'], 'string', 'max' => 10],
            //['cedulapareja','validacionCedulaPareja']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cedulapareja' => 'Cedula de la Pareja',
        ];
    }

    //luego se crea el metodo de Validacion Ajax
    public function validacionCedulaPareja($attribute,$params)
    {
        //SE CREA LA LOGICA QUE SE NECESITE
        $persona = Persona::find()->where(['cedula'=>$this->cedulapareja])->count();
        if ( $persona == '0' ) {
            if ($attribute) {
                $this->addError($attribute,'La persona con la siguiente cedula '.$this->cedulapareja.' no esta registrada!!');
            }
        }
    }
}
