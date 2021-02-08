<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "public.discapacidad".
 *
 * @property int $iddisca
 * @property string $nombdisca
 * @property int $persona_id
 */
class Discapacidad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.discapacidad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombdisca'], 'string','max'=>255],
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
            'iddisca' => 'Id',
            'nombdisca' => 'Nombre de Discapacidad',
            'persona_id' => 'Persona',
        ];
    }
}
