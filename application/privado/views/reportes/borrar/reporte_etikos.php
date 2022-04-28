<?php
$this->load->view('cabecera');
?>
<?php
$sitio=$this->tool_entidad->sitioindexpri();
$cabecera_listado='<div id="cabecera_listado"><table cellpadding="5">';
if($fecha_desde && $fecha_hasta)
    $cabecera_listado.='<tr><td align="left"><b> Desde: </b> '.$fecha_desde.' &nbsp; <b> Desde: </b> '.$fecha_hasta.'</td></tr>';
else
    $cabecera_listado.='<tr><td align="left"><b> Desde: </b> aaaa-mm-dd &nbsp; <b> Desde: </b> aaaa-mm-dd</td></tr>';
if($cliente)
    $cabecera_listado.='<tr><td align="left"><b> Cliente: </b> '.$this->clientes[$cliente].'</td></tr>';
else
    $cabecera_listado.='<tr><td align="left"><b> Cliente: </b> Todos los Clientes</td></tr>';
if($etiko)
    $cabecera_listado.='<tr><td align="left"><b> ETIKO: </b> '.$this->etikos[$etiko].'</td></tr>';
else
    $cabecera_listado.='<tr><td align="left"><b> ETIKO: </b> Todos los ETIKOS</td></tr>';
if($servicio) {
    $cabecera_listado.='<tr><td align="left"><b> Servicio: </b> '.$this->servicios[$servicio].'</td></tr>';
    if($sede)
        $cabecera_listado.='<tr><td align="left"><b> Sede: </b> '.$this->sedes[$sede].'</td></tr>';
    elseif($servicio==7)
        $cabecera_listado.='<tr><td align="left"><b> Sede: </b> Todas las Sedes</td></tr>';
}
else
    $cabecera_listado.='<tr><td align="left"><b> Servicio: </b> Todos los Servicios</td></tr>';
if($facturacion)
    $cabecera_listado.='<tr><td align="left"><b> Tipo Facturación: </b> '.$this->facturaciones[$facturacion].'</td></tr>';
else
    $cabecera_listado.='<tr><td align="left"><b> Tipo Facturación: </b> Todas las Facturaciones</td></tr>';
$cabecera_listado.='</table></div><br/>';

