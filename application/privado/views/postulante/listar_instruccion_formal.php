<?php
$this->load->view('cabecera');
?>
<?php
$msj_confirmar = '¿Está seguro que desea eliminar el elemento seleccionado?';
$ruta = $this->rutarchivo . @$this->carpetaup;
?>


<div id="listado">
    <?php
    $sitio = $this->tool_entidad->sitioindexpri();
    $prefijo = 'pos_';
    ?>
    <div align="left" ><?php echo anchor($this->controlador . 'editar/id/' . $fila_sup[$prefijo . 'id'], 'Atrás', array('class' => 'enlace_retornar enlace_a1')); ?></div><br/>
    <div id="cabecera_listado">
        <table cellpadding="5">
            <tr><td align="right"><b> Nombre: </b></td><td align="left"><?php echo $fila_sup[$prefijo . 'apaterno'] . ' ' . $fila_sup[$prefijo . 'amaterno'] . ' ' . $fila_sup[$prefijo . 'nombre']; ?></td></tr>
            <tr><td align="right"><b> Documento: </b></td><td align="left"><?php echo $fila_sup[$prefijo . 'documento']; ?></td></tr>
        </table>
    </div>
    <form action="<?php echo $sitio . $this->controlador . 'procesar' ?>" method="post" id="form_listar_fsimple">
        <input type="hidden" name="id" value="<?php echo $id; ?>" id="id"/>
        <h2 align="center">Educación Post Grado</h2>
        <table  align="center" class="tabla_listado" border="0" cellspacing="0" width="900">

            <!-- ini cabeceras -->
            <tr class="cabecera_listado">
                <?php
                for ($i = 0; $i < count($campos_listar_postgrado); $i++) {
					$aux=strtolower($campos_listar_postgrado[$i]);
                    if (!$this->tool_general->find_in_array($aux, @$hiddens)) {
                        ?>
                        <td><?php echo $campos_listar_postgrado[$i]; ?></td>
                    <?php }
                }
                ?>
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
                            if (!$this->tool_general->find_in_array(strtolower($campos_reales_postgrado[$i]), @$hiddens)) {
                                if (strtolower($campos_reales_postgrado[$i]) == 'edu_grado') {
                                    ?>
                                    <td valign="center"><?php echo $this->grados[$fila[strtolower($campos_reales_postgrado[$i])]]; ?></td>
                                    <?php
                                } else {
                                    if ((@$estado != strtolower($campos_reales_postgrado[$i])) && (@$actual != strtolower($campos_reales_postgrado[$i])) && (@$orden != strtolower($campos_reales_postgrado[$i])) && (@$destacadomas != strtolower($campos_reales_postgrado[$i]))) {
                                        ?>
                                        <td valign="center"><?php echo strip_tags($fila[strtolower($campos_reales_postgrado[$i])]); ?>&nbsp;</td>
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                        <td><?php echo anchor($this->controlador . 'editar_postgrado/id/' . $fila[$prefijo . 'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a1')); ?></td>
                        <td><?php echo anchor($this->controlador . 'eliminar_postgrado/id/' . $fila[$prefijo . 'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/eliminar.png" alt="eliminar">', array('class' => 'enlace_a1', 'onclick' => "return confirmar('$msj_confirmar')")); ?></td>
                    </tr>
                <?php } ?>
<?php } else { ?>
                <tr>
                    <td colspan="10" align="center">
                        <b>No tiene ningun Post Grado</b>
                    </td>
                </tr>
<?php } ?>
            <tr>
                <td colspan="10" align="center">
<?php echo anchor($this->controlador . 'postgrado_nuevo/ids/' . $fila_sup['pos_id'], 'Agregar Nuevo Post Grado', array('class' => 'enlace_nuevo1 enlace_a1')); ?>&nbsp;&nbsp;
                </td>
            </tr>
        </table>        

        <h2 align="center">Educación Superior</h2>
        <table  align="center" class="tabla_listado"  cellspacing="0" width="900">
            <!-- ini cabeceras -->
            <tr class="cabecera_listado">
                <?php
                for ($i = 0; $i < count($campos_listar_superior); $i++) {
                    if (!$this->tool_general->find_in_array(strtolower($campos_listar_superior[$i]), @$hiddens)) {
                        ?>
                        <td><?php echo $campos_listar_superior[$i]; ?></td>
                    <?php }
                }
                ?>
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
                            if (!$this->tool_general->find_in_array(strtolower($campos_reales_superior[$i]), @$hiddens)) {
                                if (strtolower($campos_reales_superior[$i]) == 'edu_grado') {
                                    ?>
                                    <td valign="center"><?php echo $this->grados_sup[$fila[strtolower($campos_reales_superior[$i])]]; ?></td>
                                    <?php } elseif (strtolower($campos_reales_superior[$i]) == 'edu_area') { ?>
                                    <td valign="center"><?php
                                        if ($fila[strtolower($campos_reales_superior[$i])] == 65) {
                                            echo $this->profesiones[$fila[strtolower($campos_reales_superior[$i])]]. "-" . $fila['edu_area_otro'];
                                        } else {
                                            echo $this->profesiones[$fila[strtolower($campos_reales_superior[$i])]];
                                        }
                                        ?></td>
                                    <?php
                                } else {
                                    if ((@$estado != strtolower($campos_reales_superior[$i])) && (@$actual != strtolower($campos_reales_superior[$i])) && (@$orden != strtolower($campos_reales_superior[$i])) && (@$destacadomas != strtolower($campos_reales_superior[$i]))) {
                                        ?>
                                        <td valign="center"><?php echo strip_tags($fila[strtolower($campos_reales_superior[$i])]); ?>&nbsp;</td>
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                        <td><?php echo anchor($this->controlador . 'editar_superior/id/' . $fila[$prefijo . 'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a1')); ?></td>
                        <td><?php echo anchor($this->controlador . 'eliminar_superior/id/' . $fila[$prefijo . 'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/eliminar.png" alt="eliminar">', array('class' => 'enlace_a1', 'onclick' => "return confirmar('$msj_confirmar')")); ?></td>
                    </tr>
                    <?php
                }
                ?>
<?php } else { ?>
                <tr>
                    <td colspan="10" align="center">
                        <b>No tiene ningun Educación Superior</b>
                    </td>
                </tr>
                    <?php } ?>
            <tr>
                <td colspan="10" align="center">
<?php echo anchor($this->controlador . 'superior_nuevo/ids/' . $fila_sup['pos_id'], 'Agregar Nuevo Educación Superior', array('class' => 'enlace_nuevo1 enlace_a1')); ?>&nbsp;&nbsp;
                </td>
            </tr>
        </table>
        <h2 align="center">Educación Secundaria</h2>
        <table  align="center" class="tabla_listado"  cellspacing="0" width="900">
            <!-- ini cabeceras -->
            <tr class="cabecera_listado">
                <?php
                for ($i = 0; $i < count($campos_listar_secundaria); $i++) {
                    if (!$this->tool_general->find_in_array(strtolower($campos_listar_secundaria[$i]), @$hiddens)) {
                        ?>
                        <td><?php echo $campos_listar_secundaria[$i]; ?></td>
    <?php }
}
?>
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
                            if (!$this->tool_general->find_in_array(strtolower($campos_reales_secundaria[$i]), @$hiddens)) {
                                if (strtolower($campos_reales_secundaria[$i]) == 'edu_grado') {
                                    ?>
                                    <td valign="center"><?php echo $this->grados_sup[$fila[strtolower($campos_reales_secundaria[$i])]]; ?></td>
                                    <?php
                                } else {
                                    if ((@$estado != strtolower($campos_reales_secundaria[$i])) && (@$actual != strtolower($campos_reales_secundaria[$i])) && (@$orden != strtolower($campos_reales_secundaria[$i])) && (@$destacadomas != strtolower($campos_reales_secundaria[$i]))) {
                                        ?>
                                        <td valign="center"><?php echo strip_tags($fila[strtolower($campos_reales_secundaria[$i])]); ?>&nbsp;</td>
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                        <td><?php echo anchor($this->controlador . 'editar_secundaria/id/' . $fila[$prefijo . 'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a1')); ?></td>
                        <td><?php echo anchor($this->controlador . 'eliminar_secundaria/id/' . $fila[$prefijo . 'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/eliminar.png" alt="eliminar">', array('class' => 'enlace_a1', 'onclick' => "return confirmar('$msj_confirmar')")); ?></td>
                    </tr>
                    <?php
                }
                ?>
<?php } else { ?>
                <tr>
                    <td colspan="7" align="center">
                        <b>No tiene ningun Educación Secundaria</b>
                    </td>
                </tr>
                    <?php } ?>
            <tr>
                <td colspan="7" align="center">
<?php echo anchor($this->controlador . 'secundaria_nuevo/ids/' . $fila_sup['pos_id'], 'Agregar Nuevo Educación Secundaria', array('class' => 'enlace_nuevo1 enlace_a1')); ?>&nbsp;&nbsp;
                </td>
            </tr>
        </table>
        <h2 align="center">Publicaciones</h2>
        <table  align="center" class="tabla_listado"  cellspacing="0" width="900">
            <!-- ini cabeceras -->
            <tr class="cabecera_listado">
                <?php
                for ($i = 0; $i < count($campos_listar_publicacion); $i++) {
                    if (!$this->tool_general->find_in_array(strtolower($campos_listar_publicacion[$i]), @$hiddens)) {
                        ?>
                        <td><?php echo $campos_listar_publicacion[$i]; ?></td>
    <?php }
}
?>
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
                            if (!$this->tool_general->find_in_array(strtolower($campos_reales_publicacion[$i]), @$hiddens)) {
                                if (strtolower($campos_reales_publicacion[$i]) == 'edu_grado') {
                                    ?>
                                    <td valign="center"><?php echo $this->grados_sup[$fila[strtolower($campos_reales_publicacion[$i])]]; ?></td>
                                    <?php
                                } else {
                                    if ((@$estado != strtolower($campos_reales_publicacion[$i])) && (@$actual != strtolower($campos_reales_publicacion[$i])) && (@$orden != strtolower($campos_reales_publicacion[$i])) && (@$destacadomas != strtolower($campos_reales_publicacion[$i]))) {
                                        ?>
                                        <td valign="center"><?php echo strip_tags($fila[strtolower($campos_reales_publicacion[$i])]); ?>&nbsp;</td>
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                        <td><?php echo anchor($this->controlador . 'editar_publicacion/id/' . $fila[$prefijo . 'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a1')); ?></td>
                        <td><?php echo anchor($this->controlador . 'eliminar_publicacion/id/' . $fila[$prefijo . 'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/eliminar.png" alt="eliminar">', array('class' => 'enlace_a1', 'onclick' => "return confirmar('$msj_confirmar')")); ?></td>
                    </tr>
        <?php
    }
    ?>
<?php } else { ?>
                <tr>
                    <td colspan="7" align="center">
                        <b>No tiene ningun Publicación</b>
                    </td>
                </tr>
<?php } ?>
            <tr>
                <td colspan="7" align="center">
<?php echo anchor($this->controlador . 'publicacion_nuevo/ids/' . $fila_sup['pos_id'], 'Agregar Nuevo Publicación', array('class' => 'enlace_nuevo1 enlace_a1')); ?>&nbsp;&nbsp;
                </td>
            </tr>
        </table>
    </form>    
</div>


