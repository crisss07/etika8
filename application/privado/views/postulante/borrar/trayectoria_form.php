<?php
$this->load->view('cabecera');
?>
<?php  
$prefijo=$this->prefijo3;
$alineacionwc1='center';
$alineacionhc1='middle';
$alineacionwc2='left';
$alineacionhc2='middle';
?>
<?php echo form_open_multipart($action); ?>

<?php
   echo form_hidden($prefijo.'id', set_value($prefijo.'id',$fila[$prefijo.'id']));
?>
<input type="hidden" name="<?php echo $prefijo.'id';?>" value="<?php echo set_value($prefijo.'id',$fila[$prefijo.'id']);?>">
<input type="hidden" name="<?php echo 'ids';?>" value="<?php echo $ids;?>">
<?php
    echo '<br/><div align="center">'.anchor($this->controlador.'trayectoria_laboral/id/'.$ids,'Cancelar',array('class' =>'enlace_cancelar enlace_a1')).'</div><br/>';    
?>

    <table id="form_admin">
        <tr>
            <td colspan="2" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
                <?php $fecha='desde';?>
                <?php echo form_label('Desde: ', $prefijo.$nombre);?>
                <?php
                if(!$fila[$prefijo.$fecha])
                    {
                        $fila[$prefijo.$fecha]='aaaa-mm';
                    }else{
                        $fila[$prefijo.$fecha]=substr($fila[$prefijo.$fecha],0,7);
                    }
                 ?>
                <input maxlength="7" type="input" class="input1_normal" style="color:#aca899;" id="<?php echo $prefijo.$fecha;?>" name="<?php echo $prefijo.$fecha;?>" size="7" onFocus="if(this.value == 'aaaa-mm'){this.value='';this.style.color='#000000';}" onBlur="if(this.value == ''){this.value='aaaa-mm';this.style.color='#aca899';}" value="<?php echo set_value($prefijo.$fecha,$fila[$prefijo.$fecha]);?>" ><span class="texto2">&nbsp;Año-mes</span>
                <?php $fecha='hasta';?>
                <?php echo form_label('Hasta: ', $prefijo.$nombre);?>
                <?php
                if(!$fila[$prefijo.$fecha])
                    {
                        $fila[$prefijo.$fecha]='aaaa-mm';
                    }else{
                        $fila[$prefijo.$fecha]=substr($fila[$prefijo.$fecha],0,7);
                    }
                ?>
                <input maxlength="7" type="input" class="input1_normal" style="color:#aca899;" id="<?php echo $prefijo.$fecha;?>" name="<?php echo $prefijo.$fecha;?>" size="7" onFocus="if(this.value == 'aaaa-mm'){this.value='';this.style.color='#000000';}" onBlur="if(this.value == ''){this.value='aaaa-mm';this.style.color='#aca899';}" value="<?php echo set_value($prefijo.$fecha,$fila[$prefijo.$fecha]);?>" ><span class="texto2">&nbsp;Año-mes</span>
                <?php
                      if(form_error($prefijo.'desde')||form_error($prefijo.'hasta'))
                         echo '<div class="error">Debe ingresar un Formato correcto de fecha</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
                <?php $nombre='organizacion';?>
                <?php echo form_label(' Nombre de la Organización: ', $prefijo.$nombre);?>
            </td>
            <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
                <?php
                    echo "<input type='text' name=".$prefijo.$nombre." id=".$prefijo.$nombre."
                                    class='input1' size='35' onblur='Mayusculas(this.value,this.id)' value='".$fila[$prefijo.$nombre]."' />";
//                    echo form_input(array(
//                        'name' => $prefijo.$nombre,
//                        'id' => $prefijo.$nombre,
//                        'class' => 'input1',
//                        'size' => '35',
//                        'onblur'=>'Mayusculas(this.value,this.id)',
//                        'value' => set_value($prefijo.$nombre,$fila[$prefijo.$nombre])
//                      ));

                      if(form_error($prefijo.$nombre))
                         echo '<div class="error">'.form_error($prefijo.$nombre).'</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
                <?php $campo1='tipo_org';?>
                <?php echo form_label(' Tipo de Organización: ', $prefijo.$campo1);?>
            </td>
            <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
                <?php
                    echo form_dropdown($prefijo.$campo1,$this->tipo_org,set_value($prefijo.$campo1,$fila[$prefijo.$campo1]));
                      if(form_error($prefijo.$campo1))
                         echo '<div class="error">'.form_error($prefijo.$campo1).'</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
                <?php $nombre='descripcion_org';?>
                <?php echo form_label(' Actividad Principal de la Organización: ', $prefijo.$nombre);?>
            </td>
            <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
                <?php
                    echo "<textarea name=".$prefijo.$nombre." id=".$prefijo.$nombre."
                                    class='input1' rows='4' cols='45' onblur='Mayusculas(this.value,this.id)'>".$fila[$prefijo.$nombre]."</textarea>";
