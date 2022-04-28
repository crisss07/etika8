<?php
$this->load->view('cabecera');
$arrayInstancia[0] = 'CCV';
$arrayInstancia[1] = 'EP';
$arrayInstancia[2] = 'TP';
$arrayInstancia[3] = 'Assesment';
$arrayInstancia[4] = 'Entrevista';
$arrayInstancia[5] = 'Finalista';
$arrayInstancia[6] = 'Elegido';
$arrayInstancia[7] = 'Espera';
$arrayIdResultados = array();
?>
<?php
$sitio = $this->tool_entidad->sitioindexpri();
if ($postulante) {
    $cabecera_listado = '<div id="cabecera_listado"><table cellpadding="5">';
    if ($residencia)
        $cabecera_listado .= '<tr><td align="right"><b> País de residencia: </b></td><td align="left">' . $residencia . '</td></tr>';
    if ($disponibilidad > 0)
        $cabecera_listado .= '<tr><td align="right"><b> Disponibilidad: </b></td><td align="left">' . $this->disponibilidad[$disponibilidad] . '</td></tr>';
    if ($genero > 0)
        $cabecera_listado .= '<tr><td align="right"><b> Género: </b></td><td align="left">' . $this->genero[$genero] . '</td></tr>';
    if ($cliente)
        $cabecera_listado .= '<tr><td align="right"><b> Cliente: </b></td><td align="left">' . $cliente . '</td></tr>';
    if ($idiomaIngles)
        $cabecera_listado .= '<tr><td align="right"><b> Idioma Ingles: </b></td><td align="left">' . $idiomaIngles . '</td></tr>';
    if ($otroIdioma)
        $cabecera_listado .= '<tr><td align="right"><b> Otro Idioma: </b></td><td align="left">' . $otroIdioma . '</td></tr>';
    if ($instancia)
        $cabecera_listado .= '<tr><td align="right"><b> Instancia: </b></td><td align="left">' . $instancia . '</td></tr>';
    if ($experienciaSupervicion)
        $cabecera_listado .= '<tr><td align="right"><b> Experiencia en supervisión: </b></td><td align="left">' . $experienciaSupervicion . '</td></tr>';
    if ($nivelAlcanzado)
        $cabecera_listado .= '<tr><td align="right"><b> Maximo nivel alcanzado: </b></td><td align="left">' . $nivelAlcanzado . '</td></tr>';
    if ($pretencionSalarial)
        $cabecera_listado .= '<tr><td align="right"><b> Ultima pretención salarial: </b></td><td align="left">' . $pretencionSalarial . '</td></tr>';
//    if($profesion)
//        $cabecera_listado.='<tr><td align="right"><b> Profesión: </b></td><td align="left">'.$this->area_pro[$profesion].'</td></tr>';
//    else
//        $cabecera_listado.='<tr><td align="right"><b> Profesión: </b></td><td align="left">Todas las Profesiones</td></tr>';
//    if ($area_exp)
//        $cabecera_listado .= '<tr><td align="right"><b> Área de experiencia: </b></td><td align="left">' . $this->area_exp[$area_exp] . '</td></tr>';
//    else
//        $cabecera_listado .= '<tr><td align="right"><b> Área de experiencia: </b></td><td align="left">Todas las Áreas de Experiencia</td></tr>';
//    if ($recomendacion)
//        $cabecera_listado .= '<tr><td align="right"><b> Recomendación: </b></td><td align="left">' . $this->recomendaciones[$recomendacion] . '</td></tr>';
//    else
//        $cabecera_listado .= '<tr><td align="right"><b> Recomendación: </b></td><td align="left">Todas las Recomendaciones</td></tr>';
//    if ($cliente)
//        $cabecera_listado .= '<tr><td align="right"><b> Cliente: </b></td><td align="left">' . $this->clientes[$cliente] . '</td></tr>';
//    else
//        $cabecera_listado .= '<tr><td align="right"><b> Cliente: </b></td><td align="left">Todos los Clientes</td></tr>';
//    if ($cargo)
//        $cabecera_listado .= '<tr><td align="right"><b> Cargo: </b></td><td align="left">' . $this->cargos[$cargo] . '</td></tr>';
//    else
//        $cabecera_listado .= '<tr><td align="right"><b> Cargo: </b></td><td align="left">Todos los Cargos</td></tr>';
//    if ($sede)
//        $cabecera_listado .= '<tr><td align="right"><b> Sede: </b></td><td align="left">' . $sede . '</td></tr>';
//    else
//        $cabecera_listado .= '<tr><td align="right"><b> Sede: </b></td><td align="left">Todas los Sedes</td></tr>';
//    if ($instancia)
//        $cabecera_listado .= '<tr><td align="right"><b> Instancia: </b></td><td align="left">' . $this->instancias[$instancia] . '</td></tr>';
//    else
//        $cabecera_listado .= '<tr><td align="right"><b> Instancia: </b></td><td align="left">Todas las Instancias</td></tr>';
    $cabecera_listado .= '</table></div><br/>';
}

