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
header("content-disposition: attachment;filename=".$archivo."(".date('Y-m-d').").xls");

if($campos_listar) {
    $mostrar='<table border="1" align="center" cellpadding="1" cellspacing="1">';
    $mostrar.='<tr><td align="center" colspan="'.(count($campos_listar) + 1).'"><font style="font-size: 20px; font-weight: bold;">'.$titulo.'</font></td></tr>';
    $mostrar.='<tr>';
    $mostrar.='<th align="center" valign="middle" ><font style="font-size: 18px; font-weight: bold;">Nº</font></th>';
    for($i=0;$i<count($campos_listar);$i++) {
        if(is_array($campos_listar[$i]))
            $mostrar.='<th align="center" valign="middle" colspan="'.count($campos_listar[$i]['campos']).'" ><font style="font-size: 18px; font-weight: bold;">'.$campos_listar[$i]['nombre'].'</font></th>';
        else
            $mostrar.='<th align="center" valign="middle" ><font style="font-size: 18px; font-weight: bold;">'.$campos_listar[$i].'</font></th>';
    }    
    $mostrar.='</tr>';    
    if($datos) {        
        foreach ($datos as $num=>$fila) {            
            $mostrar.='<tr>';
            $mostrar.='<td align="center" valign="top">'.($num+1).'</td>';
            for($i=0;$i<count($campos_reales);$i++) {               
                if ($campos_reales[$i] == "pof_recomendacion") {
                    $mostrar .= '<td align="center" valign="top">'.$this->recomendaciones[$fila[strtolower($campos_reales[$i])]].'</td>';
                } else {
                    $mostrar .= '<td align="center" valign="top">' . $fila[strtolower($campos_reales[$i])] . '</td>';
                }             
            }            
            $mostrar.='</tr>';                      
        }
    }
    $mostrar.='</table>';
}
?>
<HTML LANG="es">
<head>
    <TITLE><?php echo $titulo; ?></TITLE>
	<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
</head>
<body>
    <?php echo $mostrar;?>    
</body>
</html>
