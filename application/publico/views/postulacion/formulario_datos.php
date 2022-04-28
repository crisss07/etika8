<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sitio = $this->tool_entidad->sitioindex();
$prefijo = $this->prefijoF;
?>
<div class="container">
    <br/>
    <br/>
    <div class="row justify-content-md-center align-items-md-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12">
                    <div class="box-acordeon">
                        <div class="row">
                            <div class="col-md-4">
                                <h2 class="text-left" style="color: #ffffff;">Datos Personales
                                    <?php
                                    if ($arrayFechas['fdp'] != '')
                                        echo'<br/><span class="box-fecha-modificacion-responsive">última modificación ' . $arrayFechas['fdp'] . '</span>';
                                    ?> 
                                </h2>
                            </div>
                            <div class="col-md-4 box-fecha-modificacion">
                                <h2 class="text-left" style="color: #ffffff;">
                                    <?php
                                    if ($arrayFechas['fdp'] != '')
                                        echo'última modificación ' . $arrayFechas['fdp'];
                                    ?>
                                </h2>
                            </div>
                            <div class="col-4 col-md-4">
                                <h4 class="">
                                    <?php echo anchor($this->controlador . 'editar_datospersonal/id/' . $id, 'Editar', array('class' => 'enlace-nuevo')); ?>
                                </h4>
                            </div>
                        </div>
                    </div>  
                </div>

                <?php
                echo anchor($this->controlador . 'cvtemporal', 'Continuar con postulación', array('class' => 'btn-etika btn'));
                ?>
            </div>
        </div>        
    </div>
</div>
