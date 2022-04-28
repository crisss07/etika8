<!-- <div class="row">
    <div class="col-md-12" align="right">
      <a href="?php echo $this->tool_entidad->sitio();?>index.php/ninicio">Volver a Inicio</a>
    </div>
</div> -->
<br>
 <div class="row justify-content-center justify-content-md-around">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 text-left">
                <span style="color:#000000; font-weight: bold;" >USUARIO: </span> <span style="color:#000000; font-weight: normal;" ><strong><?php echo $_SESSION[$this->presession . 'usuario']; ?></strong></span><br/>
                <span style="color:#000000; font-weight: bold;" >NOMBRE: </span> <span style="color:#000000; font-weight: normal;" ><strong><?php echo strtoupper($_SESSION[$this->presession . 'nombre']); ?></strong></span>
            </div>
        </div>
    </div>
</div>
 <?php
$this->load->view('cabecera');
?>
<br>
<br>

<?php echo form_open_multipart('Prueba_tres/texto_instructivo_ii/'.$pla_id.'/'.$id_grupo.'/'.$ideval); ?>
<div class="row justify-content-center">

  <div class="col-md-6">
    <table class="table">
      <!-- p1 -->
      
      <tr bgcolor="#f4f4f4">
        <td style="width:10px;">1.-</td>
        <td><?php echo $preguntas[0]['prueba_texto'];?> </td>
      </tr>
      <tr>
        <td><input type="radio" id="customRadio1" name="resp1" ></td>
        <td><?php echo $preguntas[0]['prueba_a'];?></td>
      </tr>
      <tr>
        <td><input type="radio" id="customRadio1" name="resp1" ></td>
        <td><?php echo $preguntas[0]['prueba_b'];?></td>
      </tr>
      <tr>
        <td><input type="radio" id="customRadio1" name="resp1" ></td>
        <td><?php echo $preguntas[0]['prueba_c'];?></td>
      </tr>
      <!-- p2 -->
      
      <tr bgcolor="#f4f4f4">
        <td>2.-</td>
        <td><?php echo $preguntas[1]['prueba_texto'];?> </td>
      </tr>
      <tr>
        <td><input type="radio" id="customRadio1" name="resp2" ></td>
        <td><?php echo $preguntas[1]['prueba_a'];?></td>
      </tr>
      <tr>
        <td><input type="radio" id="customRadio1" name="resp2" ></td>
        <td><?php echo $preguntas[1]['prueba_b'];?></td>
      </tr>
      <tr>
        <td><input type="radio" id="customRadio1" name="resp2" ></td>
        <td><?php echo $preguntas[1]['prueba_c'];?></td>
      </tr>

      <!-- p2 -->
      
      <tr bgcolor="#f4f4f4">
        <td>3.-</td>
        <td><?php echo $preguntas[2]['prueba_texto'];?> </td>
      </tr>
      <tr>
        <td><input type="radio" id="customRadio1" name="resp3" ></td>
        <td><?php echo $preguntas[2]['prueba_a'];?></td>
      </tr>
      <tr>
        <td><input type="radio" id="customRadio1" name="resp3" ></td>
        <td><?php echo $preguntas[2]['prueba_b'];?></td>
      </tr>
      <tr>
        <td><input type="radio" id="customRadio1" name="resp3" ></td>
        <td><?php echo $preguntas[2]['prueba_c'];?></td>
      </tr>


    </table>
  </div>
  
</div>
<p></p>
<div class="row justify-content-center justify-content-md-around">
    <div class="col-md-9">
         <button type="submit" class="btn-etika btn" id="guardar" >Siguiente</button>
    </div>
</div>
</form>
