
<?php

require_once('Controladoradmin.php');

class Noticias extends Controladoradmin {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form', 'html', 'file', 'xml'));
        $this->load->library(array('form_validation', 'tool_general'));
        $this->load->library('image_lib');
        $this->load->library('aws3');

        //****** definiendo nombre de carpeta por defecto
        $this->carpeta = 'noticias/';
        $this->controlador = 'noticias/';

        $this->carpeta_s3 = 'archivos/noticias/';
		
		
        //******conf uploads
        $this->config_normal['upload_path'] = './archivos/noticias/';
        $this->config_normal['allowed_types'] = 'doc|pdf|txt|mp4|gif|jpg|png|docx|xlsx';
        $this->config_normal['max_size'] = '6096';
        $this->load->library('upload', $this->config_normal);

        $this->tabla = 'noticias';
        $this->prefijo = 'not_';
        $this->campo = array($this->prefijo . 'titulo', $this->prefijo . 'contenido');
        $this->campoup_adj = array($this->prefijo . 'adj');
        $this->campoup_img = array($this->prefijo . 'img1');
        //******* Tamaño Maximo de la imagen
        $this->campoup_img_width = array(1920);
        $this->campoup_img_height = array(825);

        $this->rutaimg = base_url() . 'files/img/';

        $this->formulario_agregar = 'agregar_form';
        $this->formulario_editar = 'agregar_form';
        $this->action_defecto = 'listar';

        //****** cargando el modelo
        $this->modelo = 'noticias_model';
        $this->load->model($this->carpeta . 'noticias_model', $this->modelo, TRUE);

        $this->cabecera['titulo'] = 'Noticias';

        $this->ruta = $this->config_normal['upload_path'];
        $this->boton = 1;
        $this->urifull = $this->uri->uri_to_assoc();


