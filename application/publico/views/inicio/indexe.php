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
<div class="container" style="position: sticky;top: 0;z-index: 10;">
    <div class="row justify-content-end">
        <div class="col-md-4">
            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #fff !important;">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <?php echo anchor('epostulante/editar_cv/id/' . $_SESSION[$this->presession . 'id'], '<img border="0" src="' . $this->tool_entidad->sitio() . 'files/img/cv.png" title="Editar Curriculum Vitae" />', array('class' => "enlace_a1")); ?>
<!--                            <a href="#"  class="enlace_a1"><img border="0" src="<?php echo $this->tool_entidad->sitio() . 'files/img/cv.png'; ?>" title="Editar Curriculum Vitae" /></a>-->
                            <!--<a href="#" onclick="mensaje_editar_cv1()" class="enlace_a1"><img border="0" src="<?php echo $this->tool_entidad->sitio() . 'files/img/cv.png'; ?>" title="Editar Curriculum Vitae" /></a>-->
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $sitiop . 'contacto'; ?>" onclick="return false;" class="enlace_a1"><img border="0" src="<?php echo $this->tool_entidad->sitio() . 'files/img/contactenos.png'; ?>" title="Contáctenos" /></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $sitiop . 'postulante/cambiarpass'; ?>" onclick="return false;" class="enlace_a1"><img border="0" src="<?php echo $this->tool_entidad->sitio() . 'files/img/contrasena.png'; ?>" title="Cambiar Contraseña" /></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $sitiop . 'inicio/cerrar_session'; ?>" onclick="return false;" class="enlace_a1"><img border="0" src="<?php echo $this->tool_entidad->sitio() . 'files/img/cerrar.png'; ?>" title="Cerrar Sesión" /></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="titulo-etika" style="font-size: 18px; color: #695E4B;">área del postulante</h2>
        </div>
    </div>
    <div class="row justify-content-center justify-content-md-around">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-6 text-left">
                    <span style="color:#000000; font-weight: bold;" >USUARIO: </span> <span style="color:#000000; font-weight: normal;" ><strong><?php echo $_SESSION[$this->presession . 'usuario']; ?></strong></span><br/>
                    <span style="color:#000000; font-weight: bold;" >NOMBRE: </span> <span style="color:#000000; font-weight: normal;" ><strong><?php echo strtoupper($_SESSION[$this->presession . 'nombre']); ?></strong></span>
