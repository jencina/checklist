<?php

class UsuarioController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','index','view','admin','delete','setTecnico','verificarTecnico'),
                'users'=>array('@'),
                'expression' => 'Usuario::model()->findByPk(Yii::app()->user->id)->tipoUsuario->nombre == "admin"',
			),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array(),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
		);
	}

    public function actionVerificarTecnico(){

        $fecha = date('Y-m-d');
        $nuevafecha = date('Y-m-d',strtotime('-2 day',strtotime($fecha)));


        $criteria            = new CDbCriteria;
        $criteria->params    = array(':fecha'=> $nuevafecha,':fecha1'=>$fecha);
        $criteria->condition = 'fecha_termino between :fecha and :fecha1';
        $tecnicos            = UsuarioTecnico::model()->findAll($criteria);


        if(count($tecnicos) > 0){

            $titulo     = 'Registro - Usuario';

            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $cabeceras .= 'From: SmartCage <admin@smartcage.com>' . "\r\n";

            $mensaje    = $this->renderPartial('email',array('tecnicos'=>$tecnicos),true);

            if(mail('jonny.encina@gmail.com',$titulo,$mensaje,$cabeceras)){
                $this->render('exito',array('tecnicos'=>$tecnicos));
            }else{
                $this->render('exito',array('error'=>true));
            }

        }else{

            $this->render('exito',array('vacio'=>true));
        }

    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
            'tecnico'=>UsuarioTecnico::model()->findByAttributes(array('usuario_id'=>$id))
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */

    public function actionSetTecnico(){

        $tecnico = new UsuarioTecnico();

        $model= new Usuario();
        $model->attributes = $_REQUEST['Usuario'];

        Yii::app()->clientScript->scriptMap['jquery.js'] = false;
        Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;

        header("Content-type: application/json");
        echo CJSON::encode(array(
            'div'=>$this->renderPartial('_formTecnico',array('model'=>$model,'tecnico'=>$tecnico,'action'=>Yii::app()->createUrl('/usuario/create')),true,true)
        ));
        exit;
    }

	public function actionCreate()
	{
		$model   = new Usuario;
        $tecnico = new UsuarioTecnico();

		if(isset($_POST['Usuario']))
		{
			$model->attributes=$_POST['Usuario'];

            if(Usuario::model()->findByPk(Yii::app()->user->id)->tipoUsuario->nombre != 'super_admin'){
                $model->empresa_id = Usuario::model()->findByPk(Yii::app()->user->id)->empresa_id;
            }

            if(isset($_POST['UsuarioTecnico'])){
                $tecnico->attributes=$_POST['UsuarioTecnico'];

                $uploadedFile= CUploadedFile::getInstance($tecnico,'contrato_adjunto');

                if(isset($uploadedFile->name)){
                    $fileName    = "{$uploadedFile}";  // random number + file name
					$fileName    = str_replace(" ","_",$fileName);
                    if(file_exists(Yii::app()->basePath.'/../images/usuarios/contratos/'.$fileName)){
                        $ran=rand(100,999);
                        $fileName =$ran.'_'.$fileName;
                        $tecnico->contrato_adjunto = $fileName;
                    }else{
                        $tecnico->contrato_adjunto = $fileName;
                    }

                }

                $valid=$model->validate();
                $valid=$tecnico->validate() && $valid;

                if($valid){
                    //w$model->password = $this->hashPass2($model->password);
                    $model->password = $model->password;
                    $model->activo   = 1;

                    if($model->save()){

                        $tecnico->usuario_id = $model->id;
                        $tecnico->insert();

                        if(!empty($tecnico->contrato_adjunto)):
                            $uploadedFile->saveAs(Yii::app()->basePath.'/../images/usuarios/contratos/'.$fileName);
                        endif;

                        if($model->tipoUsuario->nombre == 'tecnico' || $model->tipoUsuario->nombre == 'reemplazo'):
                            $titulo     = 'Registro - Usuario';

                            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                            $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                            $cabeceras .= 'From: SmartCage <admin@smartcage.com>' . "\r\n";

                            $mensaje    = $this->render('emailregistro',array('usuario'=>$model->usuario,'password'=>$model->password));

                            mail($model->email,$titulo,$mensaje,$cabeceras);

                        endif;

                        $this->redirect(array('usuario/admin'));
                    }
                }

            }else{
                if($model->validate()){

                   // $model->password = $this->hashPass2($model->password);
                    $model->password = $model->password;
                    $model->activo   = 1;
                    if($model->save()){

                        $titulo     = 'Registro - Usuario';

                        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                        $cabeceras .= 'From: SmartCage <admin@smartcage.com>' . "\r\n";

                        $mensaje    = $this->renderPartial('emailregistro',array('usuario'=>$model->usuario,'password'=>$model->password),true);

                        mail($model->email,$titulo,$mensaje,$cabeceras);

                        $this->redirect(array('usuario/admin'));
                    }
                }
            }
		}

		$this->render('create',array(
			'model'=>$model,
            'tecnico'=>$tecnico
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model   = $this->loadModel($id);
        $tecnico = UsuarioTecnico::model()->findByAttributes(array('usuario_id'=>$id));

        if($tecnico){
            $contrato = $tecnico->contrato_adjunto;
        }

		if(isset($_POST['Usuario']))
		{
            $pass = $model->password;
			$model->attributes=$_POST['Usuario'];


            if(isset($_POST['UsuarioTecnico'])){

                $tecnico->attributes=$_POST['UsuarioTecnico'];

                $uploadedFile= CUploadedFile::getInstance($tecnico,'contrato_adjunto');

                if(isset($uploadedFile->name)){
                    $fileName    = "{$uploadedFile}";  // random number + file name
                    $fileName    = str_replace(" ","_",$fileName);
					
                    if(file_exists(Yii::app()->basePath.'/../images/usuarios/contratos/'.$fileName)){
                        $ran=rand(100,999);
                        $fileName =$ran.'_'.$fileName;
                        $tecnico->contrato_adjunto = $fileName;
                    }else{
                        $tecnico->contrato_adjunto = $fileName;
                    }

                }else{
                    $tecnico->contrato_adjunto = $contrato;

                }


                $valid=$model->validate();
                $valid=$tecnico->validate() && $valid;

                if($valid){

                    if($pass != $model->password){
                        $model->password = $this->hashPass2($model->password);
                    }

                    if($model->update()){

                        $tecnico->update();

                        if(isset($uploadedFile->name)):

                            $uploadedFile->saveAs(Yii::app()->basePath.'/../images/usuarios/contratos/'.$fileName);

                            if(file_exists(Yii::app()->basePath.'/../images/usuarios/contratos/'.$contrato) && !is_dir(file_exists(Yii::app()->basePath.'/../images/usuarios/contratos/'.$contrato))){
                                if($contrato != ''){
									unlink(Yii::app()->basePath.'/../images/usuarios/contratos/'.$contrato);
								}
                            }

                        endif;

                        $this->redirect(array('usuario/admin'));
                    }
                }

            }else{
                if($model->validate()){

                    if($pass != $model->password){
                        $model->password = $this->hashPass2($model->password);
                    }
                    if($model->update()){
                        $this->redirect(array('usuario/admin'));
                    }
                }
            }
		}

		$this->render('update',array(
			'model'=>$model,'tecnico'=>$tecnico
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Usuario');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
        $usuario = Usuario::model()->findByPk(Yii::app()->user->id);

        if($usuario->tipoUsuario->nombre == 'super_admin'){

            $criteria=new CDbCriteria;
            $criteria->condition = "tipo_usuario_id IN(1,2)";
          //  $criteria->params= array(":value" => $usuario->tipo_usuario_id);
        }else{
            $criteria=new CDbCriteria;
            $criteria->condition = "empresa_id = :value";
            $criteria->params= array(":value" => $usuario->empresa_id);
        }

        $dataProvider = new CActiveDataProvider('Usuario', array(
            'criteria'    => $criteria,
            'pagination'  => array(
                'pageSize'=>10,
            ),
        ));


		$this->render('admin',array(
			'model'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Usuario the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Usuario::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Usuario $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='usuario-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
