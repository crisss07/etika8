<?php

require_once('Controladoradmin.php');

class Convocatoria extends Controladoradmin {

    function __construct() {
        parent::__construct();
        force_ssl();
        $this->load->helper(array('url', 'form'));
        $this->load->library('Form_validation');
        $this->load->library('Securimage');

        $this->load->helper('html');
        $this->load->library('Tool_general');
        $this->load->library('aws3'); 
//        $this->load->library(array('form_validation', 'tool_general'));
        //****** definiendo la tabla por defecto y prefijo si lo tuviera
        $this->tabla = 'postulante';
        $this->tablaF = 'postulante_f';
        $this->tabla1 = 'educacion_post_grado';
        $this->tabla2 = 'educacion_superior';
        $this->tabla3 = 'educacion_secundaria';
        $this->tabla4 = 'publicaciones';
        $this->tabla5 = 'trayectoria_laboral';
        $this->tabla6 = 'idiomas';
        $this->tablaP = 'paises';
        $this->tablaPI = 'postulante_idioma';
        $this->tablaC = 'convocatoria';
        $this->tablacv = 'cv_temporales';
        $this->prefijo = 'pos_';
        $this->prefijoF = 'pof_';
        $this->prefijo1 = 'edu_';
        $this->prefijo2 = 'pub_';
        $this->prefijo3 = 'tra_';
        $this->prefijo4 = 'idi_';
        $this->prefijo6 = 'idi_';
        $this->prefijoP = 'pai_';
        $this->prefijoPI = 'poi_';
        $this->prefijoC = 'con_';
        $this->prefijocv = 'cvt_';
        //******* definiendo campos de la tabla                  
        //****** definiendo nombre de carpeta por defecto
        $this->carpeta = 'convocatoria/';
        $this->controlador = 'convocatoria/';
        $this->urifull = $this->uri->uri_to_assoc();
        $this->rutabase = $this->tool_entidad->constantes['sitiopri'];
        $this->rutarchivo = $this->tool_entidad->sitio() . 'archivos/';
        $this->rutaimg = $this->tool_entidad->sitio() . 'files/img/';
        $this->rutadj = 'archivos/';
        $this->cuadro_actual = 'postulante';
        $this->boton_actual = '';
        $this->contenido = '';
        $this->contenido_completo = '';
        $this->bloquear_enlaces = '';
        //$this->formulario='usuario_form';
        //****** cargando el modelo
        $this->no_mostrar_enlaces = 1;
        $this->modelo = 'Modelo_postulante';
        $this->load->model($this->carpeta . 'Postulante_model', $this->modelo, TRUE);
        $consulta = $this->db->query('
        SELECT com_id as id, com_nombre as nombre
        FROM combos
        WHERE com_tipo="1"
        ORDER BY com_orden asc'
        );
        $grados = $consulta->result_array();
        $this->grados[-1] = 'Seleccione el Grado o Titulo';
        foreach ($grados as $grado) {
            $this->grados[$grado['id']] = $grado['nombre'];
        }
        $consulta = $this->db->query('
        SELECT com_id as id, com_nombre as nombre
        FROM combos
        WHERE com_tipo="2"
        ORDER BY com_orden asc'
        );
        $grados_sup = $consulta->result_array();
        $this->grados_sup[-1] = 'Seleccione el Grado o Titulo';
        foreach ($grados_sup as $grado) {
            $this->grados_sup[$grado['id']] = $grado['nombre'];
        }
        $consulta = $this->db->query('
        SELECT com_id as id, com_nombre as nombre
        FROM combos
        WHERE com_tipo="3" and com_id<>65
        ORDER BY com_nombre asc'
        );
        $area_pro = $consulta->result_array();
        $profesionOtro = $this->db->query('
        SELECT com_id as id, com_nombre as nombre
        FROM combos
        WHERE com_tipo="3" and com_id=65
        ORDER BY com_nombre asc'
        );
        $consulta = $this->db->query('
        SELECT com_id as id, com_nombre as nombre
        FROM combos
        WHERE com_tipo="5"
        ORDER BY com_orden asc'
        );
        $area_exp = $consulta->result_array();
//        $this->area_exp[-1] = 'Seleccione la Área de Experiencia';
        foreach ($area_exp as $grado) {
            $this->area_exp[$grado['id']] = $grado['nombre'];
        }

        $consulta = $this->db->query('
        SELECT com_id as id, com_nombre as nombre
        FROM combos
        WHERE com_tipo="6"
        ORDER BY com_orden asc'
        );
        $sector_exp = $consulta->result_array();
//        $this->sector_exp[-1] = 'Seleccione el Sector de Experiencia';
        foreach ($sector_exp as $grado) {
            $this->sector_exp[$grado['id']] = $grado['nombre'];
        }

        $consulta = $this->db->query('
        SELECT com_id as id, com_nombre as nombre
        FROM combos
        WHERE com_tipo="9"
        ORDER BY com_orden asc'
        );
        $nivel_alcanzado = $consulta->result_array();
        $this->nivel_alcanzado[-1] = 'Seleccione máximo nivel alcanzado';
        foreach ($nivel_alcanzado as $grado) {
            $this->nivel_alcanzado[$grado['id']] = $grado['nombre'];
        }

        $consultaN = $this->db->query('
        SELECT com_id as id, com_nombre as nombre
        FROM combos
        WHERE com_tipo="11"
        ORDER BY com_orden asc'
        );
        $nivel_alcanzadoN = $consultaN->result_array();
        $this->nivel_alcanzadoN[-1] = 'Seleccione experiencia en no Supervisión';
        foreach ($nivel_alcanzadoN as $grado) {
            $this->nivel_alcanzadoN[$grado['id']] = $grado['nombre'];
        }


        $arrayProfesionOtro = $profesionOtro->result_array();
        $this->area_pro[-1] = 'Seleccione el Área de Profesión';
        foreach ($area_pro as $grado) {
            $this->area_pro[$grado['id']] = $grado['nombre'];
        }
        if (array_key_exists(0, $arrayProfesionOtro)) {
            $this->area_pro[$arrayProfesionOtro[0]['id']] = $arrayProfesionOtro[0]['nombre'];
        }

        $consulta = $this->db->query('SELECT * FROM contador ORDER BY con_orden asc');
        $fila = $consulta->result_array();
        $this->contador[-1] = '¿Cómo se enteró de esta postulación?';
        foreach ($fila as $row) {
            $this->contador[$row['con_id']] = $row['con_nombre'];
        }


        $this->cabecera['titulo'] = 'Formulario de Postulación';
        $this->cabecera['accion'] = '';
        $this->estado = $this->prefijo . 'estado';
        $this->hiddens = array($this->prefijo . 'id');
        $this->presession = $this->tool_entidad->presession();

        //******conf uploads
        $this->config_normal['upload_path'] = './archivos/cvtemporales/';
        $this->config_normal['allowed_types'] = 'gif|jpg|png|flv|avi|swf';
        $this->config_normal['max_size'] = '10240';
        $this->load->library('upload', $this->config_normal);

        $this->ruta = $this->config_normal['upload_path'];

//        campo para adjunto
        $this->campoup_adj = array($this->prefijocv . 'docnombre');


        @session_start();
//        if (!isset($_SESSION[$this->presession . 'usuario'])) {
//            redirect(base_url() . index_page());
//        }
    }

