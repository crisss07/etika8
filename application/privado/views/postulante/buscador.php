
<?php
$sitio=$this->tool_entidad->sitioindexpri();
$buscar_campo[0]='Elija Criterio';
$buscar_campo[1]='Todo';
$buscar_campo[2]='Documento';
$buscar_campo[3]='Apellido Paterno';
$buscar_campo[4]='Apellido Materno';
$buscar_campo[5]='Nombres';
$buscar_campo[6]='Cliente';
$buscar_campo[7]='Instancia';
$buscar_campo[8]='Recomendable';
$alineacionw='center';
$alineacionh='middle';
?>
<form method="post" action="<?php echo $sitio.$this->controlador.'listar';?>">
    <table align="center">
        <tr>
            <td align="right">
                Seleccionar criterio de búsqueda
                <select name="campob">
                    <?php for($i=0;$i<count($buscar_campo);$i++) {?>
                    <option value="<?php echo $i?>" <?php if($criterio==$i){ echo 'selected'; }?> ><?php echo '&nbsp;'.$buscar_campo[$i].'&nbsp;&nbsp;&nbsp;';?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right">
                Introducir texto para buscar
                <input name="cadena" id="cadena" size="20" class="input1" value="<?php echo $cadena?>"/>                
            </td>
            <td>
                <input type="submit" name="buscar" value="Buscar"/>
            </td>
        </tr>
    </table>
</form>



