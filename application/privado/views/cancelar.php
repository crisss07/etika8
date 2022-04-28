<?php
  if($this->no_mostrar_enlaces)
  {
  ?>
  <table align="center" width="100%">
      <tr>
          <td class="enlaces_add_edit" align="left" width="100%">
              <?php echo anchor('inicio','Cancelar',array('class' =>'enlace_cancelar enlace_a1','title' =>'Cancelar accion')); ?>
              <br/><br/><br/>
          </td>

      </tr>
  </table>

  <?php
  }
  ?>