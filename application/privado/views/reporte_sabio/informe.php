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

		table, tr, td, th {
			font-size: x-small;
			border: 1px solid black;
			border-collapse: collapse;
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
			font-size: 16px;
			font-weight: bold;
		}
		.titulos_tabla {
			font-size: 16px;
			font-weight: bold;
		}
		.contenido_tabla {
			font-size: 16px;

		}
		.cuerpo_tabla {



			padding-left:  100px;
			padding-right:  40px;
		}
	</style>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>


</head>
<body>

	<div class="encabezado">
		<table >
			<tr >
				<td align="center" style="width: 50%;">                

					<img src="<?php echo $this->tool_entidad->sitio(); ?>files/pdf/logo_etikaPdf.jpg" align="left" alt="Cinque Terre" width="180" height="auto">
				</td>

			</tr>

		</table>
	</div>







	<div class="invoice">
		<div align="center">
			ESTILOS PERSONALES <br>
			PERFIL EN SITUACIONES POSITIVAS Y NEGATIVAS		
		</div>

		<p></p>
		<table width="100%" class="cuerpo">        
			<tbody>
				<tr>
					<td align="center" >
						Nombre :
					</td>
					<td align="center" >
						Edad :
					</td>
					<td align="center" >
						Sexo :
					</td>
					<td align="center" >
						Fecha: 13/7/2021
					</td>
				</tr>



			</tbody>     
		</table>



		<h4 align="center"></h4>

		<img width="500" height="auto" class="border"	src="https://quickchart.io/chart?c={
		type: 'radar',
		data: {
			labels: ['RESULTADOS','CREATIVO','PERSONAS','METODICO'],
			datasets: [{
				label: 'Negativas',
				data: [27,22,23,28],    
				fill: false,    
				borderColor: 'rgb(255, 99, 132)'    
			}, {
				label: 'Positivas',
				data: [25,22,25,28],
				fill: false,    
				borderColor: 'rgb(54, 162, 235)'    
			}]
		},
		options: {
			title: {
				display: true,
				text: 'A. GRÁFICO GENERAL DE COMPETENCIAS',				
				fontSize: 14
			},
			legend: {
				display: true,
				position: 'bottom',
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


		<div class="row align-items-center justify-content-center" >
			<canvas class="col-sm-8 text-center border" id="radarChart"  height="102" width="304"></canvas>

		</div>

		<div class="cuerpo_tabla">
			<table width="30%" class="contenido_tabla">        
				<tbody>
					<tr>
						<td align="center" >

						</td>
						<td align="center" >
							Positivas :
						</td>            
						<td align="center" >
							Negativas :
						</td>            
					</tr>
					<tr>
						<td align="left" >RESULTADOS            	
						</td>
						<td align="center" >
							25
						</td>            
						<td align="center" >
							27
						</td>            
					</tr>
					<tr>
						<td align="left" >RESULTADOS            	
						</td>
						<td align="center" >
							25
						</td>            
						<td align="center" >
							27
						</td>            
					</tr>
					<tr>
						<td align="left" >RESULTADOS            	
						</td>
						<td align="center" >
							25
						</td>            
						<td align="center" >
							27
						</td>            
					</tr>
					<tr>
						<td align="left" >RESULTADOS            	
						</td>
						<td align="center" >
							25
						</td>            
						<td align="center" >
							27
						</td>            
					</tr>
				</tbody>     
			</table>
			<p></p>
			<!-- tabla de textos -->
			<table width="70%" class="contenido_tabla">        
				<tbody>
					<tr>
						<td align="center" >

						</td>
						<td align="center" >
							Positivas :
						</td>            
						<td align="center" >
							Negativas :
						</td>            
					</tr>
					<tr>
						<td align="left" >RESULTADOS            	
						</td>
						<td align="center" >
							Orientado a Resultados
						</td>            
						<td align="center" >
							Sobreexigente, dominante, agresivo
						</td>            
					</tr>
					<tr>
						<td align="left" >VISIONARIO            	
						</td>
						<td align="center" >
							Creativo, Espontáneo
						</td>            
						<td align="center" >
							Difuso, poco práctico, melodramático, impulsivo
						</td>            
					</tr>
					<tr>
						<td align="left" >PERSONAS            	
						</td>
						<td align="center" >
							Orientado a las Personas
						</td>            
						<td align="center" >
							Muy docil, sobrecargado, victimizado, pasivo
						</td>            
					</tr>
					<tr>
						<td align="left" >METODICO            	
						</td>
						<td align="center" >
							Pensamiento crítico
						</td>            
						<td align="center" >
							Criticón, rígido, terco, indeciso, aburrido
						</td>            
					</tr>



				</tbody>     
			</table>
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

<!-- <script type="text/javascript">
	
	var ctx = document.getElementById("radarChart");
	const data = {
  labels: [
    
    'RESULTADOS',
'CREATIVO',
'PERSONAS',
'METODICO'

  ],
  datasets: [{
    label: 'Negativas',
    data: [27,22,23,28],    
    fill: false,
    backgroundColor: 'rgba(255, 99, 132, 0.2)',
    borderColor: 'rgb(255, 99, 132)',
    pointBackgroundColor: 'rgb(255, 99, 132)',
    pointBorderColor: '#fff',
    pointHoverBackgroundColor: '#fff',
    pointHoverBorderColor: 'rgb(255, 99, 132)'
  }, {
    label: 'Positivas',
    data: [25,22,25,28],
    fill: false,
    backgroundColor: 'rgba(54, 162, 235, 0.2)',
    borderColor: 'rgb(54, 162, 235)',
    pointBackgroundColor: 'rgb(54, 162, 235)',
    pointBorderColor: '#fff',
    pointHoverBackgroundColor: '#fff',
    pointHoverBorderColor: 'rgb(54, 162, 235)'
  }]
};
	//inicio del chart
	var barChart = new Chart(ctx, {
	  type: 'radar',
	  data: data,
		options: {
	        title: {
	            display: true,
	            text: 'A. GRÁFICO GENERAL DE COMPETENCIAS',
	            fontSize: 14
	        },
	        legend: {
	    		display: false
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
	});	
</script> -->

<script type="text/javascript">
	
	var ctx = document.getElementById("radarChart");
	const datass = {
		labels: [

		'RESULTADOS',
		'CREATIVO',
		'PERSONAS',
		'METODICO'

		],
		datasets: [{
			label: 'Negativas',
			data: [27,22,23,28],    
			fill: false,
			backgroundColor: 'rgba(255, 99, 132, 0.2)',
			borderColor: 'rgb(255, 99, 132)',
			pointBackgroundColor: 'rgb(255, 99, 132)',
			pointBorderColor: '#fff',
			pointHoverBackgroundColor: '#fff',
			pointHoverBorderColor: 'rgb(255, 99, 132)'
		}, {
			label: 'Positivas',
			data: [25,22,25,28],
			fill: false,
			backgroundColor: 'rgba(54, 162, 235, 0.2)',
			borderColor: 'rgb(54, 162, 235)',
			pointBackgroundColor: 'rgb(54, 162, 235)',
			pointBorderColor: '#fff',
			pointHoverBackgroundColor: '#fff',
			pointHoverBorderColor: 'rgb(54, 162, 235)'
		}]
	};
	//inicio del chart
	var barChart = new Chart(ctx, {
		type: 'radar',
		data: {
			labels: ['RESULTADOS','CREATIVO','PERSONAS','METODICO'],
			datasets: [{
				label: 'Negativas',
				data: [27,22,23,28],    
				fill: false,    
				borderColor: 'rgb(255, 99, 132)'    
			}, {
				label: 'Positivas',
				data: [25,22,25,28],
				fill: false,    
				borderColor: 'rgb(54, 162, 235)'    
			}]
		},
		options: {
			title: {
				display: true,
				text: 'A. GRÁFICO GENERAL DE COMPETENCIAS',				
				fontSize: 14
			},
			legend: {
				display: true,
				position: 'bottom',
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
	});


	



	
</script>


