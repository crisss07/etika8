<script language="javascript" type="text/javascript">
    window.addEventListener('load', function() {
    console.log('All assets are loaded');
    
})
    
//    window.onload = function () {
window.addEventListener('load', function() {
        console.log('All ssss');
        if (document.getElementById('datospersonalesall')) {
            document.getElementById('datospersonalesall').onclick = function () {
                toggleChecks(this, 'datospersonales', 19);
//                toggleChecks(this, 'datospersonales', 17);
            };
        }
        if (document.getElementById('instruccionformalall')) {
            document.getElementById('instruccionformalall').onclick = function () {
                toggleChecks(this, 'educacionpostgrado', 9);
                toggleChecks(this, 'educacionsuperior', 9);
                toggleChecks(this, 'educacionsecundaria', 4);
                toggleChecks(this, 'educacionsecundaria', 4);
                toggleChecks(this, 'publicacion', 2);
            };
        }
        if (document.getElementById('educacionpostgradoall')) {
            document.getElementById('educacionpostgradoall').onclick = function () {
                toggleChecks(this, 'educacionpostgrado', 9);
            };
        }
        if (document.getElementById('educacionsuperiorall')) {
            document.getElementById('educacionsuperiorall').onclick = function () {
                toggleChecks(this, 'educacionsuperior', 9);
            };
        }
        if (document.getElementById('educacionsecundariaall')) {
            document.getElementById('educacionsecundariaall').onclick = function () {
                toggleChecks(this, 'educacionsecundaria', 4);
            };
        }
        if (document.getElementById('publicacionall')) {
            document.getElementById('publicacionall').onclick = function () {
                toggleChecks(this, 'publicacion', 2);
            };
        }
        if (document.getElementById('trayectorialaboralall')) {
            document.getElementById('trayectorialaboralall').onclick = function () {
                toggleChecks(this, 'trayectorialaboral', 17);
                toggleChecks(this, 'sintesis', 4);
            };
        }
        if (document.getElementById('sintesisall')) {
            document.getElementById('sintesisall').onclick = function () {
                toggleChecks(this, 'sintesis', 4);
            };
        }
        if (document.getElementById('trayectorialaboralexperienciaall')) {
            document.getElementById('trayectorialaboralexperienciaall').onclick = function () {
               toggleChecks(this, 'trayectorialaboral', 17);
            };
        }
        if (document.getElementById('informacionadicionalall')) {
            document.getElementById('informacionadicionalall').onclick = function () {
                toggleChecks(this, 'informacionadicional', 4);
            };
        }
        if (document.getElementById('informacionadicionalInglesall')) {
            document.getElementById('informacionadicionalInglesall').onclick = function () {
                toggleChecks(this, 'informacionadicionalIngles', 4);
            };
        }
        if (document.getElementById('otrosall')) {
            document.getElementById('otrosall').onclick = function () {
                toggleChecks(this, 'otros', 3);
            };
        }

    });
    //
    function toggleChecks(onoff, nombre, nro) {
        var sw = (onoff.checked == true) ? true : false;
        for (j = 1; j <= nro; j++) {
            if (document.getElementById(nombre + j) != null)
            {
                var obj = document.getElementById(nombre + j);
                obj.checked = sw;
            }
        }
    }
</script>


<?php
$this->load->view('cabecera');
$this->load->view($this->carpeta . 'etapas', $id);
?>
<div align="left"><?php echo anchor($this->controlador, 'Atras', array('class' => 'enlace_retornar enlace_a1')); ?> &nbsp; <?php echo anchor($this->controlador . 'etapas/id/' . $id, 'Cancelar', array('class' => 'enlace_cancelar enlace_a1')); ?></div>
<?php
$alineacionwc1 = 'left';
$alineacionhc1 = 'middle';
$alineacionwc2 = 'left';
$alineacionhc2 = 'middle';
$prefijo = $this->prefijo;
?>

