<?php
require_once('Controladoradmin.php');

class Reporte_ic extends Controladoradmin
{
    function __construct()
    {
      parent::__construct();
      force_ssl();
      $this->load->helper(array('url','form','html'));
      $this->load->library(array('form_validation','tool_general'));

         //****** definiendo nombre de carpeta por defecto
      $this->carpeta='pdf_sabio/';
      $this->controlador='Reporte_ic/';

      $this->tabla='zis_plantillas';
      $this->prefijo='gru_';
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
    //   if($_SESSION[$this->presession.'permisos']>='2') {
    //     redirect('inicio');
    // }
}   

function pdf_redirect($pos_id,$gru_id,$eva_id)
{   
    $datos_query=$this->db->query("SELECT * FROM zis_evaluacion
WHERE eva_id=$eva_id")->row();
    $pla_id=$datos_query->zpla_id;
    redirect('Reporte_ic/pdf/'.$pos_id.'/'.$gru_id.'/'.$eva_id.'/'.$pla_id);
}

function pdf_redirect_dos($pos_id,$gru_id,$eva_id)
{   
    $datos_query=$this->db->query("SELECT * FROM zis_evaluacion
WHERE eva_id=$eva_id")->row();
    $pla_id=$datos_query->zpla_id;
    redirect('Reporte_ic/lista_preguntas/'.$pos_id.'/'.$gru_id.'/'.$eva_id.'/'.$pla_id);
    // redirect('Seguimiento/respuestas_participantes/'.$gru_id);
}
function vista_redirect($pos_id,$gru_id,$eva_id)
{   
    $datos_query=$this->db->query("SELECT * FROM zis_evaluacion
WHERE eva_id=$eva_id")->row();
    $pla_id=$datos_query->zpla_id;
    redirect('Reporte_ic/pdf_html/'.$pos_id.'/'.$gru_id.'/'.$eva_id.'/'.$pla_id);
}

    // $pos_id=null,$id_grupo,$id_eval
// function pdf($pos_id=null,$id_grupo,$id_eval)
function pdf($pos_id,$gru_id,$eva_id,$pla_id)
{
   if (!isset($_SESSION[$this->presession.'usuario']))
   {
      redirect(base_url().index_page());         
  }else{

    

    $datos_query=$this->db->query("SELECT p.*,YEAR(f.pof_fecha_nacimiento) as fecha_nac,CASE WHEN f.pof_sexo =1 THEN 'M' ELSE 'F' END as sexo FROM postulante p
        JOIN
        postulante_f f
        on p.pos_id=f.pos_id
        WHERE p.pos_id='$pos_id'")->row();
   
   $data_tiempo=$this->db->query("SELECT * FROM 
zis_seguimiento
WHERE pos_id=$pos_id and eva_id=$eva_id and gru_id=$gru_id and pla_id=$pla_id")->result_array();

   $data_graf=$this->db->query("SELECT * FROM 
zis_respuestas_cinco_puntaje
WHERE pos_id=$pos_id and eva_id=$eva_id and gru_id=$gru_id and zpla_id=$pla_id")->result_array();
   $data_graf=$data_graf[0];

   $data_cant_preg_resp=$this->db->query("SELECT SUM(resp_a) as suma_a,SUM(resp_b) as suma_b,SUM(resp_c) as suma_c FROM
zis_respuestas_cinco
WHERE pos_id=$pos_id and eva_id=$eva_id and gru_id=$gru_id and zpla_id=$pla_id")->result_array();

   $suma_cant_preg_resp=$data_cant_preg_resp[0]['suma_a']+$data_cant_preg_resp[0]['suma_b']+$data_cant_preg_resp[0]['suma_c'];
   // var_dump($suma_cant_preg_resp);exit();//
   
   

   $cantidad_errores=$data_graf['er_a']+$data_graf['er_b']+$data_graf['er_c'];
   // var_dump($cantidad_errores);exit();
    $data['valores_grafico']=$data_graf;
    $data['cantidad_errores']=$cantidad_errores;
    $data['postulante_datos']=$datos_query;
    $data['pe']=$data_graf['pe'];
    $data['tiempo']=$data_tiempo[0]['seg_tiempo_total'];
    $data['suma_resp']=$suma_cant_preg_resp;

    date_default_timezone_set('America/La_Paz');
    $data['fecha_reporte']=date('d').'/'.date('m').'/'.date('Y'); 
    $anio_actual=date('Y'); 
    $edad=$anio_actual-$datos_query->fecha_nac;
    $data['edad']=$edad;
    $data['logo']=$this->tool_entidad->sitiopri().'files/pdf/logo_etika.png';
    //de js a imagen
    // $data_grafico=$data_graf['pe'];
    // $fecha_actual_reporte = new DateTime();
    // $nombre_archivo = $fecha_actual_reporte->format("dmYhis");
    // $id_usuario_reporte=$_SESSION[$this->presession.'id'];
    // $nombre_archivo=$id_usuario_reporte.$nombre_archivo.'.png';
    // var_dump($nombre_archivo);exit();
    // $url_archivo='https://quickchart.io/chart?h=100&c={type:%20%27horizontalBar%27,data:%20{datasets:%20[{label:%20%27%27,backgroundColor:%20%27rgba(236,%20103,%2059,%201)%27,data:%20['.$data_grafico.',0,10]}]},%20%20options:%20{elements:%20{%20%20rectangle:%20{%27borderWidth%27:%200%20%20}},responsive:%20true,legend:%20{%20%20display:%20false,},title:%20{%20%20display:%20false,%20%20text:%20%27hola%27}%20%20}}';
    // $imagen_generada = $this->file_get_contents_curl($url_archivo); 
    // $imagen_generada = $this->file_get_contents_curl('https://media.geeksforgeeks.org/wp-content/uploads/geeksforgeeks-6-1.png'); 
    // $ruta_archivo = './archivos/reporte_imagenes/'.$nombre_archivo;
    // // var_dump($ruta_archivo);exit();
    // $ruta_archivo_grafico = 'archivos/reporte_imagenes/'.$nombre_archivo;
  
    // file_put_contents( $ruta_archivo, $imagen_generada );

    // $data['ruta_grafico']=$ruta_archivo_grafico;

    $nombre_archivo_pdf=$datos_query->pos_documento.'.pdf';
    $this->load->view('reporte_ic/pdf_js',$data);
    $html = $this->output->get_output();
    $this->load->library('pdf');
    $this->dompdf->loadHtml($html,'UTF-8');
    $this->dompdf->set_option('isRemoteEnabled', TRUE);   
    $this->dompdf->setPaper('letter', 'landscape');

    $this->dompdf->render();
    // echo memory_get_usage() . "\n";exit();
    $this->dompdf->stream($nombre_archivo_pdf, array("Attachment"=>0));
    
}

}
function file_get_contents_curl($url) {
    $ch = curl_init();
  
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
  
    $data = curl_exec($ch);
    curl_close($ch);
  
    return $data;
}
//solo vista
function pdf_html($pos_id,$gru_id,$eva_id,$pla_id)
{
   if (!isset($_SESSION[$this->presession.'usuario']))
   {
      redirect(base_url().index_page());         
  }else{

    

    $datos_query=$this->db->query("SELECT p.*,YEAR(f.pof_fecha_nacimiento) as fecha_nac,CASE WHEN f.pof_sexo =1 THEN 'M' ELSE 'F' END as sexo FROM postulante p
        JOIN
        postulante_f f
        on p.pos_id=f.pos_id
        WHERE p.pos_id='$pos_id'")->row();
   
   $data_tiempo=$this->db->query("SELECT * FROM 
zis_seguimiento
WHERE pos_id=$pos_id and eva_id=$eva_id and gru_id=$gru_id and pla_id=$pla_id")->result_array();

   $data_graf=$this->db->query("SELECT * FROM 
zis_respuestas_cinco_puntaje
WHERE pos_id=$pos_id and eva_id=$eva_id and gru_id=$gru_id and zpla_id=$pla_id")->result_array();
   $data_graf=$data_graf[0];

   $data_cant_preg_resp=$this->db->query("SELECT SUM(resp_a) as suma_a,SUM(resp_b) as suma_b,SUM(resp_c) as suma_c FROM
zis_respuestas_cinco
WHERE pos_id=$pos_id and eva_id=$eva_id and gru_id=$gru_id and zpla_id=$pla_id")->result_array();

   $suma_cant_preg_resp=$data_cant_preg_resp[0]['suma_a']+$data_cant_preg_resp[0]['suma_b']+$data_cant_preg_resp[0]['suma_c'];
   // var_dump($suma_cant_preg_resp);exit();//
   
   

   $cantidad_errores=$data_graf['er_a']+$data_graf['er_b']+$data_graf['er_c'];
   // var_dump($cantidad_errores);exit();
    $data['valores_grafico']=$data_graf;
    $data['cantidad_errores']=$cantidad_errores;
    $data['postulante_datos']=$datos_query;
    $data['pe']=$data_graf['pe'];
    $data['tiempo']=$data_tiempo[0]['seg_tiempo_total'];
    $data['suma_resp']=$suma_cant_preg_resp;

    date_default_timezone_set('America/La_Paz');
    $data['fecha_reporte']=date('d').'/'.date('m').'/'.date('Y'); 
    $anio_actual=date('Y'); 
    $edad=$anio_actual-$datos_query->fecha_nac;
    $data['edad']=$edad;
    $data['logo']=$this->tool_entidad->sitiopri().'files/pdf/logo_etika.png';


    $this->load->view('reporte_ic/pdf_html_vista',$data);
    // $html = $this->output->get_output();
    // $this->load->library('pdf');
    // $this->dompdf->loadHtml($html,'UTF-8');
    // $this->dompdf->set_option('isRemoteEnabled', TRUE);   
    // $this->dompdf->setPaper('letter', 'landscape');
    // $this->dompdf->render();
    // $this->dompdf->stream("listado_.pdf", array("Attachment"=>0));
}

}


function lista_preguntas($pos_id=null,$id_grupo=null,$id_eval=null)
{
    $this->cabecera['accion']='Listado';     
    $datos_evaluacion = $this->db->query("SELECT * FROM zis_evaluacion
WHERE eva_id=$id_eval")->row();  
    $pla_id=$datos_evaluacion->zpla_id;
    $consulta = $this->db->query("SELECT * FROM zis_respuestas_cinco_puntaje 
where pos_id=$pos_id and gru_id=$id_grupo and eva_id=$id_eval and zpla_id=$pla_id");
    $datos=$consulta->result();

    //datos postulante
    $data_p = $this->db->query("SELECT * FROM postulante p WHERE p.pos_id='$pos_id'")->row();
    $data_eval = $this->db->query("SELECT p.zpla_titulo,e.eva_titulo FROM
zis_plantillas p
JOIN
zis_evaluacion e
on p.zpla_id=e.zpla_id
WHERE e.eva_id=$id_eval")->row();
    

    $contenido['cabecera']=$this->cabecera;
    $contenido['datos'] = $datos;    
    $contenido['data_p'] = $data_p;   
    $contenido['data_eval'] = $data_eval; 
    $contenido['nombre_eval'] =$datos_evaluacion->eva_titulo;
    $contenido['nro_participantes'] = count($datos);
    $contenido['id_grupo'] = $id_grupo;
    $data['contenido'] = $this->load->view('reporte_ic/lista_respuestas', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}



//old


function xls_comparativo($id_grupo=null,$id_eval=null)
{
    $this->cabecera['accion']='Listado';     
    
    $datos = $this->db->query("SELECT pos.pos_id as id_pos,p.* FROM
postulante p
JOIN
(SELECT s.pos_id FROM zis_seguimiento s
JOIN
zis_evaluacion e
on e.eva_id=s.eva_id
WHERE s.gru_id=$id_grupo and s.eva_id=$id_eval and s.seg_termino=1 and s.seg_porcentaje=100) pos
on p.pos_id=pos.pos_id
ORDER BY id_pos DESC
")->result_array();
    $data_r=$this->respuestas_por_grupo($id_grupo,$id_eval);
    $datos_evaluacion = $this->db->query("SELECT * FROM zis_evaluacion
WHERE eva_id=$id_eval")->row();  
    $pla_id=$datos_evaluacion->zpla_id;
    $data_eva_grupo = $this->db->query("SELECT g.gru_nombre,e.eva_titulo FROM
zis_grupo_evaluacion g
JOIN
zis_evaluacion e
on g.gru_id=e.gru_id
WHERE e.gru_id=$id_grupo and e.eva_id=$id_eval")->row();  
    $contenido['cabecera']=$this->cabecera;
    $contenido['datos'] = $datos;    
    $contenido['nro_participantes'] = count($datos);
    $contenido['datos_posi'] = $data_r['positivas'];
    $contenido['datos_nega'] = $data_r['negativas'];  
    $contenido['id_grupo'] = $id_grupo;
    $contenido['nom_grupo'] = $data_eva_grupo->gru_nombre;
    $contenido['nom_eva'] = $data_eva_grupo->eva_titulo;
    $data['contenido'] = $this->load->view('reporte_sabio/xls_comparativo', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}

function xls_informe($pla_id=null,$fecha_ini=null,$fecha_fin=null)
{
    $this->cabecera['accion']='Listado';     
    
    $datos = $this->db->query("SELECT y.*,w.com_nombre as profesion
FROM
(SELECT e.pos_id,c.com_nombre FROM
educacion_superior e 
JOIN combos c 
ON e.edu_area=c.com_id 
WHERE e.edu_profesion_ejercida=1) w

JOIN

(SELECT f.pos_id as id ,YEAR(NOW())-YEAR(f.pof_fecha_nacimiento) as edad,
CASE
    WHEN f.pof_sexo =1 THEN 'M'
    ELSE 'F'
END as sexo,f.pof_lugar_estudios,c.*
 FROM postulante_f f
JOIN
(SELECT p.pos_nombre,pos_amaterno,pos_apaterno,a.* FROM
postulante p
JOIN
(SELECT t.*,s.seg_tiempo_total FROM
zis_respuestas_cinco_puntaje t
JOIN
zis_seguimiento s
on t.pos_id=s.pos_id
WHERE t.zpla_id=s.pla_id and t.zpla_id=$pla_id and DATE(seg_fecha_inicio) BETWEEN '$fecha_ini' and '$fecha_fin') a
on p.pos_id=a.pos_id) c
on c.pos_id=f.pos_id) y
on w.pos_id=y.id ORDER BY y.id")->result_array();


    //para las respuestas
    $data_plantilla=$this->db->query("SELECT p.zpla_titulo,t.tipo_desc FROM zis_plantillas p
JOIN
ztipo_evaluacion t
on p.ztipo_eval_id=t.tipo_eval_id
WHERE p.zpla_id=$pla_id")->row();
    

    $data_factores=$this->db->query("SELECT * FROM
zis_factor")->result_array();

    
    
    

    $contenido['cabecera']=$this->cabecera;
    $contenido['datos'] = $datos; 
    
       
    $contenido['nro_participantes'] = count($datos);
    $contenido['data_plantilla'] = $data_plantilla;   
    $contenido['fecha_ini'] = $fecha_ini;   
    $contenido['fecha_fin'] = $fecha_fin;   
    
    $data['contenido'] = $this->load->view('reporte_ic/reporte_xls', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}

function xls_informe_pe($pla_id=null,$fecha_ini=null,$fecha_fin=null)
{
    $this->cabecera['accion']='Listado';     
    
    $datos = $this->db->query("SELECT y.*,w.com_nombre as profesion
FROM
(SELECT e.pos_id,c.com_nombre FROM
educacion_superior e 
JOIN combos c 
ON e.edu_area=c.com_id 
WHERE e.edu_profesion_ejercida=1) w
JOIN
(SELECT f.pos_id as id ,YEAR(NOW())-YEAR(f.pof_fecha_nacimiento) as edad,
CASE
    WHEN f.pof_sexo =2 THEN 'M'
    ELSE 'F'
END as sexo,f.pof_lugar_estudios,c.*
 FROM postulante_f f
JOIN
(SELECT p.pos_nombre,pos_amaterno,pos_apaterno,a.* FROM
postulante p
JOIN
(SELECT g.*,h.sociabilidad,h.emocional,h.apertura,h.amabilidad,h.responsabilidad
FROM
(SELECT t.* FROM
zis_respuestas_tres_total_gral t
JOIN
zis_seguimiento s
on t.pos_id=s.pos_id
WHERE t.zpla_id=s.pla_id and t.zpla_id=$pla_id) g
JOIN
(SELECT * FROM zis_resp_tres_calculo_sec WHERE zpla_id=$pla_id) h
on g.pos_id=h.pos_id) a
on p.pos_id=a.pos_id) c
on c.pos_id=f.pos_id) y
on w.pos_id=y.id
ORDER BY y.id")->result_array();


    //para las respuestas
    $data_plantilla=$this->db->query("SELECT p.zpla_titulo,t.tipo_desc FROM zis_plantillas p
JOIN
ztipo_evaluacion t
on p.ztipo_eval_id=t.tipo_eval_id
WHERE p.zpla_id=$pla_id")->row();
    

    $data_factores=$this->db->query("SELECT * FROM
zis_factor")->result_array();

    
    
    

    $contenido['cabecera']=$this->cabecera;
    $contenido['datos'] = $datos; 
    $contenido['data_factores'] = $data_factores;
       
    $contenido['nro_participantes'] = count($datos);
    $contenido['data_plantilla'] = $data_plantilla;   
    $contenido['fecha_ini'] = $fecha_ini;   
    $contenido['fecha_fin'] = $fecha_fin;   
    
    $data['contenido'] = $this->load->view('reporte_actitudes/xls_informe_plantilla_pe', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}








function exportar_reporte()
    {
        $nombre = "evaluacion";
        $headerTable[] = 'N°';
        $headerTable[] = 'Tiempo';
        $headerTable[] = 'N° Intentos';
        $headerTable[] = 'Nombres';
        $headerTable[] = 'Apellidos';
        $fecha = date("Ymd");
        // header('Content-type: application/vnd.ms-excel');
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=" . $fecha . "_" . $nombre . ".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo "<table border=1><tr>";
        foreach ($headerTable as $cabecera) {
            echo "<th>" . $cabecera . "</th> ";
        }
         echo "</tr> ";
        
            echo "<tr><td>2</td> ";
            echo "<td>1</td> ";
            echo "<td>2</td> ";
            echo "<td>joshe</td> ";
            echo "<td>HUARA</td></tr>";
            echo "</table> ";
    }



}


?>