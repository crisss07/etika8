<?php

class Convocatorias extends CI_Controller {

    var $titulo;
    var $controlador = 'convocatorias/';
    var $carpeta = 'convocatorias/';

    function __construct() {
        parent::__construct();
        remove_ssl();
        $this->load->helper(array('url', 'form'));
        $this->load->helper('html');

        $this->load->library('Tool_general');
        $this->load->library('Tool_entidad');
        //$this->cabecera['titulo_general']='¿Qué es el observatorio?';
        $this->sub = '';
        //$this->ruta=base_url().'archivos/';
        $this->ruta = $this->tool_entidad->sitio() . 'archivos/';
        $this->rutabaseimg = $this->tool_entidad->baseurlimg();
        $this->rutadj = 'archivos/';
        $this->urifull = $this->uri->uri_to_assoc();
        $this->cabecera['titulo_general'] = 'Convocatorias Vigentes';
        $this->boton = 1;
        $this->tabla = 'convocatoria';
        $this->prefijo = 'con_';
        $this->tablaP = 'postulante';
        $this->prefijoP = 'pos_';
        $this->cuadro_actual = 'convocatorias';

        //$this->ruta=base_url().'archivos/';
        $this->plantilla = 'plantilla_publico';
        @session_start();
        if (!@isset($_SESSION['count'])) {
            @$_SESSION['count'] = 0;
            $this->db->query('update cont set cont_id=cont_id+1 where cont_id=cont_id');
        }
    }

    // function index() {
    //     $this->load->view('index/pagina_construccion');
    // }

    function index() {
        //$this->dbC = $this->load->database('convocatoria', TRUE);
        $consulta = $this->db->query('
        SELECT *
        FROM convocatoria
        WHERE con_tope>="' . date('Y-m-d') . '" and con_interno != "1"
        ORDER BY con_id desc');
//        $consulta = $this->dbC->query('
//        select * from convocatoria limit 5');
        $fila = $consulta->result_array();
        $contenido['fila'] = $fila;
        $data['contenido'] = $this->load->view($this->carpeta . 'index', $contenido, true);
        //$this->db = $this->load->database('default', TRUE);
        $this->load->view('plantilla_publico_2019_etika', $data);
    }

//     function ver() {
//         //$this->dbC = $this->load->database('convocatoria', TRUE);
//         $id = $this->urifull['id'];

// //        if (!$id) {
// //            $id = 1;
// //        }

//         $consulta = $this->db->query('
//         SELECT * FROM ' . $this->tabla . ' where ' . $this->prefijo . 'id=' . $id);
//         $fila = $consulta->row_array();

//         $contenido['fila'] = $fila;

//         $contenido['id'] = $id;
//         $vista = $fila['pla_id'];

//         if ($vista == 0 || $vista == 1) {
//         	$data['contenido'] = $this->load->view($this->carpeta . 'ver1', $contenido, true);
//         	$this->load->view('plantilla_publico_2019_etika', $data);
//         }
//         if ($vista == 2) {
//         	$data['contenido'] = $this->load->view($this->carpeta . 'ver2', $contenido, true);
//         	$this->load->view('plantilla_publico_2019_etika', $data);
//         }
//         if ($vista == 3) {
//         	$data['contenido'] = $this->load->view($this->carpeta . 'ver3', $contenido, true);
//         	$this->load->view('plantilla_publico_2019_etika', $data);
//         }
        
//     }

        function ver() {
            //$this->dbC = $this->load->database('convocatoria', TRUE);
            $id = $this->urifull['id'];

    //        if (!$id) {
    //            $id = 1;
    //        }

            $consulta = $this->db->query('
            SELECT * FROM ' . $this->tabla . ' where ' . $this->prefijo . 'id=' . $id);
            $fila = $consulta->row_array();

            $contenido['fila'] = $fila;

            $contenido['id'] = $id;
            $data['contenido'] = $this->load->view($this->carpeta . 'ver', $contenido, true);
            //$this->db = $this->load->database('default', TRUE);
            $this->load->view('plantilla_publico_2019', $data);
        }

    function postular() {
        $this->dbC = $this->load->database('convocatoria', TRUE);
        $ci = $this->input->post('ci');
        $consulta = $this->dbC->query('
        SELECT ' . $this->prefijoP . 'documento FROM ' . $this->tablaP . ' where ' . $this->prefijoP . 'documento=' . $ci);
        $fila = $consulta->row_array();

        $this->db = $this->load->database('default', TRUE);
        $data['contenido'] = $this->load->view($this->carpeta . 'form', $contenido, true);
        $this->load->view('plantilla_publico_2019_etika', $data);
    }

    function registrate_talentos() {
        //$this->dbC = $this->load->database('convocatoria', TRUE);

        $fila['con_cargo'] = "REGISTRATE EN TALENTOS";
        $fila['con_descripcion'] = '<p style="text-align: center;"><span style="font-size: large;"><strong>REGISTRATE EN TALENTOS</strong></span></p>
<p><span style="font-size: small;">ETIKA es requerida por empresas, ONGs y otras organizaciones para realizar b&uacute;squedas de Gerentes y Especialistas.</span></p>
<p><span style="font-size: small;">Si cuentas con la formaci&oacute;n y experiencia para este tipo de cargos, ingresa tu curriculum vitae en nuestra base de datos para que sea evaluado en alguna b&uacute;squeda. Para ello puedes descargar el formulario en esta p&aacute;gina o enviarnos en un formato propio a seleccion1@etika.com.bo<br /></span></p>
<p style="text-align: justify;"><span style="font-size: small;">Tambi&eacute;n puedes suscribir tu correo electr&oacute;nico en nuestro bolet&iacute;n electr&oacute;nico <a href="/index.php/boletin/principal">http://www.etika.com.bo/index.php/boletin/principal</a> para recibir las convocatorias vigentes. </span></p>
<p style="text-align: justify;"><span style="font-size: small;">Si estamos en proceso de b&uacute;squeda de personal y tu curr&iacute;culum califica para el cargo nos contactaremos contigo para continuar con el proceso de selecci&oacute;n.</span></p>
<p><span style="font-size: small;">Gracias por tu confianza.</span></p>
<p><span style="font-size: small;">El equipo de ETIKA</span></p>';
        $contenido['fila'] = $fila;
        $data['contenido'] = $this->load->view($this->carpeta . 'ver_talentos', $contenido, true);
        //$this->db = $this->load->database('default', TRUE);
        $this->load->view('plantilla_publico_2019_etika', $data);
    }

    function ver_noticias() {
            // $id = $this->urifull['id'];

            // $consulta = $this->db->query('
            // SELECT * FROM ' . $this->tabla . ' where ' . $this->prefijo . 'id=' . $id);
            // $fila = $consulta->row_array();

            // $contenido['fila'] = $fila;
            $contenido['fila'] = 'hola';

            // $contenido['id'] = $id;
            $data['contenido'] = $this->load->view('convocatorias/ver_noticia', $contenido, true);
            //$this->db = $this->load->database('default', TRUE);
            $this->load->view('plantilla_publico_2019', $data);
        }

}
