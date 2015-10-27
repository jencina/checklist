
<div class="page-header">
    <h1>Checklist <small>Detalle #<?php echo $model->id; ?></small></h1>
</div>


<div class="panel panel-primary">

    <div class="panel-heading">
        <span>Identificacion del Usuario</span>
    </div>

    <div class="panel-body">


        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Fecha Inicio:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $model->fecha_inicio; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Fecha Termino:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $model->fecha_termino; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Hora Inicio:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $model->hora_inicio; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Hora Termino:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $model->hora_termino; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Estado:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($model->estado->nombre)?$model->estado->nombre:''; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Usuario:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($model->usuario->nombre)?$model->usuario->nombre:''; ?></label>
            </div>
        </div>



    </div>

</div>



<!-- VALIDACION TIPO CHECKLIST-->

<?php if($model->localidad->proyecto->tipo_checklist_id == 1){?>


<div class="panel panel-primary">

    <div class="panel-heading">
        <span>Identificacion del Usuario</span>
    </div>

    <div class="panel-body">
        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Nombre:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $usuario->nombre; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Proyecto:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($model->localidad->proyecto->nombre)?$model->localidad->proyecto->nombre:''; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Departamento:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($model->localidad->proyecto->departamento->nombre)?$model->localidad->proyecto->departamento->nombre:''; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Email:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $usuario->email; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Telefono:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $usuario->telefono; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Region:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($model->localidad->region->nombre)?$model->localidad->region->nombre:''; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Comuna:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($model->localidad->comuna->nombre)?$model->localidad->comuna->nombre:''; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Direccion:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($model->localidad->direccion)?$model->localidad->direccion:''; ?></label>
            </div>
        </div>

    </div>

</div>



<!-- INFORMACION EQUIPO -->

<div class="panel panel-primary">

    <div class="panel-heading">
        <span>Informacion Equipo</span>
    </div>

    <div class="panel-body">
        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Ram:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $informacionEquipo->ram; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Disco:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $informacionEquipo->disco; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Cpu:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($informacionEquipo->cpu->modelo)?$informacionEquipo->cpu->modelo:''; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Monitor:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($informacionEquipo->monitor->modelo)?$informacionEquipo->monitor->modelo:''; ?></label>
            </div>
        </div>

    </div>

</div>

<!-- FIN INFORMACION EQUIPO-->


<!-- IMPRESORA -->

<div class="panel panel-primary">

    <div class="panel-heading">
        <span>Impresora</span>
    </div>

    <div class="panel-body">
        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Puerto:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $impresora->puerto; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Pdfcmon:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $impresora->pdfcmon; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Usb001:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $impresora->usb001; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Ip:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $impresora->ip; ?></label>
            </div>
        </div>

    </div>

</div>

<!-- FIN IMPRESORA-->

<!-- Sistema Operativo -->

<div class="panel panel-primary">

    <div class="panel-heading">
        <span>Sistema Operativo</span>
    </div>

    <div class="panel-body">
        <div class="col-sm-12">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Sistema Operativo:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php  echo isset($model->sistemaOperativo->version)?$model->sistemaOperativo->version:''; ?></label>
            </div>
        </div>
    </div>

</div>

<!-- FIN SISTEMA OPERATIVO-->

<!-- FOTOS -->

<div class="panel panel-primary">

    <div class="panel-heading">
        <span>Fotos</span>
    </div>

    <div class="panel-body">
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <?php if($foto->antes_1 != null || $foto->antes_1!= ''){ ?>
                    <img id="img-antes-1" src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist/images/checklist_<?php echo $model->id.'/'.$foto->antes_1; ?>" />
                <?php }else{ ?>
                    <img id="img-antes-1" src="<?php echo Yii::app()->request->baseUrl; ?>/images/no_image.png" />
                <?php } ?>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <?php if($foto->antes_2 != null || $foto->antes_2 != ''){ ?>
                    <img id="img-antes-2" src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist/images/checklist_<?php echo $model->id.'/'.$foto->antes_2; ?>" />
                <?php }else{ ?>
                    <img id="img-antes-2" src="<?php echo Yii::app()->request->baseUrl; ?>/images/no_image.png" />
                <?php } ?>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <?php if($foto->antes_3 != null || $foto->antes_3 != ''){ ?>
                    <img id="img-antes-3" src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist/images/checklist_<?php echo $model->id.'/'.$foto->antes_3; ?>" />
                <?php }else{ ?>
                    <img id="img-antes-3" src="<?php echo Yii::app()->request->baseUrl; ?>/images/no_image.png" />
                <?php } ?>
            </div>
        </div>



        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <?php if($foto->despues_1 != null || $foto->despues_1!= ''){ ?>
                    <img id="img-despues-1" src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist/images/checklist_<?php echo $model->id.'/'.$foto->despues_1; ?>" />
                <?php }else{ ?>
                    <img id="img-despues-1" src="<?php echo Yii::app()->request->baseUrl; ?>/images/no_image.png" />
                <?php } ?>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <?php if($foto->despues_2 != null || $foto->despues_2 != ''){ ?>
                    <img id="img-despues-2" src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist/images/checklist_<?php echo $model->id.'/'.$foto->despues_2; ?>" />
                <?php }else{ ?>
                    <img id="img-despues-2" src="<?php echo Yii::app()->request->baseUrl; ?>/images/no_image.png" />
                <?php } ?>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <?php if($foto->antes_3 != null || $foto->antes_3 != ''){ ?>
                    <img id="img-despues-3" src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist/images/checklist_<?php echo $model->id.'/'.$foto->despues_3; ?>" />
                <?php }else{ ?>
                    <img id="img-despues-3" src="<?php echo Yii::app()->request->baseUrl; ?>/images/no_image.png" />
                <?php } ?>
            </div>
        </div>

    </div>
</div>

<!-- FIN FOTOS-->

<!-- CONFIGURACION RED -->

<div class="panel panel-primary">

    <div class="panel-heading">
        <span>Configuracion Red</span>
    </div>

    <div class="panel-body">

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Usuario:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $configuracionRed->usuario; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Dominio:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $configuracionRed->dominio; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Nombre Maquina:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $configuracionRed->nombre_maquina; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Red:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $configuracionRed->red; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Mascara:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $configuracionRed->mascara; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Puerto Enlace:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $configuracionRed->puerto_enlace; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Dns Preferencial:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $configuracionRed->dns_preferencial; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Dns Alternativo:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $configuracionRed->dns_alternativo; ?></label>
            </div>
        </div>


    </div>

</div>

<!-- FIN CONFIGURACION RED-->

<!-- MIGRACION -->

<div class="panel panel-primary">

    <div class="panel-heading">
        <span>Migracion</span>
    </div>

    <div class="panel-body">

        <div class="page-header" style="width: 100%;float: left;margin: 0 0 20px">
            <h1><small>Antes</small></h1>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Ram Antes:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $migracion->ram_antes; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Disco Antes:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $migracion->disco_antes; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Cpu Antes:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($migracion->cpuIdAntes->modelo)?$migracion->cpuIdAntes->modelo:''; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Monitor:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($migracion->monitorIdAntes->modelo)?$migracion->monitorIdAntes->modelo:''; ?></label>
            </div>
        </div>

        <div class="page-header" style="width: 100%;float: left;margin: 0 0 20px">
            <h1 style="margin: 0"><small>Despues</small></h1>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Ram Despues:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $migracion->ram_despues; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Disco Despues:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $migracion->disco_despues; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Cpu Despues:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($migracion->cpuIdDespues->modelo)?$migracion->cpuIdDespues->modelo:''; ?></label>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Monitor Despues:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($migracion->monitorIdDespues->modelo)?$migracion->monitorIdDespues->modelo:''; ?></label>
            </div>
        </div>

    </div>

</div>

<!-- FIN MIGRACION-->

<?php } ?>

<!-- Sistema Operativo -->

<div class="panel panel-primary">

    <div class="panel-heading">
        <span>Tareas</span>
    </div>

    <div class="panel-body">

        <?php foreach($tareas as $ta){?>
        <div class="col-sm-12">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%"><?php echo $ta->tarea->nombre?>:</label>
                <label class="col-md-6" style="font-size: 20px;font-weight: lighter;"><?php  echo 'Precio: '.$ta->tarea->precio ?></label>
                <label class="col-md-6" style="font-size: 20px;font-weight: lighter;"><?php  echo 'Estado: '.$ta->estado->nombre ?></label>
            </div>
        </div>
        <?php }?>


    </div>

</div>

<!-- FIN SISTEMA OPERATIVO-->

<!-- OBSERVACION -->

<div class="panel panel-primary">

    <div class="panel-heading">
        <span>Observacion</span>
    </div>

    <div class="panel-body">
        <div class="col-sm-12">
            <div class="form-group" style="padding-left: 10px">
                <label class="control-label" style="width: 100%">Observacion:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php  echo isset($model->observacion)?$model->observacion:''; ?></label>
            </div>
        </div>
    </div>

</div>

<!-- FIN OBSERVACION-->
