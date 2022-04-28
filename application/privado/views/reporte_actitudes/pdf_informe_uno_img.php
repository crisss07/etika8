<!doctype html>
	<html lang="es">


	<head>
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />    
		<title>Reporte</title>

		<style type="text/css">
		@page {
			margin-top: 1cm;
			margin-bottom: 0cm;
			margin-left: 1cm;
			margin-right: 1cm;
		}



		* {
			font-family: Verdana, Arial, sans-serif;
		}

		a {
			color: #fff;
			text-decoration: none;
		}

		table {
			font-size: x-small;

		}

		tfoot tr td {
			font-weight: bold;
			font-size: x-small;
		}

		.invoice table {
			margin: 0px;
		}

		.invoice h3 {
			margin-left: 18px;
		}

		.information {
			background-color: #60A7A6;
			color: #FFF;
		}

		.information .logo {
			margin: 5px;
		}

		.information table {
			padding: 10px;
		}

		.encabezado {
			padding: 0px;
			color: #000000;
		}
		.piedpagina {

			padding-top: 40px;
			padding-bottom: 50px;
			padding-left:  40px;
			padding-right:  40px;
		}
		.cuerpo {
			font-size: 12px;
			font-weight: bold;
		}
		.titulos_tabla {
			font-size: 16px;
			font-weight: bold;
		}
		.contenido_tabla {
			font-size: 11px;

		}
		.cuerpo_tabla {
			padding-left:  0px;
			
		}
		.bordes_td{
			/*border: 1px solid #4B4141;	*/
			
		}
		.bordes_td_dos{
			border-bottom: 1px solid #4B4141;	
			
		}
		.borde_tabla{
			border-collapse: collapse;
		}
	</style>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>


</head>
<body>



		
		<table width="100%">
			<tr >
				<td align="left" width="30%" > 
				<img width="100px" src="files/pdf/logo_etikaPdf.jpg" alt="logo">
				</td>
				<td align="center">
					<p></p>
			RASGOS DE PERSONALIDAD							
<br>
			PERFIL DE ESCALAS PRIMARIAS Y BIG 5	
				</td>
				<td></td>

			</tr>

		</table>
	







	<div class="invoice" >
		

		<table width="100%" class="cuerpo">        
			<tbody>
				<tr>
					<td align="left" >
						Nombre : <?php echo $postulante_datos->pos_nombre.' '.$postulante_datos->pos_apaterno.' '.$postulante_datos->pos_amaterno; ?>
					</td>
					<td align="left" >
						Edad : <?php echo $edad; ?>
					</td>

					<td align="left" >
						Sexo : <?php echo $postulante_datos->sexo; ?>
					</td>
					
					<td align="left" >
						Fecha: <?php echo $fecha_reporte; ?>
					</td>
				</tr>



			</tbody>     
		</table>



		




		
</div>
		<div class="cuerpo_tabla" >
			<p></p><p></p><p></p><p></p>
			<table  class="contenido_tabla borde_tabla" width="100%" >        
				<tbody>
					<tr >
						<td align="left" class=" bordes_td" style="width:100px;">
						<b>Escala</b>
						</td>
						<td align="left" class=" bordes_td" style="width:250px;">
							<b>El polo bajo define una persona...</b>            	
						</td>  
						<!-- style="margin-top: -12px;" -->
						<td rowspan="12" style="width:350px;">
							<br>
							<img width="350"  src="files/pdf/chart_barra.png" alt="logo">
							    <br>
							
							<img width="350" height="450"  style="margin-top: -10px;"	src="<?php echo $ruta_grafico; ?>">
						</td>
						         
						<td align="left" class=" bordes_td" style="width:250px;">
							<b>El polo alto define una persona...
</b>            	
						</td>            
					</tr>


					<?php for ($i=0; $i < count($dtg) ; $i++) { ?>
						<tr >
							<td ><?php echo $dtg[$i]['escala'];?></td>
							<td ><?php echo $dtg[$i]['polo_bajo'];?></td>
							
							<td ><?php echo $dtg[$i]['polo_alto'];?></td>
						</tr>
					<?php } ?>
						<tr>
							<td></td>
							<td></td>
							
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							
							<td></td>
						</tr>
					
					
					
				</tbody>     
			</table>
			<p></p>
			
		</div>










	

	

</body>
</html>



