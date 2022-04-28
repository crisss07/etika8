<?php $msj_confirmar='¿Está seguro que desea eliminar el elemento seleccionado? \nSe eliminará todos los procesos que hagan referencia a este elemento en la Base de Datos.'; ?>

<script type="text/javascript">
  $(function() {
    $('textarea.tinymcesimple').tinymce({
      // Location of TinyMCE script
      script_url : '<?php echo $this->tool_entidad->sitio();?>files/js/tinymce/jquery_tiny_mce/tiny_mce_gzip.php',

      // General options
      theme : "simple",
      plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

      // Theme options
      theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
      theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
      //theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
      //theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
      theme_advanced_toolbar_location : "top",
      theme_advanced_toolbar_align : "left",
      theme_advanced_statusbar_location : "bottom",
      //theme_advanced_resizing : true,

      // Example content CSS (should be your site CSS)
      //content_css : "css/example.css",
                        content_css : "<?php echo $this->tool_entidad->sitio();?>files/css/editor_tiny.css",

      // Drop lists for link/image/media/template dialogs
      template_external_list_url : "lists/template_list.js",
      external_link_list_url : "lists/link_list.js",
      external_image_list_url : "lists/image_list.js",
      media_external_list_url : "lists/media_list.js",

      // Replace values for the template plugin
      template_replace_values : {
        username : "Some User",
        staffid : "991234"
      }
    });
  });
</script>

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
                <span class="cabecera_titulo">Evaluaci&oacute;n</span>
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
  <div class="col-md-12" align="left">
  <?php
  $sitio=$this->tool_entidad->sitioindexpri();
  ?>

    <?php echo anchor($this->controlador.'listar/', 'Cancelar', array('class' => 'enlace_cancelar enlace_a1')); ?>  
  

  </div>
</div>
<br>

<?php echo form_open_multipart('Evaluacion/upd_mensaje_eval'); ?>  
<div class="row">
  <div class="col-md-4" style="font-size:16px;vertical-align: center;" align="right">Mensaje predefinido:</div>
  <div class="col-md-4" align="left">

    
        
    <div class="form-group">
      <!-- <label class="control-label" >Mensaje predefinido: </label> -->
      <select class="form-select-21" id="texto_mensaje" name="texto_mensaje" >
       <option value="">Seleccione un mensaje</option>
       <?php foreach ($combo_texto as $tp) : ?>

      <option value="<?php echo $tp->texto_id; ?>"><?php echo $tp->titulo; ?></option>


    <?php endforeach; ?>


      </select>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4" style="font-size:16px;vertical-align: center;" align="right">Texto a mostrar:</div>
  <div class="col-md-4" align="left">
    
    <input type="hidden" class="form-control" value="<?php echo $id_grupo; ?>" name="id_grupo"    >
  
    
        
          <?php                 
                echo form_textarea(array(
                    'name' => 'texto_bienvenida',
                    'id' => 'texto_bienvenida',
                    'rows' => '5',
                    'cols' => '60',
                    'class'=>'textarea',
                    'class'=>'tinymce',
                    'value' =>$texto
                    

                  ));

                
            ?>
  
    
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

    $('#texto_mensaje').on('change',function(){

    var texto_id = $('#texto_mensaje').val();
         

         console.log(texto_id);
   // AJAX request
   // 

    $.ajax({
    url: '<?php echo $this->tool_entidad->sitiopri().'Evaluacion/texto_evaluacion';?>',
    type: 'post',
    data: {texto_id:texto_id},
    dataType: "json",
    success: function(data){ 
      // Add response in Modal body
      console.log(data.texto_contenido);
      $('#texto_bienvenida').val('');
      $('#texto_bienvenida').val(data.texto_contenido);

      
  }

});

  

   

   



});
   });
</script>