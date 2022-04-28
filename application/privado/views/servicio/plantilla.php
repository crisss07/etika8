<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<br/>
<?php
$this->load->view('cabecera');
?>
<?php
$sitio=$this->tool_entidad->sitioindexpri();
$bucket_url =$this->tool_entidad->aws_url();
?>
<style type="text/css">
	.col-lg-4{
		margin-bottom: 20px;
	}
  .img_plantillas{
    /*width: 200px;*/
    height: 300px;
  }
  
</style>
<br>
  <!-- <div id="carouselMultiItemExample" class="carousel slide carousel-dark text-left" data-mdb-ride="carousel">
     <a href="<?php //echo $this->tool_entidad->sitioindexpri(); ?>Imagenes" class="enlace_retornar enlace_a1">Atrás</a>
  </div> -->

<div id="listado">
  <br/>
  
  <!-- <div id="carouselMultiItemExample" class="carousel slide carousel-dark text-center" data-mdb-ride="carousel">
	   <a href="#" onclick="abre_modal('<?php //echo $plantilla; ?>');" class="enlace_nuevo enlace_a1">Nueva Plantilla</a>
  </div> -->
  <?php echo form_open('Convocatoria/guardar_imagen_redes'); ?>
<div id="carouselMultiItemExample" class="carousel slide carousel-dark text-center" data-mdb-ride="carousel">
  <div class="carousel-inner py-4">
    <!-- Single item -->
    <div class="carousel-item active">
      <div class="container">
        <div class="row">
                <input type="hidden" name="plantillas" value="<?php echo $plantilla; ?>">
                <input type="hidden" name="con_id" value="<?php echo $con_id; ?>">
                <input type="hidden" name="pla_id" value="<?php echo $pla_id; ?>">
                <input type="hidden" name="imagen_id" id="imagen_id">
           
          <?php //print_r($fila); ?>
          <?php if ($fila) {
            $cont = 1;
            foreach ($fila as $imagenes) { ?> 
              
            <div class="col-lg-4 d-none d-lg-block">
              <div class="card">
                
                <!-- <input type="hidden" name="imagen_id" value="<?php //echo $imagenes['pla_id']; ?>"> -->
                
                <img class="img_plantillas" src="<?php echo $bucket_url ?>archivos/plantillas/<?php echo $imagenes['pla_ubicacion']; ?>/<?php echo $imagenes['pla_nombre']; ?>" class="card-img-top" alt="..." />
                <div class="card-body">
                  <h5 class="card-title">Imagen <?php echo $cont;  $cont++;?></h5>
                  <!-- <p class="card-text">
                    Some quick example text to build on the card title and make up the bulk of the card's content.
                  </p> -->
                  <button style="border:0;outline:0 none;" type="submit" class="enlace_bien enlace_a1" onclick="imagen('<?php echo $imagenes['pla_id']; ?>');">USAR IMAGEN</button>&nbsp;&nbsp;
                </div>
              </div>
            </div>
          
          <?php } 
          } ?> 
           
        </div>
      </div>
    </div>

  </div>
  <!-- Inner -->
</div>
<?php echo form_close() ?>
<!-- Carousel wrapper -->


    
</div>

<script>
  function abre_modal(carpeta)
  {
    $('#carpeta').val(carpeta);
    $("#myModal").modal('show');

  }

  function seleccionar()
  {
    Swal.fire(
      'Felicitaciones!',
      'Se selecciono correctamente la imagen!',
      'success'
    ).then(function() {
    document.forms["plantillas"].submit();
    });
  }

  function imagen(pla_id){
    $('#imagen_id').val(pla_id);
  }

  function eliminar(id)
  {
    Swal.fire({
      title: '¿Quieres borrar?',
      text: "Luego no podras recuperarlo!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, estoy seguro!',
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.value) {
        Swal.fire(
          'Excelente!',
          'La imagen fue borrado.',
          'success'
        );
        // console.log("el id es "+id_pago);
        window.location.href = "<?php echo $this->tool_entidad->sitioindexpri(); ?>Imagenes/eliminar_imagen/" + id;
      }
    })

    
  }
</script>
<script>
    $(document).ready(function() {
        $('.dropify').dropify({
            messages: {
                default: 'Arrastre un archivo o haga click',
                replace: 'Arrastre un archivo para reemplazar',
                remove: 'eliminar',
                error: 'Lo sentimos no se admite el tipo de archivo.',
            }
        });
   
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });
        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });
        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });
        drEvent.on('dropify.error.imageFormat', function(event, element){
    alert('Image format error message!');
});
        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });

    $('#input-file-input').on( 'change', function() {
   myfile= $( this ).val();
   var ext = myfile.split('.').pop();
   if(ext=="exe" || ext=="zip" || ext=="rar"|| ext=="7zip"){
       //alert(ext);
       Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'No se admite ese tipo de archivo, elija otro archivo'
        })
       $('#guardar').hide();
   } else{
       //alert(ext);
       $('#guardar').show();
   }
});
</script>

