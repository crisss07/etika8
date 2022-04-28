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
  
 

  <table  align="center" class="tabla_listado"  cellspacing="0" width="100%" id="example">
    <tr >
        <td align="center" valign="">
          
        </td>
        <td align="center" valign="">
          
        </td>
        <td align="center" valign="">
          
        </td>         
   </tr>
</table>
 <button onclick="ExportToExcel('xlsx')">Export table to excel</button>
<!-- las 3 tablas -->
<div class="row">
  <div class="col-md-4">
    
<?php $sw=0; ?>
      <table  align="center" class="tabla_listado" id="tbl_exporttable_to_xls" cellspacing="0" width="100%" id="example">
    <!-- table table-bordered table-striped -->
    <tr>
      <td colspan="6">Puntajes Directos 
</td>
    </tr>
     
    <tr class="cabecera_listado"  >
 <!-- # Evaluaciones  # Participantes Fecha Envio Configurar Envio  Editar  Eliminar -->
        
        <td align="center" valign="">id</td>
        <td align="center" valign="">Nro</td>
        <td align="center" valign="">Nombre</td>
        <td align="center" valign="">Apellidos</td>
        <td align="center" valign="">Género</td>
        <td align="center" valign="">Edad</td>
         
         
         
   </tr>
     <?php $j=1; ?>
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
      <td align="left"><?php echo $fila->id_pos; ?></td>
      <td align="left"><?php echo $j; ?></td>
      <td align="left"><?php echo $fila->pos_nombre; ?></td>
     <td align="left"><?php echo $fila->pos_apaterno.' '.$fila->pos_amaterno; ?></td>
     <td align="left"><?php echo $fila->sexo; ?></td>
     <td align="left"><?php echo $fila->edad; ?></td>
   </tr>
   <?php $j++; ?>
   <?php
 }
 ?>
</table>
  </div>
  <div class="col-md-4">
    <?php $sw=0; ?>
      <table  align="center" class="tabla_listado"  cellspacing="0" width="100%" id="example">
    <!-- table table-bordered table-striped -->
    <tr>
      <td colspan="5">
        Situaciones Positivas 
      </td>
    </tr>
    <tr class="cabecera_listado">
      <td>id</td>
      <td>
        RESULTADOS      
      </td>
      <td>CREATIVO</td>
      <td>PERSONAS</td>
      <td>METODICO</td>
    </tr>

     <?php for ($i=0; $i <3 ; $i++) {  ?>   
     
    <tr  class="fila-color-2">
     
      <td align="left"><?php echo $datos_posi[$i][0]; ?></td>
      <td align="left"><?php echo $datos_posi[$i][1]; ?></td>
      <td align="left"><?php echo $datos_posi[$i][2]; ?></td>
      <td align="left"><?php echo $datos_posi[$i][3]; ?></td>
      <td align="left"><?php echo $datos_posi[$i][4]; ?></td>
   </tr>
   
   <?php
 }
 ?>
</table>
  </div>
  <div class="col-md-4">
    <?php $sw=0; ?>
      <table  align="center" class="tabla_listado"  cellspacing="0" width="100%" id="example">
    <!-- table table-bordered table-striped -->
    <tr>
      <td colspan="5">
        Situaciones Negativas 

      </td>
    </tr>
    <tr class="cabecera_listado">
      <td>id</td>
      <td>
        RESULTADOS      
      </td>
      <td>CREATIVO</td>
      <td>PERSONAS</td>
      <td>METODICO</td>
    </tr>

     <?php for ($i=0; $i <3 ; $i++) {  ?>   
     
    <tr  class="fila-color-2">
     
      <td align="left"><?php echo $datos_nega[$i][0]; ?></td>
      <td align="left"><?php echo $datos_nega[$i][1]; ?></td>
      <td align="left"><?php echo $datos_nega[$i][2]; ?></td>
      <td align="left"><?php echo $datos_nega[$i][3]; ?></td>
      <td align="left"><?php echo $datos_nega[$i][4]; ?></td>
   </tr>
   
   <?php
 }
 ?>
</table>
  </div>
</div>

    


  
   

    
 
    
   


  </div>

<br/>
<br/>
</form>
<?php }?>
</div>


<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

<script>
  function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('tbl_exporttable_to_xls');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx')));
    }
</script>