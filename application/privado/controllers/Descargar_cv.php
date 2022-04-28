<?php

require_once('Controladoradmin.php');

class Descargar_cv extends Controladoradmin {

    function __construct() {
        // parent::Controladoradmin();
        parent::__construct();
        force_ssl();
        $this->load->helper(array('url', 'form', 'html'));
        $this->load->library(array('form_validation', 'tool_general'));

        //****** definiendo nombre de carpeta por defecto
        $this->carpeta = 'descargar/';
        $this->controlador = 'descargar/';
        $this->controladorP = 'postulante/';

        $this->rutaimg = $this->tool_entidad->constantes['nombresitio'] . 'files/img/';
        $this->action_defecto = 'listar';

        $this->cabecera['titulo'] = 'Descargar';
        $this->boton = 6;
        $this->presession = $this->tool_entidad->presession();
        $this->tablaP = 'postulante';
        $this->prefijoP = 'pos_';
        $this->tablaT = 'trayectoria_laboral';
        $this->prefijoT = 'tra_';
        session_start();
        if (!isset($_SESSION[$this->presession . 'usuario'])) {
            redirect(base_url() . index_page());
        }
    }

    function index() {
        $contenido['cabecera'] = $this->cabecera;
        $data['contenido'] = $this->load->view($this->carpeta . 'index', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function cv() {
        $this->cabecera['acticion'] = 'CV';
        $contenido['cabecera'] = $this->cabecera;
        $campos_listar = array('Documento', 'Apellido Paterno', 'Apellido Materno', 'Nombres', 'Tel&eacute;fono', 'Celular', 'Email');
        $campos_reales = array('documento', 'apaterno', 'amaterno', 'nombre', 'telefono', 'celular', 'email');
        $tipoExhaustiva = $this->input->post('tipoexhaustiva');
        $valorBusqueda = $this->input->post('valorBusqueda');
        $idPostulantes = $_SESSION['idPostulantes'];
        $resultado = array();

        if ($idPostulantes && $valorBusqueda != "" && $tipoExhaustiva > 0) {
            switch ($tipoExhaustiva) {
                case 1:
                    $adicionarCL = array_search("Cargos Ocupados", $campos_listar, false);
                    if (!$adicionarCL) {
                        $campos_listar[] = "Cargos Ocupados";
                    }
                    $andLike = " and " . $this->prefijoT . "cargos like ('%" . $valorBusqueda . "%')";
                    $campo = "tra_cargos as resultado";
                    break;
                case 2:
                    $adicionarCL = array_search("Nombre de la Organización", $campos_listar, false);
                    if (!$adicionarCL) {
                        $campos_listar[] = "Nombre de la Organización";
                    }
                    $andLike = " and " . $this->prefijoT . "organizacion like ('%" . $valorBusqueda . "%')";
                    $campo = "tra_organizacion as resultado";
                    break;
            }


            $consultaExhaustiva = $this->db->query('select p.' . $this->prefijoP . 'id,
                                                            ' . $this->prefijoT . 'id, 
                                                            ' . $this->prefijoP . 'documento as documento,
                                                            ' . $this->prefijoP . 'apaterno as apaterno,
                                                            ' . $this->prefijoP . 'amaterno as amaterno,
                                                            ' . $this->prefijoP . 'nombre as nombre,
                                                            ' . $this->prefijoP . 'telefono as telefono,
                                                            ' . $this->prefijoP . 'celular as celular,
                                                            ' . $this->prefijoP . 'email as email,
                                                            ' . $campo . '
                                                      from ' . $this->tablaP . ' p
                                                          inner join ' . $this->tablaT . ' tl
                                                              on p.' . $this->prefijoP . 'id=tl.' . $this->prefijoP . 'id
                                                        where p.' . $this->prefijoP . 'id in(' . implode(',', $idPostulantes) . ')' . $andLike . ' ORDER BY apaterno asc');
            $resultado = $consultaExhaustiva->result_array();
            $adicionarCR = array_search("resultado", $campos_reales, false);
            if (!$adicionarCR) {
                $campos_reales[] = "resultado";
            }
        } else {
            $consulta = $this->db->query('select p.' . $this->prefijoP . 'id,
                                                            ' . $this->prefijoP . 'documento as documento,
                                                            ' . $this->prefijoP . 'apaterno as apaterno,
                                                            ' . $this->prefijoP . 'amaterno as amaterno,
                                                            ' . $this->prefijoP . 'nombre as nombre,
                                                            ' . $this->prefijoP . 'telefono as telefono,
                                                            ' . $this->prefijoP . 'celular as celular,
                                                            ' . $this->prefijoP . 'email as email
                                                      from ' . $this->tablaP . ' p
                                                        where p.' . $this->prefijoP . 'id in(' . implode(',', $idPostulantes) . ') ORDER BY apaterno asc');
            $resultado = $consulta->result_array();
        }




        $contenido['procesar'] = @$procesarConsulta;
        $contenido['tipoBusqueda'] = $tipoExhaustiva;
        $contenido['valorBusqueda'] = $valorBusqueda;
        $contenido['campos_reales'] = $campos_reales;
        $contenido['campos_listar'] = $campos_listar;
        $contenido['datos'] = $resultado;
        $data['contenido'] = $this->load->view($this->carpeta . 'descargar', $contenido, true);
        $this->load->view('plantilla_privado', $data);
        
        
//        $this->load->view($this->carpeta . 'descargar', $contenido);
//        $data['contenido'] = $this->load->view($this->carpeta . 'busqueda', $contenido, true);
//        $this->load->view('plantilla_privado', $data);
    }

}
