﻿<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sitio = $this->tool_entidad->sitioindex();
$prefijo = $this->prefijoF;
?>
<div class="container">
    <br/>
    <br/>
    <div class="row justify-content-md-center align-items-md-center">
        <div class="col-md-5 col-lg-4" style="border: 1px solid white; background: #fff;padding: 20px;border-radius: 20px;">
            <?php echo form_open_multipart($action . '/postulacion/cvtemporal'); ?>
            <div class="row text-left">
                <div class="col-md-12 text-center">
                    <!--<h2 class='titulo-formulario'>Usted esta postulando al cargo</h2>-->
                    <!--<h2 class='titulo-formulario bold'>"<?php echo $cargo; ?>"</h2>-->
                    <h2>Subir archivo adjunto </h2>
                </div>

                <div class="col-md-12">

                    <span class="texto2" style="font-size: 12px;"><b>Nota.</b>
                        <br/>- El peso máximo permitido 2MB.
                        <br/>- Formato permitido .PDF, .doc, .docx.
                        <br/>- El documento es válido para esta única postulación y
                        se borrará automaticamente del sistema en 30 días.
                    </span>
                    <br/>
                    <br/>
                </div>
                <div class="col-md-12">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFileLang" lang="es" name="cvt_docnombre">
                        <label class="custom-file-label" for="customFileLang"></label>
                    </div>
                </div>

            </div>
            <br/>
            <div class="col-md-12">
                <div class="error"><p><?php echo $mensaje; ?></p></div>
                <a href="<?php echo $sitio.'postulacion/postular/idp/'.$_SESSION[$this->presession . 'idc'];?>" class="btn-etika btn">Cancelar</a>
                <input class="btn-etika btn" type="submit" value="Subir CV"/>
                <br/>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
