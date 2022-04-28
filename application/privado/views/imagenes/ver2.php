<?php
$prefijo = $this->prefijo_con;
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
                        <span style="font-size: 15px;"><b>Fecha Tope: </b><?php echo $fila[$prefijo . 'tope']; ?></span>
                    </div>
                    <div class="box-fecha-sede" style="float:right; margin-right: 15px; margin-top: 10px;">
                        <span style="font-size: 15px;"><b>Sede: </b><?php echo $fila[$prefijo . 'sede']; ?></span>
                    </div>
                    <div style="clear: both"></div>
            </div>

        </div>
        <div class="col-md-8 box-convocatoria-contenido" style="background-color: #E7E4E4;">
            
            <div style="margin: 0 100px; padding: 20px;  color: black;">
                <p><?php echo $fila[$prefijo . 'descripcion']; ?></p>
            </div>
        </div>
    </div>
    <br/>
</div>