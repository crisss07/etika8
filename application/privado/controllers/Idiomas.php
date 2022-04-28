<?php

require_once('Controladoradmin.php');

class Idiomas extends Controladoradmin {

    function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form', 'html');
        $this->load->library(array('form_validation', 'tool_general'));

        //****** definiendo nombre de carpeta por defecto
        $this->carpeta = 'idiomas/';
        $this->controlador = 'idiomas/';

        $this->tabla = 'idiomas';
        $this->prefijo = 'idi_';
        //******* definiendo campos de la tabla
        $this->campo = array($this->prefijo . 'idioma');


        $this->formulario_agregar = 'idiomas_agregar';
        $this->formulario_editar = 'idiomas_agregar';
        $this->action_defecto = 'listar';


        //****** cargando el modelo
        $this->modelo = 'modelo_combos';
        $this->load->model($this->carpeta . 'idiomas_model', $this->modelo, TRUE);

        $this->cabecera['titulo'] = 'Administración de Combos';
        $this->rutaimg = @$this->constantes['nombresitio'] . 'files/img/';

        $this->boton = 7;

        $this->vidp = "idi_tipo";
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
            $this->campos_listar = array('Nº', 'Idioma');
        } else {
            $this->campos_listar = array('Nº', 'Ciudad o Localidad');
        }
        $this->campos_reales = array($this->prefijo . 'orden', $this->prefijo . 'idioma');
        $this->hiddens = array($this->prefijo . 'id');

        $this->ordencampo = array(
            'campo1' => $this->prefijo . 'orden',
            'campo2' => $this->prefijo . 'nombre'
        );
        $this->ordenlabel = array(
            'campo1' => 'orden',
            'campo1' => 'Número',
            'campo2' => 'Nombre'
        );

