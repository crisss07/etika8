<?php
$this->load->view('cabecera');
?>
<?php  
$prefijo=$this->prefijo1;
$alineacionwc1='center';
$alineacionhc1='middle';
$alineacionwc2='left';
$alineacionhc2='middle';
?>
<?php
    echo '<br/><div align="center">'.anchor($this->controlador.'instruccion_formal/id/'.$ids,'Cancelar',array('class' =>'enlace_cancelar enlace_a1')).'</div><br/>';
?>
<?php echo form_open_multipart($action); ?>

<?php
   echo form_hidden($prefijo.'id', set_value($prefijo.'id',$fila[$prefijo.'id']));
?>
<input type="hidden" name="<?php echo $prefijo.'id';?>" value="<?php echo set_value($prefijo.'id',$fila[$prefijo.'id']);?>">
<input type="hidden" name="<?php echo 'ids';?>" value="<?php echo $ids;?>">
    <table id="form_admin">
        <tr>
            <td colspan="2" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
                <?php $fecha='desde';?>
                <?php echo form_label('Desde: ', $prefijo.$nombre);?>
                <?php
                if(!$fila[$prefijo.$fecha])
                    {
                        $fila[$prefijo.$fecha]='aaaa';
                    }
                 ?>
                <input maxlength="4" type="input" class="input1_normal" style="color:#aca899;" id="<?php echo $prefijo.$fecha;?>" name="<?php echo $prefijo.$fecha;?>" size="3" onFocus="if(this.value == 'aaaa'){this.value='';this.style.color='#000000';}" onBlur="if(this.value == ''){this.value='aaaa';this.style.color='#aca899';}" value="<?php echo set_value($prefijo.$fecha,$fila[$prefijo.$fecha]);?>" ><span class="texto2">&nbsp;Año</span>
                <?php $fecha='hasta';?>
                <?php echo form_label('Hasta: ', $prefijo.$nombre);?>
                <?php
                if(!$fila[$prefijo.$fecha])
                    {
                        $fila[$prefijo.$fecha]='aaaa';
                    }
                ?>
                <input maxlength="4" type="input" class="input1_normal" style="color:#aca899;" id="<?php echo $prefijo.$fecha;?>" name="<?php echo $prefijo.$fecha;?>" size="3" onFocus="if(this.value == 'aaaa'){this.value='';this.style.color='#000000';}" onBlur="if(this.value == ''){this.value='aaaa';this.style.color='#aca899';}" value="<?php echo set_value($prefijo.$fecha,$fila[$prefijo.$fecha]);?>" ><span class="texto2">&nbsp;Año</span>
                <?php
                      if(form_error($prefijo.'desde')||form_error($prefijo.'hasta'))
                         echo '<div class="error">Debe ingresar un Formato correcto de fecha</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
                <?php $nombre='institucion';?>
                <?php echo form_label('Institución: ', $prefijo.$nombre);?>
            </td>
            <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
                <?php
                    echo "<input type='text' name='".$prefijo.$nombre."' id='".$prefijo.$nombre."'
                                    class='input1' size='25' onblur='Mayusculas(this.value,this.id)' value='".$fila[$prefijo .$nombre ]."' />";
//                    echo form_input(array(
//                        'name' => $prefijo.$nombre,
//                        'id' => $prefijo.$nombre,
//                        'class' => 'input1',
//                        'size' => '25',
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
                <?php $nombre='pais';?>
                <?php echo form_label('País: ', $prefijo.$nombre);?>
            </td>
            <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
                <?php
                    echo "<input type='text' name='".$prefijo.$nombre."' id='".$prefijo.$nombre."'
                                    class='input1' size='10' onblur='Mayusculas(this.value,this.id)' value='".$fila[$prefijo .$nombre ]."' />";
//                    echo form_input(array(
//                        'name' => $prefijo.$nombre,
//                        'id' => $prefijo.$nombre,
//                        'class' => 'input1',
//                        'size' => '10',
//                        'onblur'=>'Mayusculas(this.value,this.id)',
//                        'value' => set_value($prefijo.$nombre,$fila[$prefijo.$nombre])
//                      ));

                      if(form_error($prefijo.$nombre))
                         echo '<div class="error">'.form_error($prefijo.$nombre).'</div>';
                ?>
            </td>
        </tr>        
    </table>
<br/>
<?php echo form_submit('enviar', '  Guardar  '); ?>
    
<?php echo form_close() ?>
