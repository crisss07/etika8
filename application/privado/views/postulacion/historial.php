<div id="listado" style=" padding: 20px;">
<br/>
<?php
$this->load->view('cabecera');
?>
<?php
$prefijo=$this->prefijo;
$msj_confirmar='¿Está seguro que desea eliminar el elemento seleccionado?';
$sitio=$this->tool_entidad->sitioindexpri();
$alineacionw='center';
$alineacionh='middle';
?>
<?php
   $this->load->view('paginacion_anio',@$data);
   ?>
<table align="center" width="100%">
    <tr>
        <td class="enlaces_add_edit" align="left" width="100%">
            <?php echo anchor($this->controlador, 'Atrás', array('class' => 'enlace_retornar enlace_a1')); ?>
        </td>
    </tr>
</table>
<br/>
    <div class="scrollh">
    <table  align="center" class="tabla_listado"  cellspacing="0" width="100%">
        <tr class="cabecera_listado">
            <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">Fecha Final</td>
            <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">Fecha Tope <br/>de Postulación</td>
            <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">Cargo</td>
            <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">Cliente</td>
            <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">Etapa 2</td>            
            <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">Etapa 3</td>
            <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">Etapa 4</td>
            <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">Etapas<br/>Completadas</td>
        </tr>
        <?php foreach ($datos as $fila){ ?>
        <?php 
        if($fila['con_interno']){
            $style= 'style="color:#fe0002;"';
        }else{$style='';}
        ?>
        <tr <?php echo $style;?> >
            <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">
                <?php echo $fila['con_hasta']; ?>
            </td>
            <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">
                <?php echo $fila['con_tope']; ?>
            </td>
            <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">
                <?php echo $fila['con_cargo']; ?>
            </td>
            <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">
                <?php echo $fila['cli_nombre']; ?>
            </td>
            <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">
                <?php echo $fila['etapa2']; ?>
            </td>
            <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">
                <?php echo $fila['etapa3']; ?>
            </td>
            <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">
                <?php echo $fila['etapa4']; ?>
            </td>            
            <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">
                <?php echo $fila['con_etapa'];?>
            </td>
        </tr>
        <?php }?>
    </table>
    </div>
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="3">
    <tr><td><br/></td></tr>
    <tr>
        <td width="2%" align="right" bgcolor="#fe0002">&nbsp;</td>
        <td align="left">
            <b><font size="-1">Evaluación Personalizada</font></b>
        </td>        
    </tr>
</table>
</div>


