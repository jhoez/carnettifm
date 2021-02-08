<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\ArrayHelper;
use yii\base\ErrorException;
use yii\web\BadRequestHttpException;
use frontend\models\Persona;
use frontend\models\PersonaSearch;
use frontend\models\Personapareja;
use frontend\models\Personafamiliar;
use frontend\models\PersonafamiliarSearch;
use frontend\models\Telefono;
use frontend\models\Familiar;
use frontend\models\Parentesco;
use frontend\models\Estudios;
use frontend\models\Calle;
use frontend\models\Casa;
use frontend\models\Inmuebles;
use frontend\models\Mascota;
use frontend\models\Servicios;
use frontend\models\Discapacidad;
use frontend\models\Direccion;
use frontend\models\Enfermedad;
use frontend\models\Pruebacovid;
use frontend\models\Politica;
use frontend\models\Trabajo;
use frontend\models\Categoria;
use frontend\models\EstadoCivil;
use frontend\models\Documento;
use frontend\models\NivelInstruccion;
use frontend\models\Embarcacionnegocio;
use frontend\models\Pago;
use yii\web\Response;
use yii\widgets\ActiveForm;
use kartik\mpdf\Pdf;

class PersonaController extends Controller{
	public function behaviors(){
		return [
			'access'=>[
				'class'=>AccessControl::className(),
				'only'=>['index','nuevo','editar','reporte','documento','descarga','vista'],
				'rules'=>[
					[
						'actions'=>['index','nuevo','editar','reporte','documento','descarga','vista','familiar'],
						'allow'=>true,
						'roles'=>['@']
					]
				]
			]
		];
	}

	public function actionIndex(){
		$searchModel = new PersonaSearch;
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andFilterWhere(['jefefamilia'=>true]);

		$estado_civil=ArrayHelper::map(EstadoCivil::find()->asArray()->all(),'nombre','nombre');
		$categoria=ArrayHelper::map(Categoria::find()->asArray()->all(),'nombre','nombre');

		return $this->render('index',[
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
			'estado_civil'=>$estado_civil,
			'categoria'=>$categoria
		]);
	}

