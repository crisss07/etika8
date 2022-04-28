<br/>
<?php
$this->load->view('cabecera');
?>
<?php
$sitio=$this->tool_entidad->sitioindexpri();
$prefijo=$this->prefijo;
?>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">

<style>
 
.color_texto{
    font-size: 22px;
    color: #404141;
    font-family: Roboto;

}
.fuente_titulos{   
    color: #eb663b;
    font-size: 24px;
    font-family: Roboto;
    font-weight: bold;
}


</style>


<style>
    table{
        padding: 4px;
    }
    th, td {
  padding: 4px;
  /*text-align: left;*/
}
</style>
<div align="left" >
    <?php  echo anchor('configuracion','Atr&aacute;s',array('class' =>'enlace_retornar enlace_a1')); ?>
        
</div>

<div class="row">
    <div class="col-md-1" ></div>
    <div class="col-md-10" >
       <!--  <table width="30%">
            <tr>
                <td>
                    s
                </td><td>
                    s
                </td>
                <td>
                    s
                </td>
            </tr>
        </table> -->


    <div id="">
        
        <table border="0"  align="center" width="100%" class="color_texto">
            <tr>
                <td colspan="3"  align="center" class="fuente_titulos"><b>ETAPA 2</b></td>
            </tr>
            <tr>
                <td style="width: 150px;"   >
                    <b><?php echo $datos[0][$prefijo.'titulo'];?></b>
                    </td>
                       <td align="left"   ><?php echo substr(strip_tags($datos[0][$prefijo.'contenido']), 0, 300) ;?></td>
                      
                        <td align="center"  >
                            <?php echo anchor($this->controlador.'vista_editar/id/'.$datos[0][$prefijo.'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">',array('class' =>'enlace_a4')); ?>
                                
                        </td>
                   
                
                 </tr>
                <tr>
                    <td>
                        <br>
                    </td>
                </tr>
            <tr>
                <td  align="vtop" >

                    <b><?php echo $datos[1][$prefijo.'titulo'];?></b>
                  </td>
                            <td  ><div align="justify"><?php echo substr(strip_tags($datos[1][$prefijo.'contenido']), 0, 300) ;?></div></td>
                      
                            <td align="center"  ><?php echo anchor($this->controlador.'vista_editar/id/'.$datos[1][$prefijo.'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">',array('class' =>'enlace_a4')); ?></td>
                   
                
            </tr>
             <tr>
                    <td  colspan="3">
                        <hr class="fuente_titulos">
                       
                    </td>
                </tr>
            <tr>
                <td colspan="3"   align="center" class="fuente_titulos"><b>ETAPA 3</b></td>
            </tr>
            <tr>
                <td  >
                    <b><?php echo $datos[2][$prefijo.'titulo'];?></b>     
                </td>
                    
                            <td align="left"  ><div align="justify"><?php echo substr(strip_tags($datos[2][$prefijo.'contenido']), 0, 300) ;?></div></td>
                      
                            <td align="center"  ><?php echo anchor($this->controlador.'vista_editar/id/'.$datos[2][$prefijo.'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">',array('class' =>'enlace_a4')); ?></td>
               
                  </tr>
                   <tr>
                    <td>
                        <br>
                    </td>
                </tr>
            <tr>
                <td   >
                    <b><?php echo $datos[3][$prefijo.'titulo'];?></b>       
                </td>
                
                            <td align="left"  ><div align="justify"><?php echo substr(strip_tags($datos[3][$prefijo.'contenido']), 0, 300) ;?></div></td>
                    
                            <td align="center"  ><?php echo anchor($this->controlador.'vista_editar/id/'.$datos[3][$prefijo.'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">',array('class' =>'enlace_a4')); ?></td>
             
            </tr>            
        </table>
    </div>
    </div>
    </div>

  <!-- <div style="color:#6781C5; font-size: 18px;"> -->