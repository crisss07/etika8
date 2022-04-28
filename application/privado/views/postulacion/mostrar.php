<!-- cdn fontawesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>

<div id="listado">
    <br/>
    <?php
    $this->load->view('cabecera');
    ?>
    <?php
    $prefijo = 'pos_';
    $sitio = $this->tool_entidad->sitioindexpri();
    $rutaArchivo = $this->tool_entidad->rutarchivo();
    $alineacionw = 'left';
    $alineacionw1 = 'center';
    $alineacionh = 'middle';
//    definimos la fecha actual
    $dateActual = date('Y-m-d');
//    definimos array para eliminar archivos posteriormente
    $arrayArchivos = array();
//    definimos los dias de diferencia
    $maxDay = 30;
//    definimos la ruta del directorio a evaluar
    $carpeta = "./archivos/cvtemporales/" . $id;
//    recuperamos el contenido del directorio
    $carpeta_archivos = @scandir($carpeta);
    $bucket_url = $this->tool_entidad->aws_url();

//    condicion para ver si es mayor a 2
//    tiene al menos un archivo el directorio
if(@$carpeta_archivos){
    if (count($carpeta_archivos) > 2) {
//        echo 'NO VACIO';
        foreach ($datos as $key => $value) {
//            print_r($value);
            if (@$value['cvtem']) {
                $dateCV = $value['cvtem']['fecha'];
                $dateCV = new DateTime($dateCV);
                $date = new DateTime($dateActual);
                $diff = $date->diff($dateCV);
                if ($diff->days >= $maxDay) {
                    $arrayArchivos[] = $value['cvtem']['nombre'];
                }
            }
        }
    }
}	else {
//        echo 'VACIO';
//        eliminamos la carpeta si esta vacio
        @rmdir($carpeta);
    }

