<div id="listado">
<br/>
<?php
$this->load->view('cabecera');
?>
<?php
$prefijo='pos_';
$sitio=$this->tool_entidad->sitioindexpri();
$alineacionw='center';
$alineacionh='middle';
?>
<table  align="center" width="100%" >
    <tr>
        <td colspan="4" align="left">
            <span class="text3"> Cliente: </span>
            <span class="text2"> <?php echo $cliente; ?> </span>
        </td>
    </tr>
</table>
<table align="center" width="100%" cellpadding="10">
    <tr>
        <td class="enlaces_add_edit" align="left" width="100%">
            <?php echo anchor($this->controlador,'Atras',array('class' =>'enlace_retornar enlace_a1')); ?>
        </td>
    </tr>
</table>
<div class="scrollh">
    <table  align="center" class="tabla_listado"  cellspacing="0" width="100%">
        <tr class="cabecera_listado">
            <?php for($i=0;$i<count($campos_listar);$i++) { ?>
            <td><?php echo $campos_listar[$i];?></td>
            <?php } ?>
            <?php if($desvincular){?>
            <td>Desvincular</td>
            <?php }?>
        </tr>
        <?php
        if($datos){
            foreach ($datos as $fila) {
            ?>
        <tr>
            <?php
                for($i=0;$i<count($campos_reales);$i++) {
            ?>
                <td><?php echo $fila[strtolower($campos_reales[$i])];?>&nbsp;</td>
            <?php
                }
            ?>
                <?php if($desvincular){?>
                <td><?php echo anchor($this->controlador.'desvincular/id/'.$fila['con_id'], 'Desvincular',array('class' =>'enlace_a1')); ?></td>
                <?php }?>
        </tr>
            <?php
            }
        }
            ?>
    </table>
    </div>
</div>


