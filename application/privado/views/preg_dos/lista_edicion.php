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
              <span class="cabecera_titulo">Plantilla</span>
               <span class="flecha2">&rarr;</span>
                <span class="cabecera_accion"> <?php echo $cabecera['accion'];?></span>

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
    
      <table width="100%"><tr><td>
        <table align="center" width="100%">
          <tr>
            <td class="enlaces_add_edit" align="left" width="100%">
              <?php echo anchor('Plantilla/listar','Listado Plantilla',array('class' =>'enlace_listar enlace_a1')); ?>
              &nbsp;&nbsp;
              
              
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

   <tr >
         <td align="center" valign="">Titulo</td>         
         <td align="center" valign=""><?php
                        echo anchor('Prueba_dos/vista_edicion_titulo/'.$resultado[0][$prefijo.'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">',array('class' =>'enlace_a1'));
                        ?></td>     
   </tr>
   <tr class="fila-color-2">
         <td align="center" valign="">Texto Bienvenida:
</td>         
         <td align="center" valign=""><?php
                        echo anchor('Prueba_dos/vista_edicion_texto/'.$resultado[0][$prefijo.'id'].'/1', '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">',array('class' =>'enlace_a1'));
                        ?></td>     
   </tr>
   <tr >
         <td align="center" valign="">Texto Instrucción:
</td>         
         <td align="center" valign=""><?php
                        echo anchor('Prueba_dos/vista_edicion_texto/'.$resultado[0][$prefijo.'id'].'/2', '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">',array('class' =>'enlace_a1'));
                        ?></td>     
   </tr>
   
   
   <tr class="fila-color-2">
         <td align="center" valign="">Preguntas
</td>         
         <td align="center" valign=""><?php
                        echo anchor('Prueba_dos/editar_preguntas/'.$resultado[0][$prefijo.'id'].'/1', '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">',array('class' =>'enlace_a1'));
                        ?></td>     
                        <!-- redirect('Prueba_dos/editar_preguntas/'.$id_pla.'/1');     -->
   </tr>
   <tr >
         <td align="center" valign="">Texto Despedida:
</td>         
         <td align="center" valign=""><?php
                        echo anchor('Prueba_dos/vista_edicion_texto/'.$resultado[0][$prefijo.'id'].'/4', '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">',array('class' =>'enlace_a1'));
                        ?></td>     
   </tr>
   
</table>
<br/>
<br/>

<?php }?>
</div>


