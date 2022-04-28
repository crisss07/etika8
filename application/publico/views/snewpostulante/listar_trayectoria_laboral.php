<SCRIPT LANGUAGE=JavaScript>
    function mensaje() {
        // alert("Debe tener al menos un campo en Trayectoria Laboral y llenar la Síntesis de Experiencia Laboral para poder pasar.");
        alert("Debe tener llenado Síntesis de Experiencia Laboral o hacer click en 'No tengo experiencia laboral' para poder pasar.");
    }
</SCRIPT>

<?php
$this->load->view('cabecera');
?>

<?php
$msj_confirmar = '¿Está seguro que desea eliminar el elemento seleccionado?';
@$ruta = $this->rutarchivo . $this->carpetaup;
?>
<br>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div>
                 <p><input type="checkbox" name="no_experiencia_laborarl" id="no_experiencia_laborarl" value="0"> &nbsp; NO TENGO EXPERIENCIA LABORAL </p>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-12">
                    <div class="box-acordeon">
                        <div class="row">
                            <div class="col-8 col-md-4 text-left">
                                <h2 style="color: #ffffff;">SÍNTESIS DE EXPERIENCIA LABORAL
                                    <?php
                                    if ($fecha != '')
                                        echo'<br/><span class="box-fecha-modificacion-responsive">última modificación ' . $fecha . '</span>';
                                    ?></h2>
                            </div>
                            <div class="col-md-4 box-fecha-modificacion">
                                <h2 style="color: #ffffff;">
                                    <?php
                                    if ($fecha != '')
                                        echo'última modificación ' . $fecha;
                                    ?>
                                </h2>
                            </div>
                            <div class="col-4 col-md-4">
                                <h4 class="">
                                    <?php
                                    if (@$sintesis['pos_ambito_exp'] && @$sintesis['pof_supervisar_exp']) {
                                        echo anchor($this->controlador . 'editar_experiencia_sintesis', 'Editar', array('class' => 'enlace-nuevo'));
                                    } else {
                                        echo anchor($this->controlador . 'editar_experiencia_sintesis', 'Agregar', array('class' => 'enlace-nuevo'));
                                    }
                                    ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <!--<br/>-->
                </div>
            </div>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <!--primer item-->
                <div class="panel panel-warning">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <div class="row">
                            <div class="col-8 col-md-4">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        EXPERIENCIA LABORAL
                                    </a>
                                    <?php
                                    if ($trafecha != '')
                                        echo'<br/><span class="box-fecha-modificacion-responsive">última modificación ' . $trafecha . '</span>';
                                    ?>
                                </h4>
                            </div>
                            <div class="col-md-4 box-fecha-modificacion">
                                <h4>
                                    <?php
                                    if ($trafecha != '')
                                        echo'última modificación ' . $trafecha;
                                    ?>
                                </h4>
                            </div>
                            <div class="col-4 col-md-4">
                                <h4 class="">
                                    <?php echo anchor($this->controlador . 'trayectoria_nuevo', 'Agregar', array('class' => 'enlace-nuevo')); ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <?php
                            $prefijo = $this->prefijo3;
//                            print_r($trayectorias);
                            if ($trayectorias) {
                                ?>
                                <div class="row">
                                    <div class="col-md-7 col-6">
                                        <h4 class='text-cafe'>Nombre Organización</h4>
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
                                foreach ($trayectorias as $key => $value) {
                                    ?>
                                    <div class="row">
                                        <div class="col-md-7 col-6">
                                            <?php echo '<p class="text-left">' . strtoupper($value[$prefijo . 'organizacion']) . '&nbsp;(' . substr($value[$prefijo . 'desde'], 0, 4) . '-' . substr($value[$prefijo . 'hasta'], 0, 4) . ')</p>'; ?>
                                        </div>
                                        <div class="col-md-5 col-6">
                                            <div class="row">
                                                <div class="col-md-6 col-6">
                                                    <?php echo anchor($this->controlador . 'editar_trayectoria/id/' . $value[$prefijo . 'id'], '<i class="fa fa-pencil-square-o fa-x5" aria-hidden="true"></i>', array('class' => 'enlace_editar')); ?>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <?php echo anchor($this->controlador . 'eliminar_trayectoria/id/' . $value[$prefijo . 'id'], '<i class="fa fa-trash-o fa-x5" aria-hidden="true"></i>', array('class' => 'enlace_eliminar', 'onclick' => "return confirmar('$msj_confirmar')")); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <p>No tiene ninguna Experiencia Laboral.</p>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
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
    <div class="row justify-content-center">
        <div class="col-6">
            <?php // echo anchor('snewpostulante/editar_cv/id/' . $id, 'Volver al menu', 'class="btn btn-default btn-etika"'); ?>
            <?php echo anchor('snewpostulante/instruccion_formal', 'paso anterior', 'class="btn btn-default btn-etika"'); ?>
        </div>
        <div class="col-6" id="boton_siguiente_paso">
            <button class="btn btn-default btn-etika" onclick="verificar()">Siguiente paso</button>
        </div>
    </div>
</div>
<script>

</script>
<script type="text/javascript">
    function verificar(){
        var ambito = '<?php echo @$sintesis['pos_ambito_exp']?>';
        if (ambito || $('#no_experiencia_laborarl').prop('checked')) {
            window.location.href = "<?php echo $sitio ?>snewpostulante/informacion_adicional";
        } else {
            mensaje();
        }
    }
</script>

<script type="text/javascript">

    $('input[type=checkbox]').on('change', function() {
        if ($(this).is(':checked') ) {
            $('#boton_siguiente_paso').html(`<?php echo anchor('snewpostulante/informacion_adicional', 'siguiente paso', 'class="btn btn-default btn-etika"'); ?>`);
            console.log("Checkbox " + $(this).prop("id") +  " (" + $(this).val() + ") => Seleccionado");
        } else {
            $('#boton_siguiente_paso').html(`<a href="#" title="Siguiente" onclick="mensaje()" class="btn btn-default btn-etika">Siguiente paso</a>`);
            console.log("Checkbox " + $(this).prop("id") +  " (" + $(this).val() + ") => Deseleccionado");
            
        }
    });

    // // Comprobar cuando se deseleciona un checkbox
    // $('input[type=checkbox]:checked').on('change', function() {
    //     console.log("Checkbox " + $(this).prop("id") +  " (" + $(this).val() + ") => Deseleccionado");
    // });
</script>
