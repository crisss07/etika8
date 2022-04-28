<script language="javascript">
$(document).ready(function(){
	// Parametros para e combo1
   $("#servicio").change(function () {
   		$("#servicio option:selected").each(function () {
				elegido=$(this).val();                                
                                if(elegido==7){
                                    mostrardiv('op_sede');
                                }else{
                                    cerrar('op_sede');
                                }
        });
   })

});
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
$alineacionw='center';
$alineacionh='middle';
?>
<div id="listado"><br/>
    <form method="post" action="<?php echo $sitio.$this->controlador.'etiko_generar';?>">
        <table align="center" width="100%" cellpadding="10">
            <tr>
                <td class="enlaces_add_edit" align="left" width="100%">
                    <?php  echo anchor($this->controlador,'Cancelar',array('class' =>'enlace_cancelar enlace_a1')); ?>
                </td>
            </tr>
        </table>
        <table align="center" cellpadding="5">
            <tr>
                <td align="center" colspan="2">
                    <b>Desde: </b>
                    <input maxlength="10" type="input" class="input1_normal" style="color:#aca899;" id="fecha_desde" name="fecha_desde" size="10" onFocus="if(this.value == 'aaaa-mm-dd'){this.value='';this.style.color='#000000';}" onBlur="if(this.value == ''){this.value='aaaa-mm-dd';this.style.color='#aca899';}" value="aaaa-mm-dd" >
                    <span class="texto2">&nbsp;Año-mes-dia</span>
                    <b> &nbsp; Hasta: </b>
                    <input maxlength="10" type="input" class="input1_normal" style="color:#aca899;" id="fecha_hasta" name="fecha_hasta" size="10" onFocus="if(this.value == 'aaaa-mm-dd'){this.value='';this.style.color='#000000';}" onBlur="if(this.value == ''){this.value='aaaa-mm-dd';this.style.color='#aca899';}" value="aaaa-mm-dd" >
                    <span class="texto2">&nbsp;Año-mes-dia</span>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <b>Cliente:</b>
                </td>
                <td align="left">
                    <select name="cliente" id="cliente">
                            <option value="0" >Todos los clientes</option>
                            <?php foreach ($this->clientes as $num=>$row){?>
                            <option value="<?php echo $num?>" <?php if($cliente==$num){ echo 'selected'; }?> ><?php echo $row;?></option>
                            <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <b>ETIKO:</b>
                </td>
                <td align="left">
                    <select name="etiko" id="etiko">
                            <option value="0" >Todos los ETIKOS</option>
                            <?php foreach ($this->etikos as $num=>$row){?>
                            <option value="<?php echo $num?>" <?php if($etiko==$num){ echo 'selected'; }?> ><?php echo $row;?></option>
                            <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <b>Servicio:</b>
                </td>
                <td align="left">
                    <select name="servicio" id="servicio">
                            <option value="0" >Todos los servicios</option>
                            <?php foreach ($this->servicios as $num=>$row){?>
                            <option value="<?php echo $num?>" <?php if($servicio==$num){ echo 'selected'; }?> ><?php echo $row;?></option>
                            <?php } ?>
                    </select>
                </td>
            </tr>
            <tr class="op_sede" id="op_sede" style="display: none;">
                <td align="right">
                    <b>Sede:</b>
                </td>
                <td align="left">
                    <select name="sede" id="sede">
                            <option value="0" >Todas las sedes</option>
                            <?php foreach ($this->sedes as $num=>$row){?>
                            <option value="<?php echo $num?>" <?php if($sede==$num){ echo 'selected'; }?> ><?php echo $row;?></option>
                            <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <b>Tipo Facturación:</b>
                </td>
                <td align="left">
                    <select name="facturacion" id="facturacion">
                            <option value="0" >Todos las Facturaciones</option>                            
                            <?php foreach ($this->facturaciones as $num=>$row){?>
                            <option value="<?php echo $num?>" <?php if($facturacion==$num){ echo 'selected'; }?> ><?php echo $row;?></option>
                            <?php } ?>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td colspan="2" align="center">
                    <br/><input type="submit" name="generar" value="  Generar  "/>
                </td>
            </tr>
        </table>
    </form>
</div>


