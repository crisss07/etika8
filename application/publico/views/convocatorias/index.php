<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sitio = $this->tool_entidad->sitioindex();
session_destroy();
?>
<div class="container-fluid">
    <div class="row justify-content-center" style="overflow-x:hidden;">
        
        <?php
        foreach ($fila as $key => $value) {
            ?>
            <div class="col-md-4 col-sm-6 car-convocatoria2">
                <div class="row">
                    <div class="col-md-2 car-sede2" style="width: 50px;">
                        <!--<span><b>Sede: </b><?php echo $value['con_sede']; ?></span>-->
                    </div>
                    <div class="col-md-10 d-flex justify-content-center align-items-center car-box" style="width: 80%; padding: 0px; text-align: center;">
                        <div class="text-center">
                            <h5><b>Sede: </b><?php echo $value['con_sede']; ?></h5>
                            <h3 style="color: black; font-size: 20px;"><?php echo $value['con_cargo']; ?></h3>
                            <span style="color: black;"><b>Fecha tope: </b><?php echo $value['con_tope']; ?></span>
                        </div>
                        <a style="bottom: 5px;" href="<?php echo $sitio; ?>convocatorias/ver/id/<?php echo $value['con_id']; ?>">+</a>
                        
                        <!--<a style="bottom: 5px;" href="<?php echo $sitio; ?>Index/prueba">+</a>-->
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4 col-sm-8 car-convocatoria-talento">
            <div class="row"   style="height: 100%;">
                <div class="col-md-12 box-solid-talento d-flex justify-content-center align-items-center">
                    <h3 class="text-center titulos-convocatorias">SISTEMA DE POSTULACI&Oacute;N</h3>
                </div>
                <div class="col-md-12">
                    <div class="row justify-content-center align-items-center">
                        <a class="sin-estilos" href="<?php echo $sitio; ?>Convocatorias/registrate_talentos">
                            <h3 class="titulos-convocatorias">REGISTRATE EN NUESTRA BASE DE DATOS</h3>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br/>
<br/>