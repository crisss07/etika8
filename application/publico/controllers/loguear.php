<?php

$ubicacion = json_decode(file_get_contents("php://input"));
$mensaje = "Timestamp: " . $ubicacion->timestamp . PHP_EOL;
$mensaje .= "Latitud: " . $ubicacion->coordenadas->latitud . PHP_EOL;
$mensaje .= "Longitud: " . $ubicacion->coordenadas->longitud . PHP_EOL . PHP_EOL;
file_put_contents("ubicaciones.txt", $mensaje, FILE_APPEND);
