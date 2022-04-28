<?php
require_once('Controladoradmin.php');

class Analitica_e extends Controladoradmin
{
    function __construct()
    {
		  parent::__construct();
		  force_ssl();
		  $this->load->helper(array('url','form','html'));
		  $this->load->library(array('form_validation','tool_general'));

			 //****** definiendo nombre de carpeta por defecto
		  $this->carpeta='Analitica_e/';
		  $this->controlador='Analitica_e/';
		  $this->controlador2='Plantilla/';

		  $this->tabla='zis_plantillas';
		  $this->prefijo='zpla_';
		  $this->tablaU='zis_plantilla_e_uno';
		  $this->prefijoU='pre_uno_';
		  $this->tablaE='zis_plantilla_p_uno';
		  $this->prefijoE='pre_uno_p_';
		  $this->tablaT='zis_tabla_plantilla_uno';
		  $this->prefijoT='t_uno_';
		  
		  $this->formulario_agregar='plantilla_uno_agregar';
		  $this->formulario_editar='plantilla_uno_agregar';
		  $this->formulario_prueba='plantilla_prueba_agregar';
		  $this->formulario_preguntas='plantilla_preguntas_agregar';
		  $this->formulario_texto='texto_agregar';
		  
		  $this->cabecera['titulo']='Plantilla Prueba Analítica'; 
		  $this->action_defecto='listar';
			 //****** cargando el modelo
		  $this->modelo='modelo_contador';

		  $this->presession=$this->tool_entidad->presession();
		  session_start();
		  if (!isset($_SESSION[$this->presession.'usuario']))
		  {
			  redirect(base_url().index_page());
		  }
		  if($_SESSION[$this->presession.'permisos']>='2') {
			redirect('inicio');
			}
	}       

	
    function exportar_reporte()
    {
		$evaluados=$_SESSION["evaluados"];
		$nombre = "evaluacion";
		$headerTable[] = 'Nro';
		$headerTable[] = 'Tiempo';
		$headerTable[] = 'Nro Intentos';
		$headerTable[] = 'Nombres';
		$headerTable[] = 'Apellidos';
		$headerTable[] = 'Edad';
		$headerTable[] = 'Género';
		$headerTable[] = 'Profesión';
		$headerTable[] = 'Donde estudio';
		$headerTable[] = 'Pregunta 1';
		$headerTable[] = 'Pregunta 2';
		$headerTable[] = 'Pregunta 3';
		$headerTable[] = 'Pregunta 4';
		$headerTable[] = 'Pregunta 5';
		$headerTable[] = 'Pregunta 6';
		$headerTable[] = 'Pregunta 7';
		$headerTable[] = 'Pregunta 8';
		$headerTable[] = 'Pregunta 9';
		$headerTable[] = 'Pregunta 10';
		$headerTable[] = 'Pregunta 11';
		$headerTable[] = 'Pregunta 12';
		$headerTable[] = 'Pregunta 13';
		$headerTable[] = 'Pregunta 14';
		$headerTable[] = 'Pregunta 15';
		$headerTable[] = 'Puntaje Bruto';
		$headerTable[] = 'Puntaje Baremo';
		$fecha = date("Ymd");
        header('Content-type: application/vnd.ms-excel');
		// header("Content-Type:   application/vnd.ms-excel; charset=utf-16");
        header("Content-Disposition: attachment; filename=" . $fecha . "_" . $nombre . ".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo "<table border=1><tr>";
        foreach ($headerTable as $cabecera) {
            echo "<th>" . $cabecera . "</th> ";
        }
			echo "</tr> ";
			if(@$evaluados){ 
				$i=1;
				foreach($evaluados as $value){
					foreach($value as $evd){
						echo "<tr>";
							echo "<td>".$i++."</td>";
							echo "<td>".$evd['seg_tiempo_total']."</td> ";
							echo "<td>".$evd['seg_intentos']."</td> ";
							echo "<td>".$evd['nombres']."</td> ";
							echo "<td>".$evd['apellidos']."</td>";
							echo "<td>".$evd['edad']."</td>";
							echo "<td>".$evd['sexo']."</td> ";
							echo "<td>".$evd['profesion']."</td> ";
							echo "<td>".$evd['lugar_estudios']."</td> ";
							echo "<td>".@$evd['res_respuesta_1']."</td>";
							echo "<td>".@$evd['res_respuesta_2']."</td>";
							echo "<td>".@$evd['res_respuesta_3']."</td> ";
							echo "<td>".@$evd['res_respuesta_4']."</td> ";
							echo "<td>".@$evd['res_respuesta_5']."</td> ";
							echo "<td>".@$evd['res_respuesta_6']."</td>";
							echo "<td>".@$evd['res_respuesta_7']."</td>";
							echo "<td>".@$evd['res_respuesta_8']."</td> ";
							echo "<td>".@$evd['res_respuesta_9']."</td> ";
							echo "<td>".@$evd['res_respuesta_10']."</td> ";
							echo "<td>".@$evd['res_respuesta_11']."</td>";
							echo "<td>".@$evd['res_respuesta_12']."</td>";
							echo "<td>".@$evd['res_respuesta_13']."</td> ";
							echo "<td>'".@$evd['res_respuesta_14']."'</td> ";
							echo "<td>".@$evd['res_respuesta_15']."</td> ";
							echo "<td>".$evd['punf']."</td>";
							echo "<td>".$evd['punb']."</td>";
						echo "</tr>";
						
					}
				}
			}
			echo "</table> ";
    }
	
	function funcion($idpos=null,$idgrupo=null,$ideval=null)
	{
		echo 'guardo';
	}
}


?>