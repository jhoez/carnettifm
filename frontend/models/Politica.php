<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "public.politica".
 *
 * @property int $idpoli
 * @property string $movsocial
 * @property string $mision
 * @property int $persona_id
 */
class Politica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.politica';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['persona_id'], 'default', 'value' => null],
            [['persona_id'], 'integer'],
            [['movsocial', 'mision'], 'string', 'max' => 255],
            [['persona_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['persona_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idpoli' => 'Idpoli',
            'movsocial' => '¿Participa en algún movimiento social? Especifique',
            'mision' => '¿Esta inscrito en alguna misión? Especifique',
            'persona_id' => 'Persona ID',
        ];
    }
}
