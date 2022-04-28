<?php
$this->load->view('cabecera');
?>
<?php    
$this->load->view('opciones');
$alineacionwc1='left';
$alineacionhc1='middle';
$alineacionwc2='left';
$alineacionhc2='middle';
$prefijo = $this->prefijo;
$prefijo1 = $this->prefijo1;
$consulta = $this->db->query('SELECT * FROM clientes ORDER BY cli_nombre asc');
$resultado=$consulta->result_array();
foreach ($resultado as $filas){
    $clientes[$filas['cli_id']]=$filas['cli_nombre'];
}
?>

<div id="cuerpo_form_admin">
<?php echo form_open_multipart($action); ?>  
<input type="hidden" name="<?php echo $prefijo.'id';?>" value="<?php echo set_value($prefijo.'id',$fila[$prefijo.'id']);?>">
<table id="form_admin">
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            <?php $campo1='id';?>
            <?php echo form_label(' Cliente: ', $prefijo1.$campo1);?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php
                echo form_dropdown($prefijo1.$campo1,$clientes,set_value($prefijo1.$campo1,$fila[$prefijo1.$campo1]));
                  if(form_error($prefijo1.$campo1))
                     echo '<div class="error">'.form_error($prefijo1.$campo1).'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            <?php $campo1='servicio';?>
            <?php echo form_label(' Servicio: ', $prefijo.$campo1);?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php
                echo form_dropdown($prefijo.$campo1,$this->servicios,set_value($prefijo.$campo1,$fila[$prefijo.$campo1]));
                  if(form_error($prefijo.$campo1))
                     echo '<div class="error">'.form_error($prefijo.$campo1).'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            <?php echo form_label('Nombre Contacto 1: ', $prefijo.'nombre1') ;?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php
                  echo form_input(array(
                    'name' => $prefijo.'nombre1',
                    'id' => $prefijo.'nombre1',
                    'size'=> '50',
                    'class'=>'input1',
                    'value' => set_value($prefijo.'nombre1',$fila[$prefijo.'nombre1'])
                    )) ;

                  if(form_error($prefijo.'nombre1'))
                    echo '<div class="error">'.form_error($prefijo.'nombre1').'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            <?php echo form_label('Email Contacto 1: ', $prefijo.'email1') ;?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php
                  echo form_input(array(
                    'name' => $prefijo.'email1',
                    'id' => $prefijo.'email1',
                    'size'=> '50',
                    'class'=>'input1',
                    'value' => set_value($prefijo.'email1',$fila[$prefijo.'email1'])
                    )) ;

                  if(form_error($prefijo.'email1'))
                    echo '<div class="error">'.form_error($prefijo.'email1').'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            <?php echo form_label('Teléfono Contacto 1: ', $prefijo.'telefono1') ;?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php
                  echo form_input(array(
                    'name' => $prefijo.'telefono1',
                    'id' => $prefijo.'telefono1',
                    'size'=> '50',
                    'class'=>'input1',
                    'value' => set_value($prefijo.'telefono1',$fila[$prefijo.'telefono1'])
                    )) ;

                  if(form_error($prefijo.'telefono1'))
                    echo '<div class="error">'.form_error($prefijo.'telefono1').'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            <?php echo form_label('Nombre Contacto 2: ', $prefijo.'nombre2') ;?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php
                  echo form_input(array(
                    'name' => $prefijo.'nombre2',
                    'id' => $prefijo.'nombre2',
                    'size'=> '50',
                    'class'=>'input1',
                    'value' => set_value($prefijo.'nombre2',$fila[$prefijo.'nombre2'])
                    )) ;

                  if(form_error($prefijo.'nombre2'))
                    echo '<div class="error">'.form_error($prefijo.'nombre2').'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            <?php echo form_label('Email Contacto 2: ', $prefijo.'email2') ;?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php
                  echo form_input(array(
                    'name' => $prefijo.'email2',
                    'id' => $prefijo.'email2',
                    'size'=> '50',
                    'class'=>'input1',
                    'value' => set_value($prefijo.'email2',$fila[$prefijo.'email2'])
                    )) ;

                  if(form_error($prefijo.'email2'))
                    echo '<div class="error">'.form_error($prefijo.'email2').'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            <?php echo form_label('Teléfono Contacto 2: ', $prefijo.'telefono2') ;?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php
                  echo form_input(array(
                    'name' => $prefijo.'telefono2',
                    'id' => $prefijo.'telefono2',
                    'size'=> '50',
                    'class'=>'input1',
                    'value' => set_value($prefijo.'telefono2',$fila[$prefijo.'telefono2'])
                    )) ;

                  if(form_error($prefijo.'telefono2'))
                    echo '<div class="error">'.form_error($prefijo.'telefono2').'</div>';
            ?>
        </td>
    </tr>
</table>


<br/>
<?php echo form_submit('enviar', '  Guardar  ') ?>
    
<?php echo form_close() ?>
</div>