
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
    left:50%;
    position:absolute;
    margin-top:-50px;
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
    guardar_form(mAux,sAux);
    console.log(mAux);
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
    url: '<?php echo base_url();?>index.php/Prueba_cinco/actualizar_tiempo',
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

function guardar_form(min,seg){
    var minutos=min;
    var segundos=seg;

    var minutos_maximo='<?php echo $tiempo_maximo; ?>';
    // minutos_maximo=minutos_maximo-1;
    console.log('min_max '+minutos_maximo+'--');

    if (minutos==minutos_maximo && seg==00) {
        swal({
  title: "El tiempo limite se termino",
  text: "Esta ventana se cerrara en 3 segundos",
  icon: "success",
  buttons: false,
  timer: 3000
});
         setTimeout(clickbutton, 3000);
    }
}

function clickbutton() {
    // simulamos el click del mouse en el boton del formulario
    console.log('ingreso acaa a guardar boton');
    // $("#guardar_form").click();
      $("#boton_guardar").click();
  }

function reiniciar(){
    clearInterval(id);
    document.getElementById("hms").innerHTML="00:00:00";
    h=0;m=0;s=0;
    document.querySelector(".start").addEventListener("click",cronometrar);
}
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<br>

<!-- <div class="row">
    <div class="col-md-12" align="right">
      <a href="?php echo $this->tool_entidad->sitio();?>index.php/ninicio">Volver a Inicio</a>
    </div>
</div> -->
<!--  -->
 <div class="row">
    <div class="col-md-8" align="left">
        
            
                <span style="color:#000000; font-weight: bold;" >USUARIO: </span> <span style="color:#000000; font-weight: normal;" ><strong><?php echo $_SESSION[$this->presession . 'usuario']; ?></strong></span><br/>
                <span style="color:#000000; font-weight: bold;" >NOMBRE: </span> <span style="color:#000000; font-weight: normal;" ><strong><?php echo strtoupper($_SESSION[$this->presession . 'nombre']); ?></strong></span>
                <?php
$this->load->view('cabecera');
?>
            
        
    </div>
    <div class="col-md-4 text-left">
                <div class="cronometro">
    <div id="hms"></div>


   <!--  <div class="boton start"></div>        
    <div class="boton stop"></div>
    <div class="boton reiniciar"></div> -->
    </div>

            </div>
     
</div>


 
<br>



<?php
$prefijo=$this->prefijo;

$alineacionw='center';
$alineacionh='middle';

?>

<!-- <div class="row " style="position: fixed;">
    <div class="col-md-10">
            <div class="my-fixed-item" id="fixedContainers">
                posisicon fija
            </div>
    </div>
</div> -->
<!-- inicio de las preguntas -->
<!-- id="fixedContainer" -->
<div class="row justify-content-center" id="fixedContainer">
  <div class="col-md-10" align="justify"> </div>
</div>
<!-- datos para el for -->
<style>
    #fixedContainer {
  position: block;
  
  left: 0;
  top: 0;
  right: 0;
  /*margin-left: -300px; /*half the width*/*/
}
</style>

<style>
    .table-fixed tbody{
        height: 230px;
        overflow:auto ;
        /*width: 100%;*/
    }
    .table-fixed thead,
    .table-fixed tbody,
    .table-fixed td,
    .table-fixed th{
        display:block ;
    }
    .table-fixed tbody td,
    .table-fixed thead > tr > th{
        float: left;
        border-bottom-width:0;
    }

</style>

<style>
    .header_fijo {
  width: 100%;
  table-layout: fixed;
  border-collapse: collapse;
}
/*.header_fijo thead {
  background-color: #333;
  color: #FDFDFD;
}*/
.header_fijo thead tr {
  display: block;
  position: relative;
}
.header_fijo tbody {
  display: block;
  overflow: auto;
  width: 100%;
  height: 300px;
}
</style>

<!-- contador regresivo -->

<!-- fin de contador regresivo -->



<?php echo form_open_multipart('Prueba_cinco/crear_preguntas/',array('onsubmit'=>"return checkSubmit();")); ?>   
<input type="hidden" value="<?php echo $id_pla; ?>" name="id_pla">
<input type="hidden" value="<?php echo $id_grupo; ?>" name="id_grupo">
<input type="hidden" value="<?php echo $idev; ?>" name="idev">

<input type="hidden" id="tiempo" name="tiempo">

<!-- preguntas -->


  


<div class="row">

  <div class="col-md-12">

    <!-- inicio preguntas -->

    <!-- <table class="table table-hover ">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table> -->


    <table class="table table-bordered header_fijo " > 
        <thead>
            <tr >
                <th colspan="7" style="font-weight:normal;">
                <?php echo $texto_instructivo; ?>
                </th>
            </tr>
            <tr bgcolor="#f4f4f4" style="width:100%;">
            <th style="width:30px;"><b>Nro</b></th>
            <th style="width:200px;" > <b> Cantidad </b></th>
            
            <th style="width:200px;"><b>Clase de seguro</b></th>
            <th style="width:200px;"><b>Fecha</b></th>
            <th style="width:40px;"><b>1</b></th>
            <th style="width:40px;"><b>2</b></th>
            <th style="width:40px;"><b>3</b></th>
          </tr>
        </thead>
        
        
        <tbody>
     <!--  <tr bgcolor="#f4f4f4" style="width:680px;">
        <td style="width:30px;"><b>Nro</b></td>
        <td style="width:200px;" > <b> Cantidad </b></td>
        
        <td style="width:200px;"><b>Clase de seguro</b></td>
        <td style="width:200px;"><b>Fecha</b></td>
        <td style="width:40px;"><b>1</b></td>
        <td style="width:40px;"><b>2</b></td>
        <td style="width:40px;"><b>3</b></td>
      </tr> -->
      
      
      <?php $i=1; ?>
    <?php for ($j=0; $j <count($datos); $j++) { ?>

      <tr width="100%">
        <td style="width:30px;"><b><?php echo $i; ?></b></td>
        <td class="texto_label" style="width:200px;">
          <?php echo $datos[$j]['cantidad']; ?>
        </td>
        
        <td style="width:200px;">
          <?php echo $datos[$j]['clase']; ?>
        </td>
        <td style="width:200px;">
          <?php echo $datos[$j]['fecha']; ?>
        </td>        
        <td style="width:40px;">          
          <input type="checkbox" class="" name="a<?php echo $i; ?>"  value="1" >          
        </td>
        
        <td style="width:40px;">
          <input type="checkbox" class="" name="b<?php echo $i; ?>"  value="1" >          
        </td>
        
        <td style="width:40px;">
          <input type="checkbox" class="" name="c<?php echo $i; ?>"  value="1" >          
        </td>
      </tr>
      <?php $i++; ?>

             
    <?php } ?>
    </tbody>
    </table>

    <!-- fin de preguntas -->
    
  </div>
  
</div>
<!-- fin preguntas -->

<p></p>
<div class="row" align="center" >
  <div class="col-md-12">    
      <button type="submit" class="btn-etika btn" id="boton_guardar" >Terminar</button>
  </div>  
</div>
</form>

<p></p><p></p>



  


<script type="text/javascript">
    var enviando = false; //Obligaremos a entrar el if en el primer submit
    
    function checkSubmit() {
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
