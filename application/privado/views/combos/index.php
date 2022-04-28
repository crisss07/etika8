<br/>
<?php
$this->load->view('cabecera');
?>
<?php
$sitio = $this->tool_entidad->sitioindexpri();
?>

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
<style>
    .numberCircle {
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
    
    color:white;
    background:#B4AB9B;
    position: absolute;
    justify-content: center;
    align-items: center;
    text-align: center;
    font-weight: bold;
   
    
}
.circulo {
   

    font-size: 30px;
    
    color:#B4AB9B;
    font-family: sans-serif;
  
  
}
.fuente_gral{
   
    color: #B4AB9B;
    font-size: 22px;
    font-family: Roboto;
    font-weight: bold;


}
.fuente_titulos{
   
    color: #110C0C;
    font-size: 22px;
    font-family: Roboto;
    


}

</style>
<style>
    .vineta {    
  
    
    font-size: 22px;
    font-weight: bold;
    color:#EB663B;
    font-family: sans-serif;

}
.color_b{
    font-size: 22px;
    color: #404141;
    font-family: Roboto;
    font-weight: normal;

}
.a.color_b:link,a.color_b:visited , a.color_b:active{

    font-family: Roboto;
    font-size: 16px;
    font-style: normal;

      
    color: #404141;
    text-decoration: none;        
}
a.color_b:hover {

    font-family: Roboto;

    color: #404141;
    text-decoration: underline;


}
</style>




<style>



table {
  border-collapse: collapse;
}
.color_etika{
    color:#F58960;
}
</style>



<div id="listado"><div align="left" >
    <?php echo anchor('configuracion', 'Atrás', array('class' => 'enlace_retornar enlace_a1')); ?></div>
    <div style="color:#6781C5; font-size: 18px;">
        <table border="0" cellpadding=5" align="left" width="100%" style="color: #6A6868;">
            <tr>
                <td align="center" class="fuente_gral"><b>Postulante</b></td>
            </tr>
            <tr>
                <td align="left" class="fuente_titulos">
                   <b> Formulario de Postulación</b>
                    <p></p>
                    <table border="0" width="650" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="15"> &nbsp; </td>
                            <td align="left" style="border-bottom:  2px solid #bdaf8c;" class="color_b">

                              <img width="18px" src="<?php echo $this->tool_entidad->sitio().'files/img/privado/circle.png' ?>" alt="">&nbsp; Datos Personales <br/>
                                <table  width="100%" cellpadding="5" >
                                    <tr>
                                        <td width="15"> &nbsp; </td>
                                        <td align="left"> 
                                            <table width="100%">
                                                <tr>
                                                    <td width="15"> &nbsp; </td>
                                                    <td align="left" class="color_b"> <em class="vineta">&bull;</em>&nbsp;   País de Residencia </td>
                                                    <td align="right" ><?php echo anchor('paises/listar/idp/1', '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'color_b')); ?></td>
                                                </tr>                                                                     
                                                <tr>
                                                    <td width="15"> &nbsp; </td>
                                                    <td align="left" class="color_b"> <em class="vineta">&bull;</em>&nbsp;&nbsp;Ciudad o Localidad</td>
                                                    <td align="right" ><?php echo anchor('paises/listar/idp/2', '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a4')); ?></td>
                                                </tr>                                                                     
                                            </table>
                                        </td>
                                    </tr>                     
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td width="15"> &nbsp; </td>
                            <td align="left" style="border-bottom: 2px solid #bdaf8c;" class="color_b"> 
                                   <img width="18px" src="<?php echo $this->tool_entidad->sitio().'files/img/privado/circle.png' ?>" alt="">&nbsp; Instrucción Formal<br/>
                                <table width="100%" cellpadding="5">
                                    <tr>
                                        <td width="15"> &nbsp; </td>
                                        <td align="left"> <em class="vineta">&bull;</em>&nbsp;&nbsp;&nbsp; Educación Post Grado
                                            <table width="100%">
                                                <tr>
                                                    <td width="15"> &nbsp; </td>
                                                    <td align="left">    <img width="14px" src="<?php echo $this->tool_entidad->sitio().'files/img/privado/right.png' ?>" alt="">&nbsp;Grado o Titulo</td>
                                                    <td align="right" ><?php echo anchor('combos/listar/idp/1', '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a4')); ?></td>
                                                </tr>                                                                     
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="15"> &nbsp; </td>
                                        <td align="left" > <em class="vineta">&bull;</em>&nbsp;&nbsp;&nbsp; Educación Superior
                                            <table border="0" width="100%">
                                                <tr>
                                                    <td width="15"> &nbsp; </td>
                                                    <td align="left"> <img width="14px" src="<?php echo $this->tool_entidad->sitio().'files/img/privado/right.png' ?>" alt=""> Grado o Titulo</td>
                                                    <td align="right" ><?php echo anchor('combos/listar/idp/2', '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a4')); ?></td>
                                                </tr>  
                                                <tr>
                                                    <td> &nbsp; </td>
                                                    <td align="left" >    <img width="14px" src="<?php echo $this->tool_entidad->sitio().'files/img/privado/right.png' ?>" alt="">&nbsp;Área de profesion</td>
                                                    <td align="right"><?php echo anchor('combos/listar/idp/3', '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a4')); ?></td>
                                                </tr> 
                                            </table>
                                        </td>
                                    </tr>                       
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td width="15"> &nbsp; </td>
                            <td align="left" style="border-bottom: 2px solid #bdaf8c;" class="color_b">    <img width="18px" src="<?php echo $this->tool_entidad->sitio().'files/img/privado/circle.png' ?>" alt="">&nbsp; Trayectoria Laboral
                                <table width="100%" cellpadding="5">
                                    <tr>
                                        <td width="15"> &nbsp; </td>
                                        <td align="left"> <em class="vineta">&bull;</em>&nbsp;&nbsp;&nbsp; Experiencia Laboral
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td width="15"> &nbsp; </td>
                                                    <td align="left">    <img width="14px" src="<?php echo $this->tool_entidad->sitio().'files/img/privado/right.png' ?>" alt="">&nbsp;  Tipo de Organización</td>
                                                    <td align="right" ><?php echo anchor('combos/listar/idp/4', '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a4')); ?></td>
                                                </tr>
