<?php
require_once('Controladoradmin.php');

class Usuario extends CI_Controller
{
    function __construct()
    {
	parent::__construct();
	$this->load->helper(array('url','form'));
        $this->load->library('form_validation');        
        $this->load->helper('html');
        $this->load->library('tool_general');        
        //****** definiendo la tabla por defecto y prefijo si lo tuviera
        $this->tabla='etiko';
        $this->prefijo='eti_';
        //****** definiendo nombre de carpeta por defecto
        $this->carpeta='usuario/';
        $this->controlador='usuario/';
        $this->rutaimg=base_url().'files/img/';
        //$this->formulario='usuario_form';

         //****** cargando el modelo
        $this->modelo='modelo_usuario';
        $this->load->model($this->carpeta.'Usuario_model',$this->modelo,TRUE);

        $this->cabecera['titulo']='Administración de Usuarios etikos';
        $this->cabecera['accion']='';

        $this->campos_listar=array('Nombre','Login','E-mail','Perfil de Usuario','Estado');
        $this->campos_reales=array($this->prefijo.'nombre',$this->prefijo.'login',$this->prefijo.'email',$this->prefijo.'permisos',$this->prefijo.'estado');
        $this->estado=$this->prefijo.'estado';       
        $this->hiddens=array($this->prefijo.'id');
        $this->presession=$this->tool_entidad->presession();       
        session_start();
        if (!isset($_SESSION[$this->presession.'usuario']))
        {
          redirect(base_url().index_page());
        }
        if($_SESSION[$this->presession.'permisos']>3 || $_SESSION[$this->presession.'permisos']<=0) {
            redirect(base_url().index_page());
        }       
			
    }
    function index() {        
		if($_SESSION[$this->presession.'permisos']>='2') {
        redirect('inicio');
		}	
        $this->cabecera['accion']='Listado';
        $consulta = $this->db->query('
        SELECT 
        '.$this->prefijo.'id,              
        '.$this->prefijo.'nombre,
        '.$this->prefijo.'login,
        '.$this->prefijo.'email,
        case '.$this->prefijo.'permisos
        WHEN "1" THEN "Administrador"
        WHEN "2" THEN "Responsable"
        WHEN "3" THEN "Usuario"
        ELSE "Ninguno"
        end as '.$this->prefijo.'permisos,
        '.$this->prefijo.'estado
        FROM '.$this->tabla.' 
        ORDER BY
        '.$this->prefijo.'nombre asc'
        );
        $datos=$consulta->result_array();
        $contenido['cabecera']=$this->cabecera;
        $contenido['datos'] = $datos;
        $data['contenido'] = $this->load->view($this->controlador.'listar', $contenido, true);
        $this->load->view('plantilla_privado', $data);
    }
    function listar(){
        redirect($this->carpeta);
    }

