<?php

namespace frontend\models;


use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "public.persona".
 *
 * @property int $id
 * @property string $nacionalidad
 * @property string $cedula
 * @property string $primer_nombre
 * @property string $segundo_nombre
 * @property string $primer_apellido
 * @property string $segundo_apellido
 * @property string $sexo
 * @property string $fecha_nacimiento
 * @property string $lugar_nacimiento
 * @property string $foto
 * @property string $created_at
 * @property string $updated_at
 * @property int $estado_civil_id
 * @property int $categoria_id
 * @property bool $jefefamilia
 * @property int $estudios_id
 * @property int $trabajo_id
 * @property int $usuario_id
 */
class Persona extends \yii\db\ActiveRecord
{
    public $img;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public.persona';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'nacionalidad',
                    'cedula',
                    'sexo',
                    'primer_nombre',
                    'primer_apellido',
                    'fecha_nacimiento',
                    'lugar_nacimiento',
                    'categoria_id',
                ], 'required'
            ],
            [
                ['img'],'file',
                'skipOnEmpty'=>false,
                'uploadRequired'=>'No has seleccionado ningun ARCHIVO',// error
                'mimeTypes'=>'image/*',
                'extensions'=>'jpg,jpeg,png',
                'wrongExtension'=>'La extension del archivo es incorrecta',
                'wrongMimeType'=>'El archivo que intenta subir no es una foto'
            ],
            [['fecha_nacimiento', 'created_at', 'updated_at'], 'safe'],
            [['estado_civil_id', 'categoria_id', 'estudios_id', 'trabajo_id', 'usuario_id'], 'default', 'value' => null],
            [['estado_civil_id', 'categoria_id', 'estudios_id', 'trabajo_id', 'usuario_id'], 'integer'],
            [['jefefamilia'], 'boolean'],
            [['nacionalidad', 'sexo'], 'string', 'max' => 1],
            [['cedula'], 'unique','message'=>'La cedula ya existe en base de datos!!'],
            [['cedula'], 'string', 'max' => 10],
            [['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido'], 'string', 'max' => 20],
            [['foto','lugar_nacimiento'], 'string', 'max' => 255],
            [[], 'string', 'max' => 30],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['categoria_id' => 'id']],
            [['estado_civil_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoCivil::className(), 'targetAttribute' => ['estado_civil_id' => 'id']],
            [['estudios_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estudios::className(), 'targetAttribute' => ['estudios_id' => 'idestu']],
            [['trabajo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Trabajo::className(), 'targetAttribute' => ['trabajo_id' => 'idtrabajo']],
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
            'nacionalidad' => 'Nacionalidad',
            'cedula' => 'Cedula',
            'primer_nombre' => 'Primer Nombre',
            'segundo_nombre' => 'Segundo Nombre',
            'primer_apellido' => 'Primer Apellido',
            'segundo_apellido' => 'Segundo Apellido',
            'sexo' => 'Sexo',
            'fecha_nacimiento' => 'Fecha de Nacimiento',
            'lugar_nacimiento' => 'Lugar de Nacimiento',
            'img' => 'Foto',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'estado_civil_id' => 'Estado Civil',
            'categoria_id' => 'Categoria',
            'estudios_id' => '',
            'jefefamilia' => 'Jefe de Familia',
            'usuario_id' => '',
        ];
    }

    public function getEstadoCivil(){
		return EstadoCivil::findOne(['id'=>$this->estado_civil_id])['nombre'];
	}

	public function getCasa(){
		return Casa::findOne(['id' => Direccion::findOne(['persona_id'=>$this->id])['casa_id']]);
	}

    public function getCalle(){
		return Calle::findOne(['id' => Direccion::findOne(['persona_id'=>$this->id])['calle_id']]);
	}

	public function getCategoria(){
		return Categoria::findOne(['id'=>$this->categoria_id]);
	}

	public function getEdad(){
		$hoy=explode('-',date('Y-m-d'));
		$nac=explode('-',date('Y-m-d',strtotime($this->fecha_nacimiento)));
		$edad=$hoy[0]-$nac[0];
		if ( $hoy[1] == $nac[1] && $hoy[2] == $nac[2] ){
            return $edad;
		}else{
            return $edad-=1;
        }
	}

    public function getparentfami()
    {
        return Familiar::findOne(['familiar_id'=>$this->id]);
    }

    public function getparentpareja()
    {
        return Familiar::findOne(['persona_id'=>$this->id]);
    }

    public function gettelf()
    {
        return Telefono::find()->where(['persona_id'=>$this->id])->all();
    }

    public function gettrabajo()
    {
        return Trabajo::findOne(['idtrabajo'=>$this->trabajo_id]);
    }

    public function getenfermedad()
    {
        return Enfermedad::findOne(['persona_id'=>$this->id]);
    }

    public function getdiscapacidad()
    {
        return Discapacidad::findOne(['persona_id'=>$this->id]);
    }

    public function getdireccion()
    {
        return Direccion::findOne(['persona_id'=>$this->id]);
    }

    public function getestudios()
    {
        return Estudios::findOne(['idestu'=>$this->estudios_id]);
    }

    public function getpruebacovid()
    {
        return Pruebacovid::find()->where(['persona_id'=>$this->id])->all();
    }

    public function getembneg()
    {
        return Embarcacionnegocio::findOne(['persona_id'=>$this->id]);
    }

    public function getmascota()
    {
        return Mascota::find()->where(['persona_id'=>$this->id])->one();
    }
}
