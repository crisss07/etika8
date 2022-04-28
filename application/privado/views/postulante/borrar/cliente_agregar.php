<?php  
$prefijo=$this->prefijo;
?>
<?php
$this->load->view('cabecera');
?>
<?php
$this->load->view('opciones');
$alineacionwc1='center';
$alineacionhc1='middle';
$alineacionwc2='left';
$alineacionhc2='middle';
?>
<?php echo form_open_multipart($action); ?>
<input type="hidden" name="<?php echo $prefijo.'id';?>" value="<?php echo set_value($prefijo.'id',$fila[$prefijo.'id']);?>">
<table id="form_admin">
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            <?php echo form_label('Nombre de la Empresa: ', $prefijo.'nombre');?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php 
                
                echo form_input(array(
                    'name' => $prefijo.'nombre',
                    'id' => $prefijo.'nombre',
                    'class' => 'input1',
                    'size' => '80',
                    'value' => set_value($prefijo.'nombre',$fila[$prefijo.'nombre'])
                  ));

                  if(form_error($prefijo.'nombre'))
                     echo '<div class="error">'.form_error($prefijo.'nombre').'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            <?php echo form_label('NIT: ', $prefijo.'nit');?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php

                echo form_input(array(
                    'name' => $prefijo.'nit',
                    'id' => $prefijo.'nit',
                    'class' => 'input1',
                    'size' => '80',
                    'value' => set_value($prefijo.'nit',$fila[$prefijo.'nit'])
                  ));

                  if(form_error($prefijo.'nit'))
                     echo '<div class="error">'.form_error($prefijo.'nit').'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            <?php echo form_label('Dirección: ', $prefijo.'direccion');?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php

                echo form_input(array(
                    'name' => $prefijo.'direccion',
                    'id' => $prefijo.'direccion',
                    'class' => 'input1',
                    'size' => '80',
                    'value' => set_value($prefijo.'direccion',$fila[$prefijo.'direccion'])
                  ));

                  if(form_error($prefijo.'direccion'))
                     echo '<div class="error">'.form_error($prefijo.'direccion').'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            <?php echo form_label('Teléfono(s): ', $prefijo.'telefono');?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php

                echo form_input(array(
                    'name' => $prefijo.'telefono',
                    'id' => $prefijo.'telefono',
                    'class' => 'input1',
                    'size' => '80',
                    'value' => set_value($prefijo.'telefono',$fila[$prefijo.'telefono'])
                  ));

                  if(form_error($prefijo.'telefono'))
                     echo '<div class="error">'.form_error($prefijo.'telefono').'</div>';
            ?>
        </td>
    </tr>
   
</table>


<br/>
<?php echo form_submit('enviar', '  Guardar  ') ?>
    
<?php echo form_close() ?>
