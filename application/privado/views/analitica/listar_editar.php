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

<br>

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
              <?php echo anchor($this->controlador.'agregar','Nuevo',array('class' =>'enlace_nuevo enlace_a1')); ?>&nbsp;&nbsp;
                                <?php echo anchor($this->controlador,'Listado',array('class' =>'enlace_listar enlace_a1')); ?>
                                &nbsp;&nbsp;
              <?php echo anchor('Reportes', 'Cancelar', array('class' => 'enlace_cancelar enlace_a1')); ?>                   
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


      
         <td align="center" valign="">Campo</td>
         <td align="center" valign="">Editar</td>

                 
         
      
   </tr>
   <?php
	$fila_color = array('fila-color-1','fila-color-2');
			$color=0;
            foreach ($datos as $fila)
            {
				if($color==0)
				{ ?>
				<tr class="<?php echo $fila_color[$color]; $color=1; ?>">
				<?php }
				else{ ?>
				<tr class="<?php echo $fila_color[$color]; $color=0; ?>">
				<?php }
				?>
      <td align="center"> <?php echo $fila['titulo'];?> </td>
     <td align="center" valign="middle">
                        <?php
                        echo anchor($this->controlador.$fila['enlace'].$id, '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">',array('class' =>'enlace_a1'));
                        ?>
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


