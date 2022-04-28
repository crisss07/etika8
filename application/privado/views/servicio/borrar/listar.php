<?php
$this->load->view('cabecera');
?>

<?php
$prefijo = $this->prefijo;
$msj_confirmar = '¿Está seguro que desea eliminar el elemento seleccionado?';
//$ruta=$this->rutabase.$this->carpetaup;
if (@$this->carpetaup) {
    $ruta = $this->rutarchivo . $this->carpetaup;
} else {
    $ruta = $this->rutarchivo . $this->carpeta;
}
//$ruta=$this->rutarchivo.$this->carpetaup;
$alineacionw = 'center';
$alineacionh = 'middle';
?>
<div id="listado">
    <br/>
    <table align="center" class="tabla_listado"  cellspacing="0" width="100%">
        <tr class="cabecera_listado">
            <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>">Cliente</td>
            <?php foreach ($this->cabecera_listado as $cabecera_listado) { ?>
                <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>"><?php echo $cabecera_listado['nombre']; ?></td>
            <?php } ?>
        </tr>
        <?php foreach ($clientes as $fila) { ?>
            <tr>
                <td align="<?php echo $alineacionw; ?>" valign="<?php echo $alineacionh; ?>"><?php echo $fila['nombre']; ?></td>
                <?php
                foreach ($this->cabecera_listado as $cabecera_listado) {
                    $servicio = 0;
                    if ($cabecera_listado['id'] == 7) {
                        $servicio = 1;
                        $consulta = $this->db->query('
                                    SELECT count(*) as nro
                                    FROM convocatoria
                                    where cli_id=' . $fila['id']);
                    } else {
                        $consulta = $this->db->query('
                                    SELECT count(*) as nro
                                    FROM especial_servicio
                                    where cli_id=' . $fila['id'] . ' and com_id =' . $cabecera_listado['id']);
                    }
                    $nro = $consulta->row_array();
                    if ($servicio) {
                        
                        echo '<td align="' . $alineacionw . '" valign="' . $alineacionh . '"><b>' . $nro['nro'] . '</b></td>';
                    } else {
                        echo '<td align="' . $alineacionw . '" valign="' . $alineacionh . '">' . anchor('especial/listar/idc/' . $fila['id'] . '/ids/' . $cabecera_listado['id'], $nro['nro'], array('class' => 'enlace_a3')) . '</td>';
                    }
                    ?>                
                <?php } ?>                
            </tr>
        <?php } ?>
    </table> <br/>
    <div align="left"><p><b>Nota.</b> Para crear un Servicio de Selección debe ir al modulo de Convocatorias.</p></div>
</div>


