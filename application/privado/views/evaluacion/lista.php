<?php $msj_confirmar='¿Está seguro que desea eliminar el elemento seleccionado? \nSe eliminará todos los procesos que hagan referencia a este elemento en la Base de Datos.'; ?>

<table align="center" width="100%">
  <tr>
    <td class="enlaces_add_edit" align="left" width="100%">
      <p></p><p></p>
     <?php
     if(count($cabecera))
     {
      ?>
      <table align="center">
        <tr>
          <td>
           <?php
           if(!@$this->notitulo)
           {
             ?>
             <?php
             if(@$cabecera['titulo_general'])
             {
              ?>
              <span class="cabecera_titulo">Reportes</span>
              <br/>
              <?php
            }
            ?>
            <?php
            if($cabecera['titulo'])
            {
              ?>
              <span class="cabecera_titulo">Grupo Evaluaci&oacute;n</span>
              <?php
            }
           
          }
          ?>

        </td>
      </tr>
      <tr><td colspan="2"><div class="linea1"></div></td></tr>
    </table>
    <?php
  }
  ?>
</td>

</tr>
</table>



<?php
$prefijo=$this->prefijo;


if(@$this->carpetaup){
  $ruta=$this->rutarchivo.$this->carpetaup;
}
else{
  $ruta=@$this->rutarchivo.$this->carpeta;
}

$alineacionw='center';
$alineacionh='middle';

?>



    
  

<div id="listado">
  <?php
  $sitio=$this->tool_entidad->sitioindexpri();
  ?>
  <div class="paginacion_lista"><?php //echo $this->pagination->create_links();?></div>

  <?php
  if(!@$this->nolistar){
    ?>
    <form action="<?php echo $sitio.$this->controlador.'procesar'?>" method="post" id="form_listar_fsimple">
      <table width="100%"><tr><td>
        <table align="center" width="100%">
          <tr>
            <td class="enlaces_add_edit" align="left" width="100%">
              <?php echo anchor($this->controlador.'agregar','Nuevo',array('class' =>'enlace_nuevo enlace_a1')); ?>&nbsp;&nbsp;

            
                                
                               
              
            </td>
          </tr>
        </table>


      </td><td align="right">
        <!-- ini combo buscar -->
        
        <!-- fin combo buscar -->
      </td>
    </tr>
  </table>
  <br>
  <input type="hidden" name="idp" value="<?php echo @$this->idp;?>" id="idp"/>
  <input type="hidden" name="tip" value="<?php print_r(@set_value($this->tip,$this->tip));?>">
  <input type="hidden" name="destacadomas" value="<?php print_r(@set_value($destacadomas,$destacadomas));?>">

  <table  align="center" class="tabla_listado"  cellspacing="0" width="100%" id="example">
    <!-- table table-bordered table-striped -->
    <tr class="cabecera_listado">
 <!-- # Evaluaciones  # Participantes Fecha Envio Configurar Envio  Editar  Eliminar -->
        <td align="center" valign="">Nro</td>
         <td align="center" valign="">Fecha Vigencia</td>
         <td align="center" valign="">Nombre Grupo</td>
         <td align="center" valign="">Cliente</td>
         
         <td align="center" valign="">Nro Evaluaciones</td>
         <td align="center" valign="">Nro Participantes</td>
         <td align="center" valign="">Estado</td>
         <td align="center" valign="">Habilitar</td>
   
         <td align="center" valign="">Editar</td>
         <td align="center" valign="">Eliminar</td>

                 
         
      
   </tr>
   <?php $j=1; ?>
   <?php $sw=0; ?>
   <?php
   foreach ($datos as $fila)
   {
    ?>

    
     <?php if ($sw==0): ?>
    <tr>
      <?php $sw=1; ?>
    <?php else: ?>
    <tr  class="fila-color-2">
     <?php $sw=0; ?>
    <?php endif ?>
    
      
        <td><?php echo $j; ?></td>
     <td align="left" valign="middle">
       <?php  print_r($fila['gru_fecha_vigencia']); ?>
     </td> 
         
      <td align="left"> <?php  print_r($fila['gru_nombre']); ?> </td>
      <td align="left" valign="middle">
       <?php  print_r($fila['cli_nombre']); ?>
     </td> 
      
     <td align="left" valign="middle">
       
       <?php echo anchor($this->controlador.'lista_evaluacion/'.$fila['gru_id'],$fila['gru_nro_eval'],array('class' =>'enlace_a1')); ?>
     </td>      
      <td align="left" valign="middle">
        <?php echo anchor($this->controlador.'lista_participantes/'.$fila['gru_id'],$fila['gru_nro_participantes'],array('class' =>'enlace_a1')); ?>
       
     </td>                

     <td align="left" valign="middle">
       
       <?php if ($fila['gru_estado']==0): ?>
         <div class="deshabilitado"></div>
       <?php else: ?>
        <div class="habilitado"></div>
       <?php endif ?>
       
     </td>  
     <td align="left" valign="middle">
       
       <?php if ($fila['gru_estado']==0): ?>         
            
                         <?php echo anchor($this->controlador.'habilitar/'.$fila['gru_id'],'Habilitar',array('class' =>'enlace_a1')); ?>
       <?php else: ?>        
         
         <?php echo anchor($this->controlador.'habilitar/'.$fila['gru_id'],'Deshabilitar',array('class' =>'enlace_a1')); ?>
       <?php endif ?>
       
     </td>  
     
     <td align="left" valign="middle">
                        <?php
                        echo anchor($this->controlador.'edicion_grupo/'.$fila[$prefijo.'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">',array('class' =>'enlace_a1'));
                        ?>
                    </td>
                     <td align="left" valign="middle">

                      <?php if ($fila['bandera']==0): ?>
                        <?php
                        echo anchor($this->controlador.'delete_grupoeval/'.$fila['gru_id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/eliminar.png" alt="eliminar">',array('class' =>'enlace_a1','onclick'=>"return confirma('$msj_confirmar')"));
                        ?>
                        
                      <?php endif ?>


                        
                    </td>
   </tr>
   <?php $j++; ?>
   <?php
 }
 ?>
</table>
<br/>
<br/>
</form>
<?php }?>
<b>Historial  </b>
            <?php foreach ($anios as $anio){?>
              <a href="listar_anio/<?php echo $anio->anio; ?>">
                <?php echo $anio->anio; ?>
              </a>
            <?php } ?>
</div>


