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
              <span class="cabecera_titulo">Puntajes Directos
</span>
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
              

            <?php echo anchor('Seguimiento/reporte_por_plantilla','Atrás',array('class' =>'enlace_retornar enlace_a1')); ?>&nbsp;&nbsp;
<input type="image" src="<?php echo base_url();?>files/img/excel_exportar.jpg"  onclick="ExportToExcel('xlsx')" alt="submit"/>
                                
                               
              
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
  
 <!-- <button onclick="ExportToExcel('xlsx')">
  <img src="" alt=""> 
</button> -->

  <style>

    .bordes_td{
      border: 1px solid #4B4141;  
      padding: 10px;  
    }
    .borde_tabla{
      border-collapse: collapse;
    }
  </style>
          <!-- tabla 1 -->
          
      <table  align="center"  id="tbl_exporttable_to_xls" class="tabla_listadozz"  cellspacing="0" width="100%" id="example">
    <!-- table table-bordered table-striped -->
    <tr>
      <td colspan="6">
        Plantilla: <?php echo $data_plantilla->zpla_titulo; ?>
      </td> 
    </tr>
    <tr>
      <td>Desde:</td>
      <td colspan="2" align="left">
         <?php echo $fecha_ini; ?>
      </td> 
      </tr>
      <tr>
        <td>Hasta:</td>
      <td colspan="2" align="left">
         <?php echo $fecha_fin; ?>         
      </td> 
    </tr>
    <tr>
      <td>
        <p></p>
      </td>
    </tr>
    <tr>
      <td colspan="16"></td>
    </tr>
    <tr class="cabecera_listado" border=1 >
      <td colspan="25">Puntajes Directos</td>
      
    </tr>
     
    <tr class="cabecera_listado"  >
 <!-- # Evaluaciones  # Participantes Fecha Envio Configurar Envio  Editar  Eliminar -->
        
        <!-- <td align="center" valign="">id</td> -->
        <td align="center" valign="">Nro</td>
        <td align="center" valign="">Nombre</td>
        <td align="center" valign="">Apellidos</td>
        <td align="center" valign="">Profesión</td>
        <td align="center" valign="">Est Secundaria</td>
        <td align="center" valign="">Género</td>
        <td align="center" valign="">Edad</td>
        <!-- campos postivos -->
        <!-- <td>id</td> -->
        <?php for ($j=0; $j <count($data_factores) ; $j++) {  ?> 
          <td>
             <?php echo $data_factores[$j]['letra']; ?>
          </td>

        <?php } ?>
      
      
         
         
         
   </tr>
   <?php $sw=0;$j=1; ?>
     <?php for ($i=0; $i <count($datos) ; $i++) {  ?> 
   
      <?php if ($sw==0): ?>
    <tr>
      <?php $sw=1; ?>
    <?php else: ?>
    <tr  class="fila-color-2">
     <?php $sw=0; ?>
    <?php endif ?>
   
   
   
     
   
      <!-- <td align="left"><?php echo $datos[$i]['id_pos']; ?></td> -->
      <td align="left"><?php echo $i+1; ?></td>
      <td align="left"><?php echo $datos[$i]['pos_nombre']; ?></td>
     <td align="left"><?php echo $datos[$i]['pos_apaterno'].' '.$datos[$i]['pos_amaterno']; ?></td>
     <td align="left"><?php echo $datos[$i]['profesion']; ?></td>
     <td align="left"><?php echo $datos[$i]['pof_lugar_estudios']; ?></td>
     <td align="left"><?php echo $datos[$i]['sexo']; ?></td>
     <td align="left"><?php echo $datos[$i]['edad']; ?></td>    
     
      
      
     
       <td align="left">
        <?php echo floor($datos[$i]['A']); ?>
        </td>
        <td align="left">
        <?php echo floor($datos[$i]['C']); ?>
        </td>
        <td align="left">
      <?php echo floor($datos[$i]['E']); ?>
        </td>
        <!-- A  C E F G H I L M N O Q1  Q2  Q3  Q4  val  val_IN  AQ -->

         <td align="left">
      <?php echo floor($datos[$i]['F']); ?>
        </td>
         <td align="left">
      <?php echo floor($datos[$i]['G']); ?>
        </td>
         <td align="left">
      <?php echo floor($datos[$i]['H']); ?>
        </td>
         <td align="left">
      <?php echo floor($datos[$i]['I']); ?>
        </td>
         <td align="left">
      <?php echo floor($datos[$i]['L']); ?>
        </td>
         <td align="left">
      <?php echo floor($datos[$i]['M']); ?>
        </td>
         <td align="left">
      <?php echo floor($datos[$i]['N']); ?>
        </td>
         <td align="left">
      <?php echo floor($datos[$i]['O']); ?>
        </td>
         <td align="left">
      <?php echo floor($datos[$i]['Q1']); ?>
        </td>
         <td align="left">
      <?php echo floor($datos[$i]['Q2']); ?>
        </td>
         <td align="left">
      <?php echo floor($datos[$i]['Q3']); ?>
        </td>
         <td align="left">
      <?php echo floor($datos[$i]['Q4']); ?>
        </td>
         <td align="left">
      <?php echo floor($datos[$i]['VAL']); ?>
        </td>
         <td align="left">
      <?php echo floor($datos[$i]['valor_IN']); ?>
        </td>
          <td align="left">
      <?php echo floor($datos[$i]['AQ']); ?>
        </td>


      
      
   </tr>
      <?php $j++; ?>
     <?php } ?>


   
</table>
        
 


    


  
   

    
 
    
   


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
       var wb = XLSX.utils.table_to_book(elt, { sheet: "Puntajes_Directos" });
       
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('Puntajes_Directos.' + (type || 'xlsx')));
    }
</script>

