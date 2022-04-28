<?php
$msj_confirmar='¿Está seguro que desea eliminar el elemento seleccionado? \nSe eliminará todos los procesos que hagan referencia a este elemento en la Base de Datos.'; 

?>

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
	//OPCIONES EN EVALUACIONES
	$this->load->view('opciones_evaluacion', $o_evaluacion);
	
  if(!@$this->nolistar){
    ?>
  <input type="hidden" name="idp" value="<?php echo @$this->idp;?>" id="idp"/>
  <input type="hidden" name="tip" value="<?php print_r(@set_value($this->tip,$this->tip));?>">
  <input type="hidden" name="destacadomas" value="<?php print_r(@set_value($destacadomas,$destacadomas));?>">

  <table  align="center" class="tabla_listado"  cellspacing="0" width="100%" id="example">
    <!-- table table-bordered table-striped -->
    <tr class="cabecera_listado">


      
         <td align="center" valign="">Titulo</td>
         <td align="center" valign="">Tipo</td>
         <td align="center" valign="">Vista Previa</td>
         <td align="center" valign="">Baremo</td>
         <td align="center" valign="">Editar</td>
         <td align="center" valign="">Eliminar</td>

                 
         
      
   </tr>
   <?php $sw=0; ?>
   <?php
   foreach ($datos as $fila)
   {
    ?>
    <?php if ($sw==0): ?>
    <tr>
      <?php $sw=1; ?>
    <?php else: ?>
    <tr  class="fila-color-2">
     <?php $sw=0; ?>
    <?php endif ?>
      <td align="center"> <?php  print_r($fila['zpla_titulo']); ?> </td>
      <td align="center" valign="middle">
       <?php  print_r($fila['tipo_desc']); ?>
     </td>                     
     <td align="center" valign="middle">
      <a href="<?php echo $this->tool_entidad->sitio().'admin.php/'.$this->controlador.'datos_plantilla/'.$fila[$prefijo.'id'].'/'.$fila['ztipo_eval_id'] ?>"  class="enlace_a1">Ver</a></td>
      <td>
        <?php if ($fila['ztipo_eval_id']==3): ?>
        <a href="<?php echo $this->tool_entidad->sitio().'admin.php/Prueba_tres/vista_baremo/'.$fila[$prefijo.'id'].'/1'; ?>"  class="enlace_a1">Actualizar</a></td>  
        <?php endif ?>
		 <?php if ($fila['ztipo_eval_id']==1): ?>
        <a href="<?php echo $this->tool_entidad->sitio().'admin.php/Analitica/editar_baremo/'.$fila[$prefijo.'id'] ?>"  class="enlace_a1">Actualizar</a></td>  
        <?php endif ?>
        <?php if ($fila['ztipo_eval_id']==5): ?>
        <a href="<?php echo $this->tool_entidad->sitio().'admin.php/Prueba_cinco/vista_baremo/'.$fila[$prefijo.'id'] ?>"  class="enlace_a1">Actualizar</a></td>  
        <?php endif ?>
       
      </td>
     <td align="center" valign="middle">
        <?php
                        echo anchor($this->controlador.'editar_plantilla/'.$fila[$prefijo.'id'].'/'.$fila['ztipo_eval_id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">',array('class' =>'enlace_a1'));
                        ?>
                    </td>
                     <td align="center" valign="middle">
                      <?php if ($fila['bandera']==0): ?>
                        <?php
                        echo anchor($this->controlador.'eliminar_plantilla/'.$fila[$prefijo.'id'].'/'.$fila['ztipo_eval_id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/eliminar.png" alt="eliminar">',array('class' =>'enlace_a1','onclick'=>"return confirmar('$msj_confirmar')"));
                        ?>
                      <?php endif ?>


                        
                    </td>
   </tr>
   <?php
 }
 ?>
</table>
<br/>
<br/>

<?php }?>
</div>
