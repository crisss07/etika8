<!-- cdn fontawesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>

<script language="javascript">
    $(document).ready(function () {
        // Parametros para e combo1
        $("#campob").change(function () {
            $("#campob option:selected").each(function () {
                //alert($(this).val());
                elegido = $(this).val();
                if (elegido > 0 && elegido <= 5) {
                    mostrardiv('inputbuscar');
                    mostrardiv('cajatexto');
                    cerrar('selec1');
                    cerrar('selec2');
                    cerrar('selec3');
                } else if (elegido == 6) {
                    mostrardiv('selec1');
                    mostrardiv('inputbuscar');
                    cerrar('cajatexto');
                    cerrar('selec2');
                    cerrar('selec3');
                } else if (elegido == 7) {
                    mostrardiv('selec2');
                    mostrardiv('inputbuscar');
                    cerrar('cajatexto');
                    cerrar('selec1');
                    cerrar('selec3');
                } else if (elegido == 8) {
                    mostrardiv('selec3');
                    mostrardiv('inputbuscar');
                    cerrar('cajatexto');
                    cerrar('selec1');
                    cerrar('selec2');
                } else {
                    cerrar('inputbuscar');
                    cerrar('cajatexto');
                    cerrar('selectcliente');
                    cerrar('selectinstancia');
                    cerrar('selectrecomendable');
                }
            });
        })

    });
    function mostrardiv(nombre) {
        div = document.getElementById(nombre);
        div.style.display = '';
    }
    function cerrar(nombre) {
        div = document.getElementById(nombre);
        div.style.display = 'none';
    }
    $(document).ready(function () {
        $("#cliente").change(function () {
            $("#cliente option:selected").each(function () {
                var id = $(this).val();
                var dataString = 'id=' + id;
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url(), "admin.php/postulante/cargos_select"; ?>',
                    data: dataString,
                    cache: false,
                    success: function (html) {
                        $("#cargo").html(html);
                    }
                });
            });
        })
    });
</script>
<?php
$this->load->view('cabecera');
?>

<?php
$enlace = '/campob/' . $criterio;
if (@$cadena)
    $enlace .= '/cadena/' . $cadena;
if (@$cliente)
    $enlace .= '/cliente/' . $cliente;
if (@$cargo)
    $enlace .= '/cargo/' . $cargo;
if (@$instancia)
    $enlace .= '/instancia/' . $instancia;
if (@$recomendacion)
    $enlace .= '/recomendacion/' . $recomendacion;
$prefijo = $this->prefijo;
$msj_confirmar = '¿Está seguro que desea eliminar al Postulante, Se eliminara todo su historial en el Sistema?';
//$ruta=$this->rutabase.$this->carpetaup;
if (@$this->carpetaup) {
    $ruta = $this->rutarchivo . $this->carpetaup;
} else {
    $ruta = $this->rutarchivo . $this->carpeta;
}
//$ruta=$this->rutarchivo.$this->carpetaup;
$alineacionw = 'center';
$alineacionh = 'middle';
$consulta = $this->db->query('
        SELECT cli_id as id, cli_nombre as nombre
        FROM clientes
        ORDER BY nombre asc'
);
$clientes = $consulta->result_array();
$instancias[0] = 'Seleccione Instancia';
$instancias[1] = 'EP';
$instancias[2] = 'TP';
$instancias[3] = 'Assesment';
$instancias[4] = 'Entrevista';
$instancias[5] = 'Finalista';
$instancias[6] = 'Elegido';
$consulta = $this->db->query('
        SELECT com_id as id, com_nombre as nombre
        FROM combos
        WHERE com_tipo="7"
        ORDER BY com_orden asc'
);
$recomendaciones = $consulta->result_array();
?>


