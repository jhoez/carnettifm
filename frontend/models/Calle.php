<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "public.calle".
 *
 * @property int $id
 * @property string $nombre
 */
class Calle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.calle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 30, 'tooLong'=>'Este campo debe tener maximo {max} caracteres'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }
}
