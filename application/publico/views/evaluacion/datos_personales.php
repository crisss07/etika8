<div class="row">
    <div class="col-md-12" align="right">
      <a href="<?php echo $this->tool_entidad->sitio();?>index.php/ninicio">Volver a Inicio</a>
    </div>
</div>
<?php
$this->load->view('cabecera');
?>
<br>
<?php echo form_open_multipart($action); ?>
<input type="hidden" name="<?php echo $prefijo . 'id'; ?>" value="<?php echo set_value($prefijo . 'id', @$fila[$prefijo . 'id']); ?>">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">Nombre</label>
            <?php
//            para nombre

            $nombre = 'nombre';
            echo "<input type='text' name=" . $prefijo . $nombre . " id=" . $prefijo . $nombre . "
                           class='input1 input-etika' size='40' onblur='Mayusculas(this.value,this.id)' value='" . @$fila[$prefijo . $nombre] . "' placeholder='Nombres' required />";
            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">Ap. Paterno</label>
            <?php

//             para apellido paterno
            $nombre = 'apaterno';
            echo "<input type='text' name=" . $prefijo . $nombre . " id=" . $prefijo . $nombre . "
                     class='input1 input-etika' size='32' onblur='Mayusculas(this.value,this.id)' value='" . @$fila[$prefijo . $nombre] . "' placeholder='Apellido Paterno' required/>";
            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
            <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">Ap. Materno</label>
            <?php

//            apellido materno
            $nombre = 'amaterno';
            echo "<input type='text' name=" . $prefijo . $nombre . " id=" . $prefijo . $nombre . "
                                    class='input1 input-etika' size='32' onblur='Mayusculas(this.value,this.id)' value='" . @$fila[$prefijo . $nombre] . "' placeholder='Apellido Materno' required/>";
            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
            <?php

//            para la fecha de nacimiento
            $fecha = 'fecha_nacimiento';

            if (!@$fila[$prefijoF . $fecha]) {
                @$fila[$prefijoF . $fecha] = '';
            }
            ?>

            <div class="row" style="margin-bottom: -15px; ">
                <div class="col-md-12" align="left">
                    <div class="form-group">
                        <label style="float: left; margin-bottom: -10; padding: 0; font-size: 9px;">Fecha de Nacimiento (Año-mes-dia)</label>

                        <input maxlength="10" type="input" class="input1 input-etika"  id="fecha" name="<?php echo $prefijoF . $fecha; ?>" size="9" onFocus="if (this.value == 'aaaa-mm-dd') {
                            this.value = '';
                            this.style.color = '#000000';
                        }"  value="<?php echo set_value($prefijoF . $fecha, @$fila[$prefijoF . $fecha]); ?>" placeholder="Fecha de Nacimiento" required />
                        <!-- <small class="texto3"> Año-mes-dia </small> -->
                    </div>
                    </div>

                </div>
                <!-- fin de nueva fecha -->
            <?php
            if (form_error($prefijoF . $fecha))
                echo '<div class="error">' . form_error($prefijoF . $fecha) . '</div>';
            ?>
			
            <!--Lugar de estudios-->
            <label style="float: left; margin-bottom: -15px; padding: 0; font-size: 9px;">
			¿En qué lugar estudió principalmente la secundaria? *
			</label>
			<?php
			$campo = 'lugar_estudios';
            ?>
            <select name="<?php echo $prefijoF.$campo; ?>" class="select_pais custom-select custom-select-sm input-etika" required >
                <option value="" >Seleccionar</option>
                <?php
                foreach ($lugares as $key => $value) {
                    ?>
                    <option value="<?php echo $value; ?>" <?php echo @$fila[$prefijoF.$campo] == $value ? 'selected' : ''; ?>><?php echo $value; ?></option>
                    <?php
                }
                ?>
            </select>
			<?php
            if (form_error($prefijoF . $campo))
                echo '<div class="error">' . form_error($prefijoF . $campo) . '</div>';
            ?>
			<!--Profesion-->
            <label style="float: left; margin-bottom: -15px; padding: 0; font-size: 9px;">
			Profesión
			</label>
            <select name="profesion" class="select_pais custom-select custom-select-sm input-etika">
                <option value="" >Seleccione la profesión en la que más se ha desempeñado</option>
                <?php
                foreach ($profesion as $key => $value) {
                    ?>
                    <option value="<?php if($value['com_id']!=0){echo $value['com_id'];}else{ echo '';} ?>" <?php echo @$value['edu_profesion_ejercida'] == 1 ? 'selected' : ''; ?>><?php echo $value['com_nombre']; ?></option>
                    <?php
                }
                ?>
            </select>
			
			<input name="profesionNuevo" type="hidden" value="<?php echo $profesionNuevo; ?>" readonly />
			<!--
			<a class="btn btn-etika" style="background-color:#EC673B;" href="<?php echo $this->tool_entidad->sitio();?>index.php/ninicio">volver a la página principal</a>
			-->
			<input name="enviar"  class="btn btn-etika" type="submit" value="Guardar"/>
			
        </div>
    </div>
</div>

<?php echo form_close() ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->tool_entidad->sitio(); ?>files/datepicker/jquery-ui.css" />
<script src="<?php echo $this->tool_entidad->sitio(); ?>files/datepicker/external/jquery/jquery.js"></script>
<script src="<?php echo $this->tool_entidad->sitio(); ?>files/datepicker/jquery-ui.js"></script>
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