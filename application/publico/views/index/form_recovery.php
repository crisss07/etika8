<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sitio = $this->tool_entidad->sitioindex();
?>
<div class="container">
    <br/>
    <br/>
    <div class="row justify-content-md-center align-items-md-center">
        <div class="col-md-5 col-lg-4" style="border: 1px solid white; background: #fff;padding: 20px;border-radius: 20px;">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="titulo-formulario">OLVIDE MI CONTRASEÑA</h2>
                </div>
            </div>
            <?php echo form_open_multipart($action); ?>
            <div class="row justify-content-center">
                <?php echo @$msje; ?>
            </div>
            <div class="row text-left">
                <div class="col-md-12">
                    <?php
                    $prefijo=$this->prefijo;
                    $nombre = 'documento';
                    echo form_input(array(
                        'name' => $prefijo . $nombre,
                        'id' => $prefijo . $nombre,
                        'class' => 'input-etika',
                        'size' => '19',
                        'placeholder' => 'MI NÚMERO DE DOCUMENTO',
                        'value' => set_value($prefijo . $nombre, @$fila[$prefijo . $nombre])
                    ));
                    if (@$error[$prefijo . $nombre])
                        echo '<br/><div class="error"><p>' . @$error[$prefijo . $nombre] . '</p></div>';
                    ?> 
                </div>
            </div>
            <!-- <div class="row text-left">
                <div class="col-10 col-md-8 box-captcha">
                    <img class="img-100" src="<?php //echo base_url(); ?>files/captcha/securimage_show.php?sid=<?php //echo md5(uniqid(time())); ?>" id="captcha_image" align="absmiddle" />
                    <a href="#" title="Refresh Image" onclick=" document.getElementById('captcha_image').src = '<?php //echo $this->tool_entidad->sitio(); ?>files/captcha/securimage_show.php?' + Math.random(); this.blur(); return false"><i class="fa fa-refresh fa-2x texto-uva" aria-hidden="true" style="color: #000;position: absolute;"></i></a>
                </div>
            </div>
            <div class="row text-left justify-content-center">
                <div class="col-9 col-md-9">
                    <input class="input-etika mayusculas" name="captcha" class="form-control" type="text" value="<?php echo @$captcha ?>" placeholder="Introduzca código de imagen" autocomplete="off"/>
                    <i class="fa fa-arrow-up" aria-hidden="true" style="position: absolute;"></i>

                    <?php
                    //$nombre = 'captcha';
                    //if (@$error[$nombre])
                        //echo '<div class="error"><p>' . @$error[$nombre] . '</p></div>';
                    ?> 
                </div>
            </div>
            -->
            <br/>
            <input class="btn-etika btn" type="submit" value="Continuar"/>
            <div class="col-md-12">
                <br/>
                <p><?php echo @$msj; ?></p>
            </div>
            <?php echo form_close(); ?>
            <a href="<?php echo $sitio; ?>index/autenticar">Volver a Autenticarse</a>
        </div>
    </div>
</div>



