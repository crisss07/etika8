<?php  
$prefijo=$this->prefijo;
?>
<?php
$this->load->view('cabecera');
?>
<?php
$this->load->view('opciones');
$alineacionwc='center';
$alineacionwc1='right';
$alineacionhc1='middle';
$alineacionwc2='left';
$alineacionhc2='middle';
$bucket_url =$this->tool_entidad->aws_url();
?>
<br>
<?php echo form_open_multipart($action); ?>
<?php
for ($i = 0; $i < count($this->campoup_img); $i++) {
    $j = $i + 1;

    echo form_hidden($prefijo . 'img' . $j . '_borrar' . $j, @set_value($prefijo . 'img_borrar' . $j, $fila[$prefijo . 'img_borrar' . $j]));
}

?>
<input type="hidden" name="<?php echo $prefijo.'id';?>" value="<?php echo @set_value($prefijo.'id',$fila[$prefijo.'id']);?>">
<table id="form_admin">
    <tr>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>" colspan="2">
		    <p class="form-label-21">* Nombre Comercial: </p>
			<?php echo form_label('', $prefijo.'nombre');?>
            <?php 
                echo form_input(array(
                    'name' => $prefijo.'nombre',
                    'id' => $prefijo.'nombre',
                    'class' => 'input1',
                    'size' => '68',
                    'value' => @set_value($prefijo.'nombre',$fila[$prefijo.'nombre'])
                  ));

                  if(form_error($prefijo.'nombre'))
                     echo '<div class="error">'.form_error($prefijo.'nombre').'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>" colspan="2">
			<p class="form-label-21">Razón Social: </p>
			<?php 
			$campo='razon_social';
			echo form_label('', $prefijo.$campo);
			?>
            <?php 
                
                echo form_input(array(
                    'name' => $prefijo.$campo,
                    'id' => $prefijo.$campo,
                    'class' => 'input1',
                    'size' => '68',
                    'value' => @set_value($prefijo.$campo,$fila[$prefijo.$campo])
                  ));

                  if(form_error($prefijo.$campo))
                     echo '<div class="error">'.form_error($prefijo.$campo).'</div>';
            ?>
        </td>
    </tr>
	<tr>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>" colspan="2">
			<p class="form-label-21">* NIT: </p>
			<?php 
			$campo='nit';
			echo form_label('', $prefijo.$campo) ;
			?>
            <?php
                  echo form_input(array(
                    'name' => $prefijo.$campo,
                    'id' => $prefijo.$campo,
                    'size'=> '68',
                    'class'=>'input1',
                    'value' => @set_value($prefijo.$campo,$fila[$prefijo.$campo])
                    )) ;

                  if(form_error($prefijo.$campo))
                    echo '<div class="error">'.form_error($prefijo.$campo).'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>" colspan="2">
			<p class="form-label-21">Dirección: </p>
			<?php echo form_label('', $prefijo.'direccion');?>
            <?php

                echo form_input(array(
                    'name' => $prefijo.'direccion',
                    'id' => $prefijo.'direccion',
                    'class' => 'input1',
                    'size' => '68',
                    'value' => @set_value($prefijo.'direccion',$fila[$prefijo.'direccion'])
                  ));

                  if(form_error($prefijo.'direccion'))
                     echo '<div class="error">'.form_error($prefijo.'direccion').'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <table align="left">
                <tr>
                    <td valign="top">
					<p class="form-label-21">Ciudad: </p>
					<?php echo form_label('', $prefijo.'ciudad');?>
                        <?php
                            echo form_input(array(
                                'name' => $prefijo.'ciudad',
                                'id' => $prefijo.'ciudad',
                                'class' => 'input1',
                                'size' => '15',
                                'value' => @set_value($prefijo.'ciudad',$fila[$prefijo.'ciudad'])
                              ));

                              if(form_error($prefijo.'ciudad'))
                                 echo '<div class="error">'.form_error($prefijo.'ciudad').'</div>';
                        ?>
                    </td>
                    <td valign="top" align="left">
                        <div style="font-size: 10px; font-weight: bold;margin-top:10px;">
                        LP - La Paz<br/>
                        SCZ - Santa Cruz<br/>
                        CBB - Cochabamba<br/>
                        EA - El Alto
                        </div>
                    </td>

                </tr>

            </table>
            
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
			<p class="form-label-21">Teléfono(s): </p>
			<?php echo form_label('', $prefijo.'telefono');?>
            <?php

                echo form_input(array(
                    'name' => $prefijo.'telefono',
                    'id' => $prefijo.'telefono',
                    'class' => 'input1',
                    'size' => '25',
                    'value' => @set_value($prefijo.'telefono',$fila[$prefijo.'telefono'])
                  ));

                  if(form_error($prefijo.'telefono'))
                     echo '<div class="error">'.form_error($prefijo.'telefono').'</div>';
            ?>
        </td>
    </tr>
	
		<?php
    if (@$fila[$prefijo . 'img_borrar1']) {
        ?>
        <tr>
            <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>" colspan="2">
				<p class="form-label-21">Imagen anterior</p>
				<table cellpadding="2" class="tabla2" width="93%" align="<?php echo $alineacionwc; ?>">
                    <tr>
                        <td>
                            <div class="aviso1">
							&nbsp;&nbsp;&nbsp;
                                <input type="checkbox" name="solo_eliminar_img[]" value="1" class="check" <?php echo set_checkbox('solo_eliminar_img[]', '1'); ?> id="check_img1">
                                <span class="flecha1">&larr;</span> Marcar si desea eliminar la imagen
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="<?php echo $bucket_url . "archivos/" . $this->carpeta . $fila[$prefijo . 'img_borrar1']; ?>" height="100" alt="Imagen" align="middle"/>
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
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
		<p class="form-label-21">Imagen : <br/><span class="texto2">(.jpg  .gif  .png .jpeg)</span></p>
		
        <?php //echo form_label('Imagen: <br/>(.jpg  .gif  .png) ', $prefijo.'img');?>
        <?php
            echo form_upload(array('name' => $prefijo . 'img1', 'id' => $prefijo . 'img1', 'size' => '60', 'onBlur' => 'LimitAttach(this,1)'));

            if (form_error($prefijo . 'img1'))
                echo '<div class="error">' . form_error($prefijo . 'img1') . '</div>';
            ?>
            <br/>
             <span class="texto_aviso1"><strong>Nota.- </strong>Ancho máximo recomendable para subir la imagen 850px.</span>
            <br/>
            <div id="msj_alerta_imagen"></div>

        </td>
    </tr>
	
    <tr>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
			<p class="form-label-21">* Nombre Contacto 1: </p>
			<?php echo form_label('', $prefijo.'nombre1') ;?>
            <?php
                  echo form_input(array(
                    'name' => $prefijo.'nombre1',
                    'id' => $prefijo.'nombre1',
                    'size'=> '25',
                    'class'=>'input1',
                    'value' => @set_value($prefijo.'nombre1',$fila[$prefijo.'nombre1'])
                    )) ;

                  if(form_error($prefijo.'nombre1'))
                    echo '<div class="error">'.form_error($prefijo.'nombre1').'</div>';
            ?>
			<p class="form-label-21">* Cedula de identidad 1: </p>
			<?php 
			$campo='ci1';
			echo form_label('', $prefijo.$campo) ;
			?>
            <?php
                  echo form_input(array(
                    'name' => $prefijo.$campo,
                    'id' => $prefijo.$campo,
                    'size'=> '25',
                    'class'=>'input1',
                    'value' => @set_value($prefijo.$campo,$fila[$prefijo.$campo])
                    )) ;

                  if(form_error($prefijo.$campo))
                    echo '<div class="error">'.form_error($prefijo.$campo).'</div>';
            ?>
			<p class="form-label-21">* Cargo Contacto 1: </p>
			<?php echo form_label('', $prefijo.'cargo1') ;?>
            <?php
                  echo form_input(array(
                    'name' => $prefijo.'cargo1',
                    'id' => $prefijo.'cargo1',
                    'size'=> '25',
                    'class'=>'input1',
                    'value' => @set_value($prefijo.'cargo1',$fila[$prefijo.'cargo1'])
                    )) ;

                  if(form_error($prefijo.'cargo1'))
                    echo '<div class="error">'.form_error($prefijo.'cargo1').'</div>';
            ?>
			<p class="form-label-21">* Email Contacto 1: </p>
			<?php echo form_label('', $prefijo.'email1') ;?>
            <?php
                  echo form_input(array(
                    'name' => $prefijo.'email1',
                    'id' => $prefijo.'email1',
                    'size'=> '25',
                    'class'=>'input1',
                    'value' => @set_value($prefijo.'email1',$fila[$prefijo.'email1'])
                    )) ;

                  if(form_error($prefijo.'email1'))
                    echo '<div class="error">'.form_error($prefijo.'email1').'</div>';
            ?>
			<p class="form-label-21">* Celular Contacto 1: </p>
			<?php echo form_label('', $prefijo.'telefono1') ;?>
            <?php
                  echo form_input(array(
                    'name' => $prefijo.'telefono1',
                    'id' => $prefijo.'telefono1',
                    'size'=> '25',
                    'class'=>'input1',
                    'value' => @set_value($prefijo.'telefono1',$fila[$prefijo.'telefono1'])
                    )) ;

                  if(form_error($prefijo.'telefono1'))
                    echo '<div class="error">'.form_error($prefijo.'telefono1').'</div>';
            ?>
        </td>
		<td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
			<p class="form-label-21">Nombre Contacto 2: </p>
            <?php echo form_label('', $prefijo.'nombre2') ;?>
            <?php
                  echo form_input(array(
                    'name' => $prefijo.'nombre2',
                    'id' => $prefijo.'nombre2',
                    'size'=> '25',
                    'class'=>'input1',
                    'value' => @set_value($prefijo.'nombre2',$fila[$prefijo.'nombre2'])
                    )) ;

                  if(form_error($prefijo.'nombre2'))
                    echo '<div class="error">'.form_error($prefijo.'nombre2').'</div>';
            ?>
			<p class="form-label-21">Cedula de identidad 2: </p>
            <?php 
			$campo='ci2';
			echo form_label('', $prefijo.$campo) ;
			?>
            <?php
                  echo form_input(array(
                    'name' => $prefijo.$campo,
                    'id' => $prefijo.$campo,
                    'size'=> '25',
                    'class'=>'input1',
                    'value' => @set_value($prefijo.$campo,$fila[$prefijo.$campo])
                    )) ;

                  if(form_error($prefijo.$campo))
                    echo '<div class="error">'.form_error($prefijo.$campo).'</div>';
            ?>
			<p class="form-label-21">Cargo Contacto 2: </p>
			<?php echo form_label('', $prefijo.'cargo2') ;?>
            <?php
                  echo form_input(array(
                    'name' => $prefijo.'cargo2',
                    'id' => $prefijo.'cargo2',
                    'size'=> '25',
                    'class'=>'input1',
                    'value' => @set_value($prefijo.'cargo2',$fila[$prefijo.'cargo2'])
                    )) ;

                  if(form_error($prefijo.'cargo2'))
                    echo '<div class="error">'.form_error($prefijo.'cargo2').'</div>';
            ?>
			<p class="form-label-21">Email Contacto 2: </p>
			<?php echo form_label('', $prefijo.'email2') ;?>
            <?php
                  echo form_input(array(
                    'name' => $prefijo.'email2',
                    'id' => $prefijo.'email2',
                    'size'=> '25',
                    'class'=>'input1',
                    'value' => @set_value($prefijo.'email2',$fila[$prefijo.'email2'])
                    )) ;

                  if(form_error($prefijo.'email2'))
                    echo '<div class="error">'.form_error($prefijo.'email2').'</div>';
            ?>
			<p class="form-label-21">Celular Contacto 2: </p>
			<?php echo form_label('', $prefijo.'telefono2') ;?>
            <?php
                  echo form_input(array(
                    'name' => $prefijo.'telefono2',
                    'id' => $prefijo.'telefono2',
                    'size'=> '25',
                    'class'=>'input1',
                    'value' => @set_value($prefijo.'telefono2',$fila[$prefijo.'telefono2'])
                    )) ;

                  if(form_error($prefijo.'telefono2'))
                    echo '<div class="error">'.form_error($prefijo.'telefono2').'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>" colspan="2">
			<p class="form-label-21">Comentario: </p>
            <?php echo form_label('', $prefijo.'comentario') ;?>
            <?php $nombre='comentario';?>
            <?php
                  echo form_textarea(array(
                        'name' => $prefijo.$nombre,
                        'id' => $prefijo.$nombre,
                        'class' => 'input1',
                        'rows' => '8',
                        'cols' => '70',                        
                        'value' => @set_value($prefijo.$nombre,$fila[$prefijo.$nombre])
                      ));
                      if(form_error($prefijo.$nombre))
                         echo '<div class="error">'.form_error($prefijo.$nombre).'</div>';
            ?>
        </td>
    </tr>
   
</table>


<br/>
<?php 
	$botonG = array(
      'class' => 'btn btn-etika');
	echo form_submit('enviar', '  Guardar  ', $botonG);
?>
    
<?php echo form_close() ?>
<br>
<br>