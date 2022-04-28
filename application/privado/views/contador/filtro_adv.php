<table align="center" width="100%">
  <tr>
    <td class="enlaces_add_edit" align="left" width="100%">
     <?php
     if(count($cabecera))
     {
      ?>
      <table align="center">
        <tr>
          <td>
           <?php
           if(!@$this->notitulo)
           {
             ?>
             <?php
             if(@$cabecera['titulo_general'])
             {
              ?>
              <span class="cabecera_titulo">Reportes</span>
              <br/>
              <?php
            }
            ?>
            <?php
            if($cabecera['titulo'])
            {
              ?>
              <span class="cabecera_titulo">Reportes</span>
              <?php
            }
            if($cabecera['accion'])
            {
              ?>
              <span class="flecha2">&rarr;</span>
              <span class="cabecera_accion">Conteo por Convocatoria</span>
              <?php
            }
          }
          ?>

        </td>
      </tr>
      <tr><td colspan="2"><div class="linea1"></div></td></tr>
    </table>
    <?php
  }
  ?>
</td>

</tr>
</table>



<?php
$prefijo=$this->prefijo;


if(@$this->carpetaup){
  $ruta=$this->rutarchivo.$this->carpetaup;
}
else{
  $ruta=@$this->rutarchivo.$this->carpeta;
}

$alineacionw='center';
$alineacionh='middle';

?>


<div id="listado">
  <?php
  $sitio=$this->tool_entidad->sitioindexpri();
  ?>
  <div class="paginacion_lista"><?php //echo $this->pagination->create_links();?></div>

  <?php
  if(!@$this->nolistar){
    ?>
    
    <table width="100%"><tr><td>
      <table align="center" width="100%">
        <tr>
          <td class="enlaces_add_edit" align="left" width="100%">
            <?php echo anchor('Reportes', 'Cancelar', array('class' => 'enlace_cancelar enlace_a1')); ?>                   
          </td>
        </tr>
      </table>


    </td><td align="right">
      <!-- ini combo buscar -->

      <!-- fin combo buscar -->
    </td>
  </tr>
</table>
<br>
<input type="hidden" name="idp" value="<?php echo @$this->idp;?>" id="idp"/>
<input type="hidden" name="tip" value="<?php print_r(@set_value($this->tip,$this->tip));?>">
<input type="hidden" name="destacadomas" value="<?php print_r(@set_value($destacadomas,$destacadomas));?>">

<br> <br>
<!-- forom ajax -->
<div class="row" >
  <div class="col-md-4"></div>
  <div class="col-md-2">
    <div class="form-group" align="left">
      <label><code>*</code> Fecha Inicial</label> <br>
      <input type="date" class="input1" id="fech_ini">
    </div>
  </div>
  <!--/span-->
  <div class="col-md-2">
    <div class="form-group" align="left">
      <label><code>*</code> Fecha Final</label><br>
      <input type="date" class="input1" id="fech_fin">
    </div>
  </div>
  <!--/span-->
</div>
<div class="row" >
  <div class="col-md-3"></div>
  <div class="col-md-3">
    <div class="form-group" align="left">
      <label>Instancia</label>
      <select class="form-select-21" id="instancia_id">
        <option value="0">Todas las instancias</option>
        <option value="1">EP</option>
        <option value="2">TP</option>
        <option value="3">Assesment</option>
        <option value="4">Entrevista</option>
        <option value="5">Finalista</option>
        <option value="6">Elegido</option>
      </select>
    </div>
  </div>
  <div class="col-md-6" id="convocatoria">


  </div>

                                                 <!-- <div >
                                                <br>
                                                  <br>
                                                    <button class="btn-etika btn" id="gen" > Generar</button>
                                                  </div> -->

                                                </div>

                                                <!-- fin form ajax -->
                                                <br><br>

                                                <div id="tabla_listado">
<!-- 
  <table  align="center" class="tabla_listado"  cellspacing="0" width="100%" >
    
    <tr class="cabecera_listado">


      
         <td align="center" valign="">Nro</td>
         <td align="center" valign="">Nombre</td>
         <td align="center" valign="">Conteo</td>
         
      
   </tr>
   <?php
   foreach ($datos as $fila)
   {
    ?>
    <tr>
      <td align="center"> <?php  print_r($fila['con_id']); ?> </td>
      <td align="center" valign="middle">
       <?php  print_r($fila['con_nombre']); ?>
     </td>                     
     <td align="center" valign="middle"> <?php  print_r($fila['total']); ?></td>
   </tr>
   <?php
 }
 ?>
</table> -->

</div>
<br/>
<br/>
</form>
<?php }?>
</div>