    function index() {
        @$id = $this->urifull['id'];
        $_SESSION[$this->presession . 'idc'] = $id;
        $contenido = array();
        $data['contenido'] = $this->load->view($this->carpeta . '/formulario', $contenido, true);
        $this->load->view('plantilla_publico_2019_banner', $data);
    }

    public function editardatos($dato_concatenado = null) {

        if (!isset($_SESSION[$this->presession . 'usuario'])) {
            redirect(base_url() . index_page());
        }
        list($salario, $contador, $disponibilidad) = explode("_", $dato_concatenado);
        $_SESSION[$this->presession . 'contador'] = $contador;
        $_SESSION[$this->presession . 'salario'] = $salario;
        $_SESSION[$this->presession . 'disponibilidad'] = $disponibilidad;
        // var_dump($_SESSION[$this->presession . 'usuario']);
        // var_dump($_SESSION['salario']);
        // var_dump($_SESSION['contador']);
        // var_dump($_SESSION['disponibilidad']);
        // exit();

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


            $consulta = $this->db->query('
                        SELECT pof_ambito_exp,pof_area_exp,pof_sector_exp,pof_supervisar_exp
                        FROM postulante_f
                        WHERE pos_id=' . $id);
            $sintesis = $consulta->row_array();

            $sintesisFecha = $this->db->query('
                SELECT pos_fecha_sintesis_exp as fecha,pof_ambito_exp,pof_area_exp,pof_sector_exp,pof_supervisar_exp
                FROM postulante_f f
                INNER JOIN postulante p
                ON p.pos_id=f.pos_id
                WHERE p.pos_id=' . $id);
                $fecha = $sintesisFecha->row_array();
                if ($fecha['pof_area_exp'] != '' && $fecha['pof_sector_exp'] != '' && $fecha['pof_supervisar_exp'] != '') {
                    $fecha = $fecha['fecha'];
                } else {
                    $fecha = '';
                }

            if ($sintesis['pof_ambito_exp']) {
                for ($j = 1; $j <= 3; $j++) {
                    if (preg_match('/' . $j . '/', $sintesis['pof_ambito_exp'])) {
                        @$ambito_exp .= $ambitos_exp[$j] . '<br/>';
                    }
                }
                $sintesis['pos_ambito_exp'] = substr($ambito_exp, 0, (strlen($ambito_exp) - 5));
                @$sintesis['pos_area_exp'] = $this->area_exp[$sintesis['pof_area_exp']];
                @$sintesis['pos_sector_exp'] = $this->sector_exp[$sintesis['pof_sector_exp']];
                $sintesis['pos_supervisar_exp'] = strtoupper($sintesis['pof_supervisar_exp']);
            }

            $contenido['sintesis'] = $sintesis;
            $contenido['fecha'] = $fecha;
            $contenido['arrayFechas'] = $arrayFechas;
            $contenido['id'] = $id;
            $data['contenido'] = $this->load->view($this->carpeta . '/formulario_datos', $contenido, true);
            $this->load->view('plantilla_publico_2019', $data);
        }
    }

    function editar_experiencia_sintesis() {
        $this->boton_actual = 'Trayectoria Laboral';
        $formulario = 'experiencia_sintesis_form';
        $this->definir_experiencia_sintesis_form_editar();
        $id = $_SESSION[$this->presession . 'id'];
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tablaF . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $this->cabecera['accion'] = 'Síntesis de Experiencia Laboral';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['action'] = $this->controlador . 'guardar_editar_experiencia_sintesis';
        $contenido['fila'] = $fila;
        $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
        $this->load->view('plantilla_publico_2019', $data);
    }

    function guardar_editar_experiencia_sintesis() {
        $this->boton_actual = 'Trayectoria Laboral';
        $formulario = 'experiencia_sintesis_form';
        $this->definir_experiencia_sintesis_form_editar();
        $prefijo = 'pof_';
        $campof = array($prefijo . 'ambito_exp', $prefijo . 'area_exp', $prefijo . 'sector_exp', $prefijo . 'supervisar_exp');
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Síntesis de Experiencia Laboral';

        $id = $this->input->post($this->prefijo . 'id');
        if ($this->form_validation->run() == FALSE) {
            $fila[$this->prefijo . 'id'] = $id;
            $fila[$prefijo . 'ambito_exp1'] = $this->input->post($this->prefijoF . 'ambito_exp1');
            $fila[$prefijo . 'ambito_exp2'] = $this->input->post($this->prefijoF . 'ambito_exp2');
            $fila[$prefijo . 'ambito_exp3'] = $this->input->post($this->prefijoF . 'ambito_exp3');
            $fila[$prefijo . 'area_exp'] = @implode(',', $this->input->post($this->prefijoF . 'area_exp'));
            $fila[$prefijo . 'sector_exp'] = @implode(',', $this->input->post($this->prefijoF . 'sector_exp'));
            $fila[$prefijo . 'supervisar_exp'] = $this->input->post($this->prefijoF . 'supervisar_exp');
            $fila[$prefijo . 'max_nivel'] = $this->input->post($this->prefijoF . 'max_nivel');
            $fila[$prefijo . 'max_nivel_no'] = $this->input->post($this->prefijoF . 'max_nivel_no');
            $fila[$prefijo . 'anios_exp'] = $this->input->post($this->prefijoF . 'anios_exp');
            $contenido['cabecera'] = $this->cabecera;
            $contenido['fila'] = $fila;
            $contenido['action'] = $this->carpeta . 'guardar_editar_experiencia_sintesis';
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_publico_2019', $data);
        } else {
            for ($i = 0; $i < count($campof); $i++) {
                $data[$campof[$i]] = $this->input->post($campof[$i]);
            }
            $ambito = '';
            for ($j = 1; $j <= 3; $j++) {
                if ($this->input->post($this->prefijoF . 'ambito_exp' . $j)) {
                    $ambito .= $this->input->post($this->prefijoF . 'ambito_exp' . $j) . ',';
                }
            }
            $data[$prefijo . 'ambito_exp'] = $ambito;
            if ($data[$prefijo . 'supervisar_exp'] == 'si') {
                $data[$prefijo . 'max_nivel'] = $this->input->post($this->prefijoF . 'max_nivel');
                $data[$prefijo . 'anios_exp'] = $this->input->post($this->prefijoF . 'anios_exp');
                $data[$prefijo . 'max_nivel_no'] = '0';
            } else {
                $data[$prefijo . 'max_nivel_no'] = $this->input->post($this->prefijoF . 'max_nivel_no');
                $data[$prefijo . 'max_nivel'] = '0';
                $data[$prefijo . 'anios_exp'] = '';
            }
            $stringAreaExperiencia = @implode(',', $data[$this->prefijoF . "area_exp"]);
            $stringSectorExperiencia = @implode(',', $data[$this->prefijoF . "sector_exp"]);

            $data[$this->prefijoF . "area_exp"] = $stringAreaExperiencia;
            $data[$this->prefijoF . "sector_exp"] = $stringSectorExperiencia;
            $data[$this->prefijo . 'id'] = $id;


            if ($this->$modelo->editarF($data)) {
//                para actulizar la fecha sintesis experiencia
                $this->Ufecha('fecha_sintesis_exp');
//                para actulizar la fecha de uno de los tab
                $this->Ufecha('fecha_trayectoria_laboral');

                $contador = $_SESSION[$this->presession . 'contador'];
                $salario = $_SESSION[$this->presession . 'salario'];
                $disponibilidad = $_SESSION[$this->presession . 'disponibilidad'];

                $dato_concatenado = $salario .'_'. $contador .'_'. $disponibilidad;


                redirect('convocatoria/editardatos/'.$dato_concatenado);
            }
        }
    }

    function definir_experiencia_sintesis_form_editar() {
        $prefijo = $this->prefijo;
        $config = $this->set_reglas_validacion_experiencia_sintesis_agregar();
        $mensajes = $this->set_mensajes_error1();
// inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach ($mensajes as $msj)
            $this->form_validation->set_message($msj['regla'], $msj['mensaje']);
// inicio asignando las reglas y mensajes de validacion
    }

    function set_reglas_validacion_experiencia_sintesis_agregar() {
        $prefijoF = $this->prefijoF;
        $config = array(
//            comentado por que se convirtieron multiselect
//            array(
//                'field' => $prefijoF . 'area_exp',
//                'label' => 'Área de Experiencia',
//                'rules' => 'is_natural'
//            ),
//            array(
//                'field' => $prefijoF . 'sector_exp',
//                'label' => 'Sector de Experiencia',
//                'rules' => 'is_natural'
//            ),
            array(
                'field' => $prefijoF . 'anios_exp',
                'label' => 'Años de Experiencia en Supervisión',
                'rules' => 'is_numeric'
            ),
            array(
                'field' => $prefijoF . 'supervisar_exp',
                'label' => 'Experiencia en supervisión',
                'rules' => 'required'
            )
        );
        return $config;
    }

    function set_mensajes_error1() {
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

    function editar_datospersonal() {

        $this->boton_actual = 'Datos Personales';
        $formulario = 'datospersonales_editar_form';
        $this->definir_datos_form_editar();
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];

        $consulta = $this->db->query('
        SELECT p.pos_id,pos_nombre, pos_apaterno, pos_amaterno, pos_nacionalidad,
			pof_fecha_nacimiento,
			pof_sexo,
			pai_id,
                        pof_pais_ciudad,
                        pof_ciudad_otra,
			ciu_id,
			pos_direccion,
			pos_telefono,
			pos_celular,
			pos_email,
			pos_traslado,
			pof_salario,
                        pos_traslado_lugar
                FROM postulante  p
               inner join postulante_f pf
               on p.pos_id=pf.pos_id
               WHERE p.pos_id=' . $id);

//        $id;
        $fila = $consulta->first_row('array');

        $consultaPaises = $this->db->query('
        SELECT * FROM ' . $this->tablaP . ' where ' . $this->prefijoP . 'tipo=1 and ' . $this->prefijoP . 'id<>10 order by ' . $this->prefijoP . 'orden');
        $newPaises = $consultaPaises->result_array();

        $consultaCiudad = $this->db->query('
        SELECT * FROM ' . $this->tablaP . ' where ' . $this->prefijoP . 'tipo=2
                and ' . $this->prefijoP . 'id<>14 order by ' . $this->prefijoP . 'orden');
        $ciudades = $consultaCiudad->result_array();
        $consultaCiudadOtro = $this->db->query('
        SELECT * FROM ' . $this->tablaP . ' where ' . $this->prefijoP . 'tipo=2
                and ' . $this->prefijoP . 'id=14 order by ' . $this->prefijoP . 'nombre');

        $ciudadesOtro = $consultaCiudadOtro->result_array();

        $newCiudades[] = array('pai_id' => '', 'pai_nombre' => 'Seleccione una ciudad');
        foreach ($ciudades as $key => $value) {
            $newCiudades[] = $value;
        }
        if (array_key_exists(0, $ciudadesOtro)) {
            $newCiudades[] = $ciudadesOtro[0];
        }

        $this->cabecera['accion'] = 'Editar Datos Personales';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['action'] = $this->controlador . 'guardar_editar_datospersonal';
        $contenido['fila'] = $fila;
        $contenido['paises'] = $newPaises;
        $contenido['ciudades'] = $newCiudades;
        $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
        $this->load->view('plantilla_publico_2019', $data);
    }

    function guardar_editar_datospersonal() {

        $this->boton_actual = 'Datos Personales';
        $formulario = 'datospersonales_editar_form';
        $campo = array($this->prefijo . 'nombre', $this->prefijo . 'apaterno', $this->prefijo . 'amaterno', $this->prefijo . 'nacionalidad',
            $this->prefijo . 'direccion', $this->prefijo . 'telefono', $this->prefijo . 'celular', $this->prefijo . 'email', $this->prefijo . 'traslado');
        $campoF = array($this->prefijoF . 'sexo', $this->prefijoF . 'fecha_nacimiento', $this->prefijoF . 'pais_ciudad', $this->prefijoF . 'ciudad_otra', $this->prefijoF . 'salario', $this->prefijoP . 'id', 'ciu_id');

        $this->definir_datos_form_editar();

        $prefijo = $this->prefijo;
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Editar Datos Personales';
        $id = $this->input->post($this->prefijo . 'id');
        $consultaBolivia = $this->db->query('
        SELECT * FROM ' . $this->tablaP . ' where ' . $this->prefijoP . 'tipo=1 and ' . $this->prefijoP . 'id=1 order by ' . $this->prefijoP . 'nombre');
        $paisBolivia = $consultaBolivia->result_array();

        $consultaOtro = $this->db->query('
        SELECT * FROM ' . $this->tablaP . ' where ' . $this->prefijoP . 'tipo=1 and ' . $this->prefijoP . 'id=10 order by ' . $this->prefijoP . 'nombre');
        $paisOtro = $consultaOtro->result_array();

        $consultaPaises = $this->db->query('
        SELECT * FROM ' . $this->tablaP . ' where ' . $this->prefijoP . 'tipo=1 and ' . $this->prefijoP . 'id<>1 and ' . $this->prefijoP . 'id<>10 order by ' . $this->prefijoP . 'nombre');
        $paises = $consultaPaises->result_array();
        $newPaises = array();
        $newCiudades = array();
        if (array_key_exists(0, $paisBolivia)) {
            $newPaises[] = $paisBolivia[0];
        }
        foreach ($paises as $key => $value) {
            $newPaises[] = $value;
        }
        if (array_key_exists(0, $paisOtro)) {
            $newPaises[] = $paisOtro[0];
        }
        $consultaCiudad = $this->db->query('
        SELECT * FROM ' . $this->tablaP . ' where ' . $this->prefijoP . 'tipo=2
                and ' . $this->prefijoP . 'id<>14 order by ' . $this->prefijoP . 'orden');
        $ciudades = $consultaCiudad->result_array();
        $consultaCiudadOtro = $this->db->query('
        SELECT * FROM ' . $this->tablaP . ' where ' . $this->prefijoP . 'tipo=2
                and ' . $this->prefijoP . 'id=14 order by ' . $this->prefijoP . 'nombre');
        $ciudadesOtro = $consultaCiudadOtro->result_array();

        $newCiudades[] = array('pai_id' => '', 'pai_nombre' => 'Seleccione una ciudad');
        foreach ($ciudades as $key => $value) {
            $newCiudades[] = $value;
        }
        if (array_key_exists(0, $ciudadesOtro)) {
            $newCiudades[] = $ciudadesOtro[0];
        }
        $idPais = $this->input->post('pai_id');
        $idCiudad = $this->input->post('ciu_id');

        if ($this->form_validation->run() == FALSE || ($idPais == 1 && $idCiudad == "")) {
            $fila[$this->prefijo . 'id'] = $this->input->post('pos_id');
            $fila[$this->prefijo . 'nombre'] = $this->input->post($this->prefijo . 'nombre');
            $fila[$this->prefijo . 'amaterno'] = $this->input->post($this->prefijo . 'amaterno');
            $fila[$this->prefijo . 'apaterno'] = $this->input->post($this->prefijo . 'apaterno');
            $fila[$this->prefijo . 'direccion'] = $this->input->post($this->prefijo . 'direccion');
            $fila[$this->prefijo . 'telefono'] = $this->input->post($this->prefijo . 'telefono');
            $fila[$this->prefijo . 'celular'] = $this->input->post($this->prefijo . 'celular');
            $fila[$this->prefijo . 'email'] = $this->input->post($this->prefijo . 'email');
            $fila[$prefijo . 'sexo'] = $this->input->post($prefijo . 'sexo');
            if ($this->input->post($prefijo . 'nacionalidad') == 1) {
                $fila[$prefijo . 'nacionalidad'] = 'BOLIVIANA';
            } else {
                $fila[$prefijo . 'nacionalidad'] = $this->input->post($prefijo . 'nacionalidad_otra');
            }
            if ($this->input->post('pai_id') != 1) {
                $fila[$this->prefijoF . 'pais_ciudad'] = '';
            } else {
                $fila[$this->prefijoF . 'pais_ciudad'] = $this->input->post($this->prefijoF . 'pais_ciudad');
            }
            $fila['pai_id'] = $this->input->post('pai_id');
            $fila['ciu_id'] = $this->input->post('ciu_id');
            $fila[$this->prefijoF . 'ciudad_otra'] = $this->input->post($this->prefijoF . 'ciudad_otra');
            $fila[$this->prefijoF . 'salario'] = $this->input->post($this->prefijoF . 'salario');
            if ($this->input->post($prefijo . 'traslado')) {
                $fila[$prefijo . 'traslado'] = $this->input->post($prefijo . 'traslado');
                $fila[$prefijo . 'traslado_lugar'] = $this->input->post($prefijo . 'traslado_lugar');
            }

            $contenido['cabecera'] = $this->cabecera;
            $contenido['fila'] = $fila;
            $contenido['paises'] = $newPaises;
            if ($idPais == 1 && $idCiudad == "") {
                $contenido['errorCiudad'] = 'Debe seleccionar una ciudad';
            }

            $contenido['ciudades'] = $newCiudades;
            $contenido['action'] = $this->carpeta . 'guardar_editar_datospersonal';
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_publico_2019', $data);
        } else {
            $error_telefono = "";
            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            for ($i = 0; $i < count($campoF); $i++) {
                $dataF[$campoF[$i]] = $this->input->post($campoF[$i]);
            }
            if (!$data[$prefijo . 'telefono'] && !$data[$prefijo . 'celular']) {
                $error_telefono = 'Debe Introducir un Teléfono o Celular.';
            }
            if ($error_telefono) {

                $fila[$this->prefijo . 'id'] = $id;
                $fila[$this->prefijo . 'nombre'] = $this->input->post($this->prefijo . 'nombre');
                $fila[$this->prefijo . 'amaterno'] = $this->input->post($this->prefijo . 'amaterno');
                $fila[$this->prefijo . 'apaterno'] = $this->input->post($this->prefijo . 'apaterno');
                $fila[$this->prefijo . 'direccion'] = $this->input->post($this->prefijo . 'direccion');
                $fila[$this->prefijo . 'telefono'] = $this->input->post($this->prefijo . 'telefono');
                $fila[$this->prefijo . 'celular'] = $this->input->post($this->prefijo . 'celular');
                $fila[$this->prefijo . 'email'] = $this->input->post($this->prefijo . 'email');
                $fila[$prefijo . 'sexo'] = $this->input->post($prefijo . 'sexo');
                $fila['pai_id'] = $this->input->post('pai_id');
                $fila['ciu_id'] = $this->input->post('ciu_id');
                $fila[$this->prefijoF . 'ciudad_otra'] = $this->input->post($this->prefijoF . 'ciudad_otra');
                $fila[$this->prefijoF . 'salario'] = $this->input->post($this->prefijoF . 'salario');
                if ($this->input->post($prefijo . 'nacionalidad') == 1) {
                    $fila[$prefijo . 'nacionalidad'] = 'BOLIVIANA';
                } else {
                    $fila[$prefijo . 'nacionalidad'] = $this->input->post($prefijo . 'nacionalidad_otra');
                }
                if ($this->input->post('pai_id') != 1) {
                    $fila[$this->prefijoF . 'pais_ciudad'] = 156;
                } else {
                    $fila[$this->prefijoF . 'pais_ciudad'] = $this->input->post($this->prefijoF . 'pais_ciudad');
                }
                if ($this->input->post($prefijo . 'traslado')) {
                    $fila[$prefijo . 'traslado'] = $this->input->post($prefijo . 'traslado');
                    $fila[$prefijo . 'traslado_lugar'] = $this->input->post($prefijo . 'traslado_lugar');
                }
                $contenido['cabecera'] = $this->cabecera;
                $contenido['fila'] = $fila;
                $contenido['paises'] = $newPaises;
                if ($idPais == 1 && $idCiudad == "") {
                    $contenido['errorCiudad'] = 'Debe seleccionar una ciudad';
                }

                $contenido['ciudades'] = $newCiudades;
                $contenido['error_telefono'] = $error_telefono;
                $contenido['action'] = $this->carpeta . 'guardar_editar_datospersonal';
                $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
                $this->load->view('plantilla_publico_2019', $data);
            } else {

                switch ($data[$prefijo . 'nacionalidad']) {
                    case 1:
                        $data[$prefijo . 'nacionalidad'] = 'BOLIVIANA';
                        break;
                    case 2:
                        $data[$prefijo . 'nacionalidad'] = $this->input->post($prefijo . 'nacionalidad_otra');
                        break;
                }
                switch ($dataF['pai_id']) {
                    case 1:
                        $dataF[$this->prefijoF . 'pais_ciudad'] = '';
                        break;
                    default :
                        $dataF['ciu_id'] = 156;
                        $dataF[$this->prefijoF . 'pais_ciudad'] = $this->input->post($this->prefijoF . 'pais_ciudad');
                }
                $idCiudad = $dataF['ciu_id'];
                if ($idCiudad != 85 && $idCiudad != 92 && $idCiudad != 119 && $idCiudad != 125 && $idCiudad != 127 && $idCiudad != 133 && $idCiudad != 142 && $idCiudad != 149 && $idCiudad != 155) {

                    $dataF[$this->prefijoF . 'ciudad_otra'] = '';
                } else {
                    $dataF[$this->prefijoF . 'ciudad_otra'] = $this->input->post($this->prefijoF . 'ciudad_otra');
                }

                if ($data[$prefijo . 'traslado']) {
                    $data[$prefijo . 'traslado_lugar'] = $this->input->post($prefijo . 'traslado_lugar');
                } else {
                    $data[$prefijo . 'traslado_lugar'] = "";
                }

                $data[$this->prefijo . 'id'] = $id;
                $dataF[$this->prefijo . 'id'] = $id;
//                para modificar la fecha de la edicion
                $data[$this->prefijo . 'fecha_edicion'] = date('Y-m-d H:i:s');
                if ($this->$modelo->editar($data) && $this->$modelo->editarF($dataF)) {
                    $contador = $_SESSION[$this->presession . 'contador'];
                    $salario = $_SESSION[$this->presession . 'salario'];
                    $disponibilidad = $_SESSION[$this->presession . 'disponibilidad'];

                    $dato_concatenado = $salario .'_'. $contador .'_'. $disponibilidad;


                    redirect('convocatoria/editardatos/'.$dato_concatenado);
                }
            }
        }
    }

    function definir_datos_form_editar() {
        $prefijo = $this->prefijo;
        $config = $this->set_reglas_validacion_datos_editar();
        $mensajes = $this->set_mensajes_error();
// inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach ($mensajes as $msj)
            $this->form_validation->set_message($msj['regla'], $msj['mensaje']);
// inicio asignando las reglas y mensajes de validacion
    }

    function set_reglas_validacion_datos_editar() {
        $prefijo = $this->prefijo;
        $prefijoF = $this->prefijoF;
        $config = array(
            array(
                'field' => $prefijo . 'nombre',
                'label' => 'Nombres',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'apaterno',
                'label' => 'Ap. Paterno',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'amaterno',
                'label' => 'Ap. Materno',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijoF . 'fecha_nacimiento',
                'label' => 'Fecha de Nacimiento',
                'rules' => 'required'
            ),
//            array(
//                'field' => 'ciu_id',
//                'label' => 'Ciudad o Localidad',
//                'rules' => 'required'
//            ),
//            array(
//                'field' => $prefijo . 'direccion',
//                'label' => 'Direccion',
//                'rules' => 'required'
//            ),
            array(
                'field' => $prefijo . 'telefono',
                'label' => 'Teléfono',
                'rules' => 'min_length[7]'
            ),
            array(
                'field' => $prefijo . 'celular',
                'label' => 'Celular',
                'rules' => 'min_length[7]'
            ),
            array(
                'field' => $prefijo . 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email'
            ),
            array(
                'field' => $prefijoF . 'salario',
                'label' => 'Pretensión Salarial Referencial',
                'rules' => 'required'
            )
        );
        return $config;
    }

    function verificar() {
        $ci = $this->input->post('ci');
        $tipodoc = $this->input->post('tipodoc');
        

        $fila = "";

        if (!isset($_SESSION[$this->presession . 'idc'])) {
            redirect(base_url() . index_page());
        }

        switch ($tipodoc) {
            case 1:
                if ($ci) {
                    if (!is_numeric($ci)) {
                        @$error[$this->prefijo . 'documento'] = 'Debe Introducir solo Numeros';
                    }
                } 
                break;
        }

        $this->definir_datos_form_verificar();
        if ($this->form_validation->run() == FALSE) {

            //if ($this->input->post('captcha')) {
            //    $captcha = $this->input->post('captcha');
            //    $img = new Securimage();
            //    //var_dump($img); exit ();
            //    $captcha_valido = $img->check($captcha);
            //    if (!$captcha_valido)
            //        $error['captcha'] = 'Codigo Incorrecto';
            //}else {
             //   $error['captcha'] = 'Debe Introducir el Codigo';
            //}
            @$contenido['fila'] = $fila;
            @$contenido['msj'] = $msj;
            @$contenido['ci'] = $ci;
            if ($tipodoc == 1) {
                $contenido['check1'] = "checked";
            } elseif ($tipodoc == 2) {
                $contenido['check2'] = "checked";
            } elseif ($tipodoc == 3) {
                $contenido['check3'] = "checked";
            }
            @$contenido['error'] = $error;
            $data['contenido'] = $this->load->view($this->carpeta . '/formulario', $contenido, true);
            $this->load->view('plantilla_publico_2019_banner', $data);
        } else {
            //if ($this->input->post('captcha')) {
            //    $captcha = $this->input->post('captcha');
            //    $img = new Securimage();
            //    //var_dump($img); exit ();
            //    $captcha_valido = $img->check($captcha);
            //    if (!$captcha_valido)
             //       $error['captcha'] = 'Codigo Incorrecto';
            //}else {
            //    $error['captcha'] = 'Debe Introducir el Codigo';
            //}
            // if ($ci && $captcha_valido && !$error) {
            if ($ci && !@$error) {


                $consulta = $this->db->query('
        SELECT ' . $this->prefijo . 'documento,' . $this->prefijo . 'id FROM ' . $this->tabla . ' where ' . $this->prefijo . 'documento="' . $ci . '"');
                $fila = $consulta->row_array();


            }

            if ($fila) {
                $msj = 'Usted se encuentra registrado en el sistema';
                $contenido['fila'] = $fila;
                $contenido['msj'] = $msj;
                $contenido['ci'] = $ci;
                if ($tipodoc == 1) {
                    $contenido['check1'] = "checked";
                } elseif ($tipodoc == 2) {
                    $contenido['check2'] = "checked";
                } elseif ($tipodoc == 3) {
                    $contenido['check3'] = "checked";
                }
//                $contenido['error'] = $error;
//                $data['contenido'] = $this->load->view($this->carpeta . '/formulario', $contenido, true);
//                $this->load->view('plantilla_publico_2019_banner', $data);
                $_SESSION[$this->presession . 'ci'] = $ci;
                $_SESSION[$this->presession . 'tipodoc'] = $tipodoc;

                $idc = $_SESSION[$this->presession . 'idc'];
                $consultaC = $this->db->query('
                            SELECT  con_id1,(date_format(b.con_fecha_creacion,"%Y-%m-%d") + INTERVAL 20 DAY) as fecha_edicion, date_format(a.con_fecha_edicion, "%Y-%m-%d") as fecha
                            FROM convocatoria_postulacion a, convocatoria b
                            WHERE pos_id=' . $fila['pos_id'] . ' and con_id1=' . $idc . ' and b.con_id=a.con_id1 and (b.con_tope + INTERVAL 20 DAY) >="' . date('Y-m-d') . '"
                            ORDER BY a.con_fecha_creacion asc'
                );
                $postulaciones = $consultaC->row_array();
                if ($postulaciones) {
                    $data['contenido'] = $this->load->view($this->carpeta . 'posutulante_vigente', $contenido, true);
                    $this->load->view('plantilla_publico_2019_banner', $data);
                } else {
                    redirect('login/autenticar');
                }
//                redirect('convocatoria/login');
            } //elseif (is_array($fila)) {
            elseif ($fila == Null && !@$error) {

                $msj = 'Debe registrarse en el sistema';
                $_SESSION[$this->presession . 'usuario'] = 'us_temporal';
                $_SESSION[$this->presession . 'ci'] = $ci;
                $_SESSION[$this->presession . 'tipodoc'] = $tipodoc;



                redirect('convocatoria/existe');

//                redirect('convocatoria/datospersonal_nuevo');
            } else {
                @$contenido['fila'] = $fila;
                @$contenido['msj'] = $msj;
                @$contenido['ci'] = $ci;
                if ($tipodoc == 1) {
                    $contenido['check1'] = "checked";
                } elseif ($tipodoc == 2) {
                    $contenido['check2'] = "checked";
                } elseif ($tipodoc == 3) {
                    $contenido['check3'] = "checked";
                }
                @$contenido['error'] = $error;
                $data['contenido'] = $this->load->view($this->carpeta . '/formulario', $contenido, true);
                $this->load->view('plantilla_publico_2019_banner', $data);
            }
        }
    }

    function existe() {
        if (!isset($_SESSION[$this->presession . 'usuario'])) {
            redirect(base_url() . index_page());
        }
        @$data['contenido'] = $this->load->view($this->carpeta . '/mensaje_existencia', $contenido, true);
        $this->load->view('plantilla_publico_2019_banner', $data);
    }

    function login() {
        $data['contenido'] = $this->load->view($this->carpeta . '/login', $contenido, true);
        $this->load->view('plantilla_publico_2019_banner', $data);
    }

    function datospersonal_nuevo() {

        $this->boton_actual = 'Datos Personales';
        $this->bloquear_enlaces = 1;
        $formulario = 'datospersonales_form';
//        $campo2 = array($this->prefijo . 'nombre', $this->prefijo . 'apaterno', $this->prefijo . 'amaterno', $this->prefijoF . 'fecha_nacimiento', $this->prefijo . 'sexo', $this->prefijo . 'nacionalidad', $this->prefijo . 'pais_otro', $this->prefijo . 'ciudad',
//            $this->prefijo . 'direccion', $this->prefijo . 'telefono', $this->prefijo . 'celular', $this->prefijo . 'email', $this->prefijo . 'traslado', $this->prefijo . 'pass', $this->prefijo . 'salario', $this->prefijo . 'acuerdo', $this->prefijoP . 'id', 'ciu_id');
        $campo = array($this->prefijo . 'nombre', $this->prefijo . 'apaterno', $this->prefijo . 'amaterno', $this->prefijo . 'nacionalidad',
            $this->prefijo . 'direccion', $this->prefijo . 'telefono', $this->prefijo . 'celular', $this->prefijo . 'email', $this->prefijo . 'traslado', $this->prefijo . 'acuerdo', $this->prefijo . 'pass');
        $campoF = array($this->prefijoF . 'sexo', $this->prefijoF . 'fecha_nacimiento', $this->prefijoF . 'pais_ciudad', $this->prefijoF . 'ciudad_otra', $this->prefijoF . 'salario', $this->prefijoP . 'id', 'ciu_id');

        $this->definir_datos_form_agregar();
        $prefijo = $this->prefijo;
        $prefijoF = $this->prefijoF;
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Datos Personales';
        $consultaBolivia = $this->db->query('
        SELECT * FROM ' . $this->tablaP . ' where ' . $this->prefijoP . 'tipo=1 and ' . $this->prefijoP . 'id=1 order by ' . $this->prefijoP . 'nombre');
        $paisBolivia = $consultaBolivia->result_array();

        $consultaOtro = $this->db->query('
        SELECT * FROM ' . $this->tablaP . ' where ' . $this->prefijoP . 'tipo=1 and ' . $this->prefijoP . 'id=10 order by ' . $this->prefijoP . 'nombre');
        $paisOtro = $consultaOtro->result_array();

        $consultaPaises = $this->db->query('
        SELECT * FROM ' . $this->tablaP . ' where ' . $this->prefijoP . 'tipo=1 and ' . $this->prefijoP . 'id<>1 and ' . $this->prefijoP . 'id<>10 order by ' . $this->prefijoP . 'nombre');
        $paises = $consultaPaises->result_array();
        $newPaises = array();
        if (array_key_exists(0, $paisBolivia)) {
            $newPaises[] = $paisBolivia[0];
        }
        foreach ($paises as $key => $value) {
            $newPaises[] = $value;
        }
        if (array_key_exists(0, $paisOtro)) {
            $newPaises[] = $paisOtro[0];
        }
        $consultaCiudad = $this->db->query('
        SELECT * FROM ' . $this->tablaP . ' where ' . $this->prefijoP . 'tipo=2 order by ' . $this->prefijoP . 'orden');
        $ciudades = $consultaCiudad->result_array();
        $idCiudad = $this->input->post('ciu_id');
        $idPais = $this->input->post('pai_id');

        if ($this->form_validation->run() == FALSE || ($idPais == 1 && $idCiudad == "")) {

            $fila[$prefijoF . 'sexo'] = $this->input->post($prefijoF . 'sexo');
            if ($this->input->post($prefijo . 'nacionalidad') == 1) {
                $fila[$prefijo . 'nacionalidad'] = 'BOLIVIANA';
            } else {
                $fila[$prefijo . 'nacionalidad'] = $this->input->post($prefijo . 'nacionalidad_otra');
            }
            if ($this->input->post($prefijo . 'pais_otro') == 1) {
                $fila[$prefijo . 'pais_otro'] = 'BOLIVIA';
            } else {
                $fila[$prefijo . 'pais_otro'] = $this->input->post($prefijo . 'pais_otro_otra');
            }

            if ($this->input->post($prefijo . 'traslado')) {
                $fila[$prefijo . 'traslado'] = $this->input->post($prefijo . 'traslado');
                $fila[$prefijo . 'traslado_lugar'] = $this->input->post($prefijo . 'traslado_lugar');
            }
            $fila[$prefijo . 'tipodoc'] = $this->input->post($prefijo . 'tipodoc');
            $fila[$prefijo . 'acuerdo'] = $this->input->post($prefijo . 'acuerdo');
            $fila['ciu_id'] = $this->input->post('ciu_id');
            $fila['pai_id'] = $this->input->post('pai_id');
            $fila['pof_pais_ciudad'] = $this->input->post('pof_pais_ciudad');
            $fila['pof_ciudad_otra'] = $this->input->post('pof_ciudad_otra');
            $fila['pof_fecha_nacimiento'] = $this->input->post('pof_fecha_nacimiento');
            $fila['pos_salario'] = $this->input->post('pos_salario');


            $fila[$this->prefijo . 'nombre'] = $this->input->post($this->prefijo . 'nombre');
            $fila[$this->prefijo . 'amaterno'] = $this->input->post($this->prefijo . 'amaterno');
            $fila[$this->prefijo . 'apaterno'] = $this->input->post($this->prefijo . 'apaterno');
            $fila[$this->prefijo . 'direccion'] = $this->input->post($this->prefijo . 'direccion');
            $fila[$this->prefijo . 'telefono'] = $this->input->post($this->prefijo . 'telefono');
            $fila[$this->prefijo . 'celular'] = $this->input->post($this->prefijo . 'celular');
            $fila[$this->prefijo . 'email'] = $this->input->post($this->prefijo . 'email');
            $fila[$prefijoF . 'sexo'] = $this->input->post($prefijoF . 'sexo');
            $fila[$prefijo . 'tipodoc'] = $_SESSION[$this->presession . 'tipodoc'];
            $contenido['fila'] = $fila;
            $contenido['paises'] = $newPaises;
            $contenido['ciudades'] = $ciudades;
            if ($idPais == 1 && $idCiudad == "") {
                $contenido['errorCiudad'] = 'Debe seleccionar una ciudad';
            }

            $contenido['cabecera'] = $this->cabecera;
            $contenido['action'] = $this->carpeta . 'datospersonal_nuevo';
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_publico_2019', $data);
        } else {

            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            for ($i = 0; $i < count($campoF); $i++) {
                $dataF[$campoF[$i]] = $this->input->post($campoF[$i]);
            }
            $passconfirm = $this->input->post($this->prefijo . 'pass1');
//            echo $passconfirm."<br>";
            if ($passconfirm != $data[$prefijo . 'pass']) {
                $error_pass = 'Las Contraseña no coinciden con la Confirmación';
            }
            if (!$data[$prefijo . 'telefono'] && !$data[$prefijo . 'celular']) {
                $error_telefono = 'Debe Introducir un Teléfono o Celular.';
            }
            if (!$data[$prefijo . 'acuerdo']) {
                $error_acuerdo = 'Debe marcar el cuadro de Aceptar para seguir';
            }
            if ($error_acuerdo || $error_telefono || $error_pass) {
                $fila[$prefijoF . 'sexo'] = $this->input->post($prefijoF . 'sexo');
                if ($this->input->post($prefijo . 'nacionalidad') == 1) {
                    $fila[$prefijo . 'nacionalidad'] = 'BOLIVIANA';
                } else {
                    $fila[$prefijo . 'nacionalidad'] = $this->input->post($prefijo . 'nacionalidad_otra');
                }
                if ($this->input->post($prefijo . 'pais_otro') == 1) {
                    $fila[$prefijo . 'pais_otro'] = 'BOLIVIA';
                } else {
                    $fila[$prefijo . 'pais_otro'] = $this->input->post($prefijo . 'pais_otro_otra');
                }
                if ($this->input->post($prefijo . 'traslado')) {
                    $fila[$prefijo . 'traslado'] = $this->input->post($prefijo . 'traslado');
                    $fila[$prefijo . 'traslado_lugar'] = $this->input->post($prefijo . 'traslado_lugar');
                }
                $fila[$this->prefijo . 'nombre'] = $this->input->post($this->prefijo . 'nombre');
                $fila[$this->prefijo . 'amaterno'] = $this->input->post($this->prefijo . 'amaterno');
                $fila[$this->prefijo . 'apaterno'] = $this->input->post($this->prefijo . 'apaterno');
                $fila[$this->prefijo . 'direccion'] = $this->input->post($this->prefijo . 'direccion');
                $fila[$this->prefijo . 'telefono'] = $this->input->post($this->prefijo . 'telefono');
                $fila[$this->prefijo . 'celular'] = $this->input->post($this->prefijo . 'celular');
                $fila[$this->prefijo . 'email'] = $this->input->post($this->prefijo . 'email');

                $fila[$prefijo . 'tipodoc'] = $this->input->post($prefijo . 'tipodoc');
                $fila[$prefijo . 'acuerdo'] = $this->input->post($prefijo . 'acuerdo');
                $fila['ciu_id'] = $this->input->post('ciu_id');
                $fila['pai_id'] = $this->input->post('pai_id');
                $fila['pof_pais_ciudad'] = $this->input->post('pof_pais_ciudad');
                $fila['pof_ciudad_otra'] = $this->input->post('pof_ciudad_otra');
                $contenido['fila'] = $fila;
                $contenido['error_pass'] = $error_pass;

                $contenido['error_acuerdo'] = $error_acuerdo;
                $contenido['error_telefono'] = $error_telefono;
                $contenido['paises'] = $newPaises;
                $contenido['ciudades'] = $ciudades;
                $contenido['cabecera'] = $this->cabecera;
                $contenido['action'] = $this->carpeta . 'datospersonal_nuevo';
                $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
                $this->load->view('plantilla_publico_2019', $data);
            } else {
                switch ($data[$prefijo . 'nacionalidad']) {
                    case 1:
                        $data[$prefijo . 'nacionalidad'] = 'BOLIVIANA';
                        break;
                    case 2:
                        $data[$prefijo . 'nacionalidad'] = $this->input->post($prefijo . 'nacionalidad_otra');
                        break;
                }
                switch ($dataF['pai_id']) {
                    case 1:
                        $dataF[$this->prefijoF . 'pais_ciudad'] = '';
                        break;
                    default :
                        $dataF['ciu_id'] = 156;
                        $dataF[$this->prefijoF . 'pais_ciudad'] = $this->input->post($this->prefijoF . 'pais_ciudad');
                }
                $idCiudad = $dataF['ciu_id'];
                if ($idCiudad != 85 && $idCiudad != 92 && $idCiudad != 119 && $idCiudad != 125 && $idCiudad != 127 && $idCiudad != 133 && $idCiudad != 142 && $idCiudad != 149 && $idCiudad != 155) {

                    $dataF[$this->prefijoF . 'ciudad_otra'] = '';
                } else {
                    $dataF[$this->prefijoF . 'ciudad_otra'] = $this->input->post($this->prefijoF . 'ciudad_otra');
                }

                if ($data[$prefijo . 'traslado']) {
                    $data[$prefijo . 'traslado_lugar'] = $this->input->post($prefijo . 'traslado_lugar');
                } else {
                    $data[$prefijo . 'traslado_lugar'] = "";
                }
                $data[$prefijo . 'documento'] = $_SESSION[$this->presession . 'ci'];
                $data[$prefijo . 'tipodoc'] = $_SESSION[$this->presession . 'tipodoc'];
//                para colocar al postulante en disponibilidad inmediata
                $dataF[$this->prefijoF . 'estado'] = 1;
                $id = $this->$modelo->agregar($data);
                $dataF['pos_id'] = $id;
                $idF = $this->$modelo->agregarF($dataF);
                if ($id && $idF) {
                    $_SESSION[$this->presession . 'usuario'] = $data[$prefijo . 'documento'];
                    $_SESSION[$this->presession . 'nombre'] = $data[$prefijo . 'nombre'] . ' ' . $data[$prefijo . 'apaterno'] . ' ' . $data[$prefijo . 'amaterno'];
                    $_SESSION[$this->presession . 'id'] = $id;
                    $_SESSION[$this->presession . 'nuevo'] = 1;

                    redirect('convocatoria/postular');
                }
            }
        }
    }

    function postular() {
        if (!isset($_SESSION[$this->presession . 'idc'])) {
            redirect(base_url() . index_page());
        }

        $formulario = 'formulario_postular';
        $this->definir_postular_form_agregar();
        $prefijo = $this->prefijoF;
        $modelo = $this->modelo;

        $idC = $_SESSION[$this->presession . 'idc'];
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
            redirect('newpostulante/instruccion_formal');
        }
    }

    function cvtemporal() {
        if (!@isset($_SESSION[$this->presession . 'idc'])) {
            redirect(base_url() . index_page());
        }
        // var_dump($_SESSION[$this->presession . 'contador']);
        // var_dump($_SESSION[$this->presession . 'salario']);
        // var_dump($_SESSION[$this->presession . 'disponibilidad']);
        // exit();

        if ($_POST) {
            $_SESSION[$this->presession . 'contador'] = $_POST['contador'];
            $_SESSION[$this->presession . 'salario'] = $_POST['salario'];
            $_SESSION[$this->presession . 'disponibilidad'] = $_POST['pof_disponibilidad'];
            // echo true;
        } else {

            $modelo = $this->modelo;
            $ruta_origen = $this->ruta;

            $consultaDatos = $this->db->query('
                            SELECT pos_id,pos_documento,pos_apaterno,pos_amaterno,pos_nombre
                            FROM postulante 
                            WHERE pos_id=' . $_SESSION[$this->presession . 'id']
            );
            $resultado = $consultaDatos->row_array();

            $nombre = $resultado[$this->prefijo . 'apaterno'] . $resultado[$this->prefijo . 'amaterno'] . $resultado[$this->prefijo . 'nombre'] . $resultado[$this->prefijo . 'documento'];
            // $nombre = $resultado[$this->prefijo . 'id'] . $resultado[$this->prefijo . 'apaterno'] . $resultado[$this->prefijo . 'amaterno'] . $resultado[$this->prefijo . 'nombre'] . $resultado[$this->prefijo . 'documento'];
//            $nombre = $resultado[$this->prefijo . 'nombre'] . $resultado[$this->prefijo . 'apaterno'] . $resultado[$this->prefijo . 'documento'];
            $nombre = $this->reemplazar_string($nombre);
            $nombreAdj = strtoupper($nombre);

//            $nombreAdj = strtoupper($nombre) . date('dmY') . date('hi');
            

            for ($i = 0; $i < count($this->campoup_adj); $i++) {
                $j = $i + 1;
                @$archivo_adj[$i] = $this->tool_general->limpiar_cadena($_FILES[$this->campoup_adj[$i]]['name']);
                $borrar_adj[$i] = $this->input->post($this->campoup_adj[$i] . '_borrar' . $j);
            }

            if (array_key_exists($this->prefijocv . 'docnombre', $_FILES)) {
                if ($_FILES[$this->prefijocv . 'docnombre']['name'] != '') {
                    
                    for ($i = 0; $i < count($this->campoup_adj); $i++) {
                        if ($this->campoup_adj[$i]) {
                            if ($archivo_adj[$i]) {
                                $extension = explode('.', $archivo_adj[$i]);
                                $extension = $extension[count($extension) - 1];

                                $adjunto[$i] = $_FILES[$this->campoup_adj[$i]]["tmp_name"];

                                $nom_adjunto = $nombreAdj . "." . $extension;

                                //codigo de rodrigo
                                // subir archivos en la carpeta cvs/fijos
                                $ci_postulante = $resultado[$this->prefijo . 'documento'];
                                $folder_name_fijos='archivos/postulante/'. $ci_postulante .'/'.$nom_adjunto;//'zzz/'
                                $aws_bucket=$this->tool_entidad->aws_bucket();
                                $this->aws3->sendFile($aws_bucket,$_FILES['cvt_docnombre'] ,$folder_name_fijos);   

                                // subir archivos en la carpeta cvs/temp/'id_convocatoria'
                                $id_convocatoria = $_SESSION[$this->presession . 'idc'];
                                $folder_name_temp='archivos/cvs/temp/'.$id_convocatoria.'/'.$nom_adjunto;//'zzz/'

                                $this->aws3->sendFile($aws_bucket,$_FILES['cvt_docnombre'] ,$folder_name_temp);  
                                //hasta aqui

                                $data_adj[$this->campoup_adj[$i]] = $nom_adjunto;
                                $data_adj['pos_id'] = $_SESSION[$this->presession . 'id'];
                                $data_adj['con_id'] = $_SESSION[$this->presession . 'idc'];
                                $idResultado = $this->$modelo->agregarAdj($data_adj);
//                              guardar datos del postulante salario disponibilidad y como se entero
//*************************************** verificar desde aqui *********************88*********************
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
                                            // var_dump($_SESSION[$this->presession . 'salario']);
                                            // var_dump($_SESSION[$this->presession . 'contador']);
                                            // exit();
                                            $data['con_pretension_salarial'] = $prestacion;
                                            $data['contador_id'] = $contador;


                                            $this->db->query('UPDATE contador SET con_numero = con_numero+1 WHERE con_id=' . $contador . ' LIMIT 1 ;');
                                            $this->db->query('UPDATE postulante_f SET pof_salario =' . $prestacion . ' WHERE pos_id=' . $data['pos_id'] . ' LIMIT 1 ;');
//                                            $this->db->query('UPDATE postulante_f SET pof_salario =' . $prestacion . ',pof_disponibilidad =' . $disponible . ' WHERE pos_id=' . $data['pos_id'] . ' LIMIT 1 ;');
                                            $this->db->query('UPDATE postulante SET  pos_nro_postulaciones = ' . ($nro['nro'] + 1) . ' WHERE pos_id=' . $data['pos_id'] . ' LIMIT 1 ;');
                                            $id = $this->$modelo->agregarPostulacion($data);
                                if ($id) {
                                    redirect('convocatoria/mensaje');
                                }
                                    echo 'formato correcto';
                            } else {
                                if ($solo_eliminar_adj[$i]) {
                                    $data_eliminar_adj[$this->campoup_adj[$i]] = '';
//                                $this->$modelo->editar($data_eliminar_adj);
                                    //@unlink($ruta_origen . $borrar_adj[$i]);
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
            @$contenido['mensaje'] = $mensajeArchivo;
            $data['contenido'] = $this->load->view($this->carpeta . '/formulario_adjuntar', $contenido, true);
            $this->load->view('plantilla_publico_2019_banner', $data);
        }
    }

    function ecvtemporal() {
        if ($_POST) {
            $_SESSION[$this->presession . 'contador'] = $_POST['contador'];
            $_SESSION[$this->presession . 'salario'] = $_POST['salario'];
            $_SESSION[$this->presession . 'disponibilidad'] = $_POST['disponibilidad'];
            echo true;
        } else {

            redirect('newpostulante/editar_datospersonale');
        }
    }

    function mensaje() {
        if (!isset($_SESSION[$this->presession . 'idc'])) {
            redirect(base_url() . index_page());
        }

        @$data['contenido'] = $this->load->view($this->carpeta . '/mensaje', $contenido, true);
        $this->load->view('plantilla_publico_2019_banner', $data);
    }

    function completo() {
        $_SESSION[$this->presession . 'nuevo'] = '';
        $this->contenido_completo = 1;
        $contenido = '';
//        $this->definir_datos_form_agregar();
//        $prefijo = $this->prefijo;
//        $modelo = $this->modelo;
//        $data[$this->prefijo . 'id'] = $_SESSION[$this->presession . 'id'];
//        $data[$this->prefijo . 'recibir'] = $this->input->post('recibir_boletin');
//        $data[$this->prefijo . 'comentario'] = $this->input->post('comentario');
//        $this->$modelo->editar($data);
        $data['contenido'] = $this->load->view($this->carpeta . '/mensaje_exito', $contenido, true);
        $this->load->view('plantilla_publico', $data);
    }

    function definir_datos_form_verificar() {
        $prefijo = $this->prefijo;
        $config = $this->set_reglas_validacion_datos_verificar();
        $mensajes = $this->set_mensajes_error();
        // inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach ($mensajes as $msj)
            $this->form_validation->set_message($msj['regla'], $msj['mensaje']);
        // inicio asignando las reglas y mensajes de validacion
    }

    function set_reglas_validacion_datos_verificar() {
        $prefijo = $this->prefijo;
        $prefijoF = $this->prefijoF;
        $config = array(
            array(
                'field' => 'ci',
                'label' => 'Número de documento',
                'rules' => 'required|min_length[3]|max_length[30]'
            ),
            array(
                'field' => 'tipodoc',
                'label' => 'Tipo de documento',
                'rules' => 'required'
            ),
//            array(
//                'field' => 'captcha',
//                'label' => 'Tipo de documento',
//                'rules' => 'required'
//            )
        );
        return $config;
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
                if ($datos = @file_get_contents($archivo, NULL, NULL, $file_data[$tipo]["offsett"], $file_data[$tipo]["lon"])) {
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

    function Ufecha($campo) {
        $modelo = $this->modelo;
        $dataF[$this->prefijo . 'id'] = $_SESSION[$this->presession . 'id'];
        $dataF[$this->prefijo . $campo] = date('Y-m-d');
        $this->$modelo->fechasUpdate($dataF);
    }

}

?>