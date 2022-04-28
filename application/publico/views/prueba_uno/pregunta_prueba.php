

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
<?php
$prefijoE = $this->prefijoE;
$alineacionwc1='center';
$alineacionhc1='middle';
$alineacionwc2='left';
$alineacionhc2='middle';
?>
<div class="row justify-content-center">
	<div class="col-lg-6">
	<table class="table borderless" style="border:none;">
		<tr>
			<td class="tr-cab" align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc1;?>" colspan="2">
			<?php echo $datos2[$this->prefijoE.'texto']; ?>
			</td>
		</tr>
		<tr>
			<td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>" style="width:50px;">
			<input type="radio" name="respuesta" >
			</td>
			<td class="texto_label" align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc1;?>">
			<?php echo $datos2[$this->prefijoE.'resp_a']; ?>
			</td>
		</tr>
		<tr>
			<td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>" style="width:50px;">
			<input type="radio" name="respuesta" >
			</td>
			<td class="texto_label" align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc1;?>">
			<?php echo $datos2[$this->prefijoE.'resp_b']; ?>
			</td>
		</tr>
		<tr>
			<td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>" style="width:50px;">
			<input type="radio" name="respuesta" >
			</td>
			<td class="texto_label" align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc1;?>">
			<?php echo $datos2[$this->prefijoE.'resp_c']; ?>
			</td>
		</tr>
		
	</table>
	</div>
</div>

<a class="btn-etika btn" href="<?php echo $this->tool_entidad->sitio().'index.php/Evaluacion/texto_instructivo_uno/idg/'.$idgrupo.'/ev/'.$idev.'/idp/'.$id;?>" >Siguiente</a>

<br>
<br>


<style>
.borderless td, .borderless th {
    border: none;
	font-size:14px;
}
.tr-cab {
    border-radius: 0.5em;
	background-color:#f4f4f4;
	
}
</style>