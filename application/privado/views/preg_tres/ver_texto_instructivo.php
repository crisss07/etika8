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
    <form action="<?php echo $sitio.$this->controlador.'procesar'?>" method="post" id="form_listar_fsimple">
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
</form>
<?php }?>
</div>
</div>

<?php echo form_open_multipart('Prueba_tres/ver_preguntas/'.$id.'/1'); ?>   
<div class="row">
  <div class="col-md-2"></div>
  
  <div class="col-md-8" align="justify">
    <input type="hidden" value="<?php echo $id; ?>" name="id"    >
    <?php echo $data_pla->zpla_texto_instructivo; ?>
    
  </div>
</div>

<p></p>
<div class="row" align="center" >
  <div class="col-md-12">
    <button type="submit" class="btn-etika btn" id="guardar" >siguiente paso</button>
  </div>  
</div>
</form>

<p></p><p></p>