<div id="cuerpo_form_admin">
    <span class="texto2">Marque los cuadros de los campos que se van a mostrar.</span>
    <?php echo form_open_multipart($action); ?>  
    <input type="hidden" name="<?php echo $prefijo . 'id'; ?>" value="<?php echo set_value($prefijo . 'id', $fila[$prefijo . 'id']); ?>">
    <table id="form_admin">
        <tr>
            <th align="left"><?php $nombre = 'datospersonales'; ?><input type="checkbox" id="<?php echo $nombre . 'all'; ?>" name="<?php echo $nombre . 'all'; ?>" value="all" /> &nbsp; <b>Datos Personales (Todos)</b></th>
            <th align="left"><?php $nombre = 'instruccionformal'; ?><input type="checkbox" id="<?php echo $nombre . 'all'; ?>" name="<?php echo $nombre . 'all'; ?>" value="all" /> &nbsp; <b>Instrucción Formal (Todos)</b></th>
            <th align="left"><?php $nombre = 'trayectorialaboral'; ?><input type="checkbox" id="<?php echo $nombre . 'all'; ?>" name="<?php echo $nombre . 'all'; ?>" value="all" /> &nbsp; <b>Trayectoria Laboral (Todos)</b></th>
            <th align="left"><?php $nombre = 'informacionadicionalIngles'; ?><input type="checkbox" id="<?php echo $nombre . 'all'; ?>" name="<?php echo $nombre . 'all'; ?>" value="all" /> &nbsp; <b>Idioma Ingles (Todos)</b></th>        
<!--            <th align="left"><?php $nombre = 'informacionadicional'; ?><input type="checkbox" id="<?php echo $nombre . 'all'; ?>" name="<?php echo $nombre . 'all'; ?>" value="all" /> &nbsp; <b>Información Adicional (Todos)</b></th>        -->
        </tr>
        <tr>
            <td valign="top" align="left" ><?php $nombre = 'datospersonales'; ?>
                <input type="checkbox" id="<?php echo $nombre . '1'; ?>" name="<?php echo $nombre . '1'; ?>" value="1" checked /> &nbsp;  Apellido Paterno <br/>
                <input type="checkbox" id="<?php echo $nombre . '2'; ?>" name="<?php echo $nombre . '2'; ?>" value="1" checked /> &nbsp; Apellido Materno <br/>
                <input type="checkbox" id="<?php echo $nombre . '3'; ?>" name="<?php echo $nombre . '3'; ?>" value="1" checked/> &nbsp; Nombres  <br/>
                <input type="checkbox" id="<?php echo $nombre . '4'; ?>" name="<?php echo $nombre . '4'; ?>" value="1" checked /> &nbsp; Documento <br/>
                <input type="checkbox" id="<?php echo $nombre . '5'; ?>" name="<?php echo $nombre . '5'; ?>" value="1" checked /> &nbsp; Tipo Documento <br/>
                <input type="checkbox" id="<?php echo $nombre . '6'; ?>" name="<?php echo $nombre . '6'; ?>" value="1" checked/> &nbsp; Fecha Nacimiento(edad) <br/>

<!--                <input type="checkbox" id="<?php echo $nombre . '7'; ?>" name="<?php echo $nombre . '7'; ?>" value="1" /> &nbsp; Sexo <br/>
                <input type="checkbox" id="<?php echo $nombre . '8'; ?>" name="<?php echo $nombre . '8'; ?>" value="1" /> &nbsp; Nacionalidad <br/>-->
                <input type="checkbox" id="<?php echo $nombre . '9'; ?>" name="<?php echo $nombre . '9'; ?>" value="1" /> &nbsp; País de Residencia <br/>
                <input type="checkbox" id="<?php echo $nombre . '10'; ?>" name="<?php echo $nombre . '10'; ?>" value="1" /> &nbsp; Ciudad o Localidad <br/>
                <!--<input type="checkbox" id="<?php echo $nombre . '11'; ?>" name="<?php echo $nombre . '11'; ?>" value="1" /> &nbsp; Dirección <br/>-->
                
                <input type="checkbox" id="<?php echo $nombre . '12'; ?>" name="<?php echo $nombre . '12'; ?>" value="1" checked/> &nbsp; Teléfono <br/>
                <input type="checkbox" id="<?php echo $nombre . '13'; ?>" name="<?php echo $nombre . '13'; ?>" value="1" checked/> &nbsp; Celular <br/>
                <input type="checkbox" id="<?php echo $nombre . '14'; ?>" name="<?php echo $nombre . '14'; ?>" value="1" /> &nbsp; Correo Electrónico <br/>
                <input type="checkbox" id="<?php echo $nombre . '15'; ?>" name="<?php echo $nombre . '15'; ?>" value="1" /> &nbsp; ¿Tiene disponibilidad de trasladarse a otra ciudad? <br/>
                <input type="checkbox" id="<?php echo $nombre . '16'; ?>" name="<?php echo $nombre . '16'; ?>" value="1" checked /> &nbsp; Pretensión Salarial Referencial <br/>
                <!--<input type="checkbox" id="<?php echo $nombre . '17'; ?>" name="<?php echo $nombre . '17'; ?>" value="1" /> &nbsp; Comentario Adicional <br/>-->
                <!--adicionado-->
                <input type="checkbox" id="<?php echo $nombre . '18'; ?>" name="<?php echo $nombre . '18'; ?>" value="1" checked/> &nbsp; Observación <br/>
                <input type="checkbox" id="<?php echo $nombre . '19'; ?>" name="<?php echo $nombre . '19'; ?>" value="1" checked/> &nbsp; Recomendaciones <br/>

            </td>
            <td valign="top" align="left" >
                <?php $nombre = 'educacionpostgrado'; ?><input type="checkbox" id="<?php echo $nombre . 'all'; ?>" name="<?php echo $nombre . 'all'; ?>" value="all" /> &nbsp; <b>Educación Postgrado (Todos)</b><br/>
