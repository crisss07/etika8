<?php
$this->load->view('cabecera');
?>
<?php
$prefijo = $this->prefijoPI;
$alineacionwc1 = 'center';
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
echo form_hidden($prefijo . 'id', @set_value($prefijo . 'id', $fila[$prefijo . 'id']));
?>
<input type="hidden" name="<?php echo $prefijo . 'id'; ?>" value="<?php echo @set_value($prefijo . 'id', $fila[$prefijo . 'id']); ?>">
<input type="hidden" name="<?php echo 'ids'; ?>" value="<?php echo $ids; ?>">
<?php
echo '<br/><div align="center">' . anchor($this->controlador . 'informacion_adicional/id/' . $ids, 'Cancelar', array('class' => 'enlace_cancelar enlace_a1')) . '</div><br/>';
?>
<div id="idioma">
    <table id="form_admin">        
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                <?php
                $nombre = 'id';
                $prefijoIdioma = 'idi_'
                ?>
                <?php echo form_label(' Idioma: ', $prefijo . $nombre); ?>
            </td>
            <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                <?php
                if ($fila[$prefijoIdioma . $nombre] != 1) {
                    ?>
                    <select name = "idi_id" class = "select_idioma">
                        <option value = "">Elija idioma</option>
                        <?php
                        foreach ($idiomas as $key => $value) {
                            ?>
                            <option  value="<?php echo $value['idi_id']; ?>" <?php echo $value['idi_id'] == $fila[$prefijoIdioma . $nombre] ? 'selected' : ''; ?>><?php echo $value['idi_idioma']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php
                } else {
                    ?>
                    <?php
                    echo form_label($fila[$prefijoIdioma . 'idioma'], '', array(
                        'style' => 'font-weight: bold;'
                    ));
                    ?>
                    <input name="idi_id" style="display: none;" value="<?php echo $fila[$prefijoIdioma . $nombre]; ?>"/>
                    <?php
                }
                if (form_error($prefijoIdioma . $nombre))
                    echo '<div class="error">' . form_error($prefijoIdioma . $nombre) . '</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="3" align="left"> 

                <div id="idioma" class="otro_idioma" <?php echo $displayIdioma; ?>>
                    <span class="texto3">Escriba el Idioma -> </span>
                    <?php
                    $nombre = 'idioma_otro';

                    echo "<input type='text' name='" . $prefijo . $nombre . "' id='" . $prefijo . $nombre . "'
                                    class='input1' size='30' onblur='Mayusculas(this.value,this.id)' value='" . $fila[$prefijo . $nombre] . "' />";
//                    echo form_input(array(
//                        'name' => $prefijo . $nombre,
//                        'id' => $prefijo . $nombre,
////                                    'class' => 'input1',
//                        'size' => '30',
////                                    'onblur' => 'Mayusculas(this.value,this.id)',
//                        'value' => $fila[$prefijo . $nombre]
//                    ));

                    if (form_error($prefijo . $nombre))
                        echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                    ?>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                <table width="100%" align="center">
                    <tr>
                        <th> &nbsp;</th>
                        <th style="font-size: 10px;"> Excelente&nbsp;&nbsp; </th>
                        <th style="font-size: 10px;"> Muy bueno&nbsp;&nbsp; </th>
                        <th style="font-size: 10px;"> Regular&nbsp;&nbsp; </th>
                        <th style="font-size: 10px;"> Basico </th>
                    </tr>
                    <tr>
                        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                            <?php $nombre = 'habla'; ?>
                            <?php echo form_label(' Habla: ', $prefijo . $nombre); ?>
                        </td>
                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php echo @$valor_habla1; ?> /></td>
                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="2" <?php echo @$valor_habla2; ?> /></td>
                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="3" <?php echo @$valor_habla3; ?> /></td>
                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="4" <?php echo @$valor_habla4; ?> /></td>
                    </tr>
                    <tr>
                        <td colspan="5" >
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
                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php echo @$valor_lee1; ?> /></td>
                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="2" <?php echo @$valor_lee2; ?> /></td>
                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="3" <?php echo @$valor_lee3; ?> /></td>
                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="4" <?php echo @$valor_lee4; ?> /></td>
                    </tr>
                    <tr>
                        <td colspan="5" >
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
                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php echo @$valor_escribe1; ?> /></td>
                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="2" <?php echo @$valor_escribe2; ?> /></td>
                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="3" <?php echo @$valor_escribe3; ?> /></td>
                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="4" <?php echo @$valor_escribe4; ?> /></td>
                    </tr>
                    <tr>
                        <td colspan="5" >
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
</div>

<br/>
<?php
echo form_submit('enviar', '  Guardar  ');
?>

<?php echo form_close() ?>
