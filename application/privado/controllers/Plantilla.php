<?php
require_once('Controladoradmin.php');

class Plantilla extends Controladoradmin
{
    function __construct()
    {
      parent::__construct();
      force_ssl();
      $this->load->helper(array('url','form','html'));
      $this->load->library(array('form_validation','tool_general'));

         //****** definiendo nombre de carpeta por defecto
      $this->carpeta='plantilla/';
      $this->controlador='Plantilla/';

      $this->tabla='zis_plantillas';
      $this->prefijo='zpla_';
	  $this->tablaE='zis_plantilla_p_uno';
	  $this->prefijoE='pre_uno_p_';
	  $this->tablaU='zis_plantilla_e_uno';
	  $this->prefijoU='pre_uno_';
		  
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






    //tabla
function listar()
{

    $this->cabecera['accion']='Listado';       

    $consulta = $this->db->query("SELECT 
(CASE WHEN z.zpla_id  IS NULL THEN '0' ELSE '1' END) AS bandera,x.*
FROM
(SELECT p.*,t.tipo_desc FROM 
        zis_plantillas p
        LEFT JOIN 
        ztipo_evaluacion t
        on p.ztipo_eval_id=t.tipo_eval_id WHERE p.ztipo_eval_id!=4 order by p.zpla_id desc) x
LEFT JOIN
(SELECT DISTINCT zpla_id FROM
zis_evaluacion) z
on x.zpla_id=z.zpla_id
order by x.zpla_id desc
                
            ");
    $datos=$consulta->result_array();
        // var_dump($datos);exit();

    $contenido['cabecera']=$this->cabecera;
    $contenido['datos'] = $datos;
    // $contenido['o_evaluacion'] = array('e_nuevo' => $this->controlador.'agregar', 'e_listado' => $this->controlador.'listar', 'e_cancelar' => $this->controlador.'listar');
    $contenido['o_evaluacion'] = array('controlador' =>$this->controlador, 'e_nuevo' => 'agregar');
    $data['contenido'] = $this->load->view('plantilla/lista', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}

    //tabla
function agregar()
{

    $this->cabecera['accion']='Nuevo';       

    $consulta = $this->db->query("SELECT * FROM ztipo_evaluacion WHERE tipo_eval_id NOT LIKE 4");
    $datos=$consulta->result();
        // var_dump($datos);exit();

    $contenido['cabecera']=$this->cabecera;
    $contenido['datos'] = $datos;
	$contenido['o_evaluacion'] = array('controlador' =>$this->controlador, 'e_nuevo' => 'agregar', 'e_listado' => 'listar', 'e_cancelar' => 'listar');
    $data['contenido'] = $this->load->view('plantilla/agregar', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}

    // crear

function create()
{
        // despues de guardar los datos se abre el form de texto instructivo
    $titulo = $this->input->post('titulo');




    $tipo = $this->input->post('tipo_eval');
    $puntaje=0;
    // if ($tipo==2) {
    //     $puntaje = 0;
    // }else{
    //     $puntaje = $this->input->post('puntaje');
    // }
    
        // $hora = $this->input->post('hora');
        // $min = $this->input->post('min');
        // $sec = $this->input->post('sec');

        //var_dump($titulo.$tipo);exit();

     //var_dump($puntaje);exit();
    $zpla_tiempo_max=0;
    if ($tipo==5) {
        $zpla_tiempo_max=$this->input->post('tiempo_prueba');
    }
    $data = array(
        'zpla_tiempo_max' => $zpla_tiempo_max ,
        'zpla_titulo' => $titulo ,
        'ztipo_eval_id' => $tipo,
        'zpla_puntaje' => $puntaje,        
        'zpla_usuario_creacion' => $_SESSION[$this->presession.'id'],               

    );

    $this->db->set('zpla_fecha_creacion', 'NOW()', FALSE);            
    $this->db->insert('zis_plantillas', $data);



    $id=$this->db->insert_id();
    redirect('Plantilla/texto_bienvenida/'.$id.'/'.$tipo);
    // if ($tipo==1) {
    //     redirect('Analitica/gpregunta/'.$id);
    // }
    // if ($tipo==2) {

    // }
}
function texto_bienvenida($id=null,$tipo=null)
{

    $this->cabecera['accion']='Texto de bienvenida'; 

    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id;
    $contenido['tipo'] = $tipo;
    $data['contenido'] = $this->load->view('plantilla/text_uno', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}

function upd_texto_uno()
{
        // despues de guardar los datos se abre el form de texto instructivo
    $texto_bienvenida = $this->input->post('texto_bienvenida');
    $id = $this->input->post('id');
    $tipo = $this->input->post('tipo');
    
        // $hora = $this->input->post('hora');
        // $min = $this->input->post('min');
        // $sec = $this->input->post('sec');

    //var_dump($texto_bienvenida.$id);exit();
    $data = array(
        'zpla_texto_bienvenida' => $texto_bienvenida ,
    );
    $this->db->where('zpla_id', $id);         
    $this->db->update('zis_plantillas', $data);



    //$id=$this->db->insert_id();
    //redirect('Plantilla/texto_bienvenida/'.$id);
    if ($tipo==1) {
        redirect('Analitica/gpregunta/'.$id);
    }
    if ($tipo==2) {
        redirect('Prueba_dos/texto_uno/'.$id);
    }
    if ($tipo==3) {
        redirect('Prueba_tres/texto_prueba/'.$id);
    }
    if ($tipo==5) {
        redirect('Prueba_cinco/texto_uno/'.$id);
    }
}

function datos_plantilla($id=null,$tipo=null)
{
    $consulta = $this->db->query("SELECT * FROM
        zis_plantillas
        WHERE zpla_id=$id");
    $datos=$consulta->result_array();
        //var_dump($datos);exit();
    $this->cabecera['accion']=$datos[0]['zpla_titulo']; 
    $contenido['cabecera']=$this->cabecera;
    $contenido['datos'] = $datos;
    $contenido['id'] = $id;
    $contenido['tipo'] = $tipo;
    if ($tipo==1) {
        $contenido['funcion'] = 'texto_instructivo_pruebas/';
    }
    if ($tipo==2) {
        $contenido['funcion'] = 'texto_instructivo/';
    }
    if ($tipo==3) {
        $contenido['funcion'] = 'texto_instructivo_prueba_actitudes/';
    }
    if ($tipo==5) {
        $contenido['funcion'] = 'texto_instructivo_ic/';
    }
    
    $data['contenido'] = $this->load->view('plantilla/texto_bienvenida', $contenido, true);
    $this->load->view('plantilla_privado',$data);

}
//texto intructivo I
function texto_instructivo($id)
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
    $data['contenido'] = $this->load->view('plantilla/text_instructivo', $contenido, true);
    $this->load->view('plantilla_privado',$data);

}

function texto_instructivo_ic($id)
{
    redirect('Prueba_cinco/vista_texto_instructivo_ic/'.$id);

}

//texto instructivo II para pruebas
function texto_instructivo_pruebas($id)
{
    // $id=$this->input->post('id');
    $consulta = $this->db->query("SELECT * FROM
        ".$this->tabla."
        WHERE " .$this->prefijo. "id=$id");
    $datos=$consulta->result_array();
        //var_dump($datos);exit();
    $this->cabecera['accion']=$datos[0][$this->prefijo.'titulo']; 
    $contenido['accion']='Analitica/vista_pregunta_prueba/'.$id;
    $contenido['cabecera']=$this->cabecera;
    $contenido['contenido'] = $datos[0][$this->prefijo.'texto_instructivo_prueba'];
    $contenido['id'] = $id;
    $data['contenido'] = $this->load->view('plantilla/text_instructivo_dos', $contenido, true);
    $this->load->view('plantilla_privado',$data);

}

//texto instructivo II para pruebas Actitudes e intereses
function texto_instructivo_prueba_actitudes($id)
{
    // $id=$this->input->post('id');
    $consulta = $this->db->query("SELECT * FROM
        ".$this->tabla."
        WHERE " .$this->prefijo. "id=$id");
    $datos=$consulta->result_array();
        //var_dump($datos);exit();
    $this->cabecera['accion']=$datos[0][$this->prefijo.'titulo']; 
    $contenido['accion']='Prueba_tres/vistapregunta_prueba/'.$id;
    $contenido['cabecera']=$this->cabecera;
    $contenido['contenido'] = $datos[0][$this->prefijo.'texto_instructivo_prueba'];
    $contenido['id'] = $id;
    $data['contenido'] = $this->load->view('plantilla/text_instructivo_dos', $contenido, true);
    $this->load->view('plantilla_privado',$data);

}


//texto intructivo I
function texto_despedida($id)
{
    // $id=$this->input->post('id');
    $consulta = $this->db->query("SELECT * FROM
        zis_plantillas
        WHERE zpla_id=$id");
    $datos=$consulta->result_array();
        //var_dump($datos);exit();
    $this->cabecera['accion']=$datos[0]['zpla_titulo']; 
    $contenido['cabecera']=$this->cabecera;
    $contenido['datos'] = $datos;
    $contenido['id'] = $id;
    $data['contenido'] = $this->load->view('plantilla/texto_despedida', $contenido, true);
    $this->load->view('plantilla_privado',$data);

}

public function caja_tipo()
{
    $data['msj_prueba'] = 'hola';
    $response=$this->load->view('plantilla/caja_puntaje',$data,TRUE);
    echo $response;
    // echo 'hola';
}

public function caja_tiempo_prueba()
{
    $data['msj_prueba'] = 'hola';
    $response=$this->load->view('plantilla/caja_tiempo_prueba',$data,TRUE);
    echo $response;
    // echo 'hola';
}


function editar_plantilla($id_pla=null,$tipo=null)
{
 
    if ($tipo==1) {
        redirect('Analitica/editar_plantilla/'.$id_pla);
    }
    if ($tipo==2) {
        redirect('Prueba_dos/editar_plantilla/'.$id_pla);
    }
    if ($tipo==3) {
        redirect('Prueba_tres/editar_plantilla/'.$id_pla);
    }
    if ($tipo==5) {
        redirect('Prueba_cinco/editar_plantilla/'.$id_pla);
    }
}

function eliminar_plantilla($id_pla=null,$tipo=null)
{
 
    if ($tipo==1) {
        redirect('Analitica/eliminar_plantilla/'.$id_pla);
    }
    if ($tipo==2) {
        redirect('Prueba_dos/eliminar_plantilla/'.$id_pla);
    }
    if ($tipo==3) {
        redirect('Prueba_tres/eliminar_plantilla/'.$id_pla);
    }
    if ($tipo==5) {
        redirect('Prueba_cinco/eliminar_plantilla/'.$id_pla);
    }
}

// function delete($id)
// {    
//     // var_dump($id);exit();
//     $this->db->where('zpla_id',$id);            
//     $this->db->delete('zis_plantillas');
//     redirect('Plantilla/listar/');
// }


}


?>