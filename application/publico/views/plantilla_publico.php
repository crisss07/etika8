<?php
 header("Content-Type: text/html;charset=ISO-8859-1");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>    
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title><?php echo $this->tool_entidad->titulo_sitio();?></title>
    <link href="<?php echo $this->tool_entidad->sitio();?>files/css/est_publico.css" rel="stylesheet" type="text/css"/>    
    <script src="<?php echo $this->tool_entidad->sitio();?>files/js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>
    <script src="<?php echo $this->tool_entidad->sitio();?>files/js/funcionesjs.js" type="text/javascript"></script>
    <script src="<?php echo $this->tool_entidad->sitio();?>files/js/tinymce/jquery_tiny_mce/jquery.tinymce.js" type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo $this->tool_entidad->sitio();?>files/js/calendar/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->tool_entidad->sitio();?>files/js/calendar/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->tool_entidad->sitio();?>files/js/calendar/css/steel/steel.css" />
    <link rel="icon" type="image/ico" href="<?php echo $this->tool_entidad->sitio();?>files/img/favicon.ico">

    <script src="<?php echo $this->tool_entidad->sitio();?>files/js/calendar/js/jscal2.js"></script>
    <script src="<?php echo $this->tool_entidad->sitio();?>files/js/calendar/js/lang/es.js"></script>
    <script type="text/javascript">
        function mensaje_datos() {
            alert("Debe completar los Datos Personales para pasar a otra pestaña.");
        }
        function mensaje_instruccion() {
            alert("Debe completar la Instrucción Formal para pasar a otra pestaña.");
        }
        function mensaje_educacion() {
            alert("Debe tener al menos un campo llenado en Educación Secundaria para poder pasar.");
        }
        function mensaje_trayectoria() {
            // alert("Debe tener al menos un campo en Trayectoria Laboral y llenar la Síntesis de Experiencia Laboral para poder pasar.");
            alert("Debe tener llenado Síntesis de Experiencia Laboral para poder pasar.");
        }
        function mensaje_editar_cv1() {
            alert("No puede editar su Curriculum Vitae hasta que terminen sus Postulaciones a los Cargos.");
        }
        function mensaje_editar_cv2() {
            alert("No puede editar su Curriculum Vitae por su Disponibilidad.");
        }
        function Mayusculas(obj,id){
            obj = obj.toUpperCase();
            document.getElementById(id).value = obj;
        }
    </script>
