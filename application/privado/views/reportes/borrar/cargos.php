<?php
echo '<option value="0" >Todos los cargo</option>';
if($cargos){
    foreach ($cargos as $row){

        echo '<option value="'.$row['id'].'" >'.$row['cargo'].'</option>';
    }
}
?>