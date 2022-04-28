<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sitio = $this->tool_entidad->sitioindex();
?>
<br/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row justify-content-center">
                <div class="col-md-10 box-convocatoria-contenido">
                    <h3 class="text-center" style="font-weight: bold;">REGISTRATE EN NUESTRA BASE DE DATOS</h3>
                    <br/>
                    <p>ETIKA es requerida por empresas, ONGs y otras organizaciones para realizar búsquedas de Gerentes y Especialistas.</p>
                    <p>Si cuentas con la formación y experiencia para este tipo de cargos, ingresa tu curriculum vitae en nuestra base de datos inscribiéndote a nuestro sistema de postulación (abajo el link)  para que sea evaluado en alguna búsqueda. </p>
                    <p>Si estamos en proceso de búsqueda de personal y tu currículum califica para el cargo nos contactaremos contigo para continuar con el proceso de selección.</p>
                    <p>Gracias por tu confianza.</p>
                    <p>El equipo de ETIKA</p>


                    <br/>
                    <br/>
                    <div class="row d-flex justify-content-around">
                        <a href="<?php echo $sitio; ?>convocatorias">Ver convocatorias</a>
                        <a href="<?php echo $this->tool_entidad->sitio(); ?>sisetika/index.html<?php echo$id; ?>" class="btn btn-default btn-etika" target="_blank">Registrarse &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
</div>