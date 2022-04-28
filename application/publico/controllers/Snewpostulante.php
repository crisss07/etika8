<?php

require_once('Controladoradmin.php');

class Snewpostulante extends Controladoradmin {

    function __construct() {
        parent::__construct();
        force_ssl();
        $this->load->helper(array('url', 'form'));
        $this->load->library('Form_validation');

        $this->load->helper('html');
        $this->load->library('Tool_general');

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
        $this->prefijo = 'pos_';
        $this->prefijoF = 'pof_';
        $this->prefijo1 = 'edu_';
        $this->prefijo2 = 'pub_';
        $this->prefijo3 = 'tra_';
        $this->prefijo4 = 'idi_';
        $this->prefijo6 = 'idi_';
        $this->prefijoP = 'pai_';
        $this->prefijoPI = 'poi_';
//******* definiendo campos de la tabla                  
//****** definiendo nombre de carpeta por defecto
        $this->carpeta = 'snewpostulante/';
        $this->controlador = 'snewpostulante/';

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
        $arrayProfesionOtro = $profesionOtro->result_array();
        $this->area_pro[-1] = 'Seleccione el Área de Profesión';
        foreach ($area_pro as $grado) {
            $this->area_pro[$grado['id']] = $grado['nombre'];
        }
        if (array_key_exists(0, $arrayProfesionOtro)) {
            $this->area_pro[$arrayProfesionOtro[0]['id']] = $arrayProfesionOtro[0]['nombre'];
        }
        $consulta = $this->db->query('
        SELECT com_id as id, com_nombre as nombre
        FROM combos
        WHERE com_tipo="4"
        ORDER BY com_orden asc'
        );
        $tipo_org = $consulta->result_array();
        $this->tipo_org[-1] = 'Seleccione el Tipo de Organización';
        foreach ($tipo_org as $grado) {
            $this->tipo_org[$grado['id']] = $grado['nombre'];
        }
        $consulta = $this->db->query('
        SELECT com_id as id, com_nombre as nombre
        FROM combos
        WHERE com_tipo="5"
        ORDER BY com_orden asc'
        );
        $area_exp = $consulta->result_array();
//        $this->area_exp[-1] = 'Seleccione la ?rea de Experiencia';
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
        $this->nivel_alcanzado[-1] = 'Seleccione mínimo nivel alcanzado';
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

        $this->cabecera['titulo'] = 'Formulario de Postulación';
        $this->cabecera['accion'] = '';
        $this->estado = $this->prefijo . 'estado';
        $this->hiddens = array($this->prefijo . 'id');
        $this->presession = $this->tool_entidad->presession();
        session_start();
        if (!isset($_SESSION[$this->presession . 'usuario'])) {
            redirect(base_url() . index_page());
        }
    }

    function aviso() {

        $this->load->view('snewpostulante/aviso', $contenido);
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
        $this->load->view('plantilla_publico_2019_banner', $data);
    }

    function instruccion_formal() {
        $this->boton_actual = 'Instruccion Formal';
        $id = $_SESSION[$this->presession . 'id'];
//        codigo para editar la fecha del cv inicio
//        $data[$this->prefijo . 'id'] = $id;
//        $data[$this->prefijo . 'fecha_edicion'] = date('Y-m-d H:i:s');
//        $modelo = $this->modelo;
//        $this->$modelo->editar($data);
//        fin
        $this->cabecera['accion'] = 'Instrucción Formal';
        $this->campos_listar_postgrado = array('Desde', 'Hasta', 'Institución', 'País', 'Grado o Titulo', 'Área de Postgrado', 'Tema Tesis', 'Titulado');
        $this->campos_reales_postgrado = array($this->prefijo1 . 'desde', $this->prefijo1 . 'hasta', $this->prefijo1 . 'institucion', $this->prefijo1 . 'pais', $this->prefijo1 . 'grado', $this->prefijo1 . 'area', $this->prefijo1 . 'tema', $this->prefijo1 . 'titulado');

        $consulta = $this->db->query('
        SELECT *,
        case ' . $this->prefijo1 . 'titulado
        when "1" then "si"
        else "no"
        end as ' . $this->prefijo1 . 'titulado
        FROM ' . $this->tabla1 . '
        INNER JOIN combos
            ON com_id=edu_grado
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY com_orden asc'
        );
        $postgrado = $consulta->result_array();

//        fecha postgrado
        $consultaFecha = $this->db->query('
        SELECT date(' . $this->prefijo1 . 'fecha_edicion) as fecha
        FROM ' . $this->tabla1 . '
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY ' . $this->prefijo1 . 'fecha_edicion desc limit 1'
        );
        $postfecha = $consultaFecha->row_array();
        @$postfecha = $postfecha['fecha'];


        $this->campos_listar_superior = array('Desde', 'Hasta', 'Institución', 'País', 'Grado o Titulo', 'Profesión', 'Tema Tesis', 'Titulado');
        $this->campos_reales_superior = array($this->prefijo1 . 'desde', $this->prefijo1 . 'hasta', $this->prefijo1 . 'institucion', $this->prefijo1 . 'pais', $this->prefijo1 . 'grado', $this->prefijo1 . 'area', $this->prefijo1 . 'tema', $this->prefijo1 . 'titulado');
        $consulta = $this->db->query('
        SELECT *,
        case ' . $this->prefijo1 . 'titulado
        when "1" then "si"
        else "no"
        end as ' . $this->prefijo1 . 'titulado
        FROM ' . $this->tabla2 . '
        INNER JOIN combos
            ON com_id=edu_grado
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY com_orden asc'
        );

        $superior = $consulta->result_array();

//        fecha superior
        $consultaFecha = $this->db->query('
        SELECT date(' . $this->prefijo1 . 'fecha_edicion) as fecha
        FROM ' . $this->tabla2 . '
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY
        ' . $this->prefijo1 . 'fecha_edicion desc limit 1'
        );
        $supfecha = $consultaFecha->row_array();
        @$supfecha = $supfecha['fecha'];


        $this->campos_listar_secundaria = array('Desde', 'Hasta', 'Institución', 'País');
        $this->campos_reales_secundaria = array($this->prefijo1 . 'desde', $this->prefijo1 . 'hasta', $this->prefijo1 . 'institucion', $this->prefijo1 . 'pais');
        $consulta = $this->db->query('
        SELECT *
        FROM ' . $this->tabla3 . '
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY
        ' . $this->prefijo1 . 'id asc'
        );
        $secundaria = $consulta->result_array();

//        fecha secundaria
        $consultafecha = $this->db->query('
        SELECT date(' . $this->prefijo1 . 'fecha_edicion) as fecha
        FROM ' . $this->tabla3 . '
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY
        ' . $this->prefijo1 . 'fecha_edicion desc limit 1'
        );
        $sfecha = $consultafecha->row_array();
        @$sfecha = $sfecha['fecha'];

        $this->campos_listar_publicacion = array('Titulo', 'Año');
        $this->campos_reales_publicacion = array($this->prefijo2 . 'titulo', $this->prefijo2 . 'anio');
        $consulta = $this->db->query('
        SELECT *
        FROM ' . $this->tabla4 . '
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY
        ' . $this->prefijo2 . 'id asc'
        );
        $publicacion = $consulta->result_array();

//        fecha publicaciones
        $consultaFecha = $this->db->query('
        SELECT date(' . $this->prefijo2 . 'fecha_edicion) as fecha
            FROM ' . $this->tabla4 . '
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY
        ' . $this->prefijo2 . 'fecha_edicion desc limit 1'
        );
        $pubfecha = $consultaFecha->row_array();
        @$pubfecha = $pubfecha['fecha'];


        if (!$secundaria) {
            $this->bloquear_enlaces = 3;
        }
        $contenido['cabecera'] = $this->cabecera;
        $contenido['id'] = $id;
        $contenido['campos_listar_postgrado'] = $this->campos_listar_postgrado;
        $contenido['campos_reales_postgrado'] = $this->campos_reales_postgrado;
        $contenido['postgrado'] = $postgrado;
        $contenido['postfecha'] = $postfecha;
        $contenido['campos_listar_superior'] = $this->campos_listar_superior;
        $contenido['campos_reales_superior'] = $this->campos_reales_superior;
        $contenido['superior'] = $superior;
        $contenido['supfecha'] = $supfecha;
        $contenido['campos_listar_secundaria'] = $this->campos_listar_secundaria;
        $contenido['campos_reales_secundaria'] = $this->campos_reales_secundaria;
        $contenido['secundaria'] = $secundaria;
        $contenido['sfecha'] = $sfecha;
        $contenido['campos_listar_publicacion'] = $this->campos_listar_publicacion;
        $contenido['campos_reales_publicacion'] = $this->campos_reales_publicacion;
        $contenido['publicacion'] = $publicacion;
        $contenido['pubfecha'] = $pubfecha;
        $data['contenido'] = $this->load->view($this->carpeta . 'listar_instruccion_formal', $contenido, true);
        $this->load->view('plantilla_publico_2019', $data);
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
        //var_dump($this->input->post($prefijo . 'traslado'));
        //exit();
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
            } else {
                $fila[$prefijo . 'traslado'] = 0;
                $fila[$prefijo . 'traslado_lugar'] = '';
            }
            $fila[$prefijo . 'tipodoc'] = $this->input->post($prefijo . 'tipodoc');
            $fila[$prefijo . 'acuerdo'] = $this->input->post($prefijo . 'acuerdo');
            $fila['ciu_id'] = $this->input->post('ciu_id');
            $fila['pai_id'] = $this->input->post('pai_id');
            $fila['pof_pais_ciudad'] = $this->input->post('pof_pais_ciudad');
            $fila['pof_ciudad_otra'] = $this->input->post('pof_ciudad_otra');
            $fila['pof_fecha_nacimiento'] = $this->input->post('pof_fecha_nacimiento');
            $fila['pof_salario'] = 0;


            $fila[$this->prefijo . 'nombre'] = $this->input->post($this->prefijo . 'nombre');
            $fila[$this->prefijo . 'amaterno'] = $this->input->post($this->prefijo . 'amaterno');
            $fila[$this->prefijo . 'apaterno'] = $this->input->post($this->prefijo . 'apaterno');
            $fila[$this->prefijo . 'direccion'] = $this->input->post($this->prefijo . 'direccion');
            $fila[$this->prefijo . 'telefono'] = $this->input->post($this->prefijo . 'telefono');
            $fila[$this->prefijo . 'celular'] = $this->input->post($this->prefijo . 'celular');
            $fila[$this->prefijo . 'email'] = $this->input->post($this->prefijo . 'email');
            $fila[$this->prefijo . 'email1'] = $this->input->post($this->prefijo . 'email1');
            $fila[$prefijoF . 'sexo'] = $this->input->post($prefijoF . 'sexo');
            $contenido['fila'] = $fila;
            $contenido['paises'] = $newPaises;
            $contenido['ciudades'] = $ciudades;
            if ($idPais == 1 && $idCiudad == "") {
                $contenido['errorCiudad'] = 'Debe seleccionar una ciudad';
            }
            $email_0 = $this->input->post($this->prefijo . 'email');
            $email_1 = $this->input->post($this->prefijo . 'email1');
            if ($email_0 != $email_1) {
                $contenido['errorEmail'] = 'Los correos electrónicos no coinciden';
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
            if (@$error_acuerdo || @$error_telefono || @$error_pass) {
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
                if ($this->input->post($prefijo . 'traslado') == 1) {
                    $fila[$prefijo . 'traslado'] = $this->input->post($prefijo . 'traslado');
                    $fila[$prefijo . 'traslado_lugar'] = $this->input->post($prefijo . 'traslado_lugar');
                } else {
                    $fila[$prefijo . 'traslado'] = 0;
                    $fila[$prefijo . 'traslado_lugar'] = '';
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
                @$contenido['error_pass'] = $error_pass;
                @$contenido['error_acuerdo'] = $error_acuerdo;
                @$contenido['error_telefono'] = $error_telefono;
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

                if ($data[$prefijo . 'traslado'] == 1) {
                    $data[$prefijo . 'traslado_lugar'] = $this->input->post($prefijo . 'traslado_lugar');
                } else {
                    $data[$prefijo . 'traslado_lugar'] = "";
                    $data[$prefijo . 'traslado'] = 0;
                }

                if ($dataF[$prefijoF . 'salario'] == Null) {
                    $dataF[$prefijoF . 'salario'] = 0;
                }
                $data[$prefijo . 'documento'] = $_SESSION[$this->presession . 'ci'];
                $data[$prefijo . 'tipodoc'] = $_SESSION[$this->presession . 'tipodoc'];
//                para colocar al postulante en disponibilidad inmediata
                // var_dump($data[$prefijo . 'tipodoc']);exit();
                $dataF[$this->prefijoF . 'estado'] = 1;
                $id = $this->$modelo->agregar($data);
                $dataF['pos_id'] = $id;
                $idF = $this->$modelo->agregarF($dataF);
                if ($id && $idF) {
                    $_SESSION[$this->presession . 'usuario'] = $data[$prefijo . 'documento'];
                    $_SESSION[$this->presession . 'nombre'] = $data[$prefijo . 'nombre'] . ' ' . $data[$prefijo . 'apaterno'] . ' ' . $data[$prefijo . 'amaterno'];
                    $_SESSION[$this->presession . 'id'] = $id;
                    $_SESSION[$this->presession . 'nuevo'] = 1;
                    redirect('snewpostulante/instruccion_formal');
                }
            }
        }
    }

