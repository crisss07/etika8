<!doctype html>
	<html lang="es">


	<head>
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />    
		<title>Reporte</title>

		<style type="text/css">
		@page {
			margin-top: 2cm;
			margin-bottom: 2cm;
			margin-left: 3cm;
			margin-right: 2cm;
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
			font-size: 12px;

		}
		.cuerpo_tabla {
			padding-left:  0px;
			
		}
		.bordes_td{
			border: 1px solid #4B4141;	
			padding: 10px;	
		}
		.borde_tabla{
			border-collapse: collapse;
		}
		.contenetor_pdf{
			padding-top: 30px;	
			padding-bottom: 30px;	
			padding-left: 30px;	
			padding-right: 30px;
			width:816px;	
		}
	</style>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>


</head>
<body style="width:816px;padding:30px;">
	<!-- inicio de contenedor -->
	<div>
	</div>
	<!-- fin de contenedor -->
	<div class="encabezado">

		
		<table >
			<tr >
				<td align="left" style="width: 30%;"> 
				<img width="200px" src="<?php echo $this->tool_entidad->sitio(); ?>files/pdf/logo_etikaPdf.jpg" alt="logo">
				</td>

			</tr>

		</table>
	</div>
	<div class="invoice" >
		<div align="center">
			<p></p>
			ESTILOS PERSONALES <br>
			PERFIL EN SITUACIONES POSITIVAS Y NEGATIVAS		
		</div>

		<p></p>
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



		<h4 align="center"></h4>




		<div class="row" align="center">
			<img width="auto" height="260" class="border"	src="https://quickchart.io/chart?c={
		type: 'radar',
		data: {
			labels: ['RESULTADOS','CREATIVIDAD','PERSONAS','METODOS'],
			datasets: [{
				label: ' Positivas',
				 data: [
				 <?php echo $posi; ?>
				 ],
				fill: false,
				borderColor: 'rgb(54, 162, 235)'    
				    
			}, {
				label: 'Bajo presi&oacute;n',				
				data: [
				<?php echo $nega; ?>
				],   
				fill: false,    
				borderColor: 'rgb(255, 99, 132)'
				    
			}]
		},
		options: {
			title: {
				display: true,
				text: 'Situaciones',
			},
			legend: {
				display: true,		
           	},
			scale: {
				ticks: {
					beginAtZero: true,
					max: 30
				}
			},
			elements: {
				line: {
					borderWidth: 3
				}
			}
		},
	}">
		</div>

		<div class="cuerpo_tabla">
			<p></p>
			<table  class="contenido_tabla borde_tabla">        
				<tbody>
					<tr >
						<td align="center" style="width:15px">

						</td>
						<td align="center" class=" bordes_td">
							<b>Situaciones Positivas:</b>            	
						</td>            
						<td align="center" class=" bordes_td">
							<b>Situaciones Bajo presi&oacute;n:</b>            	
						</td>            
					</tr>
					<tr class=" bordes">
						<td align="left" class=" bordes_td"><b>RESULTADOS</b>            	
						</td>
						<td align="center" class=" bordes_td">
							<?php echo $ps[0]; ?>
						</td>            
						<td align="center" class=" bordes_td">
							<?php echo $ng[0]; ?>
						</td>            
					</tr>
					<tr>
						<td align="left" class=" bordes_td"><b>CREATIVIDAD</b>            	
						</td>
						<td align="center" class=" bordes_td">
							<?php echo $ps[1]; ?>
						</td>            
						<td align="center" class=" bordes_td">
							<?php echo $ng[1]; ?>					
						</td>            
					</tr>
					<tr>
						<td align="left" class=" bordes_td"><b>PERSONAS</b>            	            	
						</td>
						<td align="center" class=" bordes_td">
							<?php echo $ps[2]; ?>
						</td>            
						<td align="center" class=" bordes_td">
							<?php echo $ng[2]; ?>
						</td>            
					</tr>
					<tr>
						<td align="left" class=" bordes_td"><b>METODOS</b>            	            	
						</td>
						<td align="center" class=" bordes_td">
							<?php echo $ps[3]; ?>
						</td>            
						<td align="center" class=" bordes_td">
							<?php echo $ng[3]; ?>
						</td>            
					</tr>
				</tbody>     
			</table>
			<p></p>
			<!-- tabla de textos -->
			<table  class="contenido_tabla borde_tabla">        
				<tbody>
					<tr >
						<td align="center" class=" bordes_td">
						<b>ORIENTACI&Oacute;N</b>
						</td>
						<td align="center" class=" bordes_td">
							<b>Situaciones Positivas: </b>
						</td>            
						<td align="center" class=" bordes_td">
							<b>Situaciones Bajo presi&oacute;n:</b>
						</td>            
					</tr>
					<tr>
						<td align="left" class=" bordes_td"><b>RESULTADOS</b>            	
						</td>
						<td align="left" class=" bordes_td" >
							Busca llegar a las metas
						</td>            
						<td align="left" class=" bordes_td">
							Sobreexigente, dominante, agresivo
						</td>            
					</tr>
					<tr>
						<td align="left" class=" bordes_td"><b>CREATIVIDAD </b>           	
						</td>
						<td align="left" class=" bordes_td">
							Visionario, espontáneo
						</td>            
						<td align="left" class=" bordes_td">
							Difuso, poco práctico, melodramático, impulsivo
						</td>            
					</tr>
					<tr>
						<td align="left" class=" bordes_td"><b>PERSONAS  </b>          	
						</td>
						<td align="left" class=" bordes_td">
							Cuida las relaciones
						</td>            
						<td align="left" class=" bordes_td">
							Muy docil, sobrecargado, victimizado, pasivo
						</td>            
					</tr>
					<tr>
						<td align="left" class=" bordes_td" ><b>METODOS </b>           	
						</td>
						<td align="left" class=" bordes_td">
							Pensamiento lógico, crítico
						</td>            
						<td align="left" class=" bordes_td">
							Rígido, terco, indeciso, criticón, distanciado
						</td>            
					</tr>



				</tbody>     
			</table>
		</div>
	</div>
</body>
</html>



