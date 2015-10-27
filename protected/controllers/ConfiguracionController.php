<?php

class ConfiguracionController extends Controller
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
				'actions'=>array('create','update','index','view','setConf','deleteTareaConf','admin','delete'),
				'users'=>array('@'),
                'expression'=> 'Usuario::model()->findByPk(Yii::app()->user->id)->tipoUsuario->nombre == "admin"'
			),

			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    public function actionSetConf(){
        $id   = Yii::app()->request->getParam('id');
        $tipo = Yii::app()->request->getParam('tipo');

        $configuracion = Configuracion::model()->findByAttributes(array('cliente_id'=>$id));


        switch($tipo){
            case 'configuracion_red':
                if($configuracion->configuracion_red == 1){
                    $dat = 0;
                }else{
                    $dat = 1;
                }
                $configuracion->configuracion_red = $dat;
            break;
            case 'unidades_red':
                if($configuracion->unidades_red == 1){
                    $dat = 0;
                }else{
                    $dat = 1;
                }
                $configuracion->unidades_red = $dat;
                break;
            case 'foto':
                if($configuracion->foto == 1){
                    $dat = 0;
                }else{
                    $dat = 1;
                }
                $configuracion->foto = $dat;
                break;
            case 'migracion':
                if($configuracion->migracion == 1){
                    $dat = 0;
                }else{
                    $dat = 1;
                }
                $configuracion->migracion = $dat;
                break;
        }

        $configuracion->update();

        header("Content-type: application/json");
        echo CJSON::encode(array(
            'msg'=> $tipo.' fue cambiado'
        ));
        exit;

    }

    public function actionDeleteTareaConf(){
        $tarea   = Yii::app()->request->getParam('tarea');
        $conf   = Yii::app()->request->getParam('conf');

        $confHasTarea = ConfiguracionHasTarea::model()->findByAttributes(array('configuracion_id'=>$conf,'tarea_id'=>$tarea));

        $confHasTarea->delete();

        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));

    }

    public function actionAddTarea(){

       // $tarea = new Tarea();
        $add =  new ConfiguracionHasTarea();

        $id   = Yii::app()->request->getParam('id');


        if(isset($_POST['ConfiguracionHasTarea'])){
        //  $tarea->scenario   = 'addTarea';
          $add->attributes = $_POST['ConfiguracionHasTarea'];
            $add->configuracion_id = $id;
            if($add->validate()){

             //   $add =  new ConfiguracionHasTarea();

                //$add->tarea_id         = $tarea->id;
                $add->insert();

                header("Content-type: application/json");
                echo CJSON::encode(array(
                    'status'=> 'success',
                    'div' => $this->renderPartial('application.views.configuracion.addTarea',array('tarea'=>$add,'id'=>$id),true,true)
                ));
                exit;
            }

            header("Content-type: application/json");
            echo CJSON::encode(array(
                 'status'=> 'failure',
                 'div' => $this->renderPartial('application.views.configuracion.addTarea',array('tarea'=>$add,'id'=>$id),true,true)
            ));
            exit;
        }
    }


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{

        $id            = Yii::app()->request->getParam('id');
        $configuracion = Configuracion::model()->findByAttributes(array('cliente_id'=>$id));
        $cliente       = Cliente::model()->findByPk($id);
        $tarea         = new ConfiguracionHasTarea();

        $criteria=new CDbCriteria;
        $criteria->compare('configuracion_id',$configuracion->id);

        // $criteria->addCondition('status = "login"');
        $dataProvider = new CActiveDataProvider('ConfiguracionHasTarea', array(
            'criteria'    => $criteria,
            'pagination'  => array(
                'pageSize'=>10,
            ),
        ));

		$this->render('index',array(
            'cliente'       => $cliente,
            'configuracion' => $configuracion,
            'tarea'         => $tarea,
            'dataProvider'  => $dataProvider

		));
    }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Configuracion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Configuracion']))
			$model->attributes=$_GET['Configuracion'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Configuracion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Configuracion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Configuracion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='configuracion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
