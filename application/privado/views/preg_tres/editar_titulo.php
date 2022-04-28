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
                <span class="cabecera_titulo">Plantilla</span>
                <span class="flecha2">&rarr;</span>
                <span class="cabecera_accion"> <?php echo $cabecera['accion'];?></span>
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

<div class="row">
  <div class="col-md-12">

<!-- <div id="listado"> -->
  <?php
  $sitio=$this->tool_entidad->sitioindexpri();
  ?>
  

  <?php
  if(!@$this->nolistar){
    ?>
    
      <table width="100%"><tr><td>
        <table align="center" width="100%">
          <tr>
            <td class="enlaces_add_edit" align="left" width="100%">

             
              <?php echo anchor($this->controlador.'listado_opciones_edicion/'.$id,'Listado de Opciones',array('class' =>'enlace_listar enlace_a1')); ?>
              &nbsp;&nbsp;
              <?php echo anchor($this->controlador.'listado_opciones_edicion/'.$id, 'Cancelar', array('class' => 'enlace_cancelar enlace_a1')); ?>  
                                
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
  

  <br/>
  <br/>

<?php }?>
</div>
<!-- finde div  -->
</div>
<!-- fin de row -->


<?php echo form_open_multipart('Prueba_tres/updt_titulo'); ?>   
<input type="hidden" name="id_pla" value="<?php echo $id; ?>">
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4" align="left">
    <div class="form-group">
      <label>Titulo Plantilla: </label>
      <input type="text" class="form-control input1" value="<?php echo $valor_texto; ?>" name="titulo" required="">
    </div> 
  </div>
</div>



<p></p>
<div class="row" align="center" >
  <div class="col-md-12">
    <button type="submit" class="btn-etika btn" id="guardar" >Modificar</button>
  </div>  
</div>
</form>

<p></p><p></p>

<script>
    $(document).ready(function(){

       $('#tipo_evalsss').on('change',function(){

         var tipo_id = $('#tipo_eval').val();
         

         console.log(tipo_id);
   // AJAX request
   if (tipo_id==1) {

    $.ajax({
    url: 'caja_tipo',
    type: 'post',
    data: {tipo_id:tipo_id},
    dataType: "html",
    success: function(response){ 
      // Add response in Modal body
      $('#dato_tipo').html(response);

      
  }

});

   }

   if (tipo_id==2) {
     $('#dato_tipo').html('');
   }

   



});
   });
</script>