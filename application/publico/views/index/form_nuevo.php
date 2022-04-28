<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title>Sistema de Postulación - Nuevo</title>
    <?php
    echo link_tag('/files/css/est_publico.css', 'stylesheet', 'text/css');
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
        <table width="100%" border="1" cellpadding="0" cellspacing="0">
            <tr>
                <td bgcolor="#2d637b" align="center"  valign="top" width="224">
                    <div class="logo_etika_inicio"> &nbsp; </div>                       
                </td>
                <td bgcolor="#ffffff" valign="top" align="center">
                    <div class="banner_etika_inicio" >
                        <div class="banner_letrasp" algin="center">ESPECIALISTAS EN DESARROLLO ORGANIZACIONAL Y GESTIÓN DE PERSONAS</div>
                        <br/><br/><br/>
                        <div class="banner_letrasg" algin="center">BIENVENIDO AL SISTEMA DE POSTULACIÓN</div>                        
                    </div>
                    <div id="contenido_inicio">
                        <div class="cuerpo_caja1">
                            <div class="cabecera">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <!--td width="5"><div class="borde_izq" > &nbsp; </div></td-->
                                        <td bgcolor="#fae5a0" align="center"><div class="titulo_caja1">SOY NUEVO POSTULANTE</div></td>
                                        <!--td width="5"><div class="borde_der" > &nbsp; </div></td-->
                                    </tr>
                                </table>                                                                
                            </div>
                            <div class="cuerpo">
                                <br/>
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
                                <table align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <!--td width="10"><div class="caja_input_borde_izq" > &nbsp; </div></td-->
                                        <td align="left" >
                                            <div class="caja_input">
                                                <?php $nombre='tipodoc'; ?>
                                                <table width="100%">
                                                    <tr>
                                                        <td><?php echo form_label('Tipo de Documento: ', $prefijo.$nombre);?></td>
                                                        <td align="left" ><input type="radio" name="<?php echo $prefijo.$nombre; ?>" value="1" <?php echo $valor_doc1;?> /><label>C.I.</label></td>
                                                        <td align="right"><input type="radio" name="<?php echo $prefijo.$nombre; ?>" value="2" <?php echo $valor_doc2;?> /><label>Pasaporte</label></td>
                                                    </tr>
                                                </table>                                                                                                
                                            </div>                                            
                                        </td>
                                        <!--td width="10"><div class="caja_input_borde_der" > &nbsp; </div></td-->
                                    </tr>                                    
                                </table>
                                <?php
                                if($error[$prefijo.$nombre])
                                        echo '<br/><div class="error1">'.$error[$prefijo.$nombre].'</div>';
                                ?>
                                <br/>
                                <table align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <!--td width="10"><div class="caja_input_borde_izq" > &nbsp; </div></td-->
                                        <td align="right">
                                            <div class="caja_input">
                                                <?php $campo1='documento';?>
                                                <?php echo form_label('Mi Número de Documento: ', $prefijo.$campo1);?> &nbsp; 
                                                <?php
                                                    echo form_input(array(
                                                        'name' => $prefijo.$campo1,
                                                        'id' => $prefijo.$campo1,
                                                        'size' => '13',
                                                        'class' => 'input1_normal',
                                                        'value' => set_value($prefijo.$campo1,$fila[$prefijo.$campo1])
                                                      ));                                                      
                                                ?>                                   
                                            </div>
                                        </td>
                                        <!--td width="10"><div class="caja_input_borde_der" > &nbsp; </div></td-->
                                    </tr>                                    
                                </table>
                                <div align="center"><span class="texto2">En caso de CI introduzca solo los números.</span></div>
                                <?php
                                if($error[$prefijo.$campo1])
                                        echo '<br/><div class="error1">'.$error[$prefijo.$campo1].'</div>';
                                ?>   
                                <br/>
                                <?php $campocap='captcha';?>
                                Código de Imagen<br/>(sensible a mayúsculas y minúsculas)
                                <br/>
                                <img src="<?php echo base_url();?>files/captcha/securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>" id="image" align="center" /><br/><br/>                                
                                <table align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <!--td width="10"><div class="caja_input_borde_izq" > &nbsp; </div></td-->
                                        <td align="right">
                                            <div class="caja_input">                                                
                                                <?php echo form_label('Introduzca el código de imagen : ', $campocap);?> &nbsp; 
                                                <?php
                                                   echo form_input(array(
                                                        'name' => $campocap,
                                                        'id' => $campocap,
                                                        'size' => '8',
                                                       'class' => 'input1_normal'
                                                      ));                                                     
                                                ?>                                   
                                            </div>
                                        </td>
                                        <!--td width="10"><div class="caja_input_borde_der" > &nbsp; </div></td-->
                                    </tr>                                    
                                </table>                                                             
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
                            <?php echo anchor('index','Volver a Acceder');?>
                        </div>
                        <br/><br/>                        
                    </div>
                </td>
            </tr>            
        </table>        
    </div>                    
</body>
</html>
