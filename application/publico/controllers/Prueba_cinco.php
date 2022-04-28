<?php
// require_once('Controladoradmin.php');
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('America/La_Paz');

class Prueba_cinco extends CI_Controller
{
    function __construct()
    {
      parent::__construct();
      force_ssl();
      $this->load->helper(array('url','form','html'));
      $this->load->library(array('form_validation','tool_general'));

         //****** definiendo nombre de carpeta por defecto
      $this->carpeta='prueba_cinco/';
      $this->controlador='Prueba_cinco/';
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
    redirect('Prueba_cinco/texto_instructivo_i/'.$id_pla.'/'.$idgrupo.'/'.$ideval);
    // redirect('Prueba_tres/preguntas/'.$id_pla.'/'.$idgrupo.'/'.$ideval);
    
}

function texto_instructivo_i($pla_id,$idgrupo=null,$ideval=null)
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

    $data['contenido'] = $this->load->view($this->carpeta.'texto_instructivo', $contenido, true);
    $this->load->view('plantilla_publico_2019', $data);
   // redirect('Prueba_tres/preguntas/'.$id_pla.'/'.$idgrupo.'/'.$ideval);
    
}


function guardar_intento($id_pla,$idgrupo=null,$ideval=null)
{      
    $id_usuario=$_SESSION[$this->presession . 'id'];
    // var_dump($id_usuario);exit();
    $resultado = $this->db->query("SELECT * FROM 
        zis_seguimiento
        WHERE pos_id=$id_usuario and eva_id=$ideval and gru_id=$idgrupo");
    $pla_cinco = $this->db->query("SELECT * FROM 
        zis_plantillas
        WHERE zpla_id=$id_pla")->row();
    $tiempo_maximo=$pla_cinco->zpla_tiempo_max;
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
        redirect('Prueba_cinco/preguntas/'.$id_pla.'/'.$idgrupo.'/'.$ideval);
    }else{
        $resultado=$resultado->row();
        if (($resultado->seg_intentos)<=($resultado->seg_max_intentos) ) {//si el numero de intentos es menor
            $numero_intentos=$resultado->seg_intentos;
            $numero_intentos=$numero_intentos+1;
            $this->db->where('seg_id',$resultado->seg_id);                                        
            $this->db->set('seg_fecha_edicion', 'NOW()', FALSE);  
            $this->db->set('seg_intentos', $numero_intentos);  
            $this->db->update('zis_seguimiento');
            redirect('Prueba_cinco/preguntas/'.$id_pla.'/'.$idgrupo.'/'.$ideval);
        }else{
            redirect($this->controladorE.'texto_despedida/'.$ideval); 
        }
        
        
    }



    
}

function preguntas($id_pla=null,$id_grupo=null,$idev=null)
{      
    //var_dump($id_grupo.'--'.$idev.'--'.$id_pla);exit();

    $resultado = $this->db->query("SELECT * FROM 
        zis_plantillas
        WHERE zpla_id=$id_pla
        ")->row();
    $id_pla=$resultado->zpla_id;
    $tiempo_maximo=$resultado->zpla_tiempo_max;
    $length=2;
    $tiempo_maximo = substr(str_repeat(0, $length).$tiempo_maximo, - $length);
    // var_dump($tiempo_maximo);exit();/
    $id_usuario=$_SESSION[$this->presession . 'id'];

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
    $contenido['texto_instructivo']=$resultado->zpla_texto_instructivo;

    $this->cabecera['accion']='Preguntas'; 
    $contenido['cabecera']=$this->cabecera;
    $contenido['id_pla'] = $id_pla;
    // $contenido['id_pla'] = $id_pla;
    $contenido['id_grupo'] = $id_grupo;
    $contenido['idev'] = $idev;
    $contenido['tiempo_maximo'] = $tiempo_maximo;
    $contenido['tc'] = $tiempo_cronometro; 
    // var_dump($tiempo_maximo);exit();

    $id_usuario=$_SESSION[$this->presession . 'id'];

    
    $resultado = $this->db->query("SELECT * from zis_plantilla_e_cinco
        WHERE zpla_id=$id_pla ORDER BY pre_nro ASC")->result_array();
    
    
    $contenido['datos'] = $resultado;  

    
    $data['contenido'] = $this->load->view($this->carpeta.'vista_preguntas', $contenido, true);
    $this->load->view('plantilla_publico_2019', $data);
    

}

function crear_preguntas()
{
    $tiempo = $this->input->post('tiempo');
    $id = $this->input->post('id_pla');
    $id_grupo = $this->input->post('id_grupo');
    $idev = $this->input->post('idev');
    $pos_id=$_SESSION[$this->presession.'id'];
    $seg_tiempo_total=strtotime($tiempo);

    //$seg_tiempo_total=date('H:i:s',strtotime($tiempo)- strtotime('00:00:00'));
    //var_dump($seg_tiempo_total);exit();
    

    //Cantidad asegurada    Clase de seguro Fecha   1   2   3
    for ($i=1; $i <=25 ; $i++) { 
        $a = $this->input->post('a'.$i);
        $b = $this->input->post('b'.$i);
        $c = $this->input->post('c'.$i);
        
        if ($this->input->post('a'.$i)==null) {//verifica si esta nulo
            $a=0;
        }
        if ($this->input->post('b'.$i)==null) {//verifica si esta nulo
            $b=0;
        }
        if ($this->input->post('c'.$i)==null) {//verifica si esta nulo
            $c=0;
        }
        $sw=$this->validar_si_pregunta_existe($id_grupo,$idev,$pos_id,$i);
        if ($sw==0) {//inserta solo si no existe el registro
            $data = array(
            'zpla_id' => $id ,
            'gru_id' => $id_grupo ,
            'eva_id' => $idev ,
            'pre_nro' => $i,            
            'resp_a' => $a,
            'resp_b' => $b,
            'resp_c' => $c,            
            
            );
            $this->db->set('pos_id', $_SESSION[$this->presession.'id']); 
            $this->db->set('user_creacion', $_SESSION[$this->presession.'id']); 
            $this->db->set('pre_fecha_creacion', 'NOW()', FALSE);            
            $this->db->insert('zis_respuestas_cinco', $data);
        }


      
    }  
    $pla_id=$id;
    $this->actualizar_puntajes($id_grupo,$idev,$pla_id,$pos_id);
    $this->actualizar_conteo($id_grupo,$idev,$pla_id,$pos_id);

        $resultado = $this->db->query("SELECT * FROM 
        zis_seguimiento
        WHERE pos_id=$pos_id and pla_id=$id and  eva_id=$idev and gru_id=$id_grupo")->row();
        // $resultado=$resultado->row();
    //actualizar termino
            //$this->db->set('seg_tiempo_total', $tiempo);  
        //por

    $seg_porcentaje=$this->calculo_porcentaje($id_grupo,$idev,$pos_id);

            $this->db->set('seg_porcentaje',$seg_porcentaje);
            $this->db->set('seg_termino',1);
            $this->db->where('seg_id',$resultado->seg_id);            
            $this->db->update('zis_seguimiento');
    redirect('Prueba_cinco/texto_despedida/'.$idev.'/'.$id_grupo.'/'.$idev); 
    
    
}

// function guardar_preguntas()
// {   
//     redirect('Prueba_tres/preguntas/'.$id.'/'.$id_grupo.'/'.$idev); 
// }

//verificar si la pregunta ya se guardo

function validar_si_pregunta_existe($gru_id,$eva_id,$pos_id,$nro_preg)
{         
    $validar= $this->db->query("SELECT * FROM zis_respuestas_cinco
    WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and pre_nro=$nro_preg ");

    
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
    $validar= $this->db->query("SELECT count(pre_nro) as total_respuestas FROM zis_respuestas_cinco
    WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id ");
    if ($validar->num_rows()==0) {//no existen datos insertar los 18 factores para guardar el baremo gral      
        // echo 'no existen preguntas';
        $porcentaje=0;
    }else{
        // echo 'existe dato';
        $validar=$validar->result_array();
        $porcentaje=$validar[0]['total_respuestas'];
        $porcentaje=($porcentaje*100)/25;
    }
    return $porcentaje;
}

//guardar resultados de las respuestas
function actualizar_puntajes($gru_id,$eva_id,$pla_id,$pos_id)
{   
    $pr= $this->db->query("SELECT * FROM zis_plantilla_e_cinco
        WHERE zpla_id=$pla_id ORDER BY pre_nro asc")->result_array();      

    $re= $this->db->query("SELECT * FROM zis_respuestas_cinco
        WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and zpla_id=$pla_id ORDER BY pre_nro asc")->result_array();

    // var_dump($preguntas,$respuestas);exit();

    //comparando preguntas con respuestas

    for ($i=0; $i < 25; $i++) {  

            //las 1 son las correctas
            //los 0 son las incorrectas
        $val_pa=$pr[$i]['pre_resp_a'];
        $val_pb=$pr[$i]['pre_resp_b'];
        $val_pc=$pr[$i]['pre_resp_c'];

        $val_ra=$re[$i]['resp_a'];
        $val_rb=$re[$i]['resp_b'];
        $val_rc=$re[$i]['resp_c'];

            //valores puntaje 
            //Ra Correcta 1, Errada 2, Omitida 3              
            if ($val_pa == $val_ra) {//0=0 o 1=1
                $puntaje_a=1;
                //echo 'correcta';
            } elseif (($val_pa == 0) && ($val_ra==1)) {
                //echo "errada";
                $puntaje_a=2;
            } elseif (($val_pa == 1) && ($val_ra==0)) {
                //echo "omitida";
                $puntaje_a=3;
            }
            //puntajes b

            if ($val_pb == $val_rb) {//0=0 o 1=1
                $puntaje_b=1;
                //echo 'correcta';
            } elseif (($val_pb == 0) && ($val_rb==1)) {
                //echo "errada";
                $puntaje_b=2;
            } elseif (($val_pb == 1) && ($val_rb==0)) {
                //echo "omitida";
                $puntaje_b=3;
            }

            //puntajes c

            if ($val_pc == $val_rc) {//0=0 o 1=1
                $puntaje_c=1;
                //echo 'correcta';
            } elseif (($val_pc == 0) && ($val_rc==1)) {
                //echo "errada";
                $puntaje_c=2;
            } elseif (($val_pc == 1) && ($val_rc==0)) {
                //echo "omitida";
                $puntaje_c=3;
            }

            $nro_preg=$re[$i]['pre_nro'];

            


            $data = array(                
                'punt_a' => $puntaje_a,
                'punt_b' => $puntaje_b,
                'punt_c' => $puntaje_c,
            );             
            $this->db->where('pre_nro', $nro_preg);
            $this->db->where('zpla_id', $pla_id);
            $this->db->where('eva_id', $eva_id);
            $this->db->where('gru_id', $gru_id);
            $this->db->where('pos_id', $pos_id);
            $this->db->update('zis_respuestas_cinco', $data);

        }

        // echo 'exito';

    }

    //guardar conteo de erradas omitidas
function actualizar_conteo($gru_id,$eva_id,$pla_id,$pos_id)
{      
    //conteo de erradas
    $er_a= $this->db->query("
        SELECT COUNT(punt_a) as conteo
FROM zis_respuestas_cinco
WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and punt_a=2 and zpla_id=$pla_id")->row();
    //conteo de omitidas
    $om_a= $this->db->query("
        SELECT COUNT(punt_a) as conteo
FROM zis_respuestas_cinco
WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and punt_a=3 and zpla_id=$pla_id")->row();

    //conteo de erradas
    $er_b= $this->db->query("
        SELECT COUNT(punt_b) as conteo
FROM zis_respuestas_cinco
WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and punt_b=2 and zpla_id=$pla_id")->row();
    //conteo de omitidas
    $om_b= $this->db->query("
        SELECT COUNT(punt_b) as conteo
FROM zis_respuestas_cinco
WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and punt_b=3 and zpla_id=$pla_id")->row();

    //conteo de erradas
    $er_c= $this->db->query("
        SELECT COUNT(punt_c) as conteo
FROM zis_respuestas_cinco
WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and punt_c=2 and zpla_id=$pla_id")->row();
    //conteo de omitidas
    $om_c= $this->db->query("
        SELECT COUNT(punt_c) as conteo
FROM zis_respuestas_cinco
WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and punt_c=3 and zpla_id=$pla_id")->row();

    // var_dump($er_a->conteo,$er_b->conteo,$er_c->conteo);exit();
    // var_dump($om_a->conteo,$om_b->conteo,$om_c->conteo);exit();

    //comparando preguntas con respuestas


            



    //falta solo actualizar puntajes

        $suma_total=$om_a->conteo+$om_b->conteo+$om_c->conteo+$er_a->conteo+$er_b->conteo+$er_c->conteo;

        $array= $this->db->query("SELECT * FROM
zis_baremo_cinco_ic
WHERE zpla_id=$pla_id")->row();

        $valor_baremo=$array->array_valores;
        $valor_baremo=json_decode($valor_baremo);

        $validar= $this->db->query("SELECT *
FROM zis_respuestas_cinco_puntaje
WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and zpla_id=$pla_id");

        //var_dump($valor_baremo[$suma_total]);exit();
        //actu
        if ($validar->num_rows()==0) {
            // code...
            $data = array(
            'zpla_id' => $pla_id ,
            'gru_id' => $gru_id ,
            'eva_id' => $eva_id ,                       
            'om_a' => $om_a->conteo,
            'om_b' => $om_b->conteo,
            'om_c' => $om_c->conteo,
            'er_a' => $er_a->conteo,
            'er_b' => $er_b->conteo,
            'er_c' => $er_c->conteo,            
            'pos_id' => $pos_id,              
            'o_e' => $suma_total,  
            'pe' => $valor_baremo[$suma_total], 
            );            
            $this->db->set('user_creacion', $_SESSION[$this->presession.'id']); 
            $this->db->set('pre_fecha_creacion', 'NOW()', FALSE);            
            $this->db->insert('zis_respuestas_cinco_puntaje', $data);
        }else{
            $validar=$validar->row();
            $id_puntaje=$validar->pre_id;
            $data = array(
            'zpla_id' => $pla_id ,
            'gru_id' => $gru_id ,
            'eva_id' => $eva_id ,                       
            'om_a' => $om_a->conteo,
            'om_b' => $om_b->conteo,
            'om_c' => $om_c->conteo,
            'er_a' => $er_a->conteo,
            'er_b' => $er_b->conteo,
            'er_c' => $er_c->conteo,            
            'pos_id' => $pos_id,              
            'o_e' => $suma_total,  
            'pe' => $valor_baremo[$suma_total], 
            );            
            
            $this->db->set('user_edicion', $_SESSION[$this->presession.'id']); 
            $this->db->set('pre_fecha_edicion', 'NOW()', FALSE);            
            $this->db->where('pre_id', $id_puntaje);
            $this->db->update('zis_respuestas_cinco_puntaje', $data);
        }

            
        

        // echo 'exito';

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
        $data['contenido'] = $this->load->view('prueba_cinco/texto_despedida', $contenido, true);
        $this->load->view('plantilla_publico_2019',$data);

    }

    function ir_inicio()
    {
        redirect('ninicio');
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

}


?>