	public function actionNuevo(){
		$persona = new Persona;
		$personapareja = new Personapareja;
		$telefono = new Telefono;
		$estudios = new Estudios;
		$trabajo = new Trabajo;
		$enfermedad = new Enfermedad;
		$pruebacovid = new Pruebacovid;
		$discapacidad = new Discapacidad;
		$politica = new Politica;
		$casa = new Casa;
		$direccion = new Direccion;
		$pago = new Pago;
		$inmuebles = new Inmuebles;
		$mascota = new Mascota;
		$servicios = new Servicios;
		$embneg	= new Embarcacionnegocio;
		$parentesco = new Parentesco;
		$familiar = new Familiar;

		$cedula = ArrayHelper::getColumn(Persona::find()->all(),'cedula');
		$calle=ArrayHelper::map(Calle::find()->asArray()->all(),'id','nombre');
		$categoria=ArrayHelper::map(Categoria::find()->asArray()->all(),'id','nombre');
		$estado_civil=ArrayHelper::map(EstadoCivil::find()->asArray()->all(),'id','nombre');
		$nivel_instruccion=ArrayHelper::map(NivelInstruccion::find()->asArray()->all(),'nombre','nombre');

		/*if ($personapareja->load(yii::$app->request->post()) && Yii::$app->request->isAjax) {
		    Yii::$app->response->format = Response::FORMAT_JSON;
		    return ActiveForm::validate($personapareja);
		}*/

		if (
			$persona->load(yii::$app->request->post()) &&
			$personapareja->load(yii::$app->request->post()) &&
			$parentesco->load(yii::$app->request->post()) &&
			$telefono->load(yii::$app->request->post()) &&
			$estudios->load(yii::$app->request->post()) &&
			$trabajo->load(yii::$app->request->post()) &&
			$enfermedad->load(yii::$app->request->post()) &&
			$pruebacovid->load(yii::$app->request->post()) &&
			$discapacidad->load(yii::$app->request->post()) &&
			$politica->load(yii::$app->request->post()) &&
			$casa->load(yii::$app->request->post()) &&
			$direccion->load(yii::$app->request->post()) &&
			$pago->load(yii::$app->request->post()) &&
			$inmuebles->load(yii::$app->request->post()) &&
			$mascota->load(yii::$app->request->post()) &&
			$servicios->load(yii::$app->request->post()) &&
			$embneg->load(yii::$app->request->post())
		){
			$persona->img = UploadedFile::getInstance($persona,'img');

			if (
				$persona->validate() &&
				$personapareja->validate() &&
				$parentesco->validate() &&
				$telefono->validate() &&
				$estudios->validate() &&
				$trabajo->validate() &&
				$enfermedad->validate() &&
				$pruebacovid->validate() &&
				$discapacidad->validate() &&
				$politica->validate() &&
				$casa->validate() &&
				$direccion->validate() &&
				$pago->validate() &&
				$inmuebles->validate() &&
				$mascota->validate() &&
				$servicios->validate() &&
				$embneg->validate()
			){
				$transaction = $embneg->db->beginTransaction();
				try {
					if ($trabajo->save()) {
						if ( $estudios->save() ) {
							$persona->foto				= $persona->img->baseName.'.'.$persona->img->extension;
							$persona->primer_nombre		= strtoupper($persona->primer_nombre);
							$persona->segundo_nombre	= strtoupper($persona->segundo_nombre);
							$persona->primer_apellido	= strtoupper($persona->primer_apellido);
							$persona->segundo_apellido	= strtoupper($persona->segundo_apellido);
							$persona->lugar_nacimiento	= strtoupper($persona->lugar_nacimiento);
							$persona->created_at		= date('Y-m-d H:i:s');
							$persona->updated_at		= date('Y-m-d H:i:s');
							$persona->estudios_id		= $estudios->idestu;
							$persona->trabajo_id		= $trabajo->idtrabajo;
							$persona->usuario_id		= yii::$app->user->identity->id;
							if( $persona->save() ){
								if ( $parentesco->save() ) {
									$pareja = Persona::find()->where(['cedula'=>$personapareja->cedulapareja])->one();
									$familiar->pareja_id = ($pareja != null || $pareja != []) ? $pareja->id : null;
									$familiar->persona_id = $persona->id;
									$familiar->parentesco_id = $parentesco->idpar;
									if ($familiar->pareja_id == null) {
										$familiar->cedula = $personapareja->cedulapareja;
									}
									if ( $familiar->save() ) {
										$telefono->persona_id = $persona->id;
										if ( $telefono->save() ) {
											$enfermedad->persona_id = $persona->id;
											if ( $enfermedad->save() ) {
												$pruebacovid->persona_id = $persona->id;
												if ( $pruebacovid->save() ) {
													$discapacidad->persona_id = $persona->id;
													if ( $discapacidad->save() ) {
														$politica->persona_id = $persona->id;
														if ( $politica->save() ) {
															if ( $inmuebles->save() ) {
																$mascota->persona_id = $persona->id;
																if ( $mascota->save() ) {
																	$casa->inmuebles_id = $inmuebles->idinm;
																	if ( $casa->save() ) {
																		$casa->tipcasa == 'alquilada' ? $pago->save() : '';
																		$direccion->persona_id = $persona->id;
																		$direccion->casa_id = $casa->id;
																		if ( $direccion->save() ) {
																			$servicios->casa_id = $casa->id;
																			if ( $servicios->save() ) {
																				$embneg->persona_id = $persona->id;
																				if ( $embneg->save() ) {
																					$persona->img->saveAs(yii::getAlias('@webroot/foto/'.$persona->foto));
																					Yii::$app->session->setFlash('success','Se ha guardado correctamente: '.$persona->primer_nombre.' - '.$persona->primer_apellido);
																					$transaction->commit();
																					return $this->redirect(['persona/familiar','id'=>$persona->id]);
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				} catch (ErrorException $e) {
					$transaction->rollback();
					Yii::$app->session->setFlash('error','No se logro registrar los datos!!');
				}

				if ( !empty($_SESSION['idpersona']) ) {
					unset($_SESSION['idpersona']);
				}

			}//if validate
		}// if load post

		return $this->render('nuevo',[
			'persona'=>$persona,
			'personapareja'=>$personapareja,
			'cedula'=>$cedula,
			'parentesco'=>$parentesco,
			'telefono'=>$telefono,
			'estudios'=>$estudios,
			'trabajo'=>$trabajo,
			'enfermedad' => $enfermedad,
			'pruebacovid' => $pruebacovid,
			'discapacidad' => $discapacidad,
			'politica' => $politica,
			'casa'=>$casa,
			'direccion'=>$direccion,
			'pago'=>$pago,
			'inmuebles'=>$inmuebles,
			'mascota'=>$mascota,
			'servicios'=>$servicios,
			'embneg'=>$embneg,
			'categoria'=>$categoria,
			'estado_civil'=>$estado_civil,
			'calle'=>$calle,
			'nivel_instruccion'=>$nivel_instruccion,
		]);
	}

	public function actionFamiliar()
	{
		$purifier = new HtmlPurifier;
		$_SESSION['idpersona'] = $purifier->process( Yii::$app->request->get('id') );
		$personafamiliar = new Personafamiliar;
		$telefono = new Telefono;
		$parentesco = new Parentesco;
		$familiar = new Familiar;
		$estudios = new Estudios;

		$categoria=ArrayHelper::map(Categoria::find()->asArray()->all(),'id','nombre');
		$estado_civil=ArrayHelper::map(EstadoCivil::find()->asArray()->all(),'id','nombre');
		$nivel_instruccion=ArrayHelper::map(NivelInstruccion::find()->asArray()->all(),'nombre','nombre');

		if (
			$personafamiliar->load(Yii::$app->request->post()) &&
			$familiar->load(Yii::$app->request->post()) &&
			$telefono->load(Yii::$app->request->post()) &&
			$parentesco->load(Yii::$app->request->post()) &&
			$estudios->load(Yii::$app->request->post())
		) {
			//echo "<pre>";var_dump( yii::$app->request->post() );die;
			if (
				$personafamiliar->validate() &&
				$familiar->validate() &&
				$telefono->validate() &&
				$parentesco->validate() &&
				$estudios->validate()
			) {
				if ( $estudios->save() ) {
					$personafamiliar->created_at = date('Y-m-d');
					$personafamiliar->updated_at = date('Y-m-d');
					$personafamiliar->jefefamilia = false;
					$personafamiliar->estudios_id = $estudios->idestu;
					$personafamiliar->usuario_id = Yii::$app->user->identity->id;
					if ( $personafamiliar->save() ) {
						$telefono->persona_id = $personafamiliar->id;
						if ( $telefono->save() ) {
							if ( $parentesco->save() ) {
								$familiar->persona_id = $_SESSION['idpersona'];
								$familiar->familiar_id = $personafamiliar->id;
								$familiar->parentesco_id = $parentesco->idpar;
								if ( $familiar->save() ) {
									Yii::$app->session->setFlash('success','Se ha guardado el familiar: '. $personafamiliar->primer_nombre.' - '.$personafamiliar->primer_apellido);
									return $this->redirect(['/persona/familiar']);
								}
							}
						}
					}
				}
			}
		}

		return $this->render('familiar',[
			'personafamiliar'=>$personafamiliar,
			'familiar'=>$familiar,
			'telefono'=>$telefono,
			'parentesco'=>$parentesco,
			'estudios'=>$estudios,
			'categoria'=>$categoria,
			'estado_civil'=>$estado_civil,
			'nivel_instruccion'=>$nivel_instruccion,
		]);
	}

	public function actionEditarfamiliar()
	{
		$purifier = new HtmlPurifier;
		$param = $purifier->process( Yii::$app->request->get('id') );
		$personafamiliar = Personafamiliar::findOne(['id'=>$param]);
		$familiar = Familiar::find()->where(['familiar_id'=>$personafamiliar->id])->one();
		$parentesco = Parentesco::find()->where(['idpar'=>$familiar->parentesco_id])->one();
		$telefono = Telefono::find()->where(['persona_id'=>$personafamiliar->id])->one();
		$estudios = Estudios::find()->where(['idestu'=>$personafamiliar->estudios_id])->one();

		$categoria=ArrayHelper::map(Categoria::find()->asArray()->all(),'id','nombre');
		$estado_civil=ArrayHelper::map(EstadoCivil::find()->asArray()->all(),'id','nombre');
		$nivel_instruccion=ArrayHelper::map(NivelInstruccion::find()->asArray()->all(),'nombre','nombre');

		if (
			$personafamiliar->load(Yii::$app->request->post()) &&
			$familiar->load(Yii::$app->request->post()) &&
			$telefono->load(Yii::$app->request->post()) &&
			$parentesco->load(Yii::$app->request->post()) &&
			$estudios->load(Yii::$app->request->post())
		) {
			if (
				$personafamiliar->validate() &&
				$familiar->validate() &&
				$telefono->validate() &&
				$parentesco->validate() &&
				$estudios->validate()
			) {
				if ( $estudios->save() ) {
					$personafamiliar->created_at = date('Y-m-d');
					$personafamiliar->updated_at = date('Y-m-d');
					$personafamiliar->jefefamilia = false;
					$personafamiliar->estudios_id = $estudios->idestu;
					$personafamiliar->usuario_id = Yii::$app->user->identity->id;
					if ( $personafamiliar->save() ) {
						$telefono->persona_id = $personafamiliar->id;
						if ( $telefono->save() ) {
							if ( $parentesco->save() ) {
								if ( $familiar->save() ) {
									Yii::$app->session->setFlash('success','Se ha Actualizado el familiar: '. $personafamiliar->primer_nombre.' - '.$personafamiliar->primer_apellido);
									return $this->redirect(['/persona/familiar']);
								}
							}
						}
					}
				}
			}
		}

		return $this->render('editarfamiliar',[
			'personafamiliar'=>$personafamiliar,
			'familiar'=>$familiar,
			'telefono'=>$telefono,
			'parentesco'=>$parentesco,
			'estudios'=>$estudios,
			'categoria'=>$categoria,
			'estado_civil'=>$estado_civil,
			'nivel_instruccion'=>$nivel_instruccion,
		]);
	}

	public function actionGrupofamiliar()
	{
		$purifier = new HtmlPurifier;
		$param = $purifier->process(Yii::$app->request->get('id'));
		$persona = Persona::findOne(['id'=>$param]);
		$parentesco = ArrayHelper::getColumn(
			Familiar::find()->where(['persona_id'=>$persona->id])->all(),
			'familiar_id'
		);

		$categoria = ArrayHelper::map(Categoria::find()->asArray()->all(),'id','nombre');
		$estado_civil = ArrayHelper::map(EstadoCivil::find()->asArray()->all(),'id','nombre');

		//	MUESTRA LOS HIJOS
		$searchModelh = new PersonaSearch;
        $dataProviderh = $searchModelh->search(Yii::$app->request->queryParams);
		$dataProviderh->query->from(['public.persona pers'])->where(['IN','id',$parentesco])->join(
			'INNER JOIN',
			'public.familiar f',
			'pers.id = f.familiar_id'
		);
		$dataProviderh->query->join(
			'INNER JOIN',
			'public.parentesco p',
			'f.parentesco_id = p.idpar'
		);
		$dataProviderh->query->andFilterWhere(['nombparent'=>'hijo/a']);
		// MUESTRA LOS FAMILIARES
		$searchModel = new PersonafamiliarSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->from(['public.persona pers'])->where(['IN','id',$parentesco])->join(
			'INNER JOIN',
			'public.familiar f',
			'pers.id = f.familiar_id'
		);
		$dataProvider->query->join(
			'INNER JOIN',
			'public.parentesco p',
			'f.parentesco_id = p.idpar'
		);
		$dataProvider->query->andFilterWhere(['!=','nombparent','hijo/a']);

		return $this->render('grupofamiliar',[
			'persona'=>$persona,
			'searchModelh'=>$searchModelh,
			'dataProviderh'=>$dataProviderh,
			'searchModel'=>$searchModel,
			'dataProvider'=>$dataProvider,
			'categoria'=>$categoria,
			'estado_civil'=>$estado_civil,
		]);
	}

	public function actionPruebacovid()
	{
		$pruebacovid = new Pruebacovid;
		$purifier = new HtmlPurifier;
		$param = $purifier->process( Yii::$app->request->get('id') );

		if ( $pruebacovid->load(Yii::$app->request->post()) ) {
			if ( $pruebacovid->validate() ) {
				if ( $pruebacovid->save() ) {
					Yii::$app->session->setFlash('success','Fue registrado con existo!!');
					return $this->redirect(['pruebacovid']);
				}
			}
		}

		return $this->render('pruebacovid',[
			'param'=>$param,
			'pruebacovid'=>$pruebacovid
		]);
	}

	public function actionEditar(){
		$purifier = new HtmlPurifier;
		$param = $purifier->process( Yii::$app->request->get('id') );
		$persona = Persona::findOne(['id'=>$param]);
		$familiar = Familiar::find()->where(['persona_id'=>$persona->id])->one();
		$parentesco = Parentesco::find()->where(['idpar'=>$familiar->parentesco_id])->one();
		$telefono = Telefono::find()->where(['persona_id'=>$persona->id])->one();
		$estudios = Estudios::find()->where(['idestu'=>$persona->estudios_id])->one();
		$trabajo = Trabajo::find()->where(['idtrabajo'=>$persona->trabajo_id])->one();
		$enfermedad = Enfermedad::find()->where(['persona_id'=>$persona->id])->one();
		$discapacidad = Discapacidad::find()->where(['persona_id'=>$persona->id])->one();
		$politica = Politica::find()->where(['persona_id'=>$persona->id])->one();
		$direccion = Direccion::find()->where(['persona_id'=>$persona->id])->one();
		$casa = Casa::find()->where(['id'=>$direccion->casa_id])->one();
		$pago = Pago::find()->where(['casa_id'=>$casa->id])->one() != null ?
			Pago::find()->where(['casa_id'=>$casa->id])->one() :
			new Pago();
		$mascota = Mascota::find()->where(['persona_id'=>$persona->id])->one();
		$inmuebles = Inmuebles::find()->where(['idinm'=>$casa->inmuebles_id])->one();
		$servicios = Servicios::find()->where(['casa_id'=>$casa->id])->one();
		$embneg	= Embarcacionnegocio::find()->where(['persona_id'=>$persona->id])->one();

		$categoria=ArrayHelper::map(Categoria::find()->asArray()->all(),'id','nombre');
		$estado_civil=ArrayHelper::map(EstadoCivil::find()->asArray()->all(),'id','nombre');
		$nivel_instruccion=ArrayHelper::map(NivelInstruccion::find()->asArray()->all(),'nombre','nombre');
		$calle=ArrayHelper::map(Calle::find()->asArray()->all(),'id','nombre');

		if (
			$persona->load(yii::$app->request->post()) &&
			$familiar->load(yii::$app->request->post()) &&
			$parentesco->load(yii::$app->request->post()) &&
			$telefono->load(yii::$app->request->post()) &&
			$estudios->load(yii::$app->request->post()) &&
			$trabajo->load(yii::$app->request->post()) &&
			$enfermedad->load(yii::$app->request->post()) &&
			$discapacidad->load(yii::$app->request->post()) &&
			$politica->load(yii::$app->request->post()) &&
			$direccion->load(yii::$app->request->post()) &&
			$casa->load(yii::$app->request->post()) &&
			$pago->load(yii::$app->request->post()) &&
			$mascota->load(yii::$app->request->post()) &&
			$inmuebles->load(yii::$app->request->post()) &&
			$servicios->load(yii::$app->request->post()) &&
			$embneg->load(yii::$app->request->post())
		){

			$persona->img = UploadedFile::getInstance($persona,'img');

			if (
				$persona->validate() &&
				$familiar->validate() &&
				$parentesco->validate() &&
				$telefono->validate() &&
				$estudios->validate() &&
				$trabajo->validate() &&
				$enfermedad->validate() &&
				$discapacidad->validate() &&
				$politica->validate() &&
				$direccion->validate() &&
				$casa->validate() &&
				$pago->validate() &&
				$mascota->validate() &&
				$inmuebles->validate() &&
				$servicios->validate() &&
				$embneg->validate()
			){
				$transaction = $embneg->db->beginTransaction();
				try {
					if ($trabajo->save()) {
						if ( $estudios->save() ) {
							$persona->foto				= $persona->img->baseName.'.'.$persona->img->extension;
							$persona->primer_nombre		= strtoupper($persona->primer_nombre);
							$persona->segundo_nombre	= strtoupper($persona->segundo_nombre);
							$persona->primer_apellido	= strtoupper($persona->primer_apellido);
							$persona->segundo_apellido	= strtoupper($persona->segundo_apellido);
							$persona->lugar_nacimiento	= strtoupper($persona->lugar_nacimiento);
							$persona->created_at		= date('Y-m-d H:i:s');
							$persona->updated_at		= date('Y-m-d H:i:s');
							$persona->estudios_id		= $estudios->idestu;
							$persona->trabajo_id		= $trabajo->idtrabajo;
							$persona->usuario_id		= yii::$app->user->identity->id;
							if( $persona->save() ){
								if ( $parentesco->save() ) {
									$pareja = Persona::find()->where(['cedula'=>$familiar->cedula])->one();
									$familiar->pareja_id = ($pareja != null || $pareja != []) ? $pareja->id : null;
									$familiar->persona_id = $persona->id;
									$familiar->parentesco_id = $parentesco->idpar;
									if ($familiar->pareja_id != null) {
										$familiar->cedula = '';
									}
									if ( $familiar->save() ) {
										if ( $telefono->save() ) {
											if ( $enfermedad->save() ) {
												if ( $discapacidad->save() ) {
													if ( $politica->save() ) {
														if ( $inmuebles->save() ) {
															if ( $mascota->save() ) {
																if ( $casa->save() ) {
																	$casa->tipcasa == 'alquilada' ? $pago->save() : '';
																	if ( $direccion->save() ) {
																		if ( $servicios->save() ) {
																			if ( $embneg->save() ) {
																				$persona->img->saveAs(yii::getAlias('@webroot/foto/'.$persona->foto));
																				Yii::$app->session->setFlash('success','Se ha actualizado correctamente: '.$persona->primer_nombre.' - '.$persona->primer_apellido);
																				$transaction->commit();
																				return $this->redirect(['persona/detalle','id'=>$persona->id]);
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				} catch (ErrorException $e) {
					$transaction->rollback();
					Yii::$app->session->setFlash('error','No se logro actualizar los datos!!');
				}
			}
		}


		return $this->render('editar',[
			'persona'=>$persona,
			'familiar'=>$familiar,
			'parentesco'=>$parentesco,
			'telefono'=>$telefono,
			'estudios'=>$estudios,
			'trabajo'=>$trabajo,
			'enfermedad'=>$enfermedad,
			'discapacidad'=>$discapacidad,
			'politica'=>$politica,
			'direccion'=>$direccion,
			'casa'=>$casa,
			'pago'=>$pago,
			'inmuebles'=>$inmuebles,
			'mascota'=>$mascota,
			'servicios'=>$servicios,
			'embneg'=>$embneg,
			'categoria'=>$categoria,
			'estado_civil'=>$estado_civil,
			'calle'=>$calle,
			'nivel_instruccion'=>$nivel_instruccion,
		]);
	}

	public function actionDetalle()
	{
		$purifier = new HtmlPurifier;
		$param = $purifier->process( Yii::$app->request->get('id') );
		$persona = Persona::findOne(['id'=>$param]);

		return $this->render('detalle',['persona'=>$persona]);
	}

	public function actionDocumento($id){
		$persona=Persona::findOne($id);
		if (empty($persona)){
			throw new BadRequestHttpException('Esta persona no se encuentra en el sistema');
		}
		$model=new DocumentoForm();
		if ($model->load(yii::$app->request->post())){
			$model->archivo=UploadedFile::getInstance($model,'archivo');
			if ($model->validate()){
				$documento=new Documento();
				$documento->nombre=strtoupper($model->nombre);
				$ruta=yii::getAlias('@webroot/documento/'.md5($id).'/');
				if (!file_exists($ruta)){
					mkdir($ruta);
				}
				$documento->created_at=date('Y-m-d H:i.s');
				$documento->archivo=md5($documento->created_at).'.'.$model->archivo->extension;
				$model->archivo->saveAs($ruta.$documento->archivo);
				$documento->persona_id=$id;
				$documento->usuario_id=yii::$app->user->identity->id;
				$documento->save();

				yii::$app->session->setFlash('success','Se ha guardado correctamente');
				return $this->redirect(['persona/documento','id'=>$id]);
			}
		}
		$dataProvider=new ActiveDataProvider([
				'query'=>Documento::find()->where(['persona_id'=>$id])
			]);
		return $this->render('documento',['persona'=>$persona,'dataProvider'=>$dataProvider,'model'=>$model]);
	}

	public function actionDescarga($id){
		$documento=Documento::findOne($id);
		if (empty($documento)){
			throw new BadRequestHttpException('No se encontro el documento asociado');
		}
		$filename=$documento->nombre.'.'.preg_replace('/.*\./','',$documento->archivo);
		yii::$app->response->headers->add('content-type','application/octet-stream');
		yii::$app->response->headers->add('content-disposition','attachment; filename=\''.$filename.'\'');
		yii::$app->response->format=Response::FORMAT_RAW;

		return file_get_contents(yii::getAlias('@webroot/documento/'.md5($documento->persona_id).'/'.$documento->archivo));
	}

	public function actionVista($id){
		$documento=Documento::findOne($id);
		if (empty($documento)){
			throw new BadRequestHttpException('No se encontro el documento asociado');
		}
		$archivo=yii::getAlias('@webroot/documento/'.md5($documento->persona_id).'/'.$documento->archivo);
		yii::$app->response->headers->add('content-type',mime_content_type($archivo));
		yii::$app->response->format=Response::FORMAT_RAW;

		return file_get_contents($archivo);
	}

	public function actionReporte(){
		$purifier = new HtmlPurifier;
		$param = $purifier->process( Yii::$app->request->get('id') );
		$persona = Personafamiliar::find()->where(['id'=>$param])->one();

		//API MPDF
		$pdf = Yii::$app->pdf;
		$API = $pdf->api;
		$API->setAutoTopMargin = 'stretch';
		$API->setAutoBottomMargin = true;
		$cabecera = Html::img(Yii::$app->getBasePath().'/web/imagenes/cintillotifm.jpg');
		$API->SetHTMLHeader($cabecera);

		$stylesheet = file_get_contents(Yii::$app->getBasePath().'/web/css/csspdf.css');
		$API->WriteHTML($stylesheet,1);
		$pdfFilename = 'Reporte_'.$persona['primer_nombre'].'_'.$persona['cedula'].'.pdf';

		$vista = $this->renderPartial('_reportepdf',[
			'persona'=>$persona
		]);

		$API->WriteHtml($vista);
		$API->Output($pdfFilename,'D');

		//return $this->redirect(['index']);
	}

	public function actionImprimir($id){
		$persona=Persona::findOne(['id'=>$id]);
		if(empty($persona)){
			throw new BadRequestHttpException('Esta persona no se encuentra en el sistema');
		}
		$persona->foto=(empty($persona->foto))?yii::getalias('@webroot/imagenes/foto.png'):yii::getAlias('@webroot/foto/'.$persona->foto);
		$estado_civil=EstadoCivil::findOne(['id'=>$persona->estado_civil_id]);
		$casa=Casa::findOne(['id'=>$persona->casa_id]);
		$calle=Calle::findOne(['id'=>$casa->calle_id]);
		$carnet=VCarnet::find()->where(['like','persona',str_pad($persona->id,4,'0',STR_PAD_LEFT)])->one();

		$fecha=date('d/m/Y',strtotime($persona->fecha_nacimiento));

		$config=[
			'width'=>[
				'col1'=>60,
				'col2'=>60,
				'col3'=>60,
				'col4'=>45,
				'col5'=>52
			],
			'height'=>12
		];
		$pdf=new Fpdf('L');
		$pdf->addPage();
		$pdf->setFont('arial','B',16);
		$pdf->setFillColor(0,128,255);
		$pdf->setTextColor(255,255,255);
		$pdf->cell(0,$config['height'],utf8_decode('Categorización: '.$carnet->categoria),1,1,'C',1);
		$pdf->setFont('arial','',8);
		$pdf->setTextColor(0,0,0);
		$pdf->cell($config['width']['col1'],$config['height']*6,$pdf->image($persona->foto,$pdf->getX(),$pdf->getY(),$config['width']['col1'],$config['height']*6),1,0,'C');
		$pdf->cell($config['width']['col2'],$config['height'],'PRIMER NOMBRE',1,0,'C');
		$pdf->cell($config['width']['col3'],$config['height'],utf8_decode($persona->primer_nombre),1,0,'C');
		$pdf->cell($config['width']['col4'],$config['height'],'CEDULA',1,0,'C');
		$pdf->cell($config['width']['col5'],$config['height'],utf8_decode(preg_replace('/(.{1,3})(?=(.{3})+$)/','\1.',$persona->cedula)),1,1,'C');

		$pdf->cell($config['width']['col1'],$config['height'],'',0,0,'C');
		$pdf->cell($config['width']['col2'],$config['height'],'SEGUNDO NOMBRE',1,0,'C');
		$pdf->cell($config['width']['col3'],$config['height'],utf8_decode($persona->segundo_nombre),1,0,'C');
		$pdf->cell($config['width']['col4'],$config['height'],'FECHA DE NACIMIENTO',1,0,'C');
		$pdf->cell($config['width']['col5'],$config['height'],utf8_decode($fecha),1,1,'C');

		$pdf->cell($config['width']['col1'],$config['height'],'',0,0,'C');
		$pdf->cell($config['width']['col2'],$config['height'],'PRIMER APELLIDO',1,0,'C');
		$pdf->cell($config['width']['col3'],$config['height'],utf8_decode($persona->primer_apellido),1,0,'C');
		$pdf->cell($config['width']['col4'],$config['height'],'EDAD',1,0,'C');
		$pdf->cell($config['width']['col5'],$config['height'],$persona->getEdad(),1,1,'C');

		$pdf->cell($config['width']['col1'],$config['height'],'',0,0,'C');
		$pdf->cell($config['width']['col2'],$config['height'],'SEGUNDO APELLIDO',1,0,'C');
		$pdf->cell($config['width']['col3'],$config['height'],utf8_decode($persona->segundo_apellido),1,0,'C');
		$pdf->cell($config['width']['col4'],$config['height'],'ESTADO CIVIL',1,0,'C');
		$pdf->cell($config['width']['col5'],$config['height'],$estado_civil->nombre,1,1,'C');

		$pdf->cell($config['width']['col1'],$config['height'],'',0,0,'C');
		$pdf->cell($config['width']['col2'],$config['height'],'NACIONALIDAD',1,0,'C');
		$pdf->cell($config['width']['col3'],$config['height'],($persona->nacionalidad=='V')?'VENEZOLANA':'EXTRANJERO',1,0,'C');
		$pdf->cell($config['width']['col4'],$config['height'],'CALLE',1,0,'C');
		$pdf->cell($config['width']['col5'],$config['height'],utf8_decode($calle->nombre),1,1,'C');

		$pdf->cell($config['width']['col1'],$config['height'],'',0,0,'C');
		$pdf->cell($config['width']['col2'],$config['height'],'LUGAR DE NACIMIENTO',1,0,'C');
		$pdf->cell($config['width']['col3'],$config['height'],utf8_decode($persona->lugar_nacimiento),1,0,'C');
		$pdf->cell($config['width']['col4'],$config['height'],'CASA',1,0,'C');
		$pdf->cell($config['width']['col5'],$config['height'],utf8_decode($casa->nombre),1,1,'C');

		$pdf->setFont('arial','B',12);
		$pdf->setTextColor(255,255,255);
		$pdf->cell(0,$config['height'],utf8_decode('Carnet: '.$carnet->calle.' '.$carnet->casa.' '.$carnet->residencia.' '.$carnet->persona),1,1,'C',1);
		$pdf->output();
	}

	public function actionCasas($id){
		$casas=Casa::find()->where(['calle_id'=>$id])->all();
		$opciones=Html::tag('option','Seleccione',['value'=>'']);
		foreach ($casas as $casa){
			$opciones.=Html::tag('option',$casa->nombre,['value'=>$casa->id]);
		}
		return $opciones;
	}
}
?>
