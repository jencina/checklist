<table>
    <tr>
        <td style="width: 120px">
            <img style="width: 120px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png">
        </td>
        <td style="text-align: center;width: 600px;">
            <span style="font-size: 30px;font-weight: 800">Checklist de Usuario Final</span>
        </td>
    </tr>
</table>



<div class="datagrid">

    <table>
        <thead>
             <tr>
                 <th colspan="2"><span>Identificacion del Usuario</span></th>
             </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <span style="font-weight:bold">Nombre:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $usuario->nombre; ?></label>
            </td>

            <td>
                <span style="font-weight:bold">Cliente:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($model->localidad->proyecto->nombre)?$model->localidad->proyecto->nombre:''; ?></label>
            </td>
        </tr>

        <tr>
            <td>
                <span style="font-weight:bold">Departamento:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($model->localidad->proyecto->departamento->nombre)?$model->localidad->proyecto->departamento->nombre:''; ?></label>
            </td>

            <td>
                <span style="font-weight:bold">Email:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $usuario->email; ?></label>
            </td>
        </tr>

        <tr>
            <td>
                <span style="font-weight:bold">Telefono:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $usuario->telefono; ?></label>
            </td>

            <td>
                <span style="font-weight:bold">Region:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($model->localidad->region->nombre)?$model->localidad->region->nombre:''; ?></label>
            </td>
        </tr>

        <tr>
            <td>
                <span style="font-weight:bold">Comuna:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($model->localidad->comuna->nombre)?$model->localidad->comuna->nombre:''; ?></label>
            </td>

            <td>
                <span style="font-weight:bold">Direccion:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($model->localidad->direccion)?$model->localidad->direccion:''; ?></label>
            </td>
        </tr>
        </tbody>
    </table>
</div>


