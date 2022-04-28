<?php echo form_open_multipart('Prueba_cinco/vista_texto_despedida/'.$id); ?>   
<input type="hidden" value="<?php echo $id; ?>" name="id">

<div class="row">
  <div class="col-md-2"> </div>
  <div class="col-md-8" >
    <table class="table table-bordered"> 
      <tr bgcolor="#f4f4f4">
        <td style="width:10px;"><b>Nro</b></td>
        <td style="width:200px;" > <b> Cantidad </b></td>
        
        <td style="width:200px;"><b>Clase de seguro</b></td>
        <td style="width:200px;"><b>Fecha</b></td>
        <td><b>1</b></td>
        <td><b>2</b></td>
        <td><b>3</b></td>
      </tr>

      <?php $i=1; ?>
    <?php for ($j=0; $j <count($datos); $j++) { ?>

      <tr bgcolor="#f4f4f4">
        <td><b><?php echo $i; ?></b></td>
        <td class="texto_label">
          <input type="text" class="form-control input1" name="cant<?php echo $i; ?>" value="<?php echo $datos[$j]['cantidad']; ?>" required="">
        </td>
        
        <td style="width:200px;">
          <input type="text" class="form-control input1" name="cl<?php echo $i; ?>" value="<?php echo $datos[$j]['clase']; ?> " required="">
        </td>
        <td >
          <input type="text" class="form-control input1" name="fech<?php echo $i; ?>" value="<?php echo $datos[$j]['fecha']; ?> " required="">
        </td>
        <?php $valor_check=""; ?>   
        <?php if ($datos[$j]['pre_resp_a']==1): ?>
              <?php $valor_check="checked";?>
        <?php endif ?> 
        <td >
          <input type="checkbox" class="" name="a<?php echo $i; ?>" <?php echo $valor_check; ?> value="1" >          
        </td>
        <?php $valor_check=""; ?>   
        <?php if ($datos[$j]['pre_resp_b']==1): ?>
              <?php $valor_check="checked";?>
        <?php endif ?> 
        <td >
          <input type="checkbox" class="" name="b<?php echo $i; ?>" <?php echo $valor_check; ?> value="1" >          
        </td>
        <?php $valor_check=""; ?>   
        <?php if ($datos[$j]['pre_resp_c']==1): ?>
              <?php $valor_check="checked";?>
        <?php endif ?> 
        <td >
          <input type="checkbox" class="" name="c<?php echo $i; ?>" <?php echo $valor_check; ?> value="1" >          
        </td>
      </tr>
      <?php $i++; ?>

              <!-- <input type="text" class="form-control input1" name="p<?php echo $i; ?>" required=""> -->
    <?php } ?>
    </table>
  </div>
</div>

<p></p>
<div class="row" align="center" >
  <div class="col-md-12">
    <button type="submit" class="btn-etika btn" id="guardar" >Siguiente Paso</button>
  </div>  
</div>
</form>

<p></p><p></p>