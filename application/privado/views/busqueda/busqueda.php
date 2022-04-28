<?php
// header("Content-Type: text/html;charset=ISO-8859-1");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>

        <meta charset="utf-8">
        <!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/> -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- <meta http-equiv="Content-Type" content="text/html;"/> -->
        <title><?php echo $this->tool_entidad->titulo_sitio(); ?></title>
        <link href="<?php echo $this->tool_entidad->sitio(); ?>files/css/est_privado.css" rel="stylesheet" type="text/css"/>
        <script src="<?php echo $this->tool_entidad->sitio(); ?>files/js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->tool_entidad->sitio(); ?>files/js/funcionesjs.js" type="text/javascript"></script>
    </head>
    <script>
        $(document).ready(function () {
            if ($("#tipo").val() == "")
            {
                document.getElementById("stringBusqueda").disabled = true;
                document.getElementById("busquedaExhaustiva").disabled = true;
            } else {
                document.getElementById("stringBusqueda").disabled = false;
                document.getElementById("busquedaExhaustiva").disabled = false;
            }

        });
    </script>
    <body onload="window.focus()">
        <?php
        $sitiop = $this->tool_entidad->sitiopri();
        if ($campos_listar) {
            $mostrar = '<table id="resultadoTabla"  align="center" class="tabla_listado" cellspacing="0" name="resultadoFiltro">';
            $mostrar .= '<thead>';
            $mostrar .= '<tr class="cabecera_listado">';
            $mostrar .= '<th   align="center" valign="middle">Nro</th>';
            for ($i = 0; $i < count($campos_listar); $i++) {
                $mostrar .= '<th  align="center" valign="middle">' . $campos_listar[$i] . '</th>';
            }
            $mostrar .= '</tr>';
            $mostrar .= '<tr>';
            $mostrar .= '</tr>';
            $mostrar .= '</thead>';

            if ($datos) {
                $n = 1;
                $mostrar .= '<tbody>';
                foreach ($datos as $fila) {
                    $arrayIdResultados[] = @$fila['id'];
                    $mostrar .= '<tr>';
                    $mostrar .= '<td align="center" valign="middle">' . $n . '</td>';
                    for ($i = 0; $i < count($campos_reales); $i++) {
                        if ($campos_reales[$i] != "postulaciones") {
                            $mostrar .= '<td align="center" valign="middle">' . $fila[strtolower($campos_reales[$i])] . '</td>';
                        }
                    }
                    $mostrar .= '</tr>';
                    $mostrar .= '<tbody>';
                    $n++;
                }
            } else {
                $colspan = count($campos_reales) + 1;
                $mostrar .= '<tr>';
                $mostrar .= '<td align="center" colspan="' . $colspan . '" valign="middle">No se encontraron resultados</td>';
                $mostrar .= '</tr>';
            }
            $mostrar .= '</table>';
        }
        ?>
        <div id="contenedor">
            <!--table width="100%"-->
            <div id="cabeza">
                <div id="cabeza_titulos">
                    <table width="100%" border="0" class="tabla_cabeza">
                        <tr>
                            <td valign="middle" align="right">

                                <div class="titulo1" align="left" ><b>SITIO PRIVADO : </b></div>

                                <div class="titulo_cliente" align="right"><?php echo $this->tool_entidad->titulo_sitio(); ?></div>
                            </td>
                            <td width="350" valign="top">

                                <div class="cuadro_usuario">
                                    <a href="<?php echo $sitiop . 'inicio/cerrar_session'; ?>" class="enlace_a1">Cerrar sesión</a>
                                    <br/>
                                    <?php
                                    if ($_SESSION[$this->presession . 'permisos'] == '1') {
                                        echo anchor('usuario', 'Administrar Usuarios Etikos', array('class' => 'enlace_a1'));
                                    } else {
                                        echo anchor('usuario/cambiarpasself', 'Cambiar mi contraseña', array('class' => 'enlace_a1'));
                                    }
                                    //echo anchor('#','Administrar usuarios',array('class'=>'enlace_a1'));
                                    ?>                                                            
                                    <br/>
                                    Usuario: <strong><?php echo $_SESSION[$this->presession . 'usuario']; ?></strong>

                                </div>

                            </td>
                        </tr>
                    </table>

                </div>
            </div>
            <table width="100%" align="center">
                <tbody><tr>
                        <td class="enlaces_add_edit" width="100%" align="left">
                            <table align="center">                            
                                <tbody><tr>
                                        <td>
                                            <span class="cabecera_titulo"> <?php echo $cabecera['titulo']; ?></span>
                                            <span class="flecha2">&rarr;</span>
                                            <span class="cabecera_accion"> <?php echo $cabecera['acticion']; ?></span>

                                        </td>
                                    </tr>
                                    <tr><td colspan="2"><div class="linea1"></div></td></tr>
                                </tbody></table>
                        </td>

                    </tr>
                </tbody></table>            
            <div id="cuerpo">
                <table align="center" width="40%">
                    <tbody><tr>
                            <td class="enlaces_add_edit" align="center">
                                <a href="#" onclick="window.close();return false;" class="enlace_cancelar enlace_a1">Cerrar Busqueda</a>
                            </td>
                            <td class="enlaces_add_edit" align="center">
                                <p><img src="<?php echo $this->tool_entidad->sitio() . 'files/img/excel_exportar.jpg'; ?>" onclick="tableToExcel2('resultadoTabla', 'Postulantes', 'resultado_exhaustiva')" 
                            style="cursor: pointer;"/></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table align="center" width="90%">              
                    <tr>
                        <td align="center">
                            <div id="cuerpo_cen">
                                <div id="listado"><br/>
                                    <div style="text-align: center;">                                        
                                        <form action="<?php echo @$sitio . 'exhaustiva'; ?>" method="post" name="fomularioBusqueda" id="fomularioBusqueda">        
                                            <select id="tipo" name="tipoexhaustiva" class="form-select-21" style="width: 175px;">
                                                <option value="">Seleccione una opci&oacute;n</option>
                                                <option value="1" <?php echo $tipoBusqueda == 1 ? 'selected' : '' ?>>Cargos ocupados</option>
                                                <option value="2" <?php echo $tipoBusqueda == 2 ? 'selected' : '' ?>>Nombre de la organizaci&oacute;n</option>
                                            </select><br/><br/>
                                            <input style="width: 175px;" type="text" id="stringBusqueda" name="valorBusqueda" value="<?php echo $valorBusqueda; ?>"/><br/><br/>
                                            <input type="button" value="Realizar busqueda" id="busquedaExhaustiva"/>
                                            <br/>
                                            <br/>
                                        </form>
                                    </div>
                                    <div class="scrollh">
                                        <?php
                                        if ($mostrar) {
                                            echo $mostrar;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="pie">
                <table align="center" cellpadding="8">        
                    <tr>
                        <td align="center">
                            <span id="siteseal"><script type="text/javascript" src="https://seal.starfieldtech.com/getSeal?sealID=ycDU5wzt3jJF7WzNVpDuNfhxH8kOrL5iJCnEbzfUV6oDRp9T1Ti3Rq6vk3t"></script><br/><a style="font-family: arial; font-size: 9px" href="http://www.starfieldtech.com" target="_blank">SSL Certificate</a></span>
                        </td>
                    </tr>
                </table> 
            </div>
        </div>
    </body>
</html>