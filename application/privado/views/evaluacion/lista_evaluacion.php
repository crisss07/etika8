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
              <span class="cabecera_titulo"><?php echo $nombre_grupo; ?></span>
                <span class="flecha2">&rarr;</span>
                
              <span class="cabecera_titulo">Lista Evaluaciones</span>
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
              <?php echo anchor($this->controlador.'listar','Listado Grupo',array('class' =>'enlace_listar enlace_a1')); ?>&nbsp;&nbsp;

              <?php echo anchor($this->controlador.'agregar_evaluacion/'.$id_grupo,'Agregar Evaluaci&oacute;n',array('class' =>'enlace_nuevo enlace_a1')); ?>&nbsp;&nbsp;
			
			<?php 
			if($carpeta==0){
			echo anchor($this->controlador.'agregar_carpeta/'.$id_grupo,'<i class="fas fa-folder-open" style="font-size:18px;"></i>&nbsp;&nbsp;Agregar Carpeta',array('class' =>'enlace_a1','style'=>'font-size: 12px; font-weight:600;')); 
			}
			?>
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
  <input type="hidden" name="idp" value="<?php echo @$this->idp;?>" id="idp"/>
  <input type="hidden" name="tip" value="<?php print_r(@set_value($this->tip,$this->tip));?>">
  <input type="hidden" name="destacadomas" value="<?php print_r(@set_value($destacadomas,$destacadomas));?>">

  <table  align="center" class="tabla_listado"  cellspacing="0" width="100%" id="example">
    <!-- table table-bordered table-striped -->
    <tr class="cabecera_listado">
 <!-- # Titulo Evaluación Tipo Respuestas Control Tiempo  # Intentos  Editar Textos Eliminar  Vista Previa -->
        <td align="center" valign="">Titulo Evaluación</td>
         <td align="center" valign="">Nombre Plantilla</td>
         <td align="center" valign="">Intentos</td>         
         
         <!-- <td align="center" valign="">Vista Previa</td> -->
         <td align="center" valign="">Estado</td>
         <td align="center" valign="">Habilitar</td>
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
      
        
     
      <td align="left"> <?php  print_r($fila['eva_titulo']); ?> </td>
      <td align="left"> <?php  print_r($fila['zpla_titulo']); ?> </td>
      <td align="left" valign="middle">
       <?php  
	   if($fila['tipo_eval_id']==4){
			echo '-';
		}else{
			print_r($fila['eva_nro_intentos']); 
		}
	   ?>
     </td> 

     <td align="left" valign="middle">
       
       <?php if ($fila['eva_estado']==0): ?>
         <div class="deshabilitado"></div>
       <?php else: ?>
        <div class="habilitado"></div>
       <?php endif ?>
       
     </td>  

     <td align="left" valign="middle">
       
       <?php if ($fila['eva_estado']==0): ?>         
            
                         <?php echo anchor($this->controlador.'habilitar_eval/'.$fila['eva_id'].'/'.$fila['gru_id'],'Habilitar',array('class' =>'enlace_a1')); ?>
       <?php else: ?>        
        
         
         <?php echo anchor($this->controlador.'habilitar_eval/'.$fila['eva_id'].'/'.$fila['gru_id'],'Deshabilitar',array('class' =>'enlace_a1')); ?>
       <?php endif ?>
       
     </td>

   

 
                   
     
    <td align="left" valign="middle">
        <?php
		if($fila['tipo_eval_id']==4){
			echo anchor($this->controlador.'editar_texto_instructivo/'.$fila['gru_id'].'/'.$fila['eva_id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">',array('class' =>'enlace_a1'));
		}else{
            echo anchor($this->controlador.'edicion_eval/'.$fila['gru_id'].'/'.$fila['eva_id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">',array('class' =>'enlace_a1'));
		}
        ?>
    </td>
                     <td align="left" valign="middle">
                      <?php if ($fila['bandera']==0): ?>
                        <?php
                        echo anchor($this->controlador.'delete_eval/'.$fila['gru_id'].'/'.$fila['eva_id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/eliminar.png" alt="eliminar">',array('class' =>'enlace_a1','onclick'=>"return confirma('$msj_confirmar')"));
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
</form>
<?php }?>
</div>
 
  
 <?php if ($nro_eval>0): ?>  
   <?php echo anchor($this->controlador.'adicionar_participantes/'.$id_grupo, 'Agregar participantes', array('class' => 'btn-etika btn')); ?>
 <?php endif ?>







 



<script>
  
function confirma(mensaje) {
    return confirm(mensaje);
}
</script>
<!-- cdn fontawesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>