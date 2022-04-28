<?php

require_once('Controladoradmin.php');

class Convocatoria extends Controladoradmin {

    var $titulo;
    var $controlador = 'convocatoria/';
    var $carpeta = 'servicio/';

    function __construct() {
        parent::__construct();
        force_ssl();
        $this->load->helper(array('url', 'form'));
        $this->load->helper('html');
        $this->load->library(array('form_validation', 'tool_general', 'tool_entidad'));

        $this->tabla = 'convocatoria';
        $this->prefijo = 'con_';
        $this->tabla1 = 'etiko';
        $this->prefijo1 = 'eti_';

        //******conf uploads
        $this->config_normal['upload_path'] = './archivos/' . $this->carpeta . 'lectura_complementaria/';
        $this->config_normal['allowed_types'] = 'doc|pdf|txt|rar|zip';
        $this->config_normal['max_size'] = '3072';
        $this->load->library('upload', $this->config_normal);

        $this->formulario_agregar = 'convocatoria_form';
        $this->formulario_editar = 'convocatoria_form';
        $this->campo = array($this->prefijo . 'cargo', $this->prefijo . 'desde', $this->prefijo . 'hasta', $this->prefijo . 'tope', $this->prefijo . 'monto', $this->prefijo . 'facturacion', $this->prefijo . 'sede', $this->prefijo . 'interno', $this->prefijo . 'descripcion', $this->prefijo . 'avance', $this->prefijo . 'porciento1', $this->prefijo . 'porciento2', 'cli_id', 'cargo_id', 'sub_cargo_id', 'sede_id', 'con_otro_cargo', $this->prefijo . 'encabezado_redes');
        $this->modelo = 'modelo_convocatoria';
        $this->load->model($this->carpeta . 'Convocatoria_model', $this->modelo, TRUE);

        $this->urifull = $this->uri->uri_to_assoc();

        $this->action_defecto = 'listar';
        //$this->no_mostrar_enlaces=1;                
        //$this->ruta=base_url().'archivos/';
        $this->ruta = $this->tool_entidad->sitio() . 'archivos/';
        $this->rutarchivo = $this->tool_entidad->sitio() . 'archivos/';
        $this->rutaimg = $this->tool_entidad->sitio() . 'files/img/';
        $this->rutabase = $this->tool_entidad->sitioindex();
        $this->ruta = $this->config_normal['upload_path'];

        $consulta = $this->db->query('
            SELECT year(' . $this->prefijo . 'hasta) anios FROM ' . $this->tabla . ' WHERE year(' . $this->prefijo . 'hasta)!=' . date('Y') . ' AND year(' . $this->prefijo . 'hasta)>0 GROUP BY anios ORDER BY anios DESC
            ');
        $this->anios = $consulta->result_array();
        $this->pagina = @$this->urifull['pagina'];
        if (!$this->pagina) {
            $this->pagina = date('Y');
        }

        if ($this->pagina == date('Y'))
            $this->cabecera['titulo'] = 'Convocatorias';
        else
            $this->cabecera['titulo'] = 'Historial Convocatorias';


        $this->orden = $this->prefijo . 'orden';
        $this->boton = '3';

        $this->presession = $this->tool_entidad->presession();
        session_start();
        if (!isset($_SESSION[$this->presession . 'usuario'])) {
            redirect(base_url() . index_page());
        }
        switch ($_SESSION[$this->presession . 'permisos']) {
            case "1":
                $this->nuevo = true;
                $this->editar = true;
                $this->eliminar = true;
                break;
            case "2":
                $this->nuevo = true;
                $this->editar = true;
                $this->eliminar = true;
                break;
            case "3":
                $this->nuevo = true;
                $this->editar = true;
                $this->eliminar = false;
                break;
        }
    }

    function index() {
        $uri = $this->uri->uri_to_assoc(3);
        $this->cabecera['accion'] = 'Listado';
        $this->campos_listar = array('Fecha desde', 'Fecha hasta', 'Fecha Tope Postulación', 'Cliente', 'Cargo', 'Responsables', 'Sede', 'Monto (Bs)', 'Tipo Facturación', 'Evaluación Personalizada');
        $this->campos_reales = array($this->prefijo . 'desde', $this->prefijo . 'hasta', $this->prefijo . 'tope', 'cliente', $this->prefijo . 'cargo', 'etikos', $this->prefijo . 'sede', $this->prefijo . 'monto', $this->prefijo . 'facturacion', $this->prefijo . 'interno');
        $this->hiddens = array($this->prefijo . 'id');
        $enlace = $this->controlador . 'index/pagina/';
        $consulta = $this->db->query('
                SELECT
                ' . $this->prefijo . 'id,
                ' . $this->prefijo . 'desde,
                ' . $this->prefijo . 'hasta,
                ' . $this->prefijo . 'monto,
                b.cli_nombre as cliente,
                ' . $this->prefijo . 'tope,
                ' . $this->prefijo . 'sede,
                ' . $this->prefijo1 . 'id1,
                ' . $this->prefijo1 . 'id2,
                ' . $this->prefijo . 'cargo,
                case ' . $this->prefijo . 'facturacion
                when "1" then "ETIKA"
                when "2" then "Consultor Individual"                
                end as ' . $this->prefijo . 'facturacion,
                case ' . $this->prefijo . 'interno
                when "1" then "Si"
                else "No"
                end as ' . $this->prefijo . 'interno
                FROM
                ' . $this->tabla . ' a, clientes b
                WHERE a.cli_id=b.cli_id and year(' . $this->prefijo . 'hasta)="' . $this->pagina . '"
                ORDER BY ' . $this->prefijo . 'hasta desc, cliente asc'
        );
        $datos = $consulta->result_array();
        foreach ($datos as $nums => $rows) {
            $consulta = $this->db->query('
                    SELECT
                    ' . $this->prefijo1 . 'nombre
                    FROM
                    ' . $this->tabla1 . '
                    where
                    ' . $this->prefijo1 . 'id="' . $rows['eti_id1'] . '"'
            );
            $etiko1 = $consulta->row_array();
            $consulta = $this->db->query('
                    SELECT
                    ' . $this->prefijo1 . 'nombre
                    FROM
                    ' . $this->tabla1 . '
                    where
                    ' . $this->prefijo1 . 'id="' . $rows['eti_id2'] . '"'
            );
            $etiko2 = $consulta->row_array();
            /* if ($etiko1['eti_nombre'])
                $etikos = '1. <b>' . $etiko1['eti_nombre'] . '</b>';
            if ($etiko2['eti_nombre'])
                $etikos .= '<br/>2. <b>' . $etiko2['eti_nombre'] . '</b>'; */
			if (@$etiko1['eti_nombre'])
                $etikos = '1. ' . $etiko1['eti_nombre'];
            if (@$etiko2['eti_nombre'])
                $etikos .= '<br>2. ' . $etiko2['eti_nombre'];
            $datos[$nums]['etikos'] = $etikos;
        }
		//print_r($datos);
        $contenido['campos_listar'] = $this->campos_listar;
        $contenido['campos_reales'] = $this->campos_reales;
        $contenido['id_cli'] = @$id_cli;
        $contenido['enlace'] = $enlace;
        $contenido['clientes'] = @$cliente_array;
        $contenido['hiddens'] = $this->hiddens;
        $contenido['cabecera'] = $this->cabecera;
        $contenido['datos'] = $datos;
        $data['contenido'] = $this->load->view($this->carpeta . 'listar_convocatoria', $contenido, true);
        //$data['contenido'] = $this->load->view('controladoradmin/listar', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function ver_convocatoria() {
        $prefijo = $this->prefijo;
        // $this->load->view($this->carpeta . 'ver_convocatoria', $contenido);
		if(isset($_POST['plantilla']))
		{
			$modelo = $this->modelo;
			$vista = $_POST['plantilla'];
			$id = $_POST[$prefijo.'id'];
			$data['pla_id'] = $vista;
            $data[$this->prefijo . 'id'] = $this->input->post($this->prefijo . 'id');
            if ($this->$modelo->editar($data)) {
				//echo 'guardo';
			}
			else{
				//echo 'no guardo';
			}
		}
		else{
			$uri = $this->uri->uri_to_assoc(3);
			$id = $uri['id'];
		}
		$consulta = $this->db->query('
            SELECT * FROM ' . $this->tabla . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');

        $consulta1 = $this->db->query('
            SELECT * FROM plantillas WHERE pla_id =' .$fila['pla_id']);
        $fila1 = $consulta1->first_row('array');

		$vista = $fila['pla_id'];
        $contenido['cabecera'] = $this->cabecera;
        $contenido['fila'] = $fila;
        $contenido['plantilla'] = $fila1;
		$contenido['action'] = $this->controlador.'ver_convocatoria/id/'.$id;
        	$this->load->view($this->carpeta . 'ver_convocatoria', $contenido);
    }

    function copiar(){
        $bucket_url =$this->tool_entidad->aws_url();
        $origen = $bucket_url.'archivos/plantillas/plantilla_1/3.png';
        $destino = './files/img/plantillas/img_temporal/';
        if(copy($origen, $destino."foto_por_defecto.png")) {
            echo "Se ha copiado correctamente la imagen";
        } else {
            echo "No se copiado la imagen correctamente";
        }


    }

    function ver_convocatoria_redes() {
        $prefijo = $this->prefijo;
        // $this->load->view($this->carpeta . 'ver_convocatoria', $contenido);
        if(isset($_POST['plantilla']))
        {
            $modelo = $this->modelo;
            $vista = $_POST['plantilla'];
            // var_dump($vista);
            // exit;
            $id = $_POST[$prefijo.'id'];
            $data['pla_id'] = $vista;
            $data[$this->prefijo . 'id'] = $this->input->post($this->prefijo . 'id');
            if ($this->$modelo->editar($data)) {
                //echo 'guardo';
            }
            else{
                //echo 'no guardo';
            }
        }
        else{
            $uri = $this->uri->uri_to_assoc(3);
            $id = $uri['id'];
        }

        
        $consulta = $this->db->query('
            SELECT * FROM ' . $this->tabla . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $pla_num = $fila['pla_id'];
        // var_dump($pla_num);
        // exit;


        $consulta2 = $this->db->query('
            SELECT * FROM clientes WHERE cli_id=' . $fila['cli_id']);
        $fila2 = $consulta2->first_row('array');

        

        $bucket_url =$this->tool_entidad->aws_url();
        if (@$fila['img_id'.$pla_num] != Null) {
            $consulta1 = $this->db->query('
            SELECT * FROM plantillas WHERE pla_id =' .$fila['img_id'.$pla_num]);
            $fila1 = $consulta1->first_row('array');
            // var_dump($fila1);
            // exit;
            $origen = $bucket_url.'archivos/plantillas/'.$fila1['pla_ubicacion'].'/'.$fila1['pla_nombre'];
            $destino = './files/img/plantillas/img_temporal/';

            $files = glob('./files/img/plantillas/img_temporal/*'); //obtenemos todos los nombres de los ficheros
            foreach($files as $file){
                if(is_file($file))
                unlink($file); //elimino el fichero
            }
            if(copy($origen, $destino.$fila1['pla_nombre'])) {
                $contenido['plantilla'] = 'files/img/plantillas/img_temporal/'.$fila1['pla_nombre'];
            }


        } else {

            $contenido['plantilla'] = '';
            
        }

        $vista = $fila['pla_id'];
        $contenido['logo_cli'] = $fila2['cli_img1'];
        $contenido['cabecera'] = $this->cabecera;
        $contenido['fila'] = $fila;
        // $contenido['plantilla'] = $fila1;
        $contenido['action'] = $this->controlador.'ver_convocatoria_redes/id/'.$id;
        if ($vista == 1 || $vista == 0) {
            
            if (!empty($fila2['cli_img1'])) {
                $origen_logo_cli = $bucket_url.'archivos/cliente/'.$fila2['cli_img1'];
                $destino_logo_cli = './files/img/plantillas/img_temporal/';
                if(copy($origen_logo_cli, $destino_logo_cli.$fila2['cli_img1'])) {
                    $contenido['logo_cliente'] = 'files/img/plantillas/img_temporal/'.$fila2['cli_img1'];
                    // var_dump($contenido);
                    // exit();
                }
            }
            

            $data['contenido'] = $this->load->view($this->carpeta . 'ver1', $contenido, true);
            $this->load->view('cabecera_plantilla', $data);
        }
        if ($vista == 2) {
            $data['contenido'] = $this->load->view($this->carpeta . 'ver2', $contenido, true);
            $this->load->view('cabecera_plantilla', $data);
        }
        if ($vista == 3) {
            // $data['contenido'] = $this->load->view($this->carpeta . 'ver3', $contenido, true);
            // $this->load->view('cabecera_plantilla', $data);
            $data['contenido'] = $this->load->view($this->carpeta . 'ver4', $contenido, true);
            $this->load->view('cabecera_plantilla', $data);
        }

    }

    function ver_carpeta()
    {
        if (!isset($_SESSION[$this->presession.'usuario']))
        {
          redirect(base_url().index_page());         
        }

        $pla_id = $this->input->post('pla_id');
        $con_id = $this->input->post('con_id');
        
        $plantillas = 'plantilla_'.$pla_id;

        // $plantilla = $this->input->post('plantilla');
        $consulta = $this->db->query('
        SELECT * FROM plantillas WHERE pla_ubicacion= "'. $plantillas .'"');
        $fila=$consulta->result_array();

        // var_dump($fila);
        // exit;
        // $nro = substr($plantillas, -1); // devuelve "!"
        $contenido['accion']='imagenes/ver_carpeta';
        $this->cabecera['titulo']='Galeria de Imagenes -> Plantilla '.$pla_id;
        $contenido['cabecera']=$this->cabecera;
        $contenido['plantilla']=$plantillas;
        $contenido['pla_id']=$pla_id;
        $contenido['fila']=$fila;
        $contenido['con_id']=$con_id;
        $data['contenido'] = $this->load->view($this->carpeta.'plantilla', $contenido, true);
        $this->load->view('plantilla_privado',$data);

    }

    function guardar_imagen_redes()
    {
        $plantillas = $this->input->post('plantillas');
        $con_id = $this->input->post('con_id');
        $pla_id = $this->input->post('pla_id');
        $imagen_id = $this->input->post('imagen_id');
        $modelo = $this->modelo;
        $data['img_id'.$pla_id] = $imagen_id;
        // var_dump($imagen_id);
        // exit;
        $data[$this->prefijo . 'id'] = $con_id;
        // var_dump($data);

        if ($this->$modelo->editar($data)) {
            // echo 'guardo';
        }
        else{
            // echo 'no guardo';
        }
        // exit;
        $consulta = $this->db->query('
            SELECT * FROM ' . $this->tabla . ' WHERE ' . $this->prefijo . 'id=' . $con_id);
        $fila = $consulta->first_row('array');
        // var_dump($fila);
        // exit;
        $bucket_url =$this->tool_entidad->aws_url();
        if ($fila['img_id'.$pla_id] != Null) {
            $consulta1 = $this->db->query('
            SELECT * FROM plantillas WHERE pla_id =' .$fila['img_id'.$pla_id]);
            $fila1 = $consulta1->first_row('array');
            // $contenido['plantilla'] = $bucket_url.'archivos/plantillas/'.$fila1['pla_ubicacion'].'/'.$fila1['pla_nombre'];
            $origen = $bucket_url.'archivos/plantillas/'.$fila1['pla_ubicacion'].'/'.$fila1['pla_nombre'];
            $destino = './files/img/plantillas/img_temporal/';

            $files = glob('./files/img/plantillas/img_temporal/*'); //obtenemos todos los nombres de los ficheros
            foreach($files as $file){
                if(is_file($file))
                unlink($file); //elimino el fichero
            }

            if(copy($origen, $destino.$fila1['pla_nombre'])) {
                $contenido['plantilla'] = 'files/img/plantillas/img_temporal/'.$fila1['pla_nombre'];
            }
        } else {
            $contenido['plantilla'] = '';
        }

        $vista = $fila['pla_id'];
        $contenido['cabecera'] = $this->cabecera;
        $contenido['fila'] = $fila;
        // $contenido['plantilla'] = $fila1;
        $contenido['action'] = $this->controlador.'ver_convocatoria_redes/id/'.$con_id;
        if ($vista == 1 || $vista == 0) {
            $data['contenido'] = $this->load->view($this->carpeta . 'ver1', $contenido, true);
            $this->load->view('cabecera_plantilla', $data);
        }
        if ($vista == 2) {
            $data['contenido'] = $this->load->view($this->carpeta . 'ver2', $contenido, true);
            $this->load->view('cabecera_plantilla', $data);
        }
        if ($vista == 3) {
            $data['contenido'] = $this->load->view($this->carpeta . 'ver4', $contenido, true);
            $this->load->view('cabecera_plantilla', $data);
        }
    }


    function secciones() {
        $idCargo = $this->input->post('id');

        $consulta = $this->db->query('
        SELECT car_id as id, car_nombre as nombre
        FROM cargos where car_tipo=2 AND fk_cargo_id=' . $idCargo . '
        order by car_nombre asc
        ');
        $fila = $consulta->result_array();
        echo '<option value="">Seleccione un Cargo</option>';
        foreach ($fila as $key => $value) {
            echo '<option value="' . $value['id'] . '">' . $value['nombre'] . '</option>';
        }
    }

    function agregar() {

        $idCargo = $this->input->post('cargo_id');

        if (!$this->nuevo)
            redirect($this->controlador);
        $this->definir_form_agregar($idCargo);

//        print_r($this->set_reglas_validacion());

        $prefijo = $this->prefijo;
        $prefijo1 = $this->prefijo1;
        $modelo = $this->modelo;
        $ruta_origen = $this->ruta;

        $this->cabecera['accion'] = 'Nuevo';

        if ($this->form_validation->run() == FALSE) {
            $uri = $this->uri->uri_to_assoc();
            if (@$this->vidp) {
                $this->idp = $uri['idp'];
                $enl = '/idp/' . $this->idp . '' . $enl;
            }
            $fila[$prefijo1 . 'id1'] = $this->input->post($prefijo1 . 'id1');
            $fila[$prefijo1 . 'id2'] = $this->input->post($prefijo1 . 'id2');
            $fila[$prefijo . 'facturacion'] = $this->input->post($prefijo . 'facturacion');
            $fila[$prefijo . 'interno'] = $this->input->post($prefijo . 'interno');
            $fila[$prefijo . 'tope'] = $this->input->post($prefijo . 'tope');
            $fila['cli_id'] = $this->input->post('cli_id');
            $fila['cargo_id'] = $this->input->post('cargo_id');
            $fila['con_cargo'] = $this->input->post('con_cargo');
            if ($idCargo==209) {//se agrego por el error
                $fila['con_otro_cargo'] = $this->input->post('con_otro_cargo');
            }
            $fila['sub_cargo_id'] = $this->input->post('sub_cargo_id');
            $fila['sede_id'] = $this->input->post('sede_id');
            $fila['con_encabezado_redes'] = $this->input->post('con_encabezado_redes');
			$fila[$this->prefijo . 'descripcion'] = $this->input->post($prefijo . 'descripcion');
            $contenido['fila'] = $fila;
            $contenido['cabecera'] = $this->cabecera;
            $contenido['action'] = $this->controlador . 'agregar' . @$enl;

            $data['contenido'] = $this->load->view($this->carpeta . $this->formulario_agregar, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        } else {
            for ($i = 0; $i < count($this->campo); $i++) {
                $data[$this->campo[$i]] = $this->input->post($this->campo[$i]);
            }
            if (@$this->vidp) {
                $this->idp = $this->input->post('idp');
                $data[$this->vidp] = $this->idp;
            }
			if($data[$this->prefijo . 'interno']==NULL){
				$data[$this->prefijo . 'interno']='';
			}
			$data[$prefijo1 . 'id1'] = $this->input->post($prefijo1 . 'id1');
            $data[$prefijo1 . 'id2'] = $this->input->post($prefijo1 . 'id2');
            if ($data[$prefijo1 . 'id1'] && $data[$prefijo1 . 'id2']) {
                if (!$data[$prefijo . 'porciento1'] && !$data[$prefijo . 'porciento1']) {
                    $data[$prefijo . 'porciento1'] = 50;
                    $data[$prefijo . 'porciento2'] = 50;
                } elseif ($data[$prefijo . 'porciento1'] && !$data[$prefijo . 'porciento2']) {
                    $data[$prefijo . 'porciento2'] = 100 - $data[$prefijo . 'porciento1'];
                }
            }
            if ($idCargo != 209) {
                $data['con_otro_cargo'] = "";
            }
            //se agrego por el error
            else{
                $data['con_otro_cargo'] = $this->input->post('con_otro_cargo');
                $data['sub_cargo_id'] = 0;
            }
            $id = $this->$modelo->agregar($data);
            if ($id) {
                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                $logs['log_tabla_id'] = $this->tabla . ' - ' . $id;
                $logs['log_modulo'] = 'Convocatorias';
                $logs['log_accion'] = 'Nuevo';
                $logs['log_fecha'] = date('Y-m-d H:i:s');
                $logs['log_comentario'] = 'Agregó el Cargo: ' . $data[$prefijo . 'cargo'];
                $this->db->insert('logs_etiko', $logs);
                redirect($this->controlador);
            }
        }
    }

    function editar() {
        $idCargo = $this->input->post('cargo_id');
        if (!$this->nuevo)
            redirect($this->controlador);
        if (@$this->definirform) {
            $this->definir_form_editar($idCargo);
        } else {
            $this->definir_form_agregar($idCargo);
        }
        $uri = $this->uri->uri_to_assoc(3);
        $id = $uri['id'];
        if (@$this->vidp) {
            $this->idp = $uri['idp'];
        }
        $prefijo = $this->prefijo;
        $consulta = $this->db->query('
            SELECT * FROM ' . $this->tabla . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');
//        print_r($fila);
        $this->cabecera['accion'] = 'Editar';
        $contenido['cabecera'] = $this->cabecera;
        $contenido['action'] = $this->controlador . 'guardar_editar';
        $contenido['fila'] = $fila;
        $data['contenido'] = $this->load->view($this->carpeta . $this->formulario_editar, $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function guardar_editar() {
        $idCargo = $this->input->post('cargo_id');
        if (@$this->definirform) {
            $this->definir_form_editar($idCargo);
        } else {
            $this->definir_form_agregar($idCargo);
        }
        $modelo = $this->modelo;
        $this->cabecera['accion'] = 'Editar';
        $prefijo = $this->prefijo;
        $prefijo1 = $this->prefijo1;
        $ruta_origen = $this->ruta;
        if (@$this->vidp) {
            $this->idp = $this->input->post('idp');
        }
        if ($this->form_validation->run() == FALSE) {
            $id = $this->input->post($this->prefijo . 'id');
            $consulta = $this->db->query('
                SELECT * FROM ' . $this->tabla . ' WHERE ' . $this->prefijo . 'id=' . $id);
            $fila1 = $consulta->first_row('array');
            $fila[$this->prefijo . 'id'] = $fila1[$this->prefijo . 'id'];
            $fila[$this->prefijo . 'descripcion'] = $fila1[$this->prefijo . 'descripcion'];
            $fila['cli_id'] = $fila1['cli_id'];
            $fila[$prefijo1 . 'id1'] = $this->input->post($prefijo1 . 'id1');
            $fila[$prefijo1 . 'id2'] = $this->input->post($prefijo1 . 'id2');
            $fila[$prefijo . 'interno'] = $this->input->post($prefijo . 'interno');
            $fila['sede_id'] = $this->input->post('sede_id');
            $fila['cargo_id'] = $this->input->post('cargo_id');
            $fila['con_cargo'] = $this->input->post('con_cargo');
            $fila['sub_cargo_id'] = $this->input->post('sub_cargo_id');
            $fila[$prefijo . 'facturacion'] = $this->input->post($prefijo . 'facturacion');
            $contenido['cabecera'] = $this->cabecera;
            $contenido['fila'] = $fila;
            $contenido['action'] = $this->controlador . 'guardar_editar';
            $data['contenido'] = $this->load->view($this->carpeta . $this->formulario_editar, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        } else {
            for ($i = 0; $i < count($this->campo); $i++) {
                $data[$this->campo[$i]] = $this->input->post($this->campo[$i]);
            }
            $data[$prefijo1 . 'id1'] = $this->input->post($prefijo1 . 'id1');
            $data[$prefijo1 . 'id2'] = $this->input->post($prefijo1 . 'id2');
            if ($data[$prefijo1 . 'id1'] && $data[$prefijo1 . 'id2']) {
                if (!$data[$prefijo . 'porciento1'] && !$data[$prefijo . 'porciento1']) {
                    $data[$prefijo . 'porciento1'] = 50;
                    $data[$prefijo . 'porciento2'] = 50;
                } elseif ($data[$prefijo . 'porciento1'] && !$data[$prefijo . 'porciento2']) {
                    $data[$prefijo . 'porciento2'] = 100 - $data[$prefijo . 'porciento1'];
                }
            }
            $data[$this->prefijo . 'id'] = $this->input->post($this->prefijo . 'id');
            if ($idCargo != 209) {
                $data['con_otro_cargo'] = "";
            }

            if ($this->$modelo->editar($data)) {
                $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
                $logs['log_tabla_id'] = $this->tabla . ' - ' . $data[$this->prefijo . 'id'];
                $logs['log_modulo'] = 'Convocatorias';
                $logs['log_accion'] = 'Editar';
                $logs['log_fecha'] = date('Y-m-d H:i:s');
                $logs['log_comentario'] = 'Modificó el Cargo: ' . $data[$prefijo . 'cargo'];
                $this->db->insert('logs_etiko', $logs);
                redirect($this->controlador);
            }
        }
    }

    function eliminar($var, $id) {
        if (!$this->nuevo)
            redirect($this->controlador);
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tabla . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');
        $this->db->delete($this->tabla, array($this->prefijo . 'id' => $fila[$this->prefijo . 'id']));
        $this->db->delete('convocatoria_postulacion', array('con_id1' => $fila[$this->prefijo . 'id']));
        $this->db->delete('etapas', array('con_id' => $fila[$this->prefijo . 'id']));
        $logs['eti_id'] = $_SESSION[$this->presession . 'id'];
        $logs['log_tabla_id'] = $this->tabla . ' - ' . $fila[$this->prefijo . 'id'];
        $logs['log_modulo'] = 'Convocatorias';
        $logs['log_accion'] = 'Eliminar';
        $logs['log_fecha'] = date('Y-m-d H:i:s');
        $logs['log_comentario'] = 'Eliminó el Cargo: ' . $fila[$this->prefijo . 'cargo'];
        $this->db->insert('logs_etiko', $logs);
        redirect($this->controlador . 'index/idc/' . $this->idp);
    }

    public function fecha_hasta($str) {
        $prefijo = $this->prefijo;
        $fecha_hasta = explode("-", $str);
        $fecha_tope = explode("-", $this->input->post($prefijo . 'tope'));
        $fecha_hasta1 = mktime(0, 0, 0, $fecha_hasta[1], $fecha_hasta[2], $fecha_hasta[0]);
        $fecha_tope1 = @mktime(0, 0, 0, $fecha_tope[1], $fecha_tope[2], $fecha_tope[0]);
        if ($fecha_hasta1 > $fecha_tope1)
            return TRUE;
        else
            return FALSE;
    }

    function definir_form_agregar($idCargo = "") {
        $prefijo = $this->prefijo;
        $config = $this->set_reglas_validacion($idCargo);
        $mensajes = $this->set_mensajes_error();

        // inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach ($mensajes as $msj)
            $this->form_validation->set_message($msj['regla'], $msj['mensaje']);
        // inicio asignando las reglas y mensajes de validacion
    }

    function set_reglas_validacion($idCargo = "") {
        $prefijo = $this->prefijo;
        $config = array(
            array(
                'field' => $prefijo . 'cargo',
                'label' => 'Cargo',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'encabezado_redes',
                'label' => 'Encabezado'
            ),
            array(
                'field' => 'cargo_id',
                'label' => ' una Unidad',
                'rules' => 'required'
            ),
            
                array(
                'field' => 'sub_cargo_id',
                'label' => ' un Cargo',
                'rules' => 'required'
            ),
                 array(
                'field' => 'con_otro_cargo',
                'label' => ' un Cargo',
                'rules' => 'required'
            ), 
            
            array(
                'field' => $prefijo . 'sede',
                'label' => 'Sede',
                'rules' => 'required'
            ),
            array(
                'field' => 'sede_id',
                'label' => ' una Sede',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'hasta',
                'label' => 'Fecha Hasta',
                'rules' => 'valid_date|callback_fecha_hasta|required'
            ),
            array(
                'field' => $prefijo . 'desde',
                'label' => 'Fecha Desde',
                'rules' => 'required|valid_date'
            ),
            array(
                'field' => $prefijo . 'tope',
                'label' => 'Fecha Tope de la Postulación',
                'rules' => 'valid_date|required'
            ),
            array(
                'field' => 'eti_id1',
                'label' => 'Responsable ETIKO 1',
                'rules' => 'is_natural'
            ),
            array(
                'field' => $prefijo . 'porciento1',
                'label' => 'Porcentaje del ETIKO 1',
                'rules' => 'is_numeric|required'
            ),
            array(
                'field' => $prefijo . 'porciento2',
                'label' => 'Porcentaje del ETIKO 2',
                'rules' => 'is_numeric'
            ),
            array(
                'field' => $prefijo . 'monto',
                'label' => 'Monto',
                'rules' => 'required|is_numeric'
            ),
            array(
                'field' => $prefijo . 'facturacion',
                'label' => 'el Tipo de Facturación',
                'rules' => 'required'
            ),
            array(
                'field' => $prefijo . 'descripcion',
                'label' => 'Descripción',
                'rules' => 'min_length[0]'
            ),
            array(
                'field' => 'cli_id',
                'label' => 'Cliente',
                'rules' => 'is_natural'
            ),
            array(
                'field' => $prefijo . 'id',
                'label' => 'id',
                'rules' => 'min_length[0]'
            ),
            array(
                'field' => 'idp',
                'label' => 'idp',
                'rules' => 'min_length[0]'
            )
        );

        if ($idCargo == 209) {
            unset($config[3]);
        } 
        else {
            unset($config[4]);
        }

        return $config;
    }

    function set_mensajes_error() {
        $mensajes = array(
            array(
                'regla' => 'required',
                'mensaje' => 'Debe introducir %s'
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
                'regla' => 'is_numeric',
                'mensaje' => 'El Monto debe ser solo numeros'
            ),
            array(
                'regla' => 'is_natural',
                'mensaje' => 'Debe seleccionar el %s'
            ),
            array(
                'regla' => 'valid_date',
                'mensaje' => 'Debe insertar la %s correctamente'
            ),
			array(
                'regla' => 'validar_fecha',
                'mensaje' => 'Debe insertar la %s correctamente'
            ),
            array(
                'regla' => 'fecha_hasta',
                'mensaje' => 'La Fecha Hasta debe ser mayor que la Fecha Tope.'
            )
        );
        return $mensajes;
    }

}

?>