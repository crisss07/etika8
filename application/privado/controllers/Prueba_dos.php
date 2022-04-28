<?php
require_once('Controladoradmin.php');

class Prueba_dos extends Controladoradmin
{
    function __construct()
    {
      parent::__construct();
      force_ssl();
      $this->load->helper(array('url','form','html'));
      $this->load->library(array('form_validation','tool_general'));

         //****** definiendo nombre de carpeta por defecto
      $this->carpeta='plantilla/';
      $this->controlador='Prueba_dos/';

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

function texto_uno($id=null)
{
    //var_dump($id);exit();
    $this->cabecera['accion']='Texto Instructivo'; 

    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id;
   // $contenido['tipo'] = $tipo;
    $data['contenido'] = $this->load->view('preg_dos/text_uno', $contenido, true);

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

    redirect('Prueba_dos/preguntas/'.$id);    
}

function preguntas($id)
{      
    $this->cabecera['accion']='Preguntas'; 
    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id;


    $resultado = $this->db->query("SELECT * from zis_plantilla_e_dos WHERE zpla_id=$id
        ORDER BY pre_nro DESC LIMIT 1");
    
    
    if ($resultado->num_rows()>0) {
        $consulta =$resultado->row();
        $ultimo_nro=$consulta->pre_nro;
        $num_ini=$ultimo_nro+1;
        $num_fin=$num_ini+15;
        $grup_ini=($ultimo_nro/4)+1;
    }
    else{
        $num_ini=1;
        $num_fin=16;
        $grup_ini=1;
    }

    //var_dump($msj);exit();

    $contenido['num_ini'] = $num_ini;
    $contenido['num_fin'] = $num_fin;
    $contenido['grup_ini'] = $grup_ini;    

    $data['contenido'] = $this->load->view('preg_dos/preguntas', $contenido, true);
    $this->load->view('plantilla_privado',$data);  
}
    //tabla




    // crear

function crear_preguntas()
{
        // despues de guardar los datos se abre el form de texto instructivo


    $id = $this->input->post('id');
    $num_ini = $this->input->post('num_ini');
    $num_fin = $this->input->post('num_fin');

    //var_dump($p1,$id,$num_ini,$num_fin);exit();

    
        // $hora = $this->input->post('hora');
        // $min = $this->input->post('min');
        // $sec = $this->input->post('sec');

        //var_dump($titulo.$tipo);exit();
    for ($i=$num_ini; $i <=$num_fin ; $i++) { 
        // code...
        $data = array(
            'zpla_id' => $id ,
            'pre_nro' => $i,
            'pre_texto' => $this->input->post('p'.$i),
        );
        $this->db->set('pre_dos_fecha_creacion', 'NOW()', FALSE);            
        $this->db->insert('zis_plantilla_e_dos', $data);
    }
    if ($num_fin==80) {
        // code...
        redirect('Prueba_dos/texto_despedida/'.$id); 
    }else{
        redirect('Prueba_dos/preguntas/'.$id); 

    }
    
}

function texto_despedida($id=null)
{
    //var_dump($id);exit();
    $this->cabecera['accion']='Texto Despedida'; 

    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id;
   // $contenido['tipo'] = $tipo;
    $data['contenido'] = $this->load->view('preg_dos/texto_despedida', $contenido, true);

    $this->load->view('plantilla_privado',$data);
}

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
    $datas=$resultado->result_array();


    $contenido['num_ini'] = $num_ini;
    $contenido['num_fin'] = $num_fin;
    $contenido['grup_ini'] = $grup_ini;    
    $contenido['data'] = $datas;  

    if ($posicion==80) {
        // code...
        redirect('Plantilla/texto_despedida/'.$id); 
    }else{
        $data['contenido'] = $this->load->view('preg_dos/vista_previa_preguntas', $contenido, true);

    }    
    $this->load->view('plantilla_privado',$data);  
}

//edicion prueba dos
function editar_plantilla($id_pla=null)
{   
    // redirect('Prueba_tres/editar_preguntas/'.$id_pla.'/1');    
    redirect('Prueba_dos/listado_opciones_edicion/'.$id_pla);    
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
    $data['contenido'] = $this->load->view('preg_dos/lista_edicion', $contenido, true);
    $this->load->view('plantilla_privado',$data);

}
function vista_edicion_titulo($id_pla=null)
{
    $resultado = $this->db->query("SELECT * from zis_plantillas
        WHERE zpla_id=$id_pla ")->row();
    $this->cabecera['accion']='Editar Titulo'; 
    //var_dump($resultado->zpla_texto_bienvenida);exit();
    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id_pla;
    $contenido['valor_texto'] = $resultado->zpla_titulo;
    $data['contenido'] = $this->load->view('preg_dos/editar_titulo', $contenido, true);
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

    redirect('Prueba_dos/listado_opciones_edicion/'.$id);    
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
    
    $data['contenido'] = $this->load->view('preg_dos/editar_texto', $contenido, true);

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

    redirect('Prueba_dos/listado_opciones_edicion/'.$id);    
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

    redirect('Prueba_dos/listado_opciones_edicion/'.$id);    
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

    redirect('Prueba_dos/listado_opciones_edicion/'.$id);    
}
function editar_preguntas($id=null,$posicion=null)
{      
    $this->cabecera['accion']='Editar Preguntas'; 
    $contenido['cabecera']=$this->cabecera;
    $contenido['id'] = $id;


    // $resultado = $this->db->query("SELECT * from zis_plantilla_e_dos WHERE zpla_id=$id
    //     ORDER BY pre_nro DESC LIMIT 1");
    
    
    if ($posicion!=1) {
        // $consulta =$resultado->row();
        // $ultimo_nro=$consulta->pre_nro;
        // $num_ini=$ultimo_nro+1;
        // $num_fin=$num_ini+15;
        // $grup_ini=($ultimo_nro/4)+1;

        $num_ini=$posicion+1;
        $num_fin=$num_ini+15;
        $grup_ini=($posicion/4)+1;
    }
    else{
        $num_ini=1;
        $num_fin=16;
        $grup_ini=1;
    }
    
    $resultado = $this->db->query("SELECT * from zis_plantilla_e_dos
        WHERE zpla_id=$id and  pre_nro BETWEEN $num_ini and $num_fin ORDER BY pre_nro ASC
        ");
    if ($resultado->num_rows()==0) {
        $this->crear_preguntas_validar($id,$num_ini,$num_fin);    
        $resultado = $this->db->query("SELECT * from zis_plantilla_e_dos
        WHERE zpla_id=$id and  pre_nro BETWEEN $num_ini and $num_fin ORDER BY pre_nro ASC
        ");
    }
    


    $datos_preg=$resultado->result_array();
    //var_dump($msj);exit();
    $contenido['dp'] = $datos_preg;
    $contenido['num_ini'] = $num_ini;
    $contenido['num_fin'] = $num_fin;
    $contenido['grup_ini'] = $grup_ini;    

    $data['contenido'] = $this->load->view('preg_dos/editar_preguntas', $contenido, true);
    $this->load->view('plantilla_privado',$data);  
}
//validar e insertar datos en caso de campos vacios
function crear_preguntas_validar($id,$num_ini,$num_fin)
{    
    
    
    for ($i=$num_ini; $i <=$num_fin ; $i++) { 
        // validar si el nro de preg existe
        $resultado = $this->db->query("SELECT * from zis_plantilla_e_dos WHERE zpla_id=$id and  pre_nro=$i");

        if ($resultado->num_rows()==0) {
            $data = array(
                'zpla_id' => $id,
                'pre_nro' => $i,
                'pre_texto' => '',
            );
            $this->db->set('pre_dos_fecha_creacion', 'NOW()', FALSE);            
            $this->db->insert('zis_plantilla_e_dos', $data);
        }
    }
}


   // editar

function update_preguntas()
{
        // despues de guardar los datos se abre el form de texto instructivo


    $id = $this->input->post('id');
    $num_ini = $this->input->post('num_ini');
    $num_fin = $this->input->post('num_fin');

    //var_dump($p1,$id,$num_ini,$num_fin);exit();

    
        // $hora = $this->input->post('hora');
        // $min = $this->input->post('min');
        // $sec = $this->input->post('sec');

        //var_dump($titulo.$tipo);exit();
    for ($i=$num_ini; $i <=$num_fin ; $i++) { 
        

        $this->db->set('pre_dos_fecha_edicion', 'NOW()', FALSE);            
        $this->db->set('pre_texto',$this->input->post('p'.$i));
        $this->db->where('pre_nro',$i);
        $this->db->where('zpla_id',$id);   
        $this->db->update('zis_plantilla_e_dos');
    }
    if ($num_fin==80) {
        // code...
        redirect('Prueba_dos/listado_opciones_edicion/'.$id); 
    }else{
        redirect('Prueba_dos/editar_preguntas/'.$id.'/'.$num_fin); 

    }
    
}



function eliminar_plantilla($id_pla)
{   
    //borrado de una plantilla tablas, zis_plantillas, zis_plantilla_e_dos, 
    //
    //tabla de plantillas
    $this->db->where('zpla_id', $id_pla);         
    $this->db->delete('zis_plantillas');

    //tabla de preguntas
    $this->db->where('zpla_id', $id_pla);         
    $this->db->delete('zis_plantilla_e_dos');
    
    
    redirect('Plantilla/listar/');    
}

}


?>