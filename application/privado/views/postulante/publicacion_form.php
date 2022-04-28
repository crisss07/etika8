<?php
$this->load->view('cabecera');
?>
<?php  
$prefijo=$this->prefijo2;
$alineacionwc1='center';
$alineacionhc1='middle';
$alineacionwc2='left';
$alineacionhc2='middle';
?>
<?php echo form_open_multipart($action); ?>

<?php
   echo form_hidden($prefijo.'id', @set_value($prefijo.'id',$fila[$prefijo.'id']));
?>
<input type="hidden" name="<?php echo $prefijo.'id';?>" value="<?php echo @set_value($prefijo.'id',$fila[$prefijo.'id']);?>">
<input type="hidden" name="<?php echo 'ids';?>" value="<?php echo $ids;?>">
<?php
    echo '<br/><div align="center">'.anchor($this->controlador.'instruccion_formal/id/'.$ids,'Cancelar',array('class' =>'enlace_cancelar enlace_a1')).'</div><br/>';
?>
<div id="publicacion">
    <table id="form_admin">        
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
                <?php $nombre='titulo';?>
                <?php echo form_label('Titulo: ', $prefijo.$nombre);?>
            </td>
            <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
                <?php
                    echo "<input type='text' name='" . $prefijo . $nombre . "' id='" . $prefijo . $nombre . "'
                                    class='input1' size='30' onblur='Mayusculas(this.value,this.id)' value='" . $fila[$prefijo . $nombre] . "' />";
//                    echo form_input(array(
//                        'name' => $prefijo.$nombre,
//                        'id' => $prefijo.$nombre,
//                        'class' => 'input1',
//                        'size' => '30',
//                        'onblur'=>'Mayusculas(this.value,this.id)',
//                        'value' => set_value($prefijo.$nombre,$fila[$prefijo.$nombre])
//                      ));

                      if(form_error($prefijo.$nombre))
                         echo '<div class="error">'.form_error($prefijo.$nombre).'</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
                <?php $fecha='anio';?>
                <?php echo form_label('A&ntilde;o: ', $prefijo.$nombre);?>
            </td>
            <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
                <?php
                if(@!$fila[$prefijo.$fecha])
                    {
                        $fila[$prefijo.$fecha]=date('Y');
                    }
                      echo form_input(array(
                          'name' => $prefijo.$fecha,
                          'id' => $prefijo.$fecha,
                          'class' => 'input1',
                          'size' => '3',
                          'maxlength'=>'4',
                          'value' => set_value($prefijo.$fecha,$fila[$prefijo.$fecha])
                          ));

                      if(form_error($prefijo.$fecha))
                         echo '<div class="error">'.form_error($prefijo.$fecha).'</div>';
                ?>
            </td>
        </tr>
    </table>
</div>


<br/>
<?php
    echo form_submit('enviar', '  Guardar  ');
?>
    
<?php echo form_close() ?>
