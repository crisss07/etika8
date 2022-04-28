<?php
$this->load->view('cabecera');
?>
<?php
$sitio=$this->tool_entidad->sitioindexpri();
if($campos_listar) {
    $mostrar='<table  align="center" class="tabla_listado" cellspacing="0" >';
    $mostrar.='<tr class="cabecera_listado">';
    for($i=0;$i<count($campos_listar);$i++) {
        $mostrar.='<td align="center" valign="middle">'.$campos_listar[$i].'</td>';
    }
    $mostrar.='</tr>';
    if($datos) {
        foreach ($datos as $fila) {
            $mostrar.='<tr>';
            for($i=0;$i<count($campos_reales);$i++) {
                $mostrar.='<td align="center" valign="top">'.$fila[strtolower($campos_reales[$i])].'&nbsp;</td>';
            }
            $mostrar.='</tr>';
        }
    }
    $mostrar.='</table>';
}
?>
<form action="<?php echo $sitio.$this->controlador.'excel';?>" method="post" id="form_listar_fsimple">
    <input type="hidden" name="id" value="<?php echo $id;?>"/>
    <input type="hidden" name="campos_listar" value="<?php echo base64_encode(serialize($campos_listar));?>"/>
    <input type="hidden" name="campos_reales" value="<?php echo base64_encode(serialize($campos_reales));?>"/>
    <input type="hidden" name="datos" value="<?php echo base64_encode(serialize($datos));?>"/>
    <table align="center" width="100%" border="0">
        <tr>
            <td class="enlaces_add_edit" align="left" width="8%" >
                <?php  echo anchor($this->controlador.'etapas/id/'.$id,'Cancelar',array('class' =>'enlace_cancelar enlace_a1')); ?>
            </td>
            <td class="enlaces_add_edit" align="left">
                <input name="enviar" src="<?php echo $this->tool_entidad->sitio().'files/img/excel_exportar.jpg';?>" type="image" value="  Guardar  ">
            </td>
        </tr>
    </table>
</form>
<?php

$alineacionwc1='left';
$alineacionhc1='middle';
$alineacionwc2='left';
$alineacionhc2='middle';
$prefijo = $this->prefijo;
?>

<div id="listado"><br/>        
        <?php 
        if($mostrar){
            echo $mostrar;
        }
        ?>                           
</div>