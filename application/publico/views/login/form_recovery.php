<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
@$sitio = $this->tool_entidad->sitioindex();
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
            <?php echo form_open_multipart(@$action); ?>
            <div class="row justify-content-center">
                    <?php echo @$msje; ?>
            </div>
            <div class="row text-left">
                <div class="col-md-12">
                    <label> Usuario:
                        <?php
                        echo @$_SESSION[$this->presession . 'ci'];
                        ?>
                    </label>
                </div>
            </div>
            
            <br/>
            <input class="btn-etika btn" type="submit" value="Continuar"/>
            <div class="col-md-12">
                <br/>
                <p><?php echo @$msj; ?></p>
            </div>
            <?php echo form_close(); ?>
            <a href="<?php echo $sitio; ?>login/autenticar">Volver a Autenticarse</a>
        </div>
    </div>
</div>



