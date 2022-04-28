<?php

// require_once './php_mailer/class.phpmailer.php';
// require_once './php_mailer/class.smtp.php';
// require_once './php_mailer/envio_email_contacto.php';

require_once './PHPMailer/Exception.php';
require_once './PHPMailer/PHPMailer.php';
require_once './PHPMailer/SMTP.php';
require_once './PHPMailer/Envio_email_contacto.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// use PHPMailer\PHPMailer\SMTP;

class Contacto extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (@in_array($this->uri->segment(1), $this->config->item('sin_ssl_pages'))) {
            remove_ssl();
        } else {
            force_ssl();
        }

        $this->load->helper(array('url', 'form'));
        $this->load->library('Form_validation');

        $this->load->helper('html');
        $this->load->library('Tool_general');
        $this->load->library('Securimage');
        $this->titulo_boton = 'Contacto';
        $this->tabla = 'contacto';
        $this->prefijo = 'con_';
        //$this->ruta=base_url().'archivos/feditable/';        
        $this->carpeta = 'contacto/';
        $this->controlador = 'contacto';
        $this->rutaimg = base_url() . 'files/img/';
        $this->formulario = 'contacto_form';
        $this->no_mostrar_enlaces = 1;
        $this->contenido_completo = 1;
        $this->urifull = $this->uri->uri_to_assoc();

        if (@$this->urifull['cargo']) {
            $this->titulo_hoja = 'Contacto con el Responsable del Proceso';
            $qry = $this->db->query('
            SELECT * FROM convocatoria WHERE con_id=' . $this->urifull['cargo']);
            $convocatoria = $qry->row_array();
            if ($convocatoria['eti_id1']) {
                $qry = $this->db->query('
                SELECT eti_email as email FROM etiko WHERE eti_id=' . $convocatoria['eti_id1']);
                $email = $qry->row_array();
                $this->email_destino = $email['email'];
            }
            if ($convocatoria['eti_id2']) {
                $qry = $this->db->query('
                SELECT eti_email as email FROM etiko WHERE eti_id=' . $convocatoria['eti_id2']);
                $email = $qry->row_array();
                if (@$email['email'])
                    $this->email_destino2 = $email['email'];
            }
        }else {
            $departamentoCorreo = isset($_POST["departamento"]) ? $_POST["departamento"] : 1;

            $this->titulo_hoja = 'Contáctenos';
            $this->departamentos[-1] = 'Seleccione el departamento';
            $this->departamentos[1] = 'La Paz';
            $this->departamentos[2] = 'Santa Cruz';
            $consulta = $this->db->query('
            SELECT con_email as email, con_id as id FROM contacto');
            $emails = $consulta->result_array();
            foreach ($emails as $row) {
                $this->emails[$row['id']] = $row['email'];
            }
            $qry = $this->db->query('
            SELECT con_email,con_pie,con_mesaje_enviado FROM contacto WHERE con_id=' . $departamentoCorreo);
            $resul = $qry->row_array();
            $qryMessage = $this->db->query('SELECT con_mesaje_enviado FROM contacto WHERE con_id=1');
            $resulMessage = $qryMessage->row_array();
            $this->email_destinoC = @$resul['con_email'];
        }

        $this->completo = 1;
        @$this->parrafo = $resul['con_pie'];
        @$this->msje = $resulMessage['con_mesaje_enviado'];
        if (!@$resulMessage) {
            $this->msje = 'Estimado postulante, su consulta ha sido enviada, en los siguientes días un ejecutivo de Etika le responderá. Gracias';
        }
        @session_start();
        $this->presession = $this->tool_entidad->presession();
        if (!isset($_SESSION[$this->presession . 'usuario'])) {
            redirect(base_url() . index_page());
        }
        $this->definir_form();
    }

    function contacto_prueba(){

        // $email_envio = "rodri07crisss@gmail.com";
        // $oMail= new PHPMailer();
        // $oMail->isSMTP();
        // $oMail->Host="smtp.gmail.com";
        // $oMail->Port=587;
        // $oMail->SMTPSecure="tls";
        // $oMail->SMTPAuth=true;
        // $oMail->Username="sjosefer07@gmail.com";
        // $oMail->Password="ewbcczrzqacomnku";
        // $oMail->setFrom($email_envio, "Cristian Salinas");
        // $oMail->addAddress("cchamby@dibeltecnologia.com","CChamby");
        // $oMail->Subject="cabecera prueba";
        // $oMail->msgHTML("Hola soy un mensaje");

        // $email_envio = "seleccion2@etika.net.bo";
        // $oMail= new PHPMailer();
        // $oMail->isSMTP();
        // $oMail->Host="smtp.etika.net.bo";
        // $oMail->Port=25;
        // $oMail->SMTPSecure="tls";
        // $oMail->SMTPAuth=true;
        // $oMail->Username="seleccion2@etika.net.bo";
        // $oMail->Password="seleccion2021";
        // $oMail->setFrom($email_envio, "Cristian Salinas");
        // $oMail->addAddress("cchamby@dibeltecnologia.com","CChamby");
        // $oMail->Subject="cabecera prueba";
        // $oMail->msgHTML("Hola soy un mensaje");

        // $email_envio = "seleccion2@etika.net.bo";
        // $oMail= new PHPMailer();
        // $oMail->isSMTP();
        // $oMail->Host="etika.net.bo";
        // $oMail->Port=25;
        // $oMail->SMTPSecure="tls";
        // $oMail->SMTPAuth=true;
        // $oMail->Username="seleccion2@etika.net.bo";
        // $oMail->Password="seleccion2021";
        // $oMail->setFrom($email_envio, "Cristian Salinas");
        // $oMail->addAddress("cchamby@dibeltecnologia.com","CChamby");
        // $oMail->Subject="cabecera prueba";
        // $oMail->msgHTML("Hola soy un mensaje");
         
        // if(!$oMail->send())
        //   echo $oMail->ErrorInfo;

        $oMail= new PHPMailer();
        $oMail->isSMTP();
        $oMail->Host="etika.net.bo";
        // $oMail->Host="smtp.gmail.com";
        $oMail->Port=25;
        // $oMail->Port=587;
        $oMail->SMTPSecure='tls';
        $oMail->SMTPAuth=true;
        $oMail->SMTPAutoTLS = false;
        $oMail->SMTPKeepAlive = true;
        $oMail->Username="seleccion2@etika.net.bo";
        // $oMail->Username="sisetika@gmail.com";
        // $oMail->Username="controlbole@etika.net.bo";
        $oMail->Password="seleccion2021";
        // $oMail->Password="ewbcczrzqacomnku";
        // $oMail->Password="tvfxytqgqswhzomc";
        // $oMail->Password="dibel123";
        $oMail->CharSet = 'UTF-8';
        $oMail->SMTPDebug = true; 
        $oMail->setFrom("seleccion2@etika.net.bo", "ETIKA");
        $oMail->addAddress("cchamby@dibeltecnologia.com","CChamby");
        // $oMail->addAddress('rsecko@dibeltecnologia.com', $nombre_postulante);
        $oMail->Subject='hola';
        $oMail->msgHTML('hola prueba');
        $oMail->isHTML(true);
        $oMail->SMTPOptions = array(
                                    'ssl' => array(
                                    'verify_peer' => false,
                                    'verify_peer_name' => false,
                                    'allow_self_signed' => true
                                    )
                                    );

        if(!$oMail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $oMail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }


       

    }

    function index() {
        if (@$this->urifull['cargo'])
            $contenido['action'] = $this->tool_entidad->sitioindex() . 'contacto/agregar/cargo/' . $this->urifull['cargo'];
        else
            $contenido['action'] = $this->tool_entidad->sitioindex() . 'contacto/agregar';
        $data['contenido'] = $this->load->view($this->carpeta . $this->formulario, $contenido, true);

        $consulta = $this->db->query('
        SELECT pof_estado as estado
        FROM postulante_f
        WHERE pos_id=' . $_SESSION[$this->presession . 'id']);
        $estado = $consulta->row_array();
        // var_dump($estado);
        // exit;
        $data['editar'] = $this->estado_usuario($_SESSION[$this->presession . 'id']);
        if (!$estado['estado']) {
            $data['noestado'] = 1;
        }
        $this->load->view('plantilla_publico_2019', $data);
    }

    function agregar() {

        // $mail = new PHPMailer;
        // $envioCorreo = new envio_email_contacto($mail);

        $img = new Securimage();
        $prefijo = $this->prefijo;
        @$fila['consulta'] = $_POST["consulta"];
        @$fila['departamento'] = $_POST["departamento"];

        if (!@$fila['consulta']) {
            @$error['consulta'] = 'Debe Ingresar la Consulta';
        }
        if (@$this->departamentos) {
            if (!preg_match('/^[0-9]+$/', $fila['departamento'])) {
                @$error['departamento'] = 'Debe Seleccionar un Departamento';
            }
        }

        // $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify'; 
        // $recaptcha_secret = '6LcjQckaAAAAAMjz8dvlOTiBCcRlBQAk_jm14KSx'; 
        // $recaptcha_response = $_POST['id_captcha']; 
        // $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response); 
        // $recaptcha = json_decode($recaptcha); 

        // if($recaptcha->score < 0.5){
        //     @$error['recaptcha'] = 'Eres un robot';
        // }

        if (@$error) {
            // var_dump('entro aqui');
            // exit;
            if (@$this->urifull['cargo'])
                $contenido['action'] = $this->tool_entidad->sitioindex() . 'contacto/agregar/cargo/' . $this->urifull['cargo'];
            else
                $contenido['action'] = 'agregar';
            $contenido['fila'] = $fila;
            $contenido['error'] = $error;
            $data['contenido'] = $this->load->view($this->carpeta . $this->formulario, $contenido, true);
            $consulta = $this->db->query('
            SELECT pof_estado as estado
            FROM postulante_f
            WHERE pos_id=' . $_SESSION[$this->presession . 'id']);
            $estado = $consulta->row_array();
            $data['editar'] = $this->estado_usuario($_SESSION[$this->presession . 'id']);
            if (!$estado['estado']) {
                $data['noestado'] = 1;
            }
            $this->load->view('plantilla_publico_2019', $data);
        } else {

            $msj = '';
            $consulta = $this->db->query('
                SELECT pos_email as email
                FROM postulante
                WHERE pos_id=' . $_SESSION[$this->presession . 'id']);
            $pos = $consulta->row_array();
            $ip = getenv("REMOTE_ADDR");
            $host = getenv("REMOTE_HOST");
            $cliente = getenv("HTTP_USER_AGENT");
            $fecha = date("D M d H:i:s Y");
            $arroba = strpos(@$email, "@");
            $punto = strpos(@$email, ".");
            $iphost = 'IP: ' . $ip . ' ' . $host . '   Cliente: ' . $cliente . '  ';
            $email = $pos['email'];
            $usuario = $_SESSION[$this->presession . 'usuario'];
            $nombre = $_SESSION[$this->presession . 'nombre'];
            $consulta = $this->input->post('consulta');
            // $email_destino = "cchamby@dibeltecnologia.com";
            //var_dump($email);
            $datos = 'Nombre : ' . $nombre;
            $msj = '     Nombre : ' . $nombre . '<br/>	
                         Usuario : ' . $usuario . '<br/>
                         Email : ' . $email . '<br/>
                         ______________________________________________________________<br/>
                         Consulta : ' . $consulta . '  ';

            if (!empty($_POST["departamento"])) {
                $qry = $this->db->query('
                SELECT * FROM contacto WHERE con_id=' . $_POST["departamento"]);
                $resul = $qry->row_array();

                $email_destino = $resul['con_email'];
                // $email_destino = "cchamby@dibeltecnologia.com";
            } else {

                $qry = $this->db->query('
                SELECT * FROM contacto WHERE con_id= 1');
                $resul = $qry->row_array();
                $email_destino = $resul['con_email'];

                
                //inicio codigo criss email Corregir el destinatario de correo electrónico al momento de desvincularse
                //codigo de prueba esto comentar
                // $qry = $this->db->query('
                // SELECT * FROM contacto WHERE con_id=' . $_POST["departamento"]);
                // $resul = $qry->row_array();
                // $email_destino = $resul['con_email'];
                //fin de codigo de prueba

                // $convocatoria_idd = @$this->urifull['cargo'];
                // $consulta_convocatoria = $this->db->query('
                // SELECT * FROM convocatoria WHERE con_id=' . $convocatoria_idd);
                // $resul1 = $consulta_convocatoria->row_array();
                // $id_etiko_1 = $resul1['eti_id1'];

                // $consulta_etiko = $this->db->query('
                // SELECT * FROM etiko WHERE eti_id=' . $id_etiko_1);
                // $resul2 = $consulta_etiko->row_array();
                // $email_destino = $resul2['eti_email'];
                // fin de codigo criss email Corregir el destinatario de correo electrónico al momento de desvincularse
            }
            
            //datos email
           

            $oMail = new PHPMailer;
            $envioCorreo = new Envio_email_contacto($oMail);
            // $nombre = 'Cristian';
            //mensaje_contacto($email='email del postulante',
            //$email_destino='email a donde se enviara' opc 1 =informacion@etika.net.bo
            //opc 2 = recepcion@etika.net.bo   ..scz
            $resultado = $envioCorreo->mensaje_contacto($oMail, $email, $nombre, $email_destino, 'Sistema de Postulación - Desvincular',$msj);

//            $msj = $iphost . '
//
//                         Nombre : ' . $nombre . '	
//                         Usuario : ' . $usuario . '
//                         ______________________________________________________________
//                         Consulta : ' . $consulta . '  ';
            // $oMail= new PHPMailer();
            // $resultado = $envioCorreo->formularioContacto($email_destino, $nombre, $msj, 'Sistema de Postulación - Desvincular');


            // $oMail->isSMTP();
            // $oMail->Host="smtp.gmail.com";
            // $oMail->Port=587;
            // $oMail->SMTPSecure="tls";
            // $oMail->SMTPAuth=true;
            // $oMail->Username="sjosefer07@gmail.com";
            // $oMail->Password="ewbcczrzqacomnku";
            // $oMail->CharSet = 'UTF-8';
            // $oMail->setFrom("sjosefer07@gmail.com", $nombre);
            // // $oMail->FromName=$email;
            // // $oMail->addReplyTo($email, $nombre);
            // $oMail->addAddress($email_destino);
            // $oMail->Subject="Sistema de Postulación - Desvincular";
            // $oMail->msgHTML($msj);

            // // $mail->setFrom('jaroslaw.frydrych@plej.pl', 'Mailer');
            // // $mail->addReplyTo('jaroslaw.frydrych@plej.pl', 'Information');
            // // $mail->isHTML(true);
            // // $mail->Subject = 'Hej, ' . $recipient['fullName'] . ' mamy życzenia dla Ciebie';
            // // $mail->Body = $body;
            // // //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            // // $mail->addAddress($recipient['email'], $recipient['fullName']);


            // if(!$oMail->send())
            //     echo $oMail->ErrorInfo; 

            // var_dump($email_destino);
            // var_dump('<br>');
            // var_dump($email);
            // var_dump('<br>');
            // var_dump($msj);
            // var_dump('<br>');
            // exit;


//             $resultado = $envioCorreo->formularioContacto($email_destino, $email, $msj, 'Sistema de Postulación - Desvincular');

//             var_dump($resultado);
//             exit;

//             // var_dump($resultado);
//             // exit;
            
//             if (@$email_destino) {
                
// //                $resultado = $envioCorreo->formularioContacto('fchoque@dibeltecnologia.com', $email, $msj, 'Sistema de Postulación - Desvincular');
//                 $resultado = $envioCorreo->formularioContacto($email_destino, $email, $msj, 'Sistema de Postulación - Desvincular');
// //                mail($this->email_destino, 'Sistema de Postulación - Desvincular', $msj, "Date: $fecha\nFrom: \"$nombre\" <$email>\nReply-To:  $email\nX-Mailer: PHP/" . phpversion());
//             }
//             if (@$email_destino2) {
//                 var_dump($this->email_destino2);
//                 exit;
// //                $resultado = $envioCorreo->formularioContacto('fchoque@dibeltecnologia.com', $email, $msj, 'Sistema de Postulación - Desvincular');
//                 $resultado = $envioCorreo->formularioContacto($email_destino2, $email, $msj, 'Sistema de Postulación - Desvincular');
// //                mail($this->email_destino2, 'Sistema de Postulación - Desvincular', $msj, "Date: $fecha\nFrom: \"$nombre\" <$email>\nReply-To:  $email\nX-Mailer: PHP/" . phpversion());
//             }
//             if (@$email_destinoC) {
//                 $resultado = $envioCorreo->formularioContacto($email_destinoC, $email, $msj, 'Consulta - Sistema de Postulación');
// //                mail($this->email_destinoC, 'Consulta - Sistema de Postulación', $msj, "Date: $fecha\nFrom: \"$nombre\" <$email>\nReply-To:  $email\nX-Mailer: PHP/" . phpversion());
//             }
            $this->definir_form();
            $contenido['mensaje_exito'] = 1;
            $data['contenido'] = $this->load->view($this->carpeta . 'contacto_form', $contenido, true);
            $consulta = $this->db->query('
            SELECT pof_estado as estado
            FROM postulante_f
            WHERE pos_id=' . $_SESSION[$this->presession . 'id']);
            $estado = $consulta->row_array();
            //var_dump($_SESSION[$this->presession.'id']);
            $data['editar'] = $this->estado_usuario($_SESSION[$this->presession . 'id']);
            if (!$estado['estado']) {
                $data['noestado'] = 1;
            }
            $this->load->view('plantilla_publico_2019', $data);
        }
    }

    function estado_usuario($id) {
        $consulta = $this->db->query('
        SELECT count(*) as nro
        FROM convocatoria_postulacion
        WHERE pos_id=' . $id . ' and con_estado="0"'
        );
        $con_pos = $consulta->row_array();
        $consulta = $this->db->query('
        SELECT count(*) as nro
        FROM etapas
        WHERE pos_id=' . $id . ' and eta_estado="0"'
        );
        $etapas = $consulta->row_array();
        if ($con_pos['nro'] || $etapas['nro'])
            return 1;
        else
            return 0;
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
            //array(
            //    'field' => 'captcha',
            //    'label' => 'Codigo',
            //    'rules' => 'required'
            //),
            array(
                'field' => $prefijo . 'consulta',
                'label' => 'Consulta',
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
            ),
            array(
                'regla' => 'is_natural',
                'mensaje' => 'Debe seleccionar una tema'
            )
        );
        return $mensajes;
    }

}

?>