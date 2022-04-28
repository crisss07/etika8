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
switch ($fila[$prefijoF . 'sexo']) {
    case 1:
        $valor1 = 'checked';
        break;
    case 2:
        $valor2 = 'checked';
        break;
    default:
        $valor1 = 'checked';
        break;
}
if ($fila[$prefijo . 'nacionalidad']) {
    switch ($fila[$prefijo . 'nacionalidad']) {
        case 'BOLIVIANA':
            $valor_nac1 = 'checked';
            break;
        default:
            $valor_nac2 = 'checked';
            $nacionalidad = $fila[$prefijo . 'nacionalidad'];
            break;
    }
} else {
    $valor_nac1 = 'checked';
}
$pais_otro = "";

if (@$fila[$prefijoF . 'pai_id'] != 1) {
    $pais_otro = $fila[$prefijoF . 'pais_ciudad'];
}
$ciudad = $fila[$prefijoF . 'ciudad_otra'];
$idPais = $fila['pai_id'];
if ($idPais != 1) {
    $displayCiudades = 'style = "display: none;"';
    $displayPaisCiudad = 'style = "display: block;"';
} else {
//    $displayCiudades = 'style = "display: block;"';
    $displayPaisCiudad = 'style = "display: none;"';
}
$idCiudad = $fila['ciu_id'];

if ($idCiudad != 85 && $idCiudad != 92 && $idCiudad != 119 && $idCiudad != 125 && $idCiudad != 127 && $idCiudad != 133 && $idCiudad != 142 && $idCiudad != 149 && $idCiudad != 155) {
    $displayCiudad = 'style = "display: none;"';
} else {
    $displayCiudad = 'style = "display: block;"';
}
if (@$fila[$prefijo . 'traslado'] == 1) {
    $valor_tras = 'checked';
}
?>
<table align="center" cellpadding="10">
    <tr>
        <td class="enlaces_add_edit" align="center"><?php echo anchor($this->controlador . 'editar/id/' . $fila[$prefijo . 'id'], 'Cancelar', array('class' => 'enlace_cancelar enlace_a1')); ?></td>
    </tr>
</table>
<br>
<?php echo form_open_multipart($action); ?>

<?php
echo form_hidden($prefijo . 'id', set_value($prefijo . 'id', $fila[$prefijo . 'id']));
?>
<input type="hidden" name="<?php echo $prefijo . 'id'; ?>" value="<?php echo set_value($prefijo . 'id', $fila[$prefijo . 'id']); ?>">
<table id="form_admin">
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <?php $nombre = 'nombre'; ?>
            <?php echo form_label('Nombres: ', $prefijo . $nombre); ?>
        </td>
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
            <?php
            echo "<input type='text' name=".$prefijo.$nombre." id=".$prefijo.$nombre."
                                    class='input1' size='20' onblur='Mayusculas(this.value,this.id)' value='".$fila[$prefijo.$nombre]."' />";
//            echo form_input(array(
//                'name' => $prefijo . $nombre,
//                'id' => $prefijo . $nombre,
//                'class' => 'input1',
//                'size' => '20',
//                'onblur' => 'Mayusculas(this.value,this.id)',
//                'value' => set_value($prefijo . $nombre, $fila[$prefijo . $nombre])
//            ));

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <?php $nombre = 'apaterno'; ?>
            <?php echo form_label('Apellido Paterno: ', $prefijo . $nombre); ?>
        </td>
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
            <?php
            echo "<input type='text' name=".$prefijo.$nombre." id=".$prefijo.$nombre."
                                    class='input1' size='15' onblur='Mayusculas(this.value,this.id)' value='".$fila[$prefijo.$nombre]."' />";
//            echo form_input(array(
//                'name' => $prefijo . $nombre,
//                'id' => $prefijo . $nombre,
//                'class' => 'input1',
//                'size' => '15',
//                'onblur' => 'Mayusculas(this.value,this.id)',
//                'value' => set_value($prefijo . $nombre, $fila[$prefijo . $nombre])
//            ));

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <?php $nombre = 'amaterno'; ?>
            <?php echo form_label('Apellido Materno: ', $prefijo . $nombre); ?>
        </td>
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
            <?php
            echo "<input type='text' name=".$prefijo.$nombre." id=".$prefijo.$nombre."
                                    class='input1' size='15' onblur='Mayusculas(this.value,this.id)' value='".$fila[$prefijo.$nombre]."' />";
