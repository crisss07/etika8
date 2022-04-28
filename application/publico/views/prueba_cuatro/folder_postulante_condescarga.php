<link rel="stylesheet" type="text/css" href="<?php echo $this->tool_entidad->sitio(); ?>files/dropify/dist/css/dropify.min.css">
<script src="<?php echo $this->tool_entidad->sitio(); ?>files/js/funcionesjs.js" type="text/javascript"></script>
<script src="<?php echo $this->tool_entidad->sitio(); ?>files/dropify/dist/js/dropify.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
<!-- stilos spiner -->
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
<!-- stilos spiner -->
<div id="listado" style=" padding: 20px;">
    <?php
    $this->load->view('cabecera');
    ?>
    <?php
    // $prefijo = $this->prefijo;
    $msj_confirmar = '¿Está seguro que desea eliminar el elemento seleccionado?';
    $sitio = $this->tool_entidad->sitioindexpri();
    $alineacionw = 'center';
    $alineacionw1 = 'left';
    $alineacionh = 'middle';
    ?>
    <br/>
    <div class="scrollh">
		<div class="row">
			<div class="col-md-2">
			</div>
			<div class="col-md-8">
				<?php echo $texto; ?>
			</div>
			<div class="col-md-2">
			</div>
		</div>
	</div>
	<br>
    <div class="scrollh">
        <div class="row">
            <div class="col-md-4"></div>
                <div class="col-md-4"> 
                    <?php echo form_open_multipart('Prueba_cuatro/uploadPostulante'); ?>
                    <input type="hidden" name="idev" value="<?php echo $idev; ?>">
                    <input type="hidden" name="idgrupo" value="<?php echo $idgrupo; ?>">
                    <input type="hidden" name="nombre_carpeta" value="<?php echo $nombre_carpeta; ?>">
                    <div class="form-group" id="cajaArchivo">
                        <div class="card">
                            <!-- <label for="recipient-name" class="control-label">Archivo</label> -->
                            <label for="input-file-now">

                                <i class="fas fa-exclamation" style="color:red"> </i>                                            
                                Solo se admite archivos no aplicaciones
                            </label>

                            <input type="file" id="input-file-now" class="dropify"  accept=
                            "application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
                            text/plain, application/pdf, image/*,.xlsx,.docx,.pptx,video/*,.flv"   name="userfile"  data-allowed-file-extensions='["pdf","doc","docx","xlsx","xls","pptx","ppt","jpg","jpeg","gif","png","avi","mov","flv","mp4","webm","mkv"]' data-max-file-size="49M" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="guardar" style="font-size: 12px;" onclick="funcionCargar()">Cargar Archivo</button>
                    </div>

                </form>
                 <div id="preloader" class="con-preloader" style="">
                        <div class="preloader"></div>
                   </div>
            </div>
        </div>

         <div class="row justify-content-center">
            <div class="col-md-9">
                 <table  class="table table-cell" cellspacing="0" width="70%" >
            <thead>
                <tr class="cabecera_listado" style="background-color:#AFA694;">

                    <th>Archivos</th>
                    <th>Descargar</th>
                    <th>Eliminar</th>  
                    

                </tr>
            </thead>
         
            <tbody>
            <?php $color=0;?>
            <?php $sw=0; $pos=0; ?>
            

                <?php foreach ($lista as $row) { ?>
                    <?php if ($sw==0): ?>
                        <?php 

                    $archivo=[];
                    $archivo=explode( '/', $row['Key'] );
                    $longitud=count($archivo)-1;
                    $sw=1;

                     ?>
                    <?php endif ?>

                    <?php 
                    $archivo=[];
                    $archivo=explode( '/', $row['Key'] );
                     ?>
                     <?php if ($pos==1): ?>
                                 <!--aplicamos color a las celdas-->
              

                
                    <?php if ($color==0): ?>
                        <tr class="<?php echo 'fila-color-1'; $color=1; ?>">
                        <?php else: ?>
                        <tr class="<?php echo 'fila-color-2'; $color=0; ?>">
                        
                    <?php endif ?>
                    <!--fin de color a las celdas-->
                        <td>                          
                            
                                    <ul class="icheck-list">                  
                                     <?php echo $archivo[$longitud]; ?>
                                     </ul>
                                     
                                </td>
                                <td style="width: 10px;font-size: 8px;" >                                    
                                  <a href="<?php echo $bucket_url;?><?php echo $row['Key']; ?>" class="btn btn-info btn-sm" title="Descargar" data-toggle="tooltip"  download> <i class="fas fa-arrow-alt-circle-down"></i></a>
                            
                          </td>
                          <td style="width: 10px;font-size: 8px;" >
                              <a href="<?php echo $sitio.$this->controlador.'eliminar_postulante/'.$idgrupo.'/'.$idev.'/?carpeta='.$nombre_carpeta.'&archivo='.$row['Key']; ?>" class="btn btn-warning btn-sm" title="Eliminar" data-toggle="tooltip"  > <i class="fas fa-trash-alt"></i></a>
                          </td>
                      </tr>
                 
                  
           
                     <?php endif ?>
                     <?php $pos=1; ?>





                       <?php 
                   } ?>
               </tbody>
           </table>



       </div>
                  
            </div>
        </div>

</div>
<!-- dropify -->
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




        var drEvent = $('#input-file-now').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });
        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });
        drEvent.on('dropify.errors', function(event, element) {
            console.log('el archivo tiene errores');
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
</script>
<!-- deshabilitar boton -->
<script>
    $('#guardar').hide();
    var myfile="";



$('#input-file-now').on( 'change', function() {
   myfile= $( this ).val();
   var ext = myfile.split('.').pop();
   if(ext=="exe" || ext=="zip" || ext=="rar"|| ext=="7zip"){
       //alert(ext);
       $('#guardar').hide();
   } else{
       //alert(ext);
       $('#guardar').show();
   }
});
</script>


<!-- spiner de carga -->

<script>
function funcionCargar() {
  var x = document.getElementById('preloader');
  var y = document.getElementById('cajaArchivo');
  x.style.display = "block";
  y.style.visibility= "hidden";
}
</script>