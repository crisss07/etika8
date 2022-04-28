<?php
//header("Content-Type: text/html;charset=ISO-8859-1");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title><?php echo $this->tool_entidad->titulo_sitio(); ?></title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link href="<?php echo $this->tool_entidad->sitio(); ?>files/bootstrap/css/bootstrap.min.css" rel="stylesheet"/> -->
    <link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/estilos_etika.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/est_privado.css" rel="stylesheet" type="text/css"/>
    <?php
        //echo link_tag('/files/css/est_privado.css', 'stylesheet', 'text/css');
    ?>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <!-- <script  src="https://code.jquery.com/jquery-3.6.0.min.js"  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script> -->
    <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.28.14/js/jquery.tablesorter.min.js'></script> -->

    <!-- <script src="<?php echo $this->tool_entidad->sitio(); ?>files/js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script> -->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->tool_entidad->sitio(); ?>files/dropify/dist/css/dropify.min.css">
    <script src="<?php echo $this->tool_entidad->sitio(); ?>files/js/funcionesjs.js" type="text/javascript"></script>
    <script src="<?php echo $this->tool_entidad->sitio(); ?>files/js/tinymce/jquery_tiny_mce/jquery.tinymce.js" type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo $this->tool_entidad->sitio(); ?>files/js/calendar/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->tool_entidad->sitio(); ?>files/js/calendar/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->tool_entidad->sitio(); ?>files/js/calendar/css/steel/steel.css" />
    <script src="<?php echo $this->tool_entidad->sitio(); ?>files/js/calendar/js/jscal2.js"></script>
    <script src="<?php echo $this->tool_entidad->sitio(); ?>files/js/calendar/js/lang/es.js"></script>
    <script src="<?php echo $this->tool_entidad->sitio(); ?>files/dropify/dist/js/dropify.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('textarea.tinymce').tinymce({
                    // Location of TinyMCE script
                    script_url: '<?php echo $this->tool_entidad->sitio(); ?>files/js/tinymce/jquery_tiny_mce/tiny_mce_gzip.php',

                    // General options
                    theme: "advanced",
                    plugins: "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

                    //pegar texto
                    paste_use_dialog: false,
                    paste_auto_cleanup_on_paste: true,
                    paste_insert_word_content_callback: "convertWord",
                    paste_remove_styles: true,

                    // Theme options
                    relative_urls: false,
                    //document_base_url : "http://www.domain.org/",
                    //external_image_list_url : "myfilehere",
                    theme_advanced_buttons1: "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                    theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                    theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                    theme_advanced_buttons4: "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
                    theme_advanced_toolbar_location: "top",
                    theme_advanced_toolbar_align: "left",
                    theme_advanced_statusbar_location: "bottom",
                    theme_advanced_resizing: true,

                    // Example content CSS (should be your site CSS)
                    //content_css : "css/example.css",
                    content_css: "<?php echo $this->tool_entidad->sitio(); ?>files/css/editor_tiny.css",

                    // Drop lists for link/image/media/template dialogs
                    template_external_list_url: "lists/template_list.js",
                    external_link_list_url: "lists/link_list.js",
                    external_image_list_url: "lists/image_list.js",
                    media_external_list_url: "lists/media_list.js",

                    // Replace values for the template plugin
                    template_replace_values: {
                        username: "Some User",
                        staffid: "991234"
                    }
                });
        });
        function convertWord(type, content) {
            switch (type) {
                    // Gets executed before the built in logic performes it's cleanups
                    case "before":
                        // do nothing
                        break;

                        // Gets executed after the built in logic performes it's cleanups
                        case "after":
                        content = content.replace(/<(!--)([\s\S]*)(--)>/gi, "");
                        break;
                    }
                    return content;
                }
                $().ready(function () {
                    $(".input1").keypress(function (event) {
                        var keyVal = (event.charCode ? event.charCode : ((event.keyCode) ? event.keyCode : event.which));
                        if (keyVal == 34 || keyVal == 39) {
                            alert("No puede Introducir este Caracter Especial al Contenido");
                            return false;
                        }
                    });
                });
                function Mayusculas(obj, id) {
                    obj = obj.toUpperCase();
                    document.getElementById(id).value = obj;
                }
            </script>


        </head>

        <body>
            <?php
            $sitiop = $this->tool_entidad->sitiopri();
            ?>

            <div id="contenedor">
                <!--table width="100%"-->
                <div id="cabeza">
                    <div id="cabeza_titulos">
                        <table width="100%" border="0" class="tabla_cabeza">
                            <tr>
                                <td width="50%" valign="middle" align="left">
                                    <img width="500px" src="<?php echo $this->tool_entidad->rutaimg(); ?>privado/logo-etika.png" alt="logo">
                                </td>
                                <td width="350" valign="top">

                                    <div class="cuadro_usuario" style="color:white;">
                                        <a style="color:white;" href="<?php echo $sitiop . 'inicio/cerrar_session'; ?>" class="enlace_a1">Cerrar sesión</a>
                                        <br/>
                                        <?php
                                        if ($_SESSION[$this->presession . 'permisos'] == '1') {
                                            echo anchor('usuario', 'Administrar Usuarios Etikos', array('class' => 'enlace_a1','style'=>'color:white;'));
                                        } else {
                                            echo anchor('usuario/cambiarpasself', 'Cambiar mi contraseña', array('class' => 'enlace_a1','style'=>'color:white;'));
                                        }
                                    //echo anchor('#','Administrar usuarios',array('class'=>'enlace_a1'));
                                        ?>                                                            
                                        <br/>
                                        Usuario: <strong><?php echo $_SESSION[$this->presession . 'usuario']; ?></strong>
                                        <br>
                                        <a style="color:white;" target="_blank" href="https://www.dropbox.com/sh/6opze1cljvy8os9/AACC58T7MjK0Xo1xZ_tI2eA0a?dl=0" class="enlace_a1">Caja de Herramientas</a>

                                    </div>

                                </td>
                            </tr>
                            <br>
                            <tr>
                             <td colspan="2">
                                 <br>
                                 <br>
                             </td>
                         </tr>
                         <tr>
                             <td colspan="2" valign="middle">
                                <div align="center">
                                   <div class="titulo_cliente" >
                                      <?php echo $this->tool_entidad->titulo_sitio(); ?>
                                  </div>
                              </div>
                          </td>
                      </tr>
                  </table>

              </div>
              <style>
                  /* menu */



