<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $this->tool_entidad->titulo_sitio(); ?></title>
        <link href="<?php echo $this->tool_entidad->sitio(); ?>files/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/est_publico.css" rel="stylesheet" type="text/css"/>    
        <link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/banner_etika.css" rel="stylesheet" type="text/css"/>    
        <link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/estilos_etika.css" rel="stylesheet" type="text/css"/>    
        <!--<link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/convocatorias.css" rel="stylesheet" type="text/css"/> -->
        <link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/convocatoriasC.css" rel="stylesheet" type="text/css"/>
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"/>
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    
       
        
    </head>
    <body>
    	<!-- inicio modal content -->
<div id="myModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<!-- <form action="<?php //echo base_url() ?>aberturas/guarda" method="POST"> -->
			<?php echo form_open('aberturas/guarda'); ?>
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">FORMULARIO DE ABERTURA</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<input type="hidden" name="ida" id="ida" value="">
				</div>
				
				<div class="modal-footer">
					<button type="submit" class="btn waves-effect waves-light btn-block btn-success">GUARDA ABERTURA</button>
				</div>
			</form>

		</div>
		<!-- /.modal-content -->
	</div>
    <!-- /.modal-dialog -->
</div>
<!-- fin modal -->
		<br>
        <div class="container-fluid row justify-content-center">
		<?php $javs = array('id' => "plantillas",'onsubmit' => "return validar()"); ?>
			<?php echo form_open_multipart($action , $javs, ); ?>
			<input type="hidden" name="<?php echo 'con_id';?>"  value="<?php echo @set_value('con_id',$fila['con_id']);?>">
				<label for="plantilla">Seleccione una plantilla: </label>
				
			<?php 
			switch($fila['pla_id']){
				case 1:
				$aux=array('selected','','');
				break;
				case 2:
				$aux=array('','selected','');
				break;
				case 3:
				$aux=array('','','selected');
				break;
				default:
				$aux=array('selected','','');
			} 
			?>
			<div class="input-group" style="width: 400px;">
			  <select class="custom-select" id="plantilla" name="plantilla">
				  <option <?php echo $aux[0]; ?> value="1">Plantilla 1</option>
				  <option <?php echo $aux[1]; ?> value="2">Plantilla 2</option>
				  <option <?php echo $aux[2]; ?> value="3">Plantilla 3</option>
			  </select>
			  <div class="input-group-append">
				<input class="btn-etika btn" type="submit" value="Cambiar Plantilla">
			  </div>
			</div>
			<?php echo form_close() ?>
			<br>
        </div>
        <br>
        <?php echo form_open_multipart('Convocatoria/ver_carpeta'); ?>
        <div class="container-fluid row justify-content-center">
            <?php if ($fila['pla_id'] == 0) { ?>
                <input type="hidden" name="pla_id" value="1">
           <?php } else {?>
        	   <input type="hidden" name="pla_id" value="<?php echo $fila['pla_id']; ?>">
            <?php } ?> 
        	<input type="hidden" name="con_id" value="<?php echo $fila['con_id']; ?>">
        	<button class="btn-etika btn botones" type="submit">Cambiar fondo de imagen</button>
				<!-- <input class="btn-etika btn botones" type="submit" onclick="galeria_imagenes();" value="Cambiar fondo de imagen"> -->
				<a class="btn-etika btn botones" href="#" id="save" type="button" style="color: white;">Exportar a Imagen</a>
		</div>
		<?php echo form_close() ?>
		<div class="container">
            <?php echo $contenido; ?>
        </div>
        <br>	       
    </body>
