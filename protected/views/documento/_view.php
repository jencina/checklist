<div class="col-sm-4 col-md-3">
    <div class="thumbnail">
        <?php
        $imagen='';
        switch($data->extension){
            case 'doc':
                $imagen = 'doc.png';
                break;
            case 'docx':
                $imagen = 'doc.png';
                break;
            case 'pdf':
                $imagen = 'pdf.png';
                break;
            case 'ppt':
                $imagen = 'ppt.png';
                break;
            case 'pptx':
                $imagen = 'ppt.png';
                break;
            case 'txt':
                $imagen = 'txt.jpeg';
                break;
            case 'xls':
                $imagen = 'xls.png';
                break;
            case 'xlsx':
                $imagen = 'xls.png';
                break;

        }

        ?>
        <img src="<?php echo Yii::app()->request->baseUrl.'/images/ext/'.$imagen; ?>" alt="" />
        <div class="caption">
            <p class="h3" style=" overflow: hidden;text-overflow: ellipsis;white-space: nowrap;"><?php echo $data->nombre?></p>
            <p><b>Fecha Subida:</b> <?php echo $data->fecha_creacion?></p>
            <p><b>Peso:</b> <?php echo $data->peso?></p>
            <p><b>Autor:</b> <?php echo $data->usuario->nombre.' '.$data->usuario->apellido?></p>
            <p>
                <?php echo CHtml::link('Descargar',Yii::app()->request->baseUrl.'/upload/'.$data->nombre,array('target'=>'_blanc','class'=>'btn btn-primary','style'=>'width: 48%;'));?>
                <?php echo CHtml::link('Eliminar' ,'',array('onclick'=>'js:eliminarDocumento('.$data->id.')','class'=>'btn btn-danger','style'=>'width: 48%;'));?>
            </p>
        </div>
    </div>
</div>
