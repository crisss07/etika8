 <?php  if($this->boton==1) {    ?>
<span class="boton_menu_activo">Quiénes somos</span>
<?php  } else  {  ?>
<a href="<?php echo base_url()."qsomos/mostrar";?>" class="boton_menu">Quiénes somos</a>
<?php   }     ?>

<a href="<?php echo base_url()."historia/mostrar";?>" <?php if($this->boton==2){?>class="boton_menu_activo"<?php } else{?>class="boton_menu"<?php } ?> >Nuestra historia</a>
<a href="<?php echo base_url()."actividad/listar";?>" <?php if($this->boton==3){?>class="boton_menu_activo"<?php } else{?>class="boton_menu"<?php } ?> >Actividades</a>
<a href="<?php echo base_url()."proyecto/mostrar";?>" <?php if($this->boton==4){?>class="boton_menu_activo"<?php } else{?>class="boton_menu"<?php } ?> >Proyectos</a>
<a href="#" <?php if($this->boton==5){?>class="boton_menu_activo"<?php } else{?>class="boton_menu"<?php } ?> >Enlaces de interés</a>
<a href="#" <?php if($this->boton==6){?>class="boton_menu_activo"<?php } else{?>class="boton_menu"<?php } ?> >Contáctenos</a>
<a href="<?php echo base_url();?>" class="boton_menu">Inicio</a>