<div id="listado">
    <?php
    /*
      if(!$this->nolistar){
      $this->load->view('opciones');} */
    $sitio = $this->tool_entidad->sitioindexpri();
    ?>
    <?php
    $sitio = $this->tool_entidad->sitioindexpri();
    $buscar_campo[0] = 'Elija Criterio';
    $buscar_campo[1] = 'Todo';
    $buscar_campo[2] = 'Documento';
    $buscar_campo[3] = 'Apellido Paterno';
    $buscar_campo[4] = 'Apellido Materno';
    $buscar_campo[5] = 'Nombres';
    $buscar_campo[6] = 'Cliente';
    $buscar_campo[7] = 'Instancia';
    $buscar_campo[8] = 'Recomendable';
    $alineacionw = 'center';
    $alineacionh = 'middle';
    if (!@$cadena) {
        $style = 'style="display: none;"';
    }
    if (!@$cliente) {
        $style1 = 'style="display: none;"';
    }
    if (!@$instancia) {
        $style2 = 'style="display: none;"';
    }
    if (!@$recomendacion) {
        $style3 = 'style="display: none;"';
    }
    if (@$cadena || @$cliente || @$instancia || @$recomendacion) {
        
    } else {
        $style_buscador = 'style="display: none;"';
    }
    ?>
    <div class="rutabase" style="display: none;"><?php echo $sitio;?></div>
    <form method="post" action="<?php echo $sitio . $this->controlador . 'listar'; ?>">
        <table align="center">
            <tr>
                <td align="center" style="width: 10px;">
                    <p class="form-label-21">Seleccionar criterio de búsqueda</p>
                    
                    <select name="campob" id="campob" class="form-select-21" style="width: 180px;">
                        <?php for ($i = 0; $i < count($buscar_campo); $i++) { ?>
                            <option value="<?php echo $i ?>" <?php
                            if ($criterio == $i) {
                                echo 'selected';
                            }
                            ?> ><?php echo '&nbsp;' . $buscar_campo[$i] . '&nbsp;&nbsp;&nbsp;'; ?></option>
                                <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <div id="cajatexto" <?php echo @$style; ?> >
                        <p class="form-label-21">
                        Introducir texto para buscar </p>
                        <input name="cadena" id="cadena" size="20" class="input1" value="<?php echo @$cadena ?>"/>
                    </div>
                    <div id="selec1" <?php echo @$style1; ?>><br/>
                        <select name="cliente" id="cliente" class="form-select-21" style="width: 330px;">
                            <option value="0" >Seleccione al Cliente</option>
                            <?php foreach ($clientes as $row) { ?>
                                <option value="<?php echo $row['id'] ?>" <?php
                                if (@$cliente == $row['id']) {
                                    echo 'selected';
                                }
                                ?> ><?php echo $row['nombre']; ?></option>
                                    <?php } ?>
                        </select>   
                        &nbsp;    &nbsp;&nbsp;             
                        <select name="cargo" id="cargo" class="form-select-21" style="width: 330px;">
                            <option value="0" >Seleccione el cargo</option>                            
                            <?php foreach ($this->cargos as $num => $row) { ?>
                                <option value="<?php echo $num ?>" <?php
                                if (@$cargo == $num) {
                                    echo 'selected';
                                }
                                ?> ><?php echo $row; ?></option>
                                    <?php } ?>
                        </select>                
                    </div>
                    <div id="selec2" <?php echo @$style2; ?>><br/>
                        <select name="instancia" id="campob" class="form-select-21" style="width: 180px;">
                            <?php for ($i = 0; $i < count($instancias); $i++) { ?>
                                <option value="<?php echo $i ?>" <?php
                                if (@$instancia == $i) {
                                    echo 'selected';
                                }
                                ?> ><?php echo $instancias[$i]; ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div id="selec3" <?php echo @$style3; ?>><br/>
                        <select name="recomendacion" id="cliente" class="form-select-21" style="width: 250px;">
                            <option value="0" >Seleccione Recomendable</option>
                            <?php foreach ($recomendaciones as $row) { ?>
                                <option value="<?php echo $row['id'] ?>" <?php
                                if (@$recomendacion == $row['id']) {
                                    echo 'selected';
                                }
                                ?> ><?php echo $row['nombre']; ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div id="inputbuscar" <?php echo @$style_buscador; ?>>
                        <br/><br/><input type="submit" name="buscar" class="btn-etika btn" value="Buscar"/>
                    </div>
                </td>            
            </tr>
        </table>
    </form>




    <div class="paginacion_lista"><?php //echo $this->pagination->create_links();     ?></div>

    <?php
    if ($datos) {
        ?>    
        <form action="<?php echo $sitio . $this->controlador . 'generar_zip' ?>" method="post" id="form_listar_fsimple">        
            <input type="hidden" name="cadena" value="<?php echo @$cadena; ?>"/>
            <input type="hidden" name="criterio" value="<?php echo $criterio; ?>"/>
            <input type="hidden" name="cliente" value="<?php echo @$cliente; ?>"/>
            <input type="hidden" name="cargo" value="<?php echo @$cargo; ?>"/>
            <input type="hidden" name="instancia" value="<?php echo @$instancia; ?>"/>
            <input type="hidden" name="recomendacion" value="<?php echo @$recomendacion; ?>"/>
            <div class="scrollh">
                <table  align="center" class="tabla_listado"  cellspacing="0" width="100%">
                    <tr class="cabecera_listado">
                        <?php
                        for ($i = 0; $i < count($campos_listar); $i++) {
                            if (!$this->tool_general->find_in_array(strtolower($campos_listar[$i]), $hiddens)) {
                                ?>
                                <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>"><?php echo $campos_listar[$i]; ?></td>
                                <?php
                            }
                        }
                        ?>
                        <?php
                        // ini enlaces label
                        if ($this->enlaces) {
                            for ($i = 1; $i <= count($this->enlaces) / $this->nroenlaces; $i++) {
                                ?>
                                <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>"><?php echo $this->enlaces['nombre' . $i] ?></td>
                                <?php
                            }
                        }
                        //fin enlaces label
                        ?>
                        <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">CV<br/>(doc)</td>
                        <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">CV<br/>(pdf)</td>
                        <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">Editar</td>
                        <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">Eliminar</td>
                        <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">Carpeta</td>
                        <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>"><input type="checkbox" name="chk_all" id="chk_all"/></td>
                    </tr>

                    <?php
                    foreach ($datos as $fila) {
                        ?>
                        <tr>


                            <?php
                            if (@$orden) {
                                ?>
                                <td align="center"> <input type='text' name='<?php echo 'orden' . $fila[$prefijo . 'id']; ?>' value='<?php echo $fila[$orden]; ?>' size="1" class="input2"></td>
                                <?php
                            }
                            ?>
                            <?php $dato_ci=''; ?>
                            <?php
                            for ($i = 0; $i < count($campos_reales); $i++) {
                                ?>
                                <?php
                                if (!$this->tool_general->find_in_array(strtolower($campos_reales[$i]), $hiddens)) {
                                    if ((@$imagen == strtolower($campos_reales[$i])) || (@$adjunto == strtolower($campos_reales[$i]))) {
                                        if ($imagen == strtolower($campos_reales[$i])) {
                                            ?>
                                            <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">
                                                <img src="<?php echo $ruta . $fila[$imagen]; ?>" width="150" alt="Sin imagen"/>
                                            </td>
                                            <?php
                                        } else {

                                            $tipofile = $this->tool_general->tipofig_extension(strtolower(substr($fila[$adjunto], -4)));
                                            ?>
                                            <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">
                                                <img src="<?php echo $this->rutaimg . $tipofile . '.gif'; ?>" alt="Sin archivo"/>
                                                <?php echo "<b>" . $fila[$adjunto] . "</b>"; ?>

                                            </td>
                                            <?php
                                        }
                                    } else {
                                        if (@$contenido == strtolower($campos_reales[$i])) {
                                            ?>
                                            <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>"><?php echo strip_tags(substr($fila[strtolower($campos_reales[$i])], 0, 200)); ?>&nbsp;</td>
                                            <?php
                                        } else {
                                            if ((@$estado != strtolower($campos_reales[$i])) && (@$actual != strtolower($campos_reales[$i])) && (@$orden != strtolower($campos_reales[$i])) && (@$destacadomas != strtolower($campos_reales[$i]))) {
                                                ?>
                                                <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">
												<?php if($campos_reales[$i]=='pof_recomendacion') { 
												$valor = 'Sin mayor información';
												foreach($recom as $re){
													if($re['id']==$fila[strtolower($campos_reales[$i])])
													{
														$valor = $re['nombre'];
													}
												}
												echo $valor;
												?>
												<?php } else{
												?>
												<?php echo strip_tags($fila[strtolower($campos_reales[$i])]); ?>&nbsp;
												<?php } ?>
                                                <?php $dato_ci= $fila[strtolower($campos_reales[3])];//ci del postulante ?>
                                                </td>
                                                <?php
                                            }
                                        }
                                    }
                                }
                            }
                            ?>   
                   <!-- estado  -->
                            <?php
                    if($fila[$estado])
                    {
                        $class_estado="habilitado";
                        $estado_accion='Disponible';
                        $estado_accion1='Deshabilitar';
                    }
                    else
                    {
                        $class_estado="deshabilitado";
                        $estado_accion='No Disponible';
                        $estado_accion1='Habilitar';
                    }
                                ?>
                                        <?php
                    if($estado)
                    {
                                            ?>
                    <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>"><div class="<?php echo $class_estado;?>"></div><br/>
                                            <?php
                        if($fila[$estado])
                        {
                            echo anchor($this->controlador.'deshabilitar/id/'.$fila[$prefijo.'id'] . $enlace,$estado_accion,array('class' =>'enlace_a1','title' => $estado_accion1));
                                        }
                        else
                        {
                            echo anchor($this->controlador.'habilitar/id/'.$fila[$prefijo.'id'] . $enlace,$estado_accion,array('class' =>'enlace_a1','title' => $estado_accion1));
                                    }


                                    ?>
                                </td>
                                <?php
                            }
                            ?>
                            <?php
                            //ini enlaces
                            if ($this->enlaces) {
                                for ($i = 1; $i <= count($this->enlaces) / $this->nroenlaces; $i++) {
                                    ?>
                                    <td align="center" valign="<?php echo $alineacionh; ?>">
                                        <?php
                                        /* $consulta = $this->db->query('
                                          SELECT *
                                          FROM
                                          '.$this->enlaces['tabla'.$i].'
                                          where '.$this->enlaces['campo'.$i].'="'.$fila[$this->enlaces['camposup'.$i]].'"'
                                          );
                                          $nro=$consulta->num_rows(); */
                                        echo anchor($this->enlaces['ruta' . $i] . '/idp/' . $fila[$prefijo . 'id'] . $enlace, $fila[$prefijo . 'nro_postulaciones'], array('class' => 'enlace_a3'));
                                        ?>

                                    </td>
                                    <?php
                                }
                            }

                            //fin enlaces
                            ?>
                            <td align="center" valign="<?php echo $alineacionh; ?>">
                                <?php echo anchor($this->controlador . 'imprimir_doc/id/' . $fila[$prefijo . 'id'], 'Imprimir', array('target' => '_blank', 'class' => 'enlace_a1')); ?>
                            </td>
                            <td align="center" valign="<?php echo $alineacionh; ?>">
                                <?php echo anchor($this->controlador . 'imprimir_pdf/id/' . $fila[$prefijo . 'id'], 'Imprimir', array('target' => '_blank', 'class' => 'enlace_a1')); ?>
                            </td>
                            <td align="center" valign="<?php echo $alineacionh; ?>">
                                <?php echo anchor($this->controlador . 'editar/id/' . $fila[$prefijo . 'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a1')); ?>
                            </td>
                            <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">
                                <?php echo anchor($this->controlador . 'eliminar/id/' . $fila[$prefijo . 'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/eliminar.png" alt="eliminar">', array('class' => 'enlace_a1', 'onclick' => "return confirmar('$msj_confirmar')")); ?>                       
                            </td> 
                            <td align="?php echo $alineacionw; ?>" valign="?php echo $alineacionh; ?>" >
                       <?php echo anchor('Postulacion/folder_postulante/' . $dato_ci, '<i class="fas fa-folder-open"></i> ', array('class' => 'enlace_a1','style'=>'font-size: 24px;')); ?>

                       
                    </td>                  
                            <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>"><input type="checkbox" name="<?php echo 'chk' . $fila[$prefijo . 'id']; ?>"/></td>
                        </tr>
                        <?php
                    }
                    ?>

                </table>
            </div>
            <br/>
            <br/>        
            <table>
                <tr>                
                    <td>Para los elementos marcados</td>
                    <td><input type="Submit" name="descargar_doc" class="btn-etika btn" value=" Descargar "/></td>
                    <td> (DOCs agrupados en un ZIP)</td>
                </tr>
            </table>
        </form>    
    <?php } elseif ($criterio) { ?>
        <b>Nuestros filtros no han identificado información.</b>
    <?php } ?>
</div>


