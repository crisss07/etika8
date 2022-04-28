<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/convocatoriasC.css" rel="stylesheet" type="text/css"/>
<br/>
<?php
$this->load->view('cabecera');
?>
<?php
$sitio=$this->tool_entidad->sitioindexpri();
$bucket_url =$this->tool_entidad->aws_url();
$sitio1 = $this->tool_entidad->sitioindex();
$prefijo = $this->prefijo;
$sitio = $this->tool_entidad->sitioindex();
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
  <div id="carouselMultiItemExample" class="carousel slide carousel-dark text-left" data-mdb-ride="carousel">
     <a href="<?php echo $this->tool_entidad->sitioindexpri(); ?>Imagenes" class="enlace_retornar enlace_a1">Atrás</a>
  </div>

<div id="listado">
  <br/>
  
  <div id="carouselMultiItemExample" class="carousel slide carousel-dark text-center" data-mdb-ride="carousel">
	   <a href="#" onclick="abre_modal('<?php echo $plantilla; ?>');" class="enlace_nuevo enlace_a1">Nueva Imagen</a>
  </div>
<div id="carouselMultiItemExample" class="carousel slide carousel-dark text-center" data-mdb-ride="carousel">
  <div class="carousel-inner py-4">
    <!-- Single item -->
    <div class="carousel-item active">
      <div class="container">
        <div class="row">
          <?php //print_r($fila); ?>
          <?php if ($fila) {
            $cont = 1;
            foreach ($fila as $imagenes) { ?> 
            <div class="col-lg-4 d-none d-lg-block">
              <div class="card">
                <img class="img_plantillas" src="<?php echo $bucket_url ?>archivos/plantillas/<?php echo $imagenes['pla_ubicacion']; ?>/<?php echo $imagenes['pla_nombre']; ?>" class="card-img-top" alt="..." />
                <div class="card-body">
                  <h5 class="card-title">Imagen <?php echo $cont;  $cont++;?></h5>
                  <!-- <p class="card-text">
                    Some quick example text to build on the card title and make up the bulk of the card's content.
                  </p> -->
                  <a href="#" class="enlace_bien enlace_a1" onclick="seleccionar('<?php echo $imagenes['pla_ubicacion']; ?>','<?php echo $bucket_url ?>archivos/plantillas/<?php echo $imagenes['pla_ubicacion']; ?>/<?php echo $imagenes['pla_nombre']; ?>');">Vista previa</a>&nbsp;&nbsp;
  				        <a href="#" class="enlace_cancelar enlace_a1" onclick="eliminar('<?php echo $imagenes['pla_id']; ?>')">Eliminar</a>
                </div>
              </div>
            </div>

          <?php } 
          } ?> 
          <!-- <div class="col-lg-4 d-none d-lg-block">
            <div class="card">
              <img src="<?php echo $bucket_url; ?>archivos/plantillas/plantilla_1/adidas.jpg" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title">Imagen 2</h5>
                <a href="#!" class="btn btn-primary">USAR IMAGEN</a>
                <a href="#!" class="btn btn-primary">ELIMINAR</a>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </div>

  </div>
  <!-- Inner -->
