<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "public.direccion".
 *
 * @property int $iddir
 * @property int $persona_id
 * @property int $casa_id
 * @property int $calle_id
 */
class Direccion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.direccion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['calle_id'], 'required'],
            [['persona_id', 'casa_id', 'calle_id'], 'default', 'value' => null],
            [['persona_id', 'casa_id', 'calle_id'], 'integer'],
            [['calle_id'], 'exist', 'skipOnError' => true, 'targetClass' => Calle::className(), 'targetAttribute' => ['calle_id' => 'id']],
            [['casa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Casa::className(), 'targetAttribute' => ['casa_id' => 'id']],
            [['persona_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['persona_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iddir' => 'Iddir',
            'persona_id' => 'Persona',
            'casa_id' => 'Casa',
            'calle_id' => 'Calle',
        ];
    }

    public function getcasa()
    {
        return Casa::findOne(['id'=>$this->casa_id]);
    }

    public function getcalle()
    {
        return Calle::findOne(['id'=>$this->calle_id]);
    }
}
