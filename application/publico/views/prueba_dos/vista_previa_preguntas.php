
<style>
*{box-sizing:border-box;margin:0;padding:0;}
@font-face{
  font-family:alarm;
  src:url(alarm.ttf);
}
.cronometro{
  width:200px;
  height:100px;
    /*top:50%;
    left:50%;*/
    /*position:absolute;*/
    /*margin-top:-50px;
    margin-left:-100px;*/
    text-align:center;
  } 
  .boton{display:inline-block;width:32px;height:32px;position:relative;}
  #hms{
    height:68px;
    padding:5px 0;
    font-size:24px;
    color:#000;
    /*font-family: alarm;  */
  }
  .start{background:url(start.png) 0 0 no-repeat;}
  .stop{background:url(pause.png) 0 0 no-repeat;}
  .reiniciar{background:url(delete.png)0 0 no-repeat;}
</style>
<script>
  window.onload = init;

  function iniciar_prueba(){
    // alert('hola');
    confirm("Comenzar prueba");
    // cronometrar();
  }


  function init(){
    // document.querySelector(".start").addEventListener("click",cronometrar);
    // document.querySelector(".stop").addEventListener("click",parar);
    // document.querySelector(".reiniciar").addEventListener("click",reiniciar);
    h = <?php echo $tc[0]; ?>;
    m = <?php echo $tc[1]; ?>;
    s = <?php echo $tc[2]; ?>;    
    document.getElementById("hms").innerHTML="00:00:00";
    cronometrar();
  }         
  function cronometrar(){
    escribir();
    id = setInterval(escribir,1000);
    document.querySelector(".start").removeEventListener("click",cronometrar);
  }
  function escribir(){
    var hAux, mAux, sAux;
    s++;
    if (s>59){m++;s=0;}
    if (m>59){h++;m=0;}
    if (h>24){h=0;}

    if (s<10){sAux="0"+s;}else{sAux=s;}
    if (m<10){mAux="0"+m;}else{mAux=m;}
    if (h<10){hAux="0"+h;}else{hAux=h;}

    document.getElementById("hms").innerHTML = hAux + ":" + mAux + ":" + sAux; 
    document.getElementById("tiempo").value = hAux + ":" + mAux + ":" + sAux; 
    guardar_tiempo(hAux,mAux,sAux); 
  }
  function parar(){
    clearInterval(id);
    document.querySelector(".start").addEventListener("click",cronometrar);

  }
  function guardar_tiempo(hora,min,seg){
    var id_pla='<?php echo $id_pla; ?>';
    var id_grupo='<?php echo $id_grupo; ?>';
    var id_eval='<?php echo $idev; ?>';
    // console.log(hora,min,seg,id_eval,id_grupo,id_pla);
    console.log(hora,min,seg);
    $.ajax({
      url: '<?php echo base_url();?>index.php/Prueba_dos/actualizar_tiempo',
      type: 'post',
      data: {id_pla:id_pla,id_grupo:id_grupo,id_eval:id_eval,hora:hora,min:min,seg:seg},
      dataType: "json",
      success: function(data){ 
        console.log(data.msj);
      // alert('paso por aca');
    }
  });

  // var id_pla=1;
  // $.ajax({
  //   url: '<?php echo base_url();?>index.php/Prueba_tres/test_ajax',
  //   // url: '<?php echo base_url();?>index.php/Prueba_tres/actualizar_tiempo',
  //   // url: "http://www.mydomain.com/inc/db_actions.php",
  //   type: 'post',
  //   data: {id_pla:id_pla},
  //   dataType: "json",
  //   success: function(data){ 
  //     console.log(data.msj);
  //     alert('paso por aca');
  //   }
  // });
}
function reiniciar(){
  clearInterval(id);
  document.getElementById("hms").innerHTML="00:00:00";
  h=0;m=0;s=0;
  document.querySelector(".start").addEventListener("click",cronometrar);
}
</script>
<br>
<!-- <div class="row">
    <div class="col-md-12" align="right">
      <a href="?php echo $this->tool_entidad->sitio();?>index.php/ninicio">Volver a Inicio</a>
    </div>
  </div> -->

  <!-- stilos spiner -->

