<!-- cdn fontawesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>

<script language="javascript">
function mostrardiv() {
div = document.getElementById('flotante');
div.style.display ='';
div1 = document.getElementById('mostrarDiv');
div1.style.display ='none';
}
function cerrar() {
div = document.getElementById('flotante');
div.style.display='none';
div1 = document.getElementById('mostrarDiv');
div1.style.display ='';
}
function valida_envia(form){
    if (form.enviar_boletin.checked){
        op = 1;
    }else{
        op = 0;
    }
    if(op){
        if (confirm('¿Está seguro que desea Procesar la Etapa y \nEnviar la notificación a los postulantes?')){
           form.submit();
        }        
    }else{
        if (confirm('¿Está seguro que desea Procesar la Etapa?')){
           form.submit();
        }
    }
} 
</script>
<div id="listado">
    <div class="scrollh">
<?php
$this->load->view('cabecera');
$this->load->view($this->carpeta.'etapas',$id);
?>
<?php
$prefijo='pos_';
$sitio=$this->tool_entidad->sitioindexpri();
$alineacionw='center';
$alineacionh='middle';
$alineacionwc2='center';
$alineacionhc2='middle';
?>
    
    <div align="left"><?php echo anchor($this->controlador,'Atras',array('class' =>'enlace_retornar enlace_a1')); ?> &nbsp; <?php  echo anchor($this->controlador.'etapas/id/'.$id,'Cancelar',array('class' =>'enlace_cancelar enlace_a1')); ?>
	<br/>
	<div class="container-fluid">
		<div class="row justify-content-end">
			<div class="col-md-5">
			<b>CCV = Corrección CV, EP = Entrevista Preliminar, TP = Toma de Pruebas</b>
			<br>
			<br>
			</div>
		</div>
	</div>
	</div>
	<?php echo form_open_multipart($action); ?>
    <input type="hidden" name="id" value="<?php echo $id;?>"/>
    <div class="scrollh">
    <table  align="center" class="tabla_listado"  cellspacing="0" width="100%">
        <tr class="cabecera_listado">
            <?php for($i=0;$i<count($campos_listar);$i++) { ?>
            <td> <?php echo $campos_listar[$i];?> </td>
            <?php } ?>
            <td> Instancia </td>
            <td> Observación </td>
            <td> Recomendación </td>
            <td> Carpeta </td>
        </tr>
        <?php
        if($datos){
            foreach ($datos as $fila) {                
            ?>
        <tr>
            <?php $dato_ci=''; ?>
            <?php
                for($i=0;$i<count($campos_reales);$i++) {
            ?>
                <td>
                    <?php echo $fila[strtolower($campos_reales[$i])];
                    $dato_ci= $fila[strtolower($campos_reales[2])];//ci del postulante
                ?>&nbsp;</td>
            <?php
                }
            ?>
                <td>
                <?php $campo1='instancia'.$fila['id'];
                    if(@$fila['espera']){
                        $id_instancia=7;
                    }else{
                        $id_instancia=@$fila['instancia'];                        
                    }
                    echo form_dropdown($campo1,$instancia,$id_instancia);
                ?>
                </td>
                <td>
                <?php
                    $nombre='observacion'.$fila['id'];
                    echo "<textarea name=" . $nombre . " id=" . $nombre . "
                    class='input1' rows='5' cols='20' style='resize: none' >" . $fila['observacionp'] . "</textarea>";
//                    echo form_textarea(array(
//                        'name' => $nombre,
//                        'id' => $nombre,
//                        'class' => 'input1',
//                        'rows' => '5',
//                        'cols' => '20',
//                        'value' => $fila['observacionp']
//                      ));
                ?>
                </td>
                <td>
                <?php $campo1='recomendacion'.$fila['id'];
                    echo form_dropdown($campo1,$this->recomendaciones,$fila['recomendacion']);
                ?>
                </td>
                <td align="?php echo $alineacionw; ?>" valign="?php echo $alineacionh; ?>" >
                       <?php echo anchor($this->controlador . 'folder_postulante/' . $dato_ci, '<i class="fas fa-folder-open"></i> ', array('class' => 'enlace_a1','style'=>'font-size: 24px;')); ?>

                       
                    </td> 
        </tr>
            <?php
            }
        }
            ?>
    </table>
    </div>

    <br/>
    <?php if($etapa<4){ ?>
    <b><?php echo form_label('Enviar Notificaciones a los Postulantes');?></b>
    <input type="checkbox" name="enviar_boletin" value="1" checked /><br/><br/>
    <div id="mostrarDiv" align="left"><a href="javascript:mostrardiv();">Personalizar Notificación</a></div>
    <div id="flotante" style="display:none;">
        <div align="left"><a href="javascript:cerrar();">Cerrar Personalización de Notificacion</a></div><br/>
        <table id="form_admin">
            <tr>                
                <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
                    <?php
                        echo form_textarea(array(
                            'name' => 'contenido',
                            'id' => 'contenido',
                            'rows' => '5',
                            'cols' => '60',
                            'class'=>'textarea',
                            'class'=>'tinymce',
                            'value' => $notificacion['not_contenido']
                          ));
                    ?>
                </td>
            </tr>
        </table>        
    </div><br/>
    <?php }?>
	<input class="btn btn-etika" name="observacion" type="submit" value="Guardar observaciones" style="cursor:pointer;padding:5px;" onClick="return confirmar('Se guardará solo las observaciones y recomendaciones registradas sin procesar la etapa ¿Está seguro de continuar?');">
    <?php if($etapa==4){?>
    <input class="btn btn-etika" name="enviar" type="submit" onClick="return confirmar('¿Está seguro que desea Procesar la Etapa, \n Se eliminarán de la lista de la convocatoria a todos los postulantes que no pasaron de la instacia CCV o Espera?');">
    <?php }else{?>
    <input class="btn btn-etika" name="enviar" type="button" value="  Procesar Etapa  " onclick="valida_envia(this.form)">
    <?php }?>        
<?php echo form_close() ?>
    </div>
</div>


