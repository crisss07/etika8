<div class="form-group">
      <label>Introduzca nro de Documento: </label>
      <input type="text" class="form-control input1" value="" id="nro_documento" name="nro_documento" required="">
    </div>
<input type="hidden" value="<?php echo $id_grupo_conv; ?>" id="id_grupo_conv">


    <button class="btn-etika btn" id="buscar">Buscar</button>




<script>
	$(document).ready(function(){       
		$('#buscar').click(function(){
			var nro_documento = $('#nro_documento').val();
      var id_grupo_conv = $('#id_grupo_conv').val();
      console.log('id nro de nro_documento::'+nro_documento+'conv::'+id_grupo_conv);
   // AJAX request
    $.ajax({
      async: false,
    url: '<?php echo $this->tool_entidad->sitio().'admin.php/Evaluacion/tabla_postulantes_doc' ?> ',
    type: 'post',
    data: {id_grupo_conv:id_grupo_conv,nro_documento:nro_documento},
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