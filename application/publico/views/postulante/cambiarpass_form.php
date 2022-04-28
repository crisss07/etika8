<?php
$this->load->view('cabecera');
?>
<div class="cuadro_intro">
    <?php
    $prefijo = $this->prefijo;
    ?>
    <?php echo form_open_multipart($action); ?>
    <input type="hidden" name="<?php echo $prefijo . 'id'; ?>" value="<?php echo set_value($prefijo . 'id', @$fila1[$prefijo . 'id']); ?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <?php $nombre = 'nombre'; ?>
                <h2  style="font-size: 15px;color: #000;">Se cambiará la contraseña del postulante:</h2>
                <p class="cabecera_titulo text-center"><?php echo @$fila1[$prefijo . 'apaterno'] . ' ' . @$fila1[$prefijo . 'amaterno'] . ' ' . @$fila1[$prefijo . 'nombre']; ?></p>
                <!--usuario-->
                <div class="row justify-content-start">
                    <div class="col-md-12 text-left">
                        <?php
                        $pass = 'usuario';
                        ?>
                        <label style="font-weight: bold;">Usuario: <?php echo @$fila1[$prefijo . 'documento']; ?></label>
                    </div>
                </div>

                <!--password anterior-->
                <?php $pass = 'pass_ant'; ?>
                <?php // echo form_label('Contraseña Anterior: ', $prefijo . $pass); ?>
                <?php
                echo form_password(array(
                    'name' => $prefijo . $pass,
                    'id' => $prefijo . $pass,
                    'class' => 'input-etika',
                    'size' => '27',
                    'placeholder'=>'CONTRASEÑA ANTERIOR',
                    'value' => set_value($prefijo . $pass, @$fila[$prefijo . $pass])
                ));
                ?>
                <?php
                if (form_error($prefijo . $pass))
                    echo '<div class="error">' . form_error($prefijo . $pass) . '</div>';
                ?>
                <?php if (@$error_anterior) { ?>
                    <tr>
                        <td align="center" colspan="2">
                            <?php echo '<div class="error"><p>' . @$error_anterior . '</p></div>'; ?>
                        </td>
                    </tr>
                <?php } ?>
                <!--nuevo password-->
                <?php $pass = 'pass_nueva'; ?>
                <?php // echo form_label('Nueva Contraseña: ', $prefijo . $pass); ?>
                <?php
                echo form_password(array(
                    'name' => $prefijo . $pass,
                    'id' => $prefijo . $pass,
                    'class' => 'input-etika',
                    'size' => '27',
                    'placeholder'=>'NUEVA CONTRASEÑA',
                    'value' => set_value($prefijo . $pass, @$fila[$prefijo . $pass])
                ));
                ?>
                <?php
                if (form_error($prefijo . $pass))
                    echo '<div class="error">' . form_error($prefijo . $pass) . '</div>';
                ?>
                <br/><span class="text4">La contraseña debe tener al menos 8 caracteres y por lo menos una letra y un número.</span>

                <!--confirmar password-->
                <?php $pass = 'pass_nueva1'; ?>
                <?php // echo form_label('Confirmar Contraseña: ', $prefijo . $pass); ?>
                <?php
                echo form_password(array(
                    'name' => $prefijo . $pass,
                    'id' => $prefijo . $pass,
                    'class' => 'input-etika',
                    'size' => '25',
                    'placeholder'=>'CONFIRMAR CONTRASEÑA',
                    'value' => set_value($prefijo . $pass, @$fila[$prefijo . $pass])
                ));
                ?>
                <?php
                if (form_error($prefijo . $pass))
                    echo '<div class="error"><p>' . form_error($prefijo . $pass) . '</p></div>';
                ?>                        
                <br/><span class="text4">La contraseña debe tener al menos 8 caracteres y por lo menos una letra y un número.</span>

                <?php if (@$error_nuevo) { ?>
                    <?php echo '<div class="error"><p>' . @$error_nuevo . '</p></div>'; ?>
                <?php } ?>

                <div class="row">
                    <div class="col-md-12 text-right">
                        <br/>
                        <button type="submit" style="border: 0; background: transparent" class="boton_aceptar"><img src="<?php echo $this->tool_entidad->sitio() . 'files/img/maq/guardar.gif'; ?>" alt="submit" />GUARDAR</button>
                            <?php
                            echo anchor('ninicio', '<img border="0" src="' . $this->tool_entidad->sitio() . 'files/img/maq/cancelar.gif" /> CANCELAR', array('class' => 'boton_cancelar'));
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <?php echo form_close() ?>
</div>