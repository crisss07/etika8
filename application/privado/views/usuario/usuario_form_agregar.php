
<?php
$this->load->view('cabecera');
?>
<?php  
$prefijo=$this->prefijo;
?>
<?php
$this->load->view('opciones');
$perfiles[-1]='Seleccione el Perfil de Usuario';
$perfiles[1]='Adminitrador';
$perfiles[2]='Responsable';
$perfiles[3]='Usuario';
?>
<br>
<br>
<?php echo form_open_multipart($action); ?>
<input type="hidden" name="<?php echo $prefijo.'id';?>" value="<?php echo set_value($prefijo.'id',@$fila[$prefijo.'id']);?>">
<table id="form_admin">
    <tr>
        <td class="texto_label">
            <?php $nombre='nombre';?>
            <?php echo form_label('Nombre Completo: ', $prefijo.$nombre);?>
        </td>
        <td>
            <?php 
                
                echo form_input(array(
                    'name' => $prefijo.$nombre,
                    'id' => $prefijo.$nombre,
                    'class' => 'input1',
                    'size' => '60',
                    'value' => set_value($prefijo.$nombre,@$fila[$prefijo.$nombre])
                  ));

                  if(form_error($prefijo.$nombre))
                     echo '<div class="error">'.form_error($prefijo.$nombre).'</div>';
            ?>
        </td>
    </tr>    
    <tr>
        <td class="texto_label">
            <?php $email='email';?>
            <?php echo form_label('E-mail: ', $prefijo.$email);?>
        </td>
        <td>
            <?php

                echo form_input(array(
                    'name' => $prefijo.$email,
                    'id' => $prefijo.$email,
                    'class' => 'input1',
                    'size' => '60',
                    'value' => set_value($prefijo.$email,@$fila[$prefijo.$email])
                  ));

                  if(form_error($prefijo.$email))
                     echo '<div class="error">'.form_error($prefijo.$email).'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label">
            <?php $login='login';?>
            <?php echo form_label('Login: ', $prefijo.$login);?>
        </td>
        <td>
            <?php

                echo form_input(array(
                    'name' => $prefijo.$login,
                    'id' => $prefijo.$login,
                    'class' => 'input1',
                    'size' => '60',
                    'value' => @set_value($prefijo.$login,$fila[$prefijo.$login])
                  ));

                  if(form_error($prefijo.$login))
                     echo '<div class="error">'.form_error($prefijo.$login).'</div>';
            ?>
            <?php
            if(isset($msj1)){
            ?>
            <div class="error">El nombre de usuario ya existe</div>

            <?php
            }
            ?>
        </td>
    </tr>
     <tr>
        <td class="texto_label">
            <?php $pass='pass';?>
            <?php echo form_label('Contraseña: ', $prefijo.$pass);?><br/>
            <span class="texto2">La contraseña debe tener 8 caracteres minimo<br/>y por lo menos una letra y un numero.</span>
        </td>
        <td>
            <?php

                echo form_input(array(
                    'name' => $prefijo.$pass,
                    'id' => $prefijo.$pass,
                    'class' => 'input1',
                    'size' => '60',
                    'value' => @set_value($prefijo.$pass,$fila[$prefijo.$pass])
                  ));

                  if(form_error($prefijo.$pass))
                     echo '<div class="error">'.form_error($prefijo.$pass).'</div>';
            ?>
        </td>
     </tr>
     <tr>
         <td class="texto_label" align="<?php echo @$alineacionwc1; ?>" valign="<?php echo @$alineacionhc1; ?>">
             <?php $campo1 = 'permisos'; ?>
             <?php echo form_label(' Perfil del Usuario: ', $prefijo . $campo1); ?>
         </td>
         <td align="<?php echo @$alineacionwc2; ?>" valign="<?php echo @$alineacionhc2; ?>">
             <?php
             echo form_dropdown($prefijo . $campo1, $perfiles, @set_value($prefijo . $campo1, $fila[$prefijo . $campo1]));
             if (form_error($prefijo . $campo1))
                 echo '<div class="error">' . form_error($prefijo . $campo1) . '</div>';
             ?>
         </td>
     </tr>
   
</table>


<br/>
<?php echo form_submit('enviar', '  Guardar  ') ?>
    
<?php echo form_close() ?>
