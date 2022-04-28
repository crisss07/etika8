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
              <span class="cabecera_titulo">Cuadro Comparativo</span>
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
    <!-- <form action="<?php echo $sitio.$this->controlador.'procesar'?>" method="post" id="form_listar_fsimple"> -->
      <table width="100%"><tr><td>
        <table align="center" width="100%">
          <tr>
            <td class="enlaces_add_edit" align="left" width="100%">
              

            <?php echo anchor('Seguimiento/listar','Volver a Seguimiento',array('class' =>'enlace_listar enlace_a1')); ?>&nbsp;&nbsp;

<input type="image" src="/sisetika/files/img/excel_exportar.jpg"  onclick="ExportToExcel('xlsx')" alt="submit"/>
                                
                               
              
            </td>
            <td>
              
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
    <div class="class-col-md-12">
      <table  align="center" class="tabla_listadoss" id="tbl_exporttable_to_xls"  cellspacing="0" width="100%" id="example">
    <!-- table table-bordered table-striped -->
    <tr>
      <td colspan="2">Grupo: <?php echo $nom_grupo; ?></td>
    </tr>
    <tr>
      <td colspan="2">
        Evaluaci&oacute;n: <?php echo $nom_eva; ?>
        <p></p>
        
      </td>
    </tr>
    <tr>
      
    </tr>

     
    <tr class="cabecera_listado"  >
 <!-- # Evaluaciones  # Participantes Fecha Envio Configurar Envio  Editar  Eliminar -->
        <td align="left" >Positivo</td>
   </tr>
   
     
    
    <tr>
    <td></td>
      
      <?php $j=1; ?>
   <?php for ($i=0; $i <count($datos) ; $i++) { ?>
    <td align="left"><?php echo $datos[$i]['pos_nombre'].' '.$datos[$i]['pos_apaterno'].' '.$datos[$i]['pos_amaterno']; ?></td> 
  <?php } ?>
   </tr>
   <tr>
    <td align="left">RESULTADOS</td> 
    <?php for ($i=0; $i <count($datos) ; $i++) { ?>
    <td align="left"><?php echo $datos_posi[$i][1]; ?></td> 
  <?php } ?>
   </tr>
   <tr>
    <td align="left">CREATIVIDAD</td> 
    <?php for ($i=0; $i <count($datos) ; $i++) { ?>
    <td align="left"><?php echo $datos_posi[$i][2]; ?></td> 
  <?php } ?>
   </tr>
   <tr>
    <td align="left">PERSONAS</td> 
    <?php for ($i=0; $i <count($datos) ; $i++) { ?>
    <td align="left"><?php echo $datos_posi[$i][3]; ?></td> 
  <?php } ?>
   </tr>
   <tr>
    <td align="left">METODOLOGÍA</td> 
    <?php for ($i=0; $i <count($datos) ; $i++) { ?>
    <td align="left"><?php echo $datos_posi[$i][4]; ?></td> 
  <?php } ?>
   </tr>
   <tr>
     <td></td>
   </tr>
   <tr class="cabecera_listado"  >
 <!-- # Evaluaciones  # Participantes Fecha Envio Configurar Envio  Editar  Eliminar -->
        <td align="left" >Negativo
</td>
   </tr>

    
    <tr>
    <td></td>
      
      <?php $j=1; ?>
   <?php for ($i=0; $i <count($datos) ; $i++) { ?>
    <td align="left"><?php echo $datos[$i]['pos_nombre'].' '.$datos[$i]['pos_apaterno'].' '.$datos[$i]['pos_amaterno']; ?></td> 
  <?php } ?>
   </tr>
   <tr>
    <td align="left">RESULTADOS</td> 
    <?php for ($i=0; $i <count($datos) ; $i++) { ?>
    <td align="left"><?php echo $datos_nega[$i][1]; ?></td> 
  <?php } ?>
   </tr>
   <tr>
    <td align="left">CREATIVIDAD</td> 
    <?php for ($i=0; $i <count($datos) ; $i++) { ?>
    <td align="left"><?php echo $datos_nega[$i][2]; ?></td> 
  <?php } ?>
   </tr>
   <tr>
    <td align="left">PERSONAS</td> 
    <?php for ($i=0; $i <count($datos) ; $i++) { ?>
    <td align="left"><?php echo $datos_nega[$i][3]; ?></td> 
  <?php } ?>
   </tr>
   <tr>
    <td align="left">METODOLOGÍA</td> 
    <?php for ($i=0; $i <count($datos) ; $i++) { ?>
    <td align="left"><?php echo $datos_nega[$i][4]; ?></td> 
  <?php } ?>
   </tr>

   
</table>
    </div>
  </div>

  <p></p><p></p>
  <div class="row">
    <div class="class-col-md-12">
      <table  align="center" class="tabla_listado"  cellspacing="0" width="100%" id="example">
    <!-- table table-bordered table-striped -->
     
    
   
    

   
</table>
    </div>
  </div>

<br/>
<br/>

<?php }?>
</div>


<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

<script>
  function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('tbl_exporttable_to_xls');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "Cuadrocomparativo" });
       
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('Cuadrocomparativo.' + (type || 'xlsx')));
    }
</script>