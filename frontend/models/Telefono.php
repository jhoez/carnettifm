<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "public.telefono".
 *
 * @property int $idtelf
 * @property string $telffijo
 * @property string $telfmovil
 * @property int $persona_id
 */
class Telefono extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.telefono';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['telfmovil'],'required'],
            [['persona_id'], 'default', 'value' => null],
            [['persona_id'], 'integer'],
            [['telffijo', 'telfmovil'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtelf' => 'Id',
            'telffijo' => 'Telefono fijo',
            'telfmovil' => 'Telefono celular',
            'persona_id' => 'Persona',
        ];
    }
}
