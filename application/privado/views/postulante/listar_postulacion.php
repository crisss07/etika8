<?php
$this->load->view('cabecera');
?>

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
    <form action="<?php echo $sitio.$this->controlador.'postulaciones/idp/'.$this->idp.'/campob/'.$criterio;?>" method="post" id="form_listar_fsimple">
        <input type="hidden" name="cadena" value="<?php echo $cadena;?>" id="cadena"/>
        <input type="hidden" name="campob" value="<?php echo $criterio;?>" id="campob"/>
        <input type="hidden" name="cliente" value="<?php echo $cliente;?>" id="cliente"/>
        <input type="hidden" name="cargo" value="<?php echo $cargo;?>" id="cargo"/>
        <input type="hidden" name="instancia" value="<?php echo $instancia;?>" id="instancia"/>
        <input type="hidden" name="recomendacion" value="<?php echo $recomendacion;?>" id="recomendacion"/>
    <table width="100%">
        <tr>
            <td>
                <table align="center" width="100%">
                    <tr>
                        <td class="enlaces_add_edit" align="left" width="100%">
                            <?php
                            $enlace='/campob/'.$criterio;
                            if($cadena)
                                $enlace.='/cadena/' . $cadena;
                            if ($cliente)
                                $enlace.='/cliente/' . $cliente;
                            if ($cargo)
                                $enlace.='/cargo/' . $cargo;
                            if ($instancia)
                                $enlace.='/instancia/' . $instancia;
                            if ($recomendacion)
                                $enlace.='/recomendacion/' . $recomendacion;
                            echo anchor($this->ruta_retorno.$enlace,$this->msj_retorno,array('class' =>'enlace_retornar enlace_a1'));                            
                            ?>
                        </td>
                    </tr>
                </table>                
            </td><td align="right">        
        <div align="right">
            <div id="barra_orden">
            <input type="radio" name="tiporden" value="ASC" checked /><span class="texto3">Ascendente</span>
            <input type="radio" name="tiporden" value="DESC"  /><span class="texto3">Descendente</span>
            <br/>
            <select name="oporden" class="lista1">
            <option value="0" selected >Ordenar por</option>
            <?php for($i=1;$i<=count($ordencampo);$i++){?>
            <option value="<?php echo $i;?>">
                <?php echo $ordencampo[$i]?>
            </option>
            <?php }?>
        </select>
            <input type="Submit" name="ordenar" value="Ordenar"/>
            </div>
        </div>        
        <!-- fin combo buscar -->
                </td>
            </tr>
        </table>
    </form>
    
    <form action="<?php echo $sitio.$this->controlador.'procesar'?>" method="post" id="form_listar_fsimple">
        <input type="hidden" name="idp" value="<?php echo $this->idp;?>" id="idp"/>
        <input type="hidden" name="tip" value="<?php print_r (@set_value($this->tip,$this->tip));?>">
        <input type="hidden" name="destacadomas" value="<?php print_r (@set_value($destacadomas,$destacadomas));?>">

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
                                    <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>"><?php echo $fila[strtolower($campos_reales[$i])];?>&nbsp;</td>
                           <?php
                                   }

                               }
                           }
                        }
                    }
                        ?>                                                        
                </tr>
            <?php

            }
            ?>

       </table>                        
    </form>    
</div>


