<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
class Postulante_model extends CI_Model {

    var $tabla = 'postulante';
    var $tablaf = 'postulante_f';
    var $tablacv = 'cv_temporales';
    var $tabla1 = 'educacion_post_grado';
    var $tabla2 = 'educacion_superior';
    var $tabla3 = 'educacion_secundaria';
    var $tabla4 = 'publicaciones';
    var $tabla5 = 'trayectoria_laboral';
    var $tabla6 = 'idiomas';
    var $tablac = 'convocatoria_postulacion';
    var $prefijo = 'pos_';
    var $prefijof = 'pof_';
    var $prefijocv = 'cvt_';
    var $prefijo1 = 'edu_';
    var $prefijo2 = 'pub_';
    var $prefijo3 = 'tra_';
    var $prefijo4 = 'idi_';
    var $prefijoc = 'con_';

    function __construct() {
        parent::__construct(); // llama al constructor
    }

    function agregar($datos = array()) {
        $datos[$this->prefijo . 'pass'] = sha1($datos[$this->prefijo . 'pass']);
        $datos[$this->prefijo . 'fecha_creacion'] = date('Y-m-d H:i:s');
        $datos[$this->prefijo . 'fecha_edicion'] = date('Y-m-d H:i:s');
        $this->db->insert($this->tabla, $datos);
        return $this->db->insert_id();
    }

//    function agregar($datos=array())
//    {
//        $datos[$this->prefijo.'pass']=sha1($datos[$this->prefijo.'pass']);
//        $datos[$this->prefijo.'fecha_creacion']=date('Y-m-d H:i:s');
//        $datos[$this->prefijo.'fecha_edicion']=date('Y-m-d H:i:s');
//        $this->db->insert($this->tabla,$datos);        
//        return $this->db->insert_id();
//    }
    function agregarF($datos = array()) {
        $datos[$this->prefijof . 'fecha_creacion'] = date('Y-m-d H:i:s');
        $datos[$this->prefijof . 'fecha_edicion'] = date('Y-m-d H:i:s');
        $this->db->insert($this->tablaF, $datos);
        return $this->db->insert_id();
    }

    function agregar_postgrado($datos = array()) {
        $datos[$this->prefijo1 . 'fecha_creacion'] = date('Y-m-d H:i:s');
        $datos[$this->prefijo1 . 'fecha_edicion'] = date('Y-m-d H:i:s');
        $this->db->insert($this->tabla1, $datos);
        return $this->db->insert_id();
    }

    function agregar_superior($datos = array()) {
        $datos[$this->prefijo1 . 'fecha_creacion'] = date('Y-m-d H:i:s');
        $datos[$this->prefijo1 . 'fecha_edicion'] = date('Y-m-d H:i:s');
        $this->db->insert($this->tabla2, $datos);
        return $this->db->insert_id();
    }

    function agregar_secundaria($datos = array()) {
        $datos[$this->prefijo1 . 'fecha_creacion'] = date('Y-m-d H:i:s');
        $datos[$this->prefijo1 . 'fecha_edicion'] = date('Y-m-d H:i:s');
        $this->db->insert($this->tabla3, $datos);
        return $this->db->insert_id();
    }

    function agregar_publicacion($datos = array()) {
        $datos[$this->prefijo2 . 'fecha_creacion'] = date('Y-m-d H:i:s');
        $datos[$this->prefijo2 . 'fecha_edicion'] = date('Y-m-d H:i:s');
        $this->db->insert($this->tabla4, $datos);
        return $this->db->insert_id();
    }

    function agregar_trayectoria($datos = array()) {
        $datos[$this->prefijo3 . 'fecha_creacion'] = date('Y-m-d H:i:s');
        $datos[$this->prefijo3 . 'fecha_edicion'] = date('Y-m-d H:i:s');
        $this->db->insert($this->tabla5, $datos);
        return $this->db->insert_id();
    }

    function agregar_idioma($datos = array()) {
        $datos[$this->prefijo4 . 'fecha_creacion'] = date('Y-m-d H:i:s');
        $datos[$this->prefijo4 . 'fecha_edicion'] = date('Y-m-d H:i:s');
        $this->db->insert($this->tabla6, $datos);
        return $this->db->insert_id();
    }

    function editar($datos = array()) {
        $id = $datos[$this->prefijo . 'id'];
        $this->db->update($this->tabla, $datos, $this->prefijo . "id = $id");
        return true;
    }

    function editarF($datos = array()) {
        $id = $datos[$this->prefijo . 'id'];
        $this->db->update($this->tablaf, $datos, $this->prefijo . "id = $id");
        return true;
    }

    function editar_postgrado($datos = array()) {
        $id = $datos[$this->prefijo1 . 'id'];
        $datos[$this->prefijo1 . 'fecha_edicion'] = date('Y-m-d H:i:s');
        $this->db->update($this->tabla1, $datos, $this->prefijo1 . "id = $id");
        return true;
    }

    function editar_superior($datos = array()) {
        $id = $datos[$this->prefijo1 . 'id'];
        $datos[$this->prefijo1 . 'fecha_edicion'] = date('Y-m-d H:i:s');
        $this->db->update($this->tabla2, $datos, $this->prefijo1 . "id = $id");
        return true;
    }

    function editar_secundaria($datos = array()) {
        $id = $datos[$this->prefijo1 . 'id'];
        $datos[$this->prefijo1 . 'fecha_edicion'] = date('Y-m-d H:i:s');
        $this->db->update($this->tabla3, $datos, $this->prefijo1 . "id = $id");
        return true;
    }

    function editar_publicacion($datos = array()) {
        $id = $datos[$this->prefijo2 . 'id'];
        $datos[$this->prefijo2 . 'fecha_edicion'] = date('Y-m-d H:i:s');
        $this->db->update($this->tabla4, $datos, $this->prefijo2 . "id = $id");
        return true;
    }

    function editar_trayectoria($datos = array()) {
        $id = $datos[$this->prefijo3 . 'id'];
        $datos[$this->prefijo3 . 'fecha_edicion'] = date('Y-m-d H:i:s');
        $this->db->update($this->tabla5, $datos, $this->prefijo3 . "id = $id");
        return true;
    }

    function editar_idioma($datos = array()) {
        $id = $datos[$this->prefijo4 . 'id'];
        $datos[$this->prefijo4 . 'fecha_edicion'] = date('Y-m-d H:i:s');
        $this->db->update($this->tabla6, $datos, $this->prefijo4 . "id = $id");
        return true;
    }

    function get_total_registros() {
        $total = $this->db->count_all($this->tabla);
        return $total;
    }

    function get_registros_pag($number_items, $offset) {
        $query = $this->db->get($this->tabla, $number_items, $offset);
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
        $datos[$this->prefijoc . 'fecha_creacion'] = date('Y-m-d H:i:s');
        $datos[$this->prefijoc . 'fecha_edicion'] = date('Y-m-d H:i:s');
        $this->db->insert($this->tablac, $datos);
        return $this->db->insert_id();
    }

    function fechasUpdate($datos = array()) {
        $idU = $datos[$this->prefijo . "id"];
        $this->db->update($this->tabla, $datos, $this->prefijo . "id = $idU");
    }

}

?>