//                    echo form_textarea(array(
//                        'name' => $prefijo.$nombre,
//                        'id' => $prefijo.$nombre,
//                        'class' => 'input1',
//                        'rows' => '4',
//                        'cols' => '45',
//                        'onblur'=>'Mayusculas(this.value,this.id)',
//                        'value' => set_value($prefijo.$nombre,$fila[$prefijo.$nombre])
//                      ));

                      if(form_error($prefijo.$nombre))
                         echo '<div class="error">'.form_error($prefijo.$nombre).'</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
                <?php $nombre='cargos';?>
                <?php echo form_label(' Cargo(s) Ocupado(s): ', $prefijo.$nombre);?>
            </td>
            <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
                <?php
                    echo "<textarea name=".$prefijo.$nombre." id=".$prefijo.$nombre."
                                    class='input1' rows='4' cols='45' onblur='Mayusculas(this.value,this.id)'>".$fila[$prefijo.$nombre]."</textarea>";
//                    echo form_textarea(array(
//                        'name' => $prefijo.$nombre,
//                        'id' => $prefijo.$nombre,
//                        'class' => 'input1',
//                        'rows' => '4',
//                        'cols' => '45',
//                        'onblur'=>'Mayusculas(this.value,this.id)',
//                        'value' => set_value($prefijo.$nombre,$fila[$prefijo.$nombre])
//                      ));

                      if(form_error($prefijo.$nombre))
                         echo '<div class="error">'.form_error($prefijo.$nombre).'</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
                <?php $nombre='funciones_org';?>
                <?php echo form_label(' 3 Principales Funciones Desempeñadas dentro del Cargo: ', $prefijo.$nombre);?>
            </td>
            <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
                <?php
                    echo "<textarea name=".$prefijo.$nombre." id=".$prefijo.$nombre."
                                    class='input1' rows='4' cols='45' onblur='Mayusculas(this.value,this.id)'>".$fila[$prefijo.$nombre]."</textarea>";
//                    echo form_textarea(array(
//                        'name' => $prefijo.$nombre,
//                        'id' => $prefijo.$nombre,
//                        'class' => 'input1',
//                        'rows' => '4',
//                        'cols' => '45',
//                        'onblur'=>'Mayusculas(this.value,this.id)',
//                        'value' => set_value($prefijo.$nombre,$fila[$prefijo.$nombre])
//                      ));

                      if(form_error($prefijo.$nombre))
                         echo '<div class="error">'.form_error($prefijo.$nombre).'</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
                <?php $nombre='logros';?>
                <?php echo form_label(' Principales Logros: ', $prefijo.$nombre);?>
            </td>
            <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
                <?php
                    echo "<textarea name=".$prefijo.$nombre." id=".$prefijo.$nombre."
                                    class='input1' rows='4' cols='45' onblur='Mayusculas(this.value,this.id)'>".$fila[$prefijo.$nombre]."</textarea>";
//                    echo form_textarea(array(
//                        'name' => $prefijo.$nombre,
//                        'id' => $prefijo.$nombre,
//                        'class' => 'input1',
//                        'rows' => '4',
//                        'cols' => '45',
//                        'onblur'=>'Mayusculas(this.value,this.id)',
//                        'value' => set_value($prefijo.$nombre,$fila[$prefijo.$nombre])
//                      ));

                      if(form_error($prefijo.$nombre))
                         echo '<div class="error">'.form_error($prefijo.$nombre).'</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
                <?php $nombre='pais';?>
                <?php echo form_label(' País - Ciudad : ', $prefijo.$nombre);?>
            </td>
            <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
                <?php
                    echo "<input type='text' name=".$prefijo.$nombre." id=".$prefijo.$nombre."
                                    class='input1' size='20' onblur='Mayusculas(this.value,this.id)' value='".$fila[$prefijo.$nombre]."' />";
