<?php
$this->load->view('cabecera');
?>

<?php
$msj_confirmar = '¿Está seguro que desea eliminar el elemento seleccionado?';
@$ruta = $this->rutarchivo . $this->carpetaup;
@$prefijo = $this->prefijo4;
@$prefijoPI = $this->prefijoPI;
//print_r($fila);
switch (@$fila[$prefijoPI . 'lee']) {
    case 1:
        $valor_lee1 = 'checked';
        break;
    case 2:
        $valor_lee2 = 'checked';
        break;
    case 3:
        $valor_lee3 = 'checked';
        break;
    case 4:
        $valor_lee4 = 'checked';
        break;
}
switch (@$fila[$prefijoPI . 'habla']) {
    case 1:
        $valor_habla1 = 'checked';
        break;
    case 2:
        $valor_habla2 = 'checked';
        break;
    case 3:
        $valor_habla3 = 'checked';
        break;
    case 4:
        $valor_habla4 = 'checked';
        break;
}
switch (@$fila[$prefijoPI . 'escribe']) {
    case 1:
        $valor_escribe1 = 'checked';
        break;
    case 2:
        $valor_escribe2 = 'checked';
        break;
    case 3:
        $valor_escribe3 = 'checked';
        break;
    case 4:
        $valor_escribe4 = 'checked';
        break;
}
?>






