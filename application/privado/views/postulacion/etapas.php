<SCRIPT LANGUAGE=JavaScript>
    function mensaje1() {
        alert("Debe Completar la Segunda Etapa para poder pasar a esta.");
    }
    function mensaje2() {
        alert("Debe Completar la Tercero Etapa para poder pasar a esta.");
    }
</SCRIPT>
<?php
$msj_confirmar='¿Usted va a regresar a una etapa anterior está seguro?';
$alineacionw='center';
$alineacionh='middle';
$consulta = $this->db->query('
        SELECT c.cli_nombre as nombre,a.con_etapa as etapa
        FROM
        convocatoria a, clientes c
        WHERE a.cli_id=c.cli_id and a.con_id='.$id
);
$cliente=$consulta->row_array();
$consulta = $this->db->query('
        SELECT *
        FROM etapas
        WHERE (eta_etapa="3" or eta_etapa="4" ) and con_id='.$id
);
$etapa3=$consulta->row_array();
if(!$etapa3 && $cliente['etapa']>=2) {
    $update = array(
            $this->prefijo.'etapa' => "2"
    );    
    $this->db->update($this->tabla1, $update, array($this->prefijo.'id' => $id));
}
$consulta = $this->db->query('
        SELECT *
        FROM etapas
        WHERE eta_etapa="4" and con_id='.$id
);
$etapa4=$consulta->row_array();
if(!$etapa4 && $etapa3 && $cliente['etapa']>=3) {
    $update = array(
            $this->prefijo.'etapa' => "3"
    );
    $this->db->update($this->tabla1, $update, array($this->prefijo.'id' => $id));
}
?>
<table  align="center" width="100%" >
    <tr>
        <td colspan="4" align="left">
            <span class="text3"> Cliente: </span>
            <span class="text2-postu"> <?php echo $cliente['nombre']; ?> </span>
        </td>
    </tr>
    <tr>
        <td align="center">
            <table class="etapas" align="center" border="0" style="" cellspacing="0" cellpadding="5">
                <tr>
                    <td <?php if($cliente['etapa']>=1){echo 'bgcolor="#aaaaee"';} ?> align="<?php echo $alineacionw;?>" if valign="<?php echo $alineacionh;?>"><?php if($this->etapa==1){ echo anchor($this->controlador.'listar/id/'.$id,'1º Etapa',array('class' =>'enlace_etapas_activo')); }else{ echo anchor($this->controlador.'listar/id/'.$id,'1º Etapa',array('class' =>'enlace_etapas')); } ?> <b>&gt;&gt;</b> </td>
                    <?php if($cliente['etapa']>=2){ ?>
                    <td bgcolor="#aaaaee" align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>"><?php if($this->etapa==2){ echo anchor($this->controlador.'ccv/etapa/2/id/'.$id,'2º Etapa',array('class' =>'enlace_etapas_activo')); }else{ echo anchor($this->controlador.'ccv/etapa/2/id/'.$id,'2º Etapa',array('class' =>'enlace_etapas','onclick'=>"return confirmar('$msj_confirmar');")); } ?> <b>&gt;&gt;</b> </td>
                    <?php }else{?>
                    <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>"><?php if($this->etapa==2){ echo anchor($this->controlador.'ccv/etapa/2/id/'.$id,'2º Etapa',array('class' =>'enlace_etapas_activo')); }else{ echo anchor($this->controlador.'ccv/etapa/2/id/'.$id,'2º Etapa',array('class' =>'enlace_etapas')); } ?> <b>&gt;&gt;</b> </td>
                    <?php } ?>
                    <?php if($etapa3){ ?>
                    <?php if($cliente['etapa']>=3){ ?>
                    <td bgcolor="#aaaaee" align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>"><?php if($this->etapa==3){ echo anchor($this->controlador.'ccv/etapa/3/id/'.$id,'3º Etapa',array('class' =>'enlace_etapas_activo')); }else{ echo anchor($this->controlador.'ccv/etapa/3/id/'.$id,'3º Etapa',array('class' =>'enlace_etapas','onclick'=>"return confirmar('$msj_confirmar');")); } ?> <b>&gt;&gt;</b> </td>
                    <?php }else{?>
                    <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>"><?php if($this->etapa==3){ echo anchor($this->controlador.'ccv/etapa/3/id/'.$id,'3º Etapa',array('class' =>'enlace_etapas_activo')); }else{ echo anchor($this->controlador.'ccv/etapa/3/id/'.$id,'3º Etapa',array('class' =>'enlace_etapas')); } ?> <b>&gt;&gt;</b> </td>
                    <?php } ?>                    
                    <?php }else{?>
                    <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>"><a href="#" class="enlace_etapas" onclick="mensaje1()">3º Etapa</a> <b>&gt;&gt;</b> </td>
                    <?php } ?>
                    <?php if($etapa4){ ?>
                    <td <?php if($cliente['etapa']>=4){echo 'bgcolor="#aaaaee"';} ?> align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>"><?php if($this->etapa==4){ echo anchor($this->controlador.'ccv/etapa/4/id/'.$id,'4º Etapa',array('class' =>'enlace_etapas_activo')); }else{ echo anchor($this->controlador.'ccv/etapa/4/id/'.$id,'4º Etapa',array('class' =>'enlace_etapas')); } ?> </td>
                    <?php }else{?>
                    <td align="<?php echo $alineacionw;?>" valign="<?php echo $alineacionh;?>"><a href="#" class="enlace_etapas" onclick="mensaje2()">4º Etapa</a> </td>
                    <?php } ?>
                    
                </tr>
            </table>
        </td>
    </tr>
</table>
<style>
.text2-postu{
    font:19px Verdana,Arial,sans-serif;
    font-weight: bold;
	color:#EA703F;
}
.etapas{
	color:black;
    padding:5px;
    border-color:#ececec;
    border-style:solid;
    border-width:1px;
	background-color:#fcfcfc;
	border-radius: 10px;
}

.etapas table{
	border-collapse: collapse;
  border-radius: 1em;
  overflow: hidden;
}
.etapas b{
	color:#AD1C62;
}
.etapas a{
	color:black;
}
</style>

