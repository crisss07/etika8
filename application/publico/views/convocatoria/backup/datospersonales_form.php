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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 box-sesion-password">
            <?php
//            documento
            ?>
            <div class="row">
                <div class="col-md-6 text-left">
                    <label><?php
                        echo $fila[$prefijo . 'tipodoc'] = 1 ? 'Pasaporte:' : 'Ci:';
                        echo "<strong>&nbsp;&nbsp;" . $_SESSION[$this->presession . 'ci'] . "</strong>";
                        ?></label>
                </div>
                <!--                <div class="col-md-6">
                <?php
                $nombre = 'documento';
                echo form_input(array(
                    'name' => $prefijo . $nombre,
                    'id' => $prefijo . $nombre,
                    'class' => 'input1_normal input-etika',
                    'size' => '40',
                    'value' => $_SESSION[$this->presession . 'ci'],
                    'disabled' => 'diabled'
                ));
                ?>
                                </div>-->
                <div class="col-md-12">
                    <?php
                    if (form_error($prefijo . $nombre))
                        echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                    ?>
                    <span class="text4">Este n�mero de documento sera su usuario para ingresar al sistema.</span>
                </div>
            </div>
            <?php
//            contrase�a
            $pass = 'pass';
            echo form_password(array(
                'name' => $prefijo . $pass,
                'id' => $prefijo . $pass,
                'class' => 'input1_normal input-etika',
                'size' => '40',
                'value' => set_value($prefijo . $pass, $fila[$prefijo . $pass]),
                'placeholder' => 'Contrase�a'
            ));
            if (form_error($prefijo . $pass))
                echo '<div class="error">' . form_error($prefijo . $pass) . '</div>';
            ?>
            <div class="row">
                <div class="col-md-12">
                    <span class="text4">La contrase�a debe tener al menos 8 caracteres y por lo menos una letra y un n�mero.</span>
                </div>
            </div>

            <?php
//            confirmar contrase�a
            $pass = 'pass1';
            echo form_password(array(
                'name' => $prefijo . $pass,
                'id' => $prefijo . $pass,
                'class' => 'input1_normal input-etika',
                'size' => '26',
                'value' => set_value($prefijo . $pass, $fila[$prefijo . $pass]),
                'placeholder' => 'Confimar Contrase�a'
            ));
            if (form_error($prefijo . $pass))
                echo '<div class="error">' . form_error($prefijo . $pass) . '</div>';
            ?> 

            <?php if ($error_pass) { ?>
                <tr>
                    <td colspan="2" align="center" height="30">
                        <div class="error"><p><?php echo $error_pass; ?></p></div>
                    </td>
                </tr>
            <?php } ?>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <?php
//            para nombre

            $nombre = 'nombre';
            echo "<input type='text' name=" . $prefijo . $nombre . " id=" . $prefijo . $nombre . "
                           class='input1 input-etika' size='40' onblur='Mayusculas(this.value,this.id)' value='" . $fila[$prefijo . $nombre] . "' placeholder='Nombres'/>";
            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';

//             para apellido paterno
            $nombre = 'apaterno';
            echo "<input type='text' name=" . $prefijo . $nombre . " id=" . $prefijo . $nombre . "
                     class='input1 input-etika' size='32' onblur='Mayusculas(this.value,this.id)' value='" . $fila[$prefijo . $nombre] . "' placeholder='Apellido Paterno'/>";
            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';

//            apellido materno
            $nombre = 'amaterno';
            echo "<input type='text' name=" . $prefijo . $nombre . " id=" . $prefijo . $nombre . "
                                    class='input1 input-etika' size='32' onblur='Mayusculas(this.value,this.id)' value='" . $fila[$prefijo . $nombre] . "' placeholder='Apellido Materno'/>";
            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';

//            para la fecha de nacimiento
            $fecha = 'fecha_nacimiento';

            if (!$fila[$prefijoF . $fecha]) {
                $fila[$prefijoF . $fecha] = '';
            }
            ?>
            <input maxlength="10" type="input" class="input1 input-etika" style="color:#aca899;" id="fecha" name="<?php echo $prefijoF . $fecha; ?>" size="9" onFocus="if (this.value == 'aaaa-mm-dd') {
                        this.value = '';
                        this.style.color = '#000000';
                    }"  value="<?php echo set_value($prefijoF . $fecha, $fila[$prefijoF . $fecha]); ?>" placeholder="Fecha de Nacimiento"/>
            &nbsp;&nbsp;<span class="texto3">A�o-mes-dia</span> 
            <?php
            if (form_error($prefijoF . $fecha))
                echo '<div class="error">' . form_error($prefijoF . $fecha) . '</div>';
            ?>

            <?php
//            para genero
            $nombre = 'sexo';
            ?>
            <div class="row justify-content-between">
                <label for="documento">G�nero:</label>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="genero" name="<?php echo $prefijoF . $nombre; ?>" class="custom-control-input" value="1" <?php echo $valor1; ?>/>
                    <label class="custom-control-label" for="genero">Masculino</label>

                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="genero2" name="<?php echo $prefijoF . $nombre; ?>" class="custom-control-input" value="2" <?php echo $valor2; ?>/>
                    <label class="custom-control-label" for="genero2">Femenino</label>
                </div>
            </div>
            <?php
