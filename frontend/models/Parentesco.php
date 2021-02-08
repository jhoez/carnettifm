<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "public.parentesco2".
 *
 * @property int $idpar
 * @property string $nombparent
 */
class Parentesco extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.parentesco';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombparent'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idpar' => 'Idpar',
            'nombparent' => 'Nombparent',
        ];
    }
}
