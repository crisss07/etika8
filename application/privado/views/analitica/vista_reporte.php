<style>
.rojo{
	border:2px solid red;
}
.p-left{
	padding-left:20px;
}
</style>
<?php
$this->load->view('cabecera');
?>
<?php
@$prefijo=$this->prefijo;
$sitio=$this->tool_entidad->sitioindexpri();
$alineacionw='center';
$alineacionw1='left';
$alineacionh='middle';
$i=1;
?>
<div class="row p-left" >
    <table align="left" cellpadding="10">
        <tr>
            <td class="enlaces_add_edit" align="left">
                <?php echo anchor($this->controladorAtras, 'Atras', array('class' => 'enlace_retornar enlace_a1')); ?>
            </td>
			<td class="enlaces_add_edit" align="left">
                <form action="<?php echo $sitio.'Analitica_e/exportar_reporte'; ?>" method="post" id="form_listar_fsimple"> 
					<input type="image" src="<?php echo $this->tool_entidad->sitio(); ?>files/img/excel_exportar.jpg"  onclick="ExportToExcel('xlsx')" alt="submit"/>
				</form>
            </td>
        </tr>
    </table>
</div>
<div class="row p-left" >
    <table align="left" cellpadding="10">
        <tr>
            <td>
            <b>Plantilla:</b> <?php echo $titulo_platilla;?>
			<br>
            <b>Desde:</b> <?php echo $desde;?>
			<br>
            <b>Hasta:</b> <?php echo $hasta;?>
            </td>
        </tr>
    </table>
</div>
<div class="row p-left" >
	<div class="col-md-9">
		<table align="center" class="tabla_listado"  cellspacing="0" width="100%" id="tbl_exporttable_to_xls"  style="z-index:-1;">
			<tr class="cabecera_listado" style="z-index:-1;" >
				<td align="<?php echo $alineacionw; ?>" valign="">N°</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Tiempo</td>
				<td align="<?php echo $alineacionw; ?>" valign="">N° Intentos</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Nombres</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Apellidos</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Edad</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Género</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Profesión</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Donde estudio</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Pregunta 1</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Pregunta 2</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Pregunta 3</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Pregunta 4</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Pregunta 5</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Pregunta 6</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Pregunta 7</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Pregunta 8</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Pregunta 9</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Pregunta 10</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Pregunta 11</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Pregunta 12</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Pregunta 13</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Pregunta 14</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Pregunta 15</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Puntaje Bruto</td>
				<td align="<?php echo $alineacionw; ?>" valign="">Puntaje Baremo</td>
			</tr>
		<?php if(@$evaluados){ 
				foreach($evaluados as $value){
					foreach($value as $evd){
		?>	
			<tr>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo $i++; ?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo $evd['seg_tiempo_total'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo $evd['seg_intentos'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo $evd['nombres'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo $evd['apellidos'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo $evd['edad'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo $evd['sexo'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo $evd['profesion'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo $evd['lugar_estudios'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo @$evd['res_respuesta_1'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo @$evd['res_respuesta_2'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo @$evd['res_respuesta_3'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo @$evd['res_respuesta_4'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo @$evd['res_respuesta_5'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo @$evd['res_respuesta_6'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo @$evd['res_respuesta_7'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo @$evd['res_respuesta_8'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo @$evd['res_respuesta_9'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo @$evd['res_respuesta_10'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo @$evd['res_respuesta_11'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo @$evd['res_respuesta_12'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo @$evd['res_respuesta_13'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo @$evd['res_respuesta_14'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo @$evd['res_respuesta_15'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo $evd['punf'];?></td>
				<td align="<?php echo $alineacionw1; ?>" valign=""><?php echo $evd['punb'];?></td>
			</tr>
		<?php 
					}
				}
			}
		?>
		</table>
    </div>
</div>
<br>
<br>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

<script>
  /* function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('tbl_exporttable_to_xls');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "Respuestas" });
       
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('Plantilla.' + (type || 'xlsx')));
    } */
</script>