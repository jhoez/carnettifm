<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "public.enfermedad".
 *
 * @property int $idenf
 * @property string $nombenf
 * @property string $tratamiento
 * @property int $persona_id
 */
class Enfermedad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.enfermedad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombenf','tratamiento'], 'string','max'=>255],
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
            'idenf' => 'Idenf',
            'nombenf' => '¿Padece alguna enfermedad? Especifique',
            'tratamiento' => '¿Toma tratamiento? Especifique',
            'persona_id' => 'Persona ID',
        ];
    }
}
