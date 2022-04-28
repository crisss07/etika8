
<style>
  *{box-sizing:border-box;margin:0;padding:0;}
@font-face{
    font-family:alarm;
    src:url(alarm.ttf);
}
.cronometro{
    width:200px;
    height:100px;
    top:50%;
    left:50%;
    position:absolute;
    margin-top:-50px;
    margin-left:-100px;
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
    h = 0;
    m = 0;
    s = 0;
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
}
function parar(){
    clearInterval(id);
    document.querySelector(".start").addEventListener("click",cronometrar);

}
function reiniciar(){
    clearInterval(id);
    document.getElementById("hms").innerHTML="00:00:00";
    h=0;m=0;s=0;
    document.querySelector(".start").addEventListener("click",cronometrar);
}
</script>
<br>
 <div class="row justify-content-center justify-content-md-around">
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-6 text-left">
                <span style="color:#000000; font-weight: bold;" >USUARIO: </span> <span style="color:#000000; font-weight: normal;" ><strong><?php echo $_SESSION[$this->presession . 'usuario']; ?></strong></span><br/>
                <span style="color:#000000; font-weight: bold;" >NOMBRE: </span> <span style="color:#000000; font-weight: normal;" ><strong><?php echo strtoupper($_SESSION[$this->presession . 'nombre']); ?></strong></span>
            </div>
        </div>
    </div>
     <div class="col-md-4">
        <div class="row">
            <div class="col-md-6 text-left">
                <div class="cronometro">
    <div id="hms"></div>


   <!--  <div class="boton start"></div>        
    <div class="boton stop"></div>
    <div class="boton reiniciar"></div> -->
    </div>

            </div>
        </div>
    </div>
</div>
 <?php
$this->load->view('cabecera');
?>
<br>
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
<div class="row" style="font-size:14px;">

  <div class="col-md-12" >
    <?php for ($i=0; $i <16 ; $i++) { ?>
      
      <?php if ($i==4): ?>
        <?php $i=8; ?>
      <?php endif ?>
      <?php if ($i==12): ?>
        <?php break; ?>
      <?php endif ?>
      
      <?php if ($grupos==$k): ?>
        <div class="row">
          <div class="col-md-6" align="center">
           <b> <h4> GRUPO <?php echo $gi; ?>
         </h4></b>
       </div>
       <?php $grupos=$grupos+4; 
       $gi++;

       ?> 
       <div class="col-md-6" align="center">
         <b> <h4> GRUPO <?php echo $gi; ?>
       </h4></b>
     </div>
     <?php $gi++; ?>

   </div>








 <?php endif ?>
 <?php $k++; ?>

 <div class="row">
  <div class="col-md-6">

    <div class="row">
     <div class="col-md-2">    

     <?php if ($i<8): ?>
         <input tabindex="<?php echo $data[$i]['pre_nro']; ?>" type="number" class="input1" maxlength="1" size="1" min="0" step="1" pattern="^[-/d]/d*$"  max="9" required="" name="p<?php echo $data[$i]['pre_nro'];?>" id="p<?php echo $pi;?>" style="width: 60px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  onchange="sumarNum1(this.value)" > 
     <?php else: ?>
         <input tabindex="<?php echo $data[$i]['pre_nro']; ?>" type="number" class="input1" maxlength="1" size="1" min="0" step="1" pattern="^[-/d]/d*$"  max="9" required="" name="p<?php echo $data[$i]['pre_nro'];?>" id="p<?php echo $pi;?>" style="width: 60px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  onchange="sumarNum3(this.value)" > 
             
           <?php endif ?>      
   
      <?php $pi++; ?>
    </div>
    <div class="col-md-10" align="left">
      <?php echo $data[$i]['pre_nro'].'.-'. $data[$i]['pre_texto']; ?>
    </div>
  </div>

</div>
<div class="col-md-6">
 <div class="row">
   <div class="col-md-2">  

   <?php if ($i<8): ?>
       <input tabindex="<?php echo $data[$i+4]['pre_nro']; ?>" type="number" class="input1" maxlength="1" size="1" min="0" step="1" pattern="^[-/d]/d*$"  max="9" required="" name="p<?php echo $data[$i+4]['pre_nro'];?>" id="p<?php echo $pi;?>" style="width: 60px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  onchange="sumarNum2(this.value)" >
   <?php else: ?>
                <input tabindex="<?php echo $data[$i+4]['pre_nro']; ?>" type="number" class="input1" maxlength="1" size="1" min="0" step="1" pattern="^[-/d]/d*$"  max="9" required="" name="p<?php echo $data[$i+4]['pre_nro'];?>" id="p<?php echo $pi;?>" style="width: 60px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  onchange="sumarNum4(this.value)" >
           <?php endif ?>        
 
    <?php $pi++; ?>
  </div>
  <div class="col-md-10" align="left">
    <?php echo $data[$i+4]['pre_nro'].'.-'. $data[$i+4]['pre_texto']; ?>

  </div>
</div>

</div>



</div>
<?php $pos_total=$i+1;
?>
<p></p>
<?php if (($pos_total % 4) == 0): ?>
  <div class="row">
    <div class="col-md-6">
      <div class="row">

        <div class="col-md-2">

         <input type="number" class="input1" maxlength="1" size="1" min="0" step="1" pattern="^[-/d]/d*$"  max="9" required="" id="suma<?php echo $i-2;?>" style="width: 60px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  readonly>
       </div>
       <div class="col-md-10" align="left">
        Total &nbsp;
        <code id="validsuma<?php echo $i-2; ?>"></code>
      </div>

    </div>

  </div>
  <div class="col-md-6">
    <div class="row">

      <div class="col-md-2">

       <input type="number" class="input1" maxlength="1" size="1" min="0" step="1" pattern="^[-/d]/d*$"  max="9" required="" id="suma<?php echo $i-1;?>" style="width: 60px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  readonly>
     </div>
     <div class="col-md-10" align="left">
      Total &nbsp;
      <code id="validsuma<?php echo $i-1; ?>"></code>
    </div>

  </div>

</div>

</div>
<?php endif ?>
<p></p>     
<?php } ?>
</div>
</div>

