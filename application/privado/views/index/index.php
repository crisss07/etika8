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
    <style type="text/css">
            #logo_etika_responsive{
                    width: 400px;
                    margin-top: 45px;
                }

            @media (max-width: 1024px) {
                #logo_etika_responsive{
                    width: 350px;
                    height: 100px;
                }
            }

            @media (max-width: 480px) {
                #logo_etika_responsive{
                    width: 250px;
                    height: 50px;
                }
            }
        </style>
</head>
<body>
<div id="fondo_ingreso">
	<div class="container">
		<br>
		<br>
		<div class="row justify-content-center">
			<img id="logo_etika_responsive" src="<?php echo $this->tool_entidad->sitio().'files/img/privado/logo-etika.png'; ?>">
		</div>
	</div>
	<div class="container-fluid">
		<br>
			<hr style="border:1px solid #e95c34;">
		<br>
		<h1 style="color:white;">Area Privada - Sistema de Postulación</h1>
		
    </div>

<?php
$prefijo=$this->prefijo;
$num=rand(1,10);
/* 
$consulta = $this->db->query('
                SELECT pas_password as clave FROM passwords where pas_id='.$num);
$pass_generado = $consulta->row_array(); */
?>
    <div id="caja1">
    <form method="post" action="<?php echo @$action;?>" name="form_autenticacion" id="form_autenticacion">
        <input type="hidden" id="authentication" name="authentication" />
        <input type="hidden" id="id_clave" name="id_clave" value="<?php echo $num;?>" />
        <table cellpadding="0" cellspacing="10" border="0" id="form_admin2" width="100%">
    <tr>
        <td valign="top" align="center" >
		<h2 class="t_ingreso" style="color:gray;margin-top:-15px;">Autenticación de usuario</h2>
		</td>
	</tr>
	<tr>
        <td valign="top">
            <?php $campo1='login';?>
            <?php echo form_label('', $prefijo.$campo1);?>
			<p class="login-label">Usuario: </p>
            <?php
                echo form_input(array(
                    'name' => $prefijo.$campo1,
                    'id' => $prefijo.$campo1,
                    'size' => '38',
                    'class' => 'input1',
                    'value' => set_value($prefijo.$campo1,@$fila[$prefijo.$campo1])

                  ));

                  if(form_error($prefijo.$campo1))
                     echo '<div class="error">'.form_error($prefijo.$campo1).'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="" valign="top">
            <?php $campo2='pass';?>
            <?php echo form_label('', $prefijo.$campo2);?>
			<p class="login-label">Contraseña: </p>
            <?php
                echo form_password(array(
                    'name' => $prefijo.$campo2,
                    'id' => $prefijo.$campo2,
                    'class' => 'input1',
                    'size' => '38'                    
                  ));

                  if(form_error($prefijo.$campo2))
                     echo '<div class="error">'.form_error($prefijo.$campo2).'</div>';
            ?>
        </td>
    </tr>
	<!--
    <tr>
        <td class="texto_label" valign="top">
            <?php $campo2='clave';?>
            <?php echo form_label('Clave : ', $prefijo.$campo2);?>
        </td>
        <td valign="top">
            <?php
                echo form_input(array(
                    'name' => $prefijo.$campo2,
                    'id' => $prefijo.$campo2,
                    'size' => '12',
                    'class' => 'input1',
                    'value' => $pass_generado['clave']
                  ));                               
            ?>                
        </td>
    </tr>
	
    <tr>
        <td class="texto_label" valign="top">
            <?php $campo2='llave';?>
            <?php echo form_label('Llave Generada: ', $prefijo.$campo2);?>
        </td>
        <td valign="top">
            <?php
                echo form_textarea(array(
                    'name' => $prefijo.$campo2,
                    'id' => $prefijo.$campo2,
                    'class' => 'input1',
                    'rows' => '2',
                    'cols' => '22'
                  ));

                  if(form_error($prefijo.$campo2))
                     echo '<div class="error">'.form_error($prefijo.$campo2).'</div>';
            ?>
        </td>
    </tr>
	-->
    <tr valign="top">
        <td valign="top" >
            <?php
            if(!empty ($user_error))
                     echo '<div class="error">'.$user_error.'</div>';
            ?>
        </td>
    </tr>
	
</table>
<br/>
<div align="center">
    <input class="btn-etika btn" type="submit" name="enviar" value="Ingresar" class="boton1"/>
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