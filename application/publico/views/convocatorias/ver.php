﻿<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sitio = $this->tool_entidad->sitioindex();
?>
<style type="text/css">
    @media (max-width: 768px) {
          #descripcion{
            margin: 0 10px;

          }
        }
</style>
<br/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row ">
                <div class="col-md-2 box-convocatoria-titulo">
                    <div class="d-flex justify-content-center align-items-center box-titulo">
                        <h2 style="font-size: 25px;" class="text-center"><?php echo $fila['con_cargo'] ?></h2>
                    </div>

                </div>
                <div class="col-md-10 box-convocatoria-contenido text-left" style="background-color: #E7E4E4;">
                    <br/>
                    <div class="box-fecha-sede">
                        <span><b>Fecha Tope: </b><?php echo $fila['con_tope']; ?></span>
                    </div>
                    <div class="box-fecha-sede">
                        <span><b>Sede: </b><?php echo $fila['con_sede']; ?></span>
                    </div>
                    <div id="descripcion" style="margin: 0 10px;">
                        <?php echo $fila['con_descripcion']; ?>
                    </div>
                    
                    <div class="row d-flex justify-content-around">
                        <a href="<?php echo $sitio; ?>convocatorias">Ver convocatorias</a>
                        <a href="<?php echo $this->tool_entidad->sitio(); ?>index.php/convocatoria/index/id/<?php echo $id; ?>"  target="_blank" class="btn btn-default btn-etika" >Postular &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <br/>
</div>