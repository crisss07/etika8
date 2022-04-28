<?php
$this->load->view('cabecera');
?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->tool_entidad->sitio(); ?>files/datepicker/jquery-ui.css" />
<script src="<?php echo $this->tool_entidad->sitio(); ?>files/datepicker/external/jquery/jquery.js"></script>
<script src="<?php echo $this->tool_entidad->sitio(); ?>files/datepicker/jquery-ui.js"></script>
<?php
$prefijo = $this->prefijo;
$prefijoF = $this->prefijoF;
$alineacionwc1 = 'center';
$alineacionhc1 = 'middle';
$alineacionwc2 = 'left';
$alineacionhc2 = 'middle';
?>
<table align="center" cellpadding="10">
    <tr>
        <td class="enlaces_add_edit" align="center"><?php echo anchor($this->controlador . 'editar/id/' . $fila[$prefijo . 'id'], 'Cancelar', array('class' => 'enlace_cancelar enlace_a1')); ?></td>
    </tr>
</table>
<?php echo form_open_multipart($action); ?>

<?php
echo form_hidden($prefijo . 'id', set_value($prefijo . 'id', $fila[$prefijo . 'id']));
?>
<input type="hidden" name="<?php echo $prefijo . 'id'; ?>" value="<?php echo set_value($prefijo . 'id', $fila[$prefijo . 'id']); ?>">
<table id="form_admin">
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <?php $nombre = 'nombre'; ?>
            <?php echo form_label('Recomendaci&oacute;n: ', $prefijo . $nombre); ?>
        </td>
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
            <?php
            $idRecomendacion = $fila['pof_recomendacion'];

            echo form_dropdown('pof_recomendacion', $comboRecomendacion, $idRecomendacion);
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <?php $nombre = 'observacion'; ?>
            <?php echo form_label('Observaci&oacute;n: ', $prefijo . $nombre); ?>
        </td>
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
            <?php
            echo "<textarea name=" . $prefijo . $nombre . " id=" . $prefijo . $nombre . "
                    class='input1' rows='10' cols='50' style='resize: none' >" . $fila[$prefijo . $nombre] . "</textarea>";
//            echo form_textarea(array(
//                'name' => $prefijo . $nombre,
//                'id' => $prefijo . $nombre,
//                'class' => 'input1',
//                'rows' => '10',
//                'cols' => '50',
//                'style' => 'resize: none;',
////    'onblur' => 'Mayusculas(this.value,this.id)',
//                'value' => set_value($prefijo . $nombre, $fila[$prefijo . $nombre])
//            ));

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
        </td>
    </tr>




</table>

<br/>
<?php echo form_submit('enviar', '  Guardar  ') ?>

<?php echo form_close() ?>
<br/>
