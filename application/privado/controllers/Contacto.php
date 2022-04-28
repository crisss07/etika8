<?php

require_once('Controladoradmin.php');

class Contacto extends Controladoradmin {

    function __construct() {
        parent::__construct();
        $this->load->helper('url', 'form', 'html');
        
        $this->load->helper('email');//nuevo
        $this->load->library(array('form_validation', 'tool_general'));
        force_ssl();

        //var_dump($this->tool_entidad->sitioindex()); //exit ();
        //****** definiendo nombre de carpeta por defecto
        $this->carpeta = 'contacto/';
        $this->controlador = 'contacto/';

        //******conf uploads
        $this->config_normal['upload_path'] = './archivos/contacto/';
        $this->config_normal['allowed_types'] = 'doc|pdf|txt|rar|gif|jpg|png';
        $this->config_normal['max_size'] = '2048';
        $this->load->library('upload', $this->config_normal);

        $this->tabla = 'contacto';
        $this->prefijo = 'con_';
        //******* definiendo campos de la tabla   
        $this->campo = array($this->prefijo . 'pie', $this->prefijo . 'email', 'con_mesaje_enviado');

        $uri = $this->uri->uri_to_assoc(3);
        $this->sub = @$uri['sub'];
        switch (@$uri['sub']) {
            case "0":
            $this->formulario_agregar = 'contacto_pie_form';
            $this->formulario_editar = 'contacto_pie_form';
            break;
            case "1":
            $this->formulario_agregar = 'contacto_email_form';
            $this->formulario_editar = 'contacto_email_form';
            break;
        }
        $this->action_defecto = '';
        //$this->noenlace_retorno='';
        $this->no_mostrar_enlaces = 1;
        $this->boton = 7;


        //****** cargando el modelo
        $this->modelo = 'modelo_contacto';
        $this->load->model($this->carpeta . 'contacto_model', $this->modelo, TRUE);

        $this->cabecera['titulo'] = 'Contactos';

        $this->ruta = $this->config_normal['upload_path'];

        $this->presession = $this->tool_entidad->presession();
        session_start();
        if (!isset($_SESSION[$this->presession . 'usuario'])) {
            redirect(base_url() . index_page());
        }
        if ($_SESSION[$this->presession . 'permisos'] >= '2') {
            redirect('inicio');
        }
    }

