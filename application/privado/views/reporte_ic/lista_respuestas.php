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
              <span class="cabecera_titulo">Listado Participantes</span>
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
              

            <?php echo anchor('Seguimiento/respuestas_participantes/'.$id_grupo,'Listado Respuestas Individuales',array('class' =>'enlace_listar enlace_a1')); ?>&nbsp;&nbsp;

                                
                               
              
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
    <div class="class-col-md-10" align="left">
    
  Evaluaci&oacute;n: <?php echo $data_eval->eva_titulo; ?><p></p>
  Plantilla: <?php echo $data_eval->zpla_titulo; ?><p></p>    
    </div>
  </div>
<?php $sw=0; ?>
  <div class="row">
    <div class="class-col-md-10">
      <table  align="center" class="tabla_listado"  cellspacing="0" width="100%" id="example">
    <!-- table table-bordered table-striped -->
     
    <tr class="cabecera_listado"  >
 <!-- # Evaluaciones  # Participantes Fecha Envio Configurar Envio  Editar  Eliminar -->
        
        
         <td align="center" valign="">Nombre</td>
          <td align="center" valign="">Apellidos</td>
         
         <td align="center" valign="">Omitidos</td>
         <td align="center" valign="">Errores</td>
         <td align="center" valign="">Decil</td>
         

         
         
   </tr>
     
   <?php
   foreach ($datos as $fila)
   {
    ?>
    
    <tr>

      <?php $valor_omitidos=$fila->om_a+$fila->om_b+$fila->om_c; ?>
      <?php $valor_errores=$fila->er_a+$fila->er_b+$fila->er_c; ?>
    
      
    <td align="left"><?php echo $data_p->pos_nombre; ?></td>
    <td align="left"><?php echo $data_p->pos_apaterno.' '.$data_p->pos_amaterno; ?></td>
     <td align="left"><?php echo $valor_omitidos; ?></td>
     <td align="left"><?php echo $valor_errores; ?></td>
     <td align="left"><?php echo $fila->pe; ?></td>
     

   </tr>
   <?php

 }
 ?>
</table>
    </div>


  
   

    
 
    
   


  </div>

<br/>
<br/>
</form>
<?php }?>
</div>


