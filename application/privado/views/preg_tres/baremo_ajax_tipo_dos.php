<?php if ($factor_ajax[0]['cantidad_preguntas']!=0): ?>

<?php echo form_open_multipart('Prueba_tres/crear_baremo_dos'); ?>   
<?php $i=0; ?>
<input type="hidden" value="<?php echo $id_plantilla; ?>" name="id_pla">
<input type="hidden" value="<?php echo $factor_id; ?>" name="factor_id">
<input type="hidden" value="<?php echo $factor_ajax[$i]['cantidad_preguntas'] ?>" name="cantidad_factor">
<input type="hidden" value="<?php echo $factor_ajax[$i]['letra'] ?>" name="letra_factor">
    <table class="table table-bordered">
      <tr bgcolor="#f4f4f4">
        <td class="texto_ablel" style="width:10px;">  <b>Factor</b> </td>
        <td colspan="29"> Cantidad Preguntas</td>
      </tr>
      
      <?php $longitud= ($factor_ajax[$i]['cantidad_preguntas']);?>
      <?php $division= $longitud/14;
      $parte_entera=floor($division);
      // echo $parte_entera;

      $pos_ini=0;
      $max_num=14;

      // $max_num_dos=
        

      ?>

      <!-- fila 1 -->
      <?php for ($k=1; $k <=$parte_entera; $k++) { ?>
        <tr>
        <td> 
          <b><?php echo $factor_ajax[$i]['letra']; ?></b>
        </td>
        
        <?php for ($j=$pos_ini; $j <= $max_num; $j++) { ?>
        <td class="texto_label" >  <b><?php echo $j; ?></b> </td>
      <?php } ?>
      </tr>
      <tr>
        <td>Valores</td>        
        <?php for ($j=$pos_ini; $j <=$max_num; $j++) { ?>
        <td class="texto_label" >
          <input type="number" class="form-control" style="padding:0px;" name="factor<?php echo $j; ?>"  min="0" max="10" value="<?php echo $val_factor[$j]; ?>" pattern="^[-/d]/d*$" required="">
        </td>
      <?php } ?>
      </tr>

      <?php 
      $pos_ini=$max_num+1;
      $max_num=$max_num+15;
       ?>
      <?php } ?>



      <tr>
        <td> 
          <b><?php echo $factor_ajax[$i]['letra']; ?></b>
        </td>
        
        <?php for ($j=$pos_ini; $j <= $longitud; $j++) { ?>
        <td class="texto_label" >  <b><?php echo $j; ?></b> </td>
      <?php } ?>
      </tr>
      <tr>
        <td>Valores</td>        
        <?php for ($j=$pos_ini; $j <= $longitud; $j++) { ?>
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