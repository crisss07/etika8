<?php

require_once('Controladoradmin.php');

class Reportes extends Controladoradmin {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html'));
        $this->load->library(array('form_validation', 'tool_general'));

        //****** definiendo nombre de carpeta por defecto
        $this->carpeta = 'reportes/';
        $this->controlador = 'reportes/';

        $this->rutaimg = $this->tool_entidad->constantes['nombresitio'] . 'files/img/';
        $this->action_defecto = 'listar';

        $this->cabecera['titulo'] = 'Reportes';
        $consulta = $this->db->query('
        SELECT pof_pais_ciudad as nombre
        FROM postulante_f
        GROUP BY pof_pais_ciudad
        ORDER BY pof_pais_ciudad asc'
        );
        $residencias = $consulta->result_array();
        foreach ($residencias as $grado) {
            if (!is_numeric($grado['nombre']))
                $this->residencias[$grado['nombre']] = $grado['nombre'];
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
        WHERE com_tipo="7"
        ORDER BY com_orden asc'
        );
        $recomendaciones = $consulta->result_array();
        foreach ($recomendaciones as $grado) {
            $this->recomendaciones[$grado['id']] = $grado['nombre'];
        }
        $consulta = $this->db->query('
        SELECT cli_id as id, cli_nombre as nombre
        FROM clientes
        ORDER BY cli_nombre asc'
        );
        $clientes = $consulta->result_array();
        foreach ($clientes as $grado) {
            $this->clientes[$grado['id']] = $grado['nombre'];
        }
        $consulta = $this->db->query('
        SELECT con_id as id, con_cargo as nombre
        FROM convocatoria
        ORDER BY con_cargo asc'
        );
        $cargos = $consulta->result_array();
        foreach ($cargos as $grado) {
            $this->cargos[$grado['id']] = $grado['nombre'];
        }
        $this->instancias[1] = 'EP';
        $this->instancias[2] = 'TP';
        $this->instancias[3] = 'Assesment';
        $this->instancias[4] = 'Entrevista';
        $this->instancias[5] = 'Finalista';
        $this->instancias[6] = 'Elegido';
        // ETIKOS

        $consulta = $this->db->query('
        SELECT com_id as id, com_nombre as nombre
        FROM combos
        WHERE com_tipo="8"
        ORDER BY com_orden asc'
        );
        $servicios = $consulta->result_array();
        foreach ($servicios as $grado) {
            $this->servicios[$grado['id']] = $grado['nombre'];
        }
        $consulta = $this->db->query('
        SELECT eti_id as id, eti_nombre as nombre
        FROM etiko
        ORDER BY nombre asc'
        );
        $etikos = $consulta->result_array();
        foreach ($etikos as $grado) {
            $this->etikos[$grado['id']] = $grado['nombre'];
        }
        $consulta = $this->db->query('
        SELECT con_sede as nombre
        FROM convocatoria
        GROUP BY nombre
        ORDER BY nombre asc'
        );
        $sedes = $consulta->result_array();
        foreach ($sedes as $grado) {
            $this->sedes[$grado['nombre']] = $grado['nombre'];
        }
//        para disponibilidad
        $qDisponible = $this->db->query('
            SELECT
            com_id as id,
            com_nombre as nombre
            FROM combos
            WHERE com_tipo = 14
            '
        );
        $disponible = $qDisponible->result_array();
        foreach ($disponible as $row) {
            $this->disponibilidad[$row['id']] = $row['nombre'];
        }
        $consulta = $this->db->query('
        SELECT com_id as id, com_nombre as nombre
        FROM combos
        WHERE com_tipo="5"
        ORDER BY com_orden asc'
        );
        $area_exp = $consulta->result_array();
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
        foreach ($sector_exp as $grado) {
            $this->sector_experiencia[$grado['id']] = $grado['nombre'];
        }
//        para genero
        $this->genero[1] = 'Masculino';
        $this->genero[2] = 'Femenino';





        $this->facturaciones[1] = 'ETIKA';
        $this->facturaciones[2] = 'Consultor Individual';

        $this->boton = 6;
        $this->presession = $this->tool_entidad->presession();
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

