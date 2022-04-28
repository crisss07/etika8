<br/>
<?php
$this->load->view('cabecera');
?>
<?php
$prefijo='pos_';
$sitio=$this->tool_entidad->sitioindexpri();
?>

<div id="listado" style="margin-bottom:3%;">
    <div align="left" ><?php  echo anchor($this->controlador.'listar','Atrás',array('class' =>'enlace_retornar enlace_a1')); ?></div><br/>
    <div id="cabecera_listado">
        <table cellpadding="5">
            <tr><td align="right"><b> Nombre: </b></td><td align="left"><?php echo $fila_sup[$prefijo.'apaterno'].' '.$fila_sup[$prefijo.'amaterno'].' '.$fila_sup[$prefijo.'nombre'];?></td></tr>
            <tr><td align="right"><b> Documento: </b></td><td align="left"><?php echo $fila_sup[$prefijo.'documento'];?></td></tr>
        </table>
    </div>
    <div style="color:#6781C5; font-size: 18px;"><br/>
        <table border="1" cellpadding=15" align="left">
            <tr>
                <td align="left"> &rarr; Datos Personales</td>
                <td align="right" ><?php echo anchor($this->controlador.'editar_datospersonal/id/'.$fila_sup[$prefijo.'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a4')); ?></td>
            </tr>
            <tr>
                <td align="left"> &rarr; Instrucción Formal</td>
                <td align="right" ><?php echo anchor($this->controlador.'instruccion_formal/id/'.$fila_sup[$prefijo.'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a4')); ?></td>
            </tr>
            <tr>
                <td align="left"> &rarr; Trayectoria Laboral</td>
                <td align="right" ><?php echo anchor($this->controlador.'trayectoria_laboral/id/'.$fila_sup[$prefijo.'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a4')); ?></td>
            </tr>
            <tr>
                <td align="left"> &rarr; Información Adicional</td>
                <td align="right" ><?php echo anchor($this->controlador.'informacion_adicional/id/'.$fila_sup[$prefijo.'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a4')); ?></td>
            </tr>
            <tr>
                <td align="left"> &rarr; Recomendación y Observación</td>
                <td align="right" ><?php echo anchor($this->controlador.'recomendacion_observacion/id/'.$fila_sup[$prefijo.'id'], '<img width="30px" src="'.$this->tool_entidad->sitio().'files/img/privado/editar.png" alt="editar">', array('class' => 'enlace_a4')); ?></td>
            </tr>
        </table>
    </div>
</div>
