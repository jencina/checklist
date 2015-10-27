<?php

class DashboardController extends Controller
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
                'actions'=>array('index','setProyectos','createGrafic'),
                'users'=>array('@'),
            //    'expression'=> 'Usuario::model()->findByPk(Yii::app()->user->id)->tipoUsuario->nombre == "admin"'
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionSetProyectos(){

        $id = Yii::app()->request->getParam('id');

        $desde     = Yii::app()->request->getParam('desde');
        $hasta     = Yii::app()->request->getParam('hasta');

        $criteria = new CDbCriteria();
       // $criteria->params = array(":desde"=>$desde,":hasta"=>$hasta,"id"=>$id);
        $criteria->params = array("id"=>$id);
        $criteria->condition = "empresa_id =:id";
        $criteria->addBetweenCondition('fecha_inicio', $desde, $hasta);
      //  $criteria->condition = "empresa_id =:id AND (fecha_inicio Between :desde and :hasta)";


        $proyectos = Proyecto::model()->findAll($criteria);

        Yii::app()->clientScript->scriptMap['jquery.js'] = false;
        Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;

        header("Content-type: application/json");
        echo CJSON::encode(array(
            'div'=>$this->renderPartial('proyectos',array('proyectos'=>$proyectos),true,true)
        ));
        exit;
    }


    public function actionCreateGrafic(){


        $ids       = Yii::app()->request->getParam('proyectos');

        $barra = array();
        $torta = array();

        foreach ($ids as $index1=>$id) {

            $proyecto = Proyecto::model()->findByPk($id);

            $proyectos[$index1] = $proyecto->nombre;

            foreach($proyecto->localidads as $index=>$localidad){

                $barra[$index1]['localidad']['nombre'][$index]= $localidad->comuna->nombre;

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

                $barra[$index1]['localidad']['pendiente'][$index]= $pendiente;
                $barra[$index1]['localidad']['iniciado'][$index] = $iniciado;
                $barra[$index1]['localidad']['terminado'][$index]= $terminado;

            }


            foreach($proyecto->localidads as $index => $localidad){

                $torta[$index1][$index]['localidad'] = $localidad->comuna->nombre;

                $count = count($localidad->checklists);

                $precio = 0;
                $costo  = 0;
                foreach($proyecto->tareas as $tarea){
                     $precio = $precio + $tarea->precio;
                     $costo  = $costo  + $tarea->costo;
                }

                $precio = $precio * $count;
                $costo  = $costo  * $count;

                //$barra2[$index1]['localidad'][$index] = $localidad->comuna->nombre;
                $barra2[$index1]['precio'][$index]    = $precio;
                $barra2[$index1]['costo'][$index]     = $costo;
                $barra2[$index1]['ganancia'][$index]  = $precio - $costo;


                foreach($localidad->checklists as  $checklist){

                    if(isset($checklist->usuario_id)){

                        $cant = 1;

                        if(isset($torta[$index1][$index]['checklist'][$checklist->usuario_id]['cant'])){
                            $cant = $torta[$index1][$index]['checklist'][$checklist->usuario_id]['cant'];
                            $cant++;
                        }

                        $torta[$index1][$index]['checklist'][$checklist->usuario_id]['id']     = $checklist->usuario_id;
                        $torta[$index1][$index]['checklist'][$checklist->usuario_id]['nombre'] = $checklist->usuario->nombre;
                        $torta[$index1][$index]['checklist'][$checklist->usuario_id]['cant']   = $cant ;

                    }else{
                        $cant = 1;
                        if(isset($torta[$index1][$index]['checklist']['otros']['cant'])){
                            $cant = $torta[$index1][$index]['checklist']['otros']['cant'];
                            $cant++;

                        }

                        $torta[$index1][$index]['checklist']['otros']['id']     = 'otros';
                        $torta[$index1][$index]['checklist']['otros']['nombre'] = 'sin asignar';
                        $torta[$index1][$index]['checklist']['otros']['cant']   = $cant ;

                    }
                }
            }
        }

        Yii::app()->clientScript->scriptMap['jquery.js']     = false;
        Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;

        Yii::app()->clientScript->scriptMap['highcharts.js']  = false;
        Yii::app()->clientScript->scriptMap['exporting.js']  = false;

        header("Content-type: application/json");
        echo CJSON::encode(array(
            'div'=>$this->renderPartial('graficos',array('barras'=>$barra,'tortas'=>$torta,'proyectos'=>$proyectos,'barras2'=>$barra2),true,true)
        ));
        exit;
    }


    public function actionIndex(){

        $this->breadcrumbs = array(
            'homeLink' => CHtml::link(Yii::t('zii', 'Dashboard'), array('dashboard/index')),
        );

        $usuario = Usuario::model()->findByPk(Yii::app()->user->id);

        $criteria=new CDbCriteria;
        $criteria->condition = "tipo_empresa_id = :value and empresa_id = :value2";
        $criteria->params= array(":value" => Yii::app()->params['empresa_cliente'],":value2"=>$usuario->empresa_id);

        $empresas = Empresa::model()->findAll($criteria);

        $this->render('index',array(

        'empresas'=>$empresas
        ));

    }


}
