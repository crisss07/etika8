<?php
$prefijo = $this->prefijo;
$sitio = $this->tool_entidad->sitioindex();
?>
<style type="text/css">
    #imagenes_2{
    
    background-image: url(<?php echo $this->tool_entidad->sitio().$plantilla;?>);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    
    color: white;
    width: 100%;
    min-height: 320px;
}
</style>
<br/>
<!-- <?php print_r($fila['img_id']);?>  -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 imagen" id="imagenes_2">
            <img class="solo_logo" style="margin: 15px; " src="<?php echo $this->tool_entidad->sitio().'files/img/solo-logo.png';?>">
            <div class="d-flex justify-content-center align-items-center box-titulo" style="margin-right: 90px; margin-left: 90px; background-color: #91989D; opacity: 0.8;">
                <h2 class="text-center" style="font-size: 16px; padding-top: 30px; text-transform: none; color: white; font-weight: 600;"><?php echo $fila['con_encabezado_redes']; ?></h2>
            </div>
            <div class="justify-content-center align-items-center box-titulo" style="margin-top: 350px; margin-bottom: 120px; background-color: #878A91; opacity: 0.8; margin-right: 90px; margin-left: 90px; padding-top: 30px; padding-bottom: 30px;">
                <h2 class="text-center" style="font-size: 45px; color: white; " ><?php echo $fila['con_cargo'] ?></h2>
                <h4 style="font-size: 16px; text-transform: capitalize; color: white;">(Sede: <?php echo $fila[$prefijo . 'sede']; ?>)</h4>
            </div>

            <div class="justify-content-center align-items-center box-titulo" style="margin-bottom: 20px;">
                <img style="width: 12%;" src="<?php echo $this->tool_entidad->sitio().'files/img/plantillas/codigoQR.jpeg';?>">
            </div>
            
            
            <div style="background-color: white;  margin-left: -15px; width: 104.2%;">
                <div style="padding: 20px;  color: black; text-align: left;">
                    <p>Para mayor información a postulación a:<br>
                    http://www.etika.bo/index.php/convocatorias hasta el <?php echo $fila[$prefijo . 'tope']; ?></p>
                </div>
            </div>
        </div>
        
    </div>
    <br/>
</div>
