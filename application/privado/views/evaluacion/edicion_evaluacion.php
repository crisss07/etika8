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

              <?php echo anchor($this->controlador.'lista_evaluacion/'.$id_grupo,'Cancelar',array('class' =>'enlace_cancelar enlace_a1')); ?>
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

<?php echo form_open_multipart('evaluacion/update_evaluacion'); ?>   

<input type="hidden" name="id_eval" value="<?php echo $id_eval; ?>" required="">
<input type="hidden" name="id_grupo" value="<?php echo $id_grupo; ?>" required="">
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4" align="left">
    <div class="form-group">
      <label>Titulo de la Evaluaci&oacute;n: </label>
      <input type="text" class="form-control input1" value="<?php echo $data_eval->eva_titulo; ?>" name="titulo" required="">
    </div>    
    <div class="form-group">
      <label class="control-label">Plantilla: </label>
      <select class="form-select-21" id="plantilla" name="plantilla" required="">
        <option value="<?php echo $data_eval->zpla_id; ?>"><?php echo $data_eval->zpla_titulo; ?></option>
      </select>
    </div>
     <div class="form-group">
      <label>Nro de intentos: </label>
      <input type="text" class="form-control input1" value="<?php echo $data_eval->eva_nro_intentos; ?>" name="intentos" required="">
    </div>   

  </div>
</div>
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-6" align="left">
    <div id="dato_tipo">      
    </div>
  </div>
</div>


<p></p>
<div class="row" align="center" >
  <div class="col-md-12">
    <button type="submit" class="btn-etika btn" id="guardar" >Siguiente Paso</button>
  </div>  
</div>
</form>

<p></p><p></p>


