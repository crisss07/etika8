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
        <div class="col-md-12">
            <img style="width: 130px;" src="<?php echo $this->tool_entidad->sitio() . 'files/img/logo_etika.png'; ?>" />
        </div>
        <div class="col-md-4" style="border: 1px solid white; background: #fff;padding: 20px;border-radius: 20px;">

            <div class="row text-left">
                <div class="col-md-12 text-center">
                    <h2 class="titulo-formulario">Gracias
                        <br/>
                        su postulacion al cargo <b>"<?php echo $cargo;?>"</b> ha sido registrada en el sistema
                        .</h2>
                    <h2 class="titulo-formulario">
                        Usted ya pertenece a la base de datos de ETIKA
                    </h2>
                </div>
            </div>
            <div class="col-md-12">
                <h2 class="titulo-formulario">para ir a su pagina de inicio haga</h2>
                <?php echo anchor('ninicio', 'click aqui'); ?>
                <br/>

            </div>

        </div>
    </div>
</div>
