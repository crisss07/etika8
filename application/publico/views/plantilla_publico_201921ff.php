<?php
header("Content-Type: text/html;charset=ISO-8859-1");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $this->tool_entidad->titulo_sitio(); ?></title>
        <link href="<?php echo $this->tool_entidad->sitio(); ?>files/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/est_publico.css" rel="stylesheet" type="text/css"/>    
        <link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/banner_etika.css" rel="stylesheet" type="text/css"/>    
        <link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/estilos_etika.css" rel="stylesheet" type="text/css"/>    
        <link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/convocatorias.css" rel="stylesheet" type="text/css"/>    
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->tool_entidad->sitio(); ?>files/js/calendar/css/jscal2.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->tool_entidad->sitio(); ?>files/js/calendar/css/border-radius.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->tool_entidad->sitio(); ?>files/js/calendar/css/steel/steel.css" />

        <script src="<?php echo $this->tool_entidad->sitio(); ?>files/js/jquery-3.4.1.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->tool_entidad->sitio(); ?>files/js/popper.min.js" ></script>
        <script src="<?php echo $this->tool_entidad->sitio(); ?>files/js/tooltip.min.js" ></script>
        <script src="<?php echo $this->tool_entidad->sitio(); ?>files/bootstrap/js/bootstrap.min.js" ></script>
        <script src="<?php echo $this->tool_entidad->sitio(); ?>files/js/funcionesjs.js" type="text/javascript"></script>
        <script src="<?php echo $this->tool_entidad->sitio(); ?>files/js/tinymce/jquery_tiny_mce/jquery.tinymce.js" type="text/javascript"></script>
        <script src="<?php echo $this->tool_entidad->sitio(); ?>files/js/calendar/js/jscal2.js"></script>
        <script src="<?php echo $this->tool_entidad->sitio(); ?>files/js/calendar/js/lang/es.js"></script>
    </head>
    <body>
        <div class="container-fluid box-banner text-center">            
            <div class="row justify-content-center align-items-end">
                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-10">
                    <img class="logo" src="<?php echo $this->tool_entidad->sitio() . 'files/img/logo_etika.jpg'; ?>" />
                </div>
            </div>

        </div>
        <div class="container" style="display: none;">
            <div class="row">
                <div class="col-md-3 col-3 sin-padding">
                    <?php if ($this->boton_actual == 'Datos Personales' && $_SESSION[$this->presession . 'usuario'] != "us_temporal") { ?>
                        <div class="boton_datos"><?php echo anchor('postulante/editar_datospersonal/id/' . $_SESSION[$this->presession . 'id'], ' DATOS PERSONALES ', array('class' => 'enlace_botones_form')); ?></div>                                              
                    <?php } elseif ($_SESSION[$this->presession . 'usuario'] == "us_temporal") { ?>
                        <div class="boton_datos"><a href="#" class="enlace_botones_form"> DATOS PERSONALES </a></div>                                              
                    <?php } else { ?>
                        <div class="boton_datos"><?php echo anchor('postulante/editar_datospersonal/id/' . $_SESSION[$this->presession . 'id'], ' DATOS PERSONALES ', array('class' => 'enlace_botones_form')); ?></div>                                              
                    <?php } ?>
                </div>
                <div class="col-md-3 col-3 sin-padding">
                    <?php if ($this->boton_actual == 'Instruccion Formal') { ?>
                        <div class="boton_instruccion"><?php echo anchor('postulante/instruccion_formal', ' INSTRUCCIÓN FORMAL ', array('class' => 'enlace_botones_form')); ?></div>
                        <?php
                    } else {
                        if ($bloquear_tab2) {
                            ?>
                            <div class="boton_instruccion"><a href="#" class="enlace_botones_form" onclick="<?php echo $mensaje; ?>"> INSTRUCCIÓN FORMAL </a></div>
                        <?php } else { ?>
                            <div class="boton_instruccion"><?php echo anchor('postulante/instruccion_formal', ' INSTRUCCIÓN FORMAL ', array('class' => 'enlace_botones_form')); ?></div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="col-md-3 col-3 sin-padding">
                    <?php if ($this->boton_actual == 'Trayectoria Laboral') { ?>
                        <div class="boton_trayectoria"><?php echo anchor('postulante/trayectoria_laboral', ' TRAYECTORIA LABORAL ', array('class' => 'enlace_botones_form')); ?></div>
                        <?php
                    } else {
                        if ($bloquear_tab3) {
                            ?>
                            <div class="boton_trayectoria"><a href="#" class="enlace_botones_form" onclick="<?php echo $mensaje; ?>"> TRAYECTORIA LABORAL </a></div>
                        <?php } else { ?>
                            <div class="boton_trayectoria"><?php echo anchor('postulante/trayectoria_laboral', ' TRAYECTORIA LABORAL ', array('class' => 'enlace_botones_form')); ?></div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="col-md-3 col-3 sin-padding">
                    <?php if ($this->boton_actual == 'Informacion Adicional') { ?>
                        <div class="boton_informacion"><?php echo anchor('postulante/informacion_adicional', ' INFORMACIÓN ADICIONAL ', array('class' => 'enlace_botones_form')); ?></div>
                        <?php
                    } else {
                        if ($bloquear_tab4) {
                            ?>
                            <div class="boton_informacion"><a href="#" class="enlace_botones_form" onclick="<?php echo $mensaje; ?>"> INFORMACIÓN ADICIONAL </a></div>
                        <?php } else { ?>
                            <div class="boton_informacion"><?php echo anchor('postulante/informacion_adicional', ' INFORMACIÓN ADICIONAL ', array('class' => 'enlace_botones_form')); ?></div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <br/>
        <div class="container">
            <?php echo $contenido; ?>
        </div>
        <br/>

        <div style="clear: both;"></div>
        <footer class="text-center">
            <span id="siteseal">
                <script type="text/javascript" src="https://seal.starfieldtech.com/getSeal?sealID=ycDU5wzt3jJF7WzNVpDuNfhxH8kOrL5iJCnEbzfUV6oDRp9T1Ti3Rq6vk3t"></script><br/><a style="font-family: arial; font-size: 9px" href="http://www.starfieldtech.com" target="_blank">SSL Certificate</a>
            </span>
            <br/>
            <br/>
        </footer>
    </body>
</html>



