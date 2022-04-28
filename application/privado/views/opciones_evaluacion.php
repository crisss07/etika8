<?php
	// print_r($o_evaluacion);
?>
<table width="100%">
	<tr>
		<td>
			<table align="center" width="100%">
				<tr>
					<td class="enlaces_add_edit" align="left" width="100%">
					  <?php 
					  if(@$o_evaluacion['e_nuevo']){
					  echo anchor($o_evaluacion['controlador'].$o_evaluacion['e_nuevo'],'Nuevo',array('class' =>'enlace_nuevo enlace_a1')); 
					  }?>&nbsp;&nbsp;
					  <?php
					  if(@$o_evaluacion['e_listado']){
					  echo anchor($o_evaluacion['controlador'].$o_evaluacion['e_listado'],'Listado',array('class' =>'enlace_listar enlace_a1'));
					  }
					  ?>
					  &nbsp;&nbsp;
					</td>
				</tr>
			</table>
		</td>
		<td align="right">
        <!-- ini combo buscar -->
        
        <!-- fin combo buscar -->
      </td>
    </tr>
</table>
<br>