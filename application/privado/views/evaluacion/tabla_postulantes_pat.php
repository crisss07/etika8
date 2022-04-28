<?php echo form_open_multipart('Evaluacion/create_participantes'); ?>   

<input type="hidden" value="<?php echo $id_grupo_tabla; ?>" name="id_grupo" id="id_grupo">

<p>
    <h3>

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
       <td align="center" valign="">adicionar</td>
       <td align="center" valign="">eliminar</td>






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
    <td>
        <button class="btn waves-effect waves-light btn-light"  onclick="add_participantes(<?php echo $j.','.$fila->pos_id; ?>)">
           <img src="<?php echo $this->tool_entidad->sitio().'files/img/nuevo.png'; ?>" width="30px" alt="">
       </button>        
    </td>
    <td align="center">
        
       <button class="btn waves-effect waves-light btn-light"  onclick="eliminar_fila(<?php echo $j; ?>)">
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
    <button type="submit" class="btn-etika btn" >Adicionar Toda la lista</button>
</div>  
</div>
</form>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function eliminar_fila(fila){
       $("#fila_"+fila).remove();
   }
</script>
<!-- adicionar_participantes -->
<script>
    function add_participantes(fila,pos_id){
        $("#fila_"+fila).remove();
       var grupo_id = $('#id_grupo').val();
       console.log(fila,grupo_id,pos_id);
       $.ajax({
          async: false,
          url: '<?php echo $this->tool_entidad->sitio().'admin.php/Evaluacion/add_post_ajax' ?> ',
          type: 'post',
          data: {pos_id:pos_id,id_grupo:grupo_id},
          dataType: "json",
          success: function(data){ 
            // data.msj_prueba
            if (data.msj_error) {
                 swal({
        title: "Se agrego correctamente",
        text:  "Este mensaje se cerrara en 2 segundos",
        icon:  "success",
        timer: 2000, 
    });
            }else{
                         swal({
        title: "El postulante ya se encuentra agregado",
        text:  "Este mensaje se cerrara en 2 segundos",
        icon:  "error",
        timer: 2000, 
    });
            }
            console.log(data.msj_error);
            // console.log('hola');
        }
        });

   }
   
</script>


