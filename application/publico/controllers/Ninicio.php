<?php
// date_default_timezone_set('America/La_Paz');
class Ninicio extends CI_Controller {

    function __construct() {
        parent::__construct();
        //if (in_array($this->uri->segment(1), $this->config->item('sin_ssl_pages'))) {
        //    remove_ssl();
        //} else {
            force_ssl();
        //}
        $this->load->helper(array('url', 'form', 'html', 'pdf'));
        $this->load->library(array('form_validation', 'tool_general', 'zip'));

        $this->load->helper(array('url', 'form'));
        $this->load->helper('html');
        $this->no_mostrar_enlaces = 1;
        $this->contenido_completo = 1;
        $this->urifull = $this->uri->uri_to_assoc();
        $this->rutabase = $this->tool_entidad->sitioindex();
        $this->rutarchivo = $this->tool_entidad->sitio() . 'archivos/';
        $this->rutabaseimg = $this->tool_entidad->baseurlimg();
        $this->rutadj = 'archivos/';
        $this->rutaimg = $this->tool_entidad->sitio() . 'files/img/';
        //nuevo para cv de postulantes
		$this->tablaG = 'zis_grupo_evaluacion';
        $this->tablaE = 'zis_evaluacion';
        $this->tablaPa = 'zis_participante';
        $this->prefijoG = 'gru_';
        $this->prefijoE = 'eva_';
        $this->prefijoPa = 'par_';
        $this->prefijo = 'pos_';
        $this->carpeta = 'inicio';
        session_start();
        $this->presession = $this->tool_entidad->presession();
        if (!isset($_SESSION[$this->presession . 'usuario'])) {
            redirect(base_url() . index_page());
        }
    }

