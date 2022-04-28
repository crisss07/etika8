<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sitio = $this->tool_entidad->sitioindex();
@$prefijo = $this->prefijoF;
?>
<div class="container">
    <br/>
    <br/>
    <div class="row justify-content-md-center align-items-md-center">
       
        <div class="col-md-4" style="border: 1px solid white; background: #fff;padding: 20px;border-radius: 20px;">

            <div class="row text-left">
                <div class="col-md-12 text-center">
                    <h2 class="titulo-formulario">Usted ya existe en el sistema.</h2>
                </div>
            </div>
            <div class="col-md-12">
                <?php echo form_open_multipart(@$action); ?>

                <div class="row text-left">
                    <div class="col-md-5 sin-padding">
                    </div>
                    <div class="col-md-12">
                        <label> Usuario:
                            <?php
//                        print_r($_SESSION);
                            echo @$_SESSION[$this->presession . 'ci'];
                            ?>
                        </label>
                    </div>
                </div>
                <div class="row text-left">
                    <div class="col-md-12">
                        <input type="hidden" name="intentos" value="<?php echo @$intentos; ?>" />
                        <?php
                        $nombre = 'pass';
                        ?>
                        <input class="input-etika" name="<?php echo $this->prefijo . $nombre; ?>" class="form-control" type="password" value="<?php echo @$ci ?>" placeholder="MI CONTRASEÑA" autocomplete="off"/>
                        <?php
                        if (form_error($this->prefijo . $nombre))
                            echo '<div class="error">' . form_error($this->prefijo . $nombre) . '</div>';
                        if (@$user_error != '')
                            echo '<div class="error">' . @$user_error . '</div>';
                        ?> 
                    </div>
                </div>
                <br/>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 col-lg-7">
                            <!--<a href="<?php echo $this->controlador; ?>" style="font-size: 14px;">Olvide mi contraseña</a>-->
                            <?php
                            echo anchor($this->controlador . 'recuperar', 'Olvide mi contraseña', 'class="" style="font-size:14px;"');
                            ?>
                        </div>
                        <div class="col-md-12 col-lg-5">
                            <input class="btn-etika btn" type="submit" value="Ingresar"/>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>

        </div>
    </div>
</div>
