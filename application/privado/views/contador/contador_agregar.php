<?php  
$prefijo=$this->prefijo;
?>
<table align="center" width="100%">
      <tr>
          <td class="enlaces_add_edit" align="left" width="100%">
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
                                      <span class="cabecera_titulo"> <?php echo $cabecera['titulo_general'];?></span>
                                      <br/>
                                      <?php
                                          }
                                      ?>
                                      <?php
                                      if($cabecera['titulo'])
                                          {
                                      ?>
                                      <span class="cabecera_titulo"> <?php echo $cabecera['titulo'];?></span>
                                      <?php
                                          }
                                      if($cabecera['accion'])
                                         {
                                      ?>
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
if(@$this->idp){
    switch ($this->idp) {
        case 1:
            $mostrar='<div align="center" style="font-size: 16px; font-weight: bold">Postulante </div>Formulario de Postulación
                        <table width="100%"><tr>
                                <td width="15"> &nbsp; </td>
                                <td align="left"> &bull; Instrucción Formal<br/>
                                    <table width="100%"><tr>
                                            <td width="15"> &nbsp; </td>
                                            <td align="left"> - Educación Post Grado
                                                <table width="100%" border="0"><tr>
                                                        <td width="15"> &nbsp; </td>
                                                        <td align="left"> &rarr; Grado o Titulo</td>
                                                </tr></table>
                                            </td>
                                    </tr></table>
                                </td>
                        </tr></table>';
            break;
        case 2:
            $mostrar='<div align="center" style="font-size: 16px; font-weight: bold">Postulante </div>Formulario de Postulación
                        <table width="100%"><tr>
                                <td width="15"> &nbsp; </td>
                                <td align="left"> &bull; Instrucción Formal<br/>
                                    <table width="100%"><tr>
                                            <td width="15"> &nbsp; </td>
                                            <td align="left"> - Educación Superior
                                                <table width="100%" border="0"><tr>
                                                        <td width="15"> &nbsp; </td>
                                                        <td align="left"> &rarr; Grado o Titulo</td>
                                                </tr></table>
                                            </td>
                                    </tr></table>
                                </td>
                        </tr></table>';
            break;
        case 3:
            $mostrar='<div align="center" style="font-size: 16px; font-weight: bold">Postulante </div>Formulario de Postulación
                        <table width="100%"><tr>
                                <td width="15"> &nbsp; </td>
                                <td align="left"> &bull; Instrucción Formal<br/>
                                    <table width="100%"><tr>
                                            <td width="15"> &nbsp; </td>
                                            <td align="left"> - Educación Superior
                                                <table width="100%" border="0"><tr>
                                                        <td width="15"> &nbsp; </td>
                                                        <td align="left"> &rarr; Área de profesion</td>
                                                </tr></table>
                                            </td>
                                    </tr></table>
                                </td>
                        </tr></table>';
            break;
        case 4:
            $mostrar='<div align="center" style="font-size: 16px; font-weight: bold">Postulante </div>Formulario de Postulación
                        <table width="100%"><tr>
                                <td width="15"> &nbsp; </td>
                                <td align="left"> &bull; Trayectoria Laboral <br/>
                                    <table width="100%"><tr>
                                            <td width="15"> &nbsp; </td>
                                            <td align="left"> - Experiencia Laboral
                                                <table width="100%" border="0"><tr>
                                                        <td width="15"> &nbsp; </td>
                                                        <td align="left"> &rarr; Tipo de Organización</td>
                                                </tr></table>
                                            </td>
                                    </tr></table>
                                </td>
                        </tr></table>';
            break;
        case 5:
            $mostrar='<div align="center" style="font-size: 16px; font-weight: bold">Postulante </div>Formulario de Postulación
                        <table width="100%"><tr>
                                <td width="15"> &nbsp; </td>
                                <td align="left"> &bull; Trayectoria Laboral<br/>
                                    <table width="100%"><tr>
                                            <td width="15"> &nbsp; </td>
                                            <td align="left"> - Síntesis de Experiencia Laboral
                                                <table width="100%" border="0"><tr>
                                                        <td width="15"> &nbsp; </td>
                                                        <td align="left"> &rarr; Área de experiencia que usted resaltaría</td>
                                                </tr></table>
                                            </td>
                                    </tr></table>
                                </td>
                        </tr></table>';
            break;
        case 6:
            $mostrar='<div align="center" style="font-size: 16px; font-weight: bold">Postulante </div>Formulario de Postulación
                        <table width="100%"><tr>
                                <td width="15"> &nbsp; </td>
                                <td align="left"> &bull; Trayectoria Laboral<br/>
                                    <table width="100%"><tr>
                                            <td width="15"> &nbsp; </td>
                                            <td align="left"> - Síntesis de Experiencia Laboral
                                                <table width="100%" border="0"><tr>
                                                        <td width="15"> &nbsp; </td>
                                                        <td align="left"> &rarr; Sector de experiencia que usted resaltaría</td>
                                                </tr></table>
                                            </td>
                                    </tr></table>
                                </td>
                        </tr></table>';
            break;
        case 7:
            $mostrar='<div align="center" style="font-size: 16px; font-weight: bold">Postulante </div>Formulario de Postulación
                        <table width="100%"><tr>
                                <td width="15"> &nbsp; </td>
                                <td align="left"> &bull; Procesar<br/>
                                    <table width="100%"><tr>
                                            <td width="15"> &nbsp; </td>
                                            <td align="left"> - Etapas
                                                <table width="100%" border="0"><tr>
                                                        <td width="15"> &nbsp; </td>
                                                        <td align="left"> &rarr; Recomendación</td>
                                                </tr></table>
                                            </td>
                                    </tr></table>
                                </td>
                        </tr></table>';
            break;
        case 8:
            $mostrar='<div align="center" style="font-size: 16px; font-weight: bold">ETIKOS </div>Servicios
                        <table width="100%"><tr>
                                <td width="15"> &nbsp; </td>
                                <td align="left"> &bull; Tipo Servicios<br/>
                                </td>
                        </tr></table>';
            break;
        case 9:
            $mostrar='<div align="center" style="font-size: 16px; font-weight: bold">Postulante </div>Formulario de Postulación
                        <table width="100%"><tr>
                                <td width="15"> &nbsp; </td>
                                <td align="left"> &bull; Trayectoria Laboral<br/>
                                    <table width="100%"><tr>
                                            <td width="15"> &nbsp; </td>
                                            <td align="left"> - Síntesis de Experiencia Laboral
                                                <table width="100%" border="0"><tr>
                                                        <td width="15"> &nbsp; </td>
                                                        <td align="left"> &rarr; Máximo nivel alcanzado</td>
                                                </tr></table>
                                            </td>
                                    </tr></table>
                                </td>
                        </tr></table>';
            break;
    }
?>
<div id="cabecera_listado">
    <table width="100%">
        <tr>
            <td>
                <span class="text3">
                    <?php echo $mostrar; ?>
                </span>
            </td>
        </tr>
    </table>
    </div>
<?php
}
?>
<table align="center" width="100%">
    <tr>
        <td class="enlaces_add_edit" align="left" width="100%">
            <?php echo anchor($this->ruta_retorno, $this->msj_retorno, array('class' => 'enlace_retornar enlace_a1')); ?>&nbsp;&nbsp;
            <?php echo anchor($this->controlador . 'agregar', 'Nuevo', array('class' => 'enlace_nuevo enlace_a1')); ?>&nbsp;&nbsp;
            <?php echo anchor($this->controlador . 'listar', 'Listado', array('class' => 'enlace_listar enlace_a1')); ?>&nbsp;&nbsp;
            <?php echo anchor($this->controlador . 'listar', 'Cancelar', array('class' => 'enlace_cancelar enlace_a1')); ?>  
        </td>
    </tr>
</table>
<?php
$alineacionwc1='center';
$alineacionhc1='middle';
$alineacionwc2='left';
$alineacionhc2='middle';
?>
<br/>
<?php echo form_open_multipart($action); ?>
<input type="hidden" name="<?php echo $prefijo.'id';?>" value="<?php echo @set_value($prefijo.'id',$fila[$prefijo.'id']);?>">
<input type="hidden" name="idp" value="<?php print_r(@set_value($this->idp,$this->idp));?>">
<table id="form_admin">    
    <tr>
        
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
          <p class="form-label-21">Nombre: </p>
      <?php echo form_label('', $prefijo.'nombre');?>
            <?php 
                
                echo form_input(array(
                    'name' => $prefijo.'nombre',
                    'id' => $prefijo.'nombre',
                    'class' => 'input1',
                    'size' => '80',
                    'value' => @set_value($prefijo.'nombre',$fila[$prefijo.'nombre'])
                  ));

                  if(form_error($prefijo.'nombre'))
                     echo '<div class="error">'.form_error($prefijo.'nombre').'</div>';
            ?>
        </td>
    </tr>       
</table>


<br/>
<?php echo form_submit(array(
                    'name' => $prefijo.'enviar',
                    'class' => 'btn-etika btn',
                    'value' => 'Guardar'));?>
    
<?php echo form_close() ?>
