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
        <div class="col-md-5 col-lg-4" style="border: 1px solid white; background: #fff;padding: 20px;border-radius: 20px;">
            <div class="row justify-content-center">
                <div class="col-12 col-md-12">
                    <h2 class="titulo-formulario">¿Desea editar sus datos personales? </h2>  
                </div>
                <div class="col-6 col-md-3">
                    <?php
                    echo anchor($this->controlador . 'editar_datospersonal/id/' . $id, 'Si', array('class' => 'btn-etika btn'));
                    ?>
                </div>
                <div class="col-6 col-md-3">
                    <?php
                    echo anchor('convocatoria/postular', 'No', array('class' => 'btn-etika btn'));
                    ?>
                </div>
            </div>
        </div>        
    </div>
</div>
