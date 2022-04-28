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
            <img class="solo_logo" style="margin: 15px;" src="<?php echo $this->tool_entidad->sitio().'files/img/solo-logo.png';?>">
            <div class="d-flex justify-content-center align-items-center box-titulo" style="margin-right: 60px; margin-left: 60px;">
                <h2 class="text-center" style="font-size: 16px; text-transform: none; color: white; font-weight: 600;"><?php echo $fila['con_encabezado_redes']; ?></h2>
            </div>
            <!-- <img class="solo_logo" style="margin: 30px; width: 10%;" src="<?php echo $this->tool_entidad->sitio().'archivos/cliente/LogoCobee_229.png';?>"> -->
            <div class="justify-content-center align-items-center box-titulo" style="margin-top: 250px; margin-bottom: 350px;">
                <h2 class="text-center" style="font-size: 45px; color: #222E3E; " ><?php echo $fila['con_cargo'] ?></h2>
                <h4 style="font-size: 16px; text-transform: capitalize; color: #222E3E;">(Sede: <?php echo $fila[$prefijo . 'sede']; ?>)</h4>
            </div>
            
            <div class="box-convocatoria-titulo_2" id="titulo_imagen2" style="margin-top: 40%; margin-bottom: 13.7%;">
                <br>
                    <div class="align-items-left box-titulo">
                        <h2 style="text-align: left; text-transform: none; margin-left: 25px; font-size: 16px; font-weight: 100;"><?php echo $fila['con_avance'] ?></h2>
                    </div>
            </div>
            <div style="background-color: white; margin-left: -15px;">
                <table>
                    <tr>
                        <td style="width: 80%">
                            <div style="padding: 20px;  color: black; text-align: left;">
                                <p>Para mayor información a postulación a:<br>
                                http://www.etika.bo/index.php/convocatorias hasta el <?php echo $fila[$prefijo . 'tope']; ?></p>
                            </div>
                        </td>
                        <td style="width: 20%;">
                            <img style="width: 70%; margin-left: 60px;" src="<?php echo $this->tool_entidad->sitio().'files/img/plantillas/codigoQR.jpeg';?>">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
    </div>
    <br/>
</div>