<!-- <script src="<?php echo base_url(); ?>public/assets/plugins/jquery/jquery.min.js"></script> -->

<script>
  $(document).ready(function(){

   $('#convss').on('change',function(){

     var conv_id = $('#conv').val();


     console.log(conv_id);
   // AJAX request
   $.ajax({
    url: 'detalle_tabla',
    type: 'post',
    data: {conv_id:conv_id},
    dataType: "html",
    success: function(response){ 
      // Add response in Modal body
      $('#tabla_listado').html(response);

      
    }

  });
 });
 });
</script>

<script>
  $(document).ready(function(){
   $('#gen').click(function(){


     var conv_id = $('#conv').val();
     var fech_ini = $('#fech_ini').val();
     var fech_fin = $('#fech_fin').val();
     console.log(conv_id,fech_ini,fech_fin);
   //ajax request
   $.ajax({
    url: 'detalle_tabla',
    type: 'post',
    data: {conv_id: conv_id,fech_ini:fech_ini,fech_fin:fech_fin},
    dataType: "html",
    success: function(response){ 
      // Add response in Modal body
      $('#tabla_listado').html(response);

      // Display Modal
      //$('#detalle_seleccion').html('show'); 
    }

  });
 });
 });
</script>

<script>
  $(document).ready(function(){
      // $('#gen').hide();
      $('#fech_fin').change(function(){


       var fech_ini = $('#fech_ini').val();
       var fech_fin = $('#fech_fin').val();
       console.log(fech_ini,fech_fin);

       $.ajax({
        url: 'comboconvocatorias',
        type: 'post',
        data: {fech_ini:fech_ini,fech_fin:fech_fin},
        dataType: "html",
        success: function(response){ 
         $('#convocatoria').html(response);
         $('#tabla_listado').empty();
       }
     });
     });
    });
  </script>
  <!-- on click -->
  <script>
    function generar() {
     var conv_id = $('#conv').val();
     var instancia_id = $('#instancia_id').val();

     console.log(conv_id,instancia_id);
   //ajax request
   $.ajax({
    // url: 'detalle_tabla',
    url: 'detalle_conv_instancia',
    type: 'post',
    data: {conv_id: conv_id,instancia_id:instancia_id},
    dataType: "html",
    success: function(response){ 
      // Add response in Modal body
      $('#tabla_listado').html(response);

      // Display Modal
      //$('#detalle_seleccion').html('show'); 
    }

  });
 }
</script>


<script>
  $(document).ready(function(){
   $('#genss').click(function(){

     var conv_id = $('#conv').val();
     var fech_ini = $('#fech_ini').val();
     var fech_fin = $('#fech_fin').val();
     console.log(conv_id,fech_ini,fech_fin);
   //ajax request
   $.ajax({
    url: 'codigo_ajax',
    type: 'post',
    data: {conv_id: conv_id,fech_ini:fech_ini,fech_fin:fech_fin},
    dataType: "json",
    success: function(data){ 
     console.log(data);
   }
 });
 });
 });
</script>

<!-- limpiar datos de la tabla -->

<script>
  $(document).ready(function(){
      // $('#gen').hide();
      $('#fech_ini').change(function(){
        $('#tabla_listado').empty();   
      });
    });
</script>

<script>
  $(document).ready(function(){
      // $('#gen').hide();
      $('#instancia_id').change(function(){
        $('#tabla_listado').empty();   
      });
    });
</script>


