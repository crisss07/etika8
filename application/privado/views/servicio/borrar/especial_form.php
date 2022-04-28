<?php
$this->load->view('cabecera');
?>
<div id="cabecera_listado">
    <table width="100%">
        <tr>
            <td>
                <span class="text3">
                <?php  if(!$this->superior['titulonom']){ echo "Titulo :";} else{ echo $this->superior['titulonom'];}?>
                </span>
                <span class="text2"><?php echo $this->superior['titulop'];?></span>
                <?php if($this->superior['titulop1']){ ?>
                <br/><br/>
                <span class="text3">
                <?php  if(!$this->superior['titulonom1']){ echo "Titulo :";} else{ echo $this->superior['titulonom1'];}?>
                </span>
                <span class="text2"><?php echo $this->superior['titulop1'];?></span>
                <?php } ?>
            </td>
        </tr>
    </table>
</div>
<br>
<table align="center" width="100%">
    <tr>
        <td class="enlaces_add_edit" align="left" width="100%">
                <?php echo anchor($this->ruta_retorno,$this->msj_retorno,array('class' =>'enlace_retornar enlace_a1'));?>&nbsp;&nbsp;
                <?php if($this->nuevo){?><?php echo anchor($this->controlador.'agregar/idc/'.$this->idc.'/ids/'.$this->ids,'Nuevo',array('class' =>'enlace_nuevo enlace_a1')); ?>&nbsp;&nbsp;<?php }?>
                <?php echo anchor($this->controlador.'listar/idc/'.$this->idc.'/ids/'.$this->ids,'Listado',array('class' =>'enlace_listar enlace_a1')); ?>&nbsp;&nbsp;
                <?php  echo anchor($this->controlador.'listar/idc/'.$this->idc.'/ids/'.$this->ids,'Cancelar',array('class' =>'enlace_cancelar enlace_a1')); ?>
        </td>
    </tr>
</table>
<br>
<br>
<?php    
if(@$this->carpetaup){$ruta=$this->rutarchivo.$this->carpetaup;}
else{$ruta=$this->rutarchivo.$this->carpeta;}
$alineacionwc1='center';
$alineacionhc1='middle';
$alineacionwc2='left';
$alineacionhc2='middle';
$prefijo = $this->prefijo;
$prefijo1 = $this->prefijo1;
$consulta = $this->db->query('SELECT eti_id as id, eti_nombre as nombre FROM etiko  WHERE eti_estado="1" order by eti_nombre asc');
$resultado=$consulta->result_array();
$etikos[-1]='Seleccion al ETIKO';
foreach($resultado as $row){
    $etikos[$row['id']]=$row['nombre'];
}
?>

<div id="cuerpo_form_admin">
<?php echo form_open_multipart($action); ?>  
<input type="hidden" name="<?php echo $prefijo.'id';?>" value="<?php echo @set_value($prefijo.'id',$fila[$prefijo.'id']);?>">
<input type="hidden" name="idc" value="<?php echo set_value($this->idc,$this->idc);?>">
<input type="hidden" name="ids" value="<?php echo set_value($this->ids,$this->ids);?>">
<table id="form_admin">
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1;?>" valign="<?php echo $alineacionhc1;?>">
            <?php echo form_label('Descripción del Servicio: ', $prefijo.'area') ;?>
        </td>
        <td align="<?php echo $alineacionwc2;?>" valign="<?php echo $alineacionhc2;?>">
            <?php
                  echo form_input(array(
                    'name' => $prefijo.'area',
                    'id' => $prefijo.'area',
                    'size'=> '50',
                    'class'=>'input1',
                    'value' => @set_value($prefijo.'area',$fila[$prefijo.'area'])
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
                <?php echo form_label('Desde: ', $prefijo.@$nombre);?>
                <?php
                if(!@$fila[$prefijo.$fecha])
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
                <?php echo form_label('Hasta: ', $prefijo.@$nombre);?>
                <?php
                if(!@$fila[$prefijo.$fecha])
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
                    'value' => @set_value($prefijo.'monto',$fila[$prefijo.'monto'])
                    )).' en Bs.' ;

                  if(form_error($prefijo.'monto'))
                    echo '<div class="error">'.form_error($prefijo.'monto').'</div>';
            ?>
        </td>
    </tr>
    <tr>
        <td class="texto_label" align="<?php echo $alineacionwc1; ?>" valign="<?php echo $alineacionhc1; ?>">
            <?php $nombre = 'facturacion';           
            echo form_label(' Tipo de Facturación: ', $prefijo . $nombre); ?>
        </td>
        <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
            <input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php if (@$fila[$prefijo . $nombre] == 1) { echo 'checked'; } ?> /> <b>ETIKA</b>
            <input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="2" <?php if (@$fila[$prefijo . $nombre] == 2) { echo 'checked'; } ?> /> <b>Consultor Individual</b>
            <?php
            if (form_error($prefijo . $nombre))
                echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
            ?>
        </td>
    </tr>
</table>


<br/>
<?php echo form_submit('enviar', '  Guardar  ') ?>
    
<?php echo form_close() ?>
</div>