<!--                                                <tr>
                                                    <td width="15"> &nbsp; </td>
                                                    <td align="left"> <em class="vineta">&bull;</em>&nbsp;&nbsp;&nbsp; Rubro de la organización</td>
                                                    <td align="right" ><?php echo anchor('empresas/listar/idp/1', '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a4')); ?></td>
                                                </tr>-->
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="15"> &nbsp; </td>
                                        <td align="left"> <em class="vineta">&bull;</em>&nbsp;&nbsp;&nbsp; Síntesis de Experiencia Laboral
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td width="15"> &nbsp; </td>
                                                    <td align="left">    <img width="14px" src="<?php echo $this->tool_entidad->sitio().'files/img/privado/right.png' ?>" alt="">&nbsp;  Área de experiencia que usted resaltaría</td>
                                                    <td align="right" > &nbsp; <?php echo anchor('combos/listar/idp/5', '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a4')); ?></td>
                                                </tr>
                                                <tr>
                                                    <td> &nbsp; </td>
                                                    <td align="left" >    <img width="14px" src="<?php echo $this->tool_entidad->sitio().'files/img/privado/right.png' ?>" alt="">&nbsp;  Sector de experiencia que usted resaltaría</td>
                                                    <td align="right"> &nbsp; <?php echo anchor('combos/listar/idp/6', '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a4')); ?></td>
                                                </tr>
                                                <tr>
                                                    <td> &nbsp; </td>
                                                    <td align="left" >    <img width="14px" src="<?php echo $this->tool_entidad->sitio().'files/img/privado/right.png' ?>" alt="">&nbsp;  Máximo nivel alcanzado</td>
                                                    <td align="right"> &nbsp; <?php echo anchor('combos/listar/idp/9', '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a4')); ?></td>
                                                </tr>
                                                <tr>
                                                    <td> &nbsp; </td>
                                                    <td align="left" >    <img width="14px" src="<?php echo $this->tool_entidad->sitio().'files/img/privado/right.png' ?>" alt="">&nbsp;  No supervisión</td>
                                                    <td align="right"> &nbsp; <?php echo anchor('combos/listar/idp/11', '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a4')); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>                       
                        <tr>
                            <td width="15"> &nbsp; </td>
                            <td align="left" style="border-bottom: 2px solid #bdaf8c;" class="color_b">    <img width="18px" src="<?php echo $this->tool_entidad->sitio().'files/img/privado/circle.png' ?>" alt="">&nbsp; Información adicional
                                <table width="100%" cellpadding="5">
                                    <tr>
                                        <td width="15"> &nbsp; </td>
                                        <td align="left"> 
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td width="15"> &nbsp; </td>
                                                    <td align="left"> <em class="vineta">&bull;</em>&nbsp;&nbsp;&nbsp; Idiomas</td>
                                                    <td align="right" ><?php echo anchor('idiomas/listar/idp/1', '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a4')); ?></td>
                                                </tr>
                                            </table>
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td width="15"> &nbsp; </td>
                                                    <td align="left"> <em class="vineta">&bull;</em>&nbsp;&nbsp;&nbsp; Disponibilidad</td>
                                                    <td align="right" ><?php echo anchor('combos/listar/idp/14', '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a4')); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>                       
                    </table>
                </td>
            </tr>
            <tr>
                <td align="left" class="fuente_titulos">
                    <p></p>
                   <b> Convocatoria</b>
                    <table border="0" width="650" cellpadding="5" cellspacing="3">
                        <tr>
                            <td width="15"> &nbsp; </td>
                            <td align="left" style="border-bottom: 2px solid #bdaf8c;" class="color_b">    <img width="18px" src="<?php echo $this->tool_entidad->sitio().'files/img/privado/circle.png' ?>" alt="">&nbsp; Postulación al Cargo<br/>
                                <table width="100%" cellpadding="5" >
                                    <tr>
                                        <td width="15"> &nbsp; </td>
                                        <td align="left"> <em class="vineta">&bull;</em>&nbsp;&nbsp;&nbsp; Cargos para el Filtro</td>
                                        <td align="right"><?php echo anchor('cargos/listar/idp/1', '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a4')); ?></td>                                        
                                                                             
                                    </tr>                                                           
                                    <tr>
                                        <td width="15"> &nbsp; </td>
                                        <td align="left"> <em class="vineta">&bull;</em>&nbsp;&nbsp;&nbsp; Sede para el Filtro</td>
                                        <td align="right"><?php echo anchor('combos/listar/idp/13', '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a4')); ?></td>                                        
                                    </tr>                                                           
                                </table>
                            </td>
                        </tr>                                              
                    </table>
                </td>
            </tr>
            <tr>
                <td align="left" class="fuente_titulos" >
                    <p></p>
                   <b> Convocatorias Vigentes</b>
                    <table border="0" width="650" cellpadding="5" cellspacing="3">
                        <tr>
                            <td width="15"> &nbsp; </td>
                            <td align="left" style="border-bottom: 2px solid #bdaf8c;" class="color_b">    <img width="18px" src="<?php echo $this->tool_entidad->sitio().'files/img/privado/circle.png' ?>" alt="">&nbsp; Postulación al Cargo<br/>
                                <table width="100%" cellpadding="5">
                                    <tr>
                                        <td width="15"> &nbsp; </td>
                                        <td align="left"> <em class="vineta">&bull;</em>&nbsp;&nbsp;&nbsp; ¿Cómo se enteró de esta postulación?</td>
                                        <td align="right" ><?php echo anchor('contador/listar', '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a4')); ?></td>                                        
                                    </tr>                                                           
                                </table>
                            </td>
                        </tr>                                              
                    </table>
                </td>
            </tr>
            <tr>

                <td align="center" class="fuente_gral" >
                    
                                <br/><br/><b>ETIKOS</b>
                    
                    
                </td>

            </tr>
            <tr>
                <td align="left" class="fuente_titulos">
                    <p></p>
                   <b> Postulaciones</b>
                    <table border="0" width="650" cellpadding="5" cellspacing="3">
                        <tr>
                            <td width="15"> &nbsp; </td>
                            <td align="left" style="border-bottom: 2px solid #bdaf8c;" class="color_b">    <img width="18px" src="<?php echo $this->tool_entidad->sitio().'files/img/privado/circle.png' ?>" alt="">&nbsp; Procesar<br/>
                                <table width="100%" cellpadding="5">
                                    <tr>
                                        <td width="15"> &nbsp; </td>
                                        <td align="left"> <em class="vineta">&bull;</em>&nbsp;&nbsp;&nbsp; Etapas
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td width="15"> &nbsp; </td>
                                                    <td align="left">    <img width="14px" src="<?php echo $this->tool_entidad->sitio().'files/img/privado/right.png' ?>" alt="">&nbsp; Recomendación</td>
                                                    <td align="right" ><?php echo anchor('combos/listar/idp/7', '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a4')); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!-- <tr>
                <td align="left">
                    <p></p>
                   <b> Servicios</b>
                    <table border="0" width="650" cellpadding="5" cellspacing="3">
                        <tr>
                            <td width="15"> &nbsp; </td>
                            <td align="left" style="border-bottom: 2px solid #bdaf8c;">
                                <table width="100%" border="0">
                                    <tr>
                                        <td align="left"><em class="circulo"></em>&nbsp;&nbsp;&nbsp; Tipo Servicios</td>
                                        <td align="right"> echo anchor('combos/listar/idp/8', '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a4')); ?>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr> borrado de servicios 2021-->
        </table>
    </div>
</div>