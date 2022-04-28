<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/files/multiselect/css/multi-select.css">
<?php
$this->load->view('cabecera');
?>
<div id="listado"><div align="left" >
        <?php echo anchor('reportes/postulante', 'Atrás', array('class' => 'enlace_retornar enlace_a1')); ?></div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <br/>
            <form method="post" action="<?php echo $sitio . 'realizar_busqueda'; ?>" name="formularioCriterios">
                <input type="text" class="criterios_selecionados" name="criterios" value="<?php echo $criterios; ?>" style="display: none;"/>
                <?php
                foreach ($arrayCriterios as $key => $value) {
                    if ($value == 1) {
                        ?>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1">
                                <label class="titulo1">País de residencia: </label>
                            </div>
                            <div class="div-criterio2">
                                <span>Solo</span><input type="radio" value="1" name="pais" id="solo"/>
                                <span>Todo menos</span><input type="radio" value="2" name="pais" id="todo"/>
                                <br/>
                                <div id="mensajepais"></div>
                                <select name="idpais">
                                    <?php
                                    foreach ($paises as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['pais']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <br/>
                            </div>
                        </div>
                        <div class="limpiar-espacio"></div>
                        <?php
                    } elseif ($value == 2) {
                        ?>
                        <br/>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1" >
                                <label class="titulo1">Profesión: </label>
                            </div>
                            <div class="div-criterio2" >
                                <select name="idprofesion[]" id="profesiones" multiple='multiplemultiple'>
                                    <?php
                                    foreach ($profesiones as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['profesion']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <div id="mensajeprofesion"></div>
                            </div>
                            <div class="limpiar-espacio"></div>
                        </div>
                        <?php
                    } elseif ($value == 3) {
                        ?>
                        <br/>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1" >
                                <label class="titulo1">Área de experiencia: </label>
                            </div>
                            <div class="div-criterio2" >
                                <select name="idarea[]" id="areaexperiencia" multiple="multiple">
                                    <?php
                                    foreach ($areaExperiencia as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['experiencia']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <div id="mensajearea"></div>
                            </div>
                        </div>
                        <div class="limpiar-espacio"></div>
                        <?php
                    } elseif ($value == 4) {
                        ?>
                        <br/>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1" >
                                <label class="titulo1">Ambito en el clasificaría su experiencia: </label>
                            </div>
                            <div class="div-criterio2" >
                                <input type="checkbox" id="ambito1" value="1" name="ambito1"/><span>Empresa Privada</span><br/>
                                <input type="checkbox" id="ambito2" value="2" name="ambito2"/><span>Entidad Publica</span><br/>
                                <input type="checkbox" id="ambito3" value="3" name="ambito3"/><span>Cooperación para el Desarrollo</span><br/>
                                <div id="mensajeambito"></div>
                            </div>
                        </div>
                        <div class="limpiar-espacio"></div>
                        <?php
                    } elseif ($value == 5) {
                        ?>
                        <br/>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1" >
                                <label class="titulo1">Experiencia en supervisión: </label>
                            </div>
                            <div class="div-criterio2" >
                                <span>Si</span><input type="radio" value="si" name="experiencia" id="experienciasi"/>
                                <span>No</span><input type="radio" value="no" name="experiencia" id="experienciano"/>
                                <div id="mensajeexperiencia-s"></div>
                            </div>
                        </div>
                        <div class="limpiar-espacio"></div>
                        <?php
                    } elseif ($value == 6) {
                        ?>
                        <br/>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1" >
                                <label class="titulo1">Disponibilidad: </label>
                            </div>
                            <div class="div-criterio2" >
                                <select name="iddisponibilidad">
                                    <?php
                                    foreach ($disponibilidad as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['disponibilidad']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="limpiar-espacio"></div>
                        <?php
                    } elseif ($value == 7) {
                        ?>
                        <br/>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1" >
                                <label class="titulo1">Maximo nivel alcanzado: </label>
                            </div>
                            <div class="div-criterio2" >
                                <select name="idsupervision">
                                    <?php
                                    foreach ($supervision as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['nombre']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="limpiar-espacio"></div>
                        <?php
                    } elseif ($value == 8) {
                        ?>
                        <br/>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1" >
                                <label class="titulo1">Maximo nivel en no supervisión: </label>
                            </div>
                            <div class="div-criterio2" >
                                <select name="idnosupervision">
                                    <?php
                                    foreach ($noSupervision as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['nombre']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="limpiar-espacio"></div>
                        <?php
                    } elseif ($value == 9) {
                        ?>
                        <br/>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1" >
                                <label class="titulo1">Años de experiencia en supervisión: </label>
                            </div>
                            <div class="div-criterio2" >
                                <span>Mayor que&nbsp;</span><input type="text" value="" name="aniomas" size="5" maxlength="2" onkeyup="this.value = Numeros(this.value)" id="aniomas"/>
                                &nbsp;&nbsp;<span>Menor que&nbsp;</span><input type="text" value="" name="aniomenos" size="5" maxlength="2" onkeyup="this.value = Numeros(this.value)" id="aniomenos"/>
                                <br/>
                                <div class="limpiar-espacio" style="height: 7px"></div>
                                <label style="margin-left: 100px;border: 2px solid red; border-top: 2px solid white;text-align: center;padding-left:  50px;padding-right: 50px;margin-top: 10px;">Entre</label><br/>
                                <div id="mensajeyear"></div>
                            </div>
                        </div>
                        <div class="limpiar-espacio"></div>
                        <?php
                    } elseif ($value == 10) {
                        ?>
                        <br/>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1" >
                                <label class="titulo1">Recomendación: </label>
                            </div>
                            <div class="div-criterio2" >
                                <select name="idrecomendacion[]" id="recomendacion" multiple="multiple">
                                    <?php
                                    foreach ($recomendacion as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['nombre']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <div id="mensajeRecomendacion"></div>
                            </div>
                        </div>
                        <div class="limpiar-espacio"></div>
                        <?php
                    } elseif ($value == 11) {
                        ?>
                        <br/>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1" >
                                <label class="titulo1">Rangos de edad: </label>
                            </div>
                            <div class="div-criterio2" >
                                <span>Mayor que&nbsp;</span><input type="text" value="" name="edadmas" size="5" maxlength="2" onkeyup="this.value = Numeros(this.value)" id="edadmas"/>
                                &nbsp;&nbsp;<span>Menor que&nbsp;</span><input type="text" value="" name="edadmenos" size="5" maxlength="2" onkeyup="this.value = Numeros(this.value)" id="edadmenos"/>
                                <br/>
                                <div class="limpiar-espacio" style="height: 7px;"></div>
                                <label style="margin-left: 100px;border: 2px solid red; border-top: 2px solid white;text-align: center;padding-left:  50px;padding-right: 50px;margin-top: 10px;">Entre</label><br/>
                                <div id="mensajeedad"></div>
                            </div>
                        </div>
                        <div class="limpiar-espacio"></div>
                        <?php
                    } elseif ($value == 21) {
                        ?>
                        <br/>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1" >
                                <label class="titulo1">Cliente: </label>
                            </div>
                            <div class="div-criterio2" >        
                                <select name="idcliente">
                                    <?php
                                    foreach ($clientes as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['nombre']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="limpiar-espacio"></div>
                        <?php
                    } elseif ($value == 12) {
                        ?>
                        <br/>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1" >
                                <label class="titulo1">Género: </label>
                            </div>
                            <div class="div-criterio2" >
                                <span>Masculino</span><input type="radio" value="1" id="masculino" name="genero"/>
                                <span>Femenino</span><input type="radio" value="2" id="femenino" name="genero"/>
                                <div id="mensajegenero"></div>
                            </div>
                        </div>
                        <div class="limpiar-espacio"></div>
                        <?php
                    } elseif ($value == 13) {
                        ?>
                        <br/>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1" >
                                <label class="titulo1">Ultima pretención salarial: </label>
                            </div>
                            <div class="div-criterio2" >
                                <span>Mayor que&nbsp;</span><input type="text" value="" name="salariomas" size="5" maxlength="10" onkeyup="this.value = Numeros(this.value)" id="salariomas"/>
                                &nbsp;&nbsp;<span>Menor que&nbsp;</span><input type="text" value="" name="salariomenos" size="5" maxlength="10" onkeyup="this.value = Numeros(this.value)" id="salariomenos"/>
                                <div class="limpiar-espacio" style="height: 7px"></div>
                                <label style="margin-left: 100px;border: 2px solid red; border-top: 2px solid white;text-align: center;padding-left:  50px;padding-right: 50px;margin-top: 10px;">Entre</label><br/>
                                <div id="mensajesalario"></div>
                            </div>
                        </div>
                        <div class="limpiar-espacio"></div>
                        <?php
                    } elseif ($value == 14) {
                        ?>
                        <br/>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1" >
                                <label class="titulo1">Cargo al que postula: </label>
                            </div>
                            <!--                            <optgroup label='Friends'>
                                                            <option value='1'>Yoda</option>
                                                            <option value='2' selected>Obiwan</option>
                                                        </optgroup>-->

                            <div class="div-criterio2" >
                                <select name="idcargo[]" id="cargo" multiple='multiple'>
                                    <?php
                                    foreach ($cargos as $key => $value) {
                                        ?>
                                        <optgroup label='<?php echo $value['nombre']; ?>'>
                                            <?php
                                            foreach ($value['subcargos'] as $key => $valueSub) {
                                                ?>
                                                <option value="<?php echo $valueSub['id']; ?>"><?php echo $valueSub['nombre']; ?></option>
                                                <?php
                                            }
                                            ?>        
                                        </optgroup>
                                                    <!--<option value="<?php echo $value['id']; ?>"><?php echo $value['nombre']; ?></option>-->
                                        <?php
                                    }
                                    ?>
                                </select>
                                <div id="mensajecargo"></div>
                            </div>
                        </div>
                        <div class="limpiar-espacio"></div>
                        <?php
                    } elseif ($value == 15) {
                        ?>
                        <br/>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1" >
                                <label class="titulo1">Cargos desempeñados: </label>
                            </div>
                            <div class="div-criterio2" >
                                <input name="cargo" value="" type="text"/>
                            </div>
                        </div>
                        <div class="limpiar-espacio"></div>
                        <?php
                    } elseif ($value == 16) {
                        ?>
                        <br/>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1" >
                                <label class="titulo1">Sede: </label>
                            </div>
                            <div class="div-criterio2" >
                                <select name="idsede[]" id="sede" multiple="multiple">
                                    <?php
                                    foreach ($sedes as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['nombre']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <div id="mensajesede"></div>
                            </div>
                        </div>
                        <div class="limpiar-espacio"></div>
                        <?php
                    } elseif ($value == 17) {
                        ?>
                        <br/>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1" >
                                <label class="titulo1">Fecha de modificación de CV: </label>
                            </div>
                            <div class="div-criterio2" >
                                <select name="fechacv">
                                    <option value="6">6 meses</option>
                                    <option value="12">1 año</option>
                                </select>
                            </div>
                        </div>
                        <div class="limpiar-espacio"></div>
                        <?php
                    } elseif ($value == 18) {
                        ?>
                        <br/>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1" >
                                <label class="titulo1">Idioma ingles: </label>
                            </div>
                            <div class="div-criterio2" >
                                <!--<span>Habla &nbsp;&nbsp;</span>-->
                                <select name="ingles[]" id="ingles" multiple="multiple">
                                    <option value="1">Excelente</option>
                                    <option value="2">Muy bueno</option>
                                    <option value="3">Regular</option>
                                    <option value="4">Basico</option>
                                </select>
                                <div id="mensajeingles"></div>
                            </div>
                        </div>
                        <div class="limpiar-espacio"></div>
                        <?php
                    } elseif ($value == 19) {
                        ?>
                        <br/>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1" >
                                <label class="titulo1">Otros idiomas: </label>
                            </div>
                            <div class="div-criterio2" >
                                <select name="idotroidioma">
                                    <?php
                                    foreach ($idiomas as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['nombre']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="limpiar-espacio"></div>
                        <?php
                    } elseif ($value == 20) {
                        ?>
                        <br/>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1" >
                                <label class="titulo1">Sector de experiencia resaltada: </label>
                            </div>
                            <div class="div-criterio2" >
                                <select name="idsectorexperiencia[]" id="sectorexperiencia" multiple="multiple">
                                    <?php
                                    foreach ($experiencia as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['nombre']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <div id="mensajesector"></div>
                            </div>
                        </div>
                        <div class="limpiar-espacio"></div>
                        <?php
                    } elseif ($value == 22) {
                        ?>
                        <br/>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1" >
                                <label class="titulo1">Ciudad o Localidad de Bolivia: </label>
                            </div>
                            <div class="div-criterio2" >
                                <select name="idciudad[]" id="ciudad" multiple="multiple">
                                    <?php
                                    foreach ($ciudades as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['nombre']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <div id="mensajeciudad"></div>
                            </div>
                        </div>
                        <div class="limpiar-espacio"></div>
                        <?php
                    } elseif ($value == 23) {
                        ?>
                        <br/>
                        <div class="limpiar-espacio"></div>
                        <div class="contenedor-criterios">
                            <div class="div-criterio1" >
                                <label class="titulo1">Instancia: </label>
                            </div>
                            <div class="div-criterio2" >
                                <select name="idinstancia[]" id="instancia" multiple="multiple">
                                    <!--<select name="idciudad[]" id="ciudad" multiple="multiple">-->
                                    <?php
                                    foreach ($instancia as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['nombre']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="limpiar-espacio"></div>
                        <?php
                    }
                }
                ?>
                <div style="clear:both;"></div>
                <br/>
                <input type="button" class="obtener_criterios" value="Generar Reporte"/>
                <input type="text" id="stringcriterios" style="display: none;" value="<?php echo $stringcriterios; ?>">
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
                            $('#cargo').multiSelect({
                                selectableOptgroup: false
                            });
                            $('#ciudad').multiSelect({
                            });
                            $('#recomendacion').multiSelect({
                            });
                            $('#sectorexperiencia').multiSelect({
                            });
                            $('#sede').multiSelect({
                            });
                            $('#profesiones').multiSelect({
                            });
                            $('#areaexperiencia').multiSelect({
                            });
                            $('#ingles').multiSelect({
                                selectableHeader: "<div class='custom-header' style='text-align:center;'><b>Habla</b></div>",
                                selectionHeader: "<div class='custom-header' style='text-align:center;'><b>Habla</b></div>",
                            });
                            $('#instancia').multiSelect({
                            });
                            
                            var arrayProfesiones = new Array();
                            $(document).ready(function () {
                                $('#profesiones').change(function (event) {
                                    arrayProfesiones = $('select#profesiones').val();
//                                    $('.criterios_selecionados').val(arrayProfesiones.join());
                                    if ($(this).val().length >= 3) {
                                        $('#ms-profesiones .ms-elem-selectable').addClass('disabled');
                                    } else {
                                        $('#ms-profesiones .ms-elem-selectable').removeClass('disabled');
                                    }
                                });
                                $('#cargo').change(function (event) {
                                    arrayCargo = $('select#cargo').val();
//                                    $('.criterios_selecionados').val(arrayCargo.join());
                                    if ($(this).val().length >= 3) {
                                        $('#ms-cargo .ms-elem-selectable').addClass('disabled');
                                    } else {
                                        $('#ms-cargo .ms-elem-selectable').removeClass('disabled');
                                    }
                                });
                                $('#ciudad').change(function (event) {
                                    arrayCiudad = $('select#ciudad').val();
//                                    $('.criterios_selecionados').val(arrayCiudad.join());
                                    if ($(this).val().length >= 3) {
                                        $('#ms-ciudad .ms-elem-selectable').addClass('disabled');
                                    } else {
                                        $('#ms-ciudad .ms-elem-selectable').removeClass('disabled');
                                    }
                                });
                                $('#ingles').change(function (event) {
                                    arrayIngles = $('select#ciudad').val();
//                                    $('.criterios_selecionados').val(arrayCiudad.join());
                                    if ($(this).val().length >= 2) {
                                        $('#ms-ingles .ms-elem-selectable').addClass('disabled');
                                    } else {
                                        $('#ms-ingles .ms-elem-selectable').removeClass('disabled');
                                    }
                                });
                                $('#recomendacion').change(function (event) {
                                    arrayRecomendacion = $('select#ciudad').val();
//                                    $('.criterios_selecionados').val(arrayRecomendacion.join());
                                    if ($(this).val().length >= 2) {
                                        $('#ms-recomendacion .ms-elem-selectable').addClass('disabled');
                                    } else {
                                        $('#ms-recomendacion .ms-elem-selectable').removeClass('disabled');
                                    }
                                });
                                $('#sectorexperiencia').change(function (event) {
                                    arraySectorExperiencia = $('select#sectorexperiencia').val();
//                                    $('.criterios_selecionados').val(arraySectorExperiencia.join());
                                    if ($(this).val().length >= 3) {
                                        $('#ms-sectorexperiencia .ms-elem-selectable').addClass('disabled');
                                    } else {
                                        $('#ms-sectorexperiencia .ms-elem-selectable').removeClass('disabled');
                                    }
                                });
                                $('#sede').change(function (event) {
                                    arraySede = $('select#sede').val();
//                                    $('.criterios_selecionados').val(arraySede.join());
                                    if ($(this).val().length >= 2) {
                                        $('#ms-sede .ms-elem-selectable').addClass('disabled');
                                    } else {
                                        $('#ms-sede .ms-elem-selectable').removeClass('disabled');
                                    }
                                });
                                $('#areaexperiencia').change(function (event) {
                                    arrayAreaExperiencia = $('select#areaexperiencia').val();
//                                    $('.criterios_selecionados').val(arrayAreaExperiencia.join());
                                    if ($(this).val().length >= 2) {
                                        $('#ms-areaexperiencia .ms-elem-selectable').addClass('disabled');
                                    } else {
                                        $('#ms-areaexperiencia .ms-elem-selectable').removeClass('disabled');
                                    }
                                });
                                $('#instancia').change(function (event) {
                                    arrayProfesiones = $('select#instancia').val();
                                    if ($(this).val().length >= 3) {
                                        $('#ms-instancia .ms-elem-selectable').addClass('disabled');
                                    } else {
                                        $('#ms-instancia .ms-elem-selectable').removeClass('disabled');
                                    }
                                });
                                $(".obtener_criterios").click(function () {
                                    var stringCriterios = $("#stringcriterios").val();
                                    var arrayCriterios = stringCriterios.split(",");
                                    var resultado = [];
                                    for (var i = 0; i < arrayCriterios.length; i++) {
                                        switch (parseInt(arrayCriterios[i])) {
                                            case 1:
                                                resultado.push(validarPais());
                                                break;
                                            case 2:
                                                console.warn($("#profesiones").val());
                                                resultado.push(validarProfesion());
                                                break;
                                            case 3:
                                                resultado.push(validarAreaExperiencia());
                                                break;
                                            case 4:
                                                resultado.push(validarAmbitoExperiencia());
                                                break;
                                            case 5:
                                                resultado.push(validarExperienciaSupervicion());
                                                break;
                                            case 9:
                                                resultado.push(validarAnioExperiencia());
                                                break;
                                            case 10:
                                                resultado.push(validarRecomendacion());
                                                break;
                                            case 11:
                                                resultado.push(validarEdad());
                                                break;
                                            case 12:
                                                resultado.push(validarGenero());
                                                break;
                                            case 13:
                                                resultado.push(validarPretencionSalarial());
                                                break;
                                            case 14:
                                                resultado.push(validarCargo());
                                                break;
                                            case 16:
                                                resultado.push(validarSede());
                                                break;
                                            case 18:
                                                resultado.push(validarIngles());
                                                break;
                                            case 20:
                                                resultado.push(validarSector());
                                                break;
                                            case 22:
                                                resultado.push(validarCiudad());
                                                break;
                                        }
                                    }
                                    console.log(resultado.includes(false));
                                    if (resultado.includes(false) == false)
                                    {
                                        document.formularioCriterios.submit()
                                    }
//                                            validarAmbitoExperiencia();
//                                            validarCargo();
//                                            validarCiudad();
                                })
                            });
                            function validarAmbitoExperiencia() {
                                var ambito1 = document.getElementById('ambito1').checked;
                                var ambito2 = document.getElementById('ambito2').checked;
                                var ambito3 = document.getElementById('ambito3').checked;
                                if (ambito1 == true || ambito2 == true || ambito3 == true)
                                {
                                    $("#mensajeambito").removeClass('alerta-incorrecta-criterios');
                                    $("#mensajeambito").html("");
                                    return true;
                                } else {
                                    $("#mensajeambito").addClass('alerta-incorrecta-criterios');
                                    $("#mensajeambito").html("debe seleccionar al menos un ambito");
                                    return false;
                                }
                            }
                            function validarCargo() {
                                var arrayCargos = $("#cargo").val();
                                if (arrayCargos.length > 0)
                                {
                                    $("#mensajecargo").removeClass('alerta-incorrecta-criterios');
                                    $("#mensajecargo").html("");
                                    return true;
                                } else {
                                    $("#mensajecargo").addClass('alerta-incorrecta-criterios');
                                    $("#mensajecargo").html("debe seleccionar al menos un cargo");
                                    return false;
                                }
                            }
                            function validarSector() {
                                var arraySector = $("#sectorexperiencia").val();
                                if (arraySector.length > 0)
                                {
                                    $("#mensajesector").removeClass('alerta-incorrecta-criterios');
                                    $("#mensajesector").html("");
                                    return true;
                                } else {
                                    $("#mensajesector").addClass('alerta-incorrecta-criterios');
                                    $("#mensajesector").html("debe seleccionar al menos un sector de experiencia");
                                    return false;
                                }
                            }
                            function validarAreaExperiencia() {
                                var arrayArea = $("#areaexperiencia").val();
                                if (arrayArea.length > 0)
                                {
                                    $("#mensajearea").removeClass('alerta-incorrecta-criterios');
                                    $("#mensajearea").html("");
                                    return true;
                                } else {
                                    $("#mensajearea").addClass('alerta-incorrecta-criterios');
                                    $("#mensajearea").html("debe seleccionar al menos una área de experiencia");
                                    return false;
                                }
                            }
                            function validarSede() {
                                var arraySede = $("#sede").val();
                                if (arraySede.length > 0)
                                {
                                    $("#mensajesede").removeClass('alerta-incorrecta-criterios');
                                    $("#mensajesede").html("");
                                    return true;
                                } else {
                                    $("#mensajesede").addClass('alerta-incorrecta-criterios');
                                    $("#mensajesede").html("debe seleccionar al menos una sede");
                                    return false;
                                }
                            }
                            function validarProfesion() {
                                var arrayProfesiones = $("#profesiones").val();
                                if (arrayProfesiones.length > 0)
                                {
                                    $("#mensajeprofesion").removeClass('alerta-incorrecta-criterios');
                                    $("#mensajeprofesion").html("");
                                    return true;
                                } else {
                                    $("#mensajeprofesion").addClass('alerta-incorrecta-criterios');
                                    $("#mensajeprofesion").html("debe seleccionar al menos una profesión");
                                    return false;
                                }
                            }
                            function validarRecomendacion() {
                                var arrayRecomendacion = $("#recomendacion").val();
                                if (arrayRecomendacion.length > 0)
                                {
                                    $("#mensajeRecomendacion").removeClass('alerta-incorrecta-criterios');
                                    $("#mensajeRecomendacion").html("");
                                    return true;
                                } else {
                                    $("#mensajeRecomendacion").addClass('alerta-incorrecta-criterios');
                                    $("#mensajeRecomendacion").html("debe seleccionar al menos una recomendación");
                                    return false;
                                }
                            }
                            function validarCiudad() {
                                var arrayCargos = $("#ciudad").val();
                                if (arrayCargos.length > 0)
                                {
                                    $("#mensajeciudad").removeClass('alerta-incorrecta-criterios');
                                    $("#mensajeciudad").html("");
                                    return true;
                                } else {
                                    $("#mensajeciudad").addClass('alerta-incorrecta-criterios');
                                    $("#mensajeciudad").html("debe seleccionar al menos una ciudad");
                                    return false;
                                }
                            }
                            function validarIngles() {
                                var arrayCampos = $("#ingles").val();
                                if (arrayCampos.length > 0)
                                {
                                    $("#mensajeingles").removeClass('alerta-incorrecta-criterios');
                                    $("#mensajeingles").html("");
                                    return true;
                                } else {
                                    $("#mensajeingles").addClass('alerta-incorrecta-criterios');
                                    $("#mensajeingles").html("debe seleccionar al menos una opción de habla ingles");
                                    return false;
                                }
                            }
                            function validarGenero() {
                                var masculino = document.getElementById('masculino').checked;
                                var femenino = document.getElementById('femenino').checked;
                                if (masculino == true || femenino == true)
                                {
                                    $("#mensajegenero").removeClass('alerta-incorrecta-criterios');
                                    $("#mensajegenero").html("");
                                    return true;
                                } else {
                                    $("#mensajegenero").addClass('alerta-incorrecta-criterios');
                                    $("#mensajegenero").html("debe seleccionar al menos un genero");
                                    return false;
                                }
                            }
                            function validarExperienciaSupervicion() {
                                var experienciasi = document.getElementById('experienciasi').checked;
                                var experienciano = document.getElementById('experienciano').checked;
                                if (experienciasi == true || experienciano == true)
                                {
                                    $("#mensajeexperiencia-s").removeClass('alerta-incorrecta-criterios');
                                    $("#mensajeexperiencia-s").html("");
                                    return true;
                                } else {
                                    $("#mensajeexperiencia-s").addClass('alerta-incorrecta-criterios');
                                    $("#mensajeexperiencia-s").html("debe seleccionar al menos una opcion");
                                    return false;
                                }
                            }
                            function validarPais() {
                                var solo = document.getElementById('solo').checked;
                                var todo = document.getElementById('todo').checked;
                                if (solo == true || todo == true)
                                {
                                    $("#mensajepais").removeClass('alerta-incorrecta-criterios');
                                    $("#mensajepais").html("");
                                    return true;
                                } else {
                                    $("#mensajepais").addClass('alerta-incorrecta-criterios');
                                    $("#mensajepais").html("debe seleccionar al menos una opción");
                                    return false;
                                }
                            }
                            function validarEdad() {
                                var edadmas = $("#edadmas").val();
                                var edadmenos = $("#edadmenos").val();
                                if (edadmas != "" || edadmenos != "")
                                {
                                    $("#mensajeedad").removeClass('alerta-incorrecta-criterios');
                                    $("#mensajeedad").html("");
                                    return true;
                                } else {
                                    $("#mensajeedad").addClass('alerta-incorrecta-criterios');
                                    $("#mensajeedad").html("debe introducir valores");
                                    return false;
                                }
                            }
                            function validarAnioExperiencia() {
                                var aniomas = $("#aniomas").val();
                                var aniomenos = $("#aniomenos").val();
                                if (aniomas != "" || aniomenos != "")
                                {
                                    $("#mensajeyear").removeClass('alerta-incorrecta-criterios');
                                    $("#mensajeyear").html("");
                                    return true;
                                } else {
                                    $("#mensajeyear").addClass('alerta-incorrecta-criterios');
                                    $("#mensajeyear").html("debe introducir valores");
                                    return false;
                                }
                            }
                            function validarPretencionSalarial() {
                                var salariomas = $("#salariomas").val();
                                var salariomenos = $("#salariomenos").val();
                                if (salariomas != "" || salariomenos != "")
                                {
                                    $("#mensajesalario").removeClass('alerta-incorrecta-criterios');
                                    $("#mensajesalario").html("");
                                    return true;
                                } else {
                                    $("#mensajesalario").addClass('alerta-incorrecta-criterios');
                                    $("#mensajesalario").html("debe introducir valores");
                                    return false;
                                }
                            }


    </script>