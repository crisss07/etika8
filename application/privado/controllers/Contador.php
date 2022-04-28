<?php
require_once('Controladoradmin.php');

class Contador extends Controladoradmin
{
    function __construct()
    {
	 parent::__construct();
        force_ssl();
	$this->load->helper(array('url','form','html'));
        $this->load->library(array('form_validation','tool_general'));

         //****** definiendo nombre de carpeta por defecto
        $this->carpeta='contador/';
        $this->controlador='contador/';

        $this->tabla='contador';
        $this->prefijo='con_';
        //******* definiendo campos de la tabla
        $this->campo=array($this->prefijo.'nombre');
         

        $this->formulario_agregar='contador_agregar';
        $this->formulario_editar='contador_agregar';
        $this->action_defecto='listar';
        

         //****** cargando el modelo
        $this->modelo='modelo_contador';
        $this->load->model($this->carpeta.'Contador_model',$this->modelo,TRUE);

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
    function listar()
    {

        $this->cabecera['accion']='Listado';
        $this->campos_listar=array('Nº','Nombre','Conteo');
        $this->campos_reales=array($this->prefijo.'orden',$this->prefijo.'nombre',$this->prefijo.'numero');
        $this->hiddens=array($this->prefijo.'id');

        $this->ordencampo=array(
            'campo1'=>$this->prefijo.'orden',
            'campo2'=>$this->prefijo.'nombre'
        );
        $this->ordenlabel=array(
            'campo1'=>'Número',
            'campo2'=>'Nombre'
        );

        $consulta = $this->db->query('
        SELECT
        '.$this->prefijo.'id,
        '.$this->prefijo.'orden,
        '.$this->prefijo.'numero,
        '.$this->prefijo.'nombre
        FROM
        '.$this->tabla.'        
        ORDER BY
        '.$this->prefijo.'orden asc'
        );
        $datos=$consulta->result_array();

        $contenido['ordencampo']=$this->ordencampo;
        $contenido['ordenlabel']=$this->ordenlabel;
        $contenido['campos_listar']=$this->campos_listar;
        $contenido['campos_reales']=$this->campos_reales;
        $contenido['hiddens']=$this->hiddens;
        $contenido['orden']=$this->orden;
        $contenido['cabecera']=$this->cabecera;
        $contenido['datos'] = $datos;
        $data['contenido'] = $this->load->view($this->carpeta.'listar', $contenido, true);
        //$data['contenido'] = $this->load->view('controladoradmin/listar', $contenido, true);
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
                     'field'   => $prefijo.'tipo',
                     'label'   => 'Lugar / campo',
                     'rules'   => 'is_natural'
                  ),
               array(
                     'field'   => $prefijo.'nombre',
                     'label'   => 'Descripción',
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
                     'mensaje'   => 'Debe introducir el %s'
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
    //listado de como se entero
    function conteo()
    {

        $this->cabecera['accion']='Listado';
        $this->campos_listar=array('Nro','Nombre','Conteo');
        $this->campos_reales=array($this->prefijo.'id',$this->prefijo.'nombre','total');
        $this->hiddens=array($this->prefijo.'id');

        $this->ordencampo=array(
            'campo1'=>$this->prefijo.'orden',
            'campo2'=>$this->prefijo.'nombre'
        );
        $this->ordenlabel=array(
            'campo1'=>'Número',
            'campo2'=>'Nombre'
        );

        $consulta = $this->db->query("SELECT c.con_id,c.con_nombre,c.con_numero as  total 
FROM contador c");
        $datos=$consulta->result_array();
        // var_dump($datos);exit();

        $contenido['ordencampo']=$this->ordencampo;
        $contenido['ordenlabel']=$this->ordenlabel;
        $contenido['campos_listar']=$this->campos_listar;
        
        $contenido['hiddens']=$this->hiddens;
        $contenido['orden']=$this->orden;
        $contenido['cabecera']=$this->cabecera;
        $contenido['datos'] = $datos;
        $data['contenido'] = $this->load->view($this->carpeta.'lista_conteo', $contenido, true);
        //$data['contenido'] = $this->load->view('controladoradmin/listar', $contenido, true);
        $this->load->view('plantilla_privado',$data);

    }
    //listado de como se entero por filtros
    function filtros()
    {

        $this->cabecera['accion']='Listado';
        $this->campos_listar=array('Nro','Nombre','Conteo');
        $this->campos_reales=array($this->prefijo.'id',$this->prefijo.'nombre','total');
        $this->hiddens=array($this->prefijo.'id');

        $this->ordencampo=array(
            'campo1'=>$this->prefijo.'orden',
            'campo2'=>$this->prefijo.'nombre'
        );
        $this->ordenlabel=array(
            'campo1'=>'Número',
            'campo2'=>'Nombre'
        );

        $consulta = $this->db->query("SELECT c.con_id,c.con_nombre, (CASE WHEN x.total  IS NULL THEN '0' ELSE x.total END) AS total 
FROM contador c
LEFT JOIN 
(SELECT contador_id,COUNT(contador_id) as total from convocatoria_postulacion
GROUP BY contador_id) x
on x.contador_id=c.con_id");
        $datos=$consulta->result_array();
        // var_dump($datos);exit();0
        $convocatorias = $this->db->query("SELECT con_id,con_cargo FROM convocatoria ORDER BY con_id DESC");
        $convocatorias=$convocatorias->result();
        // var_dump($convocatorias);exit();
        

        $contenido['ordencampo']=$this->ordencampo;
        $contenido['ordenlabel']=$this->ordenlabel;
        $contenido['campos_listar']=$this->campos_listar;
        
        $contenido['hiddens']=$this->hiddens;
        $contenido['orden']=$this->orden;
        $contenido['cabecera']=$this->cabecera;
        $contenido['datos'] = $datos;
        //nuevos datos
        $contenido['convocatoria'] = $convocatorias;
        $data['contenido'] = $this->load->view($this->carpeta.'filtro_adv', $contenido, true);
        //$data['contenido'] = $this->load->view('controladoradmin/listar', $contenido, true);
        $this->load->view('plantilla_privado',$data);

    }
    //detalle listado por filtros
    function detalle_tabla()
    {
      $conv_id= $this->input->post("conv_id");     
      $fech_ini= $this->input->post("fech_ini");   
      $fech_fin= $this->input->post("fech_fin");   
      $consulta = $this->db->query("SELECT c.con_id,c.con_nombre, (CASE WHEN x.total  IS NULL THEN '0' ELSE x.total END) AS total 
        FROM contador c
        LEFT JOIN 
        (SELECT contador_id,COUNT(contador_id) as total FROM convocatoria_postulacion 
        WHERE con_id1=$conv_id and DATE(con_fecha_creacion) BETWEEN '$fech_ini' and '$fech_fin'
        GROUP BY contador_id) x
        on x.contador_id=c.con_id");
      $datos=$consulta->result_array();     
      $data['datos'] = $datos;
      $response=$this->load->view('contador/detalle',$data,TRUE);
      echo $response;
    }

    public function codigo_ajax()
    {       

        $jsondata['msj'] = 'a';
        $jsondata['resp'] = 'b';
        
        
        echo json_encode($jsondata);        
    }
    //combo convocatorias
    function comboconvocatorias()
    {        
      $fech_ini= $this->input->post("fech_ini");   
      $fech_fin= $this->input->post("fech_fin");   
      $consulta = $this->db->query("SELECT * FROM convocatoria WHERE con_desde BETWEEN '$fech_ini' and '$fech_fin' ORDER BY con_id DESC");
      $datos=$consulta->result();     
      $data['convocatoria'] = $datos;
      

          if ($datos) {
            
      
              $response=$this->load->view('contador/combo_convocatoria',$data,TRUE);
              echo $response;
              

          } else {
              $response=$this->load->view('contador/404',$data,TRUE);
              echo $response;
          }
    }
    //tabla con los datos del form convocatoria seleccionada y la instancia seleccionada
    function detalle_conv_instancia()
    {
      $conv_id= $this->input->post("conv_id");     
      $instancia_id= $this->input->post("instancia_id"); 

      if ($instancia_id==0) {
        $consulta = $this->db->query("SELECT c.con_id,c.con_nombre, (CASE WHEN x.total  IS NULL THEN '0' ELSE x.total END) AS total 
        FROM contador c
        LEFT JOIN 
        (SELECT contador_id,COUNT(contador_id) as total FROM convocatoria_postulacion 
        WHERE con_id1=$conv_id
        GROUP BY contador_id) x
        on x.contador_id=c.con_id");
        
      }else{
        $consulta = $this->db->query("SELECT d.con_id,d.con_nombre, (CASE WHEN y.total  IS NULL THEN '0' ELSE y.total END) AS total 
FROM contador d
LEFT JOIN 
(SELECT x.contador_id,COUNT(x.contador_id) as total FROM (
SELECT c.con_id1,contador_id FROM convocatoria_postulacion c
INNER JOIN 
(SELECT pos_id FROM etapas
WHERE eta_instancia='$instancia_id' and con_id='$conv_id') e
on c.pos_id=e.pos_id
WHERE c.con_id1='$conv_id'
) x
GROUP BY x.contador_id) y
on y.contador_id=d.con_id");
     


      }
       $datos=$consulta->result_array();     
      $data['datos'] = $datos;
      $response=$this->load->view('contador/detalle',$data,TRUE);
      echo $response;
      
      
    }




}


?>