<?php
$this->load->view('cabecera');
?>
<?php
$prefijo = $this->prefijoPI;
$alineacionwc1 = 'left';
$alineacionhc1 = 'middle';
$alineacionwc2 = 'left';
$alineacionhc2 = 'middle';
switch ($fila[$prefijo . 'lee']) {
    case 1:
        $valor_lee1 = 'checked';
        break;
    case 2:
        $valor_lee2 = 'checked';
        break;
    case 3:
        $valor_lee3 = 'checked';
        break;
    case 4:
        $valor_lee4 = 'checked';
        break;
}
switch ($fila[$prefijo . 'habla']) {
    case 1:
        $valor_habla1 = 'checked';
        break;
    case 2:
        $valor_habla2 = 'checked';
        break;
    case 3:
        $valor_habla3 = 'checked';
        break;
    case 4:
        $valor_habla4 = 'checked';
        break;
}
switch ($fila[$prefijo . 'escribe']) {
    case 1:
        $valor_escribe1 = 'checked';
        break;
    case 2:
        $valor_escribe2 = 'checked';
        break;
    case 3:
        $valor_escribe3 = 'checked';
        break;
    case 4:
        $valor_escribe4 = 'checked';
        break;
}
$idIdioma = $fila['idi_id'];
if ($idIdioma != 223) {
    $displayIdioma = 'style = "display: none;"';
} else {
    $displayIdioma = 'style = "display: block;"';
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
        <div class="col-md-7 col-lg-5">
            <div class="row text-left justify-content-center">
                <div class="col-2">
                    <label>Idioma</label>
                </div>
                <div class="col-8 text-center">
                    <?php
                    $nombre = 'id';
                    $prefijoIdioma = 'idi_'
                    ?>
                    <select name="idi_id" class="select_idioma custom-select custom-select-sm input-etika">
                        <option value="">Elija idioma</option>
                        <?php
                        foreach ($idiomas as $key => $value) {
                            ?>
                            <option  value="<?php echo $value['idi_id']; ?>" <?php echo $value['idi_id'] == $fila[$prefijoIdioma . $nombre] ? 'selected' : ''; ?>><?php echo $value['idi_idioma']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php
                    if (form_error($prefijoIdioma . $nombre)) {
                        echo '<div class="error">' . form_error($prefijoIdioma . $nombre) . '</div>';
                    }
                    ?>  

                    <div id="idioma" class="otro_idioma" <?php echo $displayIdioma; ?>>
                        <?php
                        $nombre = 'idioma_otro';
                        echo "<input type='text' name='" . $prefijo . $nombre . "' id='" . $prefijo . $nombre . "'
                                    class='input1 input-etika' size='40' onblur='Mayusculas(this.value,this.id)' value='" . $fila[$prefijo . $nombre] . "' placeholder='Escriba el Idioma' />";
                        if (form_error($prefijo . $nombre))
                            echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                        ?>
                        <br/>
                    </div>
                </div>
            </div>
            <div class="row text-left justify-content-center container-ingles">
                <div class="col-2">
                    <h4 class="text-cafe text-left">&nbsp;</h4></div>
                <div class="col-2 text-center"><h4 class="text-cafe">Exelente</h4></div>
                <div class="col-2 text-center"><h4 class="text-cafe">bueno</h4></div>
                <div class="col-2 text-center"><h4 class="text-cafe">Regular</h4></div>
                <div class="col-2 text-center"><h4 class="text-cafe">Basico</h4></div>
            </div>
            <div class="row text-left justify-content-center">
                <div class="col-2"><p>HABLA</p></div>
                <?php
                $nombre = 'habla';
                ?>
                <div class="col-2 text-center">
                    <input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php echo @$valor_habla1; ?> />
                </div>
                <div class="col-2 text-center">
                    <input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="2" <?php echo @$valor_habla2; ?> />
                </div>
                <div class="col-2 text-center">
                    <input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="3" <?php echo @$valor_habla3; ?> />
                </div>
                <div class="col-2 text-center">
                    <input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="4" <?php echo @$valor_habla4; ?> />
                </div>
                <div class="col-12 text-center">
                    <?php
                    if (form_error($prefijo . $nombre))
                        echo '<div class="error" style="text-aling:center;">' . form_error($prefijo . $nombre) . '</div>';
                    ?>
                </div>
            </div>
            <div class="row text-left justify-content-center">
                <div class="col-2"><p>LEE</p></div>
                <?php
                $nombre = 'lee';
                ?>
                <div class="col-2 text-center">
                    <input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php echo @$valor_lee1; ?> />
                </div>
                <div class="col-2 text-center">
                    <input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="2" <?php echo @$valor_lee2; ?> />
                </div>
                <div class="col-2 text-center">
                    <input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="3" <?php echo @$valor_lee3; ?> />
                </div>
                <div class="col-2 text-center">
                    <input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="4" <?php echo @$valor_lee4; ?> />
                </div>
                <div class="col-12 text-center">
                    <?php
                    if (form_error($prefijo . $nombre))
                        echo '<div class="error" style="text-aling:center;">' . form_error($prefijo . $nombre) . '</div>';
                    ?>
                </div>
            </div>
            <div class="row text-left justify-content-center">
                <div class="col-2"><p>ESCRIBE</p></div>
                <?php
                $nombre = 'escribe';
                ?>
                <div class="col-2 text-center">
                    <input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php echo @$valor_escribe1; ?> />
                </div>
                <div class="col-2 text-center">
                    <input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="2" <?php echo @$valor_escribe2; ?> />
                </div>
                <div class="col-2 text-center">
                    <input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="3" <?php echo @$valor_escribe3; ?> />
                </div>
                <div class="col-2 text-center">
                    <input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="4" <?php echo @$valor_escribe4; ?> />
                </div>
                <div class="col-12 text-center">
                    <?php
                    if (form_error($prefijo . $nombre))
                        echo '<div class="error" style="text-aling:center;">' . form_error($prefijo . $nombre) . '</div>';
                    ?>
                </div>
            </div>
            <br/>
            <br/>
            <div class="col-md-12 text-right">
                <button type="submit" style="border: 0; background: transparent" class="boton_aceptar"><img src="<?php echo $this->tool_entidad->sitio() . 'files/img/maq/guardar.gif'; ?>" alt="submit" />GUARDAR</button>
                    <?php
                    echo anchor($this->controlador . 'informacion_adicional', '<img border="0" src="' . $this->tool_entidad->sitio() . 'files/img/maq/cancelar.gif" /> CANCELAR', array('class' => 'boton_cancelar'));
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