    function postulante() {
        $this->cabecera['accion'] = 'Postulantes';
        $contenido['cabecera'] = $this->cabecera;
        $arrayMultiSelect = array();
        $arrayMultiSelect[4] = array("titulo" => "Ámbito en el clasificaría su experiencia", "valor" => 4);
        $arrayMultiSelect[3] = array("titulo" => "Área de experiencia", "valor" => 3);
        $arrayMultiSelect[14] = array("titulo" => "Cargo al que postula", "valor" => 14);
        $arrayMultiSelect[22] = array("titulo" => "Ciudad o Localidad de Bolivia", "valor" => 22);
        $arrayMultiSelect[21] = array("titulo" => "Cliente", "valor" => 21);
//        $arrayMultiSelect[6] = array("titulo" => "Disponibilidad", "valor" => 6);
        $arrayMultiSelect[17] = array("titulo" => "Fecha de modificación de CV", "valor" => 17);
        $arrayMultiSelect[12] = array("titulo" => "Género", "valor" => 12);
        $arrayMultiSelect[18] = array("titulo" => "Idioma ingles", "valor" => 18);
        $arrayMultiSelect[23] = array("titulo" => "Instancia", "valor" => 23);
        $arrayMultiSelect[19] = array("titulo" => "Otros Idiomas", "valor" => 19);
        $arrayMultiSelect[1] = array("titulo" => "País de residencia", "valor" => 1);
        $arrayMultiSelect[2] = array("titulo" => "Profesión", "valor" => 2);
        $arrayMultiSelect[11] = array("titulo" => "Rangos de edad", "valor" => 11);
        $arrayMultiSelect[10] = array("titulo" => "Recomendación", "valor" => 10);
        $arrayMultiSelect[9] = array("titulo" => "S-Años de experiencia en supervisión", "valor" => 9);
        $arrayMultiSelect[8] = array("titulo" => "S-Experiencia en no supervisión", "valor" => 8);
        $arrayMultiSelect[5] = array("titulo" => "S-Experiencia en supervisión", "valor" => 5);
        $arrayMultiSelect[7] = array("titulo" => "S-Maximo nivel alcanzado", "valor" => 7);
        $arrayMultiSelect[20] = array("titulo" => "Sector de Experiencia que usted realtaría", "valor" => 20);
        $arrayMultiSelect[16] = array("titulo" => "Sede", "valor" => 16);
        $arrayMultiSelect[13] = array("titulo" => "Ultima pretensión salarial", "valor" => 13);

//        $arrayMultiSelect[15]=array("titulo" =>"Cargos Desempeñados","valor" => 15);
//        uasort($arrayMultiSelect, "callback");
//        sort($arrayMultiSelect);
        $contenido['multiselect'] = $arrayMultiSelect;
        $data['contenido'] = $this->load->view($this->carpeta . 'campos', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function campos_criterios() {
        $arrayCriterios = Array();
        $stringCriterios = $this->input->post('criterios');
        if ($this->input->post('criterios')) {
            $stringCadena = $this->input->post('criterios');
            $arrayCriterios = explode(',', $stringCadena);
        }
        $instancia = array();
        foreach ($arrayCriterios as $key => $value) {
            switch ($value) {
                case 1:
                    $consultaPais = $this->db->query('
                    SELECT
                    pai_id as id,
                    pai_nombre as pais
                    FROM paises
                    WHERE pai_tipo=1 ORDER BY pai_orden asc'
                    );
                    $paises = $consultaPais->result_array();
                    break;
                case 2:
                    $consultaProfesion = $this->db->query('
                    SELECT
                    com_id as id,
                    com_nombre as profesion
                    FROM combos
                    WHERE com_tipo=3 and com_id<>65  ORDER BY com_nombre asc'
//                    WHERE com_tipo=3 and com_id<>65  ORDER BY com_nombre asc'
                    );
                    $consultaOtro = $this->db->query('
                                SELECT
                                com_id as id,
                                com_nombre as profesion
                                FROM
                                combos
                                where  com_tipo=3  and com_id=65'
                    );
                    $profesiones = array();
                    $otro = $consultaOtro->row_array();
                    $profesionesSinOtro = $consultaProfesion->result_array();
                    foreach ($profesionesSinOtro as $key => $value) {
                        $profesiones[] = $value;
                    }
                    if ($otro) {
                        $profesiones[] = $otro;
                    }

                    break;
                case 3:
                    $consultaAreaExperiencia = $this->db->query('
                    SELECT
                    com_id as id,
                    com_nombre as experiencia
                    FROM combos
                    WHERE com_tipo=5  ORDER BY com_orden asc'
                    );
                    $areaExperiencia = $consultaAreaExperiencia->result_array();
                    break;
                case 6:
                    $consultaDisponibilidad = $this->db->query('
                    SELECT
                    com_id as id,
                    com_nombre as disponibilidad
                    FROM combos
                    WHERE com_tipo=14 ORDER BY com_orden asc'
                    );
                    $disponibilidad = $consultaDisponibilidad->result_array();
                    break;
                case 7:
                    $consultaSupervision = $this->db->query('
                    SELECT
                    com_id as id,
                    com_nombre as nombre
                    FROM combos
                    WHERE com_tipo=9 ORDER BY com_orden asc'
                    );
                    $supervision = $consultaSupervision->result_array();
                    break;
                case 8:
                    $consultaNoSupervision = $this->db->query('
                    SELECT
                    com_id as id,
                    com_nombre as nombre
                    FROM combos
                    WHERE com_tipo=11 ORDER BY com_nombre asc'
                    );
                    $noSupervision = $consultaNoSupervision->result_array();
                    break;
                case 10:
                    $consultaRecomendacion = $this->db->query('
                    SELECT
                    com_id as id,
                    com_nombre as nombre
                    FROM combos
                    WHERE com_tipo=7 ORDER BY com_nombre asc'
                    );
                    $recomendacion = $consultaRecomendacion->result_array();
                    break;
                case 14:
                    $consultaCargos = $this->db->query('
                    SELECT
                    car_id as id,
                    car_nombre as nombre
                    FROM cargos
                    WHERE car_tipo=1 ORDER BY car_nombre asc'
                    );
                    $cargos = $consultaCargos->result_array();
                    foreach ($cargos as $key => $value) {
                        $subCargos = array();
                        $consultaSubCargos = $this->db->query('
                    SELECT car_id as id,fk_cargo_id as fk_cargo,
                    car_nombre as nombre
                    FROM cargos
                         WHERE car_tipo=2 and fk_cargo_id=' . $value['id'] . ' ORDER BY car_nombre asc'
                        );
                        $subCargos = $consultaSubCargos->result_array();
                        $value['subcargos'] = $subCargos;
                        $cargos[$key] = $value;
                    }
                    break;
                case 16:
                    $consultaSedes = $this->db->query('
                    SELECT
                    com_id as id,
                    com_nombre as nombre
                    FROM combos
                    WHERE com_tipo=13 ORDER BY com_nombre asc'
                    );
                    $sedes = $consultaSedes->result_array();
                    break;
                case 19:
                    $consultaIdioma = $this->db->query('
                    SELECT
                    idi_id as id,
                    idi_idioma as nombre
                    FROM idiomas
                    WHERE idi_id<>1 and idi_id<>4  ORDER BY idi_idioma asc'
                    );
                    $idiomas = $consultaIdioma->result_array();
                    break;
                case 20:
                    $consultaExperiencia = $this->db->query('
                    SELECT
                    com_id as id,
                    com_nombre as nombre
                    FROM combos
                    WHERE com_tipo=6 ORDER BY com_nombre asc'
                    );
                    $esperiencia = $consultaExperiencia->result_array();
                    break;
                case 21:
                    $consultaClientes = $this->db->query('
                    SELECT
                    cli_id as id,
                    cli_nombre as nombre
                    FROM clientes
                    ORDER BY cli_nombre asc'
                    );
                    $clientes = $consultaClientes->result_array();
                    break;
                case 22:
                    $consultaCiudades = $this->db->query('
                    SELECT
                    pai_id as id,
                    pai_nombre as nombre
                    FROM paises
                    WHERE pai_tipo=2 ORDER BY pai_orden asc'
                    );
                    $ciudades = $consultaCiudades->result_array();
                    break;
                case 23:
                    $instancia[0] = array('nombre' => 'CCV', 'id' => '0');
                    $instancia[1] = array('nombre' => 'EP', 'id' => '1');
                    $instancia[2] = array('nombre' => 'TP', 'id' => '2');
                    $instancia[3] = array('nombre' => 'Assesment', 'id' => '3');
                    $instancia[4] = array('nombre' => 'Entrevista', 'id' => '4');
                    $instancia[5] = array('nombre' => 'Finalista', 'id' => '5');
                    $instancia[6] = array('nombre' => 'Elegido', 'id' => '6');
                    $instancia[7] = array('nombre' => 'Espera', 'id' => '7');
                    break;
            }
        }

        $this->cabecera['accion'] = 'Postulantes';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['arrayCriterios'] = $arrayCriterios;
        $contenido['criterios'] = $stringCadena;
        $contenido['paises'] = @$paises;
        $contenido['profesiones'] = @$profesiones;
        $contenido['areaExperiencia'] = @$areaExperiencia;
        $contenido['disponibilidad'] = @$disponibilidad;
        $contenido['supervision'] = @$supervision;
        $contenido['noSupervision'] = @$noSupervision;
        $contenido['recomendacion'] = @$recomendacion;
        $contenido['cargos'] = @$cargos;
        $contenido['sedes'] = @$sedes;
        $contenido['idiomas'] = @$idiomas;
        $contenido['experiencia'] = @$esperiencia;
        $contenido['clientes'] = @$clientes;
        $contenido['ciudades'] = @$ciudades;
        $contenido['instancia'] = @$instancia;
        $contenido['stringcriterios'] = $stringCriterios;
        $data['contenido'] = $this->load->view($this->carpeta . 'formulario_campos', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function postulante_generar() {
        $residencia = $this->input->post('residencia');
        $profesion = $this->input->post('profesion');
        $area_exp = $this->input->post('area_exp');
        $recomendacion = $this->input->post('recomendacion');
        $cliente = $this->input->post('cliente');
        $cargo = $this->input->post('cargo');
        $sede = $this->input->post('sede');
        $instancia = $this->input->post('instancia');
        $campos_listar = array('Documento', 'Apellido Paterno', 'Apellido Materno', 'Nombres', 'Teléfono', 'Celular', 'Email');
        $campos_reales = array('documento', 'apaterno', 'amaterno', 'nombre', 'telefono', 'celular', 'email');
        if ($residencia) {
            $pos_where .= ' and pos_pais_otro="' . $residencia . '" ';
        } else {
            $campos_listar[] = 'País Residencia';
            $campos_reales[] = 'residencia';
        }
        if ($profesion) {
            $pro_where = ' and edu_area="' . $profesion . '" ';
            $opcion = 1;
        } else {
            $campos_listar[] = 'Profesión';
            $campos_reales[] = 'profesion';
        }
        if ($area_exp) {
            $pos_where .= ' and pos_area_exp="' . $area_exp . '" ';
        } else {
            $campos_listar[] = 'Área de Experiencia';
            $campos_reales[] = 'area_exp';
        }
        if ($recomendacion) {
            $pos_where .= ' and pof_recomendacion="' . $recomendacion . '" ';
        } else {
            $campos_listar[] = 'Recomendación';
            $campos_reales[] = 'recomendacion';
        }
        $campos_listar[] = 'Otros';
        $campos_reales[] = 'procesos_ant';
        $proceso_where = '';
        if ($cliente) {
            $proceso_where .= ' and c.cli_id=' . $cliente;
            $opcion = 2;
        }
        if ($cargo) {
            $proceso_where .= ' and b.con_id=' . $cargo;
            $opcion = 2;
        }
        if ($sede) {
            $proceso_where .= ' and b.con_sede="' . $sede . '" ';
            $opcion = 2;
        }
        if ($instancia) {
            $proceso_where .= ' and a.eta_instancia="' . $instancia . '" ';
            $opcion = 2;
        }
        if ($profesion && ($cliente || $cargo || $sede || $instancia)) {
            $opcion = 3;
        }
        $consulta = $this->db->query('
            SELECT
            pos_id as id,
            pos_documento as documento,
            pos_nombre as nombre,
            pos_nro_postulaciones as nro,
            pos_apaterno as apaterno,
            pos_amaterno as amaterno,
            pos_telefono as telefono,
            pos_celular as celular,
            pos_email as email,
            pos_area_exp as area_exp,
            pos_pais_otro as residencia,
            pof_recomendacion as recomendacion
            FROM postulante
            WHERE pos_id !=0 ' . $pos_where . '
            ORDER BY apaterno asc
            '
        );
        $postulantes = $consulta->result_array();
        if ($postulantes) {
            $aux = 0;
            foreach ($postulantes as $num => $row) {
                $educacion_sup = '';
                $procesos_ant = '';
                $consulta1 = $this->db->query('
                    SELECT
                    edu_area as profesion
                    FROM educacion_superior
                    WHERE pos_id = ' . $row['id'] . ' ' . $pro_where
                );
                $educacion_superior = $consulta1->result_array();
                if ($educacion_superior) {
                    $educacion_sup = '<div style="text-align: left; font-weight: bold;">';
                    foreach ($educacion_superior as $row1) {
                        $educacion_sup .= ' -' . $this->area_pro[$row1['profesion']] . '<br/>';
                    }
                    $educacion_sup .= '</div>';
                } else {
                    $educacion_sup = 'No tiene Ninguna Educación';
                }
                $consulta1 = $this->db->query('
                    SELECT
                    eta_instancia as instancia,
                    eta_observacion as observacion,                    
                    con_cargo as cargo,
                    con_sede as sede,
                    cli_nombre as cliente
                    FROM etapas a, convocatoria b, clientes c
                    WHERE a.con_id=b.con_id and b.cli_id=c.cli_id and pos_id = ' . $row['id'] . $proceso_where . '
                    ORDER BY b.con_hasta desc
                    LIMIT 3'
                );
                $procesos_anteriores = $consulta1->result_array();

                if ($procesos_anteriores) {
                    $procesos_ant = '<table align="center" cellpadding="0" cellspacing="0">';
                    $procesos_ant .= '<tr><td align="center">Nº Total de cargos postulados: <b>' . $row['nro'] . '</b></td></tr>';
                    $procesos_ant .= '<tr><td align="left"><table border="1" align="center">';
                    $procesos_ant .= '<tr>';
                    if ($cliente && $cargo && $instancia) {
                        
                    } else {
                        $procesos_ant .= '<th align="center" valign="top">Participación en anteriores procesos</th>';
                    }
                    $procesos_ant .= '<th align="center" valign="top">Observación</th>';
                    $procesos_ant .= '</tr>';
                    foreach ($procesos_anteriores as $row1) {
                        $participacion = '';
                        $procesos_ant .= '<tr>';
                        if (!$cliente)
                            $participacion .= 'Cliente<br/><b>' . $row1['cliente'] . '</b><br/>';
                        if (!$cargo)
                            $participacion .= 'Cargo<br/><b>' . $row1['cargo'] . '</b><br/>';
                        if (!$sede)
                            $participacion .= 'Sede<br/><b>' . $row1['sede'] . '</b><br/>';
                        if (!$instancia)
                            $participacion .= 'Instancia<br/><b>' . $this->instancias[$row1['instancia']] . '</b>';
                        if ($participacion)
                            $procesos_ant .= '<td align="center" valign="top">' . $participacion . '</td>';
                        $procesos_ant .= '<td align="center">' . $row1['observacion'] . '</td>';
                        $procesos_ant .= '</tr>';
                    }
                    $procesos_ant .= '</table></td></tr>';
                    $procesos_ant .= '</table>';
                }else {
                    $procesos_ant = 'No tiene Ningun Proceso Anterior';
                }
                switch ($opcion) {
                    case 1:
                        if ($educacion_sup != 'No tiene Ninguna Educación') {
                            $datos[$aux] = array(
                                'documento' => $row['documento'],
                                'apaterno' => $row['apaterno'],
                                'amaterno' => $row['amaterno'],
                                'nombre' => $row['nombre'],
                                'telefono' => $row['telefono'],
                                'celular' => $row['celular'],
                                'email' => $row['email'],
                                'recomendacion' => $this->recomendaciones[$row['recomendacion']],
                                'residencia' => $row['residencia'],
                                'recomendacion' => $this->recomendaciones[$row['recomendacion']],
                                'area_exp' => $this->area_exp[$row['area_exp']],
                                'profesion' => $educacion_sup,
                                'procesos_ant' => $procesos_ant
                            );
                            if (!$recomendacion) {
                                $datos[$aux]['recomendacion'] = $this->recomendaciones[$row['recomendacion']];
                            }
                        }
                        break;
                    case 2:
                        if ($procesos_ant != 'No tiene Ningun Proceso Anterior') {
                            $datos[$aux] = array(
                                'documento' => $row['documento'],
                                'apaterno' => $row['apaterno'],
                                'amaterno' => $row['amaterno'],
                                'nombre' => $row['nombre'],
                                'telefono' => $row['telefono'],
                                'celular' => $row['celular'],
                                'email' => $row['email'],
                                'recomendacion' => $this->recomendaciones[$row['recomendacion']],
                                'residencia' => $row['residencia'],
                                'area_exp' => $this->area_exp[$row['area_exp']],
                                'profesion' => $educacion_sup,
                                'procesos_ant' => $procesos_ant
                            );
                        }
                        break;
                    case 3:
                        if ($educacion_sup != 'No tiene Ninguna Educación' && $procesos_ant != 'No tiene Ningun Proceso Anterior') {
                            $datos[$aux] = array(
                                'documento' => $row['documento'],
                                'apaterno' => $row['apaterno'],
                                'amaterno' => $row['amaterno'],
                                'nombre' => $row['nombre'],
                                'telefono' => $row['telefono'],
                                'celular' => $row['celular'],
                                'email' => $row['email'],
                                'recomendacion' => $this->recomendaciones[$row['recomendacion']],
                                'residencia' => $row['residencia'],
                                'area_exp' => $this->area_exp[$row['area_exp']],
                                'profesion' => $educacion_sup,
                                'procesos_ant' => $procesos_ant
                            );
                        }
                        break;
                    default:
                        $datos[$aux] = array(
                            'documento' => $row['documento'],
                            'apaterno' => $row['apaterno'],
                            'amaterno' => $row['amaterno'],
                            'nombre' => $row['nombre'],
                            'telefono' => $row['telefono'],
                            'celular' => $row['celular'],
                            'email' => $row['email'],
                            'recomendacion' => $this->recomendaciones[$row['recomendacion']],
                            'residencia' => $row['residencia'],
                            'area_exp' => $this->area_exp[$row['area_exp']],
                            'profesion' => $educacion_sup,
                            'procesos_ant' => $procesos_ant
                        );
                        break;
                }
                $aux++;
            }
        }
        $this->cabecera['accion'] = 'Postulantes';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['campos_listar'] = $campos_listar;
        $contenido['campos_reales'] = $campos_reales;
        $contenido['postulante'] = 1;
        $contenido['residencia'] = $residencia;
        $contenido['profesion'] = $profesion;
        $contenido['area_exp'] = $area_exp;
        $contenido['recomendacion'] = $recomendacion;
        $contenido['cliente'] = $cliente;
        $contenido['cargo'] = $cargo;
        $contenido['sede'] = $sede;
        $contenido['instancia'] = $instancia;
        $contenido['datos'] = $datos;
        $contenido['titulo'] = 'Postulantes';
        $data['contenido'] = $this->load->view($this->carpeta . 'reporte', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function realizar_busqueda() {
        set_time_limit(-1);
        $mostrar = 0;
        $campos_listar = array('Documento', 'Apellido Paterno', 'Apellido Materno', 'Nombres', 'Teléfono', 'Celular', 'Email');
        $campos_reales = array('documento', 'apaterno', 'amaterno', 'nombre', 'telefono', 'celular', 'email');
        $procesarConsulta = $this->input->post('mostrarAdicional');
        $tipoExhaustiva = $this->input->post('tipoexhaustiva');
        $valorBusqueda = $this->input->post('valorBusqueda');

        $idciudad = $this->input->post('idciudad');
        $idDisponibilidad = $this->input->post('iddisponibilidad');
        $idGenero = $this->input->post('genero');
        $recomendacion = $this->input->post('idrecomendacion');
        $solo = $this->input->post('pais');
        $idPais = $this->input->post('idpais');
        $idAmbito1 = $this->input->post('ambito1');
        $idAmbito2 = $this->input->post('ambito2');
        $idAmbito3 = $this->input->post('ambito3');
        $idCargo = $this->input->post('idcargo');
        $idCliente = $this->input->post('idcliente');
        $inglesHabla = $this->input->post('ingles');
        $idInstancia = $this->input->post('idinstancia');
        $idOtroIdioma = $this->input->post('idotroidioma');
        $idProfesion = $this->input->post('idprofesion');
        $edadMas = $this->input->post('edadmas');
        $edadMenos = $this->input->post('edadmenos');
        $anioMas = $this->input->post('aniomas');
        $anioMenos = $this->input->post('aniomenos');
        $idSede = $this->input->post('idsede');
        $idNoSupervicion = $this->input->post('idnosupervision');
        $experiencia = $this->input->post('experiencia');
        $idSupervicion = $this->input->post('idsupervision');
        $idSectorExperiencia = $this->input->post('idsectorexperiencia');
        $salarioMas = $this->input->post('salariomas');
        $salarioMenos = $this->input->post('salariomenos');
        $idArea = $this->input->post('idarea');
        $fechaCV = $this->input->post('fechacv');

        $pos_where = "";
        $agrupar = "";
        $innjerJoin = "";
        $campos = array();
        $innjerJoin = " inner join postulante_f
                                on p.pos_id=postulante_f.pos_id";
        if ($idPais != "") {
            if ($solo == 1) {
                $pos_where .= " and postulante_f.pai_id=" . $idPais;
                $residencia = " Solo ";
            } else {
                $residencia = " Todo menos ";
                $pos_where .= " and postulante_f.pai_id!=" . $idPais;
                $innjerJoin .= " inner join paises as pa
                                on postulante_f.pai_id=pa.pai_id ";
                $campos [] = " pa.pai_nombre as pais";
                $campos_listar[] = "País";
                $campos_reales[] = "pais";
            }
            $consulta = $this->db->query('
            SELECT
            pai_nombre as pais           
            FROM paises            
            WHERE pai_id = ' . $idPais . '
            '
            );
            $pais = $consulta->row_array();
            $residencia .= $pais['pais'];
        }
        if ($idciudad) {
            $innjerJoin .= " inner join paises as pb
                                on postulante_f.ciu_id=pb.pai_id";
            $pos_where .= " and ciu_id in(" . implode(',', $idciudad) . ")";
            $campos [] = ' IF(postulante_f.ciu_id!=14, pb.pai_nombre,CONCAT(pb.pai_nombre," - ",pof_ciudad_otra)) as ciudad';
            $campos_listar[] = "Ciudad";
            $campos_reales[] = "ciudad";
        }
        if ($idDisponibilidad) {
            $pos_where .= " and pof_disponibilidad=" . $idDisponibilidad;
        }
        if ($idGenero != "") {
            $pos_where .= " and pof_sexo=" . $idGenero;
        }
        if ($recomendacion) {
            $pos_where .= " and pof_recomendacion in(" . implode(',', $recomendacion) . ")";
        }
//        para mostrar siempre la recomendacion en la tabla basica
        $campos [] = " postulante_f.pof_recomendacion";
        $innjerJoin .= " inner join combos as r
                                on postulante_f.pof_recomendacion=r.com_id";
        $campos [] = " r.com_nombre as recomendacion";
//        comenzando los filtros 22 de junio de 2018
        if ($idCargo) {
            $pos_where .= " and c.sub_cargo_id in(" . implode(',', $idCargo) . ")";
            $innjerJoin .= " inner join convocatoria_postulacion cp
                                on p.pos_id=cp.pos_id ";
            $innjerJoin .= " inner join convocatoria c
                                on cp.con_id1=c.con_id ";
            $innjerJoin .= " inner join cargos ca
                                on ca.car_id=c.cargo_id ";
            $innjerJoin .= " inner join cargos cs
                                on cs.car_id=c.sub_cargo_id ";
            $agrupar .= "group by sub_cargo_id,p.pos_id ";
            $campos [] = " concat(ca.car_nombre,'-',cs.car_nombre )as cargo";
            $campos_listar[] = "Cargo";
            $campos_reales[] = "cargo";
        }


        if ($idSede) {
            $pos_where .= " and c.sede_id in(" . implode(',', $idSede) . ")";
            if (empty($idCargo)) {
                $innjerJoin .= " inner join convocatoria_postulacion cp
                                on cp.pos_id=p.pos_id ";
                $innjerJoin .= " inner join convocatoria c
                                on c.con_id=cp.con_id1 ";
            }
            $innjerJoin .= " inner join combos comb
                                on comb.com_id=c.sede_id ";
            $campos [] = "comb.com_nombre as sede";
            $campos_listar[] = "Sede";
            $campos_reales[] = "sede";
        }

        if ($idNoSupervicion > 0) {
            $pos_where .= " and pof_max_nivel_no=" . $idNoSupervicion . "";
        }
        if ($idAmbito1 > 0 || $idAmbito2 > 0 || $idAmbito3 > 0) {
            if ($idAmbito1 > 0) {
                @$ambito .= "%" . $idAmbito1 . "%";
            }
            if ($idAmbito2 > 0) {
                @$ambito .= "%" . $idAmbito2 . "%";
            }
            if ($idAmbito3 > 0) {
                @$ambito .= "%" . $idAmbito3 . "%";
            }
//            $pos_where .= " and pof_ambito_exp REGEXP " . $ambito . "";
            $pos_where .= " and pof_ambito_exp like('" . $ambito . "')";
            $campos [] = "pof_ambito_exp as ambito";
            $campos_listar[] = "Ámbito";
            $campos_reales[] = "ambito";
        }
        if ($idCliente != "") {
            $consulta = $this->db->query('
            SELECT
            cli_nombre as cliente           
            FROM clientes            
            WHERE cli_id = ' . $idCliente . '
            ');
            $resultado = $consulta->row_array();
            $cliente = $resultado['cliente'];
            $pos_where .= " and cl.cli_id=" . $idCliente . " ";
            if ($idCargo) {
                $innjerJoin .= " inner join clientes cl
                                on cl.cli_id=c.cli_id ";
            } else {

                $innjerJoin .= " inner join convocatoria_postulacion conp
                                on p.pos_id=conp.pos_id ";
                $innjerJoin .= " inner join convocatoria con
                                on con.con_id=conp.con_id1 ";
                $innjerJoin .= " inner join clientes cl
                                on cl.cli_id=con.cli_id ";
            }
        }
//        para mostrar la edad y verificar
        if ($edadMas > 0 && $edadMenos > 0) {
            $campos [] = "TIMESTAMPDIFF(YEAR,pof_fecha_nacimiento, CURDATE()) as edad";
            $campos_listar[] = "Edad";
            $campos_reales[] = "edad";
            $pos_where .= " and TIMESTAMPDIFF(YEAR,pof_fecha_nacimiento, CURDATE())>=" . $edadMas . "";
            $pos_where .= " and TIMESTAMPDIFF(YEAR,pof_fecha_nacimiento, CURDATE())<=" . $edadMenos . "";
        } elseif ($edadMas > 0 || $edadMenos > 0) {
            $campos [] = "TIMESTAMPDIFF(YEAR,pof_fecha_nacimiento, CURDATE()) as edad";
            $campos_listar[] = "Edad";
            $campos_reales[] = "edad";
            if ($edadMas > 0) {
                $pos_where .= " and TIMESTAMPDIFF(YEAR,pof_fecha_nacimiento, CURDATE())>=" . $edadMas . "";
            }
            if ($edadMenos > 0) {
                $pos_where .= " and TIMESTAMPDIFF(YEAR,pof_fecha_nacimiento, CURDATE())>0 and TIMESTAMPDIFF(YEAR,pof_fecha_nacimiento, CURDATE())<=" . $edadMenos . "";
            }
        } else {
//            para que salga la columna de edad
            $campos [] = "TIMESTAMPDIFF(YEAR,pof_fecha_nacimiento, CURDATE()) as edad";
            $campos_listar[] = "Edad";
            $campos_reales[] = "edad";
        }
        if ($anioMas > 0 && $anioMenos > 0) {
            $campos [] = "pof_anios_exp as aniosexp";
            $campos_listar[] = "Años de Experiencia";
            $campos_reales[] = "aniosexp";
            $pos_where .= " and pof_anios_exp>=" . $anioMas . "";
            $pos_where .= " and pof_anios_exp<=" . $anioMenos . "";
        } elseif ($anioMas > 0 || $anioMenos > 0) {
            $campos [] = "pof_anios_exp as aniosexp";
            $campos_listar[] = "Años de Experiencia";
            $campos_reales[] = "aniosexp";
            if ($anioMas > 0) {
                $pos_where .= " and pof_anios_exp>=" . $anioMas . "";
            }
            if ($anioMenos > 0) {
                $pos_where .= " and pof_anios_exp>0 and pof_anios_exp<=" . $anioMenos . "";
            }
        }
        if ($salarioMas > 0 && $salarioMenos > 0) {
            $campos [] = "pof_salario as salario";
            $campos_listar[] = "Pretensión Salarial";
            $campos_reales[] = "salario";
            $pos_where .= " and pof_salario>=" . $salarioMas . "";
            $pos_where .= " and pof_salario<=" . $salarioMenos . "";
            $pretencionSalarial = " Mayor que " . $salarioMas . " Menor que " . $salarioMenos;
        } elseif ($salarioMas > 0 || $salarioMenos > 0) {
            $campos [] = "pof_salario as salario";
            $campos_listar[] = "Pretensión Salarial";
            $campos_reales[] = "salario";
            if ($salarioMas > 0) {
                $pos_where .= " and pof_salario>=" . $salarioMas . "";
                $pretencionSalarial = " Mayor que " . $salarioMas;
            }
            if ($salarioMenos > 0) {
                $pos_where .= " and pof_salario>0 and pof_salario<=" . $salarioMenos . "";
                $pretencionSalarial = " Menor que " . $salarioMenos;
            }
        } else {
//            campo basico a mostrar
            $campos [] = "pof_salario as salario";
            $campos_listar[] = "Pretensión Salarial";
            $campos_reales[] = "salario";
        }
        if ($inglesHabla) {
            $arrayIdiomaNivel = array();
            $arrayIdiomaNivel[1] = 'Excelente';
            $arrayIdiomaNivel[2] = 'Muy bueno';
            $arrayIdiomaNivel[3] = 'Regular';
            $arrayIdiomaNivel[4] = 'Basico';
            $pos_where .= " and posidi.poi_habla in(" . implode(",", $inglesHabla) . ")";
            $pos_where .= " and posidi.idi_id=1";
            $innjerJoin .= " inner join postulante_idioma posidi
                                on posidi.pos_id=p.pos_id ";

            $campos [] = " CASE
                                WHEN posidi.poi_habla = 1 THEN 'Excelente'
                                WHEN posidi.poi_habla = 2 THEN 'Muy bueno'
                                WHEN posidi.poi_habla = 3 THEN 'Regular'
                                WHEN posidi.poi_habla = 4 THEN 'Basico'
                            END as habla";
            $campos_listar[] = "Habla Inglés";
            $campos_reales[] = "habla";
        }
        if ($fechaCV > 0) {
            $campos [] = "timestampdiff(month,pof_fecha_edicion,curdate()) as meses";
            $campos_listar[] = "Modificación de CV en meses";
            $campos_reales[] = "meses";
            $pos_where .= " and timestampdiff(month,pof_fecha_edicion,curdate())>0 and timestampdiff(month,pof_fecha_edicion,curdate())<=" . $fechaCV . "";
        }
        if ($experiencia != '') {
            $pos_where .= " and pof_supervisar_exp='" . $experiencia . "'";
            $experienciaS = $experiencia;
        }
        if ($idSupervicion > 0) {
            $pos_where .= " and pof_max_nivel='" . $idSupervicion . "'";
            $consulta = $this->db->query('
            SELECT
            com_nombre as nivelmax           
            FROM combos            
            WHERE com_id = ' . $idSupervicion . '
            ');
            $resultado = $consulta->row_array();
            $nivelAlcanzado = $resultado['nivelmax'];
        }
        if ($idSectorExperiencia) {
            $arrayFindSet = array();
            foreach ($idSectorExperiencia as $key => $value) {
                $arrayFindSet[] = " FIND_IN_SET('" . $value . "',pof_sector_exp)";
            }
            if ($arrayFindSet) {
                $pos_where .= " and (" . implode(' or ', $arrayFindSet) . ")";
            }
            $campos [] = "pof_sector_exp as idsector";
            $campos_listar[] = "Sector de experiencia";
            $campos_reales[] = "idsector";
        }
        if ($idInstancia) {
            $innjerJoin .= " inner join etapas et
                                on p.pos_id=et.pos_id ";
//            $pos_where .= " and eta_instancia='" . $idInstancia . "'";
            $pos_where .= " and eta_instancia in('" . implode("','", $idInstancia) . "')";
            $arrayInstancia[0] = 'CCV';
            $arrayInstancia[1] = 'EP';
            $arrayInstancia[2] = 'TP';
            $arrayInstancia[3] = 'Assesment';
            $arrayInstancia[4] = 'Entrevista';
            $arrayInstancia[5] = 'Finalista';
            $arrayInstancia[6] = 'Elegido';
            $arrayInstancia[7] = 'Espera';

            if ($idCargo) {
                $agrupar .= ", pof_recomendacion ";
            } else {
                $agrupar .= "group by pof_recomendacion,p.pos_id ";
            }
            $campos [] = "CASE
                            WHEN eta_instancia=0 THEN 'CCV'
                            WHEN eta_instancia='1' THEN 'EP'
                            WHEN eta_instancia='2' THEN 'TP'
                            WHEN eta_instancia='3' THEN 'Assesment'
                            WHEN eta_instancia='4' THEN 'Entrevista'
                            WHEN eta_instancia='5' THEN 'Finalista'
                            WHEN eta_instancia='6' THEN 'Elegido'
                            WHEN eta_instancia='7' THEN 'Espera'
                            END as instancia";
            $campos_listar[] = "Instancia";
            $campos_reales[] = "instancia";
        }
        if ($idProfesion) {
            $innjerJoin .= " inner join educacion_superior es
                                on p.pos_id=es.pos_id ";
            $innjerJoin .= " inner join combos pc
                                on es.edu_area=pc.com_id ";
            $pos_where .= " and es.edu_area in(" . implode(',', $idProfesion) . ")";

            $campos [] = "UPPER(CASE
    WHEN es.edu_area = 65 THEN CONCAT(pc.com_nombre,' - ',es.edu_area_otro)
    ELSE pc.com_nombre
END) as profesion";
//            $campos [] = "IF(es.edu_area!=65, pc.com_nombre,CONCAT(pc.com_nombre," - ",es.edu_area_otro))";
            $campos_listar[] = "Profesión";
            $campos_reales[] = "profesion";
        }
        if ($idArea) {
            $arrayFindSetArea = array();
            foreach ($idArea as $key => $value) {
                $arrayFindSetArea[] = " FIND_IN_SET('" . $value . "',pof_area_exp)";
            }
            if ($arrayFindSetArea) {
                $pos_where .= " and (" . implode(' or ', $arrayFindSetArea) . ")";
            }

            $campos [] = "pof_area_exp as idarea";
            $campos_listar[] = "Área de Expericia";

            $campos_reales[] = "idarea";
        }

        if ($idOtroIdioma > 0) {
            if ($inglesHabla > 0) {
                $pos_where .= " and posidi.idi_id=" . $idOtroIdioma . "";
                $innjerJoin .= " inner join idiomas idi
                                on idi.idi_id=posidi.idi_id ";
            } else {
                $pos_where .= " and posidi.idi_id=" . $idOtroIdioma . "";
                $innjerJoin .= " inner join postulante_idioma posidi
                                on posidi.pos_id=p.pos_id ";
                $innjerJoin .= " inner join idiomas idi
                                on idi.idi_id=posidi.idi_id ";
            }
            $consulta = $this->db->query('
            SELECT
            idi_idioma as idioma           
            FROM idiomas            
            WHERE idi_id = ' . $idOtroIdioma . '
            ');
            $resultado = $consulta->row_array();
            $otroIdioma = $resultado['idioma'];
            $campos [] = "UPPER(CASE
    WHEN idi.idi_id = 223 THEN CONCAT(idi_idioma,' - ',poi_idioma_otro)
    ELSE idi_idioma
END) as idioma";
            $campos_listar[] = "Idioma";
            $campos_reales[] = "idioma";
        }

        $msc = microtime(true);
        $innerCampos = implode(',', $campos);
        if ($innerCampos != "") {
            $innerCampos = ',' . $innerCampos;
        }
        if ($idInstancia > 0 || $recomendacion || $idCliente > 0 || $idCargo || $idSede) {
            $pos_where .= " and pos_nro_postulaciones>0";
        }
        if ($procesarConsulta == 1) {
            //var_dump('ingreso por si');exit();
            $contenido = $_SESSION['resultado_filtro'];
            $contenido['procesar'] = $procesarConsulta;
            $datosAnterior = $contenido['datos'];
            $arrayCompleto = array();

            foreach ($datosAnterior as $key => $value) {
                $ultimasPostulaciones = array();
                if ($value['npostulacion'] > 0) {
                    $consultaPostulaciones = $this->db->query('select cp.pos_id, cli_nombre as cliente,
                                                 con_cargo as cargo, con_sede as sede,
                                                 eta_instancia as instancia, 
                                                 cp.con_fecha_creacion 
                                            from convocatoria_postulacion cp
                                                inner join convocatoria c
                                                    on c.con_id=cp.con_id1
                                                inner join clientes cl
                                                    on cl.cli_id=c.cli_id
                                                inner join etapas e
                                                    on e.con_id=c.con_id
                                                        where cp.pos_id=' . $value['id'] . ' 
                                                            group by cp.con_id
                                                    order by cp.con_fecha_creacion desc limit 3');
                    $ultimasPostulaciones = $consultaPostulaciones->result_array();
                    //var_dump($ultimasPostulaciones);exit();
                }
                $value['postulaciones'] = $ultimasPostulaciones;
                $arrayCompleto[] = $value;
            }
            $campos_reales = $contenido['campos_reales'];
            $campos_reales[] = "postulaciones";
            $contenido['campos_reales'] = $campos_reales;
            $contenido['datos'] = $arrayCompleto;
        } else {
            // var_dump('ingreso por no');exit();
           
            if ($mostrar == 1) {
                echo '
            SELECT DISTINCT(p.pos_id) as id,
            p.pos_nro_postulaciones as npostulacion,
            pos_documento as documento,
            pos_nombre as nombre,
            pos_nro_postulaciones as nro,
            pos_apaterno as apaterno,
            pos_amaterno as amaterno,
            pos_telefono as telefono,
            pos_celular as celular,
            pos_email as email,            
            pos_observacion as observacion
            ' . $innerCampos . '
            FROM postulante p
            ' . $innjerJoin . '
            WHERE p.pos_id !=0 ' . $pos_where . '
            ' . $agrupar . 'ORDER BY apaterno asc
            ';
            }
            $query_ing="SELECT DISTINCT(p.pos_id) as id,
            p.pos_nro_postulaciones as npostulacion,
            pos_documento as documento,
            pos_nombre as nombre,
            pos_nro_postulaciones as nro,
            pos_apaterno as apaterno,
            pos_amaterno as amaterno,
            pos_telefono as telefono,
            pos_celular as celular,
            pos_email as email,            
            pos_observacion as observacion
            $innerCampos
            FROM postulante p
            $innjerJoin
            WHERE p.pos_id !=0 $pos_where
            $agrupar ORDER BY apaterno asc
            ";
            //var_dump($query_ing);exit();
             
            // $consulta = $this->db->query('
            // SELECT
            // p.pos_id as id,
            // p.pos_nro_postulaciones as npostulacion,
            // pos_documento as documento,
            // pos_nombre as nombre,
            // pos_nro_postulaciones as nro,
            // pos_apaterno as apaterno,
            // pos_amaterno as amaterno,
            // pos_telefono as telefono,
            // pos_celular as celular,
            // pos_email as email,            
            // pos_observacion as observacion
            // ' . $innerCampos . '
            // FROM postulante p
            // ' . $innjerJoin . '
            // WHERE p.pos_id !=0 ' . $pos_where . '
            // ' . $agrupar . 'ORDER BY apaterno asc
            // ');

            $consulta = $this->db->query("
            SELECT DISTINCT(p.pos_id) as id,
            p.pos_nro_postulaciones as npostulacion,
            pos_documento as documento,
            pos_nombre as nombre,
            pos_nro_postulaciones as nro,
            pos_apaterno as apaterno,
            pos_amaterno as amaterno,
            pos_telefono as telefono,
            pos_celular as celular,
            pos_email as email,            
            pos_observacion as observacion
            $innerCampos
            FROM postulante p
            $innjerJoin
            WHERE p.pos_id !=0 $pos_where
            $agrupar ORDER BY apaterno asc
            ");

            //var_dump($consulta->result_array());exit();

            $postulantes = $consulta->result_array();
            $msc = microtime(true) - $msc;
            $campos_listar[] = "Recomendación";
            $campos_reales[] = "recomendacion";
            $campos_listar[] = "Observación";
            $campos_reales[] = "observacion";
            $campos_listar[] = 'N° postulaciones';
            $campos_reales[] = 'npostulacion';
            $this->cabecera['accion'] = 'Postulantes';
            $contenido['cabecera'] = $this->cabecera;
            $contenido['campos_listar'] = $campos_listar;
            $contenido['campos_reales'] = $campos_reales;
            $contenido['postulante'] = 1;
            $contenido['disponibilidad'] = @$idDisponibilidad;
            $contenido['residencia'] = @$residencia;
            $contenido['cliente'] = @$cliente;
            $contenido['idiomaIngles'] = @$idiomaIngles;
            $contenido['otroIdioma'] = @$otroIdioma;
            $contenido['genero'] = @$idGenero;
            $contenido['pretencionSalarial'] = @$pretencionSalarial;
            $contenido['experienciaSupervicion'] = @$experienciaS;
            $contenido['nivelAlcanzado'] = @$nivelAlcanzado;
            $contenido['recomendacion'] = @$recomendacion;
            $contenido['cargo'] = @$cargo;
            $contenido['sede'] = @$sede;
            $contenido['instancia'] = @$instancia;
            $contenido['datos'] = @$postulantes;
            $contenido['titulo'] = 'Postulantes';
            $contenido['tiempo_ejecucion'] = $msc;
            $contenido['procesar'] = 0;
            $_SESSION['resultado_filtro'] = $contenido;
        }
        $data['contenido'] = $this->load->view($this->carpeta . 'reporte', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function etiko() {
        if ($_SESSION[$this->presession . 'permisos'] > '2') {
            redirect('inicio');
        }
        $this->cabecera['accion'] = 'ETIKOS';
        $contenido['cabecera'] = $this->cabecera;
        $data['contenido'] = $this->load->view($this->carpeta . 'campos_etiko', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function etiko_generar() {
        set_time_limit(-1);
        if ($_SESSION[$this->presession . 'permisos'] > '2') {
            redirect('inicio');
        }
        if ($this->input->post('fecha_desde') != 'aaaa-mm-dd') {
            $fecha_desde = $this->input->post('fecha_desde');
        }
        if ($this->input->post('fecha_hasta') != 'aaaa-mm-dd') {
            $fecha_hasta = $this->input->post('fecha_hasta');
        }
        $cliente = $this->input->post('cliente');


        if ($cliente) {
            $cli_where = ' WHERE cli_id=' . $cliente;
            $contenido['cliente'] = $cliente;
        }
        else{
            $cli_where = '';
            $contenido['cliente'] = $cliente;
        }
        // var_dump($cliente.'--'.$cli_where);exit();
        $servicio = $this->input->post('servicio');
        if ($servicio) {
            $sede = $this->input->post('sede');
            $ser_where = ' com_id=' . $servicio;
            $contenido['servicio'] = $servicio;
            $contenido['sede'] = $sede;
        } else {
            $ser_where = ' com_tipo=8';
        }
        if (@$sede) {
            $sede_where = ' and con_sede="' . $sede . '" ';
        }else{
            $sede_where = '';
        }
        $etiko = $this->input->post('etiko');

        $facturacion = $this->input->post('facturacion');

        // var_dump($cliente,$etiko,$servicio,$facturacion);exit();

        $consulta = $this->db->query('SELECT com_id as id, com_nombre as nombre FROM combos WHERE ' . $ser_where . ' ORDER BY com_orden asc');
        $servicios = $consulta->result_array();
        $consulta = $this->db->query('SELECT cli_id as id, cli_nombre as nombre FROM clientes ' . $cli_where . ' ORDER BY cli_nombre asc');
        $clientes = $consulta->result_array();

        // var_dump($servicios,$clientes);exit();


        foreach ($clientes as $grado) {
            $array_clientes[$grado['id']] = $grado['nombre'];
        }

        // var_dump(count($array_clientes));exit();
        // var_dump($servicios);exit();
        foreach ($servicios as $servicio) {
            foreach ($array_clientes as $num => $cliente) {
                $eti_where = '';
                $fecha_where = '';
                
                switch ($servicio['id']) {
                    case 7:
                        if ($etiko) {
                            $eti_where = ' and (eti_id1="' . $etiko . '" or eti_id2="' . $etiko . '")';
                        }
                        if ($fecha_desde && $fecha_hasta) {
                            $fecha_where = ' and con_hasta between "' . $fecha_desde . '" and "' . $fecha_hasta . '"';
                        }
                        if ($facturacion) {
                            $facturacion_where = ' and con_facturacion="' . $facturacion . '"';
                        }
                            //else{
                        //     $facturacion_where = '';
                        // }
                        $consulta = $this->db->query('
                                        SELECT
                                        con_cargo as cargo,
                                        con_facturacion as facturacion,
                                        con_monto as monto,
                                        eti_id1 as eti1,
                                        eti_id2 as eti2,
                                        con_porciento1 as porciento1,
                                        con_porciento2 as porciento2,
                                        con_sede as sede,
                                        con_desde as desde,
                                        con_hasta as hasta
                                        FROM convocatoria
                                        WHERE cli_id=' . $num . ' ' . $eti_where . ' ' . $sede_where . ' ' . $fecha_where . ' ' . $facturacion_where);
                        break;
                    default:


                        if ($etiko) {
                            $eti_where = ' and eti_id="' . $etiko . '"';
                        }
                        if ($fecha_desde && $fecha_hasta) {
                            $fecha_where = ' and esp_hasta between "' . $fecha_desde . '" and "' . $fecha_hasta . '"';
                        }
                        if ($facturacion) {
                            $facturacion_where = ' and esp_facturacion="' . $facturacion . '"';
                        }
                        else{
                            $facturacion_where = '';
                        }

                       
                      
                        $consulta = $this->db->query('
                                        SELECT
                                        esp_area as cargo,
                                        esp_facturacion as facturacion,
                                        esp_monto as monto,
                                        eti_id as eti,
                                        esp_desde as desde,
                                        esp_hasta as hasta
                                        FROM especial_servicio
                                        WHERE com_id=' . $servicio['id'] . ' and cli_id="' . $num . '" ' . $eti_where . ' ' . $fecha_where . ' ' . $facturacion_where);

                           // var_dump($query.'ingreso a servicio');exit();


                        break;
                }
                $servicios_especiales = $consulta->result_array();
                if ($servicios_especiales)
                    $datos[$servicio['id']][$num] = $servicios_especiales;

                // print_r($servicios_especiales[1].'ingreso a servicio');exit();
            }
        }
        $this->cabecera['accion'] = 'ETIKO';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['etiko'] = 1;
        $contenido['datos'] = @$datos;
        $contenido['fecha_desde'] = $fecha_desde;
        $contenido['fecha_hasta'] = $fecha_hasta;
        $contenido['etiko'] = $etiko;
        $contenido['facturacion'] = $facturacion;
        $contenido['titulo'] = 'ETIKO';
        $data['contenido'] = $this->load->view($this->carpeta . 'reporte_etikos', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function servicio_generar() {
        if ($_SESSION[$this->presession . 'permisos'] > '2') {
            redirect('inicio');
        }
        $consulta = $this->db->query('SELECT com_id as id, com_nombre as nombre FROM combos WHERE com_tipo=8 ORDER BY com_orden asc');
        $servicios = $consulta->result_array();
        $campos_listar[] = 'Años';
        $campos_reales[] = 'anio';
        foreach ($servicios as $servicio) {
            $campos_listar[] = $servicio['nombre'] . ' (Bs)';
            $campos_reales[] = 'servicio' . $servicio['id'];
        }
        $campos_listar[] = 'Totales por Año';
        $campos_reales[] = 'sum_anio';
        $consulta = $this->db->query('
            SELECT year(esp_hasta) anios FROM especial_servicio GROUP BY anios ORDER BY anios DESC
            ');
        $anios_esp = $consulta->result_array();
        if ($anios_esp) {
            foreach ($anios_esp as $anio) {
                $anios[] = $anio['anios'];
                @$where .= $anio['anios'] . ',';
            }
            $where = ' WHERE year(con_hasta) not in (' . substr($where, 0, strlen($where) - 1) . ')';
        }
        $consulta = $this->db->query('
            SELECT year(con_hasta) anios FROM convocatoria ' . $where . ' GROUP BY anios ORDER BY anios DESC
            ');
        $anios_con = $consulta->result_array();
        if ($anios_con) {
            foreach ($anios_con as $anio) {
                $anios_con = $consulta->result_array();
                $anios[] = $anio['anios'];
            }
        }
        rsort($anios);
        $aux = 0;
        $total_anios = 0;
        foreach ($anios as $anio) {
            $sum_anio = 0;
            $datos[$aux]['anio'] = $anio;
            foreach ($servicios as $servicio) {
                switch ($servicio['id']) {
                    case 7:
                        $consulta = $this->db->query('
                                SELECT sum(con_monto) total
                                FROM convocatoria
                                WHERE year(con_hasta)="' . $anio . '"
                                ');
                        break;
                    default:
                        $consulta = $this->db->query('
                                SELECT sum(esp_monto) total
                                FROM especial_servicio
                                WHERE com_id=' . $servicio['id'] . ' and year(esp_hasta)="' . $anio . '"
                                ');
                        break;
                }
                $total = $consulta->row_array();
                if ($total['total']) {
                    $datos[$aux]['servicio' . $servicio['id']] = $total['total'];
                    @$totales['servicio' . $servicio['id']] += $total['total'];
                    $sum_anio += $total['total'];
                } else {
                    $datos[$aux]['servicio' . $servicio['id']] = 0;
                    @$totales['servicio' . $servicio['id']] += 0;
                    $sum_anio += 0;
                }
            }
            $datos[$aux]['sum_anio'] = '<b>' . $sum_anio . '</b>';
            $aux++;
            $total_anios += $sum_anio;
        }
        $datos[$aux + 1]['anio'] = '<b>Totales por Servicio:</b>';
        foreach ($servicios as $servicio) {
            $datos[$aux + 1]['servicio' . $servicio['id']] = '<b>' . $totales['servicio' . $servicio['id']] . '</b>';
        }
        $datos[$aux + 1]['sum_anio'] = '<font color="#966901"><b>' . $total_anios . '</b></font>';
        $this->cabecera['accion'] = 'Reporte Anual de Servicios';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['campos_listar'] = $campos_listar;
        $contenido['campos_reales'] = $campos_reales;
        $contenido['datos'] = $datos;
        $contenido['servicios'] = 1;
        $contenido['titulo'] = 'Reporte Anual de Servicios';
        $contenido['ocultarPostulaciones'] = 1;
        $data['contenido'] = $this->load->view($this->carpeta . 'reporte', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function cargos_select() {
        $id = $this->input->post('id');
        $consulta = $this->db->query('SELECT con_id as id, con_cargo as cargo FROM convocatoria WHERE cli_id=' . $id);
        $cargos = $consulta->result_array();
        $datos['cargos'] = $cargos;
        $this->load->view($this->carpeta . 'cargos', $datos);
    }

//para exportar de la tabla en html a excel
    function excelExportar() {
        header("Content-type: application/vnd.ms-excel; name='excel'");
        header("Content-Disposition: filename=prueba.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        if (isset($_POST['datos_a_enviar']) && $_POST['datos_a_enviar'] != '')
            echo $_POST['datos_a_enviar'];
    }

    function excel() {
        $campos_listar = unserialize(base64_decode($_REQUEST['campos_listar']));
        $campos_reales = unserialize(base64_decode($_REQUEST['campos_reales']));
        $datos = unserialize(base64_decode($_REQUEST['datos']));
        $cabecera_listado = unserialize(base64_decode($_REQUEST['cabecera_listado']));
        $titulo = 'Reporte - ' . $this->input->post('titulo');
        $contenido['campos_listar'] = $campos_listar;
        $contenido['campos_reales'] = $campos_reales;
        $contenido['datos'] = $datos;
        $contenido['titulo'] = $titulo;
        $contenido['cabecera_listado'] = $cabecera_listado;
        $contenido['archivo'] = str_replace(' ', '_', $titulo);
        $this->load->view($this->carpeta . 'excel', $contenido);
    }

    function excel_contenido() {
        $contenido_excel = unserialize(base64_decode($_REQUEST['contenido']));
        $cabecera_listado = unserialize(base64_decode($_REQUEST['cabecera_listado']));
        $titulo = 'Reporte - ' . $this->input->post('titulo');
        $contenido['contenido'] = $contenido_excel;
        $contenido['titulo'] = $titulo;
        $contenido['cabecera_listado'] = $cabecera_listado;
        $contenido['archivo'] = str_replace(' ', '_', $titulo);
        $this->load->view($this->carpeta . 'excel_contenido', $contenido);
    }
  


}

?>