        $this->orden = $this->prefijo . 'orden';
        $this->registros = 20;
        @$this->pagina = $this->urifull['pagina'];
        if (!$this->pagina) {
            $this->inicio = 0;
            $this->pagina = 1;
        } else {
            $this->inicio = ($this->pagina - 1) * $this->registros;
        }
        $this->presession = $this->tool_entidad->presession();
        session_start();
        if (!isset($_SESSION[$this->presession . 'usuario'])) {
            redirect(base_url() . index_page());
        }
    }

    function listar() {
        $this->cabecera['accion'] = 'Listado';
        $this->campos_listar = array('N°', 'Título');
        $this->campos_reales = array($this->prefijo . 'titulo');
        $this->adjunto = $this->prefijo . 'adj';
        $this->imagen = $this->prefijo . 'img';
        $this->hiddens = array($this->prefijo . 'id');
        $enlace = $this->controlador . 'listar/pagina/';
        $query = '
        SELECT
        ' . $this->prefijo . 'id,
        ' . $this->prefijo . 'titulo,  
		' . $this->prefijo . 'orden,  
        ' . $this->prefijo . 'estado
        FROM
        ' . $this->tabla . '        
        ORDER BY
        ' . $this->prefijo . 'orden desc';
        $total_registros = $this->db->query($query)->num_rows();
        $total_paginas = ceil($total_registros / $this->registros);
        $consulta4 = $this->db->query($query . '
        LIMIT ' . $this->inicio . ',' . $this->registros . '
        ');
        $datos = $consulta4->result_array();
        $contenido['enlace'] = $enlace;
        $contenido['total_registros'] = $total_registros;
        $contenido['total_paginas'] = $total_paginas;
        $contenido['orden'] = $this->orden;
        $contenido['campos_listar'] = $this->campos_listar;
        $contenido['campos_reales'] = $this->campos_reales;
        $contenido['adjunto'] = $this->adjunto;
        $contenido['imagen'] = $this->imagen;
        $contenido['hiddens'] = $this->hiddens;
        $contenido['cabecera'] = $this->cabecera;
        $contenido['datos'] = $datos;
        $data['contenido'] = $this->load->view($this->carpeta . 'listar', $contenido, true);
        //$data['contenido'] = $this->load->view('controladoradmin/listar', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function editar() {
        if (@$this->definirform) {
            $this->definir_form_editar();
        } else {
            $this->definir_form_agregar();
        }

        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
        if (@$this->vtip) {
            $this->tip = $uri['tip'];
        }
        if (@$this->vidp) {
            $this->idp = $uri['idp'];
        }

        $prefijo = $this->prefijo;

        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tabla . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');

        $this->cabecera['accion'] = 'Editar';

        for ($i = 0; $i < count($this->campoup_img); $i++) {
            $j = $i + 1;
            $fila[$this->prefijo . 'img_borrar' . $j] = @$fila[$this->campoup_img[$i]];
            $fila[$this->campoup_img[$i]] = '';
        }
        for ($i = 0; $i < count($this->campoup_adj); $i++) {
            $j = $i + 1;
            $fila[$this->campoup_adj[$i] . '_borrar' . $j] = @$fila[$this->campoup_adj[$i]];
            $fila[$this->campoup_adj[$i]] = '';
        }

        $contenido['cabecera'] = $this->cabecera;
        $contenido['action'] = $this->controlador . 'guardar_editar';
        $contenido['fila'] = $fila;

        $data['contenido'] = $this->load->view($this->carpeta . $this->formulario_editar, $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function agregar() {
        $this->definir_form_agregar();
        $prefijo = $this->prefijo;
        $modelo = $this->modelo;
        $ruta_origen = $this->ruta;

        $this->cabecera['accion'] = 'Nuevo';

        if ($this->form_validation->run() == FALSE) {

            //$contenido['idp']=$this->idp;
            $uri = $this->uri->uri_to_assoc();
            if (@$this->vtip) {
                $this->tip = $uri['tip'];
                $enl = '/tip/' . $this->tip;
            }
            if (@$this->vidp) {
                $this->idp = $uri['idp'];
                $enl = '/idp/' . $this->idp . '' . $enl;
            }
            for ($i = 0; $i < count($this->campo); $i++) {
                $data[$this->campo[$i]] = $this->input->post($this->campo[$i]);
            }
            $contenido['cabecera'] = $this->cabecera;
            $contenido['fila'] = $data;
            $contenido['action'] = $this->controlador . 'agregar' . @$enl;
            $data['contenido'] = $this->load->view($this->carpeta . $this->formulario_agregar, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        } else {
            for ($i = 0; $i < count($this->campo); $i++) {
                $data[$this->campo[$i]] = $this->input->post($this->campo[$i]);
            }

            for ($i = 0; $i < count($this->campoup_img); $i++) {
                @$archivo_img[$i]['name'] = $this->tool_general->limpiar_cadena($_FILES[$this->campoup_img[$i]]['name']);
                @$archivo_img[$i]['tmp'] = $_FILES[$this->campoup_img[$i]]["tmp_name"];
            }

            for ($i = 0; $i < count($this->campoup_adj); $i++) {
                $archivo_adj[$i] = $this->tool_general->limpiar_cadena($_FILES[$this->campoup_adj[$i]]['name']);
            }

            if (@$this->vidp) {
                $this->idp = $this->input->post('idp');
                $data[$this->vidp] = $this->idp;
            }
            if (@$this->vtip) {
                $this->tip = $this->input->post('tip');
                if (!$this->nodata) {
                    $data[$this->vtip] = $this->tip;
                }
            }

            if ($this->orden) {
                if (@$this->vidp) {
                    if (($this->vtip) && (!$this->nodata)) {
                        $consulta2 = $this->db->query('
                        SELECT * FROM ' . $this->tabla . '
                        WHERE ' . $this->vidp . '="' . $this->idp . '"
                            ' . $this->vtip . '="' . $this->tip . '"
                        ORDER BY ' . $this->orden . ' desc');
                    } else {
                        $consulta2 = $this->db->query('
                    SELECT * FROM ' . $this->tabla . '
                    WHERE ' . $this->vidp . '="' . $this->idp . '"
                    ORDER BY ' . $this->orden . ' desc');
                    }
                } else {
                    if ((@$this->vtip) && (!$this->nodata)) {
                        $consulta2 = $this->db->query('
                        SELECT * FROM ' . $this->tabla . '
                        WHERE ' . $this->vtip . '="' . $this->tip . '"
                        ORDER BY ' . $this->orden . ' desc');
                    } else {
                        $consulta2 = $this->db->query('
                    SELECT * FROM ' . $this->tabla . '
                    ORDER BY ' . $this->orden . ' desc');
                    }
                }
                $fila = $consulta2->first_row('array');
                @$data[$this->orden] = $fila[$this->orden] + 1;
            }
            $id = $this->$modelo->agregar($data);

            if ($id) {            
			$aws_bucket=$this->tool_entidad->aws_bucket();
            $carpeta_s3 = $this->carpeta_s3;
           
            if(@$_FILES['not_img1']['size']!=0){
			$img = $_FILES['not_img1']['name'];
            $tipo_img = explode('.', $img);
			$nombre_archivo_img ='img_noticia_'.$id.'.'.$tipo_img[1];
			$this->aws3->sendFile($aws_bucket,$_FILES['not_img1'] ,$carpeta_s3.$nombre_archivo_img);
			$data_adj['not_img1'] = $nombre_archivo_img;
			}
			if(@$_FILES['not_adj']['size']!=0){
			$doc = $_FILES['not_adj']['name'];
            $tipo_doc = explode('.', $doc);
			$nombre_archivo_adj ='adj_noticia_'.$id.'.'.$tipo_doc[1];
            $this->aws3->sendFile($aws_bucket,$_FILES['not_adj'] ,$carpeta_s3.$nombre_archivo_adj);
			$data_adj['not_adj'] = $nombre_archivo_adj;
			}
			
			$data_adj['not_id'] = $id;
            $this->$modelo->editar($data_adj);
			
                if ($this->no_mostrar_enlaces) {
                    redirect($this->controlador . 'mensaje_exito');
                } else {

                    if (!$this->enlace_retorno) {
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
                    } else {
                        redirect($this->enlace_retorno . $this->tip);
                    }
                }
            } else {
                redirect($this->controlador . $this->action_defecto);
            }
        }
    }

    function guardar_editar() {
        if (@$this->definirform) {
            $this->definir_form_editar();
        } else {
            $this->definir_form_agregar();
        }
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Editar';
        $prefijo = $this->prefijo;
        $ruta_origen = $this->ruta;
        if (@$this->vidp) {
            $this->idp = $this->input->post('idp');
        }
        if (@$this->vtip) {
            $this->tip = $this->input->post('tip');
        }

        if ($this->form_validation->run() == FALSE) {

            $id = $this->input->post($this->prefijo . 'id');
            $consulta = $this->db->query('
            SELECT * FROM ' . $this->tabla . ' WHERE ' . $this->prefijo . 'id=' . $id);
            $fila1 = $consulta->first_row('array');

            for ($i = 0; $i < count($this->campoup_img); $i++) {
                $j = $i + 1;
                $fila[$this->prefijo . 'img_borrar' . $j] = @$fila1[$this->campoup_img[$i]];
                $fila[$this->campoup_img[$i]] = '';
            }
            for ($i = 0; $i < count($this->campoup_adj); $i++) {
                $j = $i + 1;
                $fila[$this->campoup_adj[$i] . '_borrar' . $j] = @$fila1[$this->campoup_adj[$i]];
                $fila[$this->campoup_adj[$i]] = '';
            }


            $fila[$this->prefijo . 'id'] = $fila1[$this->prefijo . 'id'];
			$fila[$this->prefijo . 'contenido'] = $fila1[$this->prefijo . 'contenido'];

            $contenido['cabecera'] = $this->cabecera;
            $contenido['fila'] = $fila;
            $contenido['action'] = $this->controlador . 'guardar_editar';
            $data['contenido'] = $this->load->view($this->carpeta . $this->formulario_editar, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        } else {
            //recibiendo los datos del formulario
            for ($i = 0; $i < count($this->campo); $i++) {
                $data[$this->campo[$i]] = $this->input->post($this->campo[$i]);
            }

            //var_dump($data); exit ();

            for ($i = 0; $i < count($this->campoup_img); $i++) {
                $j = $i + 1;
                $archivo_img[$i]['name'] = @$this->tool_general->limpiar_cadena($_FILES[$this->campoup_img[$i]]['name']);
                $archivo_img[$i]['tmp'] = @$_FILES[$this->campoup_img[$i]]["tmp_name"];

//                ajuste para eliminar todas las imagenes
//                $borrar_img[$i] = $this->input->post($this->campoup_img[$i]. '_borrar' . $j);

                $borrar_img[$i] = $this->input->post($this->campoup_img[$i] . '_borrar' . $j);

                //var_dump($archivo_img); exit ();
            }
            for ($i = 0; $i < count($this->campoup_adj); $i++) {
                $j = $i + 1;
                $archivo_adj[$i] = $this->tool_general->limpiar_cadena($_FILES[$this->campoup_adj[$i]]['name']);
                $borrar_adj[$i] = $this->input->post($this->campoup_adj[$i] . '_borrar' . $j);
            }

            for ($i = 0; $i < count($this->campoup_img); $i++) {
                $j = $i + 1;
                $solo_eliminar_img[] = false;
            }
            foreach (@$this->input->post('solo_eliminar_img') as $key => $value) {
                $solo_eliminar_img[$value - 1] = $value;
            }

//            $solo_eliminar_img = $this->input->post('solo_eliminar_img');
            $solo_eliminar_adj = $this->input->post('solo_eliminar_adj');
            //$solo_eliminar_aud=$this->input->post('solo_eliminar_aud');

            $data[$this->prefijo . 'id'] = $this->input->post($this->prefijo . 'id');
            if ($this->$modelo->editar($data)) {
                $id = $data[$prefijo . 'id'];
				$data_eliminar_adj[$prefijo . 'id'] = $id;
				$aws_bucket=$this->tool_entidad->aws_bucket();
				$carpeta_s3 = $this->carpeta_s3;
			   if ($solo_eliminar_img[0]) {
					$data_eliminar_adj[$prefijo . 'img1'] = '';
					$respuesta = $this->aws3->deleteFile($aws_bucket,$carpeta_s3.$borrar_img[0]);
               }
			   if ($solo_eliminar_adj[0]) {
					$data_eliminar_adj[$prefijo . 'adj'] = '';
					$respuesta = $this->aws3->deleteFile($aws_bucket,$carpeta_s3.$borrar_adj[0]);
					
               }
				$this->$modelo->editar($data_eliminar_adj);
				
				           
            if(@$_FILES['not_img1']['size']!=0){
				 if (@$borrar_img[0]) {
					$respuesta = $this->aws3->deleteFile($aws_bucket,$carpeta_s3.$borrar_img[0]);
				 }
			$img = $_FILES['not_img1']['name'];
            $tipo_img = explode('.', $img);
			$nombre_archivo_img ='img_noticia_'.$id.'.'.$tipo_img[1];
			$this->aws3->sendFile($aws_bucket,$_FILES['not_img1'] ,$carpeta_s3.$nombre_archivo_img);
			$data_adj['not_img1'] = $nombre_archivo_img;
			}
			if(@$_FILES['not_adj']['size']!=0){
				if (@$borrar_adj[0]) {
					$respuesta = $this->aws3->deleteFile($aws_bucket,$carpeta_s3.$borrar_adj[0]);
				 }
			$doc = $_FILES['not_adj']['name'];
            $tipo_doc = explode('.', $doc);
			$nombre_archivo_adj ='adj_noticia_'.$id.'.'.$tipo_doc[1];
            $this->aws3->sendFile($aws_bucket,$_FILES['not_adj'] ,$carpeta_s3.$nombre_archivo_adj);
			$data_adj['not_adj'] = $nombre_archivo_adj;
			}
			
			$data_adj['not_id'] = $id;
            $this->$modelo->editar($data_adj);
			
			

                if ($this->no_mostrar_enlaces) {
                    redirect($this->controlador . 'mensaje_exito');
                } else {
                    if (!$this->enlace_retorno) {
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
                    } else {

                        redirect($this->enlace_retorno . $this->tip);
                    }
                }
            }
        }
    }

    function eliminarnot($var,$id)
    {

        $ruta_origen=@$this->ruta;
        $consulta = $this->db->query('
        SELECT * FROM '.$this->tabla.' WHERE '.$this->prefijo.'id='.$id);

        $fila=$consulta->first_row('array');
		$aws_bucket=$this->tool_entidad->aws_bucket();
        $carpeta_s3 = $this->carpeta_s3;
		if (@$fila[$this->prefijo.'img1']) {
			$respuesta = $this->aws3->deleteFile($aws_bucket,$carpeta_s3.$fila[$this->prefijo.'img1']);
			}
		if (@$fila[$this->prefijo.'adj']) {
			$respuesta = $this->aws3->deleteFile($aws_bucket,$carpeta_s3.$fila[$this->prefijo.'adj']);
		}
        $this->db->delete($this->tabla, array($this->prefijo.'id' => $fila[$this->prefijo.'id']));

        if($this->idp){
			if($this->tip){
				redirect($this->controlador.$this->action_defecto.'/idp/'.$this->idp.'/tip/'.$this->tip);
            }
            else{
				redirect($this->controlador.$this->action_defecto.'/idp/'.$this->idp);
            }
        }else{
			if($this->tip){
				redirect($this->controlador.$this->action_defecto.'/tip/'.$this->tip);
            }
            else{
				redirect($this->controlador.$this->action_defecto);
            }
        }

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

    function set_reglas_validacion() {
        $prefijo = $this->prefijo;
        $config = array(
            array(
                'field' => $prefijo . 'titulo',
                'label' => 'Título',
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
            ),
            array(
                'regla' => 'is_natural',
                'mensaje' => 'Debe seleccionar un %s'
            )
        );
        return $mensajes;
    }

}

?>
