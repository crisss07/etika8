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

  <!-- ?php
  if(!@$this->nolistar){
    ?> -->
    <!-- <form action="?php echo $sitio.$this->controlador.'procesar'?>" method="post" id="form_listar_fsimple"> -->
      <table width="100%"><tr><td>
        <table align="center" width="100%">
          <tr>
            <td class="enlaces_add_edit" align="left" width="100%">


              <?php echo anchor($this->controlador.'listar','Listado Seguimiento',array('class' =>'enlace_listar enlace_a1')); ?>&nbsp;&nbsp;



              
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
          <tr class="cabecera_listado"  > 
            <td align="center" valign="" colspan="4">&nbsp;</td>
            <?php $longitud=count($nombre_eval);?>
            <?php for ($i=0; $i <$longitud ; $i++) {  ?>
                <td align="left" valign="" colspan="4"><?php echo $nombre_eval[$i]; ?></td>
            <?php } ?>       

          </tr>
          <tr class="cabecera_listado"  >
           <!-- # Evaluaciones  # Participantes Fecha Envio Configurar Envio  Editar  Eliminar -->

           <td align="center" valign="">Nro</td>
           <td align="center" valign="" style="width:300px;">Ap Paterno</td>
           <td align="center" valign="">Ap Materno</td>
           <td align="center" valign="">Nombre</td>
           

           <?php for ($i=0; $i <$longitud ; $i++) {  ?>
    
          <!-- <td align="left" valign="">id</td> -->
          <td align="left" valign="">Nro Intentos</td>
          <td align="left" valign="">Porcentaje</td>
          <td align="left" valign="">Tiempo</td>
          <td align="left" valign="" >Habilitar intento</td>  
          <?php } ?>       
        

         </tr>

         <!-- fin de encabezado -->
         <?php $k=1;$sw=0; ?>


         <?php for ($j=0; $j < count($datos_dos) ; $j++) {  ?>

          <?php if ($sw==0): ?>
            <tr>
              <?php $sw=1; ?>
            <?php else: ?>
              <tr  class="fila-color-2">
               <?php $sw=0; ?>
             <?php endif ?>
             <td align="left"><?php echo $j; ?> </td>
             <td align="left"><?php echo $datos_dos[$j]['pos_apaterno']; ?></td>
             <td align="left"><?php echo $datos_dos[$j]['pos_amaterno']; ?></td>     
             <td align="left">
              <?php echo $datos_dos[$j]['pos_nombre']; ?> 
            </td>
            <?php for ($i=0; $i <$longitud ; $i++) {  ?>
              <td align="left"><?php echo $evaluaciones[$i][$j]['nro_intentos']; ?></td>
             <td align="left"><?php echo $evaluaciones[$i][$j]['porcentaje']; ?></td>
             <td align="left"><?php echo $evaluaciones[$i][$j]['tiempo_total']; ?></td>     
             <td align="left">
              <?php if ($evaluaciones[$i][$j]['nro_intentos']!=0): ?>
                <?php $datos_informe=$evaluaciones[$i][$j]['pos_id'].'/'.$evaluaciones[$i][$j]['gru_id'].'/'.$evaluaciones[$i][$j]['eva_id']; ?>
                <?php echo anchor($this->controlador.'habilitar_intento/'.$datos_informe,'Habilitar',array('class' =>'enlace_a1')); ?>
              <?php endif ?>
            <?php } ?> 

          </tr>   
          <?php
          $k++;
        }
        ?>

      </table>


      <!-- anterior codigo -->


<!-- <div class="row"> -->

<!-- <table  align="center" class="tabla_listado"  cellspacing="0" width="100%" id="example"> -->
          <!-- table table-bordered table-striped -->
          <!-- <tr class="cabecera_listado"  >  -->
            <!-- <td align="center" valign="" colspan="4">&nbsp;</td>
          </tr>
           -->
           <!-- <tr class="cabecera_listado"  > -->
           <!-- # Evaluaciones  # Participantes Fecha Envio Configurar Envio  Editar  Eliminar -->

           <!-- <td align="center" valign="">Nro</td>
           <td align="center" valign="" style="width:300px;">Ap Paterno</td>
           <td align="center" valign="">Ap Materno</td>
            -->
            <!-- <td align="center" valign="">Nombre</td> -->

         <!-- </tr> -->
         <!-- 
         <?php $k=1;$sw=0; ?>

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
             <td align="left"><?php echo $k; ?> </td>
             <td align="left"><?php echo $fila->pos_apaterno; ?></td>
             <td align="left"><?php echo $fila->pos_amaterno; ?></td>     
             <td align="left">
              <?php echo $fila->pos_nombre; ?> 
            </td>
          </tr>   
          <?php
          $k++;
        }
        ?>
      </table>


  <?php $sw=0; ?>

  <?php $longitud=count($nombre_eval);
  ?>

  <?php for ($i=0; $i <$longitud ; $i++) {  ?> -->


    
      <!-- <table  align="left" class="tabla_listado"  cellspacing="0"  id="example">
        <tr class="cabecera_listado">
          <td align="left" valign="" colspan="4"><?php echo $nombre_eval[$i]; ?></td>
        </tr>        
        <tr class="cabecera_listado"> -->
          <!-- <td align="left" valign="">id</td> -->
          <!-- <td align="left" valign="">Nro Intentos</td>
          <td align="left" valign="">Porcentaje</td>
          <td align="left" valign="">Tiempo</td>
          <td align="left" valign="" >Habilitar intento</td>         
        </tr>
 -->

        <!-- <?php for ($j=0; $j <$nro_participantes ; $j++) {  ?>

          <?php if ($sw==0): ?>
            <tr>
              <?php $sw=1; ?>
            <?php else: ?>
              <tr  class="fila-color-2">
               <?php $sw=0; ?>
             <?php endif ?> -->
             
             <!-- <td align="left"><?php echo $evaluaciones[$i][$j]['nro_intentos']; ?></td>
             <td align="left"><?php echo $evaluaciones[$i][$j]['porcentaje']; ?></td>
             <td align="left"><?php echo $evaluaciones[$i][$j]['tiempo_total']; ?></td>     
             <td align="left">
              <?php if ($evaluaciones[$i][$j]['nro_intentos']!=0): ?>
                <?php $datos_informe=$evaluaciones[$i][$j]['pos_id'].'/'.$evaluaciones[$i][$j]['gru_id'].'/'.$evaluaciones[$i][$j]['eva_id']; ?>
                <?php echo anchor($this->controlador.'habilitar_intento/'.$datos_informe,'Habilitar',array('class' =>'enlace_a1')); ?>
              <?php endif ?>


            </td>
          </tr> -->


        <!-- <?php } ?>
      </table>
    

  <?php } ?> -->







<!-- </div> -->

<br/>
<br/>
<p></p>
<!-- </form>
?php }?> -->
</div>


