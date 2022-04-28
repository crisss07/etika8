<?php
require_once('Controladoradmin.php');

class Notificacion extends Controladoradmin
{
    function __construct()
    {
	   parent::__construct();
        force_ssl();
	$this->load->helper(array('url','form','html'));
        $this->load->library(array('form_validation','tool_general'));

         //****** definiendo nombre de carpeta por defecto
        $this->carpeta='notificacion/';
        $this->controlador='notificacion/';

        $this->tabla='notificaciones';
        $this->prefijo='not_';
        //******* definiendo campos de la tabla
        $this->campo=array($this->prefijo.'titulo',$this->prefijo.'contenido');
         

        $this->formulario_agregar='notificacion_agregar';
        $this->formulario_editar='notificacion_agregar';
        $this->action_defecto='index';
        

         //****** cargando el modelo
        $this->modelo='modelo_notificacion';
        $this->load->model($this->carpeta.'Notificacion_model',$this->modelo,TRUE);

        $this->cabecera['titulo']='Notificaciones';
        $this->rutaimg=@$this->constantes['nombresitio'].'files/img/';              

        $this->boton=7;   
        //adicionar nuevos cambios
    
        //fin de adicionar
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
        $this->cabecera['accion']='Listado';                                            
        $consulta = $this->db->query('
        SELECT
        '.$this->prefijo.'id,
        '.$this->prefijo.'titulo,
        '.$this->prefijo.'contenido
        FROM
        '.$this->tabla.'        
        ORDER BY
        '.$this->prefijo.'id asc'
        );
        $datos=$consulta->result_array();        
                          
        $contenido['cabecera']=$this->cabecera;
        $contenido['datos'] = $datos;        
        $data['contenido'] = $this->load->view($this->carpeta.'index', $contenido, true);
        $this->load->view('plantilla_privado',$data);

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
                     'field'   => $prefijo.'titulo',
                     'label'   => 'Titulo',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => $prefijo.'contenido',
                     'label'   => 'Notificaci&oacute;n',
                     'rules'   => 'required'
                  )
            );
        return $config;

    }

     function set_mensajes_error()
    {
       $mensajes = array(
               array(
                     'regla'   => 'required',
                     'mensaje'   => 'Debe introducir el campo %s'
                  ),
              array(
                     'regla'   => 'min_length',
                     'mensaje'   => 'El campo %s debe tener al menos %s carácteres'
                  ),              
              array(
                     'regla'   => 'is_natural',
                     'mensaje'   => 'Debe seleccionar un Lugar / Campo'
                  )
            );
       return $mensajes;
    }

    function vista_editar()
    {
        if(@$this->definirform){$this->definir_form_editar();}
        else{$this->definir_form_agregar();}

        $uri = $this->uri->uri_to_assoc(3);
        $id=$uri['id'];
        if(@$this->vtip){$this->tip=$uri['tip'];}
        if(@$this->vidp){@$this->idp=$uri['idp'];}
        
        $prefijo=$this->prefijo;

        $consulta = $this->db->query('
        SELECT * FROM '.$this->tabla.' WHERE '.$this->prefijo.'id='.$id);
        $fila=$consulta->first_row('array');

        $this->cabecera['accion']='Editar';
        if(@$this->campoup_img){
            for($i=0;$i<count($this->campoup_img);$i++)
             {
                $j=$i+1;
                $fila[$this->prefijo.'img_borrar'.$j]=$fila[$this->campoup_img[$i]];
                $fila[$this->campoup_img[$i]]='';
             }
        }
        if(@$this->campoup_img){
            for($i=0;$i<count($this->campoup_adj);$i++)
             {
                $j=$i+1;
                $fila[$this->campoup_adj[$i].'_borrar'.$j]=$fila[$this->campoup_adj[$i]];
                $fila[$this->campoup_adj[$i]]='';
             }
        }
        $contenido['cabecera']=$this->cabecera;
        $contenido['action'] = $this->controlador.'guardar_edicion';
        $contenido['fila'] = $fila;

        $data['contenido'] = $this->load->view($this->carpeta.$this->formulario_editar,$contenido, true);
        $this->load->view('plantilla_privado', $data);

    }

    //guardar datos
    function guardar_edicion() {//guardar datos de editor html
    $this->definir_form_agregar();
    
    $modelo = $this->modelo;
    $this->cabecera['accion'] = 'Editar';
    $prefijo = $this->prefijo;
    
    $id=$this->input->post($this->prefijo . 'id');
    

        $titulo=$this->input->post($this->prefijo . 'titulo');
        $datocontenido=$this->input->post($this->prefijo . 'contenido');

    if ($this->form_validation->run() == FALSE) {

        $id = $this->input->post($this->prefijo . 'id');
        $consulta = $this->db->query('
            SELECT * FROM ' . $this->tabla . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila1 = $consulta->first_row('array');

        for ($i = 0; $i < count( array(@$this->campoup_img)); $i++) {
            $j = $i + 1;
            @$fila[$this->prefijo . 'img_borrar' . $j] = $fila1[@$this->campoup_img[$i]];
            @$fila[$this->campoup_img[$i]] = '';
        }
        for ($i = 0; $i < count(array(@$this->campoup_adj)); $i++) {
            $j = $i + 1;
            @$fila[$this->campoup_adj[$i] . '_borrar' . $j] = $fila1[@$this->campoup_adj[$i]];
            @$fila[$this->campoup_adj[$i]] = '';
        }

        $fila[$this->prefijo . 'titulo'] = $titulo;
        $fila[$this->prefijo . 'contenido'] = $datocontenido;
        $fila[$this->prefijo . 'id'] = $id;
        
        $contenido['cabecera'] = array($this->cabecera);   
        //$contenido['titulo'] = 'Notificaciones'; 
        $contenido['fila'] = $fila;
        $contenido['action'] = $this->controlador . 'guardar_edicion';
        $data['contenido'] = $this->load->view($this->carpeta . $this->formulario_editar, $contenido, true);
        $this->load->view('plantilla_privado', $data);
    } else {//si todo es correcto ingresa 
        
        $this->$modelo->agregar_datos_edicion($prefijo,$titulo,$datocontenido,$id);
        redirect('Notificacion');
        
        
    }
    
}



}


?>