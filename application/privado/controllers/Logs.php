<?php
require_once('Controladoradmin.php');

class Logs extends Controladoradmin
{
    function __construct()
    {
	parent::__construct();
        force_ssl();
	$this->load->helper(array('url','form','html'));
        $this->load->library(array('form_validation','tool_general'));

         //****** definiendo nombre de carpeta por defecto
        $this->carpeta='logs/';
        $this->controlador='logs/';

         //******conf uploads
        $this->config_normal['upload_path'] = './archivos/cliente/';
        $this->config_normal['allowed_types'] = 'doc|pdf|txt|rar';
	$this->config_normal['max_size']	= '2048';
        $this->load->library('upload',$this->config_normal);

        $this->tabla='logs_etiko';
        $this->prefijo='log_';                                  

        $this->cabecera['titulo']='Logs ETIKO';

        $this->ruta=$this->config_normal['upload_path'];
        @$this->rutaimg=$this->constantes['nombresitio'].'files/img/';
        $this->rutabase=$this->tool_entidad->sitioindexpri();
        $this->urifull = $this->uri->uri_to_assoc();

        $this->registros = 50;
        $this->pagina=@$this->urifull['pagina'];
        if (!$this->pagina) {
            $this->inicio = 0;
            $this->pagina = 1;
        }
        else {
            $this->inicio = ($this->pagina - 1) * $this->registros;
        }

        $this->boton=8;
        
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
        $this->campos_listar=array('ETIKO','Modulo','Acción','Fecha y Hora','Comentarios');
        $this->campos_reales=array('etiko',$this->prefijo.'modulo',$this->prefijo.'accion',$this->prefijo.'fecha',$this->prefijo.'comentario');

        $enlace=$this->rutabase.$this->controlador.'index/pagina/';
        $qry='
        SELECT
        b.eti_nombre as etiko,
        '.$this->prefijo.'modulo,
        '.$this->prefijo.'accion,
        '.$this->prefijo.'fecha,
        '.$this->prefijo.'comentario
        FROM
        '.$this->tabla.' a, etiko b
        WHERE
        a.eti_id=b.eti_id
        ORDER BY
        '.$this->prefijo.'fecha desc,'.$this->prefijo.'id desc';
        $total_registros=$this->db->query($qry)->num_rows();
        $total_paginas = ceil($total_registros / $this->registros);
        $consulta4 = $this->db->query($qry.'
        LIMIT '.$this->inicio.','.$this->registros.'
        ');
        $datos=$consulta4->result_array();
        $this->cabecera['accion']='Ultimos 50 Acciones';
        $contenido['cabecera']=$this->cabecera;
        $contenido['campos_listar']=$this->campos_listar;
        $contenido['campos_reales']=$this->campos_reales;
        $contenido['enlace']=$enlace;
        $contenido['total_registros']=$total_registros;
        $contenido['total_paginas']=$total_paginas;                
        $contenido['datos'] = $datos;        
        $data['contenido'] = $this->load->view($this->carpeta.'reporte', $contenido, true);        
        $this->load->view('plantilla_privado',$data);        
    }
    function excel()
    {
        $fechaini = $this->input->post('fechaini');
        $fechafin = $this->input->post('fechafin');
        $chk_eliminar = $this->input->post('eliminar_logs');
        if($fechafin && $fechaini){
            $campos_listar=array('ETIKO','Tabla - Id','Modulo','Acción','Fecha y Hora','Comentarios');
            $campos_reales=array('etiko',$this->prefijo.'tabla_id',$this->prefijo.'modulo',$this->prefijo.'accion',$this->prefijo.'fecha',$this->prefijo.'comentario');
            $consulta = $this->db->query('
                SELECT eti_nombre as etiko,log_tabla_id,log_modulo,log_accion,log_fecha,log_comentario 
                FROM logs_etiko a, etiko b  
                WHERE a.eti_id=b.eti_id and date(log_fecha) BETWEEN "'.$fechaini.'" and "'.$fechafin.'"
                ORDER BY log_fecha asc, log_id asc');
            $datos=$consulta->result_array();
            if ($chk_eliminar) {
                $this->db->query('DELETE FROM logs_etiko WHERE date(log_fecha) BETWEEN "' . $fechaini . '" and "' . $fechafin . '"');
            }
            $titulo = 'Logs ETIKO ('.$fechaini.' hasta '.$fechafin.')';
            $contenido['campos_listar'] = $campos_listar;
            $contenido['campos_reales'] = $campos_reales;
            $contenido['datos'] = $datos;
            $contenido['titulo']=$titulo;            
            $contenido['archivo']=str_replace(' ','_',$titulo);
            $this->load->view($this->carpeta.'excel',$contenido);            
        }else{
            redirect($this->controlador);
        }        
    }
}
?>