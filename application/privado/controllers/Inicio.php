<?php
class Inicio extends CI_Controller
{

   function __construct()
    {
	parent::__construct();
	$this->load->helper(array('url','form'));   
        $this->load->helper('html');
        session_start();
        $this->presession=$this->tool_entidad->presession();
        $this->no_mostrar_enlaces=1;
        /*
        $this->load->library('session');
        $ingresado = $this->session->userdata('ingresado');
        if(!$ingresado)
            redirect(base_url().'index2.php');

         $login=$this->session->userdata('login');
         var_dump($login);*/
    }
    function index()
    {

        if (!isset($_SESSION[$this->presession.'usuario']))
        {
          redirect(base_url().index_page());         
        }
        //$data['contenido'] = $this->load->view('index', $contenido, true);
		$data['contenido']='';
        $this->load->view('plantilla_privado', $data);



    }
    function menu_vertical()
    {

        if (!isset($_SESSION[$this->presession.'usuario']))
        {
          redirect(base_url().index_page());         
        }
        //$data['contenido'] = $this->load->view('index', $contenido, true);
        
        $this->load->view('menu_vertical');



    }
    function cerrar_session()
    {
        session_destroy();
       // $this->session->destroy();
        redirect();
    }
}


?>