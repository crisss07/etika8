<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title><?php echo $this->tool_entidad->titulo_sitio();?></title>
    <link href="<?php echo $this->tool_entidad->sitio();?>files/css/est_publico.css" rel="stylesheet" type="text/css"/>
    <?php
    //echo link_tag('/files/css/est_privado.css', 'stylesheet', 'text/css');
    ?>
    <script src="<?php echo $this->tool_entidad->sitio();?>files/js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>
    <script src="<?php echo $this->tool_entidad->sitio();?>files/js/funcionesjs.js" type="text/javascript"></script>
    <script src="<?php echo $this->tool_entidad->sitio();?>files/js/tinymce/jquery_tiny_mce/jquery.tinymce.js" type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo $this->tool_entidad->sitio();?>files/js/calendar/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->tool_entidad->sitio();?>files/js/calendar/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->tool_entidad->sitio();?>files/js/calendar/css/steel/steel.css" />
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
        function Mayusculas(obj,id){
            obj = obj.toUpperCase();
            document.getElementById(id).value = obj;
        }
    </script>
</head>

<body>
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
      <!--table width="100%"-->
      <div id="cabeza">
          <div id="cabeza_titulos">
              <table width="100%">
                  <tr>
                      <td align="center">
                          <img align="center" src="<?php echo $this->tool_entidad->sitio().'files/img/logo.jpg';?>" title="Sistema de Postulación" alt="Sistema de Postulación"/>
                      </td>
                      <td align="center">
                          <img align="center" src="<?php echo $this->tool_entidad->sitio().'files/img/sistema.jpg';?>" title="Sistema de Postulación" alt="Sistema de Postulación"/>
                      </td>
                  </tr>
              </table>              
          </div>              
      </div>
      <!--/table-->
      <div id="cuerpo">
          <?php if($this->bloquear_enlaces!=1) {?>
          <table width="100%" cellpadding="5" border="0">
              <tr>
                  <td align="center" width="150" valign="middle">
                      <?php if(!$paginicio){ ?>
                      <a href="<?php echo $sitiop.'inicio';?>" class="enlace_a1">Pagina de Inicio</a><br/>
                      <?php }?>
                      <a href="<?php echo $sitiop.'contacto';?>" class="enlace_a1">Contáctenos</a>
                  </td>
                  <td valign="middle" align="center">
                      Usuario: <strong><?php echo $_SESSION[$this->presession.'usuario'];?></strong><br/>
                      Nombre: <strong><?php echo $_SESSION[$this->presession.'nombre'];?></strong>
                  </td>
                  <td width="180" valign="middle" align="right">
                          <a href="<?php echo $sitiop.'inicio/cerrar_session';?>" class="enlace_a1">Cerrar sesion</a>
                          <br/>
                          <?php
                          echo anchor('postulante/cambiarpass','Cambiar mi contraseña',array('class'=>'enlace_a1'));
                          ?>                      
                  </td>
              </tr>
          </table>
          <?php }?>
          <?php if(!$this->contenido_completo){ ?>
          <table align="center" width="900" border="0" cellpadding="0" cellspacing="0">
              <tr>
                  <td colspan="2"><br/></td>
              </tr>
              <tr>
                  <td valign="bottom">
                  <table cellpadding="0" align="left" cellspacing="0">
                          <tr>
                              <td valign="bottom">
                                  <?php if($this->boton_actual=='Datos Personales'){?>
                                  <div class="boton_datos_over"><?php echo anchor('postulante/editar_datospersonal/id/'.$_SESSION[$this->presession.'id'],' &nbsp; ',array ('class'=>'enlace_botones_form')); ?></div>
                                  <?php }else{ ?>
                                  <div class="boton_datos_normal"><?php echo anchor('postulante/editar_datospersonal/id/'.$_SESSION[$this->presession.'id'],' &nbsp; ',array ('class'=>'enlace_botones_form')); ?></div>
                                  <?php }?>
                              </td>
                              <td valign="bottom">
                                  <?php if($this->boton_actual=='Instruccion Formal'){?>
                                  <div class="boton_instruccion_over"><?php echo anchor('postulante/instruccion_formal',' &nbsp; ',array ('class'=>'enlace_botones_form')); ?></div>
                                  <?php }else{
                                      if($bloquear_tab2){
                                  ?>
                                  <div class="boton_instruccion_normal"><a href="#" class="enlace_botones_form" onclick="<?php echo $mensaje;?>"> &nbsp; </a></div>
                                  <?php }else{?>
                                  <div class="boton_instruccion_normal"><?php echo anchor('postulante/instruccion_formal',' &nbsp; ',array ('class'=>'enlace_botones_form')); ?></div>
                                  <?php }}?>
                              </td>
                              <td valign="bottom">
                                  <?php if($this->boton_actual=='Trayectoria Laboral'){?>
                                  <div class="boton_trayectoria_over"><?php echo anchor('postulante/trayectoria_laboral',' &nbsp; ',array ('class'=>'enlace_botones_form')); ?></div>
                                  <?php }else{
                                      if($bloquear_tab3){
                                  ?>
                                  <div class="boton_trayectoria_normal"><a href="#" class="enlace_botones_form" onclick="<?php echo $mensaje;?>"> &nbsp; </a></div>
                                  <?php }else{?>
                                  <div class="boton_trayectoria_normal"><?php echo anchor('postulante/trayectoria_laboral',' &nbsp; ',array ('class'=>'enlace_botones_form')); ?></div>
                                  <?php }}?>
                              </td>
                              <td valign="bottom">
                                  <?php if($this->boton_actual=='Informacion Adicional'){?>
                                  <div class="boton_informacion_over"><?php echo anchor('postulante/informacion_adicional',' &nbsp; ',array ('class'=>'enlace_botones_form')); ?></div>
                                  <?php }else{
                                      if($bloquear_tab4){
                                  ?>
                                  <div class="boton_informacion_normal"><a href="#" class="enlace_botones_form" onclick="<?php echo $mensaje;?>"> &nbsp; </a></div>
                                  <?php }else{?>
                                  <div class="boton_informacion_normal"><?php echo anchor('postulante/informacion_adicional',' &nbsp; ',array ('class'=>'enlace_botones_form')); ?></div>
                                  <?php }}?>
                              </td>
                          </tr>
                      </table>
                  </td>
                  <td style="border-bottom: 1px solid black; width: 202px;"> &nbsp; </td>
              </tr>
              <tr bgcolor="#f0efed">
                  <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;" colspan="2" valign="top">
                      <div id="cuerpo_cen" ><?php echo $contenido; ?></div>
                  </td>
              </tr>
          </table>
          <?php }else{ ?>
          <table align="center" width="900">
              <tr>
                  <td align="center">
                      <div id="cuerpo_cen"><?php echo $contenido; ?></div>
                  </td>
              </tr>
          </table>
          <?php }?>
      </div>
      <div id="pie">
          <table align="center" cellpadding="8">        
              <tr>
                  <td align="center">
                      <span id="siteseal"><script type="text/javascript" src="https://seal.starfieldtech.com/getSeal?sealID=ycDU5wzt3jJF7WzNVpDuNfhxH8kOrL5iJCnEbzfUV6oDRp9T1Ti3Rq6vk3t"></script><br/><a style="font-family: arial; font-size: 9px" href="http://www.starfieldtech.com" target="_blank">SSL Certificate</a></span>
                  </td>
              </tr>
          </table>
          <!--<textarea class="tinymce">dfgshdfgh dfgh dfgh dgf</textarea>-->
      </div>
   </div>
</body>
</html>
