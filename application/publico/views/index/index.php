<?php
header("Content-Type: text/html;charset=ISO-8859-1");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $this->tool_entidad->titulo_sitio(); ?></title>
        
        <link href="<?php echo $this->tool_entidad->sitio(); ?>files/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/est_publico.css" rel="stylesheet" type="text/css"/>    
        <link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/banner_etika.css" rel="stylesheet" type="text/css"/>    
        <link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/estilos_etika.css" rel="stylesheet" type="text/css"/>    
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->tool_entidad->sitio(); ?>files/js/calendar/css/jscal2.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->tool_entidad->sitio(); ?>files/js/calendar/css/border-radius.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->tool_entidad->sitio(); ?>files/js/calendar/css/steel/steel.css" />
        <!-- <link rel="shortcut icon" href="/files/img/favicon.ico"> -->
        <link rel="icon" type="image/ico" href="<?php echo $this->tool_entidad->sitio();?>files/img/favicon.ico">

        <!-- <link rel="icon" href="<?php echo $this->tool_entidad->sitio();?>files/img/favicon.jpg" type="image/jpg" /> -->
        <script src="<?php echo $this->tool_entidad->sitio(); ?>files/js/jquery-3.4.1.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->tool_entidad->sitio(); ?>files/js/popper.min.js" ></script>
        <script src="<?php echo $this->tool_entidad->sitio(); ?>files/js/tooltip.min.js" ></script>
        <script src="<?php echo $this->tool_entidad->sitio(); ?>files/bootstrap/js/bootstrap.min.js" ></script>
        <script src="<?php echo $this->tool_entidad->sitio(); ?>files/js/funcionesjs.js" type="text/javascript"></script>
        <script src="<?php echo $this->tool_entidad->sitio(); ?>files/js/tinymce/jquery_tiny_mce/jquery.tinymce.js" type="text/javascript"></script>
        <script src="<?php echo $this->tool_entidad->sitio(); ?>files/js/calendar/js/jscal2.js"></script>
        <script src="<?php echo $this->tool_entidad->sitio(); ?>files/js/calendar/js/lang/es.js"></script>
        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
        <style type="text/css">
            #logo_etika_responsive{
                    width: 400px;
                    margin-top: 45px;
                }

            @media (max-width: 1024px) {
                #logo_etika_responsive{
                    width: 350px;
                    height: 100px;
                }
            }

            @media (max-width: 480px) {
                #logo_etika_responsive{
                    width: 250px;
                    height: 50px;
                }
            }
        </style>
    </head>
    <body>
        <?php
        $prefijo = $this->prefijo;
        switch (@$fila[$prefijo . 'tipodoc']) {
            case 1:
                $valor_doc1 = 'checked';
                break;
            case 2:
                $valor_doc2 = 'checked';
                break;
            case 3:
                $valor_doc3 = 'checked';
                break;
        }
        ?>

        <div class="container-fluid box-banner text-center banner-container" >
            <!--<div class="masc-banner" style="height: 100%;"></div>-->
            <div class="row justify-content-center p-relative">
                <img id="logo_etika_responsive" src="<?php echo $this->tool_entidad->sitio() . 'files/img/logo-etika.png'; ?>" />
            </div>
            <div class="row justify-content-center p-relative">
                <div class="col-md-12">
                    <br/>
                    <h2 style="color: #fff;font-size: 20px;">POSTULANTE YA REGISTRADO EN EL SISTEMA</h2>
                </div>
                <div class="col-md-12">
                    <form method="post" action="autenticar" id="form_autenticacion">
                        <input type="hidden" name="intentos" value="<?php echo @$intentos; ?>" />       
                        <div class="row justify-content-center">
                            <div class="col-md-4 col-lg-3 box-formulario-banner">
                                <?php
                                $campo1 = 'login';
                                ?>
                                <input class="input-etika" name="<?php echo $prefijo . $campo1; ?>" class="form-control" type="text" value="<?php echo @$fila[$prefijo . $campo1] ?>" placeholder="Introducir Número de Documento" autocomplete="off">
                                <?php
                                if (@$error_login)
                                    echo '<br/><div class="error"><p>' . $error_login . '</p></div>';
                                ?>
                                <!--<input class="input-etika" name="ci" class="form-control" type="password" value="<?php echo @$fila[$prefijo . $campo1] ?>" placeholder="Mi contraseÎÂ±a" autocomplete="off"/>-->
                                <?php
                                $campo2 = 'pass';
                                echo form_password(array(
                                    'name' => $prefijo . $campo2,
                                    'id' => $prefijo . $campo2,
                                    'class' => 'input-etika',
                                    'size' => '35',
                                    'placeholder' => "Mi contraseña"
                                ));
                                if (@$error_pass)
                                    echo '<br/><div class="error"><p>' . $error_pass . '</p></div>';

                                if (!empty($user_error)) {
                                    echo '<br/><div class="error" align="center"><p>' . $user_error . '</p></div>';
                                }
                                if (@$msj) {
                                    ?>                        
                                    <div class="error1" align="center">Deberia de recuperar su contraseña<br/>haga <?php echo anchor('index/recuperar', ' click aqui', array('class' => '')); ?><br/></div>
                                    <?php
                                }
                                echo anchor('index/recuperar', 'Olvide mi contraseña', array('class' => ''));
                                ?><br/><br/>
                                <input class="btn btn-default btn-etika" type="submit" name="enviar" value="INGRESAR"/>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
            <div class="row justify-content-center p-relative">
                <div class="col-md-12">
                    <br/>
                    <h2 style="color: #fff;font-size: 20px;">SOY NUEVO POSTULANTE</h2>
                </div>
                <div class="col-md-12">

                    <!--<form method="post" action="autenticar" id="form_autenticacion">-->
                    <input type="hidden" name="intentos" value="<?php echo @$intentos; ?>" />       
                    <div class="row justify-content-center">
                        <div class="col-md-4 col-lg-3 box-formulario-banner">
                            <?php if (@$mensaje) { ?>
                                <div align="center">
                                    <div class="texto_msj" style="font-size: 14px;width: auto;">
                                        <?php echo @$msje; ?>
                                    </div>
                                </div>                                    
                            <?php } ?>
                            <form method="post" action="guardar_nuevo" id="form_autenticacion">

                                <div class="row text-left">
                                    <div class="col-md-5">
                                        <label for="documento">Tipo de Documento:</label>
                                    </div>
                                    <div class="col-md-7">
                                        <?php
                                        $nombre = 'tipodoc';
                                        ?>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="documento" name="<?php echo $this->prefijo . $nombre; ?>" class="custom-control-input" value="1" <?php echo @$valor_doc1; ?> />
                                            <label class="custom-control-label" for="documento">C.I.</label>

                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="documento2" name="<?php echo $this->prefijo . $nombre; ?>" class="custom-control-input" value="2" <?php echo @$valor_doc2; ?>/>
                                            <label class="custom-control-label" for="documento2">Pasaporte</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <?php
                                        if (@$error[$prefijo . $nombre])
                                            echo '<div class="error"><p>' . @$error[$prefijo . $nombre] . '</p></div>';
                                        ?>
                                    </div>
                                </div>
                                <div class="row text-left">
                                    <!--                <div class="col-md-5 ">
                                                        <label for="ci">Mi Número de Documento:  </label>
                                                    </div>-->
                                    <div class="col-md-12">
                                        <?php
                                        $name = 'documento';
                                        ?>
                                        <input class="input-etika" name="<?php echo $this->prefijo . $name ?>" class="form-control" type="text" value="<?php echo @$fila[$prefijo . $name]; ?>" placeholder="Mi Número de Documento" autocomplete="off"/>
                                        <?php
                                        $nombre = 'ci';
                                        if (form_error($nombre))
                                            echo '<div class="error">' . form_error($nombre) . '</div>';
                                        ?> 
                                    </div>
                                </div>
                                <div class="row text-left">
                                    <div class="col-md-12">
                                        <?php
                                        $nombre = 'tipodoc';
                                        if (@$error[$this->prefijo . 'documento'])
                                            echo '<div class="error"><p>' . @$error[$this->prefijo . 'documento'] . '</p></div>';
                                        ?> 
                                        <p style="margin-bottom: 0;">En caso de CI introduzca solo los números.</p>
                                        <span class="nota-ci" data-toggle="tooltip" title="En caso de que tenga número complementario para su carnet de identidad haga click aquí.
                                        Ej: 13144071N. 
                                        Los números complementarios son casos excepcionales que no se refieren al lugar de emisión del carnet Ej: LP,SC,PT,etc.">Nota: Personas que tienen en su CI código complementario. <i class="fa fa-question-circle" aria-hidden="true" ></i>
                                               <!--<input type="radio" />--> marque aquí &nbsp; 
                                            <input name="<?php echo $this->prefijo . $nombre; ?>" type="radio" value="3" <?php echo @$valor_doc3; ?>/>
                                        </span>
                                        <!--<input type="checkbox" style="margin-bottom: 16px;"/>-->
                                    </div>
                                </div>

                                <br/>
                                <input class="btn-etika btn" type="submit" value="ENVIAR"/>
                                <div class="col-md-12">
                                    <br/>
                                    <p><?php echo @$msj; ?></p>
                                </div>
                            </form>
                                <!--<input class="btn btn-default btn-etika" type="submit" name="enviar" value="ENVIAR"/>-->
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <br/>
            <br/>
                    
       <footer class="text-center">
            <span id="siteseal">
                <script type="text/javascript" src="https://seal.starfieldtech.com/getSeal?sealID=4oh6MsPttpdX2y1QrCCBWoB7Yv44YWMUBhnmPY0gOlefiKREodbVZiLevGl0"></script><br/><a style="font-family: arial; font-size: 9px" href="http://www.starfieldtech.com" target="_blank">SSL Certificate</a>
                <p class="pie-dibel sin-padding" style="color:white; font-size: 12px;">Desarrollo Web: <a style="color:white;" href="http://www.dibeltecnologia.com/" target="_blank">Dibel Soluciones en Tecnología</a></p>
                </span>
        </footer>
        </div>
        <script type="text/javascript">
            function validar_formulario(){
                var contar = 0;
                var cual = 0
                    if (document.getElementById("documento").checked) {
                        contar++;
                        cual = 1;
                    } 
                    if (document.getElementById("documento2").checked) {
                        contar++;
                        cual = 2;
                    }
                    if (document.getElementById("documento3").checked) {
                        contar++;
                        cual = 3;
                    }

                    if (contar == 0) {

                        $('#marcar_1').html(`<div class="error"><p>Debe Seleccionar un Tipo de Documento</p></div>`);
                        return false;
                    } else {
                        $('#marcar_1').html('');
                        var tip_doc = $('#tipo_documento').val();
                        if (cual == 1) {
                            var valoresAceptados = /^[0-9]+$/;
                            if (tip_doc.match(valoresAceptados) ) {
                                $('#tip_doc_1').html(``);
                                return true;
                            } else {
                                $('#tip_doc_1').html(`<div class="error"><p>Debe Introducir solo Numeros</p></div>`);
                                return false;
                            }
                        }

                        if (cual == 2) {
                            //var valoresAceptados = /^[0-9]+$/;
                            if (tip_doc.length > 0 ) {
                                $('#tip_doc_1').html(``);
                                return true;
                            } else {
                                $('#tip_doc_1').html(`<div class="error"><p>Debe Introducir CI o Pasaporte</p></div>`);
                                return false;
                            }
                        }

                        if (cual == 3) {
                            //var valoresAceptados = /^[0-9]+$/;
                            if (tip_doc.length > 0 ) {
                                $('#tip_doc_1').html(``);
                                return true;
                            } else {
                                $('#tip_doc_1').html(`<div class="error"><p>Debe Introducir CI o Pasaporte</p></div>`);
                                return false;
                            }
                        }
                    }
            }
        </script>
    </body>
</html>