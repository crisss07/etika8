<?php
require_once('controladoradmin.php');

class Servicio extends Controladoradmin
{
    
    var $titulo;
    var $controlador='servicio/';
    var $carpeta='servicio/';
    function __construct()
    {
	parent::__construct();
        force_ssl();
	$this->load->helper(array('url','form'));
        $this->load->helper('html');
        $this->load->library(array('form_validation','tool_general','tool_entidad'));

        $this->tabla='servicios';
        $this->prefijo='ser_';
        $this->tabla1='clientes';
        $this->prefijo1='cli_';

         //******conf uploads
        $this->config_normal['upload_path'] = './archivos/'.$this->carpeta;
        $this->config_normal['allowed_types'] = 'doc|pdf|txt|rar|zip';
	$this->config_normal['max_size']	= '3072';
        $this->load->library('upload',$this->config_normal);

        //******* definiendo campos de la tabla
        $this->campo=array($this->prefijo.'servicio',$this->prefijo.'nombre1',$this->prefijo.'email1',$this->prefijo.'telefono1',$this->prefijo.'nombre2',$this->prefijo.'email2',$this->prefijo.'telefono2');

        $this->formulario_agregar='servicio_form';
        $this->formulario_editar='servicio_form';
        $this->action_defecto='listar';       
        //$this->no_mostrar_enlaces=1;

         //****** cargando el modelo
        $this->modelo='modelo_servicio';
        $this->load->model($this->carpeta.'Servicio_model',$this->modelo,TRUE);

        $this->cabecera['titulo']='Servicios Generales';
        
        //$this->ruta=base_url().'archivos/';
        $this->ruta=$this->tool_entidad->sitio().'archivos/';
        $this->rutarchivo=$this->tool_entidad->sitio().'archivos/';
        $this->rutaimg=$this->tool_entidad->sitio().'files/img/';
        $this->rutabase=$this->tool_entidad->sitioindex();                       
        $this->ruta=$this->config_normal['upload_path'];
        $this->boton=2;
        $consulta = $this->db->query('SELECT com_id as id, com_nombre as nombre FROM combos WHERE com_tipo=8 ORDER BY com_orden asc');
        $this->cabecera_listado=$consulta->result_array();        
        

        $this->urifull=$this->uri->uri_to_assoc();
        $this->idp=@$this->urifull['idp'];
        $this->vidp='ser_id';
        $this->enlaces=array(
            'id1'=>'ser_id', //id propio
            'nombre1'=>'Servicio Especifico', //cabecera
            'ruta1'=>'especial/listar', //ruta de controlador hijo
            'campo1'=>'ser_id', //id padre
            'campoborrar1'=>@$borrar1, //campos a borra del hijo
            'tabla1'=>'especial_servicio', //tabla hijo
            'camposup1'=>'ser_id'
        );
        $this->nroenlaces=6;        

        $this->presession=$this->tool_entidad->presession();
        session_start();
        if (!isset($_SESSION[$this->presession.'usuario']))
        {
          redirect(base_url().index_page());
        }
        if($_SESSION[$this->presession.'permisos']>='3') {
            redirect('inicio');
        }

    }    

    function listar()
    {
        $consulta = $this->db->query('
        SELECT
        cli_id as id,
        cli_nombre as nombre
        FROM
        clientes
        ORDER BY
        cli_nombre asc,cli_nit asc'
        );
        $clientes=$consulta->result_array();        
        $contenido['cabecera']=$this->cabecera;        
        $contenido['clientes'] = $clientes;
        $data['contenido'] = $this->load->view($this->carpeta.'listar', $contenido, true);
        //$data['contenido'] = $this->load->view('controladoradmin/listar', $contenido, true);
        $this->load->view('plantilla_privado',$data);

    }   
    
}


?>