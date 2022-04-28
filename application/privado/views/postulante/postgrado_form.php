<?php
$this->load->view('cabecera');
?>
<?php
$prefijo = $this->prefijo1;
$alineacionwc1 = 'center';
$alineacionhc1 = 'middle';
$alineacionwc2 = 'left';
$alineacionhc2 = 'middle';
?>
<?php echo form_open_multipart($action); ?>
<input type="hidden" name="<?php echo $prefijo . 'id'; ?>" value="<?php echo set_value($prefijo . 'id', @$fila[$prefijo . 'id']); ?>">
<input type="hidden" name="<?php echo 'ids'; ?>" value="<?php echo $ids; ?>">
<?php
echo '<br/><div align="center">' . anchor($this->controlador . 'instruccion_formal/id/' . $ids, 'Cancelar', array('class' => 'enlace_cancelar enlace_a1')) . '</div><br/>';
?>
<div id="post_grado">
    <table id="form_admin">
        <tr>
            <td colspan="2" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                <?php $fecha = 'desde'; ?>
                <?php echo form_label('Desde: ', $prefijo . $fecha); ?>
                <?php
                if (@!$fila[$prefijo . $fecha]) {
                    $fila[$prefijo . $fecha] = 'aaaa-mm';
                } else {
                    $fila[$prefijo . $fecha] = substr($fila[$prefijo . $fecha], 0, 7);
                }
                ?>
                <input maxlength="7" type="input" class="input1_normal" style="color:#aca899;" id="<?php echo $prefijo . $fecha; ?>" name="<?php echo $prefijo . $fecha; ?>" size="7" onFocus="if (this.value == 'aaaa-mm') {
                            this.value = '';
                            this.style.color = '#000000';
                        }" onBlur="if (this.value == '') {
                                    this.value = 'aaaa-mm';
                                    this.style.color = '#aca899';
                                }" value="<?php echo set_value($prefijo . $fecha, $fila[$prefijo . $fecha]); ?>" ><span class="texto2">&nbsp;Año-mes</span>

                <?php $fecha = 'hasta'; ?>
                <?php echo form_label('Hasta: ', $prefijo . $fecha); ?>
                <?php
                if (@!$fila[$prefijo . $fecha]) {
                    $fila[$prefijo . $fecha] = 'aaaa-mm';
                } else {
                    $fila[$prefijo . $fecha] = substr($fila[$prefijo . $fecha], 0, 7);
                }
                ?>
                <input maxlength="7" type="input" class="input1_normal" style="color:#aca899;" id="<?php echo $prefijo . $fecha; ?>" name="<?php echo $prefijo . $fecha; ?>" size="7" onFocus="if (this.value == 'aaaa-mm') {
                            this.value = '';
                            this.style.color = '#000000';
                        }" onBlur="if (this.value == '') {
                                    this.value = 'aaaa-mm';
                                    this.style.color = '#aca899';
                                }" value="<?php echo set_value($prefijo . $fecha, $fila[$prefijo . $fecha]); ?>" ><span class="texto2">&nbsp;Año-mes</span>
                <?php
                if (form_error($prefijo . 'desde') || form_error($prefijo . 'hasta'))
                    echo '<div class="error">Debe ingresar un Formato correcto de fecha</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                <?php $nombre = 'institucion'; ?>
                <?php echo form_label('Institución: ', $prefijo . $nombre); ?>
            </td>
            <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                <?php
                echo "<input type='text' name='" . $prefijo . $nombre . "' id='" . $prefijo . $nombre . "'
                                    class='input1' size='25' onblur='Mayusculas(this.value,this.id)' value='" . $fila[$prefijo . $nombre] . "' />";
//                    echo form_input(array(
//                        'name' => $prefijo.$nombre,
//                        'id' => $prefijo.$nombre,
//                        'class' => 'input1',
//                        'size' => '25',
//                        'onblur'=>'Mayusculas(this.value,this.id)',
//                        'value' => set_value($prefijo.$nombre,$fila[$prefijo.$nombre])
//                      ));

                if (form_error($prefijo . $nombre))
                    echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                <?php $nombre = 'pais'; ?>
                <?php echo form_label('País: ', $prefijo . $nombre); ?>
            </td>
            <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                <?php
                echo "<input type='text' name='".$prefijo.$nombre."' id='".$prefijo.$nombre."'
                                    class='input1' size='10' onblur='Mayusculas(this.value,this.id)' value='".$fila[$prefijo . $nombre]."' />";
