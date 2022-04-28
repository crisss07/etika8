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
            <?php echo form_open_multipart(@$action . '/convocatoria/verificar'); ?>
            <div class="row text-left">
                <div class="col-md-5">
                    <label for="documento" class="bold">Tipo de Documento:</label>
                </div>
                <div class="col-md-7">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="documento" name="tipodoc" class="custom-control-input" value="1" <?php echo @$check1; ?>/>
                        <label class="custom-control-label bold" for="documento">C.I.</label>

                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="documento2" name="tipodoc" class="custom-control-input" value="2" <?php echo @$check2; ?>/>
                        <label class="custom-control-label bold" for="documento2">Pasaporte</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <?php
                    $nombre = 'tipodoc';
                    if (form_error($nombre))
                        echo '<div class="error">' . form_error($nombre) . '</div>';
                    ?> 
                </div>
            </div>
            <div class="row text-left">
                <!--                <div class="col-md-5 ">
                                    <label for="ci">Mi Número de Documento:  </label>
                                </div>-->
                <div class="col-md-12">
                    <input class="input-etika" name="ci" class="form-control" type="text" value="<?php echo @$ci ?>" placeholder="MI NÚMERO DE DOCUMENTO" autocomplete="off"/>
                    <?php
                    $nombre = 'ci';
                    if (form_error($nombre))
                        echo '<div class="error">' . form_error($nombre) . '</div>';
                    ?> 
                </div>
            </div>
            <div class="row text-left">
                <div class="col-md-12">
                    <?php
                    if (@$error[$this->prefijo . 'documento'])
                        echo '<div class="error"><p>' . $error[$this->prefijo . 'documento'] . '</p></div>';
                    ?> 
                    <p style="margin-bottom: 0;font-weight: lighter;">En caso de CI introduzca solo los números.</p>
                    <span class="nota-ci" style="font-weight:100;" data-toggle="tooltip" title="En caso de que tenga número complementario para su carnet de identidad haga click aquí. 
                          Ej: 13144071N. 
                          Los números complementarios son casos excepcionales que no se refieren al lugar de emisión del carnet Ej: LP,SC,PT,etc.">Nota: Personas que tienen en su CI código complementario. <i class="fa fa-question-circle" aria-hidden="true" ></i>
                        marque aquí &nbsp;<input name="tipodoc" type="radio" value="3" <?php echo @$check3; ?>/>
                    </span>
                    <!--<input type="checkbox" style="margin-bottom: 16px;"/>-->
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
                    <p>&nbsp;</p>
                    <input class="input-etika mayusculas" name="captcha" class="form-control" type="text" value="<?php //echo @$captcha ?>" placeholder="Introduzca código de imagen" autocomplete="off"/>
                    <i class="fa fa-arrow-up" aria-hidden="true" style="position: absolute;"></i>

                    <?php
                    //$nombre = 'captcha';
                    //if (@$error[$nombre])
                       // echo '<div class="error"><p>' . $error[$nombre] . '</p></div>';
                    ?> 
                </div>
            </div> -->
            <br/>
            <input class="btn-etika btn" type="submit" value="Continuar"/>
            <div class="col-md-12">
                <br/>
                <p><?php echo @$msj; ?></p>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>



