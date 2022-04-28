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
<?php
@$prefijosup = $this->prefijosup;
@$prefijo = $this->prefijo;
@$rutasup = $this->rutarchivo . $this->carpetasup;
@$ruta = $this->ruta . $this->carpeta;
@$rutabaseimg = $this->rutabaseimg . $this->carpeta;
$sitiop = $this->tool_entidad->sitiopri();

//$this->rutabase=$this->tool_entidad->sitioindex();
?>
<div class="container" style="position: sticky;top: 0;z-index: 10;">
    <div class="row justify-content-end">
        <div class="col-md-4">
            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #fff !important;">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <!-- <li class="nav-item active">
                            <?php echo anchor('postulante/editar_cv/id/' . $_SESSION[$this->presession . 'id'], '<img border="0" src="' . $this->tool_entidad->sitio() . 'files/img/cv.png" title="Editar Curriculum Vitae" />', array('class' => "enlace_a1")); ?> -->
                            <!--                            <a href="#"  class="enlace_a1"><img border="0" src="<?php echo $this->tool_entidad->sitio() . 'files/img/cv.png'; ?>" title="Editar Curriculum Vitae" /></a>-->
                            <!--<a href="#" onclick="mensaje_editar_cv1()" class="enlace_a1"><img border="0" src="<?php echo $this->tool_entidad->sitio() . 'files/img/cv.png'; ?>" title="Editar Curriculum Vitae" /></a>-->
                            <!-- </li> -->
                            <li class="nav-item">
                                <a href="<?php echo $sitiop . 'ninicio'; ?>" class="enlace_a1"><img border="0" src="<?php echo $this->tool_entidad->sitio() . 'files/img/volver_inicio.png'; ?>" title="Volver" /></a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo $sitiop . 'postulante/editar_cv/id/'. $_SESSION[$this->presession . 'id']; ?>" class="enlace_a1"><img border="0" src="<?php echo $this->tool_entidad->sitio() . 'files/img/cv.png'; ?>" title="Editar" /></a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo $sitiop . 'ninicio/imprimir_doc/id/' . $_SESSION[$this->presession . 'id']; ?>"class="enlace_a1"><img border="0" src="<?php echo $this->tool_entidad->sitio() . 'files/img/cv_des.png'; ?>" title="Descargar CV Sistema" /></a>
                            <!-- <a href="http://localhost/sisetika/admin.php/postulante/imprimir_doc/id/23037" target="_blank" class="enlace_a1">Imprimir</a>
                            <td align="center" valign="<?php echo $alineacionh; ?>">
                                <?php echo anchor($this->controlador . 'imprimir_doc/id/' . $fila[$prefijo . 'id'], 'Imprimir', array('target' => '_blank', 'class' => 'enlace_a1')); ?>
                            </td> -->
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $sitiop . 'contacto'; ?>" class="enlace_a1"><img border="0" src="<?php echo $this->tool_entidad->sitio() . 'files/img/conta.png'; ?>" title="Contáctenos" /></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $sitiop . 'postulante/cambiarpass'; ?>" class="enlace_a1"><img border="0" src="<?php echo $this->tool_entidad->sitio() . 'files/img/contrasena.png'; ?>" title="Cambiar Contraseña" /></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $sitiop . 'inicio/cerrar_session'; ?>"class="enlace_a1"><img border="0" src="<?php echo $this->tool_entidad->sitio() . 'files/img/cerrar.png'; ?>" title="Cerrar Sesión" /></a>
                        </li>
                        
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="titulo-etika text-center" style="font-size: 18px; color: #695E4B;font-weight: bold">área del postulante</h2>
        </div>
    </div>
    <div class="row justify-content-center justify-content-md-around">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-6 text-left">
                    <span style="color:#000000; font-weight: bold;" >USUARIO: </span> <span style="color:#000000; font-weight: normal;" ><strong><?php echo $_SESSION[$this->presession . 'usuario']; ?></strong></span><br/>
                    <span style="color:#000000; font-weight: bold;" >NOMBRE: </span> <span style="color:#000000; font-weight: normal;" ><strong><?php echo strtoupper($_SESSION[$this->presession . 'nombre']); ?></strong></span>
