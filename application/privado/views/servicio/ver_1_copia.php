
<?php 
$prefijo = $this->prefijo;
$sitio = $this->tool_entidad->sitioindex();
// $imagen = $plantilla['pla_nombre'];
$imagen = 'imagen1.jpg';
// $imagen = 'adidas.jpg';
$bucket_url =$this->tool_entidad->aws_url();
?>
<style>
    #imagenes{
    background-image: url(<?php echo $this->tool_entidad->sitio().$plantilla;?>);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    color: white;
    width: 1000px;
    min-height: 500px;
}
</style>

<br/>
<div>
    <div class="container">
        <!-- <?php echo $this->tool_entidad->sitio().'files/img/plantillas/imagen1.jpg';?> -->
        <div class="row justify-content-center">
            <div class="col-md-10 imagen">
                <div class="row">
                    <!-- <?php echo $plantilla; ?> -->

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
                            <p><?php echo $fila[$prefijo . 'avance']; ?> </p>
                        </div>
                        <br>
                        <div class="row d-flex justify-content-around" style="height:60px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
    </div>
</div>




