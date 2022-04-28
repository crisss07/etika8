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


<div id="listado">
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
  

  <br/>
  <br/>
</form>
<?php }?>
</div>

<!-- datos para el for -->
<?php 
$gi=$grup_ini;
$grupos=$num_ini;
$k=$num_ini;
$pos_total=0;
$pi=0;
$suma1=1;
$suma2='onclick="sumarNum2(this.value)"';
?>

<?php echo form_open_multipart('Prueba_dos/vista_preguntas/'.$id.'/'.$num_fin, array('onsubmit' => 'return validar()') ); ?>   
<input type="hidden" value="<?php echo $id; ?>" name="id">
<input type="hidden" value="<?php echo $num_ini; ?>" name="num_ini">
<input type="hidden" value="<?php echo $num_fin; ?>" name="num_fin">
<div class="row" style="font-size:14px;">

  <div class="col-md-12" >
    <?php for ($i=0; $i <16 ; $i++) { ?>
      
      <?php if ($i==4): ?>
        <?php $i=8; ?>
      <?php endif ?>
      <?php if ($i==12): ?>
        <?php break; ?>
      <?php endif ?>
      
      <?php if ($grupos==$k): ?>
        <div class="row">
          <div class="col-md-6" align="center">
           <b> <h4> GRUPO <?php echo $gi; ?>
         </h4></b>
       </div>
       <?php $grupos=$grupos+4; 
       $gi++;

       ?> 
       <div class="col-md-6" align="center">
         <b> <h4> GRUPO <?php echo $gi; ?>
       </h4></b>
     </div>
     <?php $gi++; ?>

   </div>








 <?php endif ?>
 <?php $k++; ?>

 <div class="row">
  <div class="col-md-6">

    <div class="row">
     <div class="col-md-2">    

     <?php if ($i<8): ?>
         <input tabindex="<?php echo $data[$i]['pre_nro']; ?>" type="number" class="input1" maxlength="1" size="1" min="0" step="1" pattern="^[-/d]/d*$"  max="9" required="" id="p<?php echo $pi;?>" style="width: 60px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  onchange="sumarNum1(this.value)" > 
     <?php else: ?>
         <input tabindex="<?php echo $data[$i]['pre_nro']; ?>" type="number" class="input1" maxlength="1" size="1" min="0" step="1" pattern="^[-/d]/d*$"  max="9" required="" id="p<?php echo $pi;?>" style="width: 60px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  onchange="sumarNum3(this.value)" > 
             
           <?php endif ?>      
   
      <?php $pi++; ?>
    </div>
    <div class="col-md-10" align="left">
      <?php echo $data[$i]['pre_nro'].'.-'. $data[$i]['pre_texto']; ?>
    </div>
  </div>

</div>
<div class="col-md-6">
 <div class="row">
   <div class="col-md-2">  

   <?php if ($i<8): ?>
       <input tabindex="<?php echo $data[$i+4]['pre_nro']; ?>" type="number" class="input1" maxlength="1" size="1" min="0" step="1" pattern="^[-/d]/d*$"  max="9" required="" id="p<?php echo $pi;?>" style="width: 60px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  onchange="sumarNum2(this.value)" >
   <?php else: ?>
                <input tabindex="<?php echo $data[$i+4]['pre_nro']; ?>" type="number" class="input1" maxlength="1" size="1" min="0" step="1" pattern="^[-/d]/d*$"  max="9" required="" id="p<?php echo $pi;?>" style="width: 60px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  onchange="sumarNum4(this.value)" >
           <?php endif ?>        
 
    <?php $pi++; ?>
  </div>
  <div class="col-md-10" align="left">
    <?php echo $data[$i+4]['pre_nro'].'.-'. $data[$i+4]['pre_texto']; ?>

  </div>
</div>

</div>



</div>
<?php $pos_total=$i+1;
?>
<p></p>
<?php if (($pos_total % 4) == 0): ?>
  <div class="row">
    <div class="col-md-6">
      <div class="row">

        <div class="col-md-2">

         <input type="number" class="input1" maxlength="1" size="1" min="0" step="1" pattern="^[-/d]/d*$"  max="9" required="" id="suma<?php echo $i-2;?>" style="width: 60px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  readonly>
       </div>
       <div class="col-md-10" align="left">
        Total &nbsp;
        <code id="validsuma<?php echo $i-2; ?>"></code>
      </div>

    </div>

  </div>
  <div class="col-md-6">
    <div class="row">

      <div class="col-md-2">

       <input type="number" class="input1" maxlength="1" size="1" min="0" step="1" pattern="^[-/d]/d*$"  max="9" required="" id="suma<?php echo $i-1;?>" style="width: 60px;" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  readonly>
     </div>
     <div class="col-md-10" align="left">
      Total &nbsp;
      <code id="validsuma<?php echo $i-1; ?>"></code>
    </div>

  </div>

</div>

</div>
<?php endif ?>
<p></p>     
<?php } ?>
</div>
</div>

