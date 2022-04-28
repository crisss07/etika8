<?php

require_once './PHPMailer/Exception.php';
require_once './PHPMailer/PHPMailer.php';
require_once './PHPMailer/SMTP.php';
require_once './PHPMailer/Envio_email_contacto.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (@in_array($this->uri->segment(1), $this->config->item('sin_ssl_pages'))) {
            remove_ssl();
        } else {
            force_ssl();
        }
        $this->load->helper(array('url', 'form'));
        $this->load->library('Form_validation');
        $this->load->library('Securimage');

        $this->prefijo = 'pos_';
        $this->load->helper('html');
        $this->definir_form();

        //**base de datos
        $this->campo = array('login', 'pass');
        $this->load->database();

        $this->tabla = 'postulante';
        $this->controlador = 'login/';
        $this->carpeta = 'login/';
        $this->presession = $this->tool_entidad->presession();
        @session_start();
    }

    function nuevo() {
        $contenido['action'] = 'guardar_nuevo';
        $this->load->view('index/form_nuevo', $contenido);
    }

    function guardar_nuevo() {
        if ($this->input->post($this->prefijo . 'tipodoc')) {
            $data[$this->prefijo . 'tipodoc'] = $fila[$this->prefijo . 'tipodoc'] = $this->input->post($this->prefijo . 'tipodoc');
        } else {
            $error[$this->prefijo . 'tipodoc'] = 'Debe Seleccionar un Tipo de Documento';
        }
        if ($this->input->post($this->prefijo . 'documento')) {
            $data[$this->prefijo . 'documento'] = $fila[$this->prefijo . 'documento'] = $this->input->post($this->prefijo . 'documento');
        } else {
            $error[$this->prefijo . 'documento'] = 'Debe Introducir CI o Pasaporte';
        }
        switch ($data[$this->prefijo . 'tipodoc']) {
            case 1:
                if ($this->input->post($this->prefijo . 'documento')) {
                    if (!is_numeric($this->input->post($this->prefijo . 'documento'))) {
                        $error[$this->prefijo . 'documento'] = 'Debe Introducir solo Numeros';
                    }
                }
                break;
        }

        if ($this->input->post($this->prefijo . 'tipodoc')) {
            $data[$this->prefijo . 'tipodoc'] = $fila[$this->prefijo . 'tipodoc'] = $this->input->post($this->prefijo . 'tipodoc');
        } else {
            $error[$this->prefijo . 'tipodoc'] = 'Debe Seleccionar un Tipo de Documento';
        }
        if ($this->input->post('captcha')) {
            $captcha = $this->input->post('captcha');
            $img = new Securimage();
            //var_dump($img); exit ();
            $captcha_valido = $img->check($captcha);
            if (!$captcha_valido)
                $error['captcha'] = 'Codigo Incorrecto';
        }else {
            $error['captcha'] = 'Debe Introducir el Codigo';
        }
        if ($captcha_valido && !$error) {
            $consulta = $this->db->query('
                SELECT *
                FROM ' . $this->tabla . '
                WHERE pos_documento = "' . $fila[$this->prefijo . 'documento'] . '" and pos_tipodoc="' . $fila[$this->prefijo . 'tipodoc'] . '"
                ');
            $postulante = $consulta->row_array();
            if ($postulante) {
                $contenido['mensaje'] = 1;
                $msje = 'El CI o Pasaporte ya ha sido registrado <br/> si desea recuperar su contraseña haga <br/>' . anchor('index/recuperar', 'click aquí') . '<br/> caso contrario escribir a <br/><a href="mailto:infoetika@etika.com.bo" title="ETIKA">infoetika@etika.com.bo</a>';
                $contenido['msje'] = $msje;
                $contenido['action'] = 'guardar_nuevo';
                $this->load->view('index/form_nuevo', $contenido);
            } else {
                $_SESSION[$this->presession . 'usuario'] = 'us_temporal';
                $_SESSION[$this->presession . 'ci'] = $fila[$this->prefijo . 'documento'];
                $_SESSION[$this->presession . 'tipodoc'] = $fila[$this->prefijo . 'tipodoc'];
                redirect('postulante/datospersonal_nuevo');
            }
        } else {
            $contenido['action'] = 'guardar_nuevo';
            $contenido['error'] = $error;
            $contenido['fila'] = $fila;
            $this->load->view('index/form_nuevo', $contenido);
        }
    }

    function recuperar() {
//        print_r($_SESSION);
        if (!isset($_SESSION[$this->presession . 'ci'])) {
            redirect(base_url() . index_page());
        }
        $contenido['action'] = 'login/recovery';
//        $this->load->view('index/form_recovery', $contenido);
//        $this->load->view('plantilla_publico_2019', $data);
        $data['contenido'] = $this->load->view($this->carpeta . '/form_recovery', $contenido, true);
        $this->load->view('plantilla_publico_2019_banner', $data);
    }

    function recovery() {
        if (!isset($_SESSION[$this->presession . 'ci'])) {
            redirect(base_url() . index_page());
        }
//        $data[$this->prefijo . 'documento'] = $this->input->post($this->prefijo . 'documento');
//        $fila[$this->prefijo . 'documento'] = $data[$this->prefijo . 'documento'];
//        if ($data[$this->prefijo . 'documento'] == '')
//            $error[$this->prefijo . 'documento'] = '<p>Debe Introducir el Login</p>';
//        $data[$this->prefijo . 'email'] = $this->input->post($this->prefijo . 'email');
//        $fila[$this->prefijo . 'email'] = $data[$this->prefijo . 'email'];
//        if ($data[$this->prefijo . 'email'] == '')
//            $error[$this->prefijo . 'email'] = '<p>Debe Introducir el Email</p>';
//        elseif ((!ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*$", $data[$this->prefijo . 'email'])))
//            $error[$this->prefijo . 'email'] = 'Debe Introducir una direccion de correo valido';

        if (!@$error) {
            $consulta = $this->db->query('
            SELECT pos_id,pos_email,pos_documento
                FROM ' . $this->tabla . '
                WHERE pos_documento = "' . $_SESSION[$this->presession . 'ci'] . '"');

            $postulante = $consulta->row_array();
            if (!$postulante) {
                $contenido['mensaje'] = 1;
                $contenido['msje'] = 'El CI/Pasaporte o el E-mail no coinciden.';
                $contenido['fila'] = $fila;
                $contenido['action'] = 'login/recovery';
//                $this->load->view('index/form_recovery', $contenido);
                $data['contenido'] = $this->load->view($this->carpeta . '/form_recovery', $contenido, true);
                $this->load->view('plantilla_publico_2019_banner', $data);
            } else {
                $id = $postulante['pos_id'];
                $nueva_pass = substr(sha1(rand()), 0, 8);
                $this->db->query('update ' . $this->tabla . ' set pos_pass = "' . sha1($nueva_pass) . '" where pos_id = ' . $id);
                $ip = getenv("REMOTE_ADDR");
                $host = getenv("REMOTE_HOST");
                $cliente = getenv("HTTP_USER_AGENT");
                $fecha = date("D M d H:i:s Y");
                @$arroba = strpos($email, "@");
                @$punto = strpos($email, ".");
                //$iphost='IP: '.$ip.' '. $host.'   Cliente: '.$cliente.'  ';
                $login = $postulante[$this->prefijo . 'documento'];
                $email = $postulante[$this->prefijo . 'email'];
                $nombre_postulante = '';
                $datos = 'Recuperar Contraseña ';
                $emailPostulante = explode("@", $email);
                $emailRegistrado = substr($emailPostulante[0], 0, 4) . "***@" . $emailPostulante[1];
                @$msj = $iphost . '

                         ' . $datos . '
                         ______________________________________________________________
                         Usted solicito recuperar contraseña para el Sistema de Postulación ETIKA!!!!
                         CI/Pasaporte: ' . $login . '
                         Nueva Contraseña: ' . $nueva_pass . '
                         Se le recomienda cambiar su contraseña una vez que ingrese.';
                $cabeceras = 'From: Sistema ETIKA <informacion@etika.com.bo>' . "\r\n" .
                        'Reply-To: Sistema ETIKA <informacion@etika.com.bo>' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

                $oMail = new PHPMailer;
                $envioCorreo = new Envio_email_contacto($oMail);

                $resultado = $envioCorreo->recuperar_contrasena($oMail, $email, $nombre_postulante, 'Sistema ETIKA - Recuperar Contraseña', $msj);


                // @mail($email, 'Sistema ETIKA - Recuperar Contraseña', $msj, $cabeceras);
                $contenido['mensaje'] = 1;
                $fila[$this->prefijo . 'documento'] = '';
                $fila[$this->prefijo . 'email'] = '';
                $contenido['msje'] = '<div class="col-md-8 col-8" style="border: 1px solid black;">Se ha enviado su nueva contraseña a la dirección de correo ' . $emailRegistrado . '</div>';

                $contenido['fila'] = $fila;
                $contenido['action'] = 'login/recovery';
//                $this->load->view('login/form_recovery', $contenido);
                $data['contenido'] = $this->load->view($this->carpeta . '/form_recovery', $contenido, true);
                $this->load->view('plantilla_publico_2019_banner', $data);
            }
        } else {
            $contenido['fila'] = $fila;
            $contenido['error'] = $error;
            $contenido['action'] = 'login/recovery';
//            $this->load->view('login/form_recovery', $contenido);
            $data['contenido'] = $this->load->view($this->carpeta . '/form_recovery', $contenido, true);
            $this->load->view('plantilla_publico_2019_banner', $data);
        }
    }

    function index() {
        if (!isset($_SESSION[$this->presession . 'usuario'])) {
            redirect('/login/autenticar');
        } else {
            redirect('/login/autenticar');
        }
    }

    function autenticar() {
        if (!isset($_SESSION[$this->presession . 'idc'])) {
            redirect(base_url() . index_page());
        }
        if ($this->input->post('intentos') >= 2) {
            $contenido['mensaje'] = 1;
        }
        $contenido['action'] = '/login/autenticar';
        $this->definir_form();
        $prefijo = $this->prefijo;
        @$modelo = $this->modelo;
		$aux=0;
        if ($this->form_validation->run() == FALSE) {
            if ($this->input->post('enviar') == 'Ingresar') {
                if (!$this->input->post($prefijo . 'login'))
                    $error_login = 'Debe Introducir su CI o Pasaporte';
                if (!$this->input->post($prefijo . 'pass'))
                    $error_pass = 'Debe Introducir su Contraseña';
                $contenido['error_pass'] = $error_pass;
                $contenido['error_login'] = $error_login;
            }
            $contenido['action'] = '/login/autenticar';
//            $this->load->view('index/index',$contenido);
            $data['contenido'] = $this->load->view($this->carpeta . '/login', $contenido, true);
            $this->load->view('plantilla_publico_2019_banner', $data);
        }
        else {
//            $login = $this->input->post($prefijo . 'login');
            $login = $_SESSION[$this->presession . 'ci'];
            $pass = sha1($this->input->post($prefijo . 'pass'));

            $consulta = $this->db->query('
            SELECT * FROM ' . $this->tabla . ' where pos_documento="' . $login . '" and pos_pass="' . $pass . '"');

            $fila = $consulta->result_array();
            if (count($fila) == 1) {
                $fila = $consulta->row_array();
//                print_r($fila);
//                if (!isset($_SESSION[$this->presession . 'usuario'])) {
                $_SESSION[$this->presession . 'usuario'] = $fila['pos_documento'];
                $_SESSION[$this->presession . 'nombre'] = $fila['pos_nombre'] . ' ' . $fila['pos_apaterno'] . ' ' . $fila['pos_amaterno'];
                $_SESSION[$this->presession . 'id'] = $fila['pos_id'];
                $_SESSION[$this->presession . 'email'] = $fila['pos_email'];
//                }
//                print_r($_SESSION);
                redirect('epostulante/postular');
            } else {
                //redirect('index/autenticar');
				//$intentos = $this->input->post('intentos') + 1;
				$aux=$this->input->post('intentos');
                $intentos = ++$aux;
                $contenido['user_error'] = '<p>Contraseña Incorrecta</p>';
                $contenido['intentos'] = $intentos;
//                $this->load->view('index/index', $contenido);
                $data['contenido'] = $this->load->view($this->carpeta . '/login', $contenido, true);
                $this->load->view('plantilla_publico_2019_banner', $data);
            }
        }
    }

    function definir_form() {
        $prefijo = $this->prefijo;
        $config = $this->set_reglas_validacion();
        $mensajes = $this->set_mensajes_error();

        // inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach ($mensajes as $msj)
            $this->form_validation->set_message($msj['regla'], $msj['mensaje']);
        // inicio asignando las reglas y mensajes de validacion
    }

    function set_reglas_validacion() {
        $prefijo = $this->prefijo;
        $config = array(
//            array(
//                'field' => $prefijo . 'login',
//                'label' => 'CI o Pasaporte',
//                'rules' => 'required'
//            ),
            array(
                'field' => $prefijo . 'pass',
                'label' => 'Contraseña',
                'rules' => 'required'
            )
        );
        return $config;
    }

    function set_mensajes_error() {
        $mensajes = array(
            array(
                'regla' => 'required',
                'mensaje' => 'Debe introducir el campo %s'
            ),
            array(
                'regla' => 'min_length',
                'mensaje' => 'El campo %s debe tener al menos %s carácteres'
            ),
            array(
                'regla' => 'valid_email',
                'mensaje' => 'Debe escribir una dirección de email correcta'
            )
        );
        return $mensajes;
    }

    function cerrar_session() {
        session_destroy();
        redirect();
    }

    function cambiar_letras($cadena) {
        $nueva_cadena = str_replace('a', '9', $cadena);
        $nueva_cadena = str_replace('e', '3', $nueva_cadena);
        $nueva_cadena = str_replace('i', '1', $nueva_cadena);
        $nueva_cadena = str_replace('o', '0', $nueva_cadena);
        $nueva_cadena = str_replace('u', '4', $nueva_cadena);
        return $nueva_cadena;
    }

}

?>