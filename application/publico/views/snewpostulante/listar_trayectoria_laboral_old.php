<SCRIPT LANGUAGE=JavaScript>
    function mensaje() {
        // alert("Debe tener al menos un campo en Trayectoria Laboral y llenar la Síntesis de Experiencia Laboral para poder pasar.");
        alert("Debe tener llenado Síntesis de Experiencia Laboral para poder pasar.");
    }
</SCRIPT>

<?php
$this->load->view('cabecera');
?>

<?php
$msj_confirmar = '¿Está seguro que desea eliminar el elemento seleccionado?';
$ruta = $this->rutarchivo . $this->carpetaup;
?>


<div id="listado">
    <?php
    $sitio = $this->tool_entidad->sitioindexpri();
    ?>        
    <form action="<?php echo $sitio . $this->controlador . 'procesar' ?>" method="post" id="form_listar_fsimple">
        <input type="hidden" name="id" value="<?php echo $id; ?>" id="id"/>
        <!--table align="left" width="815" border="0" cellspacing="0">
            <tr>
                <td align="right" width="228"><div class="titulo_cabecera_listado">SÍNTESIS DE EXPERIENCIA LABORAL <span class="flecha2">&raquo;</span></div></td>
                <td align="left" width="60"><?php echo anchor($this->controlador . 'editar_experiencia_sintesis', 'Editar', array('class' => 'enlace_editar1 enlace_a1')); ?></td>
                <td> &nbsp; </td>
            </tr>
            <tr><td> &nbsp; </td></tr>
        </table-->
        <table cellpadding="0" border="0" cellspacing="0">
            <tr>
                <td align="left">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="left"><div class="titulo_cabecera_listado">SÍNTESIS DE EXPERIENCIA LABORAL</div></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="left">
                    <table class="tabla_listado" border="1" bordercolor="#b0c4c5" cellspacing="0" cellpadding="3" width="815">        
                        <!-- ini cabeceras -->
                        <tr class="cabecera_listado">
                            <?php
                            for ($i = 0; $i < count($campos_listar_trayectoria1); $i++) {
                                if (!$this->tool_general->find_in_array(strtolower($campos_listar_trayectoria1[$i]), $hiddens)) {
                                    ?>
                                    <td><?php echo $campos_listar_trayectoria1[$i]; ?></td>
                                    <?php
                                }
                            }
                            ?>                
                        </tr>
                        <?php
                        if ($sintesis['pos_ambito_exp']) {
                            ?>
                            <?php $prefijo = 'pos_'; ?>
                            <tr>
                                <?php
                                for ($i = 0; $i < count($campos_reales_trayectoria1); $i++) {
                                    if (!$this->tool_general->find_in_array(strtolower($campos_reales_trayectoria1[$i]), $hiddens)) {

                                        if (($estado != strtolower($campos_reales_trayectoria1[$i])) && ($actual != strtolower($campos_reales_trayectoria1[$i])) && ($orden != strtolower($campos_reales_trayectoria1[$i])) && ($destacadomas != strtolower($campos_reales_trayectoria1[$i]))) {
//                                            echo $campos_reales_trayectoria1[$i] . "<br>";
//                                        print_r($this->sector_exp);
                                            if ($campos_reales_trayectoria1[$i] == "pos_area_exp") {

                                                $arrayArea = explode(',', $sintesis['pof_area_exp']);
                                                $nombresArea = array();
                                                foreach ($arrayArea as $key => $value) {
                                                    $nombresArea[] = $this->area_exp[$value];
                                                }
                                                ?>
                                                <td valign="center"><?php echo strtoupper(implode(', ', $nombresArea)); ?>&nbsp;</td>
                                                <?php
                                            } elseif ($campos_reales_trayectoria1[$i] == "pos_sector_exp") {
                                                $arraySectorExperiencia = explode(',', $sintesis['pof_sector_exp']);
                                                $nombresSector = array();
                                                foreach ($arraySectorExperiencia as $key => $value) {
                                                    $nombresSector[] = $this->sector_exp[$value];
                                                }
                                                ?>
                                                <td valign="center"><?php echo strtoupper(implode(', ', $nombresSector)); ?>&nbsp;</td>
                                                <?php
                                            } else {

//                                        print_r($this->area_exp);
                                                ?>
                                                <td valign="center"><?php echo $sintesis[strtolower($campos_reales_trayectoria1[$i])]; ?>&nbsp;</td>
                                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>                    
                            </tr>            
                        <?php } else { ?>
                            <tr>
                                <td colspan="11" align="left">
                                    <div class="enlace_nodato1"><img src="<?php echo $this->tool_entidad->sitio() . 'files/img/maq/no_data.png'; ?>" hspace="5" />No ha llenado la Síntesis de Experiencia Laboral</div>
                                </td>
                            </tr>
                        <?php } ?>                
                    </table>
                </td>
            </tr>
        </table>                 
        <div class="tabla_listado_nuevo" align="left"> &nbsp; <?php echo anchor($this->controlador . 'editar_experiencia_sintesis', 'Editar Síntesis de Experiencia Laboral', array('class' => 'enlace_nuevo1 enlace_a1')); ?>&nbsp;&nbsp;</div>
        <table cellpadding="0" border="0" cellspacing="0">
            <tr>
                <td align="left">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="left"><div class="titulo_cabecera_listado">EXPERIENCIA LABORAL</div></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="left">
                    <table class="tabla_listado" border="1" bordercolor="#b0c4c5" cellspacing="0" cellpadding="3" width="815">        
                        <!-- ini cabeceras -->
                        <tr class="cabecera_listado">
                            <?php
                            for ($i = 0; $i < count($campos_listar_trayectoria); $i++) {
                                if (!$this->tool_general->find_in_array(strtolower($campos_listar_trayectoria[$i]), $hiddens)) {
                                    ?>
                                    <td><?php echo $campos_listar_trayectoria[$i]; ?></td>
                                    <?php
                                }
                            }
                            ?>
                            <td>Editar</td>
                            <td>Eliminar</td>
                        </tr>
                        <!-- fin cabeceras -->
                        <?php if ($trayectorias) { ?>
                            <?php
                            $prefijo = $this->prefijo3;
                            foreach ($trayectorias as $fila) {
                                ?>
                                <tr>
                                    <?php
                                    for ($i = 0; $i < count($campos_reales_trayectoria); $i++) {
                                        if (!$this->tool_general->find_in_array(strtolower($campos_reales_trayectoria[$i]), $hiddens)) {
                                            if (strtolower($campos_reales_trayectoria[$i]) == 'edu_grado') {
                                                ?>
                                                <td valign="center"><?php echo $this->grados[$fila[strtolower($campos_reales_trayectoria[$i])]]; ?></td>
                                                <?php
                                            } else {
                                                if (($estado != strtolower($campos_reales_trayectoria[$i])) && ($actual != strtolower($campos_reales_trayectoria[$i])) && ($orden != strtolower($campos_reales_trayectoria[$i])) && ($destacadomas != strtolower($campos_reales_trayectoria[$i]))) {
                                                    ?>
                                                    <td valign="center"><?php echo strip_tags($fila[strtolower($campos_reales_trayectoria[$i])]); ?>&nbsp;</td>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                    <td align="center"><?php echo anchor($this->controlador . 'editar_trayectoria/id/' . $fila[$prefijo . 'id'], 'Editar', array('class' => 'enlace_editar1 enlace_a1')); ?></td>
                                    <td align="center"><?php echo anchor($this->controlador . 'eliminar_trayectoria/id/' . $fila[$prefijo . 'id'], 'Eliminar', array('class' => 'enlace_eliminar1 enlace_a1', 'onclick' => "return confirmar('$msj_confirmar')")); ?></td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="11" align="left">
                                    <div class="enlace_nodato1"><img src="<?php echo $this->tool_entidad->sitio() . 'files/img/maq/no_data.png'; ?>" hspace="5" />No tiene ninguna Experiencia Laboral</div>
                                </td>
                            </tr>
                        <?php } ?>                
                    </table>
                </td>
            </tr>
        </table>                   
        <div class="tabla_listado_nuevo" align="left"> &nbsp; <?php echo anchor($this->controlador . 'trayectoria_nuevo', 'Agregar Nueva Experiencia Laboral', array('class' => 'enlace_nuevo1 enlace_a1')); ?>&nbsp;&nbsp;</div>
    </form>    
    <table  align="center" cellspacing="35" width="815">
        <tr>
            <td align="left" valign="top">
                <?php echo anchor('postulante/instruccion_formal', '<img border="0" src="' . $this->tool_entidad->sitio() . 'files/img/maq/anterior.gif"/>'); ?>
            </td>
            <td align="right" valign="top">
                <?php
                // if ($trayectorias && $sintesis['pos_ambito_exp']) {
                if ($sintesis['pos_ambito_exp']) {
                    echo anchor('postulante/informacion_adicional', '<img border="0" src="' . $this->tool_entidad->sitio() . 'files/img/maq/siguiente.gif"/>');
                } else {
                    ?>
                    <a href="#" title="Siguiente" onclick="mensaje()"><img border="0" src="<?php echo $this->tool_entidad->sitio() . 'files/img/maq/siguiente.gif'; ?>"/></a>
                <?php } ?>                
            </td>
        </tr>
    </table>    
</div>


