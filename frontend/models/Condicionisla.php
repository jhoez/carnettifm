<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "public.condicionisla".
 *
 * @property int $idcond
 * @property string $status
 * @property string $f_registro
 * @property string $time_expulsion
 * @property int $persona_id
 */
class Condicionisla extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.condicionisla';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['f_registro'], 'safe'],
            [['persona_id'], 'default', 'value' => null],
            [['persona_id'], 'integer'],
            [['status', 'time_expulsion'], 'string', 'max' => 10],
            [['persona_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['persona_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcond' => 'Idcond',
            'status' => 'Status',
            'f_registro' => 'F Registro',
            'time_expulsion' => 'Time Expulsion',
            'persona_id' => 'Persona ID',
        ];
    }
}
