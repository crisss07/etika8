<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<style>
  *{box-sizing:border-box;margin:0;padding:0;}

.cronometro{
    width:200px;
    height:100px;
    left:50%;
    position:absolute;
    margin-top:-20px;
    margin-left:-100px;
    text-align:center;
	padding-top:10px;
	padding-bottom:10px;
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
function guardar_tiempo(hora,min,seg){
  var id_pla='<?php echo $idp; ?>';
  var id_grupo='<?php echo $idgrupo; ?>';
  var id_eval='<?php echo $idev; ?>';
    // console.log(hora,min,seg,id_eval,id_grupo,id_pla);
    console.log(hora,min,seg);
  $.ajax({
    url: '<?php echo base_url();?>index.php/Prueba_uno/actualizar_tiempo',
    type: 'post',
    data: {id_pla:id_pla,id_grupo:id_grupo,id_eval:id_eval,hora:hora,min:min,seg:seg},
    dataType: "json",
    success: function(data){ 
      console.log(data.msj);
      // alert('paso por aca');
    }
  });
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
<div class="row">
    <div class="col-md-12" align="right">
      <a href="<?php echo $this->tool_entidad->sitio();?>index.php/ninicio">Volver a Inicio</a>
    </div>
</div>
 <div class="row justify-content-center justify-content-md-around">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 text-left">
                <span style="color:#000000; font-weight: bold;" >USUARIO: </span> <span style="color:#000000; font-weight: normal;" ><strong><?php echo $_SESSION[$this->presession . 'usuario']; ?></strong></span><br/>
                <span style="color:#000000; font-weight: bold;" >NOMBRE: </span> <span style="color:#000000; font-weight: normal;" ><strong><?php echo strtoupper($_SESSION[$this->presession . 'nombre']); ?></strong></span>
				<?php
				$this->load->view('cabecera');
				?>
            </div>
			<div class="col-md-6 text-right">
				<div class="cronometro">
					<div id="hms"></div>
				</div>
            </div>
        </div>
    </div>
</div>
 
<br>
<br>
<br>
<?php
$prefijoE = $this->prefijoE;
$alineacionwc1='center';
$alineacionhc1='middle';
$alineacionwc2='left';
$alineacionhc2='middle';
// $action='hola';
?>
<?php echo form_open_multipart($action, array('onsubmit'=>"return validar();")); ?>
<input type="hidden" id="tiempo" name="tiempo">
<input type="hidden" name="idgrupo" value="<?php echo $idgrupo;?>" readonly >
<input type="hidden" name="idev" value="<?php echo $idev;?>" readonly >
<input type="hidden" name="idp" value="<?php echo $idp;?>" readonly >
<div class="row justify-content-center">
<?php 
	$preg_i = array("a", "b", "c");
	foreach($array_p as $value){
	shuffle($preg_i);
	$x=$value;?>
	<input type="hidden" name="<?php echo 'idpreg_'.$value[$this->prefijoU.'nro'];?>" value="<?php echo $value[$this->prefijoU.'id'];?>" readonly >
	<div class="col-lg-5">
	<table class="table borderless" style="border:none;">
		<tr>
			<td class="tr-cab" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>" style="width:50px;">
			<?php echo $value[$this->prefijoU.'nro'].'.- ';?>
			</td>
			<td class="tr-cab2" align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc1;?>">
			<?php echo $value[$this->prefijoU.'texto']; ?>
			</td>
		</tr>
		<tr>
			<td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>" style="width:50px;">
			<input type="radio" name="<?php echo 'respuesta_'.$value[$this->prefijoU.'nro'];?>" value="<?php echo $value[$this->prefijoU.'resp_'.$preg_i[0]]; ?>">
			</td>
			<td class="texto_label" align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc1;?>">
			<?php echo $value[$this->prefijoU.'resp_'.$preg_i[0]]; ?>
			</td>
		</tr>
		<tr>
			<td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>" style="width:50px;">
			<input type="radio" name="<?php echo 'respuesta_'.$value[$this->prefijoU.'nro'];?>" value="<?php echo $value[$this->prefijoU.'resp_'.$preg_i[1]]; ?>">
			</td>
			<td class="texto_label" align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc1;?>">
			<?php echo $value[$this->prefijoU.'resp_'.$preg_i[1]]; ?>
			</td>
		</tr>
		<tr>
			<td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>" style="width:50px;">
			<input type="radio" name="<?php echo 'respuesta_'.$value[$this->prefijoU.'nro'];?>" value="<?php echo $value[$this->prefijoU.'resp_'.$preg_i[2]]; ?>">
			</td>
			<td class="texto_label" align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc1;?>">
			<?php echo $value[$this->prefijoU.'resp_'.$preg_i[2]]; ?>
			</td>
		</tr>
		<tr>
			<td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>" colspan="2">
			<div class="alerta-p1" id="<?php echo 'msj'.$value[$this->prefijoU.'nro'];?>" style="">
				Debe seleccionar una respuesta para esta pregunta.
				</div>
			</td>
		</tr>
	</table>
	<br>
	</div>
<?php 
$fin=$value[$this->prefijoU.'nro'];
}
?>
</div>
<!-- <input name="enviar"  class="btn btn-etika" type="submit" id="guardar" value="Guardar"/> -->
<button type="submit" class="btn btn-etika" id="boton_guardar" >
	Guardar
</button>
<?php echo form_close() ?>

<br>
<br>
<style>
.borderless td, .borderless th {
    border: none;
	font-size:17px;
}
.tr-cab {
	border-bottom-left-radius: 0.5em;
	border-top-left-radius: 0.5em;
	background-color:#f4f4f4;
	
}
.tr-cab2 {
	border-bottom-right-radius: 0.5em;
	border-top-right-radius: 0.5em;
	background-color:#f4f4f4;
	
}
.rojo{
	border:2px solid red;
}
.alerta-p1{
	color:red;font-size:12px;
	display:none;
}
</style>
<script>
function validar()
{
	var inicio = <?php echo json_encode($array_p[0][$this->prefijoU.'nro']);?>;
	var fin = <?php echo json_encode($fin);?>;
	var prefijoU = 'respuesta_';
	var c2 = 0;
	var x=0;
	var enviando = false;//se agrego para no guardar 2 veces la pregunta
	var ruta_gif='<?php echo $this->tool_entidad->rutaimg().'imagen_cargando.gif'; ?>';
	console.log(ruta_gif);
	
	for (x =  parseInt(inicio); x <= parseInt(fin); x++) {
		var c = 0;
		var mensaje = document.getElementById('msj' + x);
		let pregunta = document.getElementsByName(prefijoU + x);
		pregunta.forEach((rate) => {
            if (rate.checked) {
                // alert(`You rated: ${rate.value}`);
				c++;
            }
        })
		if(c==0){
			mensaje.style.display='block';
			c2++;
		}else{
			mensaje.style.display='none';
		}
	}
	
	if(c2==0){
		// alert('TODOS SELECCIONADOS');
		// return true;
		//validacion que ya se hizo el click en el boton guardar
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
        //fin devalidacion que ya se hizo el click en el boton guardar

	}else{
		// alert('NINGUNO SELECCIONADOS');
		return false;
	}
		
            
			
		

}
</script>
