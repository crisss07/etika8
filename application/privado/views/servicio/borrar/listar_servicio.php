<?php
$this->load->view('cabecera');
?>
<div id="cabecera_listado">
    <table width="100%">
        <tr>
            <td>
                <span class="text3">
                <?php  if(!$this->superior['titulonom']){ echo "Titulo :";} else{ echo $this->superior['titulonom'];}?>
                </span>
                <span class="text2"><?php echo $this->superior['titulop'];?></span>
                <?php if($this->superior['titulop1']){ ?>
                <br/><br/>
                <span class="text3">
                <?php  if(!$this->superior['titulonom1']){ echo "Titulo :";} else{ echo $this->superior['titulonom1'];}?>
                </span>
                <span class="text2"><?php echo $this->superior['titulop1'];?></span>
                <?php } ?>
            </td>
        </tr>
    </table>
</div>
<?php
$prefijo=$this->prefijo;
$msj_confirmar='¿Está seguro que desea eliminar el elemento seleccionado?';
//$ruta=$this->rutabase.$this->carpetaup;
if(@$this->carpetaup){$ruta=$this->rutarchivo.$this->carpetaup;}
else{$ruta=$this->rutarchivo.$this->carpeta;}
//$ruta=$this->rutarchivo.$this->carpetaup;
$alineacionw='center';
$alineacionh='middle';

