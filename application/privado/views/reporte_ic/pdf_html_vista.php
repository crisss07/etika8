
<style type="text/css">
	.rojo{
		border:2px solid red;
	}
		@page {
			margin-top: 2cm;
			margin-bottom: 2cm;
			margin-left: 3cm;
			margin-right: 2cm;
		}
		* {
			font-family: Verdana, Arial, sans-serif;
		}
		.encabezado {
			padding: 0px;
			color: #000000;
		}
		.invoice table {
			margin: 0px;
		}

		.invoice h3 {
			margin-left: 18px;
		}
		table {
			font-size: x-small;

		}
		tfoot tr td {
			font-weight: bold;
			font-size: x-small;
		}
		.cuerpo {
			font-size: 12px;
			font-weight: bold;
		}
		.cuerpo_tabla {
			padding-left:  0px;
			
		}
		.contenido_tabla {
			font-size: 12px;
		}
</style>
<!doctype html>
	<html lang="es">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />    
		<title>Reporte</title>
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
		<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
	</head>
	<body style="width:1054px;padding:30px;">

	<div class="encabezado">
		<table >
			<tr >
				<td align="left" style="width: 30%;"> 
			

				<img width="200px" src="<?php echo $this->tool_entidad->rutaimg(); ?>privado/logo-etika.png" alt="logo">
				</td>

			</tr>
		</table>
	</div>
	<div class="invoice">
		<div align="center">
			<p></p>
			<b>
			TEST MANEJO DE DATOS Y PRESION</b>
			
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
				<tr>
					<td align="left" >
						Cantidad de errores : <?php echo $cantidad_errores; ?>
					</td>
					<td align="left" >
						Tiempo de ejecucion : <?php echo $tiempo; ?>
					</td>
					
				</tr>



			</tbody>     
		</table>


		
		<h4 align="center"></h4>

		<div class="cuerpo_tabla">
			<p></p>
			<table  class="contenido_tabla borde_tabla" style="" >        
				<tbody>
					<tr>
						<td class="bordes_td">
							Rapidez y Precisión
						</td> 
						<td class="bordes_td">
							<b style="font-weight:700;">El polo bajo describe una persona...</b>
							<p >Lenta y/o que comete más errores bajo presión.
							</p>
							<p>
								Se debe verificar si mostró razonamiento 
concreto en otras pruebas

							</p>	
						</td>    
						<td align="center" class=" bordes_td">
							<table width="100%" style="z-index:1000;">
								<tr valign="top">
									<td align="center" width="33%">BAJO</td>
									<td align="center" width="1%">
										<img height="80px" width="1px" src="files/img/linea.png" alt="logo">
									</td>
									<td align="center" width="32%">MEDIO</td>
									<td align="center" width="1%">
										<img height="80px" width="1px" src="files/img/linea.png" alt="logo">
									</td>
									<td align="center" width="24%">ALTO</td>
								</tr>
							</table>
							<img width="350" height="auto" class="border" style="margin-top:-60px;"	src="https://quickchart.io/chart?h=100&c={
								type: 'horizontalBar',
								data: {
									datasets: [{
										label: '',
										backgroundColor: 'rgba(236, 103, 59, 1)',
										data: [
										  <?php echo $pe; ?>,
										  0,
										  10
										]
									}]
								},
								  options: {
									elements: {
									  rectangle: {
										'borderWidth': 0
									  }
									},
									responsive: true,
									legend: {
									  display: false,
									},
									title: {
									  display: false,
									  text: 'hola'
									}
								  }
							}&f=.bmp">
						</td> 							
						<td class="bordes_td">
							<b >El polo alto describe una persona...</b>
							<p>
							Que comprende instrucciones complejas, rápida y precisa al manejar información</p>  	
							<br><br><br>
						</td>            
					</tr>
					<tr>
						<td class="bordes_td" colspan="3">
						<br>
						<br>
						<p>
						Si la persona puntuó 3, 2 o 1 y tuvo menos de 7 errores indica cierta precisión pero lentitud ante la presión

						</p>
						<p>
						Si la persona puntuó 3, 2 o 1 y tuvo 8 o más errores y terminó antes del tiempo, indica rapidez con muy poca precisión
						</p>
						<p>
							<?php if ($suma_resp==0): ?>
									Nota: El postulante no tickeo ninguna respuesta	
								<?php else: ?>
									<!-- Nota: El postulante tickeo almenos una vez -->
							<?php endif ?>
						</p>
						</td>            
					</tr>
				</tbody>     
			</table>
			<p></p>
		</div>
	</div>

	<div class="piedpagina" style="position: absolute; ">
		<table width="100%">        
			<tbody>
				<tr>
					<td align="center" style="width: 50%;">

					</td>
				</tr>



			</tbody>     
		</table>
	</div>

</body>
</html>



