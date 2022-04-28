<?php
class Controladoradmin extends CI_Controller
{   
    function __construct()
    {
	parent::__construct();     
	
    }
    function index()
    {
        
       
    }
     function agregar()
    {
        
        $this->definir_form_agregar();
        $prefijo=$this->prefijo;
        $modelo=$this->modelo;
        $ruta_origen=$this->ruta;

        $this->cabecera['accion']='Nuevo';

        if ($this->form_validation->run()==FALSE)
        {
            //$contenido['idp']=$this->idp;
            $uri = $this->uri->uri_to_assoc();
            if($this->vtip){                
                $this->tip=$uri['tip'];
                $enl='/tip/'.$this->tip;
            }
            if($this->vidp){                
                $this->idp=$uri['idp'];
                $enl='/idp/'.$this->idp.''.$enl;
            }            

            $contenido['cabecera']=$this->cabecera;
            $contenido['action'] = $this->controlador.'agregar'.$enl;
            $data['contenido'] = $this->load->view($this->carpeta.$this->formulario_agregar, $contenido, true);
            $this->load->view('plantilla_privado', $data);
	}
        else
        {
             for($i=0;$i<count($this->campo);$i++)
             {  $data[$this->campo[$i]] = $this->input->post( $this->campo[$i]); }

             for($i=0;$i<count($this->campoup_img);$i++)
             { 
                 $archivo_img[$i]['name']=$this->tool_general->limpiar_cadena($_FILES[$this->campoup_img[$i]]['name']);
                 $archivo_img[$i]['tmp']=$_FILES[$this->campoup_img[$i]]["tmp_name"];
             }

             for($i=0;$i<count($this->campoup_adj);$i++)
             { $archivo_adj[$i]=$this->tool_general->limpiar_cadena($_FILES[$this->campoup_adj[$i]]['name']); }                         
             /*
            if($this->orden)
            {
                $consulta2 = $this->db->query('
                SELECT * FROM '.$this->tabla.' ORDER BY '.$this->orden.' desc');
                $fila=$consulta2->first_row('array');
                $data[$this->orden]=$fila[$this->orden]+1;
            }*/            

            if($this->vidp){
                $this->idp=$this->input->post('idp');
                $data[$this->vidp]=$this->idp;
            }
            if($this->vtip){
                $this->tip=$this->input->post('tip');
                if(!$this->nodata){ $data[$this->vtip]=$this->tip;}
                }

            if($this->orden)
            {
                if($this->vidp)
                {
                    if(($this->vtip)&&(!$this->nodata)){
                        $consulta2 = $this->db->query('
                        SELECT * FROM '.$this->tabla.'
                        WHERE '.$this->vidp.'="'.$this->idp.'"
                            '.$this->vtip.'="'.$this->tip.'"
                        ORDER BY '.$this->orden.' desc');
                     
                    }
                    else{
                    $consulta2 = $this->db->query('
                    SELECT * FROM '.$this->tabla.'
                    WHERE '.$this->vidp.'="'.$this->idp.'"
                    ORDER BY '.$this->orden.' desc');                    
                    }
                }
                else{
                    if(($this->vtip)&&(!$this->nodata)){
                        $consulta2 = $this->db->query('
                        SELECT * FROM '.$this->tabla.'
                        WHERE '.$this->vtip.'="'.$this->tip.'"
                        ORDER BY '.$this->orden.' desc');
                        
                    }
                    else{
                    $consulta2 = $this->db->query('
                    SELECT * FROM '.$this->tabla.'
                    ORDER BY '.$this->orden.' desc');
                    
                    }
                }
                $fila=$consulta2->first_row('array');
                $data[$this->orden]=$fila[$this->orden]+1;
            }
                
            $id=$this->$modelo->agregar($data);

            if($id)
            {
                 $data_img[$this->prefijo.'id']=$id;

                 for($i=0;$i<count($this->campoup_img);$i++)
                 {
                     if($this->campoup_img[$i])
                     {
                         $ext=substr($archivo_img[$i]['name'],0,-4);
                         $ext=substr($archivo_img[$i]['name'],strlen($ext),4);
                         $nombre_archivo_nuevo = substr($archivo_img[$i]['name'],0,-4).'_'.$id.$ext;
                         $infoimg=@getimagesize($archivo_img[$i]['tmp']);
                         $ancho=$infoimg[0];
                         if($ancho<=$this->tool_entidad->ancho_imagen()) {
                             if(copy($archivo_img[$i]['tmp'],$ruta_origen.$nombre_archivo_nuevo)) {
                                 $consulta = $this->db->query('update '.$this->tabla.' set '.$this->campoup_img[$i].'="'.$nombre_archivo_nuevo.'" where '.$this->prefijo.'id='.$id);
                                 $nombre_thum='t_'.$nombre_archivo_nuevo;                                 
                                 if(count($this->campoup_img_thum_width)||count($this->campoup_img_thum_height)) {
                                     $this->tool_general->crear_thumbnail($nombre_archivo_nuevo,$nombre_thum,$this->campoup_img_thum_width[$i],$this->campoup_img_thum_height[$i],$ruta_origen,0,$this->escalar_img_thum);
                                 }

                             }
                         }else {
                             if(copy($archivo_img[$i]['tmp'],$ruta_origen.$nombre_archivo_nuevo)) {
                                 $consulta = $this->db->query('update '.$this->tabla.' set '.$this->campoup_img[$i].'="'.$nombre_archivo_nuevo.'" where '.$this->prefijo.'id='.$id);
                                 $nombre_thum='t_'.$nombre_archivo_nuevo;
                                 $this->tool_general->crear_thumbnail($nombre_archivo_nuevo,$nombre_archivo_nuevo,$this->tool_entidad->ancho_imagen(),$this->campoup_img_height[$i],$ruta_origen,0,$this->escalar_img);
                                 if(count($this->campoup_img_thum_width)||count($this->campoup_img_thum_height)) {
                                     $this->tool_general->crear_thumbnail($nombre_archivo_nuevo,$nombre_thum,$this->campoup_img_thum_width[$i],$this->campoup_img_thum_height[$i],$ruta_origen,0,$this->escalar_img_thum);
                                 }

                             }
                         }
                         /*$this->upload->file_name=substr($archivo_img[$i],0,-4).'_'.$id;

                         if($this->upload->do_upload($this->campoup_img[$i]))
                         {
                             $nombre_archivo=substr($archivo_img[$i],0,-4).'_'.$id.substr($archivo_img[$i],-4);
                             $data_img[$this->campoup_img[$i]]=$nombre_archivo;
                             $this->$modelo->editar($data_img);
                             $nombre_thum='t_'.$nombre_archivo;

                             if(count($this->campoup_img_width)||count($this->campoup_img_height))
                             { $this->tool_general->crear_thumbnail($nombre_archivo,$nombre_archivo,$this->campoup_img_width[$i],$this->campoup_img_height[$i],$ruta_origen,0,$this->escalar_img);}
                             if(count($this->campoup_img_thum_width)||count($this->campoup_img_thum_height))
                             { $this->tool_general->crear_thumbnail($nombre_archivo,$nombre_thum,$this->campoup_img_thum_width[$i],$this->campoup_img_thum_height[$i],$ruta_origen,0,$this->escalar_img_thum); }

                         }*/
                     }
                 }
                 //***************
                 $data_adj[$this->prefijo.'id']=$id;
                 for($i=0;$i<count($this->campoup_adj);$i++)
                 {
                     if($this->campoup_adj[$i])
                     {

                        $adjunto[$i] = $_FILES[$this->campoup_adj[$i]]["tmp_name"];
                        if($adjunto[$i]){
                             $nom_adjunto=substr($archivo_adj[$i],0,-4).'_'.$id.substr($archivo_adj[$i],-4);
                             @copy($adjunto[$i],$ruta_origen.$nom_adjunto);
                             $data_adj[$this->campoup_adj[$i]]=$nom_adjunto;
                             $this->$modelo->editar($data_adj);
                        }

                     }
                 }

                  //*************** audio
                 $data_aud[$this->prefijo.'id']=$id;
                 for($i=0;$i<count($this->campoup_aud);$i++)
                 {
                     if($this->campoup_aud[$i])
                     {
                         //var_dump($this->campoup_aud[$i]); exit ();
                         $this->upload->file_name=substr($archivo_aud[$i],0,-4).'_'.$id;
                         if($this->upload->do_upload($this->campoup_aud[$i]))
                         {

                             $nom_audio=substr($archivo_aud[$i],0,-4).'_'.$id.substr($archivo_aud[$i],-4);
                             $data_aud[$this->campoup_aud[$i]]=$nom_audio;
                             $this->$modelo->editar($data_aud);

                             //var_dump($nom_audio); exit ();
                         }
                     }
                 }

               
                if($this->no_mostrar_enlaces)
                {
                    $contenido = '';
                    $data['contenido'] = $this->load->view($this->carpeta.'/mensaje_exito', $contenido, true);
                    $this->load->view('plantilla_privado', $data);
                }
                else
                {

                    if(!$this->enlace_retorno){
                        if($this->idp){
                            if($this->tip){
                                redirect($this->controlador.$this->action_defecto.'/idp/'.$this->idp.'/tip/'.$this->tip);
                            }
                            else{
                                redirect($this->controlador.$this->action_defecto.'/idp/'.$this->idp);
                            }
                        }
                        else{
                            if($this->tip){
                                redirect($this->controlador.$this->action_defecto.'/tip/'.$this->tip);
                            }
                            else{
                                redirect($this->controlador.$this->action_defecto);
                            }
                        }
                    }
                    else{
                               redirect($this->enlace_retorno.$this->tip);
                    }

                }
            }
	}
    }

    function editar()
    {
        if($this->definirform){$this->definir_form_editar();}
        else{$this->definir_form_agregar();}

        $uri = $this->uri->uri_to_assoc(3);
        $id=$uri['id'];
        if($this->vtip){$this->tip=$uri['tip'];}
        if($this->vidp){$this->idp=$uri['idp'];}
        
        $prefijo=$this->prefijo;

        $consulta = $this->db->query('
        SELECT * FROM '.$this->tabla.' WHERE '.$this->prefijo.'id='.$id);
        $fila=$consulta->first_row('array');

        $this->cabecera['accion']='Editar';

        for($i=0;$i<count($this->campoup_img);$i++)
         {
            $j=$i+1;
            $fila[$this->prefijo.'img_borrar'.$j]=$fila[$this->campoup_img[$i]];
            $fila[$this->campoup_img[$i]]='';
         }
        for($i=0;$i<count($this->campoup_adj);$i++)
         {
            $j=$i+1;
            $fila[$this->campoup_adj[$i].'_borrar'.$j]=$fila[$this->campoup_adj[$i]];
            $fila[$this->campoup_adj[$i]]='';
         }
        
        $contenido['cabecera']=$this->cabecera;
        $contenido['action'] = $this->controlador.'guardar_editar';
        $contenido['fila'] = $fila;

        $data['contenido'] = $this->load->view($this->carpeta.$this->formulario_editar,$contenido, true);
        $this->load->view('plantilla_privado', $data);

    }

    function guardar_editar()
    {        
        if($this->definirform){$this->definir_form_editar();}
        else{$this->definir_form_agregar();}
        $modelo=$this->modelo;
        $this->cabecera['accion']='Editar';
        $prefijo=$this->prefijo;
        $ruta_origen=$this->ruta;
        if($this->vidp){
                $this->idp=$this->input->post('idp');
            }
         if($this->vtip){
                $this->tip=$this->input->post('tip');
            }

        if ($this->form_validation->run()==FALSE)
        {

            $id=$this->input->post($this->prefijo.'id');
            $consulta = $this->db->query('
            SELECT * FROM '.$this->tabla.' WHERE '.$this->prefijo.'id='.$id);
            $fila1=$consulta->first_row('array');

            for($i=0;$i<count($this->campoup_img);$i++)
             {
                $j=$i+1;
                $fila[$this->prefijo.'img_borrar'.$j]=$fila1[$this->campoup_img[$i]];                
                $fila[$this->campoup_img[$i]]='';
             }
            for($i=0;$i<count($this->campoup_adj);$i++)
             {
                $j=$i+1;
                $fila[$this->campoup_adj[$i].'_borrar'.$j]=$fila1[$this->campoup_adj[$i]];
                $fila[$this->campoup_adj[$i]]='';
             }
           

            $fila[$this->prefijo.'id']=$fila1[$this->prefijo.'id'];

            $contenido['cabecera']=$this->cabecera;
            $contenido['fila']=$fila;
            $contenido['action'] = $this->controlador.'guardar_editar';
            $data['contenido'] = $this->load->view($this->carpeta.$this->formulario_editar,$contenido, true);
            $this->load->view('plantilla_privado', $data);
	}
        else
        {
             //recibiendo los datos del formulario
             for($i=0;$i<count($this->campo);$i++)
             {
                $data[$this->campo[$i]] = $this->input->post($this->campo[$i]);
             }
             //var_dump($data); exit ();

             for($i=0;$i<count($this->campoup_img);$i++)
             {
                $j=$i+1;
                $archivo_img[$i]['name']=$this->tool_general->limpiar_cadena($_FILES[$this->campoup_img[$i]]['name']);
                $archivo_img[$i]['tmp']=$_FILES[$this->campoup_img[$i]]["tmp_name"];
                $borrar_img[$i]=$this->input->post($this->campoup_img[$i].'_borrar'.$j);

                //var_dump($archivo_img); exit ();
             }
             for($i=0;$i<count($this->campoup_adj);$i++)
             {
                $j=$i+1;
                $archivo_adj[$i]=$this->tool_general->limpiar_cadena($_FILES[$this->campoup_adj[$i]]['name']);
                $borrar_adj[$i]=$this->input->post($this->campoup_adj[$i].'_borrar'.$j);
             }
          

            $solo_eliminar_img=$this->input->post('solo_eliminar_img');
            $solo_eliminar_adj=$this->input->post('solo_eliminar_adj');
            //$solo_eliminar_aud=$this->input->post('solo_eliminar_aud');

            $data[$this->prefijo.'id']=$this->input->post($this->prefijo.'id');

            if($this->$modelo->editar($data))
            {
                 $id=$data[$prefijo.'id'];
                 $data_img[$prefijo.'id']=$id;
                 $data_eliminar_img[$prefijo.'id']=$id;

                 for($i=0;$i<count($this->campoup_img);$i++)
                 {
                     if($this->campoup_img[$i])
                     {                        

                         if($archivo_img[$i]['name']){
                             @unlink($ruta_origen.$borrar_img[$i]);
                             $nombre_thum='t_'.substr($borrar_img[$i],0,-4).substr($borrar_img[$i],-4);
                             @unlink($ruta_origen.$nombre_thum);
                             $ext=substr($archivo_img[$i]['name'],0,-4);
                             $ext=substr($archivo_img[$i]['name'],strlen($ext),4);
                             $nombre_archivo_nuevo = substr($archivo_img[$i]['name'],0,-4).'_'.$id.$ext;
                             $infoimg=@getimagesize($archivo_img[$i]['tmp']);
                             $ancho=$infoimg[0];
                             if($ancho<=$this->tool_entidad->ancho_imagen()) {
                                 if(copy($archivo_img[$i]['tmp'],$ruta_origen.$nombre_archivo_nuevo)) {
                                     $consulta = $this->db->query('update '.$this->tabla.' set '.$this->campoup_img[$i].'="'.$nombre_archivo_nuevo.'" where '.$this->prefijo.'id='.$id);
                                     $nombre_thum='t_'.$nombre_archivo_nuevo;
                                     if(count($this->campoup_img_thum_width)||count($this->campoup_img_thum_height)) {
                                         $this->tool_general->crear_thumbnail($nombre_archivo_nuevo,$nombre_thum,$this->campoup_img_thum_width[$i],$this->campoup_img_thum_height[$i],$ruta_origen,0,$this->escalar_img_thum);
                                     }

                                 }
                             }else {
                                 if(copy($archivo_img[$i]['tmp'],$ruta_origen.$nombre_archivo_nuevo)) {
                                     $consulta = $this->db->query('update '.$this->tabla.' set '.$this->campoup_img[$i].'="'.$nombre_archivo_nuevo.'" where '.$this->prefijo.'id='.$id);
                                     $nombre_thum='t_'.$nombre_archivo_nuevo;
                                     $this->tool_general->crear_thumbnail($nombre_archivo_nuevo,$nombre_archivo_nuevo,$this->tool_entidad->ancho_imagen(),$this->campoup_img_height[$i],$ruta_origen,0,$this->escalar_img);
                                     if(count($this->campoup_img_thum_width)||count($this->campoup_img_thum_height)) {
                                         $this->tool_general->crear_thumbnail($nombre_archivo_nuevo,$nombre_thum,$this->campoup_img_thum_width[$i],$this->campoup_img_thum_height[$i],$ruta_origen,0,$this->escalar_img_thum);
                                     }

                                 }
                             }
                             /* @unlink($ruta_origen.$borrar_img[$i]);
                              $nombre_thum='t_'.substr($borrar_img[$i],0,-4).substr($borrar_img[$i],-4);
                              @unlink($ruta_origen.$nombre_thum);
                             $this->upload->file_name=substr($archivo_img[$i],0,-4).'_'.$id;

                             if($this->upload->do_upload($this->campoup_img[$i]))
                             {
                                 $nombre_archivo=substr($archivo_img[$i],0,-4).'_'.$id.substr($archivo_img[$i],-4);
                                 $data_img[$this->campoup_img[$i]]=$nombre_archivo;

                                 $this->$modelo->editar($data_img);
                                
                                 //**** crear thumbnails
                                 $nombre_thum='t_'.substr($archivo_img[$i],0,-4).'_'.$id.substr($archivo_img[$i],-4);
                                 if(count($this->campoup_img_width)||count($this->campoup_img_height))
                                 { $this->tool_general->crear_thumbnail($nombre_archivo,$nombre_archivo,$this->campoup_img_width[$i],$this->campoup_img_height[$i],$ruta_origen,0,$this->escalar_img); }
                                 if(count($this->campoup_img_thum_width)||count($this->campoup_img_thum_height))
                                 { $this->tool_general->crear_thumbnail($nombre_archivo,$nombre_thum,$this->campoup_img_thum_width[$i],$this->campoup_img_thum_height[$i],$ruta_origen,0,$this->escalar_img_thum); }

                             }*/

                         }
                         else
                         {
                             if($solo_eliminar_img[$i])
                             {

                                 $data_eliminar_img[$this->campoup_img[$i]]='';
                                 $this->$modelo->editar($data_eliminar_img);
                                 @unlink($ruta_origen.$borrar_img[$i]);
                                 $nombre_thum='t_'.substr($borrar_img[$i],0,-4).substr($borrar_img[$i],-4);
                                 @unlink($ruta_origen.$nombre_thum);
                             }


                         }

                     }

                 }
                 //**** adjunto

                 $data_adj[$prefijo.'id']=$id;
                 $data_eliminar_adj[$prefijo.'id']=$id;
                 for($i=0;$i<count($this->campoup_adj);$i++)
                 {
                     if($this->campoup_adj[$i])
                     {                         
                          if($archivo_adj[$i]){
                             @unlink($ruta_origen.$borrar_adj[$i]);
                             $adjunto[$i] = $_FILES[$this->campoup_adj[$i]]["tmp_name"];
                            if($adjunto[$i]){
                                 $nom_adjunto=substr($archivo_adj[$i],0,-4).'_'.$id.substr($archivo_adj[$i],-4);
                                 @copy($adjunto[$i],$ruta_origen.$nom_adjunto);
                                 $data_adj[$this->campoup_adj[$i]]=$nom_adjunto;
                                 $this->$modelo->editar($data_adj);
                            }

                         }
                         else
                         {
                             if($solo_eliminar_adj[$i])
                             {
                                 $data_eliminar_adj[$this->campoup_adj[$i]]='';
                                 $this->$modelo->editar($data_eliminar_adj);
                                 @unlink($ruta_origen.$borrar_adj[$i]);
                             }
                         }
                     }
                 }

                if($this->no_mostrar_enlaces)
                {
                    $contenido = '';
                    $data['contenido'] = $this->load->view($this->carpeta.'/mensaje_exito', $contenido, true);
                    $this->load->view('plantilla_privado', $data);
                }
                else
                {
                    if(!$this->enlace_retorno){
                        if($this->idp){
                            if($this->tip){
                                redirect($this->controlador.$this->action_defecto.'/idp/'.$this->idp.'/tip/'.$this->tip);
                            }
                            else{
                                redirect($this->controlador.$this->action_defecto.'/idp/'.$this->idp);
                            }
                        }
                        else{
                            if($this->tip){
                                redirect($this->controlador.$this->action_defecto.'/tip/'.$this->tip);
                            }
                            else{
                                redirect($this->controlador.$this->action_defecto);
                            }
                        }
                      }
                    else{
                        
                               redirect($this->enlace_retorno.$this->tip);
                    }
                }

            }
	}
    }



/*
    function procesar()
    {
       if($this->vidp){
            $this->idp=$this->input->post('idp');
            if(($this->vtip)&&(!$this->nodata)){
                $this->tip=$this->input->post('tip');
                $consulta = $this->db->query('
                SELECT * FROM '.$this->tabla.'
                where '.$this->vidp.'="'.$this->idp.'" and '.$this->vtip.'="'.$this->tip.'"
                order by '.$this->prefijo.'id asc');
            }
            else{
                $consulta = $this->db->query('
                SELECT * FROM '.$this->tabla.'
                where '.$this->vidp.'="'.$this->idp.'"
                order by '.$this->prefijo.'id asc');
            }
        }
        else{
            if(($this->vtip)&&(!$this->nodata)){
                $this->tip=$this->input->post('tip');
                $consulta = $this->db->query('
                SELECT * FROM '.$this->tabla.'
                where '.$this->vtip.'="'.$this->tip.'"
                order by '.$this->prefijo.'id asc');
            }
            else{
            $consulta = $this->db->query('
                SELECT * FROM '.$this->tabla.'
                order by '.$this->prefijo.'id asc');
            }
        }
         if($this->vtip){
              $this->tip=$this->input->post('tip');
         }
              

        
        $datos=$consulta->result_array();


       

        $eliminar = $this->input->post('eliminar');
        $deshabilitar = $this->input->post('deshabilitar');
        $habilitar = $this->input->post('habilitar');
        
        $destacadomas = $this->input->post('destacadomas');        
        $botondestacadomas = $this->input->post('botondestacadomas');

        $actualizar = $this->input->post('actualizar');
        $bandera = $this->input->post('bandera');
        $ordenar = $this->input->post('ordenar');
        $modelo=$this->modelo;
        //$this->load->model($this->carpeta.'fsimple/fsimple_model', $modelo, TRUE);

        $ruta_origen=$this->ruta;
        $accion_realizada='';
        foreach ($datos as $fila)
        {
            $chk = $this->input->post('chk'.$fila[$this->prefijo.'id']);
            $chkd = $this->input->post('chkd'.$fila[$this->prefijo.'id']);
            $orden = $this->input->post('orden'.$fila[$this->prefijo.'id']);
            
            if($botondestacadomas=="Actualizar destacados")
            {  
                if($chkd=='on'){  $fila[$destacadomas]='1';  }
                else { $fila[$destacadomas]='0'; }
                $this->$modelo->editar($fila);
            }
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
                         if($this->enlaces){
                             for($i=1;$i<=(count($this->enlaces)/$this->nroenlaces);$i++){
                                 $this->eliminarsub($this->enlaces['campo'.$i],$fila[$this->prefijo.'id'],$this->enlaces['id'.$i],$this->enlaces['url'.$i],$this->enlaces['tabla'.$i],$this->enlaces['campoborrar'.$i]);
                             }
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
         if($this->idp){
                        if($this->tip){
                            redirect($this->controlador.$this->action_defecto.'/idp/'.$this->idp.'/tip/'.$this->tip);
                        }
                        else{
                            redirect($this->controlador.$this->action_defecto.'/idp/'.$this->idp);
                        }
                    }
                    else{
                        if($this->tip){
                            redirect($this->controlador.$this->action_defecto.'/tip/'.$this->tip);
                        }
                        else{
                            redirect($this->controlador.$this->action_defecto);
                        }
                    }

    }
*/
     function reordenar($campo,$tipo,$orden,$tabla,$prefijo,$vtip,$tip,$vidp,$idp,$nodata){
         $modelo=$this->modelo;
         
         if($vidp){
            if(($vtip)&&(!$nodata)){

                $consulta = $this->db->query('
                SELECT '.$prefijo.'id,'.$orden.' FROM '.$tabla.'
                where '.$vidp.'="'.$idp.'" and '.$vtip.'="'.$tip.'"
                order by '.$campo.' '.$tipo.'');
                
            }
            else{
                $consulta = $this->db->query('
                SELECT '.$prefijo.'id,'.$orden.' FROM '.$tabla.'
                where '.$vidp.'="'.$idp.'"
                order by '.$campo.' '.$tipo.'');
                
            }
        }
        else{            
            if(($vtip)&&(!$nodata)){
                $consulta = $this->db->query('
                SELECT '.$prefijo.'id,'.$orden.' FROM '.$tabla.'
                where '.$vtip.'="'.$tip.'"
                order by '.$campo.' '.$tipo.'');
               
            }
            else{
            $consulta = $this->db->query('
                SELECT '.$prefijo.'id,'.$orden.' FROM '.$tabla.'
                order by '.$campo.' '.$tipo.'');
            
            }
        }
        $datos=$consulta->result_array();
        
        $i=0;
        foreach ($datos as $fila){
            $i++;
            $fila[$orden]=$i;
            $this->$modelo->editar($fila);
        }       
        return true;
       

    }
    function procesar()
    {        
        if($this->vidp){
                $this->idp=$this->input->post('idp');
                if(($this->vtip)&&(!$this->nodata)){
                    $this->tip=$this->input->post('tip');
                    $consulta = $this->db->query('
                    SELECT * FROM '.$this->tabla.'
                    where '.$this->vidp.'="'.$this->idp.'" and '.$this->vtip.'="'.$this->tip.'"
                    order by '.$this->prefijo.'id asc');
                }
                else{
                    $consulta = $this->db->query('
                    SELECT * FROM '.$this->tabla.'
                    where '.$this->vidp.'="'.$this->idp.'"
                    order by '.$this->prefijo.'id asc');
                }
            }
            else{
                
                if(($this->vtip)&&(!$this->nodata)){
                    $this->tip=$this->input->post('tip');
                    $consulta = $this->db->query('
                    SELECT * FROM '.$this->tabla.'
                    where '.$this->vtip.'="'.$this->tip.'"
                    order by '.$this->prefijo.'id asc');
                }
                else{
                    
                    $consulta = $this->db->query('
                    SELECT * FROM '.$this->tabla.'
                    order by '.$this->prefijo.'id asc');
                }
            }
             if($this->vtip){
                  $this->tip=$this->input->post('tip');
             }

             
        $oporden=$this->input->post('oporden');
        $ordenar = $this->input->post('ordenar');
        
        

        //si no se ha presionado el boton ordenar y no hay opc seguri normal
        if(($oporden==$this->prefijo.'orden')||($ordenar!="Ordenar")){


                $datos=$consulta->result_array();


                //consulta original
                /*
                 $consulta = $this->db->query('
                SELECT * FROM '.$this->tabla.' order by '.$this->prefijo.'id asc');
                $datos=$consulta->result_array();
                 */
                 
                $eliminar = $this->input->post('eliminar');
                $deshabilitar = $this->input->post('deshabilitar');
                $habilitar = $this->input->post('habilitar');

                $destacadomas = $this->input->post('destacadomas');
                $botondestacadomas = $this->input->post('botondestacadomas');

                $actualizar = $this->input->post('actualizar');
                $bandera = $this->input->post('bandera');
                $ordenar = $this->input->post('ordenar');
                $modelo=$this->modelo;
                //$this->load->model($this->carpeta.'fsimple/fsimple_model', $modelo, TRUE);

                $ruta_origen=$this->ruta;
                $accion_realizada='';
                foreach ($datos as $fila)
                {
                    $chk = $this->input->post('chk'.$fila[$this->prefijo.'id']);
                    $chkd = $this->input->post('chkd'.$fila[$this->prefijo.'id']);
                    $orden = $this->input->post('orden'.$fila[$this->prefijo.'id']);

                    if($botondestacadomas=="Actualizar destacados")
                    {
                        if($chkd=='on'){  $fila[$destacadomas]='1';  }
                        else { $fila[$destacadomas]='0'; }
                        $this->$modelo->editar($fila);
                    }
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
                                 if($this->enlaces){
                                     for($i=1;$i<=(count($this->enlaces)/$this->nroenlaces);$i++){
                                         $this->eliminarsub($this->enlaces['campo'.$i],$fila[$this->prefijo.'id'],$this->enlaces['id'.$i],$this->enlaces['url'.$i],$this->enlaces['tabla'.$i],$this->enlaces['campoborrar'.$i]);
                                     }
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


             }
        else{            
            if($oporden){                
                $tiporden = $this->input->post('tiporden');                
                $this->reordenar($oporden,$tiporden,$this->orden,$this->tabla,$this->prefijo,$this->vtip,$this->tip,$this->vidp,$this->idp,$this->nodata);                
            }
        }

         if($this->idp){
                            if($this->tip){
                                redirect($this->controlador.$this->action_defecto.'/idp/'.$this->idp.'/tip/'.$this->tip);
                            }
                            else{
                                redirect($this->controlador.$this->action_defecto.'/idp/'.$this->idp);
                            }
                        }
                        else{
                            if($this->tip){
                                redirect($this->controlador.$this->action_defecto.'/tip/'.$this->tip);
                            }
                            else{
                                redirect($this->controlador.$this->action_defecto);
                            }
                        }


    }

     function eliminarsub($camposup,$id,$idsub,$ruta,$tabla,$camposelim=array())
    {       

        $consulta = $this->db->query('
        SELECT * FROM '.$tabla.' WHERE '.$camposup.'='.$id);
        $datos=$consulta->result_array();
        
        foreach ($datos as $fila){

            for($j=0;$j<count($camposelim);$j++){

                $borrar=$fila[$camposelim[$j]];
                @unlink($ruta.$borrar);
                $nombre_thum='t_'.substr($borrar,0,-4).substr($borrar,-4);
                @unlink($ruta.$nombre_thum);
                $fila[$camposelim[$j]]='';

            }
            $this->db->delete($tabla, array($idsub => $fila[$idsub]));
        }
        return true;
    }

    function eliminar($var,$id)
    {

        $ruta_origen=$this->ruta;
        $consulta = $this->db->query('
        SELECT * FROM '.$this->tabla.' WHERE '.$this->prefijo.'id='.$id);

        $fila=$consulta->first_row('array');
        for($i=0;$i<count($this->campoup_img);$i++)
         {
             if($this->campoup_img[$i])
             {
                     $borrar_img[$i]=$fila[$this->campoup_img[$i]];
                     @unlink($ruta_origen.$borrar_img[$i]);
                     $nombre_thum='t_'.substr($borrar_img[$i],0,-4).substr($borrar_img[$i],-4);
                     @unlink($ruta_origen.$nombre_thum);
                     $fila[$this->campoup_img[$i]]='';
             }
         }

         for($i=0;$i<count($this->campoup_adj);$i++)
         {
             if($this->campoup_adj[$i])
             {
                     $borrar_adj[$i]=$fila[$this->campoup_adj[$i]];
                     @unlink($ruta_origen.$borrar_adj[$i]);
                     $fila[$this->campoup_adj[$i]]='';
             }
         }

         if($this->enlaces){
             for($i=1;$i<=(count($this->enlaces)/$this->nroenlaces);$i++){
                 $this->eliminarsub($this->enlaces['campo'.$i],$id,$this->enlaces['id'.$i],$this->enlaces['url'.$i],$this->enlaces['tabla'.$i],$this->enlaces['campoborrar'.$i]);                 
             }             
         }
         
         $this->db->delete($this->tabla, array($this->prefijo.'id' => $fila[$this->prefijo.'id']));

          if($this->idp){
                        if($this->tip){
                            redirect($this->controlador.$this->action_defecto.'/idp/'.$this->idp.'/tip/'.$this->tip);
                        }
                        else{
                            redirect($this->controlador.$this->action_defecto.'/idp/'.$this->idp);
                        }
                    }
                    else{
                        if($this->tip){
                            redirect($this->controlador.$this->action_defecto.'/tip/'.$this->tip);
                        }
                        else{
                            redirect($this->controlador.$this->action_defecto);
                        }
                    }

    }

    

    function deshabilitar()
    {

        $id=$this->uri->segment(4);

        $consulta = $this->db->query('
        SELECT * FROM '.$this->tabla.' WHERE '.$this->prefijo.'id='.$id);
        $fila=$consulta->first_row('array');
        $fila[$this->prefijo.'estado']='0';
        $modelo=$this->modelo;
        $this->$modelo->editar($fila);
        redirect($this->controlador.$this->action_defecto);


    }

    function habilitar()
    {

        $id=$this->uri->segment(4);

        $consulta = $this->db->query('
        SELECT * FROM '.$this->tabla.' WHERE '.$this->prefijo.'id='.$id);
        $fila=$consulta->first_row('array');
        $fila[$this->prefijo.'estado']='1';
        $modelo=$this->modelo;
        $this->$modelo->editar($fila);
        redirect($this->controlador.$this->action_defecto);


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
                     'regla'   => 'valid_email',
                     'mensaje'   => 'Debe escribir una dirección de email correcta'
                  )
            );
       return $mensajes;
    }

}


?>