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
        <h2 align="center">Idiomas que Habla</h2>
        <table  align="center" class="tabla_listado"  cellspacing="0" width="900">

            <!-- ini cabeceras -->
            <tr class="cabecera_listado">
                <?php
                for ($i = 0; $i < count($campos_listar_idioma); $i++) {
                    if (!$this->tool_general->find_in_array(strtolower($campos_listar_idioma[$i]), $hiddens)) {
                        ?>
                        <td><?php echo $campos_listar_idioma[$i]; ?></td>
                        <?php
                    }
                }
                ?>
                <td>Editar</td>
                <!--<td>Eliminar</td>-->
            </tr>
            <!-- fin cabeceras -->
            <?php if ($fila) { ?>
                <?php
                $prefijo = $this->prefijoPI;
//            echo $prefijo;
//            print_r($fila); 
                ?>
                <tr>
                    <?php
                    for ($i = 0; $i < count($campos_reales_idioma); $i++) {
                        if (!$this->tool_general->find_in_array(strtolower($campos_reales_idioma[$i]), $hiddens)) {
                            if (strtolower($campos_reales_idioma[$i]) == 'edu_grado') {
                                ?>
                                <td valign="center"><?php echo $this->grados[$fila[strtolower($campos_reales_idioma[$i])]]; ?></td>
                                <?php
                            } else {
                                if (($estado != strtolower($campos_reales_idioma[$i])) && ($actual != strtolower($campos_reales_idioma[$i])) && ($orden != strtolower($campos_reales_idioma[$i])) && ($destacadomas != strtolower($campos_reales_idioma[$i]))) {
                                    ?>
                                    <td valign="center"><?php echo strip_tags($fila[strtolower($campos_reales_idioma[$i])]); ?>&nbsp;</td>
                                    <?php
                                }
                            }
                        }
                    }
                    ?>
                    <td><?php
                        if ($fila[$prefijo . 'id'] != 0) {
                            echo anchor($this->controlador . 'editar_idioma/id/' . $fila[$prefijo . 'id'], 'Editar', array('class' => 'enlace_a1'));
                        } else {
                            echo anchor($this->controlador . 'idioma_nuevo/ids/' . $fila_sup['pos_id'] . '/id/0', 'Editar', array('class' => 'enlace_a1'));
                        }
                        ?></td>
                    <!--<td><?php echo anchor($this->controlador . 'eliminar_idioma/id/' . $fila[$prefijo . 'id'], 'Eliminar', array('class' => 'enlace_a1', 'onclick' => "return confirmar('$msj_confirmar')")); ?></td>-->
                </tr>

            <?php } ?>
        </table> 
        <br/>
        <br/>
        <br/>
        <table  align="center" class="tabla_listado"  cellspacing="0" width="900">

            <!-- ini cabeceras -->
            <tr class="cabecera_listado">
                <?php
                for ($i = 0; $i < count($campos_listar_idioma); $i++) {
                    if (!$this->tool_general->find_in_array(strtolower($campos_listar_idioma[$i]), $hiddens)) {
                        ?>
                        <td><?php echo $campos_listar_idioma[$i]; ?></td>
                        <?php
                    }
                }
                ?>
                <td>Editar</td>
                <td>Eliminar</td>
            </tr>
            <!-- fin cabeceras -->
            <?php if ($idiomas) { ?>
                <?php
                $prefijo = $this->prefijoPI;
                foreach ($idiomas as $fila) {
                    ?>
                    <tr>
                        <?php
                        for ($i = 0; $i < count($campos_reales_idioma); $i++) {
                            if (!$this->tool_general->find_in_array(strtolower($campos_reales_idioma[$i]), $hiddens)) {
                                if (strtolower($campos_reales_idioma[$i]) == 'edu_grado') {
                                    ?>
                                    <td valign="center"><?php echo $this->grados[$fila[strtolower($campos_reales_idioma[$i])]]; ?></td>
                                    <?php
                                } else {
                                    if (($estado != strtolower($campos_reales_idioma[$i])) && ($actual != strtolower($campos_reales_idioma[$i])) && ($orden != strtolower($campos_reales_idioma[$i])) && ($destacadomas != strtolower($campos_reales_idioma[$i]))) {
                                        ?>
                                        <td valign="center"><?php echo strip_tags($fila[strtolower($campos_reales_idioma[$i])]); ?>&nbsp;</td>
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                        <td><?php echo anchor($this->controlador . 'editar_idioma/id/' . $fila[$prefijo . 'id'], 'Editar', array('class' => 'enlace_a1')); ?></td>
                        <td><?php echo anchor($this->controlador . 'eliminar_idioma/id/' . $fila[$prefijo . 'id'], 'Eliminar', array('class' => 'enlace_a1', 'onclick' => "return confirmar('$msj_confirmar')")); ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="7" align="center">
                        <b>No tiene ningun Idioma</b>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="7" align="center">
                    <?php echo anchor($this->controlador . 'idioma_nuevo/ids/' . $fila_sup['pos_id'], 'Agregar Nuevo Idioma', array('class' => 'enlace_nuevo1 enlace_a1')); ?>&nbsp;&nbsp;
                </td>
            </tr>
        </table> 
        <h2 align="center">Comentario Adicional </h2>
        <table  align="center" class="tabla_listado"  cellspacing="0" width="900">
            <?php if ($fila_sup['pos_comentario']) { ?>
                <tr><td algin="left"><div align="justify"><?php echo $fila_sup['pos_comentario']; ?></div></td></tr>
            <?php } else { ?>
                <tr><td colspan="7"><b>No tiene ningun Comentario Adicional</b></td></tr>
            <?php } ?>
        </table>
        <div align="center"><?php echo anchor($this->controlador . 'editar_comentario/id/' . $fila_sup['pos_id'], 'Editar Comentario', array('class' => 'enlace_a3')); ?></div>
    </form>       
</div> 


