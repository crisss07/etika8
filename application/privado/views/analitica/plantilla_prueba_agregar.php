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
$prefijoE = $this->prefijoE;
$alineacionwc1='center';
$alineacionhc1='middle';
$alineacionwc2='left';
$alineacionhc2='middle';
?>
<div class="row justify-content-center">
	<div class="col-lg-6">
	<?php echo form_open_multipart($action); ?>
	<?php for($x=1;$x<=1;$x++){?>
	<!--
	<table id="form_admin" class="table table-bordered">
	-->
	<table class="table table-bordered">
		<tr bgcolor="#f4f4f4">
			<td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
				<?php $campo='nro';?>
				<?php echo form_label('Nro ', $prefijoE.$campo);?>
			</td>
			<td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
				<?php $campo='texto';?>
				<?php echo form_label('Pregunta ', $prefijoE.$campo);?>
			</td>
		</tr>
		<tr>
			<td align="center" valign="<?php echo $alineacionhc2;?>">
				<input type="hidden" name="<?php echo $prefijoE.'id'.$x;?>" value="<?php echo @$fila[$prefijoE.'id'];?>">
				<b><?php echo $x.'.-';?></b>            
			</td>
			<td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
				<?php    
					$campo='texto'.$x;
					$campo2='texto';
					echo form_input(array(
						'name' => $prefijoE.$campo,
						'id' => $prefijoE.$campo,
						'class' => 'input1',
						'autocomplete' => 'off',
						'size' => '60',
						'required' => 'required',
						'value' => @$fila[$prefijoE.$campo2]
					  ));
					  if(form_error($prefijoE.$campo))
						 echo '<div class="error">'.form_error($prefijoE.$campo).'</div>';
				?>
			</td>
		</tr>
			<tr>
			<td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
				<?php $campo='resp_a'.$x;?>
				<?php $campo2='resp_a';?>
				<?php echo form_label('A. ', $prefijoE.$campo);?>
			</td>
			<td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
				<?php                 
					echo form_input(array(
						'name' => $prefijoE.$campo,
						'id' => $prefijoE.$campo,
						'class' => 'input1',
						'autocomplete' => 'off',
						'size' => '60',
						'required' => 'required',
						'value' => @$fila[$prefijoE.$campo2]
					  ));

					  if(form_error($prefijoE.$campo))
						 echo '<div class="error">'.form_error($prefijoE.$campo).'</div>';
				?>
			</td>
		</tr>
		<tr>
			<td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
				<?php $campo='resp_b'.$x;?>
				<?php $campo2='resp_b';?>
				<?php echo form_label('B. ', $prefijoE.$campo);?>
			</td>
			<td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
				<?php                 
					echo form_input(array(
						'name' => $prefijoE.$campo,
						'id' => $prefijoE.$campo,
						'class' => 'input1',
						'autocomplete' => 'off',
						'size' => '60',
						'required' => 'required',
						'value' => @$fila[$prefijoE.$campo2]
					  ));

					  if(form_error($prefijoE.$campo))
						 echo '<div class="error">'.form_error($prefijoE.$campo).'</div>';
				?>
			</td>
		</tr>
		<tr>
			<td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
				<?php $campo='resp_c'.$x;?>
				<?php $campo2='resp_c';?>
				<?php echo form_label('C. ', $prefijoE.$campo);?>
			</td>
			<td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
				<?php                 
					echo form_input(array(
						'name' => $prefijoE.$campo,
						'id' => $prefijoE.$campo,
						'class' => 'input1',
						'autocomplete' => 'off',
						'size' => '60',
						'required' => 'required',
						'value' => @$fila[$prefijoE.$campo2]
					  ));

					  if(form_error($prefijoE.$campo))
						 echo '<div class="error">'.form_error($prefijoE.$campo).'</div>';
				?>
			</td>
		</tr>
	</table>
	<br>
	<br>
	<?php }?>  
	</div>
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