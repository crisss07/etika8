<?php

class Inicio extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (in_array($this->uri->segment(1), $this->config->item('sin_ssl_pages'))) {
            remove_ssl();
        } else {
            force_ssl();
        }
        $this->load->helper(array('url', 'form'));
        $this->load->helper('html');

        $this->no_mostrar_enlaces = 1;
        $this->contenido_completo = 1;
        $this->urifull = $this->uri->uri_to_assoc();
        $this->rutabase = $this->tool_entidad->sitioindex();
        $this->rutarchivo = $this->tool_entidad->sitio() . 'archivos/';
        $this->rutabaseimg = $this->tool_entidad->baseurlimg();
        $this->rutadj = 'archivos/';
        $this->rutaimg = $this->tool_entidad->sitio() . 'files/img/';
        session_start();
        $this->presession = $this->tool_entidad->presession();
        if (!isset($_SESSION[$this->presession . 'usuario'])) {
            redirect(base_url() . index_page());
        }
    }

    function index() {
        $this->cabecera['titulo'] = 'Pagina de Inicio';
        $id = $_SESSION[$this->presession . 'id'];
        $consulta = $this->db->query('
        SELECT *
        FROM educacion_secundaria
        WHERE pos_id=' . $id);
        $secundaria = $consulta->result_array();
        $consulta = $this->db->query('
        SELECT *
        FROM trayectoria_laboral
        WHERE pos_id=' . $id);
        $trayectorias = $consulta->result_array();
        if (!$secundaria) {
            $contenido['instruccion'] = 1;
        }
        if (!$trayectorias) {
            $contenido['trayectoria'] = 1;
        }

        $consulta = $this->db->query('
        SELECT *
        FROM convocatoria
        WHERE con_tope>="' . date('Y-m-d') . '" and con_interno != "1"
        ORDER BY con_id desc'
        );
        $convocatorias = $consulta->result_array();
        $consulta = $this->db->query('
        SELECT *, (date_format(b.con_fecha_creacion,"%Y-%m-%d") + INTERVAL 20 DAY) as fecha_edicion, date_format(a.con_fecha_edicion, "%Y-%m-%d") as fecha
        FROM convocatoria_postulacion a, convocatoria b
        WHERE pos_id=' . $id . ' and b.con_id=a.con_id1 and (b.con_tope + INTERVAL 20 DAY) >="' . date('Y-m-d') . '"
        ORDER BY a.con_fecha_creacion asc'
        );
        $postulaciones = $consulta->result_array();
        foreach ($postulaciones as $postulacion) {
            foreach ($convocatorias as $numero => $convocatoria) {
                if ($convocatoria['con_id'] == $postulacion['con_id1']) {
                    unset($convocatorias[$numero]);
                }
            }
        }
        $consulta = $this->db->query('
        SELECT *
        FROM noticia
        ORDER BY not_fecha_creacion desc, not_id desc'
        );
        $anuncios = $consulta->result_array();
        $consulta = $this->db->query('
        SELECT pof_estado as estado
        FROM postulante_f
        WHERE pos_id=' . $id);
        $consultaDisponibilidad = $this->db->query('
        SELECT
        com_id as id,
        com_nombre as nombre 
        FROM combos
        where com_tipo=14
        ORDER BY com_orden asc'
        );
        $disponibilidad = $consultaDisponibilidad->result_array();
        $consultaDisponible = $this->db->query('
                            SELECT pof_estado
                            FROM postulante_f
                            WHERE pos_id=' . $id
        );
        $idDisponible = $consultaDisponible->row_array();

        $estado = $consulta->row_array();
        $contenido['cabecera'] = $this->cabecera;
        $contenido['convocatorias'] = $convocatorias;
        $contenido['postulaciones'] = $postulaciones;
        $contenido['anuncios'] = $anuncios;
        $contenido['estado'] = $estado;
        $contenido['disponibilidad'] = $disponibilidad;
        $contenido['idDisponible'] = $idDisponible;
        $contenido['id'] = $id;
        $contenido['editar'] = $this->estado_usuario($id);
        $data['contenido'] = $this->load->view('inicio/index', $contenido, true);
        $data['paginicio'] = 1;
        $data['editar'] = $this->estado_usuario($id);
        if ($estado['estado']==257) {
            $data['noestado'] = 1;
        }
        $this->load->view('plantilla_publico', $data);
    }

    function mostrar() {

        $idp = $_SESSION[$this->presession . 'id'];
        $consulta = $this->db->query('
        SELECT *
        FROM educacion_secundaria
        WHERE pos_id=' . $idp);
        $secundaria = $consulta->result_array();
        $consulta = $this->db->query('
        SELECT *
        FROM trayectoria_laboral
        WHERE pos_id=' . $idp);
        $trayectorias = $consulta->result_array();
        if (!$secundaria) {
            $contenido['instruccion'] = 1;
        }
        if (!$trayectorias) {
            $contenido['trayectoria'] = 1;
        }

        $id = $this->urifull['id'];
        $consulta1 = $this->db->query('
        select * from convocatoria where con_id=' . $id);
        $fila = $consulta1->row_array();
        $rutacces = array(
            'nombre1' => $titulo = 'Pagina de Inicio',
            'enlace1' => $this->rutabase . 'inicio',
            'nombre2' => $fila['con_cargo'],
            'enlace2' => '#'
        );
        $consulta = $this->db->query('
        SELECT pof_estado as estado
        FROM postulante_f
        WHERE pos_id=' . $idp);
        $estado = $consulta->row_array();
        
       
        
        $contenido['rutacces'] = $rutacces;
        $contenido['boton'] = $this->boton;
        $contenido['cabecera'] = $this->cabecera;
        $contenido['estado'] = $estado;
        $contenido['fila'] = $fila;
        $data['contenido'] = $this->load->view('inicio/mostrar', $contenido, true);
        $this->load->view('plantilla_publico', $data);
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

    function cerrar_session() {
        session_destroy();
        redirect();
    }

}

?>