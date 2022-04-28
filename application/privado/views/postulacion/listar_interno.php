<script language="javascript">
function mostrardiv(nombre) {
div = document.getElementById(nombre);
div.style.display ='';
}
function cerrar(nombre) {
div = document.getElementById(nombre);
div.style.display='none';
}
</script>
<?php
$this->load->view('cabecera');
?>
<?php
$prefijo=$this->prefijo;
$sitio=$this->tool_entidad->sitioindexpri();
$buscar_campo[0]='Elija Criterio';
$buscar_campo[1]='Documento';
$buscar_campo[2]='Apellido Paterno';
$buscar_campo[3]='Apellido Materno';
$buscar_campo[4]='Nombres';
$buscar_campo[5]='Profesión';
$buscar_campo[6]='Síntesis de Experiencia Laboral';
$alineacionw='center';
$alineacionh='middle';
if(!@$cadena){
    $style='style="display: none;"';
}
if(!@$profesion){
    $style1='style="display: none;"';
}
if(!@$sintesis){
    $style2='style="display: none;"';
}
if(@$cadena || @$profesion || @$sintesis){
}else{
    $style_buscador='style="display: none;"';
}
?>
<table align="center" width="100%" cellpadding="10">
        <tr>
            <td class="enlaces_add_edit" align="left" width="100%">
                <?php  echo anchor($this->controlador,'Cancelar',array('class' =>'enlace_cancelar enlace_a1')); ?>
            </td>
        </tr>
    </table>

<form method="post" action="<?php echo $sitio.$this->controlador.'interno/id/'.$id;?>">
    <table align="center">      
        <tr>
            <td align="left">
                <div id="cajatexto"  >
				<p class="form-label-21">Introduzca el nro de documento del Postulante: </p>
                <input name="cadena" id="cadena" size="50" class="input1" value="<?php echo @$cadena?>"/>
                </div>
            </td>
        </tr>
		        <tr>
            <td align="center">
               <div id="inputbuscar" >
                    <br/><br/><input class="btn btn-etika" type="submit" name="buscar" value="Buscar"/>
                </div>
            </td>
        </tr>
    </table>
</form>

<div id="listado"><br/>
    <h4><?php echo @$mensaje;?></h4>
    <?php if($datos){ ?>
    <form method="post" action="<?php echo $sitio.$this->controlador.'postular/id/'.$id;?>">
        <input type="hidden" name="profesion" id="profesion" value="<?php echo @$profesion?>"/>
        <input type="hidden" name="cadena" id="cadena" value="<?php echo $cadena?>"/>
        <input type="hidden" name="ambito_exp1" id="ambito_exp1" value="<?php echo @$ambito_exp1; ?>"/>
        <input type="hidden" name="ambito_exp2" id="ambito_exp2" value="<?php echo @$ambito_exp2; ?>"/>
        <input type="hidden" name="ambito_exp3" id="ambito_exp3" value="<?php echo @$ambito_exp3; ?>"/>
        <input type="hidden" name="area_exp" id="area_exp" value="<?php echo @$area_exp; ?>"/>
        <input type="hidden" name="sector_exp" id="sector_exp" value="<?php echo @$sector_exp; ?>"/>
        <input type="hidden" name="max_nivel" id="max_nivel" value="<?php echo @$max_nivel; ?>"/>
        <input type="hidden" name="anios_exp" id="anios_exp" value="<?php echo @$anios_exp; ?>"/>        
        <input type="hidden" name="sintesis" id="sintesis" value="<?php echo @$sintesis; ?>"/>
        <input type="hidden" name="condicion" id="condicion" value="<?php echo @$condicion; ?>"/>
        <div class="scrollh">
    <table  align="center" class="tabla_listado"  cellspacing="0" width="100%">
        <tr class="cabecera_listado">
            <?php for($i=0;$i<count($campos_listar);$i++) { ?>
            <td><?php echo $campos_listar[$i];?></td>
            <?php } ?>
            <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>"><input type="checkbox" name="chk_all" id="chk_all"/></td>
        </tr>
		<?php 
			$fila_color = array('fila-color-1','fila-color-2');
			$color=0;
			foreach ($datos as $fila){
				if($color==0)
				{ ?>
				<tr class="<?php echo $fila_color[$color]; $color=1; ?>">
				<?php }
				else{ ?>
				<tr class="<?php echo $fila_color[$color]; $color=0; ?>">
				<?php }
				?>
				<?php
					for($i=0;$i<count($campos_reales);$i++) {
				?>
					<td><?php echo $fila[strtolower($campos_reales[$i])];?>&nbsp;</td>
				<?php
					}
				?>
                <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>"><input type="checkbox" name="<?php echo 'chk'.$fila['pos_id'];?>"/></td>
			</tr>
            <?php }?>
    </table>
        </div>
        <br/>
        <p>Para los elementos marcados</p>
        <input class="btn btn-etika" name="enviar" type="submit" value="  Postular  " onClick="return confirmar('¿Está seguro que desea Postular ?');">
    </form>
    <?php }else{?>
    <b>
        <?php echo $mensaje_validar_postulacion; ?>
    </b>
    <?php }?>
</div>


