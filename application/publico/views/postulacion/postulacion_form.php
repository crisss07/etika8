<?php
$this->load->view('cabecera');
?>
<?php
$prefijo = $this->prefijo;
$alineacionwc1 = 'left';
$alineacionhc1 = 'middle';
$alineacionwc2 = 'right';
$alineacionhc2 = 'middle';
?>
<?php if ($existe) { ?>
    <script language="javascript">
        alert('Usted ya se ha postulado a este cargo.');
        window.open('../../../inicio', '_self');
    </script>
<?php } else { ?>
    <div class="cuadro_intro">
        <?php echo form_open_multipart($action); ?>

        <?php
        echo form_hidden($prefijo . 'id', set_value($prefijo . 'id', $fila[$prefijo . 'id']));
        ?>
        <input type="hidden" name="<?php echo $prefijo . 'id'; ?>" value="<?php echo set_value($prefijo . 'id', $fila[$prefijo . 'id']); ?>">
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td align="left">
                    <table class="tamanio_campos" cellpadding="5">
                        <tr>
                            <td align="left" colspan="2">
                                <div align="justify">
                                    <span class="texto2"><b>Nota.</b>
                                        <br/>- Si modifica la Pretensión Salarial Referencial Mensual tambien se modificará en su Curriculum Vitae.
                                        <!--<br/>- Si modifica la Disponibilidad tambien se modificará en su Curriculum Vitae.-->
                                        <br/>- Si usted quiere modificar su Curruculum Vitae antes de postularse haga <?php echo anchor('postulante/editar_datospersonal/id/' . $_SESSION[$this->presession . 'id'], 'click aqui', array('class' => "enlace_a1", 'target' => "_blank")); ?>.
                                    </span>
                                </div>
                            </td>
                            <td> &nbsp; </td>
                        </tr>
                    </table>            
                </td>
            </tr>
            <tr>
                <td align="left">
                    <table class="tamanio_campos" cellpadding="5">
                        <tr>
                            <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                                <?php $pass = 'salario'; ?>
                                <?php echo form_label('Total Ganado Referencia Mensual (en Bs.): ', $prefijo . $pass); ?><br/>
                                <?php // echo form_label('Pretensión Salarial Referencial Mensual (en Bs.): ', $prefijo . $pass); ?><br/>
                            </td>
                            <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                                <?php
                                echo form_input(array(
                                    'name' => $prefijo . $pass,
                                    'id' => $prefijo . $pass,
                                    'class' => 'input1',
                                    'size' => '20',
                                    'value' => $salario['salario'],
                                    'onkeyup' => 'this.value=Numeros(this.value)'
                                ));

                                if (form_error($prefijo . $pass))
                                    echo '<div class="error">' . form_error($prefijo . $pass) . '</div>';
                                ?>
                            </td>
                            <td width="140"> &nbsp; </td>
                        </tr>
                        <tr>
                            <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                                <?php $pass = 'salario'; ?>
                                <?php echo form_label('Tiempo de disponibilidad: ', $prefijo . $pass); ?><br/>
                            </td>
                            <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                                <select style="width: 200px;" class="" name="<?php echo $prefijo . "disponibilidad" ?>">
                                    <option value="0">Seleccione diponibilidad</option>
                                    <?php
                                    foreach ($disponibilidad as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['id']; ?>"  <?php echo $value['id'] == $idDisponible['pof_disponibilidad'] ? 'selected' : '' ?>><?php echo $value['nombre']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td width="140">
                                <?php
                                if ($error_disponibilidad)
                                    echo '<div class="error">' . $error_disponibilidad . '</div>';
                                ?>            
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
            <tr>
                <td align="left">
                    <table class="tamanio_campos" cellpadding="5">
                        <tr>
                            <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
                                <?php $pass = 'contador'; ?>
                                <?php echo form_label('¿Cómo se enteró de esta postulación?: ', $prefijo . $pass); ?><br/>
                            </td>
                            <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                                <?php
                                echo form_dropdown($pass, $this->contador, set_value($pass, $contador));
                                ?>
                            </td>
                            <td width="140">
                                <?php
                                if ($error_contador)
                                    echo '<div class="error">' . $error_contador . '</div>';
                                ?>            
                            </td>
                        </tr>
                        <tr>
                            <td align="center" colspan="3">
                                <br/>
                                <div align="center">
                                    <button type="submit" name="enviar" value="  Enviar  " style="border: 0; background: transparent" class="boton_aceptar" onClick="return confirmar('Una vez que usted se postule no podrá modificar su CV hasta terminar el proceso. Está de acuerdo ?');"><img src="<?php echo $this->tool_entidad->sitio() . 'files/img/maq/guardar.gif'; ?>" alt="submit" />ENVIAR</button>
                                        <?php
                                        echo anchor('inicio', '<img border="0" src="' . $this->tool_entidad->sitio() . 'files/img/maq/cancelar.gif" /> CANCELAR', array('class' => 'boton_cancelar'));
                                        ?>
                                </div>                
                            </td>
                        </tr>
                    </table>            
                </td>
            </tr>
        </table>





        <br/>
        <!--input name="enviar" type="submit" value="  Enviar  " -->
        <?php //echo form_submit('enviar', '  Guardar  ') ?>

        <?php echo form_close() ?>
    </div>
<?php } ?>
