<?php
$prefijo = $this->prefijo;
?>
<?php
$this->load->view('cabecera');
?>
<?php
$this->load->view('opciones');
$alineacionwc1 = 'center';
$alineacionhc1 = 'middle';
$alineacionwc2 = 'left';
$alineacionhc2 = 'middle';
switch (@$fila[$prefijo . 'posimg']) {
    case 1: $valor1 = TRUE;
        break;
    case 2: $valor2 = TRUE;
        break;
    case 3: $valor3 = TRUE;
        break;
}
?>
<br>
<?php echo form_open_multipart($action); ?>

<?php
for ($i = 0; $i < count($this->campoup_img); $i++) {
    $j = $i + 1;

    echo form_hidden($prefijo . 'img' . $j . '_borrar' . $j, @set_value($prefijo . 'img_borrar' . $j, $fila[$prefijo . 'img_borrar' . $j]));
}

for ($i = 0; $i < count($this->campoup_adj); $i++) {
    $j = $i + 1;


    echo form_hidden($prefijo . 'adj_borrar' . $j, @set_value($prefijo . 'adj_borrar' . $j, $fila[$prefijo . 'adj_borrar' . $j]));
}
?>
<input type="hidden" name="<?php echo $prefijo . 'id'; ?>" value="<?php echo @set_value($prefijo . 'id', $fila[$prefijo . 'id']); ?>">
<input type="hidden" name="idp" value="<?php print_r (set_value(@$this->idp, @$this->idp)); ?>">
<input type="hidden" name="tip" value="<?php print_r (set_value(@$this->tip, @$this->tip)); ?>">
<table id="form_admin">    
    <tr>
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
		<p class="form-label-21">Titulo: </p>
			<?php $campo = 'titulo'; ?>
            <?php echo form_label('', $prefijo . $campo); ?>
            <?php
            echo form_input(array(
                'name' => $prefijo . $campo,
                'id' => $prefijo . $campo,
                'class' => 'input1',
                'size' => '75',
                'value' => set_value($prefijo . $campo, @$fila[$prefijo . $campo])
            ));

            if (form_error($prefijo . $campo))
                echo '<div class="error">' . form_error($prefijo . $campo) . '</div>';
            ?>
        </td>
    </tr>

    <?php
    if (@$fila[$prefijo . 'img_borrar1']) {
        ?>
        <tr>
            <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
				<p class="form-label-21">Imagen anterior</p>
                <table cellpadding="2" class="tabla2" align="<?php echo $alineacionwc1; ?>">
                    <tr align="<?php echo $alineacionwc1; ?>">
                        <td>
                            <div class="aviso1">
                                <input type="checkbox" name="solo_eliminar_img[]" value="1" class="check" <?php echo set_checkbox('solo_eliminar_img[]', '1'); ?> id="check_img1">
                                <span class="flecha1">&larr;</span> Marcar si desea eliminar la imagen
                            </div>

                        </td>
                    </tr>
                    <tr align="<?php echo $alineacionwc1; ?>"  style="height:150px;width:200px;overflow: hidden;">
                        <td>
                            <img src="<?php echo $this->tool_entidad->aws_url() . $this->carpeta_s3 . $fila[$prefijo . 'img_borrar1']; ?>" style="width:200px;" alt="Imagen" align="middle"/>
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
            <p class="form-label-21">Imagen : <span class="texto2">(.jpeg  .gif  .png)</span></p>
			<?php
            echo form_upload(array('name' => $prefijo . 'img1', 'id' => $prefijo . 'img1', 'size' => '60', 'onBlur' => 'LimitAttach(this,1)','accept'=>
                            '.png,.jpg,.jpeg,.gif'));

            
            ?>
            <br/>
             <span class="texto_aviso1"><strong>Nota.- </strong>Ancho máximo recomendable para subir la imagen 850px.</span>
            <br/>
            <div >
                <span><code id="msj_alerta_imagen_nueva"></code></span>
            </div>

        </td>
    </tr>
    <tr>
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
			<p class="form-label-21" style="margin-bottom:-10px;" >Contenido : </p>
			<?php $nombre = 'contenido'; ?>
			<div align="<?php echo $alineacionwc1; ?>">
            <?php echo form_label('', $prefijo . $nombre); ?>
            <?php
            echo form_textarea($prefijo . $nombre,@$fila[$prefijo . $nombre], array(
                'rows' => '60',
                'cols' => '70',
                'class' => 'tinymce'
            ));

            if (form_error($prefijo . $nombre))
                echo '<div class="error" >' . form_error($prefijo . $nombre) . '</div>';
            ?>
			</div>
        </td>
    </tr>


    <?php
    if (@$fila[$prefijo . 'adj_borrar1']) {
        ?>
        <tr>
            <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
				<p class="form-label-21">Archivo adjunto anterior</p>
                <table cellpadding="2" class="tabla2" align="<?php echo $alineacionwc1; ?>">
                    <tr>
                        <td align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc2; ?>">
                            <div class="aviso1">
                                <input type="checkbox" name="solo_eliminar_adj[]" value="2" id="check_adj1">
                                <span class="flecha1">&larr;</span> Marcar si desea eliminar el Archivo adjunto &nbsp;&nbsp;
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc2; ?>">
                            <?php
							$aux2=substr($fila[$this->prefijo . 'adj_borrar1'], -4);
							$aux1=strtolower($aux2);
							//echo $aux1;
                            $tipofile = $this->tool_general->tipofig_extension($aux1);
                            ?>
                            <img src="<?php echo $this->rutaimg . $tipofile . '.gif'; ?>" alt="tipo"/>
                            <?php echo "<b>" . $fila[$prefijo . 'adj_borrar1'] . "</b>"; ?>

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
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
            <p class="form-label-21">
			Archivo adjunto: <span class="texto2">(.pdf .doc .xls .txt  .ppt )</span>
			</p>
			<?php
            echo form_upload(array('name' => $prefijo . 'adj', 'id' => $prefijo . 'adj', 'size' => '60', 'onBlur' => 'LimitAttach(this,2)','accept'=>
                            "application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
                            text/plain, application/pdf, image/*,.xlsx,.docx,.pptx,video/*,.flv"));

   
            ?>
            <br/>
            <div ><code id="msj_alerta_archivo_nuevo"></code></div>
        </td>
    </tr>

    
</table>


<br>
<br>
<?php 
$botonG = array('class' => 'btn btn-etika','id'=>'guardar');
echo form_submit('enviar', '  Guardar  ', $botonG); 
?>

<?php echo form_close() ?>
<br>


<script>
    $('#not_img1').on( 'change', function() {
   myfile= $( this ).val();
   var ext = myfile.split('.').pop();
   if(ext=="jpg" || ext=="jpeg" || ext=="png"|| ext=="gif"){
       
       //alert(ext);
       $('#guardar').show();
        $('#msj_alerta_imagen_nueva').text('');
       
   } else{
    //alert(ext);
       $('#guardar').hide();
       $('#msj_alerta_imagen_nueva').text("Solo puede subir imagenes con las siguientes extensiones .jpg .gif .png .Por favor, seleccione otra imagen");
       
    }
});
</script>

<!-- validacion de  -->

<script>
    $('#not_adj').on( 'change', function() {
   myfile= $( this ).val();
   var ext = myfile.split('.').pop();
    if(ext=="exe" || ext=="zip" || ext=="rar"|| ext=="7zip" || ext=="bat" || ext=="dll"){
       

        $('#guardar').hide();
       $('#msj_alerta_archivo_nuevo').text("Solo puede subir archivos, imagenes o videos");
       
   } else{
    
       //alert(ext);
       $('#guardar').show();
        $('#msj_alerta_archivo_nuevo').text('');
       
       
    }
});
</script>