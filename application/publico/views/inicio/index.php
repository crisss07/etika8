<SCRIPT LANGUAGE=JavaScript>
    function mensaje() {
        alert("Su Curriculum Vitae debe estar completo para poder postularse.");
    }
    function mensaje1() {
        alert("Su Estado debe estar Disponible para poder postularse.");
    }
    function mensaje_cv() {
        alert("Su Estado debe estar Disponible para poder postularse.");
    }
</SCRIPT>
<?php
$prefijosup = $this->prefijosup;
$prefijo = $this->prefijo;
$rutasup = $this->rutarchivo . $this->carpetasup;
$ruta = $this->ruta . $this->carpeta;
$rutabaseimg = $this->rutabaseimg . $this->carpeta;
$sitiop = $this->tool_entidad->sitiopri();

//$this->rutabase=$this->tool_entidad->sitioindex();
?>

<div id="contenido">
    <div class="cuadro_intro">
        <div class="cuadro_estado_postulante">
            <?php if ($estado['estado']) { ?>
            <div class="habilitado"><b>Estado: </b> &nbsp;<?php echo anchor('postulante/deshabilitar/id/' . $id, 'DISPONIBLE', array('class' => "enlace_estado", 'title' => 'Está habilitado a postularse a un cargo por más de que no se vincule directamente (podría por ejemplo ser encontrado con un filtro por profesión y ser contactado).')); ?> &nbsp; </div>
            <?php } else { ?>
            <div class="deshabilitado"><b>Estado:  </b> &nbsp;<?php echo anchor('postulante/habilitar/id/' . $id, 'NO DISPONIBLE', array('class' => "enlace_estado", 'title' => 'Su información está en la Base de datos de ETIKA, por el momento usted no está disponible para postularse o ser encontrado por nuestros filtros (por ejemplo porque está trabajando).')); ?> &nbsp; </div>
            <?php } ?>
        </div><br/><br/>
        <div class="nota_alerta" style="padding: 5px;"><br/>
            <?php if ($estado['estado']) { ?>
            <span style="text-decoration: underline;">Nota.-</span> Está habilitado a postularse a un cargo por más de que no se vincule directamente (podría por ejemplo ser encontrado con un filtro por profesión y ser contactado).
            <?php } else { ?>
            <span style="text-decoration: underline;">Nota.-</span> Su información está en la Base de datos de ETIKA, por el momento usted no está disponible para postularse o ser encontrado por nuestros filtros (por ejemplo porque está trabajando).            
            <?php } ?>                        
        </div>
        <table align="center" width="820" border="0" cellpadding="2">
            <!--tr align="center" valign="top">
                <td colspan="2" align="left">
            <?php if ($editar) { ?>
                                                                                        <div style="text-align: left; font-weight: bold; color: red; font-size: 14px;">No puede editar su Curriculum Vitae Hasta que terminen sus Postulaciones a los cargos</div>
            <?php } elseif ($noestado) { ?>
                                                                                        <div style="text-align: left; font-weight: bold; color: red; font-size: 14px;">No puede editar su Curriculum Vitae por su Estado</div>
            <?php } else { ?>
                <?php echo anchor('postulante/editar_datospersonal/id/' . $id, 'Editar Curriculum Vitae', array('class' => "enlace_a1")); ?>
            <?php } ?>
                </td>
            </tr-->
            <tr align="center" valign="top">
                <td width="407" align="left">
                    <br/>
                    <div class="titulo_alerta">ALERTAS</div>
                    <table width="100%" class="alerta_contenido" cellpadding="0" cellspacing="8" align="center" >
                        <tr>
                            <td align="left" valign="top">                                                                
                                <div class="cuadro_contenido_mensajes">                                                                                                        
                                    <?php if ($instruccion) { ?>
                                        <div class="mensaje_alerta">&rarr; Usted no ha terminado de llenar la <b>Instrucción Formal</b> de su Curriculum Vitae</div>
                                    <?php } ?>
                                    <?php if ($trayectoria) { ?>
                                        <div class="mensaje_alerta">&rarr; Usted no ha terminado de llenar la <b>Trayectoria Laboral</b> de su Curriculum Vitae</div>
                                    <?php } ?>                                
                                    <?php
                                    if ($trayectoria || $instruccion) {
                                        $incompleto = 1;
                                        ?>
                                        <div class="mensaje_alerta">&rarr; Si su <b>Curriculum Vitae</b> no esta completo usted no puede postular a ningun cargo</div>
                                    <?php } ?>
                                    <div style="font: 12px 'Helvetica CE'; font-weight: bold; color: #2F627B; text-decoration: underline;">POSTULACIONES:</div>
                                    <?php if ($postulaciones) { ?>                                
                                        <?php
                                        foreach ($postulaciones as $postulacion) {
                                            $notificacion = '';
                                            ?>
                                            <div class="fondo_hover">
                                                <div class="titulo_postulaciones"><?php echo strtoupper($postulacion['con_cargo']); ?></div>
                                                <?php
                                                $porciento = (($postulacion['con_etapa'] * 100) / 4);
                                                if ($postulacion['con_etapa'] == 2 && !$postulacion['con_espera']) {
                                                    $consulta = $this->db->query('
                                        SELECT *
                                        FROM etapas
                                        WHERE pos_id=' . $postulacion['pos_id'] . ' and con_id=' . $postulacion['con_id1']
                                                    );
                                                    $msj = $consulta->row_array();
                                                    if ($msj) {
                                                        $consulta = $this->db->query('
                                            SELECT con_mensaje_si as notificacion
                                            FROM convocatoria
                                            WHERE con_id=' . $postulacion['con_id1']
                                                        );
                                                    } else {
                                                        $consulta = $this->db->query('
                                            SELECT not_contenido as notificacion
                                            FROM notificaciones
                                            WHERE not_id=2');
                                                    }
                                                    $fecha_actual = strtotime(date("Y-m-d", time()));
                                                    $fecha_entrada = strtotime($postulacion['fecha_edicion']);
                                                    if ($fecha_entrada >= $fecha_actual) {
                                                        $notificacion = $consulta->row_array();
                                                    }
                                                    $fecha_publicacion = $postulacion['fecha'];
                                                }
                                                if ($postulacion['con_etapa'] >= 3) {
                                                    $consulta = $this->db->query('
                                        SELECT *, date_format(eta_fecha_edicion, "%Y-%m-%d") as fecha
                                        FROM etapas
                                        WHERE pos_id=' . $postulacion['pos_id'] . ' and con_id=' . $postulacion['con_id1']
                                                    );
                                                    $msj = $consulta->row_array();
                                                    if ($msj['eta_tipo_msj'] == 'no') {
                                                        $consulta = $this->db->query('
                                            SELECT not_contenido as notificacion
                                            FROM notificaciones
                                            WHERE not_id=4');
                                                    } elseif ($msj['eta_tipo_msj'] == 'si') {
                                                        $consulta = $this->db->query('
                                            SELECT con_mensaje_si as notificacion
                                            FROM convocatoria
                                            WHERE con_id=' . $postulacion['con_id1']
                                                        );
                                                    } else {
                                                        $consulta = $this->db->query('
                                            SELECT not_contenido as notificacion
                                            FROM notificaciones
                                            WHERE not_id=2');
                                                    }
                                                    $fecha_actual = strtotime(date("Y-m-d", time()));
                                                    $fecha_entrada = strtotime($postulacion['fecha_edicion']);
                                                    if ($fecha_entrada >= $fecha_actual) {
                                                        $notificacion = $consulta->row_array();
                                                    }
                                                    if ($msj['fecha']) {
                                                        $fecha_publicacion = $msj['fecha'];
                                                    } else {
                                                        $fecha_publicacion = $postulacion['fecha'];
                                                    }
                                                }
                                                ?>                                    
                                                <div class="ProgressBar">
                                                    <div class="ProgressBarText"><?php echo $porciento; ?>% de avance del proceso</div>
                                                    <div class="ProgressBarFill" style="width: <?php echo $porciento; ?>%;"></div>
                                                </div> <br/>                               
                                                Fecha de cierre de Postulación: <span class="titulo_postulaciones"><?php echo $postulacion['con_tope']; ?></span><br/><br/>
                                                Si desea <span class="titulo_postulaciones">Desvincularse</span> del proceso contactarse con el responsable haciendo <a href="<?php echo $sitiop . 'contacto/index/cargo/' . $postulacion['con_id']; ?>" class="enlace_postulacion" title="Contactenos">click aqui</a>.
                                                <?php if ($notificacion) { ?>
                                                    <div style="color:#B71318;" align="justify"><p>Publicación: <b><?php echo $fecha_publicacion; ?></b></p><?php echo $notificacion['notificacion']; ?></div>
                                                <?php } ?>                                    
                                            </div>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <div class="mensaje_alerta">No se esta postulando a ningun cargo.</div>
                                    <?php } ?>                                                                
                                </div>
                            </td>
                        </tr>                        
                    </table><br/>
                    <div class="nota_alerta">
                        <span style="text-decoration: underline;">Nota.-</span> Usted recibirá noticias en su página en un lapso de 20 días despúes de la fecha de postulación.                                                
                    </div>
                    <br/>
                    <div class="titulo_nota">NOTAS / ANUNCIOS</div>
                    <table width="100%" class="nota_contenido" cellpadding="0" cellspacing="8" align="center" >
                        <tr>
                            <td align="center" valign="top">                                
                                <div class="cuadro_contenido_noticias">
                                    <?php if ($anuncios) { ?>
                                        <?php foreach ($anuncios as $anuncio) { ?>
                                            <div class="fondo_hover">
                                                <div class="titulo_noticia"><?php echo strtoupper($anuncio['not_titulo']); ?></div>
                                                <div align="justify"><p><?php echo substr(strip_tags($anuncio['not_contenido']), 0, 200) . '..'; ?></p></div><br/>
                                                <a class="ver_convocatoria" href="<?php echo $sitiop . 'noticia/mostrar/id/' . $anuncio['not_id']; ?>" >Ver Más</a>
                                            </div>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <div class="mensaje_alerta">No existe ninguna Nota / Anuncio.</div>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="407">
                    <br/>
                    <div class="titulo_convocatoria">CONVOCATORIAS VIGENTES</div>
                    <table width="100%" class="convocatoria_contenido" cellpadding="0" cellspacing="8" align="center" >
                        <tr>
                            <td align="left" valign="top">                                
                                <div class="cuadro_contenido_postulaciones">
                                    <?php if ($convocatorias) { ?>                                
                                        <?php foreach ($convocatorias as $convocatoria) { ?>
                                            <div class="fondo_hover">                                        
                                                <?php if ($incompleto) { ?>
                                                    <a class="enlace_postulacion" href="#" onclick="mensaje()"><?php echo strtoupper($convocatoria['con_cargo']); ?></a>
                                                <?php } elseif ($noestado) { ?>
                                                    <a class="enlace_postulacion" href="#" onclick="mensaje1()"><?php echo strtoupper($convocatoria['con_cargo']); ?></a>
                                                <?php } else { ?>
                                                    <a class="enlace_postulacion" href="<?php echo $sitiop . 'postulacion/agregar/idp/' . $convocatoria['con_id']; ?>" ><?php echo strtoupper($convocatoria['con_cargo']); ?></a>
                                                <?php } ?>
                                                <br/>
                                                Fecha Tope de la Postulación: <span class="enlace_postulacion"><?php echo $convocatoria['con_tope']; ?></span><br/>Sede: <span class="enlace_postulacion"><?php echo $convocatoria['con_sede']; ?></span>
                                                <div align="justify"><br/><?php echo substr(strip_tags($convocatoria['con_descripcion']), 0, 200) . '..'; ?></div><br/>                                
                                                <div align="center"><a class="ver_convocatoria" href="<?php echo $sitiop . 'inicio/mostrar/id/' . $convocatoria['con_id']; ?>" >Ver Convocatoria</a></div>                                        
                                            </div>

                                        <?php } ?>
                                    <?php } else { ?>
                                        <div class="mensaje_alerta">No existe ninguna Convocatoria Vigente.</div>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    </table><br/>
                    <div class="nota_alerta">
                        <span style="text-decoration: underline;">Nota.-</span> Haga click en el titulo para postularse.
                    </div>
                </td>
            </tr>            
        </table>        
    </div>
</div>





