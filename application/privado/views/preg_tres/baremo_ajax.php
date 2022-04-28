
<?php if ($factor_ajax[0]['cantidad_preguntas']!=0): ?>
  


<?php echo form_open_multipart('Prueba_tres/crear_baremo'); ?>   
<?php $i=0; ?>
<input type="hidden" value="<?php echo $id_plantilla; ?>" name="id_pla">
<input type="hidden" value="<?php echo $factor_id; ?>" name="factor_id">
<input type="hidden" value="<?php echo $factor_ajax[$i]['cantidad_preguntas'] ?>" name="cantidad_factor">
<input type="hidden" value="<?php echo $factor_ajax[$i]['letra'] ?>" name="letra_factor">



    <table class="table table-bordered">
    
        <!-- p1 -->
      <tr bgcolor="#f4f4f4">
        <td class="texto_ablel" style="width:10px;">  <b>Factor</b> </td>
        <td colspan="29"> Cantidad Preguntas CP</td>
        
        
         
      </tr>
      <!-- fila 1 -->
      <tr>
        <td> <b>
          <?php echo $factor_ajax[$i]['letra']; ?></b>
        </td>
        <?php $longitud= ($factor_ajax[$i]['cantidad_preguntas']);?>
        <?php $longitud_dos=$longitud*2;?>
        <?php for ($j=0; $j <= $longitud; $j++) { ?>
        <td class="texto_label" >  <b><?php echo $j; ?></b> </td>
      <?php } ?>
      </tr>
      <tr>
        <td>Valores</td>        
        <?php for ($j=0; $j <=$longitud; $j++) { ?>
        <td class="texto_label" >
          <input type="number" class="form-control" style="padding:0px;" name="factor<?php echo $j; ?>"  min="0" max="10" value="<?php echo $val_factor[$j]; ?>" pattern="^[-/d]/d*$" required="">
        </td>
      <?php } ?>
      </tr>
      <!-- fila 2 -->
      <tr>
        <td> <b>
          <?php echo $factor_ajax[$i]['letra']; ?></b>
        </td>        
        
        <?php for ($j=$longitud+1; $j <= $longitud_dos; $j++) { ?>
        <td class="texto_label" >  <b><?php echo $j; ?></b> </td>
      <?php } ?>
      </tr>
      <tr>
        <td>Valores</td>        
        <?php for ($j=$longitud+1; $j <=$longitud_dos; $j++) { ?>
        <td class="texto_label" >
          <input type="number" class="form-control" style="padding:0px;" name="factor<?php echo $j; ?>"  min="0" max="10" value="<?php echo $val_factor[$j]; ?>" pattern="^[-/d]/d*$" required="">
        </td>
      <?php } ?>
      </tr>
      
      
      
      
      
      


    </table>
  




<p></p>
<div class="row" align="center" >
  <div class="col-md-12">



    <button type="submit" class="btn-etika btn" id="guardar" >Guardar</button>    
    

    

  </div>  
</div>
</form>

<p></p><p></p>
<?php else: ?>
  El Factor tiene 0 cantidad preguntas CP

<?php endif ?>
<!-- if de validacion de 0 -->
<script>
  (function() {
    var
    integers = document.querySelectorAll('input[type="number"][step="1"]'),
    intRx = /\d/;

    for (var input of integers) {
      input.addEventListener('keydown', integerChange, false);
    }

    function integerChange(event) {
      if (
        (event.key.length > 1) || 
        (
          (event.key === "-") &&
          (event.currentTarget.value.length === 0)
          ) ||
        intRx.test(event.key)
        ) return;
        event.preventDefault();
    }

  })();
</script>