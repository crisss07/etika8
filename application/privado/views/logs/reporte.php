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
            $mostrar.='<tr class="'.$filac.'">';
            for($i=0;$i<count($campos_reales);$i++) {
                $mostrar.='<td align="left" valign="middle">'.$fila[strtolower($campos_reales[$i])].'</td>';
            }
            $mostrar.='</tr>';
        }
    }
    $mostrar.='</table>';
}
?>

<div id="listado">
    <div style="background-color: #f0f0ee; width: 600px; border: solid 1px gray; padding:10px 20px;">
    <form method="post" action="<?php echo $sitio.$this->controlador.'excel';?>">
        <table>
            <tr>
                <td align="right">
                    Fecha inicial&nbsp;&nbsp;&nbsp;<input  type="text" name="fechaini" maxlength="10" size="10" value="<?php  echo date('Y-m-d');?>"/>
                </td>

                <td align="right">
                  &nbsp;&nbsp;&nbsp;Fecha final &nbsp;&nbsp;&nbsp;<input  type="text" name="fechafin" maxlength="10" size="10" value="<?php  echo date('Y-m-d');?>"/>
                </td>
                <td align="center">&nbsp;&nbsp;&nbsp;<input type="Submit" value="Exportar" name="generar"/></td>
            </tr>
            <?php if(@$error){ ?>
            <tr>
                <td align="center" colspan="3" >
                    <div class="error"><?php echo $error;?></div>
                </td>
            </tr>
            <?php }?>
            <tr>
                <td align="center" colspan="3">
                    <div class="aviso1">
                        <input type="checkbox" name="eliminar_logs" value="1" class="check" <?php echo set_checkbox('eliminar_logs', '1'); ?> id="eliminar_logs">
                        <span class="flecha1">&larr;</span> Marcar si desea eliminar los Logs Generados
                    </div>                    
                </td>
            </tr>
        </table>        
    </form>
    </div>
    <br/>
    <?php echo @$cabecera_listado; ?>
    <div class="scrollh">
        <?php 
        if($mostrar){
            echo $mostrar;
        }
        ?>
    </div>
</div>