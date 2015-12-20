<?php

class ChecklistController extends Controller
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
                'actions'=>array('index','view','admin','exportPdf','exportExcel'),
                'users'=>array('@'),
            ),

			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update','UploadFoto'),
				'users'=>array('@'),
                'expression'=> 'Usuario::model()->findByPk(Yii::app()->user->id)->tipoUsuario->nombre != "cliente"'
			),

            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','delete','addChecklist'),
                'users'=>array('@'),
                'expression'=> 'Usuario::model()->findByPk(Yii::app()->user->id)->tipoUsuario->nombre == "admin"'
            ),

			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */

    public function actionExportPdf(){

        $id    = Yii::app()->request->getParam('id');

        $model             = $this->loadModel($id);
        $usuario           = IdentificacionUsuario::model()->findByAttributes(array('checklist_id'=>$id));
        $informacionEquipo = InformacionEquipo::model()->findByAttributes(array('checklist_id'=>$id));
        $impresora         = Impresora::model()->findByAttributes(array('checklist_id'=>$id));


        $foto              = Foto::model()->findByAttributes(array('checklist_id'=>$id));
        $migracion         = Migracion::model()->findByAttributes(array('checklist_id'=>$id));
        $configuracion_red = ConfiguracionRed::model()->findByAttributes(array('checklist_id'=>$id));

        $tareas            = ChecklistHasTarea::model()->findAllByAttributes(array('checklist_id'=>$id));


        $mPDF1 = Yii::app()->ePdf->mpdf();
        $stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css').'/checklist_pdf.css');
        $mPDF1->WriteHTML($stylesheet,1);

        $mPDF1->SetHTMLHeader('<div class="header"><span class="direccion">http://23kycorp.com/</span></div>');
        $mPDF1->setFooter('{PAGENO}');

        $mPDF1->WriteHTML($this->renderPartial('view_pdf',
            array('model'=> $model,
                'usuario'          => $usuario,
                'informacionEquipo'=> $informacionEquipo,
                'impresora'        => $impresora,
                'foto'             => $foto,
                'migracion'        => $migracion,
                'configuracionRed' => $configuracion_red,
                'tareas'           => $tareas
            ), true));

        $mPDF1->Output();
    }



    public function actionExportExcel(){

        $id    = Yii::app()->request->getParam('id');

        $model             = $this->loadModel($id);
        $usuario           = IdentificacionUsuario::model()->findByAttributes(array('checklist_id'=>$id));
        $informacionEquipo = InformacionEquipo::model()->findByAttributes(array('checklist_id'=>$id));
        $impresora         = Impresora::model()->findByAttributes(array('checklist_id'=>$id));


        $foto              = Foto::model()->findByAttributes(array('checklist_id'=>$id));
        $migracion         = Migracion::model()->findByAttributes(array('checklist_id'=>$id));
        $configuracionRed = ConfiguracionRed::model()->findByAttributes(array('checklist_id'=>$id));

        $tareas            = ChecklistHasTarea::model()->findAllByAttributes(array('checklist_id'=>$id));

        Yii::import('ext.phpexcel.XPHPExcel');
        $objPHPExcel= XPHPExcel::createPHPExcel();

        $sheet = $objPHPExcel->getActiveSheet(0);
        $sheet->setCellValueByColumnAndRow(1, 2, "Checklist Usuario Final");
        $sheet->mergeCells('B2:E2');

//INFORMACION USUARIO
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B3:E3')
            ->setCellValue('B3', 'Informacion Usuario')
            ->setCellValue('B4', 'Nombre')
            ->setCellValue('C4', $usuario->nombre)
            ->setCellValue('D4', 'Cliente')
            ->setCellValue('E4', isset($model->cliente->nombre)?$model->cliente->nombre:'')
            ->setCellValue('B5', 'Departamento')
            ->setCellValue('C5', isset($model->cliente->departamento->nombre)?$model->cliente->departamento->nombre:'')
            ->setCellValue('D5', 'Email')
            ->setCellValue('E5', $usuario->email)
            ->setCellValue('B6', 'Telefono')
            ->setCellValue('C6', $usuario->telefono)
            ->setCellValue('D6', 'Region')
            ->setCellValue('E6', isset($model->cliente->region->nombre)?$model->cliente->region->nombre:'')
            ->setCellValue('B7', 'Comuna')
            ->setCellValue('C7', isset($model->cliente->comuna->nombre)?$model->cliente->comuna->nombre:'')
            ->setCellValue('D7', 'Direccion')
            ->setCellValue('E7', isset($model->cliente->direccion)?$model->cliente->direccion:'');

        $bold= array('font'=>array(
                        'color' => array('rgb' => '000000'),
                        'bold'  => true ));

        $background = array('fill' => array(
                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array('rgb' => 'ffffff')));

        $background2 = array('fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '2644a0')),
        'font'=>array(
            'color' => array('rgb' => 'ffffff'))
        );


        $objPHPExcel->getActiveSheet(0)->getStyle('B4:E32')->applyFromArray($background);
        $objPHPExcel->getActiveSheet(0)->getStyle('B4:B32')->applyFromArray($bold);
        $objPHPExcel->getActiveSheet(0)->getStyle('D4:D32')->applyFromArray($bold);

        $objPHPExcel->getActiveSheet(0)->getStyle('B3:E3')->applyFromArray($background2);
        $objPHPExcel->getActiveSheet(0)->getStyle('B9:E9')->applyFromArray($background2);
        $objPHPExcel->getActiveSheet(0)->getStyle('B13:E13')->applyFromArray($background2);
        $objPHPExcel->getActiveSheet(0)->getStyle('B17:E17')->applyFromArray($background2);
        $objPHPExcel->getActiveSheet(0)->getStyle('B20:E20')->applyFromArray($background2);
        $objPHPExcel->getActiveSheet(0)->getStyle('B26:E26')->applyFromArray($background2);


        //INFORMACION EQUIPO
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B9', 'Informacion Equipo')
            ->setCellValue('B10', 'Ram')
            ->setCellValue('C10', $informacionEquipo->ram)
            ->setCellValue('D10', 'Disco')
            ->setCellValue('E10', $informacionEquipo->disco)
            ->setCellValue('B11', 'Cpu')
            ->setCellValue('C11', isset($informacionEquipo->cpu->modelo)?$informacionEquipo->cpu->modelo:'')
            ->setCellValue('D11', 'Monitor')
            ->setCellValue('E11', isset($informacionEquipo->monitor->modelo)?$informacionEquipo->monitor->modelo:'');

        //IMPRESORA
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B13', 'Impresora')
            ->setCellValue('B14', 'Puerto')
            ->setCellValue('C14', $impresora->puerto)
            ->setCellValue('D14', 'Pdfcmon')
            ->setCellValue('E14', $impresora->pdfcmon)
            ->setCellValue('B15', 'Usb001')
            ->setCellValue('C15', $impresora->usb001)
            ->setCellValue('D15', 'Ip')
            ->setCellValue('E15', $impresora->ip);

        //SISTEMA OPERATIVO
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B17', 'Sistema Operativo')
            ->setCellValue('B18', 'Sistema Operativo')
            ->setCellValue('C18', isset($model->sistemaOperativo->version)?$model->sistemaOperativo->version:'');

        //CONFIGURACION RED
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B20', 'Configuracion Red')
            ->setCellValue('B21', 'Usuario')
            ->setCellValue('C21', $configuracionRed->usuario)
            ->setCellValue('D21', 'Dominio')
            ->setCellValue('E21', $configuracionRed->dominio)
            ->setCellValue('B22', 'Nombre Maquina')
            ->setCellValue('C22', $configuracionRed->nombre_maquina)
            ->setCellValue('D22', 'Red')
            ->setCellValue('E22', $configuracionRed->red)
            ->setCellValue('B23', 'Mascara')
            ->setCellValue('C23', $configuracionRed->mascara)
            ->setCellValue('D23', 'Puerto Enlace')
            ->setCellValue('E23', $configuracionRed->puerto_enlace)
            ->setCellValue('B24', 'Dns Preferencial')
            ->setCellValue('C24', $configuracionRed->dns_preferencial)
            ->setCellValue('D24', 'Dns Alternativo')
            ->setCellValue('E24', $configuracionRed->dns_alternativo);

        //MIGRACION
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B26', 'Migracion')
            ->setCellValue('B27', 'Antes')
            ->setCellValue('B28', 'Ram Antes')
            ->setCellValue('C28', $migracion->ram_antes)
            ->setCellValue('D28', 'Disco Antes')
            ->setCellValue('E28', $migracion->disco_antes)
            ->setCellValue('B29', 'Cpu Antes')
            ->setCellValue('C29', isset($migracion->cpuIdAntes->modelo)?$migracion->cpuIdAntes->modelo:'')
            ->setCellValue('D29', 'Monitor Antes')
            ->setCellValue('E29', isset($migracion->monitorIdAntes->modelo)?$migracion->monitorIdAntes->modelo:'')
            ->setCellValue('B30', 'Despues')
            ->setCellValue('B31', 'Ram Despues')
            ->setCellValue('C31', $migracion->ram_despues)
            ->setCellValue('D31', 'Disco Despues')
            ->setCellValue('E31', $migracion->disco_despues)
            ->setCellValue('B32', 'Cpu Despues')
            ->setCellValue('C32', isset($migracion->cpuIdDespues->modelo)?$migracion->cpuIdDespues->modelo:'')
            ->setCellValue('D32', 'Monitor Despues')
            ->setCellValue('E32', isset($migracion->monitorIdDespues->modelo)?$migracion->monitorIdDespues->modelo:'');


// Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Checklist');
        $objPHPExcel->setActiveSheetIndex(0);

        foreach(range('A','I') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        ob_end_clean();
        ob_start();

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="01simple.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        Yii::app()->end();
    }

	public function actionView($id)
	{
        $model             = $this->loadModel($id);

        $this->menu_activo = 'empresa';

        $this->breadcrumbs =array(
            'homeLink' => CHtml::link(Yii::t('zii', 'Empresa'), array('empresa/admin')),
            'links' => array(
                'Proyectos'  => array('empresa/proyectos','id'=>$model->localidad->proyecto->empresa_id),
                'Localidades'=> array('empresa/localidades','id'=>$model->localidad->proyecto_id),
                'Checklist'  => array('checklist/admin','id'=>$model->localidad_id),
                'Ver'
            ),
        );


        $baseUrl = Yii::app()->baseUrl;
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile($baseUrl.'/css/checklist_view.css');


        $usuario           = IdentificacionUsuario::model()->findByAttributes(array('checklist_id'=>$id));
        $informacionEquipo = InformacionEquipo::model()->findByAttributes(array('checklist_id'=>$id));
        $impresora         = Impresora::model()->findByAttributes(array('checklist_id'=>$id));


        $foto              = Foto::model()->findByAttributes(array('checklist_id'=>$id));
        $migracion         = Migracion::model()->findByAttributes(array('checklist_id'=>$id));
        $configuracion_red = ConfiguracionRed::model()->findByAttributes(array('checklist_id'=>$id));

        $tareas            = ChecklistHasTarea::model()->findAllByAttributes(array('checklist_id'=>$id));

        $this->render('view',array(
            'model'            => $model,
            'usuario'          => $usuario,
            'informacionEquipo'=> $informacionEquipo,
            'impresora'        => $impresora,

            'foto'             => $foto,
            'migracion'        => $migracion,
            'configuracionRed'=> $configuracion_red,

            'tareas'           => $tareas

        ));
	}


    public function actionAdmin(){

        $id     = Yii::app()->request->getParam('id');


        $user     = Yii::app()->user->id;
        $tipo     = Yii::app()->user->tipo_usuario;
        $proyecto = Localidad::model()->findByPk($id);


            $this->menu_activo = 'empresa';

            $this->breadcrumbs =array(
                'homeLink' => CHtml::link(Yii::t('zii', 'Empresa'), array('empresa/admin')),
                'links'    => array('Proyectos'=> array('empresa/proyectos','id'=>$proyecto->proyecto->empresa_id),
                    'Localidades'=>array('empresa/localidades','id'=>$proyecto->proyecto_id),'Checklist'),
            );


        if( $tipo == 'admin'){

            $criteria            = new CDbCriteria;
            $criteria->condition = "localidad_id =:cliente";
            $criteria->params    = array(':cliente'=>$id);

        }else if($tipo == 'tecnico' ){
           
            $criteria            = new CDbCriteria;
            $criteria->condition = "usuario_id =:value and localidad_id =:cliente";
            $criteria->params    = array(":value" => $user,':cliente'=>$id);

        }else if($tipo == 'cliente'){

            $criteria            = new CDbCriteria;
            $criteria->condition = "localidad_id =:cliente";
            $criteria->params    = array(':cliente'=>$id);

        }

        $dataProvider = new CActiveDataProvider('Checklist', array(
            'criteria'    => $criteria,
            'pagination'  => array(
                'pageSize'=>10,
            ),
        ));

        $precio = 0;

        foreach($dataProvider->getData() as $data){
            $precio = $precio+$data->precio;
        }
        $this->render('create',array(
            'model'=>$dataProvider,'id'=>$id ,'precio'=>$precio ,'proyecto'=>$proyecto
        ));

    }

    public function actionAddChecklist(){

        $id    = Yii::app()->request->getParam('id');
        $localidad = Localidad::model()->findByPk($id);

        $model = new Checklist();
        $model->localidad_id  = $id;
        $model->estado_id     = 1;
        $model->fecha_inicio  = null;
        $model->fecha_termino = null;
        $model->hora_inicio   = null;
        $model->hora_termino  = null;
        $model->precio        = 0;
        $model->insert();

        $usuario = new IdentificacionUsuario();
        $usuario->checklist_id = $model->id;
        $usuario->insert();

        $informacionEquipo = new InformacionEquipo();
        $informacionEquipo->checklist_id = $model->id;
        $informacionEquipo->insert();

        $configRed = new ConfiguracionRed();
        $configRed->checklist_id = $model->id;
        $configRed->insert();

        $impresoras = new Impresora();
        $impresoras->checklist_id = $model->id;
        $impresoras->insert();

        $foto = new Foto();
        $foto->checklist_id = $model->id;
        $foto->insert();

        $migracion = new Migracion();
        $migracion->checklist_id = $model->id;
        $migracion->insert();

        $conf   = Configuracion::model()->findByAttributes(array('proyecto_id'=>$localidad->proyecto_id));
        $tareas = ProyectoHasTarea::model()->findAllByAttributes(array('proyecto_id'=>$conf->id));

       foreach($tareas as $ta){

           $checkHasTarea =  new ChecklistHasTarea();
           $checkHasTarea->checklist_id = $model->id;
           $checkHasTarea->tarea_id     = $ta->tarea_id;
           $checkHasTarea->estado_id    = 1;
           $checkHasTarea->insert();

       }

        $folder=Yii::app()->basePath. "/../images";
        $file = $folder.'/checklist/images/checklist_'.$model->id;

        chmod($file, 0777);
        mkdir($file, 0777 ,true);



        header("Content-type: application/json");
        echo CJSON::encode(array(
            'status'=>'success'
        ));
        exit;

    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{

		$model             = $this->loadModel($id);

        $this->menu_activo = 'empresa';

        $this->breadcrumbs =array(
            'homeLink' => CHtml::link(Yii::t('zii', 'Empresa'), array('empresa/admin')),
            'links' => array(
                          'Proyectos'  => array('empresa/proyectos','id'=>$model->localidad->proyecto->empresa_id),
                          'Localidades'=> array('empresa/localidades','id'=>$model->localidad->proyecto_id),
                          'Checklist'  => array('checklist/admin','id'=>$model->localidad_id),
                          'Editar'
            ),
        );


        if($model->localidad->proyecto->tipo_checklist_id == 1){

            $usuario           = IdentificacionUsuario::model()->findByAttributes(array('checklist_id'=>$id));
            $informacionEquipo = InformacionEquipo::model()->findByAttributes(array('checklist_id'=>$id));
            $impresora         = Impresora::model()->findByAttributes(array('checklist_id'=>$id));

            $foto              = Foto::model()->findByAttributes(array('checklist_id'=>$id));
            $migracion         = Migracion::model()->findByAttributes(array('checklist_id'=>$id));
            $configuracion_red = ConfiguracionRed::model()->findByAttributes(array('checklist_id'=>$id));

        }else{

            $usuario = '';
            $informacionEquipo = '';
            $impresora = '';
            $foto = '';
            $migracion = '';
            $configuracion_red = '';

        }


        $tareas  = ChecklistHasTarea::model()->findAllByAttributes(array('checklist_id'=>$id));


		if(isset($_POST['Checklist']))
		{
			$model->attributes             = $_POST['Checklist'];

            if($model->localidad->proyecto->tipo_checklist_id == 1) {

                $usuario->attributes = $_POST['IdentificacionUsuario'];
                $informacionEquipo->attributes = $_POST['InformacionEquipo'];
                $impresora->attributes = $_POST['Impresora'];


                if (isset($_POST['ConfiguracionRed'])) {
                    $configuracion_red->attributes = $_POST['ConfiguracionRed'];
                }

                if (isset($_POST['Migracion'])) {
                    $migracion->attributes = $_POST['Migracion'];
                }
            }
            
            $attributes = $_POST['ChecklistHasTarea'];
            $precio     = 0;

            foreach($tareas as $index=>$tarea){

                if(isset($attributes[$tarea->tarea_id])){

                    $tarea->estado_id = $attributes[$tarea->tarea_id]['estado_id'];

                    if($tarea->estado->nombre == 'terminado'){
                        $precio = $precio+$tarea->tarea->precio;
                    }
                }
            }

            $model->precio        = $precio;
            $model->fecha_inicio  = (!empty($model->fecha_inicio))?date('Y-m-d',strtotime($model->fecha_inicio)):null;
            $model->fecha_termino = (!empty($model->fecha_termino))?date('Y-m-d',strtotime($model->fecha_termino)):null;

            if($model->save()){

                if($model->localidad->proyecto->tipo_checklist_id == 1) {
                    $usuario->save();
                    $informacionEquipo->save();
                    $impresora->save();
                    $configuracion_red->save();
                    $migracion->save();
                }

                $iniciado  = false;
                $terminado = false;
                $cont      = count($tareas);
                $i         = 0;
                foreach($tareas as $tarea){
                    $tarea->update();

                    if($tarea->estado_id == 2){
                        $iniciado = true;
                    }elseif($tarea->estado_id == 3){
                        $i++;
                    }

                }

                if($iniciado == true){
                    $model->estado_id =2;
                    $model->update();
                }elseif($cont == $i){
                    $model->estado_id =3;
                    $model->update();
                }

                $this->redirect(array('checklist/admin','id'=>$model->localidad_id,'empresa'=>$model->localidad->proyecto_id));
            }
		}

		$this->render('update',array(
			'model'            => $model,
            'usuario'          => $usuario,
            'informacionEquipo'=> $informacionEquipo,
            'impresora'        => $impresora,

            'foto'             => $foto,
            'migracion'        => $migracion,
            'configuracionRed'=> $configuracion_red,

            'tareas'           => $tareas

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

        $file = Yii::app()->basePath."/../images/checklist/images/checklist_".$id."/";
        if(file_exists($file)){
            rmdir($file);
        }

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}



    public function actionUploadFoto(){

        Yii::import("ext.EAjaxUpload.qqFileUploader");

        $id     = Yii::app()->request->getParam('id');
        $file   = Yii::app()->request->getParam('filename');

        $folder=Yii::app()->getBasePath()."/../images/checklist/images/checklist_".$id."/";// folder for uploaded files

        $allowedExtensions = array("jpg","png","pdf");//array("jpg","jpeg","gif","exe","mov" and etc...

        $sizeLimit = 5 * 1024 * 1024;// maximum file size in bytes

        $checklist = Foto::model()->findByAttributes(array('checklist_id'=>$id));

        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit,$checklist->$file,$file);

        $result = $uploader->handleUpload($folder,true);

        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);

        $fileName=$result['filename'];//GETTING FILE NAME


        $checklist->$file = $fileName;
        $checklist->update();

        // $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE


        echo $return;// it's array

    }

	/**
	 * Lists all models.
	 */
	/*
    public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Cliente');

        $this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	*/

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
        $id    = Yii::app()->user->id;
        $tipo  = Usuario::model()->findByPk($id);

        if( $tipo->tipoUsuario->nombre == 'admin'  || $tipo->tipoUsuario->nombre == 'super_admin'){

            $criteria= new CDbCriteria;

        }else if($tipo->tipoUsuario->nombre == 'tecnico'){

            $criteria=new CDbCriteria;
            $criteria->join = 'LEFT JOIN (Select id,usuario_id,cliente_id from checklist)checklist ON checklist.cliente_id = t.id';
            $criteria->condition = "checklist.usuario_id =  :value";
            $criteria->params= array(":value" => $id);

        }else if($tipo->tipoUsuario->nombre == 'cliente'){

            $criteria=new CDbCriteria;
            $criteria->condition = "empresa_id =  :value";
            $criteria->params= array(":value" => $tipo->empresa_id);
        }

        $dataProvider = new CActiveDataProvider('Proyecto', array(
            'criteria'    => $criteria,
            'pagination'  => array(
                'pageSize'=>10,
            ),
        ));

        $this->render('admin',array(
            'model'=>$dataProvider
        ));

        /*
		$model=new Cliente('search');

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Checklist']))
			$model->attributes=$_GET['Checklist'];

		$this->render('admin',array(
			'model'=>$model,
		));*/
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Checklist the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Checklist::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Checklist $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='checklist-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
