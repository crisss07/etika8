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
<HTML lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<TITLE><?php echo $titulo; ?></TITLE>
</head>
<body>
    <table border="1" align="center" cellpadding="1" cellspacing="1">
        <tr>
            <td align="center"><font style="font-size: 20px; font-weight: bold;"><?php echo $titulo;?></font></td>
        </tr>        
        <tr>
            <td align="left"><?php echo $cabecera_listado;?></td>
        </tr>                   
        <tr>            
            <td align="center" valign="top"><?php echo $contenido;?></td>
        </tr>                   
    </table>
</body>
</html>
