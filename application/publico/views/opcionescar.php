 <?php
 
  if(!$this->no_mostrar_enlaces)
  {
   ?>

   <table align="center" width="100%">
          <tr>
              <td class="enlaces_add_edit" align="left" width="100%">
                  <?php  
                  if($this->idp){
                     
                     echo anchor($this->controlador.$this->action_defecto.'/idp/'.$this->idp,$this->msj_retorno,array('class' =>'enlace_retornar enlace_a1'));
                     
                  }
                  ?>
     
                   
              </td>

          </tr>
      </table>


<?php 
    }
?>