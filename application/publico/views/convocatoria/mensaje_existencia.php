<?php
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
        <div class="col-md-4" style="border: 1px solid white; background: #fff;padding: 20px;border-radius: 20px;">

            <div class="row text-left">
                <div class="col-md-12 text-center">
                    <h2 class="titulo-formulario">Usted es nuevo en el sistema para continuar
                        con la postulación complete sus datos personales.</h2>
                </div>
            </div>
            <div class="col-md-12">
                <a href="<?php echo $this->tool_entidad->sitio(). 'index.php/newpostulante/datospersonal_nuevo'; ?>" class="btn btn-default btn-etika">Continuar</a>
                <br/>

            </div>

        </div>
    </div>
</div>
