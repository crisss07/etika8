 <?php
   for($i=1;$i<=count($rutacces)/2;$i++){
   ?>
    &nbsp;<span class="flechita1">&raquo;</span><a href="<?php echo $rutacces['enlace'.$i]?>" class="enlace_acces"><?php echo $rutacces['nombre'.$i]?></a>
<?php } ?>
