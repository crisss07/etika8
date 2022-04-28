<?php $msj_confirmar='¿Está seguro que desea eliminar del grupo el elemento seleccionado?'; ?>

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
              <span class="cabecera_titulo">Participantes</span>
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
              <?php echo anchor($this->controlador.'lista_evaluacion/'.$id_grupo,'Listado',array('class' =>'enlace_listar enlace_a1')); ?>
              &nbsp;&nbsp;
              <?php echo anchor($this->controlador.'adicionar_participantes/'.$id_grupo,'Adicionar Participantes',array('class' =>'enlace_nuevo enlace_a1')); ?>&nbsp;&nbsp;
                                
                                &nbsp;&nbsp;
              
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

<input type="hidden" name="grupo_id" id="grupo_id" value="<?php echo $id_grupo; ?>">
  <table  align="center" class="tabla_listado"  cellspacing="0" width="100%" id="example">
    <!-- table table-bordered table-striped -->
    <tr class="cabecera_listado">
 <!-- # Evaluaciones  # Participantes Fecha Envio Configurar Envio  Editar  Eliminar -->
         <td align="center" valign="">Nro</td>
         <td align="center" valign="">Ap Paterno</td>
         <td align="center" valign="">Ap Materno</td>
         <td align="center" valign="">Nombre</td>
         <td align="center" valign="">Documento</td>       
         <td align="center" valign="">Celular</td> 
         <td align="center" valign="">Correo</td> 
         <td align="center" valign="">Eliminar</td>

      

                 
         
      
   </tr>
   <?php $j=0; ?>
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
      
        
     
     <td align="left"><?php echo $j+1; ?> </td>
     <td align="left"><?php echo $fila->pos_apaterno; ?></td>
     <td align="left"><?php echo $fila->pos_amaterno; ?></td>     
     <td align="left">
        <?php echo $fila->pos_nombre; ?> 
        

     </td>
     <td align="left"><?php echo $fila->pos_documento; ?> </td>
     <td align="left"><?php echo $fila->pos_celular; ?></td>
     <td align="left"><?php echo $fila->pos_email; ?></td>
     <td align="left">

      <?php if ($fila->bandera==0): ?>
      <?php
                        echo anchor($this->controlador.'delete_pos_id_sin_seg/'.$fila->par_id.'/'.$fila->pos_id.'/'.$fila->gru_id, '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/eliminar.png" alt="eliminar">',array('class' =>'enlace_a1','onclick'=>"return confirma('$msj_confirmar')"));
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
<?php if ($estado_grupo==0): ?>
   <?php echo anchor($this->controlador.'habilitar/'.$id_grupo, 'Habilitar Grupo', array('class' => 'btn-etika btn')); ?>
 <?php else: ?>
   <?php echo anchor($this->controlador.'habilitar/'.$id_grupo, 'Deshabilitar Grupo', array('class' => 'btn-etika btn')); ?>
<?php endif ?>
 

</form>
<?php }?>
</div>
 

<script>
  
function confirma(mensaje) {
    return confirm(mensaje);
}
</script>



