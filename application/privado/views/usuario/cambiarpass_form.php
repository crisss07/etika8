
<?php
$this->load->view('cabecera');
?>
<?php  
$prefijo=$this->prefijo;
?>
<?php
$this->load->view('opciones');
?>
<br>
<br>
<?php echo form_open_multipart($action); ?>
<input type="hidden" name="<?php echo $prefijo.'id';?>" value="<?php echo set_value($prefijo.'id',$fila[$prefijo.'id']);?>">
<table id="form_admin">
    <tr>
        <td class="texto_label" colspan="2">           
            <?php $nombre='nombres';?>
            Se cambiará la contraseña del usuario :
             <b>
             <?php
                echo $fila[$prefijo.'nombre'];
            ?>
            </b>
        </td>        
    </tr>    
   
     <tr>
        <td class="texto_label">
            <?php $pass='pass';?>
            <?php echo form_label('Introduzca la nueva contraseña: ', $prefijo.$pass);?><br/>
            <span class="texto2">La contraseña debe tener 8 caracteres minimo<br/>y por lo menos una letra y un numero.</span>
        </td>
        <td>
            <?php

                echo form_input(array(
                    'name' => $prefijo.$pass,
                    'id' => $prefijo.$pass,
                    'class' => 'input1',
                    'size' => '40',                    
                  ));
                  if(form_error($prefijo.$pass))
                     echo '<div class="error">'.form_error($prefijo.$pass).'</div>';
            ?>
        </td>
    </tr>
   
</table>


<br/>
<?php echo form_submit('enviar', '  Guardar  ') ?>
    
<?php echo form_close() ?>
