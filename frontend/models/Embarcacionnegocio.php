<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "public.embarcacionnegocio".
 *
 * @property int $idembneg
 * @property bool $posee_emb
 * @property bool $propietario
 * @property string $datosdueno
 * @property bool $operativa
 * @property string $matricula
 * @property string $poseenegocio
 * @property bool $poseeconcesion
 * @property int $persona_id
 */
class Embarcacionnegocio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.embarcacionnegocio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['posee_emb', 'propietario', 'operativa', 'poseeconcesion'], 'boolean'],
            /*[['posee_emb'], function($attribute,$param){
                $this->posee_emb = $this->posee_emb[0];
            }],
            [['propietario'], function($attribute,$param){
                $this->propietario = $this->propietario[0];
            }],
            [['operativa'], function($attribute,$param){
                $this->operativa = $this->operativa[0];
            }],
            [['poseeconcesion'], function($attribute,$param){
                $this->poseeconcesion = $this->poseeconcesion[0];
            }],*/
            [['persona_id'], 'default', 'value' => null],
            [['persona_id'], 'integer'],
            [['datosdueno', 'matricula', 'poseenegocio'], 'string', 'max' => 255],
            [['persona_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['persona_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idembneg' => 'Id',
            'posee_emb' => '¿Poseé Embarcación?',
            'propietario' => '¿Es propietario?',
            'datosdueno' => 'Datos del dueño',
            'operativa' => '¿Esta operativa?',
            'matricula' => 'Matricula de la Embarcación',
            'poseenegocio' => '¿Posee negocio en los Roques? Especifique',
            'poseeconcesion' => '¿Poseé concesión?',
            'persona_id' => 'Persona',
        ];
    }
}
