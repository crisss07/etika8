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
<br>
 <?php
if($this->idp){
    switch ($this->idp) {
        case 1:
            $mostrar='<div align="center" style="font-size: 16px; font-weight: bold">Postulante </div>Formulario de Postulación
                        <table width="100%"><tr>
                                <td width="15"> &nbsp; </td>
                                <td align="left"> &bull; Información adicional<br/>
                                    <table width="100%"><tr>
                                            <td width="15"> &nbsp; </td>
                                            <td align="left"> 
                                                <table width="100%" border="0"><tr>
                                                        <td width="15"> &nbsp; </td>
                                                        <td align="left"> &rarr; Idioma</td>
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
                                <td align="left"> &bull; Datos Personales<br/>
                                    <table width="100%"><tr>
                                            <td width="15"> &nbsp; </td>
                                            <td align="left"> 
                                                <table width="100%" border="0"><tr>
                                                        <td width="15"> &nbsp; </td>
                                                        <td align="left"> &rarr; Ciudad o Localidad</td>
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
    <br>
<?php
}
?>
<?php
$this->load->view('opciones');
$alineacionwc1='center';
$alineacionhc1='middle';
$alineacionwc2='left';
$alineacionhc2='middle';
?>
<br/>
<br>
<?php echo form_open_multipart($action); ?>
<input type="hidden" name="<?php echo $prefijo.'id';?>" value="<?php echo @set_value($prefijo.'id',$fila[$prefijo.'id']);?>">
<input type="hidden" name="idp" value="<?php echo set_value($this->idp,$this->idp);?>">
<table id="form_admin">    
    <tr>
        
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">

            <p class="form-label-21">Idioma: </p>
          <?php echo form_label('', $prefijo.'idioma');?>
            <input name="<?php echo $prefijo.'idioma';?>" id="<?php echo $prefijo.'idioma';?>" class="input1" size="80" value="<?php echo @$fila[$prefijo.'idioma'];?>"/>
            <?php 
                
//                echo form_input(array(
//                    'name' => $prefijo.'idioma',
//                    'id' => $prefijo.'idioma',
//                    'class' => 'input1',
//                    'size' => '80',
//                    'value' => set_value($prefijo.'idioma',$fila[$prefijo.'idioma'])
//                  ));

                  if(form_error($prefijo.'idioma'))
                     echo '<div class="error">'.form_error($prefijo.'idioma').'</div>';
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