//                    echo form_input(array(
//                        'name' => $prefijo.$nombre,
//                        'id' => $prefijo.$nombre,
//                        'class' => 'input1',
//                        'size' => '20',
//                        'onblur'=>'Mayusculas(this.value,this.id)',
//                        'value' => set_value($prefijo.$nombre,$fila[$prefijo.$nombre])
//                      ));

                      if(form_error($prefijo.$nombre))
                         echo '<div class="error">'.form_error($prefijo.$nombre).'</div>';
                ?>
            </td>
        </tr>        
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
                <?php $nombre='nsubordinados';?>
                <?php echo form_label(' Nº de Subordinados: ', $prefijo.$nombre);?>
            </td>
            <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
                <?php

                    echo form_input(array(
                        'name' => $prefijo.$nombre,
                        'id' => $prefijo.$nombre,
                        'class' => 'input1_normal',
                        'size' => '5',
                        'value' => set_value($prefijo.$nombre,$fila[$prefijo.$nombre])
                      ));

                      if(form_error($prefijo.$nombre))
                         echo '<div class="error">'.form_error($prefijo.$nombre).'</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
                <?php $nombre='sueldo';?>
                <?php echo form_label(' Total Ganado Mensual: ', $prefijo.$nombre);?>
            </td>
            <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
                <?php

                    echo form_input(array(
                        'name' => $prefijo.$nombre,
                        'id' => $prefijo.$nombre,
                        'class' => 'input1_normal',
                        'size' => '5',
                        'value' => set_value($prefijo.$nombre,$fila[$prefijo.$nombre]),
                        'onkeyup'=>"this.value=Numeros(this.value)"
                      )).' en Bs.';

                      if(form_error($prefijo.$nombre))
                         echo '<div class="error">'.form_error($prefijo.$nombre).'</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
                <?php $nombre='telefono_org';?>
                <?php echo form_label(' Teléfono(s) de la Organización: ', $prefijo.$nombre);?><br/>
            </td>
            <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
                <?php

                    echo form_input(array(
                        'name' => $prefijo.$nombre,
                        'id' => $prefijo.$nombre,
                        'class' => 'input1',
                        'size' => '15',
                        'value' => set_value($prefijo.$nombre,$fila[$prefijo.$nombre])
                      ));

                      if(form_error($prefijo.$nombre))
                         echo '<div class="error">'.form_error($prefijo.$nombre).'</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
                <?php $nombre='nombre_sup';?>
                <?php echo form_label(' Nombre del Inmediato Superior: ', $prefijo.$nombre);?><br/>
            </td>
            <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
                <?php
                    echo "<input type='text' name=".$prefijo.$nombre." id=".$prefijo.$nombre."
                                    class='input1' size='25' onblur='Mayusculas(this.value,this.id)' value='".$fila[$prefijo.$nombre]."' />";
//                    echo form_input(array(
//                        'name' => $prefijo.$nombre,
//                        'id' => $prefijo.$nombre,
//                        'class' => 'input1',
//                        'size' => '25',
//                        'onblur'=>'Mayusculas(this.value,this.id)',
//                        'value' => set_value($prefijo.$nombre,$fila[$prefijo.$nombre])
//                      ));

                      if(form_error($prefijo.$nombre))
                         echo '<div class="error">'.form_error($prefijo.$nombre).'</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
                <?php $nombre='telefono_sup';?>
                <?php echo form_label(' Teléfono(s) del Inmediato Superior: ', $prefijo.$nombre);?><br/>
            </td>
            <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
                <?php

                    echo form_input(array(
                        'name' => $prefijo.$nombre,
                        'id' => $prefijo.$nombre,
                        'class' => 'input1',
                        'size' => '15',
                        'value' => set_value($prefijo.$nombre,$fila[$prefijo.$nombre])
                      ));

                      if(form_error($prefijo.$nombre))
                         echo '<div class="error">'.form_error($prefijo.$nombre).'</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
                <?php $nombre='email_sup';?>
                <?php echo form_label(' Correo Electrónico del Inmediato Superior: ', $prefijo.$nombre);?><br/>
            </td>
            <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
                <?php
                    echo "<input type='text' name=".$prefijo.$nombre." id=".$prefijo.$nombre."
                                    class='input1_normal' size='30'  value='".$fila[$prefijo.$nombre]."' />";
//                    echo form_input(array(
//                        'name' => $prefijo.$nombre,
//                        'id' => $prefijo.$nombre,
//                        'class' => 'input1_normal',
//                        'size' => '30',
//                        'value' => set_value($prefijo.$nombre,$fila[$prefijo.$nombre])
//                      ));

                      if(form_error($prefijo.$nombre))
                         echo '<div class="error">'.form_error($prefijo.$nombre).'</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td class="texto_label" colspan="2" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
                <?php
                    if($fila[$prefijo.'actual']==1){
                            $actual='checked';
                        }
                    ?>
                    <b>Estoy actualmente Trabajando en esta Organización </b> <input type="checkbox" name="<?php echo $prefijo.'actual'; ?>" value="1" <?php echo $actual;?> />Si
            </td>
        </tr>
    </table>
<br/>
<?php
    echo form_submit('enviar', '  Guardar  ');
?>
    
<?php echo form_close() ?>
