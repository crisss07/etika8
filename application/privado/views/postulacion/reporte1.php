<?php
$this->load->view('cabecera');
$this->load->view($this->carpeta . 'etapas');
?>
<?php
$sitio = $this->tool_entidad->sitioindexpri();
if ($sub_cabecera)
    $rowspan = ' rowspan="2"';
//print_r($campos_listar);
//print_r($datos);
if ($campos_listar) {
    $mostrar = '<table  align="center" class="tabla_listado" cellspacing="0" >';
    $mostrar .= '<tr class="cabecera_listado">';
    for ($i = 0; $i < count($campos_listar); $i++) {
        if (is_array($campos_listar[$i]))
            $mostrar .= '<td align="center" valign="middle" colspan="' . count($campos_listar[$i]['campos']) . '" >' . $campos_listar[$i]['nombre'] . '</td>';
        else
            $mostrar .= '<td align="center" valign="middle" ' . $rowspan . ' >' . $campos_listar[$i] . '</td>';
    }
//    $mostrar .= '<td align="center" valign="middle" ' . $rowspan . ' >Nº Postulaciones</td>';
    $mostrar .= '</tr>';
    $mostrar .= '<tr class="cabecera_listado">';
    for ($i = 0; $i < count($campos_listar); $i++) {
        if (is_array($campos_listar[$i])) {
            foreach ($campos_listar[$i]['campos'] as $cabecera) {
                $mostrar .= '<td align="center" valign="middle" >' . $cabecera . '</td>';
            }
        }
    }
    $mostrar .= '</tr>';
    if ($datos) {

        foreach ($datos as $indiceP => $fila) {
            if ($indiceP % 2 == 0) {
                $backgroundRows = "bgcolor='#e0e5e8'";
            } else {
                $backgroundRows = "";
            }
            $rowspan = '';
            if ($fila['nro'])
                $rowspan = ' ';
            $mostrar .= '<tr ' . $backgroundRows . '>';
//print_r($campos_reales);
            for ($i = 0; $i < count($campos_reales); $i++) {
//                echo $campos_reales[$i]['nombre']."<br>";
                if (is_array($campos_reales[$i])) {
                    if (@$fila[strtolower($campos_reales[$i]['nombre'])]) {

                        if ($campos_reales[$i]['nombre'] == 'educacion_postgrado' || $campos_reales[$i]['nombre'] == 'educacion_superior') {
                            $postgradoSuperior = $fila[strtolower($campos_reales[$i]['nombre'])];
                            $numero = count($postgradoSuperior);

                            if (is_array($postgradoSuperior)) {
                                $mostrar .= '<td align="center" valign="middle">' . $numero . '</td>';
                                for ($indice = 0; $indice < 2; $indice++) {

                                    if (array_key_exists($indice, $postgradoSuperior)) {
                                        $mostrar .= '<td align="center" valign="middle">' . $postgradoSuperior[$indice]["edu_grado"] . '</td>';
                                        $mostrar .= '<td align="center" valign="middle">' . $postgradoSuperior[$indice]["edu_area"] . '</td>';
                                    } else {
                                        $mostrar .= '<td align="center" valign="middle"> &nbsp;</td>';
                                        $mostrar .= '<td align="center" valign="middle"> &nbsp;</td>';
                                    }
                                }
                            }
                        } else {
                            foreach ($campos_reales[$i]['campos'] as $row) {
                                if ($fila[strtolower($campos_reales[$i]['nombre'])][0][$row]) {
                                    @$numColum += 1;
                                    if ($row == 'tra_funciones_org' || $row == 'tra_logros') {
                                        $mostrar .= '<td align="center" valign="middle"><p style="width:400px"></p>' . $fila[strtolower($campos_reales[$i]['nombre'])][0][$row] . '</td>';
                                    } else {
                                        $mostrar .= '<td align="center" valign="middle">' . $fila[strtolower($campos_reales[$i]['nombre'])][0][$row] . '</td>';
                                    }
                                } else {// $numColum += 1; error en safari ios
                                    @$numColum += 1;
                                    $mostrar .= '<td align="center" valign="middle"> &nbsp;</td>';
                                }
                            }
                        }
                    } elseif ($campos_reales[$i]['nombre'] == 'ultima' || $campos_reales[$i]['nombre'] == 'penultima' || $campos_reales[$i]['nombre'] == 'antepenultima') {
                        $postulaciones = $fila['postulaciones'][$campos_reales[$i]['nombre']];
                        foreach ($postulaciones as $key => $value) {
                            $mostrar .= '<td align="center" valign="middle">' . $value . ' &nbsp;</td>';
                        }
                    } else {
                        if ($campos_reales[$i]['nombre'] == 'educacion_postgrado' || $campos_reales[$i]['nombre'] == 'educacion_superior') {

                            $mostrar .= '<td align="center" valign="middle">0</td>';
                            $mostrar .= '<td align="center" valign="middle"> &nbsp;</td>';
                            $mostrar .= '<td align="center" valign="middle"> &nbsp;</td>';
                            $mostrar .= '<td align="center" valign="middle"> &nbsp;</td>';
                            $mostrar .= '<td align="center" valign="middle"> &nbsp;</td>';
                        } else {
                            foreach ($campos_reales[$i]['campos'] as $row) {
                                $mostrar .= '<td align="center" valign="middle"> &nbsp;</td>';
                            }
                        }
                    }
                } else {
                    $mostrar .= '<td align="center" valign="middle" ' . $rowspan . ' >' . $fila[strtolower($campos_reales[$i])] . '</td>';
                }
            }
            $mostrar .= '</tr>';
//            para mostra trayectoria laboral
if(@$datos[$indiceP]["trayectoria"]){
            $numTrayactoria = count($datos[$indiceP]["trayectoria"]);
            if ($numTrayactoria > 1) {
                for ($indCol = 1; $indCol < $numTrayactoria; $indCol++) {
                    $mostrar .= '<tr ' . $backgroundRows . '>';
                    for ($i = 0; $i < count($campos_reales); $i++) {
                        if (is_array($campos_reales[$i])) {
                            if ($campos_reales[$i]["nombre"] == "trayectoria") {
                                if ($indCol > 0) {
                                    foreach ($campos_reales[$i]['campos'] as $keyCamTra => $valueCamTra) {
                                        $mostrar .= '<td align="center" valign="middle">' . $datos[$indiceP]["trayectoria"][$indCol][$valueCamTra] . ' </td>';
                                    }
                                }
                            } elseif ($campos_reales[$i]["nombre"] == "educacion_postgrado" || $campos_reales[$i]["nombre"] == "educacion_superior") {
                                $mostrar .= '<td align="center" valign="middle">&nbsp;</td>';
                                $mostrar .= '<td align="center" valign="middle">&nbsp;</td>';
                                $mostrar .= '<td align="center" valign="middle">&nbsp;</td>';
                                $mostrar .= '<td align="center" valign="middle">&nbsp;</td>';
                                $mostrar .= '<td align="center" valign="middle">&nbsp;</td>';
                            } else {

                                foreach ($campos_reales[$i]["campos"] as $key2 => $value2) {

                                    $mostrar .= '<td align="center" valign="middle">&nbsp;</td>';
                                }
                            }
                        } else {
                            $mostrar .= '<td align="center" valign="middle">&nbsp;</td>';
                        }
                    }
                    $mostrar .= '</tr>';
                }
            }
		}
        }
    }
    $mostrar .= '</table>';
}
?>
<form action="<?php echo $sitio . $this->controlador . 'excel'; ?>" method="post" id="form_listar_fsimple">
    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
    <input type="hidden" name="campos_listar" value="<?php echo base64_encode(serialize($campos_listar)); ?>"/>
    <input type="hidden" name="campos_reales" value="<?php echo base64_encode(serialize($campos_reales)); ?>"/>
    <input type="hidden" name="datos" value="<?php echo base64_encode(serialize($datos)); ?>"/>
    <input type="hidden" name="sub_cabecera" value="<?php echo $sub_cabecera; ?>"/>
    <table align="center" width="100%" border="0">
        <tr>
            <td class="enlaces_add_edit" align="left" width="150" >
                <?php echo anchor($this->controlador . 'etapas/id/' . $id, 'Cancelar', array('class' => 'enlace_cancelar enlace_a1')); ?>
            </td>
            <td class="enlaces_add_edit" align="left" width="200">
                <?php echo anchor($this->controlador . 'excel_new/id/' . $id, 'Exportar Tabla Basica', array('class' => 'enlace_exportar enlace_a1')); ?>                
            </td>
            <td class="enlaces_add_edit" align="left">
                <input name="enviar" class="enlace_exportar" type="submit" value="Exportar Tabla Completa">
            </td>
        </tr>
    </table>
</form>
<?php
$alineacionwc1 = 'left';
$alineacionhc1 = 'middle';
$alineacionwc2 = 'left';
$alineacionhc2 = 'middle';
$prefijo = $this->prefijo;
?>

<div id="listado"><br/>
    <div class="scrollh">
        <?php
        if ($mostrar) {
            echo $mostrar;
        }
        ?>
    </div>
</div>