?>
<div id="listado">    
<?php
/*
if(!$this->nolistar){
$this->load->view('opciones');}*/
$sitio=$this->tool_entidad->sitioindexpri();
?>
<br>
    <form action="<?php echo $sitio.$this->controlador.'listar'?>" method="post" id="form_listar_fsimple">
    <table width="100%">
        <tr>
            <td>
                <table align="center" width="100%">
                  <tr>
                      <td class="enlaces_add_edit" align="left" width="100%">
                          <?php echo anchor($this->ruta_retorno,$this->msj_retorno,array('class' =>'enlace_retornar enlace_a1'));?>&nbsp;&nbsp;
                          <?php if($this->nuevo){?><?php echo anchor($this->controlador.'agregar/idc/'.$this->idc.'/ids/'.$this->ids,'Nuevo',array('class' =>'enlace_nuevo enlace_a1')); ?>&nbsp;&nbsp;<?php }?>
                          <?php echo anchor($this->controlador.'listar/idc/'.$this->idc.'/ids/'.$this->ids,'Listado',array('class' =>'enlace_listar enlace_a1')); ?>&nbsp;&nbsp;
                          <?php  echo anchor($this->controlador.'listar/idc/'.$this->idc.'/ids/'.$this->ids,'Cancelar',array('class' =>'enlace_cancelar enlace_a1')); ?>
                      </td>
                  </tr>
                </table>
            </td>
            </tr>
        </table>
    </form>
    <br>
    <form action="<?php echo $sitio.$this->controlador.'procesar'?>" method="post" id="form_listar_fsimple">
        <input type="hidden" name="idp" value="<?php echo @$this->idp;?>" id="idp"/>
        <input type="hidden" name="tip" value="<?php print_r (@set_value($this->tip,$this->tip));?>">
        <input type="hidden" name="destacadomas" value="<?php print_r (set_value(@$destacadomas,@$destacadomas));?>">

        <table  align="center" class="tabla_listado"  cellspacing="0" width="100%">
            <tr class="cabecera_listado">


                <?php
               for($i=0;$i<count($campos_listar);$i++)
               {
                   if(!$this->tool_general->find_in_array(strtolower($campos_listar[$i]),$hiddens))
                   {
               ?>
                    <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>"><?php echo $campos_listar[$i];?></td>
               <?php
                    }
               }
               ?>
               <?php
               // ini enlaces label
               if(@$this->enlaces){                   
                   for($i=1;$i<=count($this->enlaces)/$this->nroenlaces;$i++){
                   ?>
                   <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>"><?php echo $this->enlaces['nombre'.$i] ?></td>
                <?php
                     }
                   }
                //fin enlaces label
                ?>                
                <?php if($this->editar){ ?><td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">Editar</td><?php }?>
                <?php if($this->eliminar){ ?><td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">Eliminar</td><?php }?>
            </tr>

           <?php

            foreach ($datos as $fila)
            {
            ?>
                <tr>

                     <?php
                   if(@$orden)
                   {
                    ?>
                    <td align="center"> <input type='text' name='<?php echo 'orden'.$fila[$prefijo.'id'];?>' value='<?php echo $fila[$orden];?>' size="1" class="input2"></td>
                    <?php
                    }
                    ?>
                    <?php
                    for($i=0;$i<count($campos_reales);$i++)
                    {
                    ?>
                        <?php
                     if(!$this->tool_general->find_in_array(strtolower($campos_reales[$i]),$hiddens))
                       {
                         if((@$imagen==strtolower($campos_reales[$i]))||(@$adjunto==strtolower($campos_reales[$i])))
                           {
                             if($imagen==strtolower($campos_reales[$i]))
                             {
                               ?>
                                <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">
                                    <img src="<?php echo $ruta.$fila[$imagen];?>" width="150" height="150" alt="Sin imagen"/>
                                </td>
                               <?php
                             }
                             else
                             {

                                 $tipofile=$this->tool_general->tipofig_extension(strtolower(substr($fila[$adjunto],-4)));
                              ?>
                                <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">
                                    <img src="<?php echo $this->rutaimg.$tipofile.'.gif';?>" alt="Sin archivo"/>
                                    <?php echo "<b>".$fila[$adjunto]."</b>"; ?>

                                </td>
                               <?php


                             }
                           }
                           else
                           {
                               if(@$contenido==strtolower($campos_reales[$i]))
                               {
                                   ?>
                                    <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>"><?php echo strip_tags(substr($fila[strtolower($campos_reales[$i])],0,200));?>&nbsp;</td>
                                   <?php
                               }
                               else
                               {
                                   if((@$estado!=strtolower($campos_reales[$i]))&&(@$actual!=strtolower($campos_reales[$i]))&&(@$orden!=strtolower($campos_reales[$i]))&&(@$destacadomas!=strtolower($campos_reales[$i])))
                                   {
                                ?>
                                    <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>"><?php echo strip_tags($fila[strtolower($campos_reales[$i])]);?>&nbsp;</td>
                           <?php
                                   }

                               }
                           }
                        }
                    }
                        ?>

                     <!-- actual  -->
                    <?php
                   if(@$actual)
                   {

                        if($fila[$actual]=='1')
			{
                            $si=$fila[$this->prefijo.'id'];
                            ?>
			    <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">
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
			    <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">
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

                    <!-- destacado mas  -->
                    <?php

                   if(@$destacadomas)
                   {

                        if($fila[$destacadomas]=='1')
			{
                            $si=$fila[$this->prefijo.'id'];
                            ?>
			    <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">
                                <div align='center'>
                                    <input type="checkbox" name="<?php echo 'chkd'.$fila[$prefijo.'id'];?>" <?php echo set_checkbox('chkd'.$fila[$prefijo.'id'],'1',TRUE); ?>/>

                                </div>
                            </td>
                            <?php
			}
			else
			{
                            $no=$fila[$this->prefijo.'id'];
                            ?>
			    <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">
                                <div align='center'>
                                    <input type="checkbox" name="<?php echo 'chkd'.$fila[$prefijo.'id'];?>" <?php echo set_checkbox('chkd'.$fila[$prefijo.'id'],'1'); ?>/>

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

                    if(@$fila[$estado])
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
                    if(@$estado)
                    {
                    ?>
                        <td align="center"><div class="<?php echo $class_estado;?>"></div></td>
                    <?php
                    }
                    ?>

                    <?php
                    //ini enlaces
               if(@$this->enlaces){
                   for($i=1;$i<=count($this->enlaces)/$this->nroenlaces;$i++){
                   ?>
                        <td align="center" valign="<?php echo $alineacionh;?>">
                         <?php
                         $servicio='';
                            switch ($fila['tipo_servicio']){
                                case 1:
                                    $serv_enlace='capacitacion/listar';
                                    $consulta = $this->db->query('
                                    SELECT *
                                    FROM
                                    '.$this->enlaces['tabla'.$i].'
                                    where '.$this->enlaces['campo'.$i].'="'.$fila[$this->enlaces['camposup'.$i]].'"'
                                    );
                                    break;
                                case 2:
                                    //$serv_enlace='convocatoria/listar';
                                    $servicio=1;
                                    $consulta = $this->db->query('
                                    SELECT *
                                    FROM convocatoria
                                    where '.$this->enlaces['campo'.$i].'="'.$fila[$this->enlaces['camposup'.$i]].'"'
                                    );
                                    break;
                                case 3:
                                    $serv_enlace='especial/listar';
                                    $consulta = $this->db->query('
                                    SELECT *
                                    FROM
                                    '.$this->enlaces['tabla'.$i].'
                                    where '.$this->enlaces['campo'.$i].'="'.$fila[$this->enlaces['camposup'.$i]].'"'
                                    );
                                    break;
                                case 4:
                                    $serv_enlace='especial/listar';
                                    $consulta = $this->db->query('
                                    SELECT *
                                    FROM
                                    '.$this->enlaces['tabla'.$i].'
                                    where '.$this->enlaces['campo'.$i].'="'.$fila[$this->enlaces['camposup'.$i]].'"'
                                    );
                                    break;
                            }
                            $nro=$consulta->num_rows();
                            if($servicio){
                                echo '<b>'.$nro.'</b>';
                            }else{
                                echo anchor($serv_enlace.'/idp/'.$fila[$prefijo.'id'],$nro,array('class' =>'enlace_a3'));
                            }
                        ?>

                    </td>
                <?php
                     }
                   }

                   //fin enlaces
                ?>                   


                    <?php
                    if(@$estado)
                    {
                    ?>
                    <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">
                        <?php
                        if($fila[$estado])
                        {
                            echo anchor($this->controlador.'deshabilitar/id/'.$fila[$prefijo.'id'],$estado_accion,array('class' =>'enlace_a1'));
                        }
                        else
                        {
                            echo anchor($this->controlador.'habilitar/id/'.$fila[$prefijo.'id'],$estado_accion,array('class' =>'enlace_a1'));
                        }


                        ?>
                    </td>
                    <?php
                    }
                    ?>
                    <?php if($this->editar){?>
                    <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">
                        <?php
                        echo anchor($this->controlador.'editar/id/'.$fila[$prefijo.'id'].'/idc/'.$this->idc.'/ids/'.$this->ids, 'Editar',array('class' =>'enlace_a1'));
                        ?>
                    </td>
                    <?php }?>
                    <?php if($this->eliminar){?>
                    <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">
                        <?php
                        echo anchor($this->controlador.'eliminar/id/'.$fila[$prefijo.'id'].'/idc/'.$this->idc.'/ids/'.$this->ids, 'Eliminar',array('class' =>'enlace_a1','onclick'=>"return confirmar('$msj_confirmar')"));
                        ?>
                    </td>
                    <?php }?>
                </tr>
            <?php

            }
            ?>

       </table>                        
    </form>    
</div>


