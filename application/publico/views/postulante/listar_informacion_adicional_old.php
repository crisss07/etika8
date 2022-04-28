<?php
$this->load->view('cabecera');
?>

<?php
$msj_confirmar = '¿Está seguro que desea eliminar el elemento seleccionado?';
$ruta = $this->rutarchivo . $this->carpetaup;
$prefijo = $this->prefijo4;
$prefijoPI = $this->prefijoPI;
//print_r($fila);
switch ($fila[$prefijoPI . 'lee']) {
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
switch ($fila[$prefijoPI . 'habla']) {
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
switch ($fila[$prefijoPI . 'escribe']) {
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
<div id="listado">
    <?php
    $sitio = $this->tool_entidad->sitioindexpri();
    ?> 
    <!--para el idioma ingles-->

    <!--<form action="<?php // echo $sitio . $this->controlador . 'procesar'   ?>" method="post" id="form_listar_fsimple">-->
    <!--<form action="<?php // echo $sitio . $this->controlador . 'completo'   ?>" method="post" id="form_listar_fsimple">-->
    <form action="<?php echo $sitio . $this->controlador . 'guardar_editar_informacion_adicional' ?>" method="post" id="form_listar_fsimple">
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <input type="hidden" name="poi_id" value="<?php echo $fila['poi_id']; ?>" />
        <table cellpadding="0" border="0" cellspacing="0">
            <tr>
                <td align="left">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="left"><div class="titulo_cabecera_listado">IDIOMAS QUE HABLA</div></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="tamanio_campos">   
                        <tr>
                            <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                                <?php $nombre = 'idioma'; ?>
                                <?php echo form_label(' INGLÉS: ', $prefijoPI . $nombre); ?>
                            </td>
                        </tr>
                    </table>                 
                    <table cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                                <table class="tabla_listado" cellspacing="0" cellpadding="3" bordercolor="#b0c4c5" border="1">
                                    <tr align="center" class="cabecera_listado">
                                        <td><span class="" style="margin:10px;"> Descripción</span></td>
                                        <td><span class="" style="margin:10px;">Excelente</span></td>
                                        <td><span class="" style="margin:10px;">Muy bueno</span></td>
                                        <td><span class="" style="margin:10px;">Regular</span></td>
                                        <td><span class="" style="margin:10px;">Basico</span></td>
                                        <td width="200"> Mensajes </td>
                                    </tr>
                                    <tr>
                                        <td class="texto_label" style="padding: 10px 0px;" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                                            <?php $nombre = 'habla'; ?>
                                            <?php echo form_label(' Habla: ', $prefijoPI . $nombre); ?>
                                        </td>
                                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="1" <?php echo $valor_habla1; ?> /></td>
                                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="2" <?php echo $valor_habla2; ?> /></td>
                                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="3" <?php echo $valor_habla3; ?> /></td>
                                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="4" <?php echo $valor_habla4; ?> /></td>                                
                                        <td align="left">
                                            <?php
                                            if (form_error($prefijoPI . $nombre))
                                                echo '<div class="error" style="text-aling:center;">' . form_error($prefijoPI . $nombre) . '</div>';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="texto_label" style="padding:10px 0px;" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                                            <?php $nombre = 'lee'; ?>
                                            <?php echo form_label(' Lee: ', $prefijoPI . $nombre); ?>
                                        </td>
                                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="1" <?php echo $valor_lee1; ?> /></td>
                                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="2" <?php echo $valor_lee2; ?> /></td>
                                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="3" <?php echo $valor_lee3; ?> /></td>
                                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="4" <?php echo $valor_lee4; ?> /></td>
                                        <td align="left">
                                            <?php
                                            if (form_error($prefijoPI . $nombre))
                                                echo '<div class="error">' . form_error($prefijoPI . $nombre) . '</div>';
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="texto_label" style="padding:10px 0px;" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                                            <?php $nombre = 'escribe'; ?>
                                            <?php echo form_label(' Escribe: ', $prefijoPI . $nombre); ?>
                                        </td>
                                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="1" <?php echo $valor_escribe1; ?> /></td>
                                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="2" <?php echo $valor_escribe2; ?> /></td>
                                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="3" <?php echo $valor_escribe3; ?> /></td>
                                        <td align="center" valign="<?php echo $alineacionhc2; ?>"><input type="radio" name="<?php echo $prefijoPI . $nombre; ?>" value="4" <?php echo $valor_escribe4; ?> /></td>
                                        <td align="left">
                                            <?php
                                            if (form_error($prefijoPI . $nombre))
                                                echo '<div class="error">' . form_error($prefijoPI . $nombre) . '</div>';
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>                 
                </td>
            </tr>
            <tr>
                <td align="left">
                    <table class="tabla_listado" border="1" bordercolor="#b0c4c5" cellspacing="0" cellpadding="3" width="815">            
                        <!-- ini cabeceras -->
                        <tr class="cabecera_listado">
                            <?php
                            for ($i = 0; $i < count($campos_listar_idioma); $i++) {
                                if (!$this->tool_general->find_in_array(strtolower($campos_listar_idioma[$i]), $hiddens)) {
                                    ?>
                                    <td><?php echo $campos_listar_idioma[$i]; ?></td>
                                    <?php
                                }
                            }
                            ?>
                            <td>Editar</td>
                            <td>Eliminar</td>
                        </tr>
                        <!-- fin cabeceras -->
                        <?php if ($idiomas) { ?>
                            <?php
                            $prefijo = $this->prefijoPI;
//                            echo "<pre>";
//                            print_r($idiomas);
                            foreach ($idiomas as $fila) {
                                ?>
                                <tr>
                                    <?php
                                    for ($i = 0; $i < count($campos_reales_idioma); $i++) {
                                        if (!$this->tool_general->find_in_array(strtolower($campos_reales_idioma[$i]), $hiddens)) {
                                            if (strtolower($campos_reales_idioma[$i]) == 'edu_grado') {
                                                ?>
                                                <td valign="center"><?php echo $this->grados[$fila[strtolower($campos_reales_idioma[$i])]]; ?></td>
                                                <?php
                                            } else {
                                                if (($estado != strtolower($campos_reales_idioma[$i])) && ($actual != strtolower($campos_reales_idioma[$i])) && ($orden != strtolower($campos_reales_idioma[$i])) && ($destacadomas != strtolower($campos_reales_idioma[$i]))) {
                                                    ?>
                                                    <td valign="center"><?php echo strip_tags($fila[strtolower($campos_reales_idioma[$i])]); ?>&nbsp;</td>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                    <td align="center"><?php echo anchor($this->controlador . 'editar_idioma/id/' . $fila[$prefijo . 'id'], 'Editar', array('class' => 'enlace_editar1 enlace_a1')); ?></td>
                                    <td align="center"><?php echo anchor($this->controlador . 'eliminar_idioma/id/' . $fila[$prefijo . 'id'], 'Eliminar', array('class' => 'enlace_eliminar1 enlace_a1', 'onclick' => "return confirmar('$msj_confirmar')")); ?></td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="7" align="left">
                                    <div class="enlace_nodato1"><img src="<?php echo $this->tool_entidad->sitio() . 'files/img/maq/no_data.png'; ?>" hspace="5" />No tiene ningun Idioma</div>                        
                                </td>
                            </tr>
                        <?php } ?>                
                    </table>                    
                </td>
            </tr>
        </table>        
        <div class="tabla_listado_nuevo" align="left"> &nbsp; <?php echo anchor($this->controlador . 'idioma_nuevo', 'Agregar Nuevo Idioma', array('class' => 'enlace_nuevo1 enlace_a1')); ?>&nbsp;&nbsp;</div>
        <!--</form>-->    
        <!--<form action="<?php echo $sitio . $this->controlador . 'completo' ?>" method="post" id="form_listar_fsimple">-->
<!--        <table align="center" border="0" cellspacing="0" cellpadding="3" width="815">
            <tr>
                <td width="350" valign="top" align="left">
                    <?php
                    $comentario = $recibir['comentario'];
                    if ($recibir['recibir'] == 1) {
                        $recibir = 'checked';
                    }
                    ?>
                    <div style="color:#355A5C; font-size: 12px;">Si Ud. desea recibir <b>boletines electrónicos  de ETIKA</b><br/>
                        con avisos de postulaciones nuevas e información interesante<br/>
                        suscribase:</div>
                </td>
                <td rowspan="2"> &nbsp; </td>
            </tr>
            <tr>
                <td align="center"><input type="checkbox" name="recibir_boletin" value="1" <?php echo $recibir; ?> /> <span class="texto3">Si</span></td>
            </tr>
        </table>-->
        <table align="center" border="0" cellspacing="0" cellpadding="3" width="815">           
            <tr>
                <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="top">
                    <?php $nombre = 'comentario'; ?><br/>
                    <?php echo form_label('Comentario Adicional: ', $nombre); ?>
                </td>
                <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>"><br/>
                    <?php
                    echo "<textarea name=".$nombre." id=".$nombre."
                                    class='input1' rows='8' cols='64' onblur='Mayusculas(this.value,this.id)'>".$comentario."</textarea>";
//                    echo form_textarea(array(
//                        'name' => $nombre,
//                        'id' => $nombre,
//                        'class' => 'input1',
//                        'rows' => '8',
//                        'cols' => '64',
//                        'onblur' => 'Mayusculas(this.value,this.id)',
//                        'value' => set_value($nombre, $comentario)
//                    ));
                    ?>
                </td>
            </tr>
        </table>
        <table  align="center" cellspacing="35" width="815">            
            <tr>
                <td align="left" valign="top">
                    <?php echo anchor('postulante/trayectoria_laboral', '<img border="0" src="' . $this->tool_entidad->sitio() . 'files/img/maq/anterior.gif"/>'); ?>
                </td>
                <td align="right" valign="top">                    
                    <input name="enviar" src="<?php echo $this->tool_entidad->sitio() . 'files/img/maq/siguiente.gif'; ?>" type="image" value="  Guardar  ">                    
                </td>
            </tr>
        </table>
    </form>

</div> 


