<?php  
$prefijo=$this->prefijo;
?>
<?php
$this->load->view('cabecera');
?>
<div align="left" ><?php  echo anchor('notificacion','Cancelar',array('class' =>'enlace_cancelar enlace_a1')); ?></div><br/>
<?php
$alineacionwc1='center';
$alineacionhc1='middle';
$alineacionwc2='left';
$alineacionhc2='middle';
?>
<?php echo form_open_multipart($action.'/sub/'.@$this->sub); ?>


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
echo form_hidden($prefijo.'email',@set_value($fila[$prefijo.'email']));
?>
<input type="hidden" name="<?php echo $prefijo.'id';?>" value="<?php echo set_value($prefijo.'id',$fila[$prefijo.'id']);?>">
<input type="hidden" name="tip" value="<?php print_r(@set_value($this->tip,$this->tip));?>">
<table id="form_admin">
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
             <?php $fecha='titulo';?>
            
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
          <p class="form-label-21">Titulo: </p>
          <?php echo form_label('', $prefijo.$fecha);?>
            <?php
                  echo form_input(array(
                      'name' => $prefijo.$fecha,
                      'id' => $prefijo.$fecha,
                      'class' => 'input1',
                      'size' => '50',
                      'value' => @set_value($prefijo.$fecha,$fila[$prefijo.$fecha])
                      ));

                  if(form_error($prefijo.$fecha))
                     echo '<div class="error">'.form_error($prefijo.$fecha).'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>" >
          <br>

          <span class="form-label-21">Notificacion: </span>
         <?php echo form_label('', $prefijo.'contenido');?>
            <?php                 
                echo form_textarea(array(
                    'name' => $prefijo.'contenido',
                    'id' => $prefijo.'contenido',
                    'rows' => '5',
                    'cols' => '60',
                    'class'=>'textarea',
                    'class'=>'tinymce',
                    'value' => html_entity_decode($fila[$prefijo.'contenido'])
                  ));

                  if(form_error($prefijo.'contenido'))
                     echo '<div class="error">'.form_error($prefijo.'contenido').'</div>';
            ?>
        </td>
    </tr>                 
   
</table>


<br/>
<?php echo form_submit(array(
                    'name' => $prefijo.'enviar',
                    'class' => 'btn-etika btn',
                    'value' => 'Guardar'));?>
    
<?php echo form_close() ?>