    function editar_datospersonal() {

        $this->boton_actual = 'Datos Personales';
        $formulario = 'datospersonales_editar_form';
        $this->definir_datos_form_editar();
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
//        codigo para editar la fecha del cv inicio
//        $data[$this->prefijo . 'id'] = $id;
//        $data[$this->prefijo . 'fecha_edicion'] = date('Y-m-d H:i:s');
//        $modelo = $this->modelo;
//        $this->$modelo->editar($data);
//        fin

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

    function editar_cv() {
        $formulario = 'editar_cv';
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
//        echo $id;
//        fecha trayectorias
        $consultaFecha = $this->db->query('
        SELECT date(' . $this->prefijo3 . 'fecha_edicion) as fecha
        FROM ' . $this->tabla5 . '
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY
        ' . $this->prefijo3 . 'fecha_edicion desc limit 1'
        );
        $datosFecha = $consultaFecha->row_array();
        @$datosFecha = $datosFecha['fecha'];

//        fecha postgrado
        $consultaFecha = $this->db->query('
        SELECT date(' . $this->prefijo1 . 'fecha_edicion) as fecha
        FROM ' . $this->tabla1 . '
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY ' . $this->prefijo1 . 'fecha_edicion desc limit 1'
        );
        $postfecha = $consultaFecha->row_array();
        @$postfecha = $postfecha['fecha'];

//        fecha superior
        $consultaFecha = $this->db->query('
        SELECT date(' . $this->prefijo1 . 'fecha_edicion) as fecha
        FROM ' . $this->tabla2 . '
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY
        ' . $this->prefijo1 . 'fecha_edicion desc limit 1'
        );
        $supfecha = $consultaFecha->row_array();
        @$supfecha = $supfecha['fecha'];

//        fecha secundaria
        $consultafecha = $this->db->query('
        SELECT date(' . $this->prefijo1 . 'fecha_edicion) as fecha
        FROM ' . $this->tabla3 . '
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY
        ' . $this->prefijo1 . 'fecha_edicion desc limit 1'
        );
        $sfecha = $consultafecha->row_array();
        @$sfecha = $sfecha['fecha'];

//        fecha publicaciones
        $consultaFecha = $this->db->query('
        SELECT date(' . $this->prefijo2 . 'fecha_edicion) as fecha
            FROM ' . $this->tabla4 . '
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY
        ' . $this->prefijo2 . 'fecha_edicion desc limit 1'
        );
        $pubfecha = $consultaFecha->row_array();
        @$pubfecha = $pubfecha['fecha'];

        $fechasInstuccion = array();
        $fechasInstuccion['postgrado']['fecha'] = $postfecha;
        $fechasInstuccion['superior']['fecha'] = $supfecha;
        $fechasInstuccion['secundaria']['fecha'] = $sfecha;
        $fechasInstuccion['publicaciones']['fecha'] = $pubfecha;
//        $postfecha = '';
//        $supfecha = '';
//        $sfecha = '';
//        $pubfecha = '';
//        fecha trayectorias
        $consultaFecha = $this->db->query('
        SELECT date(' . $this->prefijo3 . 'fecha_edicion) as fecha
        FROM ' . $this->tabla5 . '
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY
        ' . $this->prefijo3 . 'fecha_edicion desc limit 1'
        );

        $trafecha = $consultaFecha->row_array();
        @$trafecha = $trafecha['fecha'];

//        fecha sintesis
        $sintesisFecha = $this->db->query('
        SELECT date(pof_fecha_edicion) as fecha,pof_ambito_exp,pof_area_exp,pof_sector_exp,pof_supervisar_exp
        FROM postulante_f
        WHERE pos_id=' . $id);
        $fecha = $sintesisFecha->row_array();
        if ($fecha['pof_area_exp'] != '' && $fecha['pof_sector_exp'] != '' && $fecha['pof_supervisar_exp'] != '') {
            @$fecha = $fecha['fecha'];
        } else {
            $fecha = '';
        }
//        $fecha = '';
//        $trafecha = '';



        $otroFecha = $this->db->query('
        SELECT
        ' . $this->prefijoPI . 'id,
        date(' . $this->prefijoPI . 'fecha_edicion) as fecha,
        IF(p.idi_id!=223, ' . $this->prefijo6 . 'idioma,CONCAT(' . $this->prefijo6 . 'idioma,"-",' . $this->prefijoPI . 'idioma_otro)) as idioma
        FROM ' . $this->tablaPI . ' as p
        INNER JOIN ' . $this->tabla6 . ' as i
            ON p.' . $this->prefijo6 . 'id=i.' . $this->prefijo6 . 'id
        WHERE p.' . $this->prefijo . 'id=' . $id . ' and ' . $this->prefijoPI . 'tipo<>1
        ORDER BY
        ' . $this->prefijoPI . 'fecha_edicion desc limit 1'
        );
        $idifecha = $otroFecha->row_array();
        @$idifecha = $idifecha['fecha'];

        $consultaFecha = $this->db->query('
        SELECT
        date(' . $this->prefijoPI . 'fecha_edicion) as fecha
        FROM ' . $this->tablaPI . ' as p
        INNER JOIN ' . $this->tabla6 . ' as i
            ON p.' . $this->prefijo6 . 'id=i.' . $this->prefijo6 . 'id
        WHERE p.' . $this->prefijo . 'id=' . $id . ' and ' . $this->prefijoPI . 'tipo=1
        ORDER BY
        ' . $this->prefijoPI . 'id asc'
        );
        $ingfecha = $consultaFecha->row_array();
        @$ingfecha = $ingfecha ['fecha'];
//        $ingfecha = '';
//        $idifecha = '';

        $this->cabecera['accion'] = 'Editar CV';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['datosFecha'] = $datosFecha;
        $contenido['postfecha'] = $postfecha;
        $contenido['supfecha'] = $supfecha;
        $contenido['sfecha'] = $sfecha;
        $contenido['pubfecha'] = $pubfecha;
        $contenido['trafecha'] = $trafecha;
        $contenido['fecha'] = $fecha;
        $contenido['ingfecha'] = $ingfecha;
        $contenido['idifecha'] = $idifecha;
        $contenido['id'] = $id;
        $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
        $this->load->view('plantilla_publico_2019', $data);
    }

    function editar_cve() {
        $formulario = 'editar_cv';
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
//        echo $id;
//        fecha trayectorias
        $consultaFecha = $this->db->query('
        SELECT date(' . $this->prefijo3 . 'fecha_edicion) as fecha
        FROM ' . $this->tabla5 . '
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY
        ' . $this->prefijo3 . 'fecha_edicion desc limit 1'
        );
        $datosFecha = $consultaFecha->row_array();
        @$datosFecha = $datosFecha['fecha'];

//        fecha postgrado
        $consultaFecha = $this->db->query('
        SELECT date(' . $this->prefijo1 . 'fecha_edicion) as fecha
        FROM ' . $this->tabla1 . '
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY ' . $this->prefijo1 . 'fecha_edicion desc limit 1'
        );
        $postfecha = $consultaFecha->row_array();
        @$postfecha = $postfecha['fecha'];

//        fecha superior
        $consultaFecha = $this->db->query('
        SELECT date(' . $this->prefijo1 . 'fecha_edicion) as fecha
        FROM ' . $this->tabla2 . '
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY
        ' . $this->prefijo1 . 'fecha_edicion desc limit 1'
        );
        $supfecha = $consultaFecha->row_array();
        @$supfecha = $supfecha['fecha'];

//        fecha secundaria
        $consultafecha = $this->db->query('
        SELECT date(' . $this->prefijo1 . 'fecha_edicion) as fecha
        FROM ' . $this->tabla3 . '
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY
        ' . $this->prefijo1 . 'fecha_edicion desc limit 1'
        );
        $sfecha = $consultafecha->row_array();
        @$sfecha = $sfecha['fecha'];

//        fecha publicaciones
        $consultaFecha = $this->db->query('
        SELECT date(' . $this->prefijo2 . 'fecha_edicion) as fecha
            FROM ' . $this->tabla4 . '
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY
        ' . $this->prefijo2 . 'fecha_edicion desc limit 1'
        );
        $pubfecha = $consultaFecha->row_array();
        @$pubfecha = $pubfecha['fecha'];

        $fechasInstuccion = array();
        $fechasInstuccion['postgrado']['fecha'] = $postfecha;
        $fechasInstuccion['superior']['fecha'] = $supfecha;
        $fechasInstuccion['secundaria']['fecha'] = $sfecha;
        $fechasInstuccion['publicaciones']['fecha'] = $pubfecha;
//        $postfecha = '';
//        $supfecha = '';
//        $sfecha = '';
//        $pubfecha = '';
//        fecha trayectorias
        $consultaFecha = $this->db->query('
        SELECT date(' . $this->prefijo3 . 'fecha_edicion) as fecha
        FROM ' . $this->tabla5 . '
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY
        ' . $this->prefijo3 . 'fecha_edicion desc limit 1'
        );

        $trafecha = $consultaFecha->row_array();
        @$trafecha = $trafecha['fecha'];

//        fecha sintesis
        $sintesisFecha = $this->db->query('
        SELECT date(pof_fecha_edicion) as fecha,pof_ambito_exp,pof_area_exp,pof_sector_exp,pof_supervisar_exp
        FROM postulante_f
        WHERE pos_id=' . $id);
        $fecha = $sintesisFecha->row_array();
        if ($fecha['pof_area_exp'] != '' && $fecha['pof_sector_exp'] != '' && $fecha['pof_supervisar_exp'] != '') {
            @$fecha = $fecha['fecha'];
        } else {
            $fecha = '';
        }
//        $fecha = '';
//        $trafecha = '';



        $otroFecha = $this->db->query('
        SELECT
        ' . $this->prefijoPI . 'id,
        date(' . $this->prefijoPI . 'fecha_edicion) as fecha,
        IF(p.idi_id!=223, ' . $this->prefijo6 . 'idioma,CONCAT(' . $this->prefijo6 . 'idioma,"-",' . $this->prefijoPI . 'idioma_otro)) as idioma
        FROM ' . $this->tablaPI . ' as p
        INNER JOIN ' . $this->tabla6 . ' as i
            ON p.' . $this->prefijo6 . 'id=i.' . $this->prefijo6 . 'id
        WHERE p.' . $this->prefijo . 'id=' . $id . ' and ' . $this->prefijoPI . 'tipo<>1
        ORDER BY
        ' . $this->prefijoPI . 'fecha_edicion desc limit 1'
        );
        $idifecha = $otroFecha->row_array();
        @$idifecha = $idifecha['fecha'];

        $consultaFecha = $this->db->query('
        SELECT
        date(' . $this->prefijoPI . 'fecha_edicion) as fecha
        FROM ' . $this->tablaPI . ' as p
        INNER JOIN ' . $this->tabla6 . ' as i
            ON p.' . $this->prefijo6 . 'id=i.' . $this->prefijo6 . 'id
        WHERE p.' . $this->prefijo . 'id=' . $id . ' and ' . $this->prefijoPI . 'tipo=1
        ORDER BY
        ' . $this->prefijoPI . 'id asc'
        );
        $ingfecha = $consultaFecha->row_array();
        @$ingfecha = $ingfecha ['fecha'];
//        $ingfecha = '';
//        $idifecha = '';

        $this->cabecera['accion'] = 'Editar CV';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['datosFecha'] = $datosFecha;
        $contenido['postfecha'] = $postfecha;
        $contenido['supfecha'] = $supfecha;
        $contenido['sfecha'] = $sfecha;
        $contenido['pubfecha'] = $pubfecha;
        $contenido['trafecha'] = $trafecha;
        $contenido['fecha'] = $fecha;
        $contenido['ingfecha'] = $ingfecha;
        $contenido['idifecha'] = $idifecha;
        $contenido['id'] = $id;
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
//                    redirect('postulante/editar_cv/id/'.$_SESSION[$this->presession . 'id']);
                    redirect('snewpostulante/instruccion_formal');
                }
            }
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
                redirect('snewpostulante/trayectoria_laboral');
            }
        }
    }

    function postgrado_nuevo() {
        if ($_SESSION[$this->presession . 'nuevo']) {
            $this->bloquear_enlaces = 2;
        }
        
        $this->boton_actual = 'Instruccion Formal';
        if ($this->input->post('sin_postgrado')) {
            redirect('snewpostulante/superior_nuevo');
        } else {
            $formulario = 'postgrado_form';
            $campo = array($this->prefijo1 . 'desde', $this->prefijo1 . 'hasta', $this->prefijo1 . 'institucion', $this->prefijo1 . 'pais', $this->prefijo1 . 'grado', $this->prefijo1 . 'area', $this->prefijo1 . 'tema', $this->prefijo1 . 'nota', $this->prefijo1 . 'titulado');
            //print_r($campo);
            //var_dump($this->input->post($prefijo . 'desde'));
            //exit();
            $this->definir_postgrado_form_agregar();
            $prefijo = $this->prefijo1;
            $modelo = $this->modelo;
            $this->cabecera['accion'] = 'Educación Post Grado';

            if ($this->form_validation->run() == FALSE) {
                $fila[$prefijo . 'grado'] = $this->input->post($prefijo . 'grado');
                $fila[$prefijo . 'titulado'] = $this->input->post($prefijo . 'titulado');
                $fila[$prefijo . 'institucion'] = $this->input->post($prefijo . 'institucion');
                $fila[$prefijo . 'pais'] = $this->input->post($prefijo . 'pais');
                $fila[$prefijo . 'area'] = $this->input->post($prefijo . 'area');
                $fila[$prefijo . 'tema'] = $this->input->post($prefijo . 'tema');
                $contenido['fila'] = $fila;
                $contenido['cabecera'] = $this->cabecera;
                $contenido['action'] = $this->carpeta . 'postgrado_nuevo';
                $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
                $this->load->view('plantilla_publico_2019', $data);
            } else {
                for ($i = 0; $i < count($campo); $i++) {
                    $data[$campo[$i]] = $this->input->post($campo[$i]);
                }

                $data[$this->prefijo . 'id'] = $_SESSION[$this->presession . 'id'];
                $id = $this->$modelo->agregar_postgrado($data);
                if ($id) {
//                para actulizar la fecha de uno de los tab
                    $this->Ufecha('fecha_instruccion_formal');
                    redirect('snewpostulante/instruccion_formal');
                }
            }
        }
    }

    function editar_postgrado() {
        $this->boton_actual = 'Instruccion Formal';
        $formulario = 'postgrado_form';
        $this->definir_postgrado_form_agregar();
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tabla1 . ' WHERE ' . $this->prefijo1 . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $this->cabecera['accion'] = 'Editar Post Grado';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['action'] = $this->controlador . 'guardar_editar_postgrado';
        $contenido['fila'] = $fila;
        $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
        $this->load->view('plantilla_publico_2019', $data);
    }

    function guardar_editar_postgrado() {
        $this->boton_actual = 'Instruccion Formal';
        $formulario = 'postgrado_form';
        $campo = array($this->prefijo1 . 'desde', $this->prefijo1 . 'hasta', $this->prefijo1 . 'institucion', $this->prefijo1 . 'pais', $this->prefijo1 . 'grado', $this->prefijo1 . 'area', $this->prefijo1 . 'tema', $this->prefijo1 . 'nota', $this->prefijo1 . 'titulado');
        $this->definir_postgrado_form_agregar();
        $prefijo = $this->prefijo1;
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Educación Post Grado';
        $id = $this->input->post($this->prefijo1 . 'id');
        if ($this->form_validation->run() == FALSE) {
            $fila[$this->prefijo1 . 'id'] = $id;
            $fila[$prefijo . 'institucion'] = $this->input->post($prefijo . 'institucion');
            $fila[$prefijo . 'pais'] = $this->input->post($prefijo . 'pais');
            $fila[$prefijo . 'area'] = $this->input->post($prefijo . 'area');
            $fila[$prefijo . 'tema'] = $this->input->post($prefijo . 'tema');
            $contenido['cabecera'] = $this->cabecera;
            $contenido['fila'] = $fila;
            $contenido['action'] = $this->carpeta . 'guardar_editar_postgrado';
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_publico_2019', $data);
        } else {
            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            $data[$this->prefijo1 . 'id'] = $id;
            if ($this->$modelo->editar_postgrado($data)) {
//                para actulizar la fecha de uno de los tab
                $this->Ufecha('fecha_instruccion_formal');
                redirect('snewpostulante/instruccion_formal');
            }
        }
    }

    function eliminar_postgrado($var, $id) {
        $this->boton_actual = 'Instruccion Formal';
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tabla1 . ' WHERE ' . $this->prefijo1 . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $this->db->delete($this->tabla1, array($this->prefijo1 . 'id' => $fila[$this->prefijo1 . 'id']));
        redirect($this->controlador . 'instruccion_formal');
    }

    function superior_nuevo() {
        if ($_SESSION[$this->presession . 'nuevo']) {
            $this->bloquear_enlaces = 2;
        }
        $this->boton_actual = 'Instruccion Formal';
        if ($this->input->post('sin_superior')) {
            redirect('snewpostulante/secundaria_nuevo');
        } else {
            $formulario = 'superior_form';
            $campo = array($this->prefijo1 . 'desde', $this->prefijo1 . 'hasta', $this->prefijo1 . 'institucion', $this->prefijo1 . 'pais', $this->prefijo1 . 'grado', $this->prefijo1 . 'area', $this->prefijo1 . 'tema', $this->prefijo1 . 'nota', $this->prefijo1 . 'titulado', $this->prefijo1 . 'area_otro');
            $this->definir_superior_form_agregar();
            $prefijo = $this->prefijo1;
            $modelo = $this->modelo;
            $this->cabecera['accion'] = 'Educación Superior';

            if ($this->form_validation->run() == FALSE) {
                $fila[$prefijo . 'grado'] = $this->input->post($prefijo . 'grado');
                $fila[$prefijo . 'area'] = $this->input->post($prefijo . 'area');
                $fila[$prefijo . 'titulado'] = $this->input->post($prefijo . 'titulado');
                $fila[$prefijo . 'area_otro'] = $this->input->post($prefijo . 'area_otro');
                $fila[$prefijo . 'institucion'] = $this->input->post($prefijo . 'institucion');
                $fila[$prefijo . 'pais'] = $this->input->post($prefijo . 'pais');
                $fila[$prefijo . 'tema'] = $this->input->post($prefijo . 'tema');
                $contenido['fila'] = $fila;
                $contenido['cabecera'] = $this->cabecera;
                $contenido['action'] = $this->carpeta . 'superior_nuevo';
                $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
                $this->load->view('plantilla_publico_2019', $data);
            } else {
                for ($i = 0; $i < count($campo); $i++) {
                    $data[$campo[$i]] = $this->input->post($campo[$i]);
                }
                $data[$this->prefijo . 'id'] = $_SESSION[$this->presession . 'id'];
                $id = $this->$modelo->agregar_superior($data);
                if ($id) {
//                para actulizar la fecha de uno de los tab
                    $this->Ufecha('fecha_instruccion_formal');
                    redirect('snewpostulante/instruccion_formal');
                }
            }
        }
    }

    function editar_superior() {
        $this->boton_actual = 'Instruccion Formal';
        $formulario = 'superior_form';
        $this->definir_superior_form_agregar();
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tabla2 . ' WHERE ' . $this->prefijo1 . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $this->cabecera['accion'] = 'Editar Educación Superior';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['action'] = $this->controlador . 'guardar_editar_superior';
        $contenido['fila'] = $fila;
        $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
        $this->load->view('plantilla_publico_2019', $data);
    }

    function guardar_editar_superior() {
        $this->boton_actual = 'Instruccion Formal';
        $formulario = 'superior_form';
        $campo = array($this->prefijo1 . 'desde', $this->prefijo1 . 'hasta', $this->prefijo1 . 'institucion', $this->prefijo1 . 'pais', $this->prefijo1 . 'grado', $this->prefijo1 . 'area', $this->prefijo1 . 'tema', $this->prefijo1 . 'nota', $this->prefijo1 . 'titulado', $this->prefijo1 . 'area_otro');
        $this->definir_superior_form_agregar();
        $prefijo = $this->prefijo1;
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Editar Educación Superior';
        $id = $this->input->post($this->prefijo1 . 'id');
        if ($this->form_validation->run() == FALSE) {
            $fila[$this->prefijo1 . 'id'] = $id;
            $fila[$prefijo . 'institucion'] = $this->input->post($prefijo . 'institucion');
            $fila[$prefijo . 'pais'] = $this->input->post($prefijo . 'pais');
            $fila[$prefijo . 'tema'] = $this->input->post($prefijo . 'tema');
            $contenido['cabecera'] = $this->cabecera;
            $contenido['fila'] = $fila;
            $contenido['action'] = $this->carpeta . 'guardar_editar_superior';
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_publico_2019', $data);
        } else {
            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            $data[$this->prefijo1 . 'id'] = $id;
            if ($this->$modelo->editar_superior($data)) {
//                para actulizar la fecha de uno de los tab
                $this->Ufecha('fecha_instruccion_formal');
                redirect('snewpostulante/instruccion_formal');
            }
        }
    }

    function eliminar_superior($var, $id) {
        $this->boton_actual = 'Instruccion Formal';
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tabla2 . ' WHERE ' . $this->prefijo1 . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $this->db->delete($this->tabla2, array($this->prefijo1 . 'id' => $fila[$this->prefijo1 . 'id']));
        redirect($this->controlador . 'instruccion_formal');
    }

    function secundaria_nuevo() {
        if ($_SESSION[$this->presession . 'nuevo']) {
            $this->bloquear_enlaces = 2;
        }
        $this->boton_actual = 'Instrucción Formal';
        $formulario = 'secundaria_form';
        $campo = array($this->prefijo1 . 'desde', $this->prefijo1 . 'hasta', $this->prefijo1 . 'institucion', $this->prefijo1 . 'pais');
        $this->definir_secundaria_form_agregar();
        $prefijo = $this->prefijo1;
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Educación Secundaria';

        if ($this->form_validation->run() == FALSE) {

            $fila[$prefijo . 'institucion'] = $this->input->post($prefijo . 'institucion');
            $fila[$prefijo . 'pais'] = $this->input->post($prefijo . 'pais');
            $contenido['cabecera'] = $this->cabecera;
            $contenido['action'] = $this->carpeta . 'secundaria_nuevo';
            $contenido['fila'] = $fila;
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_publico_2019', $data);
        } else {
            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            $data[$this->prefijo . 'id'] = $_SESSION[$this->presession . 'id'];
            $id = $this->$modelo->agregar_secundaria($data);
            if ($id) {
//                para actulizar la fecha de uno de los tab
                $this->Ufecha('fecha_instruccion_formal');
                redirect('snewpostulante/instruccion_formal');
            }
        }
    }

    function editar_secundaria() {
        $this->boton_actual = 'Instruccion Formal';
        $formulario = 'secundaria_form';
        $this->definir_secundaria_form_agregar();
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tabla3 . ' WHERE ' . $this->prefijo1 . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $this->cabecera['accion'] = 'Editar Educación Secundaria';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['action'] = $this->controlador . 'guardar_editar_secundaria';
        $contenido['fila'] = $fila;
        $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
        $this->load->view('plantilla_publico_2019', $data);
    }

    function guardar_editar_secundaria() {
        $this->boton_actual = 'Instruccion Formal';
        $formulario = 'secundaria_form';
        $campo = array($this->prefijo1 . 'desde', $this->prefijo1 . 'hasta', $this->prefijo1 . 'institucion', $this->prefijo1 . 'pais');
        $this->definir_secundaria_form_agregar();
        $prefijo = $this->prefijo1;
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Editar Educación Superior';
        $id = $this->input->post($this->prefijo1 . 'id');
        if ($this->form_validation->run() == FALSE) {
            $fila[$this->prefijo1 . 'id'] = $id;
            $fila[$prefijo . 'institucion'] = $this->input->post($prefijo . 'institucion');
            $fila[$prefijo . 'pais'] = $this->input->post($prefijo . 'pais');
            $contenido['cabecera'] = $this->cabecera;
            $contenido['fila'] = $fila;
            $contenido['action'] = $this->carpeta . 'guardar_editar_secundaria';
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_publico_2019', $data);
        } else {
            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            $data[$this->prefijo1 . 'id'] = $id;
            if ($this->$modelo->editar_secundaria($data)) {
//                para actulizar la fecha de uno de los tab
                $this->Ufecha('fecha_instruccion_formal');
                redirect('snewpostulante/instruccion_formal');
            }
        }
    }

    function eliminar_secundaria($var, $id) {
        $this->boton_actual = 'Instruccion Formal';
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tabla3 . ' WHERE ' . $this->prefijo1 . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $this->db->delete($this->tabla3, array($this->prefijo1 . 'id' => $fila[$this->prefijo1 . 'id']));
        redirect($this->controlador . 'instruccion_formal');
    }

    function publicacion_nuevo() {
        if ($_SESSION[$this->presession . 'nuevo']) {
            $this->bloquear_enlaces = 2;
        }
        $this->boton_actual = 'Instrucción Formal';
        if ($this->input->post('sin_publicacion')) {
            redirect('snewpostulante/instruccion_formal');
        } else {
            $formulario = 'publicacion_form';
            $campo = array($this->prefijo2 . 'titulo', $this->prefijo2 . 'anio');
            $this->definir_publicacion_form_agregar();
            $prefijo = $this->prefijo2;
            $modelo = $this->modelo;
            $this->cabecera['accion'] = 'Publicaciones';
            if ($this->form_validation->run() == FALSE) {
                $fila[$prefijo . 'titulo'] = $this->input->post($prefijo . 'titulo');
                $contenido['fila'] = $fila;
                $contenido['cabecera'] = $this->cabecera;
                $contenido['action'] = $this->carpeta . 'publicacion_nuevo';
                $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
                $this->load->view('plantilla_publico_2019', $data);
            } else {
                for ($i = 0; $i < count($campo); $i++) {
                    $data[$campo[$i]] = $this->input->post($campo[$i]);
                }
                $data[$this->prefijo . 'id'] = $_SESSION[$this->presession . 'id'];
                $id = $this->$modelo->agregar_publicacion($data);
                if ($id) {
//                para actulizar la fecha de uno de los tab
                    $this->Ufecha('fecha_instruccion_formal');
                    redirect('snewpostulante/instruccion_formal');
                }
            }
        }
    }

    function editar_publicacion() {
        $this->boton_actual = 'Instruccion Formal';
        $formulario = 'publicacion_form';
        $this->definir_publicacion_form_agregar();
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tabla4 . ' WHERE ' . $this->prefijo2 . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $this->cabecera['accion'] = 'Editar Publicaci?';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['action'] = $this->controlador . 'guardar_editar_publicacion';
        $contenido['fila'] = $fila;
        $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
        $this->load->view('plantilla_publico_2019', $data);
    }

    function guardar_editar_publicacion() {
        $this->boton_actual = 'Instruccion Formal';
        $formulario = 'publicacion_form';
        $campo = array($this->prefijo2 . 'titulo', $this->prefijo2 . 'anio');
        $this->definir_publicacion_form_agregar();
        $prefijo = $this->prefijo2;
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Editar Publicaci?';
        $id = $this->input->post($this->prefijo2 . 'id');
        if ($this->form_validation->run() == FALSE) {
            $fila[$this->prefijo2 . 'id'] = $id;
            $fila[$prefijo . 'titulo'] = $this->input->post($prefijo . 'titulo');
            $contenido['cabecera'] = $this->cabecera;
            $contenido['fila'] = $fila;
            $contenido['action'] = $this->carpeta . 'guardar_editar_publicacion';
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_publico_2019', $data);
        } else {
            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            $data[$this->prefijo2 . 'id'] = $id;
            if ($this->$modelo->editar_publicacion($data)) {
//                para actulizar la fecha de uno de los tab
                $this->Ufecha('fecha_instruccion_formal');
                redirect('snewpostulante/instruccion_formal');
            }
        }
    }

    function eliminar_publicacion($var, $id) {
        $this->boton_actual = 'Instruccion Formal';
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tabla4 . ' WHERE ' . $this->prefijo2 . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $this->db->delete($this->tabla4, array($this->prefijo2 . 'id' => $fila[$this->prefijo2 . 'id']));
        redirect($this->controlador . 'instruccion_formal');
    }

    function trayectoria_laboral() {
        $this->boton_actual = 'Trayectoria Laboral';
        $ant = $this->uri->segment(4);
        $id = $_SESSION[$this->presession . 'id'];
//        codigo para editar la fecha del cv inicio
//        $data[$this->prefijo . 'id'] = $id;
//        $data[$this->prefijo . 'fecha_edicion'] = date('Y-m-d H:i:s');
//        $modelo = $this->modelo;
//        $this->$modelo->editar($data);
//        fin
        $this->cabecera['accion'] = 'Trayectoria Laboral';
        $this->campos_listar_trayectoria1 = array('Ambito Experiencia', 'Área de Experiencia Resaltada', 'Sector Experiencia Resaltada', 'Experiencia en Supervisión');
        $this->campos_reales_trayectoria1 = array('pos_ambito_exp', 'pos_area_exp', 'pos_sector_exp', 'pos_supervisar_exp');
        $this->campos_listar_trayectoria = array('Desde', 'Hasta', 'Nombre Organización', 'País/ciudad', 'Cargo(s) Ocupado(s)', 'Sueldo por Mes', 'Teléfono Organización', 'Nombre, Telf., Email Inmediato Superior');
        $this->campos_reales_trayectoria = array($this->prefijo3 . 'desde', $this->prefijo3 . 'hasta', $this->prefijo3 . 'organizacion', $this->prefijo3 . 'pais', $this->prefijo3 . 'cargos', $this->prefijo3 . 'sueldo', $this->prefijo3 . 'telefono_org', 'superior', $this->prefijo3 . 'actual');
        $consulta = $this->db->query('
        SELECT *, concat(tra_nombre_sup," - ",tra_telefono_sup," - ",tra_email_sup) as superior
        FROM ' . $this->tabla5 . '
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY
        ' . $this->prefijo3 . 'hasta desc'
        );

        $trayectorias = $consulta->result_array();
//        fecha trayectorias
        $consultaFecha = $this->db->query('
        SELECT date(' . $this->prefijo3 . 'fecha_edicion) as fecha
        FROM ' . $this->tabla5 . '
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY
        ' . $this->prefijo3 . 'fecha_edicion desc limit 1'
        );

        $trafecha = $consultaFecha->row_array();
        @$trafecha = $trafecha['fecha'];

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
            @$fecha = $fecha['fecha'];
        } else {
            $fecha = '';
        }


        $ambitos_exp[1] = strtoupper('Empresa Privada');
        $ambitos_exp[2] = strtoupper('Entidad Publica');
        $ambitos_exp[3] = strtoupper('Cooperación para el Desarrollo');
        if (@$sintesis['pof_ambito_exp']) {
            for ($j = 1; $j <= 3; $j++) {
                if (preg_match('/' . $j . '/', $sintesis['pof_ambito_exp'])) {
                    @$ambito_exp .= @$ambitos_exp[$j] . '<br/>';
                }
            }
            $sintesis['pos_ambito_exp'] = substr($ambito_exp, 0, (strlen($ambito_exp) - 5));
            // // $sintesis['pos_area_exp'] = $this->area_exp[$sintesis['pof_area_exp']];
            // $sintesis['pos_sector_exp'] = $this->sector_exp[$sintesis['pof_sector_exp']];
            $sintesis['pos_supervisar_exp'] = strtoupper($sintesis['pof_supervisar_exp']);
        }
        if (!$trayectorias || empty($sintesis['pof_ambito_exp'])) {
            $this->bloquear_enlaces = 4;
        }
