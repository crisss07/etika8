<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Ingreso</title>
    <?php
    echo link_tag('/files/css/est_privado.css', 'stylesheet', 'text/css');
    ?> 
	<!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">	
    <link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/estilos_etika.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="fondo_ingreso">
	<div class="container">
		<br>
		<br>
		<div class="row justify-content-center">
			<img class="col-lg-7" src="<?php echo $this->tool_entidad->sitio().'files/img/privado/logo-etika.png'; ?>">
		</div>
	</div>
	<div class="container-fluid">
		<br>
			<hr style="border:1px solid #e95c34;">
		<br>
		<br/>
		<h1 style="color:white;">Habilitar el segundo metodo de Autenticacion</h1>
		
    </div>


    <div id="caja1" align="center">
          <p>Escanee el siguiente código Qr con la aplicación Google Authenticator en su teléfono y haga click en guardar</p>
          
            <div class="form-group">
                        <div class="col-sm-12" align="center">
                            <img src="<?= $user_2fa_qrCode ?>" />
                        </div>
                     
                    </div>
             
                
                <br>
                        <?php echo form_open_multipart('Autenticar/codigo'); ?>
                
                    <div class="form-group">
                        <label class="col-md-12">
</label>
                        <input type="hidden" name="secret_code" value="<?= $user_2fa_secret_code ?>" required>
                        <input type="hidden" name="id" value="<?= $id ?>" required>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12" align="center">
                            <button type="submit" class="btn-etika btn">Guardar</button>
                            
                            
                        </div>
                     
                    </div>
                </form>
    </div>
<br>
<br>
<br>
<br>
<br>
</div>

<div id="pie-etika">
<br>
<table align="center" cellpadding="8">        
        <tr>
            <td align="center">
                <span id="siteseal">
                    <script type="text/javascript" src="https://seal.starfieldtech.com/getSeal?sealID=4oh6MsPttpdX2y1QrCCBWoB7Yv44YWMUBhnmPY0gOlefiKREodbVZiLevGl0"></script><br/><a style="font-family: arial; font-size: 9px" href="http://www.starfieldtech.com" target="_blank">SSL Certificate</a>
                    <p class="pie-dibel sin-padding" style="color:rgba(255, 255, 255, 0.5); font-size: 12px; ">Desarrollo Web: <a style="color:rgba(255, 255, 255, 0.5); text-decoration: none;" href="https://www.dibeltecnologia.com/" target="_blank">Dibel Soluciones en Tecnología</a></p>
                </span>
            </td>
        </tr>
    </table> 
</div>
</body>
</html>
<style>

</style>