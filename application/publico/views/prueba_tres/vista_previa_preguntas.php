
<style>
  *{box-sizing:border-box;margin:0;padding:0;}
/*@font-face{
    font-family:alarm;
    src:url(alarm.ttf);
}*/
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
    cronometrar();
}


function init(){
    // document.querySelector(".start").addEventListener("click",cronometrar);
    // document.querySelector(".stop").addEventListener("click",parar);
    // document.querySelector(".reiniciar").addEventListener("click",reiniciar);
    h = <?php echo $tc[0]; ?>;
    m = <?php echo $tc[1]; ?>;
    s = <?php echo $tc[2]; ?>; 
    document.getElementById("hms").innerHTML="00:00:00";
    // document.getElementById("hms").hidden();
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
    url: '<?php echo base_url();?>index.php/Prueba_tres/actualizar_tiempo',
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
 <div class="row justify-content-center justify-content-md-around">
    <div class="col-md-8" align="left">
        
                <span style="color:#000000; font-weight: bold;" >USUARIO: </span> <span style="color:#000000; font-weight: normal;" ><strong><?php echo $_SESSION[$this->presession . 'usuario']; ?></strong></span><br/>
                <span style="color:#000000; font-weight: bold;" >NOMBRE: </span> <span style="color:#000000; font-weight: normal;" ><strong><?php echo strtoupper($_SESSION[$this->presession . 'nombre']); ?></strong></span>
            
    </div>
     <div class="col-md-4">
        <div id="hms">      
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
<!-- <button onclick="guardar_tiempo('9','3','5')">
  hola
</button> -->

<?php echo form_open_multipart('Prueba_tres/guardar_preguntas/',array('onsubmit'=>"return checkSubmit();")); ?>   
<input type="hidden" value="<?php echo $id_pla; ?>" name="id_pla">
<input type="hidden" value="<?php echo $id_grupo; ?>" name="id_grupo">
<input type="hidden" value="<?php echo $idev; ?>" name="idev">
<input type="hidden" value="<?php echo $num_ini; ?>" name="num_ini">
<input type="hidden" value="<?php echo $num_fin; ?>" name="num_fin">
<input type="hidden" id="tiempo" name="tiempo">

<!-- preguntas -->
<div class="row justify-content-center">

  <div class="col-md-10">
    <table class="table table-bordered">
      <tr bgcolor="#f4f4f4">
        <td class="texto_label" style="width:10px;">  <b>Nro</b> </td>
        <td><b>Pregunta</b></td>
        <!-- <td><b>Factor</b></td>
        <td><b>IN</b></td>
        <td><b>AQ</b></td> -->
      </tr>
      <?php $j=$num_ini; ?>
      <?php for ($i=0; $i <10; $i++) { ?>
        <!-- p1 -->
      
      <tr bgcolor="#f4f4f4">
        <td><?php  echo $j; ?>.-</td>
        <td><?php echo $datos[$i]['pre_texto']; ?></td>
        <!-- <td><?php echo $datos[$i]['letra']; ?>       -->
        </td>

        <?php $valor_in=0; ?>   
        <?php if ($datos[$i]['valor_in']==1): ?>
              <?php $valor_in=1;?>
        <?php endif ?>  
        <?php $valor_aq=0; ?>   
        <?php if ($datos[$i]['aq']==1): ?>
              <?php $valor_aq=1;?>
        <?php endif ?>   

        <!-- <td valign="middle" align="center">
        <?php $valor_check=""; ?>   
        <?php if ($datos[$i]['valor_in']==1): ?>
              <?php $valor_check="checked";?>
        <?php endif ?>       
          <input type="checkbox" class="" name="in<?php echo $i; ?>" <?php echo $valor_check; ?> disabled>          
        
        </td> -->
        <!-- <td>
          <?php $valor_check=""; ?>   
        <?php if ($datos[$i]['aq']==1): ?>
              <?php $valor_check="checked";?>
        <?php endif ?>   
          <input type="checkbox" class="" name="aq<?php echo $i; ?>" <?php echo $valor_check; ?>  disabled>          
        </td> -->
      </tr>
      <tr>
        <td>
          

            

          <input type="radio" id="customRadio1" name="resp<?php echo $j; ?>" value="<?php echo '1,'.$datos[$i]['valor_a'].','.$datos[$i]['letra'].','.$datos[$i]['factor_id'].',0,'.$valor_aq; ?>" required></td>
        <td><?php echo $datos[$i]['pre_resp_a']; ?></td>
        <!-- <td><?php echo $datos[$i]['valor_a']; ?>
          
        </td> -->
        

      </tr>
      <tr>
        <td><input type="radio" id="customRadio1" name="resp<?php echo $j; ?>" value="<?php echo '2,'.$datos[$i]['valor_b'].','.$datos[$i]['letra'].','.$datos[$i]['factor_id'].','.$valor_in.',0'; ?>" required></td>
        <td><?php echo $datos[$i]['pre_resp_b']; ?></td>
        <!-- <td><?php echo $datos[$i]['valor_b']; ?></td> -->
      </tr>
      <tr>
        <td><input type="radio" id="customRadio1" name="resp<?php echo $j; ?>" value="<?php echo '3,'.$datos[$i]['valor_c'].','.$datos[$i]['letra'].','.$datos[$i]['factor_id'].',0,0'; ?>" required></td>
        <td><?php echo $datos[$i]['pre_resp_c']; ?></td>
        <!-- <td><?php echo $datos[$i]['valor_c']; ?></td> -->
      </tr> 

          

      <?php $j++; ?>      
      <?php }?>
      
      
      


    </table>
  </div>
  
</div>
<!-- fin preguntas -->

<p></p>
<div class="row" align="center" >
  <div class="col-md-12">
    <?php if ($num_fin==170): ?>
      <button type="submit" class="btn-etika btn" id="boton_guardar" >Terminar</button>
    <?php else: ?>
      <button type="submit" class="btn-etika btn" id="boton_guardar" >Siguientes Preguntas</button>    
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

<!-- para evitar el doble click -->
<script type="text/javascript">
    var enviando = false; //Obligaremos a entrar el if en el primer submit

      var ruta_gif='<?php echo $this->tool_entidad->rutaimg().'imagen_cargando.gif'; ?>';
  console.log(ruta_gif);


            //  swal({
            //     title:"", 
            //     text:"Se esta guardando las respuestas...",
            //     icon: "https://www.boasnotas.com/img/loading2.gif",
            //     buttons: false,      
            //     closeOnClickOutside: false,
            //     // timer: 30000,
            //     //icon: "success"
            // });
    
    function checkSubmit() {
        if (!enviando) {
            enviando= true;
            //$('#boton_sig').hide();
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
</script>

