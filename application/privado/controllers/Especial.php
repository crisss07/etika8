<?php
require_once('controladoradmin.php');

class Especial extends Controladoradmin
{    
    var $titulo;
    var $controlador='especial/';
    var $carpeta='servicio/';
    function __construct()
    {
	parent::__construct(); 
        force_ssl();
	$this->load->helper(array('url','form'));
        $this->load->helper('html');
        $this->load->library(array('form_validation','tool_general','tool_entidad'));

        $this->tabla='especial_servicio';
        $this->prefijo='esp_';
        $this->tabla1='etiko';
        $this->prefijo1='eti_';

         //******conf uploads
        $this->config_normal['upload_path'] = './archivos/'.$this->carpeta.'lectura_complementaria/';
        $this->config_normal['allowed_types'] = 'doc|pdf|txt|rar|zip';
	$this->config_normal['max_size']	= '3072';
        $this->load->library('upload',$this->config_normal);

        $this->formulario_agregar='especial_form';
        $this->formulario_editar='especial_form';
        $this->campo=array($this->prefijo.'area',$this->prefijo.'desde',$this->prefijo.'hasta',$this->prefijo.'monto',$this->prefijo.'facturacion');
        $this->modelo='modelo_especial';
        $this->load->model($this->carpeta.'Especial_model',$this->modelo,TRUE);

        $this->urifull=$this->uri->uri_to_assoc();
        $this->idc=$this->urifull['idc'];
        $this->ids=$this->urifull['ids'];
        $this->vidc='cli_id';
        $this->vids='com_id';
        if($this->vidc){
            $consultac = $this->db->query('
                SELECT
                cli_nombre as cliente                
                FROM
                clientes 
                WHERE
                cli_id='.$this->idc);
            $filac=$consultac->row_array('array');
            $consultas = $this->db->query('
                SELECT
                com_nombre as servicio
                FROM
                combos
                WHERE
                com_id='.$this->ids);
            $filas=$consultas->row_array('array');            
            $this->superior=array(
                'titulop'=>$filac['cliente'],
                'titulop1'=>$filas['servicio']
            );
            $this->msj_retorno='Volver';
            $this->ruta_retorno='servicio/listar';
            $this->superior['titulonom']='Cliente: ';
            $this->superior['titulonom1']='Servicio: ';
        }
        
        $this->action_defecto='listar';
        //$this->no_mostrar_enlaces=1;
        
        $this->cabecera['titulo']='Servicios Especificos';
        
        //$this->ruta=base_url().'archivos/';
        $this->ruta=$this->tool_entidad->sitio().'archivos/';
        $this->rutarchivo=$this->tool_entidad->sitio().'archivos/';
        $this->rutaimg=$this->tool_entidad->sitio().'files/img/';
        $this->rutabase=$this->tool_entidad->sitioindex();                       
        $this->ruta=$this->config_normal['upload_path'];
        $this->orden=$this->prefijo.'orden';        
        
        $this->presession=$this->tool_entidad->presession();
        session_start();
        if (!isset($_SESSION[$this->presession.'usuario']))
        {
          redirect(base_url().index_page());
        }
        if($_SESSION[$this->presession.'permisos']>='3') {
            redirect('inicio');
        }
        switch ($_SESSION[$this->presession.'permisos']){
            case "1":                
                $this->nuevo=true;
                $this->editar=true;
                $this->eliminar=true;
                break;
            case "2":                
                $this->nuevo=false;
                $this->editar=true;
                $this->eliminar=false;
                break;         
        }

    }
    function index()
    {
        
    }

    function listar()
    {        
        $this->cabecera['accion']='Listado';
        $this->campos_listar=array('Fecha desde','Fecha hasta','Descripción del Servicio','Resp. ETIKO','Monto (Bs)','Tipo Facturación');
        $this->campos_reales=array($this->prefijo.'desde',$this->prefijo.'hasta',$this->prefijo.'area','etiko',$this->prefijo.'monto',$this->prefijo.'facturacion');
        $this->hiddens=array($this->prefijo.'id');
        $consulta = $this->db->query('
        SELECT
        '.$this->prefijo.'id,
        '.$this->prefijo.'desde,
        '.$this->prefijo.'hasta,
        '.$this->prefijo.'monto,
        '.$this->prefijo.'area,
        case '.$this->prefijo.'facturacion
                when "1" then "ETIKA"
                when "2" then "Consultor Individual"                
        end as '.$this->prefijo.'facturacion,
        '.$this->prefijo1.'nombre as etiko
        FROM
        '.$this->tabla.' a, '.$this->tabla1.' b
        where
        a.'.$this->vidc.'="'.$this->idc.'" and a.'.$this->vids.'="'.$this->ids.'" and a.'.$this->prefijo1.'id=b.'.$this->prefijo1.'id'
        );
        $datos=$consulta->result_array();
        
        $contenido['campos_listar']=$this->campos_listar;
        $contenido['campos_reales']=$this->campos_reales;        
        $contenido['hiddens']=$this->hiddens;        
        $contenido['cabecera']=$this->cabecera;
        $contenido['datos'] = $datos;        
        $data['contenido'] = $this->load->view($this->carpeta.'listar_servicio', $contenido, true);
        //$data['contenido'] = $this->load->view('controladoradmin/listar', $contenido, true);
        $this->load->view('plantilla_privado',$data);
    }
    function agregar() {
        $uri = $this->uri->uri_to_assoc();
        $this->idc=$uri['idc'];
        $this->ids=$uri['ids'];
        if(!$this->nuevo)
            redirect($this->controlador.'listar/idc/'.$this->idc.'/ids/'.$this->ids);
        $this->definir_form_agregar();
        $prefijo=$this->prefijo;
        $prefijo1=$this->prefijo1;
        $modelo=$this->modelo;
        $ruta_origen=$this->ruta;        

        $this->cabecera['accion']='Nuevo';

        if ($this->form_validation->run()==FALSE) {            
            if($this->vidc) {                
                $enl='/idc/'.$this->idc.'/ids/'.$this->ids.''.@$enl;
            }
            $fila[$prefijo1.'id']=$this->input->post($prefijo1.'id');
            $contenido['fila']=$fila;
            $contenido['cabecera']=$this->cabecera;
            $contenido['action'] = $this->controlador.'agregar'.$enl;
            $data['contenido'] = $this->load->view($this->carpeta.$this->formulario_agregar, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        }
        else {
            for($i=0;$i<count($this->campo);$i++) {
                $data[$this->campo[$i]] = $this->input->post( $this->campo[$i]);
            }
            if($this->vidc) {
                $this->idc=$uri['idc'];
                $this->ids=$uri['ids'];
                $data[$this->vidc]=$this->idc;
                $data[$this->vids]=$this->ids;
            }
            $data[$prefijo1.'id']=$this->input->post($prefijo1.'id');            
            $id=$this->$modelo->agregar($data);
            if($id) {
                redirect($this->controlador.$this->action_defecto.'/idc/'.$this->idc.'/ids/'.$this->ids);
            }
        }
    }

    function editar() {
        $uri = $this->uri->uri_to_assoc(3);
        $id=$uri['id'];
        $this->idc=$uri['idc'];
        $this->ids=$uri['ids'];
        if(!$this->editar)
            redirect($this->controlador.'listar/idc/'.$this->idc.'/ids/'.$this->ids);
        if(@$this->definirform) {
            $this->definir_form_editar();
        }
        else {
            $this->definir_form_agregar();
        }        
        $enl='/idc/'.$this->idc.'/ids/'.$this->ids.''.@$enl;

        $prefijo=$this->prefijo;
        $consulta = $this->db->query('
            SELECT * FROM '.$this->tabla.' WHERE '.$this->prefijo.'id='.$id);
        $fila=$consulta->first_row('array');                

        $this->cabecera['accion']='Editar';
        $contenido['cabecera']=$this->cabecera;
        $contenido['action'] = $this->controlador.'guardar_editar'.$enl;
        $contenido['fila'] = $fila;
        $data['contenido'] = $this->load->view($this->carpeta.$this->formulario_editar,$contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function guardar_editar() {
        if(@$this->definirform) {
            $this->definir_form_editar();
        }
        else {
            $this->definir_form_agregar();
        }
        $modelo=$this->modelo;
        $this->cabecera['accion']='Editar';
        $prefijo=$this->prefijo;
        $prefijo1=$this->prefijo1;
        $ruta_origen=$this->ruta;
        $uri = $this->uri->uri_to_assoc(3);
        $this->idc=$uri['idc'];
        $this->ids=$uri['ids'];
        if ($this->form_validation->run()==FALSE) {
            $enl='/idc/'.$this->idc.'/ids/'.$this->ids.''.@$enl;
            $id=$this->input->post($this->prefijo.'id');
            $consulta = $this->db->query('
                SELECT * FROM '.$this->tabla.' WHERE '.$this->prefijo.'id='.$id);
            $fila1=$consulta->first_row('array');
            $fila[$this->prefijo.'id']=$fila1[$this->prefijo.'id'];
            $fila[$prefijo1.'id']=$this->input->post($prefijo1.'id');
            $contenido['cabecera']=$this->cabecera;
            $contenido['fila']=$fila;
            $contenido['action'] = $this->controlador.'guardar_editar'.$enl;
            $data['contenido'] = $this->load->view($this->carpeta.$this->formulario_editar,$contenido, true);
            $this->load->view('plantilla_privado', $data);
        }
        else {
            for($i=0;$i<count($this->campo);$i++) {
                $data[$this->campo[$i]] = $this->input->post($this->campo[$i]);
            }
            $data[$prefijo1.'id']=$this->input->post($prefijo1.'id');
            $data[$this->prefijo.'id']=$this->input->post($this->prefijo.'id');
            if($this->$modelo->editar($data)) {
                redirect($this->controlador.$this->action_defecto.'/idc/'.$this->idc.'/ids/'.$this->ids);
            }
        }
    }
    function eliminar($var,$id)
    {
        $uri = $this->uri->uri_to_assoc(3);
        $id=$uri['id'];
        $this->idc=$uri['idc'];
        $this->ids=$uri['ids'];
        if(!$this->eliminar)
            redirect($this->controlador.'listar/idc/'.$this->idc.'/ids/'.$this->ids);
        $ruta_origen=$this->ruta;
        $consulta = $this->db->query('
        SELECT * FROM '.$this->tabla.' WHERE '.$this->prefijo.'id='.$id);

        $fila=$consulta->first_row('array');
        for($i=0;$i<count($this->campoup_img);$i++)
         {
             if($this->campoup_img[$i])
             {
                     $borrar_img[$i]=$fila[$this->campoup_img[$i]];
                     @unlink($ruta_origen.$borrar_img[$i]);
                     $nombre_thum='t_'.substr($borrar_img[$i],0,-4).substr($borrar_img[$i],-4);
                     @unlink($ruta_origen.$nombre_thum);
                     $fila[$this->campoup_img[$i]]='';
             }
         }

         for($i=0;$i<count($this->campoup_adj);$i++)
         {
             if($this->campoup_adj[$i])
             {
                     $borrar_adj[$i]=$fila[$this->campoup_adj[$i]];
                     @unlink($ruta_origen.$borrar_adj[$i]);
                     $fila[$this->campoup_adj[$i]]='';
             }
         }

         if($this->enlaces){
             for($i=1;$i<=(count($this->enlaces)/$this->nroenlaces);$i++){
                 $this->eliminarsub($this->enlaces['campo'.$i],$id,$this->enlaces['id'.$i],$this->enlaces['url'.$i],$this->enlaces['tabla'.$i],$this->enlaces['campoborrar'.$i]);                 
             }             
         }         
         $this->db->delete($this->tabla, array($this->prefijo.'id' => $fila[$this->prefijo.'id']));
         redirect($this->controlador.'listar/idc/'.$this->idc.'/ids/'.$this->ids);
    }
   

    function definir_form_agregar()
    {
        $prefijo=$this->prefijo;
        $config=$this->set_reglas_validacion();        
        $mensajes=$this->set_mensajes_error();

        // inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach($mensajes as $msj)
           $this->form_validation->set_message($msj['regla'],$msj['mensaje']);
        // inicio asignando las reglas y mensajes de validacion

    }


    function set_reglas_validacion()
    {
        $prefijo=$this->prefijo;
        $config = array(
               array(
                     'field'   => $prefijo.'area',
                     'label'   => 'Descripción del Servicio',
                     'rules'   => 'min_length[0]'
                  ),
               array(
                     'field'   => $prefijo.'hasta',
                     'label'   => 'Fecha Hasta',
                     'rules'   => 'min_length[0]'
                  ),
               array(
                     'field'   => $prefijo.'desde',
                     'label'   => 'Fecha Desde',
                     'rules'   => 'min_length[0]'
                  ),
               array(
                     'field'   => $prefijo.'monto',
                     'label'   => 'Monto',
                     'rules'   => 'required|is_numeric'
                  ),
               array(
                     'field'   => $prefijo.'facturacion',
                     'label'   => 'el Tipo de Facturación',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => $prefijo.'id',
                     'label'   => 'id',
                     'rules'   => 'min_length[0]'
                  ),
               array(
                     'field'   => 'idp',
                     'label'   => 'idp',
                     'rules'   => 'min_length[0]'
                  ),
               array(
                     'field'   => 'eti_id',
                     'label'   => 'ETIKO',
                     'rules'   => 'is_natural'
                  )           
            );
        return $config;

    }

     function set_mensajes_error()
    {
       $mensajes = array(
               array(
                     'regla'   => 'required',
                     'mensaje'   => 'Debe introducir %s'
                  ),
              array(
                     'regla'   => 'min_length',
                     'mensaje'   => 'El campo %s debe tener al menos %s carácteres'
                  ),
              array(
                     'regla'   => 'valid_email',
                     'mensaje'   => 'Debe escribir una dirección de email correcta'
                  ),
              array(
                     'regla'   => 'is_numeric',
                     'mensaje'   => 'El Monto debe ser solo numeros'
                  ),
              array(
                     'regla'   => 'is_natural',
                     'mensaje'   => 'Debe seleccionar al %s'
                  )
            );
       return $mensajes;
    }

    
}


?>