<?php
require_once('Controladoradmin.php');

class Evaluacion extends Controladoradmin {

    function __construct() {
        parent::__construct();
        force_ssl();
        $this->load->helper(array('url', 'form'));
        $this->load->library('Form_validation');

        $this->load->helper('html');
        $this->load->library('Tool_general');

//****** definiendo la tabla por defecto y prefijo si lo tuviera
        $this->tabla = 'postulante';
        $this->tablaF = 'postulante_f';
        $this->tablaG = 'zis_grupo_evaluacion';
        $this->tablaE = 'zis_evaluacion';
        $this->tablaP = 'zis_plantillas';
        $this->tablaS = 'zis_seguimiento';
        $this->tablaES = 'educacion_superior';
        $this->tablaC = 'combos';
        $this->prefijo = 'pos_';
        $this->prefijoF = 'pof_';
        $this->prefijoG = 'gru_';
        $this->prefijoE = 'eva_';
        $this->prefijoP = 'zpla_';
        $this->prefijoES = 'edu_';
        $this->prefijoC = 'com_';
        $this->prefijoS = 'seg_';
//******* definiendo campos de la tabla                  
//****** definiendo nombre de carpeta por defecto
        $this->carpeta = 'evaluacion/';
        $this->controlador = 'Evaluacion/';
        $this->controlador1 = 'Prueba_uno/';
        $this->controlador2 = 'Prueba_dos/';
        $this->controlador4 = 'Prueba_cuatro/'; //Evaluacion CARPETA

        $this->cabecera['titulo'] = 'Sistema de Evaluación';
        $this->cabecera['accion'] = '';
        $this->presession = $this->tool_entidad->presession();
        session_start();
        if (!isset($_SESSION[$this->presession . 'usuario'])) {
            redirect(base_url() . index_page());
        }
    }

