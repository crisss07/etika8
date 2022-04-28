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
        <div class="col-md-8" id="imagenes_2">
            <img class="solo_logo" style="margin: 15px;" src="<?php echo $this->tool_entidad->sitio().'files/img/solo-logo.png';?>">
            <div class="box-convocatoria-titulo_2" id="titulo_imagen2">
                <br>
                    <div class="d-flex justify-content-center align-items-center box-titulo" >
                        <h2 class="text-center" style="font-size: 25px;"><?php echo $fila['con_cargo'] ?></h2>
                    </div>
                    <div class="box-fecha-sede" style="float: left; margin-left: 15px; margin-top: 10px;">
                        <span style="font-size: 15px;"><b>Fecha Tope: </b><?php echo $fila['con_tope']; ?></span>
                    </div>
                    <div class="box-fecha-sede" style="float:right; margin-right: 15px;">
                        <span style="font-size: 15px;"><b>Sede: </b><?php echo $fila['con_sede']; ?></span>
                    </div>
                    <div style="clear: both"></div>
            </div>

        </div>
        <div class="col-md-8 box-convocatoria-contenido" style="background-color: #E7E4E4;">
            
            <div style="margin: 0 100px; padding: 20px;  color: black;">
                <p><?php echo $fila['con_descripcion']; ?></p>
            </div>
            <br>
            <div class="row d-flex justify-content-around" >
                <a href="<?php echo $sitio; ?>convocatorias">Ver convocatorias</a>
                <a href="<?php echo $this->tool_entidad->sitio(); ?>index.php/convocatoria/index/id/<?php echo $id; ?>"  target="_blank" class="btn btn-default btn-etika" style="margin-bottom: 10px;">Postular &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
    <br/>
</div>