<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "public.trabajo".
 *
 * @property int $idtrabajo
 * @property bool $trabaja
 * @property string $antiguedad
 * @property string $lugartrabajo
 * @property string $sueldomensual
 * @property string $cargo
 */
class Trabajo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.trabajo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['trabaja'], 'boolean'],
            [['trabaja'], function($attribute,$param){
                $this->trabaja = $this->trabaja[0];
            }],
            [['sueldomensual'], 'integer'],
            [['antiguedad'], 'string', 'max' => 2],
            [['lugartrabajo', 'cargo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtrabajo' => 'Id',
            'trabaja' => 'Trabaja',
            'antiguedad' => 'Antiguedad',
            'lugartrabajo' => 'Lugar de trabajo',
            'sueldomensual' => 'Ingreso mensual',
            'cargo' => 'Cargo',
        ];
    }
}
