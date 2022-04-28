<?php
class Imagenes extends CI_Controller
{

   function __construct()
    {
    	parent::__construct();
    	$this->load->helper(array('url','form'));   
        $this->load->helper('html');
        $this->load->library('aws3'); 
        session_start();
        $this->presession=$this->tool_entidad->presession();
        $this->no_mostrar_enlaces=1;
        $this->cabecera['titulo']='Galeria de Imagenes';
        $this->carpeta = 'imagenes/';
        $this->tabla='plantillas';
        $this->prefijo='pla_';
        $this->ruta_aws= $this->tool_entidad->aws_url();
    }

    function index()
    {

        if (!isset($_SESSION[$this->presession.'usuario']))
        {
          redirect(base_url().index_page());         
        }

        $consulta = $this->db->query('
        SELECT pla_ubicacion, COUNT(*) as nro FROM '.$this->tabla. ' GROUP BY pla_ubicacion;');
        $fila=$consulta->result_array();
        $contenido['accion']='imagenes/ver_carpeta';
        $contenido['fila']=$fila;
        $contenido['cabecera']=$this->cabecera;
        $data['contenido'] = $this->load->view($this->carpeta.'index', $contenido, true);
        $this->load->view('plantilla_privado',$data);

    }

    function ver_carpeta($plantilla = null)
    {
        if (!isset($_SESSION[$this->presession.'usuario']))
        {
          redirect(base_url().index_page());         
        }

        // $plantilla = $this->input->post('plantilla');
        $consulta = $this->db->query('
        SELECT * FROM '.$this->tabla.' WHERE '.$this->prefijo.'ubicacion= "'. $plantilla .'"');
        $fila=$consulta->result_array();

        // var_dump($fila);
        // exit;
        $nro = substr($plantilla, -1); // devuelve "!"
        $contenido['accion']='imagenes/ver_carpeta';
        $this->cabecera['titulo']='Galeria de Imagenes -> Plantilla '.$nro;
        $contenido['cabecera']=$this->cabecera;
        $contenido['plantilla']=$plantilla;
        $contenido['fila']=$fila;
        $data['contenido'] = $this->load->view($this->carpeta.'plantilla', $contenido, true);
        $this->load->view('plantilla_privado',$data);

    }

    function subir_imagen()
    {
        $carpeta = $this->input->post('carpeta');
        // $nombre = $_FILES['docnombre']['name'];

        $consulta = $this->db->query('
        SELECT pla_ubicacion, COUNT(*) as nro FROM '.$this->tabla. ' WHERE pla_ubicacion = "' .$carpeta. '" GROUP BY pla_ubicacion;');
        $fila=$consulta->first_row('array');
        $num = $fila['nro'] + 1;

        // var_dump($fila['nro']);
        // exit;
        $nombre = 'imagen_'.$num;
        //subir imagenes al servidor AWS
        $folder_name_fijos='archivos/plantillas/'.$carpeta.'/'.$nombre;//'zzz/'
        $aws_bucket=$this->tool_entidad->aws_bucket();
        $this->aws3->sendFile($aws_bucket,$_FILES['docnombre'] ,$folder_name_fijos);

        $datos[$this->prefijo . 'nombre'] = $nombre;
        $datos[$this->prefijo . 'ubicacion'] = $carpeta;
        $datos[$this->prefijo . 'fecha_creacion'] = date('Y-m-d H:i:s');
        $datos[$this->prefijo . 'fecha_edicion'] = date('Y-m-d H:i:s');
        $this->db->insert($this->tabla, $datos);

        $consulta = $this->db->query('
        SELECT * FROM '.$this->tabla.' WHERE '.$this->prefijo.'ubicacion= "'. $carpeta .'"');
        // $consulta = $this->db->query('
        // SELECT * FROM '.$this->tabla);
        $fila=$consulta->result_array();
        $nro = substr($carpeta, -1);
        // var_dump($fila);
        // exit;

        $contenido['accion']='imagenes/ver_carpeta';
        $this->cabecera['titulo']='Galeria de Imagenes -> Plantilla '.$nro;
        $contenido['cabecera']=$this->cabecera;
        $contenido['plantilla']=$carpeta;
        $contenido['fila']=$fila;
        $data['contenido'] = $this->load->view($this->carpeta.'plantilla', $contenido, true);
        $this->load->view('plantilla_privado',$data);

    }

    function eliminar_imagen($pla_id = null)
    {
        $consulta = $this->db->query('
        SELECT * FROM '.$this->tabla.' WHERE '.$this->prefijo.'id='. $pla_id);
        $fila=$consulta->row_array();
        $ruta = 'archivos/plantillas/'.$fila['pla_ubicacion'].'/'.$fila['pla_nombre'];
        //eliminar archivo del servidor
        $aws_bucket=$this->tool_entidad->aws_bucket();
        $this->aws3->deleteFile($aws_bucket,$ruta);
        
        //eliminar de la base de datos
        $this->db->delete($this->tabla, array('pla_id' => $pla_id));
        $carpeta = $fila['pla_ubicacion'];

        $consulta1 = $this->db->query('
        SELECT * FROM '.$this->tabla.' WHERE '.$this->prefijo.'ubicacion= "'. $carpeta .'"');
        $fila1=$consulta1->result_array();
        $nro = substr($carpeta, -1);

        $contenido['accion']='imagenes/ver_carpeta';
        $this->cabecera['titulo']='Galeria de Imagenes -> Plantilla '.$nro;
        $contenido['cabecera']=$this->cabecera;
        $contenido['plantilla']=$carpeta;
        $contenido['fila']=$fila1;
        $data['contenido'] = $this->load->view($this->carpeta.'plantilla', $contenido, true);
        $this->load->view('plantilla_privado',$data);


    }

    function estructura()
    {
        if (!isset($_SESSION[$this->presession.'usuario']))
        {
          redirect(base_url().index_page());         
        }
        $contenido['accion']='imagenes/ver_carpeta';
        $contenido['cabecera']=$this->cabecera;
        $data['contenido'] = $this->load->view($this->carpeta.'index', $contenido, true);
        $this->load->view('plantilla_privado',$data);
    }

    function formulario_prueba()
    {
        if (!isset($_SESSION[$this->presession.'usuario']))
        {
          redirect(base_url().index_page());         
        }
        $contenido['accion']='imagenes/ver_carpeta';
        $contenido['cabecera']=$this->cabecera;
        $data['contenido'] = $this->load->view($this->carpeta.'formulario_prueba', $contenido, true);
        $this->load->view('plantilla_privado',$data);
    }
}


?>