//            para nacionalidad
            $nombre = 'nacionalidad';
            ?>
            <div class="row justify-content-between">

                <label for="documento">Nacionalidad:</label>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="nacionalidad" name="<?php echo $prefijo . $nombre; ?>" class="custom-control-input" value="1" <?php echo $valor_nac1; ?> onclick="javascript:document.getElementById('otro').style.display = ('none');"/>
                    <label class="custom-control-label" for="nacionalidad">Boliviana</label>

                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="notra" name="<?php echo $prefijo . $nombre; ?>" class="custom-control-input" value="2" <?php echo $valor_nac2; ?> onclick="javascript:document.getElementById('otro').style.display = (this.checked ? 'block' : 'none');"/>
                    <label class="custom-control-label" for="notra">Otra</label>
                </div>
                <?php
                if (form_error($prefijo . $nombre))
                    echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                ?>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php if (!$nacionalidad) { ?>
                        <div id="otro" style="display: none;" >
                            <?php
                            echo "<input type='text' name='" . $prefijo . $nombre . "_otra' id='" . $prefijo . $nombre . "_otra'
                                    class='input1 input-etika' size='18' onblur='Mayusculas(this.value,this.id)' value='" . $nacionalidad . "' placeholder='Escriba la Nacionalidad'/>";
                            if (form_error($prefijo . $nombre))
                                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                            ?>
                        </div>
                    <?php }else { ?>
                        <div id="otro" >
                            <?php
                            echo "<input type='text' name='" . $prefijo . $nombre . "_otra' id='" . $prefijo . $nombre . "_otra'
                                    class='input1 input-etika' size='18' onblur='Mayusculas(this.value,this.id)' value='" . $nacionalidad . "' placeholder='Escriba la Nacionalidad'/>";

                            if (form_error($prefijo . $nombre))
                                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                            ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!--pais de residencia-->
            <select name="pai_id" class="select_pais custom-select custom-select-sm input-etika">
                <option value="0" >Pa�s de Residencia</option>
                <?php
                foreach ($paises as $key => $value) {
                    ?>
                    <option value="<?php echo $value[$this->prefijoP . 'id']; ?>" <?php echo $value[$this->prefijoP . 'id'] == $fila['pai_id'] ? 'selected' : ''; ?>><?php echo$value[$this->prefijoP . 'nombre']; ?></option>
                    <?php
                }
                ?>
            </select>

            <!--ciudades de bolivia-->
            <div class="contenedor_ciudades" <?php echo $displayCiudades; ?>>
                <select name="ciu_id" class="select_ciudad custom-select custom-select-sm input-etika">
                    <option value="">Seleccione una ciudad</option>
                    <?php
                    foreach ($ciudades as $key => $value) {
                        ?>
                        <option value="<?php echo $value[$this->prefijoP . 'id']; ?>" <?php echo $value[$this->prefijoP . 'id'] == $fila['ciu_id'] ? 'selected' : ''; ?> ><?php echo$value[$this->prefijoP . 'nombre']; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <?php
                if ($errorCiudad)
                    echo '<div class="error"><p>' . $errorCiudad . '</p></div>';
                ?>    
            </div>
            <!--otra ciudad distinto de bolivia-->
            <?php $nombre = 'pais_ciudad'; ?>
            <div class="row">
                <div id="pais" class="col-md-12 otro_pais_ciudad" <?php echo $displayPaisCiudad; ?>>
                    <?php
                    echo "<input type='text' name='" . $prefijoF . $nombre . "' id='" . $prefijoF . $nombre . "'
                                    class='input1 input-etika' size='30' onblur='Mayusculas(this.value,this.id)' value='" . $pais_otro . "' placeholder='Escriba la ciudad '/>";
                    if (form_error($prefijoF . $nombre))
                        echo '<div class="error">' . form_error($prefijoF . $nombre) . '</div>';
                    ?>
                    <?php
                    if ($errorCiudad)
                        echo '<div class="error">' . $errorCiudad . '</div>';
                    ?> 
                </div>
            </div>


            <?php
//            direccion
            $nombre = 'direccion';
            echo "<input type='text' name='" . $prefijo . $nombre . "' id='" . $prefijo . $nombre . "'
                                    class='input1 input-etika' size='40' onblur='Mayusculas(this.value,this.id)' value='" . $fila[$prefijo . $nombre] . "' placeholder='Direcci�n'/>";
            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';

//            telefono
            $nombre = 'telefono';
            echo "<input type='text' name='" . $prefijo . $nombre . "' id='" . $prefijo . $nombre . "'
                                    class='input1 input-etika' size='42' value='" . $fila[$prefijo . $nombre] . "' placeholder='Tel�fono'/>";
            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';

//            celular
            $nombre = 'celular';
            echo "<input type='text' name='" . $prefijo . $nombre . "' id='" . $prefijo . $nombre . "'
                                    class='input1 input-etika' size='43' value='" . $fila[$prefijo . $nombre] . "' placeholder='Celular'/>";
            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
            <div class="row">
                <div class="col-md-12">
                    <span class="text4">Nota: Debe introduccir al menos el tel�fono fijo o celular.</span>
                </div>
                <div class="col-md-12">
                    <?php if ($error_telefono) { ?>
                        <div class="error"><p><?php echo $error_telefono; ?></p></div>
                    <?php } ?>
                </div>
            </div>
            <?php
//            correo electronico
            $nombre = 'email';
            echo "<input type='text' name='" . $prefijo . $nombre . "' id='" . $prefijo . $nombre . "'
                                    class='input1_normal input-etika' size='30' value='" . $fila[$prefijo . $nombre] . "' placeholder='Correo Electr�nico'/>";
            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';

//             disponibilidad de traslado
            ?>
            <?php $nombre = 'traslado'; ?>
            <div class="row">
                <div class="col-md-12">
                    <label for="documento">Disponibilidad de trasladarse a otra ciudad: </label>
                    <input type="checkbox" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php echo $valor_tras; ?> onclick="javascript:document.getElementById('traslado').style.display = (this.checked ? 'block' : 'none');" /> <span class="texto3">Si</span>
                </div>
            </div>
            <!--ciudad de traslado-->
            <?php if (!$fila[$prefijo . $nombre . '_lugar']) { ?>
                <div id="traslado" style="display: none;" >
                    <?php
                    echo "<input type='text' name='" . $prefijo . $nombre . "_lugar' id='" . $prefijo . $nombre . "_lugar'
                                    class='input1_normal input-etika' size='10' value='" . $fila[$prefijo . $nombre . "_lugar"] . "' placeholder='Escriba la Ciudad de Traslado'/>";

                    if (form_error($prefijo . $nombre))
                        echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                    ?>
                </div>
            <?php }else { ?>
                <div id="traslado" >
                    <?php
                    echo "<input type='text' name='" . $prefijo . $nombre . "_lugar' id='" . $prefijo . $nombre . "_lugar'
                                    class='input1_normal input-etika' size='10' value='" . $fila[$prefijo . $nombre . "_lugar"] . "' placeholder='Escriba la Ciudad de Traslado'/>";
                    if (form_error($prefijo . $nombre))
                        echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                    ?>
                </div>
                <?php
            }



//             pretension salarial
//            $pass = 'salario';
//            echo form_input(array(
//                'name' => $prefijoF . $pass,
//                'id' => $prefijoF . $pass,
//                'class' => 'input1 input-etika',
//                'size' => '7',
//                'value' => set_value($prefijoF . $pass, $fila[$prefijoF . $pass]),
//                'onkeyup' => 'this.value=Numeros(this.value)',
//                'placeholder' => 'Pretensi�n Salarial Referencial (en Bs.)'
//            ));
//            if (form_error($prefijoF . $pass))
//                echo '<div class="error">' . form_error($prefijoF . $pass) . '</div>';

//             terminos de servicio 
            ?>
            <div class="terminos_servicio">T�RMINOS DE SERVICIO</div>
            <div class="cuadro_terminos">
                <?php echo $this->tool_entidad->declaracion_texto();?>
            </div>

            <!--cuadro acepto-->
            <br/>
            <a class="enlace_terminos" href="#">LEER LOS TERMINOS DE SERVICIO COMPLETO</a> 
            <?php
            $nombre = 'acuerdo';
            if ($fila[$prefijo . $nombre] == 1) {
                $recibir = 'checked';
            }
            ?>            
            <br/>
            <br/>
            <div class="row">
                <div class="col-md-12 text-left">
                    <span class="terminos_servicio_acepto">
                        <input type="checkbox" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php echo $recibir; ?> /> ACEPTO
                    </span>
                    <?php
                    if ($error_acuerdo)
                        echo '<p style="color: #CD0101; font-size: 11px; font-style: italic;" class="error">' . $error_acuerdo . '</p>';
                    ?>                  
                    <div class="terminos_servicio_acepto_texto">Debe marcar el recuadro de acepto que aparece a continuaci�n,<br/>
                        para aceptar tanto los T�rminos de servicio anteriores como la<br/>
                        Pol�tica del programa y la Pol�tica de privacidad.</div>  
                </div>
                <div class="col-md-12 text-right">
                    <input name="enviar" class="btn btn-etika" type="submit" value="Continuar">
                </div>
            </div>
        </div>
    </div>
</div>







<?php
echo form_hidden($prefijo . 'id', set_value($prefijo . 'id', $fila[$prefijo . 'id']));
?>
<input type="hidden" name="<?php echo $prefijo . 'id'; ?>" value="<?php echo set_value($prefijo . 'id', $fila[$prefijo . 'id']); ?>">

<?php echo form_close() ?>
</div>
<script>

    //para mostrar el datepicker
    $(function () {

        $("#fecha").datepicker({
            changeYear: true,
            changeMonth: true,
            dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            dayNames: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "S�bado"],
            monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
            dateFormat: "yy-mm-dd",
            yearRange: '-84:-18',
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