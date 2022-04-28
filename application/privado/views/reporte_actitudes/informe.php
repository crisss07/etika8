<!doctype html>
	<html lang="es">


	<head>
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />    
		<title>Reporte</title>

		<style type="text/css">
		@page {
			margin-top: 1cm;
			margin-bottom: 1cm;
			margin-left: 2cm;
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
				<td align="left" style="width: 30%;"> 
					<img width="200px" src="<?php echo base_url().'files/pdf/logo_etikaPdf.jpg'; ?>" alt="logo">
				</td>

			</tr>

		</table>
	</div>







	<div class="invoice">
		<div align="center">
			<p></p>
			16PF-5							
			<br>
			PERFIL DE ESCALAS PRIMARIAS Y DIMENSIONES GLOBALES	
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
						Fecha: <?php echo $fecha_reporte; ?>
					</td>
				</tr>



			</tbody>     
		</table>



		<h4 align="center"></h4>



		<div>
			<canvas id="myChart" width="467" height="233" style="display: block; box-sizing: border-box; height: 233px; width: 467px;"></canvas>
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



<script>
	var ctx = document.getElementById("myChart");



	const data = {
		labels: ["A","C","Ase","F","Nor","H","I","Con","M","N","O","Q1","Aut","Q3","Q4","Ext","Em","Ap","Am","Res","Val","IN","AQ"]
		,
		datasets: [
		{
			label: 'Dataset 1',
			data: [9,8,5,7,7,5,6,9,8,7,6,6,4,5,5,7,6,3,4,8,6,3,6,2,5,7,9
			],
			borderColor: 'rgb(255, 99, 132)',
			backgroundColor: 'rgba(255, 99, 132, 0.2)',
		}
		]
	};


	var barChart = new Chart(ctx, {
		type: 'horizontalBar',
		data: {
			labels: ["A","C","Ase","F","Nor","H","I","Con","M","N","O","Q1","Aut","Q3","Q4","Ext","Em","Ap","Am","Res","Val","IN","AQ"],
			datasets: [
			{
				label: '',
				data: [9,8,5,7,7,5,6,9,8,7,6,6,4,5,5,7,6,3,4,8,6,3,6,2,5,7,9
				],
				borderColor: 'rgb(255, 99, 132)',
				backgroundColor: 'rgba(255, 99, 132, 0.2)',
			}
			]
		},
		options: {

			tooltips: {
					enabled: true
				},

			elements: {
				bar: {
					borderWidth: 2,
				}
			},
			legend: { display: false },
			responsive: true,
			plugins: {
				legend: {
					display: false,
					position: 'right',
				},
				title: {
					display: false,
					text: 'Chart.js Horizontal Bar Chart'
				}
			},
			scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true,
            },
            gridLines: {
                display: false
            },
        }],
        xAxes: [{
            ticks: {
            	beginAtZero: true,
                stepSize:1,
                display: true,
                max:10
            },
            gridLines: {
                drawBorder: false,
            }
        }],
    }
		},
	}
	);
</script>