<!--                <input type="checkbox" id="<?php echo $nombre . '1'; ?>" name="<?php echo $nombre . '1'; ?>" value="1" /> &nbsp; Desde <br/>
                <input type="checkbox" id="<?php echo $nombre . '2'; ?>" name="<?php echo $nombre . '2'; ?>" value="1" /> &nbsp; Hasta <br/>
                <input type="checkbox" id="<?php echo $nombre . '3'; ?>" name="<?php echo $nombre . '3'; ?>" value="1" /> &nbsp; Institución <br/>
                <input type="checkbox" id="<?php echo $nombre . '4'; ?>" name="<?php echo $nombre . '4'; ?>" value="1" /> &nbsp; País <br/>-->
                <input type="checkbox" id="<?php echo $nombre . '5'; ?>" name="<?php echo $nombre . '5'; ?>" value="1" checked/> &nbsp; Grado o Titulo <br/>
                <input type="checkbox" id="<?php echo $nombre . '6'; ?>" name="<?php echo $nombre . '6'; ?>" value="1" checked/> &nbsp; Área Postgrado <br/>
<!--                <input type="checkbox" id="<?php echo $nombre . '7'; ?>" name="<?php echo $nombre . '7'; ?>" value="1" /> &nbsp; Tema Tesis <br/>
                <input type="checkbox" id="<?php echo $nombre . '8'; ?>" name="<?php echo $nombre . '8'; ?>" value="1" /> &nbsp; Nota Tesis <br/>-->
                <!--<input type="checkbox" id="<?php echo $nombre . '9'; ?>" name="<?php echo $nombre . '9'; ?>" value="1" /> &nbsp; Titulado <br/>-->
                <br/><br/>
                <?php $nombre = 'educacionsuperior'; ?><input type="checkbox" id="<?php echo $nombre . 'all'; ?>" name="<?php echo $nombre . 'all'; ?>" value="all" /> &nbsp; <b>Educación Superior (Todos)</b><br/>
<!--                <input type="checkbox" id="<?php echo $nombre . '1'; ?>" name="<?php echo $nombre . '1'; ?>" value="1" /> &nbsp; Desde <br/>
                <input type="checkbox" id="<?php echo $nombre . '2'; ?>" name="<?php echo $nombre . '2'; ?>" value="1" /> &nbsp; Hasta <br/>
                <input type="checkbox" id="<?php echo $nombre . '3'; ?>" name="<?php echo $nombre . '3'; ?>" value="1" /> &nbsp; Institución <br/>
                <input type="checkbox" id="<?php echo $nombre . '4'; ?>" name="<?php echo $nombre . '4'; ?>" value="1" /> &nbsp; País <br/>-->
                <input type="checkbox" id="<?php echo $nombre . '5'; ?>" name="<?php echo $nombre . '5'; ?>" value="1" checked/> &nbsp; Grado o Titulo <br/>
                <input type="checkbox" id="<?php echo $nombre . '6'; ?>" name="<?php echo $nombre . '6'; ?>" value="1" checked /> &nbsp; Área de Profesión <br/>
<!--                <input type="checkbox" id="<?php echo $nombre . '7'; ?>" name="<?php echo $nombre . '7'; ?>" value="1" /> &nbsp; Tema Tesis <br/>
                <input type="checkbox" id="<?php echo $nombre . '8'; ?>" name="<?php echo $nombre . '8'; ?>" value="1" /> &nbsp; Nota Tesis <br/>
                <input type="checkbox" id="<?php echo $nombre . '9'; ?>" name="<?php echo $nombre . '9'; ?>" value="1" /> &nbsp; Titulado <br/>-->
                <!--<?php // $nombre = 'educacionsecundaria';  ?><input type="checkbox" id="<?php echo $nombre . 'all'; ?>" name="<?php echo $nombre . 'all'; ?>" value="all" /> &nbsp; <b>Educación Secundaria (Todos)</b><br/>-->
