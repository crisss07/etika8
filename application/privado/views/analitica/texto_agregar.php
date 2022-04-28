

<table align="center" width="100%">
  <tr>
    <td class="enlaces_add_edit" align="left" width="100%">
      <p></p><p></p>
      <?php
      if(count($cabecera))
      {
        ?>
        <table align="center">
          <tr>
            <td>
             <?php
             if(!@$this->notitulo)
             {
               ?>
               
              <?php
              if($cabecera['titulo'])
              {
                ?>
                <span class="cabecera_titulo"><?php echo $cabecera['titulo'];?></span>
                <span class="flecha2">&rarr;</span>
                <span class="cabecera_accion"> <?php echo $cabecera['accion'];?></span>
                <?php
              }


            }
            ?>

          </td>
        </tr>
        <tr><td colspan="2"><div class="linea1"></div></td></tr>
      </table>
      <?php
    }
    ?>
  </td>

</tr>
</table>



<?php

$alineacionw='center';
$alineacionh='middle';

?>

<br>
<br>

<?php echo form_open_multipart($action); ?>   
<div class="row justify-content-center">
	  <div class="col-md-6" align="left">
	  
		<p>Contenido:</p>
		<input type="hidden" value="<?php echo $id; ?>" name="id">
		<input type="hidden" value="<?php echo $tipo; ?>" name="tipo">
		<?php                 
			// $value=$this->prefijo.'texto_instructivo_prueba';
			$value=$texto;
			echo form_textarea($this->prefijo.$campo,$value,array(
			'rows' => '40',
			'cols' => '70',
			'class'=>'tinymce',
			'value' =>''
			));
		?>
	  
		
	  </div>
</div>

<p></p>
<div class="row" align="center" >
  <div class="col-md-12">
    <button type="submit" class="btn-etika btn" id="guardar" ><?php echo $boton; ?></button>
  </div>  
</div>
</form>

<br>
<br>

