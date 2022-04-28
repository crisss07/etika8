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
        <!--<link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/convocatorias.css" rel="stylesheet" type="text/css"/> -->
        <link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/convocatoriasC.css" rel="stylesheet" type="text/css"/>    
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"/>

       
        
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
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row ">
                <div class="col-md-2 box-convocatoria-titulo">
                    <div class="d-flex justify-content-center align-items-center box-titulo">
                        <h2 class="text-center" style="font-size: 25px;"><?php echo $fila['con_cargo'] ?></h2>
                    </div>

                </div>
                <div class="col-md-10 box-convocatoria-contenido" id="imagenes">
                    <div class="row d-flex justify-content-around" style="margin: 15px;">
                        <img class="solo_logo" src="<?php echo $this->tool_entidad->sitio().'files/img/solo-logo.png';?>">
                    </div>
                    <!--<br/>-->
                    <div class="box-fecha-sede" style="float: left;">
                        <span style="font-size: 15px;"><b>Fecha Tope: </b><?php echo $fila[$prefijo . 'tope']; ?></span>
                    </div>
                    <div class="box-fecha-sede" style="float:right;">
                        <span style="font-size: 15px;"><b>Sede: </b><?php echo $fila[$prefijo . 'sede']; ?></span>
                    </div>
                    <div style="clear: both"></div>
                    <div style="margin: 0 100px; padding: 20px;  color: black; background-color: white; opacity: 0.8; border-radius: 5%;">
                        <p><?php echo $fila[$prefijo . 'descripcion']; ?></p>
                    </div>
                    <br>
                    <div class="row d-flex justify-content-around">
                        <a href="#">Ver convocatorias</a>
                        <a href="#"  target="_blank" class="btn btn-default btn-etika" style="margin-bottom: 10px;">Postular &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
</div>

        
    </body>
</html>



