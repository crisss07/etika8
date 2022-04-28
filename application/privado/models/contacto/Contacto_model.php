<?php
class Contacto_model extends CI_Model{

     var $tabla='contacto';
     var $prefijo='con_';
    
    function __construct()
    {
        parent::__construct(); // llama al constructor
    }  
    function Contacto_model()
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

    function agregar_datos($email,$prefijo,$id)    
    {    
        $this->db->set($this->prefijo.'email',$email);        
        $this->db->where($this->prefijo.'id',$id);
        $this->db->update($this->tabla);      
     

    }

    function agregar_datos_editor($prefijo,$pie,$mensaje_enviado,$id)    
    {   
        $this->db->set($this->prefijo.'pie',$pie);   
        $this->db->set($this->prefijo.'mesaje_enviado',$mensaje_enviado);    
        $this->db->where($this->prefijo.'id', $id);
        $this->db->update($this->tabla);      
     

    }


    


}

?>
