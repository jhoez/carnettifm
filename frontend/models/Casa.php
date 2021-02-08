<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "public.casa".
 *
 * @property int $id
 * @property string $nombre
 * @property string $ncasa
 * @property string $tipcasa
 * @property bool $bano
 * @property bool $cuarto
 * @property bool $sala
 * @property bool $comedor
 * @property string $tippiso
 * @property string $tipconstruccion
 * @property string $tiptecho
 * @property int $inmuebles_id
 */
class Casa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.casa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre','ncasa'], 'required'],
            [['alquilada', 'bano', 'cuarto', 'sala', 'comedor'], 'boolean'],
            /*[['alquilada'], function($attribute,$param){
                $this->alquilada = $this->alquilada[0];
            }],
            [['bano'], function($attribute,$param){
                $this->bano = $this->bano[0];
            }],
            [['cuarto'], function($attribute,$param){
                $this->cuarto = $this->cuarto[0];
            }],
            [['sala'], function($attribute,$param){
                $this->sala = $this->sala[0];
            }],
            [['comedor'], function($attribute,$param){
                $this->comedor = $this->comedor[0];
            }],*/
            [['inmuebles_id'], 'default', 'value' => null],
            [['inmuebles_id'], 'integer'],
            [['nombre'], 'string', 'max' => 30,'tooLong'=>'Este campo debe tener maximo {max} caracteres'],
            [['ncasa'], 'string', 'max' => 10],
            [['tipcasa'], 'string', 'max' => 100],
            [['tippiso', 'tipconstruccion', 'tiptecho'], 'string', 'max' => 255],
            [['inmuebles_id'], 'exist', 'skipOnError' => true, 'targetClass' => Inmuebles::className(), 'targetAttribute' => ['inmuebles_id' => 'idinm']],
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
            'ncasa' => 'N# de Casa',
            'tipcasa' => '¿La Vivienda es?',
            'banos' => '¿Cuantos Baños tiene',
            'cuartos' => '¿Cuantos Cuartos tiene?',
            'sala' => '¿Sala',
            'comedor' => 'Comedor',
            'tippiso' => 'Tipo de piso',
            'tipconstruccion' => 'Tipo de construccion',
            'tiptecho' => 'Tipo de techo',
        ];
    }

    public function getinmuebles()
    {
        return Inmuebles::findOne(['idinm'=>$this->inmuebles_id]);
    }

    public function getpago()
    {
        return Pago::findOne(['idpago'=>$this->id]);
    }

    public function getservicios()
    {
        return Servicios::findOne(['casa_id'=>$this->id]);
    }
}
