<?php
$prefijo=$this->prefijo;
$msj_confirmar='¿Está seguro que desea eliminar el elemento seleccionado?';
?>

<div id="listado">

    <div class="paginacion_lista"><?php //echo $this->pagination->create_links();?></div>

    <form action="<?php echo $this->carpeta.'procesar'?>" method="post" id="form_listar_fsimple">
        <table  align="center" class="tabla_listado"  cellspacing="0" width="100%">
            <tr class="cabecera_listado">


                <?php
               for($i=0;$i<count($this->campos_listar);$i++)
               {
                   if(!$this->tool_general->find_in_array(strtolower($this->campos_listar[$i]),$this->hiddens))
                   {
               ?>
                <td><?php echo $this->campos_listar[$i];?></td>
               <?php
                    }
               }
               ?>
                <td><input type="checkbox" name="chk_all" id="chk_all"/></td>

                <?php
                if($this->estado)
                {
                ?>
                <td>Habilitar</td>
                <?php
                }
                ?>
                <td>Editar</td>
                <td>Eliminar</td>
            </tr>

            <?php

            foreach ($datos as $fila)
            {
            ?>
                <tr>
                    <?php
                    for($i=0;$i<count($this->campos_reales);$i++)
                    {
                     //var_dump(strtolower($this->campos_listar[$i]));exit();

                     if(!$this->tool_general->find_in_array(strtolower($this->campos_reales[$i]),$this->hiddens))
                       {
                           if($this->contenido==strtolower($this->campos_reales[$i]))
                           {
                               ?>
                                <td><?php echo strip_tags(substr($fila[strtolower($this->campos_reales[$i])],0,200));?>&nbsp;</td>
                               <?php
                           }
                           else
                           {
                               if($this->estado!=strtolower($this->campos_reales[$i]))
                               {
                            ?>
                                <td><?php echo $fila[strtolower($this->campos_reales[$i])];?>&nbsp;</td>
                       <?php
                               }
                           }
                        }
                    }
                        ?>

                   <?php
                    if($fila[$this->estado])
                    {
                        $class_estado="habilitado";
                        $estado_accion='Deshabilitar';
                    }
                    else
                    {
                        $class_estado="deshabilitado";
                        $estado_accion='Habilitar';
                    }
                   ?>
                    <?php
                    if($this->estado)
                    {
                    ?>
                        <td align="center"><div class="<?php echo $class_estado;?>"></div><?php //echo $estado;?></td>
                    <?php
                    }
                    ?>

                   <td><input type="checkbox" name="<?php echo 'chk'.$fila[$prefijo.'id'];?>"/></td>


                    <?php
                    if($this->estado)
                    {
                    ?>
                    <td>
                        <?php
                        if($fila[$prefijo.'estado'])
                        {
                            echo anchor($this->carpeta.'deshabilitar/id/'.$fila[$prefijo.'id'],$estado_accion,array('class' =>'enlace_a1'));
                        }
                        else
                        {
                            echo anchor($this->carpeta.'habilitar/id/'.$fila[$prefijo.'id'],$estado_accion,array('class' =>'enlace_a1'));
                        }


                        ?>
                    </td>
                    <?php
                    }
                    ?>
                    <td><?php echo anchor($this->carpeta.'editar/id/'.$fila[$prefijo.'id'], 'Editar',array('class' =>'enlace_a1'))?></td>
                    <td><?php echo anchor($this->carpeta.'eliminar/id/'.$fila[$prefijo.'id'], 'Eliminar',array('class' =>'enlace_a1','onclick'=>"return confirmar('$msj_confirmar')"))?></td>
                </tr>
            <?php

            }
            ?>

       </table>
        <br/>
        <br/>
        <table >
           <tr>
               <td>Para los elementos marcados </td>
               <td><input type="Submit" name="eliminar" value="Eliminar" onclick="return confirmar('¿Está seguro que desea eliminar los elementos seleccionados?')"/></td>
               <?php
               if($this->estado)
               {
               ?>
               <td><input type="Submit" name="habilitar" value="Habilitar"/></td>
               <td><input type="Submit" name="deshabilitar" value="Deshabilitar"/></td>
               <?php
               }
               ?>
           </tr>
       </table>
    </form>
</div>