//    para eliminar los archivos temporales
    if ($arrayArchivos) {
        foreach ($arrayArchivos as $key => $value) {
            @unlink("./archivos/cvtemporales/" . $id . "/" . $value);
        }
    }
    ?>
    <table  align="center" width="100%" >
        <tr>
            <td colspan="4" align="left">
                <span class="text3"> Cliente: </span>
                <span class="text2"> <?php echo $cliente; ?> </span>
            </td>
        </tr>
    </table>
    <table align="center" width="100%" cellpadding="10">
        <tr>
            <td class="enlaces_add_edit" align="left" width="100%">
                <?php echo anchor($this->controlador, 'Atras', array('class' => 'enlace_retornar enlace_a1')); ?>
            </td>
        </tr>
    </table>
    <div class="scrollh">
        <table id="myTable" align="center" class="tabla_listado table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr class="cabecera_listado">
                    <td align="<?php echo $alineacionw1;?>">Nro</td>
                    <?php for ($i = 0; $i < count($campos_listar); $i++) { ?>
                        <td align="<?php echo $alineacionw1;?>"><?php echo $campos_listar[$i]; ?></td>
                    <?php } ?>
                    <?php if (@$desvincular || $_SESSION[$this->presession . 'permisos'] == 1) { ?>
                        <td>Seleccionar</td>
                        <td>Desvincular</td>
                        <td> Carpeta </td>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
            <?php
            if ($datos) {
				$fila_color = array('fila-color-1','fila-color-2');
			$color=0;

            //formulario para descargar archivos seleccionados
            echo form_open_multipart('postulacion/descargar_seleccionados'); 
            
                $nom_var = $datos[0]['con_id1'];
                ?>
                <input type="hidden" name="nombre_carpeta" value="<?php echo $nom_var; ?>">
                <?php
                foreach ($datos as $num => $fila) {

					
				if($color==0)
				{ ?>
				<tr class="<?php echo $fila_color[$color]; $color=1; ?>">
				<?php }
				else{ ?>
				<tr class="<?php echo $fila_color[$color]; $color=0; ?>">
				<?php }
                    ?>
                    <?php $dato_ci=''; ?>
                        <td align="<?php echo $alineacionw1;?>"><?php echo $num + 1; ?>&nbsp;</td>
                        <?php
                        for ($i = 0; $i < count($campos_reales); $i++) {
                            if (strtolower($campos_reales[$i]) == 'num' && $fila[strtolower($campos_reales[$i])] != 0) {
                                $cargo = '';
                                $paralelas = array();
                                $dato_ci= $fila[strtolower($campos_reales[2])];//ci del postulante
                                foreach ($fila[$campos_reales[$i]] as $indice => $valor) {
//                                    $cargo = '';
                                    $cargo .= "<b>Cargo: </b>" . $valor['con_cargo'] . "<br/>";
                                    $cargo .= "<b>Etiko1: </b>" . $this->etikos[$valor['eti_id1']] . "<br/>";
                                    $cargo .= "<b>Etiko2: </b>" . @$this->etikos[$valor['eti_id2']] . "<br/>";
//                                    $paralelas[] = $cargo;
                                }
                                ?>
                                <td align="<?php echo $alineacionw;?>"><?php echo $cargo; ?></td>
                                <!--<td style="text-align: center;"><?php //echo implode('<hr/>', $paralelas); ?></td>-->
                                <?php
                            } elseif (strtolower($campos_reales[$i]) == 'cvtem') {
                                ?>
                                <td style="text-align: center;">
                                    <?php
                                    @$archivo_existe = "./archivos/cvtemporales/" . $fila['con_id1'] . "/" . $fila[$campos_reales[$i]]['nombre'];
//                                    $archivo_existe = $rutaArchivo . "cvtemporales/" . $fila['con_id1'] . "/" . $fila[$campos_reales[$i]]['nombre'];
                                    if (@$fila[$campos_reales[$i]]['nombre'] != '') {
                                        if (file_exists($archivo_existe)) {
                                            ?>
                                            <a href="<?php echo $bucket_url ?>archivos/cvs/tmp/<?php echo $fila['con_id1'] . "/" . $fila[$campos_reales[$i]]['nombre']; ?>" target="_blank"><i class="bi bi-cloud-download"></i></a>
                                            <?php
                                        } else { ?>
                                            <a href="<?php echo $bucket_url ?>archivos/cvs/temp/<?php echo $fila['con_id1'] . "/" . $fila[$campos_reales[$i]]['nombre']; ?>" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-download" viewBox="0 0 16 16">
                                              <path d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
                                              <path d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>
                                            </svg>
                                            <br>
                                        <?php } echo '<b>' . $fila[$campos_reales[$i]]['fecha'] . '</b>';
                                    } ?>

                                            </a>
                                </td>
                                <?php if (!empty($fila[$campos_reales[$i]]['nombre'])) { ?>
                                    <td align="<?php echo $alineacionw1;?>">
                                        <input type="checkbox" class="check" id="flat-checkbox-1" name="archivos[]" value="<?php echo $fila[$campos_reales[$i]]['nombre'];?>"  data-checkbox="icheckbox_flat-green">

                                    </td>
                                <?php } else {?>
                                    <td></td>
                                <?php }
                            } else {
                                ?>
                                <td align="<?php echo $alineacionw;?>"><?php echo $fila[strtolower($campos_reales[$i])]; ?>&nbsp;</td>
                                <?php
                            }

                            ?>
                            
                            
                            <?php
                        }
                        ?>
                        <?php if (@$desvincular || $_SESSION[$this->presession . 'permisos'] == 1) { ?>
                            <td align="<?php echo $alineacionw1;?>"><?php echo anchor($this->controlador . 'desvincular/id/' . $fila['con_id'], 'Desvincular', array('class' => 'enlace_a1')); ?></td>
                        <?php } ?>

                        <td align="?php echo $alineacionw; ?>" valign="?php echo $alineacionh; ?>" >
                       <?php echo anchor($this->controlador . 'folder_postulante/' . $dato_ci, '<i class="fas fa-folder-open"></i> ', array('class' => 'enlace_a1','style'=>'font-size: 24px;')); ?>

                       
                    </td> 
                        

                    </tr>
                    <?php
                }
            }
            ?>
            </tbody>
        </table>
        <br>
        <!-- boton para descargar seleccionados -->
        <div class="col-md-12" align="center">
             <button type="submit" class="btn btn-info" >Descargar CVS adjuntos seleccionados</button>
         </div>
        </form> 
        <br><br>
        <form action="<?php echo $sitio  . 'postulante/zip_postulantes' ?>" method="post" id="form_listar_fsimple">
            <input type="text" style="display: none;" name="idc" value="<?php echo $id;?>" />
            <br/>
            <table>
                <tr>                
					<td align="center"><input type="Submit" name="descargar_doc" class="btn-etika btn" value=" Descargar CVS en Sistema"/></td>
                    <td></td>
                    <td></td>
                    <td align="center"><a style="color: white;" class="btn-etika btn" value=" Descargar CVS " id="guardar" onclick="funcionCargar(<?php echo $id;?>)" />Descargar CVS Adjuntos </a></td>
                </tr>
                <br>
                <tr>                
                   <td style="float: left; font-size: 10px;">(Descargar todos los CV's en Sistema)</td>
                   <td></td>
                   <td></td>
                    <td style="float: right; font-size: 10px;">(Descargar todos los CV's Aduntos agrupados en ZIP)</td> 
                </tr>
            </table>
            <br><br>
        </form>
    </div>
</div>

<script>

    function funcionCargar(id){

        window.location.href = "<?php echo $sitio; ?>postulante/zip_postulantes_cvs/" + id;
    }
</script>
<script>
    $(function(){
      $('#myTable').tablesorter(); 
    });
</script>


