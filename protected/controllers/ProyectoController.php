<?php

class ProyectoController extends Controller
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
                'actions'=>array('view'),
                'users'=>array('@'),
            ),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','index','setComuna','admin','delete','configurar','setLocalidad','setJefeProyecto','setUsuario','setTarea','graficos'),
				'users'=>array('@'),
                'expression'=> 'Usuario::model()->findByPk(Yii::app()->user->id)->tipoUsuario->nombre == "admin"'
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

    public function actionGraficos(){

        $id       = Yii::app()->request->getParam('id');

        $protecto = $this->loadModel($id);

        $barra = array();

        foreach($protecto->localidads as $index=>$localidad){

            $barra['localidad']['nombre'][$index]= $localidad->comuna->nombre;

            $checklist = Checklist::model()->findAllByAttributes(array('localidad_id'=>$localidad->id));

            $pendiente = 0;
            $iniciado  = 0;
            $terminado = 0;

            foreach($checklist as $check){

                switch($check->estado_id){
                    case 1;
                        $pendiente++;
                        break;
                    case 2;
                        $iniciado++;
                        break;
                    case 3;
                        $terminado++;
                        break;
                }
            }

            $barra['localidad']['pendiente'][$index]= $pendiente;
            $barra['localidad']['iniciado'][$index] = $iniciado;
            $barra['localidad']['terminado'][$index]= $terminado;

        }

        $this->render('graficos',array(
            'model' => $protecto,
            'barra'=>$barra
        ));
    }

    public function actionConfigurar()
    {

        $id            = Yii::app()->request->getParam('id');
        $configuracion = Configuracion::model()->findByAttributes(array('proyecto_id'=>$id));
        $proyecto       = Proyecto::model()->findByPk($id);
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

        $this->render('application.views.configuracion.index',array(
            'proyecto'      => $proyecto,
            'configuracion' => $configuracion,
            'tarea'         => $tarea,
            'dataProvider'  => $dataProvider

        ));
    }

    public function actionSetComuna()
    {
        $id = Yii::app()->request->getParam('id');

        $comuna = Comuna::model()->findAllByAttributes(array('region_id'=>$id),array("select"=>"nombre,id"));

        $comunas = '<option value="">Seleccione Region</option>';
        foreach($comuna as $com){

            $comunas .= '<option value="'.$com->id.'">'.$com->nombre.'</option>';

        }

        Yii::app()->clientScript->scriptMap['jquery.js'] = false;
        Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;

        header("Content-type: application/json");
        echo CJSON::encode(array(
            'comuna'=>$comunas
        ));
        exit;
    }

    public function actionSetLocalidad()
    {
        require_once Yii::app()->basePath . '/extensions/booster/widgets/TbActiveForm.php';

        $localidad = new Localidad();
        $form      = new TbActiveForm();

        $i = Yii::app()->request->getParam('i');
        $i++;

        Yii::app()->clientScript->scriptMap['jquery.js'] = false;
        Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;

        header("Content-type: application/json");
        echo CJSON::encode(array(
            'div'=>$this->renderPartial('localidad',array('localidad'=>$localidad,'i'=>$i,'form'=>$form),true,true)
        ));
        exit;
    }

    public function actionSetJefeProyecto()
    {
        require_once Yii::app()->basePath . '/extensions/booster/widgets/TbActiveForm.php';

        $jefeProyecto = new JefeProyecto();
        $form         = new TbActiveForm();

        $tipo = Yii::app()->request->getParam('tipo');
        $i    = Yii::app()->request->getParam('i');
        $i++;

        Yii::app()->clientScript->scriptMap['jquery.js'] = false;
        Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;

        header("Content-type: application/json");
        echo CJSON::encode(array(
            'div'=>$this->renderPartial('jefeProyecto',array('jefeProyecto'=>$jefeProyecto,'i'=>$i,'form'=>$form,'tipo'=>$tipo),true,true)
        ));
        exit;
    }

    public function actionSetUsuario()
    {
        require_once Yii::app()->basePath . '/extensions/booster/widgets/TbActiveForm.php';

        $usuario = new Usuario();
        $form         = new TbActiveForm();

        $i    = Yii::app()->request->getParam('i');
        $i++;

        echo $this->renderPartial('usuario',array('usuario'=>$usuario,'i'=>$i,'form'=>$form,'listUsuarios'=>$this->listUsuarios()),false,true);
        exit;
    }

    public function actionSetTarea()
    {
        require_once Yii::app()->basePath . '/extensions/booster/widgets/TbActiveForm.php';

        $tarea  = new Tarea();
        $form   = new TbActiveForm();

        $i    = Yii::app()->request->getParam('i');
        $i++;

        echo $this->renderPartial('tarea',array('tarea'=>$tarea,'i'=>$i,'form'=>$form,'listTareas'=>$this->listTareas()),false,true);
        exit;
    }


    public function listUsuarios(){
        $listUsuarios= array();
        foreach(Usuario::model()->findAllByAttributes(array('empresa_id'=>Yii::app()->user->empresa)) as $index=>$user){

            $tipo   = $user->tipoUsuario->nombre;
            $nombre = $user->nombre.' '.$user->apellido;
            $listUsuarios[] = array(
                'label' => $user->id.' - '.$nombre.' - '.$tipo,  // label for dropdown list
                'value' => $nombre,  // value for input field
                'id'    => $user->id,       // return values from autocomplete
                'nombre'=> $user->nombre,
                'tipo'  => $tipo,
                'email' => $user->email
            );

        }
        return $listUsuarios;
    }


    public function listTareas(){
        $listTareas= array();
        foreach(Tarea::model()->findAllByAttributes(array('empresa_id'=>Yii::app()->user->empresa)) as $index=>$tarea){

            $tiempo   = $tarea->tiempo;
            $precio   = $tarea->precio;
            $nombre   = $tarea->nombre;

            $listTareas[] = array(
                'label'  => $nombre,  // label for dropdown list
                'value'  => $nombre,  // value for input field
                'id'     => $tarea->id,       // return values from autocomplete
                'nombre' => $nombre,
                'precio' => $precio,
                'tiempo' => $tiempo
            );

        }
        return $listTareas;
    }

    /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */

    public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

		$model    = new Proyecto;

        $id = Yii::app()->request->getParam('id');

        $this->breadcrumbs =array(
            'homeLink' => CHtml::link(Yii::t('zii', 'Proyecto'), array('proyecto/admin')),
            'links' => array('Crear Nuevo'),
        );

        if(isset($id)){

            $model->empresa_id = $id;
            $this->menu_activo = 'empresa';

            $this->breadcrumbs =array(
                'homeLink' => CHtml::link(Yii::t('zii', 'Empresa'), array('empresa/admin')),
                'links'    => array('Proyectos'=> array('empresa/proyectos','id'=>$id),'Crear Nuevo'),
            );
        }

        $local    = new Localidad();
        $int      = new JefeProyecto();
        $ext      = new JefeProyecto();
        $user     = new UsuarioAutoComplete();
        $tar      = new TareaAutoComplete();
        $conf     = new Configuracion();

        $internos = array();
        $externos = array();

        $internos[0]    = $int;
        $externos[0]    = $ext;
        $localidades[0] = $local;
        $usuarios[0]    = $user;
        $tareas[0]      = $tar;

		if(isset($_POST['Proyecto']))
		{
			$model->attributes=$_POST['Proyecto'];


            $error = false;
            if(isset($_POST['interno'])){

                foreach($_POST['interno']['JefeProyecto']  as $index=>$interno){

                    $int = new JefeProyecto();
                    $int->attributes = $interno;
                    $int->validate();
                    $internos[$index] = $int;
                    if(count($int->getErrors())>0){
                        $error = true;
                    }
                }
            }

            if(isset($_POST['externo'])){
                foreach($_POST['externo']['JefeProyecto'] as $index=>$externo){
                    $ext = new JefeProyecto();
                    $ext->attributes = $externo;
                    $ext->validate();
                    $externos[$index] = $ext;
                    if(count($ext->getErrors())>0){
                        $error = true;
                    }
                }
            }

            if(isset($_POST['Localidad'])){
                foreach($_POST['Localidad'] as $index=>$localidad){

                    $local = new Localidad();
                    $local->attributes = $localidad;
                    $local->validate();
                    $localidades[$index] = $local;
                    if(count($local->getErrors())>0){
                        $error = true;
                    }
                }
            }

            if(isset($_POST['Usuario'])){
                foreach($_POST['Usuario'] as $index=>$usuario){

                    $user = new UsuarioAutoComplete();
                    $user->attributes = $usuario;
                    $user->tipo_usuario_id = $usuario['tipo_usuario_id'];
                    $user->email           = $usuario['email'];

                    $user->validate();
                    $usuarios[$index] = $user;

                    if(count($user->getErrors())>0){
                        $error = true;
                    }
                }
            }

            if(isset($_POST['Tarea'])){
                foreach($_POST['Tarea'] as $index=>$tarea){

                    $tar = new TareaAutoComplete();
                    $tar->attributes = $tarea;
                    $tar->precio     = $tarea['precio'];
                    $tar->tiempo     = $tarea['tiempo'];
                    $tar->validate();

                    $tareas[$index] = $tar;
                    if(count($tar->getErrors())>0){
                        $error = true;
                    }
                }
            }


            if($model->validate() && $error == false){


                if($model->save()) {

                    $conf = new Configuracion();
                    $conf->unidades_red      = (isset($_POST['Configuracion']['unidades_red']))?$_POST['Configuracion']['unidades_red']:0;
                    $conf->foto              = (isset($_POST['Configuracion']['foto']))?$_POST['Configuracion']['foto']:0;
                    $conf->configuracion_red = (isset($_POST['Configuracion']['configuracion_red']))?$_POST['Configuracion']['configuracion_red']:0;
                    $conf->migracion         = (isset($_POST['Configuracion']['migracion']))?$_POST['Configuracion']['migracion']:0;
                    $conf->proyecto_id       = $model->id;
                    $conf->insert();

                    foreach($internos as $interno){
                        $interno->proyecto_id = $model->id;

                        $interno->tipo_jefe_proyecto_id = 1;
                        $interno->insert();
                    }

                    foreach($externos as $externo){
                        $externo->proyecto_id = $model->id;
                        $externo->tipo_jefe_proyecto_id = 2;
                        $externo->insert();
                    }

                    foreach($localidades as $localidad){
                        $localidad->proyecto_id = $model->id;
                        $localidad->insert();
                    }

                    foreach($usuarios as $usuario){
                        $user = new ProyectoHasUsuario();
                        $user->usuario_id = $usuario->id;
                        $user->proyecto_id = $model->id;
                        $user->insert();
                    }

                    foreach($tareas as $tarea){
                        $tar = new ProyectoHasTarea();
                        $tar->tarea_id    = $tarea->id;
                        $tar->proyecto_id = $model->id;
                        $tar->insert();
                    }

                    $this->redirect(array('empresa/proyectos','id'=>$model->empresa_id));
                }
            }
		}

		$this->render('create',array(
			'model'       => $model,
            'localidades' => $localidades,
            'internos'    => $internos,
            'externos'    => $externos,
            'usuarios'    => $usuarios,
            'id'          => $id,
            'listUsuarios'=> $this->listUsuarios(),
            'tareas'      => $tareas,
            'listTareas'  => $this->listTareas(),
            'configuracion'=> $conf
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
        $id = Yii::app()->request->getParam('id');

		$model=$this->loadModel($id);

        $this->menu_activo = 'empresa';

        if(isset($_POST['Proyecto']))
        {
            $model->attributes=$_POST['Proyecto'];

            $error = false;
            if(isset($_POST['interno'])){

                foreach($_POST['interno']['JefeProyecto']  as $index=>$interno){
                    if(!empty($interno['id'])){
                        $int = JefeProyecto::model()->findByPk($interno['id']);
                    }else{
                        $int = new JefeProyecto();
                        $int->proyecto_id           = $model->id;
                        $int->tipo_jefe_proyecto_id = 1;
                    }

                    $int->attributes = $interno;
                    $int->validate();
                    $internos[$index] = $int;
                    if(count($int->getErrors())>0){
                        $error = true;
                    }
                }
            }

            if(isset($_POST['externo'])){
                foreach($_POST['externo']['JefeProyecto'] as $index=>$externo){
                    if(!empty($externo['id'])){
                        $ext= JefeProyecto::model()->findByPk($externo['id']);
                    }else{
                        $ext = new JefeProyecto();
                        $ext->proyecto_id           = $model->id;
                        $ext->tipo_jefe_proyecto_id = 2;
                    }

                    $ext->attributes = $externo;
                    $ext->validate();
                    $externos[$index] = $ext;
                    if(count($ext->getErrors())>0){
                        $error = true;
                    }
                }
            }

            if(isset($_POST['Localidad'])){
                foreach($_POST['Localidad'] as $index=>$localidad){
                    if(!empty($localidad['id'])){
                        $local = Localidad::model()->findByPk($localidad['id']);
                    }else{
                        $local = new Localidad();
                        $local->proyecto_id = $model->id;
                    }

                    $local->attributes = $localidad;
                    $local->validate();
                    $localidades[$index] = $local;
                    if(count($local->getErrors())>0){
                        $error = true;
                    }
                }
            }

            if(isset($_POST['Usuario'])){
                foreach($_POST['Usuario'] as $index=>$usuario){
                    if(!empty($usuario['id'])){
                        $user = UsuarioAutoComplete::model()->findByPk($usuario['id']);
                    }else{
                        $user = new UsuarioAutoComplete();
                    }
                    $user->attributes = $usuario;
                    $user->validate();
                    $usuarios[$index] = $user;
                    if(count($user->getErrors())>0){
                        $error = true;
                    }
                }
            }

            if(isset($_POST['Tarea'])){
                foreach($_POST['Tarea'] as $index=>$tarea){
                    if(!empty($tarea['id'])){
                        $tar = TareaAutoComplete::model()->findByPk($tarea['id']);
                    }else{
                        $tar = new TareaAutoComplete();
                    }
                    $tar->attributes = $tarea;

                    $tar->validate();
                    $tareas[$index] = $tar;

                    if(count($tar->getErrors())>0){
                        $error = true;
                    }
                }
            }

            if($model->validate() && $error == false){


                if($model->update()) {

                    $conf = Configuracion::model()->findByAttributes(array('proyecto_id'=>$model->id));
                    if(isset($conf)){
                        $conf->unidades_red      = (isset($_POST['Configuracion']['unidades_red']))?$_POST['Configuracion']['unidades_red']:0;
                        $conf->foto              = (isset($_POST['Configuracion']['foto']))?$_POST['Configuracion']['foto']:0;
                        $conf->configuracion_red = (isset($_POST['Configuracion']['configuracion_red']))?$_POST['Configuracion']['configuracion_red']:0;
                        $conf->migracion         = (isset($_POST['Configuracion']['migracion']))?$_POST['Configuracion']['migracion']:0;
                        $conf->proyecto_id       = $model->id;
                        $conf->update();
                    }


                    $ids = array();
                    foreach($internos as $interno){
                        $interno->save();
                        $ids[] = $interno->id;
                    }

                    $criteria = new CDbCriteria;
                    $criteria->params = array(':id'=>$model->id);
                    $criteria->condition = 'proyecto_id =:id AND tipo_jefe_proyecto_id = 1';
                    $criteria->addNotInCondition('id',$ids);
                    JefeProyecto::model()->deleteAll($criteria);

                    $ids2= array();
                    foreach($externos as $externo){
                        $externo->save();
                        $ids2[] = $externo->id;
                    }

                    $criteria = new CDbCriteria;
                    $criteria->params = array(':id'=>$model->id);
                    $criteria->condition = 'proyecto_id =:id AND tipo_jefe_proyecto_id = 2';
                    $criteria->addNotInCondition('id',$ids2);
                    JefeProyecto::model()->deleteAll($criteria);

                    $ids3 = array();
                    foreach($localidades as $localidad){
                        $localidad->save();
                        $ids3[] = $localidad->id;
                    }

                    $criteria = new CDbCriteria;
                    $criteria->params = array(':id'=>$model->id);
                    $criteria->condition = 'proyecto_id =:id';
                    $criteria->addNotInCondition('id',$ids3);
                    Localidad::model()->deleteAll($criteria);


                    $ids4 = array();
                    foreach($usuarios as $usuario){
                        $user = ProyectoHasUsuario::model()->findByAttributes(array('proyecto_id'=>$model->id,'usuario_id'=>$usuario['id']));

                        if(!$user){
                            $user = new ProyectoHasUsuario();
                            $user->proyecto_id = $model->id;
                            $user->usuario_id  = $usuario['id'];
                            $user->save();
                        }

                        $ids4[] = $usuario['id'];
                    }

                    $criteria = new CDbCriteria;
                    $criteria->params = array(':id'=>$model->id);
                    $criteria->condition = 'proyecto_id =:id';
                    $criteria->addNotInCondition('usuario_id',$ids4);
                    ProyectoHasUsuario::model()->deleteAll($criteria);


                    $ids5 = array();
                    foreach($tareas as $tarea){
                        $tar = ProyectoHasTarea::model()->findByAttributes(array('proyecto_id'=>$model->id,'tarea_id'=>$tarea['id']));

                        if(!$tar){
                            $tar = new ProyectoHasTarea();
                            $tar->proyecto_id = $model->id;
                            $tar->tarea_id  = $tarea['id'];
                            $tar->save();
                        }

                        $ids5[] = $tarea['id'];
                    }

                    $criteria = new CDbCriteria;
                    $criteria->params = array(':id'=>$model->id);
                    $criteria->condition = 'proyecto_id =:id';
                    $criteria->addNotInCondition('tarea_id',$ids5);
                    ProyectoHasTarea::model()->deleteAll($criteria);


                    $this->redirect(array('empresa/proyectos','id'=>$model->empresa_id));
                }
            }
        }else{

            $local    = Localidad::model()->findAllByAttributes(array('proyecto_id'=>$model->id));
            $int      = JefeProyecto::model()->findAllByAttributes(array('proyecto_id'=>$model->id,'tipo_jefe_proyecto_id'=>1));
            $ext      = JefeProyecto::model()->findAllByAttributes(array('proyecto_id'=>$model->id,'tipo_jefe_proyecto_id'=>2));
            $user     = ProyectoHasUsuario::model()->findAllByAttributes(array('proyecto_id'=>$model->id));
            $tare     = ProyectoHasTarea::model()->findAllByAttributes(array('proyecto_id'=>$model->id));
            $conf     = Configuracion::model()->findByAttributes(array('proyecto_id'=>$model->id));

            $u = array();
            foreach($user as $index=>$us){
                $u[$index] = UsuarioAutoComplete::model()->findByPk($us->usuario_id);
            }

            $t = array();
            foreach($tare as $index=>$tar){
                $t[$index] = TareaAutoComplete::model()->findByPk($tar->tarea_id);
            }

            $internos     = $int;
            $externos     = $ext;
            $localidades  = $local;
            $usuarios     = $u;
            $tareas       = $t;

        }

        $this->render('update',array(
            'model'       => $model,
            'localidades' => $localidades,
            'internos'    => $internos,
            'externos'    => $externos,
            'usuarios'    => $usuarios,
            'listUsuarios'=> $this->listUsuarios(),
            'listTareas'  => $this->listTareas(),
            'tareas'      => $tareas,
            'id'          => $id,
            'configuracion'=>$conf
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
		$dataProvider=new CActiveDataProvider('Proyecto');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{

		$model=new Proyecto('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Proyecto']))
			$model->attributes=$_GET['Proyecto'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Proyecto the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Proyecto::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Proyecto $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='proyecto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
