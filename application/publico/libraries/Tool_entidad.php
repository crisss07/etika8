<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tool_entidad {
     function __construct(){
        $root = str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);        
        if(strlen($root)<=1){
        $this->constantes['baseurl']='../';
        $this->constantes['sitio']='/index.php/';
        $this->constantes['sitiopri']='/index.php/';
        $this->constantes['nombresitio']='/';
        $this->constantes['baseurlimg']='';
        $this->constantes['presession']='admin_siste_pub_etika';
        $this->constantes['rutaimg']=$this->constantes['nombresitio'].'files/img/';
        $this->constantes['archivo']=$this->constantes['nombresitio'].'archivos/';
        $this->constantes['titulo_sitio']='Sistema de Postulación';
        // enlace bucket S3
        $this->constantes['aws_bucket']='elasticbeanstalk-us-east-2-676905610441';
        $this->constantes['aws_url']='https://elasticbeanstalk-us-east-2-676905610441.s3.us-east-2.amazonaws.com/';
        $this->constantes['declaracion_texto']='Declaro que todos los datos que preceden son verdaderos y garantizo su autenticidad. Me comprometo a respaldarlos con la documentación correspondiente cuando ETIKA SRL lo solicite. Al mismo tiempo, autorizo a ETIKA SRL a verificarlos y usarlos en mi postulación al presente cargo (o a otros cargos dentro de la organización a la que postulo), con la confidencialidad del caso. Comunicaré a ETIKA SRL cuando no esté interesado de formar parte de su base de datos.
Además acepto participar en pruebas y entrevistas requeridas en la selección de personal del presente cargo.';

        }else{
        $this->constantes['baseurl']='..'.$root;
        $this->constantes['sitio']= $root.'index.php/';
        $this->constantes['sitiopri']=$root.'index.php/';
        $this->constantes['nombresitio']=$root;
        $this->constantes['baseurlimg']='..'.$root;
        $this->constantes['presession']='admin_siste_pub_etika';
        $this->constantes['rutaimg']=$this->constantes['nombresitio'].'files/img/';
        $this->constantes['archivo']=$this->constantes['nombresitio'].'archivos/';
        $this->constantes['titulo_sitio']='Sistema de Postulación';
        // enlace bucket S3
        $this->constantes['aws_bucket']='elasticbeanstalk-us-east-2-676905610441';
        $this->constantes['aws_url']='https://elasticbeanstalk-us-east-2-676905610441.s3.us-east-2.amazonaws.com/';
        $this->constantes['declaracion_texto']='Declaro que todos los datos que preceden son verdaderos y garantizo su autenticidad. Me comprometo a respaldarlos con la documentación correspondiente cuando ETIKA SRL lo solicite. Al mismo tiempo, autorizo a ETIKA SRL a verificarlos y usarlos en mi postulación al presente cargo (o a otros cargos dentro de la organización a la que postulo), con la confidencialidad del caso. Comunicaré a ETIKA SRL cuando no esté interesado de formar parte de su base de datos.
Además acepto participar en pruebas y entrevistas requeridas en la selección de personal del presente cargo.';

        }
        /*$this->constantes['sitio']='/fconstruir/index.php/';
        $this->constantes['sitiopri']='/fconstruir/admin.php/';
        $this->constantes['nombresitio']='/fconstruir/';
        $this->constantes['presession']='admin_fco_';
        $this->constantes['rutaimg']=$this->constantes['nombresitio'].'files/img/';        
        $this->constantes['archivo']=$this->constantes['nombresitio'].'archivos/';
        $this->constantes['titulo_sitio']='Fundación Construir';
        */
    }
    
   
    function Tool_entidad(){
        $root = str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);        
        if(strlen($root)<=1){
        $this->constantes['baseurl']='../';
        $this->constantes['sitio']='/index.php/';
        $this->constantes['sitiopri']='/index.php/';
        $this->constantes['nombresitio']='/';
        $this->constantes['baseurlimg']='';
        $this->constantes['presession']='admin_siste_pub_etika';
        $this->constantes['rutaimg']=$this->constantes['nombresitio'].'files/img/';
        $this->constantes['archivo']=$this->constantes['nombresitio'].'archivos/';
        $this->constantes['titulo_sitio']='Sistema de Postulación';
        // enlace bucket S3
        $this->constantes['aws_bucket']='elasticbeanstalk-us-east-2-676905610441';
        $this->constantes['aws_url']='https://elasticbeanstalk-us-east-2-676905610441.s3.us-east-2.amazonaws.com/';
        $this->constantes['declaracion_texto']='Declaro que todos los datos que preceden son verdaderos y garantizo su autenticidad. Me comprometo a respaldarlos con la documentación correspondiente cuando ETIKA SRL lo solicite. Al mismo tiempo, autorizo a ETIKA SRL a verificarlos y usarlos en mi postulación al presente cargo (o a otros cargos dentro de la organización a la que postulo), con la confidencialidad del caso. Comunicaré a ETIKA SRL cuando no esté interesado de formar parte de su base de datos.
Además acepto participar en pruebas y entrevistas requeridas en la selección de personal del presente cargo.';


        }else{
        $this->constantes['baseurl']='..'.$root;
        $this->constantes['sitio']= $root.'index.php/';
        $this->constantes['sitiopri']=$root.'index.php/';
        $this->constantes['nombresitio']=$root;
        $this->constantes['baseurlimg']='..'.$root;
        $this->constantes['presession']='admin_siste_pub_etika';
        $this->constantes['rutaimg']=$this->constantes['nombresitio'].'files/img/';
        $this->constantes['archivo']=$this->constantes['nombresitio'].'archivos/';
        $this->constantes['titulo_sitio']='Sistema de Postulación';
        // enlace bucket S3
        $this->constantes['aws_bucket']='elasticbeanstalk-us-east-2-676905610441';
        $this->constantes['aws_url']='https://elasticbeanstalk-us-east-2-676905610441.s3.us-east-2.amazonaws.com/';
        $this->constantes['declaracion_texto']='Declaro que todos los datos que preceden son verdaderos y garantizo su autenticidad. Me comprometo a respaldarlos con la documentación correspondiente cuando ETIKA SRL lo solicite. Al mismo tiempo, autorizo a ETIKA SRL a verificarlos y usarlos en mi postulación al presente cargo (o a otros cargos dentro de la organización a la que postulo), con la confidencialidad del caso. Comunicaré a ETIKA SRL cuando no esté interesado de formar parte de su base de datos.
Además acepto participar en pruebas y entrevistas requeridas en la selección de personal del presente cargo.';


        }
        /*$this->constantes['sitio']='/fconstruir/index.php/';
        $this->constantes['sitiopri']='/fconstruir/admin.php/';
        $this->constantes['nombresitio']='/fconstruir/';
        $this->constantes['presession']='admin_fco_';
        $this->constantes['rutaimg']=$this->constantes['nombresitio'].'files/img/';        
        $this->constantes['archivo']=$this->constantes['nombresitio'].'archivos/';
        $this->constantes['titulo_sitio']='Fundación Construir';
        */
    }
