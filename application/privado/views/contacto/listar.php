<?php
$this->load->view('cabecera');
?>

<?php
$prefijo=$this->prefijo;
$msj_confirmar='¿Está seguro que desea eliminar el elemento seleccionado?';
$ruta=$this->rutabase.$this->carpetaup;
?>


<div id="listado">    

     <?php
if($filasup){
?>
     <div id="cabecera_listado">
    <table width="100%">
        <tr>            
            <td>
                <span class="text3">
                <?php
                if($this->titulosup){ echo $this->titulosup;}
                else { echo "Título : ";}
                ?>
                </span>
                <span class="text2"><?php echo $filasup['titulo'];?></span>
                <br/>
                <?php echo strip_tags(substr($filasup['contenido'],0,300));?>
            </td>
            <td width="200" align="center">
                <?php 
               if($this->idp){
                   echo anchor($this->enlacesup['ruta1'].'/idp/'.$this->idp,$this->enlacesup['nombre1'],array('class' =>'enlace_editar1 enlace_a1'));
               }
               if($this->tip){
                   echo anchor($this->enlacesup['ruta1'].'/tip/'.$this->tip,$this->enlacesup['nombre1'],array('class' =>'enlace_editar1 enlace_a1'));
               }
                ?>
            </td>
        </tr>
    </table>
    </div>
    <br/>

<?php
}
?>
<?php
//$this->load->view('opciones');
$sitio=$this->tool_entidad->sitioindexpri();
?>
    <div class="paginacion_lista"><?php //echo $this->pagination->create_links();?></div>
</div>
    <form action="<?php echo $sitio.$this->controlador.'listar'?>" method="post" id="form_listar_fsimple">
        <table width="100%"><tr><td>
                    <?php
                    if(!$this->nolistar){
$this->load->view('opciones');
//$this->load->view('botones');

}
                    ?>

                </td><td align="right">
        <!-- ini combo buscar -->
        <?php if($ordencampo){ ?>
        <div align="right">
            <div id="barra_orden">
            <input type="radio" name="tiporden" value="ASC" /><span class="texto3">Ascendente</span>
            <input type="radio" name="tiporden" value="DESC" checked /><span class="texto3">Descendente</span>
            <br/>
            <select name="oporden" class="lista1">
            <option value="0" selected >Ordenar por</option>
            <?php for($i=1;$i<=count($ordencampo);$i++){?>
            <option value="<?php echo $ordencampo['campo'.$i]?>">
                <?php echo $ordenlabel['campo'.$i]?>
            </option>
            <?php }?>
        </select>
            <input type="Submit" name="ordenar" value="Ordenar"/>
            </div>
        </div>
        <?php } ?>
        <!-- fin combo buscar -->
                </td>
            </tr>
        </table>
        <input type="hidden" name="idp" value="<?php echo $this->idp;?>" id="idp"/>
        <input type="hidden" name="tip" value="<?php echo set_value($this->tip,$this->tip);?>">
        <input type="hidden" name="destacadomas" value="<?php echo set_value($destacadomas,$destacadomas);?>">

        
    </form>


