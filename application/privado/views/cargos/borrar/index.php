<br/>
<?php
$this->load->view('cabecera');
?>
<?php
$sitio = $this->tool_entidad->sitioindexpri();
?>

<div id="listado"><div align="left" ><?php echo anchor('configuracion', 'Atrás', array('class' => 'enlace_retornar enlace_a1')); ?></div>
    <div style="color:#6781C5; font-size: 18px;">
        <table border="0" cellpadding=5" align="left" width="100%">
            <tr>
                <td align="center"><b>Postulante</b></td>
            </tr>
            <tr>
                <td align="left">
                    Formulario de Postulación
                    <table border="0" width="650" cellpadding="5" cellspacing="3">
                        <tr>
                            <td width="15"> &nbsp; </td>
                            <td align="left" style="border: 2px solid #bdaf8c;"> &bull; Datos Personales<br/>
                                <table width="100%" cellpadding="5">
                                    <tr>
                                        <td width="15"> &nbsp; </td>
                                        <td align="left"> 
                                            <table width="100%">
                                                <tr>
                                                    <td width="15"> &nbsp; </td>
                                                    <td align="left"> &rarr; País de Residencia</td>
                                                    <td align="right" ><?php echo anchor('paises/listar/idp/1', ' Editar', array('class' => 'enlace_a4')); ?></td>
                                                </tr>                                                                     
                                            </table>
                                        </td>
                                    </tr>                     
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td width="15"> &nbsp; </td>
                            <td align="left" style="border: 2px solid #bdaf8c;"> &bull; Instrucción Formal<br/>
                                <table width="100%" cellpadding="5">
                                    <tr>
                                        <td width="15"> &nbsp; </td>
                                        <td align="left"> - Educación Post Grado
                                            <table width="100%">
                                                <tr>
                                                    <td width="15"> &nbsp; </td>
                                                    <td align="left"> &rarr; Grado o Titulo</td>
                                                    <td align="right" ><?php echo anchor('combos/listar/idp/1', ' Editar', array('class' => 'enlace_a4')); ?></td>
                                                </tr>                                                                     
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="15"> &nbsp; </td>
                                        <td align="left"> - Educación Superior
                                            <table border="0" width="100%">
                                                <tr>
                                                    <td width="15"> &nbsp; </td>
                                                    <td align="left"> &rarr; Grado o Titulo</td>
                                                    <td align="right" ><?php echo anchor('combos/listar/idp/2', ' Editar', array('class' => 'enlace_a4')); ?></td>
                                                </tr>  
                                                <tr>
                                                    <td> &nbsp; </td>
                                                    <td align="left" > &rarr; Área de profesion</td>
                                                    <td align="right"><?php echo anchor('combos/listar/idp/3', ' Editar', array('class' => 'enlace_a4')); ?></td>
                                                </tr> 
                                            </table>
                                        </td>
                                    </tr>                       
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td width="15"> &nbsp; </td>
                            <td align="left" style="border: 2px solid #bdaf8c;"> &bull; Trayectoria Laboral
                                <table width="100%" cellpadding="5">
                                    <tr>
                                        <td width="15"> &nbsp; </td>
                                        <td align="left"> - Experiencia Laboral
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td width="15"> &nbsp; </td>
                                                    <td align="left"> &rarr; Tipo de Organización</td>
                                                    <td align="right" ><?php echo anchor('combos/listar/idp/4', ' Editar', array('class' => 'enlace_a4')); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="15"> &nbsp; </td>
                                        <td align="left"> - Síntesis de Experiencia Laboral
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td width="15"> &nbsp; </td>
                                                    <td align="left"> &rarr; Área de experiencia que usted resaltaría</td>
                                                    <td align="right" > &nbsp; <?php echo anchor('combos/listar/idp/5', ' Editar', array('class' => 'enlace_a4')); ?></td>
                                                </tr>
                                                <tr>
                                                    <td> &nbsp; </td>
                                                    <td align="left" > &rarr; Sector de experiencia que usted resaltaría</td>
                                                    <td align="right"> &nbsp; <?php echo anchor('combos/listar/idp/6', ' Editar', array('class' => 'enlace_a4')); ?></td>
                                                </tr>
                                                <tr>
                                                    <td> &nbsp; </td>
                                                    <td align="left" > &rarr; Máximo nivel alcanzado</td>
                                                    <td align="right"> &nbsp; <?php echo anchor('combos/listar/idp/9', ' Editar', array('class' => 'enlace_a4')); ?></td>
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
                <td align="left">
                    Convocatorias Vigentes
                    <table border="0" width="650" cellpadding="5" cellspacing="3">
                        <tr>
                            <td width="15"> &nbsp; </td>
                            <td align="left" style="border: 2px solid #bdaf8c;"> &bull; Postulación al Cargo<br/>
                                <table width="100%" cellpadding="5">
                                    <tr>
                                        <td width="15"> &nbsp; </td>
                                        <td align="left"> - ¿Cómo se enteró de esta postulación?</td>
                                        <td align="right" ><?php echo anchor('contador/listar', ' Editar', array('class' => 'enlace_a4')); ?></td>                                        
                                    </tr>                                                           
                                </table>
                            </td>
                        </tr>                                              
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center"><br/><br/><b>ETIKOS</b></td>
            </tr>
            <tr>
                <td align="left">
                    Postulaciones
                    <table border="0" width="650" cellpadding="5" cellspacing="3">
                        <tr>
                            <td width="15"> &nbsp; </td>
                            <td align="left" style="border: 2px solid #bdaf8c;"> &bull; Procesar<br/>
                                <table width="100%" cellpadding="5">
                                    <tr>
                                        <td width="15"> &nbsp; </td>
                                        <td align="left"> - Etapas
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td width="15"> &nbsp; </td>
                                                    <td align="left"> &rarr; Recomendación</td>
                                                    <td align="right" ><?php echo anchor('combos/listar/idp/7', ' Editar', array('class' => 'enlace_a4')); ?></td>
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
                <td align="left">
                    Servicios
                    <table border="0" width="650" cellpadding="5" cellspacing="3">
                        <tr>
                            <td width="15"> &nbsp; </td>
                            <td align="left" style="border: 2px solid #bdaf8c;">
                                <table width="100%" border="0">
                                    <tr>
                                        <td align="left">&bull; Tipo Servicios</td>
                                        <td align="right"><?php echo anchor('combos/listar/idp/8', ' Editar', array('class' => 'enlace_a4')); ?>&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>