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

<a class="btn-etika btn" href="<?php echo $this->tool_entidad->sitio().'admin.php/'.$this->controlador.'vista_instructivo_plantilla_uno/'.$id;?>" >Siguiente</a>

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