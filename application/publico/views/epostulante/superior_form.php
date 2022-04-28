
<?php
$this->load->view('cabecera');
?>
<?php
$prefijo = $this->prefijo1;
$alineacionwc1 = 'left';
$alineacionhc1 = 'middle';
$alineacionwc2 = 'right';
$alineacionhc2 = 'middle';
$idProfesion = @$fila[$prefijo . 'area'];
if ($idProfesion == 65) {
    $displayProfesion = 'style="display:block;"';
} else {
    $displayProfesion = 'style="display:none;"';
}
?>
<?php echo form_open_multipart($action); ?>

<?php
echo form_hidden($prefijo . 'id', set_value($prefijo . 'id', @$fila[$prefijo . 'id']));
?>
<input type="hidden" name="<?php echo $prefijo . 'id'; ?>" value="<?php echo set_value($prefijo . 'id', @$fila[$prefijo . 'id']); ?>">
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <?php
//            desde
            $fecha = 'desde';
            if (!@$fila[$prefijo . $fecha]) {
                @$fila[$prefijo . $fecha] = 'aaaa';
            }
//                echo form_label('Desde: ', $prefijo . $nombre);
            ?>
            <div class="row">
                <div class="col-md-4 text-left">
                    <?php echo form_label('Desde: <span class="texto3">&nbsp;Año</span>', $prefijo . @$nombre); ?>

                </div>
                <div class="col-md-8 text-right">
                    <input maxlength="4" type="input" class="input1_normal input-etika" style="color:#aca899;" id="<?php echo $prefijo . $fecha; ?>" name="<?php echo $prefijo . $fecha; ?>" size="40" onFocus="if (this.value == 'aaaa') {
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
//            echo form_label('Hasta: ', $prefijo . $nombre);

            if (!@$fila[$prefijo . $fecha]) {
                @$fila[$prefijo . $fecha] = 'aaaa';
            }
            ?>
            <div class="row">
                <div class="col-md-4 text-left">
                    <?php echo form_label('Hasta: <span class="texto3">&nbsp;Año</span>', $prefijo .@ $nombre); ?>
                </div>
                <div class="col-md-8 text-right">
                    <input maxlength="4" type="input" class="input1_normal input-etika" style="color:#aca899;" id="<?php echo $prefijo . $fecha; ?>" name="<?php echo $prefijo . $fecha; ?>" size="40" onFocus="if (this.value == 'aaaa') {
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
                        echo '<div class="error">Debe ingresar un Formato correcto de Fechas</div>';
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
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">Grado</label>
            <?php

//            grado o titulo
            $campo1 = 'grado';
//            echo form_label(' Grado o Titulo: ', $prefijo . $campo1);

            echo form_dropdown($prefijo . $campo1, $this->grados_sup, set_value($prefijo . $campo1, @$fila[$prefijo . $campo1]), 'class="custom-select custom-select-sm input-etika"');

            if (form_error($prefijo . $campo1))
                echo '<div class="error">' . form_error($prefijo . $campo1) . '</div>';
            ?>
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">Área de Profesión</label>
            <?php
//            area de profesion
            $campo1 = 'area';
            //            echo form_label('Área de Post Grado: ', $prefijo . $nombre);

            echo form_dropdown($prefijo . $campo1, $this->area_pro, set_value($prefijo . $campo1, @$fila[$prefijo . $campo1]), 'class="select_profesion custom-select custom-select-sm input-etika"');
            if (form_error($prefijo . $campo1))
                echo '<div class="error">' . form_error($prefijo . $campo1) . '</div>';
//            otra profesion
            ?>
            <div id="pais" class="otra_profesion" <?php echo $displayProfesion; ?>>
<!--                <span class="texto3">Escriba la Profesión -> </span>-->
                <?php
                echo "<input type='text' name='" . $prefijo . "area_otro' id='" . $prefijo . "area_otro'
                                    class='input1 input-etika' size='30' onblur='Mayusculas(this.value,this.id)' value='" . @$fila[$prefijo . "area_otro"] . "' placeholder='Escriba la Profesión' />";
                if (form_error($prefijo . 'area_otro'))
                    echo '<div class="error">' . form_error($prefijo . 'area_otro') . '</div>';
                ?>
            </div>
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">Tema Tesis</label>

            <?php
            //            tema de tesis
            $nombre = 'tema';
            //            echo form_label('Tema Tesis: ', $prefijo . $nombre);
            echo "<textarea name=" . $prefijo . $nombre . " id=" . $prefijo . $nombre . "
                            class='input1 input-etika' rows='5' cols='30' onblur='Mayusculas(this.value, this.id)' placeholder='Tema Tesis'>" . @$fila[$prefijo . $nombre] . "</textarea>";

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">Nota de la Tesis</label>
            <?php

            //            nota de tesis
            $nombre = 'nota';
            //            echo form_label('Nota de la Tesis: ', $prefijo . $nombre);
            echo form_input(array(
                'name' => $prefijo . $nombre,
                'id' => $prefijo . $nombre,
                'class' => 'input1 input-etika',
                'size' => '16',
                'maxlength' => '3',
                'placeholder' => 'Nota de la Tesis',
                'value' => set_value($prefijo . $nombre, @$fila[$prefijo . $nombre])
            )) . '<span class="texto3"> de 1 a 100</span>';

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';

            //            titulado
            $nombre = 'titulado';
            if (@$fila[$prefijo . 'id']) {
                if (@$fila[$prefijo . $nombre] == 1) {
                    $recibir1 = 'checked';
                } elseif (@$fila[$prefijo . $nombre] == 0) {
                    $recibir2 = 'checked';
                }
            } else {
                if (@$fila[$prefijo . $nombre] == 1) {
                    $recibir1 = 'checked';
                } elseif (@$fila[$prefijo . $nombre] == 0) {
                    $recibir2 = 'checked';
                }
            }
            ?>                        
            <div class="row justify-content-between">
                <label for="<?php echo $nombre; ?>">Titulado:</label>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="si" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php echo @$recibir1; ?> class="custom-control-input" />
                    <label class="custom-control-label" for="si">Si</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="no" name="<?php echo $prefijo . $nombre; ?>" value="0" <?php echo @$recibir2; ?> class="custom-control-input" />
                    <label class="custom-control-label" for="no">No</label>
                </div>


                <?php
                if (form_error($prefijo . $nombre))
                    echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                ?>   
            </div>

            <div class="col-md-12 text-right">
                <button type="submit" style="border: 0; background: transparent" class="boton_aceptar"><img src="<?php echo $this->tool_entidad->sitio() . 'files/img/maq/guardar.gif'; ?>" alt="submit" />GUARDAR</button>
                <?php
                echo anchor($this->controlador . 'instruccion_formal', '<img border="0" src="' . $this->tool_entidad->sitio() . 'files/img/maq/cancelar.gif" /> CANCELAR', array('class' => 'boton_cancelar'));
                ?>
            </div>
        </div>
    </div>
</div>
<?php
//echo form_submit('enviar', '  Guardar  ');
?>

<?php echo form_close() ?>
