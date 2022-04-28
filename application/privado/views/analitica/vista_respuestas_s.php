
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
            if($cabecera['titulo'])
            {
              ?>
              <span class="cabecera_titulo">Listado Participantes</span>
              <?php
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


$alineacionw='center';
$alineacionh='middle';

?>
  <?php
  $sitio=$this->tool_entidad->sitioindexpri();
  ?>

<br>
<br>
	<div class="row text-left">
	<div class="col-lg-4">
		<p><b>Postulante: </b><?php echo $nombres; ?></p>
	</div>
	<div class="col-lg-2">
		<p><b>Puntaje Bruto: </b><?php echo $notap; ?></p>
	</div>
	<div class="col-lg-2">
		<p><b>Puntaje Baremo: </b><?php echo $notab; ?></p>
	</div>
  </div>
  <br>


  <div class="row">
    <div class="class-col-md-2">
      <table  align="center" class="tabla_listado"  cellspacing="0" width="100%" id="example">
    <!-- table table-bordered table-striped -->
     <tr class="cabecera_listado"  > 
      <td align="center" valign="" colspan="5"><?php echo $nombre_eval; ?></td>
     </tr>
    <tr class="cabecera_listado"  >
 <!-- # Evaluaciones  # Participantes Fecha Envio Configurar Envio  Editar  Eliminar -->
        
        <td align="center" valign="">id</td>
        <td align="center" valign="">Nro</td>
         <td align="center" valign="">Pregunta</td>
         <td align="center" valign="">Respuesta</td>
   </tr>
     
   <?php
   foreach ($datos as $fila)
   {
    ?>
    <tr>
      <td align="left"><?php echo $idpos; ?></td>     
      <td align="left"><?php echo $fila['nro']; ?></td>
     <td align="left"><?php echo $fila['pregunta']; ?></td>
     <td align="left"><?php echo $fila['respuesta']; ?></td>
     

   </tr>
   <?php

	}
 ?>
</table>
    </div>
    </div>
	
<br>
<br>
<br>