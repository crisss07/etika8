<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/files/multiselect/css/multi-select.css">
<?php
$this->load->view('cabecera');
?>
<?php
$prefijo = $this->prefijo;
$prefijoF = $this->prefijoF;
$alineacionwc1 = 'center';
$alineacionhc1 = 'middle';
$alineacionwc2 = 'left';
$alineacionhc2 = 'middle';
if ($fila[$prefijoF . 'ambito_exp']) {
    for ($j = 1; $j <= 3; $j++) {
        if (preg_match('/' . $j . '/', $fila[$prefijoF . 'ambito_exp'])) {
            $fila[$prefijoF . 'ambito_exp' . $j] = $j;
        }
    }
}
if (@$fila[$prefijoF . 'ambito_exp1']) {
    $valor_ambexp1 = 'checked';
}
if (@$fila[$prefijoF . 'ambito_exp2']) {
    $valor_ambexp2 = 'checked';
}
if (@$fila[$prefijoF . 'ambito_exp3']) {
    $valor_ambexp3 = 'checked';
}
?>
<?php echo form_open_multipart($action); ?>

<?php
echo form_hidden($prefijo . 'id', set_value($prefijo . 'id', $fila[$prefijo . 'id']));
?>
<input type="hidden" name="<?php echo $prefijo . 'id'; ?>" value="<?php echo set_value($prefijo . 'id', $fila[$prefijo . 'id']); ?>">
<?php
echo '<br/><div align="center">' . anchor($this->controlador . 'trayectoria_laboral/id/' . $fila[$prefijo . 'id'], 'Cancelar', array('class' => 'enlace_cancelar enlace_a1')) . '</div><br/>';
?>
<table id="form_admin">
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <?php $nombre = 'ambito_exp'; ?>
            <?php echo form_label(' Ambito en el que clasificar&iacute;a su experiencia: ', $prefijoF . $nombre); ?>
        </td>
        <td align="left" valign="<?php echo $alineacionhc2; ?>">
            <input type="checkbox" name="<?php echo $prefijoF . $nombre . '1'; ?>" value="1" <?php echo @$valor_ambexp1; ?> /> Empresa Privada<br/>
            <input type="checkbox" name="<?php echo $prefijoF . $nombre . '2'; ?>" value="2" <?php echo @$valor_ambexp2; ?> /> Entidad Publica<br/>
            <input type="checkbox" name="<?php echo $prefijoF . $nombre . '3'; ?>" value="3" <?php echo @$valor_ambexp3; ?> /> Cooperaci&oacute;n para el Desarrollo
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <?php $campo1 = 'area_exp'; ?>
            <?php echo form_label(' &aacute;rea de experiencia que usted resaltar&iacute;a: ', $prefijoF . $campo1); ?>
        </td>
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
            <?php
            $arrayAreaExperiencia = explode(',', $fila[$prefijoF . $campo1]);
            echo form_dropdown($prefijoF . $campo1. "[]", $this->area_experiencia, set_value($prefijoF . $campo1, $arrayAreaExperiencia), 'id="areaexpreciencia" multiple="multiplemultiple"');
            if (form_error($prefijoF . $campo1))
                echo '<div class="error">' . form_error($prefijoF . $campo1) . '</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <?php $campo1 = 'sector_exp'; ?>
            <?php echo form_label(' Sector de experiencia que usted resaltar&iacute;a: ', $prefijo . $campo1); ?>
        </td>
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
            <?php
            $arraySector = explode(',', $fila[$prefijoF . $campo1]);
            echo form_dropdown($prefijoF . $campo1. "[]", $this->sector_experiencia, set_value($prefijoF . $campo1, $arraySector), 'id="sectorexpreciencia" multiple="multiplemultiple"');
            if (form_error($prefijo . $campo1))
                echo '<div class="error">' . form_error($prefijo . $campo1) . '</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <?php
            $nombre = 'supervisar_exp';
            if ($fila[$prefijoF . $nombre] == 'si') {
                $experiencia1 = 'checked';
            } elseif ($fila[$prefijoF . $nombre] == 'no') {
                $experiencia2 = 'checked';
            }
            ?>
            <?php echo form_label(' Experiencia en supervisi&oacute;n: ', $prefijoF . $nombre); ?>
        </td>
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
            <input type="radio" name="<?php echo $prefijoF . $nombre; ?>" value="si" <?php echo @$experiencia1; ?> onclick="javascript:document.getElementById('experiencia_sup').style.display = (this.checked ? 'block' : 'none');" class="radioExperiencia" /> <b>Si</b>
            <input type="radio" name="<?php echo $prefijoF . $nombre; ?>" value="no" <?php echo @$experiencia2; ?> onclick="javascript:document.getElementById('experiencia_sup').style.display = (this.checked ? 'none' : 'block');" class="radioExperiencia"/> <b>No</b>
            <?php
            if (form_error($prefijoF . $nombre))
                echo '<div class="error">' . form_error($prefijoF . $nombre) . '</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="left">
            <?php
            if ($fila[$prefijoF . $nombre] == 'si') {
                $display = 'display: block;';
                $displayN = 'display: none;';
            } else {
                $displayN = 'display: block;';
                $display = 'display: none;';
            }
            ?>
            <div id="experiencia_sup" style="<?php echo $display; ?>">
                <table width="100%">
                    <tr>
                        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                            <?php $campo1 = 'max_nivel'; ?>
                            <?php echo form_label(' Máximo nivel alcanzado: ', $prefijoF . $campo1); ?>
                        </td>
                        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                            <?php
                            echo form_dropdown($prefijoF . $campo1, $this->nivel_alcanzado, set_value($prefijoF . $campo1, $fila[$prefijoF . $campo1]));
                            if (form_error($prefijoF . $campo1))
                                echo '<div class="error">' . form_error($prefijoF . $campo1) . '</div>';
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                            <?php $nombre = 'anios_exp'; ?>
                            <?php echo form_label(' Años de experiencia en supervisión: ', $prefijoF . $nombre); ?><br/>
                        </td>
                        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                            <?php
                            echo form_input(array(
                                'name' => $prefijoF . $nombre,
                                'id' => $prefijoF . $nombre,
                                'class' => 'input1',
                                'size' => '3',
                                'maxlength' => '2',
                                'value' => set_value($prefijoF . $nombre, $fila[$prefijoF . $nombre]),
                                'onkeyup' => 'this.value=Numeros(this.value)'
                            ));

                            if (form_error($prefijoF . $nombre))
                                echo '<div class="error">' . form_error($prefijoF . $nombre) . '</div>';
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="experiencia_sup_no" style="<?php echo $displayN; ?>">
                <table width="100%">
                    <tr>
                        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                            <?php $campo1 = 'max_nivel_no'; ?>
                            <?php echo form_label('  No Supervici&oacute;n: ', $prefijoF . $campo1); ?>
                        </td>
                        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                            <?php
                            echo form_dropdown($prefijoF . $campo1, $this->nivel_alcanzadoN, set_value($prefijoF . $campo1, $fila[$prefijoF . $campo1]));
                            if (form_error($prefijoF . $campo1))
                                echo '<div class="error">' . form_error($prefijoF . $campo1) . '</div>';
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
</table>


