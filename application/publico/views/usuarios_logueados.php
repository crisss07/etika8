<?php
if($_SESSION[$this->presession.'id']){
$this->db->query('UPDATE usuario_publico SET `usu_logueado`="'.date('Y-m-d H:i:s').'" WHERE usu_id='.$_SESSION[$this->presession.'id']);
}
$consulta = $this->db->query('SELECT usu_nombre as nombre, date_format(usu_logueado,"%Y-%m-%d") as fecha,date_format(usu_logueado,"%H:%i") as hora FROM usuario_publico where usu_estado="1" order by usu_nombre');
$usuarios=$consulta->result_array();
$fecha_actual=date('Y-m-d');
$hora_actual=strtotime(date('H:i'));
$contador=0;
if($usuarios){
?>
<table border="0" cellpadding="4" align="left">
    
<?php
    foreach ($usuarios as $usuario){
        if($usuario['fecha'] && $usuario['fecha']==$fecha_actual){
            $hora = $usuario['hora'];
            $nueva_hora= strtotime("$hora + 15 minute ").'<br/>';
            if($nueva_hora > $hora_actual){
                ?>
    <tr>
        <td>
            <img src="<?php echo $this->tool_entidad->sitio().'files/img/maq/login.gif';?>" />            
        </td>
        <td valign="middle">
            <?php echo $usuario['nombre'];?>
        </td>
    </tr>
    <?php
            }
            
        }
    }
    ?>    
</table>
    <?php }?>