</div>
<!-- Carousel wrapper -->



  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Nueva Imagen</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <form action="<?php echo $this->tool_entidad->sitioindexpri(); ?>Imagenes/subir_imagen" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="carpeta" id="carpeta">
              <div class="col-md-12" id="cajaArchivo">
                <div class="card">
                    <input type="file" id="input-file-input" class="dropify" accept="image/*," name="docnombre"  data-allowed-file-extensions='["jpg","jpeg","gif","png"]' />
                </div>
              </div>
              <br>
              <div align="center">
                <button type="submit" class="btn btn-info">Guardar</button>
                <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
              </div>
            </form>
        </div>
        
        
      </div>
    </div>
  </div>

  <!-- The Modal -->
  <div class="modal" id="vista_previa_1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      <style type="text/css">
        #imagenes_1{
          /*background-image: url(<?php echo $this->tool_entidad->sitio().$plantilla;?>);*/
          background-repeat: no-repeat;
          background-size: cover;
          background-position: center;
          
          color: white;
          width: 100%;
          min-height: 320px;
      }
      </style>
        <!-- Modal Header -->
        <!-- <div class="modal-header">
          <h4 class="modal-title">Nueva Imagen</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> -->
        
        <!-- Modal body -->
        <div class="modal-body">
              <!-- <div class="row justify-content-center"> -->
                  <!-- <div class="col-md-10"> -->
                      <div class="col-md-12 imagen" id="imagenes_1" >
                        <img class="solo_logo" style="margin: 15px; width: 30%;" src="<?php echo $this->tool_entidad->sitio().'files/img/solo-logo.png';?>">
                        <div class="d-flex justify-content-center align-items-center box-titulo" style="margin-right: 20px; margin-left: 20px;">
                            <h2 class="text-center" style="font-size: 16px; text-transform: none; color: #222E3E; font-weight: 600;">Nuestro cliente Finilager, nos ha encomendado la búsqueda de un(a) profesional de alto nivel para ocupar el cardo de:</h2>
                        </div>
                        <img class="solo_logo" style="margin: 30px; width: 10%;" src="<?php echo $this->tool_entidad->sitio().'archivos/cliente/LogoCobee_229.png';?>">
                        <div class="justify-content-center align-items-center box-titulo" style="margin-top: 250px; margin-bottom: 350px;">
                            <h2 class="text-center" style="font-size: 45px; color: #222E3E; " >GERENTE REGIONAL COMERCIAL</h2>
                            <h4 style="font-size: 16px; text-transform: capitalize; color: #222E3E;">(Sede La Paz)</h4>
                        </div>
                        
                        <div class="box-convocatoria-titulo_2" id="titulo_imagen2" style="margin-top: 40%; margin-bottom: 13.7%;">
                            <br>
                                <div class="align-items-left box-titulo">
                                    <h2 style="text-align: left; text-transform: none; margin-left: 5px; font-size: 16px; font-weight: 100;">Requisitos:<br><ul>
                                      <li style="margin-left: -20px;">Lic. Administración de Empresas; Ing. Comercial, Industrial o Mecánica, o similares.</li>
                                      <li style="margin-left: -20px;">Minimo 5 años de experencia en posiciones de liderazgo en el área comercial, gestionando el área administrativa, de recursos humanos, comercialización, logística y finanzas.</li>
                                      <li style="margin-left: -20px;">Idioma inglés intermedio.</li>
                                    </ul>
                                      </h2>
                                </div>
                        </div>
                        <div style="background-color: white; margin-left: -15px;">
                            <table>
                                <tr>
                                    <td style="width: 80%">
                                        <div style="padding: 20px;  color: black; text-align: left;">
                                            <p>Para mayor información a postulación a:<br>
                                            http://www.etika.bo/index.php/convocatorias hasta el 20 de Marzo de 2021</p>
                                        </div>
                                    </td>
                                    <td style="width: 20%;">
                                        <img style="width: 70%; margin-left: 60px;" src="<?php echo $this->tool_entidad->sitio().'files/img/plantillas/codigoQR.jpeg';?>">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                  <!-- </div> -->
              <!-- </div> -->
              <br/>
        </div>
        
        
      </div>
    </div>
  </div>

  <!-- The Modal -->
  <div class="modal" id="vista_previa_2">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      <style type="text/css">
        #imagenes_2{
          /*background-image: url(<?php echo $this->tool_entidad->sitio().$plantilla;?>);*/
          background-repeat: no-repeat;
          background-size: cover;
          background-position: center;
          
          color: white;
          width: 100%;
          min-height: 320px;
      }
      </style>
        <!-- Modal Header -->
        <!-- <div class="modal-header">
          <h4 class="modal-title">Nueva Imagen</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> -->
        
        <!-- Modal body -->
        <div class="modal-body">

                      <div class="col-md-12 imagen" id="imagenes_2">
                        <img class="solo_logo" style="margin: 15px; width: 30%;" src="<?php echo $this->tool_entidad->sitio().'files/img/solo-logo.png';?>">
                        <div class="d-flex justify-content-center align-items-center box-titulo" style="margin-right: 60px; margin-left: 60px;">
                            <h2 class="text-center" style="font-size: 16px; text-transform: none; color: white; font-weight: 600;">Empresa multinacional lider a nivel nacional en el rubro de masivos, busca profesional con alto potencial para:</h2>
                        </div>
                        <!-- <img class="solo_logo" style="margin: 30px; width: 10%;" src="<?php echo $this->tool_entidad->sitio().'archivos/cliente/LogoCobee_229.png';?>"> -->
                        <div class="justify-content-center align-items-center box-titulo" style="margin-top: 250px; margin-bottom: 350px;">
                            <h2 class="text-center" style="font-size: 45px; color: #222E3E; " >GERENTE REGIONAL COMERCIAL</h2>
                            <h4 style="font-size: 16px; text-transform: capitalize; color: #222E3E;">(Sede La Paz)</h4>
                        </div>
                        
                        <div class="box-convocatoria-titulo_2" id="titulo_imagen2" style="margin-top: 40%; margin-bottom: 13.7%;">
                            <br>
                                <div class="align-items-left box-titulo">
                                    <h2 style="text-align: left; text-transform: none; margin-left: 5px; font-size: 16px; font-weight: 100;">Requisitos:<br>
                                      <ul>
                                        <li style="margin-left: -20px;">Lic. Administración de Empresas; Ing. Comercial, Industrial o Mecánica, o similares.</li>
                                        <li style="margin-left: -20px;">Minimo 5 años de experencia en posiciones de liderazgo en el área comercial, gestionando el área administrativa, de recursos humanos, comercialización, logística y finanzas.</li>
                                        <li style="margin-left: -20px;">Idioma inglés intermedio.</li>
                                      </ul>
                                    </h2>
                                </div>
                        </div>
                        <div style="background-color: white; margin-left: -15px;">
                            <table>
                                <tr>
                                    <td style="width: 80%">
                                        <div style="padding: 20px;  color: black; text-align: left;">
                                            <p>Para mayor información a postulación a:<br>
                                            http://www.etika.bo/index.php/convocatorias hasta el 31 de diciembre de 2021</p>
                                        </div>
                                    </td>
                                    <td style="width: 20%;">
                                        <img style="width: 70%; margin-left: 60px;" src="<?php echo $this->tool_entidad->sitio().'files/img/plantillas/codigoQR.jpeg';?>">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                  <!-- </div> -->
              <!-- </div> -->
              <br/>
        </div>
        
        
      </div>
    </div>
  </div>

  <!-- The Modal -->
  <div class="modal" id="vista_previa_3">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      <style type="text/css">
        #imagenes_3{
          /*background-image: url(<?php echo $this->tool_entidad->sitio().$plantilla;?>);*/
          background-repeat: no-repeat;
          background-size: cover;
          background-position: center;
          
          color: white;
          width: 100%;
          min-height: 320px;

      }
      </style>
        <!-- Modal Header -->
        <!-- <div class="modal-header">
          <h4 class="modal-title">Nueva Imagen</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> -->
        
        <!-- Modal body -->
        <div class="modal-body">

            <div class="col-md-12 imagen" id="imagenes_3">
                <img class="solo_logo" style="margin: 15px;  margin-left: -105px; position: absolute; z-index: 1" src="<?php echo $this->tool_entidad->sitio().'files/img/solo-logo.png';?>">
                <br>
                <br>
                <br><br><br>
                <div class="d-flex justify-content-center align-items-center box-titulo" style="margin-right: 90px; margin-left: 90px; background-color: #91989D; opacity: 0.8; padding-top: 12px;">
                    <h2 class="text-center" style="font-size: 16px; text-transform: none; color: white; font-weight: 600;">Empresa lider en el sector financiero a nivel nacional, busca profesionales innovadores y de alto potencial para el cargo de:</h2>
                </div>
                <div class="justify-content-center align-items-center box-titulo" style="margin-top: 350px; margin-bottom: 120px; background-color: #878A91; opacity: 0.8; margin-right: 90px; margin-left: 90px; padding-top: 30px; padding-bottom: 30px;">
                    <h2 class="text-center" style="font-size: 45px; color: white; " >GERENTE REGIONAL COMERCIAL</h2>
                    <h4 style="font-size: 16px; text-transform: capitalize; color: white;">(Sede La Paz)</h4>
                </div>

                <div class="justify-content-center align-items-center box-titulo" style="margin-bottom: 20px;">
                    <img style="width: 12%;" src="<?php echo $this->tool_entidad->sitio().'files/img/plantillas/codigoQR.jpeg';?>">
                </div>
                
                
                <div style="background-color: white;  margin-left: -15px; width: 104.2%;">
                    <div style="padding: 20px;  color: black; text-align: left;">
                        <p>Para mayor información a postulación a:<br>
                        http://www.etika.bo/index.php/convocatorias hasta el 31 de diciembre de 2021</p>
                    </div>
                </div>
            </div>

                  <!-- </div> -->
              <!-- </div> -->
              <br/>
        </div>
        
        
      </div>
    </div>
  </div>


    
</div>

<script>
  function abre_modal(carpeta)
  {
    $('#carpeta').val(carpeta);
    $("#myModal").modal('show');

  }

  function seleccionar(pla_ubicacion,imagen)
  {
    

    if (pla_ubicacion == 'plantilla_1') {
      var intro = document.getElementById('imagenes_1');
          intro.style.backgroundImage = `url(${imagen})`;
          $("#vista_previa_1").modal('show');
    } else if (pla_ubicacion == 'plantilla_2') {
      var intro = document.getElementById('imagenes_2');
          intro.style.backgroundImage = `url(${imagen})`;
          $("#vista_previa_2").modal('show');
    } else if (pla_ubicacion == 'plantilla_3') {
      var intro = document.getElementById('imagenes_3');
          intro.style.backgroundImage = `url(${imagen})`;
          $("#vista_previa_3").modal('show');
    }
  
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

