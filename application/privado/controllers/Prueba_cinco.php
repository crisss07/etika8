<?php
require_once('Controladoradmin.php');

class Prueba_cinco extends Controladoradmin
{
    function __construct()
    {
      parent::__construct();
      force_ssl();
      $this->load->helper(array('url','form','html'));
      $this->load->library(array('form_validation','tool_general'));

         //****** definiendo nombre de carpeta por defecto
      $this->carpeta='plantilla/';
      $this->controlador='Prueba_cinco/';

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
function index()
{
    redirect('Plantilla/listar');
}    

function texto_uno($id=null)
{
    //var_dump($id);exit();
    $this->cabecera['accion']='Texto Instructivo'; 

    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id;
   // $contenido['tipo'] = $tipo;
    $data['contenido'] = $this->load->view('preg_cinco/text_uno', $contenido, true);

    $this->load->view('plantilla_privado',$data);
}

function upd_texto_uno()
{      
    $texto_instructivo = $this->input->post('texto_instructivo');
    $id = $this->input->post('id');

    //var_dump($id,$texto_instructivo);exit();
    
    
    $data = array(
        'zpla_texto_instructivo' => $texto_instructivo ,
    );
    $this->db->where('zpla_id', $id);         
    $this->db->update('zis_plantillas', $data);

    redirect('Prueba_cinco/preguntas/'.$id);    
}

function preguntas($id)
{      
    $this->cabecera['accion']='Preguntas'; 
    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id;
    $data['contenido'] = $this->load->view('preg_cinco/preguntas', $contenido, true);
    $this->load->view('plantilla_privado',$data);  
}
    //tabla




    // crear

function crear_preguntas()
{
    $id = $this->input->post('id');
    

    //Cantidad asegurada    Clase de seguro Fecha   1   2   3
    for ($i=1; $i <=25 ; $i++) { 

        $cantidad=$this->input->post('cant'.$i);
        
        $clase=$this->input->post('cl'.$i);
        $fecha=$this->input->post('fech'.$i);

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
        $data = array(
            'zpla_id' => $id ,
            'pre_nro' => $i,
            'cantidad' => $cantidad,            
            'clase' => $clase,
            'pre_resp_a' => $a,
            'pre_resp_b' => $b,
            'pre_resp_c' => $c,
            'fecha' => $fecha,            
            'user_creacion' => $_SESSION[$this->presession.'id'],
        );
        $this->db->set('pre_fecha_creacion', 'NOW()', FALSE);            
        $this->db->insert('zis_plantilla_e_cinco', $data);
    }    
        
    redirect('Prueba_cinco/texto_despedida/'.$id); 
    
    
}

function texto_despedida($id=null)
{
    //var_dump($id);exit();
    $this->cabecera['accion']='Texto Despedida'; 

    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id;
   // $contenido['tipo'] = $tipo;
    $data['contenido'] = $this->load->view('preg_cinco/texto_despedida', $contenido, true);

    $this->load->view('plantilla_privado',$data);
}

//vista_previa
function vista_texto_instructivo_ic($id)
{
    //$tipo=$this->input->post('tipo');
    $consulta = $this->db->query("SELECT * FROM
        zis_plantillas
        WHERE zpla_id=$id");
    $datos=$consulta->result_array();
        //var_dump($datos);exit();
    $this->cabecera['accion']=$datos[0]['zpla_titulo']; 
    $contenido['cabecera']=$this->cabecera;
    //$contenido['tipo'] = $tipo;
    $contenido['datos'] = $datos;
    $contenido['id'] = $id;
    $data['contenido'] = $this->load->view('preg_cinco/vista_text_instructivo', $contenido, true);
    $this->load->view('plantilla_privado',$data);

}

// vista de preguntas
function vista_preguntas($id=null)
{      
    $consulta = $this->db->query("SELECT * from zis_plantilla_e_cinco
        WHERE zpla_id=$id ORDER BY pre_nro ASC")->result_array();
    $this->cabecera['accion']='Preguntas'; 
    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id;
    $contenido['datos'] = $consulta;
    $data['contenido'] = $this->load->view('preg_cinco/vista_previa_preguntas', $contenido, true);
    $this->load->view('plantilla_privado',$data);  
}

//vista_previa
function vista_texto_despedida($id)
{
    //$tipo=$this->input->post('tipo');
    $consulta = $this->db->query("SELECT * FROM
        zis_plantillas
        WHERE zpla_id=$id");
    $datos=$consulta->result_array();
        //var_dump($datos);exit();
    $this->cabecera['accion']=$datos[0]['zpla_titulo']; 
    $contenido['cabecera']=$this->cabecera;
    //$contenido['tipo'] = $tipo;
    $contenido['datos'] = $datos;
    $contenido['id'] = $id;
    $data['contenido'] = $this->load->view('preg_cinco/vista_text_despedida', $contenido, true);
    $this->load->view('plantilla_privado',$data);

}


//old

function upd_texto_despedida()
{      
    $texto_despedida = $this->input->post('texto_despedida');
    $id = $this->input->post('id');

    //var_dump($id,$texto_instructivo);exit();
    
    
    $data = array(
        'zpla_texto_despedida' => $texto_despedida ,
    );
    $this->db->where('zpla_id', $id);         
    $this->db->update('zis_plantillas', $data);

    redirect('Plantilla/listar/');    
}
//baremo
function vista_baremo($id_pla=null)
{
    
    $cantidad_baremo=75;
    $tamano_array=0;
    $validar= $this->db->query("SELECT array_valores as valor FROM  zis_baremo_cinco_ic WHERE zpla_id=$id_pla");    
    if($validar->num_rows()==0){
            $valores=[];
            for ($i=0; $i <=$cantidad_baremo; $i++) { 
             array_push($valores,"1");         
            }
            $user_creacion=$_SESSION[$this->presession.'id'];
            $this->db->set('pre_fecha_creacion', 'NOW()', FALSE);  
            $this->db->set('user_creacion', $user_creacion);
            $this->db->set('array_valores', json_encode($valores));
            $this->db->set('cantidad_preguntas',$cantidad_baremo);            
            $this->db->set('zpla_id', $id_pla);
            $this->db->insert('zis_baremo_cinco_ic');
        }else{
            //$valores=$valor->result_array();  
            $validar=$validar->row();
            $array_valores=$validar->valor;  
            $valores=json_decode($array_valores);      

        }


    //var_dump(count($valores));exit();
    $tamano_array=count($valores);    

    $this->cabecera['accion']='Crear Baremo';     

    $contenido['cabecera']=$this->cabecera;
    $contenido['id_plantilla'] = $id_pla;
    $contenido['val_baremo'] = $valores;
    $contenido['long_json'] = $tamano_array;
    $contenido['cantidad_preg'] = $cantidad_baremo;
    
    

    //antes se actualiza o se crea la cantidad de los baremos
    
    $data['contenido'] = $this->load->view('preg_cinco/vista_crear_baremo', $contenido, true);

    $this->load->view('plantilla_privado',$data);
}

function crear_baremo()
{      
    $id_pla = $this->input->post('id_pla');
    $user=$_SESSION[$this->presession.'id'];
    
    $valores=[];
    for ($i=0; $i <=75; $i++) {     
     $puntaje = $this->input->post('p'.$i);
         //$puntaje = array($i=>$puntaje);    
     array_push($valores,$puntaje);

    }
    // var_dump(json_encode($valores[22]));exit();
        $this->db->set('pre_fecha_edicion', 'NOW()', FALSE);  
        $this->db->set('user_edicion', $user);
        $this->db->set('array_valores', json_encode($valores));
        $this->db->where('zpla_id', $id_pla);
        $this->db->update('zis_baremo_cinco_ic');    
   
    redirect('Plantilla/listar/'.$id_pla);
}

//edicion prueba dos
function editar_plantilla($id_pla=null)
{   
    // redirect('Prueba_tres/editar_preguntas/'.$id_pla.'/1');    
    redirect('Prueba_cinco/listado_opciones_edicion/'.$id_pla);    
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
    $data['contenido'] = $this->load->view('preg_cinco/lista_edicion', $contenido, true);
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
    
    $data['contenido'] = $this->load->view('preg_cinco/editar_titulo', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}
function vista_edicion_tiempo($id_pla=null)
{
    $resultado = $this->db->query("SELECT * from zis_plantillas
        WHERE zpla_id=$id_pla ")->row();
    $this->cabecera['accion']='Edicion Tiempo'; 
    //var_dump($resultado->zpla_texto_bienvenida);exit();
    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id_pla;
    $contenido['valor_texto'] = $resultado->zpla_tiempo_max;    
    $data['contenido'] = $this->load->view('preg_cinco/editar_tiempo', $contenido, true);
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

    redirect('Prueba_cinco/listado_opciones_edicion/'.$id);    
}

function updt_tiempo()
{      
    $tiempo_prueba = $this->input->post('tiempo_prueba');
    $id = $this->input->post('id_pla');

    //var_dump($id,$texto_instructivo);exit();
    
    
    $data = array(
        'zpla_tiempo_max' => $tiempo_prueba ,
    );
    $this->db->where('zpla_id', $id);         
    $this->db->update('zis_plantillas', $data);

    redirect('Prueba_cinco/listado_opciones_edicion/'.$id);    
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
        $val1='Edicion Texto Instrucción:';
        $val2='upd_texto_instructivo_ii';
        $val3='Texto Instrucción:';
        $val4=$resultado->zpla_texto_instructivo;
    }
    if ($opc==4) {
        $val1='Edicion Texto Despedida:';
        $val2='upd_texto_despedida_dos';
        $val3='Texto Despedida:';
        $val4=$resultado->zpla_texto_despedida;
    }

    $this->cabecera['accion']=$val1;         
    $contenido['funcion']=$val2;    
    $contenido['label_texto']=$val3;

    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id_pla;
    $contenido['valor_texto'] = $val4;
    
    $data['contenido'] = $this->load->view('preg_cinco/editar_texto', $contenido, true);

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

    redirect('Prueba_cinco/listado_opciones_edicion/'.$id);    
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

    redirect('Prueba_cinco/listado_opciones_edicion/'.$id);    
}
function upd_texto_despedida_dos()
{      
    $texto = $this->input->post('texto');
    $id = $this->input->post('id');

    //var_dump($id,$texto_instructivo);exit();
    
    
    $data = array(
        'zpla_texto_despedida' => $texto ,
    );
    $this->db->where('zpla_id', $id);         
    $this->db->update('zis_plantillas', $data);

    redirect('Prueba_cinco/listado_opciones_edicion/'.$id);    
}
function editar_preguntas($id=null)
{      
    $consulta = $this->db->query("SELECT * from zis_plantilla_e_cinco
        WHERE zpla_id=$id ORDER BY pre_nro ASC");

    if ($consulta->num_rows()==0) {
        $this->crear_preguntas_validar($id);    
        $consulta = $this->db->query("SELECT * from zis_plantilla_e_cinco
        WHERE zpla_id=$id ORDER BY pre_nro ASC
        ");
    }
    $this->cabecera['accion']='Preguntas'; 
    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id;
    $contenido['datos'] = $consulta->result_array();
    $data['contenido'] = $this->load->view('preg_cinco/vista_editar_preguntas', $contenido, true);
    $this->load->view('plantilla_privado',$data);    
}

function crear_preguntas_validar($id)
{
    
    

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
        $data = array(
            'zpla_id' => $id ,
            'pre_nro' => $i,
            'cantidad' => "",            
            'clase' => "",
            'pre_resp_a' => 0,
            'pre_resp_b' => 0,
            'pre_resp_c' => 0,
            'fecha' => "",            
            'user_creacion' => $_SESSION[$this->presession.'id'],
        );
        $this->db->set('pre_fecha_creacion', 'NOW()', FALSE);            
        $this->db->insert('zis_plantilla_e_cinco', $data);
    }    
        
    
    
    
}

function update_preguntas()
{
    $id = $this->input->post('id');
    

    //Cantidad asegurada    Clase de seguro Fecha   1   2   3
    for ($i=1; $i <=25 ; $i++) { 

        $cantidad=$this->input->post('cant'.$i);
        
        $clase=$this->input->post('cl'.$i);
        $fecha=$this->input->post('fech'.$i);

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
        $data = array(
            'cantidad' => $cantidad,            
            'clase' => $clase,
            'pre_resp_a' => $a,
            'pre_resp_b' => $b,
            'pre_resp_c' => $c,
            'fecha' => $fecha,                        
        );
        $this->db->set('pre_fecha_edicion', 'NOW()', FALSE);            
        $this->db->set('user_edicion', $_SESSION[$this->presession.'id']);            
        $this->db->where('pre_nro', $i);            
        $this->db->where('zpla_id', $id);            
        $this->db->update('zis_plantilla_e_cinco', $data);
    }    
        
    redirect('Prueba_cinco/listado_opciones_edicion/'.$id); 
    
    
} 

function eliminar_plantilla($id_pla)
{   
    //borrado de una plantilla tablas, zis_plantillas, zis_plantilla_e_cinco, 
    //zis_baremo_cinco_ic   
    
    //tabla de plantilla
    $this->db->where('zpla_id', $id_pla);         
    $this->db->delete('zis_plantillas');
    //tabla de preguntas
    $this->db->where('zpla_id', $id_pla);         
    $this->db->delete('zis_plantilla_e_cinco');
    //tabla de valores baremo
    $this->db->where('zpla_id', $id_pla);         
    $this->db->delete('zis_baremo_cinco_ic');
    redirect('Plantilla/listar/');    
}  



}


?>