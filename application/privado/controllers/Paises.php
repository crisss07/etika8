<?php

require_once('Controladoradmin.php');

class Paises extends Controladoradmin {

    function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form', 'html');
        $this->load->library(array('form_validation', 'tool_general'));

        //****** definiendo nombre de carpeta por defecto
        $this->carpeta = 'paises/';
        $this->controlador = 'paises/';

        $this->tabla = 'paises';
        $this->prefijo = 'pai_';
        //******* definiendo campos de la tabla
        $this->campo = array($this->prefijo . 'nombre');


        $this->formulario_agregar = 'paises_agregar';
        $this->formulario_editar = 'paises_agregar';
        $this->action_defecto = 'listar';


        //****** cargando el modelo
        $this->modelo = 'modelo_combos';
        $this->load->model($this->carpeta . 'paises_model', $this->modelo, TRUE);

        $this->cabecera['titulo'] = 'Administración de Combos';
        $this->rutaimg = @$this->constantes['nombresitio'] . 'files/img/';

        $this->boton = 7;

        $this->vidp = "pai_tipo";
        if ($this->vidp) {
            $uri = $this->uri->uri_to_assoc(3);
            $this->idp = @$uri['idp'];
            $this->msj_retorno = 'Volver';
            $this->ruta_retorno = 'combos';
        }
        $this->orden = $this->prefijo . 'orden';
        $this->presession = $this->tool_entidad->presession();
        session_start();
        if (!isset($_SESSION[$this->presession . 'usuario'])) {
            redirect(base_url() . index_page());
        }
        if ($_SESSION[$this->presession . 'permisos'] >= '2') {
            redirect('inicio');
        }
    }

    function index() {

        $this->cabecera['accion'] = 'Listado';
        $this->campos_listar = array('Nombre', 'Lugar - Campo');
        $this->campos_reales = array($this->prefijo . 'nombre', $this->prefijo . 'tipo');
        $this->hiddens = array($this->prefijo . 'id');

        $consulta = $this->db->query('
        SELECT
        ' . $this->prefijo . 'id,
        ' . $this->prefijo . 'nombre,
        ' . $this->prefijo . 'tipo
        FROM
        ' . $this->tabla . '        
        ORDER BY
        ' . $this->prefijo . 'tipo asc'
        );
        $datos = $consulta->result_array();

        $contenido['campos_listar'] = $this->campos_listar;
        $contenido['campos_reales'] = $this->campos_reales;
        $contenido['hiddens'] = $this->hiddens;
        $contenido['cabecera'] = $this->cabecera;
        $contenido['datos'] = $datos;
        $data['contenido'] = $this->load->view($this->carpeta . 'index', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function listar() {
        $this->cabecera['accion'] = 'Listado';
        if ($this->idp == 1) {
//            $this->campos_listar = array('País');
            $this->campos_listar = array('Nº', 'País');
        } else {
            $this->campos_listar = array('Nº','Ciudad o Localidad');
//            $this->campos_listar = array('Nº', 'Ciudad o Localidad');
        }
//        $this->campos_reales = array($this->prefijo . 'orden', $this->prefijo . 'nombre');
        $this->campos_reales = array($this->prefijo . 'orden', $this->prefijo . 'nombre');
        $this->hiddens = array($this->prefijo . 'id');

        $this->ordencampo = array(
            'campo1' => $this->prefijo . 'orden',
            'campo2' => $this->prefijo . 'nombre'
        );
        $this->ordenlabel = array(
            'campo1' => 'Número',
            'campo2' => 'Nombre'
        );
        if ($this->idp == 1) {
            $consulta = $this->db->query('
        SELECT
        ' . $this->prefijo . 'id,
        ' . $this->prefijo . 'orden,
        ' . $this->prefijo . 'nombre
        FROM
        ' . $this->tabla . '
        where ' . $this->vidp . '="' . $this->idp . '" 
        ORDER BY
        ' . $this->prefijo . 'orden asc'
            );
            $consultaBolivia = $this->db->query('
        SELECT
        ' . $this->prefijo . 'id,
        ' . $this->prefijo . 'orden,
        ' . $this->prefijo . 'nombre
        FROM
        ' . $this->tabla . '
        where ' . $this->vidp . '="' . $this->idp . '" and pai_id=1
        ORDER BY
        ' . $this->prefijo . 'orden asc'
            );
            $consultaOtro = $this->db->query('
        SELECT
        ' . $this->prefijo . 'id,
        ' . $this->prefijo . 'orden,
        ' . $this->prefijo . 'nombre
        FROM
        ' . $this->tabla . '
        where ' . $this->vidp . '="' . $this->idp . '" and pai_id=10
        ORDER BY
        ' . $this->prefijo . 'orden asc'
            );
            $bolivia = $consultaBolivia->row_array();
        } else {
            $consulta = $this->db->query('
        SELECT
        ' . $this->prefijo . 'id,
        ' . $this->prefijo . 'orden,
        ' . $this->prefijo . 'nombre
        FROM
        ' . $this->tabla . '
        where ' . $this->vidp . '="' . $this->idp . '" and pai_id<>14
        ORDER BY
        ' . $this->prefijo . 'orden asc'
            );
            $consultaOtro = $this->db->query('
        SELECT
        ' . $this->prefijo . 'id,
        ' . $this->prefijo . 'orden,
        ' . $this->prefijo . 'nombre
        FROM
        ' . $this->tabla . '
        where ' . $this->vidp . '="' . $this->idp . '" and pai_id=14
        ORDER BY
        ' . $this->prefijo . 'orden asc'
            );
        }
        $datos = $consulta->result_array();
        $otro = $consultaOtro->row_array();
        $newDatos = Array();
        if (@$bolivia) {
            $newDatos[] = $bolivia;
        }
        foreach ($datos as $key => $value) {
            $newDatos[] = $value;
        }
        if ($otro) {
            $newDatos[] = $otro;
        }
        
        $contenido['ordencampo'] = $this->ordencampo;
        $contenido['ordenlabel'] = $this->ordenlabel;
        $contenido['campos_listar'] = $this->campos_listar;
        $contenido['campos_reales'] = $this->campos_reales;
        $contenido['hiddens'] = $this->hiddens;
        $contenido['orden'] = $this->orden;
        $contenido['cabecera'] = $this->cabecera;
        $contenido['datos'] = $datos;
        $data['contenido'] = $this->load->view($this->carpeta . 'listar', $contenido, true);
        //$data['contenido'] = $this->load->view('controladoradmin/listar', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function procesar() {
        if ($this->vidp) {
            $this->idp = $this->input->post('idp');
            if ((@$this->vtip) && (!$this->nodata)) {
                $this->tip = $this->input->post('tip');
                $consulta = $this->db->query('
                    SELECT * FROM ' . $this->tabla . '
                    where ' . $this->vidp . '="' . $this->idp . '" and ' . $this->vtip . '="' . $this->tip . '"
                    order by ' . $this->prefijo . 'id asc');
            } else {
                $consulta = $this->db->query('
                    SELECT * FROM ' . $this->tabla . '
                    where ' . $this->vidp . '="' . $this->idp . '"
                    order by ' . $this->prefijo . 'id asc');
            }
        } else {

            if (($this->vtip) && (!$this->nodata)) {
                $this->tip = $this->input->post('tip');
                $consulta = $this->db->query('
                    SELECT * FROM ' . $this->tabla . '
                    where ' . $this->vtip . '="' . $this->tip . '"
                    order by ' . $this->prefijo . 'id asc');
            } else {

                $consulta = $this->db->query('
                    SELECT * FROM ' . $this->tabla . '
                    order by ' . $this->prefijo . 'id asc');
            }
        }
        if (@$this->vtip) {
            $this->tip = $this->input->post('tip');
        }


        $oporden = $this->input->post('oporden');
        $ordenar = $this->input->post('ordenar');



        //si no se ha presionado el boton ordenar y no hay opc seguri normal
        if (($oporden == $this->prefijo . 'orden') || ($ordenar != "Ordenar")) {


            $datos = $consulta->result_array();


            //consulta original
            /*
              $consulta = $this->db->query('
              SELECT * FROM '.$this->tabla.' order by '.$this->prefijo.'id asc');
              $datos=$consulta->result_array();
             */

            $eliminar = $this->input->post('eliminar');
            $deshabilitar = $this->input->post('deshabilitar');
            $habilitar = $this->input->post('habilitar');

            $destacadomas = $this->input->post('destacadomas');
            $botondestacadomas = $this->input->post('botondestacadomas');

            $actualizar = $this->input->post('actualizar');
            $bandera = $this->input->post('bandera');
            $ordenar = $this->input->post('ordenar');
            $modelo = $this->modelo;
            //$this->load->model($this->carpeta.'fsimple/fsimple_model', $modelo, TRUE);

            $ruta_origen = @$this->ruta;
            $accion_realizada = '';
            foreach ($datos as $fila) {
                $chk = $this->input->post('chk' . $fila[$this->prefijo . 'id']);
                $chkd = $this->input->post('chkd' . $fila[$this->prefijo . 'id']);
                $orden = $this->input->post('orden' . $fila[$this->prefijo . 'id']);

                if ($botondestacadomas == "Actualizar destacados") {
                    if ($chkd == 'on') {
                        $fila[$destacadomas] = '1';
                    } else {
                        $fila[$destacadomas] = '0';
                    }
                    $this->$modelo->editar($fila);
                }
                if ($chk == 'on') {
                    $item_procesado = @$fila[$this->prefijo . 'titulo'];

                    if ($eliminar == "Eliminar") {
					if(@$this->campoup_img){
                        for ($i = 0; $i < count($this->campoup_img); $i++) {
                            @unlink($ruta_origen . $fila[$this->campoup_img[$i]]);
                            $nom_thum = 't_' . substr($fila[$this->campoup_img[$i]], 0, -4) . substr($fila[$this->campoup_img[$i]], -4);
                            @unlink($ruta_origen . $nom_thum);
                        }
					}
					if(@$this->campoup_adj){
                        for ($i = 0; $i < count($this->campoup_adj); $i++) {
                            @unlink($ruta_origen . $fila[$this->campoup_adj[$i]]);
                        }
					}
                        if (@$this->enlaces) {
                            for ($i = 1; $i <= (count($this->enlaces) / $this->nroenlaces); $i++) {
                                $this->eliminarsub($this->enlaces['campo' . $i], $fila[$this->prefijo . 'id'], $this->enlaces['id' . $i], $this->enlaces['url' . $i], $this->enlaces['tabla' . $i], $this->enlaces['campoborrar' . $i]);
                            }
                        }

                        $id = $fila[$this->prefijo . 'id'];
                        $resultado = $this->verificar($id);

                        if ($resultado == FALSE) {
                            $this->db->delete($this->tabla, array($this->prefijo . 'id' => $fila[$this->prefijo . 'id']));
                        }
                        $accion_realizada = "eliminado";
                    } else {
                        if ($habilitar == "Habilitar") {
                            $fila[$this->estado] = '1';
                            $accion_realizada = "habilitado";
                        }

                        if ($deshabilitar == "Deshabilitar") {
                            $fila[$this->estado] = '0';
                            $accion_realizada = "deshabilitado";
                        }
                        $this->$modelo->editar($fila);
                    }
                }
                if (@$this->actual) {
                    if ($bandera == $fila[$this->prefijo . 'id']) {
                        $fila[$this->actual] = '1';
                        $this->$modelo->editar($fila);
                    } else {
                        $fila[$this->actual] = '0';
                        $this->$modelo->editar($fila);
                    }
                }
                if ($this->orden) {
                    $fila[$this->orden] = $orden;
                    $this->$modelo->editar($fila);
                }
            }
        } else {
            if ($oporden) {
                $tiporden = $this->input->post('tiporden');
                $this->reordenar($oporden, $tiporden, $this->orden, $this->tabla, $this->prefijo, $this->vtip, $this->tip, $this->vidp, $this->idp, $this->nodata);
            }
        }

        if ($this->idp) {
            if ($this->tip) {
                redirect($this->controlador . $this->action_defecto . '/idp/' . $this->idp . '/tip/' . $this->tip);
            } else {
                redirect($this->controlador . $this->action_defecto . '/idp/' . $this->idp);
            }
        } else {
            if ($this->tip) {
                redirect($this->controlador . $this->action_defecto . '/tip/' . $this->tip);
            } else {
                redirect($this->controlador . $this->action_defecto);
            }
        }
    }

    function verificar($idF = "") {
        $id = $this->input->post('id');
        if ($id == "") {
            $id = $idF;
        }
        if ($this->idp == 1) {
            $prefijo = "pai_";
        } else {
            $prefijo = "ciu_";
        }
        $consulta = $this->db->query('
        SELECT pos_id from postulante_f where ' . $prefijo . 'id=' . $id . ' limit 1'
        );
        $datos = $consulta->row_array();
        if ($datos) {
            $retornar = true;
        } else {
            $retornar = false;
        }
        echo $retornar;
        return $retornar;
    }

    function definir_form_agregar() {
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
                'field' => $prefijo . 'tipo',
                'label' => 'Lugar / campo',
                'rules' => 'is_natural'
            ),
            array(
                'field' => $prefijo . 'nombre',
                'label' => 'Descripción',
                'rules' => 'required'
            )
        );
        return $config;
    }

    function set_mensajes_error() {
        $mensajes = array(
            array(
                'regla' => 'required',
                'mensaje' => 'Debe introducir el %s'
            ),
            array(
                'regla' => 'min_length',
                'mensaje' => 'El campo %s debe tener al menos %s carácteres'
            ),
            array(
                'regla' => 'is_natural',
                'mensaje' => 'Debe seleccionar un Lugar / Campo'
            )
        );
        return $mensajes;
    }

}

?>