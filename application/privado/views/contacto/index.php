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
   

    font-size: 30px;
    
    color:#B4AB9B;
    font-family: sans-serif;
  
  
}
.fuente_gral{
   
    color: #B4AB9B;
    font-size: 22px;
    font-family: Roboto;
    font-weight: bold;


}
.fuente_titulos{
   
    color: #110C0C;
    font-size: 22px;
    font-family: Roboto;
    


}

</style>
<style>
    .vineta {    
    font-size: 22px;
    font-weight: bold;
    color:#EB663B;
    font-family: sans-serif;
}
.color_b{
    font-size: 22px;
    color: #404141;
    font-family: Roboto;
    font-weight: normal;

}
.a.color_b:link,a.color_b:visited , a.color_b:active{

    font-family: Roboto;
    font-size: 16px;
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




<style>



table {
  border-collapse: collapse;
}
.color_etika{
    color:#F58960;
}
</style>


<div id="listado"><br/>
   
                <table cellpadding="5">
                    <tr>
                        <td width="10"> &nbsp; </td>
                        <td align="left"><em class="vineta">&bull;</em>&nbsp;&nbsp;&nbsp;<?php echo anchor('contacto/vista_edicion_editor/id/1/sub/0','  Contenido',array('class' =>' color_b')); ?></td>
                    </tr>                                      
                    <tr>
                        <td width="10"> &nbsp; </td>
                        <td align="left"><em class="vineta">&bull;</em>&nbsp;&nbsp;&nbsp;<?php echo anchor('contacto/vista_edicion/id/1/sub/1','  Email La Paz',array('class' =>' color_b')); ?></td>
                    </tr>
                    <tr>
                        <td width="10"> &nbsp; </td>
                        <td align="left"><em class="vineta">&bull;</em>&nbsp;&nbsp;&nbsp;<?php echo anchor('contacto/vista_edicion/id/2/sub/1','  Email Santa Cruz',array('class' =>' color_b')); ?></td>
                    </tr>
                </table>                
      
</div>



                
          
      