if($datos){
    $mostrar='<table width="100%" align="center" cellpadding="8">';
    foreach ($datos as $ser=>$filas) {
        $sum_total_serv=0;
        $sum_total_etiko=0;
        $mostrar.='<tr><td align="left"><font size="+1">Servicio: <b>'.$this->servicios[$ser].'</b></font></td></tr>';
        $mostrar.='<tr><td align="left">';
        $mostrar.='<table  align="left" class="tabla_listado" border="1" cellspacing="0" ><tr class="cabecera_listado">';
        $cabecera_listado1='';
        switch ($ser) {
            case 7:
                if(!$cliente)
                    $cabecera_listado1='<th align="center" valign="middle">Cliente</th>';
                $cabecera_listado1.='<th align="center" valign="middle">Cargo</th>';
                $cabecera_listado1.='<th align="center" valign="middle">Monto (Bs)</th>';
                if(!$etiko)
                    $cabecera_listado1.='<th align="center" valign="middle">ETIKO (% Bs)</th>';
                else
                    $cabecera_listado1.='<th align="center" valign="middle"> % Bs </th>';
                if(!$facturacion)
                    $cabecera_listado1.='<th align="center" valign="middle">Tipo Facturación</th>';
                $cabecera_listado1.='<th align="center" valign="middle">Fechas</th>';
                $cabecera_listado1.='<th align="center" valign="middle">Sede</th>';
                break;
            default:
                if(!$cliente)
                    $cabecera_listado1='<th align="center" valign="middle">Cliente</th>';
                $cabecera_listado1.='<th align="center" valign="middle">Servicio Especial</th>';
                $cabecera_listado1.='<th align="center" valign="middle">Monto (Bs)</th>';
                if(!$etiko)
                    $cabecera_listado1.='<th align="center" valign="middle">ETIKO</th>';
                if(!$facturacion)
                    $cabecera_listado1.='<th align="center" valign="middle">Tipo Facturación</th>';
                $cabecera_listado1.='<th align="center" valign="middle">Fechas</th>';
                break;
        }
        $mostrar.=$cabecera_listado1;
        $mostrar.='</tr>';        
        foreach ($filas as $cli=>$fila){
            $rowspan=count($fila);
            if(!$cliente)
                $aux_cli=1;
            $contenido='<tr>';
            $sum_total=0;
            $sum_total_eti=0;
            foreach ($fila as $row){
                if($aux_cli){
                    $contenido.='<td align="center" rowspan="'.$rowspan.'" valign="top">'.$this->clientes[$cli].'</td>';
                    $aux_cli=0;
                }
                switch ($ser) {
                    case 7:
                        $contenido.='<td align="center" valign="top">'.$row['cargo'].'</td>';
                        $contenido.='<td align="center" valign="top">'.$row['monto'].'</td>';
                        $contenido.='<td align="right" valign="top">';
                        if($row['eti1'] && !$etiko) {
                            if($row['porciento1']) {
                                $contenido.='- '.$this->etikos[$row['eti1']].' ('.(($row['monto']*$row['porciento1'])/100).') <br/>';
                            }else {
                                $contenido.='- '.$this->etikos[$row['eti1']].' (0) <br/>';
                            }
                        }elseif($row['eti1'] == $etiko){
                            if($row['porciento1']) {
                                $contenido.=(($row['monto']*$row['porciento1'])/100);
                                $sum_total_eti+=(($row['monto']*$row['porciento1'])/100);
                            }
                        }
                        if($row['eti2'] && !$etiko) {
                            if($row['porciento2']) {
                                $contenido.='- '.$this->etikos[$row['eti2']].' ('.(($row['monto']*$row['porciento2'])/100).')';
                            }else {
                                $contenido.='- '.$this->etikos[$row['eti2']].' (0)';
                            }
                        }elseif($row['eti2'] == $etiko){
                            if($row['porciento2']) {
                                $contenido.=(($row['monto']*$row['porciento2'])/100);
                                $sum_total_eti+=(($row['monto']*$row['porciento2'])/100);
                            }
                        }
                        $contenido.='</td>';
                        if(!$facturacion)
                            $contenido.='<td align="center" valign="top"> '.$this->facturaciones[$row['facturacion']].' </td>';
                        $contenido.='<td align="center" valign="top"> Desde: '.$row['desde'].'<br/> Hasta: '.$row['hasta'].'</td>';
                        $contenido.='<td align="center" valign="top">'.$row['sede'].'</td>';
                        break;
                    default:
                        $contenido.='<td align="center" valign="top">'.$row['cargo'].'</td>';
                        $contenido.='<td align="center" valign="top">'.$row['monto'].'</td>';
                        if(!$etiko)
                            $contenido.='<td align="center" valign="top">'.$this->etikos[$row['eti']].'</td>';
                        if(!$facturacion)
                            $contenido.='<td align="center" valign="top"> '.$this->facturaciones[$row['facturacion']].' </td>';
                        $contenido.='<td align="center" valign="top"> Desde: '.$row['desde'].'<br/> Hasta: '.$row['hasta'].'</td>';
                        break;
                }
                $contenido.='</tr>';
                $sum_total+=$row['monto'];
            }
            $contenido.='<tr><td align="center" colspan="2"><b>Total</b></td><td align="center"><b>'.$sum_total.'</b></td>';
            if($etiko && $ser==7)
                $contenido.='<td align="center"><b>'.$sum_total_eti.'</b></td>';
            $contenido.='</tr>';
            $mostrar.=$contenido;
            $sum_total_serv+=$sum_total;
            $sum_total_etiko+=$sum_total_eti;
        }
        $mostrar.='</table>';
        $mostrar.='</td></tr>';
        if($etiko && $ser==7){
            $mostrar.='<tr><td align="left"><font size="+1">Total ETIKO: <b>'.$sum_total_etiko.'</b></font></td></tr>';
        }
        $mostrar.='<tr><td align="left"><font size="+1">Total del Servicio: <b>'.$sum_total_serv.'</b></font></td></tr>';
    }
    $mostrar.='</table>';
}
?>
<form action="<?php echo $sitio.$this->controlador.'excel_contenido';?>" method="post" id="form_listar_fsimple">
    <input type="hidden" name="cabecera_listado" value="<?php echo base64_encode(serialize($cabecera_listado));?>"/>
    <input type="hidden" name="contenido" value="<?php echo base64_encode(serialize($mostrar));?>"/>
    <input type="hidden" name="titulo" value="<?php echo $titulo;?>"/>    
    <table align="center" width="100%" border="0">
        <tr>
            <td class="enlaces_add_edit" align="left" width="8%" >
                <?php                
                    echo anchor($this->controlador.'etiko','Cancelar',array('class' =>'enlace_cancelar enlace_a1'));
                ?>
            </td>
            <td class="enlaces_add_edit" align="left">
                <input name="enviar" src="<?php echo $this->tool_entidad->sitio().'files/img/excel_exportar.jpg';?>" type="image" value="  Guardar  ">
            </td>
        </tr>
    </table>
</form>

<div id="listado"><br/>
    <?php echo $cabecera_listado; ?>
    <br/>
    <div class="scrollh">        
        <?php 
        if($mostrar){
            echo $mostrar;
        }
        ?>
    </div>
</div>