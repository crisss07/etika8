<?php
$this->load->view('cabecera');
?>
<?php
$prefijo = $this->prefijo3;
$alineacionwc1 = 'left';
$alineacionhc1 = 'middle';
$alineacionwc2 = 'right';
$alineacionhc2 = 'middle';
?>
<?php echo form_open_multipart(@$action); ?>

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
                @$fila[$prefijo . $fecha] = 'aaaa-mm';
            } else {
                @$fila[$prefijo . $fecha] = substr(@$fila[$prefijo . $fecha], 0, 7);
            }
            ?>
            <div class="row">
                <div class="col-md-4 text-left">
                    <?php echo form_label('Desde: <span class="texto3">&nbsp;Año-mes</span>', $prefijo . @$nombre); ?>

                </div>
                <div class="col-md-8 text-right">
                    <input maxlength="7" type="input" class="input1_normal input-etika" style="color:#aca899;" id="<?php echo $prefijo . $fecha; ?>" name="<?php echo $prefijo . $fecha; ?>" size="40" onFocus="if (this.value == 'aaaa-mm') {
                                this.value = '';
                                this.style.color = '#000000';
                            }" onBlur="if (this.value == '') {
                                        this.value = 'aaaa-mm';
                                        this.style.color = '#aca899';
                                    }" value="<?php echo set_value($prefijo . $fecha, @$fila[$prefijo . $fecha]); ?>" >
                </div>
            </div>
            <?php
