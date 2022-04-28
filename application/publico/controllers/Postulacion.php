<?php

require_once('Controladoradmin.php');

class Postulacion extends Controladoradmin {

    function __construct() {
        parent::__construct();
        //if (in_array($this->uri->segment(1), $this->config->item('sin_ssl_pages'))) {
        //    remove_ssl();
        //} else {
            force_ssl();
        //}
        $this->load->helper(array('url', 'form'));
        $this->load->library('Form_validation');

        $this->load->helper('html');
        $this->load->library('Tool_general');

        //****** definiendo la tabla por defecto y prefijo si lo tuviera
        $this->tabla = 'convocatoria_postulacion';
        $this->prefijo = 'pos_';
        $this->prefijoF = 'pof_';
        $this->tablaC = 'convocatoria';
        $this->prefijoC = 'con_';
        $this->tablacv = 'cv_temporales';
        $this->prefijocv = 'cvt_';
        //******* definiendo campos de la tabla                  
        //****** definiendo nombre de carpeta por defecto
        $this->carpeta = 'postulacion/';
        $this->controlador = 'postulacion/';


        //******conf uploads
        $this->config_normal['upload_path'] = './archivos/cvtemporales/';
        $this->config_normal['allowed_types'] = 'gif|jpg|png|flv|avi|swf';
        $this->config_normal['max_size'] = '10240';
        $this->load->library('upload', $this->config_normal);

        $this->ruta = $this->config_normal['upload_path'];

//        campo para adjunto
        $this->campoup_adj = array($this->prefijocv . 'docnombre');

        $this->rutabase = $this->tool_entidad->constantes['sitiopri'];
        $this->rutarchivo = $this->tool_entidad->sitio() . 'archivos/';
        $this->rutaimg = $this->tool_entidad->sitio() . 'files/img/';
        $this->rutadj = 'archivos/';
        $this->cuadro_actual = 'postulacion';
        $this->contenido_completo = 1;
        //$this->formulario='usuario_form';
        //****** cargando el modelo
        $this->no_mostrar_enlaces = 1;
        $this->modelo = 'Modelo_postulacion';
        $this->load->model($this->carpeta . 'Postulacion_model', $this->modelo, TRUE);

        $this->cabecera['titulo'] = 'Postulación al Cargo';
        $this->cabecera['accion'] = '';
        $this->estado = $this->prefijo . 'estado';
        $this->hiddens = array($this->prefijo . 'id');
        $consulta = $this->db->query('SELECT * FROM contador ORDER BY con_orden asc');
        $fila = $consulta->result_array();
        $this->contador[-1] = 'Seleccione un opción';
        foreach ($fila as $row) {
            $this->contador[$row['con_id']] = $row['con_nombre'];
        }
        $this->presession = $this->tool_entidad->presession();
        session_start();
        if (!isset($_SESSION[$this->presession . 'usuario'])) {
            redirect(base_url() . index_page());
        }
    }

