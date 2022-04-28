 <?php
 
  if(!$this->no_mostrar_enlaces)
  {
   ?>

   <table align="center" width="100%">
          <tr>
              <td class="enlaces_add_edit" align="left" width="100%">
                  <?php  
                  if($this->idp){
                      if($this->tip){
                        echo anchor($this->ruta_retorno.'/idp/'.$this->idsup.'/tip/'.$this->tip,$this->msj_retorno,array('class' =>'enlace_retornar enlace_a1'));
                      }
                      else
                      {
                         echo anchor($this->ruta_retorno,$this->msj_retorno,array('class' =>'enlace_retornar enlace_a1'));
                      }
                    if($this->tip){?>
                       <?php echo anchor($this->controlador.'agregar/idp/'.$this->idp.'/tip/'.$this->tip,'Nuevo',array('class' =>'enlace_nuevo enlace_a1')); ?>&nbsp;&nbsp;
                      <?php echo anchor($this->controlador.'listar/idp/'.$this->idp.'/tip/'.$this->tip,'Listado',array('class' =>'enlace_listar enlace_a1')); ?>
                       &nbsp;&nbsp;
                      <?php  echo anchor($this->controlador.'listar/idp/'.$this->idp.'/tip/'.$this->tip,'Cancelar',array('class' =>'enlace_cancelar enlace_a1')); ?>
                      <?php
                    }
                    else{
                        ?>
                       <?php echo anchor($this->controlador.'agregar/idp/'.$this->idp,'Nuevo',array('class' =>'enlace_nuevo enlace_a1')); ?>&nbsp;&nbsp;
                  <?php echo anchor($this->controlador.'listar/idp/'.$this->idp,'Listado',array('class' =>'enlace_listar enlace_a1')); ?>
                   &nbsp;&nbsp;
                  <?php  echo anchor($this->controlador.'listar/idp/'.$this->idp,'Cancelar',array('class' =>'enlace_cancelar enlace_a1')); ?>

                        <?php
                    }

                  }
                  else{
                      if($this->tip){?>
                       <?php echo anchor($this->controlador.'agregar/tip/'.$this->tip,'Nuevo',array('class' =>'enlace_nuevo enlace_a1')); ?>&nbsp;&nbsp;
                      <?php echo anchor($this->controlador.'listar/tip/'.$this->tip,'Listado',array('class' =>'enlace_listar enlace_a1')); ?>
                       &nbsp;&nbsp;
                      <?php  echo anchor($this->controlador.'listar/tip/'.$this->tip,'Cancelar',array('class' =>'enlace_cancelar enlace_a1')); ?>
                      <?php
                    }
                    else{
                        ?>
                       <?php echo anchor($this->controlador.'agregar','Nuevo',array('class' =>'enlace_nuevo enlace_a1')); ?>&nbsp;&nbsp;
                  <?php echo anchor($this->controlador.'listar','Listado',array('class' =>'enlace_listar enlace_a1')); ?>
                   &nbsp;&nbsp;
                  <?php  echo anchor($this->controlador.'listar','Cancelar',array('class' =>'enlace_cancelar enlace_a1')); ?>

                        <?php
                    }


                  }
                  ?>
                   <br/>
              </td>

          </tr>
      </table>

<?php 
    }
?>