    function index() {

        // hora del sistema
//         $DateAndTime = date('m-d-Y h:i:s a', time());  
//         echo "The current date and time are $DateAndTime.";
//         echo '<br>';
//         $hora = $this->db->query('SELECT NOW()
// FROM
// etiko
//         ' 
//         );
//         exit();
        // fin de hora del sistema

        $this->cabecera['titulo'] = 'Pagina de Inicio';
        $id = $_SESSION[$this->presession . 'id'];
        $consulta = $this->db->query('
        SELECT *
        FROM educacion_secundaria
        WHERE pos_id=' . $id);
        $secundaria = $consulta->result_array();
        $consulta = $this->db->query('
        SELECT *
        FROM trayectoria_laboral
        WHERE pos_id=' . $id);
        $trayectorias = $consulta->result_array();
        if (!$secundaria) {
            $contenido['instruccion'] = 1;
        }
        if (!$trayectorias) {
            $contenido['trayectoria'] = 1;
        }

        $consulta = $this->db->query('
        SELECT *
        FROM convocatoria
        WHERE con_tope>="' . date('Y-m-d') . '" and con_interno != "1"
        ORDER BY con_id desc'
        );
        $convocatorias = $consulta->result_array();
        $consulta = $this->db->query('
        SELECT *, (date_format(b.con_fecha_creacion,"%Y-%m-%d") + INTERVAL 20 DAY) as fecha_edicion, date_format(a.con_fecha_edicion, "%Y-%m-%d") as fecha
        FROM convocatoria_postulacion a, convocatoria b
        WHERE pos_id=' . $id . ' and b.con_id=a.con_id1 and (b.con_tope + INTERVAL 20 DAY) >="' . date('Y-m-d') . '"
        ORDER BY a.con_fecha_creacion asc'
        );
        $postulaciones = $consulta->result_array();
        foreach ($postulaciones as $postulacion) {
            foreach ($convocatorias as $numero => $convocatoria) {
                if ($convocatoria['con_id'] == $postulacion['con_id1']) {
                    unset($convocatorias[$numero]);
                }
            }
        }
        $consulta = $this->db->query('
        SELECT *
        FROM noticia
        ORDER BY not_fecha_creacion desc, not_id desc'
        );
        $anuncios = $consulta->result_array();

        //etapas
		// -------CONSULTA EVALUACIONES
        $query_grupo_eval="SELECT * FROM '.$this->tablaPa.' as p inner join '.$this->tablaG.' as g on p.'.$this->prefijoG.'id=g.'.$this->prefijoG.'id AND p.'.$this->prefijo.'id='.$id.' AND g.'.$this->prefijoG.'estado=1
        AND g.'.$this->prefijoG.'fecha_vigencia >= CURDATE()";

		$consulta = $this->db->query('
		SELECT * FROM '.$this->tablaPa.' as p inner join '.$this->tablaG.' as g on p.'.$this->prefijoG.'id=g.'.$this->prefijoG.'id AND p.'.$this->prefijo.'id='.$id.' AND g.'.$this->prefijoG.'estado=1
		AND g.'.$this->prefijoG.'fecha_vigencia >= CURDATE() ORDER BY g.gru_fecha_vigencia DESC
		' 
        );
        //grupo de evaluaciones
        $grupo = $consulta->result_array();
        //grupo de evaluaciones
        // var_dump($query_grupo_eval);exit();
		if(@$grupo){
			$cgrupo=count($grupo);
			// $idgupo = $grupo[$this->prefijoG.'id'];
			for($i=0;$i<$cgrupo;$i++){
				$idgrupo = $grupo[$i][$this->prefijoG.'id'];
				// echo $idgupo;
				$evaluaciones[$i]=array();
				$consulta2 = $this->db->query('
				SELECT '.$this->prefijoE.'id, '.$this->prefijoE.'titulo, '.$this->prefijoE.'estado, tipo_eval_id,eva_nro_intentos FROM '.$this->tablaE.' WHERE '.$this->prefijoG.'id='.$idgrupo.'
				'
				);
				$evaluaciones[$i] = $consulta2->result_array();
				// print_r($evaluaciones[$i]);exit();
				$j=0;
				foreach($evaluaciones[$i] as $ev){
					$ideva = $ev[$this->prefijoE.'id'];
					$consulta3 = $this->db->query('
					SELECT * FROM zis_seguimiento WHERE pos_id='.$id.' AND gru_id='.$idgrupo.' AND eva_id='.$ideva.'
					'
					);
					$seguimiento = $consulta3->first_row('array');
                    //var_dump($seguimiento['seg_intentos']);exit();
                    $msj_eva_validacion="";
                    //nro de intentos y maximo de intentos
                    if ($consulta3->num_rows()>0) {
                        $evaluaciones[$i][$j]['nro_intento_seg'] = $seguimiento['seg_intentos'];
                        $evaluaciones[$i][$j]['estado_Porcentaje_avance'] = $seguimiento['seg_termino'];
                        if ($seguimiento['seg_intentos']>$seguimiento['seg_max_intentos']) {
                            $msj_eva_validacion='(Ha superado el nro. máximo de intentos)';
                        }
                        if ($seguimiento['seg_termino']==1) {
                            $msj_eva_validacion='(Prueba concluida)';
                        }
                        
                        //$evaluaciones[$i][$j]['nro_max_intento_eval'] = $seguimiento['seg_max_intentos'];
                    }else{
                         $evaluaciones[$i][$j]['nro_intento_seg'] = 0;
                         $evaluaciones[$i][$j]['estado_Porcentaje_avanse'] = 0;
                        // $evaluaciones[$i][$j]['nro_max_intento_eval'] = $seguimiento['seg_max_intentos'];
                    }
                    //consulta de seguimiento
					if(@$seguimiento['seg_intentos']>@$seguimiento['seg_max_intentos'] || @$seguimiento['seg_termino']==1 || @$evaluaciones[$i][$j]['eva_estado']==0){
						$evaluaciones[$i][$j]['enlace'] = '
						<li style="color:black;">
						'.$evaluaciones[$i][$j][$this->prefijoE.'titulo'].' '.$msj_eva_validacion.'
						</li>
						';
                        

					}else{
						$tipo=$evaluaciones[$i][$j]['tipo_eval_id'];
						$evaluaciones[$i][$j]['enlace'] = '
						<a href="'.$this->tool_entidad->sitio() . 'index.php/Evaluacion/principal/idg/'.$idgrupo.'/ev/'.$ideva.'/tip/'.$tipo.'" ><li>
						'.$evaluaciones[$i][$j][$this->prefijoE.'titulo'].'
						</li></a>
						';
					}
                    
                   

					//print_r($seguimiento);
					
					$j++;

				}
				// print_r ($evaluaciones[$i]);
			}
			$contenido['evaluaciones'] = $evaluaciones;
		}
		else{
			// echo 'no hay evaluaciones';
		}
		// print_r($grupo);
		// exit();
	   //var_dump($evaluaciones);exit();
        //noticias
        $noticias_etika = $this->db->query("SELECT * FROM noticias WHERE not_estado=1 ORDER BY not_orden DESC");
        if ($noticias_etika->num_rows()>0) {
            $contenido['noticias_etika'] = $noticias_etika->result_array();
            $contenido['validacion_noticias_etika'] = 1;
        }else{
            $contenido['validacion_noticias_etika'] = 0;
        }
        //var_dump($noticias);exit();
        $consulta = $this->db->query('
        SELECT pof_estado as estado
        FROM postulante_f
        WHERE pos_id=' . $id);
        $estado = $consulta->row_array();
        $contenido['cabecera'] = $this->cabecera;
        $contenido['convocatorias'] = $convocatorias;
        $contenido['postulaciones'] = $postulaciones;
        $contenido['grupo'] = $grupo;
        $contenido['anuncios'] = $anuncios;
        
        $contenido['estado'] = $estado;
        $contenido['id'] = $id;
        $contenido['editar'] = $this->estado_usuario($id);
        $data['contenido'] = $this->load->view('inicio/nindex', $contenido, true);
        $data['paginicio'] = 1;
//        $this->load->view('plantilla_publico', $data);
        $this->load->view('plantilla_publico_2019', $data);
    }

    function mostrar() {

        $idp = $_SESSION[$this->presession . 'id'];
        $consulta = $this->db->query('
        SELECT *
        FROM educacion_secundaria
        WHERE pos_id=' . $idp);
        $secundaria = $consulta->result_array();
        $consulta = $this->db->query('
        SELECT *
        FROM trayectoria_laboral
        WHERE pos_id=' . $idp);
        $trayectorias = $consulta->result_array();
        if (!$secundaria) {
            $contenido['instruccion'] = 1;
        }
        if (!$trayectorias) {
            $contenido['trayectoria'] = 1;
        }

        $id = $this->urifull['id'];
        $consulta1 = $this->db->query('
        select * from convocatoria where con_id=' . $id);
        $fila = $consulta1->row_array();
        $rutacces = array(
            'nombre1' => $titulo = 'Pagina de Inicio',
            'enlace1' => $this->rutabase . 'inicio',
            'nombre2' => $fila['con_cargo'],
            'enlace2' => '#'
        );
       $consulta = $this->db->query('
        SELECT pof_estado as estado
        FROM postulante_f
        WHERE pos_id=' . $idp);
        $estado = $consulta->row_array();
        $contenido['rutacces'] = $rutacces;
        @$contenido['boton'] = $this->boton;
        @$contenido['cabecera'] = $this->cabecera;
        $contenido['estado'] = $estado;
        $contenido['fila'] = $fila;

        $data['contenido'] = $this->load->view('inicio/ver', $contenido, true);
        $this->load->view('plantilla_publico_2019', $data);
        //mostrar la plantilla seleccionada
        // $vista = $fila['pla_id'];
        // if ($vista == 0 || $vista == 1) {
        //     $data['contenido'] = $this->load->view('inicio/ver1', $contenido, true);
        //     $this->load->view('plantilla_publico_2019', $data);
        // }

        // if ($vista == 2) {
        //     $data['contenido'] = $this->load->view('inicio/ver2', $contenido, true);
        //     $this->load->view('plantilla_publico_2019', $data);
        // }
        // if ($vista == 3) {
        //     $data['contenido'] = $this->load->view('inicio/ver3', $contenido, true);
        //     $this->load->view('plantilla_publico_2019', $data);
        // }
        
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

     function mostrar_noticia($id_noticia=null) {
      
      $this->cabecera['titulo'] = 'Pagina de Inicio';
        $id = $_SESSION[$this->presession . 'id'];
        //noticias
        $noticias_etika = $this->db->query("SELECT * FROM noticias WHERE not_id=$id_noticia and not_estado=1");
        if ($noticias_etika->num_rows()>0) {
            $contenido['nt_row'] = $noticias_etika->row();
            $contenido['validacion_noticias_etika'] = 1;
        }else{
            $contenido['validacion_noticias_etika'] = 0;
            redirect('Ninicio');
        }
        //var_dump($noticias_etika);exit();
        $consulta = $this->db->query('
        SELECT pof_estado as estado
        FROM postulante_f
        WHERE pos_id=' . $id);
        $estado = $consulta->row_array();
        $contenido['cabecera'] = $this->cabecera;
        $contenido['estado'] = $estado;
        $contenido['id'] = $id;
        $contenido['editar'] = $this->estado_usuario($id);
        $data['contenido'] = $this->load->view('inicio/ver_noticia_id', $contenido, true);
        $data['paginicio'] = 1;
        $this->load->view('plantilla_publico_2019', $data);

     }


     function mostrar_noticia_all() {
      
      $this->cabecera['titulo'] = 'Pagina de Inicio';
        $id = $_SESSION[$this->presession . 'id'];
        //noticias
        $noticias_etika = $this->db->query("SELECT * FROM noticias WHERE not_estado=1 ORDER BY not_orden DESC");
        if ($noticias_etika->num_rows()>0) {
            $contenido['nt_row'] = $noticias_etika->result_array();
            $contenido['validacion_noticias_etika'] = 1;
        }else{
            $contenido['validacion_noticias_etika'] = 0;
        }
        //var_dump($noticias_etika);exit();
        $consulta = $this->db->query('
        SELECT pof_estado as estado
        FROM postulante_f
        WHERE pos_id=' . $id);
        $estado = $consulta->row_array();
        $contenido['cabecera'] = $this->cabecera;
        $contenido['estado'] = $estado;
        $contenido['id'] = $id;
        $contenido['editar'] = $this->estado_usuario($id);
        $data['contenido'] = $this->load->view('inicio/mostrar_todas_noticias', $contenido, true);
        $data['paginicio'] = 1;
        $this->load->view('plantilla_publico_2019', $data);

     }



     function mostrar_noticias_ordenado() {
      
      $this->cabecera['titulo'] = 'Pagina de Inicio';
        $id = $_SESSION[$this->presession . 'id'];
        //noticias
        $noticias_etika = $this->db->query("SELECT * FROM noticias WHERE not_estado=1");
        if ($noticias_etika->num_rows()>0) {
            $contenido['nt_row'] = $noticias_etika->result_array();
            $contenido['validacion_noticias_etika'] = 1;
        }else{
            $contenido['validacion_noticias_etika'] = 0;
        }
        //var_dump($noticias_etika);exit();
        $consulta = $this->db->query('
        SELECT pof_estado as estado
        FROM postulante_f
        WHERE pos_id=' . $id);
        $estado = $consulta->row_array();
        $contenido['cabecera'] = $this->cabecera;
        $contenido['estado'] = $estado;
        $contenido['id'] = $id;
        $contenido['editar'] = $this->estado_usuario($id);
        $data['contenido'] = $this->load->view('inicio/mostrar_todas_noticias_ordenado', $contenido, true);
        $data['paginicio'] = 1;
        $this->load->view('plantilla_publico_2019', $data);

     }

    function cerrar_session() {
        session_destroy();
        redirect();
    }

    function imprimir_doc() {
        $id = $this->uri->segment(4);
        $array_doc = $this->preparar_doc($id);

        $doc = $array_doc['doc'];
        $nombre_archivo = $array_doc['nombre_archivo'];
        $archivo = $this->temporal($doc, ".doc");
        $this->descargar($archivo, $nombre_archivo);
    }

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
        $doc['doc'] = $this->load->view($this->carpeta . '/imprimir', $contenido, true);
        $doc['nombre_archivo'] = $this->tool_general->limpiar_cadena($datos_personales['pos_apaterno'] . ' ' . $datos_personales['pos_amaterno'] . ' ' . $datos_personales['pos_nombre']);
        return $doc;
    }

    function temporal($pdf, $extencion) {
        $tmp = @tempnam("tmp", "tmp") . $extencion;
        $fp = fopen($tmp, "w");
        fputs($fp, $pdf);
        fclose($fp);
        return $tmp;
    }

    function descargar($archivo, $filename) {
        $data['archivo'] = $archivo;
        $data['filename'] = $filename;
        $this->load->view($this->carpeta . '/descargar', $data);
    }

    function prueba_marca()
    {
        $this->load->view('inicio/imprimir');
    }

}

?>