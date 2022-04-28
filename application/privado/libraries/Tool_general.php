<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tool_general {

    function crear_thumbnail($nom_imagen, $nom_new_imagen, $ancho, $alto, $ruta_origen, $ruta_destino, $escalar) {
        $ext_imagen = substr($nom_imagen, -4);

        if (($ext_imagen == '.jpg') || ($ext_imagen == '.JPG')) {
            $fuente = @imagecreatefromjpeg($ruta_origen . $nom_imagen);
        }
        if (($ext_imagen == '.gif') || ($ext_imagen == '.GIF')) {
            $fuente = @imagecreatefromgif($ruta_origen . $nom_imagen);
        }
        if (($ext_imagen == '.png') || ($ext_imagen == '.PNG')) {
            $fuente = @imagecreatefrompng($ruta_origen . $nom_imagen);
        }

        $imgAncho = @imagesx($fuente);
        $imgAlto = @imagesy($fuente);

        if ($escalar) {
            if ($alto) {
                if ($imgAlto < $alto) {
                    $alto = $imgAlto;
                    $ancho = (int) (($imgAncho * $alto) / $imgAlto);
                }
            } else {
                $alto = (int) (($imgAlto * $ancho) / $imgAncho);
            }
            if ($ancho) {
                if ($imgAncho < $ancho) {
                    $ancho = $imgAncho;
                    $alto = (int) (($imgAlto * $ancho) / $imgAncho);
                }
            } else {
                $ancho = (int) (($imgAncho * $alto) / $imgAlto);
            }
        } else {
            if ($ancho) {
                if (!$alto)
                    $alto = (int) (($imgAlto * $ancho) / $imgAncho);
            }
            if ($alto) {
                if (!$ancho)
                    $ancho = (int) (($imgAncho * $alto) / $imgAlto);
            }
        }


        $imagen = @imagecreatetruecolor($ancho, $alto);
        @ImageCopyResized($imagen, $fuente, 0, 0, 0, 0, $ancho, $alto, $imgAncho, $imgAlto);
        if (!$ruta_destino) {
            $ruta_destino = $ruta_origen;
        }
        if (($ext_imagen == '.jpg') || ($ext_imagen == '.JPG')) {
            //Header("Content-type: image/jpeg");
            @imageJpeg($imagen, $ruta_destino . $nom_new_imagen);
        }
        if (($ext_imagen == '.gif') || ($ext_imagen == '.GIF')) {
            //Header("Content-type: image/gif");
            @imageGif($imagen, $ruta_destino . $nom_new_imagen);
        }
        if (($ext_imagen == '.png') || ($ext_imagen == '.PNG')) {
            //Header("Content-type: image/png");
            @imagePng($imagen, $ruta_destino . $nom_new_imagen);
        }
        return true;
    }

    function tipofig_tipo($tipo) {
        switch ($tipo) {
            case "application/pdf": $fig = "pdf";
                break;
            case "application/msword":$fig = "word";
                break;
            case "application/vnd.ms-excel":$fig = "excel";
                break;
            case "application/x-zip-compressed":$fig = "zip";
                break;
            case "application/vnd.ms-powerpoint":$fig = "ppt";
                break;
            case "text/plain":$fig = "txt";
                break;
            case "application/octet-stream":$fig = "rar";
                break;
            case "application/x-shockwave-flash":$fig = "swf";
                break;
            case "audio/mpeg":$fig = "mp3";
                break;
        }
        return $fig;
    }

    function tipofig_extension($tipo) {
        switch ($tipo) {
            case ".pdf":$fig = "pdf";
                break;
            case ".doc":$fig = "word";
                break;
			 case "docx":$fig = "word";
                break;
            case ".xsl":$fig = "excel";
                break;
            case ".zip":$fig = "zip";
                break;
            case ".ppt":$fig = "ppt";
                break;
            case ".txt":$fig = "txt";
                break;
            case ".rar":$fig = "rar";
                break;
            case ".swf":$fig = "swf";
                break;
            case ".mp3":$fig = "mp3";
                break;
            case ".flv":$fig = "flv";
                break;
        }
        return $fig;
    }

    //********************************//
    function find_in_array($e, $arr) {
        $i = 0;
        $encontrado = 0;
        //var_dump($e); var_dump($arr);
		if($arr){
			while (($i < count($arr)) && ($encontrado == 0)) {
				if ($e == $arr[$i])
					$encontrado = 1;
				$i++;
			}
		}
        // var_dump($encontrado);
        // exit ();
        if ($encontrado)
            return 1;
        else
            return 0;
    }

    function limpiar_cadena($cadena) {
        /*
          $archivo = trim($archivo);
          $remuevo = array( "([^a-zA-Z0-9-.])", "(-{2,})" );
          $remplazo = array("_","");
          $nuevo_nombre = preg_replace($remuevo, $remplazo, $archivo);
          return $nuevo_nombre;
         *
         */
        $tofind = "Ã?Ã?Ã?Ã?Ã?Ã?Ã Ã¡Ã¢Ã£Ã¤Ã¥Ã?Ã?Ã?Ã?Ã?Ã?Ã²Ã³Ã´ÃµÃ¶Ã¸Ã?Ã?Ã?Ã?Ã¨Ã©ÃªÃ«Ã?Ã§Ã?Ã?Ã?Ã?Ã¬Ã­Ã®Ã¯Ã?Ã?Ã?Ã?Ã¹ÃºÃ»Ã¼Ã¿Ã?Ã± ";
        $replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn_";
        $cadena_sin_acentos = strtr($cadena, $tofind, $replac);

        /* para borrar todos los demas caracteres que no sean alfanumericos o _. */
        $cadena = preg_replace('/[^a-zA-Z0-9_.]/', '', $cadena_sin_acentos);
        return $cadena;
    }

    function limpiar_acentos($cadena) {
        $cadena = trim($cadena);

        $cadena = str_replace(
                array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $cadena
        );

        $cadena = str_replace(
                array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $cadena
        );

        $cadena = str_replace(
                array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $cadena
        );

        $cadena = str_replace(
                array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $cadena
        );

        $cadena = str_replace(
                array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $cadena
        );

        $cadena = str_replace(
                array('ñ', 'Ñ', 'ç', 'Ç'), array('n', 'N', 'c', 'C',), $cadena
        );

        //Esta parte se encarga de eliminar cualquier caracter extraño
        $cadena = str_replace(
                array("\\", "¨", "º", "-", "~",
            "#", "@", "|", "!", "\"",
            "·", "$", "%", "&", "/",
            "(", ")", "?", "'", "¡",
            "¿", "[", "^", "`", "]",
            "+", "}", "{", "¨", "´",
            ">", "<", ";", ",", ":",
            "."), '', $cadena
        );
        return $cadena;
    }
}

?>