<!--                <input type="checkbox" id="<?php echo $nombre . '1'; ?>" name="<?php echo $nombre . '1'; ?>" value="1" /> &nbsp; Desde <br/>
                <input type="checkbox" id="<?php echo $nombre . '2'; ?>" name="<?php echo $nombre . '2'; ?>" value="1" /> &nbsp; Hasta <br/>
                <input type="checkbox" id="<?php echo $nombre . '3'; ?>" name="<?php echo $nombre . '3'; ?>" value="1" /> &nbsp; Institución <br/>
                <input type="checkbox" id="<?php echo $nombre . '4'; ?>" name="<?php echo $nombre . '4'; ?>" value="1" /> &nbsp; País <br/>-->
                <!--<?php // $nombre = 'publicacion';  ?><input type="checkbox" id="<?php echo $nombre . 'all'; ?>" name="<?php echo $nombre . 'all'; ?>" value="all" /> &nbsp; <b>Publicaciones (Todos)</b><br/>-->
<!--                <input type="checkbox" id="<?php echo $nombre . '1'; ?>" name="<?php echo $nombre . '1'; ?>" value="1" /> &nbsp; Titulo <br/>
                <input type="checkbox" id="<?php echo $nombre . '2'; ?>" name="<?php echo $nombre . '2'; ?>" value="1" /> &nbsp; Año <br/>-->
            </td>
            <td valign="top" align="left">
                <?php $nombre = 'sintesis'; ?><input type="checkbox" id="<?php echo $nombre . 'all'; ?>" name="<?php echo $nombre . 'all'; ?>" value="all" /> &nbsp; <b>Síntesis de Exp. Laboral (Todos)</b><br/>
                <input type="checkbox" id="<?php echo $nombre . '1'; ?>" name="<?php echo $nombre . '1'; ?>" value="1" /> &nbsp; Ambito en el que clasifica su Exp. Laboral <br/>
                <input type="checkbox" id="<?php echo $nombre . '2'; ?>" name="<?php echo $nombre . '2'; ?>" value="1" /> &nbsp; Área de exp. que usted resaltaría <br/>
                <input type="checkbox" id="<?php echo $nombre . '3'; ?>" name="<?php echo $nombre . '3'; ?>" value="1" checked/> &nbsp; Sector de exp. que usted resaltaría <br/>
                <input type="checkbox" id="<?php echo $nombre . '4'; ?>" name="<?php echo $nombre . '4'; ?>" value="1" /> &nbsp; Experiencia en Supervisión <br/><br/>
                
                <?php $nombre = 'trayectorialaboral'; ?><input type="checkbox" id="<?php echo $nombre . 'experienciaall'; ?>" name="<?php echo $nombre . 'all'; ?>" value="all" /> &nbsp; <b>Experiencia Laboral (Todos)</b><br/>
                <input type="checkbox" id="<?php echo $nombre . '1'; ?>" name="<?php echo $nombre . '1'; ?>" value="1" /> &nbsp; Desde <br/>
                <input type="checkbox" id="<?php echo $nombre . '2'; ?>" name="<?php echo $nombre . '2'; ?>" value="1" /> &nbsp; Hasta <br/>
                <input type="checkbox" id="<?php echo $nombre . '3'; ?>" name="<?php echo $nombre . '3'; ?>" value="1" /> &nbsp; Tiempo que Trabajó(Años y Meses) <br/>
                <input type="checkbox" id="<?php echo $nombre . '4'; ?>" name="<?php echo $nombre . '4'; ?>" value="1" /> &nbsp; Nombre Organización <br/>
                <input type="checkbox" id="<?php echo $nombre . '5'; ?>" name="<?php echo $nombre . '5'; ?>" value="1" /> &nbsp; Tipo Organización <br/>
                <input type="checkbox" id="<?php echo $nombre . '6'; ?>" name="<?php echo $nombre . '6'; ?>" value="1" /> &nbsp; Actividad Principal Organización <br/>
                <input type="checkbox" id="<?php echo $nombre . '7'; ?>" name="<?php echo $nombre . '7'; ?>" value="1" /> &nbsp; Cargo(s) Ocupado(s) <br/>
                <input type="checkbox" id="<?php echo $nombre . '8'; ?>" name="<?php echo $nombre . '8'; ?>" value="1" /> &nbsp; 3 Principales Funciones Desempeñadas dentro del Cargo <br/>
                <input type="checkbox" id="<?php echo $nombre . '9'; ?>" name="<?php echo $nombre . '9'; ?>" value="1" /> &nbsp; Principales Logros <br/>
                <input type="checkbox" id="<?php echo $nombre . '10'; ?>" name="<?php echo $nombre . '10'; ?>" value="1" /> &nbsp; País - Ciudad <br/>
                <input type="checkbox" id="<?php echo $nombre . '11'; ?>" name="<?php echo $nombre . '11'; ?>" value="1" /> &nbsp; Nº de Subordinados <br/>
                <input type="checkbox" id="<?php echo $nombre . '12'; ?>" name="<?php echo $nombre . '12'; ?>" value="1" /> &nbsp; Total Ganado Mensual <br/>
                <input type="checkbox" id="<?php echo $nombre . '13'; ?>" name="<?php echo $nombre . '13'; ?>" value="1" /> &nbsp; Teléfono de la Organización <br/>
                <input type="checkbox" id="<?php echo $nombre . '14'; ?>" name="<?php echo $nombre . '14'; ?>" value="1" /> &nbsp; Nombre del Inmediato Superior <br/>
                <input type="checkbox" id="<?php echo $nombre . '15'; ?>" name="<?php echo $nombre . '15'; ?>" value="1" /> &nbsp; Teléfono del Inmediato Superior <br/>
                <input type="checkbox" id="<?php echo $nombre . '16'; ?>" name="<?php echo $nombre . '16'; ?>" value="1" /> &nbsp; Correo Electrónico del Inmediato Superior <br/>
                <input type="checkbox" id="<?php echo $nombre . '17'; ?>" name="<?php echo $nombre . '17'; ?>" value="1" /> &nbsp; Actualmente Trabajando en<br/> esta Organización <br/>            
                
            </td>
            <td valign="top" align="left">
                <?php $nombre = 'informacionadicionalIngles'; ?>
                <!--<input type="checkbox" id="<?php echo $nombre . '1'; ?>" name="<?php echo $nombre . '1'; ?>" value="1" /> &nbsp; Idioma <br/>-->
                <input type="checkbox" id="<?php echo $nombre . '2'; ?>" name="<?php echo $nombre . '2'; ?>" value="1" /> &nbsp; Habla <br/>
                <input type="checkbox" id="<?php echo $nombre . '3'; ?>" name="<?php echo $nombre . '3'; ?>" value="1" /> &nbsp; Lee <br/>
                <input type="checkbox" id="<?php echo $nombre . '4'; ?>" name="<?php echo $nombre . '4'; ?>" value="1" /> &nbsp; Escribe <br/><br/>
                <!--//<?php $nombre = 'informacionadicional'; ?><input type="checkbox" id="<?php echo $nombre . 'all'; ?>" name="<?php echo $nombre . 'all'; ?>" value="all" /> &nbsp; <b>Otros Idiomas (Todos)</b><br/>-->
