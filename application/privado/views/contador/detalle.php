<table  align="center" class="tabla_listado"  cellspacing="0" width="100%" >
    <!-- table table-bordered table-striped -->
    <tr class="cabecera_listado">


      
         <td align="center" valign="">Nro</td>
         <td align="center" valign="">Nombre</td>
         <td align="center" valign="">Conteo</td>
         
      
   </tr>
   <?php
   foreach ($datos as $fila)
   {
    ?>
    <tr>
      <td align="center"> <?php  print_r($fila['con_id']); ?> </td>
      <td align="center" valign="middle">
       <?php  print_r($fila['con_nombre']); ?>
     </td>                     
     <td align="center" valign="middle"> <?php  print_r($fila['total']); ?></td>
   </tr>
   <?php
 }
 ?>
</table>