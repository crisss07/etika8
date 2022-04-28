<?php
// require_once('Controladoradmin.php');

// Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
// Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
// Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('America/La_Paz');

// class Prueba_tres extends Controladoradmin
class Prueba_tres extends CI_Controller
{
    function __construct()
    {
      parent::__construct();
      force_ssl();
      $this->load->helper(array('url','form','html'));
      $this->load->library(array('form_validation','tool_general'));

         //****** definiendo nombre de carpeta por defecto
      $this->carpeta='prueba_tres/';
      $this->controlador='Prueba_tres/';
      $this->controladorE='Evaluacion/';

      $this->tabla='zis_plantillas';
      $this->prefijo='zpla_';
        //******* definiendo campos de la tabla
      $this->campo=array($this->prefijo.'nombre');


      $this->formulario_agregar='contador_agregar';
      $this->formulario_editar='contador_agregar';
      $this->action_defecto='listar';


         //****** cargando el modelo
      $this->modelo='modelo_contador';
        //$this->load->model($this->carpeta.'Contador_model',$this->modelo,TRUE);
      $this->cabecera['titulo'] = 'Sistema de Evaluación';
      $this->rutaimg=@$this->constantes['nombresitio'].'files/img/';              

      $this->msj_retorno='Volver';
      $this->ruta_retorno='combos';        
      $this->orden=$this->prefijo.'orden';
      $this->presession = $this->tool_entidad->presession();
      session_start();
      if (!isset($_SESSION[$this->presession . 'usuario'])) {
        redirect(base_url() . index_page());
    }
} 

function comenzar_preguntas($idgrupo=null,$ideval=null)
{      
    $resultado = $this->db->query("SELECT zpla_id FROM
zis_evaluacion
WHERE eva_id=$ideval")->row();
    $id_pla=$resultado->zpla_id;
    //var_dump($idgrupo.'--'.$ideval.'--'.$pla_id);exit();
    redirect('Prueba_tres/texto_instructivo_i/'.$id_pla.'/'.$idgrupo.'/'.$ideval);
    // redirect('Prueba_tres/preguntas/'.$id_pla.'/'.$idgrupo.'/'.$ideval);
    
}

function texto_instructivo_i($pla_id,$idgrupo=null,$ideval=null)
{      
    $resultado = $this->db->query("SELECT * FROM 
zis_plantillas
WHERE zpla_id=$pla_id
")->row();
    $id_pla=$resultado->zpla_id;
    $contenido['texto']=$resultado->zpla_texto_instructivo_prueba;
    $contenido['pla_id']=$pla_id;
    $contenido['id_grupo']=$idgrupo;
    $contenido['ideval']=$ideval;
    // $contenido['array_id']=[$pla_id,$idgrupo,$ideval];

    $data['contenido'] = $this->load->view($this->carpeta.'texto_instructivo_i', $contenido, true);
    $this->load->view('plantilla_publico_2019', $data);
   // redirect('Prueba_tres/preguntas/'.$id_pla.'/'.$idgrupo.'/'.$ideval);
    
}
function preguntas_prueba($pla_id,$idgrupo=null,$ideval=null)
{      
    $this->db->order_by('prueba_nro','ASC'); 
    $this->db->where('zpla_id', $pla_id);         
    $preguntas=$this->db->get('zis_plantilla_p_tres');
    $contenido['preguntas'] = $preguntas->result_array();
    $contenido['pla_id']=$pla_id;
    $contenido['id_grupo']=$idgrupo;
    $contenido['ideval']=$ideval;
    $data['contenido'] = $this->load->view($this->carpeta.'vista_preguntas_prueba', $contenido, true);
    $this->load->view('plantilla_publico_2019', $data);
   // redirect('Prueba_tres/preguntas/'.$id_pla.'/'.$idgrupo.'/'.$ideval);
    
}

function texto_instructivo_ii($pla_id,$idgrupo=null,$ideval=null)
{      
    $resultado = $this->db->query("SELECT * FROM 
zis_plantillas
WHERE zpla_id=$pla_id
")->row();
    $id_pla=$resultado->zpla_id;
    $contenido['texto']=$resultado->zpla_texto_instructivo;
    $contenido['pla_id']=$pla_id;
    $contenido['id_grupo']=$idgrupo;
    $contenido['ideval']=$ideval;
    // $contenido['array_id']=[$pla_id,$idgrupo,$ideval];

    $data['contenido'] = $this->load->view($this->carpeta.'texto_instructivo_ii', $contenido, true);
    $this->load->view('plantilla_publico_2019', $data);
   // redirect('Prueba_tres/preguntas/'.$id_pla.'/'.$idgrupo.'/'.$ideval);
    
}
function guardar_intento($id_pla,$idgrupo=null,$ideval=null)
{      
    $id_usuario=$_SESSION[$this->presession . 'id'];
    $resultado = $this->db->query("SELECT * FROM 
zis_seguimiento
WHERE pos_id=$id_usuario and eva_id=$ideval and gru_id=$idgrupo");
    if ($resultado->num_rows() == 0) {//ya tiene un registro
        $intentos = $this->db->query("SELECT * FROM zis_evaluacion WHERE eva_id=$ideval")->row();
        $data_seg = array(  
            'pos_id' => $id_usuario ,
            'gru_id' => $idgrupo ,
            'eva_id' => $ideval ,
            'pla_id' => $id_pla,                  
            'seg_max_intentos' => $intentos->eva_nro_intentos ,
            'seg_intentos' => 1 ,
            
        );  
        $this->db->set('seg_fecha_inicio', 'NOW()', FALSE);                  
        $this->db->set('seg_fecha_creacion', 'NOW()', FALSE);  
        $this->db->insert('zis_seguimiento', $data_seg);
        redirect('Prueba_tres/preguntas/'.$id_pla.'/'.$idgrupo.'/'.$ideval);
    }else{
        $resultado=$resultado->row();
        if (($resultado->seg_intentos)<=($resultado->seg_max_intentos)) {//si el numero de intentos es menor
            $numero_intentos=$resultado->seg_intentos;
            $numero_intentos=$numero_intentos+1;
            $this->db->where('seg_id',$resultado->seg_id);                                        
            $this->db->set('seg_fecha_edicion', 'NOW()', FALSE);  
            $this->db->set('seg_intentos', $numero_intentos);  
            $this->db->update('zis_seguimiento');
            redirect('Prueba_tres/preguntas/'.$id_pla.'/'.$idgrupo.'/'.$ideval);
        }else{
            redirect($this->controladorE.'texto_despedida/'.$ideval); 
        }
        
        
    }
   
   
   
    
}

function preguntas($id_pla=null,$id_grupo=null,$idev=null)
{      
    //var_dump($id_grupo.'--'.$idev.'--'.$id_pla);exit();
    $this->cabecera['accion']='Preguntas'; 
    $contenido['cabecera']=$this->cabecera;
    $contenido['id_pla'] = $id_pla;
    // $contenido['id_pla'] = $id_pla;
    $contenido['id_grupo'] = $id_grupo;
    $contenido['idev'] = $idev;

    $id_usuario=$_SESSION[$this->presession . 'id'];


    $resultado = $this->db->query("SELECT * FROM zis_respuestas_tres WHERE pos_id='$id_usuario' and eva_id='$idev' and gru_id='$id_grupo' ORDER BY res_nro_resp desc limit 1
        ");

    if ($resultado->num_rows() > 0) {
        $resultado = $resultado->row();
        $posicion_actual=$resultado->res_nro_resp;
        $posicion=$posicion_actual;
            // echo 'verdad';
    }
    else{
            //return false;
            // echo 'falso';
        $posicion=1;
    }

    // var_dump($posicion.'--'.$ideval.'--'.$id_usuario);exit();

    if ($posicion!=1) {        
        $num_ini=$posicion+1;
        $num_fin=$num_ini+9;        
    }
    else{
        $num_ini=1;
        $num_fin=10;
        
    }
    //var_dump($msj);exit();

    //obtener el tiempo
    $tiempo = $this->db->query("SELECT seg_tiempo_total FROM zis_seguimiento WHERE pos_id='$id_usuario' and eva_id='$idev' and gru_id='$id_grupo'");

    if ($tiempo->num_rows() > 0) {
        $tiempo=$tiempo->result_array();
        $tiempo=$tiempo[0]['seg_tiempo_total'];
        $valor_tiempo=explode(":",$tiempo);
        $tiempo_cronometro=[$valor_tiempo[0],$valor_tiempo[1],$valor_tiempo[2]];
        //var_dump($tiempo_cronometro);exit();
        
    }else{
        $tiempo_cronometro=[0,0,0];
    }

    $resultado = $this->db->query("SELECT p.*,f.letra,f.factor_id from zis_plantilla_e_tres p
        LEFT JOIN
        zis_factor f
        on p.factor_id=f.factor_id
        WHERE p.zpla_id=$id_pla and p.pre_nro BETWEEN $num_ini and $num_fin
        ORDER BY p.pre_nro ASC
        ");
    $data=$resultado->result_array();

    // $contenido['action'] = $this->controlador. 'preguntas/'.$id.'/'.$num_fin.'/'.$idev;
    $contenido['num_ini'] = $num_ini;
    $contenido['num_fin'] = $num_fin;

    $contenido['datos'] = $data;  

    $contenido['tc'] = $tiempo_cronometro; 
    // var_dump($tiempo_cronometro);exit();

    if ($posicion==170) {
        // code...
        redirect($this->controladorE.'texto_despedida/'.$idev); 
    }
    else{
        $data['contenido'] = $this->load->view($this->carpeta.'vista_previa_preguntas', $contenido, true);
        $this->load->view('plantilla_publico_2019', $data);

        // $this->load->view('prueba_tres/ajax');
    }

}

function guardar_preguntas()
{      

    $tiempo = $this->input->post('tiempo');
    $id = $this->input->post('id_pla');
    $id_grupo = $this->input->post('id_grupo');
    $idev = $this->input->post('idev');
    $num_ini = $this->input->post('num_ini');
    $num_fin = $this->input->post('num_fin');
    $id_usuario=$_SESSION[$this->presession . 'id'];
    // $valor_radio=$this->input->post('resp10');

    

    //valores
    // '1,'.$datos[$i]['valor_a'].','.$datos[$i]['letra'].','.$datos[$i]['factor_id'].',in,'.$valor_aq
    // var_dump($id,$id_grupo,$idev,$num_ini,$num_fin,$id_usuario,$valor_radio);exit();        
    for ($i=$num_ini; $i <=$num_fin ; $i++) { 
    // for ($i=1; $i <=170 ; $i++) { 
       $valor_radio=$this->input->post('resp'.$i);
       $array_preg=explode(",",$valor_radio);
         // var_dump($array_preg[5]);
         // exit();
        //validar que el registro no exista
       $sw=$this->validar_si_pregunta_existe($id_grupo,$idev,$id_usuario,$i);
       //1 existe 0 no existe dato
       //var_dump($sw);exit();
       // solo inserta si no existe la pregunta
       if ($sw==0) {
           $data = array(
         'pos_id' => $id_usuario ,
         'gru_id' => $id_grupo ,
         'eva_id' => $idev ,
         'res_nro_resp' => $i,
         'res_respuesta' => $array_preg[0],
         'res_puntaje' => $array_preg[1],       
         'factor_id' => $array_preg[3],
         'factor_letra' => $array_preg[2],
         'valor_in' => $array_preg[4],
         'aq' => $array_preg[5],

         );
         $this->db->set('res_fecha_creacion', 'NOW()', FALSE);            
         $this->db->insert('zis_respuestas_tres', $data);
       }
         
   }

    //guardamos los datos en seguimiento
   $resultado = $this->db->query("SELECT * FROM 
    zis_seguimiento
    WHERE pos_id=$id_usuario and eva_id=$idev and gru_id=$id_grupo");

   if ($resultado->num_rows() > 0) {
    $resultado = $resultado->row();
            // $seg_intentos=$resultado->$seg_intentos;
    $seg_porcentaje=$resultado->seg_porcentaje;
    $seg_tiempo_total=$resultado->seg_tiempo_total;

    // $seg_intentos=$seg_intentos+1;
    //calculo de procentaje
    

    // $seg_porcentaje=$seg_porcentaje+5.88;
    $seg_porcentaje=$this->calculo_porcentaje($id_grupo,$idev,$id_usuario);

    // var_dump($seg_porcentaje);exit();
    // if ($resultado->seg_tiempo_total=='00:00:00') {
    //         $seg_tiempo_total=$tiempo;
    // }else{

    //         $tiempo_bd= date('H:i:s',strtotime($seg_tiempo_total));
    //         $tiempo_dos=  date('H:i:s',strtotime($tiempo));
    //         $seg_tiempo_total=date('H:i:s',strtotime($tiempo_bd)+strtotime($tiempo_dos)- strtotime('00:00:00'));
        
    // }
            // 
    //var_dump($tiempo,$tiempo_dos,$seg_tiempo_total);exit();

    $data_seg = array(
            // 'seg_intentos' => $id_usuario ,
        'seg_porcentaje' => $seg_porcentaje ,
        // 'seg_tiempo_total' => $seg_tiempo_total ,           
    );

    $this->db->set('seg_fecha_edicion', 'NOW()', FALSE);            
    $this->db->where('seg_id', $resultado->seg_id);    
    $this->db->update('zis_seguimiento', $data_seg);
            // echo 'verdad';
}
//guardar resultados
    //crear baremos gral con valores pd y de ceros
    $this->crear_baremo_gral_respuestas_parciales($id_grupo,$idev,$id,$id_usuario);
    $this->guardar_baremo_gral_respuestas_parciales($id_grupo,$idev,$id,$id_usuario);

    $this->crear_tabla_calculo_sec_temporal($id,$id_grupo,$idev,$id_usuario);
    $this->guardar_tabla_calculo_sec_temporal($id,$id_grupo,$idev,$id_usuario);
    
    $this->crear_tabla_valores_totales_temporales($id,$id_grupo,$idev,$id_usuario);
    $this->calculo_valores_totales_temporales($id_grupo,$idev,$id,$id_usuario);

if ($num_fin==170) {
        // code...
    //$this->db->set('seg_porcentaje', $seg_porcentaje);
    $this->db->set('seg_termino', 1);            
    $this->db->where('seg_id', $resultado->seg_id);    
    $this->db->update('zis_seguimiento');
        // redirect('ninicio'); 
    //generar los resultados para el informe
    // $this->guardar_baremo_gral_respuestas($id_grupo,$idev,$id,$id_usuario);
    //  // guardar_tabla_calculo_sec($pla_id,$gru_id,$eva_id,$pos_id)
    // $this->guardar_tabla_calculo_sec($id,$id_grupo,$idev,$id_usuario);
    // $this->calculo_valores_totales($id_grupo,$idev,$id,$id_usuario);

    //fin de generar los resultados para el informe

    redirect('Prueba_tres/texto_despedida/'.$id.'/'.$id_grupo.'/'.$idev); 
}else{

    

    redirect('Prueba_tres/preguntas/'.$id.'/'.$id_grupo.'/'.$idev); 

}

}

////update  factor
function update_factores()
{
    $this->db->order_by('pre_nro','asc');
    $data=$this->db->get('zis_plantilla_e_tres')->result_array();
    //var_dump($data[0]);exit();

    
    $factores=$this->db->get('zis_factor')->result_array();
    //var_dump($factores[0]['letra']);exit();

    for ($i=0; $i <count($factores) ; $i++) { 
        $this->db->set('factor_id', $factores[$i]['factor_id']);
        $this->db->where('factor_letra', $factores[$i]['letra']);
        $this->db->update('zis_respuestas_tres');
    }
    echo 'exito';
}

//verificar si la pregunta ya se guardo

function validar_si_pregunta_existe($gru_id,$eva_id,$pos_id,$nro_preg)
{         
    $validar= $this->db->query("SELECT * FROM zis_respuestas_tres
    WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and res_nro_resp=$nro_preg ");

    
    if ($validar->num_rows()==0) {//no existen datos insertar los 18 factores para guardar el baremo gral      
        // echo 'no existe dato';
        $sw_p=0;
    }else{
        // echo 'existe dato';
        $sw_p=1;
    }
    return $sw_p;
}
//calcular porcentaje

function calculo_porcentaje($gru_id,$eva_id,$pos_id)
{         
    $validar= $this->db->query("SELECT count(res_nro_resp) as total_respuestas FROM zis_respuestas_tres
    WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id ");
    if ($validar->num_rows()==0) {//no existen datos insertar los 18 factores para guardar el baremo gral      
        // echo 'no existen preguntas';
        $porcentaje=0;
    }else{
        // echo 'existe dato';
        $validar=$validar->result_array();
        $porcentaje=$validar[0]['total_respuestas'];
        $porcentaje=($porcentaje*100)/170;
    }
    return $porcentaje;
}

//guardar resultados de las respuestas
function crear_baremo_gral_respuestas_parciales($gru_id,$eva_id,$pla_id,$pos_id)
{         
    $validar= $this->db->query("SELECT * FROM zis_resp_tres_baremogral
    WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id");
    $factores= $this->db->query("SELECT * FROM zis_factor")->result_array();
    if ($validar->num_rows()==0) {//no existen datos insertar los 18 factores para guardar el baremo gral
        for ($i=0; $i < count($factores); $i++) {             
            $data = array(
                'zpla_id' => $pla_id,
                'factor_id' => $factores[$i]['factor_id'],
                'factor_letra' => $factores[$i]['letra'],
                'pd' => 0,        
                'de' =>0,
                'pos_id'=>$pos_id,
                'gru_id'=>$gru_id,
                'eva_id'=>$eva_id,                
            );             
            $this->db->insert('zis_resp_tres_baremogral', $data);
        }
        echo 'exito';
    }else{
        echo 'false';
    }
}

//guardar resultados de las respuestas
function guardar_baremo_gral_respuestas_parciales($gru_id,$eva_id,$pla_id,$pos_id)
{ 
$validar= $this->db->query("SELECT * FROM zis_resp_tres_baremogral
    WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id");

$factores= $this->db->query("SELECT * FROM zis_factor
    WHERE tipo=1")->result_array();

    if ($validar->num_rows()>0) {//no existen datos insertar los valores de baremo gral
        for ($i=0; $i < count($factores); $i++) { 
            
            

            $factor_id=$factores[$i]['factor_id'];

            //id de la tabla baremo gral
            $id_tabla= $this->db->query("SELECT *
FROM zis_resp_tres_baremogral
WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and factor_id=$factor_id")->result_array();
            $id_tabla=$id_tabla[0]['res_baremo_id'];

            // $factor_id=13;

            //puntaje bruto de factor en caso de existir el valor es cero
            $suma_total= $this->db->query("SELECT (CASE WHEN sum(res_puntaje)  IS NULL THEN 0   ELSE sum(res_puntaje) END) as puntaje_bruto FROM zis_respuestas_tres
                WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and factor_id=$factor_id")->result_array();
            $suma_total=$suma_total[0]['puntaje_bruto'];
            
            //baremo con valores de
            // $factor_id_bar=$suma_total[$i]['factor_id'];
            $puntaje_baremo= $this->db->query("SELECT array_valores as valor FROM
zis_baremo_factor
WHERE factor_id=$factor_id AND zpla_id=$pla_id")->result_array();
            $puntaje_baremo=json_decode($puntaje_baremo[0]['valor']);
            //var_dump($puntaje_baremo[20]);exit();   
            $valor_baremo=$suma_total;
            // $valor_baremo=$puntaje_baremo[0];//error
            $valor_baremo=$puntaje_baremo[$valor_baremo];
            
            $data = array(
                'pd' => $suma_total,//puntaje bruto
                'de' =>$valor_baremo//puntaje baremo 
            );
            $this->db->where('res_baremo_id',$id_tabla);             
            $this->db->update('zis_resp_tres_baremogral', $data);
        }    

        //id de la tabla baremo gral
            $id_tabla= $this->db->query("SELECT *
FROM zis_resp_tres_baremogral
WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and factor_id=17")->result_array();
            $id_tabla=$id_tabla[0]['res_baremo_id'];    

        $suma_total= $this->db->query("SELECT (CASE WHEN sum(valor_in)  IS NULL THEN 0  ELSE sum(valor_in) END) as puntaje_bruto FROM zis_respuestas_tres
WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id")->result_array();
        $puntaje_baremo= $this->db->query("SELECT array_valores as valor FROM
zis_baremo_factor
WHERE factor_id=17 AND zpla_id=$pla_id")->result_array();
            $puntaje_baremo=json_decode($puntaje_baremo[0]['valor']);
            $valor_baremo=$suma_total[0]['puntaje_bruto'];
            $valor_baremo=$puntaje_baremo[$valor_baremo];           

            $data = array(         
                'pd' => $suma_total[0]['puntaje_bruto'],        
                'de' =>$valor_baremo                
            );          
            $this->db->where('res_baremo_id',$id_tabla);                
            $this->db->update('zis_resp_tres_baremogral', $data);
            
            //valor de aq
            //id de la tabla baremo gral
            $id_tabla= $this->db->query("SELECT *
FROM zis_resp_tres_baremogral
WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and factor_id=18")->result_array();
            $id_tabla=$id_tabla[0]['res_baremo_id'];  
        $suma_total= $this->db->query("SELECT (CASE WHEN sum(aq)  IS NULL THEN 0  ELSE sum(aq) END) as puntaje_bruto FROM zis_respuestas_tres
WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id")->result_array();
        $puntaje_baremo= $this->db->query("SELECT array_valores as valor FROM
zis_baremo_factor
WHERE factor_id=18 AND zpla_id=$pla_id")->result_array();
            $puntaje_baremo=json_decode($puntaje_baremo[0]['valor']);
            $valor_baremo=$suma_total[0]['puntaje_bruto'];
            $valor_baremo=$puntaje_baremo[$valor_baremo];
            
            $data = array(
                'pd' => $suma_total[0]['puntaje_bruto'],        
                'de' =>$valor_baremo ,
                
            );             
            $this->db->where('res_baremo_id',$id_tabla); 
            $this->db->update('zis_resp_tres_baremogral', $data);
            //var_dump($valor_baremo);exit();
        
        echo 'exito';
    }else{
        echo 'false';
    }

    //insertar los valores in aq

    
}
//crear la tabla calculo sec
function crear_tabla_calculo_sec_temporal($pla_id,$gru_id,$eva_id,$pos_id){
    $validar= $this->db->query("SELECT * FROM zis_resp_tres_calculo_sec
    WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and zpla_id=$pla_id");

    if ($validar->num_rows()==0) {//no existen datos insertar los valores de baremo gral
        $data = array(
                'zpla_id' => $pla_id,
                'sociabilidad' => 0,
                'emocional' => 0,
                'apertura' => 0,        
                'amabilidad' =>0,
                'responsabilidad' =>0,
                'pos_id'=>$pos_id,
                'gru_id'=>$gru_id,
                'eva_id'=>$eva_id,                                                
                'user_creacion'=>$_SESSION[$this->presession.'id'],         
        );   
        $this->db->set('pre_fecha_creacion', 'NOW()', FALSE);            
        $this->db->insert('zis_resp_tres_calculo_sec', $data);
        echo 'exito';
    }else{
        echo 'false';
    }
}

//calculo de la tabla calculo sec

//calculo tabla sociabilidad etc
function guardar_tabla_calculo_sec_temporal($pla_id,$gru_id,$eva_id,$pos_id)
{      
     
// $validar= 0;

$validar= $this->db->query("SELECT *
FROM zis_resp_tres_calculo_sec
WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id")->result_array();

$tab_bar= $this->db->query("SELECT x.* FROM
(SELECT * FROM
zis_resp_tres_baremogral
WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id ORDER BY factor_id) x
JOIN
(SELECT * FROM
zis_factor 
WHERE grupo_baremo=1) y
on x.factor_id=y.factor_id")->result_array();
$suma_a=21;//c1s
$suma_b=0;//c2s
$suma_c=10;
$suma_d=16;
$suma_e=138;
$suma_f=5;
$suma_g=5;
$suma_h=50;
$suma_m=0;
$suma_n=22;

// $suma_a=$suma_a+5+16;
//         $suma_c=$suma_c+10;
//         $suma_d=$suma_d+16;
//         $suma_e=$suma_e+138;
//         $suma_f=$suma_f+5;
//         $suma_g=$suma_g+5;
//         $suma_h=$suma_h+50;

    if ($validar>0) {//no existen datos insertar los valores de baremo gral
        //5 0   0   3   1   1   2   0   0   0   2   0   0   1   1 sociabilidad constante 1 del 0 al 14
        //0 1   0   0   0   0   0   0   0   3   0   2   4   0   0 sociabilidad constante 2

        $a=["5","0","0","3","1","1","2","0","0","0","2","0","0","1","1"];
        $b=["0","1","0","0","0","0","0","0","0","3","0","2","4","0","0"];

        $c=["2","0","1","1","1","0","1","3","0","1","5","0","0","3","4"];
        $d=["0","3","0","0","0","2","0","0","0","0","0","4","2","0","0"];

        $e=["0","0","0","3","0","0","0","2","0","1","1","0","0","0","3"];
        $f=["2","1","1","0","0","2","3","0","3","0","0","8","3","1","0"];

        $g=["0","1","7","3","0","2","0","3","0","2","0","1","0","1","2"];
        $h=["1","0","0","0","1","0","2","0","0","0","0","0","0","0","0"];

        $m=["3","0","1","0","5","0","1","0","0","0","3","0","0","7","0"];
        $n=["0","1","0","3","0","1","0","0","1","0","0","0","0","0","0"];

        // $c=explode(",", $constante_uno);
        // $d=explode(",", $constante_dos);

        
        
        for ($i=0; $i < count($tab_bar); $i++) { 
            $suma_a=$suma_a+$tab_bar[$i]['de']*$a[$i];
            $suma_b=$suma_b+$tab_bar[$i]['de']*$b[$i];
            $suma_c=$suma_c+$tab_bar[$i]['de']*$c[$i];
            $suma_d=$suma_d+$tab_bar[$i]['de']*$d[$i];
            $suma_e=$suma_e+$tab_bar[$i]['de']*$e[$i];
            $suma_f=$suma_f+$tab_bar[$i]['de']*$f[$i];
            $suma_g=$suma_g+$tab_bar[$i]['de']*$g[$i];
            $suma_h=$suma_h+$tab_bar[$i]['de']*$h[$i];
            $suma_m=$suma_m+$tab_bar[$i]['de']*$m[$i];
            $suma_n=$suma_n+$tab_bar[$i]['de']*$n[$i];
        }

        
        // var_dump($suma_a,$suma_b,$suma_c,$suma_d,$suma_e,$suma_f,$suma_g,$suma_h,$suma_m,$suma_n);exit();

        $sociabilidad=($suma_a-$suma_b)/10;
        $estab_emocional=($suma_c-$suma_d)/10;
        $apertura=($suma_e-$suma_f)/10;
        $amabilidad=($suma_g-$suma_h)/10;
        $responsabilidad=($suma_m-$suma_n)/10;

        //var_dump($sociabilidad,$estab_emocional,$apertura,$amabilidad,$responsabilidad);exit();

        //cambio de valores con la formula invertida
        if ($sociabilidad>=10) {
            $sociabilidad=10;
        }
        if ($sociabilidad<=1) {
            $sociabilidad=1;
        }

        if ($estab_emocional>=10) {
            $estab_emocional=10;
        }
        if ($estab_emocional<=1) {
            $estab_emocional=1;
        }

        if ($apertura>=10) {
            $apertura=10;
        }
        if ($apertura<=1) {
            $apertura=1;
        }

        if ($amabilidad>=10) {
            $amabilidad=10;
        }
        if ($amabilidad<=1) {
            $amabilidad=1;
        }

         if ($responsabilidad>=10) {
            $responsabilidad=10;
        }
        if ($responsabilidad<=1) {
            $responsabilidad=1;
        }

        //fin de cambio de valores con la formula invertida


        //insertar los valores parciales 
        //id de la tabla
        $id_tabla=$validar[0]['calculo_sec_id'];
        $data = array(                
                'sociabilidad' => $sociabilidad,
                'emocional' => $estab_emocional,
                'apertura' => $apertura,        
                'amabilidad' =>$amabilidad,
                'responsabilidad' =>$responsabilidad,                
            );    
        $this->db->where('calculo_sec_id', $id_tabla);
        $this->db->update('zis_resp_tres_calculo_sec', $data);
        echo 'exito';
    }else{
        echo 'false';
    }

    //insertar los valores in aq
}
//crear la tabla calculo sec
function crear_tabla_valores_totales_temporales($pla_id,$gru_id,$eva_id,$pos_id){
    $validar= $this->db->query("SELECT * FROM zis_respuestas_tres_total_gral
    WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and zpla_id=$pla_id");

    if ($validar->num_rows()==0) {//no existen datos insertar los valores de baremo gral
        $data = array(
                'zpla_id' => $pla_id,                
                'array_total_gral' =>0,
                'pos_id'=>$pos_id,
                'gru_id'=>$gru_id,
                'eva_id'=>$eva_id,                                
                'user_creacion'=>$_SESSION[$this->presession.'id'], 
            );             
        $this->db->set('res_fecha_creacion', 'NOW()', FALSE);  
        $this->db->insert('zis_respuestas_tres_total_gral', $data);
        echo 'exito';
    }else{
        echo 'false';
    }
}

function calculo_valores_totales_temporales($gru_id,$eva_id,$pla_id,$pos_id)
{      
//     $gru_id=1;
//     $eva_id=20;
//     $pla_id=56;
//     $pos_id=30548;  
    $array_valores_totales=[];
$tabla_calculo_est= $this->db->query("SELECT * FROM zis_resp_tres_calculo_sec
    WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and zpla_id=$pla_id")->result_array();


$validar= $this->db->query("SELECT * FROM zis_respuestas_tres_total_gral
    WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and zpla_id=$pla_id");

$tab_bar= $this->db->query("SELECT x.de,x.factor_letra,y.descripcion FROM
(SELECT * FROM
zis_resp_tres_baremogral
WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id ORDER BY factor_id) x
JOIN
(SELECT * FROM
zis_factor 
WHERE grupo_baremo=1) y
on x.factor_id=y.factor_id")->result_array();


        
        for ($i=0; $i < count($tab_bar); $i++) { 
            
            $valor=$tab_bar[$i]['de'];
            array_push($array_valores_totales,$valor);
            // $array_valores_totales+=[$valor];
        }
        //estab emocional etc..

            $valor=$tabla_calculo_est[0]['sociabilidad'];
           // var_dump($valor);exit();
            array_push($array_valores_totales,$valor);
            $valor=10-$tabla_calculo_est[0]['emocional'];
            array_push($array_valores_totales,$valor);
            $valor=10-$tabla_calculo_est[0]['apertura'];
            array_push($array_valores_totales,$valor);
            $valor=$tabla_calculo_est[0]['amabilidad'];
            array_push($array_valores_totales,$valor);
            $valor=$tabla_calculo_est[0]['responsabilidad'];
            array_push($array_valores_totales,$valor);


$tab_bar_dos= $this->db->query("SELECT x.de,x.factor_letra,y.descripcion FROM
(SELECT * FROM
zis_resp_tres_baremogral
WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id ORDER BY factor_id) x
JOIN
zis_factor y
on x.factor_id=y.factor_id")->result_array();
            $valor=10-$tab_bar_dos[15]['de'];
            array_push($array_valores_totales,$valor);
            $valor=$tab_bar_dos[16]['de'];
            array_push($array_valores_totales,$valor);
            $valor=$tab_bar_dos[17]['de'];
            array_push($array_valores_totales,$valor);
//var_dump($array_valores_totales);exit();
    if ($validar->num_rows()>0) {
        $validar=$validar->result_array();
        $id_tabla=$validar[0]['total_gral_id'];
        $data = array(                
                'array_total_gral' =>json_encode($array_valores_totales),
            );             
            $this->db->where('total_gral_id',$id_tabla );  
            $this->db->set('res_fecha_creacion', 'NOW()', FALSE);  
            $this->db->update('zis_respuestas_tres_total_gral', $data);
        echo 'exito';
    }else{
        echo 'false';
    }

    //insertar los valores in aq

    
}
//anterior version
//guardar resultados de las respuestas
function guardar_baremo_gral_respuestas($gru_id,$eva_id,$pla_id,$pos_id)
{      
    // $gru_id=1;
    // $eva_id=20;
    // $pla_id=56;
    // $pos_id=30548;  

// $valores=[];
// for ($i=0; $i <= ($cantidad_factor*2); $i++) {     
//    $puntaje = $this->input->post('factor'.$i);
//          //$puntaje = array($i=>$puntaje);    
//    array_push($valores,$puntaje);

// }
    // var_dump(json_encode($valores[22]));exit();

    //solo insertar una vez

$validar= $this->db->query("SELECT * FROM zis_resp_tres_baremogral
    WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id");

$factores= $this->db->query("SELECT * FROM zis_factor
    WHERE tipo=1")->result_array();

    if ($validar->num_rows()==0) {//no existen datos insertar los valores de baremo gral
        for ($i=0; $i < count($factores); $i++) { 

            $suma_total= $this->db->query("SELECT y.*,x.puntaje_bruto FROM
                (SELECT sum(res_puntaje) as puntaje_bruto,factor_id FROM zis_respuestas_tres
                WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id
                GROUP BY factor_id ORDER BY factor_id asc) x
                JOIN
                (SELECT * FROM zis_factor
                WHERE tipo=1) y
                on x.factor_id=y.factor_id")->result_array();
           //var_dump($suma_total);exit();
            //baremo con valores de
            $factor_id_bar=$suma_total[$i]['factor_id'];
            $puntaje_baremo= $this->db->query("SELECT array_valores as valor FROM
zis_baremo_factor
WHERE factor_id=$factor_id_bar AND zpla_id=$pla_id")->result_array();
            $puntaje_baremo=json_decode($puntaje_baremo[0]['valor']);
            //var_dump($puntaje_baremo[20]);exit();   
            $valor_baremo=$suma_total[$i]['puntaje_bruto'];
            $valor_baremo=$puntaje_baremo[$valor_baremo];
            $data = array(
                'zpla_id' => $pla_id,
                'factor_id' => $suma_total[$i]['factor_id'],
                'factor_letra' => $suma_total[$i]['letra'],
                'pd' => $suma_total[$i]['puntaje_bruto'],        
                'de' =>$valor_baremo ,
                'pos_id'=>$pos_id,
                'gru_id'=>$gru_id,
                'eva_id'=>$eva_id,                
            );             
            $this->db->insert('zis_resp_tres_baremogral', $data);
        }

        $suma_total= $this->db->query("SELECT SUM(valor_in) as puntaje_bruto FROM zis_respuestas_tres
WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id")->result_array();
        $puntaje_baremo= $this->db->query("SELECT array_valores as valor FROM
zis_baremo_factor
WHERE factor_id=17 AND zpla_id=$pla_id")->result_array();
            $puntaje_baremo=json_decode($puntaje_baremo[0]['valor']);
            $valor_baremo=$suma_total[0]['puntaje_bruto'];
            $valor_baremo=$puntaje_baremo[$valor_baremo];
            $data = array(
                'zpla_id' => $pla_id,
                'factor_id' => 17,
                'factor_letra' => 'IN',
                'pd' => $suma_total[0]['puntaje_bruto'],        
                'de' =>$valor_baremo ,
                'pos_id'=>$pos_id,
                'gru_id'=>$gru_id,
                'eva_id'=>$eva_id,                
            );             
            $this->db->insert('zis_resp_tres_baremogral', $data);
        $suma_total= $this->db->query("SELECT SUM(aq) as puntaje_bruto FROM zis_respuestas_tres
WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id")->result_array();
        $puntaje_baremo= $this->db->query("SELECT array_valores as valor FROM
zis_baremo_factor
WHERE factor_id=18 AND zpla_id=$pla_id")->result_array();
            $puntaje_baremo=json_decode($puntaje_baremo[0]['valor']);
            $valor_baremo=$suma_total[0]['puntaje_bruto'];
            $valor_baremo=$puntaje_baremo[$valor_baremo];
            $data = array(
                'zpla_id' => $pla_id,
                'factor_id' => 18,
                'factor_letra' => 'AQ',
                'pd' => $suma_total[0]['puntaje_bruto'],        
                'de' =>$valor_baremo ,
                'pos_id'=>$pos_id,
                'gru_id'=>$gru_id,
                'eva_id'=>$eva_id,                
            );             
            $this->db->insert('zis_resp_tres_baremogral', $data);
        
        echo 'exito';
    }else{
        echo 'false';
    }
    //insertar los valores in aq
}
//calculo de la ta

//calculo tabla sociabilidad etc
function guardar_tabla_calculo_sec($pla_id,$gru_id,$eva_id,$pos_id)
{      
    // $gru_id=1;
    // $eva_id=20;
    // $pla_id=56;
    // $pos_id=30548;  
$validar= $this->db->query("SELECT * FROM zis_resp_tres_calculo_sec
    WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and zpla_id=$pla_id");

$tab_bar= $this->db->query("SELECT x.* FROM
(SELECT * FROM
zis_resp_tres_baremogral
WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id ORDER BY factor_id) x
JOIN
(SELECT * FROM
zis_factor 
WHERE grupo_baremo=1) y
on x.factor_id=y.factor_id")->result_array();
$suma_a=21;//c1s
$suma_b=0;//c2s
$suma_c=10;
$suma_d=16;
$suma_e=138;
$suma_f=5;
$suma_g=5;
$suma_h=50;
$suma_m=0;
$suma_n=22;

// $suma_a=$suma_a+5+16;
//         $suma_c=$suma_c+10;
//         $suma_d=$suma_d+16;
//         $suma_e=$suma_e+138;
//         $suma_f=$suma_f+5;
//         $suma_g=$suma_g+5;
//         $suma_h=$suma_h+50;

    if ($validar->num_rows()==0) {//no existen datos insertar los valores de baremo gral
        //5 0   0   3   1   1   2   0   0   0   2   0   0   1   1 sociabilidad constante 1 del 0 al 14
        //0 1   0   0   0   0   0   0   0   3   0   2   4   0   0 sociabilidad constante 2

        $a=["5","0","0","3","1","1","2","0","0","0","2","0","0","1","1"];
        $b=["0","1","0","0","0","0","0","0","0","3","0","2","4","0","0"];

        $c=["2","0","1","1","1","0","1","3","0","1","5","0","0","3","4"];
        $d=["0","3","0","0","0","2","0","0","0","0","0","4","2","0","0"];

        $e=["0","0","0","3","0","0","0","2","0","1","1","0","0","0","3"];
        $f=["2","1","1","0","0","2","3","0","3","0","0","8","3","1","0"];

        $g=["0","1","7","3","0","2","0","3","0","2","0","1","0","1","2"];
        $h=["1","0","0","0","1","0","2","0","0","0","0","0","0","0","0"];

        $m=["3","0","1","0","5","0","1","0","0","0","3","0","0","7","0"];
        $n=["0","1","0","3","0","1","0","0","1","0","0","0","0","0","0"];

        // $c=explode(",", $constante_uno);
        // $d=explode(",", $constante_dos);

        
        
        for ($i=0; $i < count($tab_bar); $i++) { 
            $suma_a=$suma_a+$tab_bar[$i]['de']*$a[$i];
            $suma_b=$suma_b+$tab_bar[$i]['de']*$b[$i];
            $suma_c=$suma_c+$tab_bar[$i]['de']*$c[$i];
            $suma_d=$suma_d+$tab_bar[$i]['de']*$d[$i];
            $suma_e=$suma_e+$tab_bar[$i]['de']*$e[$i];
            $suma_f=$suma_f+$tab_bar[$i]['de']*$f[$i];
            $suma_g=$suma_g+$tab_bar[$i]['de']*$g[$i];
            $suma_h=$suma_h+$tab_bar[$i]['de']*$h[$i];
            $suma_m=$suma_m+$tab_bar[$i]['de']*$m[$i];
            $suma_n=$suma_n+$tab_bar[$i]['de']*$n[$i];
        }

        
        // var_dump($suma_a,$suma_b,$suma_c,$suma_d,$suma_e,$suma_f,$suma_g,$suma_h,$suma_m,$suma_n);exit();

        $sociabilidad=($suma_a-$suma_b)/10;
        $estab_emocional=($suma_c-$suma_d)/10;
        $apertura=($suma_e-$suma_f)/10;
        $amabilidad=($suma_g-$suma_h)/10;
        $responsabilidad=($suma_m-$suma_n)/10;

        //var_dump($sociabilidad,$estab_emocional,$apertura,$amabilidad,$responsabilidad);exit();

        //insertar los valores parciales 
        $data = array(
                'zpla_id' => $pla_id,
                'sociabilidad' => $sociabilidad,
                'emocional' => $estab_emocional,
                'apertura' => $apertura,        
                'amabilidad' =>$amabilidad,
                'responsabilidad' =>$responsabilidad,
                'pos_id'=>$pos_id,
                'gru_id'=>$gru_id,
                'eva_id'=>$eva_id,                
                'pre_fecha_creacion'=>$eva_id, 
                'user_creacion'=>$eva_id, 
            );             

            $this->db->insert('zis_resp_tres_calculo_sec', $data);



        
        
        echo 'exito';
    }else{
        echo 'false';
    }

    //insertar los valores in aq

    
}

function calculo_valores_totales($gru_id,$eva_id,$pla_id,$pos_id)
{      
//     $gru_id=1;
//     $eva_id=20;
//     $pla_id=56;
//     $pos_id=30548;  
    $array_valores_totales=[];
$tabla_calculo_est= $this->db->query("SELECT * FROM zis_resp_tres_calculo_sec
    WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and zpla_id=$pla_id")->result_array();


$validar= $this->db->query("SELECT * FROM zis_respuestas_tres_total_gral
    WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and zpla_id=$pla_id");

$tab_bar= $this->db->query("SELECT x.de,x.factor_letra,y.descripcion FROM
(SELECT * FROM
zis_resp_tres_baremogral
WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id ORDER BY factor_id) x
JOIN
(SELECT * FROM
zis_factor 
WHERE grupo_baremo=1) y
on x.factor_id=y.factor_id")->result_array();


        
        for ($i=0; $i < count($tab_bar); $i++) { 
            
            $valor=$tab_bar[$i]['de'];
            array_push($array_valores_totales,$valor);
            // $array_valores_totales+=[$valor];
        }
        //estab emocional etc..

            $valor=$tabla_calculo_est[0]['sociabilidad'];
            array_push($array_valores_totales,$valor);
            $valor=10-$tabla_calculo_est[0]['emocional'];
            array_push($array_valores_totales,$valor);
            $valor=10-$tabla_calculo_est[0]['apertura'];
            array_push($array_valores_totales,$valor);
            $valor=$tabla_calculo_est[0]['amabilidad'];
            array_push($array_valores_totales,$valor);
            $valor=$tabla_calculo_est[0]['responsabilidad'];
            array_push($array_valores_totales,$valor);


$tab_bar_dos= $this->db->query("SELECT x.de,x.factor_letra,y.descripcion FROM
(SELECT * FROM
zis_resp_tres_baremogral
WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id ORDER BY factor_id) x
JOIN
zis_factor y
on x.factor_id=y.factor_id")->result_array();
            $valor=10-$tab_bar_dos[15]['de'];
            array_push($array_valores_totales,$valor);
            $valor=$tab_bar_dos[16]['de'];
            array_push($array_valores_totales,$valor);
            $valor=$tab_bar_dos[17]['de'];
            array_push($array_valores_totales,$valor);
//var_dump($array_valores_totales);exit();
    if ($validar->num_rows()==0) {
        $data = array(
                'zpla_id' => $pla_id,                
                'array_total_gral' =>json_encode($array_valores_totales),
                'pos_id'=>$pos_id,
                'gru_id'=>$gru_id,
                'eva_id'=>$eva_id,                                
                'user_creacion'=>$_SESSION[$this->presession.'id'], 
            );             
            $this->db->set('res_fecha_creacion', 'NOW()', FALSE);  
            $this->db->insert('zis_respuestas_tres_total_gral', $data);
        echo 'exito';
    }else{
        echo 'false';
    }

    //insertar los valores in aq

    
}






function texto_despedida($id_pla=null,$id_grupo=null,$idev=null)
{
    // $id=$this->input->post('id');
    $consulta = $this->db->query("SELECT eva_texto_despedida FROM zis_evaluacion
        WHERE eva_id=$idev");
    $datos=$consulta->result_array();
    // var_dump($datos->eva_texto_despedida);exit();
    $this->cabecera['accion']=''; 
    $contenido['cabecera']=$this->cabecera;
    $contenido['datos'] = $datos;
    $contenido['id'] = $id_pla;
    $contenido['id_grupo'] = $id_grupo;
    $contenido['idev'] = $idev;
    // $data['contenido'] = $this->load->view('prueba_dos/texto_despedida', $contenido, true);
    $data['contenido'] = $this->load->view('prueba_dos/texto_despedida', $contenido, true);
    $this->load->view('plantilla_publico_2019',$data);


}

function actualizar_tiempo()
{   
    $id_pla=$this->input->post("id_pla");
    $id_grupo=$this->input->post("id_grupo");
    $id_eval=$this->input->post("id_eval");
    $hora=$this->input->post("hora");
    $min=$this->input->post("min");
    $seg=$this->input->post("seg");
    $pos_id=$_SESSION[$this->presession . 'id'];
    // id_pla:id_pla,id_grupo:id_grupo,id_eval:id_eval,hora:hora,min:min,seg:seg
    $resultado = $this->db->query("SELECT * FROM 
    zis_seguimiento
    WHERE pos_id=$pos_id and eva_id=$id_eval and gru_id=$id_grupo")->row();
    $tiempo=$hora.':'.$min.':'.$seg;
    $seg_tiempo_total=strtotime($tiempo);
    $this->db->set('seg_tiempo_total', $tiempo);            
    $this->db->where('seg_id', $resultado->seg_id);    
    $this->db->update('zis_seguimiento');
    $data['msj'] = $tiempo;   
    echo json_encode($data);
}

function test_ajax()
{   
    $id_pla=$this->input->post("id_pla");
    
    $data['msj'] = 'exito';   
    echo json_encode($data);
}

function ir_inicio()
{
    redirect('ninicio');
}

}


?>