    function agregar() {
        $this->formulario='usuario_form_agregar';
        $this->campo=array($this->prefijo.'nombre',$this->prefijo.'login',$this->prefijo.'email',$this->prefijo.'pass',$this->prefijo.'permisos');
        $this->definir_form_agregar();
        $prefijo=$this->prefijo;
        $modelo=$this->modelo;
        $this->cabecera['accion']='Nuevo';
        if ($this->form_validation->run()==FALSE) {
            $contenido['cabecera']=$this->cabecera;
            $contenido['action'] = $this->carpeta.'agregar';
            $data['contenido'] = $this->load->view($this->carpeta.$this->formulario, $contenido, true);
            $this->load->view('plantilla_privado', $data);
        }
        else {
            for($i=0;$i<count($this->campo);$i++) {
                $data[$this->campo[$i]] = $this->input->post( $this->campo[$i]);
            }
            $login=$data[$this->prefijo.'login'];
            $consulta3 = $this->db->query('
                    SELECT * FROM '.$this->tabla.' where '.$this->prefijo.'login="'.$login.'"');
            $fila3=$consulta3->row_array('array');
            if(!$fila3) {
                $id=$this->$modelo->agregar($data);
                if($id) {
                    if($this->no_mostrar_enlaces) {
                        $contenido = '';
                        $data['contenido'] = $this->load->view($this->carpeta.'/mensaje_exito', $contenido, true);
                        $this->load->view('plantilla_privado', $data);
                    }
                    else {
                        redirect($this->carpeta);
                    }
                }
            }
            else {
                $contenido['msj1']=1;
                $contenido['cabecera']=$this->cabecera;
                $contenido['action'] = $this->carpeta.'agregar';
                $data['contenido'] = $this->load->view($this->carpeta.$this->formulario, $contenido, true);
                $this->load->view('plantilla_privado', $data);
            }
        }
    }
    function editar() {
        $this->formulario='usuario_form_editar';
        $this->campo=array($this->prefijo.'nombre',$this->prefijo.'login',$this->prefijo.'email',$this->prefijo.'permisos');
        $this->definir_form_editar();
        $id=$this->uri->segment(4);
        $prefijo=$this->prefijo;
        $consulta = $this->db->query('
        SELECT * FROM '.$this->tabla.' WHERE '.$this->prefijo.'id='.$id);
        $fila=$consulta->first_row('array');
        $this->cabecera['accion']='Editar';
        $contenido['cabecera']=$this->cabecera;
        $contenido['action'] = $this->carpeta.'guardar_editar';
        $contenido['fila'] = $fila;
        $data['contenido'] = $this->load->view($this->carpeta.$this->formulario,$contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function guardar_editar() {
        $this->formulario='usuario_form_editar';
        $this->campo=array($this->prefijo.'nombre',$this->prefijo.'email',$this->prefijo.'permisos');
        $this->definir_form_editar();
        $modelo=$this->modelo;
        $this->cabecera['accion']='Editar';
        $prefijo=$this->prefijo;
        $ruta_origen=@$this->ruta;
        if ($this->form_validation->run()==FALSE) {
            $id=$this->input->post($this->prefijo.'id');
            $consulta = $this->db->query('
                SELECT * FROM '.$this->tabla.' WHERE '.$this->prefijo.'id='.$id);
            $fila1=$consulta->first_row('array');
            $fila[$this->prefijo.'id']=$fila1[$this->prefijo.'id'];
            $contenido['cabecera']=$this->cabecera;
            $contenido['fila']=$fila;
            $contenido['action'] = $this->carpeta.'guardar_editar';
            $data['contenido'] = $this->load->view($this->carpeta.$this->formulario,$contenido, true);
            $this->load->view('plantilla_privado', $data);
        }
        else {
            for($i=0;$i<count($this->campo);$i++) {
                $data[$this->campo[$i]] = $this->input->post($this->campo[$i]);
            }
            $data[$this->prefijo.'id']=$this->input->post($this->prefijo.'id');
            if($this->$modelo->editar($data)) {
                if($this->no_mostrar_enlaces) {
                    $contenido = '';
                    $data['contenido'] = $this->load->view($this->carpeta.'/mensaje_exito', $contenido, true);
                    $this->load->view('plantilla_privado', $data);
                }
                else {
                    redirect($this->carpeta);
                }
            }
        }
    }
    function cambiarpass() {
        $this->formulario='cambiarpass_form';
        $this->definir_form_pass();
        $this->campo=array($this->prefijo.'pass');
        $id=$this->uri->segment(4);
        $prefijo=$this->prefijo;

        $consulta = $this->db->query('
        SELECT * FROM '.$this->tabla.' WHERE '.$this->prefijo.'id='.$id);
        $fila=$consulta->first_row('array');

        if(isset($this->idsub)) {
            $this->cabecera['titulo']=$fila[$this->titulo];
        }
        $this->cabecera['accion']='Editar';
		if(isset($this->campoup_img)){
			for($i=0;$i<count($this->campoup_img);$i++) {
				$j=$i+1;
				$fila[$this->prefijo.'img_borrar'.$j]=$fila[$this->campoup_img[$i]];
				$fila[$this->campoup_img[$i]]='';
			}
		}
		if(isset($this->campoup_adj)){
			for($i=0;$i<count($this->campoup_adj);$i++) {
				$j=$i+1;
				$fila[$this->prefijo.'adj_borrar'.$j]=$fila[$this->campoup_adj[$i]];
				$fila[$this->campoup_adj[$i]]='';
			}
		}
        $contenido['cabecera']=$this->cabecera;
        $contenido['action'] = $this->carpeta.'guardar_cambiarpass';
        $contenido['fila'] = $fila;
        $data['contenido'] = $this->load->view($this->carpeta.$this->formulario,$contenido, true);
        $this->load->view('plantilla_privado', $data);
    }

    function borrar_qr($id=null) {
        $consulta = $this->db->query("UPDATE etiko set google_auth_code=NULL WHERE eti_id=$id");
        // var_dump($id,$consulta);exit();
        redirect('Usuario');        
    }

    function guardar_cambiarpass()
    {
        $campo=array($this->prefijo.'pass');
        $this->formulario='cambiarpass_form';
        $this->definir_form_pass();
        $modelo=$this->modelo;
        $this->cabecera['accion']='Editar';
        $prefijo=$this->prefijo;

        if ($this->form_validation->run()==FALSE)
        {
            $id=$this->input->post($this->prefijo.'id');
            $consulta = $this->db->query('
            SELECT * FROM '.$this->tabla.' WHERE '.$this->prefijo.'id='.$id);
            $fila1=$consulta->first_row('array');            
            $fila[$this->prefijo.'id']=$fila1[$this->prefijo.'id'];
            $contenido['cabecera']=$this->cabecera;
            $contenido['fila']=$fila1;
            $contenido['action'] = $this->carpeta.'guardar_cambiarpass';
            $data['contenido'] = $this->load->view($this->carpeta.$this->formulario,$contenido, true);
            $this->load->view('plantilla_privado', $data);
	}
        else
        {             
             for($i=0;$i<count($campo);$i++)
             {
                $data[$campo[$i]] = $this->input->post($campo[$i]);
             }
            $data[$this->prefijo.'pass']=sha1($data[$this->prefijo.'pass']);
            $data[$this->prefijo.'id']=$this->input->post($this->prefijo.'id');
            if($this->$modelo->editar($data))
            {
                redirect($this->carpeta);
            }
	}
    }

     function cambiarpasself()
    {
        $this->formulario='cambiarpasself_form';
        $this->definir_form_pasself();
        $this->campo=array($this->prefijo.'pass');
        $id=$_SESSION[$this->presession.'id'];
        $prefijo=$this->prefijo;
        $consulta = $this->db->query('
                SELECT * FROM '.$this->tabla.' WHERE '.$this->prefijo.'id='.$id);
        $fila1=$consulta->first_row('array');
        $this->cabecera['titulo']='Postulante';
        $this->cabecera['accion']='Cambiar Contraseña';
        $contenido['cabecera']=$this->cabecera;
        $contenido['action'] = $this->carpeta.'guardar_cambiarpasself';
        $contenido['fila1'] = $fila1;
        $data['contenido'] = $this->load->view($this->carpeta.$this->formulario,$contenido, true);
        $this->load->view('plantilla_privado', $data);

    }

    function guardar_cambiarpasself()
    {        
        $this->formulario='cambiarpasself_form';
        $this->definir_form_pasself();
        $modelo=$this->modelo;
        $this->cabecera['accion']='Editar';
        $prefijo=$this->prefijo;
        $id=$this->input->post($this->prefijo.'id');
        $consulta = $this->db->query('
            SELECT * FROM '.$this->tabla.' WHERE '.$this->prefijo.'id='.$id);
        $fila1=$consulta->first_row('array');
        if ($this->form_validation->run()==FALSE) {
            $this->cabecera['titulo']='Postulante';
            $this->cabecera['accion']='Cambiar Contraseña';
            $contenido['cabecera']=$this->cabecera;
            $contenido['fila']=@$fila;
            $contenido['fila1'] = $fila1;
            $contenido['action'] = $this->carpeta.'guardar_cambiarpasself';
            $data['contenido'] = $this->load->view($this->carpeta.$this->formulario,$contenido, true);
            $this->load->view('plantilla_privado', $data);
        }
        else {
            $pass_ant=$this->input->post($prefijo.'pass_ant');
            $pass_nueva=$this->input->post($prefijo.'pass_nueva');
            $pass_nueva1=$this->input->post($prefijo.'pass_nueva1');
            $consulta3 = $this->db->query('
                    SELECT * FROM '.$this->tabla.' where '.$prefijo.'pass="'.sha1($pass_ant).'"');
            $fila3=$consulta3->row_array('array');
            if($pass_nueva!=$pass_nueva1) {
                $error_nuevo='No Coinciden las Nuevas Contraseñas';
            }
            if(!$fila3){
                $error_anterior='La Contraseña Anterior es Incorrecta';
            }
            if($fila3 && !@$error_nuevo && !@$error_anterior) {
                $data[$this->prefijo.'pass']=sha1($pass_nueva);
                $data[$this->prefijo.'id']=$id;
                if($this->$modelo->editar($data)) {
                    $contenido = '';
                    $data['contenido'] = $this->load->view($this->carpeta.'mensaje_exito', $contenido, true);
                    $this->load->view('plantilla_privado', $data);
                }
            }else {
                $this->cabecera['titulo']='Postulante';
                $this->cabecera['accion']='Cambiar Contraseña';
                $contenido['cabecera']=$this->cabecera;
                $contenido['fila']=@$fila;
                $contenido['fila1']=$fila1;
                $contenido['error_anterior'] = @$error_anterior;
                $contenido['error_nuevo'] = @$error_nuevo;
                $contenido['action'] = $this->carpeta.'guardar_cambiarpasself';
                $data['contenido'] = $this->load->view($this->carpeta.$this->formulario,$contenido, true);
                $this->load->view('plantilla_privado', $data);
            }
        }
    }

    function procesar()
    {

        $consulta = $this->db->query('
        SELECT * FROM '.$this->tabla.' order by '.$this->prefijo.'id asc');
        $datos=$consulta->result_array();

        $eliminar = $this->input->post('eliminar');
        $deshabilitar = $this->input->post('deshabilitar');
        $habilitar = $this->input->post('habilitar');

        $actualizar = $this->input->post('actualizar');
        $bandera = $this->input->post('bandera');

        $ordenar = $this->input->post('ordenar');

        $modelo=$this->modelo;
        //$this->load->model($this->carpeta.'fsimple/fsimple_model', $modelo, TRUE);

        $ruta_origen=$this->ruta;//"uploads/fsimple/";
        $accion_realizada='';
        foreach ($datos as $fila)
        {
            $chk = $this->input->post('chk'.$fila[$this->prefijo.'id']);
            $orden = $this->input->post('orden'.$fila[$this->prefijo.'id']);
            if($chk=='on')
            {
                $item_procesado=$fila[$this->prefijo.'titulo'];

                if($eliminar=="Eliminar")
                    {

                         for($i=0;$i<count($this->campoup_img);$i++)
                         {
                             @unlink($ruta_origen.$fila[$this->campoup_img[$i]]);
                             $nom_thum='t_'.substr($fila[$this->campoup_img[$i]],0,-4).substr($fila[$this->campoup_img[$i]],-4);
                             @unlink($ruta_origen.$nom_thum);
                         }
                         for($i=0;$i<count($this->campoup_adj);$i++)
                         {
                             @unlink($ruta_origen.$fila[$this->campoup_adj[$i]]);

                         }
                         $this->db->delete($this->tabla, array($this->prefijo.'id' => $fila[$this->prefijo.'id']));
                        $accion_realizada="eliminado";

                    }
                else
                {
                    if($habilitar=="Habilitar")
                    {
                        $fila[$this->estado]='1';
                        $accion_realizada="habilitado";
                    }

                    if($deshabilitar=="Deshabilitar")
                    {
                        $fila[$this->estado]='0';
                        $accion_realizada="deshabilitado";
                    }
                    $this->$modelo->editar($fila);

                }
                //echo "<br/>Elemento ".$accion_realizada." ".$item_procesado;
            }
            if($this->actual)
            {
                if($bandera==$fila[$this->prefijo.'id'])
                {
                     $fila[$this->actual]='1';
                     $this->$modelo->editar($fila);
                }
                else
                {
                    $fila[$this->actual]='0';
                     $this->$modelo->editar($fila);
                }
            }
            if($this->orden)
            {
                $fila[$this->orden]=$orden;
                $this->$modelo->editar($fila);
            }


        }
        redirect($this->controlador);

    }

    function deshabilitar()
    {

        $id=$this->uri->segment(4);

        $consulta = $this->db->query('
        SELECT '.$this->prefijo.'id,'.$this->prefijo.'estado FROM '.$this->tabla.' WHERE '.$this->prefijo.'id='.$id);
        $fila=$consulta->first_row('array');
        $fila[$this->prefijo.'estado']='0';
        $modelo=$this->modelo;
        $this->$modelo->editar($fila);
        redirect($this->carpeta);


    }

    function habilitar()
    {

        $id=$this->uri->segment(4);
        //var_dump($id); exit ();
        $consulta = $this->db->query('
        SELECT '.$this->prefijo.'id,'.$this->prefijo.'estado FROM '.$this->tabla.' WHERE '.$this->prefijo.'id='.$id);
        $fila=$consulta->first_row('array');
        $fila[$this->prefijo.'estado']='1';
        $modelo=$this->modelo;
        $this->$modelo->editar($fila);
        redirect($this->carpeta);


    }
    function eliminar($var, $id) {

        $ruta_origen = @$this->ruta;
        $consulta = $this->db->query('
        SELECT * FROM ' . $this->tabla . ' WHERE ' . $this->prefijo . 'id=' . $id);
        $fila = $consulta->first_row('array');
        if(isset($this->campoup_img)){      
			for ($i = 0; $i < count($this->campoup_img); $i++) {
				if ($this->campoup_img[$i]) {
					$borrar_img[$i] = $fila[$this->campoup_img[$i]];
					@unlink($ruta_origen . $borrar_img[$i]);
					$nombre_thum = 't_' . substr($borrar_img[$i], 0, -4) . substr($borrar_img[$i], -4);
					@unlink($ruta_origen . $nombre_thum);
					$fila[$this->campoup_img[$i]] = '';
				}
			}
		}
		if(isset($this->campoup_adj)){    
			for ($i = 0; $i < count($this->campoup_adj); $i++) {
				if ($this->campoup_adj[$i]) {
					$borrar_adj[$i] = $fila[$this->campoup_adj[$i]];
					@unlink($ruta_origen . $borrar_adj[$i]);
					$fila[$this->campoup_adj[$i]] = '';
				}
			}        
        }        
        $this->db->delete($this->tabla, array($this->prefijo . 'id' => $fila[$this->prefijo . 'id']));
        $this->db->delete('especial_servicio', array($this->prefijo . 'id' => $fila[$this->prefijo . 'id']));
        $this->db->delete('logs_etiko', array($this->prefijo . 'id' => $fila[$this->prefijo . 'id']));
        $consulta = $this->db->query('
        SELECT * FROM convocatoria WHERE ' . $this->prefijo . 'id1=' . $id.' OR ' . $this->prefijo . 'id2=' . $id);
        $convocatorias = $consulta->result_array();
        foreach ($convocatorias as $convocatoria){
            if($convocatoria['eti_id1'] && !$convocatoria['eti_id2'])
                $this->db->delete('convocatoria', array('con_id' => $convocatoria['con_id']));
            elseif(!$convocatoria['eti_id1'] && $convocatoria['eti_id2'])
                $this->db->delete('convocatoria', array('con_id' => $convocatoria['con_id']));
        }                
		$this->action_defecto='index';
        if (isset($this->idp)) {
            if ($this->tip) {
                redirect($this->controlador . $this->action_defecto . '/idp/' . $this->idp . '/tip/' . $this->tip);
            } else {
                redirect($this->controlador . $this->action_defecto . '/idp/' . $this->idp);
            }
        } else {
            if (isset($this->tip)) {
                redirect($this->controlador . $this->action_defecto . '/tip/' . $this->tip);
            } else {
                redirect($this->controlador . $this->action_defecto);
            }
        }
    }

     function definir_form_agregar()
    {
        $prefijo=$this->prefijo;
        $config=$this->set_reglas_validacion_agregar();
        $mensajes=$this->set_mensajes_error();

        // inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach($mensajes as $msj)
           $this->form_validation->set_message($msj['regla'],$msj['mensaje']);
        // inicio asignando las reglas y mensajes de validacion

    }
     function set_reglas_validacion_agregar()
    {
        $prefijo=$this->prefijo;
        $config = array(
               array(
                     'field'   => $prefijo.'nombre',
                     'label'   => 'Nombre',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => $prefijo.'login',
                     'label'   => 'Login',
                     'rules'   => 'required'
                  ),           
              array(
                     'field'   => $prefijo.'pass',
                     'label'   => 'Contraseña',
                     'rules'   => 'required|min_length[8]|max_length[30]'
                  ),
               array(
                     'field'   => $prefijo.'email',
                     'label'   => 'E-mail',
                     'rules'   => 'valid_email'
                  ),
               array(
                     'field'   => $prefijo.'permisos',
                     'label'   => 'Perfil del Usuario',
                     'rules'   => 'is_natural'
                  )
            );
        return $config;

    }

     function definir_form_editar()
    {
        $prefijo=$this->prefijo;
        $config=$this->set_reglas_validacion_editar();
        $mensajes=$this->set_mensajes_error();

        // inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach($mensajes as $msj)
           $this->form_validation->set_message($msj['regla'],$msj['mensaje']);
        // inicio asignando las reglas y mensajes de validacion

    }
     function set_reglas_validacion_editar()
    {
        $prefijo=$this->prefijo;
        $config = array(
               array(
                     'field'   => $prefijo.'nombre',
                     'label'   => 'Nombre',
                     'rules'   => 'required'
                  ),/*
               array(
                     'field'   => $prefijo.'login',
                     'label'   => 'Login',
                     'rules'   => 'required'
                  ),  */
               array(
                     'field'   => $prefijo.'email',
                     'label'   => 'E-mail',
                     'rules'   => 'valid_email'
                  ),
               array(
                     'field'   => $prefijo.'permisos',
                     'label'   => 'Perfil del Usuario',
                     'rules'   => 'is_natural'
                  )
            );
        return $config;

    }

     function definir_form_pass()
    {
        $prefijo=$this->prefijo;
        $config=$this->set_reglas_validacion_pass();
        $mensajes=$this->set_mensajes_error();

        // inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach($mensajes as $msj)
           $this->form_validation->set_message($msj['regla'],$msj['mensaje']);
        // inicio asignando las reglas y mensajes de validacion

    }


    function set_reglas_validacion_pass()
    {
        $prefijo=$this->prefijo;
        $config = array(

              array(
                     'field'   => $prefijo.'pass',
                     'label'   => 'Contraseña',
                     'rules'   => 'required'
                  ),
             array(
                     'field'   => $prefijo.'pass',
                     'label'   => 'Contraseña',
                     'rules'   => 'required|min_length[8]|max_length[30]'
                  )
            );
        return $config;

    }

     function definir_form_pasself()
    {
        $prefijo=$this->prefijo;
        $config=$this->set_reglas_validacion_pasself();
        $mensajes=$this->set_mensajes_error();

        // inicio asignando las reglas y mensajes de validacion
        $this->form_validation->set_rules($config);
        foreach($mensajes as $msj)
           $this->form_validation->set_message($msj['regla'],$msj['mensaje']);
        // inicio asignando las reglas y mensajes de validacion

    }
     function set_reglas_validacion_pasself()
    {
        $prefijo=$this->prefijo;
        $config = array(
             array(
                     'field'   => $prefijo.'pass_ant',
                     'label'   => 'Contraseña Anterior',
                     'rules'   => 'required'
                  ),
             array(
                     'field'   => $prefijo.'pass_nueva',
                     'label'   => 'Nueva Contraseña',
                     'rules'   => 'required|min_length[8]|max_length[30]'
                  ),
             array(
                     'field'   => $prefijo.'pass_nueva1',
                     'label'   => 'Confirmación de Contraseña',
                     'rules'   => 'required|min_length[8]|max_length[30]'
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
                     'regla'   => 'max_length',
                     'mensaje'   => 'El campo %s debe tener como maximo %s carácteres'
                  ),
              array(
                     'regla'   => 'valid_email',
                     'mensaje'   => 'Debe escribir una dirección de email correcta'
                  ),
              array(
                     'regla'   => 'valid_password',
                     'mensaje'   => 'Debe escribir por lo menos un caracter o numero'
                  ),
              array(
                     'regla'   => 'is_numeric',
                     'mensaje'   => 'El campo %s debe ser un numero'
                  ),
              array(
                     'regla'   => 'is_natural',
                     'mensaje'   => 'Debe seleccionar el %s'
                  )
            );
       return $mensajes;
    }




}


?>