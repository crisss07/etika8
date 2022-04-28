<?php
require_once('Controladoradmin.php');

class Reporte_sabio extends Controladoradmin
{
    function __construct()
    {
      parent::__construct();
      force_ssl();
      $this->load->helper(array('url','form','html'));
      $this->load->library(array('form_validation','tool_general'));
      $this->load->library('aws3');

         //****** definiendo nombre de carpeta por defecto
      $this->carpeta='pdf_sabio/';
      $this->controlador='Reporte_sabio/';

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
    //   if($_SESSION[$this->presession.'permisos']>='1') {
    //     redirect('inicio');
    // }
}   

function pdf_hello_world()
{
   if (!isset($_SESSION[$this->presession.'usuario']))
   {
      redirect(base_url().index_page());         
  }else{

     //opcion 1
    // $url = 'http://quickchart.io/chart?bkg=white&c={type:%27bar%27,data:{labels:[2012,2013,2014,2015,2016],datasets:[{label:%27Users%27,data:[120,60,50,180,120]}]}}'; 
    // // $url = 'https://media.geeksforgeeks.org/wp-content/uploads/geeksforgeeks-6-1.png'; 
    // $img = './archivos/logo.png'; 
  
    // // Function to write image into file
    // $var=file_put_contents($img, file_get_contents($url));

    //opcion 2
    // $data = $this->file_get_contents_curl('https://media.geeksforgeeks.org/wp-content/uploads/geeksforgeeks-6-1.png');  
    $data = $this->file_get_contents_curl('https://quickchart.io/chart?bkg=white&c={type:%27bar%27,data:{labels:[2012,2013,2014,2015,2016],datasets:[{label:%27Users%27,data:[120,60,50,180,120]}]}}'); 
    $fp = './archivos/logo.png';
  
    file_put_contents( $fp, $data );

    // echo $var;
    $this->load->view('reporte_sabio/pdf_test');
    $html = $this->output->get_output();
    $this->load->library('pdf');
    $this->dompdf->loadHtml($html);


    
    $this->dompdf->set_option('isHtml5ParserEnabled', TRUE);  
    $this->dompdf->set_option('isRemoteEnabled', TRUE);  
     $this->dompdf->set_option('setIsRemoteEnabled', TRUE);  
    
    $this->dompdf->setPaper('A4', 'portrait');
    $this->dompdf->render();
    $this->dompdf->stream('hola.pdf', array("Attachment"=>0));
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



function informe()
{
    if (!isset($_SESSION[$this->presession.'usuario']))
    {
      redirect(base_url().index_page());         
  }
  $contenido['informe']=3;        

        // $this->load->view('reporte_sabio/informe', $contenido, true);
  $this->load->view('reporte_sabio/informe');

}
function pdf_estatico()
{
   if (!isset($_SESSION[$this->presession.'usuario']))
   {
      redirect(base_url().index_page());         
    }else{
    $this->load->view('reporte_sabio/pdf_test');
    $html = $this->output->get_output();
    $this->load->library('pdf');
    $this->dompdf->loadHtml($html);
    $this->dompdf->set_option('isRemoteEnabled', TRUE);  
    $this->dompdf->setPaper('A4', 'portrait');
    $this->dompdf->render();
    $this->dompdf->stream('hola.pdf', array("Attachment"=>0));
    }    
}

function pdf_s3()
{
   if (!isset($_SESSION[$this->presession.'usuario']))
   {
      redirect(base_url().index_page());         
    }else{
        $this->load->view('reporte_sabio/pdf_test');
        $html = $this->output->get_output();
        $this->load->library('pdf');
        $this->dompdf->loadHtml($html);
        $this->dompdf->set_option('isRemoteEnabled', TRUE);  
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();    
        $output = $this->dompdf->output();
        file_put_contents('./archivos/Brochure.pdf', $output);

        $folder_name_fijos='archivos/prueba_subida/Brochure.pdf';
        $aws_bucket=$this->tool_entidad->aws_bucket();
        $this->aws3->sendFile_s3($aws_bucket,'./archivos/Brochure.pdf' ,$folder_name_fijos);
    }    
}
    // $pos_id=null,$id_grupo,$id_eval
function pdf($pos_id=null,$id_grupo,$id_eval)
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
    $datos_respuestas=$this->db->query("SELECT res_nro_resp,res_resp FROM zis_respuestas_dos
WHERE gru_id='$id_grupo' and eva_id='$id_eval' and pos_id='$pos_id' ORDER BY res_nro_resp ASC")->result_array();


    $longitud=count($datos_respuestas);
    $resp=[];

    for ($i=0; $i <$longitud ; $i++) { 
        array_push($resp,$datos_respuestas[$i]['res_resp']);
    }
    // var_dump($array_respuestas);exit();
    //empezamos con las positivas
    // g7d4(3,7)d8(11,15)d13(20,24)d17(28,32)d18(33,37)
    $g7=$resp[2]+$resp[6]+$resp[10]+$resp[14]+$resp[19]+$resp[23]+$resp[27]+$resp[31]+$resp[32]+$resp[36];
    // k7d2(1,5)d6(9,13)d11(18,22)d16(27,31)d19(34,38)
    $k7=$resp[0]+$resp[4]+$resp[8]+$resp[12]+$resp[17]+$resp[21]+$resp[26]+$resp[30]+$resp[33]+$resp[37];
    // i7d5(4,8)d9(12,16)d10(17,21)d15(26,30)d20(35,39)
    $i7=$resp[3]+$resp[7]+$resp[11]+$resp[15]+$resp[16]+$resp[20]+$resp[25]+$resp[29]+$resp[34]+$resp[38];
    // m7d3(2,6)d7(10,14)d12(19,23)d14(25,29)d21(36,40)
    $m7=$resp[1]+$resp[5]+$resp[9]+$resp[13]+$resp[18]+$resp[22]+$resp[24]+$resp[28]+$resp[35]+$resp[39];  

    $array_positivas=[$g7,$k7,$i7,$m7];
    // data: [25,22,25,28],
    //respuestas negativas
    // g19d22(41,45)d29(52,56)d32(59,63)d37(68,72)d39(74,78)
    $g19=$resp[40]+$resp[44]+$resp[51]+$resp[55]+$resp[58]+$resp[62]+$resp[67]+$resp[71]+$resp[73]+$resp[77];
    // k19d23(42,46)d28(51,55)d33(60,64)d35(66,70)d40(75,79)
    $k19=$resp[41]+$resp[45]+$resp[50]+$resp[54]+$resp[59]+$resp[63]+$resp[65]+$resp[69]+$resp[74]+$resp[78];
    // i19d24(43,47)d27(50,54)d31(58,62)d34(65,69)d41(76,80)
    $i19=$resp[42]+$resp[46]+$resp[49]+$resp[53]+$resp[57]+$resp[61]+$resp[64]+$resp[68]+$resp[75]+$resp[79];
    // m19d25(44,48)d26(49,53)d30(57,61)d36(67,71)d38(73,77)
    $m19=$resp[43]+$resp[47]+$resp[48]+$resp[52]+$resp[56]+$resp[60]+$resp[66]+$resp[70]+$resp[72]+$resp[76];


    $array_negativas=[$g19,$k19,$i19,$m19];
    // data: [27,22,23,28],   
    


    $data['posi']=$array_positivas[0].','.$array_positivas[1].','.$array_positivas[2].','.$array_positivas[3];
    $data_positiva=$array_positivas[0].','.$array_positivas[1].','.$array_positivas[2].','.$array_positivas[3];
    // var_dump($data['posi']);exit();
    $data['nega']=$array_negativas[0].','.$array_negativas[1].','.$array_negativas[2].','.$array_negativas[3];
    $data_negativas=$array_negativas[0].','.$array_negativas[1].','.$array_negativas[2].','.$array_negativas[3];
    //array de la tabla
    $data['ps']=$array_positivas;
    $data['ng']=$array_negativas;

    $data['postulante_datos']=$datos_query;

    date_default_timezone_set('America/La_Paz');
    $data['fecha_reporte']=date('d').'/'.date('m').'/'.date('Y'); 
    $anio_actual=date('Y'); 
    $edad=$anio_actual-$datos_query->fecha_nac;
    $data['edad']=$edad;
    $data['logo']=$this->tool_entidad->sitiopri().'files/pdf/logo_etika.png';

    //de js a imagen
    //comentario
    $fecha_actual_reporte = new DateTime();
    $nombre_archivo = $fecha_actual_reporte->format("dmYhis");
    $id_usuario_reporte=$_SESSION[$this->presession.'id'];
    $nombre_archivo=$id_usuario_reporte.$nombre_archivo.'.png';
    // var_dump($nombre_archivo);exit();
    // $url_archivo='https://quickchart.io/chart?c={type:%20%27radar%27,data:%20{labels:%20[%27RESULTADOS%27,%27CREATIVIDAD%27,%27PERSONAS%27,%27METODOS%27],datasets:%20[{label:%20%27%20Positivas%27,%20data:%20['.$data_positiva.'],fill:%20false,borderColor:%20%27rgb(54,%20162,%20235)%27%20%20%20%20%20%20%20%20},%20{label:%20%27Bajo%20presi%C3%B3n%27,data:%20['.$data_negativas.'],%20%20%20fill:%20false,%20%20%20%20borderColor:%20%27rgb(255,%2099,%20132)%27%20%20%20%20}]},options:%20{title:%20{display:%20true,text:%20%27Situaciones%27,},legend:%20{display:%20true,%20%20%20%20%20%20%20%20%20%20%20},scale:%20{ticks:%20{beginAtZero:%20true,max:%2030}},elements:%20{line:%20{borderWidth:%203}}},}';
    // $imagen_generada = $this->file_get_contents_curl($url_archivo); 
    // // $imagen_generada = $this->file_get_contents_curl('https://media.geeksforgeeks.org/wp-content/uploads/geeksforgeeks-6-1.png'); 
    $ruta_archivo = './archivos/reporte_imagenes/'.$nombre_archivo;
    // var_dump($ruta_archivo);exit();
    $ruta_archivo_grafico = 'archivos/reporte_imagenes/'.$nombre_archivo;
  
    // file_put_contents( $ruta_archivo, $imagen_generada );

    // $data['ruta_grafico']=$ruta_archivo_grafico;


    $nombre_archivo_pdf=$datos_query->pos_documento.'.pdf';
    $this->load->view('reporte_sabio/pdf_js',$data);
    $html = $this->output->get_output();
    $this->load->library('pdf');
    $this->dompdf->loadHtml($html,'UTF-8');
    $this->dompdf->set_option('isRemoteEnabled', TRUE);   
    $this->dompdf->setPaper('letter', 'portrait');
    $this->dompdf->render();
    $this->dompdf->stream($nombre_archivo_pdf, array("Attachment"=>0));
}

}

function pdf_old_conssl($pos_id=null,$id_grupo,$id_eval)
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
    $datos_respuestas=$this->db->query("SELECT res_nro_resp,res_resp FROM zis_respuestas_dos
WHERE gru_id='$id_grupo' and eva_id='$id_eval' and pos_id='$pos_id' ORDER BY res_nro_resp ASC")->result_array();


    $longitud=count($datos_respuestas);
    $resp=[];

    for ($i=0; $i <$longitud ; $i++) { 
        array_push($resp,$datos_respuestas[$i]['res_resp']);
    }
    // var_dump($array_respuestas);exit();
    //empezamos con las positivas
    // g7d4(3,7)d8(11,15)d13(20,24)d17(28,32)d18(33,37)
    $g7=$resp[2]+$resp[6]+$resp[10]+$resp[14]+$resp[19]+$resp[23]+$resp[27]+$resp[31]+$resp[32]+$resp[36];
    // k7d2(1,5)d6(9,13)d11(18,22)d16(27,31)d19(34,38)
    $k7=$resp[0]+$resp[4]+$resp[8]+$resp[12]+$resp[17]+$resp[21]+$resp[26]+$resp[30]+$resp[33]+$resp[37];
    // i7d5(4,8)d9(12,16)d10(17,21)d15(26,30)d20(35,39)
    $i7=$resp[3]+$resp[7]+$resp[11]+$resp[15]+$resp[16]+$resp[20]+$resp[25]+$resp[29]+$resp[34]+$resp[38];
    // m7d3(2,6)d7(10,14)d12(19,23)d14(25,29)d21(36,40)
    $m7=$resp[1]+$resp[5]+$resp[9]+$resp[13]+$resp[18]+$resp[22]+$resp[24]+$resp[28]+$resp[35]+$resp[39];  

    $array_positivas=[$g7,$k7,$i7,$m7];
    // data: [25,22,25,28],
    //respuestas negativas
    // g19d22(41,45)d29(52,56)d32(59,63)d37(68,72)d39(74,78)
    $g19=$resp[40]+$resp[44]+$resp[51]+$resp[55]+$resp[58]+$resp[62]+$resp[67]+$resp[71]+$resp[73]+$resp[77];
    // k19d23(42,46)d28(51,55)d33(60,64)d35(66,70)d40(75,79)
    $k19=$resp[41]+$resp[45]+$resp[50]+$resp[54]+$resp[59]+$resp[63]+$resp[65]+$resp[69]+$resp[74]+$resp[78];
    // i19d24(43,47)d27(50,54)d31(58,62)d34(65,69)d41(76,80)
    $i19=$resp[42]+$resp[46]+$resp[49]+$resp[53]+$resp[57]+$resp[61]+$resp[64]+$resp[68]+$resp[75]+$resp[79];
    // m19d25(44,48)d26(49,53)d30(57,61)d36(67,71)d38(73,77)
    $m19=$resp[43]+$resp[47]+$resp[48]+$resp[52]+$resp[56]+$resp[60]+$resp[66]+$resp[70]+$resp[72]+$resp[76];


    $array_negativas=[$g19,$k19,$i19,$m19];
    // data: [27,22,23,28],   
    


    $data['posi']=$array_positivas[0].','.$array_positivas[1].','.$array_positivas[2].','.$array_positivas[3];
    // var_dump($data['posi']);exit();
    $data['nega']=$array_negativas[0].','.$array_negativas[1].','.$array_negativas[2].','.$array_negativas[3];
    //array de la tabla
    $data['ps']=$array_positivas;
    $data['ng']=$array_negativas;

    $data['postulante_datos']=$datos_query;

    date_default_timezone_set('America/La_Paz');
    $data['fecha_reporte']=date('d').'/'.date('m').'/'.date('Y'); 
    $anio_actual=date('Y'); 
    $edad=$anio_actual-$datos_query->fecha_nac;
    $data['edad']=$edad;
    $data['logo']=$this->tool_entidad->sitiopri().'files/pdf/logo_etika.png';


    $this->load->view('reporte_sabio/pdf',$data);
    $html = $this->output->get_output();
    $this->load->library('pdf');
    $this->dompdf->loadHtml($html,'UTF-8');
    $this->dompdf->set_option('isRemoteEnabled', TRUE);   
    $this->dompdf->setPaper('letter', 'portrait');
    $this->dompdf->render();
    $this->dompdf->stream("listado_.pdf", array("Attachment"=>0));
}

}

function pdf_html($pos_id=null,$id_grupo,$id_eval)
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
    $datos_respuestas=$this->db->query("SELECT res_nro_resp,res_resp FROM zis_respuestas_dos
WHERE gru_id='$id_grupo' and eva_id='$id_eval' and pos_id='$pos_id' ORDER BY res_nro_resp ASC")->result_array();


    $longitud=count($datos_respuestas);
    $resp=[];

    for ($i=0; $i <$longitud ; $i++) { 
        array_push($resp,$datos_respuestas[$i]['res_resp']);
    }
    // var_dump($array_respuestas);exit();
    //empezamos con las positivas
    // g7d4(3,7)d8(11,15)d13(20,24)d17(28,32)d18(33,37)
    $g7=$resp[2]+$resp[6]+$resp[10]+$resp[14]+$resp[19]+$resp[23]+$resp[27]+$resp[31]+$resp[32]+$resp[36];
    // k7d2(1,5)d6(9,13)d11(18,22)d16(27,31)d19(34,38)
    $k7=$resp[0]+$resp[4]+$resp[8]+$resp[12]+$resp[17]+$resp[21]+$resp[26]+$resp[30]+$resp[33]+$resp[37];
    // i7d5(4,8)d9(12,16)d10(17,21)d15(26,30)d20(35,39)
    $i7=$resp[3]+$resp[7]+$resp[11]+$resp[15]+$resp[16]+$resp[20]+$resp[25]+$resp[29]+$resp[34]+$resp[38];
    // m7d3(2,6)d7(10,14)d12(19,23)d14(25,29)d21(36,40)
    $m7=$resp[1]+$resp[5]+$resp[9]+$resp[13]+$resp[18]+$resp[22]+$resp[24]+$resp[28]+$resp[35]+$resp[39];  

    $array_positivas=[$g7,$k7,$i7,$m7];
    // data: [25,22,25,28],
    //respuestas negativas
    // g19d22(41,45)d29(52,56)d32(59,63)d37(68,72)d39(74,78)
    $g19=$resp[40]+$resp[44]+$resp[51]+$resp[55]+$resp[58]+$resp[62]+$resp[67]+$resp[71]+$resp[73]+$resp[77];
    // k19d23(42,46)d28(51,55)d33(60,64)d35(66,70)d40(75,79)
    $k19=$resp[41]+$resp[45]+$resp[50]+$resp[54]+$resp[59]+$resp[63]+$resp[65]+$resp[69]+$resp[74]+$resp[78];
    // i19d24(43,47)d27(50,54)d31(58,62)d34(65,69)d41(76,80)
    $i19=$resp[42]+$resp[46]+$resp[49]+$resp[53]+$resp[57]+$resp[61]+$resp[64]+$resp[68]+$resp[75]+$resp[79];
    // m19d25(44,48)d26(49,53)d30(57,61)d36(67,71)d38(73,77)
    $m19=$resp[43]+$resp[47]+$resp[48]+$resp[52]+$resp[56]+$resp[60]+$resp[66]+$resp[70]+$resp[72]+$resp[76];


    $array_negativas=[$g19,$k19,$i19,$m19];
    // data: [27,22,23,28],   
    


    $data['posi']=$array_positivas[0].','.$array_positivas[1].','.$array_positivas[2].','.$array_positivas[3];
    // var_dump($data['posi']);exit();
    $data['nega']=$array_negativas[0].','.$array_negativas[1].','.$array_negativas[2].','.$array_negativas[3];
    //array de la tabla
    $data['ps']=$array_positivas;
    $data['ng']=$array_negativas;

    $data['postulante_datos']=$datos_query;

    date_default_timezone_set('America/La_Paz');
    $data['fecha_reporte']=date('d').'/'.date('m').'/'.date('Y'); 
    $anio_actual=date('Y'); 
    $edad=$anio_actual-$datos_query->fecha_nac;
    $data['edad']=$edad;
    $data['logo']=$this->tool_entidad->sitiopri().'files/pdf/logo_etika.png';


    $this->load->view('reporte_sabio/pdf_html',$data);
    // $html = $this->output->get_output();
    // $this->load->library('pdf');
    // $this->dompdf->loadHtml($html,'UTF-8');
    // $this->dompdf->set_option('isRemoteEnabled', TRUE);   
    // $this->dompdf->setPaper('letter', 'portrait');
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
    $consulta = $this->db->query("SELECT r.pos_id,r.res_nro_resp,p.pre_texto,r.res_resp FROM 
(SELECT * FROM zis_plantilla_e_dos
WHERE zpla_id=$pla_id ORDER BY pre_nro asc) p
JOIN
(SELECT * FROM zis_respuestas_dos 
where pos_id=$pos_id and gru_id=$id_grupo and eva_id=$id_eval ORDER BY res_nro_resp asc) r
on p.pre_nro=r.res_nro_resp");
    $datos=$consulta->result();

    //datos postulante
    $data_p = $this->db->query("SELECT CONCAT(p.pos_nombre,' ',p.pos_apaterno,' ',pos_amaterno)  as nombre FROM postulante p WHERE p.pos_id='$pos_id'")->row();
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
    $data['contenido'] = $this->load->view('reporte_sabio/lista_respuestas', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}

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
    
//     $datos = $this->db->query("SELECT YEAR(NOW())-YEAR(f.pof_fecha_nacimiento) as edad,
// CASE
//     WHEN f.pof_sexo =2 THEN 'M'
//     ELSE 'F'
// END as sexo
// ,dp.* FROM postulante_f f
// JOIN
// (SELECT pos.pos_id as id_pos,p.* FROM
// postulante p
// JOIN
// (SELECT s.*,r.zpla_id FROM zis_seguimiento s
// JOIN
// (SELECT e.eva_id,e.zpla_id FROM zis_evaluacion e
// JOIN
// zis_plantillas p
// on e.zpla_id=p.zpla_id
// WHERE p.zpla_id=$pla_id) r
// on s.eva_id=r.eva_id
// WHERE s.seg_termino=1 and s.seg_porcentaje=100 and DATE(s.seg_fecha_inicio) BETWEEN '$fecha_ini' and '$fecha_fin'
// ORDER BY s.pos_id DESC) pos
// on p.pos_id=pos.pos_id) dp
// on f.pos_id=dp.id_pos")->result_array();

    $consulta_data="SELECT YEAR(NOW())-YEAR(f.pof_fecha_nacimiento) as edad,
CASE
    WHEN f.pof_sexo =1 THEN 'M'
    ELSE 'F'
END as sexo,f.pof_lugar_estudios
,dp.* FROM postulante_f f
JOIN
(SELECT pos.pos_id as id_pos,pos.gru_id,pos.eva_id,p.* FROM
(SELECT u.*,w.com_nombre FROM
(SELECT g.* FROM
postulante g
JOIN
(SELECT DISTINCT pos_id FROM
zis_seguimiento WHERE seg_termino=1 and seg_porcentaje=100 and DATE(seg_fecha_inicio) BETWEEN '$fecha_ini' and '$fecha_fin') m
on
g.pos_id=m.pos_id) u
JOIN 
(SELECT e.pos_id,c.com_nombre FROM
educacion_superior e 
JOIN combos c 
ON e.edu_area=c.com_id 
WHERE e.edu_profesion_ejercida=1) w
on u.pos_id=w.pos_id) p
JOIN
(SELECT s.*,r.zpla_id FROM zis_seguimiento s
JOIN
(SELECT e.eva_id,e.zpla_id FROM zis_evaluacion e
JOIN
zis_plantillas pl
on e.zpla_id=pl.zpla_id
WHERE pl.zpla_id=$pla_id) r
on s.eva_id=r.eva_id
WHERE s.seg_termino=1 and s.seg_porcentaje=100 and DATE(s.seg_fecha_inicio) BETWEEN '$fecha_ini' and '$fecha_fin'
ORDER BY s.pos_id DESC) pos
on p.pos_id=pos.pos_id) dp
on f.pos_id=dp.id_pos";
// var_dump($consulta_data);exit();
    $datos = $this->db->query("SELECT YEAR(NOW())-YEAR(f.pof_fecha_nacimiento) as edad,
CASE
    WHEN f.pof_sexo =1 THEN 'M'
    ELSE 'F'
END as sexo,f.pof_lugar_estudios
,dp.* FROM postulante_f f
JOIN
(SELECT pos.pos_id as id_pos,pos.gru_id,pos.eva_id,p.* FROM
(SELECT u.*,w.com_nombre FROM
(SELECT g.* FROM
postulante g
JOIN
(SELECT DISTINCT pos_id FROM
zis_seguimiento WHERE seg_termino=1 and seg_porcentaje=100 and DATE(seg_fecha_inicio) BETWEEN '$fecha_ini' and '$fecha_fin') m
on
g.pos_id=m.pos_id) u
JOIN 
(SELECT e.pos_id,c.com_nombre FROM
educacion_superior e 
JOIN combos c 
ON e.edu_area=c.com_id 
WHERE e.edu_profesion_ejercida=1) w
on u.pos_id=w.pos_id) p
JOIN
(SELECT s.*,r.zpla_id FROM zis_seguimiento s
JOIN
(SELECT e.eva_id,e.zpla_id FROM zis_evaluacion e
JOIN
zis_plantillas pl
on e.zpla_id=pl.zpla_id
WHERE pl.zpla_id=$pla_id) r
on s.eva_id=r.eva_id
WHERE s.seg_termino=1 and s.seg_porcentaje=100 and DATE(s.seg_fecha_inicio) BETWEEN '$fecha_ini' and '$fecha_fin'
ORDER BY s.pos_id DESC) pos
on p.pos_id=pos.pos_id) dp
on f.pos_id=dp.id_pos")->result_array();

//     $datos_evaluacion = $this->db->query("SELECT * FROM zis_evaluacion
// WHERE eva_id=$id_eval")->row();  
//     $pla_id=$datos_evaluacion->zpla_id;
    //para las respuestas
    $data_plantilla=$this->db->query("SELECT p.zpla_titulo,t.tipo_desc FROM zis_plantillas p
JOIN
ztipo_evaluacion t
on p.ztipo_eval_id=t.tipo_eval_id
WHERE p.zpla_id=$pla_id")->row();
    $data_r=$this->respuestas_plantilla($pla_id,$fecha_ini,$fecha_fin);

    // var_dump($datos['positivas']);exit();

    
    
    

    $contenido['cabecera']=$this->cabecera;
    $contenido['datos'] = $datos; 
    $contenido['datos_posi'] = $data_r['positivas'];
    $contenido['datos_nega'] = $data_r['negativas'];   
    $contenido['nro_participantes'] = count($datos);
    $contenido['data_plantilla'] = $data_plantilla;   
    $contenido['fecha_ini'] = $fecha_ini;   
    $contenido['fecha_fin'] = $fecha_fin;   
    
    $data['contenido'] = $this->load->view('reporte_sabio/xls_informe_plantilla', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}

//para resolver las respuestas

function respuestas_plantilla($pla_id=null,$fecha_ini=null,$fecha_fin=null)
{
    $data_pers=$this->db->query("SELECT s.pos_id,s.gru_id,s.eva_id FROM zis_seguimiento s
        JOIN
        (SELECT e.eva_id,e.zpla_id FROM zis_evaluacion e
        JOIN
        zis_plantillas p
        on e.zpla_id=p.zpla_id
        WHERE p.zpla_id=$pla_id) r
        on s.eva_id=r.eva_id
        WHERE s.seg_termino=1 and s.seg_porcentaje=100 and DATE(s.seg_fecha_inicio) BETWEEN '$fecha_ini' and '$fecha_fin'
        ORDER BY s.pos_id DESC")->result_array();
    $positivas_pos_id=[];
    $negativas_pos_id=[];
    //para recorrer los postulantes
    for ($j=0; $j <count($data_pers) ; $j++) { 
        $pos_id=$data_pers[$j]['pos_id'];
        $id_grupo=$data_pers[$j]['gru_id'];
        $id_eval=$data_pers[$j]['eva_id'];
        $datos_respuestas=$this->db->query("SELECT res_nro_resp,res_resp FROM zis_respuestas_dos
            WHERE gru_id='$id_grupo' and eva_id='$id_eval' and pos_id='$pos_id' ORDER BY res_nro_resp ASC")->result_array();


        $longitud=count($datos_respuestas);
        $resp=[];

        for ($i=0; $i <$longitud ; $i++) { 
            array_push($resp,$datos_respuestas[$i]['res_resp']);
        }
    // var_dump($array_respuestas);exit();
    //empezamos con las positivas
    // g7d4(3,7)d8(11,15)d13(20,24)d17(28,32)d18(33,37)
        $g7=$resp[2]+$resp[6]+$resp[10]+$resp[14]+$resp[19]+$resp[23]+$resp[27]+$resp[31]+$resp[32]+$resp[36];
    // k7d2(1,5)d6(9,13)d11(18,22)d16(27,31)d19(34,38)
        $k7=$resp[0]+$resp[4]+$resp[8]+$resp[12]+$resp[17]+$resp[21]+$resp[26]+$resp[30]+$resp[33]+$resp[37];
    // i7d5(4,8)d9(12,16)d10(17,21)d15(26,30)d20(35,39)
        $i7=$resp[3]+$resp[7]+$resp[11]+$resp[15]+$resp[16]+$resp[20]+$resp[25]+$resp[29]+$resp[34]+$resp[38];
    // m7d3(2,6)d7(10,14)d12(19,23)d14(25,29)d21(36,40)
        $m7=$resp[1]+$resp[5]+$resp[9]+$resp[13]+$resp[18]+$resp[22]+$resp[24]+$resp[28]+$resp[35]+$resp[39];  

        $array_positivas=[$pos_id,$g7,$k7,$i7,$m7];
        array_push($positivas_pos_id,$array_positivas);

        //respuestas negativas
    // g19d22(41,45)d29(52,56)d32(59,63)d37(68,72)d39(74,78)
        $g19=$resp[40]+$resp[44]+$resp[51]+$resp[55]+$resp[58]+$resp[62]+$resp[67]+$resp[71]+$resp[73]+$resp[77];
    // k19d23(42,46)d28(51,55)d33(60,64)d35(66,70)d40(75,79)
        $k19=$resp[41]+$resp[45]+$resp[50]+$resp[54]+$resp[59]+$resp[63]+$resp[65]+$resp[69]+$resp[74]+$resp[78];
    // i19d24(43,47)d27(50,54)d31(58,62)d34(65,69)d41(76,80)
        $i19=$resp[42]+$resp[46]+$resp[49]+$resp[53]+$resp[57]+$resp[61]+$resp[64]+$resp[68]+$resp[75]+$resp[79];
    // m19d25(44,48)d26(49,53)d30(57,61)d36(67,71)d38(73,77)
        $m19=$resp[43]+$resp[47]+$resp[48]+$resp[52]+$resp[56]+$resp[60]+$resp[66]+$resp[70]+$resp[72]+$resp[76];
        $array_negativas=[$pos_id,$g19,$k19,$i19,$m19];
        array_push($negativas_pos_id,$array_negativas);
    }
    $data['positivas']=$positivas_pos_id;
    $data['negativas']=$negativas_pos_id;
    return($data);
}


function respuestas_por_grupo($id_grupo=null,$id_eval=null)
{
    $data_pers=$this->db->query("SELECT pos.pos_id as id_pos,p.* FROM
postulante p
JOIN
(SELECT s.pos_id FROM zis_seguimiento s
JOIN
zis_evaluacion e
on e.eva_id=s.eva_id
WHERE s.gru_id=$id_grupo and s.eva_id=$id_eval and s.seg_termino=1 and s.seg_porcentaje=100) pos
on p.pos_id=pos.pos_id
ORDER BY id_pos DESC")->result_array();
    $positivas_pos_id=[];
    $negativas_pos_id=[];
    //para recorrer los postulantes
    for ($j=0; $j <count($data_pers) ; $j++) { 
        $pos_id=$data_pers[$j]['id_pos'];
        $datos_respuestas=$this->db->query("SELECT res_nro_resp,res_resp FROM zis_respuestas_dos
            WHERE gru_id='$id_grupo' and eva_id='$id_eval' and pos_id='$pos_id' ORDER BY res_nro_resp ASC")->result_array();


        $longitud=count($datos_respuestas);
        $resp=[];

        for ($i=0; $i <$longitud ; $i++) { 
            array_push($resp,$datos_respuestas[$i]['res_resp']);
        }
    // var_dump($array_respuestas);exit();
    //empezamos con las positivas
    // g7d4(3,7)d8(11,15)d13(20,24)d17(28,32)d18(33,37)
        $g7=$resp[2]+$resp[6]+$resp[10]+$resp[14]+$resp[19]+$resp[23]+$resp[27]+$resp[31]+$resp[32]+$resp[36];
    // k7d2(1,5)d6(9,13)d11(18,22)d16(27,31)d19(34,38)
        $k7=$resp[0]+$resp[4]+$resp[8]+$resp[12]+$resp[17]+$resp[21]+$resp[26]+$resp[30]+$resp[33]+$resp[37];
    // i7d5(4,8)d9(12,16)d10(17,21)d15(26,30)d20(35,39)
        $i7=$resp[3]+$resp[7]+$resp[11]+$resp[15]+$resp[16]+$resp[20]+$resp[25]+$resp[29]+$resp[34]+$resp[38];
    // m7d3(2,6)d7(10,14)d12(19,23)d14(25,29)d21(36,40)
        $m7=$resp[1]+$resp[5]+$resp[9]+$resp[13]+$resp[18]+$resp[22]+$resp[24]+$resp[28]+$resp[35]+$resp[39];  

        $array_positivas=[$pos_id,$g7,$k7,$i7,$m7];
        array_push($positivas_pos_id,$array_positivas);

        //respuestas negativas
    // g19d22(41,45)d29(52,56)d32(59,63)d37(68,72)d39(74,78)
        $g19=$resp[40]+$resp[44]+$resp[51]+$resp[55]+$resp[58]+$resp[62]+$resp[67]+$resp[71]+$resp[73]+$resp[77];
    // k19d23(42,46)d28(51,55)d33(60,64)d35(66,70)d40(75,79)
        $k19=$resp[41]+$resp[45]+$resp[50]+$resp[54]+$resp[59]+$resp[63]+$resp[65]+$resp[69]+$resp[74]+$resp[78];
    // i19d24(43,47)d27(50,54)d31(58,62)d34(65,69)d41(76,80)
        $i19=$resp[42]+$resp[46]+$resp[49]+$resp[53]+$resp[57]+$resp[61]+$resp[64]+$resp[68]+$resp[75]+$resp[79];
    // m19d25(44,48)d26(49,53)d30(57,61)d36(67,71)d38(73,77)
        $m19=$resp[43]+$resp[47]+$resp[48]+$resp[52]+$resp[56]+$resp[60]+$resp[66]+$resp[70]+$resp[72]+$resp[76];
        $array_negativas=[$pos_id,$g19,$k19,$i19,$m19];
        array_push($negativas_pos_id,$array_negativas);
    }
    $data['positivas']=$positivas_pos_id;
    $data['negativas']=$negativas_pos_id;
    return($data);
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