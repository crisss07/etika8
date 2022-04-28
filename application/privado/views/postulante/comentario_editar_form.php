<?php
$this->load->view('cabecera');
?>
<?php  
$prefijo=$this->prefijo;
$alineacionwc1='center';
$alineacionhc1='middle';
$alineacionwc2='left';
$alineacionhc2='middle';
?>
<table align="center" cellpadding="10">
    <tr>
        <td class="enlaces_add_edit" align="center"><?php  echo anchor($this->controlador.'informacion_adicional/id/'.$fila[$prefijo.'id'],'Cancelar',array('class' =>'enlace_cancelar enlace_a1')); ?></td>
    </tr>
</table>
<?php echo form_open_multipart($action); ?>

<?php
   echo form_hidden($prefijo.'id', set_value($prefijo.'id',$fila[$prefijo.'id']));
?>
<input type="hidden" name="<?php echo $prefijo.'id';?>" value="<?php echo set_value($prefijo.'id',$fila[$prefijo.'id']);?>">
<table id="form_admin">
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            <?php $nombre='comentario';?>
            <?php echo form_label('Comentario Adicional: ', $prefijo.$nombre);?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php
                echo "<textarea name=".$prefijo.$nombre." id=".$prefijo.$nombre."
                                    class='input1' rows='4' cols='45' onblur='Mayusculas(this.value,this.id)'>".@$fila[$prefijo.$nombre]."</textarea>";
                
                  if(form_error($prefijo.$nombre))
                     echo '<div class="error">'.form_error($prefijo.$nombre).'</div>';
            ?>
        </td>
    </tr>    
</table>

<br/>
<?php echo form_submit('enviar', '  Guardar  ') ?>
    
<?php echo form_close() ?>
<br/>
