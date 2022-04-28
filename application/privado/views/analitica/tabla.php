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
              if($cabecera['titulo'])
              {
                ?>
                <span class="cabecera_titulo"><?php echo $cabecera['titulo'];?></span>
                <span class="flecha2">&rarr;</span>
                <span class="cabecera_accion"> <?php echo $cabecera['accion'];?></span>
                <?php
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
<table width="100%"><tr><td>
        <table align="center" width="100%">
          <tr>
            <td class="enlaces_add_edit" align="left" width="100%">

                <?php echo anchor('Plantilla/listar','Listado Plantillas',array('class' =>'enlace_listar enlace_a1')); ?>
              &nbsp;&nbsp;
              <?php echo anchor('Plantilla/listar', 'Cancelar', array('class' => 'enlace_cancelar enlace_a1')); ?>                   
            </td>
          </tr>
        </table>


      </td><td align="right">
        <!-- ini combo buscar -->
        
        <!-- fin combo buscar -->
      </td>
    </tr>
  </table>
<br>
<br>
<?php
$alineacionwc1='center';
$alineacionhc1='middle';
$alineacionwc2='left';
$alineacionhc2='middle';
?>

<?php echo form_open_multipart($action); ?>
<div class="row justify-content-center">
<div class="col-lg-12 col-md-12">
<table class="table table-bordered">
	<tr bgcolor="#f4f4f4">
		<td  align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>" >
		<?php //echo form_label('Nro Pregunta');?>
		<span><b>Puntaje</b></span>
		</td>
	<?php foreach($array_tabla as $value){
	$x=$value;?>
		<td align="center" valign="<?php echo $alineacionhc1;?>">
			<input type="hidden" name="<?php echo 'nro'.$x;?>" value="<?php echo $x;?>">
				<b><?php echo $x;?></b>            
		</td>
		
	
		
<?php } ?>
	</tr>
	<tr>
		<td align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>"  bgcolor="#f4f4f4">
		<?php //echo form_label('Valor equivalente');?>
		<span><b>Valor equivalente</b></span>
		</td>
	<?php foreach($array_tabla as $value){
	$x=$value;?>
		<td width="10px" align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
				<?php    
					$campo=$x;
					echo form_input(array(
						'name' => $prefijoT.$campo,
						'id' => $prefijoT.$campo,
						'type' => 'number',
						'autocomplete' => 'off',
						'value' => @$fila[$x],
						'min' => '1',
						'max' => '10',
						'onchange' => 'verificar(this.value,id)',
						'required' => 'required',
						'style' => 'width:50px;'
					  ));
					  if(form_error($prefijoT.$campo))
						 echo '<div class="error">'.form_error($prefijoT.$campo).'</div>';
				?>
		</td>
	
		
<?php } ?>
	</tr>
</table>
		<br>
	</div>
</div>
<?php
if($editar){
    echo form_submit('enviar', 'Guardar', 'class="btn-etika btn"');
}else{
    //echo form_submit('enviar', 'Atras', 'class="btn danger"');    
    echo form_submit('enviar', 'Guardar y finalizar', 'class="btn-etika btn"');
}
?>
<?php echo form_close() ?>
<br>
<br>
<script>
function verificar(value,idcampo)
{
	if(value<1 || value>10){
		alert('Debe ingresar un número mayor a 0 y menor o igual a 10');
		var campo = document.getElementById(idcampo);
		campo.value = '';
	}
}
</script>