//        $consulta = $this->db->query('
//        SELECT
//        ' . $this->prefijo . 'id,
//        ' . $this->prefijo . 'orden,
//        ' . $this->prefijo . 'idioma
//        FROM
//        ' . $this->tabla
//        );
        $consulta = $this->db->query('
        SELECT
        ' . $this->prefijo . 'id,
        ' . $this->prefijo . 'orden,
        ' . $this->prefijo . 'idioma
        FROM
        ' . $this->tabla . '
        where ' . $this->vidp . '="' . $this->idp . '"
        ORDER BY
        ' . $this->prefijo . 'orden asc'
        );
        $datos = $consulta->result_array();

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
                if (@$chk == 'on') {
                    $item_procesado = $fila[$this->prefijo . 'titulo'];

                    if ($eliminar == "Eliminar") {
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

        $datos = array();
        $id = $this->input->post('id');
        if ($id == "") {
            $id = $idF;
        }
        $campo = "idi_id";
        $tabla = "postulante_idioma";


        $consulta = $this->db->query('
        SELECT pos_id from ' . $tabla . ' where ' . $campo . '=' . $id . ' limit 1'
        );
        $datos = $consulta->row_array();
        if (array_key_exists('pos_id', $datos)) {
            $retornar = true;
        } else {
            $retornar = false;
        }
//        echo 'SELECT pos_id from ' . $tabla . ' where ' . $campo . '=' . $id . ' limit 1';

        echo $retornar;
        return $retornar;
    }

    function agregar() {

        $this->definir_form_agregar();
        $prefijo = $this->prefijo;
        $modelo = $this->modelo;
        $ruta_origen = @$this->ruta;

        $this->cabecera['accion'] = 'Nuevo';

        if ($this->form_validation->run() == FALSE) {
            //$contenido['idp']=$this->idp;
            $uri = $this->uri->uri_to_assoc();
            if (@$this->vtip) {
                $this->tip = $uri['tip'];
                $enl = '/tip/' . $this->tip;
            }
            if ($this->vidp) {
                $this->idp = $uri['idp'];
                $enl = '/idp/' . $this->idp . '' . @$enl;
            }

            $contenido['cabecera'] = $this->cabecera;
            $contenido['action'] = $this->controlador . 'agregar' . $enl;
            $data['contenido'] = $this->load->view($this->carpeta . $this->formulario_agregar, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        } else {
            for ($i = 0; $i < count($this->campo); $i++) {
                $data[$this->campo[$i]] = $this->input->post($this->campo[$i]);
            }
			if(@$this->campoup_img){
				for ($i = 0; $i < count($this->campoup_img); $i++) {
					$archivo_img[$i]['name'] = $this->tool_general->limpiar_cadena($_FILES[$this->campoup_img[$i]]['name']);
					$archivo_img[$i]['tmp'] = $_FILES[$this->campoup_img[$i]]["tmp_name"];
				}
			}
			if(@$this->campoup_adj){
				for ($i = 0; $i < count($this->campoup_adj); $i++) {
					$archivo_adj[$i] = $this->tool_general->limpiar_cadena($_FILES[$this->campoup_adj[$i]]['name']);
				}
			}
            if ($this->vidp) {
                $this->idp = $this->input->post('idp');
                $data[$this->vidp] = $this->idp;
            }
            if (@$this->vtip) {
                $this->tip = $this->input->post('tip');
                if (!$this->nodata) {
                    $data[$this->vtip] = $this->tip;
                }
            }

            if ($this->orden) {
                if ($this->vidp) {
                    if ((@$this->vtip) && (!$this->nodata)) {
                        $consulta2 = $this->db->query('
                        SELECT * FROM ' . $this->tabla . '
                        WHERE ' . $this->vidp . '="' . $this->idp . '"
                            ' . $this->vtip . '="' . $this->tip . '"
                        ORDER BY ' . $this->orden . ' desc');
                    } else {
                        $consulta2 = $this->db->query('
                    SELECT * FROM ' . $this->tabla . '
                    WHERE ' . $this->vidp . '="' . $this->idp . '"
                    ORDER BY ' . $this->orden . ' desc');
                    }
                } else {
                    if (($this->vtip) && (!$this->nodata)) {
                        $consulta2 = $this->db->query('
                        SELECT * FROM ' . $this->tabla . '
                        WHERE ' . $this->vtip . '="' . $this->tip . '"
                        ORDER BY ' . $this->orden . ' desc');
                    } else {
                        $consulta2 = $this->db->query('
                    SELECT * FROM ' . $this->tabla . '
                    ORDER BY ' . $this->orden . ' desc');
                    }
                }
                $fila = $consulta2->first_row('array');
                $data[$this->orden] = $fila[$this->orden] + 1;
            }
            $id = $this->$modelo->agregar($data);

            if ($id) {
                $data_img[$this->prefijo . 'id'] = $id;
			if(@$this->campoup_img){
                for ($i = 0; $i < count($this->campoup_img); $i++) {
                    if ($this->campoup_img[$i]) {
                        $ext = substr($archivo_img[$i]['name'], 0, -4);
                        $ext = substr($archivo_img[$i]['name'], strlen($ext), 4);
                        $nombre_archivo_nuevo = substr($archivo_img[$i]['name'], 0, -4) . '_' . $id . $ext;
                        $infoimg = @getimagesize($archivo_img[$i]['tmp']);
                        $ancho = $infoimg[0];
                        if ($ancho <= $this->tool_entidad->ancho_imagen()) {
                            if (copy($archivo_img[$i]['tmp'], $ruta_origen . $nombre_archivo_nuevo)) {
                                $consulta = $this->db->query('update ' . $this->tabla . ' set ' . $this->campoup_img[$i] . '="' . $nombre_archivo_nuevo . '" where ' . $this->prefijo . 'id=' . $id);
                                $nombre_thum = 't_' . $nombre_archivo_nuevo;
                                if (count($this->campoup_img_thum_width) || count($this->campoup_img_thum_height)) {
                                    $this->tool_general->crear_thumbnail($nombre_archivo_nuevo, $nombre_thum, $this->campoup_img_thum_width[$i], $this->campoup_img_thum_height[$i], $ruta_origen, 0, $this->escalar_img_thum);
                                }
                            }
                        } else {
                            if (copy($archivo_img[$i]['tmp'], $ruta_origen . $nombre_archivo_nuevo)) {
                                $consulta = $this->db->query('update ' . $this->tabla . ' set ' . $this->campoup_img[$i] . '="' . $nombre_archivo_nuevo . '" where ' . $this->prefijo . 'id=' . $id);
                                $nombre_thum = 't_' . $nombre_archivo_nuevo;
                                $this->tool_general->crear_thumbnail($nombre_archivo_nuevo, $nombre_archivo_nuevo, $this->tool_entidad->ancho_imagen(), $this->campoup_img_height[$i], $ruta_origen, 0, $this->escalar_img);
                                if (count($this->campoup_img_thum_width) || count($this->campoup_img_thum_height)) {
                                    $this->tool_general->crear_thumbnail($nombre_archivo_nuevo, $nombre_thum, $this->campoup_img_thum_width[$i], $this->campoup_img_thum_height[$i], $ruta_origen, 0, $this->escalar_img_thum);
                                }
                            }
                        }
                        /* $this->upload->file_name=substr($archivo_img[$i],0,-4).'_'.$id;

                          if($this->upload->do_upload($this->campoup_img[$i]))
                          {
                          $nombre_archivo=substr($archivo_img[$i],0,-4).'_'.$id.substr($archivo_img[$i],-4);
                          $data_img[$this->campoup_img[$i]]=$nombre_archivo;
                          $this->$modelo->editar($data_img);
                          $nombre_thum='t_'.$nombre_archivo;

                          if(count($this->campoup_img_width)||count($this->campoup_img_height))
                          { $this->tool_general->crear_thumbnail($nombre_archivo,$nombre_archivo,$this->campoup_img_width[$i],$this->campoup_img_height[$i],$ruta_origen,0,$this->escalar_img);}
                          if(count($this->campoup_img_thum_width)||count($this->campoup_img_thum_height))
                          { $this->tool_general->crear_thumbnail($nombre_archivo,$nombre_thum,$this->campoup_img_thum_width[$i],$this->campoup_img_thum_height[$i],$ruta_origen,0,$this->escalar_img_thum); }

                          } */
                    }
                }
			}
                //***************
                $data_adj[$this->prefijo . 'id'] = $id;
			if(@$this->campoup_adj){
                for ($i = 0; $i < count($this->campoup_adj); $i++) {
                    if ($this->campoup_adj[$i]) {

                        $adjunto[$i] = $_FILES[$this->campoup_adj[$i]]["tmp_name"];
                        if ($adjunto[$i]) {
                            $nom_adjunto = substr($archivo_adj[$i], 0, -4) . '_' . $id . substr($archivo_adj[$i], -4);
                            @copy($adjunto[$i], $ruta_origen . $nom_adjunto);
                            $data_adj[$this->campoup_adj[$i]] = $nom_adjunto;
                            $this->$modelo->editar($data_adj);
                        }
                    }
                }
			}
                //*************** audio
                $data_aud[$this->prefijo . 'id'] = $id;
				
                for ($i = 0; $i < count($this->campoup_aud); $i++) {
                    if ($this->campoup_aud[$i]) {
                        //var_dump($this->campoup_aud[$i]); exit ();
                        $this->upload->file_name = substr($archivo_aud[$i], 0, -4) . '_' . $id;
                        if ($this->upload->do_upload($this->campoup_aud[$i])) {

                            $nom_audio = substr($archivo_aud[$i], 0, -4) . '_' . $id . substr($archivo_aud[$i], -4);
                            $data_aud[$this->campoup_aud[$i]] = $nom_audio;
                            $this->$modelo->editar($data_aud);

                            //var_dump($nom_audio); exit ();
                        }
                    }
                }


                if ($this->no_mostrar_enlaces) {
                    $contenido = '';
                    $data['contenido'] = $this->load->view($this->carpeta . '/mensaje_exito', $contenido, true);
                    $this->load->view('plantilla_privado', $data);
                } else {

                    if (!$this->enlace_retorno) {
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
                    } else {
                        redirect($this->enlace_retorno . $this->tip);
                    }
                }
            }
        }
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
                'field' => $prefijo . 'idioma',
                'label' => 'Idioma',
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