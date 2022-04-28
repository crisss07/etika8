<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/files/multiselect/css/multi-select.css">
<?php
$this->load->view('cabecera');
?>
<div id="listado"><div align="left" >
        <?php echo anchor('reportes', 'Atr�s', array('class' => 'enlace_retornar enlace_a1')); ?></div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <br/>
                    <!--<span class="cabecera_titulo" style="padding-bottom: 3px;border-bottom: 1px solid rgb(15, 45, 124);">Elegir 5 criterios como m�ximo</span>-->
            <select id='criterios' multiple='multiple' >
                <?php
                foreach ($multiselect as $key => $value) {
                    echo "<option value='" . $value['valor'] . "'>" . $value['titulo'] . "</option>";
                }
                ?>
                <!--                <option value='1'>Pa�s de residencia</option>
                                <option value='2'>Profesi�n</option>
                                <option value='3'>�rea de experiencia</option>
                                <option value='4'>Ambito en el clasificar�a su experiencia</option>
                                <option value='5'>Experiencia en supervisi�n</option>
                                <option value='6'>Disponibilidad</option>
                                <option value='7'>Maximo nivel alcanzado</option>
                                <option value='8'>Experiencia en no supervisi�n</option>
                                <option value='9'>A�os de experiencia en supervici�n</option>
                                <option value='10'>Recomendaci�n</option>
                                <option value='11'>Rangos de edad</option>
                                <option value='12'>G�nero</option>
                                <option value='13'>Ultima pretensi�n salarial</option>
                                <option value='14'>Cargo al que postula</option>
                                            <option value='15'>Cargos Desempe�ados</option>
                                <option value='16'>Sede</option>
                                <option value='17'>Fecha de modificaci�n de CV</option>
                                <option value='18'>Idioma ingles</option>
                                <option value='19'>Otros Idiomas</option>
                                <option value='20'>Sector de Experiencia que usted realtar�a</option>
                                <option value='21'>Cliente</option>
                                <option value='22'>Ciudad o Localidad</option>
                                <option value='23'>Instancia</option>-->
                <!--<option value='elem_4' selected>elem 4</option>-->
                <!--<option value='elem_100'>elem 100</option>-->
            </select>
            <br>
            <form method="post" action="<?php echo $sitio . 'campos_criterios'; ?>" id="formulario">
                <div id="mensajeCriterios"></div>
                <input type="text" class="criterios_selecionados" name="criterios" style="display: none;"/>
                <input type="button" class="obtener_criterios" value="Generar Formulario" onclick="enviarFormulario();"/>
            </form>
            <!--<div class="btn btn-default">Generar Formulario</div>-->
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
        </div>

    </div>
    <script src="<?php echo base_url(); ?>/files/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>/files/multiselect/js/jquery.multi-select.js"></script>
    <script type="text/javascript">
                    // run pre selected options
                    $('#criterios').multiSelect({
                        keepOrder: false
                    });
                    var arrayCriterios = new Array();
                    function enviarFormulario() {
                        if ($(".criterios_selecionados").val() != "")
                        {
                            $("#mensajeCriterios").removeClass('alerta-incorrecta-criterios');
                            $("#mensajeCriterios").html("");
                            document.forms["formulario"].submit();
                        } else {
                            $("#mensajeCriterios").addClass('alerta-incorrecta-criterios');
                            $("#mensajeCriterios").html("debe elegir al menos un criterio");
                        }
                    }
                    $(document).ready(function () {
                        $('#criterios').change(function (event) {
                            arrayCriterios = $('select#criterios').val();
                            $('.criterios_selecionados').val(arrayCriterios.join());
                            if ($(this).val().length >= 5) {
                                $('#ms-criterios .ms-elem-selectable').addClass('disabled');
                            } else {
                                $('#ms-criterios .ms-elem-selectable').removeClass('disabled');

                            }
//                            console.info(arrayCriterios);
//                para verificar si se seleccionbe maximo nivel alcanzado
                            if (arrayCriterios.includes('7') || arrayCriterios.includes('9'))
                            {
                                $("#53-selectable").addClass('disabled');
                                $("#56-selectable").addClass('disabled');
                            }
                            if (arrayCriterios.includes('8'))
                            {
                                $("#53-selectable").addClass('disabled');
                                $("#55-selectable").addClass('disabled');
                                $("#57-selectable").addClass('disabled');
                            }
                        });
                    });


    </script>


