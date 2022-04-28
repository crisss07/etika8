<?php echo form_open_multipart('Evaluacion/create_participantes'); ?>   

<input type="hidden" value="<?php echo $id_grupo_tabla; ?>" name="id_grupo">

<p>
<h3>
<?php echo $convocatoria_texto; ?>    
</h3>    
</p>
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
         <td align="center" valign="">Acciones</td>

      

                 
         
      
   </tr>
   <?php $j=0; ?>
   <?php
   foreach ($datos as $fila)
   {
    ?>
    <tr id="fila_<?php echo $j; ?>">
      
        
     
     <td align="center"><?php echo $j+1; ?> </td>
     <td align="center"><?php echo $fila->pos_apaterno; ?></td>
     <td align="center"><?php echo $fila->pos_amaterno; ?></td>     
     <td align="center">
        <?php echo $fila->pos_nombre; ?> 
        <input type="hidden" name="postulantes[]" value="<?php echo $fila->pos_id; ?>">

     </td>
     <td align="center"><?php echo $fila->pos_documento; ?> </td>
     <td align="center"><?php echo $fila->pos_celular; ?></td>
     <td align="center"><?php echo $fila->pos_email; ?></td>
     <td align="center"> <button class="btn waves-effect waves-light btn-light"  onclick="eliminar_fila(<?php echo $j; ?>)">
         <img src="<?php echo $this->tool_entidad->sitio().'files/img/privado/eliminar.png'; ?>" width="30px" alt="">
     </button>
        
                        </td>


      
      
   </tr>
   <?php $j++; ?>
   <?php
 }
 ?>
</table>

<p></p>
<div class="row" align="center" >
  <div class="col-md-12">
    <button type="submit" class="btn-etika btn" id="guardar" >Adicionar Toda la lista</button>
  </div>  
</div>
</form>

<script>
    function eliminar_fila(fila){
         $("#fila_"+fila).remove();
    }
</script>


