<?php
require_once('Controladoradmin.php');

class Analitica extends Controladoradmin
{
    function __construct()
    {
		  parent::__construct();
		  force_ssl();
		  $this->load->helper(array('url','form','html'));
		  $this->load->library(array('form_validation','tool_general'));

			 //****** definiendo nombre de carpeta por defecto
		  $this->carpeta='analitica/';
		  $this->controlador='Analitica/';
		  $this->controladorAtras='Seguimiento/reporte_por_plantilla';
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
		 //  if($_SESSION[$this->presession.'permisos']>='2') {
			// redirect('inicio');
			// }
	}       

	function gpregunta($id)
	{
		$this->cabecera['accion']='Texto Instructivo I'; 
		$contenido['cabecera']=$this->cabecera;
		$contenido['id'] = $id;
		$contenido['tipo'] = 1;
		$contenido['action'] = $this->controlador.'guardar_insctructivo_prueba';
		$contenido['campo'] = 'texto_instructivo_prueba';
		$contenido['texto'] = '';
		$contenido['boton'] = 'Siguiente';
		$data['contenido'] = $this->load->view($this->carpeta.$this->formulario_texto, $contenido, true);
		$this->load->view('plantilla_privado',$data);
	}
	function texto_prueba($id)
	{
		$plantilla = $this->db->query("SELECT zpla_texto_instructivo_prueba as texto FROM zis_plantillas
		WHERE zpla_id=$id")->row();
		$this->cabecera['accion']='Editar Texto Instructivo I'; 
		$contenido['cabecera']=$this->cabecera;
		$contenido['id'] = $id;
		$contenido['tipo'] = 1;
		$contenido['action'] = $this->controlador.'guardar_insctructivo_prueba/editar';
		$contenido['campo'] = 'texto_instructivo_prueba';
		$contenido['texto'] = $plantilla->texto;
		$contenido['boton'] = 'Guardar';
		$data['contenido'] = $this->load->view($this->carpeta.$this->formulario_texto, $contenido, true);
		$this->load->view('plantilla_privado',$data);
	}

	function guardar_insctructivo_prueba($accion=null)
	{
		/* RECIBIR DATOS POST */
		$texto_prueba = $this->input->post($this->prefijo.'texto_instructivo_prueba');
		$id = $this->input->post('id');
		$tipo = $this->input->post('tipo');
		/* CARGAR DATOS A LA BD */
		$data = array($this->prefijo.'texto_instructivo_prueba' => $texto_prueba);
		$this->db->where($this->prefijo.'id', $id);         
		$this->db->update($this->tabla, $data);
		/* SIGUIENTE FUNCION */
		if($accion=='editar')
		{
			redirect($this->controlador.'editar_plantilla/'.$id);
		}
		else{
			redirect($this->controlador.'agregar_pregunta_prueba/'.$id);
		}
	}
	function agregar_pregunta_prueba($id)
	{
		$prefijoE=$this->prefijoE;
		$prefijo=$this->prefijo;
		$this->cabecera['accion']='Pregunta de Prueba'; 
		$contenido['cabecera']=$this->cabecera;
		$contenido['id'] = $id;
		$contenido['action'] = $this->controlador.'agregar_pregunta_prueba/'.$id;
		$contenido['editar'] = 0;
		$opciones = $this->input->post('enviar');
        if($opciones == 'Atras'){
            redirect($this->controlador.'gpregunta/'.$id);
        }elseif($opciones == 'Siguiente'){
			for($x=1;$x<=1;$x++){
                $data1[$prefijo . 'id'] = $id;
                $data1[$prefijoE . 'nro'] = $x;
                $data1[$prefijoE . 'texto'] = $this->input->post($prefijoE.'texto'.$x);
                $data1[$prefijoE . 'resp_a'] = $this->input->post($prefijoE.'resp_a'.$x);
                $data1[$prefijoE . 'resp_b'] = $this->input->post($prefijoE.'resp_b'.$x);
                $data1[$prefijoE . 'resp_c'] = $this->input->post($prefijoE.'resp_c'.$x); 
                $data1[$prefijoE.'fecha_edicion'] = date('Y-m-d H:i:s');
                if($this->input->post($prefijoE.'id'.$x)){
					echo $this->input->post($prefijoE.'id'.$x);
					echo 'editar';
                    /* $data1[$prefijoE . 'id'] = $this->input->post($prefijoE.'id'.$x);
                    $this->$modelo->editar_evaluacion_prueba_uno_plantilla($data1); */
				}else{    					
					$data1[$prefijoE.'fecha_creacion'] = date('Y-m-d H:i:s');					
					print_r($data1);         
					$this->db->insert($this->tablaE, $data1);
					$idp=$this->db->insert_id();
                    echo $idp;
				}                        
            }  
			redirect($this->controlador.'instructivo_dos/'.$id);    
		}
		$data['contenido'] = $this->load->view($this->carpeta.$this->formulario_prueba, $contenido, true);
		$this->load->view('plantilla_privado',$data);
	}
	function editar_pregunta_prueba($id)
	{
		$prefijoE=$this->prefijoE;
		$prefijo=$this->prefijo;
		$preguntas = $this->db->query("SELECT * FROM zis_plantilla_p_uno
		WHERE zpla_id=$id")->result_array();
		$this->cabecera['accion']='Editar Pregunta de Prueba'; 
		$contenido['cabecera']=$this->cabecera;
		$contenido['id'] = $id;
		$contenido['action'] = $this->controlador.'editar_pregunta_prueba/'.$id;
		$contenido['editar']=1;
		$contenido['fila']=$preguntas[0];
		$opciones = $this->input->post('enviar');
        if($opciones == 'Atras'){
            redirect($this->controlador.'gpregunta/'.$id);
        }elseif($opciones == 'Guardar'){
			for($x=1;$x<=1;$x++){
                $data1[$prefijo . 'id'] = $id;
                $data1[$prefijoE . 'nro'] = $x;
                $data1[$prefijoE . 'texto'] = $this->input->post($prefijoE.'texto'.$x);
                $data1[$prefijoE . 'resp_a'] = $this->input->post($prefijoE.'resp_a'.$x);
                $data1[$prefijoE . 'resp_b'] = $this->input->post($prefijoE.'resp_b'.$x);
                $data1[$prefijoE . 'resp_c'] = $this->input->post($prefijoE.'resp_c'.$x); 
                $data1[$prefijoE.'fecha_edicion'] = date('Y-m-d H:i:s');
				$id_p = $this->input->post($prefijoE.'id'.$x);
				$this->db->where($this->prefijoE.'id', $id_p);         
				$this->db->update($this->tablaE, $data1);
            }  
			redirect($this->controlador.'editar_plantilla/'.$id);    
		}
		$data['contenido'] = $this->load->view($this->carpeta.$this->formulario_prueba, $contenido, true);
		$this->load->view('plantilla_privado',$data);
	}
	function instructivo_dos($id)
	{
		$this->cabecera['accion']='Texto Instructivo II'; 
		$contenido['cabecera']=$this->cabecera;
		$contenido['id'] = $id;
		$contenido['tipo'] = 1;
		$contenido['action'] = $this->controlador.'guardar_insctructivo_dos';
		$contenido['campo'] = 'texto_instructivo';
		$contenido['texto'] = '';
		$contenido['boton'] = 'Siguiente';
		$data['contenido'] = $this->load->view($this->carpeta.$this->formulario_texto, $contenido, true);
		$this->load->view('plantilla_privado',$data);
	}
	function editar_instructivo_dos($id)
	{
		$plantilla = $this->db->query("SELECT zpla_texto_instructivo as texto FROM zis_plantillas
		WHERE zpla_id=$id")->row();
		$this->cabecera['accion']='Editar Texto Instructivo II'; 
		$contenido['cabecera']=$this->cabecera;
		$contenido['id'] = $id;
		$contenido['tipo'] = 1;
		$contenido['action'] = $this->controlador.'guardar_insctructivo_dos/editar';
		$contenido['campo'] = 'texto_instructivo';
		$contenido['texto'] = $plantilla->texto;
		$contenido['boton'] = 'Guardar';
		$data['contenido'] = $this->load->view($this->carpeta.$this->formulario_texto, $contenido, true);
		$this->load->view('plantilla_privado',$data);
	}
	function guardar_insctructivo_dos($accion=null)
	{
		/* RECIBIR DATOS POST */
		$texto = $this->input->post($this->prefijo.'texto_instructivo');
		$id = $this->input->post('id');
		/* CARGAR DATOS A LA BD */
		$data = array($this->prefijo.'texto_instructivo' => $texto);
		$this->db->where($this->prefijo.'id', $id);         
		$this->db->update($this->tabla, $data);
		/* SIGUIENTE FUNCION */
		// redirect($this->controlador.'funcion/'.$id);
		
		if($accion=='editar')
		{
			redirect($this->controlador.'editar_preguntas_g1/'.$id);
		}
		else{
			redirect($this->controlador.'agregar_preguntas_g1/'.$id);
		}
	}
	function agregar_preguntas_g1($id)
	{
		$prefijoU=$this->prefijoU;
		$prefijo=$this->prefijo;
		$this->cabecera['accion']='Añadir Preguntas'; 
		$contenido['cabecera']=$this->cabecera;
		$contenido['id'] = $id;
		$contenido['action'] = $this->controlador.'agregar_preguntas_g1/'.$id;
		$contenido['editar']=0;
		$cantidad_preguntas=array(1,2,3,4,5,6,7,8);
		// $cantidad_preguntas=array(1);
		$contenido['array_p']=$cantidad_preguntas;
		$opciones = $this->input->post('enviar');
        if($opciones == 'Atras'){
            redirect($this->controlador.'gpregunta/'.$id);
        }elseif($opciones == 'Siguiente'){
			foreach($cantidad_preguntas as $value){
				$x=$value;
				$data1[$prefijo . 'id'] = $id;
                $data1[$prefijoU . 'nro'] = $x;
                $data1[$prefijoU . 'texto'] = $this->input->post($prefijoU.'texto'.$x);
                $data1[$prefijoU . 'resp_a'] = $this->input->post($prefijoU.'resp_a'.$x);
                $data1[$prefijoU . 'resp_b'] = $this->input->post($prefijoU.'resp_b'.$x);
                $data1[$prefijoU . 'resp_c'] = $this->input->post($prefijoU.'resp_c'.$x); 
                $inciso = $this->input->post($prefijoU.'correcta'.$x); 
                $data1[$prefijoU . 'resp_correcta'] = $inciso; 
                $data1[$prefijoU . 'valor_correcta'] = $this->input->post($prefijoU.'resp_'.$inciso.$x);
                $data1[$prefijoU.'fecha_edicion'] = date('Y-m-d H:i:s');
                if($this->input->post($prefijoU.'id'.$x)){
					echo $this->input->post($prefijoU.'id'.$x);
					echo 'editar';
                    /* $data1[$prefijoE . 'id'] = $this->input->post($prefijoE.'id'.$x);
                    $this->$modelo->editar_evaluacion_prueba_uno_plantilla($data1); */
				}else{    					
					$data1[$prefijoU.'fecha_creacion'] = date('Y-m-d H:i:s');					
					/* print_r($data1);   */
					$this->db->insert($this->tablaU, $data1);
					$idp=$this->db->insert_id();
				} 
			}
			// redirect($this->controlador.'funcion/'.$id);
			redirect($this->controlador.'agregar_preguntas_g2/'.$id);
		}
		$data['contenido'] = $this->load->view($this->carpeta.$this->formulario_preguntas, $contenido, true);
		$this->load->view('plantilla_privado',$data);	
	}

	function agregar_preguntas_g2($id)
	{
		$prefijoU=$this->prefijoU;
		$prefijo=$this->prefijo;
		$this->cabecera['accion']='Añadir Preguntas'; 
		$contenido['cabecera']=$this->cabecera;
		$contenido['id'] = $id;
		$contenido['action'] = $this->controlador.'agregar_preguntas_g2/'.$id;
		$contenido['editar']=0;
		$cantidad_preguntas=array(9,10,11,12,13,14,15);
		// $cantidad_preguntas=array(1,2,3);
		$contenido['array_p']=$cantidad_preguntas;
		$opciones = $this->input->post('enviar');
        if($opciones == 'Atras'){
            redirect($this->controlador.'gpregunta/'.$id);
        }elseif($opciones == 'Siguiente'){
			foreach($cantidad_preguntas as $value){
				$x=$value;
				$data1[$prefijo . 'id'] = $id;
                $data1[$prefijoU . 'nro'] = $x;
                $data1[$prefijoU . 'texto'] = $this->input->post($prefijoU.'texto'.$x);
                $data1[$prefijoU . 'resp_a'] = $this->input->post($prefijoU.'resp_a'.$x);
                $data1[$prefijoU . 'resp_b'] = $this->input->post($prefijoU.'resp_b'.$x);
                $data1[$prefijoU . 'resp_c'] = $this->input->post($prefijoU.'resp_c'.$x); 
				$inciso = $this->input->post($prefijoU.'correcta'.$x); 
                $data1[$prefijoU . 'resp_correcta'] = $inciso; 
                $data1[$prefijoU . 'valor_correcta'] = $this->input->post($prefijoU.'resp_'.$inciso.$x);				
                $data1[$prefijoU.'fecha_edicion'] = date('Y-m-d H:i:s');
                if($this->input->post($prefijoU.'id'.$x)){
					echo $this->input->post($prefijoU.'id'.$x);
					echo 'editar';
                    /* $data1[$prefijoE . 'id'] = $this->input->post($prefijoE.'id'.$x);
                    $this->$modelo->editar_evaluacion_prueba_uno_plantilla($data1); */
				}else{    					
					$data1[$prefijoU.'fecha_creacion'] = date('Y-m-d H:i:s');					
					/* print_r($data1);   */
					$this->db->insert($this->tablaU, $data1);
					$idp=$this->db->insert_id();
				} 
			}
			// redirect($this->controlador.'funcion/'.$id);
			redirect($this->controlador.'texto_despedida/'.$id);
		}
		$data['contenido'] = $this->load->view($this->carpeta.$this->formulario_preguntas, $contenido, true);
		$this->load->view('plantilla_privado',$data);	
	}
	function editar_preguntas_g1($id)
	{
		$prefijoU=$this->prefijoU;
		$prefijo=$this->prefijo;
		$this->cabecera['accion']='Editar Preguntas'; 
		$contenido['cabecera']=$this->cabecera;
		$contenido['id'] = $id;
		$contenido['action'] = $this->controlador.'editar_preguntas_g1/'.$id;
		$contenido['editar']=0;
		$cantidad_preguntas=array(1,2,3,4,5,6,7,8);
		// $cantidad_preguntas=array(1);
		$contenido['array_p']=$cantidad_preguntas;
		$opciones = $this->input->post('enviar');
        if($opciones == 'Atras'){
            redirect($this->controlador.'gpregunta/'.$id);
        }elseif($opciones == 'Siguiente'){
			foreach($cantidad_preguntas as $value){
				$x=$value;
				$idpr=$this->input->post($prefijoU.'id'.$x);
                $data1[$prefijoU . 'texto'] = $this->input->post($prefijoU.'texto'.$x);
                $data1[$prefijoU . 'resp_a'] = $this->input->post($prefijoU.'resp_a'.$x);
                $data1[$prefijoU . 'resp_b'] = $this->input->post($prefijoU.'resp_b'.$x);
                $data1[$prefijoU . 'resp_c'] = $this->input->post($prefijoU.'resp_c'.$x); 
                $inciso = $this->input->post($prefijoU.'correcta'.$x); 
                $data1[$prefijoU . 'resp_correcta'] = $inciso; 
                $data1[$prefijoU . 'valor_correcta'] = $this->input->post($prefijoU.'resp_'.$inciso.$x);
                $data1[$prefijoU.'fecha_edicion'] = date('Y-m-d H:i:s');
				$this->db->where($prefijoU.'id', $idpr);         
				$this->db->update('zis_plantilla_e_uno', $data1);
			}
			redirect($this->controlador.'editar_preguntas_g2/'.$id);
		}
		$preguntas = $this->db->query("SELECT * FROM
			".$this->tablaU."
			WHERE ".$this->prefijo."id=".$id." AND ".$this->prefijoU."nro between 1 and 8 order by ".$this->prefijoU."nro ASC")->result_array();
		if(!@$preguntas){redirect($this->controlador.'agregar_preguntas_g1/'.$id);}
		$fila=array();
		foreach($preguntas as $p){
			$p['a']='';
			$p['b']='';
			$p['c']='';
			switch($p[$prefijoU.'resp_correcta']){
				case 'a':
					$p['a']='checked';
				break;
				case 'b':
					$p['b']='checked';
				break;
				case 'c':
					$p['c']='checked';
				break;
			}
			array_push($fila, $p);
		}
		$contenido['fila']=$fila;
		$data['contenido'] = $this->load->view($this->carpeta.$this->formulario_preguntas, $contenido, true);
		$this->load->view('plantilla_privado',$data);	
	}
	function editar_preguntas_g2($id)
	{
		$prefijoU=$this->prefijoU;
		$prefijo=$this->prefijo;
		$this->cabecera['accion']='Editar Preguntas'; 
		$contenido['cabecera']=$this->cabecera;
		$contenido['id'] = $id;
		$contenido['action'] = $this->controlador.'editar_preguntas_g2/'.$id;
		$contenido['editar']=1;
		$cantidad_preguntas=array(9,10,11,12,13,14,15);
		// $cantidad_preguntas=array(1);
		$contenido['array_p']=$cantidad_preguntas;
		$opciones = $this->input->post('enviar');
        if($opciones == 'Atras'){
            redirect($this->controlador.'gpregunta/'.$id);
        }elseif($opciones == 'Guardar'){
			foreach($cantidad_preguntas as $value){
				$x=$value;
				$idpr=$this->input->post($prefijoU.'id'.$x);
                $data1[$prefijoU . 'texto'] = $this->input->post($prefijoU.'texto'.$x);
                $data1[$prefijoU . 'resp_a'] = $this->input->post($prefijoU.'resp_a'.$x);
                $data1[$prefijoU . 'resp_b'] = $this->input->post($prefijoU.'resp_b'.$x);
                $data1[$prefijoU . 'resp_c'] = $this->input->post($prefijoU.'resp_c'.$x); 
                $inciso = $this->input->post($prefijoU.'correcta'.$x); 
                $data1[$prefijoU . 'resp_correcta'] = $inciso; 
                $data1[$prefijoU . 'valor_correcta'] = $this->input->post($prefijoU.'resp_'.$inciso.$x);
                $data1[$prefijoU.'fecha_edicion'] = date('Y-m-d H:i:s');
				$this->db->where($prefijoU.'id', $idpr);         
				$this->db->update('zis_plantilla_e_uno', $data1);
			}
			redirect($this->controlador.'editar_plantilla/'.$id);
		}
		$preguntas = $this->db->query("SELECT * FROM
			".$this->tablaU."
			WHERE ".$this->prefijo."id=".$id." AND ".$this->prefijoU."nro between 9 and 15 order by ".$this->prefijoU."nro ASC")->result_array();
		if(!@$preguntas){redirect($this->controlador.'agregar_preguntas_g2/'.$id);}
		$fila=array();
		foreach($preguntas as $p){
			$p['a']='';
			$p['b']='';
			$p['c']='';
			switch($p[$prefijoU.'resp_correcta']){
				case 'a':
					$p['a']='checked';
				break;
				case 'b':
					$p['b']='checked';
				break;
				case 'c':
					$p['c']='checked';
				break;
			}
			array_push($fila, $p);
		}
		$contenido['fila']=$fila;
		$data['contenido'] = $this->load->view($this->carpeta.$this->formulario_preguntas, $contenido, true);
		$this->load->view('plantilla_privado',$data);	
	}
	function texto_despedida($id)
	{
		$this->cabecera['accion']='Texto Despedida'; 
		$contenido['cabecera']=$this->cabecera;
		$contenido['id'] = $id;
		$contenido['tipo'] = 1;
		$contenido['action'] = $this->controlador.'guardar_texto_despedida';
		$contenido['campo'] = 'texto_despedida';
		$contenido['texto'] = '';
		$contenido['boton'] = 'Siguiente';
		$data['contenido'] = $this->load->view($this->carpeta.$this->formulario_texto, $contenido, true);
		$this->load->view('plantilla_privado',$data);
	}
	function editar_texto_despedida($id)
	{
		$plantilla = $this->db->query("SELECT zpla_texto_despedida as texto FROM zis_plantillas
		WHERE zpla_id=$id")->row();
		$this->cabecera['accion']='Editar Texto Despedida'; 
		$contenido['cabecera']=$this->cabecera;
		$contenido['id'] = $id;
		$contenido['tipo'] = 1;
		$contenido['action'] = $this->controlador.'guardar_texto_despedida';
		$contenido['campo'] = 'texto_despedida';
		$contenido['texto'] = $plantilla->texto;
		$contenido['boton'] = 'Guardar';
		$data['contenido'] = $this->load->view($this->carpeta.$this->formulario_texto, $contenido, true);
		$this->load->view('plantilla_privado',$data);
	}
	function guardar_texto_despedida()
	{
		/* RECIBIR DATOS POST */
		$texto = $this->input->post($this->prefijo.'texto_despedida');
		$id = $this->input->post('id');
		/* CARGAR DATOS A LA BD */
		$data = array($this->prefijo.'texto_despedida' => $texto);
		$this->db->where($this->prefijo.'id', $id);         
		$this->db->update($this->tabla, $data);
		/* SIGUIENTE FUNCION */
		// redirect($this->controlador.'funcion/'.$id);
		redirect($this->controlador.'agregar_tabla/'.$id);
	}
	function agregar_tabla($id)
	{
		$prefijoT=$this->prefijoT;
		$prefijo=$this->prefijo;
		$this->cabecera['accion']='Tabla de Equivalencias'; 
		$contenido['cabecera']=$this->cabecera;
		$contenido['id'] = $id;
		$contenido['action'] = $this->controlador.'agregar_tabla/'.$id;
		$contenido['prefijoT']=$this->prefijoT;
		$contenido['editar']=0;
		$array_tabla=array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15);
		$contenido['array_tabla']=$array_tabla;
		$opciones = $this->input->post('enviar');
        if($opciones == 'Atras'){
            redirect($this->controlador.'gpregunta/'.$id);
        }elseif($opciones == 'Guardar y finalizar'){
			$val=array(1=>'',2=>'',3=>'',4=>'',5=>'',6=>'',7=>'',8=>'',9=>'',10=>'');
			foreach($array_tabla as $value){
				$x=$value;
				$aux=$this->input->post('nro'.$x);
				$nro=strval($this->input->post('nro'.$x));
				switch($this->input->post($prefijoT.$x)){
					case 1:
						$val[1]=$val[1].$nro.',';
					break;
					case 2:
						$val[2]=$val[2].$nro.',';
					break;
					case 3:
						$val[3]=$val[3].$nro.',';
					break;
					case 4:
						$val[4]=$val[4].$nro.',';
					break;
					case 5:
						$val[5]=$val[5].$nro.',';
					break;
					case 6:
						$val[6]=$val[6].$nro.',';
					break;
					case 7:
						$val[7]=$val[7].$nro.',';
					break;
					case 8:
						$val[8]=$val[8].$nro.',';
					break;
					case 9:
						$val[9]=$val[9].$nro.',';
					break;
					case 10:
						$val[10]=$val[10].$nro.',';
					break;
					default:
					break;
				}
				
			}
			$data1[$prefijo . 'id'] = $id;			
			for($i=1;$i<=10;$i++)
			{
				$data1[$prefijoT . $i] = $val[$i];
            }
			$data1[$prefijoT.'fecha_edicion'] = date('Y-m-d H:i:s');
            if($this->input->post($prefijoT.'id'.$x)){
					echo $this->input->post($prefijoT.'id'.$x);
					echo 'editar';
                    /* $data1[$prefijoE . 'id'] = $this->input->post($prefijoE.'id'.$x);
                    $this->$modelo->editar_evaluacion_prueba_uno_plantilla($data1); */
			}else{    					
				$data1[$prefijoT.'fecha_creacion'] = date('Y-m-d H:i:s');					
				print_r($data1);         
				$this->db->insert($this->tablaT, $data1);
				$idp=$this->db->insert_id();
                echo $idp;
				redirect($this->controlador2.'listar');
				exit();
				} 
		}
		$data['contenido'] = $this->load->view($this->carpeta.'tabla', $contenido, true);
		$this->load->view('plantilla_privado',$data);	
	}
	function editar_baremo($id)
	{
		$prefijoT=$this->prefijoT;
		$prefijo=$this->prefijo;
		$this->cabecera['accion']='Editar Tabla de Equivalencias'; 
		$contenido['cabecera']=$this->cabecera;
		$contenido['id'] = $id;
		$contenido['action'] = $this->controlador.'editar_baremo/'.$id;
		$contenido['prefijoT']=$this->prefijoT;
		$contenido['editar']=1;
		$array_tabla=array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15);
		$contenido['array_tabla']=$array_tabla;
		$opciones = $this->input->post('enviar');
        if($opciones == 'Guardar'){
			$val=array(1=>'',2=>'',3=>'',4=>'',5=>'',6=>'',7=>'',8=>'',9=>'',10=>'');
			foreach($array_tabla as $value){
				$x=$value;
				$aux=$this->input->post('nro'.$x);
				$nro=strval($this->input->post('nro'.$x));
				switch($this->input->post($prefijoT.$x)){
					case 1:
						$val[1]=$val[1].$nro.',';
					break;
					case 2:
						$val[2]=$val[2].$nro.',';
					break;
					case 3:
						$val[3]=$val[3].$nro.',';
					break;
					case 4:
						$val[4]=$val[4].$nro.',';
					break;
					case 5:
						$val[5]=$val[5].$nro.',';
					break;
					case 6:
						$val[6]=$val[6].$nro.',';
					break;
					case 7:
						$val[7]=$val[7].$nro.',';
					break;
					case 8:
						$val[8]=$val[8].$nro.',';
					break;
					case 9:
						$val[9]=$val[9].$nro.',';
					break;
					case 10:
						$val[10]=$val[10].$nro.',';
					break;
					default:
					break;
				}
				
			}
			$data1[$prefijo . 'id'] = $id;			
			for($i=1;$i<=10;$i++)
			{
				$data1[$prefijoT . $i] = $val[$i];
            }
			$data1[$prefijoT.'fecha_edicion'] = date('Y-m-d H:i:s');
			$this->db->where($this->prefijo.'id', $id);         
			$this->db->update($this->tablaT, $data1);
			redirect($this->controlador2.'listar');
		}
		$tabla = $this->db->query("SELECT * FROM
			".$this->tablaT."
			WHERE ".$this->prefijo."id=".$id." ")->result_array();
		if(!@$tabla){redirect($this->controlador.'agregar_tabla/'.$id);}
		$baremo=$this->invertirBaremo($tabla);
		// print_r($baremo);
		$contenido['fila']=$baremo;
		$data['contenido'] = $this->load->view($this->carpeta.'tabla', $contenido, true);
		$this->load->view('plantilla_privado',$data);	
	}
	
	function invertirBaremo($tabla)
	{
		$baremo='';
		for($i=1;$i<=10;$i++){
			$aux = explode( ',', $tabla[0]['t_uno_'.$i] );
			array_pop($aux);
			foreach($aux as $valueb){
				$baremo = $baremo . $i .',';
			}
			
		}
		$aux2 = explode( ',', $baremo );
		array_pop($aux2);
		return $aux2;
	}
	//preguntas de pruebas

	function vista_pregunta_prueba($id)
	{
		// $id=$this->input->post('id');
		$consulta = $this->db->query("SELECT * FROM
			".$this->tabla."
			WHERE zpla_id=$id");
		$datos=$consulta->result_array();
		$consulta2 = $this->db->query("SELECT * FROM
			".$this->tablaE."
			WHERE zpla_id=$id LIMIT 1");
		$datos2=$consulta2->result_array();
		// var_dump($datos);exit();
		// $this->cabecera['accion']=$datos[0]['zpla_titulo']; 
		$this->cabecera['accion']='Pregunta de prueba'; 
		$this->cabecera['titulo']='Plantilla'; 
		$contenido['cabecera']=$this->cabecera;
		$contenido['datos2'] = $datos2[0];
		$contenido['id'] = $id;
		$data['contenido'] = $this->load->view($this->carpeta.'vista_preguntas_de_prueba', $contenido, true);
		$this->load->view('plantilla_privado',$data);

	}
	function vista_instructivo_plantilla_uno($id)
	{
		// $id=$this->input->post('id');
		$consulta = $this->db->query("SELECT * FROM
			".$this->tabla."
			WHERE " .$this->prefijo. "id=".$id);
		$datos=$consulta->result_array();
			//var_dump($datos);exit();
		$this->cabecera['accion']=$datos[0][$this->prefijo.'titulo']; 
		$contenido['accion']=$this->controlador.'vista_preguntas_g1/'.$id;
		$contenido['cabecera']=$this->cabecera;
		$contenido['contenido'] = $datos[0][$this->prefijo.'texto_instructivo'];
		$contenido['id'] = $id;
		$data['contenido'] = $this->load->view('plantilla/text_instructivo_dos', $contenido, true);
		$this->load->view('plantilla_privado',$data);

	}
	//preguntas
	function vista_preguntas_g1($id)
	{
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
		$this->cabecera['titulo']='Plantilla'; 
		$contenido['enlace']=  $this->tool_entidad->sitio().'admin.php/'.$this->controlador.'vista_preguntas_g2/'.$id;
		$contenido['cabecera']=$this->cabecera;
		$contenido['datos2'] = $datos2;
		$contenido['id'] = $id;
		$data['contenido'] = $this->load->view($this->carpeta.'vista_preguntas', $contenido, true);
		$this->load->view('plantilla_privado',$data);

	}
	function vista_preguntas_g2($id)
	{
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
		$this->cabecera['titulo']='Plantilla'; 
		$contenido['enlace']=  $this->tool_entidad->sitio().'admin.php/'.$this->controlador2.'texto_despedida/'.$id;
		$contenido['cabecera']=$this->cabecera;
		$contenido['datos2'] = $datos2;
		$contenido['id'] = $id;
		$data['contenido'] = $this->load->view($this->carpeta.'vista_preguntas', $contenido, true);
		$this->load->view('plantilla_privado',$data);

	}
	function informe_pdf($idpos=null,$idgrupo=null,$ideval=null)
	{	
		$datos_query=$this->db->query("SELECT p.*,YEAR(f.pof_fecha_nacimiento) as fecha_nac, f.pof_sexo as sexo FROM postulante p
			JOIN
			postulante_f f
			on p.pos_id=f.pos_id
			WHERE p.pos_id='$idpos'")->row();
		$datos_evaluacion = $this->db->query("SELECT * FROM zis_evaluacion
		WHERE eva_id=$ideval")->row();  
		$pla_id=$datos_evaluacion->zpla_id;
		$datos_puntaje = $this->db->query("SELECT seg_id, seg_resp_puntaje, seg_bare_puntaje FROM zis_seguimiento
		WHERE pos_id=$idpos AND gru_id=$idgrupo AND eva_id=$ideval")->row();  
		if($datos_puntaje->seg_resp_puntaje==0 && $datos_puntaje->seg_bare_puntaje==0){
			$datos_puntaje=$this->obtener_puntaje($idpos,$idgrupo,$ideval,$datos_puntaje->seg_id,$pla_id);
			$notap=$datos_puntaje['seg_resp_puntaje'];
			$notab=$datos_puntaje['seg_bare_puntaje'];
		}
		else{
			$notap=$datos_puntaje->seg_resp_puntaje;
			$notab=$datos_puntaje->seg_bare_puntaje;
		}
		if($notab<4){
			$polo='Bajo';
		}
		else{
			if($notab>7)
			{
				$polo='Alto';
			}
			else{
				$polo='Medio';
			}
		}
		
		date_default_timezone_set('America/La_Paz');
		$anio_actual=date('Y'); 
		$edad=$anio_actual-$datos_query->fecha_nac;
		$data['edad'] = $edad;
		if($datos_query->sexo==2){$sexo='M';}else{$sexo='F';}
		$data['sexo'] = $sexo;
		$data['valor_b'] = $notab;
		$data['polo'] = $polo;
		$data['fecha_reporte']=date('d').'/'.date('m').'/'.date('Y'); 
		$data['postulante_datos']=$datos_query;
		$data['logo']=$this->tool_entidad->sitiopri().'files/pdf/logo_etikaPdf.jpg';

		//de js a imagen
    
	    // $fecha_actual_reporte = new DateTime();
	    // $nombre_archivo = $fecha_actual_reporte->format("dmYhis");
	    // $id_usuario_reporte=$_SESSION[$this->presession.'id'];
	    // $nombre_archivo=$id_usuario_reporte.$nombre_archivo.'.png';
	    // var_dump($nombre_archivo);exit();
	    // $url_archivo='https://quickchart.io/chart?h=100&c={type:%20%27horizontalBar%27,data:%20{datasets:%20[{label:%20%27%27,backgroundColor:%20%27rgba(236,%20103,%2059,%201)%27,data:%20['.$notab.',0,10]}]},%20%20options:%20{elements:%20{%20%20rectangle:%20{%27borderWidth%27:%200%20%20}},responsive:%20true,legend:%20{%20%20display:%20false,},title:%20{%20%20display:%20false,%20%20text:%20%27hola%27}%20%20}}';
	    // $imagen_generada = $this->file_get_contents_curl($url_archivo); 
	    // $imagen_generada = $this->file_get_contents_curl('https://media.geeksforgeeks.org/wp-content/uploads/geeksforgeeks-6-1.png'); 
	    // $ruta_archivo = './archivos/reporte_imagenes/'.$nombre_archivo;
	    // // var_dump($ruta_archivo);exit();
	    // $ruta_archivo_grafico = 'archivos/reporte_imagenes/'.$nombre_archivo;
	  
	    // file_put_contents( $ruta_archivo, $imagen_generada );

	    // $data['ruta_grafico']=$ruta_archivo_grafico;
	    //image js
	    $nombre_archivo_pdf=$datos_query->pos_documento.'.pdf';
		$this->load->view($this->carpeta.'informe_pdf_js',$data);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html,'UTF-8');
		$this->dompdf->set_option('isRemoteEnabled', TRUE);   
		$this->dompdf->setPaper('letter', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream($nombre_archivo_pdf, array("Attachment"=>0));
	}


	function file_get_contents_curl($url) {
	    $ch = curl_init();
	  
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_URL, $url);
	  
	    $data = curl_exec($ch);
	    curl_close($ch);
	  
	    return $data;
	}

	function informe_pdf_html($idpos=null,$idgrupo=null,$ideval=null)
	{	
		$datos_query=$this->db->query("SELECT p.*,YEAR(f.pof_fecha_nacimiento) as fecha_nac, f.pof_sexo as sexo FROM postulante p
			JOIN
			postulante_f f
			on p.pos_id=f.pos_id
			WHERE p.pos_id='$idpos'")->row();
		$datos_evaluacion = $this->db->query("SELECT * FROM zis_evaluacion
		WHERE eva_id=$ideval")->row();  
		$pla_id=$datos_evaluacion->zpla_id;
		$datos_puntaje = $this->db->query("SELECT seg_id, seg_resp_puntaje, seg_bare_puntaje FROM zis_seguimiento
		WHERE pos_id=$idpos AND gru_id=$idgrupo AND eva_id=$ideval")->row();  
		if($datos_puntaje->seg_resp_puntaje==0 && $datos_puntaje->seg_bare_puntaje==0){
			$datos_puntaje=$this->obtener_puntaje($idpos,$idgrupo,$ideval,$datos_puntaje->seg_id,$pla_id);
			$notap=$datos_puntaje['seg_resp_puntaje'];
			$notab=$datos_puntaje['seg_bare_puntaje'];
		}
		else{
			$notap=$datos_puntaje->seg_resp_puntaje;
			$notab=$datos_puntaje->seg_bare_puntaje;
		}
		if($notab<4){
			$polo='Bajo';
		}
		else{
			if($notab>7)
			{
				$polo='Alto';
			}
			else{
				$polo='Medio';
			}
		}
		
		date_default_timezone_set('America/La_Paz');
		$anio_actual=date('Y'); 
		$edad=$anio_actual-$datos_query->fecha_nac;
		$data['edad'] = $edad;
		if($datos_query->sexo==2){$sexo='M';}else{$sexo='F';}
		$data['sexo'] = $sexo;
		$data['valor_b'] = $notab;
		$data['polo'] = $polo;
		$data['fecha_reporte']=date('d').'/'.date('m').'/'.date('Y'); 
		$data['postulante_datos']=$datos_query;
		$data['logo']=$this->tool_entidad->sitiopri().'files/pdf/logo_etikaPdf.jpg';
		$this->load->view($this->carpeta.'informe_pdf_html',$data);
		// $html = $this->output->get_output();
		// $this->load->library('pdf');
		// $this->dompdf->loadHtml($html,'UTF-8');
		// $this->dompdf->set_option('isRemoteEnabled', TRUE);   
		// $this->dompdf->setPaper('letter', 'portrait');
		// $this->dompdf->render();
		// $this->dompdf->stream("listado_.pdf", array("Attachment"=>0));
	}

	function ver_respuestas_s($idpos=null,$idgrupo=null,$ideval=null)
	{
		$datos_postulante = $this->db->query("SELECT pos_apaterno as paterno, pos_amaterno as materno, pos_nombre as nombre FROM postulante
		WHERE pos_id=$idpos")->row();  
		$nombres=$datos_postulante->paterno.' '.$datos_postulante->materno.' '.$datos_postulante->nombre;
		$datos_evaluacion = $this->db->query("SELECT * FROM zis_evaluacion
		WHERE eva_id=$ideval")->row();  
		$pla_id=$datos_evaluacion->zpla_id;
		$datos_puntaje = $this->db->query("SELECT seg_id, seg_resp_puntaje, seg_bare_puntaje FROM zis_seguimiento
		WHERE pos_id=$idpos AND gru_id=$idgrupo AND eva_id=$ideval")->row();  
		if($datos_puntaje->seg_resp_puntaje==0 && $datos_puntaje->seg_bare_puntaje==0){
			$datos_puntaje=$this->obtener_puntaje($idpos,$idgrupo,$ideval,$datos_puntaje->seg_id,$pla_id);
			$notap=$datos_puntaje['seg_resp_puntaje'];
			$notab=$datos_puntaje['seg_bare_puntaje'];
		}
		else{
			$notap=$datos_puntaje->seg_resp_puntaje;
			$notab=$datos_puntaje->seg_bare_puntaje;
		}
		$consulta = $this->db->query("SELECT p.".$this->prefijoU."id as preg_id, p.".$this->prefijoU."nro as nro, ".$this->prefijoU."texto as pregunta, r.res_respuesta as respuesta FROM (SELECT * FROM zis_plantilla_e_uno
		WHERE zpla_id=$pla_id ORDER BY pre_uno_id asc) p
		JOIN
		(SELECT * FROM zis_respuestas_uno
		where pos_id=$idpos and gru_id=$idgrupo and eva_id=$ideval ORDER BY pre_uno_id asc) r
		on p.pre_uno_id=r.pre_uno_id");
		$datos=$consulta->result_array();
		// print_r($datos);
		$this->cabecera['accion']='Listado';     
        $contenido['cabecera']=$this->cabecera;
		$contenido['datos'] =$datos;
		$contenido['nombre_eval'] =$datos_evaluacion->eva_titulo;
		$contenido['nombres'] = $nombres;
		$contenido['notap'] = $notap;
		$contenido['notab'] = $notab;
		$contenido['id_grupo'] = $idgrupo;
		$contenido['idpos'] =$idpos;
		$data['contenido'] = $this->load->view($this->carpeta.'vista_respuestas_s', $contenido, true);
		$this->load->view('plantilla_privado',$data);
	}
	function obtener_puntaje($idpos=null,$idgrupo=null,$ideval=null,$idseg=null,$idpla=null)
	{
		$consulta = $this->db->query("SELECT * FROM zis_plantilla_e_uno WHERE zpla_id=$idpla ORDER BY pre_uno_id ASC LIMIT 15");
		$datos=$consulta->result_array();
		$consulta2 = $this->db->query("SELECT * FROM zis_respuestas_uno WHERE pos_id=$idpos AND eva_id=$ideval AND gru_id=$idgrupo ORDER BY pre_uno_id ASC LIMIT 15");
		$datos2=$consulta2->result_array();
		$nota=0;
		for($i=0;$i<15;$i++){
			$ind=$datos[$i]['pre_uno_resp_correcta'];
			$resp_c=$datos[$i]['pre_uno_resp_'.$ind];
			$res_p=$datos2[$i]['res_respuesta'];
			if($resp_c==$res_p){
				$nota++;
			}
		}
		$consulta3 = $this->db->query("SELECT * FROM zis_tabla_plantilla_uno WHERE zpla_id=$idpla");
		$datos3=$consulta3->first_row('array');
		$j=1;
		do{
			if(@$datos3['t_uno_'.$j]){
				$valores = explode(",", $datos3['t_uno_'.$j]);
				foreach($valores as $val){
					if($val==$nota){
						$notab=$j;
						$j=11;
					}
				}
				
			}
			$j++;
		}while(($j<11));
		$filaS['seg_resp_puntaje'] = $nota;
		$filaS['seg_bare_puntaje'] = $notab;
		$this->db->where('seg_id', $idseg);         
		$this->db->update('zis_seguimiento', $filaS);
		return $filaS;
	}
	function reporte($idpla=null,$desde=null,$hasta=null)
	{
		// $idpla=31;
		// $desde='2021-07-13';
		// $hasta='2021-07-31';
		$consulta = $this->db->query("SELECT e.eva_id, e.gru_id, pl.zpla_titulo FROM zis_evaluacion e JOIN zis_plantillas pl on e.zpla_id=pl.zpla_id WHERE pl.zpla_id=$idpla ORDER BY e.eva_id ASC");
		$evaluaciones=$consulta->result_array();
		$contenido['titulo_platilla']='-';
		// print_r($evaluaciones);
		if(@$evaluaciones){
			$contenido['titulo_platilla']=$evaluaciones[0]['zpla_titulo'];
			$cevaluaciones=count($evaluaciones);
			for($i=0;$i<$cevaluaciones;$i++){
				$idev=$evaluaciones[$i]['eva_id'];
				$idgru=$evaluaciones[$i]['gru_id'];
				$consulta2 = $this->db->query("SELECT seg_id, pos_id, gru_id, eva_id, seg_intentos, seg_tiempo_total, seg_resp_puntaje as punf, seg_bare_puntaje punb FROM zis_seguimiento WHERE eva_id=$idev AND gru_id=$idgru   AND  DATE(seg_fecha_inicio) between '".$desde."' AND '".$hasta."' AND seg_termino =1 ORDER BY seg_id ASC");
				$evaluados[$i]=$consulta2->result_array();
			}
			$evaluado2=array();
			foreach($evaluados as $evd){
				$cevd=count($evd);
				for($i=0;$i<$cevd;$i++){
					$idev=$evd[$i]['eva_id'];
					$idgru=$evd[$i]['gru_id'];
					$idpos=$evd[$i]['pos_id'];
					$consulta3 = $this->db->query("SELECT p.*,YEAR(NOW())-YEAR(f.pof_fecha_nacimiento) as edad, CASE WHEN f.pof_sexo =1 THEN 'M' ELSE 'F' END as sexo, pof_lugar_estudios FROM postulante p JOIN postulante_f f on p.pos_id=f.pos_id WHERE p.pos_id='$idpos'");
					$postd=$consulta3->first_row('array');
					$evd[$i]['nombres']=$postd['pos_nombre'];
					$evd[$i]['apellidos']=$postd['pos_apaterno'].' '.$postd['pos_amaterno'];
					$evd[$i]['sexo']=$postd['sexo'];
					$evd[$i]['edad']=$postd['edad'];
					$evd[$i]['lugar_estudios']=$postd['pof_lugar_estudios'];
					$consulta4 = $this->db->query("SELECT com_nombre FROM educacion_superior e INNER JOIN combos c ON e.edu_area=c.com_id AND e.pos_id=$idpos AND e.edu_profesion_ejercida=1");
					$edu=$consulta4->first_row('array');
					$evd[$i]['profesion']=$edu['com_nombre'];
					$consulta5 = $this->db->query("SELECT pre_uno_id, res_respuesta FROM zis_respuestas_uno WHERE eva_id=$idev AND gru_id=$idgru AND pos_id=$idpos ORDER BY res_uno_id ASC");
					$respuestas=$consulta5->result_array();
					$cresp=count($respuestas);
					for($j=0;$j<$cresp;$j++){
						$k=$respuestas[$j]['pre_uno_id'];
						$evd[$i]['res_respuesta_'.$k]=$respuestas[$j]['res_respuesta'];
					}
				}
				array_push($evaluado2,$evd);
			}
			//print_r($evd2);
			// print_r($evaluado2);
		}
		$_SESSION["evaluados"]=$evaluado2;
		$contenido['evaluados']=$evaluado2;     
		$this->cabecera['titulo']='Reportes';     
		$this->cabecera['accion']='Plantilla';     
        $contenido['desde']=$desde;
        $contenido['hasta']=$hasta;
        $contenido['cabecera']=$this->cabecera;
		$data['contenido'] = $this->load->view($this->carpeta.'vista_reporte', $contenido, true);
		$this->load->view('plantilla_privado',$data);
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
        // header('Content-type: application/vnd.ms-excel');
		header("Content-Type:   application/vnd.ms-excel; charset=utf-16");
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
							echo "<td>".@$evd['res_respuesta_14']."</td> ";
							echo "<td>".@$evd['res_respuesta_15']."</td> ";
							echo "<td>".$evd['punf']."</td>";
							echo "<td>".$evd['punb']."</td>";
						echo "</tr>";
						
					}
				}
			}
			echo "</table> ";
    }
	function editar_plantilla($id=null)
    {
		$campos=array();
		$fila1 = array('titulo' => 'Título','enlace' => 'editar_titulo/');
		$fila2 = array('titulo' => 'Texto Bienvenida','enlace' => 'editar_texto_bienvenida/');
		$fila3 = array('titulo' => 'Texto Prueba','enlace' => 'texto_prueba/');
		$fila4 = array('titulo' => 'Preguntas Prueba','enlace' => 'editar_pregunta_prueba/');
		$fila5= array('titulo' => 'Texto Instructivo','enlace' => 'editar_instructivo_dos/');
		$fila6= array('titulo' => 'Preguntas','enlace' => 'editar_preguntas_g1/');
		$fila7= array('titulo' => 'Texto Despedida','enlace' => 'editar_texto_despedida/');
		array_push($campos,$fila1,$fila2,$fila3,$fila4,$fila5,$fila6,$fila7);
		// print_r($campos);
		$this->cabecera['titulo']='Reportes';     
		$this->cabecera['accion']='Plantilla';     
        $contenido['cabecera']=$this->cabecera;
		$contenido['id']=$id;
		$contenido['datos']=$campos;
		$data['contenido'] = $this->load->view($this->carpeta.'listar_editar', $contenido, true);
		$this->load->view('plantilla_privado',$data);
	}
	function editar_texto_bienvenida($id)
	{
		$plantilla = $this->db->query("SELECT zpla_texto_bienvenida as texto FROM zis_plantillas
		WHERE zpla_id=$id")->row();
		$this->cabecera['accion']='Editar Texto Bienvenida'; 
		$contenido['cabecera']=$this->cabecera;
		$contenido['id'] = $id;
		$contenido['tipo'] = 1;
		$contenido['action'] = $this->controlador.'guardar_texto_bienvenida/';
		$contenido['campo'] = 'texto_bienvenida';
		$contenido['texto'] = $plantilla->texto;
		$contenido['boton'] = 'Guardar';
		$data['contenido'] = $this->load->view($this->carpeta.$this->formulario_texto, $contenido, true);
		$this->load->view('plantilla_privado',$data);
	}
	function guardar_texto_bienvenida()
	{
		/* RECIBIR DATOS POST */
		$texto = $this->input->post($this->prefijo.'texto_bienvenida');
		$id = $this->input->post('id');
		/* CARGAR DATOS A LA BD */
		$data = array($this->prefijo.'texto_bienvenida' => $texto);
		$this->db->where($this->prefijo.'id', $id);         
		$this->db->update($this->tabla, $data);
		/* SIGUIENTE FUNCION */
		// redirect($this->controlador.'funcion/'.$id);
		redirect($this->controlador.'editar_plantilla/'.$id);
	}
	function editar_titulo($id)
	{
		$plantilla = $this->db->query("SELECT zpla_titulo as texto FROM zis_plantillas
		WHERE zpla_id=$id")->row();
		$this->cabecera['accion']='Editar Título'; 
		$contenido['cabecera']=$this->cabecera;
		$contenido['id'] = $id;
		$contenido['tipo'] = 1;
		$contenido['valor_texto'] = $plantilla->texto;
		$contenido['action'] = $this->controlador.'guardar_titulo';
		$data['contenido'] = $this->load->view($this->carpeta.'editar_titulo', $contenido, true);
		$this->load->view('plantilla_privado',$data);
	}
	function guardar_titulo()
	{
		/* RECIBIR DATOS POST */
		$texto = $this->input->post($this->prefijo.'titulo');
		$id = $this->input->post('id');
		/* CARGAR DATOS A LA BD */
		$data = array($this->prefijo.'titulo' => $texto);
		$this->db->where($this->prefijo.'id', $id);         
		$this->db->update($this->tabla, $data);
		/* SIGUIENTE FUNCION */
		// redirect($this->controlador.'funcion/'.$id);
		redirect($this->controlador.'editar_plantilla/'.$id);
	}
	
	function eliminar_plantilla($idpla=null)
	{
		$consulta_e = $this->db->query("SELECT * FROM zis_evaluacion
			WHERE zpla_id=$idpla");
		if (!$consulta_e->num_rows()>0) {
			//Elimina registro tabla baremo uno
			$this->db->where('zpla_id',$idpla);            
			$this->db->delete('zis_tabla_plantilla_uno');
			//Elimina registro pregunta prueba uno
			$this->db->where('zpla_id',$idpla);            
			$this->db->delete('zis_plantilla_p_uno');
			//Elimina registro preguntas uno
			$this->db->where('zpla_id',$idpla);            
			$this->db->delete('zis_plantilla_e_uno');
			//Elimina registro plantillas
			$this->db->where('zpla_id',$idpla);            
			$this->db->delete('zis_plantillas');
		}
		redirect('Plantilla/listar');
	}
	
	function funcion($idpos=null,$idgrupo=null,$ideval=null)
	{
		echo 'guardo';
	}
}


?>