<?php
$this->load->view('cabecera');
?>
<?php
$prefijo = $this->prefijo1;
$alineacionwc1 = 'left';
$alineacionhc1 = 'middle';
$alineacionwc2 = 'right';
$alineacionhc2 = 'middle';
?>
<?php echo form_open_multipart($action); ?>

<?php
echo form_hidden($prefijo . 'id', set_value($prefijo . 'id', @$fila[$prefijo . 'id']));
?>
<input type="hidden" name="<?php echo $prefijo . 'id'; ?>" value="<?php echo set_value($prefijo . 'id', @$fila[$prefijo . 'id']); ?>">


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <?php
//            desde
            $fecha = 'desde';
            if (!@$fila[$prefijo . $fecha]) {
                @$fila[$prefijo . $fecha] = 'aaaa';
            } else {
                @$fila[$prefijo . $fecha] = substr(@$fila[$prefijo . $fecha], 0, 7);
            }
            ?>
            <div class="row">
                <div class="col-md-4 text-left">
                    <?php echo form_label('Desde: <span class="texto3">&nbsp;Año</span>', $prefijo . @$nombre); ?>

                </div>
                <div class="col-md-8 text-right">
                    <input maxlength="7" type="input" class="input1_normal input-etika" style="color:#aca899;" id="<?php echo $prefijo . $fecha; ?>" name="<?php echo $prefijo . $fecha; ?>" size="30" onFocus="if (this.value == 'aaaa') {
                                this.value = '';
                                this.style.color = '#000000';
                            }" onBlur="if (this.value == '') {
                                        this.value = 'aaaa';
                                        this.style.color = '#aca899';
                                    }" value="<?php echo set_value($prefijo . $fecha, @$fila[$prefijo . $fecha]); ?>" >
                </div>
            </div>
            <?php
//            hasta
            $fecha = 'hasta';
            if (!@$fila[$prefijo . $fecha]) {
                @$fila[$prefijo . $fecha] = 'aaaa';
            } else {
                @$fila[$prefijo . $fecha] = substr(@$fila[$prefijo . $fecha], 0, 7);
            }
            ?>
            <div class="row">
                <div class="col-md-4 text-left">
                    <?php echo form_label('Hasta: <span class="texto3">&nbsp;Año</span>', $prefijo . @$nombre); ?>
                </div>
                <div class="col-md-8 text-right">
                    <input maxlength="7" type="input" class="input1_normal input-etika" style="color:#aca899;" id="<?php echo $prefijo . $fecha; ?>" name="<?php echo $prefijo . $fecha; ?>" size="30" onFocus="if (this.value == 'aaaa') {
                                this.value = '';
                                this.style.color = '#000000';
                            }" onBlur="if (this.value == '') {
                                        this.value = 'aaaa';
                                        this.style.color = '#aca899';
                                    }" value="<?php echo set_value($prefijo . $fecha, @$fila[$prefijo . $fecha]); ?>" >
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (form_error($prefijo . 'desde') || form_error($prefijo . 'hasta'))
                        echo '<div class="error"><p>Debe ingresar un Formato correcto de Fechas</p></div>';
                    ?>  
                </div>
            </div>
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">Institución</label>
            <?php
//            institucion
            $nombre = 'institucion';
            // echo form_label('Institución: ', $prefijo . $nombre);
            echo "<input type='text' name='" . $prefijo . $nombre . "' id='" . $prefijo . $nombre . "'
                                    class='input1 input-etika' size='40' onblur='Mayusculas(this.value,this.id)' value='" . @$fila[$prefijo . $nombre] . "' placeholder='Institución'/>";

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">País</label>
            <?php
//            pais
            $nombre = 'pais';
//            echo form_label('País: ', $prefijo . $nombre); 

            echo "<input type='text' name='" . $prefijo . $nombre . "' id='" . $prefijo . $nombre . "'
                                    class='input1 input-etika' size='45' onblur='Mayusculas(this.value,this.id)' value='" . @$fila[$prefijo . $nombre] . "' placeholder='País'/>";

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>                        
            

            <div class="col-md-12 text-right">
                <button type="submit" style="border: 0; background: transparent" class="boton_aceptar"><img src="<?php echo $this->tool_entidad->sitio() . 'files/img/maq/guardar.gif'; ?>" alt="submit" />GUARDAR</button>
                <?php
                echo anchor($this->controlador . 'instruccion_formal', '<img border="0" src="' . $this->tool_entidad->sitio() . 'files/img/maq/cancelar.gif" /> CANCELAR', array('class' => 'boton_cancelar'));
                ?>
            </div>
        </div>
    </div>
</div>

<br/>
<?php //echo form_submit('enviar', '  Guardar  ');   ?>

<?php echo form_close() ?>
