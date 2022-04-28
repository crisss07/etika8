<SCRIPT LANGUAGE=JavaScript>
    function mensaje() {
        alert("Debe tener al menos un campo llenado en Educación Secundaria para poder pasar.");
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
        <table cellpadding="0" border="0" cellspacing="0">
            <tr>
                <td align="left">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="left"><div class="titulo_cabecera_listado">EDUCACIÓN POST GRADO</div></td>
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
                            for ($i = 0; $i < count($campos_listar_postgrado); $i++) {
                                if (!$this->tool_general->find_in_array(strtolower($campos_listar_postgrado[$i]), $hiddens)) {
                                    ?>
                                    <td><?php echo $campos_listar_postgrado[$i]; ?></td>
                                <?php }
                            } ?>
                            <td>Editar</td>
                            <td>Eliminar</td>
                        </tr>
                        <!-- fin cabeceras -->
                        <?php if ($postgrado) { ?>
                            <?php
                            $prefijo = $this->prefijo1;
                            foreach ($postgrado as $fila) {
                                ?>
                                <tr>
                                    <?php
                                    for ($i = 0; $i < count($campos_reales_postgrado); $i++) {
                                        if (!$this->tool_general->find_in_array(strtolower($campos_reales_postgrado[$i]), $hiddens)) {
                                            if (strtolower($campos_reales_postgrado[$i]) == 'edu_grado') {
                                                ?>
                                                <td valign="center"><?php echo $this->grados[$fila[strtolower($campos_reales_postgrado[$i])]]; ?></td>
                                            <?php
                                            } else {
                                                if (($estado != strtolower($campos_reales_postgrado[$i])) && ($actual != strtolower($campos_reales_postgrado[$i])) && ($orden != strtolower($campos_reales_postgrado[$i])) && ($destacadomas != strtolower($campos_reales_postgrado[$i]))) {
                                                    ?>
                                                    <td valign="center"><?php echo strip_tags($fila[strtolower($campos_reales_postgrado[$i])]); ?>&nbsp;</td>
                                                <?php
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                    <td align="center"><?php echo anchor($this->controlador . 'editar_postgrado/id/' . $fila[$prefijo . 'id'], 'Editar', array('class' => 'enlace_editar1 enlace_a1')); ?></td>
                                    <td align="center"><?php echo anchor($this->controlador . 'eliminar_postgrado/id/' . $fila[$prefijo . 'id'], 'Eliminar', array('class' => 'enlace_eliminar1 enlace_a1', 'onclick' => "return confirmar('$msj_confirmar')")); ?></td>
                                </tr>
    <?php } ?>
<?php } else { ?>
                            <tr>
                                <td colspan="10" align="left">
                                    <div class="enlace_nodato1"><img src="<?php echo $this->tool_entidad->sitio() . 'files/img/maq/no_data.png'; ?>" hspace="5" />No tiene ningun Post Grado</div>                        
                                </td>
                            </tr>
<?php } ?>                
                    </table>                    
                </td>
            </tr>
        </table>        
        <div class="tabla_listado_nuevo" align="left"> &nbsp;<?php echo anchor($this->controlador . 'postgrado_nuevo', 'Agregar Nuevo Post Grado', array('class' => 'enlace_nuevo1 enlace_a1')); ?></div>            
        <table cellpadding="0" border="0" cellspacing="0">
            <tr>
                <td align="left">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="left"><div class="titulo_cabecera_listado">EDUCACIÓN SUPERIOR</div></td>
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
                            for ($i = 0; $i < count($campos_listar_superior); $i++) {
                                if (!$this->tool_general->find_in_array(strtolower($campos_listar_superior[$i]), $hiddens)) {
                                    ?>
                                    <td><?php echo $campos_listar_superior[$i]; ?></td>
    <?php }
} ?>
                            <td>Editar</td>
                            <td>Eliminar</td>
                        </tr>
                        <!-- fin cabeceras -->
                        <?php if ($superior) { ?>
                            <?php
                            $prefijo = $this->prefijo1;
                            foreach ($superior as $fila) {
                                ?>
                                <tr>
                                    <?php
                                    for ($i = 0; $i < count($campos_reales_superior); $i++) {
                                        if (!$this->tool_general->find_in_array(strtolower($campos_reales_superior[$i]), $hiddens)) {
                                            if (strtolower($campos_reales_superior[$i]) == 'edu_grado') {
                                                ?>
                                                <td valign="center"><?php echo $this->grados_sup[$fila[strtolower($campos_reales_superior[$i])]]; ?></td>
                                                <?php } elseif (strtolower($campos_reales_superior[$i]) == 'edu_area') { ?>
                                                <td valign="center"><?php
                                                    if ($fila[strtolower($campos_reales_superior[$i])] == 65) {
                                                    echo $this->area_pro[$fila[strtolower($campos_reales_superior[$i])]]."-".$fila['edu_area_otro'];
                                                    } else {
                                                    echo $this->area_pro[$fila[strtolower($campos_reales_superior[$i])]];
                                                    }
                                                    ?></td>
                                            <?php
                                            } else {
                                                if (($estado != strtolower($campos_reales_superior[$i])) && ($actual != strtolower($campos_reales_superior[$i])) && ($orden != strtolower($campos_reales_superior[$i])) && ($destacadomas != strtolower($campos_reales_superior[$i]))) {
                                                    ?>
                                                    <td valign="center"><?php echo strip_tags($fila[strtolower($campos_reales_superior[$i])]); ?>&nbsp;</td>
                    <?php
                    }
                }
            }
        }
        ?>
                                    <td align="center"><?php echo anchor($this->controlador . 'editar_superior/id/' . $fila[$prefijo . 'id'], 'Editar', array('class' => 'enlace_editar1 enlace_a1')); ?></td>
                                    <td align="center"><?php echo anchor($this->controlador . 'eliminar_superior/id/' . $fila[$prefijo . 'id'], 'Eliminar', array('class' => 'enlace_eliminar1 enlace_a1', 'onclick' => "return confirmar('$msj_confirmar')")); ?></td>
                                </tr>
        <?php
    }
    ?>
<?php } else { ?>
                            <tr>
                                <td colspan="10" align="left">
                                    <div class="enlace_nodato1"><img src="<?php echo $this->tool_entidad->sitio() . 'files/img/maq/no_data.png'; ?>" hspace="5" />No tiene ningun Educación Superior</div>                        
                                </td>
                            </tr>
<?php } ?>                
                    </table>
                </td>
            </tr>
        </table>         
        <div class="tabla_listado_nuevo" align="left"> &nbsp; <?php echo anchor($this->controlador . 'superior_nuevo', 'Agregar Nuevo Educación Superior', array('class' => 'enlace_nuevo1 enlace_a1')); ?>&nbsp;&nbsp;</div>
        <table cellpadding="0" border="0" cellspacing="0">
            <tr>
                <td align="left">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="left"><div class="titulo_cabecera_listado">EDUCACIÓN SECUNDARIA</div></td>
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
for ($i = 0; $i < count($campos_listar_secundaria); $i++) {
    if (!$this->tool_general->find_in_array(strtolower($campos_listar_secundaria[$i]), $hiddens)) {
        ?>
                                    <td><?php echo $campos_listar_secundaria[$i]; ?></td>
                            <?php }
                        } ?>
                            <td>Editar</td>
                            <td>Eliminar</td>
                        </tr>
                        <!-- fin cabeceras -->
                            <?php if ($secundaria) { ?>
                                <?php
                                $prefijo = $this->prefijo1;
                                foreach ($secundaria as $fila) {
                                    ?>
                                <tr>
                                    <?php
                                    for ($i = 0; $i < count($campos_reales_secundaria); $i++) {
                                        if (!$this->tool_general->find_in_array(strtolower($campos_reales_secundaria[$i]), $hiddens)) {
                                            if (strtolower($campos_reales_secundaria[$i]) == 'edu_grado') {
                                                ?>
                                                <td valign="center"><?php echo $this->grados_sup[$fila[strtolower($campos_reales_secundaria[$i])]]; ?></td>
                                            <?php
                                            } else {
                                                if (($estado != strtolower($campos_reales_secundaria[$i])) && ($actual != strtolower($campos_reales_secundaria[$i])) && ($orden != strtolower($campos_reales_secundaria[$i])) && ($destacadomas != strtolower($campos_reales_secundaria[$i]))) {
                                                    ?>
                                                    <td valign="center"><?php echo strip_tags($fila[strtolower($campos_reales_secundaria[$i])]); ?>&nbsp;</td>
                                            <?php
                                            }
                                        }
                                    }
                                }
                                ?>
                                    <td align="center"><?php echo anchor($this->controlador . 'editar_secundaria/id/' . $fila[$prefijo . 'id'], 'Editar', array('class' => 'enlace_editar1 enlace_a1')); ?></td>
                                    <td align="center"><?php echo anchor($this->controlador . 'eliminar_secundaria/id/' . $fila[$prefijo . 'id'], 'Eliminar', array('class' => 'enlace_eliminar1 enlace_a1', 'onclick' => "return confirmar('$msj_confirmar')")); ?></td>
                                </tr>
                                <?php
                            }
                            ?>
<?php } else { ?>
                            <tr>
                                <td colspan="7" align="left">                        
                                    <div class="enlace_nodato1"><img src="<?php echo $this->tool_entidad->sitio() . 'files/img/maq/no_data.png'; ?>" hspace="5" />No tiene ningun Educación Secundaria</div>
                                </td>
                            </tr>
<?php } ?>                
                    </table>
                </td>
            </tr>
        </table>          
        <div class="tabla_listado_nuevo" align="left"> &nbsp; <?php echo anchor($this->controlador . 'secundaria_nuevo', 'Agregar Nuevo Educación Secundaria', array('class' => 'enlace_nuevo1 enlace_a1')); ?>&nbsp;&nbsp;</div>
        <table cellpadding="0" border="0" cellspacing="0">
            <tr>
                <td align="left">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="left"><div class="titulo_cabecera_listado">PUBLICACIONES</div></td>
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
                        for ($i = 0; $i < count($campos_listar_publicacion); $i++) {
                            if (!$this->tool_general->find_in_array(strtolower($campos_listar_publicacion[$i]), $hiddens)) {
                                ?>
                                    <td><?php echo $campos_listar_publicacion[$i]; ?></td>
                            <?php }
                        } ?>
                            <td>Editar</td>
                            <td>Eliminar</td>
                        </tr>
                        <!-- fin cabeceras -->
                            <?php if ($publicacion) { ?>
                                <?php
                                $prefijo = $this->prefijo2;
                                foreach ($publicacion as $fila) {
                                    ?>
                                <tr>
                                    <?php
                                    for ($i = 0; $i < count($campos_reales_publicacion); $i++) {
                                        if (!$this->tool_general->find_in_array(strtolower($campos_reales_publicacion[$i]), $hiddens)) {
                                            if (strtolower($campos_reales_publicacion[$i]) == 'edu_grado') {
                                                ?>
                                                <td valign="center"><?php echo $this->grados_sup[$fila[strtolower($campos_reales_publicacion[$i])]]; ?></td>
                <?php
                } else {
                    if (($estado != strtolower($campos_reales_publicacion[$i])) && ($actual != strtolower($campos_reales_publicacion[$i])) && ($orden != strtolower($campos_reales_publicacion[$i])) && ($destacadomas != strtolower($campos_reales_publicacion[$i]))) {
                        ?>
                                                    <td valign="center"><?php echo strip_tags($fila[strtolower($campos_reales_publicacion[$i])]); ?>&nbsp;</td>
                                            <?php
                                            }
                                        }
                                    }
                                }
                                ?>
                                    <td align="center"><?php echo anchor($this->controlador . 'editar_publicacion/id/' . $fila[$prefijo . 'id'], 'Editar', array('class' => 'enlace_editar1 enlace_a1')); ?></td>
                                    <td align="center"><?php echo anchor($this->controlador . 'eliminar_publicacion/id/' . $fila[$prefijo . 'id'], 'Eliminar', array('class' => 'enlace_eliminar1 enlace_a1', 'onclick' => "return confirmar('$msj_confirmar')")); ?></td>
                                </tr>
        <?php
    }
    ?>
<?php } else { ?>
                            <tr>
                                <td colspan="7" align="left">
                                    <div class="enlace_nodato1"><img src="<?php echo $this->tool_entidad->sitio() . 'files/img/maq/no_data.png'; ?>" hspace="5" />No tiene ninguna Publicación</div>
                                </td>
                            </tr>
                <?php } ?>                
                    </table>
                </td>
            </tr>
        </table>         
        <div class="tabla_listado_nuevo" align="left"> &nbsp; <?php echo anchor($this->controlador . 'publicacion_nuevo', 'Agregar Nuevo Publicación', array('class' => 'enlace_nuevo1 enlace_a1')); ?>&nbsp;&nbsp;</div>
    </form>
    <br/>
    <table  align="center" cellspacing="35" width="815">
        <tr>
            <td align="left" valign="top">
<?php echo anchor('postulante/editar_datospersonal/id/' . $id, '<img border="0" src="' . $this->tool_entidad->sitio() . 'files/img/maq/anterior.gif"/>'); ?>
            </td>
            <td align="right" valign="top">
<?php
    echo anchor('postulante/trayectoria_laboral', '<img border="0" src="' . $this->tool_entidad->sitio() . 'files/img/maq/siguiente.gif"/>');
 ?>
            </td>
        </tr>
    </table>
</div>


