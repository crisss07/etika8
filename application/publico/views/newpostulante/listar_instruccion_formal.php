<SCRIPT LANGUAGE=JavaScript>
    function mensaje() {
        alert("Debe tener al menos un campo llenado en Educación Secundaria para poder pasar.");
    }
</SCRIPT>

<?php
$this->load->view('cabecera');
?>

<?php
$msj_confirmar = '¿Está seguro que desea eliminar el elemento seleccionado?';
@$ruta = $this->rutarchivo . $this->carpetaup;
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <!--primer item-->
                <br>
                <div class="panel panel-warning">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <div class="row">
                            <div class="col-8 col-md-4">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        EDUCACIÓN SECUNDARIA
                                    </a>
                                    <?php
                                    if ($sfecha != '')
                                        echo'<br/><span class="box-fecha-modificacion-responsive">última modificación ' . $sfecha . '</span>';
                                    ?>
                                </h4>
                            </div>
                            <div class="col-md-4 box-fecha-modificacion">
                                <h4>
                                    <?php
                                    if ($sfecha != '')
                                        echo'última modificación ' . $sfecha;
                                    ?>
                                </h4>
                            </div>
                            <div class="col-4 col-md-4">
                                <h4 class="">
                                    <?php echo anchor($this->controlador . 'secundaria_nuevo', 'Agregar', array('class' => 'enlace-nuevo')); ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <?php
                            $prefijo = $this->prefijo1;
                            if ($secundaria) {
                                ?>
                                <div class="row">
                                    <div class="col-md-7 col-6">
                                        <h4 class='text-cafe'>Institución</h4>
                                    </div>
                                    <div class="col-md-5 col-6">
                                        <div class="row">
                                            <div class="col-md-6 col-6">
                                                <h4 class='text-cafe'>Editar</h4>
                                            </div>
                                            <div class="col-md-6 col-6">
                                                <h4 class='text-cafe'>Eliminar</h4>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                foreach ($secundaria as $key => $value) {
                                    ?>
                                    <div class="row">
                                        <div class="col-md-7 col-6">
                                            <?php echo '<p class="text-left">' . strtoupper($value[$prefijo . 'institucion']) . '</p>'; ?>
                                        </div>
                                        <div class="col-md-5 col-6">
                                            <div class="row">
                                                <div class="col-md-6 col-6">
                                                    <?php echo anchor($this->controlador . 'editar_secundaria/id/' . $value[$prefijo . 'id'], '<i class="fa fa-pencil-square-o fa-x5" aria-hidden="true"></i>', array('class' => 'enlace_editar')); ?>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <?php echo anchor($this->controlador . 'eliminar_secundaria/id/' . $value[$prefijo . 'id'], '<i class="fa fa-trash-o fa-x5" aria-hidden="true"></i>', array('class' => 'enlace_eliminar', 'onclick' => "return confirmar('$msj_confirmar')")); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <p>No tiene ningún Educación Secundaria.</p>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <br>
                <!--segundo item-->
                <div class="panel panel-warning">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <div class="row">
                            <div class="col-8 col-md-4">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        EDUCACIÓN SUPERIOR
                                    </a>
                                    <?php
                                    if ($supfecha != '')
                                        echo'<br/><span class="box-fecha-modificacion-responsive">última modificación ' . $supfecha . '</span>';
                                    ?>
                                </h4>
                            </div>
                            <div class="col-md-4 box-fecha-modificacion">
                                <h4>
                                    <?php
                                    if ($supfecha != '')
                                        echo'última modificación ' . $supfecha;
                                    ?>
                                </h4>
                            </div>
                            <div class="col-4 col-md-4">
                                <h4 class="">
                                    <?php echo anchor($this->controlador . 'superior_nuevo', 'Agregar', array('class' => 'enlace-nuevo')); ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <?php
                            $prefijo = $this->prefijo1;
                            if ($superior) {
                                ?>
                                <div class="row">
                                    <div class="col-md-7 col-6">
                                        <h4 class='text-cafe'>Profesión</h4>
                                    </div>
                                    <div class="col-md-5 col-6">
                                        <div class="row">
                                            <div class="col-md-6 col-6">
                                                <h4 class='text-cafe'>Editar</h4>
                                            </div>
                                            <div class="col-md-6 col-6">
                                                <h4 class='text-cafe'>Eliminar</h4>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                foreach ($superior as $key => $value) {
                                    ?>
                                    <div class="row">
                                        <div class="col-md-7 col-6">
                                            <?php echo '<p class="text-left">' . $this->area_pro[strtoupper($value[$prefijo . 'area'])] . '</p>'; ?>
                                        </div>
                                        <div class="col-md-5 col-6">
                                            <div class="row">
                                                <div class="col-md-6 col-6">
                                                    <?php echo anchor($this->controlador . 'editar_superior/id/' . $value[$prefijo . 'id'], '<i class="fa fa-pencil-square-o fa-x5" aria-hidden="true"></i>', array('class' => 'enlace_editar')); ?>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <?php echo anchor($this->controlador . 'eliminar_superior/id/' . $value[$prefijo . 'id'], '<i class="fa fa-trash-o fa-x5" aria-hidden="true"></i>', array('class' => 'enlace_eliminar', 'onclick' => "return confirmar('$msj_confirmar')")); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <p>No tiene ningún Educación Superior.</p>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <br>
                <!--tercer item-->
                <div class="panel panel-warning">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <div class="row">
                            <div class="col-8 col-md-4">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        EDUCACIÓN POST GRADO
                                    </a>
                                    <?php
                                    if ($postfecha != '')
                                        echo'<br/><span class="box-fecha-modificacion-responsive">última modificación ' . $postfecha . '</span>';
                                    ?>
                                </h4>
                            </div>
                            <div class="col-md-4 box-fecha-modificacion">
                                <h4>
                                    <?php
                                    if ($postfecha != '')
                                        echo'última modificación ' . $postfecha;
                                    ?>
                                </h4>
                            </div>
                            <div class="col-4 col-md-4">
                                <h4 class="">
                                    <?php echo anchor($this->controlador . 'postgrado_nuevo', 'Agregar', array('class' => 'enlace-nuevo')); ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                            <?php
                            $prefijo = $this->prefijo1;
                            if ($postgrado) {
                                ?>
                                <div class="row">
                                    <div class="col-md-7 col-6">
                                        <h4 class='text-cafe'>Área de Post Grado</h4>
                                    </div>
                                    <div class="col-md-5 col-6">
                                        <div class="row">
                                            <div class="col-md-6 col-6">
                                                <h4 class='text-cafe'>Editar</h4>
                                            </div>
                                            <div class="col-md-6 col-6">
                                                <h4 class='text-cafe'>Eliminar</h4>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                foreach ($postgrado as $key => $value) {
                                    ?>
                                    <div class="row">
                                        <div class="col-md-7 col-6">
                                            <?php echo '<p class="text-left">' . strtoupper($value[$prefijo . 'area']) . '</p>'; ?>
                                        </div>
                                        <div class="col-md-5 col-6">
                                            <div class="row">
                                                <div class="col-md-6 col-6">
                                                    <?php echo anchor($this->controlador . 'editar_postgrado/id/' . $value[$prefijo . 'id'], '<i class="fa fa-pencil-square-o fa-x5" aria-hidden="true"></i>', array('class' => 'enlace_editar')); ?>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <?php echo anchor($this->controlador . 'eliminar_postgrado/id/' . $value[$prefijo . 'id'], '<i class="fa fa-trash-o fa-x5" aria-hidden="true"></i>', array('class' => 'enlace_eliminar', 'onclick' => "return confirmar('$msj_confirmar')")); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <p>No tiene ningún Post Grado.</p>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <br>
                <!--cuarto item-->
                <div class="panel panel-warning">
                    <div class="panel-heading" role="tab" id="headingFour">
                        <div class="row">
                            <div class="col-8 col-md-4 ">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        PUBLICACIONES
                                    </a>
                                    <?php
                                    if ($pubfecha != '')
                                        echo'<br/><span class="box-fecha-modificacion-responsive">última modificación ' . $pubfecha . '</span>';
                                    ?>
                                </h4>
                            </div>
                            <div class="col-md-4 box-fecha-modificacion">
                                <h4>
                                    <?php
                                    if ($pubfecha != '')
                                        echo'última modificación ' . $pubfecha;
                                    ?>
                                </h4>
                            </div>
                            <div class="col-4 col-md-4 ">
                                <h4 class="">
                                    <?php echo anchor($this->controlador . 'publicacion_nuevo', 'Agregar', array('class' => 'enlace-nuevo')); ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingFour">
                        <div class="panel-body">
                            <?php
                            $prefijo = $this->prefijo2;
                            if ($publicacion) {
                                ?>
                                <div class="row">
                                    <div class="col-md-7 col-6">
                                        <h4 class='text-cafe'>Título</h4>
                                    </div>
                                    <div class="col-md-5 col-6">
                                        <div class="row">
                                            <div class="col-md-6 col-6">
                                                <h4 class='text-cafe'>Editar</h4>
                                            </div>
                                            <div class="col-md-6 col-6">
                                                <h4 class='text-cafe'>Eliminar</h4>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                foreach ($publicacion as $key => $value) {
                                    ?>
                                    <div class="row">
                                        <div class="col-md-7 col-6">
                                            <?php echo '<p class="text-left">' . strtoupper($value[$prefijo . 'titulo']) . '</p>'; ?>
                                        </div>
                                        <div class="col-md-5 col-6">
                                            <div class="row">
                                                <div class="col-md-6 col-6">
                                                    <?php echo anchor($this->controlador . 'editar_publicacion/id/' . $value[$prefijo . 'id'], '<i class="fa fa-pencil-square-o fa-x5" aria-hidden="true"></i>', array('class' => 'enlace_editar')); ?>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <?php echo anchor($this->controlador . 'eliminar_publicacion/id/' . $value[$prefijo . 'id'], '<i class="fa fa-trash-o fa-x5" aria-hidden="true"></i>', array('class' => 'enlace_eliminar', 'onclick' => "return confirmar('$msj_confirmar')")); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <p>No tiene ninguna Publicación.</p>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>


<div id="listado">
    <?php
    $sitio = $this->tool_entidad->sitioindexpri();
    ?>        
    <form action="<?php echo $sitio . $this->controlador . 'procesar' ?>" method="post" id="form_listar_fsimple">
        <input type="hidden" name="id" value="<?php echo $id; ?>" id="id"/>
    </form>
    <br/>
    <div class="row">
        <div class="col-6">
            <?php // echo anchor('postulante/editar_datospersonal/id/' . $id, '<img border="0" src="' . $this->tool_entidad->sitio() . 'files/img/maq/anterior.gif"/>'); ?>
        </div>
        <div class="col-6">
            <?php
            echo anchor('newpostulante/trayectoria_laboral', 'Siguiente Paso', 'class="btn btn-default btn-etika"');
            ?>
            <?php
            //if ($secundaria) {
            //    echo anchor('newpostulante/trayectoria_laboral', 'Siguiente Paso', 'class="btn btn-default btn-etika"');
            //} else {
                ?>
                <!-- <a href="#" title="Siguiente" onclick="mensaje()" class="btn btn-default btn-etika">Siguiente Paso</a> -->
            <?php //} ?>
        </div>
    </div>
</div>


<!--para el acordion-->
<script>
    $(document).ready(function () {
        $("a.collapsed").click(function () {
            $(this).find(".btn:contains('answer')").toggleClass("collapsed");
        });
    });
</script>