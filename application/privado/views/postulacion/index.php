<!-- cdn fontawesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
<div id="listado" style=" padding: 20px;">
    <br/>
    <?php
    $this->load->view('cabecera');
    ?>
    <?php
    $prefijo = $this->prefijo;
    $msj_confirmar = '¿Está seguro que desea eliminar el elemento seleccionado?';
    $sitio = $this->tool_entidad->sitioindexpri();
    $alineacionw = 'center';
    $alineacionw1 = 'left';
    $alineacionh = 'middle';
    ?>
    <br/>
    <div class="scrollh">
        <table  align="center" class="tabla_listado"  cellspacing="0" width="100%">
            <tr class="cabecera_listado">
                <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">Fecha Final</td>
                <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">Fecha Tope <br/>de Postulación</td>
                <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">Cargo</td>
                <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">Cliente</td>
                <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">Nº de Postulantes</td>            
    <!--            <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">Nº de Postulantes / Desvincular /<br/> Convocatorias vigentes</td>            -->
                <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">Procesar</td>
                <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">Postular</td>
                <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">Etapas<br/>Completadas</td>
                <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">Carpeta</td>
            </tr>
            <?php 
			$fila_color = array('fila-color-1','fila-color-2');
			$color=0;
			foreach ($datos as $fila) { 
				if($color==0)
				{
					$filac=$fila_color[0]; $color=1;
				}
				else{ 
					$filac=$fila_color[1]; $color=0;
				}
			?>
                <?php
                if ($fila['con_interno']) {
                    $style = 'style="color:#fe0002;"';
                } else {
                    $style = '';
                }
                ?>
                <tr class="<?php echo $filac; ?>" <?php echo $style; ?> >
                    <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">
                        <?php echo $fila['con_hasta']; ?>
                    </td>
                    <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">
                        <?php echo $fila['con_tope']; ?>
                    </td>
                    <td align="<?php echo $alineacionw1; ?>" valign="<?php echo $alineacionh; ?>">
                        <?php echo $fila['con_cargo']; ?>
                    </td>
                    <td align="<?php echo $alineacionw1; ?>" valign="<?php echo $alineacionh; ?>">
                        <?php echo $fila['cli_nombre']; ?>
                    </td>
                    <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">
                        <?php
//                        $consulta = $this->db->query('SELECT * FROM convocatoria_postulacion WHERE con_id1='.$fila['con_id']);
                        
                        $consulta = $this->db->query('SELECT * FROM convocatoria_postulacion c
                                                            inner join postulante p
                                                            on p.pos_id=c.pos_id 
                                                            WHERE con_id1=' . $fila['con_id']);
//                        $consulta = $this->db->query('SELECT * FROM convocatoria_postulacion c
//                                                            inner join postulante p
//                                                            on p.pos_id=c.pos_id 
//                                                            inner join postulante_f f
//                                                            on f.pos_id=c.pos_id 
//                                                            WHERE con_id1=' . $fila['con_id']);
                        $nro = $consulta->num_rows();
                        if ($nro > 0) {
                            echo anchor($this->controlador . 'mostrar/id/' . $fila['con_id'], $nro, array('class' => 'enlace_a1'));
                        } else {
                            echo $nro;
                        }
                        ?>                
                    </td>
                    <!--td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">
                    <?php echo anchor($this->controlador . 'listar/id/' . $fila['con_id'], 'Generar', array('class' => 'enlace_a1')); ?>
                    </td-->
                    <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">
                        <?php
                        if ($fila['eti_id1'] == $this->id_etiko || $fila['eti_id2'] == $this->id_etiko || $_SESSION[$this->presession . 'permisos'] == 1) {
                            echo anchor($this->controlador . 'etapas/id/' . $fila['con_id'], 'Procesar', array('class' => 'enlace_a1'));
                        } else {
                            echo "&nbsp;";
                        }
                        ?>
                    </td>
                    <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">
                        <?php
                        if ($fila['eti_id1'] == $this->id_etiko || $fila['eti_id2'] == $this->id_etiko || $_SESSION[$this->presession . 'permisos'] == 1) {
                            echo anchor($this->controlador . 'interno/id/' . $fila['con_id'], 'Postular', array('class' => 'enlace_a1'));
                        } else {
                            echo "&nbsp;";
                        }
                        ?>
                    </td>
                    <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">
                        <?php echo $fila['con_etapa']; ?>
                    </td>
                     <td align="?php echo $alineacionw; ?>" valign="?php echo $alineacionh; ?>" >
                       <?php echo anchor($this->controlador . 'folder/' . $fila['con_id'], '<i class="fas fa-folder-open"></i> ', array('class' => 'enlace_a1','style'=>'font-size: 24px;')); ?>
                       <!-- <?php echo $this->tool_entidad->aws_url(); ?> -->
                    </td> 
                </tr>
            <?php } ?>
        </table>
    </div>
    <table width="90%" border="0" align="center" cellpadding="1" cellspacing="3">
        <tr><td><br/></td></tr>
        <tr>
            <td width="2%" align="right" bgcolor="#fe0002">&nbsp;</td>
            <td align="left">
                <b><font size="-1">Evaluación Personalizada</font></b>
            </td>
            <td align="right">            
                <div align="right">
                    <p>
                        <b>Historial de Postulaciones </b>
                        <?php
                        foreach ($this->anios as $anio) {
                            echo anchor($this->controlador . 'historial/pagina/' . $anio['anios'], $anio['anios']) . '&nbsp;';
                        }
                        ?>
                    </p>
                </div>     
            </td>
        </tr>
    </table>
</div>


