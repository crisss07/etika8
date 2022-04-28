<!-- <div class="row">
    <div class="col-md-12" align="right">
      <a href="?php echo $this->tool_entidad->sitio();?>index.php/ninicio">Volver a Inicio</a>
    </div>
</div> -->
<br>
 <div class="row justify-content-center justify-content-md-around">
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-6 text-left">
                <span style="color:#000000; font-weight: bold;" >USUARIO: </span> <span style="color:#000000; font-weight: normal;" ><strong><?php echo $_SESSION[$this->presession . 'usuario']; ?></strong></span><br/>
                <span style="color:#000000; font-weight: bold;" >NOMBRE: </span> <span style="color:#000000; font-weight: normal;" ><strong><?php echo strtoupper($_SESSION[$this->presession . 'nombre']); ?></strong></span>
            </div>
        </div>
    </div>
     <div class="col-md-4">
       
    </div>
</div>
 <?php
$this->load->view('cabecera');
?>
<br>
<br>


<?php
$prefijo=$this->prefijo;

$alineacionw='center';
$alineacionh='middle';

?>

<div class="row">
  <div class="col-md-4" align="center">
    
  </div>

    <div class="col-md-4" align="left">
    <?php
    echo $datos[0]['eva_texto_despedida'];
    ?>
  </div>
  
</div>
<div class="row">
  <div class="col-md-12" align="center">
    
    <?php echo form_open_multipart('Prueba_cinco/ir_inicio/'); ?>  

    <button type="submit" class="btn-etika btn" >Finalizar</button>
  </div>  
</div>






