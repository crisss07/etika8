<?php
$this->load->view('cabecera');
?>
<?php
$prefijo=$this->prefijo;
$sitio=$this->tool_entidad->sitioindexpri();
$this->load->view($this->carpeta.'etapas');
?>
<div align="left"><?php echo anchor($this->controlador,'Atras',array('class' =>'enlace_retornar enlace_a1')); ?></div>



