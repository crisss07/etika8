
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $this->tool_entidad->titulo_sitio(); ?></title>
        <link href="<?php echo $this->tool_entidad->sitio(); ?>files/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/est_publico.css" rel="stylesheet" type="text/css"/>    
        <link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/banner_etika.css" rel="stylesheet" type="text/css"/>    
        <link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/estilos_etika.css" rel="stylesheet" type="text/css"/>    
        <!--<link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/convocatorias.css" rel="stylesheet" type="text/css"/> -->
        <link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/convocatoriasC.css" rel="stylesheet" type="text/css"/>    
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
        <style type="text/css">

        @media (max-width: 768px) {
           .container-fluid{
                min-height: 310px;
            }
        }
           
        </style>
    </head>
    <body>
        <div class="container-fluid box-banner text-center">
            <div class="row">
                <div class="col-xl-4">
                    <img class="logo" src="<?php echo $this->tool_entidad->sitio() . 'files/img/logo-etika.png'; ?>" />
                </div>
                <div class="col-xl-8" style="margin-top: 10px;" id="menu_encabezado">
                    <nav class="navbar navbar-expand-sm navbar-light bg-light" style="background-color: transparent !important;">
                        <button class="navbar-toggler" style="background-color: #DD6339;" type="button" data-toggle="collapse" data-target="#opciones">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                        
                        <!-- logo -->
                        
                        <!-- enlaces -->
                        <div class="collapse navbar-collapse" id="opciones" style="background-color: transparent !important;">   
                          <ul class="navbar-nav">
                            <li class="nav-item">
                              <a href="" style="text-decoration: none; color: white; background-color: #DD6339; margin-right: 50px; padding: 7px;">CONVOCATORIAS</a>
                            </li>
                            <li class="nav-item">
                              <a href="https://www.etika.com.bo/servicios/" style="text-decoration: none; color: white; margin-right: 50px;">SERVICIOS</a>
                            </li>
                            <li class="nav-item">
                              <a href="https://www.etika.com.bo/quienes-somos/" style="text-decoration: none; color: white; margin-right: 50px;">QUIÉNES SOMOS</a>
                            </li>
                            <li class="nav-item">
                              <a href="https://www.etika.com.bo/category/noticias/" style="text-decoration: none; color: white; margin-right: 50px;">NOTICIAS</a>
                            </li>
                            <li class="nav-item">
                              <a href="https://www.etika.com.bo/contacto/" style="text-decoration: none; color: white; margin-right: 50px;">CONTACTO</a>
                            </li>            
                          </ul>
                        </div>
                    </nav>
                </div>
                <br>
                <div class="col-xl-3"  style="height: 80px;padding-left:15px;background-color:rgba(236, 103, 59, 0.8);padding-top: 10px; padding-left: 30px; margin-bottom: 40px; text-align: left;">
                    <h2 style=" color: white; font-size: 30px;">CONVOCATORIAS<br><a href=""  style="color: white; font-size: 10px; text-decoration: none;">Inicio | </a><a href=""  style="color: white; font-size: 10px; text-decoration: none;">Convocatorias</a></h2>
                </div>
            </div>

        </div>





        <hr id="hr_banner">
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
        <footer class="text-center" style="background-image: url('<?php echo $this->tool_entidad->sitio()."files/img/footer.jpg"; ?>'); height: 210px;">
            <style>
                .padre_footer{
                    height: 210px;
                    display: flex;
                    align-items: center;
                    font-size: 15px;
                }

                .hijo_footer{
                    width: 33%;
                    color: white;
                    padding: 10px;
                }
                .espacio{
                    height: 10px;
                }

                @media (max-width: 768px) {
                   #hijo_1{
                        width: 26%;
                        color: white;
                        padding: 10px;
                    }

                    #hijo_2{
                        width: 37%;
                        color: white;
                        padding: 10px;
                        font-size: 9px;
                        text-align: left;
                    }

                    #hijo_3{
                        width: 37%;
                        color: white;
                        padding: 10px;
                        font-size: 9px;
                        text-align: left;
                    }

                    .contenido{
                        font-size: 8px;
                    }

                    .contenido_imagen{
                      width: 15px; 
                      height: 15px;
                    }

                    .pie-footer{
                        font-size: 8px;
                    }
                }
            </style>
                <div class="padre_footer">
                    <div class="hijo_footer" id="hijo_1">
                        <a href="https://www.etika.com.bo/">
                            <img style="width: 40%;" src="<?php echo $this->tool_entidad->sitio() . 'files/img/logo-footer.png'; ?>">
                        </a>
                        
                    </div>
                    <div class="hijo_footer" id="hijo_2" style="text-align: left;">
                        La Paz
                            <table class="table-footer" style="color: white; font-size: 13px;">
                                <tr style="height: 10px">
                                    <td class="contenido">
                                      <img style="margin-right: 10px;" src="<?php echo $this->tool_entidad->sitio() . 'files/img/iconos/footer-image-1.png'; ?>">
                                    </td>
                                    <td class="contenido">
                                        Edif. Ignacio de Loyola, oficina 110, Av. Héctor Ormachea Nº 315, Obrajes calle 12, La Paz - Bolivia
                                    </td>
                                </tr>
                                <tr class="espacio"></tr>
                                <tr>
                                    <td class="contenido">
                                        <img src="<?php echo $this->tool_entidad->sitio() . 'files/img/iconos/footer-image-2.png'; ?>">
                                    </td>
                                    <td class="contenido">
                                        (591-2) 2785604
                                    </td>
                                </tr>
                                <tr class="espacio"></tr>
                                <tr>
                                    <td class="contenido">
                                        <img src="<?php echo $this->tool_entidad->sitio() . 'files/img/iconos/footer-image-3.png'; ?>">
                                    </td>
                                    <td class="contenido">
                                        <a style="text-decoration: none; color: white;" href="mailto:infoetika@etika.net.bo"><strong>infoetika@etika.net.bo</strong></a>
                                    </td>
                                </tr>
                            </table>
                            <br class="visible-xs">
                    </div>
                    <div class="hijo_footer" id="hijo_3" style="text-align: left;">
                            Santa Cruz
                        <table class="table-footer" style="color: white; font-size: 13px;">
                            <tr>
                                <td class="contenido">
                                    <img style="margin-right: 10px;" src="<?php echo $this->tool_entidad->sitio() . 'files/img/iconos/footer-image-1.png'; ?>">
                                </td>
                                <td class="contenido">
                                    Calle Dechia Nº 8 – Zona Urbarí Norte, Santa Cruz de la Sierra - Bolivia
                                </td>
                            </tr>
                            <tr class="espacio"></tr>
                            <tr>
                                <td class="contenido">
                                    <img src="<?php echo $this->tool_entidad->sitio() . 'files/img/iconos/footer-image-2.png'; ?>">
                                </td>
                                <td class="contenido">
                                    (591-3) 3516140
                                </td>
                            </tr>
                            <tr class="espacio"></tr>
                            <tr>
                                <td class="contenido">
                                    <img src="<?php echo $this->tool_entidad->sitio() . 'files/img/iconos/footer-image-3.png'; ?>">
                                </td>
                                <td class="contenido">
                                    <a style="text-decoration: none; color: white;" href="mailto:recepcion@etika.net.bo"><strong>recepcion@etika.net.bo</strong></a>
                                </td>
                            </tr>
                            <tr class="espacio"></tr>
                        </table>
                        <div>
                            <a href="https://www.facebook.com/etikasrl/" target="_blank">
                                <svg class="contenido_imagen" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
                                    <path fill="#FFFFFF" d="M17.217,30H10.75V15.001H7.5V9.813h3.25V6.718C10.75,2.501,12.563,0,17.782,0h4.313v5.156h-2.686
                                        c-2.033,0-2.158,0.751-2.158,2.095l-0.033,2.562L22.5,9.875v5.063l-5.282,0.063V30z">
                                    </path>
                                </svg>
                            </a>
                            <a href="https://www.linkedin.com/company/etika-desarrollo-organizacional/" target="_blank">
                                <svg class="contenido_imagen" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
                                    <path fill="#FFFFFF" d="M3.635,7.532h-0.05C1.418,7.532,0,6.089,0,4.27c0-1.844,1.443-3.263,3.664-3.263
                                        c2.212,0,3.581,1.418,3.63,3.263C7.294,6.089,5.876,7.532,3.635,7.532z M6.872,28.993H0.447V10.096h6.425V28.993z M30,28.993h-6.422
                                        V18.887c0-2.543-0.922-4.264-3.237-4.264c-1.766,0-2.841,1.15-3.288,2.291c-0.173,0.401-0.223,0.972-0.223,1.522v10.557h-6.401
                                        c0,0,0.078-17.107,0-18.897h6.401v2.688c0.848-1.294,2.39-3.114,5.776-3.114c4.23,0,7.394,2.688,7.394,8.489V28.993z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                        
                    </div>
                            
                </div>
                <div class="justify-content-center s-margin s-padding" style="background-color:#6A6351;height:60px;color:white;">
                    <div class="col-lg-5" align="left" style="display: inline-block;">
                        <span class="pie-footer">
                        <br>
                        © 2021 ETIKA
                        </span>
                    </div>

                    <div class="col-lg-5" align="right" style="display: inline-block;">
                        <span class="pie-footer">
                        <br>
                        Diseñado y Desarrollado por Dibeltecnologia
                        </span>
                    </div>
                </div>
            </footer>


        
    </body>
</html>