<!--                    <span style="color:#3E677B; font-weight: bold;" >USUARIO: </span> <span style="color:#695E4B; font-weight: normal;" ><strong><?php echo $_SESSION[$this->presession . 'usuario']; ?></strong></span><br/>
    <span style="color:#3E677B; font-weight: bold;" >NOMBRE: </span> <span style="color:#695E4B; font-weight: normal;" ><strong><?php echo $_SESSION[$this->presession . 'nombre']; ?></strong></span>-->
</div>
<div class="col-md-6">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-start justify-content-md-end justify-content-lg-end justify-content-xl-end">
            <div class="cuadro_estado_postulante">
                <?php if ($estado['estado']) { ?>
                    <div class="habilitado">ESTADO: &nbsp;<?php echo anchor('postulante/ndeshabilitar/id/' . $id, 'DISPONIBLE', array('class' => "enlace_estado", 'title' => 'Está habilitado a postularse a un cargo por más de que no se vincule directamente (podría por ejemplo ser encontrado con un filtro por profesión y ser contactado).')); ?> &nbsp; </div>
                <?php } else { ?>
                    <div class="deshabilitado">ESTADO: &nbsp;<?php echo anchor('postulante/nhabilitar/id/' . $id, 'NO DISPONIBLE', array('class' => "enlace_estado", 'title' => 'Su información está en la Base de datos de ETIKA, por el momento usted no está disponible para postularse o ser encontrado por nuestros filtros (por ejemplo porque está trabajando).')); ?> &nbsp; </div>
                <?php } ?>
                <div class="nota_alerta" style="padding: 5px;"><br/>
                    <?php if ($estado['estado']) { ?>
                        <span style="text-decoration: underline;">Nota.-</span> Está habilitado a postularse a un cargo por más de que no se vincule directamente (podría por ejemplo ser encontrado con un filtro por profesión y ser contactado).
                    <?php } else { ?>
                        <span style="text-decoration: underline;">Nota.-</span> Su información está en la Base de datos de ETIKA, por el momento usted no está disponible para postularse o ser encontrado por nuestros filtros (por ejemplo porque está trabajando).            
                    <?php } ?>                        
                </div>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-start justify-content-md-end justify-content-lg-end justify-content-xl-end">
        <div class="col-md-6">

        </div>
    </div>
</div>
</div>
</div>
</div>
<br/>
<!-- noticias -->
<style>
    .contenedor-novedades-img
    {
        min-height: 120px;
        max-height: 120px;
        
    }
</style>
<div class="row justify-content-center">
        <div class="col-md-10 " >
            <?php if ($validacion_noticias_etika==1): ?> 
                <?php for ($i=0; $i <count($nt_row); $i++) { ?>
                <div class="row ">
                    <div class="col-md-6 " align="center">
                        <div class="contenedor-novedades-img" >
                            <a href="<?php echo $sitiop.'ninicio/mostrar_noticia/'.$nt_row[$i]['not_id']; ?>" title="Ver Noticia" data-toggle="tooltip" >
                        <img src="<?php echo $this->tool_entidad->aws_url().'archivos/noticias/'.$nt_row[$i]['not_img1']; ?>"  alt="Responsive image" height="120px" >
                        </a>
                        </div>
                        <p></p>
                        <div class="titulo_postulaciones" style="color:#000;text-transform: uppercase;"><?php echo $nt_row[$i]['not_titulo']; ?>
                        </div>
                        
                        
                    </div>
                    <?php $j=$i+1; ?>
                    <div class="col-md-6 " align="center">
                        <div class="contenedor-novedades-img" >
                   <?php if ($j<count($nt_row)): ?>
                        <a href="<?php echo $sitiop.'ninicio/mostrar_noticia/'.$nt_row[$i+1]['not_id']; ?>" title="Ver Noticia" data-toggle="tooltip" >
                        <img src="<?php echo $this->tool_entidad->aws_url().'archivos/noticias/'.$nt_row[$i+1]['not_img1']; ?>" height="120px" alt="Responsive image" >
                            </a>
                            <p></p>
                            <div class="titulo_postulaciones" style="color:#000;text-transform: uppercase;"><?php echo $nt_row[$i+1]['not_titulo']; ?>
                        </div>

                   <?php endif ?>
                     </div>
                    </div>
               
                  
                    
                </div>
            
            <?php $i++; ?>
               
            
            

        <?php } ?>
              

                        
            <?php endif ?>
        </div>
</div>
<!-- fin de noticias -->

<p></p>

  
  






</div>


</td>
</tr>
            
</table>        
</div>
</div>