//            hasta
            $fecha = 'hasta';
            if (!@$fila[$prefijo . $fecha]) {
                @$fila[$prefijo . $fecha] = 'aaaa-mm';
            } else {
                @$fila[$prefijo . $fecha] = substr(@$fila[$prefijo . $fecha], 0, 7);
            }
            ?>
            <div class="row">
                <div class="col-md-4 text-left">
                    <?php echo form_label('Hasta: <span class="texto3">&nbsp;Año-mes</span>', $prefijo . @$nombre); ?>
                </div>
                <div class="col-md-8 text-right">
                    <input maxlength="7" type="input" class="input1_normal input-etika" style="color:#aca899;" id="<?php echo $prefijo . $fecha; ?>" name="<?php echo $prefijo . $fecha; ?>" size="40" onFocus="if (this.value == 'aaaa-mm') {
                                this.value = '';
                                this.style.color = '#000000';
                            }" onBlur="if (this.value == '') {
                                        this.value = 'aaaa-mm';
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
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">Nombre de la Organización</label>
            <?php
//            nombre de organizacion
            $nombre = 'organizacion';
            // echo form_label('Nombre de la Organización: ', $prefijo . $nombre);
            echo "<input type='text' name='" . $prefijo . $nombre . "' id='" . $prefijo . $nombre . "'
                                    class='input1 input-etika' size='40' onblur='Mayusculas(this.value,this.id)' value='" . @$fila[$prefijo . $nombre] . "' placeholder='Nombre de la Organización'/>";

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">Tipo de Organización</label>
            <?php

//            tipo organizacion
            $campo1 = 'tipo_org';
            echo form_dropdown($prefijo . $campo1, $this->tipo_org, set_value($prefijo . $campo1, @$fila[$prefijo . $campo1]), 'class="custom-select custom-select-sm input-etika"');

            if (form_error($prefijo . $campo1))
                echo '<div class="error">' . form_error($prefijo . $campo1) . '</div>';
            ?>
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">Actividad Principal de la Organización</label>
            <?php

//            actividad principal de la organizacion
            $nombre = 'descripcion_org';
//            echo form_label('Actividad Principal de la Organización: ', $prefijo . $nombre);
            echo "<textarea name=" . $prefijo . $nombre . " id=" . $prefijo . $nombre . "
                                    class='input1 input-etika' rows='5' cols='30' onblur='Mayusculas(this.value,this.id)' placeholder='Actividad Principal de la Organización'>" . @$fila[$prefijo . $nombre] . "</textarea>";

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">Cargo/s ocupado/s, indique todos los cargos</label>
            <?php

//            cargos ocupados
            $nombre = 'cargos';
//            echo form_label('Cargo/s ocupado/s, indique todos los cargos: ', $prefijo . $nombre);
            echo "<textarea name=" . $prefijo . $nombre . " id=" . $prefijo . $nombre . "
                                    class='input1 input-etika' rows='5' cols='30' onblur='Mayusculas(this.value,this.id)' placeholder='Cargo/s ocupado/s, indique todos los cargos'>" . @$fila[$prefijo . $nombre] . "</textarea>";

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">3 principales funciones desempeñadas dentro del cargo/s</label>
            <?php

//            3 principales funciones 
            $nombre = 'funciones_org';
//            echo form_label('3 principales funciones desempeñadas dentro del cargo/s: ', $prefijo . $nombre);
            echo "<textarea name=" . $prefijo . $nombre . " id=" . $prefijo . $nombre . "
                                    class='input1 input-etika' rows='5' cols='30' onblur='Mayusculas(this.value,this.id)' placeholder='3 principales funciones desempeñadas dentro del cargo/s'>" . @$fila[$prefijo . $nombre] . "</textarea>";

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">Principales Logros</label>
            <?php

//            principales logros
            $nombre = 'logros';
//            echo form_label('Principales Logros: ', $prefijo . $nombre);
            echo "<textarea name=" . $prefijo . $nombre . " id=" . $prefijo . $nombre . "
                                    class='input1 input-etika' rows='5' cols='30' onblur='Mayusculas(this.value,this.id)' placeholder='Principales Logros'>" . @$fila[$prefijo . $nombre] . "</textarea>";

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">País - Ciudad</label>
            <?php

//            pais ciudad
            $nombre = 'pais';
//            echo form_label('País - Ciudad: ', $prefijo . $nombre);
            echo "<input type='text' name=" . $prefijo . $nombre . " id=" . $prefijo . $nombre . "
                                    class='input1 input-etika' size='42' onblur='Mayusculas(this.value,this.id)' value='" . @$fila[$prefijo . $nombre] . "' placeholder='País - Ciudad' />";

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">Nº DE SUBORDINADOS</label>
            <?php

//            n de subordinados
            $nombre = 'nsubordinados';
//            echo form_label('Nº de Subordinados: ', $prefijo . $nombre);
            echo form_input(array(
                'name' => $prefijo . $nombre,
                'id' => $prefijo . $nombre,
                'class' => 'input1_normal input-etika',
                'size' => '35',
                'placeholder' => 'Nº DE SUBORDINADOS',
                'value' => set_value($prefijo . $nombre, @$fila[$prefijo . $nombre])
            ));

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">TOTAL GANADO MENSUAL (EN BS.)</label>
            <?php

//            total ganado mensual
            $nombre = 'sueldo';
//            echo form_label('Total Ganado Mensual (en Bs.): ', $prefijo . $nombre);
            echo form_input(array(
                'name' => $prefijo . $nombre,
                'id' => $prefijo . $nombre,
                'class' => 'input1_normal input-etika',
                'size' => '28',
                'placeholder' => 'TOTAL GANADO MENSUAL (EN BS.)',
                'value' => set_value($prefijo . $nombre, @$fila[$prefijo . $nombre]),
                'onkeyup' => 'this.value=Numeros(this.value)'
            ));

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">TELÉFONO(S) DE LA ORGANIZACIÓN</label>
            <?php

//            telefono de la organizacion
            $nombre = 'telefono_org';
//            echo form_label('Teléfono(s) de la Organización: ', $prefijo . $nombre);
            echo form_input(array(
                'name' => $prefijo . $nombre,
                'id' => $prefijo . $nombre,
                'class' => 'input1 input-etika',
                'size' => '63',
                'placeholder' => 'TELÉFONO(S) DE LA ORGANIZACIÓN',
                'value' => set_value($prefijo . $nombre, @$fila[$prefijo . $nombre])
            ));

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">Nombre del Inmediato Superior</label>
            <?php

//            nombre inmediato superior
            $nombre = 'nombre_sup';
//            echo form_label('Nombre del Inmediato Superior: ', $prefijo . $nombre);
            echo "<input type='text' name=" . $prefijo . $nombre . " id=" . $prefijo . $nombre . "
                                    class='input1 input-etika' size='63' onblur='Mayusculas(this.value,this.id)' value='" . @$fila[$prefijo . $nombre] . "' placeholder='Nombre del Inmediato Superior' />";

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">TELÉFONO(S) DEL INMEDIATO SUPERIOR</label>
            <?php

//            telefono inmediato superior
            $nombre = 'telefono_sup';
//            echo form_label('Teléfono(s) del Inmediato Superior: ', $prefijo . $nombre);
            echo form_input(array(
                'name' => $prefijo . $nombre,
                'id' => $prefijo . $nombre,
                'class' => 'input1 input-etika',
                'size' => '63',
                'placeholder' => 'TELÉFONO(S) DEL INMEDIATO SUPERIOR',
                'value' => set_value($prefijo . $nombre, @$fila[$prefijo . $nombre])
            ));
            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">CORREO ELECTRÓNICO DEL INMEDIATO SUPERIOR</label>
            <?php

//           correo del inmediato superior
            $nombre = 'email_sup';
//            echo form_label('Correo Electrónico del Inmediato Superior: ', $prefijo . $nombre);
            echo "<input type='text' name=" . $prefijo . $nombre . " id=" . $prefijo . $nombre . "
                                    class='input1_normal input-etika' size='63'  value='" . @$fila[$prefijo . $nombre] . "' placeholder='CORREO ELECTRÓNICO DEL INMEDIATO SUPERIOR' />";

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';

//            Estoy trabajando actualmente
            if (@$fila[$prefijo . 'actual'] == 1) {
                $actual = 'checked';
            }
            echo form_label(' Estoy actualmente Trabajando en esta Organización: ');
            ?>        
            <br/><input type="checkbox" name="<?php echo $prefijo . 'actual'; ?>" value="1" <?php echo @$actual; ?> /> <label>Si</label><span class="mensaje_alerta-trayectoria">Solo tickear el SI en caso de que esté trabajando.</span>

            <div class="col-md-12 text-right">
                <button type="submit" style="border: 0; background: transparent" class="boton_aceptar"><img src="<?php echo $this->tool_entidad->sitio() . 'files/img/maq/guardar.gif'; ?>" alt="submit" />GUARDAR</button>
                    <?php
                    echo anchor($this->controlador . 'trayectoria_laboral', '<img border="0" src="' . $this->tool_entidad->sitio() . 'files/img/maq/cancelar.gif" /> CANCELAR', array('class' => 'boton_cancelar'));
                    ?>
            </div>
        </div>
    </div>
</div>
<br/>
<?php
//echo form_submit('enviar', '  Guardar  ');
?>

<?php echo form_close() ?>
