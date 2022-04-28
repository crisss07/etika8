<?php  
$prefijo=$this->prefijo;
$tabla=$this->tabla;
$consulta2 = $this->db->query('
    SELECT * FROM '.$tabla.' where '.$prefijo.'id="3"
    order by '.$prefijo.'orden asc
    ');
    $estatico=$consulta2->result_array();
?>
<div id="contenido">
    <h1><?php echo $this->titulo_boton; ?></h1>
    <h2 align="center"><?php echo $this->titulo_hoja; ?></h2>

<?php
if($mensaje_exito)
{
?>
    <br/>
    <div align="center">
    <div class="texto_msj">
    <?php echo $this->msje; ?>
    </div>
    </div>
    <br/>
<?php
}
?>
<?php //echo form_open($action); ?>

<form method="post" action="<?php echo $action;?>" id="form_contacto">
    <table id="form_admin" align="center">
    <tr>
        <td class="texto_label" valign="top">
            <?php $campo1='nombre';?>
            <?php echo form_label('Nombre: ', $prefijo.$campo1);?>
        </td>
        <td valign="top">
            <?php 
                
                echo form_input(array(
                    'name' => $prefijo.$campo1,
                    'id' => $prefijo.$campo1,
                    'size' => '30',
                    'value' => set_value($prefijo.$campo1,$fila[$prefijo.$campo1])
                  ));

                  if(form_error($prefijo.$campo1))
                     echo '<div class="error">'.form_error($prefijo.$campo1).'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" valign="top">
            <?php $campo1='ciudad';?>
            <?php echo form_label('Ciudad: ', $prefijo.$campo1);?>
        </td>
        <td valign="top">
            <?php

                echo form_input(array(
                    'name' => $prefijo.$campo1,
                    'id' => $prefijo.$campo1,
                    'size' => '30',
                    'value' => set_value($prefijo.$campo1,$fila[$prefijo.$campo1])
                  ));

                  if(form_error($prefijo.$campo1))
                     echo '<div class="error">'.form_error($prefijo.$campo1).'</div>';
            ?>
        </td>
    </tr>
    
    <tr>
        <td class="texto_label" valign="top">
            <?php $campo1='email';?>
            <?php echo form_label('E-mail: ', $prefijo.$campo1);?>
        </td>
        <td valign="top">
            <?php

                echo form_input(array(
                    'name' => $prefijo.$campo1,
                    'id' => $prefijo.$campo1,
                    'size' => '30',
                    'value' => set_value($prefijo.$campo1,$fila[$prefijo.$campo1])
                  ));

                  if(form_error($prefijo.$campo1))
                     echo '<div class="error">'.form_error($prefijo.$campo1).'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" valign="top">
            <?php $campo1='telefono';?>
            <?php echo form_label('Teléfono: ', $prefijo.$campo1);?>
        </td>
        <td valign="top">
            <?php

                echo form_input(array(
                    'name' => $prefijo.$campo1,
                    'id' => $prefijo.$campo1,
                    'size' => '30',
                    'value' => set_value($prefijo.$campo1,$fila[$prefijo.$campo1])
                  ));

                  if(form_error($prefijo.$campo1))
                     echo '<div class="error">'.form_error($prefijo.$campo1).'</div>';
            ?>
        </td>
    </tr>

    <tr>
        <td class="texto_label" valign="top">
            <?php $campo1='consulta';?>
            <?php echo form_label('Consulta: ', $prefijo.$campo1) ;?>
        </td>
        <td valign="top">
            <?php
                  echo form_textarea(array(
                    'name' => $prefijo.$campo1,
                    'id' => $prefijo.$campo1,
                    'rows' => '10',
                    'cols' => '40',
                    'value' => set_value($prefijo.$campo1,$fila[$prefijo.$campo1])
                    )) ;

                  if(form_error($prefijo.$campo1))
                    echo '<div class="error">'.form_error($prefijo.$campo1).'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" valign="top">
            <?php $campocap='captcha';?>
            <?php //echo form_label('Código de imagen: ', $campocap);?>
        </td>
        <td valign="top">
            Código de imagen (sensible a mayúsculas y minúsculas)            
            <br/>
            <img src="<?php echo base_url();?>files/captcha/securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>" id="image" align="absmiddle" />
            <br/>Introduzca el codigo de imagen :
            <?php

                echo form_input(array(
                    'name' => $campocap,
                    'id' => $campocap,
                    'size' => '6'
                  ));

                  if(form_error($campocap))
                     echo '<div class="error">'.form_error($campocap).'</div>';
            ?>
        </td>
    </tr>

</table>


<br/>
<div align="center"><?php echo form_submit('enviar', 'Enviar') ?></div>

</form>
    <div style="padding: 5px 50px; text-align: center;">
    <?php echo $this->parrafo; ?>        
    </div>
</div>