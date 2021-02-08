<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "public.pruebacovid".
 *
 * @property int $idcovid
 * @property bool $prueba_1
 * @property string $f_prueba1
 * @property bool $resultado1
 * @property int $persona_id
 */
class Pruebacovid extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.pruebacovid';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['prueba_1', 'resultado1'], 'boolean'],
            [['prueba_1'], function($attribute,$param){
                $this->prueba_1 = $this->prueba_1[0];
            }],
            [['resultado1'], function($attribute,$param){
                $this->resultado1 = $this->resultado1[0];
            }],
            [['f_prueba1'], 'safe'],
            [['persona_id'], 'default', 'value' => null],
            [['persona_id'], 'integer'],
            [['persona_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['persona_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcovid' => 'Id',
            'prueba_1' => 'Prueba',
            'f_prueba1' => 'Fecha de prueba',
            'resultado1' => 'Resultado',
            'persona_id' => 'Persona',
        ];
    }

    public function getpersona()
    {
        return Persona::find()->where(['id'=>$this->persona_id])->all();
    }
}
