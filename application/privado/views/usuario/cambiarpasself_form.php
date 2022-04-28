
<?php
$this->load->view('cabecera');
?>
<?php  
$prefijo=$this->prefijo;
?>

<?php
$this->no_mostrar_enlaces=1;
$this->load->view('cancelar');
?>
<br/>
<br>
<?php echo form_open_multipart($action); ?>
<input type="hidden" name="<?php echo $prefijo.'id';?>" value="<?php echo set_value($prefijo.'id',$fila1[$prefijo.'id']);?>">
<table align="center">
    <tr>
        <td class="texto_label" colspan="2">
            <?php $nombre='nombre';?>
            Se cambiará la contraseña del postulante :
             <b>
             <?php
                echo $fila1[$prefijo.'nombre'];
            ?>
            </b>
        </td>
    </tr>
    <tr>
        <td class="texto_label">
            <?php $pass='usuario';?>
            <?php echo form_label('Usuario: ', $prefijo.$pass);?>
        </td>
        <td>
            <?php

                echo form_input(array(
                    'name' => $prefijo.$pass,
                    'id' => $prefijo.$pass,
                    'class' => 'input1',
                    'size' => '10',
                    'disabled' => 'disabled',
                    'value' => $fila1[$prefijo.'login']
                  ));

                  if(form_error($prefijo.$pass))
                     echo '<div class="error">'.form_error($prefijo.$pass).'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label">
            <?php $pass='pass_ant';?>
            <?php echo form_label('Contraseña Anterior: ', $prefijo.$pass);?>
        </td>
        <td>
            <?php

                echo form_input(array(
                    'name' => $prefijo.$pass,
                    'id' => $prefijo.$pass,
                    'class' => 'input1',
                    'size' => '20',
                    'value' => @set_value($prefijo.$pass,$fila[$prefijo.$pass])
                  ));

                  if(form_error($prefijo.$pass))
                     echo '<div class="error">'.form_error($prefijo.$pass).'</div>';
            ?>
        </td>
    </tr>
    <?php if(@$error_anterior){ ?>
    <tr>
        <td align="center" colspan="2">
            <?php echo '<div class="error">'.$error_anterior.'</div>'; ?>
        </td>
    </tr>
    <?php }?>
    <tr>
        <td class="texto_label">
            <?php $pass='pass_nueva';?>
            <?php echo form_label('Nueva Contraseña: ', $prefijo.$pass);?><br/>
            <span class="texto2">La contraseña debe tener 8 caracteres minimo<br/>y por lo menos una letra y un numero.</span>
        </td>
        <td>
            <?php

                echo form_input(array(
                    'name' => $prefijo.$pass,
                    'id' => $prefijo.$pass,
                    'class' => 'input1',
                    'size' => '20',
                    'value' => @set_value($prefijo.$pass,$fila[$prefijo.$pass])
                  ));
                  if(form_error($prefijo.$pass))
                     echo '<div class="error">'.form_error($prefijo.$pass).'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label">
            <?php $pass='pass_nueva1';?>
            <?php echo form_label('Confirmar Contraseña: ', $prefijo.$pass);?><br/>
            <span class="texto2">La contraseña debe tener 8 caracteres minimo<br/>y por lo menos una letra y un numero.</span>
        </td>
        <td>
            <?php

                echo form_input(array(
                    'name' => $prefijo.$pass,
                    'id' => $prefijo.$pass,
                    'class' => 'input1',
                    'size' => '20',
                    'value' => @set_value($prefijo.$pass,$fila[$prefijo.$pass])
                  ));

                  if(form_error($prefijo.$pass))
                     echo '<div class="error">'.form_error($prefijo.$pass).'</div>';
            ?>
        </td>
    </tr>
    <?php if(@$error_nuevo){ ?>
    <tr>
        <td align="center" colspan="2">
            <?php echo '<div class="error">'.$error_nuevo.'</div>'; ?>
        </td>
    </tr>
    <?php }?>
    <tr>
        <td align="center" colspan="2">
            <br/>
            <?php echo form_submit('enviar', '  Guardar  ') ?>
        </td>
    </tr>

</table>


<br/>


<?php echo form_close() ?>