<!--                <input type="checkbox" id="<?php echo $nombre . '1'; ?>" name="<?php echo $nombre . '1'; ?>" value="1" /> &nbsp; Idioma <br/>
                <input type="checkbox" id="<?php echo $nombre . '2'; ?>" name="<?php echo $nombre . '2'; ?>" value="1" /> &nbsp; Habla <br/>
                <input type="checkbox" id="<?php echo $nombre . '3'; ?>" name="<?php echo $nombre . '3'; ?>" value="1" /> &nbsp; Lee <br/>
                <input type="checkbox" id="<?php echo $nombre . '4'; ?>" name="<?php echo $nombre . '4'; ?>" value="1" /> &nbsp; Escribe <br/><br/>-->
                <!--//<?php $nombre = 'otros'; ?><input type="checkbox" id="<?php echo $nombre . 'all'; ?>" name="<?php echo $nombre . 'all'; ?>" value="all" /> &nbsp; <b>Otros (Todos)</b><br/>-->
                <input type="checkbox" id="<?php echo $nombre . '1'; ?>" name="<?php echo $nombre . '1'; ?>" value="1" checked/> &nbsp;  <b>Participación anteriores procesos </b> <br/>
                <small>(Campos Cliente, Cargo e Instancia)</small>
    <!--            <input type="checkbox" id="<?php echo $nombre . '2'; ?>" name="<?php echo $nombre . '2'; ?>" value="1" checked/> &nbsp; Observación <br/>
                <input type="checkbox" id="<?php echo $nombre . '3'; ?>" name="<?php echo $nombre . '3'; ?>" value="1" checked/> &nbsp; Recomendaciones <br/>-->
            </td>
        </tr>    
    </table>


    <br/>
    <?php 
	$botonG = array(
      'class' => 'btn btn-etika');
	echo form_submit('enviar', '  Generar  ', $botonG);
	?>

    <?php echo form_close() ?>
</div>
<br>
<br>