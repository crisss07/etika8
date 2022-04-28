<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sitio = $this->tool_entidad->sitioindex();
$prefijo = 'con_';
?>
<br/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row ">
                <div class="col-md-2 box-convocatoria-titulo">
                    <div class="d-flex justify-content-center align-items-center box-titulo">
                        <h2 class="text-center h2"><?php echo $fila['con_cargo'] ?></h2>
                    </div>

                </div>
                <div class="col-md-10 box-convocatoria-contenido text-left" style="background-color: #E7E4E4;padding: 50px;">
                    <br/>
                    <div class="box-fecha-sede">
                        <span><b>Fecha Tope: </b><?php echo $fila['con_hasta']; ?></span>
                    </div>
                    <div class="box-fecha-sede">
                        <span><b>Sede: </b><?php echo $fila['con_sede']; ?></span>
                    </div>
                    <?php echo $fila['con_descripcion']; ?>
                    <br/>
                    <div class="row d-flex justify-content-around">
                        <a href="<?php echo $sitio; ?>ninicio">Cancelar</a>
                        
                        <?php echo anchor('postulacion/postular/idp/' . $fila[$prefijo . 'id'],'<img border="0" /> Postular &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-default btn-etika')); ?>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <br/>
</div>