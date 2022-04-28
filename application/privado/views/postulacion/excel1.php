<?php
//Exportar datos de php a Excel
//header("Content-Type: application/vnd.ms-excel");
//header("Expires: 0");
//header("Content-type: application/x-msdownload");
//header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//header("content-disposition: attachment ; filename = reporte.xls");

header("Cache-Control:  max-age=1");
header("Pragma: public");
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=" . $archivo . "(" . date('Y-m-d') . ").xls");

if ($sub_cabecera)
    $rowspan = ' rowspan="2"';
if ($campos_listar) {
    $mostrar = '<table border="1" align="center" cellpadding="1" cellspacing="1">';
    $mostrar .= '<tr><td align="center" colspan="' . count($campos_listar) . '"><font style="font-size: 20px; font-weight: bold;">' . $titulo . '</font></td></tr>';
    $mostrar .= '<tr>';
    for ($i = 0; $i < count($campos_listar); $i++) {
        if (is_array($campos_listar[$i]))
            $mostrar .= '<th align="center" valign="bottom" colspan="' . count($campos_listar[$i]['campos']) . '" ><font style="font-size: 18px; font-weight: bold;">' . $campos_listar[$i]['nombre'] . '</font></th>';
        else
            $mostrar .= '<th align="center" valign="bottom" ' . $rowspan . ' ><font style="font-size: 18px; font-weight: bold;">' . $campos_listar[$i] . '</font></th>';
    }
//    $mostrar .= '<th align="center" valign="bottom" ' . $rowspan . ' ><font style="font-size: 18px; font-weight: bold;">Nº Postulaciones</font></th>';
    $mostrar .= '</tr>';
    $mostrar .= '<tr>';
    for ($i = 0; $i < count($campos_listar); $i++) {
        if (is_array($campos_listar[$i])) {
            foreach ($campos_listar[$i]['campos'] as $cabecera) {
                $mostrar .= '<th align="center" valign="bottom" ><font style="font-size: 18px; font-weight: bold;">' . $cabecera . '</font></td>';
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
            $mostrar .= '<tr>';
            for ($i = 0; $i < count($campos_reales); $i++) {
                if (is_array($campos_reales[$i])) {
                    if (@$fila[strtolower($campos_reales[$i]['nombre'])]) {

                        if ($campos_reales[$i]['nombre'] == 'educacion_postgrado' || $campos_reales[$i]['nombre'] == 'educacion_superior') {
                            $postgradoSuperior = $fila[strtolower($campos_reales[$i]['nombre'])];
                            $numero = count($postgradoSuperior);

                            if (is_array($postgradoSuperior)) {
                                $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle">' . $numero . '</td>';
                                for ($indice = 0; $indice < 2; $indice++) {

                                    if (array_key_exists($indice, $postgradoSuperior)) {
                                        $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle">' . $postgradoSuperior[$indice]["edu_grado"] . '</td>';
                                        $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle">' . $postgradoSuperior[$indice]["edu_area"] . '</td>';
                                    } else {
                                        $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle"> &nbsp;</td>';
                                        $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle"> &nbsp;</td>';
                                    }
                                }
                            }
                        } else {
                            foreach ($campos_reales[$i]['campos'] as $row) {
                                if ($fila[strtolower($campos_reales[$i]['nombre'])][0][$row]) {
                                    $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle">' . $fila[strtolower($campos_reales[$i]['nombre'])][0][$row] . '</td>';
                                } else {
                                    $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle"> &nbsp;</td>';
                                }
                            }
                        }
                    } elseif ($campos_reales[$i]['nombre'] == 'ultima' || $campos_reales[$i]['nombre'] == 'penultima' || $campos_reales[$i]['nombre'] == 'antepenultima') {
//                        print_r($fila);
                        $postulaciones = $fila['postulaciones'][$campos_reales[$i]['nombre']];
                        foreach ($postulaciones as $key => $value) {
                            $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle">' . $value . ' &nbsp;</td>';
                        }
                    } else {
                        if ($campos_reales[$i]['nombre'] == 'educacion_postgrado' || $campos_reales[$i]['nombre'] == 'educacion_superior') {
                            $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle">0</td>';
                            $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle"> &nbsp;</td>';
                            $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle"> &nbsp;</td>';
                            $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle"> &nbsp;</td>';
                            $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle"> &nbsp;</td>';
                        } else {
                            foreach ($campos_reales[$i]['campos'] as $row) {

                                $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle"> &nbsp;</td>';
                            }
                        }
                    }
                } else {
                    $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle" ' . $rowspan . ' >' . $fila[strtolower($campos_reales[$i])] . '</td>';
                }
            }
//            $mostrar.='<td ' . $backgroundRows . '  align="center" valign="top" '.$rowspan.' >'.$fila['pos_nro_postulaciones'].'</td>';
            $mostrar .= '</tr>';
            @$numTrayactoria = count($datos[$indiceP]["trayectoria"]);
            if ($numTrayactoria > 1) {
                for ($indCol = 1; $indCol < $numTrayactoria; $indCol++) {
                    $mostrar .= '<tr>';
                    for ($i = 0; $i < count($campos_reales); $i++) {
                        if (is_array($campos_reales[$i])) {
                            if ($campos_reales[$i]["nombre"] == "trayectoria") {
                                if ($indCol > 0) {
                                    foreach ($campos_reales[$i]['campos'] as $keyCamTra => $valueCamTra) {
                                        $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle">' . $datos[$indiceP]["trayectoria"][$indCol][$valueCamTra] . ' </td>';
                                    }
                                }
                            } elseif ($campos_reales[$i]["nombre"] == "educacion_postgrado" || $campos_reales[$i]["nombre"] == "educacion_superior") {
                                $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle">&nbsp;</td>';
                                $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle">&nbsp;</td>';
                                $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle">&nbsp;</td>';
                                $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle">&nbsp;</td>';
                                $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle">&nbsp;</td>';
                            } else {
                                foreach ($campos_reales[$i]["campos"] as $key2 => $value2) {

                                    $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle">&nbsp;</td>';
                                }
                            }
                        } else {
                            $mostrar .= '<td ' . $backgroundRows . '  align="center" valign="middle">&nbsp;</td>';
                        }
                    }
                    $mostrar .= '</tr>';
                }
            }
        }
    }
    $mostrar .= '</table>';
}
?>
<HTML LANG="es">
<head>
    <TITLE><?php echo $titulo; ?></TITLE>
	<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
</head>
<body>
    <?php echo $mostrar; ?>    
</body>
</html>
