
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
<div class="row justify-content-center justify-content-md-around">
    <div class="col-md-9 text-left titulo_postulaciones" >
	A continuación se indica la(s) encuesta(s)/cuestionario(s) que debe responder.
	<ul>
		<li>
		La(s) encuesta(s) tiene(n) una sección de instrucciones y otra de preguntas, así como tiempos específicos de llenado.
		</li>
		<li>
		Tiene la opción de cancelar y salir de la encuesta/cuestionario en la sección de instrucciones.
		</li>
		<li>
		Luego de la sección de instrucciones, y cuando ingrese a la sección de preguntas debe concluir todo el llenado.
		</li>
		<li>
		Desde el enlace que recibió en su correo electrónico puede volver a ingresar las veces que requiera.
		</li>
	</ul>
	</div>
</div>
