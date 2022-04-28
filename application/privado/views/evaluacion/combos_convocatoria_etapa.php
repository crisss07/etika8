
<div class="form-group">
	<label class="control-label">Convocatoria: </label>
	<select class="form-select-21" id="id_conv" name="id_conv" required="">
		<option value="">Seleccione Convocatoria</option>

		<?php foreach ($lista_conv as $tp) : ?>

			<option value="<?php echo $tp->con_id; ?>"><?php echo $tp->con_cargo; ?></option>


		<?php endforeach; ?>


	</select>
</div>

<input type="hidden" value="<?php echo $id_grupo_conv; ?>" id="id_grupo_conv">

<div class="form-group">
	<label class="control-label">Etapa: </label>
	<select class="form-select-21" id="id_etapa" name="id_etapa" required="">
		<option value="">Seleccione Etapa</option>
		<!-- <option value="1">Etapa 1</option> -->
		<option value="1">Etapa 2</option>
		<option value="2">Etapa 3</option>
		<!-- <option value="3">Etapa 4</option> -->


	</select>
</div>

<button class="btn-etika btn" id="buscar">Buscar</button>




<script>
	$(document).ready(function(){       
		$('#buscar').click(function(){
			var id_conv = $('#id_conv').val();
			var id_etapa = $('#id_etapa').val();			
			var id_grupo_conv = $('#id_grupo_conv').val();

			var texto = $('#id_conv option:selected').text();
         //var msg= asign_id.atrr('');
      console.log('id grupo_ajax conv'+id_grupo_conv);
   // AJAX request
    $.ajax({
      async: false,
    url: '<?php echo $this->tool_entidad->sitio().'admin.php/Evaluacion/tabla_postulantes' ?> ',
    type: 'post',
    data: {id_conv:id_conv,id_etapa:id_etapa,id_grupo_conv:id_grupo_conv,texto:texto},
    dataType: "html",
    success: function(response){ 
      // Add response in Modal body
      $('#dato_tipo').html('');
      $('#tabla_ajax').html(response);

      
  }

}); 
});
	});
</script>