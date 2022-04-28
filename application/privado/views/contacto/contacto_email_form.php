<?php  
$prefijo=$this->prefijo;
?>
<?php
$this->load->view('cabecera');
?>
<div align="left" ><?php  echo anchor('configuracion','Cancelar',array('class' =>'enlace_cancelar enlace_a1')); ?></div><br/>
<?php
$alineacionwc1='center';
$alineacionhc1='middle';
$alineacionwc2='left';
$alineacionhc2='middle';
?>
<?php echo form_open_multipart($action.'/sub/'.$this->sub); ?>

<?php
   
   for($i=0;$i<count(array(@$this->campoup_img));$i++)
     {
        $j=$i+1;
       
        echo form_hidden($prefijo.'img_borrar'.$j, @set_value($prefijo.'img_borrar'.$j,$fila[$prefijo.'img_borrar'.$j]));
     }

  for($i=0;$i<count(array(@$this->campoup_adj));$i++)
     {
        $j=$i+1;
       

        echo form_hidden($prefijo.'adj_borrar'.$j, @set_value($prefijo.'adj_borrar'.$j,$fila[$prefijo.'adj_borrar'.$j]));
     }
   

?>
<?php
echo form_hidden($prefijo.'pie',@set_value($fila[$prefijo.'pie']));
echo form_hidden('con_mesaje_enviado',@set_value($fila['con_mesaje_enviado']));
?>
<input type="hidden" name="<?php echo $prefijo.'id';?>" value="<?php echo set_value($prefijo.'id',$fila[$prefijo.'id']);?>">
<input type="hidden" name="tip" value="<?php print_r(@set_value($this->tip,$this->tip));?>">
<table id="form_admin">            
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            <?php $email=$prefijo.'email';?>
            <?php echo form_label('Email:<br/><span class="texto2">(ejemplo@sitio.com)</span>',$email);?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php

                echo form_input(array(
                    'name' => $email,
                    'id' => $email,
                    'class' => 'input1',
                    'size' => '60',
                    'value' => @set_value($email,$fila[$email])
                  ));

                  if(form_error($email))
                     echo '<div class="error">'.form_error($email).'</div>';
            ?>
        </td>
    </tr>    
    <!--
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
             <?php $fecha='fecha';?>
            <?php echo form_label('Fecha creacion: ', $prefijo.$fecha);?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php
            if(!$fila[$prefijo.$fecha])
                {
                    $fila[$prefijo.$fecha]=date('Y-m-d');

                }
                  echo form_input(array(
                      'name' => $prefijo.$fecha,
                      'id' => $prefijo.$fecha,
                      'class' => 'input1',
                      'size' => '20',
                      'value' => set_value($prefijo.$fecha,$fila[$prefijo.$fecha])
                      ));

                  if(form_error($prefijo.$fecha))
                     echo '<div class="error">'.form_error($prefijo.$fecha).'</div>';
            ?>

            &nbsp;&nbsp;Año-mes-dia
        </td>
    </tr>
  -->
<!--
     <?php
    if($fila[$prefijo.'img_borrar1'])
    {
    ?>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            Imagen anterior
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">

             <table cellpadding="2" class="tabla2">
                 <tr>
                    <td>
                        <div class="aviso1">
                        <input type="checkbox" name="solo_eliminar_img[]" value="1" class="check" <?php echo set_checkbox('solo_eliminar_img[]', '1'); ?> id="check_img1">
                        <span class="flecha1">&larr;</span> Marcar si desea eliminar la imagen
                        </div>

                    </td>
                </tr>
                <tr>
                    <td>
                         <img src="<?php echo $this->tool_entidad->sitio()."archivos/".$this->carpeta.$fila[$prefijo.'img_borrar1'];?>" height="100" alt="Imagen" align="middle"/>
                         <div id="eliminar_imagen"></div>
                         <br/><span class="texto_aviso1"><strong>Nota.-</strong> Si sube otra imagen la anterior se eliminará automáticamente.</span>
                    </td>
                </tr>
            </table>


        </td>
    </tr>
    <?php
    }
    ?>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            Imagen: <br/><span class="texto2">(.jpg  .gif  .png)</span>
             <?php //echo form_label('Imagen: <br/>(.jpg  .gif  .png) ', $prefijo.'img');?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
             <?php

                echo form_upload(array('name' => $prefijo.'img', 'id' => $prefijo.'img', 'size' =>'60','onBlur'=>'LimitAttach(this,1)'));

                if(form_error($prefijo.'img'))
                     echo '<div class="error">'.form_error($prefijo.'img').'</div>';
            ?>
            <br/>
            <div id="msj_alerta_imagen"></div>
        </td>
    </tr>    


    <?php
    if($fila[$prefijo.'adj_borrar1'])
    {
    ?>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            Archivo anterior
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">

             <table cellpadding="2" class="tabla2" align="<?php echo $alinear;?>">
                 <tr>
                    <td>
                        <div class="aviso1">
                         <input type="checkbox" name="solo_eliminar_adj[]" value="2" id="check_adj1">
                        <span class="flecha1">&larr;</span> Marcar si desea eliminar el archivo
                        </div>

                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                           $tipofile=$this->tool_general->tipofig_extension(strtolower(substr($fila[$this->prefijo.'adj_borrar1'],-4)));
                        ?>
                        <img src="<?php echo $this->rutaimg.$tipofile.'.gif';?>" alt="tipo"/>
                        <?php echo "<b>".$fila[$prefijo.'adj_borrar1']."</b>"; ?>

                         <div id="eliminar_archivo"></div>
                        <br/><span class="texto_aviso1"><strong>Nota.- </strong>Si sube otro archivo el anterior se eliminará automáticamente.</span>

                    </td>
                </tr>
            </table>

        </td>
    </tr>
    <?php
    }
    ?>

    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            <?php echo form_label('Archivo: ', $prefijo.'adj');?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php

                  echo form_upload(array('name' => $prefijo.'adj', 'id' => $prefijo.'adj','size'=>'60'));

                  if(form_error($prefijo.'adj'))
                     echo '<div class="error">'.form_error($prefijo.'adj').'</div>';
            ?>
        </td>
    </tr>
-->
   
</table>


<br/>
<?php echo form_submit(array(
                    'name' => $prefijo.'enviar',
                    'class' => 'btn-etika btn',
                    'value' => 'Guardar'));?>
    
<?php echo form_close() ?>
