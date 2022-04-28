<?php if($this->id){
    $enlace=$this->rutabase.$this->controlador.'index/pagina/';
        $qry='
        SELECT com_id,usu_login, com_contenido, date_format(com_fecha_creacion,"%Y-%m-%d") as fecha
        FROM comentarios a, usuario_publico u
        WHERE a.usu_id = u.usu_id and for_id='.$this->id.'
        order by com_id desc, fecha desc';
        $total_registros=$this->db->query($qry)->num_rows();
        $total_paginas = ceil($total_registros / $this->registros);
        $consulta4 = $this->db->query($qry.'
        LIMIT '.$this->inicio.','.$this->registros.'
        ');
        $comentarios=$consulta4->result_array();

    /*$consulta = $this->db->query('
        SELECT com_id,usu_nombre, com_contenido, com_fecha_creacion
        FROM comentarios a, usuario_publico u
        WHERE a.usu_id = u.usu_id and for_id='.$this->id.'
        order by com_fecha_creacion desc, com_id desc');
        $comentarios=$consulta->result_array();*/
?>
<br/>
<?php
$msj_confirmar='¿Está seguro que desea eliminar el elemento seleccionado?';
$ruta = $this->tool_entidad->sitioindex();
?>
<div align="right">
    <?php
                    session_start();
                    $this->presession=$this->tool_entidad->presession();
                    if (isset($_SESSION[$this->presession.'usuario'])){
                    ?>
                    <div align="right">
                        <span>Usuario: <strong><?php echo $_SESSION[$this->presession.'usuario'];?></strong> </span>
                    </div>
                    <div class="cuerpo">
                        <div align="right">
                            <?php echo anchor('index/cerrar_session','Cerrar Sesion',array('tittle'=>'Cerrar Sesion')); ?><br/>
                            <?php echo anchor('usuario/cambiarpass/id/'.$_SESSION[$this->presession.'id'],'Cambiar Contraseña',array('tittle'=>'Cambiar Contraseña')); ?><br/>
                            <?php echo anchor('usuario/editar/id/'.$_SESSION[$this->presession.'id'],'Editar Perfil',array('tittle'=>'Editar Perfil')); ?>
                        </div>
                    </div>
                    <?php } ?>

</div>
<div style="margin-top: 20px;" align="center"><h2>Comentario</h2></div>
    <?php if($mensaje_exito) {?>

    <div align="center">
        <div class="texto_msj">
            <?php echo $msje; ?>
        </div>
    </div>
    <br/>
            <?php
            }
            ?>
<form method="post" action="<?php echo $ruta.'foro/comentario'; ?>" id="form_contacto">
    <table id="form_admin" align="center">
        <tr>
            <td valign="top">
                Usuario: <b><?php echo $usuario; ?> </b>
            </td>        
            <td valign="top">&nbsp;
            <?php $campo1='opinion_foro';
                  echo form_textarea(array(
                    'name' => $campo1,
                    'id' => $campo1,
                    'rows' => '3',
                    'cols' => '50',
                    'value' => set_value($campo1,$fila1[$campo1])
                    )) ;

                  if($error[$campo1])
                     echo '<div class="error">'.$error[$campo1].'</div>';
            ?>
        </td>
    </tr>
    <tr>

            <?php $campocap='captcha1';?>
            <?php //echo form_label('Código de imagen: ', $campocap);?>
        <td valign="top" align="center" colspan="2" style="font-size: 10px;">
            Código de imagen (sensible a mayúsculas y minúsculas)
            <br/>
            <img src="<?php echo base_url();?>files/captcha/securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>" width="180" id="image" align="absmiddle" />
            <?php

                echo form_input(array(
                    'name' => $campocap,
                    'id' => $campocap,
                    'size' => '10'
                  ));
                  if($error[$campocap])
                     echo '<div class="error">'.$error[$campocap].'</div>';
            ?>
        </td>
    </tr>

</table>


<br/>
<div align="center"><?php echo form_submit('enviar', 'Opinar') ?></div>

</form>

<div id="paginacion">
<?php
if(($this->pagina==1)&&($total_registros<=$this->registros)){
    ?>
    <!--<span class='paginaactual'>
                         <span class="corchete">[</span>
                         <?php echo $this->pagina; ?>
                         <span class="corchete">]</span>
                     </span>-->
    <?php
}
else{

if($total_registros) {?>

        <?php
        if(($this->pagina - 1) > 0) {
        $antpag=$this->pagina-1;
        ?>
            <a href='<?php echo $enlace.$antpag;?>' class='paginaant'>&laquo; Anterior</a>
        <?php
        }

        for ($i=1; $i<=$total_paginas; $i++){
                if($this->pagina == $i)
                {        ?>
                     <span class='paginaactual'>
                         <span class="corchete">[</span>
                         <?php echo $this->pagina; ?>
                         <span class="corchete">]</span>
                     </span>
               <?php }
               else {?>
                     <a href='<?php echo $enlace.$i?>' class='pagina'><?php echo $i;?></a>
        <?php
               }
        }

        if(($this->pagina + 1)<=$total_paginas) {
        $sigpag=$this->pagina+1;
             ?>
                     <a href='<?php echo $enlace.$sigpag;?>' class='paginasig'>Siguiente &raquo;</a>
        <?php
        }
        ?>

<?php
}
}
?>
</div>
    <table width="95%" border="0" align="center">
<?php foreach ($comentarios as $comentario){ ?>
    <tr>
        <td width="15%" align="left"><b>Usuario: </b></td>
        <td><?php echo $comentario['usu_login']?></td>
    </tr>
    <tr>
        <td valign="top" align="left"><b>Comentario: </b></td>
        <td><div align="justify"><?php echo $comentario['com_contenido']?></div></td>
    </tr>
    <tr>
        <td align="left"><b>Fecha: </b></td>
        <td><?php echo $comentario['fecha']?></td>
    </tr>
    <?php if($this->permisos=="1"){?>
    <tr>
        <td align="center" colspan="2">
            <?php echo anchor($this->controlador.'editar/id/'.$comentario['com_id'], 'Editar',array('class' =>'enlace_a1'));?> &nbsp; <?php echo anchor($this->controlador.'eliminar/id/'.$comentario['com_id'], 'Eliminar',array('class' =>'enlace_a1','onclick'=>"return confirmar('$msj_confirmar')")); ?>
        </td>
    </tr>
    <?php } ?>
    <tr>
        <td colspan="2">
            <hr>
        </td>
    </tr>
<?php }?>
    <tr>
        <td colspan="2">
            <div id="paginacion">
<?php
if(($this->pagina==1)&&($total_registros<=$this->registros)){
    ?>
    <!--<span class='paginaactual'>
                         <span class="corchete">[</span>
                         <?php echo $this->pagina; ?>
                         <span class="corchete">]</span>
                     </span>-->
    <?php
}
else{

if($total_registros) {?>

        <?php
        if(($this->pagina - 1) > 0) {
        $antpag=$this->pagina-1;
        ?>
            <a href='<?php echo $enlace.$antpag;?>' class='paginaant'>&laquo; Anterior</a>
        <?php
        }

        for ($i=1; $i<=$total_paginas; $i++){
                if($this->pagina == $i)
                {        ?>
                     <span class='paginaactual'>
                         <span class="corchete">[</span>
                         <?php echo $this->pagina; ?>
                         <span class="corchete">]</span>
                     </span>
               <?php }
               else {?>
                     <a href='<?php echo $enlace.$i?>' class='pagina'><?php echo $i;?></a>
        <?php
               }
        }

        if(($this->pagina + 1)<=$total_paginas) {
        $sigpag=$this->pagina+1;
             ?>
                     <a href='<?php echo $enlace.$sigpag;?>' class='paginasig'>Siguiente &raquo;</a>
        <?php
        }
        ?>

<?php
}
}
?>
</div>
        </td>
    </tr>
    <tr>
        <td>
            <br/>
        </td>
    </tr>
</table>

<?php }else{
?>
<p>no funciona</p>
<?php }?>