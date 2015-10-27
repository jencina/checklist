<?php

class CronjobCommand extends CConsoleCommand
{

    private function render($template, array $data = array()){
        $path = Yii::getPathOfAlias('application.views.usuario').'/'.$template.'.php';
        if(!file_exists($path)) throw new Exception('Template '.$path.' does not exist.');
        return $this->renderFile($path, $data, true);
    }

    public function run($args)
    {

      //  require('CController');

        $fecha = date('Y-m-d');
        $nuevafecha = strtotime ('-2 day',strtotime($fecha));


        $criteria            = new CDbCriteria;
        $criteria->params    = array(':fecha'=> date('Y-m-d',$nuevafecha),':fecha1'=>$fecha);
        $criteria->condition = 'fecha_termino between :fecha and :fecha1';
        $tecnicos            = UsuarioTecnico::model()->findAll($criteria);


       // $ccc = new CController();

        //if(count($tecnicos) > 0){
            Yii::import('application.extensions.phpmailer.JPhpMailer');
            $mail = new JPhpMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = '587';
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = 'jonny.encina@gmail.com';
            $mail->Password = 'jonathan24';
            $mail->SetFrom('jonny.encina@gmail.com', 'Falcon');
            $mail->Subject = 'Aviso Tecnicos';
            $mail->MsgHTML( $this->render('email',array('tecnicos'=>$tecnicos),true));
            $mail->AddAddress('jonny.encina@gmail.com', 'Falcon CK');

            $mail->Send();

        //}
    }
}