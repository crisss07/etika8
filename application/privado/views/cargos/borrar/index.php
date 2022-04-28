<br/>
<?php
$this->load->view('cabecera');
?>
<?php
$sitio = $this->tool_entidad->sitioindexpri();
?>

<div id="listado"><div align="left" ><?php echo anchor('configuracion', 'Atr�s', array('class' => 'enlace_retornar enlace_a1')); ?></div>
    <div style="color:#6781C5; font-size: 18px;">
        <table border="0" cellpadding=5" align="left" width="100%">
            <tr>
                <td align="center"><b>Postulante</b></td>
            </tr>
            <tr>
                <td align="left">
                    Formulario de Postulaci�n
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
                                                    <td align="left"> &rarr; Pa�s de Residencia</td>
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
                            <td align="left" style="border: 2px solid #bdaf8c;"> &bull; Instrucci�n Formal<br/>
                                <table width="100%" cellpadding="5">
                                    <tr>
                                        <td width="15"> &nbsp; </td>
                                        <td align="left"> - Educaci�n Post Grado
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
                                        <td align="left"> - Educaci�n Superior
                                            <table border="0" width="100%">
                                                <tr>
                                                    <td width="15"> &nbsp; </td>
                                                    <td align="left"> &rarr; Grado o Titulo</td>
                                                    <td align="right" ><?php echo anchor('combos/listar/idp/2', ' Editar', array('class' => 'enlace_a4')); ?></td>
                                                </tr>  
                                                <tr>
                                                    <td> &nbsp; </td>
                                                    <td align="left" > &rarr; �rea de profesion</td>
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
                                                    <td align="left"> &rarr; Tipo de Organizaci�n</td>
                                                    <td align="right" ><?php echo anchor('combos/listar/idp/4', ' Editar', array('class' => 'enlace_a4')); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="15"> &nbsp; </td>
                                        <td align="left"> - S�ntesis de Experiencia Laboral
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td width="15"> &nbsp; </td>
                                                    <td align="left"> &rarr; �rea de experiencia que usted resaltar�a</td>
                                                    <td align="right" > &nbsp; <?php echo anchor('combos/listar/idp/5', ' Editar', array('class' => 'enlace_a4')); ?></td>
                                                </tr>
                                                <tr>
                                                    <td> &nbsp; </td>
                                                    <td align="left" > &rarr; Sector de experiencia que usted resaltar�a</td>
                                                    <td align="right"> &nbsp; <?php echo anchor('combos/listar/idp/6', ' Editar', array('class' => 'enlace_a4')); ?></td>
                                                </tr>
                                                <tr>
                                                    <td> &nbsp; </td>
                                                    <td align="left" > &rarr; M�ximo nivel alcanzado</td>
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
                            <td align="left" style="border: 2px solid #bdaf8c;"> &bull; Postulaci�n al Cargo<br/>
                                <table width="100%" cellpadding="5">
                                    <tr>
                                        <td width="15"> &nbsp; </td>
                                        <td align="left"> - �C�mo se enter� de esta postulaci�n?</td>
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
                                                    <td align="left"> &rarr; Recomendaci�n</td>
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