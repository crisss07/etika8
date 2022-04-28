<?php
$this->load->view('cabecera');
?>
<div class="cuadro_intro">
<?php  
$prefijo=$this->prefijo;
?>
<?php echo form_open_multipart($action); ?>
<input type="hidden" name="<?php echo $prefijo.'id';?>" value="<?php echo set_value($prefijo.'id',$fila1[$prefijo.'id']);?>">
<table id="form_admin" align="left" width="660" cellpadding="5">
        <tr>
            <td>
                <table class="tamanio_campos">   
                    <tr>
                        <td class="texto_label" align="left">           
                            <?php $nombre='nombre';?>
                            <?php echo form_label('Se cambiará la contraseña del postulante: ', $prefijo.$pass);?>                             
                        </td>
                        <td align="left" width="335"> &nbsp; </td>
                    </tr>
                    <tr>
                        <td class="texto_label" align="right">
                            <span class="cabecera_titulo"><?php echo $fila1[$prefijo.'apaterno'].' '.$fila1[$prefijo.'amaterno'].' '.$fila1[$prefijo.'nombre'];?></span><br/><br/>
                        </td>
                        <td align="left" width="335"> &nbsp; </td>
                    </tr>
                </table>                 
                <table class="tamanio_campos">
                    <tr>
                        <td class="texto_label" algin="left">
                            <?php $pass='usuario';?>
                            <?php echo form_label('Usuario: ', $prefijo.$pass);?>
                        </td>
                        <td align="right">
                            <?php
                                echo form_input(array(
                                    'name' => $prefijo.$pass,
                                    'id' => $prefijo.$pass,
                                    'class' => 'input1',
                                    'size' => '40',
                                    'disabled' => 'disabled',
                                    'value' => $fila1[$prefijo.'documento']
                                  ));
                            ?>
                        </td>
                        <td align="left" width="335">
                            <?php 
                            if(form_error($prefijo.$pass))
                                     echo '<div class="error">'.form_error($prefijo.$pass).'</div>';
                            ?>                        
                        </td>
                    </tr>
                </table>                 
                <table class="tamanio_campos">
                    <tr>
                        <td class="texto_label" align="left">
                            <?php $pass='pass_ant';?>
                            <?php echo form_label('Contraseña Anterior: ', $prefijo.$pass);?>
                        </td>
                        <td align="right">
                            <?php
                                echo form_password(array(
                                    'name' => $prefijo.$pass,
                                    'id' => $prefijo.$pass,
                                    'class' => 'input1',
                                    'size' => '27',
                                    'value' => set_value($prefijo.$pass,$fila[$prefijo.$pass])
                                  ));
                            ?>
                        </td>
                        <td align="left" width="335">
                            <?php 
                            if(form_error($prefijo.$pass))
                                     echo '<div class="error">'.form_error($prefijo.$pass).'</div>';
                            ?>                        
                        </td>
                    </tr>
                    <?php if($error_anterior){ ?>
                    <tr>
                        <td align="center" colspan="2">
                            <?php echo '<div class="error">'.$error_anterior.'</div>'; ?>
                        </td>
                    </tr>
                    <?php }?>
                </table>                 
                <table class="tamanio_campos">
                    <tr>
                        <td class="texto_label" align="left">
                            <?php $pass='pass_nueva';?>
                            <?php echo form_label('Nueva Contraseña: ', $prefijo.$pass);?><br/>                            
                        </td>
                        <td align="right">
                            <?php
                                echo form_password(array(
                                    'name' => $prefijo.$pass,
                                    'id' => $prefijo.$pass,
                                    'class' => 'input1',
                                    'size' => '27',
                                    'value' => set_value($prefijo.$pass,$fila[$prefijo.$pass])
                                  ));                                  
                            ?>
                        </td>
                        <td align="left" width="335">
                            <?php 
                            if(form_error($prefijo.$pass))
                                     echo '<div class="error">'.form_error($prefijo.$pass).'</div>';
                            ?>                        
                        </td>
                        
                    </tr>
                </table>
                <table class="tamanio_campos">
                    <tr>
                        <td align="center">
                            <span class="text4">La contraseña debe tener al menos 8 caracteres y por lo menos una letra y un número.</span>
                        </td>
                        <td align="left" width="335"> &nbsp; </td>
                    </tr>
                </table>
                <table class="tamanio_campos">
                    <tr>
                        <td class="texto_label" align="left">
                            <?php $pass='pass_nueva1';?>
                            <?php echo form_label('Confirmar Contraseña: ', $prefijo.$pass);?><br/>                            
                        </td>
                        <td align="right">
                            <?php
                                echo form_password(array(
                                    'name' => $prefijo.$pass,
                                    'id' => $prefijo.$pass,
                                    'class' => 'input1',
                                    'size' => '25',
                                    'value' => set_value($prefijo.$pass,$fila[$prefijo.$pass])
                                  ));
                            ?>
                        </td>
                        <td align="left" width="335">
                            <?php 
                            if(form_error($prefijo.$pass))
                                     echo '<div class="error">'.form_error($prefijo.$pass).'</div>';
                            ?>                        
                        </td>
                    </tr>                                                            
                </table>
                <table class="tamanio_campos">
                    <tr>
                        <td align="center">
                            <span class="text4">La contraseña debe tener al menos 8 caracteres y por lo menos una letra y un número.</span>
                        </td>
                        <td align="left" width="335"> &nbsp; </td>
                    </tr>
                </table>
                <?php if($error_nuevo){ ?>
                <table class="tamanio_campos1">
                    <tr>
                        <td align="center">
                            <?php echo '<div class="error">'.$error_nuevo.'</div>'; ?>
                        </td>
                    </tr>
                </table>
                <?php }?>
            </td>
        </tr>
        <tr>
            <td align="center">                
                <div align="center">
                    <button type="submit" style="border: 0; background: transparent" class="boton_aceptar"><img src="<?php echo $this->tool_entidad->sitio().'files/img/maq/guardar.gif';?>" alt="submit" />GUARDAR</button>
                    <?php 
                        echo anchor($this->controlador.'informacion_adicional','<img border="0" src="'.$this->tool_entidad->sitio().'files/img/maq/cancelar.gif" /> CANCELAR',array('class' =>'boton_cancelar'));
                    ?>
                </div>                
            </td>
        </tr>
    <!--tr>
        <td align="center" colspan="2">
            <br/>
            <?php echo form_submit('enviar', '  Guardar  ') ?>
        </td>
    </tr-->
   
</table>


<br/>

    
<?php echo form_close() ?>
</div>