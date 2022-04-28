<?php
$this->load->view('cabecera');
$sitio = $this->tool_entidad->sitioindex();
?>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
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
        <!--instruccion formal-->
        <div class="col-md-8 col-md-offset-2">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <!--primer item-->
                <div class="panel panel-warning">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <div class="row">
                            <div class="col-8 col-md-4">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Instrucción Formal
                                    </a>
                                    <?php
                                    if ($arrayFechas['fif'] != '')
                                        echo'<br/><span class="box-fecha-modificacion-responsive">última modificación ' . $arrayFechas['fif'] . '</span>';
                                        
                                        ?>
                                </h4>
                            </div>
                            <div class="col-md-4 box-fecha-modificacion">
                                <h4>
                                    <?php
                                    if ($arrayFechas['fif'] != '')
                                        echo'última modificación ' . $arrayFechas['fif'];
                                        
                                        ?>
                                </h4>
                            </div>
                            <div class="col-4 col-md-4">
                                <h4 class="">
                                    <?php echo anchor($this->controlador . 'instruccion_formal', 'Editar', array('class' => 'enlace-nuevo')); ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <?php
                            if ($postfecha != '' || $supfecha != '' || $sfecha != '' || $pubfecha != '') {
                                ?>
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <h4 class='text-cafe'>Formulario</h4>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <div class="row">
                                            <div class="col-md-6 col-6">
                                                <h4 class='text-cafe'>Fecha Modificación</h4>
                                            </div>
                                            <div class="col-md-6 col-6">
                                                <h4 class='text-cafe'>Editar</h4>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--educacion educacion postgrado-->                                
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <?php echo '<p class="text-left mayusculas">' . strtoupper('Educación Post Grado') . '</p>'; ?>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <div class="row justify-content-center">
                                            <?php
                                            if ($postfecha != '') {
                                                ?>
                                                <div class="col-md-6 col-6">
                                                    <?php echo '<p class="text-left">' . $postfecha . '</p>'; ?>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <?php echo anchor($this->controlador . 'instruccion_formal/id/' . $id, '<i class="fa fa-pencil-square-o fa-x5" aria-hidden="true"></i>', array('class' => 'enlace_editar')); ?>                                  
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div class="col-md-6 col-6">
                                                    <?php echo '<p class="text-left">No tiene ningun dato.</p>'; ?>
                                                </div>
                                                <div class="col-md-6 col-6">                                                
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <!--fin de educacion postgrado-->
                                <!--educacion superior-->                                
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <?php echo '<p class="text-left mayusculas">' . strtoupper('Educación Superior') . '</p>'; ?>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <div class="row justify-content-center">
                                            <?php
                                            if ($supfecha != '') {
                                                ?>
                                                <div class="col-md-6 col-6">
                                                    <?php echo '<p class="text-left">' . $supfecha . '</p>'; ?>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <?php echo anchor($this->controlador . 'instruccion_formal/id/' . $id, '<i class="fa fa-pencil-square-o fa-x5" aria-hidden="true"></i>', array('class' => 'enlace_editar')); ?>                                  
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div class="col-md-6 col-6">
                                                    <?php echo '<p class="text-left">No tiene ningun dato.</p>'; ?>
                                                </div>
                                                <div class="col-md-6 col-6">                                                
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <!--fin de educacion superior-->
                                <!--educacion secundaria-->                                
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <?php echo '<p class="text-left mayusculas">' . strtoupper('Educación Secundaria') . '</p>'; ?>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <div class="row justify-content-center">
                                            <?php
                                            if ($sfecha != '') {
                                                ?>
                                                <div class="col-md-6 col-6">
                                                    <?php echo '<p class="text-left">' . $sfecha . '</p>'; ?>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <?php echo anchor($this->controlador . 'instruccion_formal/id/' . $id, '<i class="fa fa-pencil-square-o fa-x5" aria-hidden="true"></i>', array('class' => 'enlace_editar')); ?>                                  
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div class="col-md-6 col-6">
                                                    <?php echo '<p class="text-left">No tiene ningun dato.</p>'; ?>
                                                </div>
                                                <div class="col-md-6 col-6">                                                
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <!--fin de educacion secundaria-->
                                <!--educacion publicaciones-->                                
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <?php echo '<p class="text-left mayusculas">' . strtoupper('Publicaciones') . '</p>'; ?>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <div class="row justify-content-center">
                                            <?php
                                            if ($pubfecha != '') {
                                                ?>
                                                <div class="col-md-6 col-6">
                                                    <?php echo '<p class="text-left">' . $pubfecha . '</p>'; ?>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <?php echo anchor($this->controlador . 'instruccion_formal/id/' . $id, '<i class="fa fa-pencil-square-o fa-x5" aria-hidden="true"></i>', array('class' => 'enlace_editar')); ?>                                  
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div class="col-md-6 col-6">
                                                    <?php echo '<p class="text-left">No tiene ningun dato.</p>'; ?>
                                                </div>
                                                <div class="col-md-6 col-6">                                                
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <!--fin de publicaciones-->
                                <?php
                            } else {
                                ?>
                                <p>No tiene ningun dato.</p>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Trayectoria Laboral-->
        <div class="col-md-8 col-md-offset-2">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <!--primer item-->
                <div class="panel panel-warning">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <div class="row">
                            <div class="col-8 col-md-4">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        Trayectoria Laboral
                                    </a>
                                    <?php
                                    if ($arrayFechas['ftl'] != '')
                                        echo'<br/><span class="box-fecha-modificacion-responsive">última modificación ' . $arrayFechas['ftl'] . '</span>';
                                        
                                        ?>
                                </h4>
                            </div>
                            <div class="col-md-4 box-fecha-modificacion">
                                <h4>
                                    <?php
                                    if ($arrayFechas['ftl'] != '')
                                        echo'última modificación ' . $arrayFechas['ftl'];
                                        
                                        ?>
                                </h4>
                            </div>
                            <div class="col-4 col-md-4">
                                <h4 class="">
                                    <?php echo anchor($this->controlador . 'trayectoria_laboral', 'Editar', array('class' => 'enlace-nuevo')); ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <?php
                            if ($fecha != '' || $trafecha != '') {
                                ?>
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <h4 class='text-cafe'>Formulario</h4>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <div class="row">
                                            <div class="col-md-6 col-6">
                                                <h4 class='text-cafe'>Fecha Modificación</h4>
                                            </div>
                                            <div class="col-md-6 col-6">
                                                <h4 class='text-cafe'>Editar</h4>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--sintesis de experiencia laboral-->                                
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <?php echo '<p class="text-left mayusculas">' . strtoupper('síntesis de experiencia laboral') . '</p>'; ?>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <div class="row justify-content-center">
                                            <?php
                                            if ($fecha != '') {
                                                ?>
                                                <div class="col-md-6 col-6">
                                                    <?php echo '<p class="text-left">' . $fecha . '</p>'; ?>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <?php echo anchor($this->controlador . 'trayectoria_laboral/id/' . $id, '<i class="fa fa-pencil-square-o fa-x5" aria-hidden="true"></i>', array('class' => 'enlace_editar')); ?>                                  
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div class="col-md-6 col-6">
                                                    <?php echo '<p class="text-left">No tiene ningun dato.</p>'; ?>
                                                </div>
                                                <div class="col-md-6 col-6">                                                
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <!--fin de sintesis de experiencia laboral-->
                                <!--experiencia laboral-->                                
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <?php echo '<p class="text-left mayusculas">' . strtoupper('experiencia laboral') . '</p>'; ?>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <div class="row justify-content-center">
                                            <?php
                                            if ($trafecha != '') {
                                                ?>
                                                <div class="col-md-6 col-6">
                                                    <?php echo '<p class="text-left">' . $trafecha . '</p>'; ?>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <?php echo anchor($this->controlador . 'trayectoria_laboral/id/' . $id, '<i class="fa fa-pencil-square-o fa-x5" aria-hidden="true"></i>', array('class' => 'enlace_editar')); ?>                                  
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div class="col-md-6 col-6">
                                                    <?php echo '<p class="text-left">No tiene ningun dato.</p>'; ?>
                                                </div>
                                                <div class="col-md-6 col-6">                                                
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <!--fin de experiencia laboral-->

                                <?php
                            } else {
                                ?>
                                <p>No tiene ningun Dato.</p>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Informacion Adicional-->
        <div class="col-md-8 col-md-offset-2">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <!--primer item-->
                <div class="panel panel-warning">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <div class="row">
                            <div class="col-8 col-md-4">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                        Información Adicional
                                    </a>
                                    <?php
                                    if ($arrayFechas['fia'] != '')
                                        echo'<br/><span class="box-fecha-modificacion-responsive">última modificación ' . $arrayFechas['fia'] . '</span>';
                                        
                                        ?>
                                </h4>
                            </div>
                            <div class="col-md-4 box-fecha-modificacion">
                                <h4>
                                    <?php
                                    if ($arrayFechas['fia'] != '')
                                        echo'última modificación ' . $arrayFechas['fia'];
                                        
                                        ?>
                                </h4>
                            </div>
                            <div class="col-4 col-md-4">
                                <h4 class="">
                                    <?php echo anchor($this->controlador . 'informacion_adicional', 'Editar', array('class' => 'enlace-nuevo')); ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                            <?php
                            if ($ingfecha != '' || $idifecha != '') {
                                ?>
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <h4 class='text-cafe'>Formulario</h4>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <div class="row">
                                            <div class="col-md-6 col-6">
                                                <h4 class='text-cafe'>Fecha Modificación</h4>
                                            </div>
                                            <div class="col-md-6 col-6">
                                                <h4 class='text-cafe'>Editar</h4>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--idioma ingles-->                                
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <?php echo '<p class="text-left mayusculas">' . strtoupper('Idioma Inglés') . '</p>'; ?>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <div class="row justify-content-center">
                                            <?php
                                            if ($ingfecha != '') {
                                                ?>
                                                <div class="col-md-6 col-6">
                                                    <?php echo '<p class="text-left">' . $ingfecha . '</p>'; ?>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <?php echo anchor($this->controlador . 'informacion_adicional/id/' . $id, '<i class="fa fa-pencil-square-o fa-x5" aria-hidden="true"></i>', array('class' => 'enlace_editar')); ?>                                  
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div class="col-md-6 col-6">
                                                    <?php echo '<p class="text-left">No tiene ningun dato.</p>'; ?>
                                                </div>
                                                <div class="col-md-6 col-6">                                                
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <!--fin de idioma ingles-->
                                <!--otros idiomas-->                                
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <?php echo '<p class="text-left mayusculas">' . strtoupper('Otros Idiomas') . '</p>'; ?>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <div class="row justify-content-center">
                                            <?php
                                            if ($idifecha != '') {
                                                ?>
                                                <div class="col-md-6 col-6">
                                                    <?php echo '<p class="text-left">' . $idifecha . '</p>'; ?>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <?php echo anchor($this->controlador . 'informacion_adicional/id/' . $id, '<i class="fa fa-pencil-square-o fa-x5" aria-hidden="true"></i>', array('class' => 'enlace_editar')); ?>                                  
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div class="col-md-6 col-6">
                                                    <?php echo '<p class="text-left">No tiene ningun dato.</p>'; ?>
                                                </div>
                                                <div class="col-md-6 col-6">                                                
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <!--fin de otros idiomas-->
                                <?php
                            } else {
                                ?>
                                <p>No tiene ningun Dato.</p>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-5">
    <!--            <input name="enviar"  class="btn btn-etika" type="submit" value="Continuar"/>-->
            <a href="<?php echo $sitio . 'postulacion/agregarnuevo'; ?>" class="btn-etika btn">Continuar Postulación</a>
            <!--<a href="<?php echo $sitio . 'epostulante/postular'; ?>" class="btn-etika btn">Continuar Postulación</a>-->
        </div>
    </div>
</div>
