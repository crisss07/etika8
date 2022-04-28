<script src="<?php echo $this->tool_entidad->sitio();?>files/js/calendario/javascripts.js" type="text/javascript"></script>
<?php
$prefijosup=$this->prefijosup;
$prefijo=$this->prefijo;
$rutasup=$this->rutarchivo.$this->carpetasup;
$ruta=$this->rutarchivo.$this->carpeta;
$rutabaseimg=$this->rutabaseimg.$this->carpeta;
?>
<br/>
<?php if($this->sub){ 
    $prefijo='for_';
    $ruta=$this->rutarchivo.'foro/';
    $rutabaseimg=$this->rutabaseimg.'foro/';
    $qry='
        SELECT com_id,usu_login, com_contenido, date_format(com_fecha_creacion,"%Y-%m-%d") as fecha
        FROM comentarios a, usuario_publico u
        WHERE a.usu_id = u.usu_id and for_id='.$this->sub.'
        order by com_id desc, fecha desc';
        $consulta4 = $this->db->query($qry);
        $comentarios=$consulta4->result_array();
?>
<?php $this->load->view('acceso', $data); ?>
<h1><?php echo $fila[$prefijo.'titulo']; ?></h1>
<div style="padding: 0px 10px;" class="cuadro_intro">
     <?php
        if($fila[$prefijo.'img'])
        {
        ?>
            <?php
            $infoimg=@getimagesize($rutabaseimg.$fila[$prefijo.'img']);
            //$infoimg=@getimagesize($ruta.$fila[$prefijo.'img']);
            $ancho=$infoimg[0];
            $posicion=$fila[$prefijo.'posimg'];

             $e=$this->tool_general->estilo_posimg($ancho,$posicion);
                    $estilo_posicion=$e[0];
                    $ancho=$e[1];
            ?>

            <div class="<?php echo $estilo_posicion;?>">
                    <img src="<?php echo $ruta.$fila[$prefijo.'img'];?>" hspace="5" alt="" width="<?php echo $ancho;?>" />
                    <table width="<?php echo $ancho;?>" align="center">
                        <tr>
                            <td>
                                <div id="pie_img">
                                    <?php echo $fila[$prefijo.'pieimg']; ?>
                                </div>
                            </td>
                        </tr>
                    </table>
            </div>
        <?php
        }
        ?>
        <?php echo $fila[$prefijo.'contenido']; ?>
    </div>
    <div style="padding: 0px 10px;">
        <br/>
                        <?php
                        if($fila[$prefijo.'adj']){
                        $tipofile=$this->tool_general->tipofig_extension(strtolower(substr($fila[$prefijo.'adj'],-4)));
                        //var_dump($tipofile); var_dump($this->rutaimg);
                        ?>
    <hr/><h4>Adjunto</h4>
                           <img src="<?php echo $this->rutaimg.$tipofile.'.gif';?>" alt="tipo"/>
                           <a  href="<?php echo $this->rutabase.$this->controlador.'descargar/carpeta/foro/archivo/'.$fila[$prefijo.'adj'];?>" class="enlace_descarga1"><?php echo $fila[$prefijo.'adj'];?></a>
                        <?php } ?>
    </div><br/>    
    <?php if($comentarios){?>
    <table width="100%" border="0">
        <tr>
            <td colspan="2" align="center" >
               <h4>Comentarios</h4>
            </td>
        </tr>
<?php foreach ($comentarios as $comentario){ ?>
    <tr>
        <td width="10%">Usuario: </td>
        <td valign="top"><?php echo $comentario['usu_login']?></td>
    </tr>
    <tr>
        <td valign="top">Comentario: </td>
        <td valign="top"><div align="justify"><?php echo $comentario['com_contenido']?></div></td>
    </tr>
    <tr>
        <td valign="top">Fecha: </td>
        <td valign="top"><?php echo $comentario['fecha']?></td>
    </tr>
    <tr>
        <td colspan="2">
            <hr>
        </td>
    </tr>
<?php }?>
</table>
    <?php }?>

<?php }elseif($this->id){?>
    <?php if($ver){?>
<div class="enlace_boton1">
    <a href="<?php echo $this->rutabase.$this->controlador.'index/id/'.$this->id.'/sub/'.$fila['for_id'];?>">Ver el Foro</a>
</div>
    <?php } ?>
<h1><?php echo $fila[$prefijo.'titulo']; ?></h1>
<div style="padding: 0px 10px;" class="cuadro_intro">
     <?php
        if($fila[$prefijo.'img'])
        {
        ?>
            <?php
            $infoimg=@getimagesize($rutabaseimg.$fila[$prefijo.'img']);
            //$infoimg=@getimagesize($ruta.$fila[$prefijo.'img']);
            $ancho=$infoimg[0];
            $posicion=$fila[$prefijo.'posimg'];

             $e=$this->tool_general->estilo_posimg($ancho,$posicion);
                    $estilo_posicion=$e[0];
                    $ancho=$e[1];
            ?>

            <div class="<?php echo $estilo_posicion;?>">
                    <img src="<?php echo $ruta.$fila[$prefijo.'img'];?>" hspace="5" alt="" width="<?php echo $ancho;?>" />
                    <table width="<?php echo $ancho;?>" align="center">
                        <tr>
                            <td>
                                <div id="pie_img">
                                    <?php echo $fila[$prefijo.'pieimg']; ?>
                                </div>
                            </td>
                        </tr>
                    </table>
            </div>
        <?php
        }
        ?>
        <?php echo $fila[$prefijo.'contenido']; ?>
        <?php if(!$material){ ?>        
                        <?php
                        if($fila[$prefijo.'adj']){
                        $tipofile=$this->tool_general->tipofig_extension(strtolower(substr($fila[$prefijo.'adj'],-4)));
                        //var_dump($tipofile); var_dump($this->rutaimg);
                        ?>
    <hr/><h4>Adjunto</h4>
                           <img src="<?php echo $this->rutaimg.$tipofile.'.gif';?>" alt="tipo"/>
                           <a  href="<?php echo $this->rutabase.$this->controlador.'descargar/archivo/'.$fila[$prefijo.'adj'];?>" class="enlace_descarga1"><?php echo $fila[$prefijo.'adj'];?></a>
                        <?php } ?>
        <?php }else{ 
            $consulta = $this->db->query('
            select * from lectura_ob where mat_id='.$fila[$prefijo.'id'].' order by lec_orden asc');
            $lectura_obligatoria=$consulta->result_array();
            $consulta = $this->db->query('
            select * from lectura_co where mat_id='.$fila[$prefijo.'id'].' order by lec_orden asc');
            $lectura_complementaria=$consulta->result_array();            
        ?>
                           <hr/>
                           <table align="center" width="80%">
                               <tr>
                                   <?php if($lectura_obligatoria){?>
                                   <td width="50%">
                                       <h3>Lectura Obligatoria</h3>
                                            <?php foreach ($lectura_obligatoria as $lectura){
                                                $tipofile=$this->tool_general->tipofig_extension(strtolower(substr($lectura['lec_adj'],-4)));
                                            ?>
                                        <b><?php echo $lectura['lec_titulo'];?></b><br/>
                                        <?php echo $lectura['lec_contenido'];?>
                                            <img src="<?php echo $this->rutaimg.$tipofile.'.gif';?>" alt="tipo"/>
                                            <a  href="<?php echo $this->rutabase.$this->controlador.'descargar/carpeta/lectura_obligatorio/tipo/1/id/'.$lectura['lec_id'].'/archivo/'.$lectura['lec_adj'];?>" class="enlace_descarga1">Descargar</a><br/><br/>
                                            <?php } ?>

                                   </td>
                                   <?php }?>
                                   <?php if($lectura_complementaria){?>
                                   <td>
                                       <h3>Lectura Complementaria</h3>
                                            <?php foreach ($lectura_complementaria as $lectura){
                                                $tipofile=$this->tool_general->tipofig_extension(strtolower(substr($lectura['lec_adj'],-4)));
                                            ?>
                                        <b><?php echo $lectura['lec_titulo'];?></b><br/>
                                        <?php echo $lectura['lec_contenido'];?>
                                            <img src="<?php echo $this->rutaimg.$tipofile.'.gif';?>" alt="tipo"/>
                                            <a  href="<?php echo $this->rutabase.$this->controlador.'descargar/carpeta/lectura_complementaria/tipo/2/id/'.$lectura['lec_id'].'/archivo/'.$lectura['lec_adj'];?>" class="enlace_descarga1">Descargar</a><br/><br/>
                                            <?php } ?>

                                   </td>
                                   <?php }?>
                               </tr>
                           </table>
        <?php } ?>
    </div>        
<?php }?>