    function principal() {
		$uri = $this->uri->uri_to_assoc(3);
        $idgrupo = $uri['idg'];
        $idev = $uri['ev'];
        $tipo = $uri['tip'];
		$id=$_SESSION[$this->presession . 'id'];
		$consultaDatos = $this->db->query('SELECT * FROM zis_seguimiento WHERE pos_id='.$id.' AND gru_id='.$idgrupo);
		$seguimientoDatos = $consultaDatos->first_row('array');
		if(@$seguimientoDatos){
			if($tipo==4){
			redirect($this->controlador4 .'carpeta/idg/'.$idgrupo.'/ev/'.$idev);
			}
			else{
				redirect($this->controlador .'inicio_prueba/idg/'.$idgrupo.'/ev/'.$idev);
			}
		}
		$consulta = $this->db->query('
			SELECT p.pos_id,pos_nombre, pos_apaterno, pos_amaterno,	pof_lugar_estudios, pof_fecha_nacimiento
			FROM postulante  p
            inner join postulante_f pf
            on p.pos_id=pf.pos_id
            WHERE p.pos_id=' . $id);
//        $id;
        $fila = $consulta->first_row('array');
		$consulta2 = $this->db->query('
        SELECT c.'.$this->prefijoC.'id, c.'.$this->prefijoC.'nombre, e.'.$this->prefijoES.'profesion_ejercida 
		FROM '.$this->tablaES.'  e
        inner join '.$this->tablaC.' c
               on e.'.$this->prefijoES.'area=c.com_id
               WHERE e.pos_id='.$id.' AND c.'.$this->prefijoC.'tipo=3');
        $profesion = $consulta2->result_array();
		$contenido['profesionNuevo'] = 0;
		if(!$profesion){
			$consulta3 = $this->db->query('
			SELECT '.$this->prefijoC.'id, '.$this->prefijoC.'nombre
			FROM '.$this->tablaC.'
				   WHERE '.$this->prefijoC.'tipo=3');

	//        $id;
			$profesion = $consulta3->result_array();
			$contenido['profesionNuevo'] = 1;
		}
		
        $lugares = array('La Paz','Santa Cruz','Cochabamba','Oruro','Chuquisaca','Tarija','Beni','Pando','Potosí','Otro país fuera de Bolivia');
		$this->cabecera['accion'] = 'Editar datos personales';
        $contenido['cabecera'] = $this->cabecera;
		$contenido['action'] = $this->controlador . 'guardar_editar_datospersonal/idg/'.$idgrupo.'/ev/'.$idev.'/tip/'.$tipo;
        $contenido['prefijo'] = $this->prefijo;
        $contenido['prefijoF'] = $this->prefijoF;
        $contenido['profesion'] = $profesion;
        $contenido['lugares'] = $lugares;
        $contenido['fila'] = $fila;
        $data['contenido'] = $this->load->view($this->carpeta . 'datos_personales', $contenido, true);
        $this->load->view('plantilla_publico_2019', $data);
    }

    function guardar_editar_datospersonal() {
			$id = $this->input->post('pos_id');
			$profesionNuevo = $this->input->post('profesionNuevo');
			if($profesionNuevo==1){
				$filaES[$this->prefijoES . 'area'] = $this->input->post('profesion');
				$filaES[$this->prefijo.'id'] = $id;									
				$filaES[$this->prefijoES.'profesion_ejercida'] = 1;
				$filaES[$this->prefijoES.'fecha_creacion'] = date('Y-m-d H:i:s');
				$this->db->insert($this->tablaES, $filaES);
				$idp=$this->db->insert_id();
				echo 'CREO NUEVO';
			}else{				    
				$filaES1[$this->prefijoES . 'profesion_ejercida'] = 0;
				$this->db->where($this->prefijo.'id', $id);         
				$this->db->update($this->tablaES, $filaES1);
				$consulta2 = $this->db->query('update educacion_superior set edu_profesion_ejercida = 1 , edu_fecha_edicion = "'.date('Y-m-d H:i:s').'"where pos_id='.$id.' AND edu_area='.$this->input->post('profesion').' limit 1;');
				echo 'ACTUALIZO';
			}
            $fila[$this->prefijo . 'nombre'] = $this->input->post($this->prefijo . 'nombre');
            $fila[$this->prefijo . 'amaterno'] = $this->input->post($this->prefijo . 'amaterno');
            $fila[$this->prefijo . 'apaterno'] = $this->input->post($this->prefijo . 'apaterno');
            $fila[$this->prefijo . 'fecha_edicion'] = date('Y-m-d H:i:s');
			$this->db->where($this->prefijo.'id', $id);         
			$this->db->update($this->tabla, $fila);
            $filaF[$this->prefijoF . 'fecha_nacimiento'] = $this->input->post($this->prefijoF . 'fecha_nacimiento');
            $filaF[$this->prefijoF . 'lugar_estudios'] = $this->input->post($this->prefijoF . 'lugar_estudios');
            $filaF[$this->prefijoF . 'fecha_edicion'] = date('Y-m-d H:i:s');
			$this->db->where($this->prefijo.'id', $id);         
			$this->db->update($this->tablaF, $filaF);
		$uri = $this->uri->uri_to_assoc(3);
        $idgrupo = $uri['idg'];
        $idev = $uri['ev'];
        $tipo = $uri['tip'];
		if($tipo==4){
			redirect($this->controlador4 .'carpeta/idg/'.$idgrupo.'/ev/'.$idev);
		}
		else{
			redirect($this->controlador .'inicio_prueba/idg/'.$idgrupo.'/ev/'.$idev);
		}
		
    }

    function inicio_prueba() {
		$uri = $this->uri->uri_to_assoc(3);
        $idgrupo = $uri['idg'];
        $idev = $uri['ev'];
		$consulta = $this->db->query('
			SELECT '.$this->prefijoE.'id, tipo_eval_id, '.$this->prefijoE.'titulo, '.$this->prefijoE.'texto_bienvenida as texto FROM '.$this->tablaE.' WHERE '.$this->prefijoG.'id='.$idgrupo.' AND '.$this->prefijoE.'id='.$idev.'
		');
//        $id;
        $fila = $consulta->first_row('array');
		$id=$_SESSION[$this->presession . 'id'];
		$this->cabecera['accion'] = $fila[$this->prefijoE.'titulo'];
        $contenido['cabecera'] = $this->cabecera;
		if($fila['tipo_eval_id']==1){
        $contenido['action'] = $this->controlador . 'texto_instructivo_prueba/idg/'.$idgrupo.'/ev/'.$idev;
		}
		if($fila['tipo_eval_id']==2){
        $contenido['action'] = $this->controlador . 'texto_instructivo/idg/'.$idgrupo.'/ev/'.$idev;
		}
		if($fila['tipo_eval_id']==3){
        $contenido['action'] = 'Prueba_tres/comenzar_preguntas/'.$idgrupo.'/'.$idev;
		}
		if($fila['tipo_eval_id']==5){
        $contenido['action'] = 'Prueba_cinco/comenzar_preguntas/'.$idgrupo.'/'.$idev;
		}
        $contenido['fila'] = $fila;
        $contenido['boton'] = 'SIGUIENTE';
        $data['contenido'] = $this->load->view($this->carpeta . 'mostrar_texto', $contenido, true);
        $this->load->view('plantilla_publico_2019', $data);
    }
    function texto_instructivo_prueba() {
		$uri = $this->uri->uri_to_assoc(3);
        $idgrupo = $uri['idg'];
        $idev = $uri['ev'];
		$consulta = $this->db->query('
			SELECT '.$this->prefijoE.'id, tipo_eval_id, '.$this->prefijoE.'titulo, '.$this->prefijoP.'id FROM '.$this->tablaE.' WHERE '.$this->prefijoG.'id='.$idgrupo.' AND '.$this->prefijoE.'id='.$idev.'
		');
        $fila = $consulta->first_row('array');
		$idplantilla=$fila[$this->prefijoP.'id'];
		$consulta2 = $this->db->query('
			SELECT '.$this->prefijoP.'texto_instructivo_prueba as texto FROM '.$this->tablaP.' WHERE '.$this->prefijoP.'id='.$idplantilla.'
		');
        $fila2 = $consulta2->first_row('array');
		$id=$_SESSION[$this->presession . 'id'];
		$this->cabecera['accion'] = $fila[$this->prefijoE.'titulo'];
        $contenido['cabecera'] = $this->cabecera;
        $contenido['action'] = $this->controlador1 . 'pregunta_prueba/idg/'.$idgrupo.'/ev/'.$idev.'/idp/'.$idplantilla;
        $contenido['fila'] = $fila2;
        $contenido['boton'] = 'SIGUIENTE';
        $data['contenido'] = $this->load->view($this->carpeta . 'mostrar_texto', $contenido, true);
        $this->load->view('plantilla_publico_2019', $data);
    }
	// -----------------TEXTO INSTRUCTIVO PRUEBA UNO
    function texto_instructivo_uno() {
		$uri = $this->uri->uri_to_assoc(3);
        $idgrupo = $uri['idg'];
        $idev = $uri['ev'];
        $idp = $uri['idp'];
		$consulta = $this->db->query('
			SELECT '.$this->prefijoE.'id, tipo_eval_id, '.$this->prefijoE.'titulo, '.$this->prefijoE.'nro_intentos as nro_intentos, '.$this->prefijoP.'id FROM '.$this->tablaE.' WHERE '.$this->prefijoG.'id='.$idgrupo.' AND '.$this->prefijoE.'id='.$idev.'
		');
        $fila = $consulta->first_row('array');
		$idplantilla=$fila[$this->prefijoP.'id'];
		$consulta2 = $this->db->query('
			SELECT '.$this->prefijoP.'texto_instructivo as texto FROM '.$this->tablaP.' WHERE '.$this->prefijoP.'id='.$idplantilla.'
		');
        $fila2 = $consulta2->first_row('array');
		$id=$_SESSION[$this->presession . 'id'];
		
		$opciones = $this->input->post('enviar');
        if($opciones == 'COMENZAR'){
			$consulta3 = $this->db->query('
				SELECT * FROM '.$this->tablaS.' WHERE '.$this->prefijo.'id='.$id.' AND '.$this->prefijoE.'id='.$idev.' AND '.$this->prefijoG.'id='.$idgrupo.' 
			');
			$fila3 = $consulta3->result_array();
			if($fila3[0][$this->prefijoS.'intentos'] > $fila3[0][$this->prefijoS.'max_intentos']){
				redirect('Ninicio/index');
			}
			else{
				if(!@$fila3){
					$filaS[$this->prefijoG.'id'] = $idgrupo;
					$filaS[$this->prefijo.'id'] = $id;
					$filaS[$this->prefijoE.'id'] = $idev;
					$filaS['pla_id'] = $idp;
					$filaS[$this->prefijoS.'fecha_inicio'] = date('Y-m-d H:i:s');
					$filaS[$this->prefijoS.'max_intentos'] = $fila['nro_intentos'];
					$filaS[$this->prefijoS.'intentos'] = 1;
					$filaS[$this->prefijoS.'termino'] = 0;
					$filaS[$this->prefijoS.'porcentaje'] = 0;
					$filaS[$this->prefijoS.'fecha_creacion'] = date('Y-m-d H:i:s');
					$this->db->insert($this->tablaS, $filaS);
					$idS=$this->db->insert_id();
					redirect($this->controlador1 . 'preguntas_g1/idg/'.$idgrupo.'/ev/'.$idev.'/idp/'.$idplantilla);
				}else{
					if($fila3[0][$this->prefijoS.'porcentaje']==60){
						$idseg=$fila3[0][$this->prefijoS.'id'];
						$filaS[$this->prefijoS . 'fecha_edicion'] = date('Y-m-d H:i:s');
						$filaS[$this->prefijoS.'intentos'] = $fila3[0][$this->prefijoS.'intentos']+1;
						$this->db->where($this->prefijoS.'id', $idseg);         
						$this->db->update($this->tablaS, $filaS);
						redirect($this->controlador1 . 'preguntas_g2/idg/'.$idgrupo.'/ev/'.$idev.'/idp/'.$idplantilla);
					}
					else{
						$idseg=$fila3[0][$this->prefijoS.'id'];
						$filaS[$this->prefijoS . 'fecha_edicion'] = date('Y-m-d H:i:s');
						$filaS[$this->prefijoS.'intentos'] = $fila3[0][$this->prefijoS.'intentos']+1;
						$this->db->where($this->prefijoS.'id', $idseg);         
						$this->db->update($this->tablaS, $filaS);
						redirect($this->controlador1 . 'preguntas_g1/idg/'.$idgrupo.'/ev/'.$idev.'/idp/'.$idplantilla);
					}
				}
			}
		}
		$contenido['action'] = $this->controlador . 'texto_instructivo_uno/idg/'.$idgrupo.'/ev/'.$idev.'/idp/'.$idp;
		$this->cabecera['accion'] = $fila[$this->prefijoE.'titulo'];
        $contenido['cabecera'] = $this->cabecera;
        $contenido['fila'] = $fila2;
        $contenido['boton'] = 'COMENZAR';
        $data['contenido'] = $this->load->view($this->carpeta . 'mostrar_texto', $contenido, true);
        $this->load->view('plantilla_publico_2019', $data);
    }
	// -----------------TEXTO INSTRUCTIVO PRUEBA DOS
    function texto_instructivo() {
		$uri = $this->uri->uri_to_assoc(3);
        $idgrupo = $uri['idg'];
        $idev = $uri['ev'];
		$consulta = $this->db->query('
			SELECT '.$this->prefijoE.'id, tipo_eval_id, '.$this->prefijoE.'titulo, '.$this->prefijoE.'nro_intentos as nro_intentos, '.$this->prefijoP.'id FROM '.$this->tablaE.' WHERE '.$this->prefijoG.'id='.$idgrupo.' AND '.$this->prefijoE.'id='.$idev.'
		');
        $fila = $consulta->first_row('array');
		$idplantilla=$fila[$this->prefijoP.'id'];
		$consulta2 = $this->db->query('
			SELECT '.$this->prefijoP.'texto_instructivo as texto FROM '.$this->tablaP.' WHERE '.$this->prefijoP.'id='.$idplantilla.'
		');
        $fila2 = $consulta2->first_row('array');
		$id=$_SESSION[$this->presession . 'id'];
		$opciones = $this->input->post('enviar');
        if($opciones == 'COMENZAR'){
			$consulta3 = $this->db->query('
				SELECT * FROM '.$this->tablaS.' WHERE '.$this->prefijo.'id='.$id.' AND '.$this->prefijoE.'id='.$idev.' AND '.$this->prefijoG.'id='.$idgrupo.' 
			');
			$fila3 = $consulta3->result_array();
			if($fila3[0][$this->prefijoS.'intentos'] > $fila3[0][$this->prefijoS.'max_intentos']){
				redirect('Ninicio/index');
			}
			else{
				if(!@$fila3){
					$filaS[$this->prefijoG.'id'] = $idgrupo;
					$filaS[$this->prefijo.'id'] = $id;
					$filaS[$this->prefijoE.'id'] = $idev;
					$filaS[$this->prefijoS.'fecha_inicio'] = date('Y-m-d H:i:s');
					$filaS[$this->prefijoS.'max_intentos'] = $fila['nro_intentos'];
					$filaS[$this->prefijoS.'intentos'] = 1;
					$filaS[$this->prefijoS.'termino'] = 0;
					$filaS[$this->prefijoS.'porcentaje'] = 0;
					$filaS[$this->prefijoS.'fecha_creacion'] = date('Y-m-d H:i:s');
					$this->db->insert($this->tablaS, $filaS);
					$idS=$this->db->insert_id();
				}else{
					$idseg=$fila3[0][$this->prefijoS.'id'];
					$filaS[$this->prefijoS . 'fecha_edicion'] = date('Y-m-d H:i:s');
					$filaS[$this->prefijoS.'intentos'] = $fila3[0][$this->prefijoS.'intentos']+1;
					$this->db->where($this->prefijoS.'id', $idseg);         
					$this->db->update($this->tablaS, $filaS);
				}
				redirect($this->controlador2 . 'preguntas/'.$idplantilla.'/'.$idgrupo.'/'.$idev);
			}
		}
		$contenido['action'] = $this->controlador . 'texto_instructivo/idg/'.$idgrupo.'/ev/'.$idev;
		$this->cabecera['accion'] = $fila[$this->prefijoE.'titulo'];
        $contenido['cabecera'] = $this->cabecera;
        $contenido['fila'] = $fila2;
        $contenido['boton'] = 'COMENZAR';
        $data['contenido'] = $this->load->view($this->carpeta . 'mostrar_texto', $contenido, true);
        $this->load->view('plantilla_publico_2019', $data);
    }
    function texto_despedida($idev) {
		$consulta = $this->db->query('
			SELECT '.$this->prefijoE.'id, '.$this->prefijoG.'id, '.$this->prefijoE.'titulo, '.$this->prefijoE.'texto_despedida as texto FROM '.$this->tablaE.' WHERE '.$this->prefijoE.'id='.$idev.'
		');
        $fila = $consulta->first_row('array');
		$id=$_SESSION[$this->presession . 'id'];
		$this->cabecera['accion'] = $fila[$this->prefijoE.'titulo'];
        $contenido['cabecera'] = $this->cabecera;
        $contenido['action'] = 'Ninicio/index';
        $contenido['fila'] = $fila;
        $contenido['boton'] = 'Finalizar';
        $data['contenido'] = $this->load->view($this->carpeta . 'mostrar_texto', $contenido, true);
        $this->load->view('plantilla_publico_2019', $data);
    }

}

?>