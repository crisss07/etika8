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
@$prefijo=$this->prefijo;
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
        <table  >
            <tr>                
                <td>
                    <div class="row">
                         <div class="col-md-6">
                        <p class="form-label-21">Desde:</p>
                    <input maxlength="10" type="date" class="form-control input1" style="color:#aca899;" id="fecha_desde" name="fecha_desde" size="10" onFocus="if(this.value == 'aaaa-mm-dd'){this.value='';this.style.color='#000000';}" onBlur="if(this.value == ''){this.value='aaaa-mm-dd';this.style.color='#aca899';}" value="aaaa-mm-dd" required="">
                    <!-- <span class="texto2">&nbsp;A&ntilde;o-mes-dia</span> -->
                    </div>
                    <div class="col-md-6">
                        <p class="form-label-21">Hasta:</p>                    
                    <input maxlength="10" type="date" class="form-control input1" style="color:#aca899;" id="fecha_hasta" name="fecha_hasta" size="10" onFocus="if(this.value == 'aaaa-mm-dd'){this.value='';this.style.color='#000000';}" onBlur="if(this.value == ''){this.value='aaaa-mm-dd';this.style.color='#aca899';}" value="aaaa-mm-dd" required="" >
                    <!-- <span class="texto2">&nbsp;A&ntilde;o-mes-dia</span> -->
                        </div>

                        
                        
                    </div>
                   
                </td>
             
            </tr>
            <tr>
               
                <td align="left">
                    <p class="form-label-21">Cliente:</p>
                    <select name="cliente" id="cliente" class="form-select-21" style="width: 330px;">
                            <option value="0" >Todos los clientes</option>
                            <?php foreach ($this->clientes as $num=>$row){?>
                            <option value="<?php echo $num?>" <?php if(@$cliente==$num){ echo 'selected'; }?> ><?php echo $row;?></option>
                            <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                
                <td align="left">
                    <p class="form-label-21">ETIKO:</p>
                    <select name="etiko" id="etiko" class="form-select-21" style="width: 250px;">
                            <option value="0" >Todos los ETIKOS</option>
                            <?php foreach ($this->etikos as $num=>$row){?>
                            <option value="<?php echo $num?>" <?php if(@$etiko==$num){ echo 'selected'; }?> ><?php echo $row;?></option>
                            <?php } ?>
                    </select>
                </td>
            </tr>

            <input type="hidden" value="0" name="servicio" id="servicio"> 
            <!-- <tr>
               

                <td align="left">
                    <p class="form-label-21">Servicio:</p>
                    <select name="servicio" id="servicio" class="form-select-21" style="width: 250px;">
                            <option value="0" >Todos los servicios</option>
                            <?php foreach ($this->servicios as $num=>$row){?>
                            <option value="<?php echo $num?>" <?php if(@$servicio==$num){ echo 'selected'; }?> ><?php echo $row;?></option>
                            <?php } ?>
                    </select>
                </td>
            </tr> -->
            <tr class="op_sede" id="op_sede" style="display: none;">
              
                <td align="left">
                    <p class="form-label-21">Sede:</p>
                    <select name="sede" id="sede" class="form-select-21" style="width: 250px;"> 
                            <option value="0" >Todas las sedes</option>
                            <?php foreach ($this->sedes as $num=>$row){?>
                            <option value="<?php echo $num?>" <?php if(@$sede==$num){ echo 'selected'; }?> ><?php echo $row;?></option>
                            <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                
                <td align="left">
                    <p class="form-label-21">Tipo Facturaci&oacute;n:</p>
                    <select name="facturacion" id="facturacion" class="form-select-21" style="width: 250px;">
                            <option value="0" >Todos las Facturaciones</option>                            
                            <?php foreach ($this->facturaciones as $num=>$row){?>
                            <option value="<?php echo $num?>" <?php if(@$facturacion==$num){ echo 'selected'; }?> ><?php echo $row;?></option>
                            <?php } ?>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td colspan="2" align="center">
                    <br/><input type="submit" name="generar" class="obtener_criterios" value="  Generar  "/>
                </td>
            </tr>
        </table>
    </form>
</div>


