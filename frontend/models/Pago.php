<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "public.pago".
 *
 * @property int $idpago
 * @property int $pagocasa
 * @property int $casa_id
 */
class Pago extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.pago';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pagocasa', 'casa_id'], 'default', 'value' => null],
            [['pagocasa', 'casa_id'], 'integer'],
            [['casa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Casa::className(), 'targetAttribute' => ['casa_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idpago' => 'Idpago',
            'pagocasa' => '¿Cuanto paga?',
            'casa_id' => 'Casa',
        ];
    }
}
