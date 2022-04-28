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
            <div class="row">
                <div class="col-md-12 box-convocatoria-titulo_2">
                    <div class="d-flex justify-content-center align-items-center box-titulo">
                        <h2 class="text-center" style="font-size: 25px;"><?php echo $fila['con_cargo'] ?></h2>
                    </div>
                </div>
                <div class="col-md-12 box-convocatoria-contenido" id="imagenes_3">
                    <!--<br/>-->
                    <div class="box-fecha-sede" style="float: left; margin-top: 10px;">
                        <span style="font-size: 15px;"><b>Fecha Tope: </b><?php echo $fila['con_tope']; ?></span>
                    </div>
                    <div class="box-fecha-sede" style="float:right;">
                        <span style="font-size: 15px;"><b>Sede: </b><?php echo $fila['con_sede']; ?></span>
                    </div>
                    <div style="clear: both"></div>
                    <div style="margin: 0 100px; padding: 20px;  color: black; background-color: white; opacity: 0.8; border-radius: 5%;">
                        <p><?php echo $fila['con_descripcion']; ?></p>
                    </div>
                    <br>
                    <div class="row d-flex justify-content-around" >
                        <a href="<?php echo $sitio; ?>convocatorias">Ver convocatorias</a>
                        <a href="<?php echo $this->tool_entidad->sitio(); ?>index.php/convocatoria/index/id/<?php echo $id; ?>"  target="_blank" class="btn btn-default btn-etika" style="margin-bottom: 10px;">Postular &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    </div>
                </div>

                <!--<div class="col-md-2 box-convocatoria-titulo_2">
                    <div class="d-flex justify-content-center align-items-center box-titulo">
                        <h2 class="text-center" style="font-size: 25px;"><?php echo $fila['con_cargo'] ?></h2>
                    </div>

                </div>-->
            </div>
        </div>
    </div>
    <br/>
</div>