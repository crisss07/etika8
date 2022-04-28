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

		$this->cabecera['titulo']='Seguimiento';

        $this->presession = $this->tool_entidad->presession();
        session_start();
        if (!isset($_SESSION[$this->presession . 'usuario'])) {
            redirect(base_url() . index_page());
        }
        $this->id_etiko = $_SESSION[$this->presession . 'id'];
    }



    public function descargar_seleccionados()
    {   
        $aws_bucket=$this->tool_entidad->aws_bucket();
        $archivos=$this->input->post('archivos');
        $nom_carpeta=$this->input->post('nombre_carpeta');
        if ($archivos!=null) {//en caso de null
            $this->aws3->zipfileSelected($aws_bucket,'archivos/cvs/temp/'.$nom_carpeta,$archivos);
        }
        else{
            redirect('Prueba_cuatro/mostrar/id/'.$nom_carpeta);
        }
    }

  

   
    //carpetas aws archivos/postulaciones/
    function folder($id=null) {
         
        //datos Aws  
        //crear carpeta
        $nombre_carpeta= 'archivos/postulaciones/'.$id.'/';
        $aws_bucket=$this->tool_entidad->aws_bucket();
        // var_dump($aws_bucket);exit();
        // $this->aws3->createFolder('elasticbeanstalk-us-east-2-676905610441',$nombre_carpeta);//crear carpeta vacia
        $this->aws3->createFolder($aws_bucket,$nombre_carpeta);//crear carpeta vacia

        // $map = $this->aws3->listFile('elasticbeanstalk-us-east-2-676905610441',$nombre_carpeta);
        $map = $this->aws3->listFile($aws_bucket,$nombre_carpeta);

        $aws_url=$this->tool_entidad->aws_url();
        //var_dump($map['key']);exit();
        $contenido['nombre_carpeta']=$id;  
        $contenido['lista']=$map;        
        // $contenido['bucket_url']='https://elasticbeanstalk-us-east-2-676905610441.s3.us-east-2.amazonaws.com/';
        $contenido['bucket_url']=$aws_url;
        //Fin de datos AWS

        $contenido['datos'] = '';
        $contenido['enlace'] = '';
        $contenido['cabecera'] = $this->cabecera;
        $data['contenido'] = $this->load->view($this->carpeta . 'listado_carpetas', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }


    public function upload()
    {           
       
            //parametros
            $nombre_carpeta= $this->input->post('nombre_carpeta');
            // $folder_name='archivos/cargos/'.$nombre_carpeta.'/';
            $folder_name='archivos/postulaciones/'.$nombre_carpeta.'/';

            //cambio de nombre            
            $filename = $_FILES['userfile']['name'];
            $name = pathinfo($filename, PATHINFO_FILENAME);
            // var_dump($name);exit();
            $extension = pathinfo($filename, PATHINFO_EXTENSION);// extension del archivo
            //adicion de la fecha al archivo
			$fecha_systema=date('Y-m-d_H:i:s');
            $nombre_archivo=$name.'_'.$fecha_systema.'.'.$extension;
            // var_dump($nombre_archivo);exit();
            //fin de cambio de nombre

            $aws_bucket=$this->tool_entidad->aws_bucket();
            $aws_url=$this->tool_entidad->aws_url();

            $folder_name = $folder_name.$nombre_archivo;
            // $url = $this->aws3->sendFile('elasticbeanstalk-us-east-2-676905610441',$_FILES['userfile'] ,$folder_name);    
            $url = $this->aws3->sendFile($aws_bucket,$_FILES['userfile'] ,$folder_name);    
            //$map = directory_map('./archivos/');
            $map = $this->aws3->listFile($aws_bucket,$folder_name);
            $data['lista']=$map;        
            $data['bucket_url']=$aws_url;
            redirect('Prueba_cuatro/folder/'.$nombre_carpeta.'/');            
    }

    public function descargar_zip()
    {
        $nombre_carpeta= $this->input->post('nombre_carpeta_descarga');
        $folder_name='archivos/postulaciones/'.$nombre_carpeta;
        $aws_bucket=$this->tool_entidad->aws_bucket();
        // $this->aws3->zipfile('elasticbeanstalk-us-east-2-676905610441',$folder_name);
        $this->aws3->zipfile($aws_bucket,$folder_name);
        
    }
    public function descargaZipSeleccionados()
    {   
        $archivos=$this->input->post('archivos');
        $nombre_carpeta= $this->input->post('carpeta_descarga');
        $folder_name='archivos/postulaciones/'.$nombre_carpeta;
        $aws_bucket=$this->tool_entidad->aws_bucket();
        if ($archivos!=null) {//en caso de null
            $this->aws3->zipfileSelected($aws_bucket,$folder_name,$archivos);
        }
        else{
            redirect('Prueba_cuatro/folder/'.$nombre_carpeta.'/');
        }
        
    }

    public function eliminar_archivos()
    {   

        $ruta_archivo=$this->input->get('archivo');
        $nombre_carpeta= $this->input->get('carpeta');  
        $aws_bucket=$this->tool_entidad->aws_bucket();
        //var_dump($ruta_archivo);exit();      
        $respuesta = $this->aws3->deleteFile($aws_bucket,$ruta_archivo);
        redirect('Prueba_cuatro/folder/'.$nombre_carpeta.'/');
    }
    //fin de carpetas aws archivos/postulaciones/

    //carpetas para postulantes
    function folder_postulante($id=null,$idg=null) {
		$grupo = $this->db->query("SELECT * from zis_grupo_evaluacion WHERE gru_id=$idg")->row_array();
		$cadena=$grupo['gru_nombre'];
        $cadena =str_replace(' ', '', $cadena);
        $ncarpeta=$grupo['gru_id'].$cadena;
        //datos Aws  
        //crear carpeta
		$consulta1 = $this->db->query("SELECT * from postulante WHERE pos_documento=$id")->result_array();
        $aws_bucket=$this->tool_entidad->aws_bucket();
        $aws_url=$this->tool_entidad->aws_url();
        $nombre_carpeta= 'archivos/postulante/'.$id.'/'.$ncarpeta.'/';
        $this->aws3->createFolder($aws_bucket,$nombre_carpeta);//crear carpeta vacia

        $map = $this->aws3->listFile($aws_bucket,$nombre_carpeta);
		$listaC=$this->ordenarLista($map);
		// print_r($listaC);
		// exit();
        //var_dump($map['key']);exit();

        $contenido['nombre_carpeta']=$id.'/'.$ncarpeta;  
        $contenido['lista']=$map;        
        $contenido['lista2']=$listaC;        
        $contenido['bucket_url']=$aws_url;
        //Fin de datos AWS
		$contenido['fila_sup']=$consulta1[0];  
        $contenido['prefijo_pos']='pos_';  
		$contenido['id'] = $id;
        $contenido['datos'] = '';
        $contenido['enlace'] = '';
        $contenido['prefijo'] = '';
		$this->cabecera['accion']='Vista Evaluación Carpeta';
        $contenido['cabecera'] = $this->cabecera;
        $data['contenido'] = $this->load->view($this->carpeta . 'listCarpetaspostulante', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }
    
    public function ordenarLista($map=null)
    {    
		$ccarpeta1=array();
		$ccarpeta2=[];
		foreach ($map as $object) {
            $aux = $object['Key'] . "<br>\n";
			$archivo = [];
            $archivo = explode( '/', $aux );
			array_push($ccarpeta1, $archivo[4]);
			array_push($ccarpeta2, strtolower($archivo[4]));
            // var_dump($object['key']);exit();
        }
		asort($ccarpeta2);
		$ccarpeta3=[];
		foreach($ccarpeta2 as $val2){
			foreach($ccarpeta1 as $val){
				if($val2==strtolower($val)){
					array_push($ccarpeta3,$val);
				}
			}
		}
		// print_r($ccarpeta3);
        // exit();
		return $ccarpeta3;
	}
	
	public function uploadPostulante()
    {           
       
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
            $fecha_systema=date('Y-m-d_H:i:s');
            $nombre_archivo=$name.'_'.$fecha_systema.'.'.$extension;
            //var_dump($nombre_archivo);exit();
            //fin de cambio de nombre            


            $folder_name = $folder_name.'/'.$nombre_archivo;

            $url = $this->aws3->sendFile($aws_bucket,$_FILES['userfile'] ,$folder_name);    
            //$map = directory_map('./archivos/');
            $map = $this->aws3->listFile($aws_bucket,$folder_name);
            $data['lista']=$map;        
            $data['bucket_url']=$aws_url;
            redirect('Prueba_cuatro/folder_postulante/'.$nombre_carpeta.'/');            
    }

    public function downZiPostulante()
    {
        $nombre_carpeta= $this->input->post('nombre_carpeta_descarga');
        $folder_name='archivos/postulante/'.$nombre_carpeta;
        $aws_bucket=$this->tool_entidad->aws_bucket();
        
        $this->aws3->zipfile($aws_bucket,$folder_name);
        
    }
    public function downZipSeleccionados()
    {   
        $archivos=$this->input->post('archivos');
        $nombre_carpeta= $this->input->post('carpeta_descarga');
        $folder_name='archivos/postulante/'.$nombre_carpeta;
        $aws_bucket=$this->tool_entidad->aws_bucket();
        

        if ($archivos!=null) {//en caso de null
            $this->aws3->zipfileSelected($aws_bucket,$folder_name,$archivos);
        }
        else{
            redirect('Prueba_cuatro/folder_postulante/'.$nombre_carpeta.'/');
        }
        
    }

    public function eliminar_postulante()
    {   
        $aws_bucket=$this->tool_entidad->aws_bucket();
        
        $ruta_archivo=$this->input->get('archivo');
        $nombre_carpeta= $this->input->get('carpeta');  
        //var_dump($ruta_archivo);exit();      
        $respuesta = $this->aws3->deleteFile($aws_bucket,$ruta_archivo);
         redirect('Prueba_cuatro/folder_postulante/'.$nombre_carpeta.'/');



    }
    //fin de carpetas postulantes
    


}

?>