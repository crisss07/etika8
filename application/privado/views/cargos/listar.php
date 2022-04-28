<table align="center" width="100%">
    <tr>
        <td class="enlaces_add_edit" align="left" width="100%">
            <?php
            if (count($cabecera)) {
                ?>
                <table align="center">
                    <tr>
                        <td>
                            <?php
                            if (!@$this->notitulo) {
                                ?>
                                <?php
                                if (@$cabecera['titulo_general']) {
                                    ?>
                                    <span class="cabecera_titulo"> <?php echo $cabecera['titulo_general']; ?></span>
                                    <br/>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($cabecera['titulo']) {
                                    ?>
                                    <span class="cabecera_titulo"> <?php echo $cabecera['titulo']; ?></span>
                                    <?php
                                }
                                if ($cabecera['accion']) {
                                    ?>
                                    <span class="flecha2">&rarr;</span>
                                    <span class="cabecera_accion"> <?php echo $cabecera['accion']; ?></span>
                                    <?php
                                }
                            }
                            ?>

                        </td>
                    </tr>
                    <tr><td colspan="2"><div class="linea1"></div></td></tr>
                </table>
                <?php
            }
            ?>
        </td>

    </tr>
</table>
<br>
<?php
if ($this->idp >= 0) {
    switch ($this->idp) {
        case 1:
            $mostrar = '<div align="center" style="font-size: 16px; font-weight: bold">Postulante </div>Formulario de convocatoria
                        <table width="100%"><tr>
                                <td width="15"> &nbsp; </td>
                                <td align="left"><table width="100%" border="0">
                                                    <tr>
                                                        <td width="15"> &nbsp; </td>
                                                        <td align="left"> &rarr; Cargos para el Filtro (Categoria Área)</td>
                                                    </tr>
                                                  </table>
                                </td>
                        </tr></table>';
            break;
        case 2:
            $mostrar = '<div align="center" style="font-size: 16px; font-weight: bold">Postulante </div>Formulario de convocatoria
                        <table width="100%"><tr>
                                <td width="15"> &nbsp; </td>
                                <td align="left"><table width="100%" border="0">
                                                    <tr>
                                                        <td width="15"> &nbsp; </td>
                                                        <td align="left"> &rarr; Cargos para el Filtro ('.$areaCategoria.')</td>
                                                    </tr>
                                                  </table>
                                </td>
                        </tr></table>';
            break;
    }
    ?>
    <div id="cabecera_listado">
        <table width="100%">
            <tr>
                <td>
                    <span class="text3">
                        <?php echo $mostrar; ?>
                    </span>                
                </td>
            </tr>
        </table>
    </div>
    <?php
}
?>





<?php
$prefijo = $this->prefijo;
$msj_confirmar = '¿Está seguro que desea eliminar el elemento seleccionado?';
//$ruta=$this->rutabase.$this->carpetaup;
if (@$this->carpetaup) {
    $ruta = $this->rutarchivo . $this->carpetaup;
} else {
    $ruta = @$this->rutarchivo . $this->carpeta;
}
//$ruta=$this->rutarchivo.$this->carpetaup;
$alineacionw = 'center';
$alineacionh = 'middle';
?>



<div id="listado">
    <?php
    $sitio = $this->tool_entidad->sitioindexpri();
    ?>
    <div class="paginacion_lista"><?php //echo $this->pagination->create_links();                   ?></div>

    <?php
    if (!@$this->nolistar) {
        ?>
        <form action="<?php echo $sitio . $this->controlador . 'procesar' ?>" method="post" id="form_listar_fsimple">
            <table width="100%"><tr><td>
                        <?php
                        if (!@$this->nolistar) {
                            $this->load->view('opciones_cargo');
                        }
                        ?>

                    </td><td align="right">
                    </td>
                </tr>
            </table>
            <br>
            <input type="hidden" name="idp" value="<?php echo $this->idp; ?>" id="idp"/>
            <input type="hidden" name="fid" value="<?php print_r (@set_value($this->fid, $this->fid)); ?>">
            <input type="hidden" name="destacadomas" value="<?php print_r (@set_value($destacadomas, $destacadomas)); ?>">

            <table  align="center" class="tabla_listado"  cellspacing="0" width="100%">
                <tr class="cabecera_listado">


                <div class="rutabase" style="display: none;"><?php echo $sitio . $this->controlador; ?></div>
                <?php
                for ($i = 0; $i < count($campos_listar); $i++) {
                    if (!$this->tool_general->find_in_array(strtolower($campos_listar[$i]), $hiddens)) {
                        ?>
                        <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>"><?php echo $campos_listar[$i]; ?></td>
                        <?php
                    }
                }
                ?>
                <?php
                // ini enlaces label
                if (@$this->enlaces) {
                    for ($i = 1; $i <= count($this->enlaces) / $this->nroenlaces; $i++) {
                        ?>
                        <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>"><?php echo $this->enlaces['nombre' . $i] ?></td>
                        <?php
                    }
                }
                //fin enlaces label
                ?>

                <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>"><input type="checkbox" name="chk_all" id="chk_all"/></td>

                <?php
                if (@$estado) {
                    ?>
                    <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">Habilitar</td>
                    <?php
                }
                ?>

                <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">Editar</td>
                <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">Eliminar</td>
                </tr>

                 <!--aplicamos color a las celdas-->
                <?php $color=0;?>

                <?php
                foreach ($datos as $fila) {
                    ?>
                    <?php if ($color==0): ?>
                        <tr class="<?php echo 'fila-color-1'; $color=1; ?>">
                        <?php else: ?>
                        <tr class="<?php echo 'fila-color-2'; $color=0; ?>">
                        
                    <?php endif ?>
                    <!--fin de color a las celdas-->

                        <?php
                        if ($orden) {
                            ?>
                            <!--comentado la columna ordenar-->
                                <!--<td align="center"> <input type='text' name='<?php echo 'orden' . $fila[$prefijo . 'id']; ?>' value='<?php echo $fila[$orden]; ?>' size="1" class="input2"></td>-->
                            <?php
                        }
                        ?>
                        <?php
                        for ($i = 0; $i < count($campos_reales); $i++) {
                            ?>
                            <?php
                            if (!$this->tool_general->find_in_array(strtolower($campos_reales[$i]), $hiddens)) {
                                if ((@$imagen == strtolower($campos_reales[$i])) || (@$adjunto == strtolower($campos_reales[$i]))) {
                                    if ($imagen == strtolower($campos_reales[$i])) {
                                        ?>
                                        <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">
                                            <img src="<?php echo $ruta . $fila[$imagen]; ?>" width="150" height="150" alt="Sin imagen"/>
                                        </td>
                                        <?php
                                    } else {

                                        $tipofile = $this->tool_general->tipofig_extension(strtolower(substr($fila[$adjunto], -4)));
                                        ?>
                                        <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">
                                            <img src="<?php echo $this->rutaimg . $tipofile . '.gif'; ?>" alt="Sin archivo"/>
                                            <?php echo "<b>" . $fila[$adjunto] . "</b>"; ?>

                                        </td>
                                        <?php
                                    }
                                } else {
                                    if (@$contenido == strtolower($campos_reales[$i])) {
                                        ?>
                                        <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>"><?php echo strip_tags(substr($fila[strtolower($campos_reales[$i])], 0, 200)); ?>&nbsp;</td>
                                        <?php
                                    } else {
                                        if ((@$estado != strtolower($campos_reales[$i])) && (@$actual != strtolower($campos_reales[$i])) && (@$orden != strtolower($campos_reales[$i])) && (@$destacadomas != strtolower($campos_reales[$i])) && ('numcargos' != strtolower($campos_reales[$i]))) {
                                            ?>
                                            <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>"><?php echo strip_tags($fila[strtolower($campos_reales[$i])]); ?>&nbsp;</td>
                                            <?php
                                        } elseif ('numcargos' == strtolower($campos_reales[$i])) {
                                            ?> 
                                            <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>"><?php echo anchor($this->controlador . 'listar/fid/' . $fila[$prefijo . 'id'] . '/idp/2', $fila['numcargos'], array('class' => 'enlace_a1'));
                                            ?>&nbsp;</td>
                                            <?php
                                        }
                                    }
                                }
                            }
                        }
                        ?>

                        <!-- actual  -->
                        <?php
                        if (@$actual) {

                            if ($fila[$actual] == '1') {
                                $si = $fila[$this->prefijo . 'id'];
                                ?>
                                <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">
                                    <div align='center'>
                                        <input type='radio' name='bandera' value='<?php echo $si; ?>' checked>
                                    </div>
                                </td>
                                <?php
                            } else {
                                $no = $fila[$this->prefijo . 'id'];
                                ?>
                                <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">
                                    <div align='center'>
                                        <input type='radio' name='bandera' value='<?php echo $no; ?>'>
                                    </div>
                                </td>
                                <?php
                            }
                            ?>

                            <?php
                        }
                        ?>

                        <!-- destacado mas  -->
                        <?php
                        if (@$destacadomas) {

                            if ($fila[$destacadomas] == '1') {
                                $si = $fila[$this->prefijo . 'id'];
                                ?>
                                <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">
                                    <div align='center'>
                                        <input type="checkbox" name="<?php echo 'chkd' . $fila[$prefijo . 'id']; ?>" <?php echo set_checkbox('chkd' . $fila[$prefijo . 'id'], '1', TRUE); ?>/>

                                    </div>
                                </td>
                                <?php
                            } else {
                                $no = $fila[$this->prefijo . 'id'];
                                ?>
                                <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">
                                    <div align='center'>
                                        <input type="checkbox" name="<?php echo 'chkd' . $fila[$prefijo . 'id']; ?>" <?php echo set_checkbox('chkd' . $fila[$prefijo . 'id'], '1'); ?>/>

                                    </div>
                                </td>
                                <?php
                            }
                            ?>

                            <?php
                        }
                        ?>
                        <!-- estado  -->
                        <?php
                        if (@$fila[$estado]) {
                            $class_estado = "habilitado";
                            $estado_accion = 'Deshabilitar';
                        } else {
                            $class_estado = "deshabilitado";
                            $estado_accion = 'Habilitar';
                        }
                        ?>
                        <?php
                        if (@$estado) {
                            ?>
                            <td align="center"><div class="<?php echo $class_estado; ?>"></div></td>
                            <?php
                        }
                        ?>

                        <?php
                        //ini enlaces
                        if (@$this->enlaces) {
                            for ($i = 1; $i <= count($this->enlaces) / $this->nroenlaces; $i++) {
                                ?>
                                <td align="center" valign="<?php echo $alineacionh; ?>">
                                    <?php
                                    $consulta = $this->db->query('
                            SELECT *
                            FROM
                            ' . $this->enlaces['tabla' . $i] . '
                            where ' . $this->enlaces['campo' . $i] . '="' . $fila[$this->enlaces['camposup' . $i]] . '"'
                                    );
                                    $nro = $consulta->num_rows();

                                    if ($this->tip) {
                                        echo anchor($this->enlaces['ruta' . $i] . '/idp/' . $fila[$prefijo . 'id'] . '/tip/' . $this->tip, $nro, array('class' => 'enlace_a3'));
                                    } else {
                                        echo anchor($this->enlaces['ruta' . $i] . '/idp/' . $fila[$prefijo . 'id'], $nro, array('class' => 'enlace_a3'));
                                    }
                                    ?>

                                </td>
                                <?php
                            }
                        }

                        //fin enlaces
                        ?>


                        <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>"><input type="checkbox" name="<?php echo 'chk' . $fila[$prefijo . 'id']; ?>"/></td>


                        <?php
                        if (@$estado) {
                            ?>
                            <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">
                                <?php
                                if ($fila[$estado]) {
                                    echo anchor($this->controlador . 'deshabilitar/id/' . $fila[$prefijo . 'id'], $estado_accion, array('class' => 'enlace_a1'));
                                } else {
                                    echo anchor($this->controlador . 'habilitar/id/' . $fila[$prefijo . 'id'], $estado_accion, array('class' => 'enlace_a1'));
                                }
                                ?>
                            </td>
                            <?php
                        }
                        ?>
                      <!-- editar -->

                        <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">
                            <?php
                            if ($this->idp) {
                                if (@$this->fid) {
                                    echo anchor($this->controlador . 'editar/id/' . $fila[$prefijo . 'id'] . '/idp/' . $this->idp . '/fid/' . $this->fid, '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a1'));
                                } else {
                                    echo anchor($this->controlador . 'editar/id/' . $fila[$prefijo . 'id'] . '/idp/' . $this->idp,'<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a1'));
                                }
                            } else {
                                if ($this->tip) {
                                    echo anchor($this->controlador . 'editar/id/' . $fila[$prefijo . 'id'] . '/tip/' . $this->tip, '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a1'));
                                } else {
                                    echo anchor($this->controlador . 'editar/id/' . $fila[$prefijo . 'id'],'<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a1'));
                                }
                            }
                            ?>

                            <!-- eliminar -->


                        </td>
                        <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">
                            <?php
                            if ($this->idp) {
                                if (@$this->fid) {
                                    $id = $fila[$prefijo . 'id'];
                                    echo anchor($this->controlador . 'eliminar/id/' . $fila[$prefijo . 'id'] . '/idp/' . $this->idp . '/fid/' . $this->fid, '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/eliminar.png" alt="eliminar">', array('class' => 'enlace_a1', 'onclick' => "return confirmarVerificar('$msj_confirmar','$id','$this->idp','$this->fid')"));
                                } else {
                                    $id = $fila[$prefijo . 'id'];
                                    echo @anchor($this->controlador . 'eliminar/id/' . $fila[$prefijo . 'id'] . '/idp/' . $this->idp, '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/eliminar.png" alt="eliminar">', array('class' => 'enlace_a1', 'onclick' => "return confirmarVerificar('$msj_confirmar','$id','$this->idp','$this->fid')"));
                                }
                            }
                            ?>

                        </td>
                    </tr>
                    <?php
                }
                ?>

            </table>
            <br/>
            <br/>
            <table>
                <tr>
                    <?php
                    if (@$destacadomas) {
                        ?>
                        <td>Actualizar destacados <input type="Submit" name="botondestacadomas" value="Actualizar destacados"/></td>
                        <?php
                    }
                    ?>
                    <?php
                    if ($orden && !$ordencampo) {
                        ?>
                        <td>Actualizar orden</td>
                        <td><input type="Submit" name="actualizarorden" value="Actualizar orden"/></td>
                        <?php
                    }
                    ?>
                    <td>Para los elementos marcados </td>
                    <td><input type="Submit" name="eliminar" class="btn-etika btn" value="Eliminar" onclick="return confirmar('¿Está seguro que desea eliminar los elementos seleccionados?\nLos registro que esten relacionados con algun postulante no seran eliminados')"/></td>
                    <?php
                    if (@$estado1) {
                        ?>
                        <td><input type="Submit" name="habilitar" value="Habilitar"/></td>
                        <td><input type="Submit" name="deshabilitar" value="Deshabilitar"/></td>
                        <?php
                    }
                    ?>
                    <?php
                    if (@$actual) {
                        ?>
                        <td><?php if (!$actualabel) { ?>Actualizar vigente
                                <?php
                            } else {
                                echo 'Actualizar  ' . $actualabel;
                            }
                            ?>

                        </td>
                        <td><input type="Submit" name="actualizar" value="Actualizar"/></td>
                        <?php
                    }
                    ?>


                </tr>
            </table>
        </form>
    <?php } ?>
</div>


