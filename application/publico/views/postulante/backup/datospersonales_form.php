<?php
$this->load->view('cabecera');
?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->tool_entidad->sitio(); ?>files/datepicker/jquery-ui.css" />
<script src="<?php echo $this->tool_entidad->sitio(); ?>files/datepicker/external/jquery/jquery.js"></script>
<script src="<?php echo $this->tool_entidad->sitio(); ?>files/datepicker/jquery-ui.js"></script>
<?php
$prefijo = $this->prefijo;
$prefijoF = $this->prefijoF;
$alineacionwc1 = 'left';
$alineacionhc1 = 'middle';
$alineacionwc2 = 'right';
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
if ($fila[$prefijoF . 'pai_id'] != 1) {
    $pais_otro = $fila[$prefijoF . 'pais_ciudad'];
}

$ciudad = $fila[$prefijoF . 'ciudad_otra'];
$idPais = $fila['pai_id'];

if ($idPais != 1 && $idPais != "") {
    $displayCiudades = 'style = "display: none;"';
    $displayPaisCiudad = 'style = "display: block;"';
} else {
    $displayCiudades = 'style = "display: block;"';
    $displayPaisCiudad = 'style = "display: none;"';
}
$idCiudad = $fila['ciu_id'];

if ($idCiudad != 85 && $idCiudad != 92 && $idCiudad != 119 && $idCiudad != 125 && $idCiudad != 127 && $idCiudad != 133 && $idCiudad != 142 && $idCiudad != 149 && $idCiudad != 155) {
    $displayCiudad = 'style = "display: none;"';
} else {
    $displayCiudad = 'style = "display: block;"';
}
if ($fila[$prefijo . 'traslado'] == 1) {
    $valor_tras = 'checked';
}
?>
<?php echo form_open_multipart($action); ?>

<?php
echo form_hidden($prefijo . 'id', set_value($prefijo . 'id', $fila[$prefijo . 'id']));
?>
<input type="hidden" name="<?php echo $prefijo . 'id'; ?>" value="<?php echo set_value($prefijo . 'id', $fila[$prefijo . 'id']); ?>">
<table id="form_admin" align="left" width="660" cellpadding="5">
    <tr>
        <td>
            <table class="tamanio_campos">
                <tr>
                    <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                        <?php $nombre = 'nombre'; ?>
                        <?php echo form_label('Nombres: ', $prefijo . $nombre); ?>
                    </td>
                    <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                        <?php
                        echo "<input type='text' name=" . $prefijo . $nombre . " id=" . $prefijo . $nombre . "
                                    class='input1' size='40' onblur='Mayusculas(this.value,this.id)' value='" . $fila[$prefijo . $nombre] . "' />";
//                        echo form_input(array(
//                            'name' => $prefijo . $nombre,
//                            'id' => $prefijo . $nombre,
//                            'class' => 'input1',
//                            'size' => '40',
//                            'onblur' => 'Mayusculas(this.value,this.id)',
//                            'value' => set_value($prefijo . $nombre, $fila[$prefijo . $nombre])
//                        ));
                        ?>
                    </td>
                    <td align="left" width="335">
                        <?php
                        if (form_error($prefijo . $nombre))
                            echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                        ?>                        
                    </td>
                </tr>
            </table>
            <table class="tamanio_campos">
                <tr>
                    <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                        <?php $nombre = 'apaterno'; ?>
                        <?php echo form_label('Apellido Paterno: ', $prefijo . $nombre); ?>
                    </td>
                    <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                        <?php
                        echo "<input type='text' name=" . $prefijo . $nombre . " id=" . $prefijo . $nombre . "
                                    class='input1' size='32' onblur='Mayusculas(this.value,this.id)' value='" . $fila[$prefijo . $nombre] . "' />";
//                        echo form_input(array(
//                            'name' => $prefijo . $nombre,
//                            'id' => $prefijo . $nombre,
//                            'class' => 'input1',
//                            'size' => '32',
//                            'onblur' => 'Mayusculas(this.value,this.id)',
//                            'value' => set_value($prefijo . $nombre, $fila[$prefijo . $nombre])
//                        ));
                        ?>
                    </td>
                    <td align="left" width="335">
                        <?php
                        if (form_error($prefijo . $nombre))
                            echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                        ?>                        
                    </td>
                </tr>
            </table>
            <table class="tamanio_campos">
                <tr>
                    <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                        <?php $nombre = 'amaterno'; ?>
                        <?php echo form_label('Apellido Materno: ', $prefijo . $nombre); ?>
                    </td>
                    <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                        <?php
                        echo "<input type='text' name=" . $prefijo . $nombre . " id=" . $prefijo . $nombre . "
                                    class='input1' size='32' onblur='Mayusculas(this.value,this.id)' value='" . $fila[$prefijo . $nombre] . "' />";