<br/>
<!--input name="enviar" src="<?php echo $this->tool_entidad->sitio() . 'files/img/siguiente.png'; ?>" type="image" value="  Guardar  "-->
<?php echo form_submit('enviar', '  Guardar  ') ?>

<?php echo form_close() ?>
<br/>
<script src="<?php echo base_url(); ?>/files/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>/files/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript">
                $('#sectorexpreciencia').multiSelect({
                });
                $('#areaexpreciencia').multiSelect({
                });
                $(document).ready(function () {
                    $('#sectorexpreciencia').change(function (event) {
                        arrayIngles = $('select#sectorexpreciencia').val();
//                                    $('.criterios_selecionados').val(arrayCiudad.join());
                        if ($(this).val().length >= 3) {
                            $('#ms-sectorexpreciencia .ms-elem-selectable').addClass('disabled');
                        } else {
                            $('#ms-sectorexpreciencia .ms-elem-selectable').removeClass('disabled');
                        }
                    });
                    $('#areaexpreciencia').change(function (event) {
                        arrayIngles = $('select#areaexpreciencia').val();
//                                    $('.criterios_selecionados').val(arrayCiudad.join());
                        if ($(this).val().length >= 3) {
                            $('#ms-areaexpreciencia .ms-elem-selectable').addClass('disabled');
                        } else {
                            $('#ms-areaexpreciencia .ms-elem-selectable').removeClass('disabled');
                        }
                    });
                    $(".obtener_criterios").click(function () {
                        var stringCriterios = $("#stringcriterios").val();
                        var arrayCriterios = stringCriterios.split(",");
                        var resultado = [];
                        for (var i = 0; i < arrayCriterios.length; i++) {
                            switch (parseInt(arrayCriterios[i])) {
                                case 18:
                                    resultado.push(validarIngles());
                                    break;
                            }
                        }
                        if (resultado.includes(false) == false)
                        {
                            document.formularioCriterios.submit()
                        }
                    })
                });
                function validarIngles() {
                    var arrayCampos = $("#ingles").val();
                    if (arrayCampos.length > 0)
                    {
                        $("#mensajeingles").removeClass('alerta-incorrecta-criterios');
                        $("#mensajeingles").html("");
                        return true;
                    } else {
                        $("#mensajeingles").addClass('alerta-incorrecta-criterios');
                        $("#mensajeingles").html("debe seleccionar al menos una opción de habla ingles");
                        return false;
                    }
                }
</script>