<p></p>
<div class="row" align="center" >
  <div class="col-md-12">
    <?php if ($num_fin==80): ?>
      <button type="submit" class="btn-etika btn" id="guardar" >Terminar</button>
    <?php else: ?>
      <button type="submit" class="btn-etika btn" id="guardar" >Siguientes Preguntas</button>    
    <?php endif ?>

    

  </div>  
</div>
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
    val2=$("#p2").val();
    val3=$("#p4").val();
    val4=$("#p6").val();
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
    val1=$("#p1").val();
    val2=$("#p3").val();
    val3=$("#p5").val();
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
    val2=$("#p10").val();
    val3=$("#p12").val();
    val4=$("#p14").val();
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
      $("#validsuma9").html(valor); 
    }else{
      if (total<10) {
        $("#validsuma9").html(valor); 
      }else{
        $("#validsuma9").html(''); 
      }     
      
    }

    
    // $total= total + parseInt(val1);
    console.log(total);
    $('#suma9').val(total);

  }
</script>

<script>
  function sumarNum4(n1) {
    total=0;
    val1=$("#p9").val();
    val2=$("#p11").val();
    val3=$("#p13").val();
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
      $("#validsuma10").html(valor); 
    }else{
      if (total<10) {
        $("#validsuma10").html(valor); 
      }else{
        $("#validsuma10").html(''); 
      }     
      
    }

    
    // $total= total + parseInt(val1);
    console.log(total);
    $('#suma10').val(total);

  }
</script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
function validar()
{
  var total1=$('#suma1').val();
  var total2=$('#suma2').val();
  var total3=$('#suma9').val();
  var total4=$('#suma10').val();
  var suma_total=parseInt(total1)+parseInt(total2)+parseInt(total3)+parseInt(total4);
  if(suma_total==40)
  {
    return true;
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