<style>
.con-preloader{
  display:none;
  width:100%;
  height:200%;
  border: 1px solid white; background: #fff;padding: 20px;border-radius: 20px; opacity:0.9;
  position: absolute;
  align-items:center;
  top: 0;
  bottom: 4%;
  right: 0;
  left: 0;
 
}
.preloader::after { 
  position:absolute;
  top: 0;
  bottom: 4%;
  right: 0;
  left: 0;
  content: " ";
  display: block;
  
  margin: auto;
  height: 62px;
  width: 62px;
  
  box-sizing: border-box;
  border: solid;
  border-width: 10px;
  border-radius: 50%;
  border-top-color: rgba(140, 140, 140, 0.55);
  border-bottom-color: rgba(140, 140, 140, 0.2);
  border-right-color: rgba(140, 140, 140, 0.2);
  border-left-color: rgba(140, 140, 140, 0.2);
  
  animation: rotating 0.9s linear infinite;
}

@keyframes rotating{
  from {
    transform:rotate(0deg);
  }
  to {
    transform:rotate(360deg);
  }
}

</style>
<!-- stilos spiner -->
  <div class="row justify-content-center justify-content-md-around" >
    <div class="col-md-8" align="left">

      <span style="color:#000000; font-weight: bold;" >USUARIO: </span> <span style="color:#000000; font-weight: normal;" ><strong><?php echo $_SESSION[$this->presession . 'usuario']; ?></strong></span><br/>
      <span style="color:#000000; font-weight: bold;" >NOMBRE: </span> <span style="color:#000000; font-weight: normal;" ><strong><?php echo strtoupper($_SESSION[$this->presession . 'nombre']); ?></strong></span>
      <?php
      $this->load->view('cabecera');
      ?>

    </div>
    <div class="col-md-4">
      <div id="hms"></div>
    </div>

  </div>

  <br>


  <?php
  $prefijo=$this->prefijo;

  $alineacionw='center';
  $alineacionh='middle';

  ?>

  <!-- inicio de las preguntas -->
  <!-- datos para el for -->
  <?php 
  $gi=$grup_ini;
  $grupos=$num_ini;
  $k=$num_ini;
  $pos_total=0;
  $pi=0;
  $suma1=1;
  $suma2='onclick="sumarNum2(this.value)"';
  ?>

  <?php echo form_open_multipart('Prueba_dos/guardar_preguntas/', array('onsubmit' => 'return validar()') ); ?>   
  <input type="hidden" value="<?php echo $id_pla; ?>" name="id_pla">
  <input type="hidden" value="<?php echo $id_grupo; ?>" name="id_grupo">
  <input type="hidden" value="<?php echo $idev; ?>" name="idev">
  <input type="hidden" value="<?php echo $num_ini; ?>" name="num_ini">
  <input type="hidden" value="<?php echo $num_fin; ?>" name="num_fin">

  <input type="hidden" id="tiempo" name="tiempo">
  <div class="row" style="font-size:14px;" id="cajaArchivo">
    <div class="col-md-6" >
      GRUPO <?php echo $gi; ?> <br>
      <table class="table" style="border:none;">
        <?php for ($i=0; $i <4 ; $i++) { ?>


          <tr>      
            <td>
              <input tabindex="<?php echo $data[$i]['pre_nro']; ?>" type="number" class="input1" maxlength="1" size="1" min="0" step="1" pattern="^[-/d]/d*$"  max="9" required="" name="p<?php echo $data[$i]['pre_nro'];?>" id="p<?php echo $i;?>" style="width: 60px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  onchange="sumarNum1(this.value)" >
            </td>
            <td>
              <?php echo $data[$i]['pre_nro'].'.-'. $data[$i]['pre_texto']; ?>
            </td>
          </tr>

        <?php } ?>
        <tr>
          <td>
           <input type="number" class="input1" maxlength="1" size="1" min="0" step="1" pattern="^[-/d]/d*$"  max="9" required="" id="suma1" style="width: 60px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  readonly>


         </td>
         <td>
          Total &nbsp;
          <code id="validsuma1"></code> 
        </td>
      </tr>
    </table>   
  </div>    
  <?php $gi++; ?>
  <div class="col-md-6" >
    GRUPO <?php echo $gi; ?> <br>
    <table class="table borderless" style="border:none;">
      <?php for ($i=4; $i <8 ; $i++) { ?>


        <tr>      
          <td>
            <input tabindex="<?php echo $data[$i]['pre_nro']; ?>" type="number" class="input1" maxlength="1" size="1" min="0" step="1" pattern="^[-/d]/d*$"  max="9" required="" name="p<?php echo $data[$i]['pre_nro'];?>" id="p<?php echo $i;?>" style="width: 60px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  onchange="sumarNum2(this.value)" >
          </td>
          <td>
            <?php echo $data[$i]['pre_nro'].'.-'. $data[$i]['pre_texto']; ?>
          </td>
        </tr>

      <?php } ?>
      <tr>
        <td>
         <input type="number" class="input1" maxlength="1" size="1" min="0" step="1" pattern="^[-/d]/d*$"  max="9" required="" id="suma2" style="width: 60px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  readonly>
       </td>
       <td>
        Total &nbsp;
        <code id="validsuma2"></code> 
      </td>
    </tr>
  </table> 
