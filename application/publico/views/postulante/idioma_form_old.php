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
$idIdioma=$fila['idi_id'];
if ($idIdioma != 223) {
    $displayIdioma = 'style = "display: none;"';
} else {
    $displayIdioma = 'style = "display: block;"';
}
?>
<?php echo form_open_multipart($action); ?>

<?php
echo form_hidden($prefijo . 'id', set_value($prefijo . 'id', $fila[$prefijo . 'id']));
?>
<input type="hidden" name="<?php echo $prefijo . 'id'; ?>" value="<?php echo set_value($prefijo . 'id', $fila[$prefijo . 'id']); ?>">
<div id="idioma">
    <table id="form_admin" align="left" width="660" cellpadding="5">
        <tr>
            <td>
                <table class="tamanio_campos">   
                    <tr>
                        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                            <?php
                            $nombre = 'id';
                            $prefijoIdioma = 'idi_'
                            ?>
                            <?php echo form_label(' Idioma: ', $prefijoIdioma . $nombre); ?>
                        </td>
                        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                            <select name="idi_id" class="select_idioma">
                                <option value="">Elija idioma</option>
                                <?php
                                foreach ($idiomas as $key => $value) {
                                    ?>
                                    <option  value="<?php echo $value['idi_id']; ?>" <?php echo $value['idi_id'] == $fila[$prefijoIdioma . $nombre] ? 'selected' : ''; ?>><?php echo $value['idi_idioma']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                        <td align="left" width="335">
                            <?php
//                            echo $prefijoIdioma . $nombre;
//                            echo "aaa".!form_error('idi_id');
                            if (form_error($prefijoIdioma . $nombre)) {
                                echo '<div class="error">' . form_error($prefijoIdioma . $nombre) . '</div>';
                            }
                            ?>                        
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" align="left"> 

                            <div id="idioma" class="otro_idioma" <?php echo $displayIdioma; ?>>
                                <span class="texto3">Escriba el Idioma -> </span>
                                <?php
                                $nombre='idioma_otro';
                                echo "<input type='text' name='".$prefijo.$nombre."' id='".$prefijo.$nombre."'
                                    class='input1' size='40' onblur='Mayusculas(this.value,this.id)' value='".$fila[$prefijo .$nombre ]."' />";
//                                echo form_input(array(
//                                    'name' => $prefijo . $nombre,
//                                    'id' => $prefijo . $nombre,
//                                    'class' => 'input1',
//                                    'size' => '30',
//                                    'onblur' => 'Mayusculas(this.value,this.id)',
//                                    'value' => $fila[$prefijo . $nombre]
//                                ));

                                if (form_error($prefijo . $nombre))
                                    echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                                ?>
                            </div>
                        </td>
                    </tr>
                </table>                 
                <table class="tamanio_campos">
                    <tr>
                        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                            <table class="tamanio_campos" align="center">
                                <tr align="center">
                                    <td> &nbsp;</td>
                                    <td><span class="texto3">Excelente</span></td>
                                    <td><span class="texto3">Muy bueno</span></td>
                                    <td><span class="texto3">Regular</span></td>
                                    <td><span class="texto3">Basico</span></td>
                                    <td width="335"> &nbsp; </td>
                                </tr>
                                <tr>
                                    <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                                        <?php $nombre = 'habla'; ?>
                                        <?php echo form_label(' Habla: ', $prefijo . $nombre); ?>
                                    </td>
                                    <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php echo $valor_habla1; ?> /></td>
                                    <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="2" <?php echo $valor_habla2; ?> /></td>
                                    <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="3" <?php echo $valor_habla3; ?> /></td>
                                    <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="4" <?php echo $valor_habla4; ?> /></td>                                
                                    <td align="left">
                                        <?php
                                        if (form_error($prefijo . $nombre))
                                            echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                                        <?php $nombre = 'lee'; ?>
                                        <?php echo form_label(' Lee: ', $prefijo . $nombre); ?>
                                    </td>
                                    <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php echo $valor_lee1; ?> /></td>
                                    <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="2" <?php echo $valor_lee2; ?> /></td>
                                    <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="3" <?php echo $valor_lee3; ?> /></td>
                                    <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="4" <?php echo $valor_lee4; ?> /></td>
                                    <td align="left">
                                        <?php
                                        if (form_error($prefijo . $nombre))
                                            echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                                        <?php $nombre = 'escribe'; ?>
                                        <?php echo form_label(' Escribe: ', $prefijo . $nombre); ?>
                                    </td>
                                    <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php echo $valor_escribe1; ?> /></td>
                                    <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="2" <?php echo $valor_escribe2; ?> /></td>
                                    <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="3" <?php echo $valor_escribe3; ?> /></td>
                                    <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="4" <?php echo $valor_escribe4; ?> /></td>
                                    <td align="left">
                                        <?php
                                        if (form_error($prefijo . $nombre))
                                            echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>                 
            </td>
        </tr>
        <tr>
            <td align="center">                
                <div align="center">
                    <button type="submit" style="border: 0; background: transparent" class="boton_aceptar"><img src="<?php echo $this->tool_entidad->sitio() . 'files/img/maq/guardar.gif'; ?>" alt="submit" />GUARDAR</button>
                        <?php
                        echo anchor($this->controlador . 'informacion_adicional', '<img border="0" src="' . $this->tool_entidad->sitio() . 'files/img/maq/cancelar.gif" /> CANCELAR', array('class' => 'boton_cancelar'));
                        ?>
                </div>                
            </td>
        </tr>
    </table>
</div>

<br/>
<?php
//echo form_submit('enviar', '  Guardar  ');
?>

<?php echo form_close() ?>