    function index() {

        $data['contenido'] = $this->load->view($this->carpeta . 'mensaje_exito', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }
      function submenu()
    {
        $contenido['cabecera']=$this->cabecera;
        $data['contenido'] = $this->load->view($this->carpeta.'index', $contenido, true);
        $this->load->view('plantilla_privado_config',$data);

    }  

    function listar() {
        $this->cabecera['accion'] = 'Listado';
        $this->campos_listar = array('Pie de Contacto', 'Email');
        $this->campos_reales = array($this->prefijo . 'pie', $this->prefijo . 'email');
        $this->contenido = $this->prefijo . 'contenido';

        $this->ordencampo = array(
            'campo1' => $this->prefijo . 'email',
            'campo2' => $this->prefijo . 'orden'
        );
        $this->ordenlabel = array(
            'campo1' => 'Email',
            'campo2' => 'Numero'
        );

        $this->hiddens = array($this->prefijo . 'id');
        $consulta = $this->db->query('
            SELECT
            ' . $this->prefijo . 'id,
            ' . $this->prefijo . 'pie ,
            ' . $this->prefijo . 'email,
            ' . $this->prefijo . 'orden,
            ' . $this->prefijo . 'actual
            FROM
            ' . $this->tabla . '        
            ORDER BY
            ' . $this->prefijo . 'orden asc'
        );
        $datos = $consulta->result_array();

        // var_dump($filasup); exit ();

        $contenido['campos_listar'] = $this->campos_listar;
        $contenido['ordencampo'] = $this->ordencampo;
        $contenido['ordenlabel'] = $this->ordenlabel;
        $contenido['campos_reales'] = $this->campos_reales;
        $contenido['contenido'] = $this->contenido;
        $contenido['actual'] = $this->actual;
        $contenido['hiddens'] = $this->hiddens;
        $contenido['adjunto'] = $this->adjunto;
        $contenido['imagen'] = $this->imagen;
        $contenido['cabecera'] = $this->cabecera;
        $contenido['orden'] = $this->orden;
        $contenido['datos'] = $datos;
        //$data['contenido'] = $this->load->view($this->carpeta.'listar', $contenido, true);
        $data['contenido'] = $this->load->view('controladoradmin/listar', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function listarintro() {

        $this->cabecera['accion'] = 'Listado';
        /*
          $this->campos_listar=array('Titulo','Contenido','Fecha creación');
          $this->campos_reales=array($this->prefijo.'titulo',$this->prefijo.'contenido',$this->prefijo.'fecha');
          $this->contenido=$this->prefijo.'contenido';
          $this->hiddens=array($this->prefijo.'id');

          $consulta = $this->db->query('
          SELECT
          '.$this->prefijo.'id,
          '.$this->prefijo.'titulo ,
          '.$this->prefijo.'contenido,
          '.$this->prefijo.'fecha
          FROM
          '.$this->tabla.'
          WHERE
          tipo="'.$this->tip.'"
          ORDER BY
          '.$this->prefijo.'fecha desc'

          );
          $datos=$consulta->result_array();
         */
          $consulta0 = $this->db->query('
            SELECT
            int_contenido as contenido
            FROM
            noticia_intro
            WHERE
            tipo="' . $this->tip . '"'
        );
          $filasup = $consulta0->row_array();




        // var_dump($filasup); exit ();

          $contenido['campos_listar'] = $this->campos_listar;
          $contenido['campos_reales'] = $this->campos_reales;
          $contenido['contenido'] = $this->contenido;
          $contenido['hiddens'] = $this->hiddens;
          $contenido['adjunto'] = $this->adjunto;
          $contenido['imagen'] = $this->imagen;
          $contenido['cabecera'] = $this->cabecera;
          $contenido['datos'] = $datos;
          $contenido['filasup'] = $filasup;
          $data['contenido'] = $this->load->view($this->carpeta . 'listar', $contenido, true);
        //$data['contenido'] = $this->load->view('controladoradmin/listar', $contenido, true);
          $this->load->view('plantilla_privado', $data);
      }

      function vista_edicion()
      {
        $this->definir_form_editar_email();

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
        $contenido['action'] = $this->controlador.'guardar_datos_edicion';
        $contenido['fila'] = $fila;

        $data['contenido'] = $this->load->view($this->carpeta.$this->formulario_editar,$contenido, true);
        $this->load->view('plantilla_privado', $data);

    }

    function vista_edicion_editor()
    {
        //$this->definir_form_editar_editor();

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
        $contenido['action'] = $this->controlador.'guardar_datos_editor';
        $contenido['fila'] = $fila;

        $data['contenido'] = $this->load->view($this->carpeta.$this->formulario_editar,$contenido, true);
        $this->load->view('plantilla_privado', $data);

    }

    function definir_form_agregar() {
        $prefijo = $this->prefijo;
        $config = $this->set_reglas_validacion();
        $mensajes = $this->set_mensajes_error();
        // inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);

        foreach ($mensajes as $msj)
            $this->form_validation->set_message($msj['regla'], $msj['mensaje']);
        // inicio asignando las reglas y mensajes de validacion
    }
     function definir_form_editar_editor() {
        $prefijo = $this->prefijo;
        $config = $this->set_reglas_validacion();
        $mensajes = $this->set_mensajes_error();
        
        // inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);

        foreach ($mensajes as $msj)
            $this->form_validation->set_message($msj['regla'], $msj['mensaje']);
        // inicio asignando las reglas y mensajes de validacion
    }

    function definir_form_editar_email() {
        $prefijo = $this->prefijo;
        $config = $this->set_reglas_validacion_email();
        $mensajes = $this->set_mensajes_error();
        // inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);

        foreach ($mensajes as $msj)
            $this->form_validation->set_message($msj['regla'], $msj['mensaje']);
        // inicio asignando las reglas y mensajes de validacion
    }




    function set_reglas_validacion_email() {
        $prefijo = $this->prefijo;
        $config = array(

            array(
                'field' => $prefijo . 'email',
                'label' => 'E-mail',
                'rules' => 'valid_email|required'
                
            )
        );
        return $config;
    }



    function set_reglas_validacion() {
        $prefijo = $this->prefijo;
        $config = array(
            array(
                'field' => $prefijo . 'pie',
                'label' => 'Pie',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'mesaje_enviado',
                'label' => 'Mensaje despues de Enviar',
                'rules' => 'required'
            )
        );
        return $config;
    }

    function set_mensajes_error() {
        $mensajes = array(
            array(
                'regla' => 'required',
                'mensaje' => 'Debe introducir el campo %s'
            ),
            array(
                'regla' => 'min_length',
                'mensaje' => 'El campo %s debe tener al menos %s carácteres'
            ),
            array(
                'regla' => 'valid_email',
                'mensaje' => 'Debe escribir una dirección de email correcta'
            )
        );
        return $mensajes;
    }



function guardar_datos_edicion() {//guardar datos de email



    $this->definir_form_editar_email();

    $modelo = $this->modelo;
    $this->cabecera['accion'] = 'Editar';
    $prefijo = $this->prefijo;
    $ruta_origen = $this->ruta;


    

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


        $fila[$this->prefijo . 'id'] = $fila1[$this->prefijo . 'id'];

        $contenido['cabecera'] = $this->cabecera;
        $contenido['fila'] = $fila;
        $contenido['action'] = $this->controlador . 'guardar_datos_edicion';
        $data['contenido'] = $this->load->view($this->carpeta . $this->formulario_editar, $contenido, true);
        $this->load->view('plantilla_privado', $data);
    } else {//si todo es correcto ingresa 
        $email=$this->input->post($prefijo.'email');
        $id = $this->input->post($this->prefijo . 'id');
        $this->$modelo->agregar_datos($email,$prefijo,$id);
        redirect('Contacto/submenu');


    }
    
}

function guardar_datos_editor() {//guardar datos de editor html



    $this->definir_form_editar_editor();
    
    $modelo = $this->modelo;
    $this->cabecera['accion'] = 'Editar';
    $prefijo = $this->prefijo;
    $ruta_origen = $this->ruta;
    $id=$this->input->post($this->prefijo . 'id');
        $pie=$this->input->post($this->prefijo . 'pie');
        $mensaje_enviado=$this->input->post($this->prefijo . 'mesaje_enviado');

    
    

    

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

        $fila[$this->prefijo . 'pie'] = $pie;
        $fila[$this->prefijo . 'mesaje_enviado'] = $mensaje_enviado;
        $fila[$this->prefijo . 'id'] = $fila1[$this->prefijo . 'id'];

        $contenido['cabecera'] = $this->cabecera;
        $contenido['fila'] = $fila;
        $contenido['action'] = $this->controlador . 'guardar_datos_editor';
        $data['contenido'] = $this->load->view($this->carpeta . $this->formulario_editar, $contenido, true);
        $this->load->view('plantilla_privado', $data);
    } else {//si todo es correcto ingresa 
        
        $this->$modelo->agregar_datos_editor($prefijo,$pie,$mensaje_enviado,$id);
        redirect('Contacto/submenu');
        
        
    }
    
}
}

?>