<?php if($model->localidad->proyecto->tipo_checklist_id == 1){?>

<!-- INFORMACION EQUIPO -->

<div class="datagrid">
    <table>
        <thead>
        <tr>
            <th colspan="2"><span>Informacion Equipo</span></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <span style="font-weight:bold">Ram:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $informacionEquipo->ram; ?></label>
            </td>
            <td>
                <span style="font-weight:bold">Disco:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $informacionEquipo->disco; ?></label>
            </td>
        </tr>

        <tr>
            <td>
                <span style="font-weight:bold">Cpu:</span>
            <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($informacionEquipo->cpu->modelo)?$informacionEquipo->cpu->modelo:''; ?></label>
            </td>

            <td>
                <span style="font-weight:bold">Monitor:</span>
            <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($informacionEquipo->monitor->modelo)?$informacionEquipo->monitor->modelo:''; ?></label>
           </td>
        </tr>
        </tbody>
    </table>
</div>

<!-- FIN INFORMACION EQUIPO-->



<!-- IMPRESORA -->

<div class="datagrid">
    <table>
        <thead>
        <tr>
            <th colspan="2"><span>Impresora</span></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <span style="font-weight:bold">Puerto:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $impresora->puerto; ?></label>
            </td>

            <td>
                <span style="font-weight:bold">Pdf Cmon:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $impresora->pdfcmon; ?></label>
            </td>
        </tr>

        <tr>
            <td>
                <span style="font-weight:bold">Usb001:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $impresora->usb001; ?></label>
            </td>
            <td>
                <span style="font-weight:bold">Ip:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $impresora->ip; ?></label>
            </td>
        </tr>

        </tbody>
    </table>
</div>
<!-- FIN IMPRESORA-->

<!-- Sistema Operativo -->
<div class="datagrid">
    <table>
        <thead>
        <tr>
            <th colspan="2"><span>Sistema Operativo</span></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <span style="font-weight:bold">Sistema Operativo:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php  echo isset($model->sistemaOperativo->version)?$model->sistemaOperativo->version:''; ?></label>
            </td>
        </tr>

        </tbody>
    </table>
</div>

<!-- FIN SISTEMA OPERATIVO-->



<!-- FOTOS -->
<div class="datagrid">
    <table>
        <thead>
            <tr>
                <th colspan="3" style="height: 20px;
                "><span style="font-size: 13px">Fotos</span></th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="3" style="border-bottom: 1px solid #ddd;margin-left: 10px"><span style="font-weight: bold">Antes</span></td>
        </tr>
        <tr>
            <td>
                <?php if($foto->antes_1 != null || $foto->antes_1!= ''){ ?>
                    <img id="img-antes-1" style="height: 150px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist/images/checklist_<?php echo $model->id.'/'.$foto->antes_1; ?>" />
                <?php }else{ ?>
                    <img id="img-antes-1" style="height: 150px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/no_image.png" />
                <?php } ?>
            </td>

            <td>
                <?php if($foto->antes_2 != null || $foto->antes_2 != ''){ ?>
                    <img id="img-antes-2" style="height: 150px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist/images/checklist_<?php echo $model->id.'/'.$foto->antes_2; ?>" />
                <?php }else{ ?>
                    <img id="img-antes-2" style="height: 150px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/no_image.png" />
                <?php } ?>
            </td>

            <td>
                <?php if($foto->antes_3 != null || $foto->antes_3 != ''){ ?>
                    <img id="img-antes-3" style="height: 150px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist/images/checklist_<?php echo $model->id.'/'.$foto->antes_3; ?>" />
                <?php }else{ ?>
                    <img id="img-antes-3" style="height: 150px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/no_image.png" />
                <?php } ?>
            </td>

        </tr>

        <tr>
            <td colspan="3" style="border-bottom: 1px solid #ddd;margin-left: 10px"><span style="font-weight: bold">Despues</span></td>
        </tr>

        <tr>
            <td style="width: 30%">
                <?php if($foto->despues_1 != null || $foto->despues_1!= ''){ ?>
                    <img  style="height: 150px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist/images/checklist_<?php echo $model->id.'/'.$foto->despues_1; ?>" />
                <?php }else{ ?>
                    <img  style="height: 150px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/no_image.png" />
                <?php } ?>
            </td>
            <td>
                <?php if($foto->despues_2 != null || $foto->despues_2 != ''){ ?>
                    <img  style="height: 150px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist/images/checklist_<?php echo $model->id.'/'.$foto->despues_2; ?>" />
                <?php }else{ ?>
                    <img  style="height: 150px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/no_image.png" />
                <?php } ?>
            </td>
            <td>
                <?php if($foto->antes_3 != null || $foto->antes_3 != ''){ ?>
                    <img  style="height: 150px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist/images/checklist_<?php echo $model->id.'/'.$foto->despues_3; ?>" />
                <?php }else{ ?>
                    <img  style="height: 150px" src="<?php echo Yii::app()->request->baseUrl; ?>/images/no_image.png" />
                <?php } ?>
            </td>
        </tr>

        </tbody>
    </table>
</div>
<!-- FIN FOTOS-->


<pagebreak />

<!-- CONFIGURACION RED -->

<div class="datagrid">
    <table>
        <thead>
        <tr>
            <th colspan="2"><span>Identificacion del Usuario</span></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <span style="font-weight:bold">Usuario:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $configuracionRed->usuario; ?></label>
            </td>
            <td>
                <span style="font-weight:bold">Dominio:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $configuracionRed->dominio; ?></label>
            </td>
        </tr>

        <tr>
            <td>
                <span style="font-weight:bold">Nombre Maquina:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $configuracionRed->nombre_maquina; ?></label>
            </td>
            <td>
                <span style="font-weight:bold">Red:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $configuracionRed->red; ?></label>
            </td>
        </tr>

        <tr>
            <td>
                <span style="font-weight:bold">Puerto Enlace:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $configuracionRed->puerto_enlace; ?></label>
            </td>
            <td>
                <span style="font-weight:bold">Dns Preferencial:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $configuracionRed->dns_preferencial; ?></label>
            </td>
        </tr>

        <tr>
            <td>
                <span style="font-weight:bold">Dns Alternativo:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $configuracionRed->dns_alternativo; ?></label>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<!-- FIN CONFIGURACION RED-->

<!-- MIGRACION -->

<div class="datagrid">
    <table>
        <thead>
        <tr>
            <th colspan="2"><span>Migracion</span></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="2" style="border-bottom: 1px solid #ddd;margin-left: 10px"><span style="font-weight: bold">Antes</span></td>
        </tr>
        <tr>
            <td>
                <span style="font-weight:bold">Ram Antes:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $migracion->ram_antes; ?></label>
            </td>
            <td>
                <span style="font-weight:bold">Disco Antes:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $migracion->disco_antes; ?></label>
            </td>
        </tr>

        <tr>
            <td>
                <span style="font-weight:bold">Cpu Antes:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($migracion->cpuIdAntes->modelo)?$migracion->cpuIdAntes->modelo:''; ?></label>
            </td>
            <td>
                <span style="font-weight:bold">Monitor Antes:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($migracion->monitorIdAntes->modelo)?$migracion->monitorIdAntes->modelo:''; ?></label>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="border-bottom: 1px solid #ddd;margin-left: 10px"><span style="font-weight: bold">Despues</span></td>
        </tr>

        <tr>
            <td>
                <span style="font-weight:bold">Ram Despues:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $migracion->ram_despues; ?></label>
            </td>
            <td>
                <span style="font-weight:bold">Disco Despues:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo $migracion->disco_despues; ?></label>
            </td>
        </tr>

        <tr>
            <td>
                <span style="font-weight:bold">Cpu Despues:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($migracion->cpuIdDespues->modelo)?$migracion->cpuIdDespues->modelo:''; ?></label>
            </td>
            <td>
                <span style="font-weight:bold">Monitor Despues:</span>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php echo isset($migracion->monitorIdDespues->modelo)?$migracion->monitorIdDespues->modelo:''; ?></label>
            </td>
        </tr>

        </tbody>
    </table>
</div>

<!-- FIN MIGRACION-->

<?php } ?>

