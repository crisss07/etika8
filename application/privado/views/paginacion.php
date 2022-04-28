<div id="paginacion">
<?php
if(($this->pagina==1)&&($total_registros<=$this->registros)){
    ?>
    <!--<span class='paginaactual'>
                         <span class="corchete">[</span>
                         <?php echo $this->pagina; ?>
                         <span class="corchete">]</span>
                     </span>-->
    <?php
}
else{

if($total_registros) {?>
   
        <?php
        if(($this->pagina - 1) > 0) {
        $antpag=$this->pagina-1;
        ?>
            <a href='<?php echo $enlace.$antpag;?>' class='paginaant'>&laquo; Anterior</a>
        <?php
        }

        for ($i=1; $i<=$total_paginas; $i++){
                if($this->pagina == $i)
                {        ?>
                     <span class='paginaactual'>
                         <span class="corchete">[</span>
                         <?php echo $this->pagina; ?>
                         <span class="corchete">]</span>
                     </span>
               <?php }
               else {?>
                     <a href='<?php echo $enlace.$i?>' class='pagina'><?php echo $i;?></a>
        <?php
               }
        }

        if(($this->pagina + 1)<=$total_paginas) {
        $sigpag=$this->pagina+1;
             ?>
                     <a href='<?php echo $enlace.$sigpag;?>' class='paginasig'>Siguiente &raquo;</a>
        <?php
        }
        ?>
   
<?php
}
}
?>
</div>