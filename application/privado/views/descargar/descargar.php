<?php
//header("Content-Type: text/html;charset=ISO-8859-1");
$sitio = $this->tool_entidad->sitioindexpri();
?>

        <?php
        $prefijo = $this->prefijoP;
        $sitiop = $this->tool_entidad->sitiopri();
        if ($campos_listar) {
            $mostrar = '<table id="resultadoTabla"  align="center" class="tabla_listado" cellspacing="0" name="resultadoFiltro">';
            $mostrar .= '<thead>';
            $mostrar .= '<tr class="cabecera_listado">';
            $mostrar .= '<th  align="center" valign="middle">N&deg;</th>';
            for ($i = 0; $i < count($campos_listar); $i++) {
                $mostrar .= '<th  align="center" valign="middle">' . $campos_listar[$i] . '</th>';
            }
            $mostrar .= '<td align="' . @$alineacionw . '>" valign="' . @$alineacionh . '"><input type="checkbox" name="chk_all" id="chk_all"/></td>';
            $mostrar .= '</tr>';
            $mostrar .= '<tr>';
            $mostrar .= '</tr>';
            $mostrar .= '</thead>';

            if ($datos) {
                $n = 1;
                $mostrar .= '<tbody>';
                foreach ($datos as $fila) {
                    $arrayIdResultados[] = @$fila['id'];
                    $mostrar .= '<tr>';
                    $mostrar .= '<td align="center" valign="middle">' . $n . '</td>';
                    for ($i = 0; $i < count($campos_reales); $i++) {
                        if ($campos_reales[$i] != "postulaciones") {
                            $mostrar .= '<td align="center" valign="middle">' . $fila[strtolower($campos_reales[$i])] . '</td>';
                        }
                    }


                    $mostrar .= '<td align="' . @$alineacionw . '" valign="' . @$alineacionh . '"><input type="checkbox" name="chk' . $fila[$prefijo . 'id'] . '"/></td>';
                    $mostrar .= '</tr>';
                    $mostrar .= '<tbody>';
                    $n++;
                }
            } else {
                $colspan = count($campos_reales) + 1;
                $mostrar .= '<tr>';
                $mostrar .= '<td align="center" colspan="' . $colspan . '" valign="middle">No se encontraron resultados</td>';
                $mostrar .= '</tr>';
            }
            $mostrar .= '</table>';
        }
        ?>
        <div id="contenedor">
            <!--table width="100%"-->
            
            <table width="100%" align="center">
                <tbody><tr>
                        <td class="enlaces_add_edit" width="100%" align="left">
                            <table align="center">                            
                                <tbody><tr>
                                        <td>
                                            <span class="cabecera_titulo"> <?php echo $cabecera['titulo']; ?></span>
                                            <span class="flecha2">&rarr;</span>
                                            <span class="cabecera_accion"> <?php echo $cabecera['acticion']; ?></span>

                                        </td>
                                    </tr>
                                    <tr><td colspan="2"><div class="linea1"></div></td></tr>
                                </tbody></table>
                        </td>

                    </tr>
                </tbody></table>            
            <div id="cuerpo">
<!--                <table align="center" width="40%">
                    <tbody><tr>
                            <td class="enlaces_add_edit" align="center">
                                <a href="#" onclick="window.close();return false;" class="enlace_cancelar enlace_a1">Cerrar</a>
                            </td>
                        </tr>
                    </tbody>
                </table>-->
                <table align="center" width="90%">              
                    <tr>
                        <td align="center">
                            <div id="cuerpo_cen">
                                <div id="listado"><br/>
                                    <div class="scrollh">
                                        <div class="download-frame"></div>

                                        <form action="<?php echo $sitio . $this->controladorP . 'generar_zip2' ?>" method="post" id="form_listar_fsimple"> 
                                            <?php
                                            if ($mostrar) {
                                                echo $mostrar;
                                            }
                                            ?>
                                            <br/>
                                            <br/>        
                                            <table>
                                                <tr>                
                                                    <td>Para los elementos marcados</td>
                                                    <!--<td><input type="button" class="descargar_zip" name="descargar_doc" value=" Descargar "/></td>-->
                                                    <td><input type="Submit" name="descargar_doc" value=" Descargar "/></td>
                                                    <td> (DOCs agrupados en un ZIP)</td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            
            
        </div>