<!--                    <span style="color:#3E677B; font-weight: bold;" >USUARIO: </span> <span style="color:#695E4B; font-weight: normal;" ><strong><?php echo $_SESSION[$this->presession . 'usuario']; ?></strong></span><br/>
                    <span style="color:#3E677B; font-weight: bold;" >NOMBRE: </span> <span style="color:#695E4B; font-weight: normal;" ><strong><?php echo $_SESSION[$this->presession . 'nombre']; ?></strong></span>-->
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-start justify-content-md-end justify-content-lg-end justify-content-xl-end">
                            <div class="cuadro_estado_postulante">
                                <?php if ($estado['estado']) { ?>
                                    <div class="habilitado">ESTADO: &nbsp;<?php echo anchor('postulante/ndeshabilitar/id/' . $id, 'DISPONIBLE', array('class' => "enlace_estado", 'title' => 'Está habilitado a postularse a un cargo por más de que no se vincule directamente (podría por ejemplo ser encontrado con un filtro por profesión y ser contactado).')); ?> &nbsp; </div>
                                <?php } else { ?>
                                    <div class="deshabilitado">ESTADO: &nbsp;<?php echo anchor('postulante/nhabilitar/id/' . $id, 'NO DISPONIBLE', array('class' => "enlace_estado", 'title' => 'Su información está en la Base de datos de ETIKA, por el momento usted no está disponible para postularse o ser encontrado por nuestros filtros (por ejemplo porque está trabajando).')); ?> &nbsp; </div>
                                <?php } ?>
                                <div class="nota_alerta" style="padding: 5px;"><br/>
                                    <?php if ($estado['estado']) { ?>
                                        <span style="text-decoration: underline;">Nota.-</span> Está habilitado a postularse a un cargo por más de que no se vincule directamente (podría por ejemplo ser encontrado con un filtro por profesión y ser contactado).
                                    <?php } else { ?>
                                        <span style="text-decoration: underline;">Nota.-</span> Su información está en la Base de datos de ETIKA, por el momento usted no está disponible para postularse o ser encontrado por nuestros filtros (por ejemplo porque está trabajando).            
                                    <?php } ?>                        
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-start justify-content-md-end justify-content-lg-end justify-content-xl-end">
                        <div class="col-md-6">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div style="background: #2d637b;padding: 10px 15px;border-top-right-radius: 3px;border-top-left-radius: 3px;margin-bottom: 15px;">
                <h2 class="text-left" style="color: #ffffff;">Postulaciones vigentes</h2>
            </div>
            <div class="row">

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
                    <?php
                }
                if ($postulaciones) {
                    ?>                                
                    <?php
                    foreach ($postulaciones as $postulacion) {
                        $notificacion = '';
                        ?>
                        <div class="col-md-6 text-left">
                            <div class="titulo_postulaciones" style="color: #000;">CARGO: <?php echo strtoupper($postulacion['con_cargo']); ?></div>
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
                            <span class="titulo_postulaciones" style="color: #000;">SEDE: <?php echo $postulacion['con_sede']; ?></span><br/>
                            <span>FECHA DE CIERRE DE POSTULACIÓN:</span> <span class="titulo_postulaciones" style="color: #000;"><?php echo $postulacion['con_tope']; ?></span><br/>
                            <span>Si desea</span> <span class="titulo_postulaciones" style="color: #000;">Desvincularse</span> <span>del proceso contactarse con el responsable haciendo</span> <a href="<?php echo $sitiop . 'contacto/index/cargo/' . $postulacion['con_id']; ?>" class="enlace_postulacion" title="Contactenos" onclick="return false;">click aqui</a>.
                            <?php if ($notificacion) { ?>
                                <div style="color:#B71318;" align="justify"><p>Publicación: <b><?php echo $fecha_publicacion; ?></b></p><?php echo $notificacion['notificacion']; ?></div>
                            <?php } ?>    
                            <hr/>
                        </div>
                    <?php } ?> 
                <?php } else { ?>
                    <div class="col-md-12">
                        <div class="mensaje_alerta">No se esta postulando a ningun cargo.</div>
                    </div>
                <?php } ?>   

            </div>
        </div>
        <div class="col-md-10">
            <br/>
            <div style="background: #2d637b;padding: 10px 15px;border-top-right-radius: 3px;border-top-left-radius: 3px;margin-bottom: 15px;">
                <h2 class="text-left" style="color: #ffffff;">Otras convocatorias</h2>
            </div>
            <div class="row justify-content-center" style="overflow-x:hidden;">
                <?php
                foreach ($convocatorias as $key => $value) {
                    ?>
                    <div class="col-md-4 col-sm-6 car-convocatoria">
                        <div class="row">
                            <div class="col-md-2 car-sede" style="width: 20%">
                                <span><b>Sede: </b><?php echo $value['con_sede']; ?></span>
                            </div>
                            <div class="col-md-10 d-flex justify-content-center align-items-center car-box" style="width: 80%;">
                                <div class="text-center">
                                    <h3 style="color: black; font-size: 20px;"><?php echo $value['con_cargo']; ?></h3>
                                    <span style="color: black;"><b>Fecha tope: </b><?php echo $value['con_hasta']; ?></span>
                                </div>
                                <a href="<?php echo $sitio; ?>convocatorias/ver/id/<?php echo $value['con_id']; ?>" onclick="return false;">+</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!--<div id="contenido">
    <div class="cuadro_intro">
        <br/><br/>

        <table align="center" width="820" border="0" cellpadding="2">
            tr align="center" valign="top">
                <td colspan="2" align="left">
<?php if ($editar) { ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div style="text-align: left; font-weight: bold; color: red; font-size: 14px;">No puede editar su Curriculum Vitae Hasta que terminen sus Postulaciones a los cargos</div>
<?php } elseif ($noestado) { ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div style="text-align: left; font-weight: bold; color: red; font-size: 14px;">No puede editar su Curriculum Vitae por su Estado</div>
<?php } else { ?>
    <?php echo anchor('postulante/editar_datospersonal/id/' . $id, 'Editar Curriculum Vitae', array('class' => "enlace_a1")); ?>
<?php } ?>
                </td>
            </tr
            <tr align="center" valign="top">
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
</div>-->





