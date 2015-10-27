<?php
/* @var $this DocumentoController */
/* @var $dataProvider CActiveDataProvider */

$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'homeLink' => 'Documentos',
        'links' => array(''),
    )
);
?>

<div class="page-header">
    <h1>Documentos <small>Administrador</small>
        <div class="col-md-3" style="float: right">
            <?php  $this->widget('ext.EAjaxUpload.EAjaxUpload',
                array(
                    'id'=>'documento',
                    'config'=>array(
                        'action'=>Yii::app()->createUrl('documento/SubirDocumento'),
                        'allowedExtensions'=>array("pdf","zip","rar","txt","cvs","doc","docx","xls","xlsx","ppt","pptx"),//array("jpg","jpeg","gif","exe","mov" and etc...
                        'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                        'onComplete'=>"js:function(id, fileName, data ){
                           $.fn.yiiListView.update('list');
                        }",
                    )
                )); ?>
        </div></h1>
</div>


<?php

echo CHtml::openTag('div', array('class' => 'row-fluid'));
$this->widget(
    'booster.widgets.TbThumbnails',
    array(
        'id'=>'list',
        'dataProvider' => $dataProvider,
        'template' => "{items}\n{pager}",
        'itemView' => 'application.views.documento._view',
    )
);
echo CHtml::closeTag('div');
?>

<script>

    function eliminarDocumento(id){

            $.ajax({
                url  : "<?php echo Yii::app()->createURL('documento/delete');?>",
                type : 'post',
                cache: false ,
                data : { id:id },
                success: function(data){
                    if(data.status =='success'){
                        $.fn.yiiListView.update('list');
                    }
                }
            });

            return false;
    }


</script>
