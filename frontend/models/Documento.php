<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "public.documento".
 *
 * @property int $id
 * @property string $nombre
 * @property string $archivo
 * @property string $created_at
 * @property int $persona_id
 * @property int $usuario_id
 */
class Documento extends \yii\db\ActiveRecord
{
    public $files;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.documento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['created_at'], 'safe'],
            [['persona_id', 'usuario_id'], 'default', 'value' => null],
            [['persona_id', 'usuario_id'], 'integer'],
            [['nombre'], 'string', 'max' => 255,'tooLong'=>'Este campo debe tener maximo {max} caracteres'],
            [['archivo'], 'string', 'max' => 50],
            [
                'files','file',
                'extensions'=>['jpg','png','gif','pdf'],
                'wrongExtension'=>'No puedes subir este tipo de archivos, debe tener una extension valida (jpg, png, gif, pdf)',
                'skipOnEmpty'=>false,
                'uploadRequired'=>'No se ha podido cargar la imagen'
            ],
            [['persona_id'], 'exist', 'skipOnError' => true, 'targetClass' => Persona::className(), 'targetAttribute' => ['persona_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['usuario_id' => 'id']],
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
            'files' => 'Seleccione un archivo',
            'created_at' => 'Created At',
            'persona_id' => '',
            'usuario_id' => '',
        ];
    }
}
