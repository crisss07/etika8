<div class="row">
<div class="col-md-6">
	<div class="form-group" align="left"> 
                                                    <label><code>*</code> Convocatoria</label>
                                                    <select class="form-select-21" id="conv">
                                                        <option value="">Seleccione convocatoria</option>
                                                        <?php foreach ($convocatoria as $tp) : ?>
                                                        <option value="<?php echo $tp->con_id; ?>"><?php echo $tp->con_cargo; ?></option>
                                                <?php endforeach; ?>
                                                        
                                                    </select>
                                                </div>
	</div>
	<div class="col-md-1">
		   <br>
                                                  <br>
		 <button class="btn-etika btn" onclick="generar()"> Generar</button>
		</div>
</div>
 

<!-- 
                                                 <div >
                                             
                                                   
                                            </div>
 -->

 <script>
  $(document).ready(function(){
      // $('#gen').hide();
      $('#conv').change(function(){
        $('#tabla_listado').empty();   
      });
    });
</script>
