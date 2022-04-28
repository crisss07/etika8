<?php
require_once('Controladoradmin.php');

class Evaluacion extends Controladoradmin
{
    function __construct()
    {
      parent::__construct();
      force_ssl();
      $this->load->helper(array('url','form','html'));
      $this->load->library(array('form_validation','tool_general'));

         //****** definiendo nombre de carpeta por defecto
      $this->carpeta='evaluacion/';
      $this->controlador='Evaluacion/';

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
}       






    //tabla grupo evaluacion
function listar()
{
    $this->cabecera['accion']='Listado';       
    // $consulta = $this->db->query("SELECT z.*,c.cli_nombre FROM zis_grupo_evaluacion z
    //     INNER JOIN clientes c
    //     on z.cli_id=c.cli_id
    //     ORDER BY z.gru_fecha_vigencia DESC");
    $consulta = $this->db->query("SELECT CASE 
    WHEN y.gru_id IS NULL THEN
        0
    ELSE
        1
END as bandera
,x.* FROM

(SELECT z.*,c.cli_nombre FROM zis_grupo_evaluacion z
         JOIN clientes c
        on z.cli_id=c.cli_id
        WHERE z.gru_fecha_vigencia>=NOW()
        ORDER BY z.gru_fecha_vigencia DESC) x
                LEFT JOIN
                (SELECT DISTINCT gru_id FROM zis_seguimiento) y
                on x.gru_id=y.gru_id ORDER BY x.gru_fecha_vigencia DESC");

    $datos=$consulta->result_array();

     $anios = $this->db->query("SELECT DISTINCT YEAR(gru_fecha_vigencia)as anio FROM
zis_grupo_evaluacion")->result();
        // var_dump($datos);exit();
    $contenido['cabecera']=$this->cabecera;
    $contenido['datos'] = $datos;
    $contenido['anios'] = $anios;
    $data['contenido'] = $this->load->view('evaluacion/lista', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}

function listar_anio($anio)
{
    $this->cabecera['accion']='Listado';       
    // $consulta = $this->db->query("SELECT z.*,c.cli_nombre FROM zis_grupo_evaluacion z
    //     INNER JOIN clientes c
    //     on z.cli_id=c.cli_id
    //     ORDER BY z.gru_fecha_vigencia DESC");
    $consulta = $this->db->query("SELECT CASE 
    WHEN y.gru_id IS NULL THEN
        0
    ELSE
        1
END as bandera
,x.* FROM

(SELECT z.*,c.cli_nombre FROM zis_grupo_evaluacion z
         JOIN clientes c
        on z.cli_id=c.cli_id
        WHERE YEAR(z.gru_fecha_vigencia)=$anio
        ORDER BY z.gru_fecha_vigencia DESC) x
                LEFT JOIN
                (SELECT DISTINCT gru_id FROM zis_seguimiento) y
                on x.gru_id=y.gru_id ORDER BY x.gru_fecha_vigencia DESC");

    $datos=$consulta->result_array();

     $anios = $this->db->query("SELECT DISTINCT YEAR(gru_fecha_vigencia)as anio FROM
zis_grupo_evaluacion")->result();
        // var_dump($datos);exit();
    $contenido['cabecera']=$this->cabecera;
    $contenido['datos'] = $datos;
    $contenido['anios'] = $anios;
    $data['contenido'] = $this->load->view('evaluacion/lista_anio', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}


function agregar()
{

    $this->cabecera['accion']='Nuevo';       

    
        // var_dump($datos);exit();

    $clientes = $this->db->query("SELECT * FROM clientes  ORDER BY cli_nombre ASC")->result();
    

    $contenido['cabecera']=$this->cabecera;
    
    $contenido['clientes'] = $clientes;
    $data['contenido'] = $this->load->view('evaluacion/agregar', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}

// crear
function create()
{    
    $titulo = $this->input->post('titulo');
    $cliente = $this->input->post('cliente');
    $fecha_vigencia = $this->input->post('fecha_vigencia');
    $data = array(
        'gru_nombre' => $titulo ,
        'cli_id' => $cliente,
        'gru_fecha_vigencia' => $fecha_vigencia,
        'gru_usu_creacion' => $_SESSION[$this->presession.'id'],         
    );
    $this->db->set('gru_fecha_creacion', 'NOW()', FALSE);            
    $this->db->insert('zis_grupo_evaluacion', $data);
    $id=$this->db->insert_id();
    redirect('Evaluacion/lista_evaluacion/'.$id);

}

//edicion de grupo
function edicion_grupo($id_grupo=null)
{
    // var_dump($_SESSION[$this->presession.'id']);exit();
    $this->cabecera['accion']='Editar';       
    $data_grupo = $this->db->query("SELECT z.*,c.cli_nombre FROM zis_grupo_evaluacion z
        JOIN
        clientes c
        on z.cli_id=c.cli_id
        WHERE z.gru_id=$id_grupo")->row();
    $clientes = $this->db->query("SELECT * FROM clientes ")->result();
    

    $contenido['cabecera']=$this->cabecera;    
    $contenido['clientes'] = $clientes;
    $contenido['data_grupo'] = $data_grupo;
    $data['contenido'] = $this->load->view('evaluacion/edicion_grupo', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}
//guardar cambios de la edicion grupo
function update_grupo()
{    
    $titulo = $this->input->post('titulo');
    $cliente = $this->input->post('cliente');
    $fecha_vigencia = $this->input->post('fecha_vigencia');
    $id_grupo = $this->input->post('id_grupo');
    $data = array(
        'gru_nombre' => $titulo ,
        'cli_id' => $cliente,
        'gru_fecha_vigencia' => $fecha_vigencia ,                
        'gru_usu_edicion' =>  $_SESSION[$this->presession.'id']
    );
    $this->db->set('gru_fecha_edicion', 'NOW()', FALSE);  
    $this->db->where('gru_id', $id_grupo);              
    $this->db->update('zis_grupo_evaluacion', $data);    
    redirect('Evaluacion/listar/');

}

//tabla listado de evaluaciones
function lista_evaluacion($id_grupo=null)
{
    $this->cabecera['accion']='Listado';       

    // $consulta = $this->db->query("SELECT z.*,t.tipo_desc FROM zis_evaluacion z JOIN
    //     ztipo_evaluacion t
    //     on t.tipo_eval_id=z.tipo_eval_id
    //     where z.gru_id=$id");

    $consulta = $this->db->query("SELECT CASE 
    WHEN y.eva_id IS NULL THEN
        0
    ELSE
        1
END as bandera

,x.* FROM
(SELECT z.*,t.tipo_desc,pl.zpla_titulo FROM zis_evaluacion z JOIN
        ztipo_evaluacion t
        on t.tipo_eval_id=z.tipo_eval_id
        JOIN
        zis_plantillas pl
        on
        pl.zpla_id=z.zpla_id
        where z.gru_id=$id_grupo) x
                LEFT JOIN               
                (SELECT DISTINCT eva_id FROM zis_seguimiento s
                WHERE gru_id=$id_grupo) y
                on x.eva_id=y.eva_id");
    $datos=$consulta->result_array();
        // var_dump($datos);exit();
    //nro de evaluaciones
    $nro_eval = $this->db->query("SELECT gru_nro_eval,gru_nro_participantes FROM zis_grupo_evaluacion
        WHERE gru_id=$id_grupo
        ")->row();
	$carpeta=0;
    foreach($datos as $value){
		if($value["tipo_eval_id"]==4){
			$carpeta=1;
		}
	}

    $nombre_grupo = $this->db->query("SELECT * from zis_grupo_evaluacion WHERE gru_id=$id_grupo")->result_array();
    $contenido['cabecera']=$this->cabecera;
    $contenido['carpeta'] = $carpeta;
    $contenido['datos'] = $datos;
    $contenido['id_grupo'] = $id_grupo;
    $contenido['nombre_grupo'] = $nombre_grupo[0]['gru_nombre'];
    $contenido['nro_eval'] = $nro_eval->gru_nro_eval;
    $contenido['nro_participantes'] = $nro_eval->gru_nro_participantes;
    $data['contenido'] = $this->load->view('evaluacion/lista_evaluacion', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}

function agregar_evaluacion($id_grupo=null)
{

    $this->cabecera['accion']='Nuevo';       

    
        // var_dump($datos);exit();

    
    $plantilla = $this->db->query("SELECT * FROM zis_plantillas WHERE ztipo_eval_id NOT LIKE 4")->result();
    

    $contenido['cabecera']=$this->cabecera;
    
    $contenido['plantilla'] = $plantilla;

    $contenido['id_grupo'] = $id_grupo;
    $data['contenido'] = $this->load->view('evaluacion/agregar_evaluacion', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}

// crear evaluacion
function create_evaluacion()
{    
    $titulo = $this->input->post('titulo');
    $plantilla_id = $this->input->post('plantilla');
    $intentos = $this->input->post('intentos');
    $id_grupo = $this->input->post('id_grupo');
    //datos de la plantilla
    $plantilla_data = $this->db->query("SELECT * FROM zis_plantillas where zpla_id=$plantilla_id ")->row();
    $data = array(

        'zpla_id' => $plantilla_id,
        'tipo_eval_id' => $plantilla_data->ztipo_eval_id,
        'gru_id' => $id_grupo,
        'eva_titulo' => $titulo,
        'eva_texto_bienvenida' => $plantilla_data->zpla_texto_bienvenida,
        'eva_texto_despedida' => $plantilla_data->zpla_texto_despedida,
        
        'eva_nro_intentos'=> $intentos,
        'eva_estado'=> 1,
        

        'eva_usu_creacion' => $_SESSION[$this->presession.'id'],   
    );
    $this->db->set('eva_fecha_creacion', 'NOW()', FALSE);            
    $this->db->insert('zis_evaluacion', $data);
    $id=$this->db->insert_id();


    // $datos = $this->db->query("SELECT * from zis_grupo_evaluacion WHERE gru_id=$id_grupo")->row();

    // $suma=$datos->gru_nro_eval+1;


    // $this->db->set('gru_nro_eval', $suma);    
    // $this->db->where('gru_id',$id_grupo);
    // $this->db->update('zis_grupo_evaluacion');
    // calcular el nro de evaluaciones
        $contador = $this->db->query("SELECT COUNT(gru_id) as total,gru_id FROM
            zis_evaluacion
            WHERE gru_id=$id_grupo
            GROUP BY gru_id
            ")->row();

        $this->db->set('gru_nro_eval', $contador->total);    
        $this->db->where('gru_id',$id_grupo);
        $this->db->update('zis_grupo_evaluacion');
    // var_dump($id);exit();
    redirect('Evaluacion/texto_bienvenida/'.$id.'/'.$id_grupo);

}
//editar evaluacion
function edicion_eval($id_grupo=null,$id_eval=null)
{
    $data_eval = $this->db->query("SELECT z.*,p.zpla_titulo FROM zis_evaluacion z
        JOIN
        zis_plantillas p
        on z.zpla_id=p.zpla_id
        WHERE z.eva_id=$id_eval")->row();
    $this->cabecera['accion']='Editar';       

    
        // var_dump($datos);exit();

    
    $plantilla = $this->db->query("SELECT * FROM zis_plantillas ")->result();
    

    $contenido['cabecera']=$this->cabecera;
    
    $contenido['plantilla'] = $plantilla;
    $contenido['data_eval'] = $data_eval;

    $contenido['id_eval'] = $id_eval;
    $contenido['id_grupo'] = $id_grupo;
    $data['contenido'] = $this->load->view('evaluacion/edicion_evaluacion', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}
//update evaluacion
function update_evaluacion()
{    
    $titulo = $this->input->post('titulo');
    $plantilla_id = $this->input->post('plantilla');
    $intentos = $this->input->post('intentos');
    $id_grupo = $this->input->post('id_grupo');
    $id_eval = $this->input->post('id_eval');
    $data = array(                
        'eva_titulo' => $titulo,        
        'eva_nro_intentos'=> $intentos,
        'eva_usu_modificacion' => $_SESSION[$this->presession.'id'],   
    );
    $this->db->set('eva_fecha_edicion', 'NOW()', FALSE);            
    $this->db->where('eva_id', $id_eval);
    $this->db->update('zis_evaluacion', $data);    
    // var_dump($id);exit();
    redirect('Evaluacion/texto_bienvenida/'.$id_eval.'/'.$id_grupo);

}

function texto_bienvenida($id_eval=null,$id_grupo=null)
{
    $evaluacion_data = $this->db->query("SELECT eva_texto_bienvenida FROM zis_evaluacion where eva_id=$id_eval ")->row();

    $this->cabecera['accion']='Texto de bienvenida'; 

    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id_eval;
    $contenido['id_grupo'] = $id_grupo;
    $contenido['texto'] =$evaluacion_data->eva_texto_bienvenida;
    $contenido['error_msj'] ="";
    
    $data['contenido'] = $this->load->view('evaluacion/texto_bienvenida', $contenido, true);

    $this->load->view('plantilla_privado',$data);
}

function upd_bienvenida()
{
    // despues de guardar los datos se abre el form de texto instructivo
    $texto_bienvenida = $this->input->post('texto_bienvenida');
    $id_eval = $this->input->post('id');
    $id_grupo = $this->input->post('id_grupo');


    if ($texto_bienvenida=="") {
        $evaluacion_data = $this->db->query("SELECT eva_texto_bienvenida FROM zis_evaluacion where eva_id=$id_eval ")->row();
        $this->cabecera['accion']='Texto de bienvenida'; 

        $contenido['cabecera']=$this->cabecera;
        $contenido['id'] = $id_eval;
        $contenido['id_grupo'] = $id_grupo;
        $contenido['texto'] =$texto_bienvenida;
        $contenido['error_msj'] ="Debe introducir un contenido";
        
        $data['contenido'] = $this->load->view('evaluacion/texto_bienvenida', $contenido, true);

        $this->load->view('plantilla_privado',$data);
    }else{
        $data = array(
            'eva_texto_bienvenida' => $texto_bienvenida ,
        );
        $this->db->where('eva_id', $id_eval);         
        $this->db->update('zis_evaluacion', $data);    
        redirect('Evaluacion/texto_despedida/'.$id_eval.'/'.$id_grupo);   
    }


}





function texto_despedida($id_eval=null,$id_grupo=null)
{
    $evaluacion_data = $this->db->query("SELECT eva_texto_despedida,gru_id FROM zis_evaluacion where eva_id=$id_eval ")->row();
    $this->cabecera['accion']='Texto Despedida'; 
    $contenido['cabecera']=$this->cabecera;
    $contenido['texto'] = $evaluacion_data->eva_texto_despedida;
    $contenido['id'] = $id_eval;
    $contenido['id_grupo'] = $id_grupo;
    $data['contenido'] = $this->load->view('evaluacion/texto_despedida', $contenido, true);
    $this->load->view('plantilla_privado',$data);
}

function upd_despedida()
{
    // despues de guardar los datos se abre el form de texto instructivo
    $eva_texto_despedida = $this->input->post('texto_despedida');
    $id = $this->input->post('id');    
    $id_grupo = $this->input->post('id_grupo'); 
    $data = array(
        'eva_texto_despedida' => $eva_texto_despedida ,
    );
    $this->db->where('eva_id', $id);         
    $this->db->update('zis_evaluacion', $data);    
    redirect('Evaluacion/lista_evaluacion/'.$id_grupo);    
}

function adicionar_participantes($id_grupo=null)
{
    $this->cabecera['accion']='Adicionar Participantes';
    $datos = $this->db->query("SELECT c.con_cargo,e.pos_id,c.con_hasta,CONCAT(p.pos_nombre,' ',p.pos_apaterno) as nombre FROM convocatoria c
        JOIN
        etapas e
        on c.con_id=e.con_id
        JOIN
        postulante p
        on e.pos_id=p.pos_id

        WHERE c.con_hasta>=CURDATE()
        ")->result();

    $consulta = $this->db->query("SELECT * FROM ztipo_evaluacion ");
    $datosss=$consulta->result();
    $contenido['cabecera']=$this->cabecera;
    $contenido['datos'] = $datos;
    $contenido['datosss'] = $datosss;
    $contenido['id_grupo'] = $id_grupo;

    $data['contenido'] = $this->load->view('evaluacion/adicionar_participantes', $contenido, true);
    // $this->load->view('evaluacion/plantilla',$data);
    $this->load->view('plantilla_privado',$data);
}

// ajax convocatorias
public function combo_convocatoria()
{   
    $id_grupo=$this->input->post("id_grupo");
    $datos = $this->db->query("SELECT c.con_cargo,c.con_id FROM convocatoria c
        WHERE c.con_hasta>=CURDATE()
        ")->result();
    $data['msj_prueba'] = 'hola';
    $data['id_grupo_conv'] = $id_grupo;
    $data['lista_conv'] = $datos;
    $response=$this->load->view('evaluacion/combos_convocatoria_etapa',$data,TRUE);
    echo $response;    
}


public function caja_tipo()
{
    $data['msj_prueba'] = 'hola';
    $response=$this->load->view('evaluacion/combos_convocatoria_etapa',$data,TRUE);
    echo $response;
    // echo 'hola';
}
//ajax adicionar participante
public function add_post_ajax()
{   
    $id_grupo=$this->input->post("id_grupo");
    $pos_id=$this->input->post("pos_id");
    $postulante_detalle = array(                
            'gru_id' => $id_grupo,                    
            'pos_id' => $pos_id,

        );

    
    //antes de insertar verificamos si ya esta en el sistema
        $verificar = $this->db->query("SELECT * FROM zis_participante
            WHERE pos_id='$pos_id' and gru_id='$id_grupo'");
        if ($verificar->num_rows()>0) {
            // echo "si existe";
            $msj_error=false;
            
        }else{
            // echo "no existe";
            $msj_error=true;
            $this->db->set('par_usu_creacion', 0);
            $this->db->set('par_fecha_creacion', 'NOW()', FALSE);
            $this->db->insert('zis_participante', $postulante_detalle);            
        }
        //exit();
    

    // calcular el nro de participantes
    $contador = $this->db->query("SELECT COUNT(gru_id) as total,gru_id FROM
        zis_participante
        WHERE gru_id=$id_grupo
        GROUP BY gru_id
        ")->row();

    $this->db->set('gru_nro_participantes', $contador->total);    
    $this->db->where('gru_id',$id_grupo);
    $this->db->update('zis_grupo_evaluacion');
   
    $data['msj_error'] = $msj_error;   
    echo json_encode($data);    
}
public function tabla_postulantes()
{   
    $con_id=$this->input->post("id_conv");
    $texto=$this->input->post("texto");
    $etapa_id=$this->input->post("id_etapa");
    $id_grupo_conv=$this->input->post("id_grupo_conv");
    $datos = $this->db->query("SELECT c.con_cargo,p.pos_documento,e.pos_id,c.con_hasta,p.* FROM convocatoria c
        JOIN
        etapas e
        on c.con_id=e.con_id
        JOIN
        postulante p
        on e.pos_id=p.pos_id
        WHERE e.eta_etapa=$etapa_id and c.con_id=$con_id")->result();
    //
    $data['msj_prueba'] = 'hola';
    $data['datos'] = $datos;
    $data['convocatoria_texto'] = $texto;
    $data['id_grupo_tabla'] = $id_grupo_conv;

    if ($datos==null) {
     $response=$this->load->view('evaluacion/404',$data,TRUE);
     echo $response;

 }else{
     $response=$this->load->view('evaluacion/tabla_postulantes',$data,TRUE);
     echo $response;
 }



    // echo 'hola';
}

//combo por documentos
public function combo_documento()
{   
    $id_grupo=$this->input->post("id_grupo");    
    $data['msj_prueba'] = 'hola';
    $data['id_grupo_conv'] = $id_grupo;    
    $response=$this->load->view('evaluacion/caja_documento',$data,TRUE);
    echo $response;    
}

//combo por documentos
public function combo_paterno()
{   
    $id_grupo=$this->input->post("id_grupo");    
    $data['msj_prueba'] = 'hola';
    $data['id_grupo_conv'] = $id_grupo;    
    $response=$this->load->view('evaluacion/caja_paterno',$data,TRUE);
    echo $response;    
}

public function tabla_postulantes_doc()
{   

    $nro_documento=$this->input->post("nro_documento");
    $id_grupo_conv=$this->input->post("id_grupo_conv");
    $datos = $this->db->query("SELECT * FROM postulante
        WHERE pos_documento='$nro_documento'")->row();
    //
    $data['msj_prueba'] = 'hola';
    $data['datos'] = $datos;
    
    $data['id_grupo_tabla'] = $id_grupo_conv;

    if ($datos==null) {
     $response=$this->load->view('evaluacion/404',$data,TRUE);
     echo $response;

 }else{
     $response=$this->load->view('evaluacion/tabla_postulantes_doc',$data,TRUE);
     echo $response;
 }



    // echo 'hola';
}

public function tabla_postulantes_pat()
{   

    $ap_paterno=$this->input->post("ap_paterno");
    $id_grupo_conv=$this->input->post("id_grupo_conv");
    $datos = $this->db->query("SELECT * FROM postulante
        WHERE pos_apaterno='$ap_paterno'")->result();
    //
    $data['msj_prueba'] = 'hola';
    $data['datos'] = $datos;
    
    $data['id_grupo_tabla'] = $id_grupo_conv;

    if ($datos==null) {
     $response=$this->load->view('evaluacion/404',$data,TRUE);
     echo $response;

 }else{
     $response=$this->load->view('evaluacion/tabla_postulantes_pat',$data,TRUE);
     echo $response;
 }



    // echo 'hola';
}



// crear evaluacion
function create_participantes()
{    
    $id_grupo = $this->input->post('id_grupo');   
    $postulantes = $this->input->post('postulantes');

    // var_dump($id_grupo);exit();
    for ($j = 0; $j < count($postulantes); $j++) {
        $pos_id=$postulantes[$j];
        $postulante_detalle = array(                
            'gru_id' => $id_grupo,                    
            'pos_id' => $pos_id,

        );
        //antes de insertar verificamos si ya esta en el sistema
        $verificar = $this->db->query("SELECT * FROM zis_participante
            WHERE pos_id='$pos_id' and gru_id='$id_grupo'");
        if ($verificar->num_rows()>0) {
            // echo "si existe";
        }else{
            // echo "no existe";

            $this->db->set('par_usu_creacion', 0);
            $this->db->set('par_fecha_creacion', 'NOW()', FALSE);
            $this->db->insert('zis_participante', $postulante_detalle);
            $datos = $this->db->query("SELECT * from zis_grupo_evaluacion WHERE gru_id=$id_grupo")->row();
            $suma=$datos->gru_nro_participantes+count($postulantes);
            $this->db->set('gru_nro_participantes', $suma);    
            $this->db->where('gru_id',$id_grupo);
            $this->db->update('zis_grupo_evaluacion');
        }
        //exit();
    }

    // calcular el nro de participantes
    $contador = $this->db->query("SELECT COUNT(gru_id) as total,gru_id FROM
        zis_participante
        WHERE gru_id=$id_grupo
        GROUP BY gru_id
        ")->row();

    $this->db->set('gru_nro_participantes', $contador->total);    
    $this->db->where('gru_id',$id_grupo);
    $this->db->update('zis_grupo_evaluacion');

    redirect('Evaluacion/lista_participantes/'.$id_grupo);

}

function lista_participantes($id_grupo=null)
{
    $this->cabecera['accion']='Listado';       

    $estado_grupo = $this->db->query("SELECT * FROM
zis_grupo_evaluacion
WHERE gru_id=$id_grupo")->row();
    // nueva query
    $consulta = $this->db->query("SELECT CASE 
        WHen z.pos_id IS NULL THEN
        0
        ELSE
        1
        END as bandera 
        ,x.* FROM
        (SELECT p.*,x.par_id,x.gru_id FROM 
        postulante p
        JOIN
        zis_participante x
        on p.pos_id=x.pos_id
        WHERE x.gru_id=$id_grupo) x
        LEFT JOIN               
        (SELECT DISTINCT pos_id FROM zis_seguimiento s
        WHERE s.gru_id=$id_grupo) z
        on x.pos_id=z.pos_id");
    $datos=$consulta->result();
        // var_dump($datos);exit();

    $contenido['cabecera']=$this->cabecera;
    $contenido['datos'] = $datos;
    $contenido['id_grupo'] = $id_grupo;
    $contenido['estado_grupo'] = $estado_grupo->gru_estado;
    $data['contenido'] = $this->load->view('evaluacion/lista_participantes', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}

function habilitar($id_grupo=null)
{    
    $consulta = $this->db->query("SELECT * FROM zis_grupo_evaluacion  WHERE gru_id=$id_grupo")->row();

    if ($consulta->gru_estado == 0) {
        $gru_estado=1;
    }else{
        $gru_estado=0;
    }
    
    $this->db->set('gru_estado',$gru_estado); 
    $this->db->where('gru_id',$id_grupo);            
    $this->db->update('zis_grupo_evaluacion');

    if ($gru_estado==1) {
        redirect('Evaluacion/texto_habilitado/'.$id_grupo);
    }else{
        redirect('Evaluacion/listar/');    
    }
    
}

//habilitar evaluacion
function habilitar_eval($id_eval=null,$id_grupo=null)
{    
    $consulta = $this->db->query("SELECT * FROM zis_evaluacion  WHERE eva_id=$id_eval")->row();

    if ($consulta->eva_estado == 0) {
        $eva_estado=1;
    }else{
        $eva_estado=0;
    }
    
    $this->db->set('eva_estado',$eva_estado); 
    $this->db->where('eva_id',$id_eval);            
    $this->db->update('zis_evaluacion');
    redirect('Evaluacion/lista_evaluacion/'.$id_grupo);    
    
    
}

//texto al habilitar un grupo

function texto_habilitado($id_grupo=null)
{
    $evaluacion_data = $this->db->query("SELECT gru_mensaje_eval FROM zis_grupo_evaluacion where gru_id=$id_grupo ")->row();
    $combo_texto = $this->db->query("SELECT * FROM zis_texto_grupo ")->result();
    $this->cabecera['accion']='Texto de bienvenida'; 

    $contenido['cabecera']=$this->cabecera;
    
    $contenido['id_grupo'] = $id_grupo;
    $contenido['texto'] =$evaluacion_data->gru_mensaje_eval;
    $contenido['combo_texto'] =$combo_texto;
    
    $data['contenido'] = $this->load->view('evaluacion/texto_habilitado_evaluacion', $contenido, true);

    $this->load->view('plantilla_privado',$data);

}

//texto del combo seleccionado
public function texto_evaluacion()
{   
    $texto_id=$this->input->post("texto_id");
    
    $datos = $this->db->query("SELECT contenido FROM zis_texto_grupo where texto_id=$texto_id")->row();
    //
    $data['texto_contenido'] = $datos->contenido;
    echo json_encode($data);
}

//actualiza el mensaje para la evaluacion en el publico

function upd_mensaje_eval()
{
    // despues de guardar los datos se abre el form de texto instructivo
    $texto_bienvenida = $this->input->post('texto_bienvenida');
    
    $id_grupo = $this->input->post('id_grupo');

    $data = array(
        'gru_mensaje_eval' => $texto_bienvenida ,
    );
    $this->db->where('gru_id', $id_grupo);         
    $this->db->update('zis_grupo_evaluacion', $data);    
    redirect('Evaluacion/listar/');    
}



function delete_pos_id_sin_seg($par_id=null,$pos_id=null,$id_grupo=null)
{    
    // solo borra los participantes que no han tomado evaluacion
    // var_dump($par_id,$id_grupo);exit();

    $verificar = $this->db->query("SELECT * FROM zis_seguimiento
        WHERE pos_id='$pos_id' and gru_id='$id_grupo'");
    if ($verificar->num_rows()>0) {
        // si esta con evaluaciones
        
    }else{
        $this->db->where('par_id',$par_id);            
        $this->db->delete('zis_participante');

    //actualiza listado de participantes
    // calcular el nro de participantes
        $contador = $this->db->query("SELECT COUNT(gru_id) as total,gru_id FROM
            zis_participante
            WHERE gru_id=$id_grupo
            GROUP BY gru_id
            ")->row();

        $this->db->set('gru_nro_participantes', $contador->total);    
        $this->db->where('gru_id',$id_grupo);
        $this->db->update('zis_grupo_evaluacion');

    }
    redirect('Evaluacion/lista_participantes/'.$id_grupo);
}

//eliminar evaluaciones
function delete_eval($id_grupo=null,$id_eval=null)
{    
    
    // var_dump($id_grupo,$id_eval);exit();

    $verificar = $this->db->query("SELECT * FROM zis_seguimiento
        WHERE eva_id='$id_eval' and gru_id='$id_grupo'");
    if ($verificar->num_rows()>0) {
        // la evaluacion ha sido contestada al menos una vez
        
    }else{
        $this->db->where('eva_id',$id_eval);            
        $this->db->delete('zis_evaluacion');

    //actualiza listado de participantes
    // calcular el nro de evaluaciones
        $contador = $this->db->query("SELECT COUNT(gru_id) as total,gru_id FROM
            zis_evaluacion
            WHERE gru_id=$id_grupo
            GROUP BY gru_id
            ")->row();

        $this->db->set('gru_nro_eval', $contador->total);    
        $this->db->where('gru_id',$id_grupo);
        $this->db->update('zis_grupo_evaluacion');

    }
    redirect('Evaluacion/lista_evaluacion/'.$id_grupo);
}
//eliminar grupo evaluaciones
function delete_grupoeval($id_grupo=null)
{    
    
    //var_dump($id_grupo);exit();

    $verificar = $this->db->query("SELECT * FROM zis_seguimiento
        WHERE gru_id='$id_grupo'");
    if ($verificar->num_rows()>0) {
        // la evaluacion ha sido contestada al menos una vez
        
    }else{
        //los participantes del grupo
        $this->db->where('gru_id',$id_grupo);            
        $this->db->delete('zis_participante');
        //las evaluaciones del grupo
        $this->db->where('gru_id',$id_grupo);            
        $this->db->delete('zis_evaluacion');
        //el grupo
        $this->db->where('gru_id',$id_grupo);            
        $this->db->delete('zis_grupo_evaluacion');
    }
    redirect('Evaluacion/listar/');
}

	function agregar_carpeta($id_grupo=null)
	{
		@$opciones = $this->input->post('enviar');
		if($opciones == 'Guardar'){
			$data['zpla_id']=1;
			$data['tipo_eval_id']=4;
			$data['gru_id']=$id_grupo;
			$data['eva_titulo']='Carpeta';
			$data['eva_texto_bienvenida']=$this->input->post('texto_bienvenida');
			$data['eva_fecha_creacion']=date('Y-m-d H:i:s');
			$data['eva_usu_creacion']=$_SESSION[$this->presession.'id'];
			$this->db->insert('zis_evaluacion', $data);
			$idp=$this->db->insert_id();
			redirect('Evaluacion/lista_evaluacion/'.$id_grupo);
		}
		$this->cabecera['accion']='Agregar Carpeta';		
		$contenido['cabecera']=$this->cabecera;
		
		$contenido['action'] = 'Evaluacion/agregar_carpeta/'.$id_grupo;
		$contenido['id'] = '';
		$contenido['texto'] = '';
		$contenido['error_msj'] = '-';
		$contenido['id_grupo'] = $id_grupo;
		$data['contenido'] = $this->load->view('prueba_cuatro/texto_bienvenida', $contenido, true);
		$this->load->view('plantilla_privado',$data);

	}
	
	function editar_texto_instructivo($id_grupo=null,$id_eval=null)
	{
		@$opciones = $this->input->post('enviar');
		if($opciones == 'Guardar'){
			$data['eva_texto_bienvenida']=$this->input->post('texto_bienvenida');
			$data['eva_fecha_edicion']=date('Y-m-d H:i:s');
			$data['eva_usu_modificacion']=$_SESSION[$this->presession.'id'];
			$this->db->where('eva_id', $id_eval);         
			$this->db->update('zis_evaluacion', $data);
			redirect('Evaluacion/lista_evaluacion/'.$id_grupo);
		}
		$evaluacion_data = $this->db->query("SELECT eva_texto_bienvenida, gru_id FROM zis_evaluacion where eva_id=$id_eval")->row();
		$this->cabecera['accion']='Editar Texto Instructivo'; 
		$contenido['action'] = 'Evaluacion/editar_texto_instructivo/'.$id_grupo.'/'.$id_eval;
		$contenido['cabecera']=$this->cabecera;
		$contenido['texto'] = $evaluacion_data->eva_texto_bienvenida;
		$contenido['id'] = $id_eval;
		$contenido['id_grupo'] = $id_grupo;
		$data['contenido'] = $this->load->view('prueba_cuatro/texto_bienvenida', $contenido, true);
		$this->load->view('plantilla_privado',$data);
	}
}


?>