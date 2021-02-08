<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "public.estudios".
 *
 * @property int $idestu
 * @property int $nivelinstruccion
 * @property string $profesion
 * @property string $nombestudio
 */
class Estudios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.estudios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nivelinstruccion'],'required'],
            [['nivelinstruccion','profesion', 'nombestudio'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idestu' => 'Idestu',
            'nivelinstruccion' => 'Nivel de instrucción',
            'profesion' => 'Profesión',
            'nombestudio' => '¿Estudia? Especifique',
        ];
    }
}
