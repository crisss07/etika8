<?php
require_once('Controladoradmin.php');

class Prueba_tres extends Controladoradmin
{
    function __construct()
    {
      parent::__construct();
      force_ssl();
      $this->load->helper(array('url','form','html'));
      $this->load->library(array('form_validation','tool_general'));

         //****** definiendo nombre de carpeta por defecto
      $this->carpeta='plantilla/';
      $this->controlador='Prueba_tres/';

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
      if($_SESSION[$this->presession.'permisos']>='2') {
        redirect('inicio');
    }
}       
//texto 2 instructivo prueba
function texto_prueba($id=null)
{
    //var_dump($id);exit();
    $this->cabecera['accion']='Texto Instructivo I'; 

    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id;
   // $contenido['tipo'] = $tipo;
    $data['contenido'] = $this->load->view('preg_tres/texto_instructivo_prueba', $contenido, true);

    $this->load->view('plantilla_privado',$data);
}
//guardar el texto instructivo de prueba
function upd_texto_prueba()
{      
    $texto_instructivo = $this->input->post('texto_instructivo');
    $id = $this->input->post('id');

    //var_dump($id,$texto_instructivo);exit();
    
    
    $data = array(
        'zpla_texto_instructivo_prueba' => $texto_instructivo ,
    );
    $this->db->where('zpla_id', $id);         
    $this->db->update('zis_plantillas', $data);

    // redirect('Prueba_dos/preguntas/'.$id);    
    redirect('Prueba_tres/preguntas_prueba/'.$id);    
}
//crear preguntas de prueba

function preguntas_prueba($id)
{      
    $this->cabecera['accion']='Preguntas de Prueba'; 
    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id;

    $data['contenido'] = $this->load->view('preg_tres/preguntas_prueba', $contenido, true);
    $this->load->view('plantilla_privado',$data);  
}
//vista preguntas de prueba
function vistapregunta_prueba($id)
{      
    $this->cabecera['accion']='Preguntas de Prueba'; 
    $this->db->order_by('prueba_nro','ASC'); 
    $this->db->where('zpla_id', $id);         
    $preguntas=$this->db->get('zis_plantilla_p_tres');
    // var_dump($preguntas->result_array());exit();


    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id;
    $contenido['preguntas'] = $preguntas->result_array();

    $data['contenido'] = $this->load->view('preg_tres/vista_preguntas_prueba', $contenido, true);
    $this->load->view('plantilla_privado',$data);  
}

//insertar preguntas de prueba
function crear_preguntas_prueba()
{
    // despues de guardar los datos se abre el form de texto instructivo
    $id = $this->input->post('id');
    //var_dump($id);exit();

    for ($i=1; $i <=3 ; $i++) { 
        // code...
        $data = array(
            'zpla_id' => $id ,
            'prueba_nro' => $i,
            'prueba_texto' => $this->input->post('p'.$i),
            'prueba_a' => $this->input->post($i.'a'),
            'prueba_b' => $this->input->post($i.'b'),
            'prueba_c' => $this->input->post($i.'c'),
        );
        $this->db->set('prueba_fecha_creacion', 'NOW()', FALSE);            
        $this->db->set('prueba_user_creacion', 'NOW()', FALSE);
        $this->db->insert('zis_plantilla_p_tres', $data);
    }    
    
    // redirect('Prueba_dos/texto_despedida/'.$id); 
    redirect('Prueba_tres/texto_dos/'.$id); 
}
//texto instructivo II
function texto_dos($id=null)
{
    //var_dump($id);exit();
    $this->cabecera['accion']='Texto Instructivo II'; 

    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id;
   // $contenido['tipo'] = $tipo;
    $data['contenido'] = $this->load->view('preg_tres/texto_instructivo', $contenido, true);

    $this->load->view('plantilla_privado',$data);
}
//guardar el texto instructivo II
function upd_texto_ii()
{      
    $texto_instructivo = $this->input->post('texto_instructivo');
    $id = $this->input->post('id');

    //var_dump($id,$texto_instructivo);exit();
    
    
    $data = array(
        'zpla_texto_instructivo' => $texto_instructivo ,
    );
    $this->db->where('zpla_id', $id);         
    $this->db->update('zis_plantillas', $data);

    // redirect('Prueba_dos/preguntas/'.$id);    
    redirect('Prueba_tres/preguntas/'.$id);    
}
//ver texto instructivo II
function ver_instructivo_ii($id=null)
{
    //var_dump($id);exit();
    $this->cabecera['accion']='Texto Instructivo II'; 

    $this->db->where('zpla_id', $id);         
    $data_pla=$this->db->get('zis_plantillas')->row();

    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id;
    $contenido['data_pla'] = $data_pla;
    $contenido['posicion'] = 1;

    $data['contenido'] = $this->load->view('preg_tres/ver_texto_instructivo', $contenido, true);

    $this->load->view('plantilla_privado',$data);
}
//preguntas para la pruebas

function preguntas($id)
{      
    $this->cabecera['accion']='Preguntas'; 
    $this->db->order_by('factor_id', 'ASC');
    $this->db->where('tipo =', 1);
    $factores = $this->db->get('zis_factor')->result();
    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id;
    $resultado = $this->db->query("SELECT * from zis_plantilla_e_tres WHERE zpla_id=$id ORDER BY pre_nro DESC LIMIT 1");
    if ($resultado->num_rows()>0) {
        $consulta =$resultado->row();
        $ultimo_nro=$consulta->pre_nro;
        $num_ini=$ultimo_nro+1;
        $num_fin=$num_ini+9;       
    }
    else{
        $num_ini=1;
        $num_fin=10;        
    }

    //var_dump($msj);exit();

    $contenido['num_ini'] = $num_ini;
    $contenido['num_fin'] = $num_fin;
    $contenido['factores'] = $factores;
    $data['contenido'] = $this->load->view('preg_tres/preguntas', $contenido, true);
    $this->load->view('plantilla_privado',$data);  
}
function ver_preguntas($id=null,$posicion=null)
{      
    $this->cabecera['accion']='Preguntas'; 
    $this->db->where('tipo =', 1);
    $factores = $this->db->get('zis_factor')->result();
    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id;   
    
    if ($posicion!=1) {
        $num_ini=$posicion+1;
        $num_fin=$num_ini+9;
    }
    else{
        $num_ini=1;
        $num_fin=10;        
    }
    $resultado = $this->db->query("SELECT p.*,f.letra from zis_plantilla_e_tres p
        LEFT JOIN
        zis_factor f
        on p.factor_id=f.factor_id
        WHERE p.zpla_id=$id and p.pre_nro BETWEEN $num_ini and $num_fin
        ORDER BY p.pre_nro ASC")->result_array();  
    //var_dump($posicion);exit();
    $contenido['num_ini'] = $num_ini;
    $contenido['num_fin'] = $num_fin;
    $contenido['factores'] = $factores;
    $contenido['datos'] = $resultado;
    if ($posicion==170) {
        // code...
        redirect('Plantilla/texto_despedida/'.$id); 
    }else{
        $data['contenido'] = $this->load->view('preg_tres/ver_preguntas', $contenido, true);

    }     
    $this->load->view('plantilla_privado',$data);  
}






    // crear

function crear_preguntas()
{
        // despues de guardar los datos se abre el form de texto instructivo


    $id = $this->input->post('id');
    // $in1 = $this->input->post('in1');
    // $aq1 = $this->input->post('aq1');
    $num_ini = $this->input->post('num_ini');
    $num_fin = $this->input->post('num_fin');
    //var_dump($num_ini,$num_fin);exit();

    for ($i=$num_ini; $i <=$num_fin ; $i++) { 
        $pregunta=$this->input->post('p'.$i);
        $factor=$this->input->post('factor'.$i);

        $in = $this->input->post('in'.$i);
        $aq = $this->input->post('aq'.$i);
        if ($this->input->post('in'.$i)==null) {//verifica si esta nulo
            $in=0;
        }
        if ($this->input->post('aq'.$i)==null) {//verifica si esta nulo
            $aq=0;
        }
        // code...
        $data = array(
            'zpla_id' => $id ,
            'pre_nro' => $i,
            'pre_texto' => $pregunta,
            'pre_resp_a' => $this->input->post('a'.$i),
            'pre_resp_b' => $this->input->post('b'.$i),
            'pre_resp_c' => $this->input->post('c'.$i),
            'factor_id' => $this->input->post('factor'.$i),
            'valor_a' => $this->input->post('fa'.$i),
            'valor_b' => $this->input->post('fb'.$i),
            'valor_c' => $this->input->post('fc'.$i),
            'valor_in' => $in,
            'aq' => $aq,
        );
        $this->db->set('pre_fecha_creacion', 'NOW()', FALSE);            
        $this->db->set('user_creacion', $_SESSION[$this->presession.'id']);  
        $this->db->insert('zis_plantilla_e_tres', $data);
    }
    if ($num_fin==170) {
        // code...
        redirect('Prueba_tres/texto_despedida/'.$id); 
    }else{
        redirect('Prueba_tres/preguntas/'.$id); 

    }
}

//edicion prueba tres
function editar_plantilla($id_pla=null)
{   
    // redirect('Prueba_tres/editar_preguntas/'.$id_pla.'/1');    
    redirect('Prueba_tres/listado_opciones_edicion/'.$id_pla);    
}


function editar_preguntas($id=null,$posicion=null)
{      
    if ($posicion>170) {
        redirect('Prueba_tres/editar_preguntas/'.$id.'/1'); 
    }else{

        $this->cabecera['accion']='Preguntas'; 
        $this->db->order_by('factor_id', 'ASC');
        $this->db->where('tipo =', 1);
        $factores = $this->db->get('zis_factor')->result();
        $contenido['cabecera']=$this->cabecera;
        $contenido['id'] = $id;   

        if ($posicion!=1) {
            $num_ini=$posicion+1;
            $num_fin=$num_ini+9;
        }
        else{
            $num_ini=1;
            $num_fin=10;        
        }
        $resultado = $this->db->query("SELECT p.*,f.letra from zis_plantilla_e_tres p
            LEFT JOIN
            zis_factor f
            on p.factor_id=f.factor_id
            WHERE p.zpla_id=$id and p.pre_nro BETWEEN $num_ini and $num_fin
            ORDER BY p.pre_nro ASC");
            if ($resultado->num_rows()==0) {
                    $this->crear_preguntas_validar($id,$num_ini,$num_fin);
                    $resultado = $this->db->query("SELECT p.*,f.letra from zis_plantilla_e_tres p
            LEFT JOIN
            zis_factor f
            on p.factor_id=f.factor_id
            WHERE p.zpla_id=$id and p.pre_nro BETWEEN $num_ini and $num_fin
            ORDER BY p.pre_nro ASC");
            }
    //var_dump($posicion);exit();
        $contenido['num_ini'] = $num_ini;
        $contenido['num_fin'] = $num_fin;
        $contenido['factores'] = $factores;
        $contenido['datos'] = $resultado->result_array();
        if ($posicion==170) {
        // code...
            redirect('Plantilla/texto_despedida/'.$id); 
        }else{
            $data['contenido'] = $this->load->view('preg_tres/editar_preguntas', $contenido, true);

        }     
        $this->load->view('plantilla_privado',$data);  
    }
}
//crear preguntas en caso de nulo
function crear_preguntas_validar($id,$num_ini,$num_fin)
{
    for ($i=$num_ini; $i <=$num_fin ; $i++) { 
        // code...
        $resultado = $this->db->query("SELECT * from zis_plantilla_e_tres            
            WHERE zpla_id=$id and pre_nro=$i");
        if ($resultado->num_rows()==0) {
            $data = array(
            'zpla_id' => $id ,
            'pre_nro' => $i,
            'pre_texto' => '',
            'pre_resp_a' => '',
            'pre_resp_b' => '',
            'pre_resp_c' => '',
            'factor_id' => 1,
            'valor_a' => 0,
            'valor_b' => 1,
            'valor_c' => 0,
            'valor_in' => 0,
            'aq' => 0,
        );
        $this->db->set('pre_fecha_creacion', 'NOW()', FALSE);            
        $this->db->set('user_creacion', $_SESSION[$this->presession.'id']);  
        $this->db->insert('zis_plantilla_e_tres', $data);
        }
        
    }
    
}
//actualizar preguntas
function update_preguntas()
{
        // despues de guardar los datos se abre el form de texto instructivo


    $id = $this->input->post('id');
    $in1 = $this->input->post('in2');
    $aq1 = $this->input->post('aq2');
    $num_ini = $this->input->post('num_ini');
    $num_fin = $this->input->post('num_fin');
    //var_dump($num_ini,$num_fin,$in1,$aq1);exit();

    for ($i=$num_ini; $i <=$num_fin ; $i++) { 
        $pregunta=$this->input->post('p'.$i);
        $factor=$this->input->post('factor'.$i);

        $in = $this->input->post('in'.$i);
        $aq = $this->input->post('aq'.$i);
        if ($this->input->post('in'.$i)==null) {//verifica si esta nulo
            $in=0;
        }
        if ($this->input->post('aq'.$i)==null) {//verifica si esta nulo
            $aq=0;
        }
        // code...
        $data = array(

            'pre_nro' => $i,
            'pre_texto' => $pregunta,
            'pre_resp_a' => $this->input->post('a'.$i),
            'pre_resp_b' => $this->input->post('b'.$i),
            'pre_resp_c' => $this->input->post('c'.$i),
            'factor_id' => $this->input->post('factor'.$i),
            'valor_a' => $this->input->post('fa'.$i),
            'valor_b' => $this->input->post('fb'.$i),
            'valor_c' => $this->input->post('fc'.$i),
            'valor_in' => $in,
            'aq' => $aq,
        );
        $this->db->set('pre_fecha_edicion', 'NOW()', FALSE);            
        $this->db->set('user_edicion', $_SESSION[$this->presession.'id']);  
        $this->db->where('pre_nro', $i);
        $this->db->where('zpla_id', $id);
        $this->db->update('zis_plantilla_e_tres', $data);
    }
    if ($num_fin==170) {
        // code...
        redirect('Prueba_tres/texto_despedida/'.$id); 
    }else{
        redirect('Prueba_tres/editar_preguntas/'.$id.'/'.$num_fin); 

    }
}

//update  factor
function update_factores($id_pla=null)
{
    $this->db->order_by('pre_nro','asc');
    $data=$this->db->get('zis_plantilla_e_tres')->result_array();
    //var_dump($data[0]);exit();

    
    $factores=$this->db->get('zis_factor')->result_array();
    //var_dump($factores[0]['letra']);exit();

    for ($i=0; $i <count($factores) ; $i++) { 
        $this->db->set('factor_id', $factores[$i]['factor_id']);
        $this->db->where('factor_letra', $factores[$i]['letra']);
        $this->db->update('zis_plantilla_e_tres');
    }
    echo 'exito';
}

function update_factores_cantidad_tipo_uno($pla_id)
{
    $this->db->order_by('pre_nro','asc');
    $data=$this->db->get('zis_plantilla_e_tres')->result_array();
    //var_dump($data[0]);exit();

    $this->db->where('tipo =',1);
    $factores=$this->db->get('zis_factor')->result_array();
    //var_dump($factores[0]['letra']);exit();

    $user=$_SESSION[$this->presession.'id'];
    for ($i=0; $i <count($factores) ; $i++) { 
        $id_factor=$factores[$i]['factor_id'];
        $total=$this->db->query("SELECT COUNT(factor_id)as total FROM zis_plantilla_e_tres WHERE zpla_id=$pla_id and factor_id=$id_factor")->row();
        //var_dump($total);exit();
        $this->db->set('pre_fecha_creacion', 'NOW()', FALSE);  
        $this->db->set('user_creacion', $user); 
        $this->db->set('cantidad_preguntas',$total->total);
        $this->db->where('factor_id', $id_factor);
        $this->db->where('zpla_id', $pla_id);
        $this->db->update('zis_baremo_factor');
    }
    echo 'exito';
}

function update_factores_cantidad_tipo_dos($pla_id)
{
    

    $this->db->where('tipo =',2);
    $factores=$this->db->get('zis_factor')->result_array();
    //var_dump($factores[0]['letra']);exit();
    $user=$_SESSION[$this->presession.'id'];
    
        $id_factor=$factores[0]['factor_id'];
        $total=$this->db->query("SELECT SUM(valor_in)as total FROM zis_plantilla_e_tres WHERE zpla_id=$pla_id")->row();
        //var_dump($total);exit();
        $this->db->set('pre_fecha_creacion', 'NOW()', FALSE);  
        $this->db->set('user_creacion', $user); 
        $this->db->set('cantidad_preguntas',$total->total);
        $this->db->where('factor_id', $id_factor);
        $this->db->where('zpla_id', $pla_id);
        $this->db->update('zis_baremo_factor');

        $id_factor=$factores[1]['factor_id'];
        $total=$this->db->query("SELECT SUM(aq)as total FROM zis_plantilla_e_tres WHERE zpla_id=$pla_id")->row();
        //var_dump($total);exit();
        $this->db->set('pre_fecha_creacion', 'NOW()', FALSE);  
        $this->db->set('user_creacion', $user);
        $this->db->set('cantidad_preguntas',$total->total);
        $this->db->where('factor_id', $id_factor);
        $this->db->where('zpla_id', $pla_id);
        $this->db->update('zis_baremo_factor');
    
    echo 'exito';
}

function crear_factores_tabla_factores($pla_id)
{
    
    //var_dump($data[0]);exit();

    
    $factores=$this->db->get('zis_factor')->result_array();
    //var_dump($factores[0]['letra']);exit();
    $user_creacion=$_SESSION[$this->presession.'id'];
    for ($i=0; $i <count($factores) ; $i++) { 
        $id_factor=$factores[$i]['factor_id'];
        $letra=$factores[$i]['letra'];
        $total=$this->db->query("SELECT * FROM zis_baremo_factor WHERE zpla_id=$pla_id and factor_id=$id_factor");
        //var_dump($total->num_rows());exit();
         if ($total->num_rows()==0) {//no tiene datos              
            $this->db->set('pre_fecha_creacion', 'NOW()', FALSE);
            $this->db->set('user_creacion',$user_creacion);
            $this->db->set('cantidad_preguntas',0);
            $this->db->set('letra', $letra);
            $this->db->set('factor_id', $id_factor);
            $this->db->set('zpla_id', $pla_id);
            $this->db->insert('zis_baremo_factor');
         }
        
    }
    echo 'exito';
}

function update_factores_cantidad_old()
{
    $this->db->order_by('pre_nro','asc');
    $data=$this->db->get('zis_plantilla_e_tres')->result_array();
    //var_dump($data[0]);exit();

    
    $factores=$this->db->get('zis_factor')->result_array();
    //var_dump($factores[0]['letra']);exit();

    for ($i=0; $i <count($factores) ; $i++) { 
        $id_factor=$factores[$i]['factor_id'];
        $total=$this->db->query("SELECT COUNT(factor_id)as total FROM zis_plantilla_e_tres WHERE zpla_id=56 and factor_id=$id_factor")->row();
        //var_dump($total);exit();
        $this->db->set('cantidad',$total->total);
        $this->db->where('factor_id', $id_factor);
        $this->db->update('zis_factor');

    }
    echo 'exito';
}





function texto_despedida($id=null)
{
    //var_dump($id);exit();
    $this->cabecera['accion']='Texto Despedida'; 

    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id;
   // $contenido['tipo'] = $tipo;
    $data['contenido'] = $this->load->view('preg_tres/texto_despedida', $contenido, true);

    $this->load->view('plantilla_privado',$data);
}

//crear baremo
function vista_baremo($id_pla=null,$sw=null)
{
    //var_dump($id);exit();
    $this->cabecera['accion']='Crear Baremo';     

    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id_pla;
    
    $this->db->order_by('factor_id', 'ASC');
    // $this->db->where('zpla_id =', $id_pla);
    // $this->db->where('tipo =', 1);
    $factores = $this->db->get('zis_factor');
    $contenido['factores'] = $factores->result_array();
    $contenido['factores_st'] = $factores->result();

    //antes se actualiza o se crea la cantidad de los baremos
    // solo cuando ingresa desde la plantilla
    //en caso de q se redirija aca despues de guardar un valor baremo no ingresa
    if($sw==1){
        $this->actualizarcantidad_factores_por_plantilla($id_pla);
    }
    $data['contenido'] = $this->load->view('preg_tres/vista_crear_baremo', $contenido, true);

    $this->load->view('plantilla_privado',$data);
}
function actualizarcantidad_factores_por_plantilla($id_pla=null){
    $this->crear_factores_tabla_factores($id_pla);
    $this->update_factores_cantidad_tipo_uno($id_pla);
    $this->update_factores_cantidad_tipo_dos($id_pla);
}


function vista_ajax_factor()
{
    //var_dump($id);exit();



    $id_plantilla = $this->input->post('id_plantilla');
    $factor_id = $this->input->post('factor_id');

    // $id_plantilla = 56;
    // $factor_id = 1;
    
    
    $this->db->where('factor_id',$factor_id );
    $factores = $this->db->get('zis_factor');
    $tipo=$factores->row();
    if ($tipo->tipo==1) {//tipo1
         

        $valor_baremo= $this->db->query("SELECT cantidad_preguntas,array_valores as valor,letra FROM  zis_baremo_factor WHERE factor_id=$factor_id and zpla_id=$id_plantilla");    
        $valor=$valor_baremo->row();
        $array_valores=$valor->valor;  
        // ($cantidad_factor->cantidad_preguntas)==0 || 
        $bandera=0;
        if (($valor->cantidad_preguntas)==0 || ($array_valores)==NULL || ($array_valores)=="") {
            $bandera=1;
        }
        $cantidad_factor=$valor->cantidad_preguntas;  
        //var_dump($bandera);exit();

        // $valor= $this->db->query("SELECT array_valores as valor FROM  zis_baremo_factor WHERE factor_id=$factor_id and zpla_id=$id_plantilla")->result_array();    
        
        // $cantidad_factor=$valor[0]['cantidad'];    

        if ($bandera==1) {//no tiene datos
            $valores=[];
            for ($i=0; $i <= ($cantidad_factor*2); $i++) { 
             array_push($valores,0);         
            }
        }else{
            //$valores=$valor->result_array();  
            $valores=json_decode($array_valores);      

        }   

        $data['factor_ajax'] = $valor_baremo->result_array();
        $data['id_plantilla'] = $id_plantilla;
        $data['factor_id'] = $factor_id;
        $data['val_factor'] = $valores;
        $response=$this->load->view('preg_tres/baremo_ajax',$data,TRUE);
    }else{//tipo2
        
        $valor_baremo= $this->db->query("SELECT cantidad_preguntas,array_valores as valor,letra FROM  zis_baremo_factor WHERE factor_id=$factor_id and zpla_id=$id_plantilla");    
        $valor=$valor_baremo->row();
        $array_valores=$valor->valor;  
        // ($cantidad_factor->cantidad_preguntas)==0 || 
        $bandera=0;
        if (($valor->cantidad_preguntas)==0 || ($array_valores)==NULL || ($array_valores)=="") {
            $bandera=1;
        }
        $cantidad_factor=$valor->cantidad_preguntas;  
        //var_dump($bandera);exit();

        // $valor= $this->db->query("SELECT array_valores as valor FROM  zis_baremo_factor WHERE factor_id=$factor_id and zpla_id=$id_plantilla")->result_array();    
        
        // $cantidad_factor=$valor[0]['cantidad'];    

        if ($bandera==1) {//no tiene datos
            $valores=[];
            for ($i=0; $i <= ($cantidad_factor*2); $i++) { 
             array_push($valores,0);         
            }
        }else{
            //$valores=$valor->result_array();  
            $valores=json_decode($array_valores);      

        }   

        $data['factor_ajax'] = $valor_baremo->result_array();
        $data['id_plantilla'] = $id_plantilla;
        $data['factor_id'] = $factor_id;
        $data['val_factor'] = $valores;
        // $response=$this->load->view('preg_tres/baremo_ajax',$data,TRUE);
        $response=$this->load->view('preg_tres/baremo_ajax_tipo_dos',$data,TRUE);

    }



    echo $response;  


}


function vista_ajax_factores()
{
    //var_dump($id);exit();
    $this->db->where('factor_id',1 );
    $factores = $this->db->get('zis_factor');

    $valor= $this->db->query('SELECT array_valores as valor FROM  zis_baremo_factor WHERE factor_id=1');    
    $cantidad_factor=$factores->result_array();
    $cantidad_factor=$cantidad_factor[0]['cantidad'];    
    
    if ($valor->num_rows()==0) {//no tiene datos
        $valores=[];
        for ($i=0; $i <= ($cantidad_factor*2); $i++) { 
         array_push($valores,0);         
     }
 }else{
    $valores=$valor->result_array();  
    $valores=json_decode($valores[0]['valor']);      

}   
    //var_dump($valores[22]);exit();
$data['factor_ajax'] = $factores->result_array();
$data['id_plantilla'] = $id_plantilla;
$data['factor_id'] = $factor_id;
    //$data['valores_ajax_factor'] = $valores;
$response=$this->load->view('preg_tres/baremo_ajax',$data,TRUE);
echo $response;  
}

function crear_baremo()
{      
    $id_pla = $this->input->post('id_pla');
    $cantidad_factor = $this->input->post('cantidad_factor');
    $letra_factor = $this->input->post('letra_factor');
    $factor_id = $this->input->post('factor_id');

    $user=$_SESSION[$this->presession.'id'];
    
    $valores=[];
    for ($i=0; $i <= ($cantidad_factor*2); $i++) {     
     $puntaje = $this->input->post('factor'.$i);
         //$puntaje = array($i=>$puntaje);    
     array_push($valores,$puntaje);

    }
    // var_dump(json_encode($valores[22]));exit();

    //solo insertar una vez

 // $validar= $this->db->query("SELECT array_valores as valor FROM  zis_baremo_factor
 //    WHERE zpla_id=$id_pla and factor_id=$factor_id");

    // if ($validar->num_rows()>0) {//exite datos update
        $this->db->set('pre_fecha_edicion', 'NOW()', FALSE);  
        $this->db->set('user_edicion', $user);
        $this->db->set('array_valores', json_encode($valores));
        $this->db->where('zpla_id', $id_pla);
        $this->db->where('factor_id', $factor_id);
        $this->db->update('zis_baremo_factor');
    // }
    // else{
    //     $data = array(
    //         'zpla_id' => $id_pla,
    //         'factor_id' => $factor_id,
    //         'letra' => $letra_factor,
    //         'cantidad_preguntas' => $cantidad_factor,        
    //         'array_valores' => json_encode($valores),
    //     );             
    //     $this->db->insert('zis_baremo_factor', $data);
    // }
   
    redirect('Prueba_tres/vista_baremo/'.$id_pla);
}

function crear_baremo_dos()
{      
    $id_pla = $this->input->post('id_pla');
    $cantidad_factor = $this->input->post('cantidad_factor');
    $letra_factor = $this->input->post('letra_factor');
    $factor_id = $this->input->post('factor_id');
    
    $user=$_SESSION[$this->presession.'id'];
    $valores=[];
    for ($i=0; $i <= ($cantidad_factor); $i++) {     
     $puntaje = $this->input->post('factor'.$i);
         //$puntaje = array($i=>$puntaje);    
     array_push($valores,$puntaje);

    }   
        $this->db->set('pre_fecha_edicion', 'NOW()', FALSE);  
        $this->db->set('user_edicion', $user);
        $this->db->set('array_valores', json_encode($valores));
        $this->db->where('zpla_id', $id_pla);
        $this->db->where('factor_id', $factor_id);
        $this->db->update('zis_baremo_factor');
   
    redirect('Prueba_tres/vista_baremo/'.$id_pla);
}

function guardar_baremo_gral_respuestas()
{      
    $gru_id=1;
    $eva_id=20;
    $pla_id=56;
    $pos_id=30548;  

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
                WHERE pos_id=$pos_id and gru_id=1 and eva_id=20
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

//calculo tabla sociabilidad etc
function guardar_tabla_calculo_sec()
{      
    $gru_id=1;
    $eva_id=20;
    $pla_id=56;
    $pos_id=30548;  
    $validar= $this->db->query("SELECT * FROM zis_resp_tres_calculo_sec
        WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and zpla_id=$pla_id");

    $tab_bar= $this->db->query("SELECT x.* FROM
        (SELECT * FROM
        zis_resp_tres_baremogral
        WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=20 ORDER BY factor_id) x
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

//calculo de los valores para el grafico

function calculo_valores_totales()
{      
    $gru_id=1;
    $eva_id=20;
    $pla_id=56;
    $pos_id=30548;  
    $array_valores_totales=[];
    $tabla_calculo_est= $this->db->query("SELECT * FROM zis_resp_tres_calculo_sec
        WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and zpla_id=$pla_id")->result_array();


    $validar= $this->db->query("SELECT * FROM zis_respuestas_tres_total_gral
        WHERE pos_id=$pos_id and gru_id=$gru_id and eva_id=$eva_id and zpla_id=$pla_id");

    $tab_bar= $this->db->query("SELECT x.de,x.factor_letra,y.descripcion FROM
        (SELECT * FROM
        zis_resp_tres_baremogral
        WHERE pos_id=30548 and gru_id=1 and eva_id=20 ORDER BY factor_id) x
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
        WHERE pos_id=30548 and gru_id=1 and eva_id=20 ORDER BY factor_id) x
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

//edicion
function listado_opciones_edicion($id_pla=null)
{
    $resultado = $this->db->query("SELECT * from zis_plantillas
        WHERE zpla_id=$id_pla ")->result_array();
    $this->cabecera['accion']=$resultado[0]['zpla_titulo']; 
    //var_dump($resultado->zpla_texto_bienvenida);exit();
    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id_pla;
    $contenido['resultado'] = $resultado;
    
    $data['contenido'] = $this->load->view('preg_tres/lista_edicion', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}
function vista_edicion_titulo($id_pla=null)
{
    $resultado = $this->db->query("SELECT * from zis_plantillas
        WHERE zpla_id=$id_pla ")->row();
    $this->cabecera['accion']='Edicion Titulo'; 
    //var_dump($resultado->zpla_texto_bienvenida);exit();
    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id_pla;
    $contenido['valor_texto'] = $resultado->zpla_titulo;
    
    $data['contenido'] = $this->load->view('preg_tres/editar_titulo', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}

function updt_titulo()
{      
    $titulo = $this->input->post('titulo');
    $id = $this->input->post('id_pla');

    //var_dump($id,$texto_instructivo);exit();
    
    
    $data = array(
        'zpla_titulo' => $titulo ,
    );
    $this->db->where('zpla_id', $id);         
    $this->db->update('zis_plantillas', $data);

    redirect('Prueba_tres/listado_opciones_edicion/'.$id);    
}
function vista_edicion_texto($id_pla=null,$opc=null)
{
    $resultado = $this->db->query("SELECT * from zis_plantillas
        WHERE zpla_id=$id_pla ")->row();
    if ($opc==1) {
        $val1='Edicion Texto de bienvenida';
        $val2='upd_texto_bienvenida';
        $val3='Texto de bienvenida:';
        $val4=$resultado->zpla_texto_bienvenida;
    }
    if ($opc==2) {
        $val1='Edicion Texto Instrucción I:';
        $val2='upd_texto_instructivo_i';
        $val3='Texto Instrucción I:';
        $val4=$resultado->zpla_texto_instructivo_prueba;
    }
    if ($opc==3) {
        $val1='Edicion Texto Instrucción II:';
        $val2='upd_texto_instructivo_ii';
        $val3='Texto Instrucción II:';
        $val4=$resultado->zpla_texto_instructivo;
    }
    if ($opc==4) {
        $val1='Edicion Texto Despedida:';
        $val2='upd_texto_despedida';
        $val3='Texto Despedida:';
        $val4=$resultado->zpla_texto_despedida;
    }

    $this->cabecera['accion']=$val1;         
    $contenido['funcion']=$val2;    
    $contenido['label_texto']=$val3;

    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id_pla;
    $contenido['valor_texto'] = $val4;
    
    $data['contenido'] = $this->load->view('preg_tres/editar_texto', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}
function upd_texto_bienvenida()
{      
    $zpla_texto_bienvenida = $this->input->post('texto');
    $id = $this->input->post('id');

    //var_dump($id,$texto_instructivo);exit();
    
    
    $data = array(
        'zpla_texto_bienvenida' => $zpla_texto_bienvenida ,
    );
    $this->db->where('zpla_id', $id);         
    $this->db->update('zis_plantillas', $data);

    redirect('Prueba_tres/listado_opciones_edicion/'.$id);    
}

function upd_texto_instructivo_i()
{      
    $texto = $this->input->post('texto');
    $id = $this->input->post('id');

    //var_dump($id,$texto_instructivo);exit();
    
    
    $data = array(
        'zpla_texto_instructivo_prueba' => $texto ,
    );
    $this->db->where('zpla_id', $id);         
    $this->db->update('zis_plantillas', $data);

    redirect('Prueba_tres/listado_opciones_edicion/'.$id);    
}
function upd_texto_instructivo_ii()
{      
    $texto = $this->input->post('texto');
    $id = $this->input->post('id');

    //var_dump($id,$texto_instructivo);exit();
    
    
    $data = array(
        'zpla_texto_instructivo' => $texto ,
    );
    $this->db->where('zpla_id', $id);         
    $this->db->update('zis_plantillas', $data);

    redirect('Prueba_tres/listado_opciones_edicion/'.$id);    
}
function upd_texto_despedida()
{      
    $texto = $this->input->post('texto');
    $id = $this->input->post('id');

    //var_dump($id,$texto_instructivo);exit();
    
    
    $data = array(
        'zpla_texto_despedida' => $texto ,
    );
    $this->db->where('zpla_id', $id);         
    $this->db->update('zis_plantillas', $data);

    redirect('Prueba_tres/listado_opciones_edicion/'.$id);    
}

function vista_pregunta_prueba_edicion($id)
{      
    $this->cabecera['accion']='Preguntas de Prueba'; 
    $this->db->order_by('prueba_nro','ASC'); 
    $this->db->where('zpla_id', $id);         
    $preguntas=$this->db->get('zis_plantilla_p_tres');
    // var_dump($preguntas->result_array());exit();
    if ($preguntas->num_rows()==0) {
        $this->crear_preguntas_prueba_validar($id);
        $preguntas = $this->db->query("SELECT * from zis_plantilla_p_tres WHERE zpla_id=$id ORDER BY prueba_nro ASC");
    }


    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id;
    $contenido['preguntas'] = $preguntas->result_array();

    $data['contenido'] = $this->load->view('preg_tres/editar_preguntas_prueba', $contenido, true);
    $this->load->view('plantilla_privado',$data);  
}

function crear_preguntas_prueba_validar($id)
{
    // despues de guardar los datos se abre el form de texto instructivo
    
    //var_dump($id);exit();

    for ($i=1; $i <=3 ; $i++) { 
        // validar si existe al pregunta antes de crearla
        $resultado = $this->db->query("SELECT * from zis_plantilla_p_tres WHERE zpla_id=$id and prueba_nro=$i ORDER BY prueba_nro ASC");
        if ($resultado->num_rows()==0) {
            $data = array(
            'zpla_id' => $id ,
            'prueba_nro' => $i,
            'prueba_texto' => '',
            'prueba_a' => '',
            'prueba_b' => '',
            'prueba_c' => '',
        );
        $this->db->set('prueba_fecha_creacion', 'NOW()', FALSE);            
        $this->db->set('prueba_user_creacion', 'NOW()', FALSE);
        $this->db->insert('zis_plantilla_p_tres', $data);
        }
        
    }    
    
}

function update_preguntas_prueba()
{
    // despues de guardar los datos se abre el form de texto instructivo
    $id = $this->input->post('id');
    //var_dump($id);exit();

    for ($i=1; $i <=3 ; $i++) { 
        // code...
        $data = array(            
            'prueba_texto' => $this->input->post('p'.$i),
            'prueba_a' => $this->input->post($i.'a'),
            'prueba_b' => $this->input->post($i.'b'),
            'prueba_c' => $this->input->post($i.'c'),
        );
        $this->db->set('prueba_user_edicion', 'NOW()', FALSE);            
        $this->db->set('prueba_user_creacion', 'NOW()', FALSE);        
        $this->db->where('prueba_nro', $i);
        $this->db->where('zpla_id', $id);
        $this->db->update('zis_plantilla_p_tres', $data);
    }    
    
    
    redirect('Prueba_tres/listado_opciones_edicion/'.$id); 
}


//old

// vista de preguntas
function vista_preguntas($id=null,$posicion=null)
{      
    $this->cabecera['accion']='Preguntas'; 
    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id;

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

    $resultado = $this->db->query("SELECT * from zis_plantilla_e_dos
        WHERE zpla_id=$id and  pre_nro BETWEEN $num_ini and $num_fin ORDER BY pre_nro ASC
        ");
    $data=$resultado->result_array();


    $contenido['num_ini'] = $num_ini;
    $contenido['num_fin'] = $num_fin;
    $contenido['grup_ini'] = $grup_ini;    
    $contenido['data'] = $data;  

    if ($posicion==80) {
        // code...
        redirect('Plantilla/texto_despedida/'.$id); 
    }else{
        $data['contenido'] = $this->load->view('preg_dos/vista_previa_preguntas_con_validacion', $contenido, true);

    }    
    $this->load->view('plantilla_privado',$data);  
}

function eliminar_plantilla($id_pla)
{   
    //borrado de una plantilla tablas, zis_plantillas, zis_plantilla_e_tres, zis_plantilla_p_tres
    //zis_baremo_factor
 
    $this->db->where('zpla_id', $id_pla);         
    $this->db->delete('zis_plantillas');
    //tabla de preguntas
    $this->db->where('zpla_id', $id_pla);         
    $this->db->delete('zis_plantilla_e_tres');
    //tabla de preguntas de prueba    
    $this->db->where('zpla_id', $id_pla);         
    $this->db->delete('zis_plantilla_p_tres');
    //tabla de valores baremos de la plantilla
    $this->db->where('zpla_id', $id_pla);         
    $this->db->delete('zis_baremo_factor');
    
    redirect('Plantilla/listar/');    
}

}


?>


