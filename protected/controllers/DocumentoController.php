<?php

class DocumentoController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','subirDocumento','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	public function actionSubirDocumento()
	{
        Yii::import("ext.EAjaxUpload.qqFileUploader");

        $folder=Yii::app()->getBasePath()."/../upload/";// folder for uploaded files

        $allowedExtensions = array("pdf","zip","rar","txt","cvs","doc","docx","xls","xlsx","ppt","pptx");//array("jpg","jpeg","gif","exe","mov" and etc...

        $sizeLimit = 5 * 1024 * 1024;// maximum file size in bytes

        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);

        $result = $uploader->handleUpload($folder,true);

        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);

        $fileName=$result['filename'];//GETTING FILE NAME
        $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
        $fileExt=$result['ext'];//GETTING FILE NAME

        $documento                 = new Documento();
        $documento->fecha_creacion = date("Y-m-d H:i:s");
        $documento->nombre         = $fileName;
        $documento->usuario_id     = Yii::app()->user->id;
        $documento->peso           = $fileSize;
        $documento->extension      = $fileExt;
        $documento->insert();

        echo $return;// it's array
	}


	public function actionDelete()
	{
        $id     = Yii::app()->request->getParam('id');
        $folder = Yii::app()->getBasePath()."/../upload/";
		$doc    = Documento::model()->findByPk($id);
        $nombre = $doc->nombre;
        $doc->delete();
        unlink($folder.$nombre);



        header("Content-type: application/json");
        echo CJSON::encode(array(
            'status'=>'success'
        ));
        exit;
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Documento');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='documento-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
