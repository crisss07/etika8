<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

<SCRIPT LANGUAGE=JavaScript>
    function mensaje() {
        alert("Su Curriculum Vitae debe estar completo para poder postularse.");
    }
    function mensaje1() {
        alert("Su Estado debe estar Disponible para poder postularse.");
    }
    function mensaje_cv() {
        alert("Su Estado debe estar Disponible para poder postularse.");
    }
</SCRIPT>
<div class="container">
    <!-- noticias -->
    <?php //if ($validacion_noticias_etika!=0): ?>        
    <div class="row justify-content-center">
        <div class="col-md-10 text-left" >
            <div class="box-acordeon">
                <h5 class="text-left title">Noticias de interes</h5>
            </div>
            <?php //foreach ($noticias_etika as $nt_row ): ?>
                <div class="card mb-3">
                  <div class="row g-0">
                    <div class="col-md-4" align="center" style=" display: flex;
  justify-content: center;
  align-items: center;">
                      <!-- <img src="<?php echo $this->tool_entidad->sitio() . 'files/img/logo-etika.png'; ?>" class="img-fluid rounded-start" alt="..."> -->
                       <img src="https://elasticbeanstalk-us-east-2-676905610441.s3.us-east-2.amazonaws.com/archivos/noticias/img_noticia_2.png" class="img-fluid" alt="Responsive image" width="200">
                    </div>

                    <div class="col-md-8">
                      <div class="card-body">
                        <h1 class="card-title">INVITACIÓN INVESTIGACIÓN TEST EN BOLIVIA</h1>
                        <p class="card-text">Te agradecemos por la confianza de ser parte de nuestra comunidad de profesionales interesados en convocatorias. <br>
                        Te enviamos a tu correo electrónico una invitación para participar en una investigación que busca formalizar un instrumento psicológico aplicado al contexto laboral boliviano. Si no recibiste el correo revisa tu bandeja de spam.</p>
                        <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                        <button type="button" class="btn btn-info">Saber más..</button>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
            <?php //endforeach ?>
        </div>
    </div>
    <?php //endif ?>
</div>






