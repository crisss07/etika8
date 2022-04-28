<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sitio = $this->tool_entidad->sitioindex();
$prefijo = $this->prefijoF;

$salario = $_SESSION[$this->presession . 'salario'];
$contador = $_SESSION[$this->presession . 'contador'];
$disponibilidad = $_SESSION[$this->presession . 'disponibilidad'];

$dato_concatenado = $salario . '_' . $contador . '_' . $disponibilidad;
?>
<style>
.con-preloader{
  display:none;
width:100%;
  height:100%;
  border: 1px solid white; background: #fff;padding: 20px;border-radius: 20px; opacity:0.9;
  position: absolute;
  align-items:center;
  top: 0;
  bottom: 4%;
  right: 0;
  left: 0;
 
}
.preloader::after { 
  position:absolute;
   top: 0;
  bottom: 4%;
  right: 0;
  left: 0;
  content: " ";
  display: block;
  
  margin: auto;
  height: 62px;
  width: 62px;
  
  box-sizing: border-box;
  border: solid;
  border-width: 10px;
  border-radius: 50%;
  border-top-color: rgba(140, 140, 140, 0.55);
  border-bottom-color: rgba(140, 140, 140, 0.2);
  border-right-color: rgba(140, 140, 140, 0.2);
  border-left-color: rgba(140, 140, 140, 0.2);
  
  animation: rotating 0.9s linear infinite;
}

@keyframes rotating{
  from {
    transform:rotate(0deg);
  }
  to {
    transform:rotate(360deg);
  }
}

</style>
<div class="container">
    <br/>
    <br/>
    <div class="row justify-content-md-center align-items-md-center">
        <div class="col-md-5 col-lg-4" style="border: 1px solid white; background: #fff;padding: 20px;border-radius: 20px;">
            <?php echo form_open_multipart(@$action . '/convocatoria/cvtemporal'); ?>
            <div class="row text-left">
                <div class="col-md-12 text-center">
                    <!--<h2 class='titulo-formulario'>Usted esta postulando al cargo</h2>-->
                    <!--<h2 class='titulo-formulario bold'>"<?php echo $cargo; ?>"</h2>-->
                    <h2>Subir archivo adjunto </h2>
                </div>

                <div class="col-md-12">

                    <span class="texto2" style="font-size: 12px;"><b>Nota.</b>
                        <br/>- El peso máximo permitido 2MB.
                        <br/>- Formato permitido .PDF, .doc, .docx.
                        <br/>- El documento es válido para esta única postulación.
                    </span>
                    <br/>
                    <br/>
                </div>
                <div class="col-md-12" id="cajaArchivo">
                    <div class="card">
                        <input type="file" id="input-file-input" class="dropify"  accept=
"application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*,.xlsx,.docx,.pptx"   name="cvt_docnombre"  data-allowed-file-extensions='["pdf","doc","docx","xlsx","xls","pptx","ppt","jpg","jpeg","gif","png"]' data-max-file-size="2M" />
                    </div>
                </div>
            </div>
            <br/>
            <div class="col-md-12">
                <div class="error"><p><?php echo $mensaje; ?></p></div>
                <a href="<?php echo $sitio.'convocatoria/editardatos/' . $dato_concatenado;?>#" class="btn-etika btn">Cancelar</a>
                <!--<a href="<?php //echo $sitio.'convocatoria/postular';?>" class="btn-etika btn">Cancelar</a>-->
                <input class="btn-etika btn" type="submit" value="Subir CV" id="guardar" onclick="funcionCargar()" />
                <br/>
            </div>
            <?php echo form_close(); ?>
      <div id="preloader" class="con-preloader" style="">
          <div class="preloader"></div>
        </div>
        </div>
    
    </div>

</div>
<script>
function funcionCargar() {
  var x = document.getElementById('preloader');
  var y = document.getElementById('cajaArchivo');
  x.style.display = "block";
  y.style.visibility= "hidden";
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
   
        var drEvent = $('#input-file-input').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });
        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });
        drEvent.on('dropify.errors', function(event, element) {
            console.log('error del archivo');
            $('#guardar').hide();
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