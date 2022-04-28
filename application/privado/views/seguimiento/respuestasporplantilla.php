<?php $msj_confirmar='¿Está seguro que desea eliminar el elemento seleccionado? \nSe eliminará todos los procesos que hagan referencia a este elemento en la Base de Datos.'; ?>

<table align="center" width="100%">
  <tr>
    <td class="enlaces_add_edit" align="left" width="100%">
      <p></p><p></p>
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
                <span class="cabecera_titulo">Grupo Evaluaci&oacute;n</span>
                <span class="flecha2">&rarr;</span>
                <span class="cabecera_accion"> <?php echo $cabecera['accion'];?></span>
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


<div class="row">
  <div class="col-md-12">
  <?php
  $sitio=$this->tool_entidad->sitioindexpri();
  ?>
  <div class="paginacion_lista"><?php //echo $this->pagination->create_links();?></div>

  <?php
  if(!@$this->nolistar){
    ?>
    <form action="<?php echo $sitio.$this->controlador.'procesar'?>" method="post" id="form_listar_fsimple">
      <table width="100%"><tr><td>
        <table align="center" width="100%">
          <tr>
            <td class="enlaces_add_edit" align="left" width="100%">

              <?php echo anchor('Reportes','Cancelar',array('class' =>'enlace_cancelar enlace_a1')); ?>
              &nbsp;&nbsp;
                                
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
  

  <br/>
  <br/>
</form>
<?php }?>
</div>
</div>

<?php echo form_open_multipart('Seguimiento/generar_xls'); ?>   


<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-4" align="left">
    <div class="row">
      <div class="col-md-6" align="left">
        <div class="form-group">
      <label>Desde: </label>
      <input type="date" class="form-control input1" value="" name="fecha_ini" required="">
    </div>
      </div>
      <div class="col-md-6" align="left">
      <div class="form-group">
      <label>Hasta: </label>
      <input type="date" class="form-control input1" value="" name="fecha_fin" required="">
    </div>
      </div>
    </div>

    
    <div class="form-group">
      <label class="control-label">Plantilla: </label>
      <select class="form-select-21" id="id_plantilla" name="id_plantilla" required="">
        <option value="">Seleccione Plantilla</option>
        <?php foreach ($plantilla as $tp) : ?>
          

          <option value="<?php echo $tp->zpla_id; ?>,<?php echo $tp->ztipo_eval_id; ?>"><?php echo $tp->zpla_titulo; ?></option>


        <?php endforeach; ?>


      </select>
    </div>
    

  </div>
</div>
<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-4" align="left">
    <div id="dato_tipo">      
    </div>
  </div>
</div>


<p></p>
<div class="row" align="center" >
  <div class="col-md-12">
    <button type="submit" class="btn-etika btn" id="guardar" >Generar</button>
  </div>  
</div>
</form>

<p></p><p></p>

<script>
    $(document).ready(function(){

       $('#id_plantilla').on('change',function(){

        // $('#strings').val(values.split(','));

         var tipo_id = $('#id_plantilla').val();
         tipo_id=tipo_id.split(',');

         tipo_id=tipo_id[1];


         

         console.log(tipo_id);
   // AJAX request
   if (tipo_id==3) {

    $.ajax({
    url: 'caja_tipo',
    type: 'post',
    data: {tipo_id:tipo_id},
    dataType: "html",
    success: function(response){ 
      // Add response in Modal body
      $('#dato_tipo').html(response);

      
  }

});

   }

   if (tipo_id!=4 && tipo_id!=3) {
     $('#dato_tipo').html('');
   }

   



});
   });
</script>