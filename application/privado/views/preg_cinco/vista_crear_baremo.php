



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


<div class="row justify-content-center">
  <div class="col-md-12">   
  

  


<?php echo form_open_multipart('Prueba_cinco/crear_baremo'); ?>   
<?php $i=0; ?>
<input type="hidden" value="<?php echo $id_plantilla; ?>" name="id_pla">




    <table class="table table-bordered">
    
        <!-- p1 -->
      <tr bgcolor="#f4f4f4">
        <td class="texto_ablel" style="width:10px;">  <b></b> </td>
        <td colspan="29"> </td>
        
        
         
      </tr>
      <!-- fila 1 -->
      <tr>
        <td>Valores</td>
        <?php for ($j=0; $j < 13; $j++) { ?>
        <td class="texto_label" >  <b><?php echo $j; ?></b> </td>
      <?php } ?>
      </tr>
      <tr>
        <td>Puntaje</td>        
        <?php for ($j=0; $j <13; $j++) { ?>
        <td class="texto_label" >
        <input type="number" step=".1" class="form-control" style="padding:0px;" name="p<?php echo $j; ?>"  min="0" max="11" value="<?php echo $val_baremo[$j]; ?>"  required="">
          <!-- <input type="number" > -->
          
        </td>
      <?php } ?>
      </tr>
      <!-- fila 2 -->
      <tr>
        <td>Valores</td>
        <?php for ($j=13; $j < 26; $j++) { ?>
        <td class="texto_label" >  <b><?php echo $j; ?></b> </td>
      <?php } ?>
      </tr>
      <tr>
        <td>Puntaje</td>        
        <?php for ($j=13; $j <26; $j++) { ?>
        <td class="texto_label" >
          <input type="number" step=".1" class="form-control" style="padding:0px;" name="p<?php echo $j; ?>"  min="0" max="10" value="<?php echo $val_baremo[$j]; ?>" required="">
        </td>
      <?php } ?>
      </tr>
      <!-- fila 3 -->
      <tr>
        <td>Valores</td>
        <?php for ($j=26; $j <39; $j++) { ?>
        <td class="texto_label" >  <b><?php echo $j; ?></b> </td>
      <?php } ?>
      </tr>
      <tr>
        <td>Puntaje</td>        
        <?php for ($j=26; $j <39; $j++) { ?>
        <td class="texto_label" >
          <input type="number" step=".1" class="form-control" style="padding:0px;" name="p<?php echo $j; ?>"  min="0" max="10" value="<?php echo $val_baremo[$j]; ?>" required="">
        </td>
      <?php } ?>
      </tr>
      <!-- fila 3 -->
      <tr>
        <td>Valores</td>
        <?php for ($j=39; $j <52; $j++) { ?>
        <td class="texto_label" >  <b><?php echo $j; ?></b> </td>
      <?php } ?>
      </tr>
      <tr>
        <td>Puntaje</td>        
        <?php for ($j=39; $j <52; $j++) { ?>
        <td class="texto_label" >
          <input type="number" step=".1" class="form-control" style="padding:0px;" name="p<?php echo $j; ?>"  min="0" max="10" value="<?php echo $val_baremo[$j]; ?>" required="">
        </td>
      <?php } ?>
      </tr>

      <!-- fila 3 -->
      <tr>
        <td>Valores</td>
        <?php for ($j=52; $j <65; $j++) { ?>
        <td class="texto_label" >  <b><?php echo $j; ?></b> </td>
      <?php } ?>
      </tr>
      <tr>
        <td>Puntaje</td>        
        <?php for ($j=52; $j <65; $j++) { ?>
        <td class="texto_label" >
          <input type="number" step=".1" class="form-control" style="padding:0px;" name="p<?php echo $j; ?>"  min="0" max="10" value="<?php echo $val_baremo[$j]; ?>" required="">
        </td>
      <?php } ?>
      </tr>
      <!-- fila 3 -->
      <tr>
        <td>Valores</td>
        <?php for ($j=65; $j <76; $j++) { ?>
        <td class="texto_label" >  <b><?php echo $j; ?></b> </td>
      <?php } ?>
      </tr>
      <tr>
        <td>Puntaje</td>        
        <?php for ($j=65; $j <76; $j++) { ?>
        <td class="texto_label" >
          <input type="number" step=".1" class="form-control" style="padding:0px;" name="p<?php echo $j; ?>"  min="0" max="10" value="<?php echo $val_baremo[$j]; ?>" required="">
        </td>
      <?php } ?>
      </tr>
      
      
      
      
      
      
      
      
      


    </table>
  




<p></p>
<div class="row" align="center" >
  <div class="col-md-12">



    <button type="submit" class="btn-etika btn" id="guardar" >Guardar</button>    
    

    

  </div>  
</div>
</form>

<p></p><p></p>

<!-- if de validacion de 0 -->

  </div>
</div>
<p></p><p></p>





<div class="row justify-content-center">

  <div class="col-md-12" id="data_ajax">
    
  </div>
  
</div>






<p></p><p></p>


<!-- ajax baremo -->
