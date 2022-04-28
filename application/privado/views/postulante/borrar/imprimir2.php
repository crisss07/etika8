<html>
    <head>
        <title>Area Restringida - Sistema de Postulaci�n</title>
        <style type="text/css"> 
            @font-face {
                font-family: 'helvetica'; /* Nombre que va a tener esa font.*/
                font-style: normal;
                font-weight: normal;
                src: local('helvetica'), url('../../libraries/fonts/helvetica/HelveticaNeueLTStd Lt.otf') format('truetype');
            }
            body{text-align:center;} #contenedor{ width: 750px; margin: 0px auto;font-family:'helvetica',arial;}
        </style>        
    </head>
    <body>        
        <div id="contenedor">            
            <table border="0" cellpadding="5" cellspacing="0" width="750">
                <tr>
                    <td align="center"><img alt="ETIKA" style="width: 50px;" title="ETIKA" src="http://www.etika.net.bo/files/img/logo_etika.jpg" /></td>
                </tr>
                <tr>                    
                    <td align="center"><h1>FORMULARIO DE <br/>DATOS PERSONALES Y LABORALES </h1></td>
                </tr>
            </table>
            <table border="0" cellpadding="5" width="100%">
                <tr>
                    <td align="left">
                        <b>Pretensi�n Salarial Referencial (en Bs.): </b> <?php echo $datos_personales['pof_salario']; ?>                       
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <h2>I.	DATOS PERSONALES</h2>                        
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                            <tr>
                                <td align="left" colspan="2">
                                    <b>Documento: </b><?php echo $datos_personales['pos_documento']; ?>
                                </td>
                                <td align="left">
                                    <b>Tipo Documento: </b><?php
                                    if ($datos_personales['pos_tipodoc'] == 1 || $datos_personales['pos_tipodoc'] == 3) {
                                        echo 'C.I.';
                                    } elseif ($datos_personales['pos_tipodoc'] == 2) {
                                        echo 'Pasaporte';
                                    }
                                    ?>
                                </td>                                
                            </tr>
                            <tr>
                                <td colspan="2" align="left">
                                    <b>Apellidos: </b><?php echo $datos_personales['pos_apaterno'] . ' ' . $datos_personales['pos_amaterno']; ?>
                                </td>
                                <td align="left">
                                    <b>Nombres: </b><?php echo $datos_personales['pos_nombre']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <b>Fecha Nacimiento (d�a, mes y a�o): </b><?php echo $datos_personales['pof_fecha_nacimiento']; ?>
                                </td>
                                <td align="left">
                                    <b>Edad: </b><?php echo $datos_personales['anios']; ?>
                                </td>
                                <td align="left">
                                    <b>G�nero: </b><?php
                                    if ($datos_personales['pof_sexo'] == 1 || $datos_personales['pof_sexo'] == 0) {
                                        echo 'Masculino';
                                    } elseif ($datos_personales['pof_sexo'] == 2) {
                                        echo 'Femenino';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" colspan="2">
                                    <b>Nacionalidad: </b><?php echo $datos_personales['pos_nacionalidad']; ?>
                                </td>
                                <td align="left">
                                    <b>Pa�s: </b><?php echo $datos_personales['pais']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" colspan="2">
                                    <b>Direcci�n: </b><?php echo $datos_personales['pos_direccion']; ?>
                                </td>
                                <td align="left">
                                    <b>Ciudad o Localidad: </b><?php echo $datos_personales['ciudad']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" colspan="2">
                                    <b>Tel�fono / Celular: </b><?php echo $datos_personales['pos_telefono'] . ' ' . $datos_personales['pos_celular']; ?>
                                </td>
                                <td align="left">
                                    <b>Correo Electr�nico: </b><?php echo $datos_personales['pos_email']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" >
                                    <b>�Disponibilidad de trasladarse a otra ciudad?</b>
                                </td>
                                <td align="center" >
                                    <?php
                                    if ($datos_personales['pos_traslado'] == 1) {
                                        echo 'Si';
                                    } else {
                                        echo 'No';
                                    }
                                    ?>
                                </td>
                                <td align="left">
                                    <?php
                                    if ($datos_personales['pos_traslado'] == 1) {
                                        echo '<b>Ciudad de Traslado: </b>' . $datos_personales['pos_traslado_lugar'];
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php
                if ($educacion_post_grado == FALSE && $educacion_superior == FALSE && $educacion_secundaria == FALSE && $publicaciones == FALSE) {}else{
                    ?>
                    <tr>
                        <td align="left">
                            <h2>II.	INSTRUCCI�N FORMAL</h2>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                                <tr>
                                    <td align="left">
                                        <h3>Educaci�n de Post Grado</b></h3>
                                    </td>
                                </tr>
                            </table>
                            <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                                <tr align="center" bgcolor="#e3e8ea">
                                    <th>Desde<br/>(A�o-Mes)</th>
                                    <th>Hasta<br/>(A�o-Mes)</th>
                                    <th>Instituci�n</th>
                                    <th>Pa�s</th>
                                    <th>Grado o Titulo</th>
                                    <th>�rea de<br/>Post Grado</th>
                                    <th>Tema de Tesis</th>
                                    <th>Nota<br/>Tesis</th>
                                    <th>Titulado<br/>(si/no)</th>
                                </tr>
                                <?php if ($educacion_post_grado) { ?>
                                    <?php foreach ($educacion_post_grado as $fila) { ?>
                                        <tr align="center">
                                            <td><?php echo $fila['edu_desde']; ?></td>
                                            <td><?php echo $fila['edu_hasta']; ?></td>
                                            <td><?php echo $fila['edu_institucion']; ?></td>
                                            <td><?php echo $fila['edu_pais']; ?></td>
                                            <td><?php echo $this->grados[$fila['edu_grado']]; ?></td>
                                            <td><?php echo $fila['edu_area']; ?></td>
                                            <td><?php echo $fila['edu_tema']; ?></td>
                                            <td><?php
                                                if ($fila['edu_nota']) {
                                                    echo $fila['edu_nota'];
                                                }
                                                ?></td>
                                            <td><?php
                                                if ($fila['edu_titulado']) {
                                                    echo 'Si';
                                                } else {
                                                    echo 'No';
                                                }
                                                ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr align="center">
                                        <td align="center" colspan="9">No tiene ninguna Educaci�n Post Grado</td>                               
                                    </tr>
                                <?php } ?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                                <tr>
                                    <td align="left">
                                        <h3><b>Educaci�n Superior</b></h3>
                                    </td>
                                </tr>
                            </table>
                            <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                                <tr align="center" bgcolor="#e3e8ea">
                                    <th>Desde<br/>(A�o)</th>
                                    <th>Hasta<br/>(A�o)</th>
                                    <th>Instituci�n</th>
                                    <th>Pa�s</th>
                                    <th>Grado o Titulo</th>
                                    <th>Profesi�n</th>
                                    <th>Tema de Tesis</th>
                                    <th>Nota<br/>Tesis</th>
                                    <th>Titulado<br/>(si/no)</th>
                                </tr>
                                <?php if ($educacion_superior) { ?>
                                    <?php foreach ($educacion_superior as $fila) { ?>
                                        <tr align="center">
                                            <td><?php echo $fila['edu_desde']; ?></td>
                                            <td><?php echo $fila['edu_hasta']; ?></td>
                                            <td><?php echo $fila['edu_institucion']; ?></td>
                                            <td><?php echo $fila['edu_pais']; ?></td>
                                            <td><?php echo $this->grados_sup[$fila['edu_grado']]; ?></td>
                                            <td><?php
                                                if ($fila['edu_area'] == 65) {
                                                    echo $this->profesiones[$fila['edu_area']] . "-" . $fila['edu_area_otro'];
                                                } else {
                                                    echo $this->profesiones[$fila['edu_area']];
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $fila['edu_tema']; ?></td>
                                            <td><?php
                                                if ($fila['edu_nota']) {
                                                    echo $fila['edu_nota'];
                                                }
                                                ?></td>
                                            <td><?php
                                                if ($fila['edu_titulado']) {
                                                    echo 'Si';
                                                } else {
                                                    echo 'No';
                                                }
                                                ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr align="center">
                                        <td align="center" colspan="9">No tiene ninguna Educaci�n Superior</td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                                <tr>
                                    <td align="left">
                                        <h3><b>Educaci�n Secundaria</b></h3>
                                    </td>
                                </tr>
                            </table>
                            <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                                <tr align="center" bgcolor="#e3e8ea">
                                    <th>Desde (A�o)</th>
                                    <th>Hasta (A�o)</th>
                                    <th>Instituci�n</th>
                                    <th>Pa�s</th>
                                </tr>
                                <?php if ($educacion_secundaria) { ?>
                                    <?php foreach ($educacion_secundaria as $fila) { ?>
                                        <tr align="center">
                                            <td><?php echo $fila['edu_desde']; ?></td>
                                            <td><?php echo $fila['edu_hasta']; ?></td>
                                            <td><?php echo $fila['edu_institucion']; ?></td>
                                            <td><?php echo $fila['edu_pais']; ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr align="center">
                                        <td align="center" colspan="4">No tiene ninguna Educaci�n Secundaria</td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                                <tr>
                                    <td align="left">
                                        <h3><b>Publicaciones</b></h3>
                                    </td>
                                </tr>
                            </table>
                            <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                                <tr align="center" bgcolor="#e3e8ea">
                                    <th>Titulo</th>
                                    <th>A�o</th>
                                </tr>
                                <?php if ($publicaciones) { ?>
                                    <?php foreach ($publicaciones as $fila) { ?>
                                        <tr align="center">
                                            <td><?php echo $fila['pub_titulo']; ?></td>
                                            <td><?php echo $fila['pub_anio']; ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr align="center">
                                        <td align="center" colspan="2">No tiene ninguna Publicaci�n</td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </td>
                    </tr>
                    <?php
                }
//                validacion para trayectoria laboral
                if ($experiencia_laboral) {
                    ?>

                    <tr>
                        <td align="left">
                            <h2>III.	TRAYECTORIA LABORAL</h2>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                                <tr>
                                    <td align="left">
                                        <h3><b>S�ntesis de Experiencia Laboral</b></h3>
                                    </td>
                                </tr>
                            </table>
                            <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                                <tr>
                                    <td align="left" bgcolor="#f2ead7">
                                        <b>Ambito en el que clasificar�a su experiencia:</b>
                                    </td>
                                    <td align="left">
                                        <?php
                                        $ambitos = explode(',', $datos_personales['pof_ambito_exp']);
                                        foreach ($ambitos as $ambito) {
                                            switch ($ambito) {
                                                case "1":
                                                    echo 'Empresa Privada <br/>';
                                                    break;
                                                case "2":
                                                    echo 'Empresa Publica <br/>';
                                                    break;
                                                case "3":
                                                    echo 'Cooperaci�n para el Desarrollo <br/>';
                                                    break;
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#f2ead7">
                                        <b>�rea de experiencia que usted resaltar�a:</b>
                                    </td>
                                    <td align="left">
                                        <?php
                                        $arrayArea = explode(',', $datos_personales['pof_area_exp']);
                                        $nombresArea = array();
                                        foreach ($arrayArea as $key => $value) {
                                            $nombresArea[] = $this->area_experiencia[$value];
                                        }
                                        ?>
                                        <?php echo implode(', ', $nombresArea); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#f2ead7">
                                        <b>Sector de experiencia que usted resaltar�a: </b>
                                    </td>
                                    <td align="left">
                                        <?php
                                        $arraySector = explode(',', $datos_personales['pof_sector_exp']);
                                        $nombresSector = array();
                                        foreach ($arraySector as $key => $value) {
                                            $nombresSector[] = $this->sector_experiencia[$value];
                                        }
                                        ?>
                                        <?php echo implode(', ', $nombresSector); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#f2ead7">
                                        <b>Experiencia en supervisi�n</b>
                                    </td>
                                    <td align="left">
                                        <?php echo ucfirst($datos_personales['pof_supervisar_exp']); ?>
                                    </td>                                
                                </tr>
                                <?php if ($datos_personales['pof_supervisar_exp'] == 'si') { ?>
                                    <tr>
                                        <td align="left" bgcolor="#f2ead7">
                                            <b>Experiencia en supervisi�n:</b>
                                        </td>
                                        <td align="left">
                                            <?php echo $this->nivel_alcanzado[$datos_personales['pof_max_nivel']]; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" bgcolor="#f2ead7">
                                            <b>A�os de experiencia en supervisi�n:</b>
                                        </td>
                                        <td align="left">
                                            <?php echo $datos_personales['pof_anios_exp']; ?>
                                        </td>
                                    </tr>
                                <?php } else { ?>
                                    <tr>
                                        <td align="left" bgcolor="#f2ead7">
                                            <b>Experiencia en no supervisi�n:</b>
                                        </td>
                                        <td align="left">
                                            <?php echo $this->nivel_alcanzado_no[$datos_personales['pof_max_nivel_no']]; ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                            <br/>
                            <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                                <tr>
                                    <td align="left">
                                        <h3><b>Experiencia Laboral Resumen</b></h3>
                                    </td>
                                </tr>
                            </table>
                            <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                                <tr align="center" bgcolor="#e3e8ea">
                                    <th>Desde</th>
                                    <th>Hasta</th>
                                    <th>Tiempo que Trabaj�<br/>(A�os y Meses)</th>
                                    <th>Nombre de la Organizaci�n</th>
                                    <th>Cargos Ocupados</th>
                                    <th>N� Subordinados</th>
                                    <th>Sueldo por Mes (en Bs.)</th>
                                </tr>
                                <?php if ($experiencia_laboral) { ?>
                                    <?php
                                    foreach ($experiencia_laboral as $fila) {
                                        $meses = $fila['tra_anio_mes'];
                                        $tiempo = '';
                                        if ($meses) {
                                            if (intval($meses / 12))
                                                $tiempo .= intval($meses / 12) . ' A�os';
                                            if ($meses % 12)
                                                $tiempo .= ' ' . ($meses % 12) . ' Meses';
                                        }
                                        ?>
                                        <tr align="center">
                                            <td><?php echo $fila['tra_desde']; ?></td>
                                            <td><?php echo $fila['tra_hasta']; ?></td>
                                            <td><?php echo $tiempo; ?></td>
                                            <td><?php echo $fila['tra_organizacion']; ?></td>
                                            <td><?php echo $fila['tra_cargos']; ?></td>
                                            <td><?php echo $fila['tra_nsubordinados']; ?></td>
                                            <td><?php echo $fila['tra_sueldo']; ?></td>
                                        </tr>
                                    <?php } ?>
                                <?php }else { ?>
                                    <tr align="center">
                                        <td align="center" colspan="6">No tiene ninguna Experiencia Laboral</td>
                                    </tr>
                                <?php } ?>
                            </table>
                            <br/>
                            <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                                <tr>
                                    <td align="left">
                                        <h3><b>Experiencia Laboral Detallada</b></h3>
                                    </td>
                                </tr>
                            </table>
                            <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">                            
                                <?php if ($experiencia_laboral) { ?>
                                    <?php
                                    foreach ($experiencia_laboral as $num => $fila) {
                                        $meses = $fila['tra_anio_mes'];
                                        $tiempo = '';
                                        if ($meses) {
                                            if (intval($meses / 12))
                                                $tiempo .= intval($meses / 12) . ' A�os';
                                            if ($meses % 12)
                                                $tiempo .= ' ' . ($meses % 12) . ' Meses';
                                        }
                                        if (($num % 2) == 0) {
                                            $color = ' ';
                                        } else {
                                            $color = ' bgcolor="#e0e5e8" ';
                                        }
                                        ?>
                                        <tr align="left" <?php echo $color; ?> >
                                            <td align="center" colspan="2"><b>Desde(A�o-Mes): </b><?php echo $fila['tra_desde']; ?>  <b>Hasta(A�o-Mes): </b><?php echo $fila['tra_hasta']; ?><br/><b>Tiempo que Trabaj� (A�os y Meses): </b><?php echo $tiempo; ?></td>
                                        </tr>
                                        <tr align="left" <?php echo $color; ?> >
                                            <td><b>Nombre de la Organizaci�n: </b><?php echo $fila['tra_organizacion']; ?></td>
                                            <td><b>Tipo Organizaci�n: </b><?php echo $this->tipo_org[$fila['tra_tipo_org']]; ?></td>
                                        </tr>
                                        <tr align="left" <?php echo $color; ?> >
                                            <td colspan="2"><div align="justify"><b>Actividad Principal de la Organizaci�n: </b><?php echo $fila['tra_descripcion_org']; ?></div></td>
                                        </tr>
                                        <tr align="left" <?php echo $color; ?> >
                                            <td colspan="2"><div align="justify"><b>Cargo(s) Ocupado(s): </b><?php echo $fila['tra_cargos']; ?></div></td>
                                        </tr>
                                        <tr align="left" <?php echo $color; ?> >
                                            <td colspan="2"><div align="justify"><b>3 Principales Funciones Desempe�adas dentro del Cargo: </b><?php echo $fila['tra_funciones_org']; ?></div></td>
                                        </tr>
                                        <tr align="left" <?php echo $color; ?> >
                                            <td colspan="2"><div align="justify"><b>Principales Logros: </b><?php echo $fila['tra_logros']; ?></div></td>
                                        </tr>
                                        <tr align="left" <?php echo $color; ?> >
                                            <td><b>Pa�s - Ciudad: </b><?php echo $fila['tra_pais']; ?></td>
                                            <td><b>Tel�fono(s) de la Organizaci�n: </b><?php echo $fila['tra_telefono_org']; ?></td>
                                        </tr>                            
                                        <tr align="left" <?php echo $color; ?> >
                                            <td align="left" colspan="2"><b>Nombre del Inmediato Superior: </b><?php echo $fila['tra_nombre_sup']; ?></td>
                                        </tr>
                                        <?php if ($fila['tra_telefono_sup']) { ?>
                                            <tr align="left" <?php echo $color; ?> >
                                                <td align="left" colspan="2"><b>Tel�fono del Inmediato Superior: </b><?php echo $fila['tra_telefono_sup']; ?></td>
                                            </tr>
                                        <?php } ?>
                                        <?php if ($fila['tra_email_sup']) { ?>
                                            <tr align="left" <?php echo $color; ?> >
                                                <td align="left" colspan="2"><b>Correo Electr�nico del Inmediato Superior: </b><?php echo $fila['tra_email_sup']; ?></td>
                                            </tr>
                                        <?php } ?>
                                        <?php if ($fila['tra_actual']) { ?>
                                            <tr align="left" <?php echo $color; ?> >
                                                <td align="center" colspan="2"><b>Estoy Trabajando Actualmente en esta Organizaci�n</b></td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </table>
                        </td>
                    </tr>
                    <?php
                }
//                validacion para informacion adicional
                if ($idiomas) {
                    ?>
                    <tr>
                        <td align="left">
                            <h2>IV.	INFORMACION ADICIONAL</h2>
                        </td>
                    </tr>
                    <?php
                    if ($idiomas) {
                        $x = 1;
                        ?>
                        <?php foreach ($idiomas as $fila) { ?>
                            <tr>
                                <td align="center">
                                    <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                                        <tr>
                                            <td align="left">
                                                <div><b>Idioma <?php echo $x . ': </b>' . $fila['idi_idioma']; ?></div>
                                            </td>
                                        </tr>
                                    </table>
                                    <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                                        <tr align="center" bgcolor="#e3e8ea">
                                            <th> &nbsp; </th>
                                            <th>Excelente</th>
                                            <th>Muy Bueno</th>
                                            <th>Regular</th>
                                            <th>Basico</th>
                                        </tr>                                                            
                                        <tr align="center">
                                            <td bgcolor="#e3e8ea"><b>Habla</b></td>
                                            <?php
                                            if ($fila['poi_habla'] == 1) {
                                                echo '<td><b>X</b></td>';
                                            } else {
                                                echo '<td> &nbsp; </td>';
                                            }
                                            ?>
                                            <?php
                                            if ($fila['poi_habla'] == 2) {
                                                echo '<td><b>X</b></td>';
                                            } else {
                                                echo '<td> &nbsp; </td>';
                                            }
                                            ?>
                                            <?php
                                            if ($fila['poi_habla'] == 3) {
                                                echo '<td><b>X</b></td>';
                                            } else {
                                                echo '<td> &nbsp; </td>';
                                            }
                                            ?>
                                            <?php
                                            if ($fila['poi_habla'] == 4) {
                                                echo '<td><b>X</b></td>';
                                            } else {
                                                echo '<td> &nbsp; </td>';
                                            }
                                            ?>
                                        </tr>
                                        <tr align="center">
                                            <td bgcolor="#e3e8ea"><b>Lee</b></td>
                                            <?php
                                            if ($fila['poi_lee'] == 1) {
                                                echo '<td><b>X</b></td>';
                                            } else {
                                                echo '<td> &nbsp; </td>';
                                            }
                                            ?>
                                            <?php
                                            if ($fila['poi_lee'] == 2) {
                                                echo '<td><b>X</b></td>';
                                            } else {
                                                echo '<td> &nbsp; </td>';
                                            }
                                            ?>
                                            <?php
                                            if ($fila['poi_lee'] == 3) {
                                                echo '<td><b>X</b></td>';
                                            } else {
                                                echo '<td> &nbsp; </td>';
                                            }
                                            ?>
                                            <?php
                                            if ($fila['poi_lee'] == 4) {
                                                echo '<td><b>X</b></td>';
                                            } else {
                                                echo '<td> &nbsp; </td>';
                                            }
                                            ?>
                                        </tr>
                                        <tr align="center">
                                            <td bgcolor="#e3e8ea"><b>Escribe</b></td>
                                            <?php
                                            if ($fila['poi_escribe'] == 1) {
                                                echo '<td><b>X</b></td>';
                                            } else {
                                                echo '<td> &nbsp; </td>';
                                            }
                                            ?>
                                            <?php
                                            if ($fila['poi_escribe'] == 2) {
                                                echo '<td><b>X</b></td>';
                                            } else {
                                                echo '<td> &nbsp; </td>';
                                            }
                                            ?>
                                            <?php
                                            if ($fila['poi_escribe'] == 3) {
                                                echo '<td><b>X</b></td>';
                                            } else {
                                                echo '<td> &nbsp; </td>';
                                            }
                                            ?>
                                            <?php
                                            if ($fila['poi_escribe'] == 4) {
                                                echo '<td><b>X</b></td>';
                                            } else {
                                                echo '<td> &nbsp; </td>';
                                            }
                                            ?>
                                        </tr>                                                        
                                    </table>
                                </td>
                            </tr>
                            <?php
                            $x++;
                        }
                        ?>
                    <?php } ?>
                    <?php if ($datos_personales['pos_comentario']) { ?>
                        <tr>
                            <td align="center">
                                <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                                    <tr>
                                        <td align="left" colspan="2">
                                            <b>Comentario Adicional : </b><?php echo $datos_personales['pos_comentario']; ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>

                <tr>
                    <td align="center">
                        <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td align="center">
                                    <div><b>Fecha de Inscripci�n(D�a-Mes-A�o): </b><?php echo $datos_personales['pos_fecha_creacion']; ?></div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>        
    </body>
</html>