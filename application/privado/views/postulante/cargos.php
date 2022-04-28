<?php
echo '<option value="0" >Seleccione el cargo</option>';
if($cargos){
    foreach ($cargos as $row){

        echo '<option value="'.$row['id'].'" >'.$row['cargo'].' ('.$row['fecha'].')</option>';
    }
}
?>