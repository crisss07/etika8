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
        <div class="col-md-6 col-lg-5 col-xl-4" style="border: 1px solid white; background: #fff;padding: 20px;border-radius: 20px;">
            <?php echo form_open_multipart($action); ?>
            <?php // echo form_open_multipart($action . 'newpostulante/instruccion_formal'); ?>

            <div class="row text-left">
                <div class="col-md-12 text-center">
                    <h2 class='titulo-formulario'>Usted esta postulando al cargo</h2>
                    <h2 class='titulo-formulario bold'>"<?php echo $cargo; ?>"</h2>
                </div>

                <div class="col-md-12">
                    <br/>
                    <br/>
                </div>
                <div class="col-md-12">
                    <!-- Button trigger modal -->                    

                    <label>Pretensión salarial (en Bs.): </label>
                </div>
                <div class="col-md-12">
                    <?php
                    $pass = 'salario';

                    $salario = @$datos[$prefijo . $pass] <= 0 ? " " : @$datos[$prefijo . $pass];
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
                    <div id="salario_mensaje1" class="error"></div>
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
                    echo form_dropdown($pass, $this->contador, set_value($pass, @$contador), "class='custom-select custom-select-sm input-etika' id=" . $pass);
                    if (form_error($pass))
                        echo '<div class="error">' . form_error($pass) . '</div>';
                    ?>
                    <div id="mensaje_contador1" class="error"></div>
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
                                <h4>Si te sientes más cómodo llene el formulario en PC.</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Continuar</button>
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
                        <p>Adjuntar su CV en formato propio.</p>
                        <a href="#cv" data-toggle="tooltip" title="Le recomendamos llenar su CV en el formato ETIKA porque mejora la precisión de su evaluación. 
Si pasa a una siguiente etapa deberá llenar su CV en el formato ETIKA." data-placement="top">
                            <span class="glyphicon glyphicon-plus" data-toggle="popover" data-placement="left" title="" data-content="Le recomendamos llenar su CV en el formato ETIKA porque mejora la precisión de su evaluación. 
Si pasa a una siguiente etapa deberá llenar su CV en el formato ETIKA.">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                </svg>
                            </span>
                        </a>
                        <button id="cv" type="button" class="btn-etika btn" onclick="verifica_cv();">CV Adjunto</button>
                        <!-- <input class="btn-etika btn cv-temporal-modal" type="button" value="CV Adjunto"/>       -->
                    </div>
                    <div class="col-6 sin-padding">
                        <p>Ingresar todos sus datos en el sistema.</p>
                        <button type="submit" class="btn-etika btn" data-url="<?php echo $sitio . 'epostulante/postular'; ?>">CV formato Etika</button>
                    </div>
                </div>
                <br/>
                <p><?php echo @$msj; ?></p>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- Modal2 cv temporal -->
<div class="modal fade" id="modal-cv-temporal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--<h5 class="modal-title" id="exampleModalLabel">Nota</h5>-->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Si llenas el sistema, la segunda vez harás solo un click para postularte.</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="butom" class="btn btn-primary cv-temporal" data-url="<?php echo $sitio . 'Convocatoria/editardatos'; ?>" data-dismiss="modal">Continuar</button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
<script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover();   
});
</script>
<script>
    function verifica_cv(){

        var salario = $('#pof_salario').val();
        var contador = $('#contador').val();
        var disponibilidad = $('#pof_disponibilidad').val();
        var cont = 0;

        console.log(salario, contador, disponibilidad);

        if (salario) {
            cont = cont + 1;
            $('#salario_mensaje1').html('');
        } else {
            $('#salario_mensaje1').html('Debe introducir la Pretensión salarial');
        }

        if (contador != -1) {
            cont = cont + 1;
            $('#mensaje_contador1').html('');
        } else {
            $('#mensaje_contador1').html('Debe seleccionar Cómo se enteró de está postulación');
        }

        if (cont == 2) {
            var dato_concatenado = salario + '_' + contador + '_' + disponibilidad;
            $.ajax({
                 url:'<?php echo $sitio; ?>epostulante/guarda_salario',
                 method: 'post',
                 data: {param1 : salario, param2 : contador, param3 : disponibilidad},
                 dataType: 'json',
                 success: function(response){
                    console.log(response);
                 },
                   error: function (error) {
                     console.log(error);
                   }
               });
            window.location.href = "<?php echo $sitio ?>convocatoria/editardatos/" + dato_concatenado;
            // window.location.href = "<?php echo $sitio . 'convocatoria/editardatos'; ?>";
        }
    }
</script>