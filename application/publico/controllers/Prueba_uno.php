<?php
// require_once('Controladoradmin.php');
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('America/La_Paz');

class Prueba_uno extends CI_Controller
{
    function __construct()
    {
		  parent::__construct();
		  force_ssl();
		  $this->load->helper(array('url','form','html'));
		  $this->load->library(array('form_validation','tool_general'));

			 //****** definiendo nombre de carpeta por defecto
		  $this->carpeta='prueba_uno/';
		  $this->controlador='Prueba_uno/';
	
		  $this->tablaPos = 'postulante';
		  $this->prefijoPos = 'pos_';
		  $this->tabla='zis_plantillas';
		  $this->prefijo='zpla_';
		  $this->tablaU='zis_plantilla_e_uno';
		  $this->prefijoU='pre_uno_';
		  $this->tablaE='zis_plantilla_p_uno';
		  $this->prefijoE='pre_uno_p_';
		  $this->tablaT='zis_tabla_plantilla_uno';
		  $this->prefijoT='t_uno_';
		  $this->tablaS = 'zis_seguimiento';
		  $this->prefijoS = 'seg_';
		  $this->tablaG = 'zis_grupo_evaluacion';
		  $this->prefijoG = 'gru_';
		  $this->tablaEv = 'zis_evaluacion';
		  $this->prefijoEv = 'eva_';
		  
		  $this->formulario_agregar='plantilla_uno_agregar';
		  $this->formulario_editar='plantilla_uno_agregar';
		  $this->formulario_prueba='plantilla_prueba_agregar';
		  $this->formulario_preguntas='plantilla_preguntas_agregar';
		  $this->formulario_texto='texto_agregar';
		  
		  $this->cabecera['titulo'] = 'Sistema de Evaluación';
		  $this->action_defecto='listar';
			 //****** cargando el modelo
		  $this->modelo='modelo_contador';

		  $this->presession=$this->tool_entidad->presession();
		  session_start();
		  if (!isset($_SESSION[$this->presession.'usuario']))
		  {
			  redirect(base_url().index_page());
		  }
		  
	}       

