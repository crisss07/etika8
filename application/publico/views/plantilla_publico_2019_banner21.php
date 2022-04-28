<?php
header("Content-Type: text/html;charset=ISO-8859-1");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!--<meta charset="utf-8">-->
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
            <div class="row justify-content-center p-relative">
                <img style="width: 300px;margin-top: 45px;" src="<?php echo $this->tool_entidad->sitio() . 'files/img/logo_etika1.jpg'; ?>" />
            </div>
            <div class="row justify-content-center">
                <?php echo $contenido; ?>
            </div>
            <br/>
            <br/>
            <br/>
        </div>        
    </body>
</html>