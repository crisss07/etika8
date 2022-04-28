<br/>
<?php
$this->load->view('cabecera');
?>
<?php
$sitio=$this->tool_entidad->sitioindexpri();
?>

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
<style>
    .numberCircle {
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
    
    color:white;
    background:#B4AB9B;
    position: absolute;
    justify-content: center;
    align-items: center;
    text-align: center;
    font-weight: bold;
   
    
}
.circulo {
    width: 1.5rem;
    height: 1.5rem;
    border-radius: 50%;
    background: #B4AB9B;
    display: flex;
    position: absolute;
    justify-content: center;
    align-items: center;
    text-align: center;
    font-size: 12px;
    font-weight: bold;
    color:white;
    font-family: Roboto;
  
  
}

</style>
<style>
    .vineta {    
    color:#F58960;
    position: absolute;
    font-size: 14px;

}
.color_b{
    font-size: 22px;
    color: #404141;
    font-family: Roboto;

}
.a.color_b:link,a.color_b:visited , a.color_b:active{

    font-family: Roboto;
    font-size: 22px;
    font-style: normal;

      
    color: #404141;
    text-decoration: none;        
}
a.color_b:hover {

    font-family: Roboto;

    color: #404141;
    text-decoration: underline;


}
</style>
<div class="row">
    <div class="col-md-3" ></div>
    <div class="col-md-8" >

<div id="listado"><br/>
    <table border="0" cellpadding=10" align="center" width="90%">
        <tr>                      
            <td align="left">
                <div class="circulo">1 </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                <?php echo anchor('postulante/listar', 'Buscador de Postulantes (Impresi&oacute;n de CV)',array('class' =>'color_b')); ?>
            </td>  
        </tr>
        <tr>
            <td align="left">
                <div class="circulo">2 </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                <?php echo anchor('reportes/postulante', 'Reportes de Postulantes (Filtros)',array('class' =>'color_b')); ?>
            </td>
        </tr>
        <?php if($_SESSION[$this->presession.'permisos']<'3'){ ?>
        <tr>
            <td align="left">
                <div class="circulo">3 </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                <?php echo anchor('reportes/etiko', 'Reporte ETIKOS',array('class' =>'color_b')); ?>
            </td>
        </tr>
        <tr>
            <td align="left">
                <div class="circulo ">4 </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <?php echo anchor('#', 'Reporte ¿Cómo se enteró de esta postulación?',array('class' =>'color_b','style'=>'pointer-events: none;')); ?>
            </td>
        </tr>
        <tr>
            <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em class="vineta">&bull;</em>&nbsp;&nbsp;&nbsp;<?php echo anchor('Contador/conteo','  Conteo General',array('class' =>' color_b')); ?></td>
        </tr> 
        <tr>
            <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em class="vineta">&bull;</em>&nbsp;&nbsp;&nbsp;<?php echo anchor('Contador/filtros','  Conteo por Convocatoria',array('class' =>' color_b')); ?></td>
        </tr> 
        <tr>
            <td align="left">
                <div class="circulo ">5 </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                <?php echo anchor('Seguimiento/reporte_por_plantilla', 'Reporte Evaluaciones por Plantilla',array('class' =>'color_b')); ?>
            </td>
        </tr>
        <!-- <tr>
            <td align="left">
                 echo anchor('reportes/servicio_generar', ' 4. Reporte Anual de Servicios',array('class' =>'enlace_a4')); ?>
            </td>
        </tr>borrado en 2021 -->
        <?php }?>
    </table>
</div>
</div>
</div>