	function pregunta_prueba()
	{
		$uri = $this->uri->uri_to_assoc(3);
        $idgrupo = $uri['idg'];
        $idev = $uri['ev'];
        $id = $uri['idp'];
		$consulta = $this->db->query("SELECT * FROM
			".$this->tabla."
			WHERE zpla_id=$id");
		$datos=$consulta->result_array();
		$consulta2 = $this->db->query("SELECT * FROM
			".$this->tablaE."
			WHERE zpla_id=$id LIMIT 1");
		$datos2=$consulta2->result_array();
		$this->cabecera['accion']='Pregunta de prueba'; 
		$contenido['cabecera']=$this->cabecera;
		$contenido['datos2'] = $datos2[0];
		$contenido['id'] = $id;
		$contenido['idev'] = $idev;
		$contenido['idgrupo'] = $idgrupo;
		$data['contenido'] = $this->load->view($this->carpeta.'pregunta_prueba', $contenido, true);
		$this->load->view('plantilla_publico_2019', $data);
	}
	
	function preguntas_g1()
	{
		$uri = $this->uri->uri_to_assoc(3);
        $idgrupo = $uri['idg'];
        $id = $uri['idp'];
        $idev = $uri['ev'];
		$id_usuario=$_SESSION[$this->presession . 'id'];
		// $id=$this->input->post('id');
		$consulta = $this->db->query("SELECT * FROM
			".$this->tabla."
			WHERE ".$this->prefijo."id=$id");
		$datos=$consulta->result_array();
		$consulta2 = $this->db->query("SELECT * FROM
			".$this->tablaU."
			WHERE ".$this->prefijo."id=".$id." AND ".$this->prefijoU."nro between 1 and 8 order by ".$this->prefijoU."nro ASC");
		$datos2=$consulta2->result_array();
		$this->cabecera['accion']=$datos[0][$this->prefijo.'titulo']; 
		// $contenido['action']=  $this->controlador.'preguntas_g2/idp/'.$id.'/ev/'.$idev;
		
		// TIEMPO INICIO
		$tiempo = $this->db->query("SELECT seg_tiempo_total FROM zis_seguimiento WHERE pos_id='$id_usuario' and eva_id='$idev' and gru_id='$idgrupo'");

		if ($tiempo->num_rows() > 0) {
			$tiempo=$tiempo->result_array();
			$tiempo=$tiempo[0]['seg_tiempo_total'];
			$valor_tiempo=explode(":",$tiempo);
			$tiempo_cronometro=[$valor_tiempo[0],$valor_tiempo[1],$valor_tiempo[2]];
			//var_dump($tiempo_cronometro);exit();
			
		}else{
			$tiempo_cronometro=[0,0,0];
		}
		// TIEMPO FIN
	    $contenido['tc'] = $tiempo_cronometro; 
		$contenido['action']=  $this->controlador.'guardar_preguntas_g1';
		$contenido['cabecera']=$this->cabecera;
		$contenido['array_p'] = $datos2;
		$contenido['idp'] = $id;
		$contenido['idev'] = $idev;
		$contenido['idgrupo'] = $idgrupo;
		$data['contenido'] = $this->load->view($this->carpeta.'vista_preguntas', $contenido, true);
		$this->load->view('plantilla_publico_2019', $data);
	}
	function guardar_preguntas_g1()
	{
		$tiempo = $this->input->post('tiempo');
		$idev = $this->input->post('idev');
		$idgrupo = $this->input->post('idgrupo');
		$idp = $this->input->post('idp');
		$id=$_SESSION[$this->presession . 'id'];
		$consulta = $this->db->query('
				SELECT * FROM zis_plantilla_e_uno WHERE zpla_id='.$idp.' AND pre_uno_nro between 1 and 8 ORDER BY pre_uno_nro ASC
			');
		$preguntas = $consulta->result_array();
		$respuestas=array();
		$puntaje=0;
		for($i=1;$i<=8;$i++){
			$respuestas[$i]['pos_id']=$id;
			$respuestas[$i][$this->prefijoU.'id']=$this->input->post('idpreg_'.$i);
			$respuestas[$i]['res_respuesta']=$this->input->post('respuesta_'.$i);
			$respuestas[$i]['eva_id']=$idev;
			$respuestas[$i]['gru_id']=$idgrupo;
			$respuestas[$i]['res_fecha_creacion']= date('Y-m-d H:i:s');
			$respuestas[$i]['res_fecha_edicion']= date('Y-m-d H:i:s');
			$ind=$preguntas[$i-1]['pre_uno_resp_correcta'];
			$respC=$preguntas[$i-1]['pre_uno_resp_'.$ind];
			if($respuestas[$i]['res_respuesta']==$respC){
				$puntaje++;
			}
			$this->db->insert('zis_respuestas_uno', $respuestas[$i]);
			$idR=$this->db->insert_id();
			$respuestas[$i]['id_respuesta']= $idR;
		}
		$notab=$this->calcular_baremo($puntaje,$idp);
		$consulta2 = $this->db->query('
				SELECT * FROM '.$this->tablaS.' WHERE '.$this->prefijoPos.'id='.$id.' AND '.$this->prefijoEv.'id='.$idev.' AND '.$this->prefijoG.'id='.$idgrupo.' 
			');
		$filaS = $consulta2->first_row('array');
		$filaSN[$this->prefijoS.'porcentaje'] = 60;
	
		$idseg=$filaS[$this->prefijoS.'id'];
		$filaSN[$this->prefijoS.'resp_puntaje']  = $puntaje;
		$filaSN[$this->prefijoS.'bare_puntaje']  = $notab;
		$filaSN[$this->prefijoS . 'fecha_edicion'] = date('Y-m-d H:i:s');
		$this->db->where($this->prefijoS.'id', $idseg);         
		$this->db->update($this->tablaS, $filaSN);
		
		redirect($this->controlador . 'preguntas_g2/idg/'.$idgrupo.'/ev/'.$idev.'/idp/'.$idp);

	}
	function preguntas_g2()
	{
		$uri = $this->uri->uri_to_assoc(3);
        $idgrupo = $uri['idg'];
        $id = $uri['idp'];
        $idev = $uri['ev'];
		$id_usuario=$_SESSION[$this->presession . 'id'];
		// $id=$this->input->post('id');
		$consulta = $this->db->query("SELECT * FROM
			".$this->tabla."
			WHERE ".$this->prefijo."id=$id");
		$datos=$consulta->result_array();
		$consulta2 = $this->db->query("SELECT * FROM
			".$this->tablaU."
			WHERE ".$this->prefijo."id=".$id." AND ".$this->prefijoU."nro between 9 and 15 order by ".$this->prefijoU."nro ASC");
		$datos2=$consulta2->result_array();
		$this->cabecera['accion']=$datos[0][$this->prefijo.'titulo']; 
		// TIEMPO INICIO
		$tiempo = $this->db->query("SELECT seg_tiempo_total FROM zis_seguimiento WHERE pos_id='$id_usuario' and eva_id='$idev' and gru_id='$idgrupo'");

		if ($tiempo->num_rows() > 0) {
			$tiempo=$tiempo->result_array();
			$tiempo=$tiempo[0]['seg_tiempo_total'];
			$valor_tiempo=explode(":",$tiempo);
			$tiempo_cronometro=[$valor_tiempo[0],$valor_tiempo[1],$valor_tiempo[2]];
			//var_dump($tiempo_cronometro);exit();
			
		}else{
			$tiempo_cronometro=[0,0,0];
		}
		// TIEMPO FIN
	    $contenido['tc'] = $tiempo_cronometro; 
		$contenido['action']=  $this->controlador.'guardar_preguntas_g2';
		$contenido['cabecera']=$this->cabecera;
		$contenido['array_p'] = $datos2;
		$contenido['idp'] = $id;
		$contenido['idev'] = $idev;
		$contenido['idgrupo'] = $idgrupo;
		$data['contenido'] = $this->load->view($this->carpeta.'vista_preguntas', $contenido, true);
		$this->load->view('plantilla_publico_2019', $data);
	}
	function guardar_preguntas_g2()
	{
		$tiempo = $this->input->post('tiempo');
		$idev = $this->input->post('idev');
		$idgrupo = $this->input->post('idgrupo');
		$idp = $this->input->post('idp');
		$id=$_SESSION[$this->presession . 'id'];
		$consulta1 = $this->db->query('
				SELECT * FROM '.$this->tablaS.' WHERE '.$this->prefijoPos.'id='.$id.' AND '.$this->prefijoEv.'id='.$idev.' AND '.$this->prefijoG.'id='.$idgrupo.' 
			');
		$filaS = $consulta1->first_row('array');
		$puntaje=$filaS['seg_resp_puntaje'];
		$consulta = $this->db->query('
		SELECT * FROM zis_plantilla_e_uno WHERE zpla_id='.$idp.' AND pre_uno_nro between 9 and 15 ORDER BY pre_uno_nro ASC
		');
		$preguntas = $consulta->result_array();
		$respuestas=array();
		$j=0;
		for($i=9;$i<=15;$i++){
			$respuestas[$i]['pos_id']=$id;
			$respuestas[$i][$this->prefijoU.'id']=$this->input->post('idpreg_'.$i);
			$respuestas[$i]['res_respuesta']=$this->input->post('respuesta_'.$i);
			$respuestas[$i]['eva_id']=$idev;
			$respuestas[$i]['gru_id']=$idgrupo;
			$respuestas[$i]['res_fecha_creacion']= date('Y-m-d H:i:s');
			$respuestas[$i]['res_fecha_edicion']= date('Y-m-d H:i:s');
			$ind=$preguntas[$j]['pre_uno_resp_correcta'];
			$respC=$preguntas[$j]['pre_uno_resp_'.$ind];
			if($respuestas[$i]['res_respuesta']==$respC){
				$puntaje++;
			}
			$j++;
			$this->db->insert('zis_respuestas_uno', $respuestas[$i]);
			$idR=$this->db->insert_id();
			$respuestas[$i]['id_respuesta']= $idR;
		}
		$notab=$this->calcular_baremo($puntaje,$idp);
		$filaSN[$this->prefijoS.'porcentaje'] = 100;
		$filaSN[$this->prefijoS.'termino'] = 1;
            $tiempobd=$filaS[$this->prefijoS.'tiempo_total'];
			$horas = [ $tiempobd, $tiempo];
			$total = 0;
			foreach($horas as $h) {
				$parts = explode(":", $h);
				$total += $parts[2] + $parts[1]*60 + $parts[0]*3600;        
			}   
			$sumat = gmdate("H:i:s", $total);
			echo $sumat;
		$idseg=$filaS[$this->prefijoS.'id'];
		$filaSN[$this->prefijoS.'resp_puntaje']  = $puntaje;
		$filaSN[$this->prefijoS.'bare_puntaje']  = $notab;
		$filaSN[$this->prefijoS.'tiempo_total']  = $sumat;
		$filaSN[$this->prefijoS . 'fecha_edicion'] = date('Y-m-d H:i:s');
		$filaSN[$this->prefijoS . 'fecha_termino'] = date('Y-m-d H:i:s');
		$this->db->where($this->prefijoS.'id', $idseg);         
		$this->db->update($this->tablaS, $filaSN);
		redirect('Evaluacion/texto_despedida/'.$idev);

	}
	function calcular_baremo($nota=null,$idpla=null)
	{
		$consulta = $this->db->query("SELECT * FROM zis_tabla_plantilla_uno WHERE zpla_id=$idpla");
		$datos=$consulta->first_row('array');
		$j=1;
		do{
			if(@$datos['t_uno_'.$j]){
				$valores = explode(",", $datos['t_uno_'.$j]);
				foreach($valores as $val){
					if($val==$nota){
						$notab=$j;
						$j=11;
					}
				}
				
			}
			$j++;
		}while(($j<11));
		return $notab;
	}
	function actualizar_tiempo()
	{   
    $id_pla=$this->input->post("id_pla");
    $id_grupo=$this->input->post("id_grupo");
    $id_eval=$this->input->post("id_eval");
    $hora=$this->input->post("hora");
    $min=$this->input->post("min");
    $seg=$this->input->post("seg");
    $pos_id=$_SESSION[$this->presession . 'id'];
    // id_pla:id_pla,id_grupo:id_grupo,id_eval:id_eval,hora:hora,min:min,seg:seg
    $resultado = $this->db->query("SELECT * FROM 
    zis_seguimiento
    WHERE pos_id=$pos_id and eva_id=$id_eval and gru_id=$id_grupo")->row();
    $tiempo=$hora.':'.$min.':'.$seg;
    $seg_tiempo_total=strtotime($tiempo);
    $this->db->set('seg_tiempo_total', $tiempo);            
    $this->db->where('seg_id', $resultado->seg_id);    
    $this->db->update('zis_seguimiento');
    $data['msj'] = $tiempo;   
    echo json_encode($data);
	}
}


?>