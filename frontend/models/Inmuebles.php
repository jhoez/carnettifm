<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "public.inmuebles".
 *
 * @property int $idinm
 * @property string $lavadora
 * @property string $nevera
 * @property string $aireacondicionado
 * @property string $tv
 * @property string $computadora
 * @property string $camas
 * @property string $cocinas
 */
class Inmuebles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.inmuebles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lavadora', 'nevera', 'aireacondicionado', 'tv', 'computadora', 'camas', 'cocinas'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idinm' => 'Idinm',
            'lavadora' => '¿Cantidad de Lavadoras?',
            'nevera' => '¿Cantidad de Neveras?',
            'aireacondicionado' => '¿Cantidad de Aireacondicionados?',
            'tv' => '¿Cantidad de TV?',
            'computadora' => '¿Cantida de Computadoras?',
            'camas' => '¿Cantidad de Camas?',
            'cocinas' => '¿Cantidad de Cocinas?',
        ];
    }
}
