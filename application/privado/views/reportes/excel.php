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
?>
<HTML LANG="es">
<TITLE><?php echo $titulo; ?></TITLE>
</head>
<body>
    <table border="1" align="center" cellpadding="1" cellspacing="1">
        <tr>
            <td align="center" colspan="<?php echo count($campos_listar);?>"><font style="font-size: 20px; font-weight: bold;"><?php echo $titulo;?></font></td>
        </tr>
        <?php if($cabecera_listado){?>
        <tr>
            <td align="left" colspan="<?php echo count($campos_listar);?>"><?php echo $cabecera_listado;?></td>
        </tr>
        <?php }?>
        <tr>
        <?php for($i=0;$i<count($campos_listar);$i++) { ?>
            <th align="center" valign="middle"><font style="font-size: 18px; font-weight: bold;"><?php echo $campos_listar[$i];?></font></th>
        <?php } ?>
        </tr>        
            <?php
            foreach ($datos as $fila) {
            ?>
        <tr>
            <?php
                for($i=0;$i<count($campos_reales);$i++) {
            ?>
            <td align="center" valign="top"><?php echo $fila[strtolower($campos_reales[$i])];?></td>
            <?php
                }
            ?>
        </tr>
            <?php
            }
            ?>        
    </table>
</body>
</html>