//                echo form_input(array(
//                    'name' => $prefijo . $nombre,
//                    'id' => $prefijo . $nombre,
//                    'class' => 'input1',
//                    'size' => '10',
//                    'onblur' => 'Mayusculas(this.value,this.id)',
//                    'value' => set_value($prefijo . $nombre, $fila[$prefijo . $nombre])
//                ));

                if (form_error($prefijo . $nombre))
                    echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                <?php $campo1 = 'grado'; ?>
                <?php echo form_label(' Grado o Titulo: ', $prefijo . $campo1); ?>
            </td>
            <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                <?php
                echo form_dropdown($prefijo . $campo1, $this->grados, set_value($prefijo . $campo1, $fila[$prefijo . $campo1]));
                if (form_error($prefijo . $campo1))
                    echo '<div class="error">' . form_error($prefijo . $campo1) . '</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                <?php $nombre = 'area'; ?>
                <?php echo form_label('Área de Post Grado: ', $prefijo . $nombre); ?>
            </td>
            <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                <?php
                echo "<input type='text' name='".$prefijo.$nombre."' id='".$prefijo.$nombre."'
                                    class='input1' size='20' onblur='Mayusculas(this.value,this.id)' value='".$fila[$prefijo . $nombre]."' />";
//                echo form_input(array(
//                    'name' => $prefijo . $nombre,
//                    'id' => $prefijo . $nombre,
//                    'class' => 'input1',
//                    'size' => '20',
//                    'onblur' => 'Mayusculas(this.value,this.id)',
//                    'value' => set_value($prefijo . $nombre, $fila[$prefijo . $nombre])
//                ));

                if (form_error($prefijo . $nombre))
                    echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                <?php $nombre = 'tema'; ?>
                <?php echo form_label('Tema Tesis: ', $prefijo . $nombre); ?>
            </td>
            <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                <?php
                echo "<textarea name=".$prefijo.$nombre." id=".$prefijo.$nombre."
                                    class='input1' rows='5' cols='35' onblur='Mayusculas(this.value,this.id)'>".$fila[$prefijo.$nombre]."</textarea>";
//                echo form_textarea(array(
//                    'name' => $prefijo . $nombre,
//                    'id' => $prefijo . $nombre,
//                    'class' => 'input1',
//                    'rows' => '5',
//                    'cols' => '35',
//                    'onblur' => 'Mayusculas(this.value,this.id)',
//                    'value' => set_value($prefijo . $nombre, $fila[$prefijo . $nombre])
//                ));

                if (form_error($prefijo . $nombre))
                    echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                <?php $nombre = 'nota'; ?>
                <?php echo form_label('Nota de la Tesis: ', $prefijo . $nombre); ?><br/>
                <span class="texto2">del 1 al 100</span>
            </td>
            <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                <?php
                echo form_input(array(
                    'name' => $prefijo . $nombre,
                    'id' => $prefijo . $nombre,
                    'class' => 'input1',
                    'size' => '4',
                    'maxlength' => '3',
                    'value' => @set_value($prefijo . $nombre, $fila[$prefijo . $nombre])
                ));

                if (form_error($prefijo . $nombre))
                    echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                <?php
                $nombre = 'titulado';
                if (@$fila[$prefijo . 'id']) {
                    if ($fila[$prefijo . $nombre] == 1) {
                        $recibir1 = 'checked';
                        $recibir2 = '';
                    } elseif ($fila[$prefijo . $nombre] == 0) {
						$recibir1 = '';
                        $recibir2 = 'checked';
                    }
                }
				
                ?>
                <?php echo form_label('Titulado: ', $prefijo . $nombre); ?>
            </td>
            <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                <input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php echo @$recibir1; ?> /> <b>Si</b>
                <input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="0" <?php echo @$recibir2; ?> /> <b>No</b>
                <?php
                if (form_error($prefijo . $nombre))
                    echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                ?>
            </td>
        </tr>
    </table>
</div>

<br/>
<?php
echo form_submit('enviar', '  Guardar  ');
?>

<?php echo form_close() ?>
