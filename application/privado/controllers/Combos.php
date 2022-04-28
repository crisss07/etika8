<?php

require_once('Controladoradmin.php');

class Combos extends Controladoradmin {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html'));
        $this->load->library(array('form_validation', 'tool_general'));

        //****** definiendo nombre de carpeta por defecto
        $this->carpeta = 'combos/';
        $this->controlador = 'combos/';

        $this->tabla = 'combos';
        $this->prefijo = 'com_';
        //******* definiendo campos de la tabla
        $this->campo = array($this->prefijo . 'nombre');


        $this->formulario_agregar = 'combos_agregar';
        $this->formulario_editar = 'combos_agregar';
        $this->action_defecto = 'listar';


        //****** cargando el modelo
        $this->modelo = 'modelo_combos';
        $this->load->model($this->carpeta . 'Combos_model', $this->modelo, TRUE);

        $this->cabecera['titulo'] = 'Administración de Combos';
        $this->rutaimg = @$this->constantes['nombresitio'] . 'files/img/';

        $this->boton = 7;

        $this->vidp = "com_tipo";
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
        if ($this->idp != 3 && $this->idp != 12) {
            $this->campos_listar = array('Nº', 'Nombre');
        } else {
            $this->campos_listar = array('Nombre');
        }
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

        if ($this->idp != 3 && $this->idp != 12) {
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
        } else {
            $consulta = $this->db->query('
        SELECT
        ' . $this->prefijo . 'id,
        ' . $this->prefijo . 'orden,
        ' . $this->prefijo . 'nombre
        FROM
        ' . $this->tabla . '
        where ' . $this->vidp . '="' . $this->idp . '" and ' . $this->prefijo . 'id<>65
        ORDER BY
        ' . $this->prefijo . 'nombre asc'
            );
            $consultaOtro = $this->db->query('
        SELECT
        ' . $this->prefijo . 'id,
        ' . $this->prefijo . 'orden,
        ' . $this->prefijo . 'nombre
        FROM
        ' . $this->tabla . '
        where ' . $this->vidp . '="' . $this->idp . '" and ' . $this->prefijo . 'id=65'
            );
            $otro = $consultaOtro->row_array();
        }
        $datos = $consulta->result_array();
        $newDatos = array();
        foreach ($datos as $key => $value) {
            $newDatos[] = $value;
        }
        if (@$otro) {
            $newDatos[] = $otro;
        }

        $contenido['ordencampo'] = $this->ordencampo;
        $contenido['ordenlabel'] = $this->ordenlabel;
        $contenido['campos_listar'] = $this->campos_listar;
        $contenido['campos_reales'] = $this->campos_reales;
        $contenido['hiddens'] = $this->hiddens;
        $contenido['orden'] = $this->orden;
        $contenido['cabecera'] = $this->cabecera;
        $contenido['datos'] = $newDatos;
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
                        if (@$this->enlaces) {
                            for ($i = 1; $i <= (count($this->enlaces) / $this->nroenlaces); $i++) {
                                $this->eliminarsub($this->enlaces['campo' . $i], $fila[$this->prefijo . 'id'], $this->enlaces['id' . $i], $this->enlaces['url' . $i], $this->enlaces['tabla' . $i], $this->enlaces['campoborrar' . $i]);
                            }
                        }
                        $id = $fila[$this->prefijo . 'id'];
                        //var_dump($id,'linea 254');exit();
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

        $datos = array();
        $id = $this->input->post('id');
        if ($id == "") {
            $id = $idF;
        }
        if ($this->idp == 1) {
            $campo = "edu_grado";
            $tabla = "educacion_post_grado";
        } elseif ($this->idp == 2) {
            $campo = "edu_grado";
            $tabla = "educacion_superior";
        } elseif ($this->idp == 3) {
            $campo = "edu_area";
            $tabla = "educacion_superior";
        } elseif ($this->idp == 4) {
            $campo = "tra_tipo_org";
            $tabla = "trayectoria_laboral";
        } elseif ($this->idp == 5) {
            $campo = "pof_area_exp";
            $tabla = "postulante_f";
        } elseif ($this->idp == 6) {
            $campo = "pof_sector_exp";
            $tabla = "postulante_f";
        } elseif ($this->idp == 7) {
            $campo = "pof_recomendacion";
            $tabla = "postulante_f";
        } 
        elseif ($this->idp == 9) {
            $campo = "pof_max_nivel";
            $tabla = "postulante_f";
        } elseif ($this->idp == 11) {
            $campo = "pof_max_nivel_no";
            $tabla = "postulante_f";
        } elseif ($this->idp == 12) {
            $campo = "cargo_id";
            $tabla = "convocatoria";
        } elseif ($this->idp == 13) {
            $campo = "sede_id";
            $tabla = "convocatoria";
        } elseif ($this->idp == 14) {
            $campo = "pof_estado";
            $tabla = "postulante_f";
        }
        //var_dump($this->idp,$campo,$tabla,$id);exit();
        if ($this->idp != 12 && $this->idp != 13) {
            $consulta = $this->db->query('
        SELECT pos_id from ' . $tabla . ' where ' . $campo . '=' . $id . ' limit 1'
            );
            $datos = $consulta->row_array();
            if (array_key_exists('pos_id', $datos)) {
                $retornar = true;
            } else {
                $retornar = false;
            }
        } else {
            $consulta = $this->db->query('
        SELECT con_id from ' . $tabla . ' where ' . $campo . '=' . $id . ' limit 1'
            );
            $datos = $consulta->row_array();
			if(@$datos){
				if (array_key_exists('con_id', $datos)) {
					$retornar = true;
				} else {
					$retornar = false;
				}
			} else {
				$retornar = false;
			}
        }
//        echo 'SELECT pos_id from ' . $tabla . ' where ' . $campo . '=' . $id . ' limit 1';

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