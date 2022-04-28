
<?php
//header ('Content-type: text/html; charset=ISO-8859-1');
class Index extends CI_Controller
{
    function __construct()
    {
	parent::__construct();
    force_ssl();
	$this->load->helper('url','form');
        $this->load->library('form_validation');        
        $this->prefijo='eti_';
        $this->load->helper('html');
        $this->definir_form();
        //**base de datos
        $this->campo=array('login','pass');
        //$this->load->database();        
        $this->tabla='etiko';
        $this->carpeta='index/';
        //prefijo de variable session
        $this->presession=$this->tool_entidad->presession();
        session_start();
        //$this->cambiar_estado();
    }
    function index()
    {
        if (!isset($_SESSION[$this->presession.'usuario']))
        {            
            redirect('index/autenticar');
        }
        else
        {
            redirect('index/autenticar');
        }        
    }
	function autenticar()
    {
       // var_dump("aut");
        $prefijo=$this->prefijo;
        //$modelo=$this->modelo;
        if ($this->form_validation->run()==FALSE)
        {
            $contenido['action'] = 'autenticar';
            $this->load->view('index/index',$contenido);
	}
        else
        {
			$login = $this->input->post($prefijo . 'login');
            $pass = sha1($this->input->post($prefijo . 'pass'));
            $consulta = $this->db->query('
            SELECT * FROM ' . $this->tabla . ' where ' . $prefijo . 'login="' . $login . '" and ' . $prefijo . 'pass="' . $pass . '" and ' . $prefijo . 'estado="1"');
            $fila = $consulta->result_array();
            if (count($fila) == 1) {
				$fila = $consulta->row_array();
                if (!isset($_SESSION[$this->presession . 'usuario'])) {
					$_SESSION[$this->presession . 'usuario'] = $fila[$prefijo . 'login'];
                    $_SESSION[$this->presession . 'id'] = $fila[$prefijo . 'id'];
                    $_SESSION[$this->presession . 'email'] = $fila[$prefijo . 'email'];
                    $_SESSION[$this->presession . 'permisos'] = $fila[$prefijo . 'permisos'];
                }
                redirect('inicio');
            } else {
				$contenido['user_error'] = 'Usuario Incorrecto';
                $this->load->view('index/index', $contenido);
            }
            
			/*
            $clave = $this->input->post('id_clave');
            $llave = sha1($this->input->post($prefijo . 'llave'));
            $consulta = $this->db->query('
                SELECT count(*) as nro FROM llaves where pas_id="' . $clave . '" and lla_llave="' . $llave . '"');
            $cla_lla = $consulta->row_array();            
            if ($cla_lla['nro']>0) {
                $login = $this->input->post($prefijo . 'login');
                $pass = sha1($this->input->post($prefijo . 'pass'));
                $consulta = $this->db->query('
                SELECT * FROM ' . $this->tabla . ' where ' . $prefijo . 'login="' . $login . '" and ' . $prefijo . 'pass="' . $pass . '" and ' . $prefijo . 'estado="1"');
                $fila = $consulta->result_array();
                if (count($fila) == 1) {
                    $fila = $consulta->row_array();
                    if (!isset($_SESSION[$this->presession . 'usuario'])) {
                        $_SESSION[$this->presession . 'usuario'] = $fila[$prefijo . 'login'];
                        $_SESSION[$this->presession . 'id'] = $fila[$prefijo . 'id'];
                        $_SESSION[$this->presession . 'email'] = $fila[$prefijo . 'email'];
                        $_SESSION[$this->presession . 'permisos'] = $fila[$prefijo . 'permisos'];
                    }
                    redirect('inicio');
                } else {
                    $contenido['user_error'] = 'Usuario Incorrecto';
                    $this->load->view('index/index', $contenido);
                }
            } else {
                $contenido['user_error'] = 'La Llave Generada es Incorrecta';
                $this->load->view('index/index', $contenido);
            }
			*/
		}
    }
    function cambiar_estado()
    {
        $consulta = $this->db->query('
        SELECT con_id as id, (con_tope + INTERVAL 15 DAY) as tope, con_cargo as cargo
        FROM convocatoria
        WHERE (con_tope + INTERVAL 15 DAY) <"'.date('Y-m-d').'"
        ORDER BY con_fecha_creacion asc'
        );
        $convocatorias=$consulta->result_array();
        foreach ($convocatorias as $convocatoria){            
            $data = array(
               'con_estado' => "1"
            );
            $this->db->update('convocatoria_postulacion', $data, array('con_id1' => $convocatoria['id']));
            $data = array(
               'eta_estado' => "1"
            );
            $this->db->update('etapas', $data, array('con_id' => $convocatoria['id']));
        }
    }

    function definir_form()
    {
        $prefijo=$this->prefijo;
        $config=$this->set_reglas_validacion();
        $mensajes=$this->set_mensajes_error();

        // inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach($mensajes as $msj)
           $this->form_validation->set_message($msj['regla'],$msj['mensaje']);
        // inicio asignando las reglas y mensajes de validacion

    }
    function set_reglas_validacion()
    {
        $prefijo=$this->prefijo;
        $config = array(
               array(
                     'field'   => $prefijo.'login',
                     'label'   => 'Usuario',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => $prefijo.'pass',
                     'label'   => 'Contraseña',
                     'rules'   => 'required'
                  ),
//               array(
//                     'field'   => $prefijo.'llave',
//                     'label'   => 'Llave Generada',
//                     'rules'   => 'required'
//                  )
            );
        return $config;

    }
    function set_mensajes_error()
    {
       $mensajes = array(
               array(
                     'regla'   => 'required',
                     'mensaje'   => 'Debe introducir el campo %s'
                  ),
              array(
                     'regla'   => 'min_length',
                     'mensaje'   => 'El campo %s debe tener al menos %s carácteres'
                  ),
              array(
                     'regla'   => 'valid_email',
                     'mensaje'   => 'Debe escribir una direcciÃ³n de email correcta'
                  )
            );
       return $mensajes;
    }   

}


?>