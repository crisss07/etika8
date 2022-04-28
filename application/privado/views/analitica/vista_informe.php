<style>
.rojo{
	border:2px solid red;
}
.f-arial{
	font-family:Arial;
}
.t-principal{
	text-align:center;font-weigth:600;font-size:25px;
}
.hr-t-principal{
	border-top:1px solid black;width:100%;
}
.sub-t{
	font-size:22px;
}
.tab-informe-cab{
	font-size:18px;color:white;
}
.cols div {
  flex: 1;
}
</style>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
<br>
<br>
<div class="row justify-content-center">
	<div class="col-lg-3">
		<img src="https://competencias.etika.net.bo/files/img/maq/logo_etika.png" style="height:70px;width:auto;">
	</div>
	<div class="col-lg-6" >
	</div>
	<div class="col-lg-3">
	</div>
</div>
<div class="row justify-content-center">
	<div class="col-lg-3">
	</div>
	<div class="col-lg-6 t-principal f-arial" >
	TEST DE RAZONAMIENTO LOGICO-ABSTRACTO
	<hr style="">
	</div>
	<div class="col-lg-3">
	</div>
</div>
<div class="row justify-content-center">
	<div class="col-lg-6 text-left">
	<b>Nombre:</b>&nbsp;MARIA ESTHER QUISPE CHARCAS
	</div>
	<div class="col-lg-1 text-left">
	<b>Edad:</b>&nbsp;26
	</div>
	<div class="col-lg-1 text-left">
	<b>Sexo:</b>&nbsp;F
	</div>
	<div class="col-lg-2 text-left">
	<b>Fecha:</b> <?php echo date('Y-m-d');?>
	</div>
</div>
<br>
<br>
<div class="row justify-content-center">
	<div class="col-lg-2 text-left">
		<b>El polo bajo describe una persona...</b>
		<p align="text-right">
		De pensamiento concreto. Razonamiento simple, poco elaborado. Puede seguir instrucciones simples y literales.
		</p>
	</div>
	<div class="col-lg-5 text-left">
	<canvas class="text-center border" id="barraHorizontal"  height="22" width="100"></canvas>

	</div>
	<div class="col-lg-2 text-left">
		<b>El polo alto describe una persona...</b>
		<p>
		De pensamiento abstracto. Puede manejar problemas complejos y seguir instrucciones inestructuradas. Saca conclusiones lógicas con pocos datos. 
		</p>
	</div>
</div>
<br>
<br>
<div class="row justify-content-center">
	<div class="col-lg-10 text-left">
		<p>
		Esta es una prueba rápida para evaluar la capacidad de resolver problemas usando el razonamiento. No reemplaza una medida completa de inteligencia.
		</p>
		<p>
		Su interpretación debe ser realizada por una persona especializada que contraste con el análisis del curriculum vitae, la entrevista y otras pruebas.
		</p>
	</div>
</div>

<div class="row align-items-center justify-content-center" >
			
		</div>

<script type="text/javascript">
	
	var ctx = document.getElementById("barraHorizontal");
	var valorP=6;
	if(valorP<4){
		var polo='Bajo';
	}
	else{
		if(valorP<8){
			var polo='Medio';
		}else{
			var polo='Alto';
		}
	}
	//inicio del chart
	Chart.defaults.global.legend.display = false;
	var barChart = new Chart(ctx, 
{
  "type": "horizontalBar",
  "data": {
   
    "datasets": [
      {
        "label": polo,
        "backgroundColor": "rgba(236, 103, 59, 1)",
        "data": [
          valorP,
          0,
          10
        ]
      }
    ]
  },
  "options": {
    "elements": {
      "rectangle": {
        "borderWidth": 0
      }
    },
    "responsive": true,
    "legend": {
      "position": "right"
    },
    "title": {
      "display": true,
      "text": polo
    }
  }

}
	);


	



	
</script>
