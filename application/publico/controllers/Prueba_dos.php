<?php
// require_once('Controladoradmin.php');
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('America/La_Paz');

class Prueba_dos extends CI_Controller
{
    function __construct()
    {
      parent::__construct();
      force_ssl();
      $this->load->helper(array('url','form','html'));
      $this->load->library(array('form_validation','tool_general'));

         //****** definiendo nombre de carpeta por defecto
      $this->carpeta='prueba_dos/';
      $this->controlador='Prueba_dos/';
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


    $id_usuario=$_SESSION[$this->presession . 'id'];
     

     $resultado = $this->db->query("SELECT * FROM
zis_respuestas_dos
WHERE pos_id='$id_usuario' and eva_id='$ideval' ORDER BY res_nro_resp desc limit 1
        ");

     if ($resultado->num_rows() > 0) {
            //return $resultado->row();
            echo 'verdad';
        }
        else{
            //return false;
            echo 'falso';
        }

        var_dump($idgrupo.'--'.$ideval.'--'.$id_usuario);exit();
     $posicion_actual=$resultado->res_nro_resp;


    

     
   

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
    
    //obtener el tiempo
    $tiempo = $this->db->query("SELECT seg_tiempo_total,seg_id FROM zis_seguimiento WHERE pos_id='$id_usuario' and eva_id='$idev' and gru_id='$id_grupo'");

    

    if ($tiempo->num_rows() > 0) {
        $tiempo=$tiempo->result_array();
        $id_seg=$tiempo[0]['seg_id'];
        // var_dump($id_seg);exit();
        $tiempo=$tiempo[0]['seg_tiempo_total'];
        $valor_tiempo=explode(":",$tiempo);
        $tiempo_cronometro=[$valor_tiempo[0],$valor_tiempo[1],$valor_tiempo[2]];
        //var_dump($tiempo_cronometro);exit();
        //guardar id_plantilla
        
        $this->db->set('pla_id',$id_pla);            
        $this->db->where('seg_id', $id_seg);    
        $this->db->update('zis_seguimiento');

        
    }else{
        $tiempo_cronometro=[0,0,0];
    }

     $resultado = $this->db->query("SELECT * FROM zis_respuestas_dos WHERE pos_id='$id_usuario' and eva_id='$idev' and gru_id='$id_grupo' ORDER BY res_nro_resp desc limit 1
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

        //var_dump($idgrupo.'--'.$ideval.'--'.$id_usuario);exit();
     
    if ($posicion!=1) {        
        $num_ini=$posicion+1;
        $num_fin=$num_ini+15;
        $grup_ini=($posicion/4)+1;
    }
    else{
        $num_ini=1;
        $num_fin=16;
        $grup_ini=1;
    }
    //var_dump($msj);exit();

    $resultado = $this->db->query("SELECT * from zis_plantilla_e_dos WHERE zpla_id=$id_pla and  pre_nro BETWEEN $num_ini and $num_fin ORDER BY pre_nro ASC
        ");
    $data=$resultado->result_array();

    // $contenido['action'] = $this->controlador. 'preguntas/'.$id.'/'.$num_fin.'/'.$idev;
    
    $contenido['num_ini'] = $num_ini;
    $contenido['num_fin'] = $num_fin;
    $contenido['grup_ini'] = $grup_ini;    
    $contenido['data'] = $data;  
    $contenido['tc'] = $tiempo_cronometro; 
    // var_dump($tiempo_cronometro);exit();

    if ($posicion==80) {
        // code...
        redirect($this->controladorE.'texto_despedida/'.$idev); 
    }
    else{
        $data['contenido'] = $this->load->view($this->carpeta.'vista_previa_preguntas', $contenido, true);
        $this->load->view('plantilla_publico_2019', $data);
    }

}

function guardar_preguntas()
{      
    $tiempo = $this->input->post('tiempo');
    // var_dump($tiempo);exit();
    $id = $this->input->post('id_pla');
    $id_grupo = $this->input->post('id_grupo');
    $idev = $this->input->post('idev');
    $num_ini = $this->input->post('num_ini');
    $num_fin = $this->input->post('num_fin');
    $id_usuario=$_SESSION[$this->presession . 'id'];
    //var_dump($p1,$id,$num_ini,$num_fin);exit();        
    for ($i=$num_ini; $i <=$num_fin ; $i++) { 
        // code...
        //validar si pregunta ya existe
        $sw=$this->validar_si_pregunta_existe($id_grupo,$idev,$id_usuario,$i);
        if ($sw==0) {//solo inserta si no existe
              $data = array(
            'pos_id' => $id_usuario ,
            'gru_id' => $id_grupo ,
            'eva_id' => $idev ,
            'res_nro_resp' => $i,
            'res_resp' => $this->input->post('p'.$i),
                );
            $this->db->set('res_fecha_creacion', 'NOW()', FALSE);            
            $this->db->insert('zis_respuestas_dos', $data);
        }
    }

    //guardamos los datos en seguimiento
    $resultado = $this->db->query("SELECT * FROM 
zis_seguimiento
WHERE pos_id=$id_usuario and eva_id=$idev and gru_id=$id_grupo");

     if ($resultado->num_rows() > 0) {
            $resultado = $resultado->row();
            // $seg_intentos=$resultado->$seg_intentos;
            //$seg_porcentaje=$resultado->seg_porcentaje;
            $seg_tiempo_total=$resultado->seg_tiempo_total;

            // $seg_intentos=$seg_intentos+1;
            //$seg_porcentaje=$seg_porcentaje+20;
            // if ($resultado->seg_tiempo_total=='00:00:00') {
            //     $seg_tiempo_total=strtotime($tiempo);
            // }else{
                
            //     $tiempo_bd= date('H:i:s',strtotime($seg_tiempo_total));
            //     $tiempo_dos=  date('H:i:s',strtotime($tiempo));

            //     $seg_tiempo_total=date('H:i:s',strtotime($tiempo_bd)+strtotime($tiempo_dos)- strtotime('00:00:00'));
            // // var_dump($tiempo_bd,$tiempo_dos,$tiempo_total);exit();
            // }
            // 
            
            // $seg_porcentaje=$seg_porcentaje+5.88;
            $seg_porcentaje=$this->calculo_porcentaje($id_grupo,$idev,$id_usuario);

            $data_seg = array(
            // 'seg_intentos' => $id_usuario ,
            'seg_porcentaje' => $seg_porcentaje ,
            // 'seg_tiempo_total' => $tiempo ,           
        );

        $this->db->set('seg_fecha_edicion', 'NOW()', FALSE);            
        $this->db->where('seg_id', $resultado->seg_id);    
        $this->db->update('zis_seguimiento', $data_seg);
            // echo 'verdad';
    }
        

    if ($num_fin==80) {
        // code...
        $this->db->set('seg_termino', 1);            
        $this->db->where('seg_id', $resultado->seg_id);    
        $this->db->update('zis_seguimiento');
        // redirect('ninicio'); 
        redirect('Prueba_dos/texto_despedida/'.$id.'/'.$id_grupo.'/'.$idev); 
    }else{
        redirect('Prueba_dos/preguntas/'.$id.'/'.$id_grupo.'/'.$idev); 

    }

}


//verificar si la pregunta ya se guardo

function validar_si_pregunta_existe($gru_id,$eva_id,$pos_id,$nro_preg)
{         
    $validar= $this->db->query("SELECT * FROM zis_respuestas_dos
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
    $validar= $this->db->query("SELECT count(res_nro_resp) as total_respuestas FROM zis_respuestas_dos
    WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id ");
    if ($validar->num_rows()==0) {//no existen datos insertar los 18 factores para guardar el baremo gral      
        // echo 'no existen preguntas';
        $porcentaje=0;
    }else{
        // echo 'existe dato';
        $validar=$validar->result_array();
        $porcentaje=$validar[0]['total_respuestas'];
        $porcentaje=($porcentaje*100)/80;
    }
    return $porcentaje;
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