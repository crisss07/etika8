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
                <span class="cabecera_titulo">Grupo Evaluacion</span>
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

              <?php echo anchor($this->controlador.'listar','Listado',array('class' =>'enlace_listar enlace_a1')); ?>
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

<?php echo form_open_multipart('evaluacion/update_grupo'); ?>   
<input type="hidden" name="id_grupo" value="<?php echo $data_grupo->gru_id; ?>">
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4" align="left">
    <div class="form-group">
      <label>Titulo Grupo Evaluacion: </label>
      <input type="text" class="form-control input1" value="<?php echo $data_grupo->gru_nombre; ?>" name="titulo" readonly >
    </div>    
    <div class="form-group">
      <label class="control-label">Cliente: </label>
      <select class="form-select-21" id="cliente" name="cliente" required="">
        <option value="<?php echo $data_grupo->cli_id; ?>"><?php echo $data_grupo->cli_nombre; ?></option>
        <?php foreach ($clientes as $tp) : ?>

          
          <?php if ($data_grupo->cli_id!=$tp->cli_id): ?>
          <option value="<?php echo $tp->cli_id; ?>"><?php echo $tp->cli_nombre; ?></option>  
          <?php endif ?>


        <?php endforeach; ?>


      </select>
    </div>
     <div class="form-group">
      <label>Fecha Vigencia: </label>
      <input type="date" class="form-control input1" value="<?php echo $data_grupo->gru_fecha_vigencia; ?>" name="fecha_vigencia" required="">
    </div>  

  </div>
</div>



<p></p>
<div class="row" align="center" >
  <div class="col-md-12">
    <button type="submit" class="btn-etika btn" id="guardar" >Guardar</button>
  </div>  
</div>
</form>

<p></p><p></p>

<script>
    $(document).ready(function(){

       $('#tipo_eval').on('change',function(){

         var tipo_id = $('#tipo_eval').val();
         

         console.log(tipo_id);
   // AJAX request
   if (tipo_id==1) {

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

   if (tipo_id==2) {
     $('#dato_tipo').html('');
   }

   



});
   });
</script>