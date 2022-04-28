<!--
<?php 
$prefijo = $this->prefijo;
?>    
<div class="cuadro_intro">           
    <h1 style="text-align: center;"><?php echo $fila[$prefijo . 'cargo']; ?></h1>
    <div align="left" >Fecha Tope: <font style=" color: #333399; font-weight: bold; font-size: 12px;"><?php echo $fila[$prefijo . 'tope']; ?></font></div>
    <?php if ($fila[$prefijo . 'sede']) { ?>
        <div align="left" >Sede: <font style=" color: #333399; font-weight: bold; font-size: 12px;"><?php echo $fila[$prefijo . 'sede']; ?></font></div>
    <?php } ?>
    <div align="justify"><?php echo $fila[$prefijo . 'descripcion']; ?></div>    
</div>
-->

<?php
// header("Content-Type: text/html;charset=ISO-8859-1");
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
        <!-- <link href="<?php //echo $this->tool_entidad->sitio(); ?>files/css/convocatoriasC.css" rel="stylesheet" type="text/css"/>     -->
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
<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sitio = $this->tool_entidad->sitioindex();
?>
<br/>
<div class="container">

<?php 
$prefijo = $this->prefijo;
$sitio = $this->tool_entidad->sitioindex();
// $imagen = $plantilla['pla_nombre'];
$imagen = 'imagen1.jpg';
// $imagen = 'adidas.jpg';
$bucket_url =$this->tool_entidad->aws_url();
?>

<br/>
<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sitio = $this->tool_entidad->sitioindex();
$prefijo = 'con_';
?>
<br/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row ">
                <div class="col-md-2 box-convocatoria-titulo">
                    <div class="d-flex justify-content-center align-items-center box-titulo">
                        <h2 class="text-center h2"><?php echo $fila['con_cargo'] ?></h2>
                    </div>

                </div>
                <div class="col-md-10 box-convocatoria-contenido text-left" style="background-color: #E7E4E4;">
                    <br/>
                    <div class="box-fecha-sede">
                        <span><b>Fecha Tope: </b><?php echo $fila['con_hasta']; ?></span>
                    </div>
                    <div class="box-fecha-sede">
                        <span><b>Sede: </b><?php echo $fila['con_sede']; ?></span>
                    </div>
                    <div style="padding:20px;">
					<?php echo $fila['con_descripcion']; ?>
                    </div>
					<br/>
                    <div class="row d-flex justify-content-around">
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <br/>
</div>
    </body>
</html>