<p></p>
<div class="row" align="center" >
  <div class="col-md-12">
    <?php if ($num_fin==80): ?>
      <button type="submit" class="btn-etika btn" id="guardar" >Terminar</button>
    <?php else: ?>
      <button type="submit" class="btn-etika btn" id="guardar" >Siguientes Preguntas</button>    
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

<script>
  function sumarNum1(n1) {
    total=0;
    val1=$("#p0").val();
    val2=$("#p2").val();
    val3=$("#p4").val();
    val4=$("#p6").val();
    valor = parseInt(n1);
    if (val1 ==='') {
      val1=0;
    }

    if (val2 ==='') {
      val2=0;
    } 
    if (val3 ==='') {
      val3=0;
    } 
    if (val4 ==='') {
      val4=0;
    } 

    total= total+ parseInt(val1)+parseInt(val2)+parseInt(val3)+parseInt(val4);
    valor='la suma debe ser igual a <b>10</b>';
    if (total>10) {
      $("#validsuma1").html(valor); 
    }else{
      if (total<10) {
        $("#validsuma1").html(valor); 
      }else{
        $("#validsuma1").html(''); 
      }     
      
    }

    
    // $total= total + parseInt(val1);
    console.log(total);
    $('#suma1').val(total);

  }
</script>

<script>
  function sumarNum2(n1) {
    total=0;
    val1=$("#p1").val();
    val2=$("#p3").val();
    val3=$("#p5").val();
    val4=$("#p7").val();
    valor = parseInt(n1);
    if (val1 ==='') {
      val1=0;
    }

    if (val2 ==='') {
      val2=0;
    } 
    if (val3 ==='') {
      val3=0;
    } 
    if (val4 ==='') {
      val4=0;
    } 

    total= total+ parseInt(val1)+parseInt(val2)+parseInt(val3)+parseInt(val4);
    valor='la suma debe ser igual a <b>10</b>';
    if (total>10) {
      $("#validsuma2").html(valor); 
    }else{
      if (total<10) {
        $("#validsuma2").html(valor); 
      }else{
        $("#validsuma2").html(''); 
      }     
      
    }

    
    // $total= total + parseInt(val1);
    console.log(total);
    $('#suma2').val(total);

  }
</script>


<script>
  function sumarNum3(n1) {
    total=0;
    val1=$("#p8").val();
    val2=$("#p10").val();
    val3=$("#p12").val();
    val4=$("#p14").val();
    valor = parseInt(n1);
    if (val1 ==='') {
      val1=0;
    }

    if (val2 ==='') {
      val2=0;
    } 
    if (val3 ==='') {
      val3=0;
    } 
    if (val4 ==='') {
      val4=0;
    } 

    total= total+ parseInt(val1)+parseInt(val2)+parseInt(val3)+parseInt(val4);
    valor='la suma debe ser igual a <b>10</b>';
    if (total>10) {
      $("#validsuma9").html(valor); 
    }else{
      if (total<10) {
        $("#validsuma9").html(valor); 
      }else{
        $("#validsuma9").html(''); 
      }     
      
    }

    
    // $total= total + parseInt(val1);
    console.log(total);
    $('#suma9').val(total);

  }
</script>

<script>
  function sumarNum4(n1) {
    total=0;
    val1=$("#p9").val();
    val2=$("#p11").val();
    val3=$("#p13").val();
    val4=$("#p15").val();
    valor = parseInt(n1);
    if (val1 ==='') {
      val1=0;
    }

    if (val2 ==='') {
      val2=0;
    } 
    if (val3 ==='') {
      val3=0;
    } 
    if (val4 ==='') {
      val4=0;
    } 

    total= total+ parseInt(val1)+parseInt(val2)+parseInt(val3)+parseInt(val4);
    valor='la suma debe ser igual a <b>10</b>';
    if (total>10) {
      $("#validsuma10").html(valor); 
    }else{
      if (total<10) {
        $("#validsuma10").html(valor); 
      }else{
        $("#validsuma10").html(''); 
      }     
      
    }

    
    // $total= total + parseInt(val1);
    console.log(total);
    $('#suma10').val(total);

  }
</script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
function validar()
{
  var total1=$('#suma1').val();
  var total2=$('#suma2').val();
  var total3=$('#suma9').val();
  var total4=$('#suma10').val();
  var suma_total=parseInt(total1)+parseInt(total2)+parseInt(total3)+parseInt(total4);
  if(suma_total==40)
  {
    return true;
  }
  else
  {
    // alert('la suma debe de ser igual 10');
    // swal("Oops, Algo salió mal!!", "error");
     swal({
        title: "Verifique que la suma total sea igual a 10",
        text:  "Este mensaje se cerrara en 4 segundos",
        icon:  "error",
        timer: 4000, 
    });
    return false;
  }

}
</script>