</html>
<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js'></script> -->
<script>
    $(document).ready(function(){

  
var element = $("#html-content-holder"); // global variable
var getCanvas; // global variable
 
    $("#btn-Preview-Image").on('click', function () {
         html2canvas(element, {
         onrendered: function (canvas) {
                $("#previewImage").append(canvas);
                getCanvas = canvas;
             }
         });
    });

  $("#btn-Convert-Html2Image").on('click', function () {
    var imgageData = getCanvas.toDataURL("image/png");
    // Now browser starts downloading it instead of just showing it
    var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
    $("#btn-Convert-Html2Image").attr("download", "your_pic_name.png").attr("href", newData);
  });

});
</script>
<script>
function validar(){
	// event.preventDefault();
	// Swal.fire(
	//   'Se guardo exitosamente!',
	//   'En un momento se actualizara la vista',
	//   'success'
	// ).then(function() {
 //    document.forms["plantillas"].submit();
 //    });	

    event.preventDefault();
    document.forms["plantillas"].submit();
}
</script>
<script>
	$('#plantilla').on('change', function(e){
        var id = e.target.value;
        // window.location.href = "<?php echo base_url() ?>aberturas/eliminar/" + id;
        });
</script>
<script>
	function galeria_imagenes(pla_id)
	{
		window.location.href = "Convocatoria/ver_carpeta" + pla_id;

		// $('#nombre').val(nombre);
		// $('#tipo').val(tipo);
		// $('#genero').val(genero);
		// $('#pla_id').val(pla_id);
		// $("#myModal").modal('show');
	}
</script>
<script type="text/javascript" src="<?php echo $this->tool_entidad->sitio(); ?>files/js/convertir_img/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="<?php echo $this->tool_entidad->sitio(); ?>files/js/convertir_img/html2canvas.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->tool_entidad->sitio(); ?>files/js/convertir_img/canvas2image.js"></script>
    <script type="text/javascript">

        $('#save').click(function(){
                var elm = $('.imagen').get(0);
                // var lebar = "600";
                // var tinggi = "450";
                var type = "jpg";
                var filename = "plantilla_1";
                html2canvas(elm).then(function(canvas){
                    var canvasWidth = canvas.width;
                    var canvasHeight = canvas.height;
                    $('.toCanvas').after(canvas);

                    // let type = $('#sel').val(); //图片类型
                    let w = 1240; //图片宽度
                    let h = 1747; //图片高度
                    // let f = $('#imgFileName').val(); //图片文件名
                    w = (w === '') ? canvasWidth : w; //判断输入宽高是否为空，为空时保持原来的值
                    h = (h === '') ? canvasHeight : h;
                    // 调用Canvas2Image插件
                    Canvas2Image.saveAsImage(canvas, w, h, type, filename);

                    // var canWidth = canvas.width;
                    // var canHeight = canvas.height;
                    // var img = Canvas2Image.convertToImage(canvas, canvasWidth, canvasHeight);
                    // $('#preview').after(img);
                    // Canvas2Image.saveAsImage(canvas, lebar, tinggi, type, filename);
            })
        })




        // var test = $(".container").get(0); //将jQuery对象转换为dom对象
        // // 点击转成canvas
        // $('.toCanvas').click(function(e) {
        //     // 调用html2canvas插件
        //     html2canvas(test).then(function(canvas) {
        //         // canvas宽度
        //         var canvasWidth = canvas.width;
        //         // canvas高度
        //         var canvasHeight = canvas.height;
        //         // 渲染canvas
        //         $('.toCanvas').after(canvas);
        //         // 显示‘转成图片’按钮
        //         $('.toPic').show(1000);
        //         // 点击转成图片
        //         $('.toPic').click(function(e) {
        //             // 调用Canvas2Image插件
        //             var img = Canvas2Image.convertToImage(canvas, canvasWidth, canvasHeight);
        //             // 渲染图片
        //             $(".toPic").after(img);
        //             // 点击保存
        //             $('#save').click(function(e) {
        //                 let type = $('#sel').val(); //图片类型
        //                 let w = $('#imgW').val(); //图片宽度
        //                 let h = $('#imgH').val(); //图片高度
        //                 let f = $('#imgFileName').val(); //图片文件名
        //                 w = (w === '') ? canvasWidth : w; //判断输入宽高是否为空，为空时保持原来的值
        //                 h = (h === '') ? canvasHeight : h;
        //                 // 调用Canvas2Image插件
        //                 Canvas2Image.saveAsImage(canvas, w, h, type, f);
        //             });
        //         });


        //     });
        // });
    </script>
<style>
	.botones{
		margin: 10px;
	}
	
</style>

