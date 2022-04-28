<?php
$this->load->view('cabecera');
if($this->idp==1){?>
<table align="center" width="100%">
          <tr>
              <td class="enlaces_add_edit" align="left" width="100%">
                  <?php  
                  if($this->idp){                      
                    if($this->tip){?>
                       <?php echo anchor($this->controlador.'agregar/idp/'.$this->idp.'/tip/'.$this->tip,'Nuevo',array('class' =>'enlace_nuevo enlace_a1')); ?>&nbsp;&nbsp;
                      <?php echo anchor($this->controlador.'listar/idp/'.$this->idp.'/tip/'.$this->tip,'Listado',array('class' =>'enlace_listar enlace_a1')); ?>
                       &nbsp;&nbsp;
                      <?php  echo anchor($this->controlador.'listar/idp/'.$this->idp.'/tip/'.$this->tip,'Cancelar',array('class' =>'enlace_cancelar enlace_a1')); ?>
                      <?php
                    }
                    else{
                        ?>
                       <?php echo anchor($this->controlador.'agregar/idp/'.$this->idp,'Nuevo',array('class' =>'enlace_nuevo enlace_a1')); ?>&nbsp;&nbsp;
                  <?php echo anchor($this->controlador.'listar/idp/'.$this->idp,'Listado',array('class' =>'enlace_listar enlace_a1')); ?>
                   &nbsp;&nbsp;
                  <?php  echo anchor($this->controlador.'listar/idp/'.$this->idp,'Cancelar',array('class' =>'enlace_cancelar enlace_a1')); ?>

                        <?php
                    }

                  }
                  else{
                      if($this->tip){?>
                       <?php echo anchor($this->controlador.'agregar/tip/'.$this->tip,'Nuevo',array('class' =>'enlace_nuevo enlace_a1')); ?>&nbsp;&nbsp;
                      <?php echo anchor($this->controlador.'listar/tip/'.$this->tip,'Listado',array('class' =>'enlace_listar enlace_a1')); ?>
                       &nbsp;&nbsp;
                      <?php  echo anchor($this->controlador.'listar/tip/'.$this->tip,'Cancelar',array('class' =>'enlace_cancelar enlace_a1')); ?>
                      <?php
                    }
                    else{
                        ?>
                       <?php echo anchor($this->controlador.'agregar','Nuevo',array('class' =>'enlace_nuevo enlace_a1')); ?>&nbsp;&nbsp;
                  <?php echo anchor($this->controlador.'listar','Listado',array('class' =>'enlace_listar enlace_a1')); ?>
                   &nbsp;&nbsp;
                  <?php  echo anchor($this->controlador.'listar','Cancelar',array('class' =>'enlace_cancelar enlace_a1')); ?>

                        <?php
                    }


                  }
                  ?>
     
                   <br/><br/><br/>
              </td>

          </tr>
      </table>
<?php    
}else{
$this->load->view('opciones');
}
if($this->carpetaup){$ruta=$this->rutarchivo.$this->carpetaup;}
else{$ruta=$this->rutarchivo.$this->carpeta;}
$alineacionwc1='center';
$alineacionhc1='middle';
$alineacionwc2='left';
$alineacionhc2='middle';
$prefijo = $this->prefijo;
$prefijo1 = $this->prefijo1;
$consulta = $this->db->query('SELECT eti_id as id, eti_nombre as nombre FROM etiko order by eti_nombre asc');
$resultado=$consulta->result_array();
foreach($resultado as $row){
    $etikos[$row['id']]=$row['nombre'];
}
?>

<div id="cuerpo_form_admin">
<?php echo form_open_multipart($action); ?>  
<input type="hidden" name="<?php echo $prefijo.'id';?>" value="<?php echo set_value($prefijo.'id',$fila[$prefijo.'id']);?>">
<input type="hidden" name="idp" value="<?php echo set_value($this->idp,$this->idp);?>">
<table id="form_admin">    
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            <?php echo form_label('Cargo o Área: ', $prefijo.'area') ;?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php
                  echo form_input(array(
                    'name' => $prefijo.'area',
                    'id' => $prefijo.'area',
                    'size'=> '50',
                    'class'=>'input1',
                    'value' => set_value($prefijo.'area',$fila[$prefijo.'area'])
                    )) ;

                  if(form_error($prefijo.'area'))
                    echo '<div class="error">'.form_error($prefijo.'area').'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            <?php $campo1='id';?>
            <?php echo form_label(' Responsable ETIKO: ', $prefijo.$campo1);?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php
            echo form_dropdown($prefijo1.$campo1,$etikos,set_value($prefijo1.$campo1,$fila[$prefijo1.$campo1]));
            if(form_error($prefijo1.$campo1))
                echo '<div class="error">'.form_error($prefijo1.$campo1).'</div>';
            ?>
        </td>
    </tr>
    <tr>
            <td colspan="2" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
                <?php $fecha='desde';?>
                <?php echo form_label('Desde: ', $prefijo.$nombre);?>
                <?php
                if(!$fila[$prefijo.$fecha])
                    {
                        $fila[$prefijo.$fecha]=date('Y-m-d');
                    }
                      echo form_input(array(
                          'name' => $prefijo.$fecha,
                          'id' => $prefijo.$fecha,
                          'class' => 'input1',
                          'size' => '7',
                          'maxlength'=>'10',
                          'value' => set_value($prefijo.$fecha,$fila[$prefijo.$fecha])
                          ));

                      if(form_error($prefijo.$fecha))
                         echo '<div class="error">'.form_error($prefijo.$fecha).'</div>';
                ?> <span class="texto2">&nbsp;Año-mes-dia</span>
                <?php $fecha='hasta';?>
                <?php echo form_label('Hasta: ', $prefijo.$nombre);?>
                <?php
                if(!$fila[$prefijo.$fecha])
                    {
                        $fila[$prefijo.$fecha]=date('Y-m-d');
                    }
                      echo form_input(array(
                          'name' => $prefijo.$fecha,
                          'id' => $prefijo.$fecha,
                          'class' => 'input1',
                          'size' => '7',
                          'maxlength'=>'10',
                          'value' => set_value($prefijo.$fecha,$fila[$prefijo.$fecha])
                          ));

                      if(form_error($prefijo.$fecha))
                         echo '<div class="error">'.form_error($prefijo.$fecha).'</div>';
                ?>
                <span class="texto2">&nbsp;Año-mes-dia</span>
            </td>
        </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            <?php echo form_label('Monto a Cobrar: ', $prefijo.'monto') ;?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php
                  echo form_input(array(
                    'name' => $prefijo.'monto',
                    'id' => $prefijo.'monto',
                    'size'=> '7',
                    'class'=>'input1',
                    'value' => set_value($prefijo.'monto',$fila[$prefijo.'monto'])
                    )) ;

                  if(form_error($prefijo.'monto'))
                    echo '<div class="error">'.form_error($prefijo.'monto').'</div>';
            ?>
        </td>
    </tr>
</table>


<br/>
<?php echo form_submit('enviar', '  Guardar  ') ?>
    
<?php echo form_close() ?>
</div>