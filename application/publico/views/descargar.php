<?php
$extension=strtolower(substr($archivo,-4));
//var_dump($archivo); var_dump($ruta); exit();
switch ($extension) {

    case ".pdf":$fig="pdf";
        break;
    case ".doc":$fig="word";
        break;
    case ".xsl":$fig="excel";
        break;
    case ".zip":$fig="zip";
        break;
    case ".ppt":$fig="ppt";
        break;
    case ".txt":$fig="txt";
        break;
    case ".rar":$fig="rar";
        break;
    case ".swf":$fig="swf";
        break;
    case ".mp3":$fig="mp3";
        break;

    //return $fig;
}
if($fig) {
    $root = $ruta;    
    $file = $archivo;
    $path = $root.$file;    
    $type = '';
    if (is_file($path)) {
        $size = filesize($path);
        if (function_exists('mime_content_type')) {
            $type = mime_content_type($path);
        } else if (function_exists('finfo_file')) {
            $info = finfo_open(FILEINFO_MIME);
            $type = finfo_file($info, $path);
            finfo_close($info);
        }
        if ($type == '') {
            $type = "application/force-download";
        }
        // Set Headers
        header("Content-Type: $type");
        header("Content-Disposition: attachment; filename=$file");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: " . $size);
        // Download File
        readfile($path);
    } else {
        die("Archivo no existe !!");
    }
    //$ruta1=$ruta;
    //var_dump($ruta.$archivo);
    //$ruta='fconstruir/archivos/documento/';
    //$ruta='/archivos/documento/';
    //$ruta=$ruta.$archivo;
    //var_dump($ruta); exit();
    /*header ('Content-Disposition: attachment; filename="'.$archivo.'"');
    header ("Content-Type: application/octet-stream");
    header ("Content-Length: ".filesize($ruta));    
    readfile($ruta);*/
}
/*
$enlace = "archivos/".$f;
header ("Content-Disposition: attachment; filename=".$f." ");
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);*/
?>
