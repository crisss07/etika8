<?php

require_once('Controladoradmin.php');
date_default_timezone_set('America/La_Paz');

class Postulacion extends Controladoradmin {

    function __construct() {
        parent::__construct();
        force_ssl();
        $this->load->helper(array('url', 'form', 'html'));
        $this->load->library(array('form_validation', 'tool_general'));
        $this->load->helper('directory');
        $this->load->library('aws3');  

        //****** definiendo nombre de carpeta por defecto
        $this->carpeta = 'postulacion/';
        $this->controlador = 'postulacion/';

        //******conf uploads
        $this->config_normal['upload_path'] = './archivos/postulacion/';
        $this->config_normal['allowed_types'] = 'doc|pdf|txt|rar|gif|jpg|png|zip|ppt';
        $this->config_normal['max_size'] = '2048';
        $this->load->library('upload', $this->config_normal);

        $this->tabla = 'convocatoria_postulacion';
        $this->prefijo = 'con_';
        $this->tabla1 = 'convocatoria';


        $this->rutaimg = base_url() . 'files/img/';

        $this->formulario_agregar = 'postulacion_form';
        $this->formulario_editar = 'postulacion_form';
        $this->action_defecto = 'listar';

        //****** cargando el modelo
        $this->modelo = 'modelo_postulacion';
        $this->load->model($this->carpeta . 'Postulacion_model', $this->modelo, TRUE);

        $this->urifull = $this->uri->uri_to_assoc();

        $this->ruta = $this->config_normal['upload_path'];
        $this->prefijo = 'pos_';
        $this->prefijoF = 'pof_';
        $this->prefijo1 = 'edu_';
        $this->prefijo2 = 'pub_';
        $this->prefijo3 = 'tra_';
        $this->prefijo4 = 'idi_';
        $this->prefijoI = 'poi_';
        $this->prefijo5 = 'eta_';
        $this->cabecera_datos_personales = array('Tipo Documento', 'Documento', 'Apellido Paterno', 'Apellido Materno', 'Nombres', 'Edad', 'Sexo', 'Nacionalidad', 'País de Residencia', 'Ciudad o Localidad', 'Dirección', 'Teléfono', 'Celular', 'Correo Electrónico', 'Traslado', 'Pretensión Salarial Referencial (Bs.)', 'Comentario Adicional', 'Observación', 'Recomendación');
//        $this->campos_datos_personales = array('case ' . $this->prefijo . 'tipodoc when "1" then "C.I." when "2" then "Pasaporte" end as ' . $this->prefijo . 'tipodoc', $this->prefijo . 'documento', $this->prefijo . 'apaterno', $this->prefijo . 'amaterno', $this->prefijo . 'nombre', 'concat(' . $this->prefijoF . 'fecha_nacimiento," (", (YEAR(CURDATE())-YEAR(pof_fecha_nacimiento) + IF(DATE_FORMAT(CURDATE(),"%m-%d") >= DATE_FORMAT(pof_fecha_nacimiento,"%m-%d"), 0, -1)),")") AS ' . $this->prefijoF . 'fecha_nacimiento', 'case ' . $this->prefijoF . 'sexo when "1" then "Hombre" when "2" then "Mujer" end as ' . $this->prefijoF . 'sexo', $this->prefijo . 'nacionalidad',
        $this->campos_datos_personales = array('case ' . $this->prefijo . 'tipodoc when "1" then "C.I." when "2" then "Pasaporte" end as ' . $this->prefijo . 'tipodoc', $this->prefijo . 'documento', $this->prefijo . 'apaterno', $this->prefijo . 'amaterno', $this->prefijo . 'nombre', '(YEAR(CURDATE())-YEAR(pof_fecha_nacimiento) + IF(DATE_FORMAT(CURDATE(),"%m-%d") >= DATE_FORMAT(pof_fecha_nacimiento,"%m-%d"), 0, -1)) AS ' . $this->prefijoF . 'fecha_nacimiento', 'case ' . $this->prefijoF . 'sexo when "1" then "Hombre" when "2" then "Mujer" end as ' . $this->prefijoF . 'sexo', $this->prefijo . 'nacionalidad', 'pa.pai_nombre', 'ci.pai_nombre',
            $this->prefijo . 'direccion', $this->prefijo . 'telefono', $this->prefijo . 'celular', $this->prefijo . 'email', $this->prefijo . 'traslado_lugar', $this->prefijoF . 'salario', $this->prefijo . 'comentario', $this->prefijo . 'observacion', $this->prefijoF . 'recomendacion');
//        $this->campos_datos_personales1 = array($this->prefijo . 'tipodoc', $this->prefijo . 'documento', $this->prefijo . 'apaterno', $this->prefijo . 'amaterno', $this->prefijo . 'nombre', $this->prefijoF . 'fecha_nacimiento', $this->prefijoF . 'sexo', $this->prefijo . 'nacionalidad',
        $this->campos_datos_personales1 = array($this->prefijo . 'tipodoc', $this->prefijo . 'documento', $this->prefijo . 'apaterno', $this->prefijo . 'amaterno', $this->prefijo . 'nombre', $this->prefijoF . 'fecha_nacimiento', $this->prefijoF . 'sexo', $this->prefijo . 'nacionalidad', 'pais', 'ciudad',
            $this->prefijo . 'direccion', $this->prefijo . 'telefono', $this->prefijo . 'celular', $this->prefijo . 'email', $this->prefijo . 'traslado_lugar', $this->prefijoF . 'salario', $this->prefijo . 'comentario', $this->prefijo . 'observacion', $this->prefijoF . 'recomendacion');
        $this->cabecera_educacion_postgrado = array('Desde', 'Hasta', 'Institución', 'País', 'Grado o Titulo', 'Área Postgrado', 'Tema Tesis', 'Nota Tesis', 'Titulado');
        $this->campos_educacion_postgrado = array($this->prefijo1 . 'desde', $this->prefijo1 . 'hasta', $this->prefijo1 . 'institucion', $this->prefijo1 . 'pais', $this->prefijo1 . 'grado', $this->prefijo1 . 'area', $this->prefijo1 . 'tema', $this->prefijo1 . 'nota', $this->prefijo1 . 'titulado');
        $this->cabecera_educacion_superior = array('Desde', 'Hasta', 'Institución', 'País', 'Grado o Titulo', 'Área Profesión', 'Tema Tesis', 'Nota Tesis', 'Titulado');
        $this->campos_educacion_superior = array($this->prefijo1 . 'desde', $this->prefijo1 . 'hasta', $this->prefijo1 . 'institucion', $this->prefijo1 . 'pais', $this->prefijo1 . 'grado', $this->prefijo1 . 'area', $this->prefijo1 . 'tema', $this->prefijo1 . 'nota', $this->prefijo1 . 'titulado');
        $this->cabecera_educacion_secundaria = array('Desde', 'Hasta', 'Institución', 'País');
        $this->campos_educacion_secundaria = array($this->prefijo1 . 'desde', $this->prefijo1 . 'hasta', $this->prefijo1 . 'institucion', $this->prefijo1 . 'pais');
        $this->cabecera_publicacion = array('Titulo', 'Año');
        $this->campos_publicacion = array($this->prefijo2 . 'titulo', $this->prefijo2 . 'anio');
        $this->cabecera_trayectoria = array('Desde', 'Hasta', 'Tiempo que Trabajó(Años y Meses)', 'Nombre Organización', 'Tipo Organización', 'Actividad Principal Organización', 'Cargo(s) Ocupado(s)', '3 Principales Funciones Desempeñadas dentro del Cargo', 'Principales Logros', 'Páis - Ciudad', 'Nº de Subordinados', 'Total Ganado Mensual', 'Teléfono de la Organización', 'Nombre del Inmediato Superior', 'Teléfono del Inmediato Superior', 'Correo Electrónico del Inmediato Superior', 'Actualmente Trabajando en esta Org.');
        $this->campos_trayectoria = array($this->prefijo3 . 'desde', $this->prefijo3 . 'hasta', $this->prefijo3 . 'anio_mes', $this->prefijo3 . 'organizacion', $this->prefijo3 . 'tipo_org', $this->prefijo3 . 'descripcion_org', $this->prefijo3 . 'cargos', $this->prefijo3 . 'funciones_org', $this->prefijo3 . 'logros', $this->prefijo3 . 'pais',
            $this->prefijo3 . 'nsubordinados', $this->prefijo3 . 'sueldo', $this->prefijo3 . 'telefono_org', $this->prefijo3 . 'nombre_sup', $this->prefijo3 . 'telefono_sup', $this->prefijo3 . 'email_sup', $this->prefijo3 . 'actual');
        $this->campos_trayectoria1 = array($this->prefijo3 . 'desde', $this->prefijo3 . 'hasta', 'PERIOD_DIFF(DATE_FORMAT(STR_TO_DATE(tra_hasta,"%Y-%m"),"%Y%m"),DATE_FORMAT(STR_TO_DATE(tra_desde,"%Y-%m"),"%Y%m")) as tra_anio_mes', $this->prefijo3 . 'organizacion', $this->prefijo3 . 'tipo_org', $this->prefijo3 . 'descripcion_org', $this->prefijo3 . 'cargos', $this->prefijo3 . 'funciones_org', $this->prefijo3 . 'logros', $this->prefijo3 . 'pais',
            $this->prefijo3 . 'nsubordinados', $this->prefijo3 . 'sueldo', $this->prefijo3 . 'telefono_org', $this->prefijo3 . 'nombre_sup', $this->prefijo3 . 'telefono_sup', $this->prefijo3 . 'email_sup', $this->prefijo3 . 'actual');
        $this->cabecera_sintesis = array('Ambito en el que clasifica su Exp. Laboral', 'Área de exp. que usted resaltaría', 'Sector de exp. que usted resaltaría', 'Experiencia en Supervisión');
        $this->campos_sintesis = array($this->prefijoF . 'ambito_exp', $this->prefijoF . 'area_exp', $this->prefijoF . 'sector_exp', $this->prefijoF . 'supervisar_exp');
        $this->cabecera_informacion_adicional = array('Idioma', 'Habla', 'Lee', 'Escribe');
        $this->campos_informacion_adicional = array('idi_idioma', $this->prefijoI . 'habla', $this->prefijoI . 'lee', $this->prefijoI . 'escribe');
        $this->cabecera_otros = array('Cliente', 'Cargo', 'Instancia');
//        $this->cabecera_otros = array('Participación en anteriores procesos', 'Observación');
        $this->campos_otros = array('cliente', 'cargo', 'instancia');
//        $this->campos_otros = array('convocatoria', $this->prefijo5 . 'observacion');
        $this->tabla = 'convocatoria_postulacion';
        $this->tabla3 = 'educacion_secundaria';
        $this->prefijo = 'con_';
        $this->tabla1 = 'convocatoria';
        $this->tablaF = 'postulante_f';
        $this->tablaP = 'postulante';
        $this->prefijoP = 'pos_';
        $this->tabla5 = 'trayectoria_laboral';
        $this->tabla6 = 'idiomas';
        $this->prefijo6 = 'idi_';
        $this->tablaPI = 'postulante_idioma';
        $this->prefijoPI = 'poi_';

        $consulta = $this->db->query('
            SELECT year(' . $this->prefijo . 'hasta) anios FROM ' . $this->tabla1 . ' WHERE ' . $this->prefijo . 'hasta<="' . date('Y-m-d') . '" GROUP BY anios ORDER BY anios DESC
            ');
        $this->anios = $consulta->result_array();
        $this->pagina = @$this->urifull['pagina'];
        if ($this->pagina)
            $this->cabecera['titulo'] = 'Historial Postulaciones';
        else
            $this->cabecera['titulo'] = 'Postulaciones';

        $consulta = $this->db->query('
        SELECT com_id as id, com_nombre as nombre
        FROM combos
        WHERE com_tipo="1"
        ORDER BY com_orden asc'
        );
        $grados = $consulta->result_array();
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
        foreach ($grados_sup as $grado) {
            $this->grados_sup[$grado['id']] = $grado['nombre'];
        }
        $consulta = $this->db->query('
        SELECT com_id as id, com_nombre as nombre
        FROM combos
        WHERE com_tipo="3"
        ORDER BY com_orden asc'
        );
        $area_pro = $consulta->result_array();
        foreach ($area_pro as $grado) {
            $this->area_pro[$grado['id']] = $grado['nombre'];
        }
        $consulta = $this->db->query('
        SELECT com_id as id, com_nombre as nombre
        FROM combos
        WHERE com_tipo="4"
        ORDER BY com_orden asc'
        );
        $tipo_org = $consulta->result_array();
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
        foreach ($nivel_alcanzado as $grado) {
            $this->nivel_alcanzado[$grado['id']] = $grado['nombre'];
        }
        $consulta = $this->db->query('
        SELECT com_id as id, com_nombre as nombre
        FROM combos
        WHERE com_tipo="11"
        ORDER BY com_orden asc'
        );
        $nivel_alcanzado_no = $consulta->result_array();
        foreach ($nivel_alcanzado_no as $grado) {
            $this->nivel_alcanzado_no[$grado['id']] = $grado['nombre'];
        }
        $consulta = $this->db->query('
        SELECT com_id as id, com_nombre as nombre
        FROM combos
        WHERE com_tipo="7"
        ORDER BY com_orden asc'
        );
        $recomendaciones = $consulta->result_array();
        $this->recomendaciones[0] = "No tiene Ninguna Recomendación";
        foreach ($recomendaciones as $grado) {
            $this->recomendaciones[$grado['id']] = $grado['nombre'];
        }

        $consultaEtikos = $this->db->query('
        SELECT eti_id, eti_nombre as nombre
        FROM etiko'
        );
        $etikos = $consultaEtikos->result_array();
        foreach ($etikos as $value) {
            $this->etikos[$value['eti_id']] = $value['nombre'];
        }


        $this->boton = '4';
        $this->etapa = 0;
        $this->presession = $this->tool_entidad->presession();
        session_start();
        if (!isset($_SESSION[$this->presession . 'usuario'])) {
            redirect(base_url() . index_page());
        }
        $this->id_etiko = $_SESSION[$this->presession . 'id'];
    }

    function mostrar() {
        $prefijo = $this->prefijo;
        $prefijo1 = 'pos_';
        $prefijoF = 'pof_';
        $campos_listar = array('fecha', 'pretension salarial', 'Documento', 'Apellido Paterno', 'Apellido Materno', 'Nombres', 'Ciudad', 'Teléfono', 'Celular', 'Email','Observación','Recomendación', 'Convocatorias paralelas', 'Fecha modificación de sistema', 'Fecha CV adjunto temporal');
        $campos_reales = array($prefijo1 . 'con_fecha_creacion', $prefijo1 . 'con_pretension_salarial', $prefijo1 . 'documento', $prefijo1 . 'apaterno', $prefijo1 . 'amaterno', $prefijo1 . 'nombre', 'ciudad', $prefijo1 . 'telefono', $prefijo1 . 'celular', $prefijo1 . 'email',$prefijo1 . 'observacion', $prefijoF. 'recomendacion', 'num', 'fsis', 'cvtem');
//        $campos_listar = array('Documento', 'Tipo Documento', 'Apellido Paterno', 'Apellido Materno', 'Nombres', 'Ciudad', 'Dirección', 'Teléfono', 'Celular', 'Email', 'Convocatorias paralelas');
//        $campos_reales = array($prefijo1 . 'documento', $prefijo1 . 'tipodoc', $prefijo1 . 'apaterno', $prefijo1 . 'amaterno', $prefijo1 . 'nombre', 'ciudad', $prefijo1 . 'direccion', $prefijo1 . 'telefono', $prefijo1 . 'celular', $prefijo1 . 'email', 'num');
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
        $consulta = $this->db->query('
        SELECT *
        FROM
        convocatoria a, clientes c
        WHERE a.cli_id=c.cli_id and a.con_id=' . $id
        );
        $fila = $consulta->row_array();
        

        $consulta = $this->db->query('
            SELECT
            b.pos_id,
            con_id,
            con_id1,
            DATE_FORMAT(a.con_fecha_creacion,"%Y-%m-%d") as ' . $prefijo1 . 'con_fecha_creacion,
            a.con_pretension_salarial as ' . $prefijo1 .'con_pretension_salarial,
            ' . $prefijo1 . 'documento,
            case ' . $prefijo1 . 'tipodoc
            when "1" then "C.I."
            when "2" then "Pasaporte"
            end as ' . $prefijo1 . 'tipodoc,
            ' . $prefijo1 . 'apaterno,
            ' . $prefijo1 . 'amaterno,
            ' . $prefijo1 . 'nombre,
            IF(pf.ciu_id = 156, pf.pof_pais_ciudad,ci.pai_nombre) as ciudad,
            ' . $prefijo1 . 'direccion,
            ' . $prefijo1 . 'telefono,
            ' . $prefijo1 . 'celular,
            ' . $prefijo1 . 'email,
            ' . $prefijo1 . 'observacion,
            pf.' . $prefijoF . 'recomendacion
            FROM convocatoria_postulacion a, postulante b
            INNER JOIN postulante_f pf
            ON pf.pos_id=b.pos_id
            INNER JOIN paises ci
            ON ci.pai_id=pf.ciu_id
            WHERE a.pos_id=b.pos_id and con_id1=' . $id . '
            ORDER BY pos_apaterno asc, pos_tipodoc asc, pos_documento asc');
        $datos = $consulta->result_array();
        $consultaRecomendacion = $this->db->query('
        SELECT
        com_id as id,
        com_nombre as nombre 
        FROM combos
        where com_tipo=7
        ORDER BY com_orden asc'
        );
        $recomendacion = $consultaRecomendacion->result_array();
        //var_dump($datos);
        //exit;
        // print_r($recomendacion);
        foreach ($datos as $key => $value) {
            $idPostulante = $value['pos_id'];
//            $consultaPostulaciones = $this->db->query('
//             select count(pos_id) as num,pos_id,con_cargo,eti_id1,eti_id2 from convocatoria_postulacion cp
//                inner join convocatoria c on c.con_id=cp.con_id1
//                    where date(now())<=con_hasta and con_hasta>=date(now()) and pos_id=
//            ' . $idPostulante . ' and con_id1!=' . $id);
            $consultaPostulaciones = $this->db->query('
             select pos_id,con_cargo,eti_id1,eti_id2 from convocatoria_postulacion cp
                inner join convocatoria c on c.con_id=cp.con_id1
                    where date(now())<=con_hasta and con_hasta>=date(now()) and pos_id=
            ' . $idPostulante . ' and con_id1!=' . $id . ' group by con_id1');
            $numPostulaciones = $consultaPostulaciones->result_array();

//            $numPostulaciones = $consultaPostulaciones->row_array();
            $value['num'] = $numPostulaciones;
            $consultaCVTem = $this->db->query('
             select cvt_docnombre as nombre,date(cvt_fecha_creacion) as fecha from cv_temporales where pos_id=' . $idPostulante . ' and con_id=' . $id . ' order by cvt_fecha_creacion desc limit 1');
            $cvTem = $consultaCVTem->row_array();
            if ($cvTem) {
                $value['cvtem'] = $cvTem;
            }
            $value['fsis'] = $this->fechasCVSistema($idPostulante);
            $valor = 'Sin mayor información';
            foreach($recomendacion as $re){
                if($re['id']==$value[$prefijoF.'recomendacion'])
                {
                    $valor = $re['nombre'];
                }
            }
            $value[$prefijoF.'recomendacion'] = $valor;

//            $value['num'] = $numPostulaciones['num']; 
//            print_r($numPostulaciones);
            $datos[$key] = $value;
        }
        // print_r($datos);
        $consulta = $this->db->query('
            SELECT eti_id1,eti_id2
            FROM convocatoria
            WHERE con_id=' . $id . ' and (eti_id1=' . $this->id_etiko . ' or eti_id2=' . $this->id_etiko . ')');
        $permisos = $consulta->row_array();
        if ($permisos) {
            $contenido['desvincular'] = 1;
        }

        $this->cabecera['titulo'] = "Cargo: " . $fila[$prefijo . 'cargo'] . " (ID: " . $id . ")";
        $this->cabecera['accion'] = 'Postulantes';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['campos_listar'] = $campos_listar;
        $contenido['campos_reales'] = $campos_reales;
        $contenido['datos'] = $datos;
        $contenido['cliente'] = $fila['cli_nombre'];
        $contenido['id'] = $id;
        $data['contenido'] = $this->load->view($this->carpeta . 'mostrar', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    public function descargar_seleccionados()
    {   
        $aws_bucket=$this->tool_entidad->aws_bucket();
        $archivos=$this->input->post('archivos');
        $nom_carpeta=$this->input->post('nombre_carpeta');
        if ($archivos!=null) {//en caso de null
            $this->aws3->zipfileSelected($aws_bucket,'archivos/cvs/temp/'.$nom_carpeta,$archivos);
        }
        else{
            redirect('Postulacion/mostrar/id/'.$nom_carpeta);
        }
    }

  



    function fechasCVSistema($id) {
        $fechasArray = array();
        $consultaFecha = $this->db->query('
        SELECT date(' . $this->prefijoP . 'fecha_edicion) as fecha
        FROM ' . $this->tablaP . '
        WHERE ' . $this->prefijoP . 'id=' . $id . '
        ORDER BY
        ' . $this->prefijoP . 'fecha_edicion desc limit 1'
        );
        $datosFecha = $consultaFecha->row_array();
        $fechasArray[] = 'Datos Personales: <b>' . $datosFecha['fecha'] . '</b>';

//        fecha instruccion formal
        $consultafecha = $this->db->query('
        SELECT ' . $this->prefijoP . 'fecha_instruccion_formal as fecha
        FROM ' . $this->tablaP . '
        WHERE ' . $this->prefijoP . 'id=' . $id
        );
        $sfecha = $consultafecha->row_array();
        $fechasArray[] = 'Instrucción Formal: <b>' . $sfecha['fecha'] . '</b>';

//        fecha trayectoria laboral
        $consultaFecha = $this->db->query('
         SELECT ' . $this->prefijoP . 'fecha_trayectoria_laboral as fecha
        FROM ' . $this->tablaP . '
        WHERE ' . $this->prefijoP . 'id=' . $id
        );
        $tfecha = $consultafecha->row_array();
        $fechasArray[] = 'Experiencia Laboral: <b>' . $tfecha['fecha'] . '</b>';

//        fecha informacion adicional
        $consultaFecha = $this->db->query('
         SELECT ' . $this->prefijoP . 'fecha_informacion_adicional as fecha
        FROM ' . $this->tablaP . '
        WHERE ' . $this->prefijoP . 'id=' . $id
        );
        $ingfecha = $consultaFecha->row_array();
        $fechasArray[] = 'Información Adicional: <b>' . $ingfecha['fecha'] . '</b>';

        return @implode($fechasArray, '<br/>');
    }

    function desvincular($var, $id) {
        $ruta_origen = $this->ruta;
        if ($_SESSION[$this->presession . 'permisos'] == 1) {
            $consulta = $this->db->query('
            SELECT a.con_id as id, a.con_id1 as id1, b.con_cargo as cargo, concat(c.pos_apaterno," ",c.pos_amaterno," ",c.pos_nombre) as nombre, c.pos_documento as documento FROM convocatoria_postulacion a, convocatoria b, postulante c WHERE a.con_id1=b.con_id and a.pos_id=c.pos_id and a.con_id=' . $id);
        } else {
            $consulta = $this->db->query('
            SELECT a.con_id as id, a.con_id1 as id1, b.con_cargo as cargo, concat(c.pos_apaterno," ",c.pos_amaterno," ",c.pos_nombre) as nombre, c.pos_documento as documento FROM convocatoria_postulacion a, convocatoria b, postulante c WHERE a.con_id1=b.con_id and a.pos_id=c.pos_id and a.con_id=' . $id . ' and (b.eti_id1=' . $_SESSION[$this->presession . 'id'] . ' or b.eti_id2=' . $_SESSION[$this->presession . 'id'] . ')');
        }
        $fila = $consulta->first_row('array');
        $this->db->delete('convocatoria_postulacion', array('con_id' => $fila['id']));
        $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
        $logs['log_tabla_id'] = 'convocatoria_postulacion - ' . $fila['id'];
        $logs['log_modulo'] = 'Postulaciones';
        $logs['log_accion'] = 'Desvincular';
        $logs['log_fecha'] = date('Y-m-d H:i:s');
        $logs['log_comentario'] = 'Desvinculó del Cargo: "' . $fila['cargo'] . '" al Postulante: "' . $fila['nombre'] . '" con Nº de Documento: "' . $fila['documento'] . '"';
        $this->db->insert('logs_etiko', $logs);
        redirect($this->controlador . 'mostrar/id/' . $fila['id1']);
    }

    function verVigentes() {
        $prefijo = 'con_';
        $campos_listar = array('Cargo', 'Responsable ETIKO 1', 'Responsable ETIKO 2');
        $campos_reales = array('con_cargo', 'eti_id1', 'eti_id2');
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
        $idconv = $uri['idconv'];
        $consulta = $this->db->query('
        SELECT *
        FROM
        convocatoria a, clientes c
        WHERE a.cli_id=c.cli_id and a.con_id=' . $idconv
        );
        $fila = $consulta->row_array();

        $consulta = $this->db->query('
             select pos_id,con_cargo,eti_id1,eti_id2
                    from convocatoria_postulacion cp
                    inner join convocatoria c on c.con_id=cp.con_id1
                    where date(now())<=con_hasta and con_hasta>=date(now()) and pos_id= ' . $id . ' and con_id1!=
                ' . $idconv);
        $datos = $consulta->result_array();


        $this->cabecera['titulo'] = $fila[$prefijo . 'cargo'];
        $this->cabecera['accion'] = 'Postulantes Convocatorias Paralelas';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['campos_listar'] = $campos_listar;
        $contenido['campos_reales'] = $campos_reales;
        $contenido['datos'] = $datos;
        $contenido['cliente'] = $fila['cli_nombre'];
        $contenido['id'] = $idconv;
        $data['contenido'] = $this->load->view($this->carpeta . 'mostrarVigentes', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function etapas() {
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
        $prefijo = $this->prefijo;
        $consulta = $this->db->query('
            SELECT * FROM ' . $this->tabla1 . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $this->cabecera['titulo'] = $fila[$prefijo . 'cargo'];
        $this->cabecera['accion'] = 'Etapas de calificación';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['action'] = $this->controlador . 'generar';
        $contenido['fila'] = $fila;
        $contenido['id'] = $id;
        $data['contenido'] = $this->load->view($this->carpeta . 'listar_etapas', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function excel() {
        $prefijo = $this->prefijo;
        $id = $this->input->post('id');
        $sub_cabecera = $this->input->post('sub_cabecera');
        $consulta = $this->db->query('
            SELECT * FROM ' . $this->tabla1 . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $contenido['archivo'] = strtolower($this->tool_general->limpiar_cadena($fila[$prefijo . 'cargo']));
        $contenido['titulo'] = $fila[$prefijo . 'cargo'];
        $campos_listar = unserialize(base64_decode($_REQUEST['campos_listar']));
        $campos_reales = unserialize(base64_decode($_REQUEST['campos_reales']));
        $datos = unserialize(base64_decode($_REQUEST['datos']));
        $contenido['campos_listar'] = $campos_listar;
        $contenido['campos_reales'] = $campos_reales;
        $contenido['datos'] = $datos;
        $contenido['sub_cabecera'] = $sub_cabecera;
        $this->load->view($this->carpeta . 'excel1', $contenido);
    }

    function excel_new() {
        $instancia[1] = 'EP';
        $instancia[2] = 'TP';
        $instancia[3] = 'Assesment';
        $instancia[4] = 'Entrevista';
        $instancia[5] = 'Finalista';
        $instancia[6] = 'Elegido';
        $prefijo = $this->prefijo;
        $id = $this->urifull['id'];
        $this->campos_listar = array('Documento', 'Primer Apellido', 'Segundo Apellido', 'Nombres', 'Edad', 'Salario<br/>Bs.', 'Telf.', 'Cel.', 'Email', 'Número<br/>de Procesos', 'Procesos Anteriores', 'El Más Alto', 'Formación Académica', 'Exp. General', 'Exp. Especifica', 'Total', 'Recomendación', 'Observaciones');
        $this->campos_reales = array('pos_documento', 'pos_apaterno', 'pos_amaterno', 'pos_nombre', 'pos_anio', 'pof_salario', 'pos_telefono', 'pos_celular', 'email', 'nro', 'anterior', 'alto', 'academica', 'exp_general', 'exp_especifica', 'total', 'pof_recomendacion', 'observacion');
        $consulta = $this->db->query('
        SELECT *,
        b.pos_id as id,
        b.pos_nro_postulaciones as nro,
        YEAR(CURDATE())-YEAR(pof_fecha_nacimiento) + IF(DATE_FORMAT(CURDATE(),"%m-%d") >= DATE_FORMAT(pof_fecha_nacimiento,"%m-%d"), 0, -1) as pos_anio, pos_observacion as observacion,pos_email as email,pof_recomendacion 
        FROM convocatoria_postulacion a, postulante b  
        INNER JOIN postulante_f pf ON  b.pos_id=pf.pos_id
        WHERE a.pos_id=b.pos_id and a.con_id1=' . $id . ' 
        ORDER BY b.pos_apaterno');

        $datos = $consulta->result_array();
        foreach ($datos as $num => $row) {
            $consulta = $this->db->query('
            SELECT a.eta_instancia as instancia, c.cli_nombre as cliente, YEAR(b.con_hasta) as anio
            FROM etapas a, convocatoria b, clientes c
            WHERE a.pos_id=' . $row['pos_id'] . ' and a.con_id != ' . $id . ' and a.con_id=b.con_id and b.cli_id=c.cli_id
            ORDER BY eta_id desc LIMIT 1'
            );
            $proceso_anterior = $consulta->row_array();
            if ($proceso_anterior) {
                $datos[$num]['anterior'] = $instancia[$proceso_anterior['instancia']] . ' ' . $proceso_anterior['cliente'] . ' ' . $proceso_anterior['anio'];
            } else {
                $datos[$num]['anterior'] = 'Ningun proceso';
            }
            $consulta = $this->db->query('
            SELECT a.eta_instancia as instancia, c.cli_nombre as cliente, YEAR(b.con_hasta) as anio
            FROM etapas a, convocatoria b, clientes c
            WHERE a.pos_id=' . $row['pos_id'] . ' and a.con_id != ' . $id . ' and a.con_id=b.con_id and b.cli_id=c.cli_id
            ORDER BY a.eta_instancia desc LIMIT 1'
            );
            $mas_alto = $consulta->row_array();

            if ($mas_alto) {
                $datos[$num]['alto'] = $instancia[$mas_alto['instancia']] . ' ' . $mas_alto['cliente'] . ' ' . $mas_alto['anio'];
            } else {
                $datos[$num]['alto'] = 'Ningun proceso';
            }
            if ($row['pos_anio'] == date('Y')) {
                $datos[$num]['pos_anio'] = 0;
            }
            $datos[$num]['academica'] = ' &nbsp; ';
            $datos[$num]['exp_general'] = ' &nbsp; ';
            $datos[$num]['exp_especifica'] = ' &nbsp; ';
            $datos[$num]['total'] = ' &nbsp; ';
//            $datos[$num]['observacion'] = ' &nbsp; ';
        }
        $consulta = $this->db->query('
            SELECT * FROM ' . $this->tabla1 . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');

        $contenido['archivo'] = strtolower($this->tool_general->limpiar_cadena($fila[$prefijo . 'cargo']));
        $contenido['titulo'] = $fila[$prefijo . 'cargo'];
        $contenido['campos_listar'] = $this->campos_listar;
        $contenido['campos_reales'] = $this->campos_reales;
        $contenido['datos'] = $datos;

        $this->load->view($this->carpeta . 'excel2', $contenido);
    }

    function index() {
        $consulta = $this->db->query('
        SELECT *
        FROM
        ' . $this->tabla1 . ' a, clientes c
        WHERE a.cli_id=c.cli_id and ' . $this->prefijo . 'hasta>="' . date('Y-m-d') . '"
        ORDER BY
        ' . $this->prefijo . 'tope asc, cli_nombre asc'
        );
        $datos = $consulta->result_array();

        $enlace = $this->controlador . 'index/pagina/';
        $contenido['datos'] = $datos;
        $contenido['enlace'] = $enlace;
        $contenido['cabecera'] = $this->cabecera;
        $data['contenido'] = $this->load->view($this->carpeta . 'index', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }
    //carpetas aws archivos/postulaciones/
    function folder($id=null) {
         
        //datos Aws  
        //crear carpeta
        $nombre_carpeta= 'archivos/postulaciones/'.$id.'/';
        $aws_bucket=$this->tool_entidad->aws_bucket();
        // var_dump($aws_bucket);exit();
        // $this->aws3->createFolder('elasticbeanstalk-us-east-2-676905610441',$nombre_carpeta);//crear carpeta vacia
        $this->aws3->createFolder($aws_bucket,$nombre_carpeta);//crear carpeta vacia

        // $map = $this->aws3->listFile('elasticbeanstalk-us-east-2-676905610441',$nombre_carpeta);
        $map = $this->aws3->listFile($aws_bucket,$nombre_carpeta);

        $aws_url=$this->tool_entidad->aws_url();
        // foreach ($map as $object) {
        //         echo $object['Key'] . "<br/>\n";
        //         // var_dump($object['key']);exit();
        //     }
        //     exit();
        
        $contenido['nombre_carpeta']=$id;  
        $contenido['lista']=$map;        
        // $contenido['bucket_url']='https://elasticbeanstalk-us-east-2-676905610441.s3.us-east-2.amazonaws.com/';
        $contenido['bucket_url']=$aws_url;
        //Fin de datos AWS

        $contenido['datos'] = '';
        $contenido['enlace'] = '';
        $contenido['cabecera'] = $this->cabecera;
        $data['contenido'] = $this->load->view($this->carpeta . 'listado_carpetas', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }


    public function upload()
    {           
       
            //parametros
            $nombre_carpeta= $this->input->post('nombre_carpeta');
            // $folder_name='archivos/cargos/'.$nombre_carpeta.'/';
            $folder_name='archivos/postulaciones/'.$nombre_carpeta.'/';

            //cambio de nombre            
            $filename = $_FILES['userfile']['name'];
            $name = pathinfo($filename, PATHINFO_FILENAME);
            // var_dump($name);exit();
            $extension = pathinfo($filename, PATHINFO_EXTENSION);// extension del archivo
            //adicion de la fecha al archivo
            $fecha_systema=date('Y-m-d');
            $nombre_archivo=$name.'_'.$fecha_systema.'.'.$extension;
            // var_dump($nombre_archivo);exit();
            //fin de cambio de nombre

            $aws_bucket=$this->tool_entidad->aws_bucket();
            $aws_url=$this->tool_entidad->aws_url();

            $folder_name = $folder_name.$nombre_archivo;
            // $url = $this->aws3->sendFile('elasticbeanstalk-us-east-2-676905610441',$_FILES['userfile'] ,$folder_name);    
            $url = $this->aws3->sendFile($aws_bucket,$_FILES['userfile'] ,$folder_name);    
            //$map = directory_map('./archivos/');
            $map = $this->aws3->listFile($aws_bucket,$folder_name);
            $data['lista']=$map;        
            $data['bucket_url']=$aws_url;
            redirect('Postulacion/folder/'.$nombre_carpeta.'/');            
    }

    public function descargar_zip()
    {
        $nombre_carpeta= $this->input->post('nombre_carpeta_descarga');
        $folder_name='archivos/postulaciones/'.$nombre_carpeta;
        $aws_bucket=$this->tool_entidad->aws_bucket();
        // $this->aws3->zipfile('elasticbeanstalk-us-east-2-676905610441',$folder_name);
        $this->aws3->zipfile($aws_bucket,$folder_name);
        
    }
    public function descargaZipSeleccionados()
    {   
        $archivos=$this->input->post('archivos');
        $nombre_carpeta= $this->input->post('carpeta_descarga');
        $folder_name='archivos/postulaciones/'.$nombre_carpeta;
        $aws_bucket=$this->tool_entidad->aws_bucket();
        if ($archivos!=null) {//en caso de null
            $this->aws3->zipfileSelected($aws_bucket,$folder_name,$archivos);
        }
        else{
            redirect('Postulacion/folder/'.$nombre_carpeta.'/');
        }
        
    }

    public function eliminar_archivos()
    {   

        $ruta_archivo=$this->input->get('archivo');
        $nombre_carpeta= $this->input->get('carpeta');  
        $aws_bucket=$this->tool_entidad->aws_bucket();
        //var_dump($ruta_archivo);exit();      
        $respuesta = $this->aws3->deleteFile($aws_bucket,$ruta_archivo);
        redirect('Postulacion/folder/'.$nombre_carpeta.'/');
    }
    //fin de carpetas aws archivos/postulaciones/

    //carpetas para postulantes
    function folder_postulante($id=null) {
        //datos Aws  
        //crear carpeta
        $consulta1 = $this->db->query("SELECT * from postulante WHERE pos_documento=$id")->result_array();
        // print_r($consulta1); exit();
        $aws_bucket=$this->tool_entidad->aws_bucket();
        $aws_url=$this->tool_entidad->aws_url();
        $nombre_carpeta= 'archivos/postulante/'.$id.'/';
        $this->aws3->createFolder($aws_bucket,$nombre_carpeta);//crear carpeta vacia

        $map = $this->aws3->listFile($aws_bucket,$nombre_carpeta);


        //var_dump($map['key']);exit();
        $contenido['fila_sup']=$consulta1[0];  
        $contenido['prefijo_pos']='pos_';  
        $contenido['nombre_carpeta']=$id;  
        $contenido['lista']=$map;        
        $contenido['bucket_url']=$aws_url;
        //Fin de datos AWS
        $this->cabecera['accion']='Carpeta postulante';
        $contenido['id'] = $id;
        $contenido['cabecera'] = $this->cabecera;
        $data['contenido'] = $this->load->view($this->carpeta . 'listCarpetaspostulante', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }
    
    function ver_evaluaciones($id=null) {
        $consulta1 = $this->db->query("SELECT * from postulante WHERE pos_documento=$id")->result_array();
        $pos_id = $consulta1[0]['pos_id'];
        $evaluaciones = $this->db->query("SELECT s.gru_id, s.seg_fecha_creacion, g.gru_nombre from zis_seguimiento s LEFT JOIN zis_grupo_evaluacion g ON s.gru_id=g.gru_id WHERE s.pos_id=$pos_id AND pla_id=1 ORDER BY s.seg_fecha_creacion desc")->result_array();        
        // print_r($data_eval);
        $name_carpetas=array();
        foreach($evaluaciones as $ev){
        // $cadena=$ev['gru_nombre'];
        // $cadena =str_replace(' ', '', $cadena);
        // $ev['nombre_carpeta']=$ev['gru_id'].$cadena;
        $ev['nombre_carpeta']=$ev['gru_id'];
        array_push($name_carpetas,$ev);
        }
        // print_r($name_carpetas);
        $contenido['fila_sup']=$consulta1[0];  
        $contenido['prefijo_pos']='pos_';  
        $contenido['lista']=$name_carpetas;
        $contenido['pos_id']=$pos_id;
        $contenido['id']=$id;
        $this->cabecera['accion']='Carpetas de Evaluaciones Postulante';
        $contenido['cabecera'] = $this->cabecera;
        $data['contenido'] = $this->load->view($this->carpeta . 'lista_carpetas_evaluaciones', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }


    public function uploadPostulante()
    {           
       
            //parametros
            $nombre_carpeta= $this->input->post('nombre_carpeta');            
            $folder_name='archivos/postulante/'.$nombre_carpeta.'/';

            $aws_bucket=$this->tool_entidad->aws_bucket();
            $aws_url=$this->tool_entidad->aws_url();
            //cambio de nombre            
            $filename = $_FILES['userfile']['name'];
            $name = pathinfo($filename, PATHINFO_FILENAME);
            // var_dump($name);exit();
            $extension = pathinfo($filename, PATHINFO_EXTENSION);// extension del archivo
            //adicion de la fecha al archivo
            $fecha_systema=date('Y-m-d');
            $nombre_archivo=$name.'_'.$fecha_systema.'.'.$extension;
            //var_dump($nombre_archivo);exit();
            //fin de cambio de nombre            


            $folder_name = $folder_name.$nombre_archivo;

            $url = $this->aws3->sendFile($aws_bucket,$_FILES['userfile'] ,$folder_name);    
            //$map = directory_map('./archivos/');
            $map = $this->aws3->listFile($aws_bucket,$folder_name);
            $data['lista']=$map;        
            $data['bucket_url']=$aws_url;
            redirect('Postulacion/folder_postulante/'.$nombre_carpeta.'/');            
    }

    public function downZiPostulante()
    {
        $nombre_carpeta= $this->input->post('nombre_carpeta_descarga');
        $folder_name='archivos/postulante/'.$nombre_carpeta;
        $aws_bucket=$this->tool_entidad->aws_bucket();
        
        $this->aws3->zipfile($aws_bucket,$folder_name);
        
    }
    public function downZipSeleccionados()
    {   
        $archivos=$this->input->post('archivos');
        $nombre_carpeta= $this->input->post('carpeta_descarga');
        $folder_name='archivos/postulante/'.$nombre_carpeta;
        $aws_bucket=$this->tool_entidad->aws_bucket();
        

        if ($archivos!=null) {//en caso de null
            $this->aws3->zipfileSelected($aws_bucket,$folder_name,$archivos);
        }
        else{
            redirect('Postulacion/folder_postulante/'.$nombre_carpeta.'/');
        }
        
    }

       public function eliminar_postulante()
    {   
        // $ruta_archivo=$this->input->post('archivo');
        // $nombre_carpeta= $this->input->post('carpeta');  
        // var_dump($ruta_archivo,$nombre_carpeta);exit();      
        // $respuesta = $this->aws3->deleteFile('elasticbeanstalk-us-east-2-676905610441',$ruta_archivo);
        // redirect('Postulacion/folder_postulante/'.$nombre_carpeta.'/');
        $aws_bucket=$this->tool_entidad->aws_bucket();
        
        $ruta_archivo=$this->input->get('archivo');
        $nombre_carpeta= $this->input->get('carpeta');  
        //var_dump($ruta_archivo);exit();      
        $respuesta = $this->aws3->deleteFile($aws_bucket,$ruta_archivo);
         redirect('Postulacion/folder_postulante/'.$nombre_carpeta.'/');



    }
    //fin de carpetas postulantes
    

    function historial() {
        $instancia[1] = 'EP';
        $instancia[2] = 'TP';
        $instancia[3] = 'Assesment';
        $instancia[4] = 'Entrevista';
        $instancia[5] = 'Finalista';
        $instancia[6] = 'Elegido';
        if ($this->pagina == date('Y'))
            $fecha_actual = $this->pagina . '-' . date('m-d');
        else
            $fecha_actual = $this->pagina . '-' . '12' . '-' . '31';
        $fecha_inicial = $this->pagina . '-' . '01' . '-' . '01';
        $consulta = $this->db->query('
        SELECT *
        FROM
        ' . $this->tabla1 . ' a, clientes c
        WHERE a.cli_id=c.cli_id and ' . $this->prefijo . 'hasta between "' . $fecha_inicial . '" and "' . $fecha_actual . '"
        ORDER BY
        ' . $this->prefijo . 'tope asc, cli_nombre asc'
        );
        $datos = $consulta->result_array();
        foreach ($datos as $num => $rows) {
            $tabla2 = '';
            $tabla3 = '';
            $tabla4 = '';
            $consulta = $this->db->query('
            SELECT concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as postulante, eta_instancia as instancia FROM etapas a, postulante b
            WHERE a.pos_id=b.pos_id and con_id=' . $rows['con_id'] . ' and eta_etapa="2"
            ORDER BY eta_etapa asc'
            );
            $etapa2 = $consulta->result_array();
            $consulta = $this->db->query('
            SELECT concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as postulante, eta_instancia as instancia FROM etapas a, postulante b
            WHERE a.pos_id=b.pos_id and con_id=' . $rows['con_id'] . ' and eta_etapa="3"
            ORDER BY eta_etapa asc'
            );
            $etapa3 = $consulta->result_array();
            $consulta = $this->db->query('
            SELECT concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as postulante, eta_instancia as instancia FROM etapas a, postulante b
            WHERE a.pos_id=b.pos_id and con_id=' . $rows['con_id'] . ' and eta_etapa="4"
            ORDER BY eta_etapa asc'
            );
            $etapa4 = $consulta->result_array();
            if ($etapa2) {
                $tabla2 = '<table align="center" width="100%">';
                foreach ($etapa2 as $etapa) {
                    $tabla2 .= '<tr><td>' . @$etapa['postulante'] . '</td><td>' . @$instancia[$etapa['instancia']] . '</td></tr>';
                }
                $tabla2 .= '</table>';
            }
            if ($etapa3) {
                $tabla3 = '<table align="center" width="100%">';
                foreach ($etapa3 as $etapa) {
                    $tabla3 .= '<tr><td>' . @$etapa['postulante'] . '</td><td>' . @$instancia[$etapa['instancia']] . '</td></tr>';
                }
                $tabla3 .= '</table>';
            }
            if ($etapa4) {
                $tabla4 = '<table align="center" width="100%">';
                foreach ($etapa4 as $etapa) {
                    $tabla4 .= '<tr><td>' . @$etapa['postulante'] . '</td><td>' . @$instancia[$etapa['instancia']] . '</td></tr>';
                }
                $tabla4 .= '</table>';
            }
            $datos[$num]['etapa2'] = $tabla2;
            $datos[$num]['etapa3'] = $tabla3;
            $datos[$num]['etapa4'] = $tabla4;
        }
        $enlace = $this->controlador . 'historial/pagina/';
        $contenido['datos'] = $datos;
        $contenido['enlace'] = $enlace;
        $contenido['cabecera'] = $this->cabecera;
        $data['contenido'] = $this->load->view($this->carpeta . 'historial', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function interno() {

        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
        $mensaje_validar_postulacion='';
        if ($this->input->post('cadena') || $this->input->post('profesion') || $this->input->post('ambito_exp1') || $this->input->post('ambito_exp2') || $this->input->post('ambito_exp3') || $this->input->post('area_exp') || $this->input->post('sector_exp') || $this->input->post('max_nivel') || $this->input->post('anios_exp') || $this->input->post('condicion')) {
            $cadena = $this->input->post('cadena');
            $profesion = $this->input->post('profesion');
            $criterio = $this->input->post('campob');
            $ambito_exp1 = $this->input->post('ambito_exp1');
            $ambito_exp2 = $this->input->post('ambito_exp2');
            $ambito_exp3 = $this->input->post('ambito_exp3');
            $area_exp = $this->input->post('area_exp');
            $sector_exp = $this->input->post('sector_exp');
            $max_nivel = $this->input->post('max_nivel');
            $anios_exp = $this->input->post('anios_exp');
            $condicion = $this->input->post('condicion');

        } elseif (@$uri['cadena'] || @$uri['profesion'] || @$uri['ambito_exp1'] || @$uri['ambito_exp2'] || @$uri['ambito_exp3'] || @$uri['area_exp'] || @$uri['sector_exp'] || @$uri['max_nivel'] || @$uri['anios_exp'] || @$uri['condicion']) {
            $cadena = $uri['cadena'];
            $profesion = @$uri['profesion'];
            $criterio = $uri['campob'];
            $ambito_exp1 = @$uri['ambito_exp1'];
            $ambito_exp2 = @$uri['ambito_exp2'];
            $ambito_exp3 = @$uri['ambito_exp3'];
            $area_exp = @$uri['area_exp'];
            $sector_exp = @$uri['sector_exp'];
            $max_nivel = @$uri['max_nivel'];
            $anios_exp = @$uri['anios_exp'];
            $condicion = @$uri['condicion'];
            $mensaje = 'Se han postulado a los elementos marcados';
            // $mensaje = '';
            $contenido['mensaje'] = $mensaje;
            // $mensaje_validar_postulacion='ya esta postuladoss';


        }
        if (@$cadena || @$profesion || @$ambito_exp1 || @$ambito_exp2 || @$ambito_exp3 || @$area_exp || @$sector_exp || @$max_nivel || @$anios_exp) {
            
            $prefijo = 'pos_';
            $campos_listar = array('Documento', 'Apellido Paterno', 'Apellido Materno', 'Nombres', 'Ciudad', 'Sexo', 'Fecha Nacimiento', 'Dirección', 'Teléfono', 'Celular', 'Email');
            $campos_reales = array($prefijo . 'documento', $prefijo . 'apaterno', $prefijo . 'amaterno', $prefijo . 'nombre', 'pai_nombre', $this->prefijoF . 'sexo', $this->prefijoF . 'fecha_nacimiento', $prefijo . 'direccion', $prefijo . 'telefono', $prefijo . 'celular', $prefijo . 'email');

            $query = 'SELECT
                        p.' . $prefijo . 'id,
                        ' . $prefijo . 'documento,
                        ' . $prefijo . 'apaterno,
                        ' . $prefijo . 'amaterno,
                        ' . $prefijo . 'nombre,
                        pai_nombre,
                        case ' . $this->prefijoF . 'sexo
                        when "1" then "Hombre"
                        when "2" then "Mujer"
                        end as ' . $this->prefijoF . 'sexo,
                        ' . $this->prefijoF . 'fecha_nacimiento,
                        ' . $prefijo . 'direccion,
                        ' . $prefijo . 'telefono,
                        ' . $prefijo . 'celular,
                        ' . $prefijo . 'email
                        FROM postulante p
                        INNER JOIN postulante_f pf
                        ON p.pos_id=pf.pos_id
                        INNER JOIN paises pa
            ON pf.ciu_id = pa.pai_id
                        WHERE  pof_estado="1" and pos_documento like "' . $cadena . '%"
                        ORDER BY pos_apaterno asc, pos_documento asc
                        ';
            $contenido['cadena'] = $cadena;

            //para ver si el postulante esta en otra postulacion
            $existePostulante = 'select p.pos_id from convocatoria_postulacion cp
                                        inner join postulante p
                                        on p.pos_id=cp.pos_id
                                            where con_id1=' . $id . ' and pos_documento like"' . $cadena . '%"';
            //consultar si el documento existe            
            $existeDocumento = $this->db->query("select p.pos_id from postulante p where pos_documento='$cadena'");
            $estadoPostulante = $this->db->query("SELECT pof_estado FROM postulante_f  f
JOIN
postulante p
on 
p.pos_id=f.pos_id
WHERE pos_documento='$cadena'");
            //var_dump($existePostulante);exit();
            $existe = $this->db->query($existePostulante);
            $result = $existe->result_array();
            //$mensaje_validar_postulacion='ya esta postulado';
            // if (!$result) {
            if ($existeDocumento->num_rows()==0 ) {
                
                $mensaje_validar_postulacion='El nro de Documento no existe';
                
            }else{
                $estadoPostulante=$estadoPostulante->result_array();
                if ($existe->num_rows()==0 && $estadoPostulante[0]['pof_estado']==1) {//por si no esta en la convocatoria
                    $consulta = $this->db->query($query);
                    $datos = $consulta->result_array();
                    // $mensaje_validar_postulacion='Se va a agregar al postulante';
                    $mensaje_validar_postulacion='';
                }else{
                    if (@$uri['bandera']==1) {
                        $mensaje_validar_postulacion='';
                    }
                    else{
                        if ($estadoPostulante[0]['pof_estado']!=1) {//no esta habilitado
                            $mensaje_validar_postulacion='El estado del Postulante es: no disponible';
                        }else{
                        $mensaje_validar_postulacion='El nro de Documento ya se encuentra entre los postulantes de esta convocatoria';
                        }
                    }
                }
            }

            
        }
        //var_dump($mensaje_validar_postulacion);exit();
        $prefijo = $this->prefijo;
        $consulta = $this->db->query('
            SELECT * FROM ' . $this->tabla1 . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $this->cabecera['titulo'] = $fila[$prefijo . 'cargo'];
        $this->cabecera['accion'] = 'Selección de Postulantes';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['action'] = $this->controlador . 'generar';
        $contenido['campos_listar'] = @$campos_listar;
        $contenido['campos_reales'] = @$campos_reales;
        $contenido['datos'] = @$datos;
        $contenido['fila'] = $fila;
        $contenido['criterio'] = @$criterio;
        $contenido['id'] = $id;
        $contenido['mensaje_validar_postulacion'] = $mensaje_validar_postulacion;
        $data['contenido'] = $this->load->view($this->carpeta . 'listar_interno', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function postular() {
        $uri = $this->uri->uri_to_assoc(3);
        $prefijo = 'pos_';
        $id = $uri['id'];
        $cadena = $this->input->post('cadena');
        $profesion = $this->input->post('profesion');
        $criterio = $this->input->post('campob');
        $ambito_exp1 = $this->input->post('ambito_exp1');
        $ambito_exp2 = $this->input->post('ambito_exp2');
        $ambito_exp3 = $this->input->post('ambito_exp3');
        $area_exp = $this->input->post('area_exp');
        $sector_exp = $this->input->post('sector_exp');
        $max_nivel = $this->input->post('max_nivel');
        $anios_exp = $this->input->post('anios_exp');
        $sintesis = $this->input->post('sintesis');
        $condicion = $this->input->post('condicion');
        $consulta = $this->db->query('
        SELECT *
        FROM
        convocatoria a, clientes c
        WHERE a.cli_id=c.cli_id and a.con_id=' . $id
        );
        $fila = $consulta->row_array();
        $consulta = $this->db->query('
                SELECT p.pos_id as id, concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as nombre, pos_documento as documento, pos_nro_postulaciones as nro
                FROM postulante p
                INNER JOIN postulante_f pf
                ON p.pos_id=pf.pos_id
                WHERE pof_estado="1"');
        $datos = $consulta->result_array();

        foreach ($datos as $filas) {
            $ckeck = $this->input->post('chk' . $filas['id']);
            if ($ckeck) {
                $this->db->query('UPDATE postulante SET pos_nro_postulaciones = ' . ($filas['nro'] + 1) . '  WHERE pos_id = ' . $filas['id'] . '  LIMIT 1');
                $this->db->query('INSERT INTO convocatoria_postulacion (pos_id,con_id1,con_fecha_creacion,con_fecha_edicion,con_disponibilidad)
                                          VALUES (' . $filas['id'] . ',' . $id . ', "' . date('Y-m-d H:i:s') . '", "' . date('Y-m-d H:i:s') . '",319)');
                $ids = $this->db->insert_id();
                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                $logs['log_tabla_id'] = 'convocatoria_postulacion - ' . $ids;
                $logs['log_modulo'] = 'Postulaciones';
                $logs['log_accion'] = 'Postular';
                $logs['log_fecha'] = date('Y-m-d H:i:s');
                $logs['log_comentario'] = 'Postuló a: "' . $filas['nombre'] . '" con Nº de Documento: "' . $filas['documento'] . '" al Cargo: "' . $fila['con_cargo'];
                $this->db->insert('logs_etiko', $logs);
            }
        }
        if ($cadena) {
            // var_dump('entro aca para insertar');exit();
            redirect($this->controlador . 'interno/cadena/' . $cadena . '/campob/1/id/' . $id.'/bandera/1');
            // entro a para insertar 

//            redirect($this->controlador . 'interno/cadena/' . $cadena . '/campob/' . $criterio . '/id/' . $id);
        } elseif ($sintesis) {
            $url = '';
            if ($ambito_exp1)
                $url .= '/ambito_exp1/' . $ambito_exp1;
            if ($ambito_exp2)
                $url .= '/ambito_exp2/' . $ambito_exp2;
            if ($ambito_exp3)
                $url .= '/ambito_exp3/' . $ambito_exp3;
            if ($area_exp)
                $url .= '/area_exp/' . $area_exp;
            if ($sector_exp)
                $url .= '/sector_exp/' . $sector_exp;
            if ($max_nivel)
                $url .= '/max_nivel/' . $max_nivel;
            if ($anios_exp)
                $url .= '/anios_exp/' . $anios_exp;
            if ($condicion)
                $url .= '/condicion/' . $condicion;
            redirect($this->controlador . 'interno' . $url . '/campob/' . $criterio . '/id/' . $id);
        }else {
            redirect($this->controlador . 'interno/profesion/' . $profesion . '/campob/' . $criterio . '/id/' . $id);
        }
        $this->cabecera['titulo'] = $fila[$prefijo . 'cargo'];
        $this->cabecera['accion'] = $etapa . 'º Etapa';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['id'] = $id;
        $data['contenido'] = $this->load->view($this->carpeta . 'mensaje_exito_etapas.php', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function listar() {
        $this->etapa = 1;
        if (@$this->definirform) {
            $this->definir_form_editar();
        } else {
            $this->definir_form_agregar();
        }
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
        $prefijo = $this->prefijo;
        $consulta = $this->db->query('
            SELECT * FROM ' . $this->tabla1 . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $this->cabecera['titulo'] = $fila[$prefijo . 'cargo'];
        $this->cabecera['accion'] = 'Generar Lista';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['action'] = $this->controlador . 'generar';
        $contenido['fila'] = $fila;
        $contenido['id'] = $id;
        $data['contenido'] = $this->load->view($this->carpeta . 'campos', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function generar() {
        $this->etapa = 1;
        $prefijo = $this->prefijo;
        $id = $this->input->post($prefijo . 'id');

        $datospersonales = $this->recuperarArray('datospersonales', 19);
        $newDatosPersonales = array();

        foreach ($datospersonales as $key => $value) {
            if ($key < 18) {
                $newDatosPersonales['datospersonales'][$key] = $value;
            } else {
                $newDatosPersonales['recomendacionObservacion'][$key] = $value;
            }
        }

        $educacionpostgrado = $this->recuperarArray('educacionpostgrado', 9);
        $educacionsuperior = $this->recuperarArray('educacionsuperior', 9);
        $educacionsecundaria = $this->recuperarArray('educacionsecundaria', 4);
        $publicacion = $this->recuperarArray('publicacion', 2);
        $trayectorialaboral = $this->recuperarArray('trayectorialaboral', 17);
        $sintesis = $this->recuperarArray('sintesis', 4);
//        $informacionadicional = $this->recuperarArray('informacionadicional', 4);
        $informacionadicional = $this->recuperarArray('informacionadicionalIngles', 4);
        $otros = $this->recuperarArray('otros', 1);
        if ($educacionpostgrado || $educacionpostgrado || $educacionsuperior || $educacionsecundaria || $publicacion || $trayectorialaboral || $sintesis || $informacionadicional || $otros)
            $sub_cabecera = 1;
//        if ($otros[3])
//            $datospersonales[18] = '1';
//        else
//            $datospersonales[18] = 0;
//        unset($otros[3]);

        $lista = @$this->cabecera($newDatosPersonales, $educacionpostgrado, $educacionsuperior, $educacionsecundaria, $publicacion, $trayectorialaboral, $sintesis, $informacionadicional, $otros, $id);
        $campos_listar = $lista[0];

        $campos_reales = $lista[1];
        $datos = $lista[2];

        $consulta = $this->db->query('
            SELECT * FROM ' . $this->tabla1 . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');
        if ($fila['con_etapa'] <= 0) {
            $update = array(
                $this->prefijo . 'etapa' => "1"
            );
            $this->db->update($this->tabla1, $update, array($this->prefijo . 'id' => $id));
        }
        $this->cabecera['titulo'] = $fila[$prefijo . 'cargo'];
        $this->cabecera['accion'] = 'Generar Lista';
        $contenido['cabecera'] = $this->cabecera;

        $contenido['campos_listar'] = $campos_listar;
        $contenido['sub_cabecera'] = $sub_cabecera;
        $contenido['campos_reales'] = $campos_reales;
        $contenido['datos'] = $datos;
        $contenido['id'] = $id;
        $data['contenido'] = $this->load->view($this->carpeta . 'reporte1', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function recuperarArray($nombre, $nro) {
        for ($i = 1; $i <= $nro; $i++) {
            if ($this->input->post($nombre . $i)) {
                $array[$i] = $this->input->post($nombre . $i);
            } else {
                $array[$i] = 0;
            }
        }
        return $array;
    }

    function cabecera($datospersonales, $educacionpostgrado, $educacionsuperior, $educacionsecundaria, $publicacion, $trayectorialaboral, $sintesis, $informacionadicional, $otros, $id) {

        $tabla = 'postulante';
        $tabla1 = 'educacion_post_grado';
        $tabla2 = 'educacion_superior';
        $tabla3 = 'educacion_secundaria';
        $tabla4 = 'publicaciones';
        $tabla5 = 'trayectoria_laboral';
        $tabla6 = 'idiomas';
        $tablaI = 'postulante_idioma';
        $tabla7 = 'etapas';
        $prefijo = 'pos_';
        $prefijo1 = $this->prefijo1;
        $prefijo2 = $this->prefijo2;
        $pos = 0;
        $pos1 = 0;
        $consulta = $this->db->query('SELECT cp.pos_id as id, pos_apaterno 
                FROM convocatoria_postulacion cp inner 
                join postulante p
                on p.pos_id=cp.pos_id
                join postulante_f f
                on f.pos_id=cp.pos_id
                WHERE  con_id1=' . $id . ' ORDER BY pos_apaterno');
        $nro_pos = $consulta->num_rows();
        $postulantes = $consulta->result_array();

        foreach ($datospersonales['datospersonales'] as $num => $fila) {
            if ($fila) {
                @$select .= $this->campos_datos_personales[$num - 1] . ',';
                $campos_cabecera[$pos] = $this->cabecera_datos_personales[$num - 1];
                $campos_reales[$pos] = $this->campos_datos_personales1[$num - 1];
                $pos++;
            }
        }
//        para agregar los campos de observacion y recomendacion en el select
        foreach ($datospersonales['recomendacionObservacion'] as $num => $fila) {
            if ($fila) {
                $select .= $this->campos_datos_personales[$num - 1] . ',';
            }
        }

        @$select = substr($select, 0, strlen($select) - 1);
        if ($educacionpostgrado) {
            $aux_edu = 0;
            foreach ($educacionpostgrado as $num => $fila) {
                if ($fila) {
                    @$select1 .= $this->campos_educacion_postgrado[$num - 1] . ',';
//                    $campos_cabecera_educacion_postgrado[$aux_edu] = $this->cabecera_educacion_postgrado[$num - 1];
                    $campos_educacion_postgrado[$aux_edu] = $this->campos_educacion_postgrado[$num - 1];
                    $aux_edu++;
                }
            }
//            $campos_cabecera_educacion_postgrado = array();
//            $campos_cabecera_educacion_postgrado[] = 'Nº';
//            for ($i = 1; $i <= 2; $i++) {
//                foreach ($educacionpostgrado as $key => $value) {
//                    if ($value) {
//                        $campos_cabecera_educacion_postgrado[] = $this->cabecera_educacion_postgrado[$key - 1] . " " . $i . "<br>";
//                    }
//                }
//            }

            $campos_cabecera_educacion_postgrado = array();
            $campos_cabecera_educacion_postgrado[] = 'Nº';
            $campos_cabecera_educacion_postgrado[] = 'Grado o Título 1';
            $campos_cabecera_educacion_postgrado[] = 'Área Postgrado 1';
            $campos_cabecera_educacion_postgrado[] = 'Grado o Título 2';
            $campos_cabecera_educacion_postgrado[] = 'Área Postgrado 2';
            @$select1 = substr($select1, 0, strlen($select1) - 1);
            if ($select1) {
                $campos_cabecera[$pos] = array(
                    'nombre' => 'Educación PostGrado',
                    'campos' => $campos_cabecera_educacion_postgrado
                );
                $campos_reales[$pos] = array(
                    'nombre' => 'educacion_postgrado',
                    'campos' => $campos_educacion_postgrado
                );
                $pos++;
            }
        }
        if ($educacionsuperior) {
            $aux_edu = 0;
            foreach ($educacionsuperior as $num => $fila) {
                if ($fila) {
                    @$select2 .= $this->campos_educacion_superior[$num - 1] . ',';
//                    $campos_cabecera_educacion_superior2[$aux_edu] = $this->cabecera_educacion_superior[$num - 1];
                    $campos_educacion_superior[$aux_edu] = $this->campos_educacion_superior[$num - 1];
                    $aux_edu++;
                }
            }
//            $campos_cabecera_educacion_superior = array();
//            $campos_cabecera_educacion_superior[] = 'Nº';
//            for ($i = 1; $i <= 2; $i++) {
//                foreach ($educacionsuperior as $key => $value) {
//                    if ($value) {
//                        $campos_cabecera_educacion_superior[] = $this->cabecera_educacion_superior[$key - 1] . " " . $i . "<br>";
//                    }
//                }
//            }
            $campos_cabecera_educacion_superior = array();
            $campos_cabecera_educacion_superior[] = 'Nº';
            $campos_cabecera_educacion_superior[] = 'Grado o Título 1';
            $campos_cabecera_educacion_superior[] = 'Área de Profesión 1';
            $campos_cabecera_educacion_superior[] = 'Grado o Título 2';
            $campos_cabecera_educacion_superior[] = 'Área de Profesión 2';
            @$select2 = substr($select2, 0, strlen($select2) - 1);
            if ($select2) {
                $campos_cabecera[$pos] = array(
                    'nombre' => 'Educación Superior',
                    'campos' => $campos_cabecera_educacion_superior
                );
                $campos_reales[$pos] = array(
                    'nombre' => 'educacion_superior',
                    'campos' => $campos_educacion_superior
                );
                $pos++;
            }
        }
        if ($educacionsecundaria) {
            $aux_edu = 0;
            foreach ($educacionsecundaria as $num => $fila) {
                if ($fila) {
                    $select3 .= $this->campos_educacion_secundaria[$num - 1] . ',';
                    $campos_cabecera_educacion_secundaria[$aux_edu] = $this->cabecera_educacion_secundaria[$num - 1];
                    $campos_educacion_secundaria[$aux_edu] = $this->campos_educacion_secundaria[$num - 1];
                    $aux_edu++;
                }
            }
            @$select3 = substr($select3, 0, strlen($select3) - 1);
            if ($select3) {
                $campos_cabecera[$pos] = array(
                    'nombre' => 'Educación Secundaria',
                    'campos' => $campos_cabecera_educacion_secundaria
                );
                $campos_reales[$pos] = array(
                    'nombre' => 'educacion_secundaria',
                    'campos' => $campos_educacion_secundaria
                );
                $pos++;
            }
        }
        if ($publicacion) {
            $aux_edu = 0;
            foreach ($publicacion as $num => $fila) {
                if ($fila) {
                    $select4 .= $this->campos_publicacion[$num - 1] . ',';
                    $campos_cabecera_publicacion[$aux_edu] = $this->cabecera_publicacion[$num - 1];
                    $campos_publicacion[$aux_edu] = $this->campos_publicacion[$num - 1];
                    $aux_edu++;
                }
            }
            @$select4 = substr($select4, 0, strlen($select4) - 1);
            if ($select4) {
                $campos_cabecera[$pos] = array(
                    'nombre' => 'Publicaciones',
                    'campos' => $campos_cabecera_publicacion
                );
                $campos_reales[$pos] = array(
                    'nombre' => 'publicacion',
                    'campos' => $campos_publicacion
                );
                $pos++;
            }
        }

        if ($sintesis) {
            $aux_sin = 0;
            foreach ($sintesis as $num => $fila) {
                if ($fila) {
                    @$select6 .= $this->campos_sintesis[$num - 1] . ',';
                    $campos_cabecera_sintesis[$aux_sin] = $this->cabecera_sintesis[$num - 1];
                    $campos_sintesis[$aux_sin] = $this->campos_sintesis[$num - 1];
                    $aux_sin++;
                }
            }
            @$select6 = substr($select6, 0, strlen($select6) - 1);
            if ($select6) {
                $campos_cabecera[$pos] = array(
                    'nombre' => 'Síntesis Exp. Laboral',
                    'campos' => $campos_cabecera_sintesis
                );
                $campos_reales[$pos] = array(
                    'nombre' => 'sintesis',
                    'campos' => $campos_sintesis
                );
                $pos++;
            }
        }
        if ($trayectorialaboral) {
            $aux_edu = 0;
            foreach ($trayectorialaboral as $num => $fila) {
                if ($fila) {
                    @$select5 .= $this->campos_trayectoria1[$num - 1] . ',';
                    $campos_cabecera_trayectoria[$aux_edu] = $this->cabecera_trayectoria[$num - 1];
                    $campos_trayectoria[$aux_edu] = $this->campos_trayectoria[$num - 1];
                    $aux_edu++;
                }
            }
            @$select5 = substr($select5, 0, strlen($select5) - 1);
            if ($select5) {
                $campos_cabecera[$pos] = array(
                    'nombre' => 'Experiencia Laboral',
                    'campos' => $campos_cabecera_trayectoria
                );
                $campos_reales[$pos] = array(
                    'nombre' => 'trayectoria',
                    'campos' => $campos_trayectoria
                );
                $pos++;
            }
        }

        if ($informacionadicional) {
            $aux_edu = 0;
            foreach ($informacionadicional as $num => $fila) {
                if ($fila) {
                    @$select7 .= $this->campos_informacion_adicional[$num - 1] . ',';
                    $campos_cabecera_informacion_adicional[$aux_edu] = $this->cabecera_informacion_adicional[$num - 1];
                    $campos_informacion_adicional[$aux_edu] = $this->campos_informacion_adicional[$num - 1];
                    $aux_edu++;
                }
            }
            @$select7 = substr($select7, 0, strlen($select7) - 1);
            if ($select7) {
                $campos_cabecera[$pos] = array(
                    'nombre' => 'Idioma Ingles',
                    'campos' => $campos_cabecera_informacion_adicional
                );
                $campos_reales[$pos] = array(
                    'nombre' => 'informacion',
                    'campos' => $campos_informacion_adicional
                );
                $pos++;
            }
        }
        if ($otros) {
            $aux_otro = 0;

            foreach ($otros as $num => $fila) {
                if ($fila) {
                    @$select8 .= $this->campos_otros[$num - 1] . ',';
                    $campos_cabecera_otros[$aux_otro] = $this->cabecera_otros[$num - 1];
                    $campos_otros[$aux_otro] = $this->campos_otros[$num - 1];
                    $aux_otro++;
                }
            }

            foreach ($this->cabecera_otros as $key => $value) {
                $campos_cabecera_otros[$key] = $value;
            }
            foreach ($this->campos_otros as $key => $value) {
                $campos_otros[$key] = $value;
            }
//            para agregar los campos de observacion y recomendacion antes de las postulaciones
            foreach ($datospersonales['recomendacionObservacion'] as $num => $fila) {
                if ($fila) {
                    $campos_cabecera[$pos] = $this->cabecera_datos_personales[$num - 1];
                    $campos_reales[$pos] = $this->campos_datos_personales1[$num - 1];
                    $pos++;
                }
            }

            $campos_cabecera[$pos] = 'Nº Postulaciones';
            $campos_reales[$pos] = 'pos_nro_postulaciones';
            $pos++;
            @$select8 = substr($select8, 0, strlen($select8) - 1);
            if ($select8) {
                $campos_cabecera[$pos] = array(
                    'nombre' => 'Ultima Postulación',
                    'campos' => $campos_cabecera_otros
                );
                $campos_reales[$pos] = array(
                    'nombre' => 'ultima',
                    'campos' => $campos_otros
                );
                $pos++;
                $campos_cabecera[$pos] = array(
                    'nombre' => 'Penúltima Postulación',
                    'campos' => $campos_cabecera_otros
                );
                $campos_reales[$pos] = array(
                    'nombre' => 'penultima',
                    'campos' => $campos_otros
                );
                $pos++;
                $campos_cabecera[$pos] = array(
                    'nombre' => 'Ante penúltima Postulación',
                    'campos' => $campos_cabecera_otros
                );
                $campos_reales[$pos] = array(
                    'nombre' => 'antepenultima',
                    'campos' => $campos_otros
                );
                $pos++;
            }
        }

        foreach ($postulantes as $postulante) {
            $nro = 0;
            $tabla_edu_post = '';

            $consulta = $this->db->query('SELECT ' . $select . ',pos_nro_postulaciones,pa.pai_nombre as pais,ci.pai_nombre as ciudad FROM ' . $tabla . ' p
                    INNER JOIN ' . $this->tablaF . ' pf ON p.pos_id= pf.pos_id
                    INNER JOIN paises pa ON pa.pai_id= pf.pai_id
                    INNER JOIN paises ci ON pf.ciu_id=ci.pai_id
                    WHERE p.' . $prefijo . 'id=' . $postulante['id']);
            $datos = $consulta->row_array();

            if (@$datos['pof_recomendacion'])
                $datos['pof_recomendacion'] = $this->recomendaciones[$datos['pof_recomendacion']];
            else
                $datos['pof_recomendacion'] = 'No tiene Ninguna Recomendación';
            $campos_datos[$pos1] = $datos;
            if ($select1) {
                $tabla_edu_post = array();
//echo 'SELECT ' . $select1 . ' FROM ' . $tabla1 . ' ep
//                                    INNER JOIN combos cb
//                                     on ep.edu_grado=cb.com_id                         
//                                WHERE ' . $prefijo . 'id=' . $postulante['id'] . ' order by com_orden desc <br/>';
                $consulta = $this->db->query('SELECT ' . $select1 . ' FROM ' . $tabla1 . ' ep
                                    INNER JOIN combos cb
                                     on ep.edu_grado=cb.com_id                         
                                WHERE ' . $prefijo . 'id=' . $postulante['id'] . ' order by com_orden asc ');

                $datos = $consulta->result_array();

                if ($datos) {
                    $tabla_edu_post = $this->armarTabla($campos_cabecera_educacion_postgrado, $campos_educacion_postgrado, $datos, 1);
                }

                $campos_datos[$pos1]['educacion_postgrado'] = $tabla_edu_post;
                $nro = count($datos);
            }
            if ($select2) {
                $tabla_edu_sup = array();

                $consulta = $this->db->query('SELECT ' . $select2 . ' FROM ' . $tabla2 . ' es 
                            INNER JOIN combos cb
                            on es.edu_grado=cb.com_id
                        WHERE ' . $prefijo . 'id=' . $postulante['id'] . ' order by com_orden asc limit 10');
                $datos = $consulta->result_array();
                if ($datos) {
                    $tabla_edu_sup = $this->armarTabla($campos_cabecera_educacion_superior, $campos_educacion_superior, $datos, 2);
                }
                $campos_datos[$pos1]['educacion_superior'] = $tabla_edu_sup;
                if ($nro) {
                    if (count($datos) > $nro)
                        $nro = count($datos);
                }else {
                    $nro = count($datos);
                }
            }
            if ($select3) {
                $tabla_edu_sec = '';
                $consulta = $this->db->query('SELECT ' . $select3 . ' FROM ' . $tabla3 . ' WHERE ' . $prefijo . 'id=' . $postulante['id']);
                $datos = $consulta->result_array();
                $campos_datos[$pos1]['educacion_secundaria'] = $datos;
                if ($nro) {
                    if (count($datos) > $nro)
                        $nro = count($datos);
                }else {
                    $nro = count($datos);
                }
            }
            if ($select4) {
                $tabla_pub = '';
                $consulta = $this->db->query('SELECT ' . $select4 . ' FROM ' . $tabla4 . ' WHERE ' . $prefijo . 'id=' . $postulante['id']);
                $datos = $consulta->result_array();
                $campos_datos[$pos1]['publicacion'] = $datos;
                if ($nro) {
                    if (count($datos) > $nro)
                        $nro = count($datos);
                }else {
                    $nro = count($datos);
                }
            }
            if ($select5) {
                $tabla_tra = '';
                $consulta = $this->db->query('SELECT *,' . $select5 . ' FROM ' . $tabla5 . ' WHERE ' . $prefijo . 'id=' . $postulante['id'] . ' order by tra_hasta desc');
                $datos = $consulta->result_array();
                if ($datos) {
                    $tabla_tra = @$this->armarTabla($campos_cabecera_trayectoria, $campos_trayectoria, $datos, 3);
                }
                $campos_datos[$pos1]['trayectoria'] = $tabla_tra;
                if ($nro) {
                    if (count($datos) > $nro)
                        $nro = count($datos);
                }else {
                    $nro = count($datos);
                }
            }
            if ($select6) {
                $tabla_sin = '';
//                echo 'SELECT * FROM ' . $tabla . ' p INNER JOIN postulante_f pf ON p.' . $prefijo . 'id=pf.' . $prefijo . 'id WHERE p.' . $prefijo . 'id=' . $postulante['id'];
//                $consulta = $this->db->query('SELECT * FROM ' . $tabla . ' WHERE ' . $prefijo . 'id=' . $postulante['id']);
                $consulta = $this->db->query('SELECT * FROM ' . $tabla . ' p INNER JOIN postulante_f pf ON p.' . $prefijo . 'id=pf.' . $prefijo . 'id WHERE p.' . $prefijo . 'id=' . $postulante['id']);
                $datos = $consulta->row_array();

                if ($datos) {
                    $tabla_sin = $this->armarTabla($campos_cabecera_sintesis, $campos_sintesis, $datos, 4);
                }
                $campos_datos[$pos1]['sintesis'] = $tabla_sin;
            }
            if ($select7) {
                $tabla_inf = '';

                $consulta = $this->db->query('SELECT ' . $select7 . ' FROM ' . $tablaI . ' p
                    INNER JOIN idiomas i ON p.idi_id=i.idi_id
                         WHERE ' . $prefijo . 'id=' . $postulante['id'] . ' and p.idi_id=1');
                $datos = $consulta->result_array();
                if ($datos) {
                    $tabla_inf = $this->armarTabla($campos_cabecera_informacion_adicional, $campos_informacion_adicional, $datos, 5);
                }
                $campos_datos[$pos1]['informacion'] = $tabla_inf;
                if ($nro) {
                    if (count($datos) > $nro)
                        $nro = count($datos);
                }else {
                    $nro = count($datos);
                }
            }

            if ($select8) {
                $tabla_otros = '';
//                echo 'SELECT * FROM ' . $tabla7 . ' WHERE con_id!=' . $id . ' and ' . $prefijo . 'id=' . $postulante['id'] . ' order by eta_fecha_creacion asc LIMIT 3';
//                $consulta = $this->db->query('SELECT * FROM ' . $tabla7 . ' WHERE ' . $prefijo . 'id=' . $postulante['id'] . ' order by eta_fecha_creacion asc LIMIT 3');
                $consultaPostulaciones = $this->db->query('select
                                                 con_cargo as cargo,
                                                 cli_nombre as cliente,
                                                 eta_instancia as instancia 
                                            from convocatoria_postulacion cp
                                                inner join convocatoria c
                                                    on c.con_id=cp.con_id1
                                                inner join clientes cl
                                                    on cl.cli_id=c.cli_id
                                                inner join etapas e
                                                    on e.con_id=c.con_id
                                                        where c.con_id!=' . $id . ' and cp.pos_id=' . $postulante['id'] . ' 
                                                            group by cp.con_id
                                                    order by cp.con_fecha_creacion desc limit 3');
                $ultimasPostulaciones = $consultaPostulaciones->result_array();
                $datos = $consulta->result_array();
                $tabla_otros = $this->armarTabla($campos_cabecera_otros, $campos_otros, $ultimasPostulaciones, 6);

                $campos_datos[$pos1]['postulaciones'] = $tabla_otros;
                if ($nro) {
                    if (count($datos) > $nro)
                        $nro = count($datos);
                }else {
                    $nro = count($datos);
                }
            }
            $campos_datos[$pos1]['nro'] = $nro;
            $pos1++;
        }

        $array[0] = $campos_cabecera;
        $array[1] = $campos_reales;
        $array[2] = $campos_datos;
        return $array;
    }

    function armarTabla($cabecera, $campos, $datos, $tipo = '') {
        switch ($tipo) {
            case 1:
                if ($datos) {
                    foreach ($datos as $num => $fila) {
                        for ($i = 0; $i < count($campos); $i++) {
                            switch ($campos[$i]) {
                                case $this->prefijo1 . 'titulado':
                                    if ($fila[strtolower($campos[$i])] == 1) {
                                        $datos[$num][strtolower($campos[$i])] = 'SI&nbsp;';
                                    } else {
                                        $datos[$num][strtolower($campos[$i])] = 'NO&nbsp;';
                                    }
                                    break;
                                case $this->prefijo1 . 'grado':
                                    $datos[$num][strtolower($campos[$i])] = $this->grados[$fila[$this->prefijo1 . 'grado']];
                                    break;
                            }
                        }
                    }
                }
                break;
            case 2:
                if ($datos) {
                    foreach ($datos as $num => $fila) {
                        for ($i = 0; $i < count($campos); $i++) {
                            switch ($campos[$i]) {
                                case $this->prefijo1 . 'titulado':
                                    if ($fila[strtolower($campos[$i])] == 1) {
                                        $datos[$num][strtolower($campos[$i])] = 'SI&nbsp;';
                                    } else {
                                        $datos[$num][strtolower($campos[$i])] = 'NO&nbsp;';
                                    }
                                    break;
                                case $this->prefijo1 . 'grado':
                                    $datos[$num][strtolower($campos[$i])] = $this->grados_sup[$fila[$this->prefijo1 . 'grado']];
                                    break;
                                case $this->prefijo1 . 'area':
                                    $datos[$num][strtolower($campos[$i])] = $this->area_pro[$fila[$this->prefijo1 . 'area']];
                                    break;
                            }
                        }
                    }
                }
                break;
            case 3:
                if ($datos) {
                    foreach ($datos as $num => $fila) {
                        $tiempo = '';
                        for ($i = 0; $i < count($campos); $i++) {
                            switch ($campos[$i]) {
                                case $this->prefijo3 . 'tipo_org':
                                    $datos[$num][strtolower($campos[$i])] = $this->tipo_org[$fila[$this->prefijo3 . 'tipo_org']];
                                    break;
                                case $this->prefijo3 . 'anio_mes':
                                    $meses = $fila[$this->prefijo3 . 'anio_mes'];
                                    if ($meses) {
                                        if (intval($meses / 12))
                                            $tiempo .= intval($meses / 12) . ' Años';
                                        if ($meses % 12)
                                            $tiempo .= ' ' . ($meses % 12) . ' Meses';
                                    }
                                    $datos[$num][strtolower($campos[$i])] = $tiempo;
                                    break;
                                case $this->prefijo3 . 'actual':
                                    if ($fila[$this->prefijo3 . 'actual'])
                                        $datos[$num][strtolower($campos[$i])] = 'SI&nbsp;';
                                    else
                                        $datos[$num][strtolower($campos[$i])] = 'NO&nbsp;';
                                    break;
                            }
                        }
                    }
                }
                break;
            case 4:
                $prefijo = 'pof_';
                if ($datos) {
                    for ($i = 0; $i < count($campos); $i++) {
                        switch ($campos[$i]) {
                            case $prefijo . 'ambito_exp':
                                $tabla = '';
                                if (preg_match('/1/', $datos[strtolower($campos[$i])])) {
                                    $tabla .= 'Empresa Privada<br/>';
                                }
                                if (preg_match('/2/', $datos[strtolower($campos[$i])])) {
                                    $tabla .= 'Empresa Publica<br/>';
                                }
                                if (preg_match('/3/', $datos[strtolower($campos[$i])])) {
                                    $tabla .= 'Cooperación para el Desarrollo<br/>';
                                }
                                $datos1[0][strtolower($campos[$i])] = $tabla;
                                break;
                            case $prefijo . 'area_exp':
                                $experienciaArray = explode(',', $datos[$prefijo . 'area_exp']);
                                $nombreArea = array();
                                foreach ($experienciaArray as $key => $value) {
                                    $nombreArea[] = @$this->area_exp[$value];
                                }
                                $datos1[0][strtolower($campos[$i])] = implode('<br>', $nombreArea);
                                break;
                            case $prefijo . 'sector_exp':
                                $sectorArray = explode(',', $datos[$prefijo . 'sector_exp']);
                                $nombreSector = array();
                                foreach ($sectorArray as $key => $value) {
                                    $nombreSector[] = @$this->sector_exp[$value];
                                }
                                $datos1[0][strtolower($campos[$i])] = implode('<br>', $nombreSector);
                                break;
                            case $prefijo . 'supervisar_exp':
                                if ($datos[strtolower($campos[$i])] == 'si') {
                                    $nivel = $this->nivel_alcanzado[$datos[$prefijo . 'max_nivel']];
                                    $tabla = 'Si<br/>Max. nivel alcanzado: <b>' . $nivel . '</b><br/>Años de Experiencia en supervición: <b>' . $datos[$prefijo . 'anios_exp'] . '</b>';
                                } else {
                                    $nivelNo = @$this->nivel_alcanzado_no[$datos[$prefijo . 'max_nivel_no']] . "<br>";
//                                    $tabla = 'No';
                                    $tabla = 'No<br/>En No Supervisión: <b>' . $nivelNo . '</b>';
                                }
                                $datos1[0][strtolower($campos[$i])] = $tabla;
                                break;
                        }
                    }
                    unset($datos);
                    $datos = $datos1;
                }
                break;
            case 5:
                if ($datos) {
                    foreach ($datos as $num => $fila) {
                        for ($i = 0; $i < count($campos); $i++) {
                            switch ($campos[$i]) {
                                case $this->prefijoI . 'habla':
                                    if ($fila[strtolower($campos[$i])] == 1)
                                        $datos[$num][strtolower($campos[$i])] = 'Excelente&nbsp;';
                                    if ($fila[strtolower($campos[$i])] == 2)
                                        $datos[$num][strtolower($campos[$i])] = 'Muy bueno&nbsp;';
                                    if ($fila[strtolower($campos[$i])] == 3)
                                        $datos[$num][strtolower($campos[$i])] = 'Regular&nbsp;';
                                    if ($fila[strtolower($campos[$i])] == 4)
                                        $datos[$num][strtolower($campos[$i])] = 'Basico&nbsp;';
                                    break;
                                case $this->prefijoI . 'lee':
                                    if ($fila[strtolower($campos[$i])] == 1)
                                        $datos[$num][strtolower($campos[$i])] = 'Excelente&nbsp;';
                                    if ($fila[strtolower($campos[$i])] == 2)
                                        $datos[$num][strtolower($campos[$i])] = 'Muy bueno&nbsp;';
                                    if ($fila[strtolower($campos[$i])] == 3)
                                        $datos[$num][strtolower($campos[$i])] = 'Regular&nbsp;';
                                    if ($fila[strtolower($campos[$i])] == 4)
                                        $datos[$num][strtolower($campos[$i])] = 'Basico&nbsp;';
                                    break;
                                case $this->prefijoI . 'escribe':
                                    if ($fila[strtolower($campos[$i])] == 1)
                                        $datos[$num][strtolower($campos[$i])] = 'Excelente&nbsp;';
                                    if ($fila[strtolower($campos[$i])] == 2)
                                        $datos[$num][strtolower($campos[$i])] = 'Muy bueno&nbsp;';
                                    if ($fila[strtolower($campos[$i])] == 3)
                                        $datos[$num][strtolower($campos[$i])] = 'Regular&nbsp;';
                                    if ($fila[strtolower($campos[$i])] == 4)
                                        $datos[$num][strtolower($campos[$i])] = 'Basico&nbsp;';
                                    break;
                            }
                        }
                    }
                }
                break;
            case 6:
                $arrayHead = array();
                $arrayHead[] = 'ultima';
                $arrayHead[] = 'penultima';
                $arrayHead[] = 'antepenultima';
                $convocatoriaVacio = array('cliente' => '', 'cargo' => '', 'instancia' => '');
                if ($datos) {
                    $numElementos = 3 - count($datos);
                    $i = 0;
                    $newDatos = array();
                    $newDatos = $datos;
                    $datos = array();
                    foreach ($newDatos as $num => $fila) {
//                        for ($i = 0; $i < 3; $i++) {
                        $instancia[1] = 'EP';
                        $instancia[2] = 'TP';
                        $instancia[3] = 'Assesment';
                        $instancia[4] = 'Entrevista';
                        $instancia[5] = 'Finalista';
                        $instancia[6] = 'Elegido';
                        $etapaInstancia = $instancia[$fila['instancia']];
//                        $etapaInstancia = $instancia[$fila['eta_instancia']];
//                        $consulta = $this->db->query('
//                                    SELECT c.cli_nombre as cliente, a.con_cargo as cargo
//                                    FROM convocatoria a, clientes c
//                                    WHERE a.cli_id=c.cli_id and a.con_id = ' . $fila['con_id']);
//                        $convocatoria = $consulta->row_array();
//                        $arrayDatos = array();
//                        $convocatoria['instancia'] = $etapaInstancia;
//                        $datos[$arrayHead[$i]] = $convocatoria;
                        $fila['instancia'] = $etapaInstancia;
                        $datos[$arrayHead[$i]] = $fila;
                        $i = $i + 1;
                    }
                    if ($numElementos > 0) {
                        for ($j = $i; $j < 3; $j++) {
                            $datos[$arrayHead[$j]] = $convocatoriaVacio;
                        }
                    }
                } else {
                    for ($j = 0; $j < 3; $j++) {
                        $datos[$arrayHead[$j]] = $convocatoriaVacio;
                    }
                }
                break;
        }
        return $datos;
    }

    function ccv() {
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
        $etapa = $uri['etapa'];
        $this->etapa = $etapa;
        $prefijo = $this->prefijo;
        $prefijo1 = 'pos_';
        $campos_listar = array('Apellido Paterno', 'Nombres', 'Documento', 'Ciudad', 'Teléfono', 'Celular', 'Email', 'Pretensión Salarial Referencial(Bs)', 'Disponibilidad');
        $campos_reales = array($prefijo1 . 'apaterno', $prefijo1 . 'nombre', $prefijo1 . 'documento', 'ciudad', $prefijo1 . 'telefono', $prefijo1 . 'celular', $prefijo1 . 'email', $prefijo1 . 'salario', 'disponibilidad');
        $consulta = $this->db->query('
        SELECT *
        FROM
        convocatoria a, clientes c
        WHERE a.cli_id=c.cli_id and a.con_id=' . $id
        );
        $fila = $consulta->row_array();
        if ($etapa < 4) {
            if ($etapa == 2)
                $consulta = $this->db->query('SELECT * FROM notificaciones WHERE not_id=1');
            elseif ($etapa == 3)
                $consulta = $this->db->query('SELECT * FROM notificaciones WHERE not_id=3');
            $notificacion = $consulta->row_array();
            $contenido['notificacion'] = $notificacion;
        }
        if ($etapa >= 3) {
            $this->cabecera['accion'] = $etapa . 'º Etapa';
            if ($etapa == 3) {
                $instancia[0] = 'CCV';
                $instancia[1] = 'EP';
                $instancia[2] = 'TP';
                $instancia[3] = 'Assesment';
            } elseif ($etapa == 4) {
                $instancia[1] = 'EP';
                $instancia[2] = 'TP';
                $instancia[3] = 'Assesment';
                $instancia[4] = 'Entrevista';
                $instancia[5] = 'Finalista';
                $instancia[6] = 'Elegido';
            }
            $consulta = $this->db->query('
            SELECT
            a.eta_id as id,
            a.eta_instancia as instancia,
            pf.pof_recomendacion as recomendacion,
            b.pos_observacion as observacionp,
            ' . $prefijo1 . 'documento,
            ' . $this->prefijoF . 'salario as pos_salario,
            case ' . $prefijo1 . 'tipodoc
            when "1" then "C.I."
            when "2" then "Pasaporte"
            end as ' . $prefijo1 . 'tipodoc,
            ' . $prefijo1 . 'apaterno,
            ' . $prefijo1 . 'amaterno,
            ' . $prefijo1 . 'nombre,
            IF(pf.ciu_id = 156, pf.pof_pais_ciudad,ci.pai_nombre) as ciudad,
            ' . $prefijo1 . 'direccion,
            ' . $prefijo1 . 'telefono,
            ' . $prefijo1 . 'celular,
            ' . $prefijo1 . 'email,
            com_nombre as disponibilidad
            FROM etapas a
            INNER JOIN postulante b
            ON   a.pos_id=b.pos_id
            INNER JOIN postulante_f pf 
            ON b.pos_id=pf.pos_id
            INNER JOIN paises ci
            ON pf.ciu_id=ci.pai_id
            INNER JOIN convocatoria_postulacion cp
            ON a.con_id=cp.con_id1
            INNER JOIN combos cb
            ON cb.com_id=cp.con_disponibilidad
            WHERE a.con_id=' . $id . ' and a.eta_etapa="' . $etapa . '"
            GROUP BY a.eta_id ORDER BY pos_apaterno asc, pos_tipodoc asc, pos_documento asc');
//            $consulta = $this->db->query('
//            SELECT
//            a.eta_id as id,
//            a.eta_observacion as observacion,
//            a.eta_instancia as instancia,
//            b.pos_recomendacion as recomendacion,
//            b.pos_observacion as observacionp,
//            ' . $prefijo1 . 'documento,
//            ' . $prefijo1 . 'salario,
//            case ' . $prefijo1 . 'tipodoc
//            when "1" then "C.I."
//            when "2" then "Pasaporte"
//            end as ' . $prefijo1 . 'tipodoc,
//            ' . $prefijo1 . 'apaterno,
//            ' . $prefijo1 . 'amaterno,
//            ' . $prefijo1 . 'nombre,
//            ' . $prefijo1 . 'ciudad,
//            ' . $prefijo1 . 'direccion,
//            ' . $prefijo1 . 'telefono,
//            ' . $prefijo1 . 'celular,
//            ' . $prefijo1 . 'email
//            FROM etapas a, postulante b
//            WHERE a.pos_id=b.pos_id and con_id=' . $id . ' and a.eta_etapa="' . $etapa . '"
//            ORDER BY pos_apaterno asc, pos_tipodoc asc, pos_documento asc');
            $datos = $consulta->result_array();
        } else {
            $this->cabecera['accion'] = '2º Etapa';
            $instancia[0] = 'CCV';
            $instancia[7] = 'Espera';
            $instancia[1] = 'EP';
            $instancia[2] = 'TP';

            $consulta = $this->db->query('
            SELECT
            a.pos_id as postulante, a.con_id1 as convocatoria, a.con_espera as espera,
            pf.pof_recomendacion as recomendacion,
            b.pos_observacion as observacionp,
            a.con_id as id,
            ' . $prefijo1 . 'documento,
            ' . $this->prefijoF . 'salario as pos_salario,
            case ' . $prefijo1 . 'tipodoc
            when "1" then "C.I."
            when "2" then "Pasaporte"
            end as ' . $prefijo1 . 'tipodoc,
            ' . $prefijo1 . 'apaterno,
            ' . $prefijo1 . 'amaterno,
            ' . $prefijo1 . 'nombre,
            IF(pf.ciu_id = 156, pf.pof_pais_ciudad,ci.pai_nombre) as ciudad,
            ' . $prefijo1 . 'direccion,
            ' . $prefijo1 . 'telefono,
            ' . $prefijo1 . 'celular,
            ' . $prefijo1 . 'email,
            com_nombre as disponibilidad
           FROM convocatoria_postulacion a
            INNER JOIN postulante b 
            ON a.pos_id=b.pos_id
            INNER JOIN postulante_f pf 
            ON b.pos_id=pf.pos_id
            INNER JOIN paises ci 
            ON pf.ciu_id=ci.pai_id
            INNER JOIN combos as cb
            ON cb.com_id=a.con_disponibilidad
            WHERE con_id1=' . $id . '
            ORDER BY pos_apaterno asc, pos_tipodoc asc, pos_documento asc');

            $datos = $consulta->result_array();
            $consulta = $this->db->query('
                SELECT pos_id as postulante, con_id as convocatoria
                FROM etapas
                WHERE con_id=' . $id);
            $etapas = $consulta->result_array();
            foreach ($datos as $numero => $filas) {
                foreach ($etapas as $rows) {
                    if ($rows['postulante'] == $filas['postulante'] && $rows['convocatoria'] == $filas['convocatoria']) {
                        unset($datos[$numero]);
                    }
                }
            }
        }

        $this->cabecera['titulo'] = $fila[$prefijo . 'cargo'];
        $contenido['cabecera'] = $this->cabecera;
        $contenido['campos_listar'] = $campos_listar;
        $contenido['campos_reales'] = $campos_reales;
        $contenido['action'] = $this->controlador . 'agregar_ccv/etapa/' . $etapa;
        $contenido['datos'] = $datos;
        $contenido['instancia'] = $instancia;
        $contenido['id'] = $id;
        $contenido['etapa'] = $etapa;
        $data['contenido'] = $this->load->view($this->carpeta . 'listar_ccv', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function agregar_ccv() {
        $uri = $this->uri->uri_to_assoc(3);
        $etapa = $uri['etapa'];
        $this->etapa = $etapa;
        $prefijo = $this->prefijo;
        $prefijo1 = 'pos_';
        $id = $this->input->post('id');
        $consulta = $this->db->query('
        SELECT *
        FROM
        convocatoria a, clientes c
        WHERE a.cli_id=c.cli_id and a.con_id=' . $id
        );
        $fila = $consulta->row_array();
        if ($etapa >= 3) {
            $consulta = $this->db->query('
                SELECT a.eta_id as id, a.pos_id as postulante, a.con_id as convocatoria, a.eta_instancia as instancia, concat(b.pos_apaterno," ",b.pos_amaterno," ",b.pos_nombre) as nombre, b.pos_documento as documento
                FROM etapas a, postulante b
                WHERE a.pos_id=b.pos_id and eta_etapa="' . $etapa . '" and con_id=' . $id);
        } else {
            $consulta = $this->db->query('
            SELECT a.con_id as id, a.pos_id as postulante, a.con_id1 as convocatoria, concat(b.pos_apaterno," ",b.pos_amaterno," ",b.pos_nombre) as nombre, b.pos_documento as documento
            FROM convocatoria_postulacion a, postulante b
            WHERE a.pos_id=b.pos_id and con_id1=' . $id);
        }
        $datos = $consulta->result_array();
        $enviar_boletin = $this->input->post('enviar_boletin');
        $texto = $this->input->post('contenido');
        if ($enviar_boletin) {
            $update = array(
                $this->prefijo . 'mensaje_si' => $texto,
                $this->prefijo . 'fecha_edicion' => date('Y-m-d H:i:s')
            );
            $this->db->update($this->tabla1, $update, array($this->prefijo . 'id' => $id));
        }
        $boton = $this->input->post('observacion');
        if($boton=='Guardar observaciones'){
            foreach ($datos as $filas) {
                $observacion = $this->input->post('observacion' . $filas['id']);
                $recomendable = $this->input->post('recomendacion' . $filas['id']);
                if ($recomendable) {
                $this->db->query('UPDATE postulante_f SET pof_recomendacion = "' . $recomendable . '" WHERE pos_id =' . $filas['postulante']);
                }
                if ($observacion) {
                    $this->db->query('UPDATE postulante SET pos_observacion = "' . $observacion . '" WHERE pos_id =' . $filas['postulante']);
                }
            }           
        }
        else{
            foreach ($datos as $filas) {
                $instancia = $this->input->post('instancia' . $filas['id']);
                $observacion = $this->input->post('observacion' . $filas['id']);
                $recomendable = $this->input->post('recomendacion' . $filas['id']);
                switch ($etapa) {
                    case 2:
                        if ($instancia == 7) {
                            $this->db->query('UPDATE convocatoria_postulacion SET con_espera = "1" WHERE con_id =' . $filas['id']);
                        } else {
                            if ($instancia) {
                                $this->db->query('INSERT INTO etapas (pos_id,con_id,eta_instancia,eta_etapa,eta_fecha_creacion,eta_fecha_edicion)
                                                  VALUES (' . $filas['postulante'] . ',' . $filas['convocatoria'] . ', "' . $instancia . '", "' . ($etapa + 1) . '", "' . date('Y-m-d H:i:s') . '", "' . date('Y-m-d H:i:s') . '")');
                                $ide = $this->db->insert_id();
                                if ($enviar_boletin) {
                                    $this->db->query('UPDATE convocatoria_postulacion SET con_estado = "1", con_espera = "0", con_fecha_edicion = "' . date('Y-m-d H:i:s') . '" WHERE con_id =' . $filas['id']);
                                    $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                                    $logs['log_tabla_id'] = 'etapas - ' . $ide;
                                    $logs['log_modulo'] = 'Postulaciones';
                                    $logs['log_accion'] = 'Procesar y Enviar';
                                    $logs['log_fecha'] = date('Y-m-d H:i:s');
                                    $logs['log_comentario'] = 'Se Proceso el cargo: ' . $fila['con_cargo'] . ' en la Etapa 2 y Envio Notificación al postulante: "' . $filas['nombre'] . '" con Nº de Documento: "' . $filas['documento'] . '"';
                                    $this->db->insert('logs_etiko', $logs);
                                } else {
                                    $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                                    $logs['log_tabla_id'] = 'etapas - ' . $ide;
                                    $logs['log_modulo'] = 'Postulaciones';
                                    $logs['log_accion'] = 'Procesar';
                                    $logs['log_fecha'] = date('Y-m-d H:i:s');
                                    $logs['log_comentario'] = 'Se Proceso el cargo: ' . $fila['con_cargo'] . ' en la Etapa 2 al postulante: "' . $filas['nombre'] . '" con Nº de Documento: "' . $filas['documento'] . '"';
                                    $this->db->insert('logs_etiko', $logs);
                                }
                                if ($fila['con_etapa'] <= 1) {
                                    $update = array(
                                        $this->prefijo . 'etapa' => "2"
                                    );
                                    $this->db->update($this->tabla1, $update, array($this->prefijo . 'id' => $id));
                                }
                            } elseif ($enviar_boletin) {
                                $this->db->query('UPDATE convocatoria_postulacion SET con_estado = "1", con_espera = "0", con_fecha_edicion = "' . date('Y-m-d H:i:s') . '" WHERE con_id =' . $filas['id']);
                                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                                $logs['log_tabla_id'] = $this->tabla1 . ' - ' . $id;
                                $logs['log_modulo'] = 'Postulaciones';
                                $logs['log_accion'] = 'Procesar y Enviar';
                                $logs['log_fecha'] = date('Y-m-d H:i:s');
                                $logs['log_comentario'] = 'Se Proceso el cargo: ' . $fila['con_cargo'] . ' en la Etapa 2 y Envio Notificación de no paso a la siguiente Etapa al postulante: "' . $filas['nombre'] . '" con Nº de Documento: "' . $filas['documento'] . '"';
                                $this->db->insert('logs_etiko', $logs);
                            }
                        }
                        break;
                    case 3:
                        if ($instancia > $filas['instancia']) {
                            if ($enviar_boletin) {
                                $this->db->query('UPDATE etapas SET eta_instancia = "' . $instancia . '", eta_etapa = "' . ($etapa + 1) . '", eta_tipo_msj = "si", eta_fecha_edicion = "' . date('Y-m-d H:i:s') . '" WHERE eta_id =' . $filas['id']);
                                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                                $logs['log_tabla_id'] = 'etapas - ' . $filas['id'];
                                $logs['log_modulo'] = 'Postulaciones';
                                $logs['log_accion'] = 'Procesar y Enviar';
                                $logs['log_fecha'] = date('Y-m-d H:i:s');
                                $logs['log_comentario'] = 'Se Proceso el cargo: ' . $fila['con_cargo'] . ' en la Etapa 3 y Envio Notificación al postulante: "' . $filas['nombre'] . '" con Nº de Documento: "' . $filas['documento'] . '"';
                                $this->db->insert('logs_etiko', $logs);
                            } else {
                                $this->db->query('UPDATE etapas SET eta_instancia = "' . $instancia . '", eta_etapa = "' . ($etapa + 1) . '", eta_fecha_edicion = "' . date('Y-m-d H:i:s') . '" WHERE eta_id =' . $filas['id']);
                                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                                $logs['log_tabla_id'] = 'etapas - ' . $filas['id'];
                                $logs['log_modulo'] = 'Postulaciones';
                                $logs['log_accion'] = 'Procesar';
                                $logs['log_fecha'] = date('Y-m-d H:i:s');
                                $logs['log_comentario'] = 'Se Proceso el cargo: ' . $fila['con_cargo'] . ' en la Etapa 3 al postulante: "' . $filas['nombre'] . '" con Nº de Documento: "' . $filas['documento'] . '"';
                                $this->db->insert('logs_etiko', $logs);
                            }
                            if ($fila['con_etapa'] <= 2) {
                                $update = array(
                                    $this->prefijo . 'etapa' => "3"
                                );
                                $this->db->update($this->tabla1, $update, array($this->prefijo . 'id' => $id));
                            }
                        } elseif ($instancia == 0) {
                            $this->db->query('DELETE FROM etapas WHERE eta_id =' . $filas['id']);
                            $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                            $logs['log_tabla_id'] = 'etapas - ' . $filas['id'];
                            $logs['log_modulo'] = 'Postulaciones';
                            $logs['log_accion'] = 'Procesar';
                            $logs['log_fecha'] = date('Y-m-d H:i:s');
                            $logs['log_comentario'] = 'Se Proceso el cargo: ' . $fila['con_cargo'] . ' en la Etapa 3 y se paso a la Etapa 2 al postulante: "' . $filas['nombre'] . '" con Nº de Documento: "' . $filas['documento'] . '"';
                            $this->db->insert('logs_etiko', $logs);
                        } elseif ($instancia < $filas['instancia']) {
                            $this->db->query('UPDATE etapas SET eta_instancia = "' . $instancia . '", eta_fecha_edicion = "' . date('Y-m-d H:i:s') . '" WHERE eta_id =' . $filas['id']);
                            $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                            $logs['log_tabla_id'] = 'etapas - ' . $filas['id'];
                            $logs['log_modulo'] = 'Postulaciones';
                            $logs['log_accion'] = 'Procesar';
                            $logs['log_fecha'] = date('Y-m-d H:i:s');
                            $logs['log_comentario'] = 'Se Proceso el cargo: ' . $fila['con_cargo'] . ' en la Etapa 3 y se cambio de Instancia al postulante: "' . $filas['nombre'] . '" con Nº de Documento: "' . $filas['documento'] . '"';
                            $this->db->insert('logs_etiko', $logs);
                        } else {
                            if ($enviar_boletin) {
                                $this->db->query('UPDATE etapas SET eta_instancia = "' . $instancia . '", eta_tipo_msj = "no", eta_estado = "1", eta_fecha_edicion = "' . date('Y-m-d H:i:s') . '" WHERE eta_id =' . $filas['id']);
                                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                                $logs['log_tabla_id'] = 'etapas - ' . $filas['id'];
                                $logs['log_modulo'] = 'Postulaciones';
                                $logs['log_accion'] = 'Procesar y Enviar';
                                $logs['log_fecha'] = date('Y-m-d H:i:s');
                                $logs['log_comentario'] = 'Se Proceso el cargo: ' . $fila['con_cargo'] . ' en la Etapa 3 y Envio Notificación de no paso a la siguiente Etapa al postulante: "' . $filas['nombre'] . '" con Nº de Documento: "' . $filas['documento'] . '"';
                                $this->db->insert('logs_etiko', $logs);
                            } else {
                                $this->db->query('UPDATE etapas SET eta_instancia = "' . $instancia . '", eta_fecha_edicion = "' . date('Y-m-d H:i:s') . '" WHERE eta_id =' . $filas['id']);
                                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                                $logs['log_tabla_id'] = 'etapas - ' . $filas['id'];
                                $logs['log_modulo'] = 'Postulaciones';
                                $logs['log_accion'] = 'Procesar';
                                $logs['log_fecha'] = date('Y-m-d H:i:s');
                                $logs['log_comentario'] = 'Se Proceso el cargo: ' . $fila['con_cargo'] . ' en la Etapa 3 al postulante: "' . $filas['nombre'] . '" con Nº de Documento: "' . $filas['documento'] . '"';
                                $this->db->insert('logs_etiko', $logs);
                            }
                        }
                        break;
                    case 4:
                        if ($instancia > $filas['instancia']) {
                            $this->db->query('UPDATE etapas SET eta_instancia = "' . $instancia . '", eta_estado = "1", eta_fecha_edicion = "' . date('Y-m-d H:i:s') . '" WHERE eta_id =' . $filas['id']);
                            $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                            $logs['log_tabla_id'] = 'etapas - ' . $filas['id'];
                            $logs['log_modulo'] = 'Postulaciones';
                            $logs['log_accion'] = 'Procesar';
                            $logs['log_fecha'] = date('Y-m-d H:i:s');
                            $logs['log_comentario'] = 'Se Proceso el cargo: ' . $fila['con_cargo'] . ' en la Etapa 4 y se cambio de Instancia al postulante: "' . $filas['nombre'] . '" con Nº de Documento: "' . $filas['documento'] . '"';
                            $this->db->insert('logs_etiko', $logs);
                            if ($fila['con_etapa'] <= 3) {
                                $update = array(
                                    $this->prefijo . 'etapa' => "4"
                                );
                                $this->db->update($this->tabla1, $update, array($this->prefijo . 'id' => $id));
                            }
                        } elseif ($instancia == 1) {
                            $this->db->query('UPDATE etapas SET eta_instancia = "' . $instancia . '", eta_etapa = "' . ($etapa - 1) . '", eta_fecha_edicion = "' . date('Y-m-d H:i:s') . '" WHERE eta_id =' . $filas['id']);
                            $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                            $logs['log_tabla_id'] = 'etapas - ' . $filas['id'];
                            $logs['log_modulo'] = 'Postulaciones';
                            $logs['log_accion'] = 'Procesar';
                            $logs['log_fecha'] = date('Y-m-d H:i:s');
                            $logs['log_comentario'] = 'Se Proceso el cargo: ' . $fila['con_cargo'] . ' en la Etapa 4 y se paso a la Etapa 3 al postulante: "' . $filas['nombre'] . '" con Nº de Documento: "' . $filas['documento'] . '"';
                            $this->db->insert('logs_etiko', $logs);
                        } elseif ($instancia < $filas['instancia']) {
                            $this->db->query('UPDATE etapas SET eta_instancia = "' . $instancia . '", eta_fecha_edicion = "' . date('Y-m-d H:i:s') . '" WHERE eta_id =' . $filas['id']);
                            $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                            $logs['log_tabla_id'] = 'etapas - ' . $filas['id'];
                            $logs['log_modulo'] = 'Postulaciones';
                            $logs['log_accion'] = 'Procesar';
                            $logs['log_fecha'] = date('Y-m-d H:i:s');
                            $logs['log_comentario'] = 'Se Proceso el cargo: ' . $fila['con_cargo'] . ' en la Etapa 4 y se cambio de Instancia al postulante: "' . $filas['nombre'] . '" con Nº de Documento: "' . $filas['documento'] . '"';
                            $this->db->insert('logs_etiko', $logs);
                        } else {
                            $this->db->query('UPDATE etapas SET eta_instancia = "' . $instancia . '", eta_estado = "1", eta_fecha_edicion = "' . date('Y-m-d H:i:s') . '" WHERE eta_id =' . $filas['id']);
                            $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                            $logs['log_tabla_id'] = 'etapas - ' . $filas['id'];
                            $logs['log_modulo'] = 'Postulaciones';
                            $logs['log_accion'] = 'Procesar';
                            $logs['log_fecha'] = date('Y-m-d H:i:s');
                            $logs['log_comentario'] = 'Se Proceso el cargo: ' . $fila['con_cargo'] . ' en la Etapa 4 al postulante: "' . $filas['nombre'] . '" con Nº de Documento: "' . $filas['documento'] . '"';
                            $this->db->insert('logs_etiko', $logs);
                        }
                        break;
                }
                if ($recomendable) {
                    $this->db->query('UPDATE postulante_f SET pof_recomendacion = "' . $recomendable . '" WHERE pos_id =' . $filas['postulante']);
                }
                if ($observacion) {
                    $this->db->query('UPDATE postulante SET pos_observacion = "' . $observacion . '" WHERE pos_id =' . $filas['postulante']);
                }
            }
            if ($etapa == 4) {
    //            se eleminan a todos los putulantes que esten dentro de la convocatoria
                $this->db->delete('convocatoria_postulacion', array('con_id1' => $id));
            }
        }
        $this->cabecera['titulo'] = $fila[$prefijo . 'cargo'];
        $this->cabecera['accion'] = $etapa . 'º Etapa';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['id'] = $id;
        $data['contenido'] = $this->load->view($this->carpeta . 'mensaje_exito_etapas.php', $contenido, true);
        $this->load->view('plantilla_privado', $data);
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
                'field' => $prefijo . 'titulo',
                'label' => 'Titulo',
                'rules' => 'min_length(0)'
            ),
            array(
                'field' => $prefijo . 'contenido',
                'label' => 'Contenido',
                'rules' => 'min_length(0)'
            ),
            array(
                'field' => $prefijo . 'boton',
                'label' => 'Boton',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'enlace',
                'label' => 'Enlace',
                'rules' => 'min_length(0)'
            ),
            array(
                'field' => $prefijo . 'fecha_caducidad',
                'label' => 'Fecha caducidad',
                'rules' => 'min_length(0)'
            ),
            array(
                'field' => $prefijo . 'pieimg',
                'label' => 'Pie de imagen',
                'rules' => 'min_length(0)'
            ),
            array(
                'field' => $prefijo . 'img_borrar1',
                'label' => 'imagen1',
                'rules' => 'min_length(0)'
            ),
            array(
                'field' => $prefijo . 'id',
                'label' => 'id',
                'rules' => 'min_length(0)'
            ),
            array(
                'field' => 'tip',
                'label' => 'tip',
                'rules' => 'min_length(0)'
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
            )
        );
        return $mensajes;
    }

}

?>