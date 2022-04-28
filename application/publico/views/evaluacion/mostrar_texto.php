<div class="row">
    <div class="col-md-12" align="right">
      <a href="<?php echo $this->tool_entidad->sitio();?>index.php/ninicio">Volver a Inicio</a>
    </div>
</div>
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

<?php echo form_open_multipart($action); ?>
<div class="row justify-content-center justify-content-md-around">
    <div class="col-md-9 text-left">
		<?php
		echo $fila['texto'];
		?>
	</div>
	<div class="col-md-9">
		<input name="enviar"  class="btn btn-etika" type="submit" value="<?php echo $boton; ?>"/>
	</div>
</div>
<?php echo form_close() ?>