<!-- Sistema Operativo -->
<div class="datagrid">
    <table>
        <thead>
        <tr>
            <th colspan="2"><span>Tareas</span></th>
        </tr>
        </thead>
        <tbody>

        <?php foreach($tareas as $ta){?>

            <tr>
                <td>
                    <span style="font-weight:bold"><?php echo $ta->tarea->nombre?>:</span>
                    <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php  echo $ta->tarea->precio?></label>
                </td>
            </tr>

        <?php }?>
        </tbody>
    </table>
</div>

<!-- FIN SISTEMA OPERATIVO-->



<!-- OBSERVACION -->

<div class="datagrid">
    <table>
        <thead>
        <tr>
            <th colspan="5"><span>Observaciones</span></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="5">
                <label class="control-label" style="width: 100%">Observacion:</label>
                <label style="width: 100%;font-size: 20px;font-weight: lighter;"><?php  echo isset($model->observacion)?$model->observacion:''; ?></label>
            </td>
        </tr>

        <tr style="padding: 10px;">
            <td></td>
            <td style="width: 200px;border-bottom:1px solid #222;content:' ';"></td>
            <td></td>
            <td style="width: 200px;border-bottom:1px solid #222;content:' ';"></td>
            <td></td>
        </tr>

        <tr style="padding: 10px;">
            <td></td>
            <td style="width: 200px;border-bottom:1px solid #ddd;content:' ';text-align:center;">Firma Tecnico</td>
            <td></td>
            <td style="width: 200px;border-bottom:1px solid #ddd;content:' ';text-align:center;">Firma Usuario Final</td>
            <td></td>
        </tr>

        </tbody>
    </table>
</div>

<!-- FIN OBSERVACION-->

</table>