/*
    function constantes(){
        $constantes['sitio']='/observatorio/index.php/';
        $constantes['nombresitio']='/observatorio/';
        $constantes['presession']='admin_cor_';
        return $constantes;
    }*/
    function sitio(){
        return $this->constantes['nombresitio'];
    }
    function ancho_imagen(){
        return '700';
    }
    function baseurlimg(){
        return $this->constantes['baseurlimg'];
    }
    function rutacaptcha(){
        return $this->constantes['rutacaptcha'];
    }
    function sitioindex(){
        return $this->constantes['sitio'];
    }
    function sitioindexpri(){
        return $this->constantes['sitiopri'];
    }
    function sitiopri(){
        return $this->constantes['sitiopri'];
    }
    function presession(){        
        return $this->constantes['presession'];
    }
    function rutaimg(){
        return $this->constantes['rutaimg'];
    }
    function rutarchivo(){
        return $this->constantes['archivo'];
    }
    function titulo_sitio(){
        return $this->constantes['titulo_sitio'];
    }
    function tematica($tem){
        switch ($tem){
            case 1:$titulo='Violencia';break;
            case 2:$titulo='Participación Politica';break;
            case 3:$titulo='Tierras';break;
            case 4:$titulo='Sección medios';break;
            case 5:$titulo='Migración';break;
        }
        return $titulo;
    }
    function departamento($id){

        switch ($id){
            case 1:$titulo="La Paz"; break;
            case 2:$titulo="Cochabamba"; break;
            case 3:$titulo="Santa cruz"; break;
            case 4:$titulo="Potosí"; break;
            case 5:$titulo="Oruro"; break;
            case 6:$titulo="Chuquisaca"; break;
            case 7:$titulo="Beni"; break;
            case 8:$titulo="Pando"; break;
            case 9:$titulo="Tarija"; break;
        }
       return $titulo;
    }

    function tiene_descendientes($tabla,$campo,$id,$db)
    {
        
        $consulta = $db->query('
        SELECT * FROM '.$tabla.' where '.$campo.'='.$id);
        $datos=$consulta->result_array();
        var_dump($datos); exit ();
        if($datos){
            return true;
        }
        else{
            return false;
            }
    }
    
    function tipofig_extension($tipo)
    {
            switch ($tipo)
            {
                    case ".pdf":$fig="pdf"; break;
                    case ".doc":$fig="word"; break;
                    case ".xsl":$fig="excel";break;
                    case ".zip":$fig="zip"; break;
                    case ".ppt":$fig="ppt"; break;
                    case ".txt":$fig="txt"; break;
                    case ".rar":$fig="rar";break;
                    case ".swf":$fig="swf";break;
                    case ".mp3":$fig="mp3";break;
            }
            return $fig;
    }

    function aws_bucket(){
        return $this->constantes['aws_bucket'];
    }
    function aws_url(){
        return $this->constantes['aws_url'];
    }

    function declaracion_texto(){
        return $this->constantes['declaracion_texto'];
    }

}


?>
