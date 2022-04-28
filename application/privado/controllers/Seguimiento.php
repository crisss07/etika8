<?php
require_once('Controladoradmin.php');

class Seguimiento extends Controladoradmin
{
    function __construct()
    {
      parent::__construct();
      force_ssl();
      $this->load->helper(array('url','form','html'));
      $this->load->library(array('form_validation','tool_general'));

         //****** definiendo nombre de carpeta por defecto
      $this->carpeta='seguimiento/';
      $this->controlador='Seguimiento/';

      $this->tabla='zis_seguimiento';
      $this->prefijo='seg_';
        //******* definiendo campos de la tabla
      $this->campo=array($this->prefijo.'nombre');


      $this->formulario_agregar='contador_agregar';
      $this->formulario_editar='contador_agregar';
      $this->action_defecto='listar';


         //****** cargando el modelo
      $this->modelo='modelo_contador';
        //$this->load->model($this->carpeta.'Contador_model',$this->modelo,TRUE);

      $this->cabecera['titulo']='Administraci&oacute;n de Combos';
      $this->rutaimg=@$this->constantes['nombresitio'].'files/img/';              

      $this->boton=7;
      $this->msj_retorno='Volver';
      $this->ruta_retorno='combos';        
      $this->orden=$this->prefijo.'orden';
      $this->presession=$this->tool_entidad->presession();
      session_start();
      if (!isset($_SESSION[$this->presession.'usuario']))
      {
          redirect(base_url().index_page());
      }
}       






