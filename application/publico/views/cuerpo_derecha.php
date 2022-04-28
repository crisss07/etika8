<?php
$ruta = $this->tool_entidad->sitioindex();
if($this->id){
?>
<div style="margin-top: 20px;" align="center"><h2>Comentario</h2></div>
    <?php if($mensaje_exito) {?>

    <div align="center">
        <div class="texto_msj">
            <?php echo $msje; ?>
        </div>
    </div>
    <br/>
            <?php
            }
            ?>
<form method="post" action="<?php echo $ruta.'foro/comentario'; ?>" id="form_contacto">
    <table id="form_admin">
        <tr>
            <td>
                Usuario: <b><?php echo $usuario; ?></b>
            </td>
        </tr>
    <tr>        
        <td valign="top">
            <?php $campo1='opinion_foro';
                  echo form_textarea(array(
                    'name' => $campo1,
                    'id' => $campo1,
                    'rows' => '5',
                    'cols' => '24',
                    'value' => set_value($campo1,$fila1[$campo1])
                    )) ;

                  if($error[$campo1])
                     echo '<div class="error">'.$error[$campo1].'</div>';
            ?>
        </td>
    </tr>
    <tr>

            <?php $campocap='captcha1';?>
            <?php //echo form_label('Código de imagen: ', $campocap);?>
        <td valign="top" align="center" colspan="2" style="font-size: 10px;">
            Código de imagen (sensible a mayúsculas y minúsculas)
            <br/>
            <img src="<?php echo base_url();?>files/captcha/securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>" width="150" id="image" align="absmiddle" />
            <br/>Introduzca el codigo de imagen :
            <?php

                echo form_input(array(
                    'name' => $campocap,
                    'id' => $campocap,
                    'size' => '6'
                  ));
                  if($error[$campocap])
                     echo '<div class="error">'.$error[$campocap].'</div>';
            ?>
        </td>
    </tr>

</table>


<br/>
<div align="center"><?php echo form_submit('enviar', 'Enviar') ?></div>

</form>
<?php }?>