//            echo form_input(array(
//                'name' => $prefijo . $nombre,
//                'id' => $prefijo . $nombre,
//                'class' => 'input1',
//                'size' => '15',
//                'onblur' => 'Mayusculas(this.value,this.id)',
//                'value' => set_value($prefijo . $nombre, $fila[$prefijo . $nombre])
//            ));

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <?php $fecha = 'fecha_nacimiento'; ?>
            <?php echo form_label('Fecha de Nacimiento: ', $prefijoF . $fecha); ?>
        </td>
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
            <?php
            if (!@$fila[$prefijoF . $fecha]) {
                $fila[$prefijoF . $fecha] = 'aaaa-mm-dd';
            }
            ?><input maxlength="10" type="input" class="input1_normal" id="fecha" name="<?php echo $prefijoF . $fecha; ?>" size="8" onFocus="if (this.value == 'aaaa-mm-dd') {
                        this.value = '';
                        this.style.color = '#000000';
                    }" onBlur="if (this.value == '') {
                                this.value = 'aaaa-mm-dd';
                                this.style.color = '#aca899';
                            }" value="<?php echo set_value($prefijoF . $fecha, $fila[$prefijoF . $fecha]); ?>" >
            &nbsp;&nbsp;Año-mes-dia
            <?php
            if (form_error($prefijoF . $fecha))
                echo '<div class="error">' . form_error($prefijoF . $fecha) . '</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <?php $nombre = 'sexo'; ?>
            <?php echo form_label('Género: ', $prefijoF . $nombre); ?>
        </td>
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
            <input type="radio" name="<?php echo $prefijoF . $nombre; ?>" value="1" <?php echo @$valor1; ?> /> Masculino
            <input type="radio" name="<?php echo $prefijoF . $nombre; ?>" value="2" <?php echo @$valor2; ?> /> Femenino
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <?php $nombre = 'nacionalidad'; ?>
            <?php echo form_label('Nacionalidad: ', $prefijo . $nombre); ?>
        </td>
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
            <input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php echo @$valor_nac1; ?> onclick="javascript:document.getElementById('otro').style.display = ('none');" /> Boliviana
            <input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="2" <?php echo @$valor_nac2; ?> onclick="javascript:document.getElementById('otro').style.display = (this.checked ? 'block' : 'none');" /> Otra
            <?php if (!@$nacionalidad) { ?>
                <div id="otro" style="display: none;" >
                    <?php
                     echo "<input type='text' name='".$prefijo.$nombre."_otra' id='".$prefijo.$nombre."_otra'
                                    class='input1' size='20' onblur='Mayusculas(this.value,this.id)' value='".@$nacionalidad."' /> <- Escriba la Nacionalidad";
//                    echo form_input(array(
//                        'name' => $prefijo . $nombre . '_otra',
//                        'id' => $prefijo . $nombre . '_otra',
//                        'class' => 'input1',
//                        'size' => '20',
//                        'onblur' => 'Mayusculas(this.value,this.id)',
//                        'value' => $nacionalidad
//                    )) . ' <- Escriba la Nacionalidad';

                    if (form_error($prefijo . $nombre))
                        echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                    ?>
                </div>
            <?php }else { ?>
                <div id="otro" >
                    <?php
                    echo "<input type='text' name='".$prefijo.$nombre."_otra' id='".$prefijo.$nombre."_otra'
                                    class='input1' size='18' onblur='Mayusculas(this.value,this.id)' value='".$nacionalidad."' /> <- Escriba la Nacionalidad";
//                    echo form_input(array(
//                        'name' => $prefijo . $nombre . '_otra',
//                        'id' => $prefijo . $nombre . '_otra',
//                        'class' => 'input1',
//                        'size' => '20',
//                        'onblur' => 'Mayusculas(this.value,this.id)',
//                        'value' => $nacionalidad
//                    )) . ' <- Escriba la Nacionalidad';

                    if (form_error($prefijo . $nombre))
                        echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                    ?>
                </div>
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <?php $nombre = 'pais_otro'; ?>
            <?php echo form_label('País de Residencia: ', $prefijo . $nombre); ?>
        </td>
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
            <select name="pai_id" style="min-width: 150px;" class="select_pais">
                <?php
                foreach ($paises as $key => $value) {
                    ?>
                    <option value="<?php echo $value[$this->prefijoP . 'id']; ?>" <?php echo $value[$this->prefijoP . 'id'] == $fila['pai_id'] ? 'selected' : ''; ?>><?php echo$value[$this->prefijoP . 'nombre']; ?></option>
                    <?php
                }
                ?>
            </select>
<!--            <input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php echo $valor_pais1; ?> onclick="javascript:document.getElementById('pais').style.display=('none');" /> Bolivia
<input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="2" <?php echo $valor_pais2; ?> onclick="javascript:document.getElementById('pais').style.display=(this.checked?'block':'none');" /> Otro-->
            <?php $nombre = 'pais_ciudad'; ?>
            <div id="pais" class="otro_pais_ciudad" <?php echo $displayPaisCiudad; ?>>
                <?php
                echo "<input type='text' name='".$prefijoF.$nombre."' id='".$prefijoF.$nombre."'
                                    class='input1' size='20' onblur='Mayusculas(this.value,this.id)' value='".$pais_otro."' /><- Escriba la ciudad";
//                echo form_input(array(
//                    'name' => $prefijoF . $nombre,
//                    'id' => $prefijoF . $nombre,
//                    'class' => 'input1',
//                    'size' => '20',
//                    'onKeyUp' => 'Mayusculas(this.value,this.id)',
//                    'value' => $pais_otro
//                )) . ' <- Escriba la ciudad';

                if (form_error($prefijoF . $nombre))
                    echo '<div class="error">' . form_error($prefijoF . $nombre) . '</div>';
                ?>
            </div>
        </td>
    </tr>
    <tr class="contenedor_ciudades" <?php echo @$displayCiudades; ?>>
        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <?php $nombre = 'ciudad'; ?>
            <?php echo form_label('Ciudad o localidad: ', $prefijo . $nombre); ?>
        </td>
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
            <!--adicionamos el select de ciudades-->
            <select name="ciu_id" style="min-width: 150px;" class="select_ciudad">
                <option value="">Seleccione una ciudad</option>
                <?php
                foreach ($ciudades as $key => $value) {
                    ?>
                    <option value="<?php echo $value[$this->prefijoP . 'id']; ?>" <?php echo $value[$this->prefijoP . 'id'] == $fila['ciu_id'] ? 'selected' : ''; ?>><?php echo$value[$this->prefijoP . 'nombre']; ?></option>
                    <?php
                }
                ?>
            </select>
            <div id="ciudad" class="otra_ciudad" <?php echo $displayCiudad; ?>>
                <?php
                $nombre = 'ciudad_otra';
                echo "<input type='text' name='".$prefijoF.$nombre."' id='".$prefijoF.$nombre."'
                                    class='input1' size='20' onblur='Mayusculas(this.value,this.id)' value='".$ciudad."' /><- Escriba la Ciudad";
//                echo form_input(array(
//                    'name' => $prefijoF . $nombre,
//                    'id' => $prefijof . $nombre,
//                    'class' => 'input1',
//                    'size' => '20',
//                    'onKeyUp' => 'Mayusculas(this.value,this.id)',
//                    'value' => $ciudad
//                )) . ' <- Escriba la Ciudad';

                if (form_error($prefijoF . $nombre))
                    echo '<div class="error">' . form_error($prefijoF . $nombre) . '</div>';
                ?>
            </div>
            <?php
            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <?php $nombre = 'direccion'; ?>
            <?php echo form_label('Dirección: ', $prefijo . $nombre); ?>
        </td>
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
            <?php
            echo "<input type='text' name='".$prefijo.$nombre."' id='".$prefijo.$nombre."'
                                    class='input1' size='40' onblur='Mayusculas(this.value,this.id)' value='".$fila[$prefijo . $nombre]."' />";
//            echo form_input(array(
//                'name' => $prefijo . $nombre,
//                'id' => $prefijo . $nombre,
//                'class' => 'input1',
//                'size' => '30',
//                'onblur' => 'Mayusculas(this.value,this.id)',
//                'value' => set_value($prefijo . $nombre, $fila[$prefijo . $nombre])
//            ));

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center" height="30">
            <span class="text4">
                <b> Nota.- </b>Debe Introducir al menos el <b>Teléfono</b> o el <b>Celular</b>.
            </span>

        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <?php $nombre = 'telefono'; ?>
            <?php echo form_label('Teléfono: ', $prefijo . $nombre); ?>
        </td>
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
            <?php
            echo "<input type='text' name='".$prefijo.$nombre."' id='".$prefijo.$nombre."'
                                    class='input1' size='10' value='".$fila[$prefijo . $nombre]."' />";
//            echo form_input(array(
//                'name' => $prefijo . $nombre,
//                'id' => $prefijo . $nombre,
//                'class' => 'input1',
//                'size' => '10',
//                'value' => set_value($prefijo . $nombre, $fila[$prefijo . $nombre])
//            ));

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <?php $nombre = 'celular'; ?>
            <?php echo form_label('Celular: ', $prefijo . $nombre); ?>
        </td>
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
            <?php
            echo "<input type='text' name='".$prefijo.$nombre."' id='".$prefijo.$nombre."'
                                    class='input1' size='10' value='".$fila[$prefijo . $nombre]."' />";
//            echo form_input(array(
//                'name' => $prefijo . $nombre,
//                'id' => $prefijo . $nombre,
//                'class' => 'input1',
//                'size' => '10',
//                'value' => set_value($prefijo . $nombre, $fila[$prefijo . $nombre])
//            ));

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
        </td>
    </tr>
    <?php if (@$error_telefono) { ?>
        <tr>
            <td colspan="2" align="center" height="30">
                <div class="error"><?php echo $error_telefono; ?></div>
            </td>
        </tr>
    <?php } ?>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <?php $nombre = 'email'; ?>
            <?php echo form_label('Correo Electrónico: ', $prefijo . $nombre); ?>
        </td>
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
            <?php
            echo "<input type='text' name='".$prefijo.$nombre."' id='".$prefijo.$nombre."'
                                    class='input1_normal' size='30' value='".$fila[$prefijo . $nombre]."' />";
//            echo form_input(array(
//                'name' => $prefijo . $nombre,
//                'id' => $prefijo . $nombre,
//                'class' => 'input1_normal',
//                'size' => '30',
//                'value' => set_value($prefijo . $nombre, $fila[$prefijo . $nombre])
//            ));

            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <?php $nombre = 'traslado'; ?>
            <?php echo form_label('Disponibilidad de trasladarse a otra ciudad ', $prefijo . $nombre); ?>
        </td>
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
            <input type="checkbox" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php echo @$valor_tras; ?> onclick="javascript:document.getElementById('traslado').style.display = (this.checked ? 'block' : 'none');" /> <b>Si</b>
            <?php if (!@$fila[$prefijo . $nombre . '_lugar']) { ?>
                <div id="traslado" style="display: none;" >
                    <?php
                    echo "<input type='text' name='".$prefijo.$nombre."_lugar' id='".$prefijo.$nombre."_lugar'
                                    class='input1' size='10' value='".$fila[$prefijo . $nombre."_lugar"]."' /> <- Escriba la Ciudad de Traslado";
//                    echo form_input(array(
//                        'name' => $prefijo . $nombre . '_lugar',
//                        'id' => $prefijo . $nombre . '_lugar',
//                        'class' => 'input1',
//                        'size' => '20',
//                        'onblur' => 'Mayusculas(this.value,this.id)',
//                        'value' => set_value($prefijo . $nombre, $fila[$prefijo . $nombre . '_lugar'])
//                    )) . ' <- Escriba la Ciudad de Traslado';

                    if (form_error($prefijo . $nombre))
                        echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                    ?>
                </div>
            <?php }else { ?>
                <div id="traslado" >
                    <?php
                    echo "<input type='text' name='".$prefijo.$nombre."_lugar' id='".$prefijo.$nombre."_lugar'
                                    class='input1' size='20' value='".$fila[$prefijo . $nombre."_lugar"]."' /> <- Escriba la Ciudad de Traslado";
//                    echo form_input(array(
//                        'name' => $prefijo . $nombre . '_lugar',
//                        'id' => $prefijo . $nombre . '_lugar',
//                        'class' => 'input1',
//                        'size' => '20',
//                        'onblur' => 'Mayusculas(this.value,this.id)',
//                        'value' => set_value($prefijo . $nombre . '_lugar', $fila[$prefijo . $nombre . '_lugar'])
//                    )) . ' <- Escriba la Ciudad de Traslado';

                    if (form_error($prefijo . $nombre))
                        echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                    ?>
                </div>
            <?php } ?>
        </td>
    </tr>    
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <?php $pass = 'salario'; ?>
            <?php echo form_label('Pretensión Salarial Referencial (en Bs.): ', $prefijoF . $pass); ?>
        </td>
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
            <?php
            echo form_input(array(
                'name' => $prefijoF . $pass,
                'id' => $prefijoF . $pass,
                'class' => 'input1',
                'size' => '10',
                'value' => set_value($prefijoF . $pass, $fila[$prefijoF . $pass]),
                'onkeyup' => "this.value=Numeros(this.value)"
            )) . ' en Bs.';

            if (form_error($prefijoF . $pass))
                echo '<div class="error">' . form_error($prefijoF . $pass) . '</div>';
            ?>
        </td>
    </tr>    
</table>

<br/>
<?php echo form_submit('enviar', '  Guardar  ') ?>

<?php echo form_close() ?>
<br/>
<script>
//para mostrar el datepicker
    $(function () {
        $("#fecha").datepicker({
            changeYear: true,
            changeMonth: true,
            dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            dayNames: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado"],
            monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
            dateFormat: "yy-mm-dd",
            yearRange: '-60:-18',
//        defaultDate:  new Date(1990,00,01)
//        https://stackoverflow.com/questions/3829033/jquery-ui-datepicker-default-date
            defaultDate: '-30y 0m 0d'
//        maxDate: "-18y",

        }).attr('readonly', 'readonly');
        ;
        $("#fecha").keypress(function (event) {
            event.preventDefault();
        });
    });
</script>