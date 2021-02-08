<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "public.familiar".
 *
 * @property int $idfam
 * @property int $persona_id
 * @property int $pareja_id
 * @property int $familiar_id
 * @property int $parentesco_id
 */
class Familiar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.familiar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['persona_id', 'pareja_id', 'familiar_id', 'parentesco_id'], 'default', 'value' => null],
            [['persona_id', 'pareja_id', 'familiar_id', 'parentesco_id'], 'integer'],
            [['parentesco_id'], 'exist', 'skipOnError' => true, 'targetClass' => Parentesco::className(), 'targetAttribute' => ['parentesco_id' => 'idpar']],
            [['persona_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['persona_id' => 'id']],
            [['pareja_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['pareja_id' => 'id']],
            [['familiar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['familiar_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idfam' => 'Idfam',
            'persona_id' => 'Persona ID',
            'pareja_id' => 'Pareja ID',
            'familiar_id' => 'Familiar ID',
            'parentesco_id' => 'Parentesco ID',
        ];
    }

    public function getfampareja()
    {
        return Persona::findOne(['id'=>$this->pareja_id]);
    }

    public function getfamparentesco()
    {
        return Parentesco::findOne(['idpar'=>$this->parentesco_id]);
    }
}
