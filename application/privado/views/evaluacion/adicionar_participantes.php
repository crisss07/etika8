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
  <?php
  $sitio=$this->tool_entidad->sitioindexpri();
  ?>
  <div class="paginacion_lista"><?php //echo $this->pagination->create_links();?></div>

  <?php
  if(!@$this->nolistar){
    ?>
    
      <table width="100%"><tr><td>
        <table align="center" width="100%">
          <tr>
            <td class="enlaces_add_edit" align="left" width="100%">

              <?php echo anchor($this->controlador.'lista_evaluacion/'.$id_grupo,'Listado',array('class' =>'enlace_listar enlace_a1')); ?>
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
  

  <br/>
  <br/>

<?php }?>
</div>
</div>

<!-- ?php echo form_open_multipart('Plantilla/create'); ?>    -->
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4" align="left">

    <input type="hidden" name="grupo_id" id="grupo_id" value="<?php echo $id_grupo; ?>">
        
    <div class="form-group">
      <label class="control-label">Tipo: </label>
      <select class="form-select-21" id="tipo_eval" name="tipo_eval" required="">
        <option value="">Seleccione una opci&oacute;n</option>
        <option value="1">Convocatoria</option>
        <option value="2">Nro de Documento</option>
        <option value="3">Ap Paterno</option>
       


      </select>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4" align="left" id="dato_tipo">
    
  </div>
</div>

<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10" align="left" id="tabla_ajax">
    
  </div>
</div>

<!-- <div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-8" align="left">
    DURACIÓN PLANTILLA:
    <br><br>
    <div class="row">
      <div class="col-md-2">
        <label>Horas</label>
        <input type="text" class="form-control input1" value="" name="hora" required="">
      </div>
      <div class="col-md-2">
        <label>Minutos</label>
        <input type="text" class="form-control input1" value="" name="min" required="">
      </div>
      <div class="col-md-2">
        <label>Segundos</label>
        <input type="text" class="form-control input1" value="" name="sec" required="">
      </div>
    </div>
  </div>
</div> -->

<p></p>
<div class="row" align="center" >
  <div class="col-md-12">
    <!-- <button type="submit" class="btn-etika btn" id="buscar">Buscar</button> -->
  </div>  
</div>
<!-- </form> -->

<p></p><p></p>

<script>
    $(document).ready(function(){

       $('#tipo_eval').on('change',function(){

         var tipo_id = $('#tipo_eval').val();
         var grupo_id = $('#grupo_id').val();
         var texto = $('#tipo_eval option:selected').text();

         // $("#servicio option:selected").text()
         

         console.log('grupo_id_parti '+grupo_id+texto);
   // AJAX request
   if (tipo_id==1) {

    $.ajax({
      async: false,
    url: '<?php echo $this->tool_entidad->sitio().'admin.php/Evaluacion/combo_convocatoria' ?> ',
    type: 'post',
    data: {tipo_id:tipo_id,id_grupo:grupo_id},
    dataType: "html",
    success: function(response){ 
      // Add response in Modal body
      $('#dato_tipo').html(response);
      $('#tipo_eval').val('');
      $('#tabla_ajax').text('');
      

      
  }

});

   }

   if (tipo_id==2) {
     //$('#dato_tipo').html('tipo 2');
    $.ajax({
      async: false,
    url: '<?php echo $this->tool_entidad->sitio().'admin.php/Evaluacion/combo_documento' ?> ',
    type: 'post',
    data: {id_grupo:grupo_id},
    dataType: "html",
    success: function(response){ 
      // Add response in Modal body
      $('#dato_tipo').html(response);
      $('#tipo_eval').val('');
      $('#tabla_ajax').text('');
      }
    });
   }

   if (tipo_id==3) {
     $.ajax({
      async: false,
    url: '<?php echo $this->tool_entidad->sitio().'admin.php/Evaluacion/combo_paterno' ?> ',
    type: 'post',
    data: {id_grupo:grupo_id},
    dataType: "html",
    success: function(response){ 
      // Add response in Modal body
      $('#dato_tipo').html(response);
      $('#tipo_eval').val('');
      $('#tabla_ajax').text('');
      }
    });
   }
   if (tipo_id==4) {
     $('#dato_tipo').html('tipo 4');
   }
});
   });
</script>