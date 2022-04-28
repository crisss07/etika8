<?php
$this->load->view('cabecera');
?>

<?php
$prefijo=$this->prefijo;
$msj_confirmar='¿Está seguro que desea eliminar el elemento seleccionado? \nSe eliminará todos los procesos que hagan referencia a este elemento en la Base de Datos.';
//$ruta=$this->rutabase.$this->carpetaup;
if(@$this->carpetaup){$ruta=$this->rutarchivo.$this->carpetaup;}
else{$ruta=@$this->rutarchivo.$this->carpeta;}
//$ruta=$this->rutarchivo.$this->carpetaup;
$alineacionw='left';
$alineacionw1='center';
$alineacionh='middle';

?>


<div id="listado">
    <?php
   $this->load->view('paginacion',@$data);
   ?>
   
     <?php
if(@$filasup){
?>
     <div id="cabecera_listado">
    <table width="100%">
        <tr>
            <td>
                <span class="text3">
                <?php
                if($this->titulosup){ echo $this->titulosup;}
                else { echo "Título : ";}
                ?>
                </span>
                <span class="text2"><?php echo $filasup['titulo'];?></span>
                <br/>
                <?php echo strip_tags(substr($filasup['contenido'],0,300));?>
            </td>
            <td width="200" align="center">
                <?php
              /* if($this->idp){
                   echo anchor($this->enlacesup['ruta1'].'/idp/'.$this->idp,$this->enlacesup['nombre1'],array('class' =>'enlace_editar1 enlace_a1'));
               }
               if($this->tip){
                   echo anchor($this->enlacesup['ruta1'].'/tip/'.$this->tip,$this->enlacesup['nombre1'],array('class' =>'enlace_editar1 enlace_a1'));
               }*/
                ?>
                 <?php
               if($this->idp){
                   if($this->tip){
                       echo anchor($this->enlacesup['ruta1'].'/idp/'.$this->idp.'/tip/'.$this->tip,$this->enlacesup['nombre1'],array('class' =>'enlace_editar1 enlace_a1'));
                   }
                   else{
                       echo anchor($this->enlacesup['ruta1'].'/idp/'.$this->idp,$this->enlacesup['nombre1'],array('class' =>'enlace_editar1 enlace_a1'));
                   }
               }
               else{
                   if($this->tip){
                       echo anchor($this->enlacesup['ruta1'].'/tip/'.$this->tip,$this->enlacesup['nombre1'],array('class' =>'enlace_editar1 enlace_a1'));
                   }
                   else{
                        echo anchor($this->enlacesup['ruta1'],$this->enlacesup['nombre1'],array('class' =>'enlace_editar1 enlace_a1'));
                   }
               }
                ?>
            </td>
        </tr>
    </table>
    </div>
    <br/>

<?php
}
?>
<?php
/*
if(!$this->nolistar){
$this->load->view('opciones');}*/
$sitio=$this->tool_entidad->sitioindexpri();
?>
    <div class="paginacion_lista"><?php //echo $this->pagination->create_links();?></div>

    <?php
    if(!@$this->nolistar){
    ?>
    <form action="<?php echo $sitio.$this->controlador.'procesar'?>" method="post" id="form_listar_fsimple">
        <table width="100%"><tr><td>
                    <?php
                    if(!@$this->nolistar){
$this->load->view('opciones');
//$this->load->view('botones');

}?>
<br>
                </td><td align="right">
        <!-- ini combo buscar -->
        <?php if(@$ordencampo){ ?>
        <div align="right">
            <div id="barra_orden">
            <input type="radio" name="tiporden" value="ASC" /><span class="texto3">Ascendente</span>
            <input type="radio" name="tiporden" value="DESC" checked /><span class="texto3">Descendente</span>
            <br/>
            <select name="oporden" class="lista1">
            <option value="0" selected >Ordenar por</option>
            <?php for($i=1;$i<=count($ordencampo);$i++){?>
            <option value="<?php echo $ordencampo['campo'.$i]?>">
                <?php echo $ordenlabel['campo'.$i]?>
            </option>
            <?php }?>
        </select>
            <input type="Submit" name="ordenar" value="Ordenar"/>
            </div>
        </div>
        <?php } ?>
        <!-- fin combo buscar -->
                </td>
            </tr>
        </table>
        <input type="hidden" name="idp" value="<?php echo @$this->idp;?>" id="idp"/>
        <input type="hidden" name="tip" value="<?php print_r (set_value(@$this->tip,@$this->tip));?>">
        <input type="hidden" name="destacadomas" value="<?php print_r (set_value(@$destacadomas,@$destacadomas));?>">
        <div class="scrollh">
        <table  align="center" class="tabla_listado"  cellspacing="0" width="100%">
            <tr class="cabecera_listado">


                <?php
               for($i=0;$i<count($campos_listar);$i++)
               {
                   if(!$this->tool_general->find_in_array(strtolower($campos_listar[$i]),$hiddens))
                   {
               ?>
                    <td align="<?php echo $alineacionw1;?>" valign="<?php echo $alineacionh;?>"><?php echo $campos_listar[$i];?></td>
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

                 <?php
                if(@$estado)
                {
                ?>
                <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">Habilitar</td>
                <?php
                }
                ?>

                <?php if($this->editar){ ?><td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">Editar</td><?php }?>
                <?php if($this->eliminar){ ?><td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">Eliminar</td><?php }?>
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
                                    <img src="<?php echo $ruta.$fila[$imagen];?>" width="150" alt="Sin imagen"/>
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
                                       if(strtolower($campos_reales[$i])==$prefijo.'contacto1'){
                               ?>
                                    <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">
                                        <?php if($fila[$prefijo.'nombre1']){echo 'Nombre: '.$fila[$prefijo.'nombre1'].'<br>';} if($fila[$prefijo.'ci1']){echo 'C.I.: '.$fila[$prefijo.'ci1'].'<br>';} if($fila[$prefijo.'cargo1']){echo 'Cargo: '.$fila[$prefijo.'cargo1'].'<br>';} if($fila[$prefijo.'telefono1']){echo 'Cel.: '.$fila[$prefijo.'telefono1'].'<br>';} if($fila[$prefijo.'email1']){echo 'Email: '.$fila[$prefijo.'email1'].'<br>';} ?>
                                    </td>
                                    <?php
                                       }elseif(strtolower($campos_reales[$i])==$prefijo.'contacto2'){
                                           ?>
                                    <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>">
                                        <?php if($fila[$prefijo.'nombre2']){echo 'Nombre: '.$fila[$prefijo.'nombre2'].'<br>';} if($fila[$prefijo.'ci2']){echo 'C.I.: '.$fila[$prefijo.'ci2'].'<br>';} if($fila[$prefijo.'cargo2']){echo 'Cargo: '.$fila[$prefijo.'cargo2'].'<br>';} if($fila[$prefijo.'telefono2']){echo 'Cel.: '.$fila[$prefijo.'telefono2'].'<br>';} if($fila[$prefijo.'email2']){echo 'Email: '.$fila[$prefijo.'email2'].'<br>';} ?>
                                    </td>
                                    <?php
                                       }else{
                                           ?>
                                    <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>"><?php echo strip_tags($fila[strtolower($campos_reales[$i])]);?>&nbsp;</td>
                                           <?php
                                       }
                                ?>                                    
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

                            $consulta = $this->db->query('
                            SELECT *
                            FROM
                            '.$this->enlaces['tabla'.$i].'
                            where '.$this->enlaces['campo'.$i].'="'.$fila[$this->enlaces['camposup'.$i]].'"'
                            );
                            $nro=$consulta->num_rows();

                            if($this->tip){
                                echo anchor($this->enlaces['ruta'.$i].'/idp/'.$fila[$prefijo.'id'].'/tip/'.$this->tip,$nro,array('class' =>'enlace_a3'));                                
                            }
                            else{
                                echo anchor($this->enlaces['ruta'.$i].'/idp/'.$fila[$prefijo.'id'],$nro,array('class' =>'enlace_a3'));
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
                    <td align="<?php echo $alineacionw1;?>" valign="<?php echo $alineacionh;?>">
                        <?php
                        if(@$this->idp){
                            if($this->tip){
                                echo anchor($this->controlador.'editar/id/'.$fila[$prefijo.'id'].'/idp/'.$this->idp.'/tip/'.$this->tip, 'Editar',array('class' =>'enlace_a1'));
                            }
                            else{
                                echo anchor($this->controlador.'editar/id/'.$fila[$prefijo.'id'].'/idp/'.$this->idp, 'Editar',array('class' =>'enlace_a1'));
                            }
                        }
                        else{
                            if(@$this->tip){
                                echo anchor($this->controlador.'editar/id/'.$fila[$prefijo.'id'].'/tip/'.$this->tip, 'Editar',array('class' =>'enlace_a1'));
                            }
                            else{
                                echo anchor($this->controlador.'editar/id/'.$fila[$prefijo.'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">',array('class' =>'enlace_a1'));
                            }
                        }

                        ?>
                    </td>
                    <?php }?>
                    <?php if($this->eliminar){?>
                    <td align="<?php echo $alineacionw1;?>" valign="<?php echo $alineacionh;?>">
                        <?php
                        if(@$this->idp){
                            if($this->tip){
                                echo anchor($this->controlador.'eliminar/id/'.$fila[$prefijo.'id'].'/idp/'.$this->idp.'/tip/'.$this->tip, 'Eliminar',array('class' =>'enlace_a1','onclick'=>"return confirmar('$msj_confirmar')"));
                            }
                            else{
                                echo anchor($this->controlador.'eliminar/id/'.$fila[$prefijo.'id'].'/idp/'.$this->idp, 'Eliminar',array('class' =>'enlace_a1','onclick'=>"return confirmar('$msj_confirmar')"));
                            }
                        }
                        else{
                            if(@$this->tip){
                                echo anchor($this->controlador.'eliminar/id/'.$fila[$prefijo.'id'].'/tip/'.$this->tip, 'Eliminar',array('class' =>'enlace_a1','onclick'=>"return confirmar('$msj_confirmar')"));
                            }
                            else{
                                echo anchor($this->controlador.'eliminar/id/'.$fila[$prefijo.'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/eliminar.png" alt="eliminar">',array('class' =>'enlace_a1','onclick'=>"return confirmar('$msj_confirmar')"));
                            }
                        }

                        ?>

                    </td>
                    <?php }?>
                </tr>
            <?php

            }
            ?>

       </table>
       </div>
        <br/>
        <br/>
        
        <table>
           <tr>
                <?php
               if(@$destacadomas)
               {
               ?>
               <td>Actualizar destacados <input type="Submit" name="botondestacadomas" value="Actualizar destacados"/></td>
               <?php
               }
               ?>
               <?php
               if(@$orden&&!$ordencampo)
               {
               ?>
               <td>Actualizar orden</td>
               <td><input type="Submit" name="actualizarorden" value="Actualizar orden"/></td>
               <?php
               }
               ?>               
               <?php
               if(@$estado)
               {
               ?>
               <!--td><input type="Submit" name="habilitar" value="Habilitar"/></td>
               <td><input type="Submit" name="deshabilitar" value="Deshabilitar"/></td-->
               <?php
               }
               ?>
               <?php
               if(@$actual)
               {
               ?>
               <td><?php if(!$actualabel){?>Actualizar Principal
               <?php } else{ echo 'Actualizar  '.$actualabel;}?>

               </td>
               <td><input type="Submit" name="actualizar" value="Actualizar"/></td>
               <?php
               }
               ?>


           </tr>
       </table>
    </form>
    <?php }?>
</div>


