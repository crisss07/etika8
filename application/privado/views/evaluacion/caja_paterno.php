<div class="form-group">
      <label>Introduzca Apellido Paterno: </label>
      <input type="text" class="form-control input1" value="" id="ap_paterno" name="ap_paterno" required="">
    </div>
<input type="hidden" value="<?php echo $id_grupo_conv; ?>" id="id_grupo_conv">


    <button class="btn-etika btn" id="buscar">Buscar</button>




<script>
	$(document).ready(function(){       
		$('#buscar').click(function(){
			var ap_paterno = $('#ap_paterno').val();
      var id_grupo_conv = $('#id_grupo_conv').val();
      console.log('id nro de ap_paterno::'+ap_paterno+'conv::'+id_grupo_conv);
   // AJAX request
    $.ajax({
      async: false,
    url: '<?php echo $this->tool_entidad->sitio().'admin.php/Evaluacion/tabla_postulantes_pat' ?> ',
    type: 'post',
    data: {id_grupo_conv:id_grupo_conv,ap_paterno:ap_paterno},
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