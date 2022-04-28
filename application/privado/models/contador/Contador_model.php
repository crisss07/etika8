<?php
class Contador_model extends CI_Model{

     var $tabla='contador';
     var $prefijo='con_';
     function __construct()
    {
        parent::__construct(); // llama al constructor
    }
    function Contador_model()
    {
        parent::Model(); // llama al constructor
    }

    function agregar($datos=array())
    {        
        $this->db->insert($this->tabla,$datos);        
        return $this->db->insert_id();
    }
    function editar($datos=array())
    {        
        $id=$datos[$this->prefijo.'id'];        
        $this->db->update($this->tabla, $datos, $this->prefijo."id = $id");
        return true;
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
    


}

?>