    //tabla grupo evaluacion
function listar()
{
    $this->cabecera['accion']='Listado';       
    $consulta = $this->db->query("SELECT z.*,c.cli_nombre FROM zis_grupo_evaluacion z
        INNER JOIN clientes c
        on z.cli_id=c.cli_id
            WHERE gru_fecha_vigencia>=NOW()
        ORDER BY z.gru_fecha_vigencia DESC");

    $anios = $this->db->query("SELECT DISTINCT YEAR(gru_fecha_vigencia)as anio FROM
zis_grupo_evaluacion")->result();

    $datos=$consulta->result_array();
//var_dump($datos);exit();
    $contenido['cabecera']=$this->cabecera;
    $contenido['datos'] = $datos;
    $contenido['anios'] = $anios;
    $data['contenido'] = $this->load->view('seguimiento/lista', $contenido, true);
    $this->load->view('plantilla_privado',$data);
}

function listar_anio($anio)
{
    $this->cabecera['accion']='Listado';       
    $consulta = $this->db->query("SELECT z.*,c.cli_nombre FROM zis_grupo_evaluacion z
        INNER JOIN clientes c
        on z.cli_id=c.cli_id
                WHERE YEAR(z.gru_fecha_vigencia)=$anio
        ORDER BY z.gru_fecha_vigencia DESC");

    $anios = $this->db->query("SELECT DISTINCT YEAR(gru_fecha_vigencia)as anio FROM
zis_grupo_evaluacion")->result();

    $datos=$consulta->result_array();
        // var_dump($datos);exit();
    $contenido['cabecera']=$this->cabecera;
    $contenido['datos'] = $datos;
    $contenido['anios'] = $anios;
    $data['contenido'] = $this->load->view('seguimiento/lista_anio', $contenido, true);
    $this->load->view('plantilla_privado',$data);
}

   //tabla grupo evaluacion
function participantes($id_grupo=null)
{
    $this->cabecera['accion']='Listado';       
    $consulta = $this->db->query("SELECT p.* FROM zis_participante z
        join postulante p
        on z.pos_id=p.pos_id
        WHERE gru_id=$id_grupo ORDER BY pos_id ASC");
    $datos=$consulta->result();
    $grupo_array = $this->db->query("SELECT * from zis_evaluacion WHERE gru_id=$id_grupo AND tipo_eval_id NOT LIKE 4")->result_array();
    //seguimiento
    $array_evaluaciones=[];
    $array_nombre_eval=[];
    for ($j = 0; $j < count($grupo_array); $j++) {
        $id_eval=$grupo_array[$j]['eva_id'];
        $nombre_eval=$grupo_array[$j]['eva_titulo'];
        // var_dump($grupo_array[$j]['eva_titulo']);exit();

        $data_eval = $this->db->query("SELECT r.pos_id, (
            CASE 
            WHEN f.seg_intentos IS NULL
            THEN 0
            ELSE f.seg_intentos
            END
            ) AS nro_intentos,
            (
            CASE 
            WHEN f.seg_porcentaje IS NULL
            THEN 0
            ELSE f.seg_porcentaje
            END
            ) AS porcentaje,
            (
            CASE 
            WHEN f.seg_tiempo_total IS NULL
            THEN 0
            ELSE f.seg_tiempo_total
            END
            ) AS tiempo_total,f.gru_id,f.eva_id
            FROM (SELECT p.*,s.gru_id FROM postulante p
            LEFT JOIN 
            zis_participante s
            on p.pos_id=s.pos_id
            WHERE s.gru_id=$id_grupo) r
            LEFT JOIN
            (SELECT * FROM zis_seguimiento
            WHERE gru_id=$id_grupo and eva_id=$id_eval) f
            on r.pos_id=f.pos_id ORDER BY r.pos_id ASC")->result_array();
        array_push($array_evaluaciones,$data_eval);
        array_push($array_nombre_eval,$nombre_eval);
    }

    $total_eval=count($grupo_array);

    //var_dump($array_evaluaciones[0][0]['pos_id']);exit();

    //nombre grupos
    $nombre_grupo = $this->db->query("SELECT * from zis_grupo_evaluacion WHERE gru_id=$id_grupo")->result_array();

    


    // var_dump(count($datos));exit();
    $datos_dos=$consulta->result_array();
    // $datos_dos=$datos_dos[0];
    $contenido['cabecera']=$this->cabecera;
    $contenido['datos'] = $datos;
    $contenido['nombre_grupo'] = $nombre_grupo[0]['gru_nombre'];
    $contenido['datos_dos'] = $datos_dos;
    $contenido['evaluaciones'] = $array_evaluaciones;
    $contenido['nombre_eval'] = $array_nombre_eval;
    $contenido['nro_participantes'] = count($datos);
    $contenido['id_grupo'] = $id_grupo;
    $data['contenido'] = $this->load->view('seguimiento/participantes', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}

//lista de participantes del grupo
function respuestas_participantes($id_grupo=null)
{
    $this->cabecera['accion']='Listado';       
    $consulta = $this->db->query("SELECT p.* FROM zis_participante z
        join postulante p
        on z.pos_id=p.pos_id
        WHERE gru_id=$id_grupo ORDER BY pos_id ASC");
    $datos=$consulta->result();
    $grupo_array = $this->db->query("SELECT * from zis_evaluacion WHERE gru_id=$id_grupo")->result_array();
    //seguimiento
    $array_evaluaciones=[];
    $array_nombre_eval=[];
    $array_id_eval=[];
    for ($j = 0; $j < count($grupo_array); $j++) {
        $id_eval=$grupo_array[$j]['eva_id'];
        $nombre_eval=$grupo_array[$j]['eva_titulo'];
        // var_dump($grupo_array[$j]['eva_titulo']);exit();
        $id_tipo=["id_eva"=>$grupo_array[$j]['eva_id'],"tipo_eva"=>$grupo_array[$j]['tipo_eval_id'],"id_grupo"=>$grupo_array[$j]['gru_id']];
        //var_dump($id_tipo);exit();

        $data_eval = $this->db->query("SELECT r.pos_id, (
            CASE 
            WHEN f.seg_intentos IS NULL
            THEN 0
            ELSE f.seg_intentos
            END
            ) AS nro_intentos,f.gru_id,f.eva_id,f.seg_porcentaje as porcentaje,f.seg_termino FROM (SELECT p.*,s.gru_id FROM postulante p
            LEFT JOIN 
            zis_participante s
            on p.pos_id=s.pos_id
            WHERE s.gru_id=$id_grupo) r
            LEFT JOIN
            (SELECT * FROM zis_seguimiento
            WHERE gru_id=$id_grupo and eva_id=$id_eval) f
            on r.pos_id=f.pos_id ORDER BY r.pos_id ASC")->result_array();
        array_push($array_evaluaciones,$data_eval);
        array_push($array_nombre_eval,$nombre_eval);
        array_push($array_id_eval,$id_tipo);
    }
    $total_eval=count($grupo_array);
    
$grupo_inf = $this->db->query("SELECT * from zis_grupo_evaluacion WHERE gru_id=$id_grupo")->result_array();
		// $cadena=$grupo_inf[0]['gru_nombre'];
		// $cadena =str_replace(' ', '', $cadena);
		// $id_carpeta=$grupo_inf[0]['gru_id'].$cadena;
		$id_carpeta=$grupo_inf[0]['gru_id'];
		
		
		// var_dump($id_carpeta);
    //var_dump($array_id_eval[0]);exit();
    
    $nombre_grupo = $this->db->query("SELECT * from zis_grupo_evaluacion WHERE gru_id=$id_grupo")->result_array();

    // var_dump(count($datos));exit();
    $contenido['id_carpeta']=$id_carpeta;
    $contenido['cabecera']=$this->cabecera;
    $contenido['datos'] = $datos;
    $contenido['evaluaciones'] = $array_evaluaciones;
    $contenido['nombre_eval'] = $array_nombre_eval;
    $contenido['nro_participantes'] = count($datos);
    $contenido['id_grupo'] = $id_grupo;
    $contenido['tipo_eval'] = $array_id_eval;
    $contenido['nombre_grupo'] = $nombre_grupo[0]['gru_nombre'];
    $data['contenido'] = $this->load->view('seguimiento/listado_participantes_respuestas', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}
//lista de respuestas para los tipos de plantillas
function informe($pos_id=null,$id_grupo=null,$id_eval=null)
{
    $consulta = $this->db->query("SELECT e.tipo_eval_id FROM zis_evaluacion e WHERE eva_id=$id_eval")->row();
    $tipo=$consulta->tipo_eval_id;
    if ($tipo==1) {
        redirect('Analitica/ver_respuestas_s/'.$pos_id.'/'.$id_grupo.'/'.$id_eval);
    }
    if ($tipo==2) {
        redirect('Reporte_sabio/lista_preguntas/'.$pos_id.'/'.$id_grupo.'/'.$id_eval);
    }
    if ($tipo==3) {
        redirect('Reporte_actitudes/pdf_redirect_dos/'.$pos_id.'/'.$id_grupo.'/'.$id_eval);
    }
    if ($tipo==5) {
        redirect('Reporte_ic/pdf_redirect_dos/'.$pos_id.'/'.$id_grupo.'/'.$id_eval);
    }

}
//para los reportes
function pdf($pos_id=null,$id_grupo=null,$id_eval=null)
{
    $consulta = $this->db->query("SELECT e.tipo_eval_id FROM zis_evaluacion e WHERE eva_id=$id_eval")->row();
    $tipo=$consulta->tipo_eval_id;
    if ($tipo==1) {
        redirect('Analitica/informe_pdf/'.$pos_id.'/'.$id_grupo.'/'.$id_eval);
        
    }
    if ($tipo==2) {
        redirect('Reporte_sabio/pdf/'.$pos_id.'/'.$id_grupo.'/'.$id_eval);

    }
    if ($tipo==3) {
        redirect('Reporte_actitudes/pdf_redirect/'.$pos_id.'/'.$id_grupo.'/'.$id_eval);

    }
    if ($tipo==5) {
        redirect('Reporte_ic/pdf_redirect/'.$pos_id.'/'.$id_grupo.'/'.$id_eval);

    }

}

function vistas($pos_id=null,$id_grupo=null,$id_eval=null)
{
    $consulta = $this->db->query("SELECT e.tipo_eval_id FROM zis_evaluacion e WHERE eva_id=$id_eval")->row();
    $tipo=$consulta->tipo_eval_id;
    if ($tipo==1) {
        redirect('Analitica/informe_pdf_html/'.$pos_id.'/'.$id_grupo.'/'.$id_eval);
        
    }
    if ($tipo==2) {
        redirect('Reporte_sabio/pdf_html/'.$pos_id.'/'.$id_grupo.'/'.$id_eval);

    }
    if ($tipo==3) {
        redirect('Reporte_actitudes/vista_redirect/'.$pos_id.'/'.$id_grupo.'/'.$id_eval);

    }
    if ($tipo==5) {
        redirect('Reporte_ic/vista_redirect/'.$pos_id.'/'.$id_grupo.'/'.$id_eval);

    }

}

function vista_informe($pos_id=null,$id_grupo=null,$id_eval=null)
{
    $consulta = $this->db->query("SELECT e.tipo_eval_id FROM zis_evaluacion e WHERE eva_id=$id_eval")->row();
    $tipo=$consulta->tipo_eval_id;
    if ($tipo==1) {
        redirect('Analitica/ver_respuestas_s/'.$pos_id.'/'.$id_grupo.'/'.$id_eval);
    }
    if ($tipo==2) {
        redirect('Reporte_sabio/lista_preguntas/'.$pos_id.'/'.$id_grupo.'/'.$id_eval);
    }
    if ($tipo==3) {
        redirect('Reporte_actitudes/vista_redirect_dos/'.$pos_id.'/'.$id_grupo.'/'.$id_eval);
    }
    if ($tipo==5) {
        redirect('Reporte_ic/pdf_redirect_dos/'.$pos_id.'/'.$id_grupo.'/'.$id_eval);
    }

}



//lista de mensaje para el sitio publico
function lista_mensaje()
{
    $this->cabecera['accion']='Listado';       
    $consulta = $this->db->query("SELECT * FROM zis_texto_grupo");
    $datos=$consulta->result_array();
        // var_dump($datos);exit();
    $contenido['cabecera']=$this->cabecera;
    $contenido['datos'] = $datos;
    $data['contenido'] = $this->load->view('seguimiento/mensaje_grupo', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}

//agregar mensaje
function agregar_msj()
{

    $this->cabecera['accion']='Texto de bienvenida'; 

    $contenido['cabecera']=$this->cabecera;
    $contenido['titulo_msj']="";
    
    $contenido['error_msj']="";
    $data['contenido'] = $this->load->view('seguimiento/agregar_msj', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}

function create_mensaje()
{
    // despues de guardar los datos se abre el form de texto instructivo
    $contenido_texto = $this->input->post('contenido');    
    $titulo = $this->input->post('titulo');
    // var_dump($contenido_texto);exit();
    if ($contenido_texto == ""){
        $this->cabecera['accion']='Texto de bienvenida'; 

    $contenido['cabecera']=$this->cabecera;
    $contenido['titulo_msj']=$titulo;    
    $contenido['error_msj']="Debe introducir un contenido";
    $data['contenido'] = $this->load->view('seguimiento/agregar_msj', $contenido, true);

    $this->load->view('plantilla_privado',$data);

    }else{
        $data = array(
        'titulo' => $titulo ,
        'contenido' => $contenido_texto ,
    );

    $this->db->insert('zis_texto_grupo', $data);    
    redirect('Seguimiento/lista_mensaje/');  
    }
    

      
}

function editar_msj($idmsj=null)
{   $this->db->where('texto_id',$idmsj);   
$data_m=$this->db->get('zis_texto_grupo');   
$data_m=$data_m->row();
    // var_dump($data);exit();


$this->cabecera['accion']='Texto de bienvenida'; 

$contenido['cabecera']=$this->cabecera;
$contenido['texto_id']=$idmsj;
$contenido['titulo_msj']=$data_m->titulo;
$contenido['contenido_msj']=$data_m->contenido;
$contenido['error_msj']="";
$data['contenido'] = $this->load->view('seguimiento/editar_msj', $contenido, true);

$this->load->view('plantilla_privado',$data);

}

function update_mensaje()
{

    $texto_id = $this->input->post('texto_id');
    $contenido_texto = $this->input->post('contenido');    
    $titulo = $this->input->post('titulo');

    // var_dump($this->form_validation->run());exit();
    // var_dump($contenido);exit(); 
    if ($contenido_texto=="") {
        // var_dump($contenido);exit(); 
        $this->cabecera['accion']='Texto de bienvenida'; 
        $contenido['cabecera']=$this->cabecera;
        $contenido['texto_id']=$texto_id;
        $contenido['titulo_msj']=$titulo;
        $contenido['contenido_msj']=$contenido_texto;
        $contenido['error_msj']="Debe introducir un contenido";
        $data['contenido'] = $this->load->view('seguimiento/editar_msj', $contenido, true);
        $this->load->view('plantilla_privado',$data);
    }else{
        $data = array(
        'titulo' => $titulo ,
        'contenido' => $contenido_texto ,
    );
    $this->db->where('texto_id', $texto_id);             
    $this->db->update('zis_texto_grupo', $data);    
    redirect('Seguimiento/lista_mensaje/');
    }
    

    
    

}

function delete($texto_id)
{       
    $this->db->where('texto_id', $texto_id);             
    $this->db->delete('zis_texto_grupo');    
    redirect('Seguimiento/lista_mensaje/');    
}

//habilitar un intento
function habilitar_intento($pos_id=null,$id_grupo=null,$id_eval=null)
{

    $consulta = $this->db->query("SELECT seg_id,seg_intentos FROM zis_seguimiento
        WHERE gru_id=$id_grupo and eva_id=$id_eval and pos_id=$pos_id")->row();

    $nro_intentos=$consulta->seg_intentos;
    $nro_intentos=$nro_intentos-1; 
    $id=$consulta->seg_id;
    // var_dump($nro_intentos);exit();   
    $this->db->set('seg_intentos',$nro_intentos); 
    $this->db->where('seg_id',$id);            
    $this->db->update('zis_seguimiento');
    redirect('Seguimiento/participantes/'.$id_grupo);    
    
}

//vista para el xls de evaluaciones del grupo
function respuestas_globales($id_grupo=null)
{

    $this->cabecera['accion']='Respuestas por evaluacion'; 
    $consulta = $this->db->query("SELECT * FROM zis_evaluacion
WHERE gru_id=$id_grupo")->result();
    $contenido['cabecera']=$this->cabecera;
    $contenido['id_grupo']=$id_grupo;
    $contenido['eval']=$consulta;
    $data['contenido'] = $this->load->view('seguimiento/respuestasporevaluacion', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}

//vista para el xls de evaluaciones del grupo solo Respuestas del Sabio
function respuestas_globales_rueda($id_grupo=null)
{    
    $verificar = $this->db->query("SELECT * FROM zis_evaluacion
WHERE gru_id=$id_grupo and tipo_eval_id=2");

    if ($verificar->num_rows()>0) {
        // si hay datos
        $verificar=$verificar->row();
        $id_eval=$verificar->eva_id;

        $verificar_termino = $this->db->query("SELECT * FROM zis_seguimiento
WHERE gru_id=$id_grupo and eva_id=$id_eval and seg_porcentaje=100 and seg_termino=1");
        if ($verificar_termino->num_rows()>0) {
                redirect('Reporte_sabio/xls_comparativo/'.$id_grupo.'/'.$id_eval);  
        }else{
                redirect('Seguimiento/listar/');   
        }
        //var_dump($id_grupo,$id_eval);exit();
         
    }else{
        redirect('Seguimiento/listar/');   
    }
    

    

}

//vista para el xls de evaluaciones del grupo
function reporte_por_plantilla()
{
    $this->cabecera['accion']='Respuestas por Plantilla'; 
    $consulta = $this->db->query("SELECT * FROM zis_plantillas WHERE ztipo_eval_id!=4")->result();
    $contenido['cabecera']=$this->cabecera;    
    $contenido['plantilla']=$consulta;
    $data['contenido'] = $this->load->view('seguimiento/respuestasporplantilla', $contenido, true);
    $this->load->view('plantilla_privado',$data);
}


function generar_xls()
{   
    $id_plantilla = $this->input->post('id_plantilla');
    $fecha_ini = $this->input->post('fecha_ini');
    $fecha_fin = $this->input->post('fecha_fin');
    //split al id_plantilla
    $id_plantilla = explode(",", $id_plantilla);
    $id_plantilla=$id_plantilla[0];
    $consulta = $this->db->query("SELECT ztipo_eval_id FROM zis_plantillas WHERE zpla_id=$id_plantilla")->row();
    $tipo=$consulta->ztipo_eval_id;
    if ($tipo==1) {
     redirect('Analitica/reporte/'.$id_plantilla.'/'.$fecha_ini.'/'.$fecha_fin);      
    }
    if($tipo==2)
    {
        redirect('Reporte_sabio/xls_informe/'.$id_plantilla.'/'.$fecha_ini.'/'.$fecha_fin);
    }

    if($tipo==3)
    {
        $opcion_tipo_tres = $this->input->post('opcion_tipo_tres');
        // redirect('Reporte_actitudes/xls_informe/'.$id_plantilla.'/'.$fecha_ini.'/'.$fecha_fin.'/'.$opcion_tipo_tres);
        redirect('Reporte_actitudes/xls_opciones/'.$id_plantilla.'/'.$fecha_ini.'/'.$fecha_fin.'/'.$opcion_tipo_tres);
    }

    if($tipo==5)
    {
        redirect('Reporte_ic/xls_informe/'.$id_plantilla.'/'.$fecha_ini.'/'.$fecha_fin);
    }

   // var_dump($id_plantilla,$fecha_ini,$fecha_fin); exit();
     
     //idplantilla/fechadesde/fecha hasta
    

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
            'field' => 'contenido',
            'label' => 'contenido',
            'rules' => 'required'
        )
    );
    return $config;
}


function set_mensajes_error() {
    $mensajes = array(
        array(
            'regla' => 'required',
            'mensaje' => 'Debe introducir el campo %s'
        )
    );
    return $mensajes;
}

public function caja_tipo()
{
    $data['msj_prueba'] = 'hola';
    $response=$this->load->view('seguimiento/opcion_seleccion_tipo_tres',$data,TRUE);
    echo $response;    
}






}


?>