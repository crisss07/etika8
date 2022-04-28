<div id="paginacion">
<?php
if(count($this->anios)>1){
    $anios = $this->anios;    
    foreach ($anios as $posicion=>$anio){
        if($this->pagina == $anio['anios'])
                {
            $numero_pos=$posicion;
        }
    }       
    $total = count($anios)-1;    
        /*if($this->pagina < $anios[0]['anios']) {
        $antpag=$numero_pos-1;
        echo anchor($enlace.$anios[$antpag]['anios'],'&laquo; Anterior');
        }*/
    foreach ($anios as $anio){
        if($this->pagina == $anio['anios'])
                {        ?>
                     <span class='paginaactual'>
                         <span class="corchete">[</span>
                         <?php echo $this->pagina; ?>
                         <span class="corchete">]</span>
                     </span>
               <?php }
               else {
                   echo anchor($enlace.$anio['anios'],$anio['anios']);
                   ?>
        <?php
               }
    }
    /*if($this->pagina>$anios[$total]['anios']) {
        $sigpag=$numero_pos+1;
        echo anchor($enlace.$anios[$sigpag]['anios'],'Siguiente &raquo;');       
        }*/
}
?>
</div>