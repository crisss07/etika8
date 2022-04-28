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

    function agregar_datos($nombre,$prefijo)    
    {     
        $columna=$this->prefijo.'orden';
        $orden=$this->db->query("SELECT  $columna FROM $this->tabla ORDER BY con_orden DESC LIMIT 1")->row();
        $orden=$orden->$columna + 1;
        

         $data = array(
                        
                        $prefijo.'nombre' => $nombre, 
                        $prefijo.'numero' => '0',
                        $prefijo.'orden' => $orden,
                        
                    );
        $this->db->insert($this->tabla,$data);        
        return $this->db->insert_id();
    }
    function editar($nombre,$prefijo,$id)
    {        
        $columna=$this->prefijo.'nombre';
         
        $this->db->set($this->prefijo.'nombre',$nombre);        
        $this->db->where($this->prefijo."id = $id");
        $this->db->update($this->tabla);
        
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
