<?php
$this->load->view('cabecera');
?>

<?php
$msj_confirmar='¿Está seguro que desea eliminar el elemento seleccionado?';
$ruta=$this->rutarchivo.$this->carpetaup;
?>


<div id="listado">
<?php
$sitio=$this->tool_entidad->sitioindexpri();
$prefijo='pos_';
?>
    <div align="left" ><?php  echo anchor($this->controlador.'editar/id/'.$fila_sup[$prefijo.'id'],'Atrás',array('class' =>'enlace_retornar enlace_a1')); ?></div><br/>
    <div id="cabecera_listado">
        <table cellpadding="5">
            <tr><td align="right"><b> Nombre: </b></td><td align="left"><?php echo $fila_sup[$prefijo.'apaterno'].' '.$fila_sup[$prefijo.'amaterno'].' '.$fila_sup[$prefijo.'nombre'];?></td></tr>
            <tr><td align="right"><b> Documento: </b></td><td align="left"><?php echo $fila_sup[$prefijo.'documento'];?></td></tr>
        </table>
    </div>
    <form action="<?php echo $sitio.$this->controlador.'procesar'?>" method="post" id="form_listar_fsimple">
        <input type="hidden" name="id" value="<?php echo $id;?>" id="id"/>
        <table align="center" border="0" cellspacing="8">
            <tr>
                <td align="right"><h2>Síntesis de Experiencia Laboral -></h2></td>
                <td align="left"><?php echo anchor($this->controlador.'editar_experiencia_sintesis/id/'.$fila_sup['pos_id'],'Editar',array('class' =>'enlace_a3')); ?></td>
            </tr>
        </table>
        <h2 align="center">Experiencia Laboral</h2>
        <table  align="center" class="tabla_listado"  cellspacing="0" width="900">
            <!-- ini cabeceras -->
            <tr class="cabecera_listado">
                <?php
                    for($i=0;$i<count($campos_listar_trayectoria);$i++) {
                        if(!$this->tool_general->find_in_array(strtolower($campos_listar_trayectoria[$i]),$hiddens)) {
                ?>
                <td><?php echo $campos_listar_trayectoria[$i];?></td>
                <?php } } ?>
                <td>Editar</td>
                <td>Eliminar</td>
            </tr>
            <!-- fin cabeceras -->
            <?php if($trayectorias){?>
            <?php
            $prefijo=$this->prefijo3;
            foreach ($trayectorias as $fila)
            {
            ?>
                <tr>
                    <?php
                    for($i=0;$i<count($campos_reales_trayectoria);$i++)
                    {
                        if(!$this->tool_general->find_in_array(strtolower($campos_reales_trayectoria[$i]),$hiddens)){
                            if(strtolower($campos_reales_trayectoria[$i])=='edu_grado'){
                    ?>
                    <td valign="center"><?php echo $this->grados[$fila[strtolower($campos_reales_trayectoria[$i])]]; ?></td>
                    <?php }else {
                        if(($estado!=strtolower($campos_reales_trayectoria[$i]))&&($actual!=strtolower($campos_reales_trayectoria[$i]))&&($orden!=strtolower($campos_reales_trayectoria[$i]))&&($destacadomas!=strtolower($campos_reales_trayectoria[$i]))){
                    ?>
                    <td valign="center"><?php echo strip_tags($fila[strtolower($campos_reales_trayectoria[$i])]);?>&nbsp;</td>
                    <?php }
                          }
                        }
                    } ?>
                    <td><?php echo anchor($this->controlador.'editar_trayectoria/id/'.$fila[$prefijo.'id'], 'Editar',array('class' =>'enlace_a1'));?></td>
                    <td><?php echo anchor($this->controlador.'eliminar_trayectoria/id/'.$fila[$prefijo.'id'], 'Eliminar',array('class' =>'enlace_a1','onclick'=>"return confirmar('$msj_confirmar')"));?></td>
                </tr>
            <?php }?>
            <?php }else{?>
                <tr>
                    <td colspan="11" align="center">
                        <b>No tiene ningun Experiencia Laboral</b>
                    </td>
                </tr>
            <?php }?>
                <tr>
                    <td colspan="11" align="center">
                        <?php echo anchor($this->controlador.'trayectoria_nuevo/ids/'.$fila_sup['pos_id'],'Agregar Nueva Experiencia Laboral',array('class' =>'enlace_nuevo1 enlace_a1')); ?>&nbsp;&nbsp;
                    </td>
                </tr>
        </table>                        
    </form>    
</div>


