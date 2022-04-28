<?php

require_once('Controladoradmin.php');

class Postulante extends Controladoradmin {

    function __construct() {
        parent::__construct();
        force_ssl();
        $this->load->helper(array('url', 'form', 'html', 'pdf'));
        $this->load->library(array('form_validation', 'tool_general', 'Cezpdf', 'zip'));
        $this->load->library('aws3');

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
        $this->carpeta = 'postulante/';
        $this->controlador = 'postulante/';

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
        $this->modelo = 'modelo_postulante';
        $this->load->model($this->carpeta . 'Postulante_model', $this->modelo, TRUE);

        $this->urifull = $this->uri->uri_to_assoc();
        $this->idp = @$this->urifull['idp'];
        $this->vidp = 'pos_id';
        $this->enlaces = array(
            'id1' => 'pos_id', //id propio
            'nombre1' => 'Postulaciones', //cabecera
            'ruta1' => 'postulante/postulaciones', //ruta de controlador hijo
            'campo1' => 'pos_id', //id padre
            'campoborrar1' => @$borrar1, //campos a borra del hijo
            'tabla1' => 'etapas', //tabla hijo
            'camposup1' => 'pos_id'
        );
        $this->nroenlaces = 6;
        $consultaN = $this->db->query('
        SELECT com_id as id, com_nombre as nombre
        FROM combos
        WHERE com_tipo="11"
        ORDER BY com_orden asc'
        );
        $nivel_alcanzadoN = $consultaN->result_array();
        foreach ($nivel_alcanzadoN as $grado) {
            $this->nivel_alcanzadoN[$grado['id']] = $grado['nombre'];
        }

        $this->cabecera['titulo'] = 'Postulantes';
        $this->cabecera['accion'] = 'listar';
        $this->estado = $this->prefijoF . 'estado';
        $this->hiddens = array($this->prefijo . 'id');
        $this->boton = 6;
        if ($this->input->post('cliente')) {
            $whereCargos = ' where cli_id=' . $this->input->post('cliente');
        }
        $consulta = $this->db->query('
        SELECT con_id as id, con_cargo as nombre,date(con_fecha_creacion) as fecha
        FROM convocatoria ' . @$whereCargos . '
        ORDER BY con_cargo asc, date(con_fecha_creacion) desc'
        );
        $cargos = $consulta->result_array();
        foreach ($cargos as $grado) {
            $this->cargos[$grado['id']] = $grado['nombre'] . ' (' . $grado['fecha'] . ')';
        }
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
        WHERE com_tipo="3"
        ORDER BY com_orden asc'
        );
        $area_pro = $consulta->result_array();
        $this->profesiones[-1] = 'Seleccione el Área de Profesión';
        foreach ($area_pro as $grado) {
            $this->profesiones[$grado['id']] = $grado['nombre'];
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
//        $this->area_experiencia[-1] = 'Seleccione la Área de Experiencia';
        foreach ($area_exp as $grado) {
            $this->area_experiencia[$grado['id']] = $grado['nombre'];
        }
        $consulta = $this->db->query('
        SELECT com_id as id, com_nombre as nombre
        FROM combos
        WHERE com_tipo="6"
        ORDER BY com_orden asc'
        );
        $sector_exp = $consulta->result_array();
//        $this->sector_experiencia[-1] = 'Seleccione el Sector de Experiencia';
        foreach ($sector_exp as $grado) {
            $this->sector_experiencia[$grado['id']] = $grado['nombre'];
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
        $consultaNo = $this->db->query('
        SELECT com_id as id, com_nombre as nombre
        FROM combos
        WHERE com_tipo="11"
        ORDER BY com_orden asc'
        );
        $nivel_alcanzado_no = $consultaNo->result_array();
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
        foreach ($recomendaciones as $grado) {
            $this->recomendaciones[$grado['id']] = $grado['nombre'];
        }
        if ($this->idp) {
            $consultap = $this->db->query('
                SELECT
                concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as postulante,
                pos_documento as documento,
                pos_nro_postulaciones as nro,
                pof_recomendacion as recomendacion
                FROM
                postulante p
                INNER JOIN postulante_f pf 
                ON p.pos_id=pf.pos_id
                WHERE
                p.pos_id="' . $this->idp . '"');
            $filap = $consultap->row_array('array');

            $this->superior = array(
                'titulop' => $filap['postulante'],
                'titulop1' => $filap['documento'],
                'titulop2' => $this->recomendaciones[$filap['recomendacion']],
                'titulop3' => $filap['nro']
            );
            $this->msj_retorno = 'Volver';
            $this->ruta_retorno = $this->controlador . 'listar';
            $this->superior['titulonom'] = 'Postulante : ';
            $this->superior['titulonom1'] = 'Documento : ';
            $this->superior['titulonom2'] = 'Recomendación : ';
            $this->superior['titulonom3'] = 'Nº Total de Postulaciones : ';
        }
        $this->presession = $this->tool_entidad->presession();
        session_start();
        if (!isset($_SESSION[$this->presession . 'usuario'])) {
            redirect(base_url() . index_page());
        }
    }

    function listar() {
        $uri = $this->uri->uri_to_assoc(3);
        $prefijo = $this->prefijo;
        if ($this->input->post('cadena') || $this->input->post('cliente') || $this->input->post('cargo') || $this->input->post('instancia') || $this->input->post('recomendacion')) {
            $cadena = $this->input->post('cadena');
            $cliente = $this->input->post('cliente');
            $cargo = $this->input->post('cargo');
            $instancia = $this->input->post('instancia');
            $recomendacion = $this->input->post('recomendacion');
            $criterio = $this->input->post('campob');
        } elseif (@$uri['cadena'] || @$uri['cliente'] || @$uri['cargo'] || @$uri['instancia'] || @$uri['recomendacion']) {
            $cadena = @$uri['cadena'];
            $criterio = $uri['campob'];
            $cliente = @$uri['cliente'];
            $cargo = @$uri['cargo'];
            $instancia = @$uri['instancia'];
            $recomendacion = @$uri['recomendacion'];
            $mensaje = 'Se han postulado a los elementos marcados';
            $contenido['mensaje'] = $mensaje;
        }
        if (@$cadena || @$cliente || @$cargo || @$instancia || @$recomendacion) {
            $cadena = $this->tool_general->limpiar_acentos($cadena);
            switch ($criterio) {
                case 1:
                    $consulta = $this->db->query('
                    SELECT pf.pos_id,pos_nombre,pos_apaterno,pos_amaterno,
                    pos_documento,b.pai_nombre as pais, c.pai_nombre as ciudad,
                    pos_direccion,pos_telefono,pos_celular,pos_email,pof_estado,
                    pos_nro_postulaciones,
                    case ' . $prefijo . 'tipodoc
                    when "1" then "C.I."
                    when "2" then "Pasaporte"
                    end as ' . $prefijo . 'tipodoc
                    FROM postulante as a
                    INNER JOIN postulante_f as pf
                    ON pf.pos_id=a.pos_id
                    INNER JOIN paises as b
                    ON pf.pai_id=b.pai_id
                    INNER JOIN paises as c
                    ON pf.ciu_id=c.pai_id
                    WHERE (pos_documento like "%' . $cadena . '%" or pos_apaterno like "%' . $cadena . '%" or pos_amaterno like "%' . $cadena . '%" or pos_nombre like "%' . $cadena . '%" )
                    ORDER BY pos_apaterno asc, pos_tipodoc asc, pos_documento asc');
                    $contenido['cadena'] = $cadena;
                    break;
                case 2:
                    $consulta = $this->db->query('
                    SELECT pf.pos_id,pos_nombre,pos_apaterno,pos_amaterno,
                    pos_documento,b.pai_nombre as pais, c.pai_nombre as ciudad,
                    pos_direccion,pos_telefono,pos_celular,pos_email,pof_estado,
                    pos_nro_postulaciones,
                    case ' . $prefijo . 'tipodoc
                    when "1" then "C.I."
                    when "2" then "Pasaporte"
                    end as ' . $prefijo . 'tipodoc
                    FROM postulante as a
                    INNER JOIN postulante_f as pf
                    ON pf.pos_id=a.pos_id
                    INNER JOIN paises as b
                    ON pf.pai_id=b.pai_id
                    INNER JOIN paises as c
                    ON pf.pai_id=c.pai_id
                    WHERE pos_documento like "%' . $cadena . '%"
                    ORDER BY pos_apaterno asc, pos_tipodoc asc, pos_documento asc');
                    $contenido['cadena'] = $cadena;
                    break;
                case 3:
                    $consulta = $this->db->query('
                    SELECT pf.pos_id,pos_nombre,pos_apaterno,pos_amaterno,
                    pos_documento,b.pai_nombre as pais, c.pai_nombre as ciudad,
                    pos_direccion,pos_telefono,pos_celular,pos_email,pof_estado,
                    pos_nro_postulaciones,
                    case ' . $prefijo . 'tipodoc
                    when "1" then "C.I."
                    when "2" then "Pasaporte"
                    end as ' . $prefijo . 'tipodoc
                    FROM postulante as a
                    INNER JOIN postulante_f as pf
                    ON pf.pos_id=a.pos_id
                    INNER JOIN paises as b
                    ON pf.pai_id=b.pai_id
                    INNER JOIN paises as c
                    ON pf.ciu_id=c.pai_id
                    WHERE pos_apaterno like "%' . $cadena . '%"
                    ORDER BY pos_apaterno asc, pos_tipodoc asc, pos_documento asc');
                    $contenido['cadena'] = $cadena;
                    break;
                case 4:
                    $consulta = $this->db->query('
                    SELECT pf.pos_id,pos_nombre,pos_apaterno,pos_amaterno,
                    pos_documento,b.pai_nombre as pais, c.pai_nombre as ciudad,
                    pos_direccion,pos_telefono,pos_celular,pos_email,pof_estado,
                    pos_nro_postulaciones,
                    case ' . $prefijo . 'tipodoc
                    when "1" then "C.I."
                    when "2" then "Pasaporte"
                    end as ' . $prefijo . 'tipodoc
                    FROM postulante as a
                    INNER JOIN postulante_f as pf
                    ON pf.pos_id=a.pos_id
                    INNER JOIN paises as b
                    ON pf.pai_id=b.pai_id
                    INNER JOIN paises as c
                    ON pf.ciu_id=c.pai_id
                    WHERE pos_amaterno like "%' . $cadena . '%"
                    ORDER BY pos_apaterno asc, pos_tipodoc asc, pos_documento asc');
                    $contenido['cadena'] = $cadena;
                    break;
                case 5:
                    $consulta = $this->db->query('
                    SELECT pf.pos_id,pos_nombre,pos_apaterno,pos_amaterno,
                    pos_documento,b.pai_nombre as pais, c.pai_nombre as ciudad,
                    pos_direccion,pos_telefono,pos_celular,pos_email,pof_estado,
                    pos_nro_postulaciones,
                    case ' . $prefijo . 'tipodoc
                    when "1" then "C.I."
                    when "2" then "Pasaporte"
                    end as ' . $prefijo . 'tipodoc
                    FROM postulante as a
                    INNER JOIN postulante_f as pf
                    ON pf.pos_id=a.pos_id
                    INNER JOIN paises as b
                    ON pf.pai_id=b.pai_id
                    INNER JOIN paises as c
                    ON pf.ciu_id=c.pai_id
                    WHERE pos_nombre like "%' . $cadena . '%"
                    ORDER BY pos_apaterno asc, pos_tipodoc asc, pos_documento asc');
                    $contenido['cadena'] = $cadena;
                    break;
                case 6:
                    $where = '';
                    if ($cliente)
                        $where .= ' and a.cli_id=' . $cliente;
                    if ($cargo) {
                        $where .= ' and a.con_id=' . $cargo;
                        $consulta = $this->db->query('
                        SELECT con_etapa as etapa
                        FROM convocatoria
                        WHERE con_id=' . $cargo);
                        $etapa = $consulta->row_array();
                        if ($etapa['etapa'] == 4) {
                            $tablac = 'etapas';
                            $campoc = 'con_id';
                        } else {
                            $tablac = 'convocatoria_postulacion';
                            $campoc = 'con_id1';
                        }
                    }
                    if (!@$tablac)
                        $tablac = 'convocatoria_postulacion';
                    if (!@$campoc)
                        $campoc = 'con_id1';
                    $consulta = $this->db->query('
                    SELECT
                    b.' . $prefijo . 'id as pos_id,
                    ' . $prefijo . 'apaterno,
                    ' . $prefijo . 'amaterno,
                    ' . $prefijo . 'nombre,
                    ' . $prefijo . 'nro_postulaciones,
                    ' . $prefijo . 'documento,
                    case ' . $prefijo . 'tipodoc
                    when "1" then "C.I."
                    when "2" then "Pasaporte"
                    end as ' . $prefijo . 'tipodoc,
                    
                    ' . $prefijo . 'direccion,
                    ' . $prefijo . 'telefono,
                    ' . $prefijo . 'celular,
                    ' . $prefijo . 'email,
                    ' . $this->prefijoF . 'estado,
                    pa.pai_nombre as pais
                    FROM convocatoria a, ' . $tablac . ' b, postulante c
                    INNER JOIN postulante_f as pf
                    ON pf.pos_id=c.pos_id
                    INNER JOIN paises as pa
                    ON pf.pai_id=pa.pai_id
                    INNER JOIN paises as pc
                    ON pf.ciu_id=pc.pai_id
                    WHERE a.con_id=b.' . $campoc . ' and b.pos_id=c.pos_id ' . $where . '
                    GROUP BY c.pos_id
                    ORDER BY pos_apaterno asc, pos_tipodoc asc, pos_documento asc');
                    $contenido['cliente'] = $cliente;
                    $contenido['cargo'] = $cargo;
                    break;
                case 7:

                    $consulta = $this->db->query('
                    SELECT
                    c.' . $prefijo . 'id as pos_id,
                    ' . $prefijo . 'apaterno,
                    ' . $prefijo . 'amaterno,
                    ' . $prefijo . 'nombre,
                    ' . $prefijo . 'nro_postulaciones,
                    ' . $prefijo . 'documento,
                    case ' . $prefijo . 'tipodoc
                    when "1" then "C.I."
                    when "2" then "Pasaporte"
                    end as ' . $prefijo . 'tipodoc,
                    ' . $prefijo . 'direccion,
                    ' . $prefijo . 'telefono,
                    ' . $prefijo . 'celular,
                    ' . $prefijo . 'email,
                    ' . $this->prefijoF . 'estado,
                    pa.pai_nombre as pais
                    FROM convocatoria a, etapas b, postulante c
                    INNER JOIN postulante_f as pf
                    ON pf.pos_id=c.pos_id
                    INNER JOIN paises as pa
                    ON pf.pai_id=pa.pai_id
                    INNER JOIN paises as pc
                    ON pf.ciu_id=pc.pai_id
                    WHERE a.con_id=b.con_id and b.pos_id=c.pos_id and b.eta_instancia="' . $instancia . '"
                    GROUP BY pos_id
                    ORDER BY pos_apaterno asc, pos_tipodoc asc, pos_documento asc');
                    $contenido['instancia'] = $instancia;
                    break;
                case 8:
                    $consulta = $this->db->query('
                    SELECT * ,
                    case ' . $prefijo . 'tipodoc
                    when "1" then "C.I."
                    when "2" then "Pasaporte"
                    end as ' . $prefijo . 'tipodoc,
                    b.pai_nombre as pais
                    FROM postulante as a
                    INNER JOIN postulante_f as pf
                    ON pf.pos_id=a.pos_id
                    INNER JOIN paises as b
                    ON pf.pai_id=b.pai_id
                    INNER JOIN paises as c
                    ON pf.ciu_id=c.pai_id                  
                    WHERE pof_recomendacion="' . $recomendacion . '"
                    ORDER BY pos_apaterno asc, pos_tipodoc asc, pos_documento asc');
                    $contenido['recomendacion'] = $recomendacion;
                    break;
            }

            $this->campos_listar = array('Apellido Paterno', 'Apellido Materno', 'Nombres', 'Documento', 'País', 'Dirección', 'Teléfono', 'Celular', 'Email', 'Estado');
            $this->campos_reales = array($prefijo . 'apaterno', $prefijo . 'amaterno', $prefijo . 'nombre', $prefijo . 'documento', 'pais', $prefijo . 'direccion', $prefijo . 'telefono', $prefijo . 'celular', $prefijo . 'email', $this->prefijoF . 'estado');
            $this->hiddens = array($this->prefijo . 'id');
            $datos = $consulta->result_array();
        }
//        para codigo disponibilidad
        $consultaDisponibilidad = $this->db->query('
        SELECT
        com_id as id,
        com_nombre as nombre 
        FROM combos
        where com_tipo=14
        ORDER BY com_orden asc'
        );
        $disponibilidad = $consultaDisponibilidad->result_array();
        $this->cabecera['accion'] = 'Listado';
        $contenido['campos_listar'] = @$this->campos_listar;
        $contenido['campos_reales'] = @$this->campos_reales;
        $contenido['hiddens'] = $this->hiddens;
        $contenido['cabecera'] = $this->cabecera;
        $contenido['datos'] = @$datos;
        $contenido['criterio'] = @$criterio;
        $contenido['estado'] = $this->estado;
        $contenido['disponibilidad'] = $disponibilidad;
        //$data['contenido'] = $this->load->view('controladoradmin/listar', $contenido, true);
        $data['contenido'] = $this->load->view($this->carpeta . 'listar', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function cargos_select() {
        $id = $this->input->post('id');
        $consulta = $this->db->query('SELECT con_id as id, con_cargo as cargo,
                                            date(con_fecha_creacion) as fecha
                                          FROM convocatoria WHERE cli_id=' . $id . '
                                               order by con_cargo asc, date(con_fecha_creacion) desc');
        $cargos = $consulta->result_array();
        $datos['cargos'] = $cargos;
        $this->load->view($this->carpeta . 'cargos', $datos);
    }

    function postulaciones() {
        //errores
        // var_dump($this->input->post('oporden'));exit();
        $prefijo = $this->prefijo;
        $prefijo1 = 'con_';
        $uri = $this->uri->uri_to_assoc(3);
        $cadena = @$uri['cadena'];
        if (!$cadena)
            $cadena = $this->input->post('cadena');
        $criterio = $uri['campob'];
        // var_dump($uri);exit();
        if (!$criterio)
            $criterio = $this->input->post('campob');
        $cliente = @$uri['cliente'];
        if (!$cliente)
            $cliente = $this->input->post('cliente');
        $cargo = @$uri['cargo'];
        if (!$cargo)
            $cargo = $this->input->post('cargo');
        $instancia = @$uri['instancia'];
        if (!$instancia)
            $instancia = $this->input->post('instancia');
        $recomendacion = @$uri['recomendacion'];
        if (!$recomendacion)
            $recomendacion = $this->input->post('recomendacion');
        if ($this->input->post('oporden')) {
            $tipo = $this->input->post('tiporden');
            switch ($this->input->post('oporden')) {
                case 1:
                    $order = ' ORDER BY cliente ' . $tipo;
                    break;
                case 2:
                    $order = ' ORDER BY ' . $prefijo1 . 'cargo ' . $tipo;
                    break;
                case 3:
                    $order = ' ORDER BY ' . $prefijo1 . 'tope ' . $tipo;
                    break;
            }
        } else {
            $order = '  ORDER BY ' . $prefijo1 . 'hasta asc';
        }

        $this->cabecera['accion'] = 'Postulaciones';
        $this->campos_listar = array('Fecha desde', 'Fecha hasta', 'Fecha Tope Postulación', 'Cliente', 'Cargo', 'Resp. ETIKO', 'Proceso Interno', 'Instancia', 'Observación', 'Etapa');
        $this->campos_reales = array($prefijo1 . 'desde', $prefijo1 . 'hasta', $prefijo1 . 'tope', 'cliente', $prefijo1 . 'cargo', 'etikos', $prefijo1 . 'interno', 'instancia', 'observacion', 'etapa');
        $this->hiddens = array($prefijo1 . 'id');
        $ordencampo[1] = 'Cliente';
        $ordencampo[2] = 'Cargo';
        $ordencampo[3] = 'Fecha Tope';

        $consulta = $this->db->query('
                SELECT
                b.' . $prefijo1 . 'id as id,
                ' . $prefijo1 . 'desde,
                ' . $prefijo1 . 'hasta,
                d.cli_nombre as cliente,
                ' . $prefijo1 . 'tope,
                eti_id1,
                eti_id2,
                ' . $prefijo1 . 'cargo,
                case ' . $prefijo1 . 'interno
                when "1" then "Si"
                else "No"
                end as ' . $prefijo1 . 'interno,
                p.pos_observacion as observacion,                
                case b.eta_instancia
                WHEN "1" THEN "EP"
                WHEN "2" THEN "TP"
                WHEN "3" THEN "Assesment"
                WHEN "4" THEN "Entrevista"
                WHEN "5" THEN "Finalista"
                WHEN "6" THEN "Elegido"
                end as instancia,
                b.eta_etapa as etapa
                FROM
                convocatoria a, etapas b, clientes d, postulante p
                WHERE a.con_id=b.con_id and b.pos_id=p.pos_id
                and a.cli_id=d.cli_id and b.pos_id = ' . $this->idp . $order);
        $datos = $consulta->result_array();
        foreach ($datos as $nums => $rows) {
            $consulta = $this->db->query('
                    SELECT
                    eti_nombre
                    FROM
                    etiko
                    where
                    eti_id="' . $rows['eti_id1'] . '"'
            );
            $etiko1 = $consulta->row_array();
            $consulta = $this->db->query('
                    SELECT
                    eti_nombre
                    FROM
                    etiko
                    where
                    eti_id="' . $rows['eti_id2'] . '"'
            );
            $etiko2 = $consulta->row_array();
            $datos[$nums]['etikos'] = ' -' . $etiko1['eti_nombre'];
            if (isset($etiko2['eti_nombre']))
                $datos[$nums]['etikos'] .= '<br/> -' . $etiko2['eti_nombre'];
        }

        $contenido['campos_listar'] = $this->campos_listar;
        $contenido['campos_reales'] = $this->campos_reales;
        $contenido['hiddens'] = $this->hiddens;
        $contenido['cabecera'] = $this->cabecera;
        $contenido['ordencampo'] = $ordencampo;
        $contenido['datos'] = $datos;
        $contenido['cadena'] = $cadena;
        $contenido['criterio'] = $criterio;
        $contenido['cliente'] = $cliente;
        $contenido['cargo'] = $cargo;
        $contenido['instancia'] = $instancia;
        $contenido['recomendacion'] = $recomendacion;
        //$data['contenido'] = $this->load->view('controladoradmin/listar', $contenido, true);
        $data['contenido'] = $this->load->view($this->carpeta . 'listar_postulacion', $contenido, true);
        $this->load->view('plantilla_privado', $data);
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
        $criterio = $this->urifull['campob'];
        $cadena = $this->urifull['cadena'];
        $cliente = $this->urifull['cliente'];
        $cargo = $this->urifull['cargo'];
        $instancia = $this->urifull['instancia'];
        $recomendacion = $this->urifull['recomendacion'];
        $consulta = $this->db->query('
        SELECT ' . $this->prefijo . 'id,' . $this->prefijoF . 'estado FROM ' . $this->tablaF . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $fila[$this->prefijoF . 'estado'] = '0';
        $modelo = $this->modelo;
        $this->$modelo->editarF($fila);
        $enlace = '/campob/' . $criterio;
        if ($cadena)
            $enlace .= '/cadena/' . $cadena;
        if ($cliente)
            $enlace .= '/cliente/' . $cliente;
        if ($cargo)
            $enlace .= '/cargo/' . $cargo;
        if ($instancia)
            $enlace .= '/instancia/' . $instancia;
        if ($recomendacion)
            $enlace .= '/recomendacion/' . $recomendacion;
        redirect($this->controlador . $this->cabecera['accion'] . $enlace);
    }

    function habilitar() {
        $id = $this->uri->segment(4);
        $criterio = $this->urifull['campob'];
        $cadena = $this->urifull['cadena'];
        $cliente = $this->urifull['cliente'];
        $cargo = $this->urifull['cargo'];
        $instancia = $this->urifull['instancia'];
        $recomendacion = $this->urifull['recomendacion'];
        $consulta = $this->db->query('
        SELECT ' . $this->prefijo . 'id,' . $this->prefijoF . 'estado FROM ' . $this->tablaF . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $fila[$this->prefijoF . 'estado'] = '1';
        $modelo = $this->modelo;
        $this->$modelo->editarF($fila);
        $enlace = '/campob/' . $criterio;
        if ($cadena)
            $enlace .= '/cadena/' . $cadena;
        if ($cliente)
            $enlace .= '/cliente/' . $cliente;
        if ($cargo)
            $enlace .= '/cargo/' . $cargo;
        if ($instancia)
            $enlace .= '/instancia/' . $instancia;
        if ($recomendacion)
            $enlace .= '/recomendacion/' . $recomendacion;
        redirect($this->controlador . $this->cabecera['accion'] . $enlace);
    }

    function cambiarEstado() {
        $id = $this->uri->segment(4);
        $idEstado = $_POST['idestado'];
        $consulta = $this->db->query('
        SELECT ' . $this->prefijo . 'id,' . $this->prefijo . 'estado FROM ' . $this->tabla . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $fila[$this->prefijo . 'estado'] = $idEstado;
        $modelo = $this->modelo;
        $this->$modelo->editar($fila);
    }

    function desvincular($var, $id) {
        $ruta_origen = $this->ruta;
        $consulta = $this->db->query('
        SELECT * FROM convocatoria_postulacion WHERE con_id=' . $id);

        $fila = $consulta->first_row('array');
        $this->db->delete('convocatoria_postulacion', array('con_id' => $fila['con_id']));
        redirect($this->controlador . 'postulaciones/idp/' . $this->idp);
    }

    function imprimir_doc() {
        $id = $this->uri->segment(4);
        $array_doc = $this->preparar_doc($id);

        $doc = $array_doc['doc'];
        $nombre_archivo = $array_doc['nombre_archivo'];
        $archivo = $this->temporal($doc, ".doc");
        $this->descargar($archivo, $nombre_archivo);
    }

//    function migrarIdioma() {
////        $limit=' limit 4 ';
//        $consulta = $this->db->query('
//                    select poi_id,poi_habla,poi_lee,poi_escribe from postulante_idioma ' . $limit . '
//                    ');
//        $idiomas = $consulta->result_array();
//        $i = 0;
//        foreach ($idiomas as $key => $value) {
//            $habla = (int) $value['poi_habla'];
//            $lee = (int) $value['poi_lee'];
//            $escribe = (int) $value['poi_escribe'];
//            $idIdioma = (int) $value['poi_id'];
////            echo $habla . "-" . $lee . "-" . $escribe . "-" . $idIdioma . "<br>";
//            $datos = array();
//            $datos['poi_habla_n'] = $habla;
//            $datos['poi_lee_n'] = $lee;
//            $datos['poi_escribe_n'] = $escribe;
////            $this->db->update('postulante_idioma', $datos, "poi_id = $idIdioma");
//            $i = $i + 1;
//        }
//        echo $i;
//    }
//    function migrarGenero() {
////        $limit=' limit 4 ';
//        $consulta = $this->db->query('
//                    select pof_id,pof_sexo from postulante_f ' . $limit . '
//                    ');
//        $sexo = $consulta->result_array();
//        $i = 0;
//        foreach ($sexo as $key => $value) {
//            $nGenero = (int) $value['pof_sexo'];
//            $id = $value['pof_id'];
//            $datos = array();
//            $datos['pof_sexo_n'] = $nGenero;
//            $this->db->update('postulante_f', $datos, "pof_id = $id");
//            $i = $i + 1;
//        }
//        echo $i;
//    }
//    function migrarAreaSector() {
////        $limit=' limit 4 ';
//        $consulta = $this->db->query('
//                    select pof_id,pof_area_exp,pof_sector_exp from postulante_f ' . $limit . '
//                    ');
//        $sexo = $consulta->result_array();
//        $i = 0;
//        foreach ($sexo as $key => $value) {
//            $area = $value['pof_area_exp'];
//            $sector = $value['pof_sector_exp'];
//            $id = $value['pof_id'];
//            $datos = array();
//            $datos['pof_area_exp_n'] = $area;
//            $datos['pof_sector_exp_n'] = $sector;
//            $this->db->update('postulante_f', $datos, "pof_id = $id");
//            $i = $i + 1;
//        }
//        echo $i;
//    }

    function preparar_doc($id) {
        $prefijo = $this->prefijo;
        $consulta222 = $this->db->query('
                SELECT *,
                date_format(pof_fecha_nacimiento, "%d-%m-%Y") as pof_fecha_nacimiento,
                year(now()) - year(pof_fecha_nacimiento) as anios,
                date_format(pos_fecha_creacion, "%d-%m-%Y") as pos_fecha_creacion,
                b.pai_nombre as pais,
                IF(pf.ciu_id!=156, c.pai_nombre,pf.pof_pais_ciudad) as ciudad
                FROM
                postulante as a 
                inner join postulante_f as pf
                on pf.pos_id=a.pos_id
                inner join paises as b
                on pf.pai_id=b.pai_id
                inner join paises as c
                on pf.ciu_id=c.pai_id
                WHERE a.pos_id = ' . $id);
        $datos_personales = $consulta222->row_array();

        $consulta = $this->db->query('
                SELECT *
                FROM
                educacion_post_grado
                INNER JOIN combos
                   ON com_id=edu_grado
                WHERE pos_id = ' . $id . ' ORDER BY com_orden asc');
        $educacion_post_grado = $consulta->result_array();
        $consulta = $this->db->query('
                SELECT *
                FROM
                educacion_superior
                INNER JOIN combos
                   ON com_id=edu_grado
                WHERE pos_id = ' . $id . ' ORDER BY com_orden asc');
        $educacion_superior = $consulta->result_array();
        $consulta = $this->db->query('
                SELECT *
                FROM
                educacion_secundaria
                WHERE pos_id = ' . $id);
        $educacion_secundaria = $consulta->result_array();
        $consulta = $this->db->query('
                SELECT *
                FROM
                publicaciones
                WHERE pos_id = ' . $id);
        $publicaciones = $consulta->result_array();
        $consulta = $this->db->query('
                SELECT *, PERIOD_DIFF(DATE_FORMAT(STR_TO_DATE(tra_hasta,"%Y-%m"),"%Y%m"),DATE_FORMAT(STR_TO_DATE(tra_desde,"%Y-%m"),"%Y%m")) as tra_anio_mes
                FROM
                trayectoria_laboral
                WHERE pos_id = ' . $id . ' order by tra_hasta desc');
        $experiencia_laboral = $consulta->result_array();
        $consulta = $this->db->query('
                SELECT poi_habla, poi_lee,poi_escribe,poi_tipo,
                IF(a.idi_id!=4, idi_idioma,CONCAT(idi_idioma,"-",poi_idioma_otro))as idi_idioma
                FROM
                postulante_idioma as a
                    inner join idiomas as b
                    on a.idi_id=b.idi_id
                WHERE pos_id = ' . $id);
        $idiomas = $consulta->result_array();

        $contenido['datos_personales'] = $datos_personales;
        $contenido['educacion_post_grado'] = $educacion_post_grado;
        $contenido['educacion_superior'] = $educacion_superior;
        $contenido['educacion_secundaria'] = $educacion_secundaria;
        $contenido['publicaciones'] = $publicaciones;
        $contenido['experiencia_laboral'] = $experiencia_laboral;
        $contenido['idiomas'] = $idiomas;
        $doc['doc'] = $this->load->view($this->carpeta . 'imprimir', $contenido, true);
        $doc['nombre_archivo'] = $this->tool_general->limpiar_cadena($datos_personales['pos_apaterno'] . ' ' . $datos_personales['pos_amaterno'] . ' ' . $datos_personales['pos_nombre']);
        return $doc;
    }

    function preparar_doc_postulante($id) {
        $prefijo = $this->prefijo;
        $consulta222 = $this->db->query('
                SELECT *,
                date_format(pof_fecha_nacimiento, "%d-%m-%Y") as pof_fecha_nacimiento,
                year(now()) - year(pof_fecha_nacimiento) as anios,
                date_format(pos_fecha_creacion, "%d-%m-%Y") as pos_fecha_creacion,
                b.pai_nombre as pais,
                IF(pf.ciu_id!=156, c.pai_nombre,pf.pof_pais_ciudad) as ciudad
                FROM
                postulante as a 
                inner join postulante_f as pf
                on pf.pos_id=a.pos_id
                inner join paises as b
                on pf.pai_id=b.pai_id
                inner join paises as c
                on pf.ciu_id=c.pai_id
                WHERE a.pos_id = ' . $id);
        $datos_personales = $consulta222->row_array();

        $consulta = $this->db->query('
                SELECT *
                FROM
                educacion_post_grado
                INNER JOIN combos
                   ON com_id=edu_grado
                WHERE pos_id = ' . $id . ' ORDER BY com_orden asc');
        $educacion_post_grado = $consulta->result_array();
        $consulta = $this->db->query('
                SELECT *
                FROM
                educacion_superior
                INNER JOIN combos
                   ON com_id=edu_grado
                WHERE pos_id = ' . $id . ' ORDER BY com_orden asc');
        $educacion_superior = $consulta->result_array();
        $consulta = $this->db->query('
                SELECT *
                FROM
                educacion_secundaria
                WHERE pos_id = ' . $id);
        $educacion_secundaria = $consulta->result_array();
        $consulta = $this->db->query('
                SELECT *
                FROM
                publicaciones
                WHERE pos_id = ' . $id);
        $publicaciones = $consulta->result_array();
        $consulta = $this->db->query('
                SELECT *, PERIOD_DIFF(DATE_FORMAT(STR_TO_DATE(tra_hasta,"%Y-%m"),"%Y%m"),DATE_FORMAT(STR_TO_DATE(tra_desde,"%Y-%m"),"%Y%m")) as tra_anio_mes
                FROM
                trayectoria_laboral
                WHERE pos_id = ' . $id . ' order by tra_hasta desc');
        $experiencia_laboral = $consulta->result_array();
        $consulta = $this->db->query('
                SELECT poi_habla, poi_lee,poi_escribe,poi_tipo,
                IF(a.idi_id!=4, idi_idioma,CONCAT(idi_idioma,"-",poi_idioma_otro))as idi_idioma
                FROM
                postulante_idioma as a
                    inner join idiomas as b
                    on a.idi_id=b.idi_id
                WHERE pos_id = ' . $id);
        $idiomas = $consulta->result_array();

        $contenido['datos_personales'] = $datos_personales;
        $contenido['educacion_post_grado'] = $educacion_post_grado;
        $contenido['educacion_superior'] = $educacion_superior;
        $contenido['educacion_secundaria'] = $educacion_secundaria;
        $contenido['publicaciones'] = $publicaciones;
        $contenido['experiencia_laboral'] = $experiencia_laboral;
        $contenido['idiomas'] = $idiomas;
        if ($educacion_secundaria) {
			//if ($educacion_secundaria && $experiencia_laboral && $idiomas) {
            $doc['doc'] = $this->load->view($this->carpeta . 'imprimir', $contenido, true);
            $doc['nombre_archivo'] = $this->tool_general->limpiar_cadena($datos_personales['pos_apaterno'] . ' ' . $datos_personales['pos_amaterno'] . ' ' . $datos_personales['pos_nombre']);
            return $doc;
        }
        return FALSE;
    }

     function hello_world()//mi hola mundo cezpdf 2021
    {
        $sol='<u>select</u>';

        $this->cezpdf->ezText('Hello World', 12, array('justification' => 'center'));
        $this->cezpdf->ezSetDy(-10);
        $content = '<table><tr><th>Month</th><th>Savings</th></tr><tr><td>January</td><td>$100</td></tr></table>';

        $this->cezpdf->ezText($content, 10);
        $data = $this->cezpdf->ezStream();

    }



    function imprimir_pdf() {
        $id = $this->uri->segment(4);
        $array_pdf = $this->preparar_pdf($id);
        $pdf = $array_pdf['pdf'];
        $nombre_archivo = $array_pdf['nombre_archivo'];
        $archivo = $this->temporal($pdf, ".pdf");
        $this->descargar($archivo, $nombre_archivo);
    }

    function preparar_pdf($id) {
        prep_pdf();
        $prefijo = $this->prefijo;
        $consulta = $this->db->query('
                SELECT *,
                date_format(pof_fecha_nacimiento, "%d-%m-%Y") as pof_fecha_nacimiento,
                year(now()) - year(pof_fecha_nacimiento) as anios,
                date_format(pos_fecha_creacion, "%d-%m-%Y") as pos_fecha_creacion,
                b.pai_nombre as pais,
                IF(pf.ciu_id!=156, c.pai_nombre,pf.pof_pais_ciudad) as ciudad
                FROM
                postulante as a 
                inner join postulante_f as pf
                on pf.pos_id=a.pos_id
                inner join paises as b
                on pf.pai_id=b.pai_id
                inner join paises as c
                on pf.ciu_id=c.pai_id
                WHERE a.pos_id = ' . $id);
        $datos_personales = $consulta->row_array();
        $consulta = $this->db->query('
                SELECT *
                FROM
                educacion_post_grado
                INNER JOIN combos
                    ON com_id=edu_grado
                WHERE pos_id = ' . $id . ' order by com_orden asc');
        $educacion_post_grado = $consulta->result_array();
        $consulta = $this->db->query('
                SELECT *
                FROM
                educacion_superior
                INNER JOIN combos
                    ON com_id=edu_grado
                WHERE pos_id = ' . $id . ' order by com_orden asc');
        $educacion_superior = $consulta->result_array();
        $consulta = $this->db->query('
                SELECT *
                FROM
                educacion_secundaria
                WHERE pos_id = ' . $id);
        $educacion_secundaria = $consulta->result_array();
        $consulta = $this->db->query('
                SELECT *
                FROM
                publicaciones
                WHERE pos_id = ' . $id);
        $publicaciones = $consulta->result_array();
        $consulta = $this->db->query('
                SELECT *, PERIOD_DIFF(DATE_FORMAT(STR_TO_DATE(tra_hasta,"%Y-%m"),"%Y%m"),DATE_FORMAT(STR_TO_DATE(tra_desde,"%Y-%m"),"%Y%m")) as tra_anio_mes
                FROM
                trayectoria_laboral
                WHERE pos_id = ' . $id . ' order by tra_hasta desc');
        $experiencia_laboral = $consulta->result_array();
//        $consulta = $this->db->query('
//                SELECT *
//                FROM
//                idiomas
//                WHERE pos_id = ' . $id);
//        $idiomas = $consulta->result_array();
        $consulta = $this->db->query('
                SELECT poi_habla, poi_lee,poi_escribe,poi_tipo,
                IF(a.idi_id!=4, idi_idioma,CONCAT(idi_idioma,"-",poi_idioma_otro))as idi_idioma
                FROM
                postulante_idioma as a
                    inner join idiomas as b
                    on a.idi_id=b.idi_id
                WHERE pos_id = ' . $id);
        $idiomas = $consulta->result_array();
        $image = $_SERVER['DOCUMENT_ROOT'] . "/sisetika/files/img/logo_etika_pdf.jpg";
//        echo $image;
//        exit();
        if (file_exists($image)) {
            $this->cezpdf->addJpegFromFile($image, 140, 740, '', 60);
        }
        $this->cezpdf->ezSetDy(-65);
        $this->cezpdf->ezText("<b>FORMULARIO DE</b>", 14, array('justification' => 'center'));
        $this->cezpdf->ezText("<b>DATOS PERSONALES Y LABORALES</b>", 14, array('justification' => 'center'));
        $this->cezpdf->ezSetDy(-20);
        $this->cezpdf->ezText('<b>Pretensión Salarial Referencial (en Bs.):</b> ' . $datos_personales['pof_salario'], 12);
        $this->cezpdf->ezSetDy(-10);
        $this->cezpdf->ezText('<b>I. DATOS PERSONALES</b>', 12);
        $this->cezpdf->ezSetDy(-10);
        $this->cezpdf->ezText('<b>Documento:</b> ' . $datos_personales['pos_documento'], 12, array('left' => 10));
        if ($datos_personales['pos_tipodoc'] == 1 || $datos_personales['pos_tipodoc'] == 3) {
            $tipo = 'C.I.';
        } elseif ($datos_personales['pos_tipodoc'] == 2) {
            $tipo = 'Pasaporte';
        }
        $this->cezpdf->ezSetDy(14);
        $this->cezpdf->ezText('<b>Tipo Documento:</b> ' . $tipo, 12, array('left' => 300));
        $this->cezpdf->ezText('<b>Apellidos:</b> ' . $datos_personales['pos_apaterno'] . ' ' . $datos_personales['pos_amaterno'], 12, array('left' => 10));
        $this->cezpdf->ezSetDy(14);
        $this->cezpdf->ezText('<b>Nombres:</b> ' . $datos_personales['pos_nombre'], 12, array('left' => 300));
        $this->cezpdf->ezText('<b>Fecha Nacimiento (día, mes y año):</b> ' . $datos_personales['pof_fecha_nacimiento'], 12, array('left' => 10));
        $this->cezpdf->ezSetDy(14);
        $this->cezpdf->ezText('<b>Edad:</b> ' . $datos_personales['anios'], 12, array('left' => 300));
        if ($datos_personales['pof_sexo'] == 1 || $datos_personales['pof_sexo'] == 0) {
            $sexo = 'Masculino';
        } elseif ($datos_personales['pof_sexo'] == 2) {
            $sexo = 'Femenino';
        }
        $this->cezpdf->ezSetDy(14);
        $this->cezpdf->ezText('<b>Género:</b> ' . $sexo, 12, array('left' => 380));
        $this->cezpdf->ezText('<b>Nacionalidad:</b> ' . $datos_personales['pos_nacionalidad'], 12, array('left' => 10));
        $this->cezpdf->ezSetDy(14);
        $this->cezpdf->ezText('<b>País:</b> ' . $datos_personales['pais'], 12, array('left' => 300));
        $this->cezpdf->ezText('<b>Ciudad o Localidad:</b> ' . $datos_personales['ciudad'], 12, array('left' => 10));
        $this->cezpdf->ezText('<b>Correo Electrónico:</b> ' . $datos_personales['pos_email'], 12, array('left' => 10));
        $this->cezpdf->ezText('<b>Teléfono / Celular:</b> ' . $datos_personales['pos_telefono'], 12, array('left' => 10));
        $this->cezpdf->ezText('<b>Dirección:</b> ' . $datos_personales['pos_direccion'], 12, array('left' => 10));
        if ($datos_personales['pos_traslado'] == 1) {
            $this->cezpdf->ezText('<b>¿Disponibilidad de trasladarse a otra ciudad?  </b>       Si', 12, array('left' => 10));
            $this->cezpdf->ezText('<b>Ciudad de Traslado: </b>', 12, array('left' => 10));
            $this->cezpdf->ezSetDy(14);
            $this->cezpdf->ezText($datos_personales['pos_traslado_lugar'], 12, array('left' => 300));
        } else {
            $this->cezpdf->ezText('<b>¿Disponibilidad de trasladarse a otra ciudad?  </b>       No', 12, array('left' => 10));
        }
        if ($educacion_post_grado == TRUE && $educacion_superior == TRUE && $educacion_secundaria == TRUE && $publicaciones == TRUE) {
            $this->cezpdf->ezSetDy(-10);
            $this->cezpdf->ezText('<b>II. INSTRUCCIÓN FORMAL</b>', 12);
            $this->cezpdf->ezSetDy(-10);
        }
        if ($educacion_post_grado) {
            foreach ($educacion_post_grado as $fila) {
                $nota = '';
                $titulado = '';
                if ($fila['edu_nota']) {
                    $nota = $fila['edu_nota'];
                }
                if ($fila['edu_titulado']) {
                    $titulado = 'Si';
                } else {
                    $titulado = 'No';
                }
                $datos[] = array($fila['edu_desde'], $fila['edu_hasta'], $fila['edu_institucion'], $fila['edu_pais'], $this->grados[$fila['edu_grado']], $fila['edu_area'], $fila['edu_tema'], $nota, $titulado);
            }
            $col_names = array(
                0 => "<b>Desde\n(Año-Mes)</b>",
                1 => "<b>Hasta\n(Año-Mes)</b>",
                2 => "<b>Institución</b>",
                3 => "<b>País</b>",
                4 => "<b>Grado o Titulo</b>",
                5 => "<b>Área de\nPost Grado</b>",
                6 => "<b>Tema de\nTesis</b>",
                7 => "<b>Nota Tesis</b>",
                8 => "<b>Titulado</b>"
            );
            $this->cezpdf->ezTable($datos, $col_names, '<b> Educación de Post Grado </b>', array('showLines' => 2, 'width' => 560, 'shaded' => 0, 'fontSize' => 8,
                'cols' => array(
                    0 => array('justification' => 'center', 'width' => 55),
                    1 => array('justification' => 'center', 'width' => 55),
                    2 => array('justification' => 'center'),
                    3 => array('justification' => 'center'),
                    4 => array('justification' => 'center'),
                    5 => array('justification' => 'center'),
                    6 => array('justification' => 'center'),
                    7 => array('justification' => 'center'),
                    8 => array('justification' => 'center')
                )
                    )
            );
        }
        $this->cezpdf->ezSetDy(-10);
        if ($educacion_superior) {
            $datos = [];
            foreach ($educacion_superior as $fila) {
                $nota = '';
                $titulado = '';
                if ($fila['edu_nota']) {
                    $nota = $fila['edu_nota'];
                }
                if ($fila['edu_titulado']) {
                    $titulado = 'Si';
                } else {
                    $titulado = 'No';
                }
                if ($fila['edu_area'] == 65) {
                    $profesion = $this->profesiones[$fila['edu_area']] . "-" . $fila['edu_area_otro'];
                } else {
                    $profesion = $this->profesiones[$fila['edu_area']];
                }
                $datos[] = array($fila['edu_desde'], $fila['edu_hasta'], $fila['edu_institucion'], $fila['edu_pais'], $this->grados_sup[$fila['edu_grado']], $profesion, $fila['edu_tema'], $nota, $titulado);
            }
            $col_names = array(
                '0' => '<b>Desde (Año-Mes)</b>',
                '1' => '<b>Hasta (Año-Mes)</b>',
                '2' => '<b>Institución</b>',
                '3' => '<b>País</b>',
                '4' => '<b>Grado o Titulo</b>',
                '5' => '<b>Profesión</b>',
                '6' => '<b>Tema de Tesis</b>',
                '7' => '<b>Nota Tesis</b>',
                '8' => '<b>Titulado</b>'
            );
            $this->cezpdf->ezTable($datos, $col_names, '<b> Educación Superior </b>', array('showLines' => 2, 'width' => 560, 'shaded' => 0, 'fontSize' => 8,
                'cols' => array(
                    0 => array('justification' => 'center', 'width' => 55),
                    1 => array('justification' => 'center', 'width' => 55),
                    2 => array('justification' => 'center'),
                    3 => array('justification' => 'center'),
                    4 => array('justification' => 'center'),
                    5 => array('justification' => 'center'),
                    6 => array('justification' => 'center'),
                    7 => array('justification' => 'center'),
                    8 => array('justification' => 'center')
                )
                    )
            );
        }
        $this->cezpdf->ezSetDy(-10);
        if ($educacion_secundaria) {
            $datos = [];
            foreach ($educacion_secundaria as $fila) {
                $datos[] = array($fila['edu_desde'], $fila['edu_hasta'], $fila['edu_institucion'], $fila['edu_pais']);
            }
            $col_names = array(
                '0' => '<b>Desde (Año)</b>',
                '1' => '<b>Hasta (Año)</b>',
                '2' => '<b>Institución</b>',
                '3' => '<b>País</b>'
            );
            $this->cezpdf->ezTable($datos, $col_names, '<b> Educación Secundaria </b>', array('showLines' => 2, 'xOrientation' => 'center', 'shaded' => 0, 'fontSize' => 8,
                'cols' => array(
                    0 => array('justification' => 'center'),
                    1 => array('justification' => 'center'),
                    2 => array('justification' => 'center'),
                    3 => array('justification' => 'center')
                )
                    )
            );
        }
        $this->cezpdf->ezSetDy(-10);
        if ($publicaciones) {
            $datos = [];
            foreach ($publicaciones as $fila) {
                $datos[] = array($fila['pub_titulo'], $fila['pub_anio']);
            }
            $col_names = array(
                '0' => '<b>Titulo</b>',
                '1' => '<b>Año</b>'
            );
            $this->cezpdf->ezTable($datos, $col_names, '<b> Publicaciones </b>', array('showLines' => 2, 'xOrientation' => 'center', 'shaded' => 0, 'fontSize' => 8,
                'cols' => array(
                    0 => array('justification' => 'center'),
                    1 => array('justification' => 'center')
                )
                    )
            );
        }
//        para trayectoria laboral
        if ($experiencia_laboral) {
            $this->cezpdf->ezSetDy(-10);
            $this->cezpdf->ezText("<b>III. TRAYECTORIA LABORAL</b>", 12);
            $this->cezpdf->ezSetDy(-10);
            $this->cezpdf->ezText("<b>Síntesis de Experiencia Laboral</b>", 12, array('left' => 10));
            $this->cezpdf->ezSetDy(-10);
            $this->cezpdf->ezText("<b>Ambito en el que clasificaría su experiencia: </b>", 12, array('left' => 10));
            $ambitos = explode(',', $datos_personales['pof_ambito_exp']);
            $amb_mostrar = "";
            foreach ($ambitos as $ambito) {
                switch ($ambito) {
                    case "1":
                        $amb_mostrar .= "Empresa Privada\n";
                        break;
                    case "2":
                        $amb_mostrar .= "Empresa Publica\n";
                        break;
                    case "3":
                        $amb_mostrar .= "Cooperación para el Desarrollo\n";
                        break;
                }
            }
            $arrayArea = explode(',', $datos_personales['pof_area_exp']);
            $nombresArea = array();
            foreach ($arrayArea as $key => $value) {
                $nombresArea[] = $this->area_experiencia[$value];
            }
            $arraySector = explode(',', $datos_personales['pof_sector_exp']);
            $nombresSector = array();
            foreach ($arraySector as $key => $value) {
                $nombresSector[] = $this->sector_experiencia[$value];
            }
            $stringNombresArea = "";
            if ($nombresArea) {
                $stringNombresArea = implode(', ', $nombresArea);
            }
            $strintNombresSector = "";
            if ($nombresSector) {
                $strintNombresSector = implode(', ', $nombresSector);
            }
            $this->cezpdf->ezSetDy(14);
            $this->cezpdf->ezText($amb_mostrar, 12, array('left' => 300));
            $this->cezpdf->ezSetDy(14);
            $this->cezpdf->ezText("<b>Área de experiencia que usted resaltaría: </b>", 12, array('left' => 10));
            $this->cezpdf->ezSetDy(14);
            $this->cezpdf->ezText($stringNombresArea, 12, array('left' => 300));
            $this->cezpdf->ezText("<b>Sector de experiencia que usted resaltaría: </b>", 12, array('left' => 10));
            $this->cezpdf->ezSetDy(14);
            $this->cezpdf->ezText($strintNombresSector, 12, array('left' => 300));
            $this->cezpdf->ezText("<b>Experiencia en supervisión: </b>", 12, array('left' => 10));
            $this->cezpdf->ezSetDy(14);
            $this->cezpdf->ezText(ucfirst($datos_personales['pof_supervisar_exp']), 12, array('left' => 300));
            if ($datos_personales['pof_supervisar_exp'] == 'si') {
                $this->cezpdf->ezText("<b>Máximo nivel alcanzado: </b>", 12, array('left' => 10));
                $this->cezpdf->ezSetDy(14);
                $this->cezpdf->ezText($this->nivel_alcanzado[$datos_personales['pof_max_nivel']], 12, array('left' => 300));
                $this->cezpdf->ezText("<b>Años de experiencia en supervisión:  </b>", 12, array('left' => 10));
                $this->cezpdf->ezSetDy(14);
                $this->cezpdf->ezText($datos_personales['pof_anios_exp'], 12, array('left' => 300));
            } else {
                $this->cezpdf->ezText("<b>Máximo nivel alcanzado: </b>", 12, array('left' => 10));
                $this->cezpdf->ezSetDy(14);
                $this->cezpdf->ezText($this->nivel_alcanzado_no[$datos_personales['pof_max_nivel_no']], 12, array('left' => 300));
            }
            $this->cezpdf->ezSetDy(-10);
            if ($experiencia_laboral) {
                $datos = [];
                foreach ($experiencia_laboral as $fila) {
                    $meses = $fila['tra_anio_mes'];
                    $tiempo = '';
                    if ($meses) {
                        if (intval($meses / 12))
                            $tiempo .= intval($meses / 12) . ' Años';
                        if ($meses % 12)
                            $tiempo .= ' ' . ($meses % 12) . ' Meses';
                    }
                    $datos[] = array($fila['tra_desde'], $fila['tra_hasta'], $tiempo, $fila['tra_organizacion'], $fila['tra_cargos'], $fila['tra_nsubordinados'], $fila['tra_sueldo']);
                }
                $col_names = array(
                    '0' => '<b>Desde</b>',
                    '1' => '<b>Hasta</b>',
                    '2' => '<b>Tiempo que Trabajó (Años y Meses):</b>',
                    '3' => '<b>Nombre de la Organización</b>',
                    '4' => '<b>Cargos Ocupados</b>',
                    '5' => '<b>Nº Subordinados</b>',
                    '6' => '<b>Sueldo por Mes (en Bs.)</b>'
                );
                $this->cezpdf->ezTable($datos, $col_names, '<b> Experiencia Laboral Resumen </b>', array('showLines' => 2, 'width' => 560, 'shaded' => 0, 'fontSize' => 8,
                    'cols' => array(
                        0 => array('justification' => 'center'),
                        1 => array('justification' => 'center'),
                        2 => array('justification' => 'center'),
                        3 => array('justification' => 'center'),
                        4 => array('justification' => 'center'),
                        5 => array('justification' => 'center'),
                        6 => array('justification' => 'center')
                    )
                        )
                );
            }
            $this->cezpdf->ezSetDy(-10);
            $this->cezpdf->ezText("<b>Experiencia Laboral Detallada</b>", 12, array('left' => 10));
            $this->cezpdf->ezSetDy(-10);
            if ($experiencia_laboral) {
                $nro_exp = count($experiencia_laboral);
                $x = 1;
                foreach ($experiencia_laboral as $fila) {
                    $meses = $fila['tra_anio_mes'];
                    $tiempo = '';
                    if ($meses) {
                        if (intval($meses / 12))
                            $tiempo .= intval($meses / 12) . ' Años';
                        if ($meses % 12)
                            $tiempo .= ' ' . ($meses % 12) . ' Meses';
                    }
                    $this->cezpdf->ezText("<b>Desde(Año-Mes): </b>" . $fila['tra_desde'], 12, array('left' => 100));
                    $this->cezpdf->ezSetDy(14);
                    $this->cezpdf->ezText("<b>Hasta(Año-Mes): </b>" . $fila['tra_hasta'], 12, array('left' => 250));
                    $this->cezpdf->ezText("<b>Tiempo que Trabajó (Años y Meses): </b>" . $tiempo, 12, array('left' => 10));
                    $this->cezpdf->ezText("<b>Nombre de la Organización: </b>" . $fila['tra_organizacion'], 12, array('left' => 10));
                    $this->cezpdf->ezText("<b>Tipo Organización: </b>" . $this->tipo_org[$fila['tra_tipo_org']], 12, array('left' => 10));
                    $this->cezpdf->ezSetDy(14);
                    $this->cezpdf->ezText("<b>País - Ciudad: </b>" . $fila['tra_pais'], 12, array('left' => 300));
                    $this->cezpdf->ezText("<b>Actividad Principal de la Organización: </b>", 12, array('left' => 10));
                    $this->cezpdf->ezText($fila['tra_descripcion_org'], 12, array('left' => 10, "justification" => "full"));
                    $this->cezpdf->ezText("<b>Cargo(s) Ocupado(s): </b>", 12, array('left' => 10));
                    $this->cezpdf->ezText($fila['tra_cargos'], 12, array('left' => 10, "justification" => "full"));
                    $this->cezpdf->ezText("<b>3 Principales Funciones Desempeñadas dentro del Cargo: </b>", 12, array('left' => 10));
                    $this->cezpdf->ezText($fila['tra_funciones_org'], 12, array('left' => 10, 'justification' => 'left'));
                    $this->cezpdf->ezText("<b>Principales Logros: </b>", 12, array('left' => 10));
                    $this->cezpdf->ezText($fila['tra_logros'], 12, array('left' => 10, "justification" => "full"));
                    $this->cezpdf->ezText("<b>Teléfono(s) de la Organización: </b>" . $fila['tra_telefono_org'], 12, array('left' => 10));
                    $this->cezpdf->ezText("<b>Nombre del Inmediato Superior: </b>" . $fila['tra_nombre_sup'], 12, array('left' => 10));
                    if ($fila['tra_telefono_sup']) {
                        $this->cezpdf->ezText("<b>Teléfono del Inmediato Superior: </b>" . $fila['tra_telefono_sup'], 12, array('left' => 10));
                    }
                    if ($fila['tra_email_sup']) {
                        $this->cezpdf->ezText("<b>Correo Electrónico del Inmediato Superior: </b>" . $fila['tra_email_sup'], 12, array('left' => 10));
                    }
                    if ($fila['tra_actual']) {
                        $this->cezpdf->ezText("<b>Estoy Trabajando Actualmente en esta Organización</b>", 12, array('justification' => 'center'));
                    }
                    if ($x != $nro_exp) {
                        $this->cezpdf->setLineStyle(1);
                        $y = $this->cezpdf->y - 10;
                        $this->cezpdf->ezSetDy(-10);
                        $this->cezpdf->line(20, $y, 560, $y);
                        $this->cezpdf->ezSetDy(-10);
                    }
                    $x++;
                }
            }
        }
        if ($idiomas) {
            $this->cezpdf->ezSetDy(-10);
            $this->cezpdf->ezText("<b>IV.	INFORMACION ADICIONAL</b>", 12);
            if ($idiomas) {
                $x = 1;
                foreach ($idiomas as $fila) {
                    $datos = [];
                    $h = '';
                    $l = '';
                    $e = '';
                    $this->cezpdf->ezSetDy(-10);
                    if ($fila['poi_habla'] == 1) {
                        $h[1] = 'X';
                    } else {
                        $h[1] = ' ';
                    }
                    if ($fila['poi_habla'] == 2) {
                        $h[2] = 'X';
                    } else {
                        $h[2] = ' ';
                    }
                    if ($fila['poi_habla'] == 3) {
                        $h[3] = 'X';
                    } else {
                        $h[3] = ' ';
                    }
                    if ($fila['poi_habla'] == 4) {
                        $h[4] = 'X';
                    } else {
                        $h[4] = ' ';
                    }
                    $datos[] = array('Habla', $h[1], $h[2], $h[3], $h[4]);
                    if ($fila['poi_lee'] == 1) {
                        $l[1] = 'X';
                    } else {
                        $l[1] = ' ';
                    }
                    if ($fila['poi_lee'] == 2) {
                        $l[2] = 'X';
                    } else {
                        $l[2] = ' ';
                    }
                    if ($fila['poi_lee'] == 3) {
                        $l[3] = 'X';
                    } else {
                        $l[3] = ' ';
                    }
                    if ($fila['poi_lee'] == 4) {
                        $l[4] = 'X';
                    } else {
                        $l[4] = ' ';
                    }
                    $datos[] = array('Lee', $l[1], $l[2], $l[3], $l[4]);
                    if ($fila['poi_escribe'] == 1) {
                        $e[1] = 'X';
                    } else {
                        $e[1] = ' ';
                    }
                    if ($fila['poi_escribe'] == 2) {
                        $e[2] = 'X';
                    } else {
                        $e[2] = ' ';
                    }
                    if ($fila['poi_escribe'] == 3) {
                        $e[3] = 'X';
                    } else {
                        $e[3] = ' ';
                    }
                    if ($fila['poi_escribe'] == 4) {
                        $e[4] = 'X';
                    } else {
                        $e[4] = ' ';
                    }
                    $datos[] = array('Escribe', $e[1], $e[2], $e[3], $e[4]);

                    $col_names = array(
                        0 => '<b></b>',
                        1 => '<b>Excelente</b>',
                        2 => '<b>Muy Bueno</b>',
                        3 => '<b>Regular</b>',
                        4 => '<b>Basico</b>'
                    );
                    $this->cezpdf->ezTable($datos, $col_names, "<b>Idioma " . $x . ":</b> " . $fila['idi_idioma'], array('showLines' => 2, 'xOrientation' => 'center', 'shaded' => 0, 'fontSize' => 8,
                        'cols' => array(
                            0 => array('justification' => 'center'),
                            1 => array('justification' => 'center'),
                            2 => array('justification' => 'center'),
                            3 => array('justification' => 'center'),
                            4 => array('justification' => 'center')
                        )
                            )
                    );


                    $x++;
                }
            }
            $this->cezpdf->ezSetDy(-20);
            if ($datos_personales['pos_comentario']) {
                $this->cezpdf->ezText("<b>Comentario Adicional : </b>", 12, array('left' => 10));
                $this->cezpdf->ezText($datos_personales['pos_comentario'], 12, array('left' => 10, "justification" => "full"));
                $this->cezpdf->ezSetDy(-10);
            }
        }
        $this->cezpdf->ezText("<b>Fecha de Inscripción(Día-Mes-Año): </b>" . $datos_personales['pos_fecha_creacion'], 12, array('justification' => 'center'));
      
        
        //$this->cezpdf->setEncryption('', '3t1k4', '');
        //$pdf['pdf'] = $this->cezpdf->ezOutput();
        $pdf['nombre_archivo'] = $this->tool_general->limpiar_cadena($datos_personales['pos_apaterno'] . ' ' . $datos_personales['pos_amaterno'] . ' ' . $datos_personales['pos_nombre']);
          $data = $this->cezpdf->ezStream(array('Content-Disposition'=>$pdf['nombre_archivo'].'.pdf','download'=>1));
        //return $pdf;
        //$this->cezpdf->ezStream(array('Content-Disposition'=>$datos_personales['pos_documento'].'.pdf'));
        //$this->cezpdf->ezStream(array('Content-Disposition' => 'nama_file.pdf'));
    }

    function generar_zip() {

        $descargar_doc = $this->input->post('descargar_doc');
        $descargar_pdf = $this->input->post('descargar_pdf');
        $cadena = $this->input->post('cadena');
        $cliente = $this->input->post('cliente');
        $cargo = $this->input->post('cargo');
        $instancia = $this->input->post('instancia');
        $recomendacion = $this->input->post('recomendacion');
        $criterio = $this->input->post('criterio');
        if ($descargar_doc == ' Descargar ') {
            $consulta = $this->db->query('
                        SELECT pos_id as id FROM postulante
                        order by pos_id asc');
            $datos = $consulta->result_array();
            foreach ($datos as $fila) {
                $array = '';
                $chk = $this->input->post('chk' . $fila['id']);
                if ($chk == 'on') {
                    $existe = 1;
                    $array = $this->preparar_doc($fila['id']);
                    $doc = $array['doc'];
                    $nombre_archivo = $array['nombre_archivo'] . '.doc';
                    $archivo = $this->temporal($doc, ".doc");
                    $this->zip->read_file($archivo, $nombre_archivo);
                    unlink($archivo);
                }
            }
            if ($existe) {
                $this->zip->download('Postulantes(' . date('Y-m-d') . ').zip');
            }
        }
//        if ($descargar_doc == ' Descargar ') {
//            $consulta = $this->db->query('
//                        SELECT pos_id as id FROM postulante
//                        order by pos_id asc');
//            $datos = $consulta->result_array();
//            foreach ($datos as $fila) {
//                $array = '';
//                $chk = $this->input->post('chk' . $fila['id']);
//                if ($chk == 'on') {
//                    $existe = 1;
//                    $array = $this->preparar_pdf($fila['id']);
//                    $doc = $array['pdf'];
//                    $nombre_archivo = $array['nombre_archivo'] . '.pdf';
//                    $archivo = $this->temporal($doc, ".pdf");
//                    $this->zip->read_file($archivo, $nombre_archivo);
//                    unlink($archivo);
//                }
//            }
//            if ($existe) {
//                $this->zip->download('Postulantes(' . date('Y-m-d') . ').zip');
//            }
//        }
        $enlace = '/campob/' . $criterio;
        if ($cadena)
            $enlace .= '/cadena/' . $cadena;
        if ($cliente)
            $enlace .= '/cliente/' . $cliente;
        if ($cargo)
            $enlace .= '/cargo/' . $cargo;
        if ($instancia)
            $enlace .= '/instancia/' . $instancia;
        if ($recomendacion)
            $enlace .= '/recomendacion/' . $recomendacion;
        redirect($this->controlador . 'listar' . $enlace);
    }

    function generar_zip2() {

        $descargar_doc = $this->input->post('descargar_doc');
        $descargar_pdf = $this->input->post('descargar_pdf');
        $cadena = $this->input->post('cadena');
        $cliente = $this->input->post('cliente');
        $cargo = $this->input->post('cargo');
        $instancia = $this->input->post('instancia');
        $recomendacion = $this->input->post('recomendacion');
        $criterio = $this->input->post('criterio');
//        if ($descargar_doc == ' Descargar ') {
        $consulta = $this->db->query('
                        SELECT pos_id as id FROM postulante
                        order by pos_id asc');
        $datos = $consulta->result_array();
        foreach ($datos as $fila) {
            $array = '';
            $chk = $this->input->post('chk' . $fila['id']);
            if ($chk == 'on') {
                $existe = 1;
                $array = $this->preparar_doc($fila['id']);
                $doc = $array['doc'];
                $nombre_archivo = $array['nombre_archivo'] . '.doc';
                $archivo = $this->temporal($doc, ".doc");
                $this->zip->read_file($archivo, $nombre_archivo);
                unlink($archivo);
            }
        }
        if ($existe) {

            $this->zip->download('Postulantes(' . date('Y-m-d') . ').zip');
            exit();
        }
//        }
    }

    function generar_zip_pdf() {
        $descargar_doc = $this->input->post('descargar_doc');
        $descargar_pdf = $this->input->post('descargar_pdf');
        $cadena = $this->input->post('cadena');
        $cliente = $this->input->post('cliente');
        $cargo = $this->input->post('cargo');
        $instancia = $this->input->post('instancia');
        $recomendacion = $this->input->post('recomendacion');
        $criterio = $this->input->post('criterio');
//        if ($descargar_doc == ' Descargar ') {
//            $consulta = $this->db->query('
//                        SELECT pos_id as id FROM postulante
//                        order by pos_id asc');
//            $datos = $consulta->result_array();
//            foreach ($datos as $fila) {
//                $array = '';
//                $chk = $this->input->post('chk' . $fila['id']);
//                if ($chk == 'on') {
//                    $existe = 1;
//                    $array = $this->preparar_doc($fila['id']);
//                    $doc = $array['doc'];
//                    $nombre_archivo = $array['nombre_archivo'] . '.doc';
//                    $archivo = $this->temporal($doc, ".doc");
//                    $this->zip->read_file($archivo, $nombre_archivo);
//                    unlink($archivo);
//                }
//            }
//            if ($existe) {
//                $this->zip->download('Postulantes(' . date('Y-m-d') . ').zip');
//            }
//        }
        if ($descargar_doc == ' Descargar ') {
            $consulta = $this->db->query('
                        SELECT pos_id as id FROM postulante
                        order by pos_id asc');
            $datos = $consulta->result_array();
            foreach ($datos as $fila) {
                $array = '';
                $chk = $this->input->post('chk' . $fila['id']);
                if ($chk == 'on') {
                    $existe = 1;
                    $array = $this->preparar_pdf($fila['id']);
                    $doc = $array['pdf'];
                    $nombre_archivo = $array['nombre_archivo'] . '.pdf';
                    $archivo = $this->temporal($doc, ".pdf");
                    $this->zip->read_file($archivo, $nombre_archivo);
                    unlink($archivo);
                }
            }
            if ($existe) {
                $this->zip->download('Postulantes(' . date('Y-m-d') . ').zip');
            }
        }
        $enlace = '/campob/' . $criterio;
        if ($cadena)
            $enlace .= '/cadena/' . $cadena;
        if ($cliente)
            $enlace .= '/cliente/' . $cliente;
        if ($cargo)
            $enlace .= '/cargo/' . $cargo;
        if ($instancia)
            $enlace .= '/instancia/' . $instancia;
        if ($recomendacion)
            $enlace .= '/recomendacion/' . $recomendacion;
        redirect($this->controlador . 'listar' . $enlace);
    }

    function zip_postulantes() {
        $idc = $this->input->post('idc');
//        echo '
//            SELECT
//            b.pos_id,
//            con_id,
//            FROM convocatoria_postulacion a, postulante b
//            INNER JOIN postulante_f pf
//            ON pf.pos_id=b.pos_id
//            INNER JOIN paises ci
//            ON ci.pai_id=pf.ciu_id
//            WHERE a.pos_id=b.pos_id and con_id1=' . $idc . '
//            ORDER BY pos_apaterno asc, pos_tipodoc asc, pos_documento asc';
        $consultaPostulantes = $this->db->query('
            SELECT
            b.pos_id as id
            FROM convocatoria_postulacion a, postulante b
            INNER JOIN postulante_f pf
            ON pf.pos_id=b.pos_id
            INNER JOIN paises ci
            ON ci.pai_id=pf.ciu_id
            WHERE a.pos_id=b.pos_id and con_id1=' . $idc . '
            ORDER BY pos_apaterno asc, pos_tipodoc asc, pos_documento asc');
        $datosPostulantes = $consultaPostulantes->result_array();

        $consulta = $this->db->query('
                        SELECT pos_id as id FROM postulante
                        order by pos_id asc');
        $datos = $consulta->result_array();

        foreach ($datosPostulantes as $key => $value) {
            
        }

        foreach ($datosPostulantes as $fila) {
            $array = '';

            $existe = 1;
            $array = $this->preparar_doc_postulante($fila['id']);
            if ($array != FALSE) {
                $doc = $array['doc'];
                $nombre_archivo = $array['nombre_archivo'] . '.doc';
                $archivo = $this->temporal($doc, ".doc");
                $this->zip->read_file($archivo, $nombre_archivo);
            }
            @unlink($archivo);
        }
        if ($existe) {

            $this->zip->download('Postulantes_' . $idc . '_(' . date('Y-m-d') . ').zip');
            exit();
        }
    }

    function zip_postulantes_cvs($idc = null) {
        $ruta = 'archivos/cvs/temp/'.$idc;
        $aws_bucket=$this->tool_entidad->aws_bucket();
        $this->aws3->zipfile($aws_bucket,$ruta);
        exit();
    }

    function temporal($pdf, $extencion) {
        $tmp = tempnam("tmp", "tmp") . $extencion;
        $fp = fopen($tmp, "w");
        fputs($fp, $pdf);
        fclose($fp);
        return $tmp;
    }

    function descargar($archivo, $filename) {
        $data['archivo'] = $archivo;
        $data['filename'] = $filename;
        $this->load->view('descargar', $data);
    }

    function editar() {
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
        $consulta = $this->db->query('
        SELECT pos_id, pos_nombre, pos_apaterno, pos_amaterno, pos_documento  FROM ' . $this->tabla . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila_sup = $consulta->first_row('array');
        $this->cabecera['accion'] = 'Editar';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['fila_sup'] = $fila_sup;
        $data['contenido'] = $this->load->view($this->carpeta . 'editar_menu', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function editar_datospersonal() {
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
        $fila = $consulta->first_row('array');
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
        $this->cabecera['accion'] = 'Editar Datos Personales';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['action'] = $this->controlador . 'guardar_editar_datospersonal';
        $contenido['fila'] = $fila;
        $contenido['paises'] = $newPaises;
        $contenido['ciudades'] = $ciudades;
        $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function recomendacion_observacion() {
        $formulario = 'recomendacion_observacion';
        $this->definir_datos_form_editar();
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
        $consulta = $this->db->query('
        SELECT p.pos_id,pos_observacion, pof_recomendacion
                FROM postulante  p
               inner join postulante_f pf
               on p.pos_id=pf.pos_id
               WHERE p.pos_id=' . $id);
        $fila = $consulta->first_row('array');
        $consultaRecomendacion = $this->db->query('
        select com_id,com_nombre from combos where com_tipo=7 order by com_orden');
        $comboRecomendacion = $consultaRecomendacion->result_array('array');
        $newComboRecomendacion = array();
        foreach ($comboRecomendacion as $key => $value) {
            $newComboRecomendacion[$value['com_id']] = $value['com_nombre'];
        }


        $this->cabecera['accion'] = 'Editar Recomendación y Observación';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['action'] = $this->controlador . 'guardar_editar_recomendacion_observacion';
        $contenido['fila'] = $fila;
        $contenido['comboRecomendacion'] = $newComboRecomendacion;
        $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function guardar_editar_datospersonal() {
        $formulario = 'datospersonales_editar_form';
        $campo = array($this->prefijo . 'nombre', $this->prefijo . 'apaterno', $this->prefijo . 'amaterno', $this->prefijo . 'nacionalidad',
            $this->prefijo . 'direccion', $this->prefijo . 'telefono', $this->prefijo . 'celular', $this->prefijo . 'email', $this->prefijo . 'traslado');
        $campoF = array($this->prefijoF . 'sexo', $this->prefijoF . 'fecha_nacimiento', $this->prefijoF . 'pais_ciudad', $this->prefijoF . 'ciudad_otra', $this->prefijoF . 'salario', $this->prefijoP . 'id', 'ciu_id');
        $this->definir_datos_form_editar();
        $prefijo = $this->prefijo;
        $prefijoF = $this->prefijoF;
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
        if ($this->form_validation->run() == FALSE) {
            $fila[$this->prefijo . 'id'] = $id;

            $fila[$this->prefijo . 'nombre'] = $this->input->post($this->prefijo . 'nombre');
            $fila[$this->prefijo . 'amaterno'] = $this->input->post($this->prefijo . 'amaterno');
            $fila[$this->prefijo . 'apaterno'] = $this->input->post($this->prefijo . 'apaterno');
            $fila[$this->prefijo . 'direccion'] = $this->input->post($this->prefijo . 'direccion');
            $fila[$this->prefijo . 'telefono'] = $this->input->post($this->prefijo . 'telefono');
            $fila[$this->prefijo . 'celular'] = $this->input->post($this->prefijo . 'celular');
            $fila[$this->prefijo . 'email'] = $this->input->post($this->prefijo . 'email');

            $fila[$prefijoF . 'sexo'] = $this->input->post($prefijoF . 'sexo');
            $fila['pai_id'] = $this->input->post('pai_id');
            $fila['ciu_id'] = $this->input->post('ciu_id');
            $fila[$this->prefijoF . 'ciudad_otra'] = $this->input->post($this->prefijoF . 'ciudad_otra');
            $fila[$this->prefijoF . 'salario'] = $this->input->post($this->prefijoF . 'salario');
            if ($fila['pai_id'] != 1) {
                $fila['ciu_id'] = '';
            }
            if ($this->input->post($prefijo . 'nacionalidad') == 1) {
                $fila[$prefijo . 'nacionalidad'] = 'BOLIVIANA';
            } else {
                $fila[$prefijo . 'nacionalidad'] = $this->input->post($prefijo . 'nacionalidad_otra');
            }
            if ($this->input->post('pai_id') != 1) {
                $fila[$prefijoF . 'pais_ciudad'] = $this->input->post($prefijoF . 'pais_ciudad');
            } else {
                $fila[$prefijoF . 'pais_ciudad'] = '';
            }
            if ($this->input->post($prefijo . 'traslado')) {
                $fila[$prefijo . 'traslado'] = $this->input->post($prefijo . 'traslado');
                $fila[$prefijo . 'traslado_lugar'] = $this->input->post($prefijo . 'traslado_lugar');
            }
            $contenido['cabecera'] = $this->cabecera;
            $contenido['fila'] = $fila;
            $contenido['paises'] = $newPaises;
            $contenido['ciudades'] = $ciudades;
            $contenido['action'] = $this->carpeta . 'guardar_editar_datospersonal';
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        } else {
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
                $fila[$prefijoF . 'sexo'] = $this->input->post($prefijoF . 'sexo');
                $fila['pai_id'] = $this->input->post('pai_id');
                $fila['ciu_id'] = $this->input->post('ciu_id');
                if ($fila['pai_id'] != 1) {
                    $fila['ciu_id'] = 156;
                }
                $fila[$this->prefijo . 'nombre'] = $this->input->post($this->prefijo . 'nombre');
                $fila[$this->prefijo . 'amaterno'] = $this->input->post($this->prefijo . 'amaterno');
                $fila[$this->prefijo . 'apaterno'] = $this->input->post($this->prefijo . 'apaterno');
                $fila[$this->prefijo . 'direccion'] = $this->input->post($this->prefijo . 'direccion');
                $fila[$this->prefijo . 'telefono'] = $this->input->post($this->prefijo . 'telefono');
                $fila[$this->prefijo . 'celular'] = $this->input->post($this->prefijo . 'celular');
                $fila[$this->prefijo . 'email'] = $this->input->post($this->prefijo . 'email');
                $fila[$this->prefijoF . 'ciudad_otra'] = $this->input->post($this->prefijoF . 'ciudad_otra');
                if ($this->input->post($prefijo . 'pais_otro') != 1) {
                    $fila[$prefijoF . 'pais_ciudad'] = $this->input->post($prefijoF . 'pais_ciudad');
                } else {
                    $fila[$prefijoF . 'pais_ciudad'] = '';
                }
                if ($this->input->post($prefijo . 'nacionalidad') == 1) {
                    $fila[$prefijo . 'nacionalidad'] = 'BOLIVIANA';
                } else {
                    $fila[$prefijo . 'nacionalidad'] = $this->input->post($prefijo . 'nacionalidad_otra');
                }
                if ($this->input->post($prefijo . 'traslado')) {
                    $fila[$prefijo . 'traslado'] = $this->input->post($prefijo . 'traslado');
                    $fila[$prefijo . 'traslado_lugar'] = $this->input->post($prefijo . 'traslado_lugar');
                }
                $contenido['cabecera'] = $this->cabecera;
                $contenido['fila'] = $fila;
                $contenido['error_telefono'] = $error_telefono;
                $contenido['paises'] = $newPaises;
                $contenido['ciudades'] = $ciudades;
                $contenido['action'] = $this->carpeta . 'guardar_editar_datospersonal';
                $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
                $this->load->view('plantilla_privado', $data);
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
                        $dataF[$this->prefijoF . 'pais_ciudad'] = $this->input->post($this->prefijoF . 'pais_ciudad');
                        $dataF['ciu_id'] = 156;
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
//                para modificar la fecha de edicion

                $data[$this->prefijo . 'fecha_edicion'] = date('Y-m-d H:i:s');
                if ($this->$modelo->editar($data) && $this->$modelo->editarF($dataF)) {
                    $consulta = $this->db->query('
                        SELECT * FROM postulante WHERE pos_id=' . $data[$this->prefijo . 'id']);
                    $fila1 = $consulta->first_row('array');
                    $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                    $logs['log_tabla_id'] = 'postulante - ' . $fila1[$this->prefijo . 'id'];
                    $logs['log_modulo'] = 'Reportes';
                    $logs['log_accion'] = 'Editar';
                    $logs['log_fecha'] = date('Y-m-d H:i:s');
                    $logs['log_comentario'] = 'Modificó los Datos Personales del Postulante: "' . $fila1[$prefijo . 'apaterno'] . ' ' . $fila1[$prefijo . 'amaterno'] . ' ' . $fila1[$prefijo . 'nombre'] . '" con Nº de Documento: "' . $fila1[$prefijo . 'documento'] . '"';
                    $this->db->insert('logs_etiko', $logs);
                    redirect($this->controlador . 'editar/id/' . $id);
                }
            }
        }
    }

    function guardar_editar_recomendacion_observacion() {
        $formulario = 'recomendacion_observacion';
        $campo = array($this->prefijo . 'observacion');
        $campoF = array($this->prefijoF . 'recomendacion');
        $this->definir_datos_observacion_recomendacion();
        $prefijo = $this->prefijo;
        $prefijoF = $this->prefijoF;
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Editar Recomendación y Observación';
        $id = $this->input->post($this->prefijo . 'id');
        $consultaRecomendacion = $this->db->query('
        select com_id,com_nombre from combos where com_tipo=7 order by com_orden');
        $comboRecomendacion = $consultaRecomendacion->result_array('array');
        $newComboRecomendacion = array();

        foreach ($comboRecomendacion as $key => $value) {
            $newComboRecomendacion[$value['com_id']] = $value['com_nombre'];
        }
        if ($this->form_validation->run() == FALSE) {
            $fila[$this->prefijo . 'id'] = $id;

            $fila[$prefijo . 'observacion'] = $this->input->post($prefijo . 'observacion');
            $fila[$prefijoF . 'recomendacion'] = $this->input->post($prefijoF . 'recomendacion');

            $contenido['cabecera'] = $this->cabecera;
            $contenido['fila'] = $fila;
            $contenido['comboRecomendacion'] = $newComboRecomendacion;
            $contenido['action'] = $this->carpeta . 'guardar_editar_recomendacion_observacion';
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        } else {
            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            for ($i = 0; $i < count($campoF); $i++) {
                $dataF[$campoF[$i]] = $this->input->post($campoF[$i]);
            }


            $data[$this->prefijo . 'id'] = $id;
            $dataF[$this->prefijo . 'id'] = $id;
//                para modificar la fecha de edicion

            $data[$this->prefijo . 'fecha_edicion'] = date('Y-m-d H:i:s');
            $dataF[$this->prefijoF . 'fecha_edicion'] = date('Y-m-d H:i:s');
            if ($this->$modelo->editarObservacion($data) && $this->$modelo->editarRecomendacion($dataF)) {
                $consulta = $this->db->query('
                        SELECT * FROM postulante WHERE pos_id=' . $data[$this->prefijo . 'id']);
                $fila1 = $consulta->first_row('array');
                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                $logs['log_tabla_id'] = 'postulante - ' . $fila1[$this->prefijo . 'id'];
                $logs['log_modulo'] = 'Reportes';
                $logs['log_accion'] = 'Editar';
                $logs['log_fecha'] = date('Y-m-d H:i:s');
                $logs['log_comentario'] = 'Modificó la Recomendación y Observación del Postulante: "' . $fila1[$prefijo . 'apaterno'] . ' ' . $fila1[$prefijo . 'amaterno'] . ' ' . $fila1[$prefijo . 'nombre'] . '" con Nº de Documento: "' . $fila1[$prefijo . 'documento'] . '"';
                $this->db->insert('logs_etiko', $logs);
                redirect($this->controlador . 'editar/id/' . $id);
            }
        }
    }

    function editar_comentario() {
        $formulario = 'comentario_editar_form';
        $this->definir_comentario_form_editar();
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
        $consulta = $this->db->query('
        SELECT pos_id,pos_comentario FROM ' . $this->tabla . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $this->cabecera['accion'] = 'Editar Comentario Adicional';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['action'] = $this->controlador . 'guardar_editar_comentario';
        $contenido['fila'] = $fila;
        $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function guardar_editar_comentario() {
        $formulario = 'comentario_editar_form';
        $campo = array($this->prefijo . 'comentario');
        $this->definir_comentario_form_editar();
        $prefijo = $this->prefijo;
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Editar Comentario Adicional';
        $id = $this->input->post($this->prefijo . 'id');
        if ($this->form_validation->run() == FALSE) {
            $fila[$this->prefijo . 'id'] = $id;
            $contenido['cabecera'] = $this->cabecera;
            $contenido['fila'] = $fila;
            $contenido['action'] = $this->carpeta . 'guardar_editar_comentario';
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        } else {
            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            $data[$this->prefijo . 'id'] = $id;
            if ($this->$modelo->editar($data)) {
                $consulta = $this->db->query('
                        SELECT * FROM postulante WHERE pos_id=' . $data[$this->prefijo . 'id']);
                $fila1 = $consulta->first_row('array');
                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                $logs['log_tabla_id'] = 'postulante - ' . $fila1[$this->prefijo . 'id'];
                $logs['log_modulo'] = 'Reportes';
                $logs['log_accion'] = 'Editar';
                $logs['log_fecha'] = date('Y-m-d H:i:s');
                $logs['log_comentario'] = 'Modificó el comentario Adicional del Postulante: "' . $fila1[$prefijo . 'apaterno'] . ' ' . $fila1[$prefijo . 'amaterno'] . ' ' . $fila1[$prefijo . 'nombre'] . '" con Nº de Documento: "' . $fila1[$prefijo . 'documento'] . '"';
                $this->db->insert('logs_etiko', $logs);
                redirect($this->controlador . 'informacion_adicional/id/' . $id);
            }
        }
    }

    function instruccion_formal() {
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
        $consulta = $this->db->query('
        SELECT pos_id, pos_nombre, pos_apaterno, pos_amaterno, pos_documento  FROM ' . $this->tabla . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila_sup = $consulta->first_row('array');
        $this->cabecera['accion'] = 'Instrucción Formal';
        $this->campos_listar_postgrado = array('Desde', 'Hasta', 'Institución', 'País', 'Grado o Titulo', 'Área de Postgrado', 'Tema Tesis', 'Titulado');
        $this->campos_reales_postgrado = array($this->prefijo1 . 'desde', $this->prefijo1 . 'hasta', $this->prefijo1 . 'institucion', $this->prefijo1 . 'pais', $this->prefijo1 . 'grado', $this->prefijo1 . 'area', $this->prefijo1 . 'tema', $this->prefijo1 . 'titulado');
        $consulta = $this->db->query('
        SELECT *,
        case ' . $this->prefijo1 . 'titulado
        when "1" then "SI"
        else "NO"
        end as ' . $this->prefijo1 . 'titulado
        FROM ' . $this->tabla1 . '
        INNER JOIN combos
            ON com_id=edu_grado
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY com_orden asc'
        );
        $postgrado = $consulta->result_array();
        $this->campos_listar_superior = array('Desde', 'Hasta', 'Institución', 'País', 'Grado o Titulo', 'Profesión', 'Tema Tesis', 'Titulado');
        $this->campos_reales_superior = array($this->prefijo1 . 'desde', $this->prefijo1 . 'hasta', $this->prefijo1 . 'institucion', $this->prefijo1 . 'pais', $this->prefijo1 . 'grado', $this->prefijo1 . 'area', $this->prefijo1 . 'tema', $this->prefijo1 . 'titulado');
        $consulta = $this->db->query('
        SELECT *,
        case ' . $this->prefijo1 . 'titulado
        when "1" then "SI"
        else "NO"
        end as ' . $this->prefijo1 . 'titulado
        FROM ' . $this->tabla2 . '
        INNER JOIN combos
            ON com_id=edu_grado
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY com_orden asc'
        );
        $superior = $consulta->result_array();
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
        $contenido['cabecera'] = $this->cabecera;
        $contenido['id'] = $id;
        $contenido['campos_listar_postgrado'] = $this->campos_listar_postgrado;
        $contenido['campos_reales_postgrado'] = $this->campos_reales_postgrado;
        $contenido['postgrado'] = $postgrado;
        $contenido['campos_listar_superior'] = $this->campos_listar_superior;
        $contenido['campos_reales_superior'] = $this->campos_reales_superior;
        $contenido['superior'] = $superior;
        $contenido['campos_listar_secundaria'] = $this->campos_listar_secundaria;
        $contenido['campos_reales_secundaria'] = $this->campos_reales_secundaria;
        $contenido['secundaria'] = $secundaria;
        $contenido['campos_listar_publicacion'] = $this->campos_listar_publicacion;
        $contenido['campos_reales_publicacion'] = $this->campos_reales_publicacion;
        $contenido['publicacion'] = $publicacion;
        $contenido['fila_sup'] = $fila_sup;
        $data['contenido'] = $this->load->view($this->carpeta . 'listar_instruccion_formal', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function postgrado_nuevo() {
        $uri = $this->uri->uri_to_assoc(3);
        $ids = $uri['ids'];
        $formulario = 'postgrado_form';
        $campo = array($this->prefijo1 . 'desde', $this->prefijo1 . 'hasta', $this->prefijo1 . 'institucion', $this->prefijo1 . 'pais', $this->prefijo1 . 'grado', $this->prefijo1 . 'area', $this->prefijo1 . 'tema', $this->prefijo1 . 'nota', $this->prefijo1 . 'titulado');
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
            print_r($fila);
            $contenido['cabecera'] = $this->cabecera;
            $contenido['ids'] = $ids;
            $contenido['action'] = $this->carpeta . 'postgrado_nuevo/ids/' . $ids;
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        } else {
            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            $data[$this->prefijo . 'id'] = $ids;
            $id = $this->$modelo->agregar_postgrado($data);
            if ($id) {
                $consulta = $this->db->query('SELECT concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as nombre, pos_documento as documento FROM postulante WHERE pos_id=' . $ids);
                $pos = $consulta->first_row('array');
                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                $logs['log_tabla_id'] = 'educacion_post_grado - ' . $id;
                $logs['log_modulo'] = 'Reportes';
                $logs['log_accion'] = 'Nuevo';
                $logs['log_fecha'] = date('Y-m-d H:i:s');
                $logs['log_comentario'] = 'Agregó una Educación Post Grado al Postulante: "' . $pos['nombre'] . '" con Nº de Documento: "' . $pos['documento'] . '"';
                $this->db->insert('logs_etiko', $logs);
                redirect($this->controlador . 'instruccion_formal/id/' . $ids);
            }
        }
    }

    function editar_postgrado() {
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
        $contenido['ids'] = $fila['pos_id'];
        $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function guardar_editar_postgrado() {
        $formulario = 'postgrado_form';
        $campo = array($this->prefijo1 . 'desde', $this->prefijo1 . 'hasta', $this->prefijo1 . 'institucion', $this->prefijo1 . 'pais', $this->prefijo1 . 'grado', $this->prefijo1 . 'area', $this->prefijo1 . 'tema', $this->prefijo1 . 'nota', $this->prefijo1 . 'titulado');
        $this->definir_postgrado_form_agregar();
        $prefijo = $this->prefijo1;
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Educación Post Grado';
        $id = $this->input->post($this->prefijo1 . 'id');
        $ids = $this->input->post('ids');
        if ($this->form_validation->run() == FALSE) {
            $fila[$this->prefijo1 . 'id'] = $id;
            $fila[$prefijo . 'institucion'] = $this->input->post($prefijo . 'institucion');
            $fila[$prefijo . 'pais'] = $this->input->post($prefijo . 'pais');
            $fila[$prefijo . 'area'] = $this->input->post($prefijo . 'area');
            $fila[$prefijo . 'tema'] = $this->input->post($prefijo . 'tema');
            $contenido['cabecera'] = $this->cabecera;
            $contenido['fila'] = $fila;
            $contenido['ids'] = $ids;
            $contenido['action'] = $this->carpeta . 'guardar_editar_postgrado';
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        } else {
            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            $data[$this->prefijo1 . 'id'] = $id;
            if ($this->$modelo->editar_postgrado($data)) {
                $consulta = $this->db->query('SELECT concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as nombre, pos_documento as documento FROM postulante WHERE pos_id=' . $ids);
                $pos = $consulta->first_row('array');
                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                $logs['log_tabla_id'] = 'educacion_post_grado - ' . $id;
                $logs['log_modulo'] = 'Reportes';
                $logs['log_accion'] = 'Editar';
                $logs['log_fecha'] = date('Y-m-d H:i:s');
                $logs['log_comentario'] = 'Modificó una Educación Post Grado del Postulante: "' . $pos['nombre'] . '" con Nº de Documento: "' . $pos['documento'] . '"';
                $this->db->insert('logs_etiko', $logs);
                redirect($this->controlador . 'instruccion_formal/id/' . $ids);
            }
        }
    }

    function eliminar_postgrado($var, $id) {
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tabla1 . ' WHERE ' . $this->prefijo1 . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $ids = $fila['pos_id'];
        $this->db->delete($this->tabla1, array($this->prefijo1 . 'id' => $fila[$this->prefijo1 . 'id']));
        $consulta = $this->db->query('SELECT concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as nombre, pos_documento as documento FROM postulante WHERE pos_id=' . $ids);
        $pos = $consulta->first_row('array');
        $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
        $logs['log_tabla_id'] = 'educacion_post_grado - ' . $id;
        $logs['log_modulo'] = 'Reportes';
        $logs['log_accion'] = 'Eliminar';
        $logs['log_fecha'] = date('Y-m-d H:i:s');
        $logs['log_comentario'] = 'Eliminó una Educación Post Grado del Postulante: "' . $pos['nombre'] . '" con Nº de Documento: "' . $pos['documento'] . '"';
        $this->db->insert('logs_etiko', $logs);
        redirect($this->controlador . 'instruccion_formal/id/' . $ids);
    }

    function superior_nuevo() {
        $uri = $this->uri->uri_to_assoc(3);
        $ids = $uri['ids'];
        $formulario = 'superior_form';
        $campo = array($this->prefijo1 . 'desde', $this->prefijo1 . 'hasta', $this->prefijo1 . 'institucion', $this->prefijo1 . 'pais', $this->prefijo1 . 'grado', $this->prefijo1 . 'area', $this->prefijo1 . 'tema', $this->prefijo1 . 'nota', $this->prefijo1 . 'titulado');
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
            $contenido['action'] = $this->carpeta . 'superior_nuevo/ids/' . $ids;
            $contenido['ids'] = $ids;
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        } else {
            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            $data[$this->prefijo . 'id'] = $ids;
            $id = $this->$modelo->agregar_superior($data);
            if ($id) {
                $consulta = $this->db->query('SELECT concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as nombre, pos_documento as documento FROM postulante WHERE pos_id=' . $ids);
                $pos = $consulta->first_row('array');
                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                $logs['log_tabla_id'] = 'educacion_superior - ' . $id;
                $logs['log_modulo'] = 'Reportes';
                $logs['log_accion'] = 'Nuevo';
                $logs['log_fecha'] = date('Y-m-d H:i:s');
                $logs['log_comentario'] = 'Agregó una Educación Superior al Postulante: "' . $pos['nombre'] . '" con Nº de Documento: "' . $pos['documento'] . '"';
                $this->db->insert('logs_etiko', $logs);
                redirect($this->controlador . 'instruccion_formal/id/' . $ids);
            }
        }
    }

    function editar_superior() {
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
        $contenido['ids'] = $fila['pos_id'];
        $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function guardar_editar_superior() {
        $formulario = 'superior_form';
        $campo = array($this->prefijo1 . 'desde', $this->prefijo1 . 'hasta', $this->prefijo1 . 'institucion', $this->prefijo1 . 'pais', $this->prefijo1 . 'grado', $this->prefijo1 . 'area', $this->prefijo1 . 'tema', $this->prefijo1 . 'nota', $this->prefijo1 . 'titulado', $this->prefijo1 . 'area_otro');
        $this->definir_superior_form_agregar();
        $prefijo = $this->prefijo1;
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Editar Educación Superior';
        $id = $this->input->post($this->prefijo1 . 'id');
        $ids = $this->input->post('ids');
        if ($this->form_validation->run() == FALSE) {
            $fila[$this->prefijo1 . 'id'] = $id;
            $fila[$prefijo . 'institucion'] = $this->input->post($prefijo . 'institucion');
            $fila[$prefijo . 'pais'] = $this->input->post($prefijo . 'pais');
            $fila[$prefijo . 'tema'] = $this->input->post($prefijo . 'tema');
            $contenido['cabecera'] = $this->cabecera;
            $contenido['fila'] = $fila;
            $contenido['ids'] = $ids;
            $contenido['action'] = $this->carpeta . 'guardar_editar_superior';
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        } else {
            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            $data[$this->prefijo1 . 'id'] = $id;
            if ($this->$modelo->editar_superior($data)) {
                $consulta = $this->db->query('SELECT concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as nombre, pos_documento as documento FROM postulante WHERE pos_id=' . $ids);
                $pos = $consulta->first_row('array');
                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                $logs['log_tabla_id'] = 'educacion_superior - ' . $id;
                $logs['log_modulo'] = 'Reportes';
                $logs['log_accion'] = 'Editar';
                $logs['log_fecha'] = date('Y-m-d H:i:s');
                $logs['log_comentario'] = 'Modificó una Educación Superior del Postulante: "' . $pos['nombre'] . '" con Nº de Documento: "' . $pos['documento'] . '"';
                $this->db->insert('logs_etiko', $logs);
                redirect($this->controlador . 'instruccion_formal/id/' . $ids);
            }
        }
    }

    function eliminar_superior($var, $id) {
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tabla2 . ' WHERE ' . $this->prefijo1 . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $ids = $fila['pos_id'];
        $this->db->delete($this->tabla2, array($this->prefijo1 . 'id' => $fila[$this->prefijo1 . 'id']));
        $consulta = $this->db->query('SELECT concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as nombre, pos_documento as documento FROM postulante WHERE pos_id=' . $ids);
        $pos = $consulta->first_row('array');
        $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
        $logs['log_tabla_id'] = 'educacion_superior - ' . $id;
        $logs['log_modulo'] = 'Reportes';
        $logs['log_accion'] = 'Eliminar';
        $logs['log_fecha'] = date('Y-m-d H:i:s');
        $logs['log_comentario'] = 'Eliminó una Educación Superior del Postulante: "' . $pos['nombre'] . '" con Nº de Documento: "' . $pos['documento'] . '"';
        $this->db->insert('logs_etiko', $logs);
        redirect($this->controlador . 'instruccion_formal/id/' . $ids);
    }

    function secundaria_nuevo() {
        $uri = $this->uri->uri_to_assoc(3);
        $ids = $uri['ids'];
        $formulario = 'secundaria_form';
        $campo = array($this->prefijo1 . 'desde', $this->prefijo1 . 'hasta', $this->prefijo1 . 'institucion', $this->prefijo1 . 'pais');
        $this->definir_secundaria_form_agregar();
        $prefijo = $this->prefijo1;
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Educación Secundaria';
        if ($this->form_validation->run() == FALSE) {
            $fila[$prefijo . 'institucion'] = $this->input->post($prefijo . 'institucion');
            $fila[$prefijo . 'pais'] = $this->input->post($prefijo . 'pais');
            $contenido['fila'] = $fila;
            $contenido['cabecera'] = $this->cabecera;
            $contenido['action'] = $this->carpeta . 'secundaria_nuevo/ids/' . $ids;
            $contenido['ids'] = $ids;
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        } else {
            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            $data[$this->prefijo . 'id'] = $ids;
            $id = $this->$modelo->agregar_secundaria($data);
            if ($id) {
                $consulta = $this->db->query('SELECT concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as nombre, pos_documento as documento FROM postulante WHERE pos_id=' . $ids);
                $pos = $consulta->first_row('array');
                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                $logs['log_tabla_id'] = 'educacion_secundaria - ' . $id;
                $logs['log_modulo'] = 'Reportes';
                $logs['log_accion'] = 'Nuevo';
                $logs['log_fecha'] = date('Y-m-d H:i:s');
                $logs['log_comentario'] = 'Agregó una Educación Secundaria al Postulante: "' . $pos['nombre'] . '" con Nº de Documento: "' . $pos['documento'] . '"';
                $this->db->insert('logs_etiko', $logs);
                redirect($this->controlador . 'instruccion_formal/id/' . $ids);
            }
        }
    }

    function editar_secundaria() {
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
        $contenido['ids'] = $fila['pos_id'];
        $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function guardar_editar_secundaria() {
        $formulario = 'secundaria_form';
        $campo = array($this->prefijo1 . 'desde', $this->prefijo1 . 'hasta', $this->prefijo1 . 'institucion', $this->prefijo1 . 'pais');
        $this->definir_secundaria_form_agregar();
        $prefijo = $this->prefijo1;
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Editar Educación Superior';
        $id = $this->input->post($this->prefijo1 . 'id');
        $ids = $this->input->post('ids');
        if ($this->form_validation->run() == FALSE) {
            $fila[$this->prefijo1 . 'id'] = $id;
            $fila[$prefijo . 'institucion'] = $this->input->post($prefijo . 'institucion');
            $fila[$prefijo . 'pais'] = $this->input->post($prefijo . 'pais');
            $contenido['cabecera'] = $this->cabecera;
            $contenido['fila'] = $fila;
            $contenido['ids'] = $ids;
            $contenido['action'] = $this->carpeta . 'guardar_editar_secundaria';
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        } else {
            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            $data[$this->prefijo1 . 'id'] = $id;
            if ($this->$modelo->editar_secundaria($data)) {
                $consulta = $this->db->query('SELECT concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as nombre, pos_documento as documento FROM postulante WHERE pos_id=' . $ids);
                $pos = $consulta->first_row('array');
                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                $logs['log_tabla_id'] = 'educacion_secundaria - ' . $id;
                $logs['log_modulo'] = 'Reportes';
                $logs['log_accion'] = 'Editar';
                $logs['log_fecha'] = date('Y-m-d H:i:s');
                $logs['log_comentario'] = 'Modificó una Educación Secundaria del Postulante: "' . $pos['nombre'] . '" con Nº de Documento: "' . $pos['documento'] . '"';
                $this->db->insert('logs_etiko', $logs);
                redirect($this->controlador . 'instruccion_formal/id/' . $ids);
            }
        }
    }

    function eliminar_secundaria($var, $id) {
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tabla3 . ' WHERE ' . $this->prefijo1 . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $ids = $fila['pos_id'];
        $this->db->delete($this->tabla3, array($this->prefijo1 . 'id' => $fila[$this->prefijo1 . 'id']));
        $consulta = $this->db->query('SELECT concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as nombre, pos_documento as documento FROM postulante WHERE pos_id=' . $ids);
        $pos = $consulta->first_row('array');
        $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
        $logs['log_tabla_id'] = 'educacion_secundaria - ' . $id;
        $logs['log_modulo'] = 'Reportes';
        $logs['log_accion'] = 'Eliminar';
        $logs['log_fecha'] = date('Y-m-d H:i:s');
        $logs['log_comentario'] = 'Eliminó una Educación Secundaria del Postulante: "' . $pos['nombre'] . '" con Nº de Documento: "' . $pos['documento'] . '"';
        $this->db->insert('logs_etiko', $logs);
        redirect($this->controlador . 'instruccion_formal/id/' . $ids);
    }

    function publicacion_nuevo() {
        $uri = $this->uri->uri_to_assoc(3);
        $ids = $uri['ids'];
        $formulario = 'publicacion_form';
        $campo = array($this->prefijo2 . 'titulo', $this->prefijo2 . 'anio');
        $this->definir_publicacion_form_agregar();
        $prefijo = $this->prefijo2;
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Publicaciones';
        if ($this->form_validation->run() == FALSE) {
            $fila[$prefijo . 'titulo'] = $this->input->post($prefijo . 'titulo');
            $contenido['cabecera'] = $this->cabecera;
            $contenido['fila'] = $fila;
            $contenido['action'] = $this->carpeta . 'publicacion_nuevo/ids/' . $ids;
            $contenido['ids'] = $ids;
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        } else {
            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            $data[$this->prefijo . 'id'] = $ids;
            $id = $this->$modelo->agregar_publicacion($data);
            if ($id) {
                $consulta = $this->db->query('SELECT concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as nombre, pos_documento as documento FROM postulante WHERE pos_id=' . $ids);
                $pos = $consulta->first_row('array');
                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                $logs['log_tabla_id'] = 'publicaciones - ' . $id;
                $logs['log_modulo'] = 'Reportes';
                $logs['log_accion'] = 'Nuevo';
                $logs['log_fecha'] = date('Y-m-d H:i:s');
                $logs['log_comentario'] = 'Agregó una Publicación al Postulante: "' . $pos['nombre'] . '" con Nº de Documento: "' . $pos['documento'] . '"';
                $this->db->insert('logs_etiko', $logs);
                redirect($this->controlador . 'instruccion_formal/id/' . $ids);
            }
        }
    }

    function editar_publicacion() {
        $formulario = 'publicacion_form';
        $this->definir_publicacion_form_agregar();
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tabla4 . ' WHERE ' . $this->prefijo2 . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $this->cabecera['accion'] = 'Editar Publicación';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['action'] = $this->controlador . 'guardar_editar_publicacion';
        $contenido['fila'] = $fila;
        $contenido['ids'] = $fila['pos_id'];
        $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function guardar_editar_publicacion() {
        $formulario = 'publicacion_form';
        $campo = array($this->prefijo2 . 'titulo', $this->prefijo2 . 'anio');
        $this->definir_publicacion_form_agregar();
        $prefijo = $this->prefijo2;
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Editar Publicación';
        $id = $this->input->post($this->prefijo2 . 'id');
        $ids = $this->input->post('ids');
        if ($this->form_validation->run() == FALSE) {
            $fila[$this->prefijo2 . 'id'] = $id;
            $fila[$prefijo . 'titulo'] = $this->input->post($prefijo . 'titulo');
            $contenido['cabecera'] = $this->cabecera;
            $contenido['fila'] = $fila;
            $contenido['ids'] = $ids;
            $contenido['action'] = $this->carpeta . 'guardar_editar_publicacion';
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        } else {
            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            $data[$this->prefijo2 . 'id'] = $id;
            if ($this->$modelo->editar_publicacion($data)) {
                $consulta = $this->db->query('SELECT concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as nombre, pos_documento as documento FROM postulante WHERE pos_id=' . $ids);
                $pos = $consulta->first_row('array');
                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                $logs['log_tabla_id'] = 'publicaciones - ' . $id;
                $logs['log_modulo'] = 'Reportes';
                $logs['log_accion'] = 'Editar';
                $logs['log_fecha'] = date('Y-m-d H:i:s');
                $logs['log_comentario'] = 'Modificó una Publicación del Postulante: "' . $pos['nombre'] . '" con Nº de Documento: "' . $pos['documento'] . '"';
                $this->db->insert('logs_etiko', $logs);
                redirect($this->controlador . 'instruccion_formal/id/' . $ids);
            }
        }
    }

    function eliminar_publicacion($var, $id) {
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tabla4 . ' WHERE ' . $this->prefijo2 . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $ids = $fila['pos_id'];
        $this->db->delete($this->tabla4, array($this->prefijo2 . 'id' => $fila[$this->prefijo2 . 'id']));
        $consulta = $this->db->query('SELECT concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as nombre, pos_documento as documento FROM postulante WHERE pos_id=' . $ids);
        $pos = $consulta->first_row('array');
        $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
        $logs['log_tabla_id'] = 'publicaciones - ' . $id;
        $logs['log_modulo'] = 'Reportes';
        $logs['log_accion'] = 'Eliminar';
        $logs['log_fecha'] = date('Y-m-d H:i:s');
        $logs['log_comentario'] = 'Eliminó una Publicación del Postulante: "' . $pos['nombre'] . '" con Nº de Documento: "' . $pos['documento'] . '"';
        $this->db->insert('logs_etiko', $logs);
        redirect($this->controlador . 'instruccion_formal/id/' . $ids);
    }

    function trayectoria_laboral() {
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
        $consulta = $this->db->query('
        SELECT pos_id, pos_nombre, pos_apaterno, pos_amaterno, pos_documento  FROM ' . $this->tabla . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila_sup = $consulta->first_row('array');
        $this->cabecera['accion'] = 'Trayectoria Laboral';
        $this->campos_listar_trayectoria = array('Desde', 'Hasta', 'Nombre Organización', 'País/ciudad', 'Cargo(s) Ocupado(s)', 'Sueldo por Mes', 'Teléfono Oranización', 'Nombre, Telf., Email Inmediato Superios');
        $this->campos_reales_trayectoria = array($this->prefijo3 . 'desde', $this->prefijo3 . 'hasta', $this->prefijo3 . 'organizacion', $this->prefijo3 . 'pais', $this->prefijo3 . 'cargos', $this->prefijo3 . 'sueldo', $this->prefijo3 . 'telefono_org', 'superior');
        $consulta = $this->db->query('
        SELECT *, concat(tra_nombre_sup," - ",tra_telefono_sup," - ",tra_email_sup) as superior
        FROM ' . $this->tabla5 . '
        WHERE ' . $this->prefijo . 'id=' . $id . '
        ORDER BY
        ' . $this->prefijo3 . 'hasta desc'
        );
        $trayectorias = $consulta->result_array();
        $consulta = $this->db->query('
        SELECT pof_ambito_exp as sin,pof_area_exp,pof_sector_exp,pof_supervisar_exp
        FROM postulante_f
        WHERE pos_id=' . $id);
        $sintesis = $consulta->row_array();
        $contenido['cabecera'] = $this->cabecera;
        $contenido['id'] = $id;
        //$contenido['ant'] = $ant; borrado en el proceso de revision editar trayectoria
        $contenido['ant'] = '';
        $contenido['sintesis'] = $sintesis;
        $contenido['campos_listar_trayectoria'] = $this->campos_listar_trayectoria;
        $contenido['campos_reales_trayectoria'] = $this->campos_reales_trayectoria;
        $contenido['trayectorias'] = $trayectorias;
        $contenido['fila_sup'] = $fila_sup;
        $data['contenido'] = $this->load->view($this->carpeta . 'listar_trayectoria_laboral', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function trayectoria_nuevo() {
        $uri = $this->uri->uri_to_assoc(3);
        $ids = $uri['ids'];
        $formulario = 'trayectoria_form';
        $campo = array($this->prefijo3 . 'desde', $this->prefijo3 . 'hasta', $this->prefijo3 . 'organizacion', $this->prefijo3 . 'tipo_org', $this->prefijo3 . 'descripcion_org', $this->prefijo3 . 'funciones_org', $this->prefijo3 . 'logros', $this->prefijo3 . 'pais', $this->prefijo3 . 'cargos',
            $this->prefijo3 . 'nsubordinados', $this->prefijo3 . 'sueldo', $this->prefijo3 . 'telefono_org', $this->prefijo3 . 'nombre_sup', $this->prefijo3 . 'telefono_sup', $this->prefijo3 . 'email_sup', $this->prefijo3 . 'actual');
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
            $contenido['action'] = $this->carpeta . 'trayectoria_nuevo/ids/' . $ids;
            $contenido['ids'] = $ids;
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        } else {
            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            $data[$this->prefijo . 'id'] = $ids;
            $id = $this->$modelo->agregar_trayectoria($data);
            if ($id) {
                $consulta = $this->db->query('SELECT concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as nombre, pos_documento as documento FROM postulante WHERE pos_id=' . $ids);
                $pos = $consulta->first_row('array');
                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                $logs['log_tabla_id'] = 'trayectoria_laboral - ' . $id;
                $logs['log_modulo'] = 'Reportes';
                $logs['log_accion'] = 'Nuevo';
                $logs['log_fecha'] = date('Y-m-d H:i:s');
                $logs['log_comentario'] = 'Agregó una Experiencia Laboral al Postulante: "' . $pos['nombre'] . '" con Nº de Documento: "' . $pos['documento'] . '"';
                $this->db->insert('logs_etiko', $logs);
                redirect($this->controlador . 'trayectoria_laboral/id/' . $ids);
            }
        }
    }

    function editar_trayectoria() {
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
        $contenido['ids'] = $fila['pos_id'];
        $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
        $this->load->view('plantilla_privado', $data);
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
        $ids = $this->input->post('ids');
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
            $contenido['ids'] = $ids;
            $contenido['action'] = $this->carpeta . 'guardar_editar_trayectoria';
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        } else {
            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            $data[$this->prefijo3 . 'id'] = $id;
            if ($this->$modelo->editar_trayectoria($data)) {
                $consulta = $this->db->query('SELECT concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as nombre, pos_documento as documento FROM postulante WHERE pos_id=' . $ids);
                $pos = $consulta->first_row('array');
                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                $logs['log_tabla_id'] = 'trayectoria_laboral - ' . $id;
                $logs['log_modulo'] = 'Reportes';
                $logs['log_accion'] = 'Editar';
                $logs['log_fecha'] = date('Y-m-d H:i:s');
                $logs['log_comentario'] = 'Modificó una Experiencia Laboral del Postulante: "' . $pos['nombre'] . '" con Nº de Documento: "' . $pos['documento'] . '"';
                $this->db->insert('logs_etiko', $logs);
                redirect($this->controlador . 'trayectoria_laboral/id/' . $ids);
            }
        }
    }

    function eliminar_trayectoria($var, $id) {
        $this->boton_actual = 'Trayectoria Laboral';
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tabla5 . ' WHERE ' . $this->prefijo3 . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $ids = $fila['pos_id'];
        $this->db->delete($this->tabla5, array($this->prefijo3 . 'id' => $fila[$this->prefijo3 . 'id']));
        $consulta = $this->db->query('SELECT concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as nombre, pos_documento as documento FROM postulante WHERE pos_id=' . $ids);
        $pos = $consulta->first_row('array');
        $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
        $logs['log_tabla_id'] = 'trayectoria_laboral - ' . $id;
        $logs['log_modulo'] = 'Reportes';
        $logs['log_accion'] = 'Eliminar';
        $logs['log_fecha'] = date('Y-m-d H:i:s');
        $logs['log_comentario'] = 'Eliminó una Experiencia Laboral del Postulante: "' . $pos['nombre'] . '" con Nº de Documento: "' . $pos['documento'] . '"';
        $this->db->insert('logs_etiko', $logs);
        redirect($this->controlador . 'trayectoria_laboral/id/' . $ids);
    }

    function editar_experiencia_sintesis() {
        $formulario = 'experiencia_sintesis_form';
        $this->definir_experiencia_sintesis_form_editar();
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tablaF . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $this->cabecera['accion'] = 'Síntesis de Experiencia Laboral';
//        print_r($fila);
        $contenido['cabecera'] = $this->cabecera;
        $contenido['action'] = $this->controlador . 'guardar_editar_experiencia_sintesis';
        $contenido['fila'] = $fila;
        $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function guardar_editar_experiencia_sintesis() {
        $this->boton_actual = 'Trayectoria Laboral';
        $formulario = 'experiencia_sintesis_form';
        $prefijo = 'pof_';
        $campof = array($prefijo . 'ambito_exp', $prefijo . 'area_exp', $prefijo . 'sector_exp', $prefijo . 'supervisar_exp');
        $this->definir_experiencia_sintesis_form_editar();
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Síntesis de Experiencia Laboral';
        $id = $this->input->post($this->prefijo . 'id');
        if ($this->form_validation->run() == FALSE) {
            $fila[$this->prefijo . 'id'] = $id;
            $fila[$prefijo . 'ambito_exp1'] = $this->input->post($this->prefijoF . 'ambito_exp1');
            $fila[$prefijo . 'ambito_exp2'] = $this->input->post($this->prefijoF . 'ambito_exp2');
            $fila[$prefijo . 'ambito_exp3'] = $this->input->post($this->prefijoF . 'ambito_exp3');
            $fila[$prefijo . 'area_exp'] = implode(',', $this->input->post($this->prefijoF . 'area_exp'));
            $fila[$prefijo . 'sector_exp'] = implode(',', $this->input->post($this->prefijoF . 'sector_exp'));
            $fila[$prefijo . 'supervisar_exp'] = $this->input->post($this->prefijoF . 'supervisar_exp');
            $fila[$prefijo . 'max_nivel'] = $this->input->post($this->prefijoF . 'max_nivel');
            $fila[$prefijo . 'max_nivel_no'] = $this->input->post($this->prefijoF . 'max_nivel_no');
            $fila[$prefijo . 'anios_exp'] = $this->input->post($this->prefijoF . 'anios_exp');
            print_r($fila);
            $contenido['cabecera'] = $this->cabecera;
            $contenido['fila'] = $fila;
            $contenido['action'] = $this->carpeta . 'guardar_editar_experiencia_sintesis';
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_privado', $data);
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
            echo $data[$prefijo . 'supervisar_exp'];
            if ($data[$prefijo . 'supervisar_exp'] == 'si') {
                $data[$prefijo . 'max_nivel'] = $this->input->post($this->prefijoF . 'max_nivel');
                $data[$prefijo . 'anios_exp'] = $this->input->post($this->prefijoF . 'anios_exp');
                $data[$prefijo . 'max_nivel_no'] = '0';
            } else {
                $data[$prefijo . 'max_nivel_no'] = $this->input->post($this->prefijoF . 'max_nivel_no');
                $data[$prefijo . 'max_nivel'] = '0';
                $data[$prefijo . 'anios_exp'] = '';
            }
            print_r($data);
            $stringAreaExperiencia = implode(',', $data[$this->prefijoF . "area_exp"]);
            $stringSectorExperiencia = implode(',', $data[$this->prefijoF . "sector_exp"]);
            ;
            $data[$this->prefijoF . "area_exp"] = $stringAreaExperiencia;
            $data[$this->prefijoF . "sector_exp"] = $stringSectorExperiencia;
            $data[$this->prefijo . 'id'] = $id;
//            exit();
            if ($this->$modelo->editarF($data)) {
                $consulta = $this->db->query('SELECT concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as nombre, pos_documento as documento FROM postulante WHERE pos_id=' . $id);
                $pos = $consulta->first_row('array');
                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                $logs['log_tabla_id'] = 'postulante - ' . $id;
                $logs['log_modulo'] = 'Reportes';
                $logs['log_accion'] = 'Editar';
                $logs['log_fecha'] = date('Y-m-d H:i:s');
                $logs['log_comentario'] = 'Modificó la Síntesis de Experiencia Laboral del Postulante: "' . $pos['nombre'] . '" con Nº de Documento: "' . $pos['documento'] . '"';
                $this->db->insert('logs_etiko', $logs);
                redirect($this->controlador . 'trayectoria_laboral/id/' . $id);
            }
        }
    }

    function informacion_adicional() {
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
        $consulta = $this->db->query('
        SELECT pos_id, pos_nombre, pos_apaterno, pos_amaterno, pos_documento,pos_comentario  FROM ' . $this->tabla . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila_sup = $consulta->first_row('array');
        $this->cabecera['accion'] = 'Información Adicional';
        $this->campos_listar_idioma = array('Idioma', 'Habla', 'Lee', 'Escribe');
        $this->campos_reales_idioma = array('idioma', $this->prefijoPI . 'habla', $this->prefijoPI . 'lee', $this->prefijoPI . 'escribe');
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
        IF(p.idi_id!=4, ' . $this->prefijo6 . 'idioma,CONCAT(' . $this->prefijo6 . 'idioma,"-",' . $this->prefijoPI . 'idioma_otro)) as idioma,
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
        WHERE p.' . $this->prefijo . 'id=' . $id . ' and ' . $this->prefijoPI . 'tipo=1
        ORDER BY
        ' . $this->prefijoPI . 'id asc'
        );
        $idiomas = $consulta->result_array();
        $idiomaIngles = $consultaIngles->row_array();
        if (!$idiomaIngles) {
            $consultaIngles = $this->db->query('select idi_idioma as idioma from idiomas where idi_id=1');
            $idiomaIngles = $consultaIngles->first_row('array');
            $idiomaIngles[$this->prefijoPI . 'habla'] = 's/n';
            $idiomaIngles[$this->prefijoPI . 'lee'] = 's/n';
            $idiomaIngles[$this->prefijoPI . 'escribe'] = 's/n';
            $idiomaIngles[$this->prefijoPI . 'id'] = 0;
        }

        $contenido['fila'] = $idiomaIngles;
        $contenido['cabecera'] = $this->cabecera;
        $contenido['id'] = $id;
        $contenido['campos_listar_idioma'] = $this->campos_listar_idioma;
        $contenido['campos_reales_idioma'] = $this->campos_reales_idioma;
        $contenido['idiomas'] = $idiomas;
        $contenido['fila_sup'] = $fila_sup;
        $data['contenido'] = $this->load->view($this->carpeta . 'listar_informacion_adicional', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function idioma_nuevo() {
        $uri = $this->uri->uri_to_assoc(3);
        $ids = $uri['ids'];
        $enlaceIngles = "";

        $formulario = 'idioma_form';
        $campo = array($this->prefijo4 . 'idioma', $this->prefijo4 . 'habla', $this->prefijo4 . 'lee', $this->prefijo4 . 'escribe');
        $this->definir_idioma_form_agregar();
        $prefijo = $this->prefijo4;
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Información Adicional';
        $campo = array($this->prefijo4 . 'id', $this->prefijoPI . 'habla', $this->prefijoPI . 'lee', $this->prefijoPI . 'escribe', $this->prefijoPI . 'idioma_otro');
        $this->definir_idioma_form_agregar();
        $prefijo = $this->prefijoPI;
        $modelo = $this->modelo;
        $consulta = $this->db->query('
                    SELECT * FROM ' . $this->tabla6
                . ' where idi_id<>1');
        $idiomas = $consulta->result_array();
        if ($this->form_validation->run() == FALSE) {
            if (@$uri['id'] == 0 && @$uri['id'] != "") {
                $enlaceIngles = '/id/' . $uri['id'];
                $consultaIngles = $this->db->query('select * from idiomas where idi_id=1');
                $fila = $consultaIngles->first_row('array');
            } else {
                $fila[$this->prefijo4 . 'id'] = $this->input->post('idi_id');
            }
            $fila[$prefijo . 'habla'] = $this->input->post($prefijo . 'habla');
            $fila[$prefijo . 'lee'] = $this->input->post($prefijo . 'lee');
            $fila[$prefijo . 'escribe'] = $this->input->post($prefijo . 'escribe');
            $fila[$prefijo . 'idioma_otro'] = $this->input->post($prefijo . 'idioma_otro');
            $contenido['fila'] = $fila;
            $contenido['cabecera'] = $this->cabecera;
            $contenido['action'] = $this->carpeta . 'idioma_nuevo/ids/' . $ids . $enlaceIngles;
            $contenido['ids'] = $ids;
            $contenido['idiomas'] = $idiomas;
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        } else {
            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            $data[$this->prefijo . 'id'] = $ids;
            if ($data[$this->prefijo4 . 'id'] == 1) {
                $data[$this->prefijoPI . 'tipo'] = 1;
            }
            $id = $this->$modelo->agregar_idioma($data);
            if ($id) {
                $consulta = $this->db->query('SELECT concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as nombre, pos_documento as documento FROM postulante WHERE pos_id=' . $ids);
                $pos = $consulta->first_row('array');
                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                $logs['log_tabla_id'] = 'idiomas - ' . $id;
                $logs['log_modulo'] = 'Reportes';
                $logs['log_accion'] = 'Nuevo';
                $logs['log_fecha'] = date('Y-m-d H:i:s');
                $logs['log_comentario'] = 'Agregó una Idioma al Postulante: "' . $pos['nombre'] . '" con Nº de Documento: "' . $pos['documento'] . '"';
                $this->db->insert('logs_etiko', $logs);
                redirect($this->controlador . 'informacion_adicional/id/' . $ids);
            }
        }
    }

    function editar_idioma() {
        $formulario = 'idioma_form';
        $this->definir_idioma_form_agregar();
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
//        $consulta = $this->db->query('
//        SELECT * FROM ' . $this->tabla6 . ' WHERE ' . $this->prefijo4 . 'id=' . $id);
        $consulta = $this->db->query('
        SELECT poi_id,pos_id,poi_idioma_otro,poi_habla,poi_lee,poi_escribe,idi_idioma,a.idi_id FROM ' . $this->tablaPI . ' as a
            inner join idiomas as b
            on a.idi_id=b.idi_id
                WHERE ' . $this->prefijoPI . 'id=' . $id);
//        $consulta = $this->db->query('
//        SELECT * FROM ' . $this->tablaPI . ' WHERE ' . $this->prefijoPI . 'id=' . $id);


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
        $contenido['ids'] = $fila['pos_id'];
        $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function guardar_editar_idioma() {
        $formulario = 'idioma_form';
//        $campo = array($this->prefijo4 . 'idioma', $this->prefijo4 . 'habla', $this->prefijo4 . 'lee', $this->prefijo4 . 'escribe');
        $campo = array($this->prefijo4 . 'id', $this->prefijoPI . 'habla', $this->prefijoPI . 'lee', $this->prefijoPI . 'escribe', $this->prefijoPI . 'idioma_otro');
        $this->definir_idioma_form_agregar();
        $prefijo = $this->prefijoPI;
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Editar Idioma';
        $id = $this->input->post($this->prefijoPI . 'id');
        $ids = $this->input->post('ids');
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
            print_r($fila);
            $contenido['fila'] = $fila;
            $contenido['ids'] = $ids;
            $contenido['idiomas'] = $idiomas;
            $contenido['action'] = $this->carpeta . 'guardar_editar_idioma';
            $data['contenido'] = $this->load->view($this->carpeta . $formulario, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        } else {
            for ($i = 0; $i < count($campo); $i++) {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
            }
            $data[$this->prefijoPI . 'id'] = $id;
            if ($this->$modelo->editar_idioma($data)) {
                $consulta = $this->db->query('SELECT concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as nombre, pos_documento as documento FROM postulante WHERE pos_id=' . $ids);
                $pos = $consulta->first_row('array');
                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                $logs['log_tabla_id'] = 'idiomas - ' . $id;
                $logs['log_modulo'] = 'Reportes';
                $logs['log_accion'] = 'Editar';
                $logs['log_fecha'] = date('Y-m-d H:i:s');
                $logs['log_comentario'] = 'Modificó un Idioma del Postulante: "' . $pos['nombre'] . '" con Nº de Documento: "' . $pos['documento'] . '"';
                $this->db->insert('logs_etiko', $logs);
                redirect($this->controlador . 'informacion_adicional/id/' . $ids);
            }
        }
    }

    function eliminar_idioma($var, $id) {
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tablaPI . ' WHERE ' . $this->prefijoPI . 'id=' . $id);

        $fila = $consulta->first_row('array');
        $ids = $fila['pos_id'];
//        $this->db->delete($this->tabla6, array($this->prefijo4 . 'id' => $fila[$this->prefijo4 . 'id']));
        $this->db->delete($this->tablaPI, array($this->prefijoPI . 'id' => $fila[$this->prefijoPI . 'id']));
        $consulta = $this->db->query('SELECT concat(pos_apaterno," ",pos_amaterno," ",pos_nombre) as nombre, pos_documento as documento FROM postulante WHERE pos_id=' . $ids);
        $pos = $consulta->first_row('array');
        $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
        $logs['log_tabla_id'] = 'idiomas - ' . $id;
        $logs['log_modulo'] = 'Reportes';
        $logs['log_accion'] = 'Eliminar';
        $logs['log_fecha'] = date('Y-m-d H:i:s');
        $logs['log_comentario'] = 'Eliminó un Idioma del Postulante: "' . $pos['nombre'] . '" con Nº de Documento: "' . $pos['documento'] . '"';
        $this->db->insert('logs_etiko', $logs);
        redirect($this->controlador . 'informacion_adicional/id/' . $ids);
    }

    function eliminar($var, $id) {

        $ruta_origen = $this->ruta;
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tabla . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $this->db->delete('educacion_post_grado', array($this->prefijo . 'id' => $fila[$this->prefijo . 'id']));
        $this->db->delete('educacion_superior', array($this->prefijo . 'id' => $fila[$this->prefijo . 'id']));
        $this->db->delete('educacion_secundaria', array($this->prefijo . 'id' => $fila[$this->prefijo . 'id']));
        $this->db->delete('publicaciones', array($this->prefijo . 'id' => $fila[$this->prefijo . 'id']));
        $this->db->delete('trayectoria_laboral', array($this->prefijo . 'id' => $fila[$this->prefijo . 'id']));
        $this->db->delete('postulante_idioma', array($this->prefijo . 'id' => $fila[$this->prefijo . 'id']));
        $this->db->delete('postulante_f', array($this->prefijo . 'id' => $fila[$this->prefijo . 'id']));
        $this->db->delete('convocatoria_postulacion', array($this->prefijo . 'id' => $fila[$this->prefijo . 'id']));
        $this->db->delete('etapas', array($this->prefijo . 'id' => $fila[$this->prefijo . 'id']));
        $this->db->delete($this->tabla, array($this->prefijo . 'id' => $fila[$this->prefijo . 'id']));
        redirect($this->controlador . 'listar');
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
            array(
                'field' => $prefijo . 'direccion',
                'label' => 'Direccion',
                'rules' => 'required'
            ),
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

    function definir_datos_observacion_recomendacion() {
        $prefijo = $this->prefijo;
        $config = $this->set_reglas_validacion_observacion_recomendacion();

        $mensajes = $this->set_mensajes_error();
        // inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach ($mensajes as $msj)
            $this->form_validation->set_message($msj['regla'], $msj['mensaje']);
        // inicio asignando las reglas y mensajes de validacion
    }

    function set_reglas_validacion_observacion_recomendacion() {
        $prefijo = $this->prefijo;
        $prefijoF = $this->prefijoF;
        $config = array(
            array(
                'field' => $prefijo . 'observacion',
                'label' => 'Observación',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijoF . 'recomendacion',
                'label' => 'Recomendación',
                'rules' => 'required'
            )
        );
        return $config;
    }

    function definir_comentario_form_editar() {
        $prefijo = $this->prefijo;
        $config = $this->set_reglas_validacion_comentario_editar();
        $mensajes = $this->set_mensajes_error();
        // inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach ($mensajes as $msj)
            $this->form_validation->set_message($msj['regla'], $msj['mensaje']);
        // inicio asignando las reglas y mensajes de validacion
    }

    function set_reglas_validacion_comentario_editar() {
        $prefijo = $this->prefijo;
        $config = array(
            array(
                'field' => $prefijo . 'comentario',
                'label' => 'Comentario',
                'rules' => 'required'
            )
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
                'label' => 'Institucion',
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
                'rules' => 'required'
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
                'label' => 'Institucion',
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
                'label' => 'Institucion',
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
            array(
                'field' => $prefijo . 'funciones_org',
                'label' => '3 Principales Funciones Desempeñadas dentro del Cargo',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'logros',
                'label' => 'Principales Logros',
                'rules' => 'required'
            ),
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
                'rules' => 'required'
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
                'label' => 'Ciudad - País',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'nsubordinados',
                'label' => 'Nº de Subordinados',
                'rules' => 'is_numeric'
            ),
            array(
                'field' => $prefijo . 'actual',
                'label' => 'Actualmente trabajando'
                //'rules' => 'min_length(0)'
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
        $prefijo = $this->prefijoF;
        $config = array(
//            array(
//                'field' => $prefijo . 'area_exp',
//                'label' => 'Área de Experiencia',
//                'rules' => 'is_natural'
//            ),
//            array(
//                'field' => $prefijo . 'sector_exp',
//                'label' => 'Sector de Experiencia',
//                'rules' => 'is_natural'
//            ),
            array(
                'field' => $prefijo . 'anios_exp',
                'label' => 'Años de Experiencia en Supervisión',
                'rules' => 'min_length(0)'
            ),
            array(
                'field' => $prefijo . 'supervisar_exp',
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
        foreach ($mensajes as $msj)
            $this->form_validation->set_message($msj['regla'], $msj['mensaje']);
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
                'rules' => 'min_length(0)'
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
                'rules' => 'min_length(0)'
            ),
            array(
                'field' => $prefijo . 'telefono',
                'label' => 'Telefono',
                'rules' => 'min_length(0)'
            ),
            array(
                'field' => $prefijo . 'institucion',
                'label' => 'Institución',
                'rules' => 'min_length(0)'
            ),
            array(
                'field' => $prefijo . 'pais',
                'label' => 'País',
                'rules' => 'min_length(0)'
            ),
            array(
                'field' => $prefijo . 'comentario',
                'label' => 'Comentario',
                'rules' => 'min_length(0)'
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

}

?>