



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
                <span class="cabecera_titulo">Plantilla</span>
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
      
        <table width="100%"><tr><td>
          <table align="center" width="100%">
            <tr>
              <td class="enlaces_add_edit" align="left" width="100%">

        <?php echo anchor('Plantilla/listar','Listado Plantillas',array('class' =>'enlace_listar enlace_a1')); ?>
              &nbsp;&nbsp;
         <?php echo anchor('Plantilla/listar', 'Cancelar', array('class' => 'enlace_cancelar enlace_a1')); ?>                   
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

<?php }?>
</div>
</div>
<input type="hidden" value="<?php echo $id; ?>" name="id_plantilla" id="id_plantilla" >

<div class="row justify-content-center">
  <div class="col-md-2">   
  <label for="">Factor:</label>    
      <select class="form-select-21"  name="factor_id" id="factor_id" required="">
        <option value="">Seleccione Factor</option>
        <?php foreach ($factores_st as $tp) : ?>
          <option value="<?php echo $tp->factor_id; ?>"><?php echo $tp->letra; ?></option>
        <?php endforeach; ?>
      </select>
  </div>
</div>
<p></p><p></p>





<div class="row justify-content-center">

  <div class="col-md-12" id="data_ajax">
    
  </div>
  
</div>






<p></p><p></p>

<script>
  (function() {
    var
    integers = document.querySelectorAll('input[type="number"][step="1"]'),
    intRx = /\d/;

    for (var input of integers) {
      input.addEventListener('keydown', integerChange, false);
    }

    function integerChange(event) {
      if (
        (event.key.length > 1) || 
        (
          (event.key === "-") &&
          (event.currentTarget.value.length === 0)
          ) ||
        intRx.test(event.key)
        ) return;
        event.preventDefault();
    }

  })();
</script>
<!-- ajax baremo -->
<script>
  $(document).ready(function(){       
    $('#factor_id').on('change',function(){
      var factor_id = $('#factor_id').val();
      var id_plantilla = $('#id_plantilla').val();
      console.log('id::'+factor_id+'conv::'+id_plantilla);
   // AJAX request
    $.ajax({
      async: false,
    url: '<?php echo $this->tool_entidad->sitio().'admin.php/Prueba_tres/vista_ajax_factor' ?> ',
    type: 'post',
    data: {id_plantilla:id_plantilla,factor_id:factor_id},
    dataType: "html",
    success: function(response){ 
      // Add response in Modal body
      $('#data_ajax').text('');
      $('#data_ajax').html(response);

      
  }

}); 
});
  });
</script>