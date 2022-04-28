<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title>Sistema de Postulación - Nuevo</title>
    <?php
    echo link_tag('/files/css/est_publico_inicio.css', 'stylesheet', 'text/css');
    ?>
	
</head>
<body id="fondo_ingreso">
    <?php
    $prefijo=$this->prefijo;
    ?> 
    <div id="contenedor">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td bgcolor="#2d637b" align="center" valign="top" width="160">
                    <div class="logo_etika_inicio"><img src="<?php echo $this->tool_entidad->sitio().'files/img/maq/logo_etika.jpg';?>" title="ETIKA" /></div>
                </td>
                <td bgcolor="#ffffff" valign="top" align="center">
                    <div class="banner_etika_inicio" >
                        <img src="<?php echo $this->tool_entidad->sitio().'files/img/maq/banner.jpg';?>" title="ETIKA" />                        
                    </div>
                    <div id="contenido_inicio">
                        <div class="cuerpo_caja1">
                            <div class="cabecera">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>                                        
                                        <td bgcolor="#fae5a0" align="center"><div class="titulo_caja1">OLVIDE MI CONTRASEÑA</div></td>                                        
                                    </tr>
                                </table>                                                                
                            </div>
                            <div class="cuerpo">                                
                                <?php if($mensaje) {?>
                                    <div align="center">
                                        <div class="texto_msj">
                                            <?php echo $msje; ?>
                                        </div>
                                    </div>                                    
                                <?php }?>
                                <form method="post" action="<?php echo $action;?>" id="form_autenticacion">
                                <input type="hidden" name="intentos" value="<?php echo $intentos; ?>" />                        
                                <br/>
                                <div class="caja_input">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <!--td width="10"><div class="caja_input_borde_izq" > &nbsp; </div></td-->
                                            <td align="left">
                                                <?php $nombre='documento';?>
                                                 &nbsp; <?php echo form_label('Mi Número de Documento: ', $prefijo.$nombre);?> &nbsp;                                                 
                                            </td>
                                            <td align="right" valign="middle">
                                                <?php
                                                    echo form_input(array(
                                                        'name' => $prefijo.$nombre,
                                                        'id' => $prefijo.$nombre,
                                                        'class' => 'input1_normal',
                                                        'size' => '19',
                                                        'value' => set_value($prefijo.$nombre,$fila[$prefijo.$nombre])
                                                      ));                                                      
                                                ?> 
                                            </td>
                                            <!--td width="10"><div class="caja_input_borde_der" > &nbsp; </div></td-->
                                        </tr>                                    
                                    </table>
                                </div>                                
                                <?php
                                if($error[$prefijo.$nombre])
                                        echo '<br/><div class="error1">'.$error[$prefijo.$nombre].'</div>';
                                ?>
                                <br/>
<!--                                <div class="caja_input">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            td width="10"><div class="caja_input_borde_izq" > &nbsp; </div></td
                                            <td align="left">
                                                <?php $email='email';?>
                                                 &nbsp; <?php echo form_label('E-mail: ', $prefijo.$email);?> &nbsp;                                                                                                
                                            </td>
                                            <td align="right" valign="middle">
                                                <?php
                                                    echo form_input(array(
                                                        'name' => $prefijo.$email,
                                                        'id' => $prefijo.$email,
                                                        'class' => 'input1_normal',
                                                        'size' => '35',
                                                        'value' => set_value($prefijo.$email,$fila[$prefijo.$email])
                                                      ));                                                      
                                                ?> 
                                            </td>
                                            td width="10"><div class="caja_input_borde_der" > &nbsp; </div></td
                                        </tr>                                    
                                    </table>
                                </div>                                -->
                                <!--<div align="center"><span class="texto2"><b> Nota.- </b>Ingrese el correo con el que se inscribió.</span></div>-->
                                <?php
                                if($error[$prefijo.$email])
                                    echo '<br/><div class="error1">'.$error[$prefijo.$email].'</div>';
                                ?>   
                                <br/>
                                <?php $campocap='captcha';?>
                                Código de Imagen<br/>(sensible a mayúsculas y minúsculas)
                                <br/>
                                <img src="<?php echo base_url();?>files/captcha/securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>" id="image" align="center" /><br/><br/>                                
                                <div class="caja_input">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <!--td width="10"><div class="caja_input_borde_izq" > &nbsp; </div></td-->
                                            <td align="left">                                                
                                                 &nbsp; <?php echo form_label('Introduzca el código de imagen : ', $campocap);?> &nbsp;                                                                                                 
                                            </td>
                                            <td align="right" valign="middle">
                                                <?php
                                                   echo form_input(array(
                                                        'name' => $campocap,
                                                        'id' => $campocap,
                                                        'size' => '13',
                                                       'class' => 'input1_normal'
                                                      ));                                                     
                                                ?>
                                            </td>
                                            <!--td width="10"><div class="caja_input_borde_der" > &nbsp; </div></td-->
                                        </tr>                                    
                                    </table>
                                </div>                                                                                           
                                <?php
                                if($error[$campocap])
                                    echo '<br/><div class="error1">'.$error[$campocap].'</div>';
                                ?>
                                                                
                                <br/><div align="center">
                                    <input type="submit" name="enviar" value="ENVIAR" class="boton1"/>
                                </div>                                
                                <br/>                                                                
                                </form>                                
                            </div>                            
                        </div>  
                        <br/><br/>
                        <div align="center">
                            <?php echo anchor('index','Volver a Autenticarse');?>
                        </div>
                        <br/><br/>
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
