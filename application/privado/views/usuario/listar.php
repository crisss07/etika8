<?php
$this->load->view('cabecera');
?>
<?php
//$this->load->view('opciones');
?>
<?php
$prefijo=$this->prefijo;
$msj_confirmar='¿Está seguro que desea eliminar el elemento seleccionado?\nSe eliminará todos los procesos que hagan referencia a este elemento en la \nBase de Datos (Si no desea eliminar los procesos solo deshabilite el usuario)';


$msj_quitar_qr='¿Está seguro que desea borrar el qr del usuario seleccionado ?';



$alineacionw1='center';
?>


 <?php
  if(!isset($this->no_mostrar_enlaces))
  {
  ?>
<table align="center" width="100%">
      <tr>
          <td class="enlaces_add_edit" align="left" width="100%">
              <?php echo anchor($this->carpeta.'agregar','Nuevo',array('class' =>'enlace_nuevo enlace_a1','title' =>'Agregar nuevo')); ?>&nbsp;&nbsp;
              <?php echo anchor($this->carpeta,'Listado',array('class' =>'enlace_listar enlace_a1','title' =>'Ver listado')); ?>
              &nbsp;&nbsp;
              <?php echo anchor($this->carpeta,'Cancelar',array('class' =>'enlace_cancelar enlace_a1','title' =>'Cancelar accion')); ?>
              <br/><br/>
          </td>

      </tr>
  </table>
  <?php
  }
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
                    <td align="<?php echo $alineacionw1;?>" ><?php echo $this->campos_listar[$i];?></td>
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

                <td>Cambiar contraseña</td>
                <td>Borrar Codigo Qr</td>
                <td align="center">Editar</td>
                <td align="center">Eliminar</td>
            </tr>

			<?php
			$fila_color = array('fila-color-1','fila-color-2');
			$color=0;
            foreach ($datos as $fila)
            {
            if($color==0)
				{ ?>
				<tr class="<?php echo $fila_color[$color]; $color=1; ?>">
				<?php }
				else{ ?>
				<tr class="<?php echo $fila_color[$color]; $color=0; ?>">
				<?php }
				?>

                     <?php
                   if(isset($this->orden))
                   {
                    ?>
                    <td align="center"> <input type='text' name='<?php echo 'orden'.$fila[$prefijo.'id'];?>' value='<?php echo $fila[$this->orden];?>' size="1" class="input2"></td>
                    <?php
                    }
                    ?>
                    <?php
                    for($i=0;$i<count($this->campos_reales);$i++)
                    {
                    ?>
                        <?php
                     if(!$this->tool_general->find_in_array(strtolower($this->campos_reales[$i]),$this->hiddens))
                       {
                         if(@$this->imagen==strtolower($this->campos_reales[$i]))
                           {
                               ?>
                                <td>                                    
                                    <img src="<?php echo base_url()."archivos/".$this->carpeta.$fila[$this->imagen];?>" width="100" alt="Sin imagen"/>
                                </td>
                               <?php
                           }
                           else
                           {
                               if(@$this->contenido==strtolower($this->campos_reales[$i]))
                               {
                                   ?>
                                    <td><?php echo strip_tags(substr($fila[strtolower($this->campos_reales[$i])],0,200));?>&nbsp;</td>
                                   <?php
                               }
                               else
                               {
                                   if(($this->estado!=strtolower($this->campos_reales[$i]))&&(@$this->actual!=strtolower($this->campos_reales[$i]))&&(@$this->orden!=strtolower($this->campos_reales[$i])))
                                   {
                                ?>
                                    <td><?php echo $fila[strtolower($this->campos_reales[$i])];?>&nbsp;</td>
                           <?php
                                   }

                               }
                           }
                        }
                    }
                        ?>

                     <!-- actual  -->
                    <?php
                   if(isset($this->actual))
                   {

                        if($fila[$this->actual]=='1')
			{
                            $si=$fila[$this->prefijo.'id'];
                            ?>
			    <td>
                                <div align='center'>
                                    <input type='radio' name='bandera' value='<?php echo $si;?>' checked>
                                </div>
                            </td>
                            <?php
			}
			else
			{
                            $no=$fila[$this->prefijo.'id'];
                            ?>
			    <td>
                                <div align='center'>
                                    <input type='radio' name='bandera' value='<?php echo $no;?>'>
                                </div>
                            </td>
                            <?php
			}
                   ?>

                   <?php
                   }
                   ?>
                   <!-- estado  -->
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
                        <td align="center"><div class="<?php echo $class_estado;?>"></div></td>
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
                        if($fila[$this->estado])
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

                    <td align="<?php echo $alineacionw1;?>"><?php echo anchor($this->carpeta.'cambiarpass/id/'.$fila[$prefijo.'id'], 'Cambiar contraseña',array('class' =>'enlace_a1'))?></td>
                    <td align="<?php echo $alineacionw1;?>">
                        <!-- ?php echo $fila['google_auth_code']; ?> -->
                        <?php echo anchor($this->carpeta.'borrar_qr/'.$fila[$prefijo.'id'], 'Quitar QR',array('class' =>'enlace_a1','onclick'=>"return confirmar('$msj_quitar_qr')"))?>
                            
                        </td>
                    <td align="center"><?php echo anchor($this->carpeta.'editar/id/'.$fila[$prefijo.'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">',array('class' =>'enlace_a1'))?></td>

                    <td align="center"><?php echo anchor($this->carpeta.'eliminar/id/'.$fila[$prefijo.'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/eliminar.png" alt="eliminar">',array('class' =>'enlace_a1','onclick'=>"return confirmar('$msj_confirmar')"))?></td>
                </tr>
            <?php

            }
            ?>

       </table>
        <br/>
        <br/>
        <table >
           <tr>
               <?php
               if(isset($this->orden))
               {
               ?>
               <td>Actualizar orden</td>
               <td><input type="Submit" name="actualizarorden" value="Actualizar orden"/></td>
               <?php
               }
               ?>
               <td>Para los elementos marcados </td>
               <td><input type="Submit" name="eliminar" value="Eliminar" onclick="return confirmar('¿Está seguro que desea eliminar los elementos seleccionados?')"/></td>
               <?php
              /* if($this->estado)
               {
               ?>
               <td><input type="Submit" name="habilitar" value="Habilitar"/></td>
               <td><input type="Submit" name="deshabilitar" value="Deshabilitar"/></td>
               <?php
               }*/
               ?>
               <?php
               if(isset($this->actual))
               {
               ?>
               <td>Actualizar vigente</td>
               <td><input type="Submit" name="actualizar" value="Actualizar"/></td>
               <?php
               }
               ?>

           </tr>
       </table>
    </form>
</div>


