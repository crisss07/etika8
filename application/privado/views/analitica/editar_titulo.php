
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
      
  </td>

</tr>
</table>



<?php
$prefijo=$this->prefijo;

$alineacionw='center';
$alineacionh='middle';

?>

<div class="row">
  <div class="col-md-12">

<!-- <div id="listado"> -->
  <?php
  $sitio=$this->tool_entidad->sitioindexpri();
  ?>
  

  <?php
  if(!@$this->nolistar){
    ?>
    
      <table width="100%"><tr><td>
        <table align="center" width="100%">
          <tr>
            <td class="enlaces_add_edit" align="left" width="100%">

            
              
              <?php echo anchor($this->controlador.'editar_plantilla/'.$id,'Listado de Opciones',array('class' =>'enlace_listar enlace_a1')); ?>
              &nbsp;&nbsp;
              <?php echo anchor($this->controlador.'editar_plantilla/'.$id, 'Cancelar', array('class' => 'enlace_cancelar enlace_a1')); ?>  
                                
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
<!-- finde div  -->
</div>
<!-- fin de row -->


<?php echo form_open_multipart($action); ?>   
<input type="hidden" name="id_pla" value="<?php echo $id; ?>">
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4" align="left">
    <div class="form-group">
	<input type="hidden" value="<?php echo $id; ?>" name="id">
      <label>Titulo Plantilla: </label>
      <input type="text" class="form-control input1" value="<?php echo $valor_texto; ?>" name="<?php echo $this->prefijo.'titulo';?>" required="">
    </div> 
  </div>
</div>



<br>
<div class="row" align="center" >
  <div class="col-md-12">
    <button type="submit" class="btn-etika btn" id="guardar" >Guardar</button>
  </div>  
</div>
</form>
<br>
<br>