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
        <div class="col-md-12">
            <img style="width: 130px;" src="<?php echo $this->tool_entidad->sitio() . 'files/img/logo_etika.png'; ?>" />
        </div>
        <div class="col-md-4" style="border: 1px solid white; background: #fff;padding: 20px;border-radius: 20px;">
            <?php echo form_open_multipart($action . 'convocatoria/postular'); ?>
            <?php // echo form_open_multipart($action . 'newpostulante/instruccion_formal'); ?>

            <div class="row text-left">
                <div class="col-md-12 text-center">
                    <h2 class='titulo-formulario'>Usted esta postulando al cargo</h2>
                    <h2 class='titulo-formulario bold'>"<?php echo $cargo; ?>"</h2>
                </div>

                <div class="col-md-12">
                    <!--<br/>-->
<!--                    <span class="texto2" style="font-size: 12px;"><b>Nota.</b>
                        <br/>- Si modifica la Pretensión Salarial Referencial Mensual tambien se modificará en su Curriculum Vitae.
                        <br/>- Si usted quiere modificar su Curruculum Vitae antes de postularse haga <?php echo anchor('postulante/editar_datospersonal/id/' . $_SESSION[$this->presession . 'id'], 'click aqui', array('class' => "enlace_a1", 'target' => "_blank")); ?>
                    </span>-->
                    <br/>
                    <br/>
                </div>
                <div class="col-md-12">
                    <label>Pretensión salarial (en Bs.): </label>
                </div>
                <div class="col-md-12">
                    <?php
                    $pass = 'salario';
                    $salario = $datos[$prefijo . $pass] <= 0 ? " " : $datos[$prefijo . $pass];
                    echo form_input(array(
                        'name' => $prefijo . $pass,
                        'id' => $prefijo . $pass,
                        'class' => 'input1 input-etika',
                        'size' => '20',
                        'value' => $salario,
                        'onkeyup' => 'this.value=Numeros(this.value)'
                    ));
                    if (form_error($prefijo . $pass))
                        echo '<div class="error">' . form_error($prefijo . $pass) . '</div>';
                    ?>
                    <div class="error-salario"></div>
                </div>


                <div class="col-md-12">
                    <?php $nombre = 'disponibilidad'; ?>
                    <select class="custom-select custom-select-sm input-etika" name="<?php echo $prefijo . $nombre ?>" id="<?php echo $prefijo . $nombre ?>">
                        <option value="-1">Seleccione diponibilidad</option>
                        <?php
                        foreach ($disponibilidad as $key => $value) {
                            ?>
                            <option value="<?php echo $value['id']; ?>"  <?php echo $value['id'] == $idDisponible['pof_disponibilidad'] ? 'selected' : '' ?>><?php echo $value['nombre']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php
                    if (form_error($prefijo . $nombre))
                        echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                    ?>
                </div>
                <div class="col-md-12">
                    <?php
                    $pass = 'contador';
                    echo form_dropdown($pass, $this->contador, set_value($pass, $contador), "class='custom-select custom-select-sm input-etika' id=" . $pass);
                    if (form_error($pass))
                        echo '<div class="error">' . form_error($pass) . '</div>';
                    ?>
                    <div class="error-contador"></div>
                </div>
            </div>
            <br/>
            <div class="col-md-12">
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <!--<h5 class="modal-title" id="exampleModalLabel">Nota</h5>-->
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h4>Se sugiere llenar el sistema en PC</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-etika">Continuar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12">
<!--                <p>Usted tiene dos formas de continuar con su postulación adjuntar su CV o llenar el sistema. 
                Se aconseja llenar el sistema.</p>-->
                        <p class="text-left">Usted tiene dos formas:.</p>
                    </div>
                    <div class="col-6">
                        <p>Adjuntar su CV de forma temporal.</p>
                        <input class="btn-etika btn cv-temporal" type="button" value="CV Temporal" data-url="<?php echo $sitio . 'convocatoria/cvtemporal'; ?>"/>
                        <!--<input class="btn-etika btn cv-temporal" type="button" value="CV Temporal" data-toggle="modal" data-target="#exampleModalLong"/>-->
                    </div>
                    <div class="col-6 sin-padding">
                        <p>Ingresar todos sus datos en el sistema.</p>
                        <input class="btn-etika btn" type="button" value="Llenar el sistema" data-toggle="modal" data-target="#exampleModal"/>
                        <!--<a href="<?php echo $sitio . '/postulante/instruccion_formal'; ?>" class="btn-etika btn">Llenar el sistema</a>-->
                    </div>
                </div>
                <br/>
                <p><?php echo $msj; ?></p>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