</div>    
</div>   
<?php $gi++; ?> 

<!-- segundo par de grupo -->
<div class="row" style="font-size:14px;">
  <div class="col-md-6" >
    GRUPO <?php echo $gi; ?> <br>
    <table class="table" style="border:none;">
      <?php for ($i=8; $i <12 ; $i++) { ?>


        <tr>      
          <td>
            <input tabindex="<?php echo $data[$i]['pre_nro']; ?>" type="number" class="input1" maxlength="1" size="1" min="0" step="1" pattern="^[-/d]/d*$"  max="9" required="" name="p<?php echo $data[$i]['pre_nro'];?>" id="p<?php echo $i;?>" style="width: 60px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  onchange="sumarNum3(this.value)" >
          </td>
          <td>
            <?php echo $data[$i]['pre_nro'].'.-'. $data[$i]['pre_texto']; ?>
          </td>
        </tr>

      <?php } ?>
      <tr>
        <td>
         <input type="number" class="input1" maxlength="1" size="1" min="0" step="1" pattern="^[-/d]/d*$"  max="9" required="" id="suma3" style="width: 60px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  readonly>
       </td>
       <td>
        Total &nbsp;
        <code id="validsuma3"></code> 
      </td>
    </tr>
  </table>   
</div>
<?php $gi++; ?>    
<div class="col-md-6" >
  GRUPO <?php echo $gi; ?> <br>
  <table class="table borderless" style="border:none;">
    <?php for ($i=12; $i <16 ; $i++) { ?>


      <tr>      
        <td>
          <input tabindex="<?php echo $data[$i]['pre_nro']; ?>" type="number" class="input1" maxlength="1" size="1" min="0" step="1" pattern="^[-/d]/d*$"  max="9" required="" name="p<?php echo $data[$i]['pre_nro'];?>" id="p<?php echo $i;?>" style="width: 60px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  onchange="sumarNum4(this.value)" >
        </td>
        <td>
          <?php echo $data[$i]['pre_nro'].'.-'. $data[$i]['pre_texto']; ?>
        </td>
      </tr>

    <?php } ?>
    

    <tr>
      <td>
       <input type="number" class="input1" maxlength="1" size="1" min="0" step="1" pattern="^[-/d]/d*$"  max="9" required="" id="suma4" style="width: 60px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  readonly>
     </td>
     <td>
      Total &nbsp;
      <code id="validsuma4"></code> 
    </td>
  </tr>
</table> 
</div>    
</div> 


<!-- old -->



<p></p>
<div class="row" align="center" >
  <div class="col-md-12">
    <?php if ($num_fin==80): ?>
      <button type="submit" class="btn-etika btn" id="boton_guardar" >Terminar</button>
    <?php else: ?>
      <button type="submit" class="btn-etika btn" id="boton_guardar" >Siguientes Preguntas</button>    
        
    <?php endif ?>
 <!-- <button type="button" class="btn-etika btn" onclick="alerta();" >Alert</button>  -->
    

  </div>  
</div>
<!-- spinner -->
<div class="form-group" >
<div id="preloader" class="con-preloader" style="">
  <div class="preloader"></div>
</div>
</div>
<!-- spinner -->
</form>

<p></p><p></p>

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

<script>
  function sumarNum1(n1) {
    total=0;
    val1=$("#p0").val();
    val2=$("#p1").val();
    val3=$("#p2").val();
    val4=$("#p3").val();
    valor = parseInt(n1);
    if (val1 ==='') {
      val1=0;
    }

    if (val2 ==='') {
      val2=0;
    } 
    if (val3 ==='') {
      val3=0;
    } 
    if (val4 ==='') {
      val4=0;
    } 

    total= total+ parseInt(val1)+parseInt(val2)+parseInt(val3)+parseInt(val4);
    valor='la suma debe ser igual a <b>10</b>';
    if (total>10) {
      $("#validsuma1").html(valor); 
    }else{
      if (total<10) {
        $("#validsuma1").html(valor); 
      }else{
        $("#validsuma1").html(''); 
      }     
      
    }

    
    // $total= total + parseInt(val1);
    console.log(total);
    $('#suma1').val(total);

  }
</script>