<br>
<div id="listado">
    <?php
    $sitio = $this->tool_entidad->sitioindexpri();
    ?> 
    <!--para el idioma ingles-->
    <form action="<?php echo $sitio . $this->controlador . 'guardar_editar_informacion_adicional' ?>" method="post" id="form_listar_fsimple">
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <input type="hidden" name="poi_id" value="<?php echo @$fila['poi_id']; ?>" />
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-md-offset-2">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="box-acordeon">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h2 class="text-left" style="color: #ffffff;">INGLÉS
                                            <?php
                                            if (@$ingfecha != '')
                                                echo'<br/><span class="box-fecha-modificacion-responsive">última modificación ' . $ingfecha . '</span>';
                                            ?> 
                                        </h2>
                                    </div>
                                    <div class="col-md-4 box-fecha-modificacion">
                                        <h2 class="text-left" style="color: #ffffff;">
                                            <?php
                                            if (@$ingfecha != '')
                                                echo'última modificación ' . $ingfecha;
                                            ?>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-left justify-content-center container-ingles">
                                <div class="col-2">
                                    <h4 class="text-cafe text-left">&nbsp;</h4></div>
                                <div class="col-2 text-center"><h4 class="text-cafe">Exelente</h4></div>
                                <div class="col-2 text-center"><h4 class="text-cafe">bueno</h4></div>
                                <div class="col-2 text-center"><h4 class="text-cafe">Regular</h4></div>
                                <div class="col-2 text-center"><h4 class="text-cafe">Basico</h4></div>
                            </div>
                            <div class="row text-left justify-content-center">
                                <div class="col-2"><p>HABLA</p></div>
                                <?php
                                $nombre = 'habla';
                                ?>
                                <div class="col-2 text-center">
                                    <input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="1" <?php echo @$valor_habla1; ?> />
                                </div>
                                <div class="col-2 text-center">
                                    <input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="2" <?php echo @$valor_habla2; ?> />
                                </div>
                                <div class="col-2 text-center">
                                    <input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="3" <?php echo @$valor_habla3; ?> />
                                </div>
                                <div class="col-2 text-center">
                                    <input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="4" <?php echo @$valor_habla4; ?> />
                                </div>
                                <div class="col-12 text-center">
                                    <?php
                                    if (form_error($prefijoPI . $nombre))
                                        echo '<div class="error" style="text-aling:center;">' . form_error($prefijoPI . $nombre) . '</div>';
                                    ?>
                                </div>
                            </div>
                            <div class="row text-left justify-content-center">
                                <div class="col-2"><p>LEE</p></div>
                                <?php
                                $nombre = 'lee';
                                ?>
                                <div class="col-2 text-center">
                                    <input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="1" <?php echo @$valor_lee1; ?> />
                                </div>
                                <div class="col-2 text-center">
                                    <input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="2" <?php echo @$valor_lee2; ?> />
                                </div>
                                <div class="col-2 text-center">
                                    <input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="3" <?php echo @$valor_lee3; ?> />
                                </div>
                                <div class="col-2 text-center">
                                    <input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="4" <?php echo @$valor_lee4; ?> />
                                </div>
                                <div class="col-12 text-center">
                                    <?php
                                    if (form_error($prefijoPI . $nombre))
                                        echo '<div class="error" style="text-aling:center;">' . form_error($prefijoPI . $nombre) . '</div>';
                                    ?>
                                </div>
                            </div>
                            <div class="row text-left justify-content-center">
                                <div class="col-2"><p>ESCRIBE</p></div>
                                <?php
                                $nombre = 'escribe';
                                ?>
                                <div class="col-2 text-center">
                                    <input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="1" <?php echo @$valor_escribe1; ?> />
                                </div>
                                <div class="col-2 text-center">
                                    <input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="2" <?php echo @$valor_escribe2; ?> />
                                </div>
                                <div class="col-2 text-center">
                                    <input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="3" <?php echo @$valor_escribe3; ?> />
                                </div>
                                <div class="col-2 text-center">
                                    <input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="4" <?php echo @$valor_escribe4; ?> />
                                </div>
                                <div class="col-12 text-center">
                                    <?php
                                    if (form_error($prefijoPI . $nombre))
                                        echo '<div class="error" style="text-aling:center;">' . form_error($prefijoPI . $nombre) . '</div>';
                                    ?>
                                </div>
                            </div>
                            <br/>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <!--primer item-->
                        <div class="panel panel-warning">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <div class="row">
                                    <div class="col-8 col-md-4">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                OTROS IDIOMAS
                                            </a>
                                            <?php
                                            if (@$idifecha != '')
                                                echo'<br/><span class="box-fecha-modificacion-responsive">última modificación ' . $idifecha . '</span>';
                                            ?>
                                        </h4>
                                    </div>
                                    <div class="col-md-4 box-fecha-modificacion">
                                        <h4>
                                            <?php
                                            if (@$idifecha != '')
                                                echo'última modificación ' . $idifecha;
                                            ?>
                                        </h4>
                                    </div>
                                    <div class="col-4 col-md-4">
                                        <h4 class="">
                                            <?php echo anchor($this->controlador . 'idioma_nuevo', 'Agregar', array('class' => 'enlace-nuevo')); ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <?php
                                    if ($idiomas) {
                                        ?>
                                        <div class="row">
                                            <div class="col-md-7 col-6">
                                                <h4 class='text-cafe'>Idioma</h4>
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
                                        $prefijo = $this->prefijoPI;
                                        foreach ($idiomas as $key => $value) {
                                            ?>
                                            <div class="row">
                                                <div class="col-md-7 col-6">
                                                    <?php echo '<p class="text-left">' . strtoupper($value['idioma']) . '</p>'; ?>
                                                </div>
                                                <div class="col-md-5 col-6">
                                                    <div class="row">
                                                        <div class="col-md-6 col-6">
                                                            <?php echo anchor($this->controlador . 'editar_idioma/id/' . $value[$prefijo . 'id'], '<i class="fa fa-pencil-square-o fa-x5" aria-hidden="true"></i>', array('class' => 'enlace_editar')); ?>
                                                        </div>
                                                        <div class="col-md-6 col-6">
                                                            <?php echo anchor($this->controlador . 'eliminar_idioma/id/' . $value[$prefijo . 'id'], '<i class="fa fa-trash-o fa-x5" aria-hidden="true"></i>', array('class' => 'enlace_eliminar', 'onclick' => "return confirmar('$msj_confirmar')")); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <p>No tiene ningun Idioma.</p>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--comentario adicion-->
                <div class="col-md-8 col-md-offset-2">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="box-acordeon">
                                <h2 style="color: #ffffff;">Comentario Adicional</h2>
                            </div>
                            <div class="row text-left justify-content-center">
                                <?php
                                $nombre = 'comentario';
                                echo "<textarea name=" . $nombre . " id=" . $nombre . "
                                    class='input1' rows='8' cols='64' onblur='Mayusculas(this.value,this.id)'>" . $recibir[$nombre] . "</textarea>";
                                ?>
                            </div>
                            <br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
<!--            <div class="col-6">
                <?php echo anchor('postulante/trayectoria_laboral', 'paso anterior', 'class="btn btn-default btn-etika"'); ?>
            </div>-->
            <div class="col-6">
                <input name="enviar" type="submit" class="btn btn-default btn-etika" value="Guardar"> 
            </div>
        </div>
    </form>

</div> 


