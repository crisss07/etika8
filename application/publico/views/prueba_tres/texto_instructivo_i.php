
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
            </div>
        </div>
    </div>
</div>
 <?php
$this->load->view('cabecera');
?>
<br>
<br>

<?php echo form_open_multipart('Prueba_tres/preguntas_prueba/'.$pla_id.'/'.$id_grupo.'/'.$ideval); ?>
<div class="row justify-content-center justify-content-md-around">
    <div class="col-md-9 text-left">
		<?php  echo $texto;?>
	</div>
	
</div>
<p></p>
<div class="row justify-content-center justify-content-md-around">
    <div class="col-md-9">
         <button type="submit" class="btn-etika btn" id="guardar" >Siguiente</button>
    </div>
</div>
</form>
