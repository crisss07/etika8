<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/files/multiselect/css/multi-select.css">
<?php
$this->load->view('cabecera');
?>
<?php
$prefijo = $this->prefijo;
$prefijoF = $this->prefijoF;
$alineacionwc1 = 'left';
$alineacionhc1 = 'middle';
$alineacionwc2 = 'right';
$alineacionhc2 = 'middle';
if (@$fila[$prefijoF . 'ambito_exp']) {
    for ($j = 1; $j <= 3; $j++) {
        if (preg_match('/' . $j . '/', @$fila[$prefijoF . 'ambito_exp'])) {
            @$fila[$prefijoF . 'ambito_exp' . $j] = $j;
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
echo form_hidden($prefijo . 'id', set_value($prefijo . 'id', @$fila[$prefijo . 'id']));
?>
<input type="hidden" name="<?php echo $prefijo . 'id'; ?>" value="<?php echo set_value($prefijo . 'id', @$fila[$prefijo . 'id']); ?>">
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 text-left">
            <?php
//            ambito
            $nombre = 'ambito_exp';
            echo form_label(' Ambito en el que clasificaría su experiencia: ', $prefijoF . $nombre);
            ?>
            <br/>
            &nbsp; <input type="checkbox" name="<?php echo $prefijoF . $nombre . '1'; ?>" value="1" <?php echo @$valor_ambexp1; ?> /> &nbsp; <span class="texto3 text-mayusculas">Empresa Privada</span><br/>
            &nbsp; <input type="checkbox" name="<?php echo $prefijoF . $nombre . '2'; ?>" value="2" <?php echo @$valor_ambexp2; ?> /> &nbsp; <span class="texto3 text-mayusculas">Entidad Publica</span><br/>
            &nbsp; <input type="checkbox" name="<?php echo $prefijoF . $nombre . '3'; ?>" value="3" <?php echo @$valor_ambexp3; ?> /> &nbsp; <span class="texto3 text-mayusculas">Cooperación para el Desarrollo</span>
            <?php
//            area de experiencia
            $campo1 = 'area_exp';
            echo form_label(' Área de experiencia que usted resaltaría: ', $prefijoF . $campo1);

            $arrayAreaExperiencia = explode(',', @$fila[$prefijoF . $campo1]);
            echo form_dropdown($prefijoF . $campo1 . "[]", $this->area_exp, set_value($prefijoF . $campo1, $arrayAreaExperiencia), 'id="areaexpreciencia" multiple="multiplemultiple"');

            if (form_error($prefijoF . $campo1))
                echo '<div class="error">' . form_error($prefijoF . $campo1) . '</div>';

//            sector de experiencia
            $campo1 = 'sector_exp';

            echo form_label(' Sector de experiencia que usted resaltaría: ', $prefijoF . $campo1);

            $arraySector = explode(',', @$fila[$prefijoF . $campo1]);
            echo form_dropdown($prefijoF . $campo1 . "[]", $this->sector_exp, set_value($prefijoF . $campo1, $arraySector), 'id="sectorexpreciencia" multiple="multiplemultiple"');

            if (form_error($prefijoF . $campo1))
                echo '<div class="error">' . form_error($prefijoF . $campo1) . '</div>';

//            experiencia en supervicion
            $nombre = 'supervisar_exp';
            if (@$fila[$prefijoF . $nombre] == 'si') {
                $experiencia1 = 'checked';
            } elseif (@$fila[$prefijoF . $nombre] == 'no') {
                $experiencia2 = 'checked';
            }
            ?>
            <div class="row justify-content-between">
                <label for="<?php echo $nombre; ?>">Experiencia en supervisión:</label>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="si" name="<?php echo $prefijoF . $nombre; ?>" value="si" <?php echo @$experiencia1; ?> onclick="javascript:document.getElementById('experiencia_sup').style.display = (this.checked ? 'block' : 'none');" class="radioExperiencia custom-control-input" />
                    <label class="custom-control-label" for="si">Si</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="no" name="<?php echo $prefijoF . $nombre; ?>" value="no" <?php echo @$experiencia2; ?> onclick="javascript:document.getElementById('experiencia_sup').style.display = (this.checked ? 'none' : 'block');" class="radioExperiencia custom-control-input" />
                    <label class="custom-control-label" for="no">No</label>
                </div>


                <?php
                if (form_error($prefijo . $nombre))
                    echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                ?>   
            </div>



            <?php
            if (form_error($prefijoF . $nombre))
                echo '<div class="error">' . form_error($prefijoF . $nombre) . '</div>';

//            maximo nivel alcanzado
            if (@$fila[$prefijoF . $nombre] == 'si') {
                $display = 'display: block;';
                $displayN = 'display: none;';
            } elseif (@$fila[$prefijoF . $nombre] == 'no') {
                $displayN = 'display: block;';
                $display = 'display: none;';
            } else {
                $displayN = 'display: none;';
            }
            ?>
            <div id="experiencia_sup" style="<?php echo @$display; ?>">
                <?php
                $campo1 = 'max_nivel';
//                echo form_label(' Máximo nivel alcanzado: ', $prefijoF . $campo1);

                echo form_dropdown($prefijoF . $campo1, $this->nivel_alcanzado, set_value($prefijoF . $campo1, @$fila[$prefijoF . $campo1]), "class='custom-select custom-select-sm input-linea'");
                if (form_error($prefijoF . $campo1))
                    echo '<div class="error">' . form_error($prefijoF . $campo1) . '</div>';

                if (form_error($prefijoF . $campo1))
                    echo '<div class="error">' . form_error($prefijoF . $campo1) . '</div>';
                $nombre = 'anios_exp';
//                echo form_label(' Años de experiencia en supervisión: ', $prefijoF . $nombre);

                echo form_input(array(
                    'name' => $prefijoF . $nombre,
                    'id' => $prefijoF . $nombre,
                    'class' => 'input1 input-etika',
                    'size' => '32',
                    'maxlength' => '2',
                    'placeholder'=>'Años de experiencia en supervisión',
                    'value' => set_value($prefijoF . $nombre, @$fila[$prefijoF . $nombre]),
                    'onkeyup' => 'this.value=Numeros(this.value)'
                ));

                if (form_error($prefijoF . $nombre))
                    echo '<div class="error">' . form_error($prefijoF . $nombre) . '</div>';
                if (form_error($prefijoF . $campo1))
                    echo '<div class="error">' . form_error($prefijoF . $campo1) . '</div>';
                ?>                        
            </div>
            <div id="experiencia_sup_no" style="<?php echo $displayN; ?>">

                <?php
                $campo1 = 'max_nivel_no';
//                echo form_label(' No Supervición: ', $prefijoF . $campo1);

                echo form_dropdown($prefijoF . $campo1, $this->nivel_alcanzadoN, set_value($prefijoF . $campo1, @$fila[$prefijoF . $campo1]), "class='custom-select custom-select-sm input-linea'");
                if (form_error($prefijoF . $campo1))
                    echo '<div class="error">' . form_error($prefijoF . $campo1) . '</div>';
                ?>

                <?php
                if (form_error($prefijoF . $campo1))
                    echo '<div class="error">' . form_error($prefijoF . $campo1) . '</div>';
                ?>
            </div>
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
<!--input name="enviar" src="<?php echo $this->tool_entidad->sitio() . 'files/img/siguiente.png'; ?>" type="image" value="  Guardar  "-->
<?php //echo form_submit('enviar', '  Guardar  ')                 ?>

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