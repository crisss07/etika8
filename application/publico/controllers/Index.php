<?php

require_once './PHPMailer/Exception.php';
require_once './PHPMailer/PHPMailer.php';
require_once './PHPMailer/SMTP.php';
require_once './PHPMailer/Envio_email_contacto.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Index extends CI_Controller {

    function __construct() {
        parent::__construct();
         
        $this->load->helper('url', 'form');
        $this->load->library('Form_validation');
        $this->load->library('Securimage');

        $this->prefijo = 'pos_';
        $this->load->helper('html');
        $this->definir_form();

        //**base de datos
        $this->campo = array('login', 'pass');
        $this->load->database();

        $this->tabla = 'postulante';

        $this->carpeta = 'index/';
        $this->presession = $this->tool_entidad->presession();
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
    }



    function aviso() {

        $this->load->view('index/aviso', $contenido);
    }

    function nuevo() {
        $contenido['action'] = 'guardar_nuevo';
        $this->load->view('index/index', $contenido);
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
        switch (@$data[$this->prefijo . 'tipodoc']) {
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
        if (!@$error) {
            //por el error del tipo doc 1,2

            // echo $fila[$this->prefijo . 'tipodoc']; exit();
            // if ($fila[$this->prefijo . 'tipodoc']==3) {
            //     $fila[$this->prefijo . 'tipodoc']='1,2';
            //     // echo 'entro if'; exit();
            // }
            // $valor_consulta='SELECT *
            //     FROM ' . $this->tabla . '
            //     WHERE pos_documento = "' . $fila[$this->prefijo . 'documento'] . '" and pos_tipodoc="' . $fila[$this->prefijo . 'tipodoc'] . '"';
            // $consulta = $this->db->query('
            //     SELECT *
            //     FROM ' . $this->tabla . '
            //     WHERE pos_documento = "' . $fila[$this->prefijo . 'documento'] . '" and pos_tipodoc="' . $fila[$this->prefijo . 'tipodoc'] . '"
            //     ');

            $consulta = $this->db->query('
                SELECT *
                FROM ' . $this->tabla . '
                WHERE pos_documento = "' . $fila[$this->prefijo . 'documento'] . '"
                ');

            //se modifico por el error de tipo doc '1,2'
            // var_dump($valor_consulta);exit();

            $postulante = $consulta->row_array();
            if ($postulante) {
                $contenido['mensaje'] = 1;
                $msje = 'El Número de Documento ya ha sido registrado <br/> si desea recuperar su contraseña haga <br/>' . anchor('index/recuperar', 'click aquí') . '<br/> caso contrario escribir a <br/><a href="mailto:infoetika@etika.net.bo" title="ETIKA">infoetika@etika.net.bo</a>';
                $contenido['msje'] = $msje;
                $contenido['action'] = 'guardar_nuevo';
                $this->load->view('index/index', $contenido);
            } else {
                $_SESSION[$this->presession . 'usuario'] = 'us_temporal';
                $_SESSION[$this->presession . 'ci'] = $fila[$this->prefijo . 'documento'];
                $_SESSION[$this->presession . 'tipodoc'] = $fila[$this->prefijo . 'tipodoc'];
                redirect('snewpostulante/datospersonal_nuevo');
            }
        } else {
            $contenido['action'] = 'guardar_nuevo';
            @$contenido['error'] = $error;
            @$contenido['fila'] = $fila;
            $this->load->view('index/index', $contenido);
        }
    }

    function recuperar() {
        $contenido['action'] = 'index/recovery';
//        $this->load->view('index/form_recovery', $contenido);
        $data['contenido'] = $this->load->view($this->carpeta . '/form_recovery', $contenido, true);
        $this->load->view('plantilla_publico_2019_banner', $data);
    }

    function prueba_recovery(){
        $mail = new PHPMailer;
        $envioCorreo = new Envio_email_contacto($mail);
        $nombre = 'Cristian';
        $resultado = $envioCorreo->prueba($nombre);

            var_dump($resultado);
            exit;
    }

    function recovery() {
        $data[$this->prefijo . 'documento'] = $this->input->post($this->prefijo . 'documento');
        $fila[$this->prefijo . 'documento'] = $data[$this->prefijo . 'documento'];
        if ($data[$this->prefijo . 'documento'] == '')
            $error[$this->prefijo . 'documento'] = 'Debe Introducir el Login';

        if (!@$error) {
            $consulta = $this->db->query('
                SELECT pos_id,pos_apaterno,pos_email,pos_documento
                FROM ' . $this->tabla . '
                WHERE pos_documento = "' . $fila[$this->prefijo . 'documento'] . '"');
//                WHERE pos_documento = "'.$fila[$this->prefijo.'documento'].'" and pos_email = "'.$fila[$this->prefijo.'email'].'"');
            $postulante = $consulta->row_array();
            
            if (!$postulante) {
                $contenido['mensaje'] = 1;
                $contenido['msje'] = 'El CI/Pasaporte no coincide.';
//                $contenido['msje'] = 'El CI/Pasaporte o el E-mail no coinciden.';
                $contenido['fila'] = $fila;
                $contenido['action'] = 'index/recovery';
//                $this->load->view('index/form_recovery', $contenido);
                 $data['contenido'] = $this->load->view($this->carpeta . '/form_recovery', $contenido, true);
            $this->load->view('plantilla_publico_2019_banner', $data);
            } else {
                $id = $postulante['pos_id'];
                $nueva_pass = substr(sha1(rand()), 0, 8);
                // var_dump($nueva_pass);
                // exit;
                $this->db->query('update ' . $this->tabla . ' set pos_pass = "' . sha1($nueva_pass) . '" where pos_id = ' . $id);
                $ip = getenv("REMOTE_ADDR");
                $host = getenv("REMOTE_HOST");
                $cliente = getenv("HTTP_USER_AGENT");
                $fecha = date("D M d H:i:s Y");
                // $arroba = strpos($email, "@");
                // $punto = strpos($email, ".");
                //$iphost='IP: '.$ip.' '. $host.'   Cliente: '.$cliente.'  ';
                $login = $postulante[$this->prefijo . 'documento'];
                $email = $postulante[$this->prefijo . 'email'];
                $nombre_postulante = $postulante['pos_apaterno'];
                $datos = 'Recuperar Contraseña ';
                $emailPostulante = explode("@", $email);
                $emailRegistrado = substr($emailPostulante[0], 0, 4) . "***@" . $emailPostulante[1];
                $msj = '

                         ' . $datos . '<br>
                         ______________________________________________________________<br>
                         Usted solicito recuperar contraseña para el Sistema de Postulación ETIKA!!!!<br>
                         CI/Pasaporte: ' . $login . '<br>
                         Nueva Contraseña: ' . $nueva_pass . '<br>
                         Se le recomienda cambiar su contraseña una vez que ingrese.';
                $cabeceras = 'From: Sistema ETIKA <informacion@etika.com.bo>' . "\r\n" .
                        'Reply-To: Sistema ETIKA <informacion@etika.com.bo>' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                
                $oMail = new PHPMailer;
                $envioCorreo = new Envio_email_contacto($oMail);
                // $nombre = 'Cristian';
                $resultado = $envioCorreo->recuperar_contrasena($oMail, $email, $nombre_postulante, 'Sistema ETIKA - Recuperar Contraseña', $msj);
                // var_dump($resultado);
                // exit;

                $contenido['mensaje'] = 1;
                $fila[$this->prefijo . 'documento'] = '';
                $fila[$this->prefijo . 'email'] = '';
                $contenido['msje'] = 'Se ha enviado su nueva contraseña a la dirección de correo ' . $emailRegistrado;
                $contenido['fila'] = $fila;
                $contenido['action'] = 'index/recovery';
//                $this->load->view('index/form_recovery', $contenido);
                $data['contenido'] = $this->load->view($this->carpeta . '/form_recovery', $contenido, true);
                $this->load->view('plantilla_publico_2019_banner', $data);
            }
        } else {
            $contenido['fila'] = $fila;
            $contenido['error'] = $error;
            $contenido['action'] = 'index/recovery';
            $data['contenido'] = $this->load->view($this->carpeta . '/form_recovery', $contenido, true);
            $this->load->view('plantilla_publico_2019_banner', $data);
        }
    }

    function index() {

        //$con = $this->db->query("SELECT * FROM cargos");
        //var_dump($con->row());
        $this->pagianaMantenimiento();
        if (!isset($_SESSION[$this->presession . 'usuario'])) {
            redirect('/index/autenticar');
        } else {
            redirect('/index/autenticar');
        }
    }

    // function index1() {

    //     //$con = $this->db->query("SELECT * FROM cargos");
    //     //var_dump($con->row());
    //     $this->pagianaMantenimiento();
    //     if (!isset($_SESSION[$this->presession . 'usuario'])) {
    //         redirect('/index/autenticar1');
    //     } else {
    //         redirect('/index/autenticar1');
    //     }
    // }

    // function autenticar() {
    //     $this->load->view('index/pagina_construccion');
    // }

    function autenticar() {

        $this->pagianaMantenimiento();
        if ($this->input->post('intentos') >= 2) {
            $contenido['msj'] = 1;
        }
        $this->definir_form();
        $prefijo = $this->prefijo;
        //$modelo = $this->modelo;
        $fila['pos_login'] = $this->input->post($prefijo . 'login');
        //$contenido['fila'] = $fila;
        $contenido['fila'] = $this->input->post($prefijo . 'login');
        $aux=0;
        if ($this->form_validation->run() == FALSE) {
            if ($this->input->post('enviar') == 'INGRESAR') {
                if (!$this->input->post($prefijo . 'login')){
                    $error_login = 'Debe Introducir su CI o Pasaporte';
                }
                if (!$this->input->post($prefijo . 'pass')){
                    $error_pass = 'Debe Introducir su Contraseña';
                }
                $contenido['error_pass'] = @$error_pass;
                $contenido['error_login'] = @$error_login;
            }
            $contenido['action'] = 'autenticar1';
            $this->load->view('index/index', $contenido);
        }
        else {
            $login = $this->input->post($prefijo . 'login');
            $pass = sha1($this->input->post($prefijo . 'pass'));
            $consulta = $this->db->query('
            SELECT * FROM ' . $this->tabla . ' where pos_documento="' . $login . '" and pos_pass="' . $pass . '"');
            $fila = $consulta->result_array();
            if (count($fila) == 1) {
                $fila = $consulta->row_array();
                //if (!isset($_SESSION[$this->presession.'usuario'])) {
                $_SESSION[$this->presession . 'usuario'] = $fila['pos_documento'];
                $_SESSION[$this->presession . 'nombre'] = $fila['pos_nombre'] . ' ' . $fila['pos_apaterno'] . ' ' . $fila['pos_amaterno'];
                $_SESSION[$this->presession . 'id'] = $fila['pos_id'];
                $_SESSION[$this->presession . 'email'] = $fila['pos_email'];
                //}                
                redirect('ninicio');
            } else {
                //redirect('index/autenticar');
                $aux=$this->input->post('intentos');
                $intentos = ++$aux;
                $contenido['user_error'] = 'Usuario Incorrecto';
                $contenido['intentos'] = $intentos;
                $this->load->view('index/index', $contenido);
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
            array(
                'field' => $prefijo . 'login',
                'label' => 'CI o Pasaporte',
                'rules' => 'required'
            ),
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

    function pagianaMantenimiento() {
        $fecha = date("d/m/Y");
        $fecha = '18/11/2018';

        if ($fecha >= '19/11/2018') {
            ?>
            <div style="width: 75%;margin: auto;">
                <br/>
                <br/>
                <br/>
                <img src="/sisetika/files/img/maq/banner.jpg" title="ETIKA">

            </div>
            <div style="width: 50%;margin: auto;">
                <p>
                    Apreciado/a Postulante:
                </p>

                <p>
                    Estamos realizando un cambio en nuestro sistema, para cualquier 
                    consulta o postulación puede escribir a 
                    <a href="mailto:seleccion1@etika.com.bo">seleccion1@etika.com.bo</a>
                    Agradecemos su comprensión.
                </p>
                <p>
                    El Equipo de ETIKA 
                </p>
            </div>
            <?php
            exit();
        }
    }

    public function ubicacion(){
        $this->load->view('index/ubicacion');  
    }

}
?>