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
	<?php
	//OPCIONES EN EVALUACIONES
	$this->load->view('opciones_evaluacion', $o_evaluacion);
	?>
	</div>
<!-- finde div  -->
</div>
<!-- fin de row -->


<?php echo form_open_multipart('Plantilla/create'); ?>   
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4" align="left">
    <div class="form-group">
      <label>Titulo Plantilla: </label>
      <input type="text" class="form-control input1" value="" name="titulo" required="">
    </div>    
    <div class="form-group">
      <label class="control-label">Tipo: </label>
      <select class="form-select-21" id="tipo_eval" name="tipo_eval" required="">
        <option value="">Seleccione una opci&oacute;n</option>
        <?php foreach ($datos as $tp) : ?>

          <option value="<?php echo $tp->tipo_eval_id; ?>"><?php echo $tp->tipo_desc; ?></option>


        <?php endforeach; ?>


      </select>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-6" align="left">
    <div id="dato_tipo">      
    </div>
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
    <button type="submit" class="btn-etika btn" id="guardar" >Guardar</button>
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

<script>
    $(document).ready(function(){

       $('#tipo_eval').on('change',function(){

         var tipo_id = $('#tipo_eval').val();
         

         console.log(tipo_id);
   // AJAX request
   if (tipo_id==5) {

    $.ajax({
    url: 'caja_tiempo_prueba',
    type: 'post',
    data: {tipo_id:tipo_id},
    dataType: "html",
    success: function(response){ 
      // Add response in Modal body
      $('#dato_tipo').html(response);

      
  }

});

   }

   if (tipo_id!=5) {
     $('#dato_tipo').html('');
   }

   



});
   });
</script>