if ($campos_listar) {
    $mostrar = '<table id="resultadoTabla"  align="center" class="tabla_listado" cellspacing="0" name="resultadoFiltro">';
    $mostrar .= '<thead>';
    $mostrar .= '<tr class="cabecera_listado">';
    $mostrar .= '<th rowspan="2"  align="center" valign="middle">Nº</th>';
    for ($i = 0; $i < count($campos_listar); $i++) {
        $mostrar .= '<th rowspan="2" align="center" valign="middle">' . $campos_listar[$i] . '</th>';
    }
    if ($procesar == 1) {
        $mostrar .= '<th colspan="4" align="center" valign="middle">Ultima</th>';
        $mostrar .= '<th colspan="4" align="center" valign="middle">Penúltima</th>';
        $mostrar .= '<th colspan="4" align="center" valign="middle">Ante penúltima</th>';
        $mostrar .= '</tr>';
        $mostrar .= '<tr class="cabecera_listado">';
        $mostrar .= '<th align="center" valign="middle">Cliente</th>';
        $mostrar .= '<th align="center" valign="middle">Cargo</th>';
        $mostrar .= '<th align="center" valign="middle">Sede</th>';
        $mostrar .= '<th align="center" valign="middle">Instancia</th>';
        $mostrar .= '<th align="center" valign="middle">Cliente</th>';
        $mostrar .= '<th align="center" valign="middle">Cargo</th>';
        $mostrar .= '<th align="center" valign="middle">Sede</th>';
        $mostrar .= '<th align="center" valign="middle">Instancia</th>';
        $mostrar .= '<th align="center" valign="middle">Cliente</th>';
        $mostrar .= '<th align="center" valign="middle">Cargo</th>';
        $mostrar .= '<th align="center" valign="middle">Sede</th>';
        $mostrar .= '<th align="center" valign="middle">Instancia</th>';
        $mostrar .= '</tr>';
    } else {
        $mostrar .= '</tr>';
        $mostrar .= '<tr>';
        $mostrar .= '</tr>';
        $mostrar .= '</thead>';
    }
    if ($datos) {
        $n = 1;
        $mostrar .= '<tbody>';
        foreach ($datos as $fila) {
            $arrayIdResultados[] = $fila['id'];
            $mostrar .= '<tr>';
            $mostrar .= '<td align="center" valign="middle">' . $n . '</td>';
            for ($i = 0; $i < count($campos_reales); $i++) {
                if ($campos_reales[$i] == "ambito") {
                    $arrayAmbito = explode(',', $fila[$campos_reales[$i]]);
                    $ambitos = array();
                    foreach ($arrayAmbito as $key => $value) {
                        if ($value == 1) {
                            $ambitos[] = "Empresa Privada";
                        }
                        if ($value == 2) {
                            $ambitos[] = "Entidad Publica";
                        }
                        if ($value == 3) {
                            $ambitos[] = "Cooperación para el Desarrollo";
                        }
                    }
                    $fila[$campos_reales[$i]] = implode(', ', $ambitos);
                }
                if ($campos_reales[$i] == "idarea") {
                    $arrayAreaExp = explode(',', $fila[$campos_reales[$i]]);
                    $nombresArea = array();
                    foreach ($arrayAreaExp as $key => $value) {
                        $nombresArea[] = $this->area_experiencia[$value];
                    }

                    $fila[$campos_reales[$i]] = implode(', ', $nombresArea);
                }
                if ($campos_reales[$i] == "idsector") {
                    $arraySectorExp = explode(',', $fila[$campos_reales[$i]]);
                    $nombresSector = array();
                    foreach ($arraySectorExp as $key => $value) {
                        $nombresSector[] = $this->sector_experiencia[$value];
                    }
                    $fila[$campos_reales[$i]] = implode(', ', $nombresSector);
                }
                if ($campos_reales[$i] != "postulaciones") {
                    $mostrar .= '<td align="center" valign="middle">' . $fila[strtolower($campos_reales[$i])] . '</td>';
                }
                if (!empty($fila['postulaciones']) && $campos_reales[$i] == "postulaciones") {
                    foreach ($fila['postulaciones'] as $key => $value) {
                        $mostrar .= '<td align="center" valign="middle">' . $value['cliente'] . '</td>';
                        $mostrar .= '<td align="center" valign="middle">' . $value['cargo'] . '</td>';
                        $mostrar .= '<td align="center" valign="middle">' . $value['sede'] . '</td>';
                        $mostrar .= '<td align="center" valign="middle">' . $arrayInstancia[$value['instancia']] . '</td>';
                    }
                }
            }
            $mostrar .= '</tr>';
            $mostrar .= '<tbody>';
            $n++;
        }
        if (!$tipoBusqueda) {
            $_SESSION['idPostulantes'] = $arrayIdResultados;
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
<form action="<?php echo $sitio . $this->controlador . 'excel'; ?>" method="post" id="form_listar_fsimple">
    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
    <input type="hidden" name="campos_listar" value="<?php echo base64_encode(serialize($campos_listar)); ?>"/>
    <input type="hidden" name="campos_reales" value="<?php echo base64_encode(serialize($campos_reales)); ?>"/>
    <input type="hidden" name="datos" value="<?php echo base64_encode(serialize($datos)); ?>"/>
    <input type="hidden" name="titulo" value="<?php echo $titulo; ?>"/>
    <input type="hidden" name="cabecera_listado" value="<?php echo base64_encode(serialize($cabecera_listado)); ?>"/>
    <table align="center" width="100%" border="0">
        <tr>
            <td class="enlaces_add_edit" align="left" width="8%" >
                <?php
                if ($servicios) {
                    echo anchor($this->controlador, 'Cancelar', array('class' => 'enlace_cancelar enlace_a1'));
                } elseif ($postulante) {
                    echo anchor($this->controlador . 'postulante', 'Cancelar', array('class' => 'enlace_cancelar enlace_a1'));
                } elseif ($etiko) {
                    echo anchor($this->controlador . 'etiko', 'Cancelar', array('class' => 'enlace_cancelar enlace_a1'));
                }
                ?>
            </td>
            <td class="enlaces_add_edit" align="left">
                <form action="<?php echo $sitio . $this->controlador . 'excelExportar'; ?>" method="post" target="_blank" id="FormularioExportacion" name="formuexcel">
                    <p><img src="<?php echo $this->tool_entidad->sitio() . 'files/img/excel_exportar.jpg'; ?>" onclick="tableToExcel2('resultadoTabla', 'Postulantes', 'resultado')" 
                            style="cursor: pointer;"/></p>
            </td>
        </tr>
    </table>
</form>
<?php
//echo $tiempo_ejecucion;
$numResultado = count($arrayIdResultados);
if ($numResultado == 0 || $numResultado >= 200) {
    $btnDeshabilitado = "disabled=''";
} else {
    $btnDeshabilitado = "";
}
if (!$ocultarPostulaciones) {
    ?>
    <div style="display: inline-block; float: left;">
        <form action="<?php echo $sitio . $this->controlador . 'realizar_busqueda'; ?>" method="post">
            <input type="text" style="display: none;" name="mostrarAdicional" value=1/>
            <input type="submit" value="Ver Postulaciones"/>
        </form>
    </div>
    <div style="display: inline-block; float: left; margin-left: 50px; text-align: left;">
        <input type="button" value="Busqueda Exhaustiva" <?php echo $btnDeshabilitado; ?> onclick="abrirVentana('<?php echo $sitio . "busqueda/exhaustiva"; ?>')"/>
        <input type="button" class="descargaCV" value="Descargar CV" <?php echo $btnDeshabilitado; ?>  data-url='<?php echo $sitio . "descargar_cv/cv"; ?>'/>
        <?php
        if ($btnDeshabilitado != "") {
            ?>
            <div class = "alerta-incorrecta-criterios">Botón deshabilitado al ser el resultado mayor a 200 datos o no existir datos</div>
            <?php
        }
        ?>
    </div>
    <?php
}
?>
<div id="listado"><br/>
    <?php echo $cabecera_listado; ?>
    <div class="scrollh">
        <?php
        if ($mostrar) {
            echo $mostrar;
        }
        ?>
    </div>
</div>