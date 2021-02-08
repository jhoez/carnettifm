<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "public.mascota".
 *
 * @property int $idmasc
 * @property bool $perro
 * @property bool $gato
 * @property bool $aves
 * @property bool $otros
 * @property int $persona_id
 */
class Mascota extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.mascota';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['perro', 'gato', 'aves', 'otros'], 'boolean'],
            /*['perro',function($model){
                $this->perro = $this->perro[0];
            }],
            ['gato',function($model){
                $this->gato = $this->gato[0];
            }],
            ['aves',function($model){
                $this->aves = $this->aves[0];
            }],
            ['otros',function($model){
                $this->otros = $this->otros[0];
            }],*/
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
            'idmasc' => 'Idmasc',
            'perro' => 'Perro',
            'gato' => 'Gato',
            'aves' => 'Aves',
            'otros' => 'Otros',
            'persona_id' => 'Persona ID',
        ];
    }
}
