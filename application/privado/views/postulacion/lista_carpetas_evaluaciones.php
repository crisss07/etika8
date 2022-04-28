
<div id="listado" style=" padding: 20px;">
    <br/>
    <?php
    $this->load->view('cabecera');
    ?>
    <?php
    $prefijo = $this->prefijo;
    $msj_confirmar = '¿Está seguro que desea eliminar el elemento seleccionado?';
    $sitio = $this->tool_entidad->sitioindexpri();
    $alineacionw = 'center';
    $alineacionw1 = 'left';
    $alineacionh = 'middle';
    ?>
    <br/>
	<div id="listado" style="margin-bottom:3%;">
    <div align="left" ><a href="javascript:history.back()" class="enlace_retornar enlace_a1" >Atrás</a></div><br>
    <div id="cabecera_listado">
        <table cellpadding="5">
            <tr><td align="right"><b> Nombre: </b></td><td align="left"><?php echo $fila_sup[$prefijo_pos.'apaterno'].' '.$fila_sup[$prefijo_pos.'amaterno'].' '.$fila_sup[$prefijo_pos.'nombre'];?></td></tr>
            <tr><td align="right"><b> Documento: </b></td><td align="left"><?php echo $id;?></td></tr>
        </table>
    </div>
    </div>
        <table  class="tabla_listado" cellspacing="0" width="70%" >
            <thead>
                <tr class="cabecera_listado">

                    <td>&nbsp;&nbsp;&nbsp;Evaluaciones</td>
                    <td align="center">Ver Carpeta</td>
                    

                </tr>
            </thead>
         
            <tbody>
                  <?php $color=0; $sw=0; $pos=0; ?>

                <?php foreach ($lista as $row) { ?>
                    <?php if ($sw==0): ?>
                        <?php 
                    $sw=1;

                     ?>
                    <?php endif ?>

                    <?php 
					
					
						if ($color==0): ?>
                        <tr class="<?php echo 'fila-color-1'; $color=1; ?>">
                        <?php else: ?>
                        <tr class="<?php echo 'fila-color-2'; $color=0; ?>">
                        
                    <?php endif ?>
                    <!--fin de color a las celdas-->
                        <td>                          
							<ul class="icheck-list">                  
                            <?php echo $row['gru_nombre']; ?>
							</ul>
                        </td>
                        <td style="width: 20px;" align="center">
                              <a class="enlace_a1" style="font-size: 20px;" href="<?php echo $sitio.'Prueba_cuatro/folder_postulante/'.$id.'/'.$row['nombre_carpeta']; ?>"><i class="fas fa-folder-open"></i></a>
                        </td>
                      </tr>
                 
                  
           
                     <?php $pos=1; ?>
						
					<?php }?>





                       <?php 
                    ?>
				   <?php if ($color==0): ?>
                        <tr class="<?php echo 'fila-color-1'; $color=1; ?>">
                        <?php else: ?>
                        <tr class="<?php echo 'fila-color-2'; $color=0; ?>">
                        
                    <?php endif ?>
                    <!--fin de color a las celdas-->
                     
                      </tr>
               </tbody>
           </table>



    
</div>
<!-- cdn fontawesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>