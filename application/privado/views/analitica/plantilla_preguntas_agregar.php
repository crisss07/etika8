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
<br>
<br>
<?php
$prefijoU = $this->prefijoU;
$alineacionwc1='center';
$alineacionhc1='middle';
$alineacionwc2='left';
$alineacionhc2='middle';
$j=0;
?>

<?php echo form_open_multipart($action, array('onsubmit'=>"return validar();")); ?>
<div class="row justify-content-center">

<?php foreach($array_p as $value){
	$x=$value;?>
	<div class="col-lg-6 col-md-6">
		<table class="table table-bordered">
			<tr bgcolor="#f4f4f4">
				<td  align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>" >
					<?php $campo='nro';?>
					<?php echo form_label('Nro', $prefijoU.$campo);?>
				</td>
				<td align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>" colspan="2">
					<?php $campo='texto';?>
					<?php echo form_label('Pregunta', $prefijoU.$campo);?>
				</td>
			</tr>
			<tr>
			<td align="center" valign="<?php echo $alineacionhc2;?>">
				<input type="hidden" name="<?php echo $prefijoU.'id'.$x;?>" value="<?php echo @$fila[$j][$prefijoU.'id'];?>" readonly >
				<b><?php echo $x.'.-';?></b>            
			</td>
			<td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>" colspan="2">
				<?php    
					$campo='texto'.$x;
					$campo2='texto';
					echo form_input(array(
						'name' => $prefijoU.$campo,
						'id' => $prefijoU.$campo,
						'class' => 'input1',
						'autocomplete' => 'off',
						'size' => '58',
						'required' => 'required',
						'value' => @$fila[$j][$prefijoU.$campo2]
					  ));
					  if(form_error($prefijoU.$campo))
						 echo '<div class="error">'.form_error($prefijoU.$campo).'</div>';
				?>
			</td>
		</tr>
		<tr>
			<td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
				<?php $campo='resp_a'.$x;?>
				<?php $campo2='resp_a';?>
				<?php echo form_label('A. ', $prefijoU.$campo);?>
			</td>
			<td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
				<?php                 
					echo form_input(array(
						'name' => $prefijoU.$campo,
						'id' => $prefijoU.$campo,
						'class' => 'input1',
						'autocomplete' => 'off',
						'size' => '50',
						'required' => 'required',
						'value' => @$fila[$j][$prefijoU.$campo2]
					  ));

					  if(form_error($prefijoU.$campo))
						 echo '<div class="error">'.form_error($prefijoU.$campo).'</div>';
				?>
			</td>
			<td align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
				<?php                
					$campo='correcta'.$x;		
				?>
				<input type="radio" name="<?php echo $prefijoU.$campo;?>" value="a" <?php echo @$fila[$j]['a']; ?>>
			</td>
		</tr>
		<tr>
			<td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
				<?php $campo='resp_b'.$x;?>
				<?php $campo2='resp_b';?>
				<?php echo form_label('B. ', $prefijoU.$campo);?>
			</td>
			<td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
				<?php                 
					echo form_input(array(
						'name' => $prefijoU.$campo,
						'id' => $prefijoU.$campo,
						'class' => 'input1',
						'autocomplete' => 'off',
						'size' => '50',
						'required' => 'required',
						'value' => @$fila[$j][$prefijoU.$campo2]
					  ));

					  if(form_error($prefijoU.$campo))
						 echo '<div class="error">'.form_error($prefijoU.$campo).'</div>';
				?>
			</td>
			<td align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
				<?php                
					$campo='correcta'.$x;		
				?>
				<input type="radio" name="<?php echo $prefijoU.$campo;?>" value="b" <?php echo @$fila[$j]['b']; ?>>
			</td>
		</tr>
		<tr>
			<td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
				<?php $campo='resp_c'.$x;?>
				<?php $campo2='resp_c';?>
				<?php echo form_label('C. ', $prefijoU.$campo);?>
			</td>
			<td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
				<?php                 
					echo form_input(array(
						'name' => $prefijoU.$campo,
						'id' => $prefijoU.$campo,
						'class' => 'input1',
						'autocomplete' => 'off',
						'size' => '50',
						'required' => 'required',
						'value' => @$fila[$j][$prefijoU.$campo2]
					  ));

					  if(form_error($prefijoU.$campo))
						 echo '<div class="error">'.form_error($prefijoU.$campo).'</div>';
				?>
			</td>
			<td align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
				<?php                
					$campo='correcta'.$x;		
				?>
				<input type="radio" name="<?php echo $prefijoU.$campo;?>" value="c" <?php echo @$fila[$j]['c']; ?>>
			</td>
		</tr>
		<tr>
			<td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>" colspan="2">
				<div class="alerta-p1" id="<?php echo 'msj'.$x;?>" style="">
				Debe seleccionar una respuesta correcta en esta pregunta.
				</div>
			</td>
			<td align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>" style="padding:5px;margin:0;">
			<span>Correcta</span>
			</td>
		</tr>
		</table>
		<br>
	</div>
<?php 
	$j++;
	}
?>

</div>
<?php
if($editar){
    echo form_submit('enviar', 'Guardar', 'class="btn-etika btn"');
}else{
    //echo form_submit('enviar', 'Atras', 'class="btn danger"');    
    echo form_submit('enviar', 'Siguiente', 'class="btn-etika btn"');
}
?>
<?php echo form_close() ?>
<br>
<br>
<style>
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
	var inicio = <?php echo json_encode($array_p[0]);?>;
	var fin = <?php echo json_encode(end($array_p));?>;
	var prefijoU = 'pre_uno_correcta';
	var c2 = 0;
	for (var x = inicio; x <= fin; x++) {
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
		return true;
	}else{
		// alert('NINGUNO SELECCIONADOS');
		return false;
	}
		
            
			
		

}
</script>