    function agregar() {
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['idp'];
        $formulario = 'postulacion_form';
        $prefijo = $this->prefijo;
        $modelo = $this->modelo;
        $consulta = $this->db->query('
            SELECT * FROM convocatoria WHERE con_id=' . $id);
        $fila = $consulta->first_row('array');
        $consulta = $this->db->query('
            SELECT * FROM convocatoria_postulacion WHERE pos_id=' . $_SESSION[$this->presession . 'id'] . ' and con_id1=' . $id);
        $contenido['existe'] = $consulta->first_row('array');
        $contador = $this->input->post('contador');
        $opcionDisponibilidad = $this->input->post($prefijo . 'disponibilidad');
        if ($this->input->post('enviar') != '' && $contador > 0 && $opcionDisponibilidad > 0) {
            $prestacion = $this->input->post($prefijo . 'salario');
            $disponible = $this->input->post($prefijo . 'disponibilidad');
            $data['pos_id'] = $_SESSION[$this->presession . 'id'];

            $consulta = $this->db->query('
                SELECT pos_nro_postulaciones as nro FROM postulante WHERE pos_id=' . $data['pos_id']);
            $nro = $consulta->first_row('array');
            $data['con_id1'] = $id;
            $data['con_disponibilidad'] = $disponible;
            $this->db->query('UPDATE contador SET con_numero = con_numero+1 WHERE con_id=' . $contador . ' LIMIT 1 ;');
            $this->db->query('UPDATE postulante_f SET pof_salario =' . $prestacion . ' WHERE pos_id=' . $data['pos_id'] . ' LIMIT 1 ;');
//            $this->db->query('UPDATE postulante_f SET pof_salario =' . $prestacion . ',pof_disponibilidad =' . $disponible . ' WHERE pos_id=' . $data['pos_id'] . ' LIMIT 1 ;');
            $this->db->query('UPDATE postulante SET  pos_nro_postulaciones = ' . ($nro['nro'] + 1) . ' WHERE pos_id=' . $data['pos_id'] . ' LIMIT 1 ;');

            $id = $this->$modelo->agregar($data);
            if ($id) {
                redirect($this->controlador . 'mensaje_exito/idp/' . $uri['idp']);
                /* $contenido['cargo'] = $fila['con_cargo'];
                  $data['contenido'] = $this->load->view($this->carpeta . 'mensaje_exito', $contenido, true);
                  $consulta = $this->db->query('
                  SELECT pos_estado as estado
                  FROM postulante
                  WHERE pos_id=' . $_SESSION[$this->presession . 'id']);
                  $estado = $consulta->row_array();
                  $data['editar'] = $this->estado_usuario($_SESSION[$this->presession . 'id']);
                  if (!$estado['estado']) {
                  $data['noestado'] = 1;
                  }
                  $this->load->view('plantilla_publico', $data); */
            }
        } elseif (($this->input->post('enviar') != '' && !$contador) || ( $this->input->post('enviar') != '' && !$opcionDisponibilidad)) {
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
                            SELECT pof_disponibilidad,pof_salario
                            FROM postulante_f 
                            WHERE pos_id=' . $_SESSION[$this->presession . 'id']
            );
            $idDisponible = $consultaDisponible->row_array();

            $idDisponible[$this->prefijoF . 'salario'] = $this->input->post($prefijo . 'salario');
            $idDisponible[$this->prefijoF . 'disponibilidad'] = $this->input->post($prefijo . 'disponibilidad');
            $consulta = $this->db->query('
                SELECT pof_salario as salario FROM postulante_f WHERE pos_id=' . $_SESSION[$this->presession . 'id']);
            $salario = $consulta->first_row('array');
            $salario['salario'] = $this->input->post($prefijo . 'salario');
            $this->cabecera['accion'] = $fila['con_cargo'];
            $contenido['cabecera'] = $this->cabecera;
            $contenido['action'] = $this->controlador . 'agregar/idp/' . $id;
            $contenido['salario'] = $salario;
            $contenido['contador'] = $contador;
            if (!$contador) {
                $contenido['error_contador'] = 'Debe seleccionar una opción';
            }
            if (!$opcionDisponibilidad) {
                $contenido['error_disponibilidad'] = 'Debe seleccionar diponibilidad';
            }
            $contenido['idDisponible'] = $idDisponible;
            $contenido['disponibilidad'] = $disponibilidad;
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $consulta = $this->db->query('
                SELECT pof_estado as estado
                FROM postulante_f
                WHERE pos_id=' . $_SESSION[$this->presession . 'id']);
            $estado = $consulta->row_array();
            $data['editar'] = $this->estado_usuario($_SESSION[$this->presession . 'id']);
            if (!$estado['estado']) {
                $data['noestado'] = 1;
            }
            $this->load->view('plantilla_publico', $data);
        } else {
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
                            SELECT pof_disponibilidad,pof_salario
                            FROM postulante_f 
                            WHERE pos_id=' . $_SESSION[$this->presession . 'id']
            );
            $idDisponible = $consultaDisponible->row_array();

            $consulta = $this->db->query('
                SELECT pof_salario as salario FROM postulante_f WHERE pos_id=' . $_SESSION[$this->presession . 'id']);
            $salario = $consulta->first_row('array');

            $this->cabecera['accion'] = $fila['con_cargo'];
            $contenido['cabecera'] = $this->cabecera;
            $contenido['action'] = $this->controlador . 'agregar/idp/' . $id;
            $contenido['salario'] = $salario;
            $contenido['idDisponible'] = $idDisponible;
            $contenido['disponibilidad'] = $disponibilidad;
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $consulta = $this->db->query('
                SELECT pof_estado as estado
                FROM postulante_f
                WHERE pos_id=' . $_SESSION[$this->presession . 'id']);
            $estado = $consulta->row_array();
            $data['editar'] = $this->estado_usuario($_SESSION[$this->presession . 'id']);
            if (!$estado['estado']) {
                $data['noestado'] = 1;
            }
            $this->load->view('plantilla_publico', $data);
        }
    }

    function editardatos() {
        if (!isset($_SESSION[$this->presession . 'usuario'])) {
            redirect(base_url() . index_page());
        }

        if ($_POST) {
            $_SESSION[$this->presession . 'contador'] = $_POST['contador'];
            $_SESSION[$this->presession . 'salario'] = $_POST['salario'];
            $_SESSION[$this->presession . 'disponibilidad'] = $_POST['disponibilidad'];
            echo true;
        } else {
            $id = $_SESSION[$this->presession . 'id'];
            $consultaFechaTL = $this->db->query('
                        SELECT ' . $this->prefijo . 'id,
                            date(' . $this->prefijo . 'fecha_edicion) as fdp,
                            ' . $this->prefijo . 'fecha_instruccion_formal as fif,
                            ' . $this->prefijo . 'fecha_trayectoria_laboral as ftl,
                            ' . $this->prefijo . 'fecha_informacion_adicional as fia
                        FROM ' . $this->tabla . '  
                        WHERE ' . $this->prefijo . 'id=' . $id
            );
            $arrayFechas = $consultaFechaTL->row_array();
            $contenido['arrayFechas'] = $arrayFechas;
            $contenido['id'] = $id;
            $data['contenido'] = $this->load->view($this->carpeta . '/formulario_datos', $contenido, true);
            $this->load->view('plantilla_publico_2019', $data);
        }
    }

    function postular() {

        $uri = $this->uri->uri_to_assoc(3);
        $formulario = 'formulario_postular';
        $this->definir_postular_form_agregar();
        $prefijo = $this->prefijoF;
        $modelo = $this->modelo;

        $idC = $uri['idp'];
        $_SESSION[$this->presession . 'idc'] = $idC;
        $consulta = $this->db->query('
        SELECT ' . $this->prefijoC . 'cargo FROM ' . $this->tablaC . ' where ' . $this->prefijoC . 'id=' . $idC);
        $fila = $consulta->row_array();

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
                            SELECT pof_disponibilidad,pof_salario
                            FROM postulante_f 
                            WHERE pos_id=' . $_SESSION[$this->presession . 'id']
        );
        $idDisponible = $consultaDisponible->row_array();
        $consulta = $this->db->query('
                SELECT pof_salario as salario FROM postulante_f WHERE pos_id=' . $_SESSION[$this->presession . 'id']);
        $salario = $consulta->first_row('array');

        if ($this->form_validation->run() == FALSE) {
            if ($this->input->post($prefijo . 'salario') > 0) {
                $idDisponible[$prefijo . 'salario'] = $this->input->post($prefijo . 'salario');
            }
            $contenido['cargo'] = $fila['con_cargo'];
            $contenido['datos'] = $idDisponible;
            $contenido['idDisponible'] = $idDisponible;
            $contenido['action'] = $this->controlador . "postular/idp/" . $idC;
            $contenido['disponibilidad'] = $disponibilidad;
            if ($this->input->post($prefijo . 'salario') > 0) {
                $idDisponible[$prefijo . 'salario'] = $this->input->post($prefijo . 'salario');
            } else {
                $idDisponible[$prefijo . 'salario'] = $salario['salario'];
            }
            $data['contenido'] = $this->load->view($this->carpeta . '/formulario_postular', $contenido, true);
            $this->load->view('plantilla_publico_2019_banner', $data);
        } else {
            $_SESSION[$this->presession . 'salario'] = $this->input->post($this->prefijoF . 'salario');
            $_SESSION[$this->presession . 'disponibilidad'] = $this->input->post($this->prefijoF . 'disponibilidad');
            $_SESSION[$this->presession . 'contador'] = $this->input->post('contador');
            redirect('epostulante/editar_cv/id/' . $_SESSION[$this->presession . 'id']);
//            epostulante/editar_cv/id/19665
        }
    }

    function cvtemporal() {
        if ($_POST) {
            $_SESSION[$this->presession . 'contador'] = $_POST['contador'];
            $_SESSION[$this->presession . 'salario'] = $_POST['salario'];
            $_SESSION[$this->presession . 'disponibilidad'] = $_POST['disponibilidad'];
            echo true;
        } else {

            $modelo = $this->modelo;
            $ruta_origen = $this->ruta;

            $consultaDatos = $this->db->query('
                            SELECT pos_documento,pos_apaterno,pos_amaterno,pos_nombre
                            FROM postulante 
                            WHERE pos_id=' . $_SESSION[$this->presession . 'id']
            );
            $resultado = $consultaDatos->row_array();

            $nombre = $resultado[$this->prefijo . 'apaterno'] . $resultado[$this->prefijo . 'amaterno'] . $resultado[$this->prefijo . 'nombre'] . $resultado[$this->prefijo . 'documento'];
            // $nombre = $resultado[$this->prefijo . 'apaterno'] . $resultado[$this->prefijo . 'amaterno'] . $resultado[$this->prefijo . 'nombre'] . $resultado[$this->prefijo . 'documento'];
//            $nombre = $resultado[$this->prefijo . 'nombre'] . $resultado[$this->prefijo . 'apaterno'] . $resultado[$this->prefijo . 'documento'];
            $nombre = $this->reemplazar_string($nombre);
            $nombreAdj = strtoupper($nombre);
//            $nombreAdj = strtoupper($nombre) . date('dmY') . date('hi');

            for ($i = 0; $i < count($this->campoup_adj); $i++) {
                $j = $i + 1;
                $archivo_adj[$i] = $this->tool_general->limpiar_cadena($_FILES[$this->campoup_adj[$i]]['name']);
                $borrar_adj[$i] = $this->input->post($this->campoup_adj[$i] . '_borrar' . $j);
            }
            if (array_key_exists($this->prefijocv . 'docnombre', $_FILES)) {
                if ($_FILES[$this->prefijocv . 'docnombre']['name'] != '') {
                    for ($i = 0; $i < count($this->campoup_adj); $i++) {
                        if ($this->campoup_adj[$i]) {
                            if ($archivo_adj[$i]) {
                                $extension = explode('.', $archivo_adj[$i]);
                                $extension = $extension[count($extension) - 1];

                                @unlink($ruta_origen . $borrar_adj[$i]);
                                $adjunto[$i] = $_FILES[$this->campoup_adj[$i]]["tmp_name"];

                                if ($this->validar_archivo($adjunto[$i])) {
                                    if ($adjunto[$i]) {
//                                        creando la carpeta
                                        $carpeta = $this->config_normal['upload_path'] . '' . $_SESSION[$this->presession . 'idc'];
                                        if (!file_exists($carpeta)) {
                                            mkdir($carpeta, 0777, true);
                                        }
                                        $nom_adjunto = $nombreAdj . "." . $extension;
//                                        echo $carpeta;
//                                        echo copy($adjunto[$i], $carpeta . $nom_adjunto);
//                                        exit();
                                        if (@copy($adjunto[$i], $carpeta . "/" . $nom_adjunto)) {
                                            $data_adj[$this->campoup_adj[$i]] = $nom_adjunto;
                                            $data_adj['pos_id'] = $_SESSION[$this->presession . 'id'];
                                            $data_adj['con_id'] = $_SESSION[$this->presession . 'idc'];
                                            $idResultado = $this->$modelo->agregarAdj($data_adj);
//                                            guardar datos del postulante salario disponibilidad y como se entero
                                            $data['pos_id'] = $_SESSION[$this->presession . 'id'];
                                            $consulta = $this->db->query('
                                                    SELECT pos_nro_postulaciones as nro FROM postulante WHERE pos_id=' . $data['pos_id']);
                                            $nro = $consulta->first_row('array');
                                            $disponible = $_SESSION[$this->presession . 'disponibilidad'];
                                            $idc = $_SESSION[$this->presession . 'idc'];

                                            $data['con_id1'] = $idc;
                                            $data['con_disponibilidad'] = $disponible;


                                            $contador = $_SESSION[$this->presession . 'contador'];
                                            $prestacion = $_SESSION[$this->presession . 'salario'];


                                            $this->db->query('UPDATE contador SET con_numero = con_numero+1 WHERE con_id=' . $contador . ' LIMIT 1 ;');
                                            $this->db->query('UPDATE postulante_f SET pof_salario =' . $prestacion . ' WHERE pos_id=' . $data['pos_id'] . ' LIMIT 1 ;');
//                                            $this->db->query('UPDATE postulante_f SET pof_salario =' . $prestacion . ',pof_disponibilidad =' . $disponible . ' WHERE pos_id=' . $data['pos_id'] . ' LIMIT 1 ;');
                                            $this->db->query('UPDATE postulante SET  pos_nro_postulaciones = ' . ($nro['nro'] + 1) . ' WHERE pos_id=' . $data['pos_id'] . ' LIMIT 1 ;');
                                            $id = $this->$modelo->agregarPostulacion($data);
                                            if ($id) {
//                                                redirect('convocatoria/mensaje');
                                                redirect($this->controlador . 'nmensaje_exito/idp/' . $idc);
                                            }
                                        } else {
                                            echo "no se subio su archivo";
                                        }
                                    }
                                    echo 'formato correcto';
                                } else {
//                                echo '';
                                    $mensajeArchivo = 'Formato incorrecto verifique el documento que intenta subir.';
                                }
                            } else {
                                if ($solo_eliminar_adj[$i]) {
                                    $data_eliminar_adj[$this->campoup_adj[$i]] = '';
//                                $this->$modelo->editar($data_eliminar_adj);
                                    @unlink($ruta_origen . $borrar_adj[$i]);
                                }
                            }
                        }
                    }
                } else {
//                echo "sin nombre";
                }
            } else {
//            echo "no existe";
            }
            $contenido['mensaje'] = $mensajeArchivo;
            $data['contenido'] = $this->load->view($this->carpeta . '/formulario_adjuntar', $contenido, true);
            $this->load->view('plantilla_publico_2019_banner', $data);
        }
    }

    function reemplazar_string($string) {

        $string = trim($string);

        $string = str_replace(
                array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $string
        );

        $string = str_replace(
                array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $string
        );

        $string = str_replace(
                array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $string
        );

        $string = str_replace(
                array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $string
        );

        $string = str_replace(
                array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $string
        );

        $string = str_replace(
                array('ñ', 'Ñ', 'ç', 'Ç'), array('n', 'N', 'c', 'C',), $string
        );
        $string = str_replace(
                array(' '), array(''), $string
        );

        //Esta parte se encarga de eliminar cualquier caracter extraño
//        $string = str_replace(
//        array("\", "¨", "º", "-", "~",
//             "#", "@", "|", "!", """,
//        "·", "$", "%", "&", "/",
//        "(", ")", "?", "'", "¡",
//        "¿", "[", "^", "<code>", "]",
//        "+", "}", "{", "¨", "´",
//        ">", "< ", ";", ",", ":",
//        ".", " "),
//        '',
//        $string
//        );

        return $string;
    }

    function validar_archivo($archivo) {
        $file_data = array(
            "doc" => array(
                "offsett" => 0,
                "lon" => 8,
                "firma" => "D0CF11E0A1B11AE1"
            ),
            "docx" => array(
                "offsett" => 0,
                "lon" => 8,
                "firma" => "504B3414060"
            ),
//            "xls" => array(
//                "offsett" => 0,
//                "lon" => 8,
//                "firma" => "D0CF11E0A1B11AE1"
//            ),
//            "xlsx" => array(
//                "offsett" => 0,
//                "lon" => 8,
//                "firma" => "504B3414060"
//            ),
//            "ppt" => array(
//                "offsett" => 0,
//                "lon" => 8,
//                "firma" => "D0CF11E0A1B11AE1"
//            ),
//            "pptx" => array(
//                "offsett" => 0,
//                "lon" => 8,
//                "firma" => "504B3414060"
//            ),
//            "flv" => array(
//                "offsett" => 0,
//                "lon" => 4,
//                "firma" => "464C561",
//            ),
//            "mp4" => array(
//                "offsett" => 0,
//                "lon" => 4,
//                "firma" => "0001C",
//            ),
//            "mp3" => array(
//                "offsett" => 0,
//                "lon" => 4,
//                "firma" => "49443304",
//            ),
            "pdf" => array(
                "offsett" => 0,
                "lon" => 8,
                "firma" => "255044462D312E3"
//		   "firma" => "255044462D312E35"
            )
        );

        $tipos = array_keys($file_data);
        $ok = false;
        do {
            if (!is_null($tipo = array_pop($tipos)))
                if ($datos = file_get_contents($archivo, NULL, NULL, $file_data[$tipo]["offsett"], $file_data[$tipo]["lon"])) {
                    $hex = '';
                    for ($i = 0; $i < strlen($datos); $i++)
                        $hex .= strtoupper(dechex(ord($datos[$i])));
                    if ($tipo == 'pdf') {
                        $hex = substr($hex, 0, strlen($hex) - 1);
                    }
                    $ok = ($hex == $file_data[$tipo]["firma"]);
                }
            //var_dump($hex); exit();
        } while (!empty($tipos) && !$ok);
        return ($ok);
    }

    function agregarnuevo() {
        print_r($_SESSION);
       // exit();
        $uri = $this->uri->uri_to_assoc(3);
        @$id = $uri['idp'] == '' ? $_SESSION[$this->presession . 'idc'] : $uri['idp'];
        $idc = $id;
        //var_dump($id);
        //exit;
        $formulario = 'postulacion_form';
        $prefijo = $this->prefijo;
        $modelo = $this->modelo;
        $consulta = $this->db->query('
            SELECT * FROM convocatoria WHERE con_id=' . $idc);
        $fila = $consulta->first_row('array');
        $consulta = $this->db->query('
            SELECT * FROM convocatoria_postulacion WHERE pos_id=' . $_SESSION[$this->presession . 'id'] . ' and con_id1=' . $id);
        $contenido['existe'] = $consulta->first_row('array');
        $contador = $this->input->post('contador') == '' ? $_SESSION[$this->presession . 'contador'] : $this->input->post('contador');
//        print_r($_SESSION);
        $opcionDisponibilidad = $this->input->post($prefijo . 'disponibilidad') == '' ? $_SESSION[$this->presession . 'disponibilidad'] : $this->input->post($prefijo . 'disponibilidad');

//        echo $contador . '<br>';
//        echo $opcionDisponibilidad;
//        exit();
        if ($contador > 0) {
//        if ($this->input->post('enviar') != '' && $contador > 0 && $opcionDisponibilidad > 0) {

            $prestacion = $this->input->post($prefijo . 'salario') == '' ? $_SESSION[$this->presession . 'salario'] : $this->input->post($prefijo . 'salario');
            $contador_conv = $this->input->post($prefijo . 'contador') == '' ? $_SESSION[$this->presession . 'contador'] : $this->input->post($prefijo . 'contador');
            
            $disponible = $opcionDisponibilidad;
//            $disponible = $this->input->post($prefijo . 'disponibilidad');
            $data['pos_id'] = $_SESSION[$this->presession . 'id'];

            $consulta = $this->db->query('
                SELECT pos_nro_postulaciones as nro FROM postulante WHERE pos_id=' . $data['pos_id']);
            $nro = $consulta->first_row('array');
            $data['con_id1'] = $id;
            $data['con_disponibilidad'] = $disponible;
            $data['con_pretension_salarial'] = $prestacion;
            $data['contador_id'] = $contador_conv;
            $this->db->query('UPDATE contador SET con_numero = con_numero+1 WHERE con_id=' . $contador . ' LIMIT 1 ;');
            $this->db->query('UPDATE postulante_f SET pof_salario =' . $prestacion . ' WHERE pos_id=' . $data['pos_id'] . ' LIMIT 1 ;');
//            $this->db->query('UPDATE postulante_f SET pof_salario =' . $prestacion . ',pof_disponibilidad =' . $disponible . ' WHERE pos_id=' . $data['pos_id'] . ' LIMIT 1 ;');
            $this->db->query('UPDATE postulante SET  pos_nro_postulaciones = ' . ($nro['nro'] + 1) . ' WHERE pos_id=' . $data['pos_id'] . ' LIMIT 1 ;');

            $id = $this->$modelo->agregar($data);

            if ($id) {
                redirect($this->controlador . 'nmensaje_exito/idp/' . $idc);
            }
        } elseif (($this->input->post('enviar') != '' && !$contador) || ( $this->input->post('enviar') != '' && !$opcionDisponibilidad)) {

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
                            SELECT pof_disponibilidad,pof_salario
                            FROM postulante_f 
                            WHERE pos_id=' . $_SESSION[$this->presession . 'id']
            );
            $idDisponible = $consultaDisponible->row_array();

            $idDisponible[$this->prefijoF . 'salario'] = $this->input->post($prefijo . 'salario');
            $idDisponible[$this->prefijoF . 'disponibilidad'] = $this->input->post($prefijo . 'disponibilidad');
            $consulta = $this->db->query('
                SELECT pof_salario as salario FROM postulante_f WHERE pos_id=' . $_SESSION[$this->presession . 'id']);
            $salario = $consulta->first_row('array');
            $salario['salario'] = $this->input->post($prefijo . 'salario');
            $this->cabecera['accion'] = $fila['con_cargo'];
            $contenido['cabecera'] = $this->cabecera;
            $contenido['action'] = $this->controlador . 'agregar/idp/' . $id;
            $contenido['salario'] = $salario;
            $contenido['contador'] = $contador;
            if (!$contador) {
                $contenido['error_contador'] = 'Debe seleccionar una opción';
            }
            if (!$opcionDisponibilidad) {
                $contenido['error_disponibilidad'] = 'Debe seleccionar diponibilidad';
            }
            $contenido['idDisponible'] = $idDisponible;
            $contenido['disponibilidad'] = $disponibilidad;
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $consulta = $this->db->query('
                SELECT pof_estado as estado
                FROM postulante_f
                WHERE pos_id=' . $_SESSION[$this->presession . 'id']);
            $estado = $consulta->row_array();
            $data['editar'] = $this->estado_usuario($_SESSION[$this->presession . 'id']);
            if (!$estado['estado']) {
                $data['noestado'] = 1;
            }
            $this->load->view('plantilla_publico', $data);
        } else {
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
                            SELECT pof_disponibilidad,pof_salario
                            FROM postulante_f 
                            WHERE pos_id=' . $_SESSION[$this->presession . 'id']
            );
            $idDisponible = $consultaDisponible->row_array();

            $consulta = $this->db->query('
                SELECT pof_salario as salario FROM postulante_f WHERE pos_id=' . $_SESSION[$this->presession . 'id']);
            $salario = $consulta->first_row('array');

            $this->cabecera['accion'] = $fila['con_cargo'];
            $contenido['cabecera'] = $this->cabecera;
            $contenido['action'] = $this->controlador . 'agregar/idp/' . $id;
            $contenido['salario'] = $salario;
            $contenido['idDisponible'] = $idDisponible;
            $contenido['disponibilidad'] = $disponibilidad;
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
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
        }
    }

    function mensaje_exito() {
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['idp'] == '' ? $_SESSION[$this->presession . 'idc'] : $uri['idp'];
        $consulta = $this->db->query('
            SELECT * FROM convocatoria WHERE con_id=' . $id);
        $fila = $consulta->first_row('array');
        $contenido['cargo'] = $fila['con_cargo'];
        $data['contenido'] = $this->load->view($this->carpeta . 'mensaje_exito', $contenido, true);
        $consulta = $this->db->query('
        SELECT pof_estado as estado
        FROM postulante_f
        WHERE pos_id=' . $_SESSION[$this->presession . 'id']);
        $estado = $consulta->row_array();
        $data['editar'] = $this->estado_usuario($_SESSION[$this->presession . 'id']);
        if (!$estado['estado']) {
            $data['noestado'] = 1;
        }
        $this->load->view('plantilla_publico', $data);
    }

    function nmensaje_exito() {
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['idp'] == '' ? $_SESSION[$this->presession . 'idc'] : $uri['idp'];
        $consulta = $this->db->query('
            SELECT * FROM convocatoria WHERE con_id=' . $id);
        $fila = $consulta->first_row('array');
        $contenido['cargo'] = $fila['con_cargo'];
        $data['contenido'] = $this->load->view('postulante/completa', $contenido, true);
//        $data['contenido'] = $this->load->view($this->carpeta . 'mensaje_exito', $contenido, true);
        $consulta = $this->db->query('
        SELECT pof_estado as estado
        FROM postulante_f
        WHERE pos_id=' . $_SESSION[$this->presession . 'id']);
        $estado = $consulta->row_array();
        $data['editar'] = $this->estado_usuario($_SESSION[$this->presession . 'id']);
        if (!$estado['estado']) {
            $data['noestado'] = 1;
        }

        $this->load->view('plantilla_publico_2019_banner', $data);
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

    function definir_postular_form_agregar() {
        $prefijo = $this->prefijoF;
        $config = $this->set_reglas_validacion_postular_agregar();
        $mensajes = $this->set_mensajes_error();

        // inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach ($mensajes as $msj)
            $this->form_validation->set_message($msj['regla'], $msj['mensaje']);
        // inicio asignando las reglas y mensajes de validacion
    }

    function set_reglas_validacion_postular_agregar() {
        $prefijo = $this->prefijoF;

        $config = array(
            array(
                'field' => $prefijo . 'salario',
                'label' => 'Pretensión salarial',
                'rules' => 'required|is_natural'
            ),
//            array(
//                'field' => $prefijo . 'disponibilidad',
//                'label' => 'Disponibilidad',
//                'rules' => 'required|is_numeric|is_natural'
//            ),
            array(
                'field' => 'contador',
                'label' => 'Cómo se enteró de está postulación',
                'rules' => 'required|is_numeric|is_natural'
            ),
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
                'regla' => 'max_length',
                'mensaje' => 'El campo %s debe tener como maximo %s carácteres'
            ),
            array(
                'regla' => 'valid_email',
                'mensaje' => 'Debe escribir una dirección de email correcta'
            ),
            array(
                'regla' => 'valid_password',
                'mensaje' => 'Debe escribir por lo menos un caracter o numero'
            ),
            array(
                'regla' => 'is_numeric',
                'mensaje' => 'El campo %s debe ser un numero'
            ),
            array(
                'regla' => 'is_natural',
                'mensaje' => 'Debe seleccionar un %s'
            ),
            array(
                'regla' => 'valid_nota',
                'mensaje' => 'La nota que Ingrese debe ser menor o igual a 100'
            ),
            array(
                'regla' => 'valid_fecha_anio_mes',
                'mensaje' => 'Debe ingresar un Formato correcto de fecha'
            )
        );
        return $mensajes;
    }

}

?>