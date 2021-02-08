<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "public.servicios".
 *
 * @property int $idserv
 * @property bool $luz
 * @property bool $aguasblancas
 * @property bool $gas
 * @property bool $cloacas
 * @property bool $internet
 * @property int $casa_id
 */
class Servicios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.servicios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['luz', 'aguasblancas', 'cloacas', 'internet', 'gas'], 'boolean'],
            /*[['luz'], function($attribute,$param){
                $this->luz = $this->luz[0];
            }],
            [['aguasblancas'], function($attribute,$param){
                $this->aguasblancas = $this->aguasblancas[0];
            }],
            [['cloacas'], function($attribute,$param){
                $this->cloacas = $this->cloacas[0];
            }],
            [['internet'], function($attribute,$param){
                $this->internet = $this->internet[0];
            }],
            [['gas'], function($attribute,$param){
                $this->gas = $this->gas[0];
            }],*/
            [['casa_id'], 'default', 'value' => null],
            [['casa_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idserv' => 'Idserv',
            'luz' => 'Luz',
            'aguasblancas' => 'Aguasblancas',
            'gas' => 'Gas',
            'cloacas' => 'Cloacas',
            'internet' => 'Internet',
            'casa_id' => 'Casa ID',
        ];
    }
}
