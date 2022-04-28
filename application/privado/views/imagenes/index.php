<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<br/>
<?php
$this->load->view('cabecera');
?>
<?php
$sitio=$this->tool_entidad->sitioindexpri();
?>
<style type="text/css">
	.col-lg-4{
		margin-bottom: 20px;
	}
</style>
<br>
<div class="container-fluid row justify-content-center">
    <form action="<?php echo $accion; ?>" id="plantillas" nctype="multipart/form-data" method="post" accept-charset="utf-8">

        <!-- <label for="plantilla">Seleccione una galeria: </label>
        
          <div class="input-group" style="width: 400px;">
            <select class="custom-select" id="plantilla" name="plantilla">
              <option value="plantilla_1">Galeria 1</option>
              <option value="plantilla_2">Galeria 2</option>
              <option value="plantilla_3">Galeria 3</option>
            </select>
            <div class="input-group-append">
            <input class="btn-etika btn" type="submit" value="Ver">
            </div>
          </div> -->
          <label for="plantilla">Listado de Plantillas: </label>
          <br>
            <table align="center" class="tabla_listado" width="100%" height="20px;">
                <tr class="cabecera_listado">
                    <td align="center" valign="middle" width="200px">Plantilla</td>
                    <td align="center" valign="middle" width="200px">Cantidad</td>
                </tr>
                <!-- <?php //print_r($fila);?> -->
                <?php foreach ($fila as $valor) { ?>
              <?php if ($valor['pla_ubicacion'] == 'plantilla_1' || $valor['pla_ubicacion'] == 'plantilla_2' || $valor['pla_ubicacion'] == 'plantilla_3') { ?>  
                <tr class="fila-color-1">
                    <td align="center" valign="middle">
                        <?php $numero = substr($valor['pla_ubicacion'], -1); echo 'Plantilla '.$numero; ?>
                    </td>
                    <td align="center" valign="middle">
                      <a href="#" onclick="envio_plantilla('<?php echo $valor['pla_ubicacion']; ?>'); "><?php echo $valor['nro']; ?></a>
                    </td>
                </tr>
                <?php } ?>
              <?php } ?>
            </table>
    </form>
</div>
<br>
<br>

<script>
  function envio_plantilla(plantilla){
    // alert(plantilla);
    window.location.href = "<?php echo $accion; ?>/" + plantilla;
  }
  
</script>
<!-- <div class="container-fluid row justify-content-center">  
    
    <form action="<?php echo $accion; ?>" id="plantillas" nctype="multipart/form-data" method="post" accept-charset="utf-8">
      <input type="hidden" name="con_id" value="1177">
        <label for="plantilla">Seleccione una Plantilla: </label>
        
          <div class="input-group" style="width: 400px;">
            <select class="custom-select" id="plantilla" name="plantilla">
              <option value="plantilla_1">Plantilla 1</option>
              <option value="plantilla_2">Plantilla 2</option>
              <option value="plantilla_3">Plantilla 3</option>
            </select>
            <div class="input-group-append">
            <input class="btn-etika btn" type="submit" value="Ver">
            </div>
          </div>
    </form>      
</div> -->



