<?php
class Lecturaob_model extends Model{

     var $tabla='lectura_ob';
     var $prefijo='lec_';
    
    function Lecturaob_model()
    {
        parent::Model(); // llama al constructor
    }

    function agregar($datos=array())
    {
        $datos[$this->prefijo.'fecha_creacion']=date('Y-m-d H:m:s');
        $datos[$this->prefijo.'fecha_edicion']=date('Y-m-d H:m:s');       
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
