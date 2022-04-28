<?php
require_once('Controladoradmin.php');
date_default_timezone_set('America/La_Paz');

class Prueba_cuatro extends Controladoradmin {

    function __construct() {
        parent::__construct();
        force_ssl();
        $this->load->helper(array('url', 'form', 'html'));
        $this->load->library(array('form_validation', 'tool_general'));
        $this->load->helper('directory');
        $this->load->library('aws3');  

        //****** definiendo nombre de carpeta por defecto
        $this->carpeta = 'prueba_cuatro/';
        $this->controlador = 'Prueba_cuatro/';

		$this->tabla = 'postulante';
		$this->prefijo = 'pos_';

        $this->cabecera['titulo'] = 'Sistema de Evaluación';
        $this->cabecera['accion'] = '';
        $this->presession = $this->tool_entidad->presession();
        session_start();
        if (!isset($_SESSION[$this->presession . 'usuario'])) {
            redirect(base_url() . index_page());
        }
    }
	
	function carpeta()
	{
		$uri = $this->uri->uri_to_assoc(3);
        $idgrupo = $uri['idg'];
        $idev = $uri['ev'];
        $id=$_SESSION[$this->presession . 'id'];
		$consulta = $this->db->query('
				SELECT g.gru_id as idg, g.gru_nombre as nombreg, e.eva_texto_bienvenida as texto FROM zis_grupo_evaluacion g JOIN zis_evaluacion e ON g.gru_id='.$idgrupo.' where eva_id='.$idev.'
			');
		$fila = $consulta->result_array();
		$texto=$fila[0]['texto'];
		$cadena=$fila[0]['nombreg'];
		$cadena =str_replace(' ', '', $cadena);
		$id_carpeta=$fila[0]['idg'].$cadena;
		
		// print_r($id_carpeta);
		$Dpostulante = $this->obtenerDatosPostulante($id);
		$documento=$Dpostulante['pos_documento'];
		//datos Aws  
        //crear carpeta
        $aws_bucket=$this->tool_entidad->aws_bucket();
        $aws_url=$this->tool_entidad->aws_url();
        $nombre_carpeta= 'archivos/postulante/'.$documento.'/'.$id_carpeta;
        $this->aws3->createFolder($aws_bucket,$nombre_carpeta.'/');//crear carpeta vacia
        $map = $this->aws3->listFile($aws_bucket,$nombre_carpeta);
		/*
		foreach ($map as $object) {
                echo $object['Key'] . "<br/>\n";
                // var_dump($object['key']);exit();
            }
            exit();
		*/
        $contenido['nombre_carpeta']=$documento.'/'.$id_carpeta.'/';  
        $contenido['lista']=$map;        
        $contenido['bucket_url']=$aws_url;
        //Fin de datos AWS

		$consulta2 = $this->db->query('
				SELECT * FROM zis_seguimiento WHERE gru_id='.$idgrupo.' AND eva_id='.$idev.' AND pos_id='.$id.'
			');
		$fila2 = $consulta2->result_array();
		// print_r($fila2);
		$filaS=array();
		if(!@$fila2){
			$filaS['gru_id'] = $idgrupo;
			$filaS['pos_id'] = $id;
			$filaS['eva_id'] = $idev;
			$filaS['pla_id'] = 1;
			$filaS['seg_fecha_inicio'] = date('Y-m-d H:i:s');
			$filaS['seg_max_intentos'] = 2;
			$filaS['seg_intentos'] = 1;
			$filaS['seg_termino'] = 0;
			$filaS['seg_porcentaje'] = 0;
			$filaS['seg_fecha_creacion'] = date('Y-m-d H:i:s');
			$this->db->insert('zis_seguimiento', $filaS);
			$idS=$this->db->insert_id();
		}
		else{
			$idseg=$fila2[0]['seg_id'];
			$filaS['seg_fecha_edicion'] = date('Y-m-d H:i:s');
			$this->db->where('seg_id', $idseg);         
			$this->db->update('zis_seguimiento', $filaS);
		}
        $contenido['datos'] = '';
        $contenido['enlace'] = '';
        $contenido['texto'] = $texto;
		$this->cabecera['accion']='Subir archivos'; 
		$contenido['cabecera']=$this->cabecera;
		$contenido['idev'] = $idev;
		$contenido['idgrupo'] = $idgrupo;
		$data['contenido'] = $this->load->view($this->carpeta.'folder_postulante', $contenido, true);
		$this->load->view('plantilla_publico_2019', $data);
	}

    public function uploadPostulante()
    {           
            $idev= $this->input->post('idev'); 
            $idgrupo= $this->input->post('idgrupo'); 
            //parametros           
            $nombre_carpeta= $this->input->post('nombre_carpeta');            
            $folder_name='archivos/postulante/'.$nombre_carpeta;

            $aws_bucket=$this->tool_entidad->aws_bucket();
            $aws_url=$this->tool_entidad->aws_url();
            //cambio de nombre            
            $filename = $_FILES['userfile']['name'];
            $name = pathinfo($filename, PATHINFO_FILENAME);
            // var_dump($name);exit();
            $extension = pathinfo($filename, PATHINFO_EXTENSION);// extension del archivo
            //adicion de la fecha al archivo
            $fecha_systema=date('YmdHis');
            //var_dump($fecha_systema);exit();
            $nombre_archivo=$name.'_'.$fecha_systema.'.'.$extension;
            //var_dump($nombre_archivo);exit();
            //fin de cambio de nombre            


            $folder_name = $folder_name.$nombre_archivo;

            $url = $this->aws3->sendFile($aws_bucket,$_FILES['userfile'] ,$folder_name);    
            //$map = directory_map('./archivos/');
            $map = $this->aws3->listFile($aws_bucket,$folder_name);
            $data['lista']=$map;        
            $data['bucket_url']=$aws_url;
            redirect('Prueba_cuatro/carpeta/idg/'.$idgrupo.'/ev/'.$idev);            
    }
   public function eliminar_postulante($idgrupo=null,$idev=null)
    {   
        $aws_bucket=$this->tool_entidad->aws_bucket();
        
        $ruta_archivo=$this->input->get('archivo');
        $nombre_carpeta= $this->input->get('carpeta');  
        //var_dump($ruta_archivo);exit();      
        $respuesta = $this->aws3->deleteFile($aws_bucket,$ruta_archivo);
         // redirect('Prueba_cuatro/folder_postulante/'.$nombre_carpeta.'/');
		 redirect('Prueba_cuatro/carpeta/idg/'.$idgrupo.'/ev/'.$idev);



    }
    //fin de carpetas postulantes
	public function obtenerDatosPostulante($id=null)
    {
		$consulta = $this->db->query('
		SELECT * FROM '.$this->tabla.' WHERE '.'pos_id='.$id
        );
        $Dpostulante = $consulta->row_array('array');
		// print_r($Dpostulante);
		return $Dpostulante;
	}
}

?>