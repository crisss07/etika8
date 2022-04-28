<html>
    <head>
        <title>Area Restringida - Sistema de Postulación</title>
        <style type="text/css"> 
            body{text-align:center;} #contenedor{ width: 750px; margin: 0px auto;}
        </style>        
    </head>
    <body>        
        <div id="contenedor">            
            <table border="0" cellpadding="5" cellspacing="0" width="750">
                <tr>                    
                    <td align="center"><h1>FORMULARIO DE <br/>DATOS PERSONALES Y LABORALES </h1></td>
                    <td align="right"><img alt="ETIKA" title="ETIKA" src="http://www.etika.com.bo/sisetika/files/img/logo_bn.gif" /></td>
                </tr>
            </table>
            <table border="0" cellpadding="5" width="100%">
                <tr>
                    <td align="left">
                        <b>Pretensión Salarial Referencial (en Bs.): </b> <?php echo $datos_personales['pof_salario'];?>                       
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <h2>I.	DATOS PERSONALES</h2>                        
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
                                    Fecha Nacimiento (día, mes y año): <b><?php echo $datos_personales['pof_fecha_nacimiento'];?></b>
                                </td>
                                <td align="left">
                                    Edad: <b><?php echo $datos_personales['anios'];?></b>
                                </td>
                                <td align="left">
                                    Género: <b><?php if($datos_personales['pof_sexo']==1){echo 'Masculino';}else{echo 'Femenino';}?></b>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" colspan="2">
                                    Nacionalidad: <b><?php echo $datos_personales['pos_nacionalidad'];?></b>
                                </td>
                                <td align="left">
                                    País: <b><?php echo $datos_personales['pais'];?></b>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" colspan="2">
                                    Dirección: <b><?php echo $datos_personales['pos_direccion'];?></b>
                                </td>
                                <td align="left">
                                    Ciudad o Localidad: <b><?php echo $datos_personales['ciudad'];?></b>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" colspan="2">
                                    Teléfono / Celular: <b><?php echo $datos_personales['pos_telefono'].' '.$datos_personales['pos_celular'] ;?></b>
                                </td>
                                <td align="left">
                                    Correo Electrónico: <b><?php echo $datos_personales['pos_email'];?></b>
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
                <tr>
                    <td align="left">
                        <h2>II.	INSTRUCCIÓN FORMAL</h2>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td align="left">
                                    <b>Educación de Post Grado</b>
                                </td>
                            </tr>
                        </table>
                        <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                            <tr align="center" bgcolor="#e3e8ea">
                                <th>Desde<br/>(Año-Mes)</th>
                                <th>Hasta<br/>(Año-Mes)</th>
                                <th>Institución</th>
                                <th>País</th>
                                <th>Grado o Titulo</th>
                                <th>Área de<br/>Post Grado</th>
                                <th>Tema de Tesis</th>
                                <th>Nota<br/>Tesis</th>
                                <th>Titulado<br/>(si/no)</th>
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
                            <?php }else{?>
                            <tr align="center">
                                <td align="center" colspan="9">No tiene ninguna Educación Post Grado</td>                               
                            </tr>
                            <?php }?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td align="left">
                                    <b>Educación Superior</b>
                                </td>
                            </tr>
                        </table>
                        <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                            <tr align="center" bgcolor="#e3e8ea">
                                <th>Desde<br/>(Año)</th>
                                <th>Hasta<br/>(Año)</th>
                                <th>Institución</th>
                                <th>País</th>
                                <th>Grado o Titulo</th>
                                <th>Profesión</th>
                                <th>Tema de Tesis</th>
                                <th>Nota<br/>Tesis</th>
                                <th>Titulado<br/>(si/no)</th>
                            </tr>
                            <?php if($educacion_superior){ ?>
                                <?php foreach ($educacion_superior as $fila){ ?>
                            <tr align="center">
                                <td><?php echo $fila['edu_desde'];?></td>
                                <td><?php echo $fila['edu_hasta'];?></td>
                                <td><?php echo $fila['edu_institucion'];?></td>
                                <td><?php echo $fila['edu_pais'];?></td>
                                <td><?php echo $this->grados_sup[$fila['edu_grado']];?></td>
                                <td><?php
                                if($fila['edu_area']==65)
                                {
                                echo $this->profesiones[$fila['edu_area']]."-".$fila['edu_area_otro'];
                                }
                                else{
                                echo $this->profesiones[$fila['edu_area']];
                                }
                                ?>
                                </td>
                                <td><?php echo $fila['edu_tema'];?></td>
                                <td><?php if($fila['edu_nota']){echo $fila['edu_nota'];}?></td>
                                <td><?php if($fila['edu_titulado']){ echo 'Si';}else{ echo 'No';}?></td>
                            </tr>
                                <?php }?>
                            <?php }else{?>
                            <tr align="center">
                                <td align="center" colspan="9">No tiene ninguna Educación Superior</td>
                            </tr>
                            <?php }?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td align="left">
                                    <b>Educación Secundaria</b>
                                </td>
                            </tr>
                        </table>
                        <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                            <tr align="center" bgcolor="#e3e8ea">
                                <th>Desde (Año)</th>
                                <th>Hasta (Año)</th>
                                <th>Institución</th>
                                <th>País</th>
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
                            <?php }else{?>
                            <tr align="center">
                                <td align="center" colspan="4">No tiene ninguna Educación Secundaria</td>
                            </tr>
                            <?php }?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td align="left">
                                    <b>Publicaciones</b>
                                </td>
                            </tr>
                        </table>
                        <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                            <tr align="center" bgcolor="#e3e8ea">
                                <th>Titulo</th>
                                <th>Año</th>
                            </tr>
                            <?php if($publicaciones){ ?>
                                <?php foreach ($publicaciones as $fila){ ?>
                            <tr align="center">
                                <td><?php echo $fila['pub_titulo'];?></td>
                                <td><?php echo $fila['pub_anio'];?></td>
                            </tr>
                                <?php }?>
                            <?php }else{?>
                            <tr align="center">
                                <td align="center" colspan="2">No tiene ninguna Publicación</td>
                            </tr>
                            <?php }?>
                        </table>
                    </td>
                </tr>
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
                                    <b>Síntesis de Experiencia Laboral</b>
                                </td>
                            </tr>
                        </table>
                        <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                            <tr>
                                <td align="left" bgcolor="#f2ead7">
                                    Ambito en el que clasificaría su experiencia:                                    
                                </td>
                                <td align="left">
                                    <?php
                                    $ambitos = explode(',', $datos_personales['pof_ambito_exp']);
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
                                <td align="left" bgcolor="#f2ead7">
                                    Área de experiencia que usted resaltaría:
                                </td>
                                <td align="left">
                                    <?php
                                    $arrayArea = explode(',',$datos_personales['pof_area_exp']);
                                    $nombresArea=array();
                                    foreach ($arrayArea as $key => $value) {
                                    $nombresArea[]=$this->area_experiencia[$value];
                                    }
                                    ?>
                                    <b><?php echo implode(', ', $nombresArea);?></b>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" bgcolor="#f2ead7">
                                    Sector de experiencia que usted resaltaría: 
                                </td>
                                <td align="left">
                                    <?php
                                    $arraySector = explode(',',$datos_personales['pof_sector_exp']);
                                    $nombresSector=array();
                                    foreach ($arraySector as $key => $value) {
                                    $nombresSector[]=$this->sector_experiencia[$value];
                                    }
                                    ?>
                                    <b><?php echo implode(', ', $nombresSector);?></b>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" bgcolor="#f2ead7">
                                    Experiencia en supervisión
                                </td>
                                <td align="left">
                                    <b><?php echo ucfirst($datos_personales['pof_supervisar_exp']);?></b>
                                </td>                                
                            </tr>
                            <?php if($datos_personales['pof_supervisar_exp']=='si'){ ?>
                            <tr>
                                <td align="left" bgcolor="#f2ead7">
                                    Experiencia en supervisión:
                                </td>
                                <td align="left">
                                    <b><?php echo $this->nivel_alcanzado[$datos_personales['pof_max_nivel']];?></b>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" bgcolor="#f2ead7">
                                    Años de experiencia en supervisión:
                                </td>
                                <td align="left">
                                    <b><?php echo $datos_personales['pof_anios_exp'];?></b>
                                </td>
                            </tr>
                            <?php }else{?>
                            <tr>
                                <td align="left" bgcolor="#f2ead7">
                                    Experiencia en no supervisión:
                                </td>
                                <td align="left">
                                    <b><?php echo $this->nivel_alcanzado_no[$datos_personales['pof_max_nivel_no']];?></b>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                        <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td align="left">
                                    <b>Experiencia Laboral Resumen</b>
                                </td>
                            </tr>
                        </table>
                        <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                            <tr align="center" bgcolor="#e3e8ea">
                                <th>Desde</th>
                                <th>Hasta</th>
                                <th>Tiempo que Trabajó<br/>(Años y Meses)</th>
                                <th>Nombre de la Organización</th>
                                <th>Cargos Ocupados</th>
                                <th>Nº Subordinados</th>
                                <th>Sueldo por Mes (en Bs.)</th>
                            </tr>
                            <?php if($experiencia_laboral){ ?>
                                <?php foreach ($experiencia_laboral as $fila){
                                    $meses=$fila['tra_anio_mes'];
                                    $tiempo='';
                                    if($meses){
                                        if(intval($meses/12))
                                            $tiempo.=intval($meses/12) . ' Años';
                                        if($meses % 12)
                                            $tiempo.=' ' . ($meses % 12) . ' Meses';
                                    }
                                    ?>
                            <tr align="center">
                                <td><?php echo $fila['tra_desde'];?></td>
                                <td><?php echo $fila['tra_hasta'];?></td>
                                <td><?php echo $tiempo;?></td>
                                <td><?php echo $fila['tra_organizacion'];?></td>
                                <td><?php echo $fila['tra_cargos'];?></td>
                                <td><?php echo $fila['tra_nsubordinados'];?></td>
                                <td><?php echo $fila['tra_sueldo'];?></td>
                            </tr>
                                <?php }?>
                            <?php }else{?>
                            <tr align="center">
                                <td align="center" colspan="6">No tiene ninguna Experiencia Laboral</td>
                            </tr>
                            <?php }?>
                        </table>
                        <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td align="left">
                                    <b style="font-size: 14px;">Experiencia Laboral Detallada</b>
                                </td>
                            </tr>
                        </table>
                        <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">                            
                            <?php if($experiencia_laboral){ ?>
                                <?php foreach ($experiencia_laboral as $num=>$fila){
                                    $meses=$fila['tra_anio_mes'];
                                    $tiempo='';
                                    if($meses){
                                        if(intval($meses/12))
                                            $tiempo.=intval($meses/12) . ' Años';
                                        if($meses % 12)
                                            $tiempo.=' ' . ($meses % 12) . ' Meses';
                                    }
                                    if(($num%2)==0){
                                        $color = ' ';
                                    }else{
                                        $color = ' bgcolor="#e0e5e8" ';
                                    }
                                ?>
                            <tr align="left" <?php echo $color;?> >
                                <td align="center" colspan="2">Desde(Año-Mes): <b><?php echo $fila['tra_desde'];?> </b> Hasta(Año-Mes): <b><?php echo $fila['tra_hasta'];?></b><br/>Tiempo que Trabajó (Años y Meses): <b><?php echo $tiempo;?></b></td>
                            </tr>
                            <tr align="left" <?php echo $color;?> >
                                <td>Nombre de la Organización: <b><?php echo $fila['tra_organizacion'];?></b></td>
                                <td>Tipo Organización: <b><?php echo $this->tipo_org[$fila['tra_tipo_org']];?></b></td>
                            </tr>
                            <tr align="left" <?php echo $color;?> >
                                <td colspan="2"><div align="justify">Actividad Principal de la Organización: <b><?php echo $fila['tra_descripcion_org'];?></b></div></td>
                            </tr>
                            <tr align="left" <?php echo $color;?> >
                                <td colspan="2"><div align="justify">Cargo(s) Ocupado(s): <b><?php echo $fila['tra_cargos'];?></b></div></td>
                            </tr>
                            <tr align="left" <?php echo $color;?> >
                                <td colspan="2"><div align="justify">3 Principales Funciones Desempeñadas dentro del Cargo: <b><?php echo $fila['tra_funciones_org'];?></b></div></td>
                            </tr>
                            <tr align="left" <?php echo $color;?> >
                                <td colspan="2"><div align="justify">Principales Logros: <b><?php echo $fila['tra_logros'];?></b></div></td>
                            </tr>
                            <tr align="left" <?php echo $color;?> >
                                <td>País - Ciudad: <b><?php echo $fila['tra_pais'];?></b></td>
                                <td>Teléfono(s) de la Organización: <b><?php echo $fila['tra_telefono_org'];?></b></td>
                            </tr>                            
                            <tr align="left" <?php echo $color;?> >
                                <td align="left" colspan="2">Nombre del Inmediato Superior: <b><?php echo $fila['tra_nombre_sup'];?></b></td>
                            </tr>
                            <?php if($fila['tra_telefono_sup']){ ?>
                            <tr align="left" <?php echo $color;?> >
                                <td align="left" colspan="2">Teléfono del Inmediato Superior: <b><?php echo $fila['tra_telefono_sup'];?></b></td>
                            </tr>
                            <?php }?>
                            <?php if($fila['tra_email_sup']){ ?>
                            <tr align="left" <?php echo $color;?> >
                                <td align="left" colspan="2">Correo Electrónico del Inmediato Superior: <b><?php echo $fila['tra_email_sup'];?></b></td>
                            </tr>
                            <?php }?>
                            <?php if($fila['tra_actual']){ ?>
                            <tr align="left" <?php echo $color;?> >
                                <td align="center" colspan="2"><b>Estoy Trabajando Actualmente en esta Organización</b></td>
                            </tr>
                            <?php }?>
                                <?php }?>
                            <?php }?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <h2>IV.	INFORMACION ADICIONAL</h2>
                    </td>
                </tr>
                <?php if($idiomas){ $x=1; ?>
                    <?php foreach ($idiomas as $fila){ ?>
                <tr>
                    <td align="center">
                        <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td align="left">
                                    <div>Idioma <?php echo $x.': <b>'.$fila['idi_idioma'].'</b>';?></div>
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
                                <?php if($fila['poi_habla']==1){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                                <?php if($fila['poi_habla']==2){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                                <?php if($fila['poi_habla']==3){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                                <?php if($fila['poi_habla']==4){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                            </tr>
                            <tr align="center">
                                <td bgcolor="#e3e8ea"><b>Lee</b></td>
                                <?php if($fila['poi_lee']==1){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                                <?php if($fila['poi_lee']==2){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                                <?php if($fila['poi_lee']==3){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                                <?php if($fila['poi_lee']==4){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                            </tr>
                            <tr align="center">
                                <td bgcolor="#e3e8ea"><b>Escribe</b></td>
                                <?php if($fila['poi_escribe']==1){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                                <?php if($fila['poi_escribe']==2){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                                <?php if($fila['poi_escribe']==3){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                                <?php if($fila['poi_escribe']==4){ echo '<td><b>X</b></td>';}else{echo '<td> &nbsp; </td>';}?>
                            </tr>                                                        
                        </table>
                    </td>
                </tr>
                    <?php $x++;}?>
                <?php }?>
                <?php if($datos_personales['pos_comentario']){ ?>
                <tr>
                    <td align="center">
                        <table width="95%" align="center" border="1" cellspacing="0" cellpadding="5">
                            <tr>
                                <td align="left" colspan="2">
                                    Comentario Adicional : <b><?php echo $datos_personales['pos_comentario'];?></b>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php }?>
                <tr>
                    <td align="center">
                        <table width="95%" align="center" border="0" cellspacing="0" cellpadding="5">
                            <tr>
                                <td align="center">
                                    <div>Fecha de Inscripción(Día-Mes-Año): <b><?php echo $datos_personales['pos_fecha_creacion'];?></b></div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>        
    </body>
</html>