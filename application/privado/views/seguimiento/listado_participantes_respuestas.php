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
              <span class="cabecera_titulo">Seguimiento</span>
                <span class="flecha2">&rarr;</span>
                <span class="cabecera_titulo"><?php echo $nombre_grupo; ?></span>
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
              

            <?php echo anchor($this->controlador.'listar','Listado Respuestas',array('class' =>'enlace_listar enlace_a1')); ?>&nbsp;&nbsp;

                                
                               
              
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

  <div class="row">
    <div class="class-col-md-2">
      <table  align="center" class="tabla_listado"  cellspacing="0" width="100%" id="example">
    <!-- table table-bordered table-striped -->
     <tr class="cabecera_listado"  > 
      <td align="center" valign="" colspan="5">&nbsp; <p></p> </td>
     </tr>
    <tr class="cabecera_listado"  >
 <!-- # Evaluaciones  # Participantes Fecha Envio Configurar Envio  Editar  Eliminar -->
        
            <!-- <td align="center" valign="">id</td> -->
         <td align="center" valign="">Nro</td>
         <td align="center" valign="">Ap Paterno</td>
         <td align="center" valign="">Ap Materno</td>
         <td align="center" valign="">Nombre</td>
         
   </tr>
     <?php $j=1; ?>
     <?php $sw=0; ?>
   <?php
   $ci=array();
   foreach ($datos as $fila)
   {
	array_push($ci,$fila->pos_documento);
    ?>
    <?php if ($sw==0): ?>
    <tr>
      <?php $sw=1; ?>
    <?php else: ?>
    <tr  class="fila-color-2">
     <?php $sw=0; ?>
    <?php endif ?>
      <!-- <td align="left"><?php echo $fila->pos_id; ?></td> -->
     <td align="left"><?php echo $j; ?> </td>
     <td align="left"><?php echo $fila->pos_apaterno; ?></td>
     <td align="left"><?php echo $fila->pos_amaterno; ?></td>     
     <td align="left">
        <?php echo $fila->pos_nombre; ?> 
        

     </td>

   </tr>
   <?php
   $j++;
 }
 ?>
</table>
    </div>

<?php $sw=0; ?>
    <?php $longitud=count($nombre_eval);
      ?>
      <?php $k=0; ?>
    <?php for ($i=0; $i <$longitud ; $i++) {  ?>

     
        <div class="class-col-md-2">
      <table  align="left" class="tabla_listado"  cellspacing="0"  id="example">
        <tr class="cabecera_listado">
            <td align="left" valign="" colspan="4"><?php echo $nombre_eval[$i]; ?>
            <br>
            <?php if ($tipo_eval[$i]['tipo_eva']==2): ?>
              <?php echo anchor('Reporte_sabio/xls_comparativo/'.$tipo_eval[$i]['id_grupo'].'/'.$tipo_eval[$i]['id_eva'],'Respuestas Comparativas',array('class' =>'enlace_a1')); ?> 
              <?php else: ?>
              <br>             
            <?php endif ?>
             </td>
        </tr>        
        <tr class="cabecera_listado">
		 <?php if ($tipo_eval[$i]['tipo_eva']==4){ ?>
		  <td align="center">Ver carpeta</td>
		 <?php } else{ ?>
         <!-- <td align="left" valign="">id</td> -->

         <?php if ($tipo_eval[$i]['tipo_eva']==3): ?>
          <td align="left" valign="">Informe 1</td>
         <td align="left" valign="" >Informe 2</td>    
           <?php else: ?>
            <td align="left" valign="">Respuestas</td>
         <td align="left" valign="" >Pdf</td>    
         
         <?php endif ?>
         
		 <?php }?>		 
        </tr>
      
      <?php $sw=0; ?>

      <?php for ($j=0; $j <$nro_participantes ; $j++) {  ?>
        
        <?php if ($sw==0): ?>
    <tr>
      <?php $sw=1; ?>
    <?php else: ?>
    <tr  class="fila-color-2">
     <?php $sw=0; ?>
    <?php endif ?>
         <?php if ($tipo_eval[$i]['tipo_eva']==4){ ?>
		  <td align="center">
		  <?php if ($evaluaciones[$i][$j]['nro_intentos']!=0){ ?>
		   <?php echo anchor('Prueba_cuatro/folder_postulante/'.$ci[$j].'/'.$id_carpeta, '<i class="fas fa-folder-open"></i> ', array('class' => 'enlace_a1','style'=>'font-size: 10px;')); 
		   
			}else{
				echo '<br>';
			}
		 ?>

		  </td>
		 <?php } else{ ?>
         <!-- <td align="left"><?php echo $evaluaciones[$i][$j]['pos_id']; ?></td> -->
         <td align="left">
          <?php if ($tipo_eval[$i]['tipo_eva']==3): ?>
            <!-- if tipo 3 -->
            <?php if ($evaluaciones[$i][$j]['nro_intentos']!=0 && $evaluaciones[$i][$j]['porcentaje']>99): ?>
            <!-- if porcentaje >19 -->
            <?php $datos_informe=$evaluaciones[$i][$j]['pos_id'].'/'.$evaluaciones[$i][$j]['gru_id'].'/'.$evaluaciones[$i][$j]['eva_id']; ?>
            
            <?php echo anchor($this->controlador.'informe/'.$datos_informe,'Pdf',array('class' =>'enlace_a1','target'=>'_blank')); ?>
            <?php echo anchor($this->controlador.'vista_informe/'.$datos_informe,'Html',array('class' =>'enlace_a1','target'=>'_blank')); ?>

            
          <!-- ?php else: ?>
            &nbsp; -->

          <?php endif ?>
          <!-- endif porcentaje >19 -->

          <?php else: ?>
            <!-- else tipo 3 -->
            <?php if ($evaluaciones[$i][$j]['nro_intentos']!=0 && $evaluaciones[$i][$j]['porcentaje']>19): ?>
            <!-- if porcentaje >19 -->
            <?php $datos_informe=$evaluaciones[$i][$j]['pos_id'].'/'.$evaluaciones[$i][$j]['gru_id'].'/'.$evaluaciones[$i][$j]['eva_id']; ?>
            
            
                <?php echo anchor($this->controlador.'informe/'.$datos_informe,'Ver',array('class' =>'enlace_a1')); ?>
            
            

            
          <!-- ?php else: ?>
            &nbsp; -->

          <?php endif ?>
          <!-- endif porcentaje >19 -->
          <?php endif ?>
          <!-- endif tipo 3 -->


          
            
          </td>     
         <td align="left">
          <?php if ($evaluaciones[$i][$j]['nro_intentos']!=0 && $evaluaciones[$i][$j]['porcentaje']>99): ?>
            <?php $datos_informe=$evaluaciones[$i][$j]['pos_id'].'/'.$evaluaciones[$i][$j]['gru_id'].'/'.$evaluaciones[$i][$j]['eva_id']; ?>
            <?php echo anchor($this->controlador.'pdf/'.$datos_informe,'Pdf',array('class' =>'enlace_a1','target'=>'_blank')); ?>
             <?php echo anchor($this->controlador.'vistas/'.$datos_informe,'Html',array('class' =>'enlace_a1','target'=>'_blank')); ?>
            <?php else: ?>
            &nbsp;

          <?php endif ?>
       </td>
       <!-- vista -->
      
	   <?php } ?>
        </tr>


        <?php } ?>
</table>
    </div>

    <?php } ?>

    
 
    
   


  </div>

<br/>
<br/>
</form>
<?php }?>
</div>
<!-- cdn fontawesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>

