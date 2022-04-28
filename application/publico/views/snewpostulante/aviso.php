<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title>Sistema de Postulación - Ingreso</title>
    <?php
    echo link_tag('/files/css/est_publico_inicio.css', 'stylesheet', 'text/css');
    ?>
	
</head>
<body id="fondo_ingreso">
    <?php
    $prefijo=$this->prefijo;
    switch ($fila[$prefijo.'tipodoc']){
        case 1:
            $valor_doc1='checked';
            break;
        case 2:
            $valor_doc2='checked';
            break;
    }
    ?>
    <div id="contenedor">
        <table width="1000" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td bgcolor="#2d637b" align="center" valign="top" width="160">
                    <div class="logo_etika_inicio"><img src="<?php echo $this->tool_entidad->sitio().'files/img/maq/logo_etika.jpg';?>" title="ETIKA" /></div>
                </td>
                <td bgcolor="#ffffff" valign="top" align="center">
                    <div class="banner_etika_inicio" >
                        <img src="<?php echo $this->tool_entidad->sitio().'files/img/maq/banner.jpg';?>" title="ETIKA" />
                                            
                    </div>
					
                    <div id="contenido_inicio">
                       
						<p>
						Por el momento no esta disponible esta funci&oacute;n se esta realizando ajustes t&eacute;cnicos por favor comunicarse con 
						recepcion@etika.com.bo
						</p>
                                                    
                        
                        <table align="center" cellpadding="8">        
                            <tr>
                                <td align="center">
                                    <span id="siteseal"><script type="text/javascript" src="https://seal.starfieldtech.com/getSeal?sealID=ycDU5wzt3jJF7WzNVpDuNfhxH8kOrL5iJCnEbzfUV6oDRp9T1Ti3Rq6vk3t"></script><br/><a style="font-family: arial; font-size: 9px" href="http://www.starfieldtech.com" target="_blank">SSL Certificate</a></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>            
        </table>        
    </div>                    
</body>
</html>
