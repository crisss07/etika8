<?php
require_once('Controladoradmin.php');

class Configuracion extends Controladoradmin
{
    function __construct()
    {
	parent::__construct();
        force_ssl();
	$this->load->helper(array('url','form','html'));
        $this->load->library(array('form_validation','tool_general'));

         //****** definiendo nombre de carpeta por defecto
        $this->carpeta='configuracion/';
        $this->controlador='configuracion/';
        
        $this->rutaimg=$this->tool_entidad->constantes['nombresitio'].'files/img/';        
        $this->action_defecto='listar';                 

        $this->cabecera['titulo']='Configuración';
        
        $this->boton=7;
        $this->presession=$this->tool_entidad->presession();
        session_start();
        if (!isset($_SESSION[$this->presession.'usuario']))
        {
          redirect(base_url().index_page());
        }
        if($_SESSION[$this->presession.'permisos']=='3') {
            redirect('inicio');
        }
    }
    function index()
    {
        $contenido['cabecera']=$this->cabecera;
        $data['contenido'] = $this->load->view($this->carpeta.'index', $contenido, true);
        $this->load->view('plantilla_privado',$data);

    }    
}


?>