//        print_r($trayectorias);
        $contenido['cabecera'] = $this->cabecera;
        $contenido['id'] = $id;
        $contenido['ant'] = $ant;
        $contenido['sintesis'] = $sintesis;
        $contenido['fecha'] = $fecha;
        $contenido['campos_listar_trayectoria1'] = $this->campos_listar_trayectoria1;
        $contenido['campos_reales_trayectoria1'] = $this->campos_reales_trayectoria1;
        $contenido['campos_listar_trayectoria'] = $this->campos_listar_trayectoria;
        $contenido['campos_reales_trayectoria'] = $this->campos_reales_trayectoria;
        $contenido['trayectorias'] = $trayectorias;
        $contenido['trafecha'] = $trafecha;
        $data['contenido'] = $this->load->view($this->carpeta . 'listar_trayectoria_laboral', $contenido, true);
        $this->load->view('plantilla_publico_2019', $data);
    }

    function trayectoria_nuevo() {
        if ($_SESSION[$this->presession . 'nuevo']) {
            $this->bloquear_enlaces = 4;
        }
        
        $this->boton_actual = 'Trayectoria Laboral';
        if ($this->input->post('sin_trayectoria')) {
            redirect('snewpostulante/trayectoria_laboral');
        } else {
            $formulario = 'trayectoria_form';
            $campo = array($this->prefijo3 . 'desde', $this->prefijo3 . 'hasta', $this->prefijo3 . 'organizacion', $this->prefijo3 . 'tipo_org', $this->prefijo3 . 'descripcion_org', $this->prefijo3 . 'funciones_org', $this->prefijo3 . 'logros', $this->prefijo3 . 'pais', $this->prefijo3 . 'cargos',
                $this->prefijo3 . 'nsubordinados', $this->prefijo3 . 'sueldo', $this->prefijo3 . 'telefono_org', $this->prefijo3 . 'nombre_sup', $this->prefijo3 . 'telefono_sup', $this->prefijo3 . 'email_sup', $this->prefijo3 . 'actual');
            //var_dump($campo);
            //exit;

            $this->definir_trayectoria_form_agregar();
            $prefijo = $this->prefijo3;
            $modelo = $this->modelo;
            $this->cabecera['accion'] = 'Experiencia Laboral';

            if ($this->form_validation->run() == FALSE) {
                $fila[$prefijo . 'tipo_org'] = $this->input->post($prefijo . 'tipo_org');
                $fila[$prefijo . 'actual'] = $this->input->post($prefijo . 'actual');
                $fila[$prefijo . 'organizacion'] = $this->input->post($prefijo . 'organizacion');
                $fila[$prefijo . 'descripcion_org'] = $this->input->post($prefijo . 'descripcion_org');
                $fila[$prefijo . 'cargos'] = $this->input->post($prefijo . 'cargos');
                $fila[$prefijo . 'funciones_org'] = $this->input->post($prefijo . 'funciones_org');
                $fila[$prefijo . 'logros'] = $this->input->post($prefijo . 'logros');
                $fila[$prefijo . 'pais'] = $this->input->post($prefijo . 'pais');
                $fila[$prefijo . 'nombre_sup'] = $this->input->post($prefijo . 'nombre_sup');
                $fila[$prefijo . 'email_sup'] = $this->input->post($prefijo . 'email_sup');
                $contenido['fila'] = $fila;
                $contenido['cabecera'] = $this->cabecera;
                $contenido['action'] = $this->carpeta . 'trayectoria_nuevo';
                $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
                $this->load->view('plantilla_publico_2019', $data);
            } else {
                //var_dump($this->input->post());
                //exit();
                for ($i = 0; $i < count($campo); $i++) {
                    if ($campo[$i] == 'tra_actual' && $this->input->post('tra_actual') == Null) {
                        $data[$campo[$i]] = 0;
                    } else {
                        $data[$campo[$i]] = $this->input->post($campo[$i]);
                    }
                }
                $data[$this->prefijo . 'id'] = $_SESSION[$this->presession . 'id'];
                $id = $this->$modelo->agregar_trayectoria($data);
                if ($id) {
//                para actulizar la fecha de uno de los tab
                    $this->Ufecha('fecha_trayectoria_laboral');
                    redirect('snewpostulante/trayectoria_laboral');
                }
            }
        }
    }

    function editar_trayectoria() {
        $this->boton_actual = 'Trayectoria Laboral';
        $formulario = 'trayectoria_form';
        $this->definir_trayectoria_form_agregar();
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tabla5 . ' WHERE ' . $this->prefijo3 . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $this->cabecera['accion'] = 'Editar Trayectoria Laboral';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['action'] = $this->controlador . 'guardar_editar_trayectoria';
        $contenido['fila'] = $fila;
        $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
        $this->load->view('plantilla_publico_2019', $data);
    }

    function guardar_editar_trayectoria() {
        $this->boton_actual = 'Trayectoria Laboral';
        $formulario = 'trayectoria_form';
        $campo = array($this->prefijo3 . 'desde', $this->prefijo3 . 'hasta', $this->prefijo3 . 'organizacion', $this->prefijo3 . 'tipo_org', $this->prefijo3 . 'descripcion_org', $this->prefijo3 . 'funciones_org', $this->prefijo3 . 'logros', $this->prefijo3 . 'pais', $this->prefijo3 . 'cargos',
            $this->prefijo3 . 'nsubordinados', $this->prefijo3 . 'sueldo', $this->prefijo3 . 'telefono_org', $this->prefijo3 . 'nombre_sup', $this->prefijo3 . 'telefono_sup', $this->prefijo3 . 'email_sup', $this->prefijo3 . 'actual');
        $this->definir_trayectoria_form_agregar();
        $prefijo = $this->prefijo3;
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Editar Trayectoria Laboral';
        $id = $this->input->post($this->prefijo3 . 'id');
        if ($this->form_validation->run() == FALSE) {
            $fila[$this->prefijo3 . 'id'] = $id;
            $fila[$prefijo . 'tipo_org'] = $this->input->post($prefijo . 'tipo_org');
            $fila[$prefijo . 'actual'] = $this->input->post($prefijo . 'actual');
            $fila[$prefijo . 'organizacion'] = $this->input->post($prefijo . 'organizacion');
            $fila[$prefijo . 'descripcion_org'] = $this->input->post($prefijo . 'descripcion_org');
            $fila[$prefijo . 'cargos'] = $this->input->post($prefijo . 'cargos');
            $fila[$prefijo . 'funciones_org'] = $this->input->post($prefijo . 'funciones_org');
            $fila[$prefijo . 'logros'] = $this->input->post($prefijo . 'logros');
            $fila[$prefijo . 'pais'] = $this->input->post($prefijo . 'pais');
            $fila[$prefijo . 'nombre_sup'] = $this->input->post($prefijo . 'nombre_sup');
            $fila[$prefijo . 'email_sup'] = $this->input->post($prefijo . 'email_sup');
            $fila[$prefijo . 'telefono_org'] = $this->input->post($prefijo . 'telefono_org');
            $fila[$prefijo . 'telefono_sup'] = $this->input->post($prefijo . 'telefono_sup');
            $contenido['cabecera'] = $this->cabecera;
            $contenido['fila'] = $fila;
            $contenido['action'] = $this->carpeta . 'guardar_editar_trayectoria';
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_publico_2019', $data);
        } else {
            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            $data[$this->prefijo3 . 'id'] = $id;
            if ($this->$modelo->editar_trayectoria($data)) {
//                para actulizar la fecha de uno de los tab
                $this->Ufecha('fecha_trayectoria_laboral');
                redirect('snewpostulante/trayectoria_laboral');
            }
        }
    }

    function eliminar_trayectoria($var, $id) {
        $this->boton_actual = 'Trayectoria Laboral';
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tabla5 . ' WHERE ' . $this->prefijo3 . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $this->db->delete($this->tabla5, array($this->prefijo3 . 'id' => $fila[$this->prefijo3 . 'id']));
        redirect($this->controlador . 'trayectoria_laboral');
    }

    function informacion_adicional() {
        $this->boton_actual = 'Informacion Adicional';
        $id = $_SESSION[$this->presession . 'id'];
//        codigo para editar la fecha del cv inicio
//        $data[$this->prefijo . 'id'] = $id;
//        $data[$this->prefijo . 'fecha_edicion'] = date('Y-m-d H:i:s');
//        $modelo = $this->modelo;
//        $this->$modelo->editar($data);
//        fin
        $this->cabecera['accion'] = 'Información Adicional';
        $this->campos_listar_idioma = array('Idioma', 'Habla', 'Lee', 'Escribe');
        $this->campos_reales_idioma = array('idioma', $this->prefijoPI . 'habla', $this->prefijoPI . 'lee', $this->prefijoPI . 'escribe');
//        ' . $this->prefijo6 . 'idioma as idioma,
        $consulta = $this->db->query('
        SELECT
        ' . $this->prefijoPI . 'id,
        ' . $this->prefijoPI . 'idioma_otro,

        IF(p.idi_id!=223, ' . $this->prefijo6 . 'idioma,CONCAT(' . $this->prefijo6 . 'idioma,"-",' . $this->prefijoPI . 'idioma_otro)) as idioma,
        case ' . $this->prefijoPI . 'habla
        when "1" then "EXCELENTE"
        when "2" then "MUY BUENO"
        when "3" then "REGULAR"
        when "4" then "BASICO"
        else "s/n"
        end as ' . $this->prefijoPI . 'habla,
        case ' . $this->prefijoPI . 'lee
        when "1" then "EXCELENTE"
        when "2" then "MUY BUENO"
        when "3" then "REGULAR"
        when "4" then "BASICO"
        else "s/n"
        end as ' . $this->prefijoPI . 'lee,
        case ' . $this->prefijoPI . 'escribe
        when "1" then "EXCELENTE"
        when "2" then "MUY BUENO"
        when "3" then "REGULAR"
        when "4" then "BASICO"
        else "s/n"
        end as ' . $this->prefijoPI . 'escribe
        FROM ' . $this->tablaPI . ' as p
        INNER JOIN ' . $this->tabla6 . ' as i
            ON p.' . $this->prefijo6 . 'id=i.' . $this->prefijo6 . 'id
        WHERE p.' . $this->prefijo . 'id=' . $id . ' and ' . $this->prefijoPI . 'tipo<>1
        ORDER BY
        ' . $this->prefijoPI . 'id asc'
        );
        $consultaIngles = $this->db->query('
        SELECT
        ' . $this->prefijoPI . 'id,
        ' . $this->prefijoPI . 'idioma_otro,
        ' . $this->prefijo6 . 'idioma as idioma,
        ' . $this->prefijoPI . 'habla,
        ' . $this->prefijoPI . 'lee,
        ' . $this->prefijoPI . 'escribe        
        FROM ' . $this->tablaPI . ' as p
        INNER JOIN ' . $this->tabla6 . ' as i
            ON p.' . $this->prefijo6 . 'id=i.' . $this->prefijo6 . 'id
        WHERE p.' . $this->prefijo . 'id=' . $id . ' and ' . $this->prefijoPI . 'tipo=1
        ORDER BY
        ' . $this->prefijoPI . 'id asc'
        );

        $consultaDisponibilidad = $this->db->query('
        SELECT
        com_id as id,
        com_nombre as nombre 
        FROM combos
        where com_tipo=14
        ORDER BY com_orden asc'
        );
        $disponibilidad = $consultaDisponibilidad->result_array();


        $otroFecha = $this->db->query('
        SELECT
        ' . $this->prefijoPI . 'id,
        date(' . $this->prefijoPI . 'fecha_edicion) as fecha,
        IF(p.idi_id!=223, ' . $this->prefijo6 . 'idioma,CONCAT(' . $this->prefijo6 . 'idioma,"-",' . $this->prefijoPI . 'idioma_otro)) as idioma
        FROM ' . $this->tablaPI . ' as p
        INNER JOIN ' . $this->tabla6 . ' as i
            ON p.' . $this->prefijo6 . 'id=i.' . $this->prefijo6 . 'id
        WHERE p.' . $this->prefijo . 'id=' . $id . ' and ' . $this->prefijoPI . 'tipo<>1
        ORDER BY
        ' . $this->prefijoPI . 'fecha_edicion desc limit 1'
        );


        $idifecha = $otroFecha->row_array();
        @$idifecha = $idifecha['fecha'];

        $idiomas = $consulta->result_array();


        $consultaFecha = $this->db->query('
        SELECT
        date(' . $this->prefijoPI . 'fecha_edicion) as fecha
        FROM ' . $this->tablaPI . ' as p
        INNER JOIN ' . $this->tabla6 . ' as i
            ON p.' . $this->prefijo6 . 'id=i.' . $this->prefijo6 . 'id
        WHERE p.' . $this->prefijo . 'id=' . $id . ' and ' . $this->prefijoPI . 'tipo=1
        ORDER BY
        ' . $this->prefijoPI . 'id asc'
        );
        $ingfecha = $consultaFecha->row_array();
        @$ingfecha = $ingfecha ['fecha'];


        $idiomaIngles = $consultaIngles->row_array();

        $consulta = $this->db->query('
        SELECT pos_recibir as recibir, pos_comentario as comentario, pof_estado as pos_estado
        FROM ' . $this->tabla . '  p
            INNER JOIN postulante_f pf
            ON p.pos_id=pf.pos_id
        WHERE p.' . $this->prefijo . 'id=' . $id);
        $recibir = $consulta->row_array();
        $contenido['cabecera'] = $this->cabecera;
        $contenido['id'] = $id;
        $contenido['recibir'] = $recibir;
        $contenido['campos_listar_idioma'] = $this->campos_listar_idioma;
        $contenido['campos_reales_idioma'] = $this->campos_reales_idioma;
        $contenido['idiomas'] = $idiomas;
        $contenido['idifecha'] = $idifecha;
        $contenido['fila'] = $idiomaIngles;
        $contenido['ingfecha'] = $ingfecha;
        $contenido['disponibilidad'] = $disponibilidad;
        $data['contenido'] = $this->load->view($this->carpeta . 'listar_informacion_adicional', $contenido, true);
        $this->load->view('plantilla_publico_2019', $data);
    }

    function guardar_editar_informacion_adicional() {
        $modelo = $this->modelo;
        $formulario = "listar_informacion_adicional";
        $this->cabecera['accion'] = 'Editar Idioma';
        $id = $this->input->post('id');
        $this->definir_datos_form_agregar_adicional();
        $this->campos_listar_idioma = array('Idioma', 'Habla', 'Lee', 'Escribe');
        $this->campos_reales_idioma = array('idioma', $this->prefijoPI . 'habla', $this->prefijoPI . 'lee', $this->prefijoPI . 'escribe');
        $consulta = $this->db->query('
        SELECT
        ' . $this->prefijoPI . 'id,
        ' . $this->prefijoPI . 'idioma_otro,
        ' . $this->prefijo6 . 'idioma as idioma,
        case ' . $this->prefijoPI . 'habla
        when "1" then "EXCELENTE"
        when "2" then "MUY BUENO"
        when "3" then "REGULAR"
        when "4" then "BASICO"
        else "s/n"
        end as ' . $this->prefijoPI . 'habla,
        case ' . $this->prefijoPI . 'lee
        when "1" then "EXCELENTE"
        when "2" then "MUY BUENO"
        when "3" then "REGULAR"
        when "4" then "BASICO"
        else "s/n"
        end as ' . $this->prefijoPI . 'lee,
        case ' . $this->prefijoPI . 'escribe
        when "1" then "EXCELENTE"
        when "2" then "MUY BUENO"
        when "3" then "REGULAR"
        when "4" then "BASICO"
        else "s/n"
        end as ' . $this->prefijoPI . 'escribe
        FROM ' . $this->tablaPI . ' as p
        INNER JOIN ' . $this->tabla6 . ' as i
            ON p.' . $this->prefijo6 . 'id=i.' . $this->prefijo6 . 'id
        WHERE p.' . $this->prefijo . 'id=' . $id . ' and ' . $this->prefijoPI . 'tipo<>1
        ORDER BY
        ' . $this->prefijoPI . 'id asc'
        );
        $idiomas = $consulta->result_array();
        $consultaDisponibilidad = $this->db->query('
        SELECT
        com_id as id,
        com_nombre as nombre 
        FROM combos
        where com_tipo=14
        ORDER BY com_nombre asc'
        );
        $disponibilidad = $consultaDisponibilidad->result_array();
        if ($this->form_validation->run() == FALSE) {
            $idiomaIngles[$this->prefijoPI . 'id'] = $this->input->post($this->prefijoPI . 'id');
            $idiomaIngles[$this->prefijoPI . 'habla'] = $this->input->post($this->prefijoPI . 'habla');
            $idiomaIngles[$this->prefijoPI . 'lee'] = $this->input->post($this->prefijoPI . 'lee');
            $idiomaIngles[$this->prefijoPI . 'escribe'] = $this->input->post($this->prefijoPI . 'escribe');
            $recibir['recibir'] = $this->input->post('recibir_boletin');
            $recibir['comentario'] = $this->input->post('comentario');
//            $recibir[$this->prefijo . 'estado'] = $this->input->post($this->prefijo . 'estado');

            $contenido['id'] = $id;
            $contenido['campos_listar_idioma'] = $this->campos_listar_idioma;
            $contenido['campos_reales_idioma'] = $this->campos_reales_idioma;
            $contenido['idiomas'] = $idiomas;
            $contenido['fila'] = $idiomaIngles;
            $contenido['recibir'] = $recibir;
            $contenido['disponibilidad'] = $disponibilidad;
            $contenido['cabecera'] = $this->cabecera;
            $contenido['action'] = $this->carpeta . 'guardar_editar_informacion_adicional';
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_publico_2019', $data);
        } else {

//            para cuando cumple las reglas de validacion
            $dataAdicional[$this->prefijo . 'id'] = $this->input->post('id');
            $dataAdicional[$this->prefijo . 'recibir'] = $this->input->post('recibir_boletin');
            $dataAdicional[$this->prefijo . 'comentario'] = $this->input->post('comentario');
//            $dataAdicional[$this->prefijo . 'estado'] = $this->input->post($this->prefijo . 'estado');
//            $this->$modelo->editar($dataAdicional);
//            $this->$modelo->editar_idioma($dataIdioma);
            if ($this->input->post($this->prefijoPI . 'id') != "") {
                $dataIdioma[$this->prefijoPI . 'id'] = $this->input->post($this->prefijoPI . 'id');
                $dataIdioma[$this->prefijoPI . 'habla'] = $this->input->post($this->prefijoPI . 'habla');
                $dataIdioma[$this->prefijoPI . 'lee'] = $this->input->post($this->prefijoPI . 'lee');
                $dataIdioma[$this->prefijoPI . 'escribe'] = $this->input->post($this->prefijoPI . 'escribe');
                $resultado = $this->$modelo->editar_idioma($dataIdioma);
            } else {
                $dataIdioma[$this->prefijo . 'id'] = $this->input->post('id');
                $dataIdioma[$this->prefijoPI . 'habla'] = $this->input->post($this->prefijoPI . 'habla');
                $dataIdioma[$this->prefijoPI . 'lee'] = $this->input->post($this->prefijoPI . 'lee');
                $dataIdioma[$this->prefijoPI . 'escribe'] = $this->input->post($this->prefijoPI . 'escribe');
                $dataIdioma[$this->prefijoPI . 'tipo'] = 1;
                $dataIdioma['idi_id'] = 1;
                $resultado = $this->$modelo->agregar_idioma($dataIdioma);
            }
            if ($resultado && $this->$modelo->editar($dataAdicional)) {
//                para actulizar la fecha de uno de los tab
                $this->Ufecha('fecha_informacion_adicional');
//                redirect('postulante/editar_cv/id/'.$_SESSION[$this->presession . 'id']);
//                redirect('postulante/editar_cv/id/'.$id);
                redirect('snewpostulante/completo');
            }
        }
    }

//    function guardar_editar_informacion_adicional() {
//        $modelo = $this->modelo;
//        $formulario = "listar_informacion_adicional";
//        $this->cabecera['accion'] = 'Editar Idioma';
//        $id = $this->input->post('id');
//        $this->definir_datos_form_agregar_adicional();
//        $this->campos_listar_idioma = array('Idioma', 'Habla', 'Lee', 'Escribe');
//        $this->campos_reales_idioma = array('idioma', $this->prefijoPI . 'habla', $this->prefijoPI . 'lee', $this->prefijoPI . 'escribe');
//        $consulta = $this->db->query('
//        SELECT
//        ' . $this->prefijoPI . 'id,
//        ' . $this->prefijoPI . 'idioma_otro,
//        ' . $this->prefijo6 . 'idioma as idioma,
//        case ' . $this->prefijoPI . 'habla
//        when "1" then "EXCELENTE"
//        when "2" then "MUY BUENO"
//        when "3" then "REGULAR"
//        when "4" then "BASICO"
//        else "s/n"
//        end as ' . $this->prefijoPI . 'habla,
//        case ' . $this->prefijoPI . 'lee
//        when "1" then "EXCELENTE"
//        when "2" then "MUY BUENO"
//        when "3" then "REGULAR"
//        when "4" then "BASICO"
//        else "s/n"
//        end as ' . $this->prefijoPI . 'lee,
//        case ' . $this->prefijoPI . 'escribe
//        when "1" then "EXCELENTE"
//        when "2" then "MUY BUENO"
//        when "3" then "REGULAR"
//        when "4" then "BASICO"
//        else "s/n"
//        end as ' . $this->prefijoPI . 'escribe
//        FROM ' . $this->tablaPI . ' as p
//        INNER JOIN ' . $this->tabla6 . ' as i
//            ON p.' . $this->prefijo6 . 'id=i.' . $this->prefijo6 . 'id
//        WHERE p.' . $this->prefijo . 'id=' . $id . ' and ' . $this->prefijoPI . 'tipo<>1
//        ORDER BY
//        ' . $this->prefijoPI . 'id asc'
//        );
//        $idiomas = $consulta->result_array();
//        $consultaDisponibilidad = $this->db->query('
//        SELECT
//        com_id as id,
//        com_nombre as nombre 
//        FROM combos
//        where com_tipo=14
//        ORDER BY com_nombre asc'
//        );
//        $disponibilidad = $consultaDisponibilidad->result_array();
//        if ($this->form_validation->run() == FALSE) {
//            echo 'asdasdasd';
//            exit();
//            $idiomaIngles[$this->prefijoPI . 'id'] = $this->input->post($this->prefijoPI . 'id');
//            $idiomaIngles[$this->prefijoPI . 'habla'] = $this->input->post($this->prefijoPI . 'habla');
//            $idiomaIngles[$this->prefijoPI . 'lee'] = $this->input->post($this->prefijoPI . 'lee');
//            $idiomaIngles[$this->prefijoPI . 'escribe'] = $this->input->post($this->prefijoPI . 'escribe');
//            $recibir['recibir'] = $this->input->post('recibir_boletin');
//            $recibir['comentario'] = $this->input->post('comentario');
////            $recibir[$this->prefijo . 'estado'] = $this->input->post($this->prefijo . 'estado');
//
//            $contenido['id'] = $id;
//            $contenido['campos_listar_idioma'] = $this->campos_listar_idioma;
//            $contenido['campos_reales_idioma'] = $this->campos_reales_idioma;
//            $contenido['idiomas'] = $idiomas;
//            $contenido['fila'] = $idiomaIngles;
//            $contenido['recibir'] = $recibir;
//            $contenido['disponibilidad'] = $disponibilidad;
//            $contenido['cabecera'] = $this->cabecera;
//            $contenido['action'] = $this->carpeta . 'guardar_editar_informacion_adicional';
//            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
//            $this->load->view('plantilla_publico_2019', $data);
//        } else {
//
////            para cuando cumple las reglas de validacion
//            $dataAdicional[$this->prefijo . 'id'] = $this->input->post('id');
//            $dataAdicional[$this->prefijo . 'recibir'] = $this->input->post('recibir_boletin');
//            $dataAdicional[$this->prefijo . 'comentario'] = $this->input->post('comentario');
////            $dataAdicional[$this->prefijo . 'estado'] = $this->input->post($this->prefijo . 'estado');
////            $this->$modelo->editar($dataAdicional);
////            $this->$modelo->editar_idioma($dataIdioma);
//            if ($this->input->post($this->prefijoPI . 'id') != "") {
//                $dataIdioma[$this->prefijoPI . 'id'] = $this->input->post($this->prefijoPI . 'id');
//                $dataIdioma[$this->prefijoPI . 'habla'] = $this->input->post($this->prefijoPI . 'habla');
//                $dataIdioma[$this->prefijoPI . 'lee'] = $this->input->post($this->prefijoPI . 'lee');
//                $dataIdioma[$this->prefijoPI . 'escribe'] = $this->input->post($this->prefijoPI . 'escribe');
//                $resultado = $this->$modelo->editar_idioma($dataIdioma);
//            } else {
//                $dataIdioma[$this->prefijo . 'id'] = $this->input->post('id');
//                $dataIdioma[$this->prefijoPI . 'habla'] = $this->input->post($this->prefijoPI . 'habla');
//                $dataIdioma[$this->prefijoPI . 'lee'] = $this->input->post($this->prefijoPI . 'lee');
//                $dataIdioma[$this->prefijoPI . 'escribe'] = $this->input->post($this->prefijoPI . 'escribe');
//                $dataIdioma[$this->prefijoPI . 'tipo'] = 1;
//                $dataIdioma['idi_id'] = 1;
//                $resultado = $this->$modelo->agregar_idioma($dataIdioma);
//            }
//            if ($resultado && $this->$modelo->editar($dataAdicional)) {
//                redirect('postulante/completo');
//            }
//        }
//    }

    function pcompleta() {
        $data['contenido'] = $this->load->view($this->carpeta . '/completa', $contenido, true);
        $this->load->view('plantilla_publico_2019_banner', $data);
    }

    function idioma_nuevo() {
        $this->boton_actual = 'Informacion Adicional';
        if ($this->input->post('sin_idioma')) {
            redirect('snewpostulante/informacion_adicional');
        } else {
            $formulario = 'idioma_form';
            $campo = array($this->prefijo4 . 'id', $this->prefijoPI . 'habla', $this->prefijoPI . 'lee', $this->prefijoPI . 'escribe', $this->prefijoPI . 'idioma_otro');
            $this->definir_idioma_form_agregar();
            $prefijo = $this->prefijoPI;
            $modelo = $this->modelo;
            $consulta = $this->db->query('
                    SELECT * FROM ' . $this->tabla6
                    . ' where idi_id<>1');
            $idiomas = $consulta->result_array();
            $this->cabecera['accion'] = 'Información Adicional';
            if ($this->form_validation->run() == FALSE) {
                $fila[$this->prefijo4 . 'id'] = $this->input->post('idi_id');
                $fila[$prefijo . 'habla'] = $this->input->post($prefijo . 'habla');
                $fila[$prefijo . 'lee'] = $this->input->post($prefijo . 'lee');
                $fila[$prefijo . 'escribe'] = $this->input->post($prefijo . 'escribe');
                $fila[$prefijo . 'idioma_otro'] = $this->input->post($prefijo . 'idioma_otro');
                $contenido['fila'] = $fila;
                $contenido['cabecera'] = $this->cabecera;
                $contenido['action'] = $this->carpeta . 'idioma_nuevo';
                $contenido['idiomas'] = $idiomas;
                $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
                $this->load->view('plantilla_publico_2019', $data);
            } else {
                for ($i = 0; $i < count($campo); $i++) {
                    $data[$campo[$i]] = $this->input->post($campo[$i]);
                }
                $data[$this->prefijo . 'id'] = $_SESSION[$this->presession . 'id'];
                $id = $this->$modelo->agregar_idioma($data);
                if ($id) {
//                para actulizar la fecha de uno de los tab
                    $this->Ufecha('fecha_informacion_adicional');
                    redirect('snewpostulante/informacion_adicional');
                }
            }
        }
    }

    function editar_idioma() {
        $this->boton_actual = 'Informacion Adicional';
        $formulario = 'idioma_form';
        $this->definir_idioma_form_agregar();
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tablaPI . ' WHERE ' . $this->prefijoPI . 'id=' . $id);

        $fila = $consulta->first_row('array');
        $consulta = $this->db->query('
                    SELECT * FROM ' . $this->tabla6
                . ' where idi_id<>1');
        $idiomas = $consulta->result_array();
        $this->cabecera['accion'] = 'Editar Idioma';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['action'] = $this->controlador . 'guardar_editar_idioma';
        $contenido['fila'] = $fila;
        $contenido['idiomas'] = $idiomas;
        $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
        $this->load->view('plantilla_publico_2019', $data);
    }

    function guardar_editar_idioma() {
        $this->boton_actual = 'Informacion Adicional';
        $formulario = 'idioma_form';
        $campo = array($this->prefijo4 . 'id', $this->prefijoPI . 'habla', $this->prefijoPI . 'lee', $this->prefijoPI . 'escribe', $this->prefijoPI . 'idioma_otro');
        $this->definir_idioma_form_agregar();
        $prefijo = $this->prefijoPI;
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Editar Idioma';
        $id = $this->input->post($this->prefijoPI . 'id');
        $consulta = $this->db->query('
                    SELECT * FROM ' . $this->tabla6
                . ' where idi_id<>1');
        $idiomas = $consulta->result_array();
        if ($this->form_validation->run() == FALSE) {
            $fila[$this->prefijoPI . 'id'] = $id;
            $fila['idi_id'] = $this->input->post('idi_id');
            $fila[$prefijo . 'idioma_otro'] = $this->input->post($prefijo . 'idioma_otro');
            $fila[$prefijo . 'habla'] = $this->input->post($prefijo . 'habla');
            $fila[$prefijo . 'lee'] = $this->input->post($prefijo . 'lee');
            $fila[$prefijo . 'escribe'] = $this->input->post($prefijo . 'escribe');
            $contenido['cabecera'] = $this->cabecera;
            $contenido['fila'] = $fila;
            $contenido['action'] = $this->carpeta . 'guardar_editar_idioma';
            $contenido['idiomas'] = $idiomas;
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_publico', $data);
        } else {
            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            $data[$this->prefijoPI . 'id'] = $id;
            if ($this->$modelo->editar_idioma($data)) {
//                para actulizar la fecha de uno de los tab
                    $this->Ufecha('fecha_informacion_adicional');
                redirect('snewpostulante/informacion_adicional');
            }
        }
    }

    function eliminar_idioma($var, $id) {
        $this->boton_actual = 'Informacion Adicional';
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tablaPI . ' WHERE ' . $this->prefijoPI . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $this->db->delete($this->tablaPI, array($this->prefijoPI . 'id' => $fila[$this->prefijoPI . 'id']));
        redirect($this->controlador . 'informacion_adicional');
    }

    function cambiarpass() {
        $this->contenido_completo = 1;
        $this->formulario = 'cambiarpass_form';
        $this->definir_form_pass();
        $this->campo = array($this->prefijo . 'pass');
        $id = $_SESSION[$this->presession . 'id'];
        $prefijo = $this->prefijo;
        $consulta = $this->db->query('
                SELECT * FROM ' . $this->tabla . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila1 = $consulta->first_row('array');
        $this->cabecera['titulo'] = 'Postulante';
        $this->cabecera['accion'] = 'Cambiar Contraseña';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['action'] = $this->carpeta . 'guardar_cambiarpass';
        $contenido['fila1'] = $fila1;
        $data['contenido'] = $this->load->view($this->carpeta . $this->formulario, $contenido, true);
        $this->load->view('plantilla_publico', $data);
    }

    function guardar_cambiarpass() {
        $this->contenido_completo = 1;
        $this->formulario = 'cambiarpass_form';
        $this->definir_form_pass();
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Editar';
        $prefijo = $this->prefijo;
        $id = $this->input->post($this->prefijo . 'id');
        $consulta = $this->db->query('
            SELECT * FROM ' . $this->tabla . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila1 = $consulta->first_row('array');
        if ($this->form_validation->run() == FALSE) {
            $this->cabecera['titulo'] = 'Postulante';
            $this->cabecera['accion'] = 'Cambiar Contraseña';
            $contenido['cabecera'] = $this->cabecera;
            $contenido['fila'] = $fila;
            $contenido['fila1'] = $fila1;
            $contenido['action'] = $this->carpeta . 'guardar_cambiarpass';
            $data['contenido'] = $this->load->view($this->carpeta . $this->formulario, $contenido, true);
            $this->load->view('plantilla_publico', $data);
        } else {
            $pass_ant = $this->input->post($prefijo . 'pass_ant');
            $pass_nueva = $this->input->post($prefijo . 'pass_nueva');
            $pass_nueva1 = $this->input->post($prefijo . 'pass_nueva1');
            $consulta3 = $this->db->query('
                    SELECT * FROM ' . $this->tabla . ' where ' . $prefijo . 'pass="' . sha1($pass_ant) . '"');
            $fila3 = $consulta3->row_array('array');
            if ($pass_nueva != $pass_nueva1) {
                $error_nuevo = 'No Coinciden las Nuevas Contraseñas';
            }
            if (!$fila3) {
                $error_anterior = 'La Contraseña Anterior es Incorrecta';
            }
            if ($fila3 && !$error_nuevo && !$error_anterior) {
                $data[$this->prefijo . 'pass'] = sha1($pass_nueva);
                $data[$this->prefijo . 'id'] = $id;
                if ($this->$modelo->editar($data)) {
                    $contenido = '';
                    $data['contenido'] = $this->load->view($this->carpeta . 'mensaje_exito1', $contenido, true);
                    $this->load->view('plantilla_publico', $data);
                }
            } else {
                $this->cabecera['titulo'] = 'Postulante';
                $this->cabecera['accion'] = 'Cambiar Contraseña';
                $contenido['cabecera'] = $this->cabecera;
                $contenido['fila'] = $fila;
                $contenido['fila1'] = $fila1;
                $contenido['error_anterior'] = $error_anterior;
                $contenido['error_nuevo'] = $error_nuevo;
                $contenido['action'] = $this->carpeta . 'guardar_cambiarpass';
                $data['contenido'] = $this->load->view($this->carpeta . $this->formulario, $contenido, true);
                $this->load->view('plantilla_publico', $data);
            }
        }
    }

    function procesar() {

        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tabla . ' order by ' . $this->prefijo . 'id asc');
        $datos = $consulta->result_array();

        $eliminar = $this->input->post('eliminar');
        $permisos = $this->input->post('permisos');
        $deshabilitar = $this->input->post('deshabilitar');
        $habilitar = $this->input->post('habilitar');

        $actualizar = $this->input->post('actualizar');
        $bandera = $this->input->post('bandera');

        $ordenar = $this->input->post('ordenar');

        $modelo = $this->modelo;
//$this->load->model($this->carpeta.'fsimple/fsimple_model', $modelo, TRUE);

        $ruta_origen = $this->ruta; //"uploads/fsimple/";
        $accion_realizada = '';
        foreach ($datos as $fila) {
            $chk = $this->input->post('chk' . $fila[$this->prefijo . 'id']);
            $chk_permisos = $this->input->post('chkpermiso' . $fila[$this->prefijo . 'id']);
            $orden = $this->input->post('orden' . $fila[$this->prefijo . 'id']);
            if ($chk_permisos == 'on' && $permisos == "Actualizar Permisos") {
                $fila[$this->prefijo . 'permisos'] = '1';
                $this->$modelo->editar($fila);
            } elseif ($permisos == "Actualizar Permisos") {
                $fila[$this->prefijo . 'permisos'] = '0';
                $this->$modelo->editar($fila);
            }
            if ($chk == 'on') {
                $item_procesado = $fila[$this->prefijo . 'titulo'];

                if ($eliminar == "Eliminar") {

                    for ($i = 0; $i < count($this->campoup_img); $i++) {
                        @unlink($ruta_origen . $fila[$this->campoup_img[$i]]);
                        $nom_thum = 't_' . substr($fila[$this->campoup_img[$i]], 0, -4) . substr($fila[$this->campoup_img[$i]], -4);
                        @unlink($ruta_origen . $nom_thum);
                    }
                    for ($i = 0; $i < count($this->campoup_adj); $i++) {
                        @unlink($ruta_origen . $fila[$this->campoup_adj[$i]]);
                    }
                    $this->db->delete($this->tabla, array($this->prefijo . 'id' => $fila[$this->prefijo . 'id']));
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
//echo "<br/>Elemento ".$accion_realizada." ".$item_procesado;
            }
            if ($this->actual) {
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
        redirect($this->controlador);
    }

    function deshabilitar() {
        $id = $this->uri->segment(4);
        $consulta = $this->db->query('
        SELECT ' . $this->prefijo . 'id, pof_estado FROM postulante_f WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $fila['pof_estado'] = 0;
        $modelo = $this->modelo;
        $this->$modelo->editarEstado($fila);
        redirect('inicio');
    }

    function habilitar() {
        $id = $this->uri->segment(4);
        $consulta = $this->db->query('
        SELECT ' . $this->prefijo . 'id,pof_estado FROM postulante_f WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $fila['pof_estado'] = 1;
        $modelo = $this->modelo;
        $this->$modelo->editarEstado($fila);
        redirect('inicio');
    }

    function ndeshabilitar() {
        $id = $this->uri->segment(4);
        $consulta = $this->db->query('
        SELECT ' . $this->prefijo . 'id, pof_estado FROM postulante_f WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $fila['pof_estado'] = 0;
        $modelo = $this->modelo;
        $this->$modelo->editarEstado($fila);
        redirect('ninicio');
    }

    function nhabilitar() {
        $id = $this->uri->segment(4);
        $consulta = $this->db->query('
        SELECT ' . $this->prefijo . 'id,pof_estado FROM postulante_f WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $fila['pof_estado'] = 1;
        $modelo = $this->modelo;
        $this->$modelo->editarEstado($fila);
        redirect('ninicio');
    }

    function cambiarEstado() {
        $id = $this->uri->segment(4);
        $idEstado = $_POST['idestado'];
        $consulta = $this->db->query('
        SELECT ' . $this->prefijo . 'id,' . $this->prefijo . 'estado FROM ' . $this->tabla . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $fila[$this->prefijo . 'estado'] = $idEstado;
        $modelo = $this->modelo;
        echo $this->$modelo->editar($fila);
    }

    function definir_form_agregar() {
        $prefijo = $this->prefijo;
        $config = $this->set_reglas_validacion_agregar();
        $mensajes = $this->set_mensajes_error();

// inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach ($mensajes as $msj)
            $this->form_validation->set_message($msj['regla'], $msj['mensaje']);
// inicio asignando las reglas y mensajes de validacion
    }

    function set_reglas_validacion_agregar() {
        $prefijo = $this->prefijo;
        $config = array(
            array(
                'field' => $prefijo . 'permisos',
                'label' => 'Permisos',
                'rules' => 'min_length[0]'
            ),
            array(
                'field' => $prefijo . 'nombre',
                'label' => 'Nombre',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'login',
                'label' => 'Login',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'pass',
                'label' => 'Contraseña',
                'rules' => 'required|min_length[5]]|max_length[30]'
            ),
            array(
                'field' => $prefijo . 'email',
                'label' => 'E-mail',
                'rules' => 'valid_email'
            ),
            array(
                'field' => $prefijo . 'email2',
                'label' => 'E-mail Secundario',
                'rules' => 'min_length[0]'
            ),
            array(
                'field' => $prefijo . 'telefono',
                'label' => 'Telefono',
                'rules' => 'min_length[0]'
            ),
            array(
                'field' => $prefijo . 'institucion',
                'label' => 'Institución',
                'rules' => 'min_length[0]'
            ),
            array(
                'field' => $prefijo . 'pais',
                'label' => 'País',
                'rules' => 'min_length[0]'
            ),
            array(
                'field' => $prefijo . 'comentario',
                'label' => 'Comentario',
                'rules' => 'min_length[0]'
            )
        );
        return $config;
    }

    function definir_datos_form_agregar() {
        $prefijo = $this->prefijo;
        $config = $this->set_reglas_validacion_datos_agregar();
        $mensajes = $this->set_mensajes_error();
// inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach ($mensajes as $msj)
            $this->form_validation->set_message($msj['regla'], $msj['mensaje']);
// inicio asignando las reglas y mensajes de validacion
    }

    function set_reglas_validacion_datos_agregar() {
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
//                'rules' => 'is_numeric'
            ),
            array(
                'field' => $prefijo . 'celular',
                'label' => 'Celular',
                'rules' => 'min_length[7]'
//                'rules' => 'is_numeric'
            ),
            array(
                'field' => $prefijo . 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email'
            ),
            array(
                'field' => $prefijo . 'email1',
                'label' => 'Email',
                'rules' => 'required|valid_email'
            ),
            array(
                'field' => $prefijo . 'documento',
                'label' => 'Documento',
                'rules' => 'min_length[0]'
            ),
            array(
                'field' => $prefijo . 'pass',
                'label' => 'Contraseña',
                'rules' => 'required|min_length[8]|max_length[30]'
            ),
            array(
                'field' => $prefijo . 'pass1',
                'label' => 'Confirmación de Contraseña',
                'rules' => 'required|min_length[8]|max_length[30]'
            ),
            array(
                'field' => $this->prefijoP . 'id',
                'label' => 'País de residencia',
                'rules' => 'required|is_natural'
            ),
//            array(
//                'field' => $prefijoF . 'salario',
//                'label' => 'Pretensi? Salarial Referencial',
//                'rules' => 'required'
//            )
        );
        return $config;
    }

    function definir_datos_form_agregar_adicional() {
        $config = $this->set_reglas_validacion_adicional_agregar();
        $mensajes = $this->set_mensajes_error();
// inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach ($mensajes as $msj)
            $this->form_validation->set_message($msj['regla'], $msj['mensaje']);
// inicio asignando las reglas y mensajes de validacion
    }

    function set_reglas_validacion_adicional_agregar() {
        $prefijo = $this->prefijoPI;
        $config = array(
            array(
                'field' => $prefijo . 'habla',
                'label' => 'Habla',
                'rules' => 'is_natural|required'
            ),
            array(
                'field' => $prefijo . 'lee',
                'label' => 'Lee',
                'rules' => 'is_natural|required'
            ),
            array(
                'field' => $prefijo . 'escribe',
                'label' => 'Escribe',
                'rules' => 'is_natural|required'
            )
        );
        return $config;
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
//            array(
//                'field' => $prefijoF . 'salario',
//                'label' => 'Pretensi? Salarial Referencial',
//                'rules' => 'required'
//            )
        );
        return $config;
    }

    function definir_postgrado_form_agregar() {
        $prefijo = $this->prefijo1;
        $config = $this->set_reglas_validacion_postgrado_agregar();
        $mensajes = $this->set_mensajes_error();
// inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach ($mensajes as $msj)
            $this->form_validation->set_message($msj['regla'], $msj['mensaje']);
// inicio asignando las reglas y mensajes de validacion
    }

    function set_reglas_validacion_postgrado_agregar() {
        $prefijo = $this->prefijo1;
        $config = array(
            array(
                'field' => $prefijo . 'institucion',
                'label' => 'Institución',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'pais',
                'label' => 'País',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'titulado',
                'label' => 'Titulado',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'grado',
                'label' => 'Grado o Titulo',
                'rules' => 'is_natural'
            ),
            array(
                'field' => $prefijo . 'area',
                'label' => 'Área de Post Grado',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'tema',
                'label' => 'Tema de la Tesis',
                'rules' => 'min_length[0]'
            ),
            array(
                'field' => $prefijo . 'nota',
                'label' => 'Nota de la Tesis',
                'rules' => 'is_numeric|valid_nota'
            ),
            array(
                'field' => $prefijo . 'hasta',
                'label' => 'Hasta',
                'rules' => 'required|valid_fecha_anio_mes'
            ),
            array(
                'field' => $prefijo . 'desde',
                'label' => 'Desde',
                'rules' => 'required|valid_fecha_anio_mes'
            )
        );
        return $config;
    }

    function definir_superior_form_agregar() {
        $prefijo = $this->prefijo1;
        $config = $this->set_reglas_validacion_superior_agregar();
        $mensajes = $this->set_mensajes_error();
// inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach ($mensajes as $msj)
            $this->form_validation->set_message($msj['regla'], $msj['mensaje']);
// inicio asignando las reglas y mensajes de validacion
    }

    function set_reglas_validacion_superior_agregar() {
        $prefijo = $this->prefijo1;
        $config = array(
            array(
                'field' => $prefijo . 'institucion',
                'label' => 'Institución',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'pais',
                'label' => 'País',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'tema',
                'label' => 'Tema de la Tesis',
                'rules' => 'min_length[0]'
            ),
            array(
                'field' => $prefijo . 'titulado',
                'label' => 'Titulado',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'grado',
                'label' => 'Grado o Titulo',
                'rules' => 'is_natural'
            ),
            array(
                'field' => $prefijo . 'area',
                'label' => 'Área de profesion',
                'rules' => 'is_natural'
            ),
            array(
                'field' => $prefijo . 'nota',
                'label' => 'Nota de la Tesis',
                'rules' => 'is_numeric|valid_nota'
            ),
            array(
                'field' => $prefijo . 'hasta',
                'label' => 'Hasta',
                'rules' => 'required|is_numeric|valid_fecha_anio'
            ),
            array(
                'field' => $prefijo . 'desde',
                'label' => 'Desde',
                'rules' => 'required|is_numeric|valid_fecha_anio'
            )
        );
        return $config;
    }

    function definir_secundaria_form_agregar() {
        $prefijo = $this->prefijo1;
        $config = $this->set_reglas_validacion_secundaria_agregar();
        $mensajes = $this->set_mensajes_error();
// inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach ($mensajes as $msj)
            $this->form_validation->set_message($msj['regla'], $msj['mensaje']);
// inicio asignando las reglas y mensajes de validacion
    }

    function set_reglas_validacion_secundaria_agregar() {
        $prefijo = $this->prefijo1;
        $config = array(
            array(
                'field' => $prefijo . 'institucion',
                'label' => 'Institución',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'pais',
                'label' => 'País',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'hasta',
                'label' => 'Hasta',
                'rules' => 'required|is_numeric|valid_fecha_anio'
            ),
            array(
                'field' => $prefijo . 'desde',
                'label' => 'Desde',
                'rules' => 'required|is_numeric|valid_fecha_anio'
            )
        );
        return $config;
    }

    function definir_publicacion_form_agregar() {
        $prefijo = $this->prefijo2;
        $config = $this->set_reglas_validacion_publicacion_agregar();
        $mensajes = $this->set_mensajes_error();
// inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach ($mensajes as $msj)
            $this->form_validation->set_message($msj['regla'], $msj['mensaje']);
// inicio asignando las reglas y mensajes de validacion
    }

    function set_reglas_validacion_publicacion_agregar() {
        $prefijo = $this->prefijo2;
        $config = array(
            array(
                'field' => $prefijo . 'titulo',
                'label' => 'Titulo',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'anio',
                'label' => 'Año',
                'rules' => 'required|is_numeric'
            )
        );
        return $config;
    }

    function definir_trayectoria_form_agregar() {
        $prefijo = $this->prefijo3;
        $config = $this->set_reglas_validacion_trayectoria_agregar();
        $mensajes = $this->set_mensajes_error();
// inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach ($mensajes as $msj)
            $this->form_validation->set_message($msj['regla'], $msj['mensaje']);
// inicio asignando las reglas y mensajes de validacion
    }

    function set_reglas_validacion_trayectoria_agregar() {
        $prefijo = $this->prefijo3;
        $config = array(
            array(
                'field' => $prefijo . 'organizacion',
                'label' => 'Nombre de la Organización',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'tipo_org',
                'label' => 'Tipo Organización',
                'rules' => 'is_natural'
            ),
            array(
                'field' => $prefijo . 'descripcion_org',
                'label' => 'Actividad Principal de la Organización',
                'rules' => 'required'
            ),
//            array(
//                'field' => $prefijo . 'funciones_org',
//                'label' => '3 Principales Funciones Desempe?das dentro del Cargo',
//                'rules' => 'required'
//            ),
//            array(
//                'field' => $prefijo . 'logros',
//                'label' => 'Principales Logros',
//                'rules' => 'required'
//            ),
            array(
                'field' => $prefijo . 'cargos',
                'label' => 'Cargo(s) Ocupado(s)',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'sueldo',
                'label' => 'Total Ganado Mensual',
                'rules' => 'is_numeric'
            ),
            array(
                'field' => $prefijo . 'telefono_org',
                'label' => 'Teléfono de la Organización',
                'rules' => 'required|is_numeric'
            ),
            array(
                'field' => $prefijo . 'nombre_sup',
                'label' => 'Nombre del Inmediato Superior',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'telefono_sup',
                'label' => 'Cel. del Inmediato superior',
                'rules' => 'is_numeric'
            ),
            array(
                'field' => $prefijo . 'email_sup',
                'label' => 'Correo Electrónico Inmediato superior',
                'rules' => 'valid_email'
            ),
            array(
                'field' => $prefijo . 'pais',
                'label' => 'País - Ciudad',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'nsubordinados',
                'label' => 'N° de Subordinados',
                'rules' => 'is_numeric'
            ),
            array(
                'field' => $prefijo . 'actual',
                'label' => 'Actualmente trabajando',
                'rules' => 'min_length[0]'
            ),
            array(
                'field' => $prefijo . 'hasta',
                'label' => 'Hasta',
                'rules' => 'required|valid_fecha_anio_mes'
            ),
            array(
                'field' => $prefijo . 'desde',
                'label' => 'Desde',
                'rules' => 'required|valid_fecha_anio_mes'
            )
        );
        return $config;
    }

    function definir_experiencia_sintesis_form_editar() {
        $prefijo = $this->prefijo;
        $config = $this->set_reglas_validacion_experiencia_sintesis_agregar();
        $mensajes = $this->set_mensajes_error();
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
//                'label' => '?rea de Experiencia',
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
                'rules' => 'min_length[0]'
            ),
            array(
                'field' => $prefijoF . 'supervisar_exp',
                'label' => 'Experiencia en supervisión',
                'rules' => 'required'
            )
        );
        return $config;
    }

    function definir_idioma_form_agregar() {
        $prefijo = $this->prefijo4;
        $config = $this->set_reglas_idioma_trayectoria_agregar();
        $mensajes = $this->set_mensajes_error();
// inicio asignando las reglas y mensajes de validacion

        $this->form_validation->set_rules($config);

        foreach ($mensajes as $msj) {
            $this->form_validation->set_message($msj['regla'], $msj['mensaje']);
        }
// inicio asignando las reglas y mensajes de validacion
    }

    function set_reglas_idioma_trayectoria_agregar() {
        $prefijo = $this->prefijo4;
        $prefijoPI = $this->prefijoPI;
        $config = array(
            array(
                'field' => $prefijo . 'id',
                'label' => 'Idioma',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijoPI . 'habla',
                'label' => 'Habla',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijoPI . 'lee',
                'label' => 'Lee',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijoPI . 'escribe',
                'label' => 'Escribe',
                'rules' => 'required'
            )
        );
        return $config;
    }

    function definir_form_pass() {
        $prefijo = $this->prefijo;
        $config = $this->set_reglas_validacion_pass();
        $mensajes = $this->set_mensajes_error();

// inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach ($mensajes as $msj)
            $this->form_validation->set_message($msj['regla'], $msj['mensaje']);
// inicio asignando las reglas y mensajes de validacion
    }

    function set_reglas_validacion_pass() {
        $prefijo = $this->prefijo;
        $config = array(
            array(
                'field' => $prefijo . 'pass_ant',
                'label' => 'Contraseña Anterior',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'pass_nueva',
                'label' => 'Nueva Contraseña',
                'rules' => 'required|min_length[8]|max_length[30]'
            ),
            array(
                'field' => $prefijo . 'pass_nueva1',
                'label' => 'Confirmación de Contraseña',
                'rules' => 'required|min_length[8]|max_length[30]'
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

//    para ordenar fechas de una array de array
    function ordenarFechaArray($a, $b) {
        return strtotime(trim($a['fecha'])) - strtotime(trim($b['fecha']));
    }

    function Ufecha($campo) {
        $modelo = $this->modelo;
        $dataF[$this->prefijo . 'id'] = $_SESSION[$this->presession . 'id'];
        $dataF[$this->prefijo . $campo] = date('Y-m-d');
        $this->$modelo->fechasUpdate($dataF);
    }

}

?>