//                        echo form_input(array(
//                            'name' => $prefijo . $nombre,
//                            'id' => $prefijo . $nombre,
//                            'class' => 'input1',
//                            'size' => '32',
//                            'onblur' => 'Mayusculas(this.value,this.id)',
//                            'value' => set_value($prefijo . $nombre, $fila[$prefijo . $nombre])
//                        ));
                        ?>
                    </td>
                    <td align="left" width="335">
                        <?php
                        if (form_error($prefijo . $nombre))
                            echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                        ?>                        
                    </td>
                </tr>
            </table>
            <table class="tamanio_campos">
                <tr>
                    <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                        <?php $fecha = 'fecha_nacimiento'; ?>
                        <?php echo form_label('Fecha de Nacimiento: ', $prefijo . $fecha); ?>
                    </td>
                    <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">

                        <?php
                        if (!$fila[$prefijoF . $fecha]) {
                            $fila[$prefijoF . $fecha] = '';
//                                $fila[$prefijo.$fecha]='aaaa-mm-dd';
                        }
                        ?>
                        <input maxlength="10" type="input" class="input1_normal" style="color:#aca899;" id="fecha" name="<?php echo $prefijoF . $fecha; ?>" size="9" onFocus="if (this.value == 'aaaa-mm-dd') {
                                    this.value = '';
                                    this.style.color = '#000000';
                                }"  value="<?php echo set_value($prefijoF . $fecha, $fila[$prefijoF . $fecha]); ?>" >
                        &nbsp;&nbsp;<span class="texto3">Año-mes-dia</span> 
                        <?php
                        if (form_error($prefijoF . $fecha))
                            echo '<div class="error">' . form_error($prefijoF . $fecha) . '</div>';
                        ?>
                    </td>
                    <td align="left" width="335"> &nbsp; </td>
                </tr>
            </table>
            <table class="tamanio_campos">
                <tr>
                    <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                        <?php $nombre = 'sexo'; ?>
                        <?php echo form_label('Género: ', $prefijo . $nombre); ?>
                    </td>
                    <td align="right"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php echo $valor1; ?> /> <span class="texto3">Masculino</span></td>
                    <td align="left"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="2" <?php echo $valor2; ?> /> <span class="texto3">Femenino</span></td>                    
                    <td align="left" width="335"> &nbsp; </td>
                </tr>
            </table>
            <table class="tamanio_campos">
                <tr>
                    <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                        <?php $nombre = 'nacionalidad'; ?>
                        <?php echo form_label('Nacionalidad: ', $prefijo . $nombre); ?>
                    </td>
                    <td align="right"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php echo $valor_nac1; ?> onclick="javascript:document.getElementById('otro').style.display = ('none');" /> <span class="texto3">Boliviana</span></td>
                    <td align="left"><input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="2" <?php echo $valor_nac2; ?> onclick="javascript:document.getElementById('otro').style.display = (this.checked ? 'block' : 'none');" /> <span class="texto3">Otra</span></td>
                    <td align="left" width="335"> &nbsp; </td>
                </tr>
                <tr>
                    <td colspan="3" align="right">                              
                        <?php if (!$nacionalidad) { ?>
                            <div id="otro" style="display: none;" >
                                <span class="texto3">Escriba la Nacionalidad -></span>
                                <?php
                                echo "<input type='text' name='" . $prefijo . $nombre . "_otra' id='" . $prefijo . $nombre . "_otra'
                                    class='input1' size='18' onblur='Mayusculas(this.value,this.id)' value='" . $nacionalidad . "' />";
//                                echo form_input(array(
//                                    'name' => $prefijo . $nombre . '_otra',
//                                    'id' => $prefijo . $nombre . '_otra',
//                                    'class' => 'input1',
//                                    'size' => '18',
//                                    'onblur' => 'Mayusculas(this.value,this.id)',
//                                    'value' => $nacionalidad
//                                ));

                                if (form_error($prefijo . $nombre))
                                    echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                                ?>
                            </div>
                        <?php }else { ?>
                            <div id="otro" >
                                <span class="texto3">Escriba la Nacionalidad -></span>
                                <?php
                                echo "<input type='text' name='" . $prefijo . $nombre . "_otra' id='" . $prefijo . $nombre . "_otra'
                                    class='input1' size='18' onblur='Mayusculas(this.value,this.id)' value='" . $nacionalidad . "' />";
//                                echo form_input(array(
//                                    'name' => $prefijo . $nombre . '_otra',
//                                    'id' => $prefijo . $nombre . '_otra',
//                                    'class' => 'input1',
//                                    'size' => '18',
//                                    'onblur' => 'Mayusculas(this.value,this.id)',
//                                    'value' => $nacionalidad
//                                ));

                                if (form_error($prefijo . $nombre))
                                    echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                                ?>
                            </div>
                        <?php } ?>
                    </td>
                    <td align="left" width="335"> &nbsp; </td>
                </tr>
            </table>
            <table class="tamanio_campos">
                <tr>
                    <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>" style="width: 200px;">
                        <?php $nombre = 'pais_otro'; ?>
                        <?php echo form_label('País de Residencia: ', $prefijo . $nombre); ?>
                    </td>
                    <td align="right">
                        <select name="pai_id" style="min-width: 150px;" class="select_pais">
                            <?php
                            foreach ($paises as $key => $value) {
                                ?>
                                <option value="<?php echo $value[$this->prefijoP . 'id']; ?>" <?php echo $value[$this->prefijoP . 'id'] == $fila['pai_id'] ? 'selected' : ''; ?>><?php echo$value[$this->prefijoP . 'nombre']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td align="left" width="335"> &nbsp; </td>
                </tr>
                <tr>
                    <td colspan="3" align="left"> 
                        <?php $nombre = 'pais_ciudad'; ?>
                        <div id="pais" class="otro_pais_ciudad" <?php echo $displayPaisCiudad; ?>>
                            <span class="texto3">&nbsp;&nbsp;Escriba la ciudad -> </span>
                            <?php
                            echo "<input type='text' name='" . $prefijoF . $nombre . "' id='" . $prefijoF . $nombre . "'
                                    class='input1' size='30' onblur='Mayusculas(this.value,this.id)' value='" . $pais_otro . "' />";
//                            echo form_input(array(
//                                'name' => $prefijoF . $nombre,
//                                'id' => $prefijoF . $nombre,
//                                'class' => 'input1',
//                                'size' => '30',
//                                'onblur' => 'Mayusculas(this.value,this.id)',
//                                'value' => $pais_otro
//                            ));

                            if (form_error($prefijoF . $nombre))
                                echo '<div class="error">' . form_error($prefijoF . $nombre) . '</div>';
                            ?>
                        </div>                        
                    </td>
                    <td align="left" width="335"> &nbsp; </td>
                </tr>
            </table>
            <table class="tamanio_campos contenedor_ciudades" <?php echo $displayCiudades; ?>>
                <tr>
                    <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>" style="width: 210px;">
                        <?php $nombre = 'ciudad_otra'; ?>
                        <?php echo form_label('Ciudad o localidad: ', $prefijo . $nombre); ?>
                    </td>
                    <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                        <select name="ciu_id" style="min-width: 150px;" class="select_ciudad">
                            <option value="">Seleccione una ciudad</option>
                            <?php
                            foreach ($ciudades as $key => $value) {
                                ?>
                                <option value="<?php echo $value[$this->prefijoP . 'id']; ?>" <?php echo $value[$this->prefijoP . 'id'] == $fila['ciu_id'] ? 'selected' : ''; ?> ><?php echo$value[$this->prefijoP . 'nombre']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td align="left" width="335">
                        <?php
                        if ($errorCiudad)
                            echo '<div class="error">' . $errorCiudad . '</div>';
                        ?>                        
                    </td>

                </tr>
                <tr>
                    <td colspan="3" align="left"> 
                        <div id="ciudad" class="otra_ciudad" <?php echo $displayCiudad; ?>>
                            <span class="texto3">Escriba la Ciudad -> </span>
                            <?php
                            echo "<input type='text' name='" . $prefijoF . $nombre . "' id='" . $prefijoF . $nombre . "'
                                    class='input1' size='30' onblur='Mayusculas(this.value,this.id)' value='" . $ciudad . "' />";
//                            echo form_input(array(
//                                'name' => $prefijoF . $nombre,
//                                'id' => $prefijoF . $nombre,
//                                'class' => 'input1',
//                                'size' => '30',
//                                'onblur' => 'Mayusculas(this.value,this.id)',
//                                'value' => $ciudad
//                            ));

                            if (form_error($prefijoF . $nombre))
                                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                            ?>
                        </div>
                    </td>
                    <td align="left" width="335"> &nbsp; </td>
                </tr>
            </table>
            <table class="tamanio_campos">
                <tr>
                    <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                        <?php $nombre = 'direccion'; ?>
                        <?php echo form_label('Dirección: ', $prefijo . $nombre); ?>
                    </td>
                    <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                        <?php
                        echo "<input type='text' name='" . $prefijo . $nombre . "' id='" . $prefijo . $nombre . "'
                                    class='input1' size='40' onblur='Mayusculas(this.value,this.id)' value='" . $fila[$prefijo . $nombre] . "' />";
//                        echo form_input(array(
//                            'name' => $prefijo . $nombre,
//                            'id' => $prefijo . $nombre,
//                            'class' => 'input1',
//                            'size' => '40',
//                            'onblur' => 'Mayusculas(this.value,this.id)',
//                            'value' => set_value($prefijo . $nombre, $fila[$prefijo . $nombre])
//                        ));
                        ?>
                    </td>
                    <td align="left" width="335">
                        <?php
                        if (form_error($prefijo . $nombre))
                            echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                        ?>                        
                    </td>
                </tr>                
            </table>
            <table class="tamanio_campos">                 
                <tr>
                    <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                        <?php $nombre = 'telefono'; ?>
                        <?php echo form_label('Teléfono: ', $prefijo . $nombre); ?>
                    </td>
                    <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                        <?php
                        echo "<input type='text' name='" . $prefijo . $nombre . "' id='" . $prefijo . $nombre . "'
                                    class='input1' size='42' value='" . $fila[$prefijo . $nombre] . "' />";
//                        echo form_input(array(
//                            'name' => $prefijo . $nombre,
//                            'id' => $prefijo . $nombre,
//                            'class' => 'input1',
//                            'size' => '42',
//                            'value' => set_value($prefijo . $nombre, $fila[$prefijo . $nombre])
//                        ));
                        ?>
                    </td>
                    <td align="left" width="335">
                        <?php
                        if (form_error($prefijo . $nombre))
                            echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                        ?>                        
                    </td>
                </tr>
            </table>
            <table class="tamanio_campos">
                <tr>
                    <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                        <?php $nombre = 'celular'; ?>
                        <?php echo form_label('Celular: ', $prefijo . $nombre); ?>
                    </td>
                    <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                        <?php
                        echo "<input type='text' name='".$prefijo.$nombre."' id='".$prefijo.$nombre."'
                                    class='input1' size='43' value='".$fila[$prefijo . $nombre]."' />";
//                        echo form_input(array(
//                            'name' => $prefijo . $nombre,
//                            'id' => $prefijo . $nombre,
//                            'class' => 'input1',
//                            'size' => '43',
//                            'value' => set_value($prefijo . $nombre, $fila[$prefijo . $nombre])
//                        ));
                        ?>
                    </td>
                    <td align="left" width="335">
                        <?php
                        if (form_error($prefijo . $nombre))
                            echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                        ?>                        
                    </td>
                </tr>
                <?php if ($error_telefono) { ?>
                    <tr>
                        <td colspan="2" align="center" height="30">
                            <div class="error"><?php echo $error_telefono; ?></div>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <table class="tamanio_campos">
                <tr>
                    <td align="center" height="30">
                        <span class="text4">Nota: Debe introduccir al menos el teléfono fijo o celular.</span>
                    </td>
                    <td align="left" width="335"> &nbsp; </td>
                </tr>
            </table>
            <table class="tamanio_campos">
                <tr>
                    <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                        <?php $nombre = 'email'; ?>
                        <?php echo form_label('Correo Electrónico: ', $prefijo . $nombre); ?>
                    </td>
                    <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                        <?php
                        echo "<input type='text' name='".$prefijo.$nombre."' id='".$prefijo.$nombre."'
                                    class='input1_normal' size='30' value='".$fila[$prefijo . $nombre]."' />";
//                        echo form_input(array(
//                            'name' => $prefijo . $nombre,
//                            'id' => $prefijo . $nombre,
//                            'class' => 'input1_normal',
//                            'size' => '30',
//                            'value' => set_value($prefijo . $nombre, $fila[$prefijo . $nombre])
//                        ));
                        ?>
                    </td>
                    <td align="left" width="335">
                        <?php
                        if (form_error($prefijo . $nombre))
                            echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                        ?>                        
                    </td>
                </tr>
            </table>
            <table class="tamanio_campos">
                <tr>
                    <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                        <?php $nombre = 'traslado'; ?>
                        <?php echo form_label('Disponibilidad de trasladarse a otra ciudad ', $prefijo . $nombre); ?>
                    </td>
                    <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                        <input type="checkbox" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php echo $valor_tras; ?> onclick="javascript:document.getElementById('traslado').style.display = (this.checked ? 'block' : 'none');" /> <span class="texto3">Si</span>
                    </td>
                    <td align="left" width="335"> &nbsp; </td>
                </tr>
                <tr> 
                    <td colspan="2" align="right">                    
                        <?php if (!$fila[$prefijo . $nombre . '_lugar']) { ?>
                            <div id="traslado" style="display: none;" >
                                <span class="texto3">Escriba la Ciudad de Traslado -></span>
                                <?php
                                echo "<input type='text' name='".$prefijo.$nombre."_lugar' id='".$prefijo.$nombre."_lugar'
                                    class='input1_normal' size='10' value='".$fila[$prefijo . $nombre."_lugar"]."' />";
//                                echo form_input(array(
//                                    'name' => $prefijo . $nombre . '_lugar',
//                                    'id' => $prefijo . $nombre . '_lugar',
//                                    'class' => 'input1',
//                                    'size' => '10',
//                                    'onblur' => 'Mayusculas(this.value,this.id)',
//                                    'value' => set_value($prefijo . $nombre, $fila[$prefijo . $nombre . '_lugar'])
//                                ));

                                if (form_error($prefijo . $nombre))
                                    echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                                ?>
                            </div>
                        <?php }else { ?>
                            <div id="traslado" >
                                <span class="texto3">Escriba la Ciudad de Traslado -></span>
                                <?php
                                echo "<input type='text' name='".$prefijo.$nombre."_lugar' id='".$prefijo.$nombre."_lugar'
                                    class='input1_normal' size='10' value='".$fila[$prefijo . $nombre."_lugar"]."' />";
//                                echo form_input(array(
//                                    'name' => $prefijo . $nombre . '_lugar',
//                                    'id' => $prefijo . $nombre . '_lugar',
//                                    'class' => 'input1',
//                                    'size' => '10',
//                                    'onblur' => 'Mayusculas(this.value,this.id)',
//                                    'value' => set_value($prefijo . $nombre . '_lugar', $fila[$prefijo . $nombre . '_lugar'])
//                                ));

                                if (form_error($prefijo . $nombre))
                                    echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                                ?>
                            </div>
                        <?php } ?>
                    </td>
                    <td align="left" width="335"> &nbsp; </td>
                </tr>    
            </table>
            <table class="tamanio_campos">
                <tr>
                    <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                        <?php $nombre = 'documento'; ?>
                        <?php echo form_label('Documento: ', $prefijo . $nombre); ?><br/>                        
                    </td>
                    <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">            
                        <?php
                        echo form_input(array(
                            'name' => $prefijo . $nombre,
                            'id' => $prefijo . $nombre,
                            'class' => 'input1_normal',
                            'size' => '40',
                            'value' => $_SESSION[$this->presession . 'ci'],
                            'disabled' => 'diabled'
                        ));
                        ?>
                    </td>
                    <td align="left" width="335">
                        <?php
                        if (form_error($prefijo . $nombre))
                            echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                        ?>                        
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="2">
                        <span class="text4">Este número de documento sera su usuario para ingresar al sistema.</span>
                    </td>
                </tr>
            </table>            
            <table class="tamanio_campos">
                <tr>
                    <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                        <?php $pass = 'pass'; ?>
                        <?php echo form_label('Contraseña: ', $prefijo . $pass); ?><br/>                        
                    </td>
                    <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">

                        <?php
                        echo form_password(array(
                            'name' => $prefijo . $pass,
                            'id' => $prefijo . $pass,
                            'class' => 'input1_normal',
                            'size' => '40',
                            'value' => set_value($prefijo . $pass, $fila[$prefijo . $pass])
                        ));
                        ?>
                    </td>
                    <td align="left" width="335">
                        <?php
                        if (form_error($prefijo . $pass))
                            echo '<div class="error">' . form_error($prefijo . $pass) . '</div>';
                        ?>                        
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="2">
                        <span class="text4">La contraseña debe tener al menos 8 caracteres y por lo menos una letra y un número.</span>
                    </td>
                </tr>
            </table>
            <table class="tamanio_campos">
                <tr>
                    <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                        <?php $pass = 'pass1'; ?>
                        <?php echo form_label('Confimar Contraseña: ', $prefijo . $pass); ?><br/>
                    </td>
                    <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">

                        <?php
                        echo form_password(array(
                            'name' => $prefijo . $pass,
                            'id' => $prefijo . $pass,
                            'class' => 'input1_normal',
                            'size' => '26',
                            'value' => set_value($prefijo . $pass, $fila[$prefijo . $pass])
                        ));
                        ?>
                    </td>
                    <td align="left" width="335">
                        <?php
                        if (form_error($prefijo . $pass))
                            echo '<div class="error">' . form_error($prefijo . $pass) . '</div>';
                        ?>                        
                    </td>
                </tr>
                <?php if ($error_pass) { ?>
                    <tr>
                        <td colspan="2" align="center" height="30">
                            <div class="error"><?php echo $error_pass; ?></div>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <table class="tamanio_campos">
                <tr>
                    <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                        <?php $pass = 'salario'; ?>
                        <?php echo form_label('Pretensión Salarial Referencial (en Bs.): ', $prefijo . $pass); ?>
                    </td>
                    <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                        <?php
                        echo form_input(array(
                            'name' => $prefijoF . $pass,
                            'id' => $prefijoF . $pass,
                            'class' => 'input1',
                            'size' => '7',
                            'value' => set_value($prefijoF . $pass, $fila[$prefijoF . $pass]),
                            'onkeyup' => 'this.value=Numeros(this.value)'
                        ));
                        ?>
                    </td>
                    <td align="left" width="335">
                        <?php
                        if (form_error($prefijoF . $pass))
                            echo '<div class="error">' . form_error($prefijoF . $pass) . '</div>';
                        ?>                        
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <div class="terminos_servicio">TÉRMINOS DE SERVICIO</div>
        </td>
    </tr>
    <tr>
        <td class="texto_label" hheight="140" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <div class="cuadro_terminos">
                <?php echo $this->tool_entidad->declaracion_texto();?>
            </div>
        </td>
    </tr>
    <tr>
        <td align="right">
            <a class="enlace_terminos" href="#">LEER LOS TERMINOS DE SERVICIO COMPLETO</a>
        </td>
    </tr>
    <tr>
        <td align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <?php
            $nombre = 'acuerdo';
            if ($fila[$prefijo . $nombre] == 1) {
                $recibir = 'checked';
            }
            ?>            
            <span class="terminos_servicio_acepto">
                <input type="checkbox" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php echo $recibir; ?> /> ACEPTO
            </span>
            <?php
            if ($error_acuerdo)
                echo '<span style="color: #CD0101; font-size: 11px; font-style: italic;" class="error">' . $error_acuerdo . '</span>';
            ?>                
            <br/>
            <div class="terminos_servicio_acepto_texto">Debe marcar el recuadro de acepto que aparece a continuación,<br/>
                para aceptar tanto los Términos de servicio anteriores como la<br/>
                Política del programa y la Política de privacidad.</div>                                    
        </td>
    </tr>    
    <tr>
        <td align="right">
            <input name="enviar" src="<?php echo $this->tool_entidad->sitio() . 'files/img/maq/siguiente.gif'; ?>" type="image" value="  Guardar  ">
        </td>
    </tr>
</table>
<?php //echo form_submit('enviar', '  Guardar  ')  ?>

<?php echo form_close() ?>
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