<script>
  function sumarNum2(n1) {
    total=0;
    val1=$("#p4").val();
    val2=$("#p5").val();
    val3=$("#p6").val();
    val4=$("#p7").val();
    valor = parseInt(n1);
    if (val1 ==='') {
      val1=0;
    }

    if (val2 ==='') {
      val2=0;
    } 
    if (val3 ==='') {
      val3=0;
    } 
    if (val4 ==='') {
      val4=0;
    } 

    total= total+ parseInt(val1)+parseInt(val2)+parseInt(val3)+parseInt(val4);
    valor='la suma debe ser igual a <b>10</b>';
    if (total>10) {
      $("#validsuma2").html(valor); 
    }else{
      if (total<10) {
        $("#validsuma2").html(valor); 
      }else{
        $("#validsuma2").html(''); 
      }     
      
    }

    
    // $total= total + parseInt(val1);
    console.log(total);
    $('#suma2').val(total);

  }
</script>


<script>
  function sumarNum3(n1) {
    total=0;
    val1=$("#p8").val();
    val2=$("#p9").val();
    val3=$("#p10").val();
    val4=$("#p11").val();
    valor = parseInt(n1);
    if (val1 ==='') {
      val1=0;
    }

    if (val2 ==='') {
      val2=0;
    } 
    if (val3 ==='') {
      val3=0;
    } 
    if (val4 ==='') {
      val4=0;
    } 

    total= total+ parseInt(val1)+parseInt(val2)+parseInt(val3)+parseInt(val4);
    valor='la suma debe ser igual a <b>10</b>';
    if (total>10) {
      $("#validsuma3").html(valor); 
    }else{
      if (total<10) {
        $("#validsuma3").html(valor); 
      }else{
        $("#validsuma3").html(''); 
      }     
      
    }

    
    // $total= total + parseInt(val1);
    console.log(total);
    $('#suma3').val(total);

  }
</script>

<script>
  function sumarNum4(n1) {
    total=0;
    val1=$("#p12").val();
    val2=$("#p13").val();
    val3=$("#p14").val();
    val4=$("#p15").val();
    valor = parseInt(n1);
    if (val1 ==='') {
      val1=0;
    }

    if (val2 ==='') {
      val2=0;
    } 
    if (val3 ==='') {
      val3=0;
    } 
    if (val4 ==='') {
      val4=0;
    } 

    total= total+ parseInt(val1)+parseInt(val2)+parseInt(val3)+parseInt(val4);
    valor='la suma debe ser igual a <b>10</b>';
    if (total>10) {
      $("#validsuma4").html(valor); 
    }else{
      if (total<10) {
        $("#validsuma4").html(valor); 
      }else{
        $("#validsuma4").html(''); 
      }     
      
    }

    
    // $total= total + parseInt(val1);
    console.log(total);
    $('#suma4').val(total);

  }
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  function alerta()
  {
    // var x = document.getElementById('preloader');
    // var y = document.getElementById('cajaArchivo');
    // x.style.display = "block";
    // y.style.visibility= "hidden";

  swal({
                title:"", 
                text:"Se esta guardando las respuestas...",
                icon: "https://www.boasnotas.com/img/loading2.gif",
                buttons: false,      
                closeOnClickOutside: false,
                // timer: 30000,
                //icon: "success"
            });
  }
</script>

<script type="text/javascript">
  function validar()
  {
    var total1=$('#suma1').val();
    var total2=$('#suma2').val();
    var total3=$('#suma3').val();
    var total4=$('#suma4').val();
    var suma_total=parseInt(total1)+parseInt(total2)+parseInt(total3)+parseInt(total4);
  //validar doble click
  var enviando = false;
  // if(suma_total==40)
  if(total1==10 && total2==10 && total3==10 && total4==10)
  {
    // return true;
    //validacion del boton
    if (!enviando) {
      enviando= true;
      $('#boton_guardar').hide();
            swal({
                title:"", 
                text:"Se esta guardando las respuestas...",
                icon: "https://www.boasnotas.com/img/loading2.gif",
                buttons: false,      
                closeOnClickOutside: false,
                // timer: 30000,
                //icon: "success"
            });
            // cargar_spinner();
            return true;
          } else {
            // $('#botones').hide();
            // //Si llega hasta aca significa que pulsaron 2 veces el boton submit
            Swal.fire(
              'Correcto!',
              'El formulario ya se esta enviando!',
              'success'
              )
            return false;
          }
        }
        else
        {
    // alert('la suma debe de ser igual 10');
    // swal("Oops, Algo salió mal!!", "error");
    swal({
      title: "Verifique que la suma total sea igual a 10",
      text:  "Este mensaje se cerrara en 4 segundos",
      icon:  "error",
      timer: 4000, 
    });
    return false;
  }

}
</script>

