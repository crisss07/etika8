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
    <div class="col-md-4" ></div>
    <div class="col-md-4" >
        <div id="listado"><br/>
            <table border="0" cellpadding=10" align="center" width="100%" style="color: #6A6868;">
                <?php if ($_SESSION[$this->presession.'permisos']!='3'): ?>

                    <?php if($_SESSION[$this->presession.'permisos']=='1'): ?>






                        <tr>                      
                            <td align="left"> 
                              <div class="circulo">1 </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo anchor('combos', 'Combos del sitio',array('class' =>'color_b ')); ?>
                          </td>  
                      </tr>
                      <tr>
                        <td align="left">
                          <div class="circulo">2 </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo anchor('notificacion', 'Notificaciones',array('class' =>'color_b')); ?>
                      </td>
                  </tr>
                  <tr>
                    <td align="left">
                        <div class="circulo">3 </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo anchor('Contacto/submenu', 'Contáctenos',array('class' =>'color_b ')); ?>

                    </div>
                    <br/>
                <!-- <table cellpadding="5">
                    <tr>
                        <td width="10"> &nbsp; </td>
                        <td align="left"><div class="vineta">&bull;</div>&nbsp;&nbsp;&nbsp; echo anchor('contacto/vista_edicion_editor/id/1/sub/0','  Contenido',array('class' =>'enlace_a4')); ?></td>
                    </tr>                                      
                    <tr>
                        <td width="10"> &nbsp; </td>
                        <td align="left"><div class="vineta">&bull;</div>&nbsp;&nbsp;&nbsp; echo anchor('contacto/vista_edicion/id/1/sub/1','  Email La Paz',array('class' =>'enlace_a4')); ?></td>
                    </tr>
                    <tr>
                        <td width="10"> &nbsp; </td>
                        <td align="left"><div class="vineta">&bull;</div>&nbsp;&nbsp;&nbsp; echo anchor('contacto/vista_edicion/id/2/sub/1','  Email Santa Cruz',array('class' =>'enlace_a4')); ?></td>
                    </tr>
                </table> borrado en 2021-4      -->          
            </td>
        </tr>
    <?php endif ?>
    <?php if ($_SESSION[$this->presession.'permisos']=='1' || $_SESSION[$this->presession.'permisos']=='2'): ?>
     <tr>
        <td align="left">
          <div class="circulo">4 </div>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo anchor('Imagenes', 'Imagenes plantillas RRSS',array('class' =>'color_b')); ?>
      </td>
  </tr>
<?php endif ?>
<?php if ($_SESSION[$this->presession.'permisos']=='1'): ?>
   <tr>
    <td align="left">
      <div class="circulo">5 </div>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo anchor('Seguimiento/lista_mensaje', 'Mensajes para Evaluaci&oacute;n',array('class' =>'color_b')); ?>
    </td>
   </tr>
<?php endif ?>


<?php endif ?>
</table>
</div>


</div>

</div>











