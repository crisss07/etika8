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

       
              <?php echo anchor($this->controlador.'listado_opciones_edicion/'.$id,'Listado de Opciones',array('class' =>'enlace_listar enlace_a1')); ?>
              &nbsp;&nbsp;
              <?php echo anchor($this->controlador.'listado_opciones_edicion/'.$id, 'Cancelar', array('class' => 'enlace_cancelar enlace_a1')); ?>                                      
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



<?php echo form_open_multipart('Prueba_tres/update_preguntas/'); ?>   
<input type="hidden" value="<?php echo $id; ?>" name="id">
<input type="hidden" value="<?php echo $num_ini; ?>" name="num_ini">
<input type="hidden" value="<?php echo $num_fin; ?>" name="num_fin">


<div class="row justify-content-center">

  <div class="col-md-10">
    <table class="table table-bordered">
      <tr bgcolor="#f4f4f4">
        <td class="texto_label" style="width:10px;">  <b>Nro</b> </td>
        <td><b>Pregunta</b></td>
        <td style="width:80px;"><b>Factor</b></td>
        <td style="width:80px;"><b>IN</b></td>
        <td style="width:80px;"><b>AQ</b></td>
      </tr>
      <?php $i=0; ?>
      <?php for ($j=$num_ini; $j <=$num_fin; $j++) { ?>
        <!-- p1 -->
      
      <tr bgcolor="#f4f4f4">
        <td><?php  echo $j; ?>.-</td>
        <td><input type="text" class="form-control input1" name="p<?php echo $j; ?>" value="<?php echo $datos[$i]['pre_texto']; ?>" required="">
          </td>
        <td>
        <select class="form-select-21"  name="factor<?php echo $j; ?>" required="">
        <option value="<?php echo $datos[$i]['factor_id']; ?>"><?php echo $datos[$i]['letra']; ?></option>
        <?php foreach ($factores as $tp) : ?>
          <?php if ($tp->factor_id!=$datos[$i]['factor_id']): ?>
          <option value="<?php echo $tp->factor_id; ?>"><?php echo $tp->letra; ?></option>  
          <?php endif ?>
        <?php endforeach; ?>
        </select>          
        </td>

        <td valign="middle" align="center">
        <?php $valor_check=""; ?>   
        <?php if ($datos[$i]['valor_in']==1): ?>
              <?php $valor_check="checked";?>
        <?php endif ?>       
          <input type="checkbox" class="" name="in<?php echo $j; ?>" <?php echo $valor_check; ?> value="1">          
        
        </td>
        <td>
          <?php $valor_check=""; ?>   
        <?php if ($datos[$i]['aq']==1): ?>
              <?php $valor_check="checked";?>
        <?php endif ?>   
          <input type="checkbox" class="" name="aq<?php echo $j; ?>" <?php echo $valor_check; ?> value="1" >         
        </td>
      </tr>
      <tr>
        <td><input type="radio" id="customRadio1" name="resp<?php echo $j; ?>" ></td>
        <td>
          <input type="text" class="form-control input1"  name="a<?php echo $j; ?>" value="<?php echo $datos[$i]['pre_resp_a']; ?>" required="">
          </td>
        <td>
          <input type="number" class="form-control input1"  name="fa<?php echo $j; ?>" value="<?php echo $datos[$i]['valor_a']; ?>" min="0" max="2"  pattern="^[-/d]/d*$" required="">
        </td>
      </tr>
      <tr>
        <td><input type="radio" id="customRadio1" name="resp<?php echo $j; ?>" ></td>
        <td>
          <input type="text" class="form-control input1"  name="b<?php echo $j; ?>" value="<?php echo $datos[$i]['pre_resp_b']; ?>" required="">
          </td>
        <td>
          <input type="number" class="form-control input1"  name="fb<?php echo $j; ?>" value="<?php echo $datos[$i]['valor_b']; ?>"  min="1" max="1" step="1" pattern="^[-/d]/d*$" required="">
          </td>
      </tr>
      <tr>
        <td><input type="radio" id="customRadio1" name="resp<?php echo $j; ?>" ></td>
        <td>
          <input type="text" class="form-control input1"  name="c<?php echo $j; ?>" value="<?php echo $datos[$i]['pre_resp_c']; ?>" required="">
          </td>
        <td>
          <input type="number" class="form-control input1"  name="fc<?php echo $j; ?>" value="<?php echo $datos[$i]['valor_c']; ?>"  min="0" max="2"  pattern="^[-/d]/d*$"required="">
          </td>
      </tr>  

      <?php $i++; ?>      
      <?php }?>
      
      
      


    </table>
  </div>
  
</div>




<p></p>
<div class="row" align="center" >
  <div class="col-md-12">

    <?php if ($num_fin==170): ?>
      <button type="submit" class="btn-etika btn" id="guardar" >Finalizar</button>    
    <?php else: ?>
      <button type="submit" class="btn-etika btn" id="guardar" >Guardar</button>    
      
    <?php endif ?>

    
    

    

  </div>  
</div>
</form>

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