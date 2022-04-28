<html>
    <head>
        <title>Area Restringida - Sistema de Postulación</title>
        <style type="text/css">
            body{text-align:center;}

        </style>
    </head>
    <body>
        <div id="contenedor">
            <h1>FORMULARIO DE DATOS PERSONALES Y LABORALES</h1>
            <table border="0" cellpadding="5" width="100%">
                <tr>
                    <td align="left">
                        <b style="font-size: 14px;">I.	DATOS PERSONALES</b>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                            <tr>
                                <td align="left" colspan="2">
                                    Documento: <b><?php echo $datos_personales['pos_documento'];?></b>
                                </td>
                                <td align="left">
                                    Tipo Documento: <b><?php if($datos_personales['pos_tipodoc']==1){echo 'C.I.';}else{echo 'Pasaporte';}?></b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="left">
                                    Apellidos: <b><?php echo $datos_personales['pos_apaterno'].' '.$datos_personales['pos_amaterno'];?></b>
                                </td>
                                <td align="left">
                                    Nombres: <b><?php echo $datos_personales['pos_nombre'];?></b>
                                </td>
                            </tr>
                            <tr>
                                <td align="left">
                                    Fecha Nacimiento (día, mes y año): <b><?php echo $datos_personales['pos_fecha_nacimiento'];?></b>
                                </td>
                                <td align="left">
                                    Edad: <b><?php echo $datos_personales['anios'];?></b>
                                </td>
                                <td align="left">
                                    Sexo: <b><?php if($datos_personales['pos_sexo']==1){echo 'Hombre';}else{echo 'Mujer';}?></b>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" colspan="2">
                                    Nacionalidad: <b><?php echo $datos_personales['pos_nacionalidad'];?></b>
                                </td>
                                <td align="left">
                                    País: <b><?php echo $datos_personales['pos_pais_otro'];?></b>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" colspan="2">
                                    Dirección: <b><?php echo $datos_personales['pos_direccion'];?></b>
                                </td>
                                <td align="left">
                                    Ciudad o Localidad: <b><?php echo $datos_personales['pos_ciudad'];?></b>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" colspan="2">
                                    Teléfono / Celular: <b><?php echo $datos_personales['pos_telefono'].' '.$datos_personales['pos_celular'] ;?></b>
                                </td>
                                <td align="left">
                                    E-mail: <b><?php echo $datos_personales['pos_email'];?></b>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" >
                                    ¿Disponibilidad de trasladarse a otra ciudad?
                                </td>
                                <td align="center" >
                                    <b><?php if($datos_personales['pos_traslado']==1){echo 'Si';}else{echo 'No';}?></b>
                                </td>
                                <td align="left">
                                    <?php if($datos_personales['pos_traslado']==1){ echo 'Ciudad de Traslado: <b>'.$datos_personales['pos_traslado_lugar'].'</b>';}?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table border="0" cellpadding="5" width="100%">
                <tr>
                    <td align="left">
                        <b style="font-size: 14px;">II.	INSTRUCCIÓN FORMAL</b>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td align="left">
                                    <b style="font-size: 14px;">Educación de Post Grado</b>
                                </td>
                            </tr>
                        </table>
                        <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                            <tr align="center">
                                <td><b>Desde<br/>(Año-Mes)</b></td>
                                <td><b>Hasta<br/>(Año-Mes)</b></td>
                                <td><b>Institución</b></td>
                                <td><b>País</b></td>
                                <td><b>Grado o Titulo</b></td>
                                <td><b>Área de<br/>Post Grado</b></td>
                                <td><b>Tema de Tesis</b></td>
                                <td><b>Nota<br/>Tesis</b></td>
                                <td><b>Titulado<br/>(si/no)</b></td>
                            </tr>
                            <?php if($educacion_post_grado){ ?>
                                <?php foreach ($educacion_post_grado as $fila){ ?>
                            <tr align="center">
                                <td><?php echo $fila['edu_desde'];?></td>
                                <td><?php echo $fila['edu_hasta'];?></td>
                                <td><?php echo $fila['edu_institucion'];?></td>
                                <td><?php echo $fila['edu_pais'];?></td>
                                <td><?php echo $this->grados[$fila['edu_grado']];?></td>
                                <td><?php echo $fila['edu_area'];?></td>
                                <td><?php echo $fila['edu_tema'];?></td>
                                <td><?php if($fila['edu_nota']){echo $fila['edu_nota'];}?></td>
                                <td><?php if($fila['edu_titulado']){ echo 'Si';}else{ echo 'No';}?></td>
                            </tr>
                                <?php }?>
                            <?php }?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td align="left">
                                    <b style="font-size: 14px;">Educación Superior</b>
                                </td>
                            </tr>
                        </table>
                        <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                            <tr align="center">
                                <td><b>Desde<br/>(Año)</b></td>
                                <td><b>Hasta<br/>(Año)</b></td>
                                <td><b>Institución</b></td>
                                <td><b>País</b></td>
                                <td><b>Grado o Titulo</b></td>
                                <td><b>Profesión</b></td>
                                <td><b>Tema de Tesis</b></td>
                                <td><b>Nota<br/>Tesis</b></td>
                                <td><b>Titulado<br/>(si/no)</b></td>
                            </tr>
                            <?php if($educacion_superior){ ?>
                                <?php foreach ($educacion_superior as $fila){ ?>
                            <tr align="center">
                                <td><?php echo $fila['edu_desde'];?></td>
                                <td><?php echo $fila['edu_hasta'];?></td>
                                <td><?php echo $fila['edu_institucion'];?></td>
                                <td><?php echo $fila['edu_pais'];?></td>
                                <td><?php echo $this->grados_sup[$fila['edu_grado']];?></td>
                                <td><?php echo $this->profesiones[$fila['edu_area']];?></td>
                                <td><?php echo $fila['edu_tema'];?></td>
                                <td><?php if($fila['edu_nota']){echo $fila['edu_nota'];}?></td>
                                <td><?php if($fila['edu_titulado']){ echo 'Si';}else{ echo 'No';}?></td>
                            </tr>
                                <?php }?>
                            <?php }?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td align="left">
                                    <b style="font-size: 14px;">Educación Secundaria</b>
                                </td>
                            </tr>
                        </table>
                        <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                            <tr align="center">
                                <td><b>Desde (Año)</b></td>
                                <td><b>Hasta (Año)</b></td>
                                <td><b>Institución</b></td>
                                <td><b>País</b></td>
                            </tr>
                            <?php if($educacion_secundaria){ ?>
                                <?php foreach ($educacion_secundaria as $fila){ ?>
                            <tr align="center">
                                <td><?php echo $fila['edu_desde'];?></td>
                                <td><?php echo $fila['edu_hasta'];?></td>
                                <td><?php echo $fila['edu_institucion'];?></td>
                                <td><?php echo $fila['edu_pais'];?></td>
                            </tr>
                                <?php }?>
                            <?php }?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td align="left">
                                    <b style="font-size: 14px;">Publicaciones</b>
                                </td>
                            </tr>
                        </table>
                        <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                            <tr align="center">
                                <td><b>Titulo</b></td>
                                <td><b>Año</b></td>
                            </tr>
                            <?php if($publicaciones){ ?>
                                <?php foreach ($publicaciones as $fila){ ?>
                            <tr align="center">
                                <td><?php echo $fila['pub_titulo'];?></td>
                                <td><?php echo $fila['pub_anio'];?></td>
                            </tr>
                                <?php }?>
                            <?php }?>
                        </table>
                    </td>
                </tr>
            </table>
            <table border="0" cellpadding="5" width="100%">
                <tr>
                    <td align="left">
                        <b style="font-size: 14px;">III.	TRAYECTORIA LABORAL</b>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td align="left">
                                    <b style="font-size: 14px;">Síntesis de Experiencia Laboral</b>
                                </td>
                            </tr>
                        </table>
                        <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                            <tr>
                                <td align="left">
                                    Ambito en el que clasificaría su experiencia:
                                </td>
                                <td align="left">
                                    <?php
                                    $ambitos = explode(',', $datos_personales['pos_ambito_exp']);
                                    foreach ($ambitos as $ambito){
                                        switch ($ambito){
                                            case "1":
                                                echo '<b> Empresa Privada </b><br/>';
                                                break;
                                            case "2":
                                                echo '<b> Empresa Publica </b><br/>';
                                                break;
                                            case "3":
                                                echo '<b> Cooperación para el Desarrollo </b><br/>';
                                                break;
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="left">
                                    Área de experiencia que usted resaltaría:
                                </td>
                                <td align="left">
                                    <b><?php echo $this->area_experiencia[$datos_personales['pos_area_exp']];?></b>
                                </td>
                            </tr>
                            <tr>
                                <td align="left">
                                    Sector de experiencia que usted resaltaría:
                                </td>
                                <td align="left">
                                    <b><?php echo $this->sector_experiencia[$datos_personales['pos_sector_exp']];?></b>
                                </td>
                            </tr>
                            <tr>
                                <td align="left">
                                    Experiencia en supervisión
                                </td>
                                <td align="left">
                                    <b><?php echo ucfirst($datos_personales['pos_supervisar_exp']);?></b>
                                </td>
                            </tr>
                            <?php if($datos_personales['pos_supervisar_exp']=='si'){ ?>
                            <tr>
                                <td align="left">
                                    Experiencia en supervisión: <b><?php echo $this->nivel_alcanzado[$datos_personales['pos_max_nivel']];?></b>
                                </td>
                                <td align="left">
                                    Años de experiencia en supervisión:  <b><?php echo $datos_personales['pos_anios_exp'];?></b>
                                </td>
                            </tr>
                            <?php }?>
                        </table>
                        <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td align="left">
                                    <b style="font-size: 14px;">Experiencia Laboral</b>
                                </td>
                            </tr>
                        </table>
                        <?php echo $mostrar; ?>
                    </td>
                </tr>
            </table>
            <table border="0" cellpadding="5" width="100%">
                <tr>
                    <td align="left">
                        <b style="font-size: 14px;">IV.	INFORMACION ADICIONAL</b>
                    </td>
                </tr>
                <?php if($idiomas){ $x=1; ?>
                    <?php foreach ($idiomas as $fila){ ?>
                <tr>
                    <td align="center">
                        <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td align="left">
                                    <div style="font-size: 14px;">Idioma <?php echo $x.': <b>'.$fila['idi_idioma'].'</b>';?></div>
                                </td>
                            </tr>
                        </table>
                        <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                            <tr align="center">
                                <th> &nbsp; </th>
                                <th>Exelente</th>
                                <th>Muy Bueno</th>
                                <th>Regular</th>
                                <th>Basico</th>
                            </tr>
                            <tr align="center">
                                <td><b>Habla</b></td>
                                <?php if($fila['idi_habla']==1){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                                <?php if($fila['idi_habla']==2){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                                <?php if($fila['idi_habla']==3){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                                <?php if($fila['idi_habla']==4){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                            </tr>
                            <tr align="center">
                                <td><b>Lee</b></td>
                                <?php if($fila['idi_lee']==1){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                                <?php if($fila['idi_lee']==2){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                                <?php if($fila['idi_lee']==3){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                                <?php if($fila['idi_lee']==4){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                            </tr>
                            <tr align="center">
                                <td><b>Escribe</b></td>
                                <?php if($fila['idi_escribe']==1){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                                <?php if($fila['idi_escribe']==2){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                                <?php if($fila['idi_escribe']==3){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                                <?php if($fila['idi_escribe']==4){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                            </tr>
                        </table>
                    </td>
                </tr>
                    <?php }?>
                <?php }?>
                <tr>
                    <td align="center">
                        <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td align="center">
                                    <div style="font-size: 14px;">Fecha de Inscripción(Día-Mes-Año): <b><?php echo $datos_personales['pos_fecha_creacion'];?></b></div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>