/* menu desplegable */

#cabeza_menu_arriba ul ul {
 display:none;
 position:absolute;
 top:100%;
 left:0;
 background:#EC673B;
 padding:0;
}

/* items del menu desplegable */



/* enlaces de los items del menu desplegable */

#cabeza_menu_arriba ul ul a {
 line-height:120%;
 padding:10px 15px;
}

/* items del menu desplegable al pasar el ratón */

#cabeza_menu_arriba ul li:hover > ul {
 display:block;
}
              </style>

              <div id="cabeza_menu_arriba">
                <div class="menu_horizontal">
                    <ul style="padding:0 auto 0 auto;z-index:100;">
                        <?php $est1 = 'menu_activo'; ?>
                        <li>
                            <a href="<?php echo $sitiop . 'cliente/listar'; ?>" class="<?php if (isset($this->boton) == 1) {
                                echo $est1;
                            } ?>">Clientes</a>
                        </li>
                        <li class="principal">
                            <a href="<?php echo $sitiop . 'convocatoria'; ?>" class="<?php if (isset($this->boton) == 3) {
                                echo $est1;
                            } ?>">Convocatorias</a>
                        </li>
                        <li class="principal">
                            <a href="<?php echo $sitiop . 'postulacion'; ?>" class="<?php if (isset($this->boton) == 4) {
                                echo $est1;
                            } ?>">Postulaciones</a>
                        </li>
                        <li class="principal">
                            <a href="<?php echo $sitiop . 'noticias/listar'; ?>" class="<?php if (isset($this->boton) == 5) {
                                echo $est1;
                            } ?>">Noticias</a>
                        </li>

                        <li class="principal">
                            <a href="<?php echo $sitiop . 'reportes'; ?>" class="<?php if (isset($this->boton) == 6) {
                                echo $est1;
                            } ?>">Reportes</a>
                        </li>
                        <?php if ($_SESSION[$this->presession . 'permisos'] == '1' || $_SESSION[$this->presession . 'permisos'] == '2') { ?>
                            <li class="principal">
                                <a href="<?php echo $sitiop . 'configuracion'; ?>" class="<?php if (isset($this->boton) == 7) {
                                    echo $est1;
                                } ?>">Configuraciones</a>
                            </li>
                        <?php } ?>
                        <li class="principal">
                                
                                <a href="#" class="menu_activo">Evaluaci&oacute;n</a>
                                <ul>
                                 <?php if ($_SESSION[$this->presession . 'permisos'] == '1') { ?>
                               <li><a href="<?php echo $sitiop . 'Plantilla/listar'; ?>" class="<?php if (isset($this->boton) == 5) {
                                    echo $est1;
                                } ?>">Plantillas</a></li>
                                 <?php } ?>
                                   <li><a href="<?php echo $sitiop . 'Evaluacion/listar'; ?>" class="menu_activo">Grupo de Evaluaci&oacute;n</a></li>
                                   <li><a href="<?php echo $sitiop . 'Seguimiento/listar'; ?>" class="menu_activo">Seguimiento</a></li>
                                   
                               </ul>
                           </li> 
                       <?php if ($_SESSION[$this->presession . 'permisos'] == '1') { ?>
                            <!--     <li class="principal">
                                    <a href="<?php echo $sitiop . 'logs'; ?>" class="<?php if (isset($this->boton) == 8) {
        echo $est1;
    } ?>">Logs ETIKO</a>
</li> -->

<?php } ?>

</ul>


<!-- menu horizontal 2 -->              
<!-- fin menu hotizonal 2-->             
</div>          
</div>
<!--/table-->
<div id="cuerpo">
    <table align="center" width="90%">              
        <tr>
            <td align="center">
                <div id="cuerpo_cen"><?php echo $contenido; ?></div>
            </td>
        </tr>
    </table>
</div>

<div id="pie">
    <table align="center" cellspacing="0" style="width:100%; margin:0px;padding:0px;">    
       <tr id="pie-etika" style="height:165px;">
        <td align="center" colspan="2">
            <span id="siteseal"><script type="text/javascript" src="https://seal.starfieldtech.com/getSeal?sealID=4oh6MsPttpdX2y1QrCCBWoB7Yv44YWMUBhnmPY0gOlefiKREodbVZiLevGl0"></script><br/><a style="font-family:arial;font-size:12px;color:white;text-decoration:none;" href="http://www.starfieldtech.com" target="_blank">SSL Certificate</a>
            </span>
        </td>
    </tr>
    <tr style="background-color:#5f5846;height:50px;color:white;font-size: 12px;">
      <td width="50%" align="center">
          <p>© <?php echo date("Y"); ?> ETIKA</p>
      </td>
      <td width="50%" align="center">
          <p class="sin-padding">Diseño y Desarrollo Web: <a style="color:white; text-decoration: none;" href="https://www.dibeltecnologia.com/" target="_blank">Dibel Soluciones en Tecnología</a></p>
      </td>
  </tr>
</table> 
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    
</body>
</html>
<style>

</style>