</head>
<body id="fondo_ingreso">
    <?php    
    $sitiop=$this->tool_entidad->sitiopri();
    switch ($this->bloquear_enlaces){
        case 1:
            $bloquear_tab2=1;
            $bloquear_tab3=1;
            $bloquear_tab4=1;
            $mensaje='mensaje_datos()';
            break;
        case 2:
            $bloquear_tab3=1;
            $bloquear_tab4=1;
            $mensaje='mensaje_instruccion()';
            break;
        case 3:
            $bloquear_tab3=1;
            $bloquear_tab4=1;
            $mensaje='mensaje_educacion()';
            break;
        case 4:
            $bloquear_tab4=1;
            $mensaje='mensaje_trayectoria()';
            break;
    }
    ?>
    <div id="contenedor">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td bgcolor="#2d637b" align="center" valign="top" width="160">
                    <div class="logo_etika_inicio"><img src="<?php echo $this->tool_entidad->sitio().'files/img/maq/logo_etika.jpg';?>" title="ETIKA" /></div>
                </td>
                <td bgcolor="#ffffff" valign="top" align="center">
                    <div class="banner_etika_inicio" >
                        <img src="<?php echo $this->tool_entidad->sitio().'files/img/maq/banner.jpg';?>" title="ETIKA" />                        
                        <div class="banner_letrasg" algin="center">SISTEMA DE POSTULACIÓN</div><br/>                        
                    </div>
                    <?php if ($this->bloquear_enlaces != 1) { ?>
                    <div id="cabecera_abajo">
                        <table width="820" cellpadding="5" border="0">
                                <tr>                                    
                                    <td valign="middle" align="left">
                                        <span style="color:#3E677B; font-weight: bold;" >USUARIO: </span> <span style="color:#695E4B; font-weight: bold;" ><strong><?php echo $_SESSION[$this->presession . 'usuario']; ?></strong></span><br/>
                                        <span style="color:#3E677B; font-weight: bold;" >NOMBRE: </span> <span style="color:#695E4B; font-weight: bold;" ><strong><?php echo $_SESSION[$this->presession . 'nombre']; ?></strong></span>
                                    </td>
                                    <td valign="top" align="right">
                                        <table cellpadding="2">
                                            <tr>
                                                <?php if (!$paginicio) { ?>
                                                <td valign="bottom" align="center">
                                                    <a href="<?php echo $sitiop . 'inicio'; ?>" class="enlace_a1"><img border="0" src="<?php echo $this->tool_entidad->sitio().'files/img/home.png';?>" title="Pagina de Inicio" /></a>                                        
                                                </td>
                                                <?php } ?>
                                                <td valign="bottom" align="center">
                                                    <?php if($editar){?>
                                                    <a href="#" onclick="mensaje_editar_cv1()" class="enlace_a1"><img border="0" src="<?php echo $this->tool_entidad->sitio().'files/img/cv.png';?>" title="Editar Curriculum Vitae" /></a>
                                                    <?php }elseif($noestado){?>
                                                    <a href="#" onclick="mensaje_editar_cv2()" class="enlace_a1"><img border="0" src="<?php echo $this->tool_entidad->sitio().'files/img/cv.png';?>" title="Editar Curriculum Vitae" /></a>
                                                    <?php }else{?>
													<?php //echo anchor('postulante/aviso','<img border="0" src="'.$this->tool_entidad->sitio().'files/img/cv.png" title="Editar Curriculum Vitae" />',array('class'=>"enlace_a1")); ?>
                                                    <?php echo anchor('postulante/editar_datospersonal/id/'.$_SESSION[$this->presession.'id'],'<img border="0" src="'.$this->tool_entidad->sitio().'files/img/cv.png" title="Editar Curriculum Vitae" />',array('class'=>"enlace_a1")); ?>
                                                    <?php } ?>                                                    
                                                </td>
                                                <td valign="bottom" align="center">
                                                    <a href="<?php echo $sitiop . 'contacto'; ?>" class="enlace_a1"><img border="0" src="<?php echo $this->tool_entidad->sitio().'files/img/contactenos.png';?>" title="Contáctenos" /></a>                                        
                                                </td>
                                                <td valign="bottom" align="center">
													<!--a href="<?php echo $sitiop . 'postulante/aviso'; ?>" class="enlace_a1"><img border="0" src="<?php echo $this->tool_entidad->sitio().'files/img/contrasena.png';?>" title="Cambiar Contraseña" /></a-->  	
                                                    <a href="<?php echo $sitiop . 'postulante/cambiarpass'; ?>" class="enlace_a1"><img border="0" src="<?php echo $this->tool_entidad->sitio().'files/img/contrasena.png';?>" title="Cambiar Contraseña" /></a>                                        
                                                </td>
                                                <td valign="bottom" align="center">
                                                    <a href="<?php echo $sitiop . 'inicio/cerrar_session'; ?>" class="enlace_a1"><img border="0" src="<?php echo $this->tool_entidad->sitio().'files/img/cerrar.png';?>" title="Cerrar Sesión" /></a>                                        
                                                </td>                                                                                                   
                                            </tr>
                                        </table>
                                    </td> 
                                </tr>
                            </table>                        
                    </div>
                    <?php } ?>
                    <div id="contenido_inicio">
                        <?php if(!$this->contenido_completo){ ?>
                      <table align="center" width="830" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                              <td colspan="2"><br/></td>
                          </tr>
                          <tr>
                              <td valign="bottom" style="border-bottom: 1px solid #b0c4c5;">
                              <table cellpadding="0" align="left" cellspacing="0">
                                      <tr>
                                          <td valign="bottom">
                                              <?php if($this->boton_actual=='Datos Personales' && $_SESSION[$this->presession.'usuario']!="us_temporal"){?>
                                              <div class="boton_datos"><?php echo anchor('postulante/editar_datospersonal/id/'.$_SESSION[$this->presession.'id'],' DATOS PERSONALES ',array ('class'=>'enlace_botones_form')); ?></div>                                              
                                              <?php }elseif($_SESSION[$this->presession.'usuario']=="us_temporal"){ ?>
                                              <div class="boton_datos"><a href="#" class="enlace_botones_form"> DATOS PERSONALES </a></div>                                              
                                              <?php }else{ ?>
                                              <div class="boton_datos"><?php echo anchor('postulante/editar_datospersonal/id/'.$_SESSION[$this->presession.'id'],' DATOS PERSONALES ',array ('class'=>'enlace_botones_form')); ?></div>                                              
                                              <?php }?>
                                          </td>
                                          <td valign="bottom">
                                              <?php if($this->boton_actual=='Instruccion Formal'){?>
                                              <div class="boton_instruccion"><?php echo anchor('postulante/instruccion_formal',' INSTRUCCIÓN FORMAL ',array ('class'=>'enlace_botones_form')); ?></div>
                                              <?php }else{
                                                  if($bloquear_tab2){
                                              ?>
                                              <div class="boton_instruccion"><a href="#" class="enlace_botones_form" onclick="<?php echo $mensaje;?>"> INSTRUCCIÓN FORMAL </a></div>
                                              <?php }else{?>
                                              <div class="boton_instruccion"><?php echo anchor('postulante/instruccion_formal',' INSTRUCCIÓN FORMAL ',array ('class'=>'enlace_botones_form')); ?></div>
                                              <?php }}?>
                                          </td>
                                          <td valign="bottom">
                                              <?php if($this->boton_actual=='Trayectoria Laboral'){?>
                                              <div class="boton_trayectoria"><?php echo anchor('postulante/trayectoria_laboral',' TRAYECTORIA LABORAL ',array ('class'=>'enlace_botones_form')); ?></div>
                                              <?php }else{
                                                  if($bloquear_tab3){
                                              ?>
                                              <div class="boton_trayectoria"><a href="#" class="enlace_botones_form" onclick="<?php echo $mensaje;?>"> TRAYECTORIA LABORAL </a></div>
                                              <?php }else{?>
                                              <div class="boton_trayectoria"><?php echo anchor('postulante/trayectoria_laboral',' TRAYECTORIA LABORAL ',array ('class'=>'enlace_botones_form')); ?></div>
                                              <?php }}?>
                                          </td>
                                          <td valign="bottom">
                                              <?php if($this->boton_actual=='Informacion Adicional'){?>
                                              <div class="boton_informacion"><?php echo anchor('postulante/informacion_adicional',' INFORMACIÓN ADICIONAL ',array ('class'=>'enlace_botones_form')); ?></div>
                                              <?php }else{
                                                  if($bloquear_tab4){
                                              ?>
                                              <div class="boton_informacion"><a href="#" class="enlace_botones_form" onclick="<?php echo $mensaje;?>"> INFORMACIÓN ADICIONAL </a></div>
                                              <?php }else{?>
                                              <div class="boton_informacion"><?php echo anchor('postulante/informacion_adicional',' INFORMACIÓN ADICIONAL ',array ('class'=>'enlace_botones_form')); ?></div>
                                              <?php }}?>
                                          </td>
                                      </tr>
                                  </table>
                              </td>
                              <td style="border-bottom: 1px solid #b0c4c5;"> &nbsp; </td>
                          </tr>
                          <tr bgcolor="#ffffff">
                              <td align="center" style="border-bottom: 1px solid #b0c4c5; border-left: 1px solid #b0c4c5; border-right: 1px solid #b0c4c5;" colspan="2" valign="top">
                                  <div id="cuerpo_cen"><?php echo $contenido; ?></div>                                  
                              </td>
                          </tr>
                      </table>
                      <?php }else{ ?>
                      <table align="center" width="830">
                          <tr>
                              <td align="center">
                                  <div id="cuerpo_cen"><?php echo $contenido; ?></div>                                  
                              </td>
                          </tr>
                      </table>
                      <?php }?>  
                        <br/>
                        <table align="center" cellpadding="8">        
                            <tr>
                                <td align="center">
                                    <span id="siteseal"><script type="text/javascript" src="https://seal.starfieldtech.com/getSeal?sealID=ycDU5wzt3jJF7WzNVpDuNfhxH8kOrL5iJCnEbzfUV6oDRp9T1Ti3Rq6vk3t"></script><br/><a style="font-family: arial; font-size: 9px" href="http://www.starfieldtech.com" target="_blank">SSL Certificate</a></span>
                                </td>
                            </tr>
                        </table>
                    </div>                    
                </td>
            </tr>            
        </table>
    </div>  
</body>
</html>
