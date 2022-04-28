<SCRIPT LANGUAGE=JavaScript>
    function mensaje() {
        alert("Su Curriculum Vitae debe estar completo para poder postularse.");
    }
    function mensaje1() {
        alert("Su Estado debe estar Activo para poder postularse.");
    }
</SCRIPT>
<?php
$prefijo = 'con_';
$prefijoCv = 'pos_';
$ruta = $this->ruta . $this->carpeta;
$rutabaseimg = $this->rutabaseimg . $this->carpeta;
$sitiop = $this->tool_entidad->sitiopri();
if ($informacion || $trayectoria || $instruccion) {
    $incompleto = 1;
}
if (!$estado['estado']) {
    $noestado = 1;
}
?>
<div id="contenido">
    <!--div align="left"><?php $this->load->view('acceso', $data); ?><br></div-->
    <div class="cuadro_intro">           
        <h1 style="text-align: center;"><?php echo strtoupper($fila[$prefijo . 'cargo']); ?></h1>
        <div align="left" >Fecha Tope: <font style=" color: #2F627B; font-weight: bold; font-size: 12px;"><?php echo $fila[$prefijo . 'tope']; ?></font></div>
        <?php if ($fila[$prefijo . 'sede']) { ?>
            <div align="left" >Sede: <font style=" color: #2F627B; font-weight: bold; font-size: 12px;"><?php echo $fila[$prefijo . 'sede']; ?></font></div>
        <?php } ?>
        <div align="justify"><?php echo $fila[$prefijo . 'descripcion']; ?></div><br/>
        <div style="height: 50px;"></div>
        <div align="center">
            <?php if ($incompleto) { ?>
                <a href="#" class="boton_cancelar" onclick="mensaje()" ><img border="0" src="<?php echo $this->tool_entidad->sitio() . 'files/img/maq/guardar.gif'; ?>" /> POSTULARSE</a>
            <?php } elseif ($noestado) { ?>
                <a href="#" class="boton_cancelar" onclick="mensaje1()" ><img border="0" src="<?php echo $this->tool_entidad->sitio() . 'files/img/maq/guardar.gif'; ?>" /> POSTULARSE</a>
                <?php } else { ?>
                    <?php echo anchor('postulacion/agregar/idp/' . $fila[$prefijo . 'id'], '<img border="0" src="' . $this->tool_entidad->sitio() . 'files/img/maq/guardar.gif" /> POSTULARSE', array('class' => 'boton_cancelar')); ?>
                <?php } ?>
            &nbsp; &nbsp;<?php echo anchor($this->controlador . 'inicio', '<img border="0" src="' . $this->tool_entidad->sitio() . 'files/img/maq/cancelar.gif" /> CANCELAR', array('class' => 'boton_cancelar')); ?>
        </div>
    </div>
</div>

