<?php
$this->load->view('cabecera');
?>
<?php
$prefijo = $this->prefijo2;
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

<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">Título</label>
            <?php
//            titulo
            $nombre = 'titulo';
            // echo form_label('Titulo: ', $prefijo . $nombre);
            echo "<input type='text' name='" . $prefijo . $nombre . "' id='" . $prefijo . $nombre . "'
                                    class='input1 input-etika' size='40' onblur='Mayusculas(this.value,this.id)' value='" . @$fila[$prefijo . $nombre] . "' placeholder='titulo' />";

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">Año</label>
            <?php

//            año
            $fecha = 'anio';
//            echo form_label('Año: ', $prefijo . $nombre);
            if (!@$fila[$prefijo . $fecha]) {
                @$fila[$prefijo . $fecha] = date('Y');
            }
            echo form_input(array(
                'name' => $prefijo . $fecha,
                'id' => $prefijo . $fecha,
                'class' => 'input1 input-etika',
                'placeholder' => 'Año',
                'value' => set_value($prefijo . $fecha, @$fila[$prefijo . $fecha])
            ));
            if (form_error($prefijo . $fecha))
                echo '<div class="error">' . form_error($prefijo . $fecha) . '</div>';
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
<?php
//echo form_submit('enviar', '  Guardar  ');
?>

<?php echo form_close() ?>
