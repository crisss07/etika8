<?php
class Postulacion_model extends CI_Model{

     var $tabla='convocatoria_postulacion';
     var $prefijo='con_';
     var $tabla1='etapas';
     var $prefijo1='eta_';
     
     var $tablacv = 'cv_temporales';
     var $prefijocv = 'cvt_';
     
    function __construct()
    {
        parent::__construct(); // llama al constructor
    }

    function agregar($datos=array())
    {        
        $datos[$this->prefijo.'fecha_creacion']=date('Y-m-d H:i:s');
        $datos[$this->prefijo.'fecha_edicion']=date('Y-m-d H:i:s');
        $this->db->insert($this->tabla,$datos);        
        return $this->db->insert_id();
    }
    function agregar_etapas($datos=array())
    {
        $datos[$this->prefijo1.'fecha_creacion']=date('Y-m-d H:i:s');
        $datos[$this->prefijo1.'fecha_edicion']=date('Y-m-d H:i:s');
        $this->db->insert($this->tabla1,$datos);
        return $this->db->insert_id();
    }
    function get_total_registros()
    {
        $total=$this->db->count_all($this->tabla);        
        return $total;
    }
    function get_registros_pag($number_items,$offset)
    {
        $query = $this->db->get($this->tabla,$number_items,$offset);
        return $query;
    }
    
//    para agregar el nombre del adjunto
    function agregarAdj($datos = array()) {
        $datos[$this->prefijocv . 'fecha_creacion'] = date('Y-m-d H:i:s');
        $datos[$this->prefijocv . 'fecha_edicion'] = date('Y-m-d H:i:s');
        $this->db->insert($this->tablacv, $datos);
        return $this->db->insert_id();
    }
    //    para guardar datos del postulante en la convocatoria
    function agregarPostulacion($datos = array()) {
        $datos[$this->prefijo . 'fecha_creacion'] = date('Y-m-d H:i:s');
        $datos[$this->prefijo . 'fecha_edicion'] = date('Y-m-d H:i:s');
        $this->db->insert($this->tabla, $datos);
        return $this->db->insert_id();
    }


}

?>
