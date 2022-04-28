<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
?>
<?php
require_once('Controladoradmin.php');

class Cliente extends Controladoradmin
{
    function __construct()
    {
	parent::__construct();
        force_ssl();
	$this->load->helper(array('url','form','html'));
        $this->load->library(array('form_validation','tool_general'));
        $this->load->library('image_lib');
        $this->load->library('aws3');
         //****** definiendo nombre de carpeta por defecto
        $this->carpeta='cliente/';
        $this->controlador='cliente/';

         //******conf uploads
        $this->config_normal['upload_path'] = './archivos/cliente/';
        $this->config_normal['allowed_types'] = 'doc|pdf|txt|rar';
	$this->config_normal['max_size']	= '2048';
        $this->load->library('upload',$this->config_normal);

        $this->tabla='clientes';
        $this->prefijo='cli_';
        //******* definiendo campos de la tabla
        $this->campo=array($this->prefijo.'nombre',$this->prefijo.'razon_social',$this->prefijo.'nit',$this->prefijo.'direccion',$this->prefijo.'telefono',$this->prefijo.'ciudad',$this->prefijo.'nombre1',$this->prefijo.'ci1',$this->prefijo.'email1',$this->prefijo.'telefono1',$this->prefijo.'cargo1',$this->prefijo.'nombre2',$this->prefijo.'ci2',$this->prefijo.'email2',$this->prefijo.'cargo2',$this->prefijo.'telefono2',$this->prefijo.'comentario');
        
		$this->campoup_img = array($this->prefijo . 'img1');
		//******* Tamaño Maximo de la imagen
        $this->campoup_img_width = array(1920);
        $this->campoup_img_height = array(825);

        $this->formulario_agregar='cliente_agregar';
        $this->formulario_editar='cliente_agregar';
        $this->action_defecto='listar';
        $this->fin="hola buenas tardes";

         //****** cargando el modelo
        $this->modelo='modelo_cliente';
        $this->load->model($this->carpeta.'Cliente_model',$this->modelo,TRUE);

        $this->cabecera['titulo']='Clientes';

        $this->ruta=$this->config_normal['upload_path'];
        @$this->rutaimg=$this->constantes['nombresitio'].'files/img/';
        $this->rutabase=$this->tool_entidad->sitioindexpri();
        $this->urifull = $this->uri->uri_to_assoc();

        $this->registros = 60;
        @$this->pagina=$this->urifull['pagina'];
        if (!$this->pagina) {
            $this->inicio = 0;
            $this->pagina = 1;
        }
        else {
            $this->inicio = ($this->pagina - 1) * $this->registros;
        }

        $this->boton='1';
        
        $this->presession=$this->tool_entidad->presession();
        session_start();
        if (!isset($_SESSION[$this->presession.'usuario']))
        {
          redirect(base_url().index_page());
        }
        switch ($_SESSION[$this->presession.'permisos']){
            case "1":                
                $this->nuevo=true;
                $this->editar=true;
                $this->eliminar=true;
                break;
            case "2":                
                $this->nuevo=true;
                $this->editar=true;
                $this->eliminar=false;
                break;
            case "3":                
                $this->nuevo=true;
                $this->editar=false;
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
        $this->campos_listar=array('Nombre Comercial','Razón Social','NIT','Dirección','Ciudad','Teléfono','Primer Contacto' ,'Segundo Contacto', 'Cometarios');
        $this->campos_reales=array($this->prefijo.'nombre',$this->prefijo.'razon_social',$this->prefijo.'nit',$this->prefijo.'direccion',$this->prefijo.'ciudad',$this->prefijo.'telefono',$this->prefijo.'contacto1',$this->prefijo.'contacto2',$this->prefijo.'comentario');
        $this->hiddens=array($this->prefijo.'id');

        $enlace=$this->rutabase.$this->controlador.'listar/pagina/';
        $qry='
        SELECT
        '.$this->prefijo.'id,
        '.$this->prefijo.'nombre,
        case '.$this->prefijo.'razon_social
        when "" then "-"
        else '.$this->prefijo.'razon_social
        end as '.$this->prefijo.'razon_social,
        case '.$this->prefijo.'nit
        when "" then "Sin NIT"
        else '.$this->prefijo.'nit
        end as '.$this->prefijo.'nit,
        '.$this->prefijo.'ciudad,
        '.$this->prefijo.'telefono,
        '.$this->prefijo.'direccion,
        '.$this->prefijo.'nombre1,
        '.$this->prefijo.'ci1,
        '.$this->prefijo.'telefono1,
        '.$this->prefijo.'email1,
        '.$this->prefijo.'cargo1,
        '.$this->prefijo.'nombre2,
		'.$this->prefijo.'ci2,
        '.$this->prefijo.'telefono2,
        '.$this->prefijo.'email2,
        '.$this->prefijo.'cargo2,
        '.$this->prefijo.'comentario
        FROM
        '.$this->tabla.'
        ORDER BY
        '.$this->prefijo.'nombre asc,'.$this->prefijo.'nit asc';
        $total_registros=$this->db->query($qry)->num_rows();
        $total_paginas = ceil($total_registros / $this->registros);
        $consulta4 = $this->db->query($qry.'
        LIMIT '.$this->inicio.','.$this->registros.'
        ');
        $datos=$consulta4->result_array();
             //print_r($datos);
        $contenido['campos_listar']=$this->campos_listar;
        $contenido['campos_reales']=$this->campos_reales;
        $contenido['enlace']=$enlace;
        $contenido['total_registros']=$total_registros;
        $contenido['total_paginas']=$total_paginas;
        $contenido['hiddens']=$this->hiddens;                
        $contenido['cabecera']=$this->cabecera;
        $contenido['datos'] = $datos;        
        $data['contenido'] = $this->load->view($this->carpeta.'listar', $contenido, true);        
        $this->load->view('plantilla_privado',$data);

    }
    function agregar() {
        if(!$this->nuevo)
            redirect($this->controlador.'listar');
        $this->definir_form_agregar();
        $prefijo=$this->prefijo;
        $modelo=$this->modelo;
        $ruta_origen=$this->ruta;

        $this->cabecera['accion']='Nuevo';

        if ($this->form_validation->run()==FALSE) {
            $contenido['cabecera']=$this->cabecera;
            $contenido['action'] = $this->controlador.'agregar'.@$enl;
            $data['contenido'] = $this->load->view($this->carpeta.$this->formulario_agregar, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        }
        else {
            for($i=0;$i<count($this->campo);$i++) {
                $data[$this->campo[$i]] = $this->input->post( $this->campo[$i]);
            }
            if($data[$prefijo.'nit']=="Sin NIT") {
                $data[$prefijo.'nit']="";
            }                        
            if (!empty($_FILES['cli_img1']['name'])) {
                
                $data['cli_img1'] = $_FILES['cli_img1']['name'];
            }


            $id=$this->$modelo->agregar($data);

            // $nombre = $this->input->post('cli_img1');
            $nombre = $_FILES['cli_img1']['name'];
            // $nombre = 'imagen_'.$num;
            //subir imagenes al servidor AWS
            $folder_name_fijos='archivos/cliente/'.$nombre;//'zzz/'

            if (!empty($_FILES['cli_img1']['name'])) {
                $aws_bucket=$this->tool_entidad->aws_bucket();
            $this->aws3->sendFile($aws_bucket,$_FILES['cli_img1'] ,$folder_name_fijos);
                // var_dump('esta vacio');exit();
            }
            // else{
            //     var_dump('no esta vacio');exit();
            // }
            

            

            if($id) {
                $logs['eti_id'] = $_SESSION[$this->presession.'id'];
                $logs['log_tabla_id'] = $this->tabla.' - '.$id;
                $logs['log_modulo'] = 'Clientes';
                $logs['log_accion'] = 'Nuevo';
                $logs['log_fecha'] = date('Y-m-d H:i:s');
                $logs['log_comentario'] = 'Agregó la Empresa: '.$data[$prefijo.'nombre'];
                $this->db->insert('logs_etiko', $logs);
                redirect($this->controlador.$this->action_defecto);
            }
        }
    }

    function editar()
    {
        if(!$this->editar)
            redirect($this->controlador.'listar');
        if(@$this->definirform){$this->definir_form_editar();}
        else{$this->definir_form_agregar();}

        $uri = $this->uri->uri_to_assoc(3);
        $id=$uri['id'];        

        $prefijo=$this->prefijo;

        $consulta = $this->db->query('
        SELECT * FROM '.$this->tabla.' WHERE '.$this->prefijo.'id='.$id);
        $fila=$consulta->first_row('array');

        $this->cabecera['accion']='Editar';        
		for ($i = 0; $i < count($this->campoup_img); $i++) {
            $j = $i + 1;
            $fila[$this->prefijo . 'img_borrar' . $j] = @$fila[$this->campoup_img[$i]];
            $fila[$this->campoup_img[$i]] = '';
        }
        $contenido['cabecera']=$this->cabecera;
        $contenido['action'] = $this->controlador.'guardar_editar';
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
        $ruta_origen=$this->ruta;

        if ($this->form_validation->run()==FALSE) {

            $id=$this->input->post($this->prefijo.'id');
            $consulta = $this->db->query('
                SELECT * FROM '.$this->tabla.' WHERE '.$this->prefijo.'id='.$id);
            $fila1=$consulta->first_row('array');

			for ($i = 0; $i < count($this->campoup_img); $i++) {
                $j = $i + 1;
                $fila[$this->prefijo . 'img_borrar' . $j] = $fila1[$this->campoup_img[$i]];
                $fila[$this->campoup_img[$i]] = '';
            }
            $fila[$this->prefijo.'id']=$fila1[$this->prefijo.'id'];

            $contenido['cabecera']=$this->cabecera;
            $contenido['fila']=$fila;
            $contenido['action'] = $this->controlador.'guardar_editar';
            $data['contenido'] = $this->load->view($this->carpeta.$this->formulario_editar,$contenido, true);
            $this->load->view('plantilla_privado', $data);
        }
        else {
            //recibiendo los datos del formulario
            for($i=0;$i<count($this->campo);$i++) {
                $data[$this->campo[$i]] = $this->input->post($this->campo[$i]);
            }
			for ($i = 0; $i < count($this->campoup_img); $i++) {
                $j = $i + 1;
                $archivo_img[$i]['name'] = $this->tool_general->limpiar_cadena($_FILES[$this->campoup_img[$i]]['name']);
                $archivo_img[$i]['tmp'] = $_FILES[$this->campoup_img[$i]]["tmp_name"];

//                ajuste para eliminar todas las imagenes
//                $borrar_img[$i] = $this->input->post($this->campoup_img[$i]. '_borrar' . $j);

                $borrar_img[$i] = $this->input->post($this->campoup_img[$i] . '_borrar' . $j);

                //var_dump($archivo_img); exit ();
            }
			for ($i = 0; $i < count($this->campoup_img); $i++) {
                $j = $i + 1;
                $solo_eliminar_img[] = false;
            }
			if(@$this->input->post('solo_eliminar_img')){
				foreach ($this->input->post('solo_eliminar_img') as $key => $value) {
					$solo_eliminar_img[$value - 1] = $value;
				}
			}
            if($data[$prefijo.'nit']=="Sin NIT") {
                $data[$prefijo.'nit']="";
            }
            $data[$this->prefijo.'id']=$this->input->post($this->prefijo.'id');
            // $data['cli_img1'] = $_FILES['cli_img1']['name'];
            // var_dump($data);
            //     var_dump('-----');
            //     exit();

            if ($_FILES['cli_img1']['name'] != null ) {
                $data['cli_img1'] = $_FILES['cli_img1']['name'];
                // $nombre = $this->input->post('cli_img1');
                $nombre = $_FILES['cli_img1']['name'];
                // $nombre = 'imagen_'.$num;
                //subir imagenes al servidor AWS
                $folder_name_fijos='archivos/cliente/'.$nombre;//'zzz/'
                $aws_bucket=$this->tool_entidad->aws_bucket();
                $this->aws3->sendFile($aws_bucket,$_FILES['cli_img1'] ,$folder_name_fijos);
            }else{
            }

            if($this->$modelo->editar($data)) {
				$id = $data[$prefijo . 'id'];
                $data_img[$prefijo . 'id'] = $id;
                $data_eliminar_img[$prefijo . 'id'] = $id;

                for ($i = 0; $i < count($this->campoup_img); $i++) {
                    if ($this->campoup_img[$i]) {
                        if ($archivo_img[$i]['name']) {
                            @unlink($ruta_origen . $borrar_img[$i]);
                            $nombre_thum = 't_' . substr($borrar_img[$i], 0, -4) . substr($borrar_img[$i], -4);
                            @unlink($ruta_origen . $nombre_thum);
                            $ext = substr($archivo_img[$i]['name'], 0, -4);
                            $ext = substr($archivo_img[$i]['name'], strlen($ext), 4);
                            // $nombre_archivo_nuevo = substr($archivo_img[$i]['name'], 0, -4) . '_' . $id . $ext;
                            $infoimg = @getimagesize($archivo_img[$i]['tmp']);
                            $ancho = $infoimg[0];
                            $alto = $infoimg[1];
                            if ($this->campoup_img_width[$i]) {
                                $tamanio_ancho = $this->campoup_img_width[$i];
                            } else {
                                $tamanio_ancho = $this->tool_entidad->ancho_max_imagen();
                            }
                            if ($ancho <= $tamanio_ancho) {
                                if (copy($archivo_img[$i]['tmp'], $ruta_origen . $nombre_archivo_nuevo)) {
                                    $consulta = $this->db->query('update ' . $this->tabla . ' set ' . $this->campoup_img[$i] . '="' . $nombre_archivo_nuevo . '" where ' . $this->prefijo . 'id=' . $id);
                                    if ($this->campoup_img_thum_width[$i] && $this->campoup_img_thum_height[$i]) {
                                        $nombre_thum = 't_' . $nombre_archivo_nuevo;
                                        $config['source_image'] = $ruta_origen . $nombre_archivo_nuevo; // ruta donde se encuentra la imagen
                                        $config['width'] = $this->campoup_img_thum_width[$i];
                                        $config['height'] = $this->campoup_img_thum_height[$i];
                                        $config['maintain_ratio'] = TRUE;
                                        $config['new_image'] = $ruta_origen . $nombre_thum;
                                        $config['quality'] = '100%';    // calidad de la imagen
                                        $this->image_lib->clear();
                                        $this->image_lib->initialize($config);
                                        $this->image_lib->resize();
                                    }
                                }
                            } else {
                                if (copy($archivo_img[$i]['tmp'], $ruta_origen . $nombre_archivo_nuevo)) {
                                    $config['source_image'] = $ruta_origen . $nombre_archivo_nuevo; // ruta donde se encuentra la imagen
                                    $config['width'] = $this->tool_entidad->ancho_imagen();
                                    $config['height'] = (int) (($this->tool_entidad->ancho_imagen() * $alto) / $ancho);
                                    $config['quality'] = '100%';    // calidad de la imagen
                                    $config['maintain_ratio'] = TRUE;
                                    $this->image_lib->clear();
                                    $this->image_lib->initialize($config);
                                    $this->image_lib->resize();
                                    $consulta = $this->db->query('update ' . $this->tabla . ' set ' . $this->campoup_img[$i] . '="' . $nombre_archivo_nuevo . '" where ' . $this->prefijo . 'id=' . $id);

                                    //$this->tool_general->crear_thumbnail($nombre_archivo_nuevo,$nombre_archivo_nuevo,$this->tool_entidad->ancho_imagen(),$this->campoup_img_height[$i],$ruta_origen,0,$this->escalar_img);
                                    if (@$this->campoup_img_thum_width[$i] && @$this->campoup_img_thum_height[$i]) {
                                        //$this->tool_general->crear_thumbnail($nombre_archivo_nuevo,$nombre_thum,$this->campoup_img_thum_width[$i],$this->campoup_img_thum_height[$i],$ruta_origen,0,$this->escalar_img_thum);
                                        $nombre_thum = 't_' . $nombre_archivo_nuevo;
                                        $config['source_image'] = $ruta_origen . $nombre_archivo_nuevo; // ruta donde se encuentra la imagen
                                        $config['width'] = $this->campoup_img_thum_width[$i];
                                        $config['height'] = $this->campoup_img_thum_height[$i];
                                        $config['create_thumb'] = TRUE;
                                        $config['maintain_ratio'] = TRUE;
                                        $config['new_image'] = $ruta_origen . $nombre_thum;
                                        $config['quality'] = '100%';    // calidad de la imagen
                                        $this->image_lib->clear();
                                        $this->image_lib->initialize($config);
                                        $this->image_lib->resize();
                                    }
                                }
                            }
                        } else {
                            if ($solo_eliminar_img[$i]) {

                                $data_eliminar_img[$this->campoup_img[$i]] = '';
                                $this->$modelo->editar($data_eliminar_img);
                                @unlink($ruta_origen . $borrar_img[$i]);
                                $nombre_thum = 't_' . substr($borrar_img[$i], 0, -4) . substr($borrar_img[$i], -4);
                                @unlink($ruta_origen . $nombre_thum);
                            }
                        }
                    }
					
                }
				redirect($this->controlador.$this->action_defecto);
            }
        }
    }
    function eliminar($var, $id) {
        if(!$this->eliminar)
            redirect($this->controlador.'listar');
        $ruta_origen = $this->ruta;
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tabla . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $consulta = $this->db->query('
        SELECT con_id as id FROM convocatoria WHERE ' . $this->prefijo . 'id=' . $id);
        $convocatorias = $consulta->result_array();        
        if($convocatorias){
            foreach ($convocatorias as $convocatoria){                
                $this->db->delete('convocatoria_postulacion', array('con_id1' => $convocatoria['id']));
                $this->db->delete('etapas', array('con_id' => $convocatoria['id']));                
            }
            
        }
        $this->db->delete($this->tabla, array($this->prefijo . 'id' => $fila[$this->prefijo . 'id']));
        $this->db->delete('especial_servicio', array($this->prefijo . 'id' => $fila[$this->prefijo . 'id']));
        $this->db->delete('convocatoria', array($this->prefijo . 'id' => $fila[$this->prefijo . 'id']));

        if ($this->idp) {
            if ($this->tip) {
                redirect($this->controlador . $this->action_defecto . '/idp/' . $this->idp . '/tip/' . $this->tip);
            } else {
                redirect($this->controlador . $this->action_defecto . '/idp/' . $this->idp);
            }
        } else {
            if ($this->tip) {
                redirect($this->controlador . $this->action_defecto . '/tip/' . $this->tip);
            } else {
                redirect($this->controlador . $this->action_defecto);
            }
        }
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
                     'field'   => $prefijo.'nombre',
                     'label'   => 'Nombre de la Empresa',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => $prefijo.'nit',
                     'label'   => 'NIT',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => $prefijo.'direccion',
                     'label'   => 'Dirección',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => $prefijo.'ciudad',
                     'label'   => 'Ciudad',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => $prefijo.'telefono',
                     'label'   => 'Teléfono',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => $prefijo.'nombre1',
                     'label'   => 'Nombre Contacto 1',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => $prefijo.'ci1',
                     'label'   => 'campo Cedula de identidad 1',
                     'rules'   => 'required'
                  ),               
			   array(
                     'field'   => $prefijo.'email1',
                     'label'   => 'Email Contacto 1',
                     'rules'   => 'required|valid_email'
                  ),
               array(
                     'field'   => $prefijo.'telefono1',
                     'label'   => 'Teléfono Contacto 1',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => $prefijo.'cargo1',
                     'label'   => 'Cargo Contacto 1',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => $prefijo.'nombre2',
                     'label'   => 'Nombre Contacto 2',
                     'rules'   => 'min_length[0]'
                  ),
               array(
                     'field'   => $prefijo.'email2',
                     'label'   => 'Email Contacto 2',
                     'rules'   => 'valid_email'
                  ),
               array(
                     'field'   => $prefijo.'telefono2',
                     'label'   => 'Teléfono Contacto 2',
                     'rules'   => 'min_length[0]'
                  ),
               array(
                     'field'   => $prefijo.'cargo2',
                     'label'   => 'Cargo Contacto 2',
                     'rules'   => 'min_length[0]'
                  ),
               array(
                     'field'   => $prefijo.'comentario',
                     'label'   => 'Comentario',
                     'rules'   => 'min_length[0]'
                  )
            );
        return $config;

    }

     function set_mensajes_error()
    {
       $mensajes = array(
               array(
                     'regla'   => 'required',
                     'mensaje'   => 'Debe introducir el %s'
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
                     'mensaje'   => 'El NIT solo debe constar de Numeros'
                  )
            );
       return $mensajes;
    }



}


?>