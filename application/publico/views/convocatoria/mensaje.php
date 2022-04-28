<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sitio = $this->tool_entidad->sitioindex();
$prefijo = $this->prefijoF;
//session_destroy();
?>
<div class="container">
    <br/>
    <br/>
    <div class="row justify-content-md-center align-items-md-center">
        <div class="col-md-4" style="border: 1px solid white; background: #fff;padding: 20px;border-radius: 20px;">

            <div class="row text-left">
                <div class="col-md-12 text-center">
                    <h2 class="titulo-formulario">Su postulación ha sido registrada correctamente.</h2>
                </div>
            </div>
            <div class="col-md-12">
                <h2 class="titulo-formulario">para ir a su pagina de inicio haga</h2>
                <?php echo anchor('ninicio', 'click aqui'); ?>
                <br/>
				<!--<a href="/index.php/convocatorias" class="">Volver a convocatorias</a>
                <a href="/etika2019/index.php/convocatorias" class="">Volver a convocatorias</a>-->
                <br/>

            </div>

        </div>
    </div>
</div>
