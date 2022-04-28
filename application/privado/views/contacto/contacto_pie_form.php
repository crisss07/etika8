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


<?php  
$prefijo=$this->prefijo;
?>
<?php
$this->load->view('cabecera');
?>
<div align="left" ><?php  echo anchor('configuracion','Cancelar',array('class' =>'enlace_cancelar enlace_a1')); ?></div><br/>
<?php
$alineacionwc1='center';
$alineacionhc1='middle';
$alineacionwc2='left';
$alineacionhc2='middle';
?>
<?php echo form_open_multipart($action.'/sub/'.$this->sub); ?>

<?php
   
   for($i=0;$i<count(array(@$this->campoup_img));$i++)
     {
        $j=$i+1;
       
        echo form_hidden($prefijo.'img_borrar'.$j, @set_value($prefijo.'img_borrar'.$j,$fila[$prefijo.'img_borrar'.$j]));
     }

  for($i=0;$i<count(array(@$this->campoup_adj));$i++)
     {
        $j=$i+1;
       

        echo form_hidden($prefijo.'adj_borrar'.$j, @set_value($prefijo.'adj_borrar'.$j,$fila[$prefijo.'adj_borrar'.$j]));
     }
   

?>
<?php
echo form_hidden($prefijo.'email',@$fila[$prefijo.'email']);
?>
<input type="hidden" name="<?php echo $prefijo.'id';?>" value="<?php echo set_value($prefijo.'id',$fila[$prefijo.'id']);?>">
<input type="hidden" name="tip" value="<?php print_r(@set_value($this->tip,$this->tip));?>">
<table id="form_admin">    
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            <?php echo form_label('Contenido del Pie: ', $prefijo.'pie');?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php                 
                echo form_textarea(array(
                    'name' => $prefijo.'pie',
                    'id' => $prefijo.'pie',
                    'rows' => '5',
                    'cols' => '60',
                    'class'=>'textarea',
                    'class'=>'tinymce',
                    'value' =>html_entity_decode($fila[$prefijo.'pie'])


                  ));

                  if(form_error($prefijo.'pie'))
                     echo '<div class="error">'.form_error($prefijo.'pie').'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            <?php echo form_label('Mensaje despues de Enviar: ', 'con_mesaje_enviado');?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php
                echo form_textarea(array(
                    'name' => 'con_mesaje_enviado',
                    'id' => 'con_mesaje_enviado',
                    'rows' => '5',
                    'cols' => '60',
                    'class'=>'textarea',
                    'class'=>'tinymcesimple',
                    'value' => html_entity_decode($fila['con_mesaje_enviado'])

                  ));

                  if(form_error('con_mesaje_enviado'))
                     echo '<div class="error">'.form_error('con_mesaje_enviado').'</div>';
            ?>
        </td>
    </tr>            
       
    <!--
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
             <?php $fecha='fecha';?>
            <?php echo form_label('Fecha creacion: ', $prefijo.$fecha);?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php
            if(!$fila[$prefijo.$fecha])
                {
                    $fila[$prefijo.$fecha]=date('Y-m-d');

                }
                  echo form_input(array(
                      'name' => $prefijo.$fecha,
                      'id' => $prefijo.$fecha,
                      'class' => 'input1',
                      'size' => '20',
                      'value' => set_value($prefijo.$fecha,$fila[$prefijo.$fecha])
                      ));

                  if(form_error($prefijo.$fecha))
                     echo '<div class="error">'.form_error($prefijo.$fecha).'</div>';
            ?>

            &nbsp;&nbsp;Año-mes-dia
        </td>
    </tr>
  -->
<!--
     <?php
    if($fila[$prefijo.'img_borrar1'])
    {
    ?>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            Imagen anterior
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">

             <table cellpadding="2" class="tabla2">
                 <tr>
                    <td>
                        <div class="aviso1">
                        <input type="checkbox" name="solo_eliminar_img[]" value="1" class="check" <?php echo set_checkbox('solo_eliminar_img[]', '1'); ?> id="check_img1">
                        <span class="flecha1">&larr;</span> Marcar si desea eliminar la imagen
                        </div>

                    </td>
                </tr>
                <tr>
                    <td>
                         <img src="<?php echo $this->tool_entidad->sitio()."archivos/".$this->carpeta.$fila[$prefijo.'img_borrar1'];?>" height="100" alt="Imagen" align="middle"/>
                         <div id="eliminar_imagen"></div>
                         <br/><span class="texto_aviso1"><strong>Nota.-</strong> Si sube otra imagen la anterior se eliminará automáticamente.</span>
                    </td>
                </tr>
            </table>


        </td>
    </tr>
    <?php
    }
    ?>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            Imagen: <br/><span class="texto2">(.jpg  .gif  .png)</span>
             <?php //echo form_label('Imagen: <br/>(.jpg  .gif  .png) ', $prefijo.'img');?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
             <?php

                echo form_upload(array('name' => $prefijo.'img', 'id' => $prefijo.'img', 'size' =>'60','onBlur'=>'LimitAttach(this,1)'));

                if(form_error($prefijo.'img'))
                     echo '<div class="error">'.form_error($prefijo.'img').'</div>';
            ?>
            <br/>
            <div id="msj_alerta_imagen"></div>
        </td>
    </tr>    


    <?php
    if($fila[$prefijo.'adj_borrar1'])
    {
    ?>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            Archivo anterior
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">

             <table cellpadding="2" class="tabla2" align="<?php echo $alinear;?>">
                 <tr>
                    <td>
                        <div class="aviso1">
                         <input type="checkbox" name="solo_eliminar_adj[]" value="2" id="check_adj1">
                        <span class="flecha1">&larr;</span> Marcar si desea eliminar el archivo
                        </div>

                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                           $tipofile=$this->tool_general->tipofig_extension(strtolower(substr($fila[$this->prefijo.'adj_borrar1'],-4)));
                        ?>
                        <img src="<?php echo $this->rutaimg.$tipofile.'.gif';?>" alt="tipo"/>
                        <?php echo "<b>".$fila[$prefijo.'adj_borrar1']."</b>"; ?>

                         <div id="eliminar_archivo"></div>
                        <br/><span class="texto_aviso1"><strong>Nota.- </strong>Si sube otro archivo el anterior se eliminará automáticamente.</span>

                    </td>
                </tr>
            </table>

        </td>
    </tr>
    <?php
    }
    ?>

    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            <?php echo form_label('Archivo: ', $prefijo.'adj');?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php

                  echo form_upload(array('name' => $prefijo.'adj', 'id' => $prefijo.'adj','size'=>'60'));

                  if(form_error($prefijo.'adj'))
                     echo '<div class="error">'.form_error($prefijo.'adj').'</div>';
            ?>
        </td>
    </tr>
-->
   
</table>


<br/>
<?php echo form_submit(array(
                    'name' => $prefijo.'enviar',
                    'class' => 'btn-etika btn',
                    'value' => 'Guardar'));?>
    
<?php echo form_close() ?>
