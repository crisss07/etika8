<?php
$consulta = $this->db->query('
        SELECT cli_id as id, cli_nombre as nombre
        FROM clientes        
        order by cli_nombre asc
        ');
$clientes = $consulta->result_array();
$cliente_array[-1] = 'Elija el Cliente';
foreach ($clientes as $row) {
    $cliente_array[$row['id']] = $row['nombre'];
}

$consultaCatCargos = $this->db->query('
        SELECT car_id as id, car_nombre as nombre
        FROM cargos where car_tipo=1 
        order by car_nombre asc
        ');
$catCargos = $consultaCatCargos->result_array();
$subCargos = array();
if ($fila['cargo_id'] > 0 && $fila['cargo_id'] != "") {
    $consultaSubCargos = $this->db->query('
        SELECT car_id as id, car_nombre as nombre
        FROM cargos where car_tipo=2 AND fk_cargo_id=' . $fila['cargo_id'] . '
        order by car_nombre asc
        ');
    $subCargos = $consultaSubCargos->result_array();
}
$consultaSedes = $this->db->query('
        SELECT com_id as id, com_nombre as nombre
        FROM combos where com_tipo=13  
        order by com_nombre asc
        ');
$sedesArray = $consultaSedes->result_array();

function sumaDia($fecha, $dia) {
    list($year, $mon, $day) = explode('-', $fecha);
    return date('Y-m-d', mktime(0, 0, 0, $mon, $day + $dia, $year));
}

$idCargo = $fila['cargo_id'];
if ($idCargo == 209) {
    $textoOtro = "";
    $selectCargo = "ocultarTexto";
} else {
    $textoOtro = "ocultarTexto";
    $selectCargo = "";
}
$this->load->view('cabecera');
?>
<table align="center" width="100%">
    <tr>
        <td class="enlaces_add_edit" align="left" width="100%">
            <?php echo anchor($this->controlador . 'agregar', 'Nuevo', array('class' => 'enlace_nuevo enlace_a1')); ?>&nbsp;&nbsp;
            <?php echo anchor($this->controlador, 'Listado', array('class' => 'enlace_listar enlace_a1')); ?>
            &nbsp;&nbsp;
            <?php echo anchor($this->controlador, 'Cancelar', array('class' => 'enlace_cancelar enlace_a1')); ?>
        </td>
    </tr>
</table>
<?php
//$this->load->view('opciones');
if (@$this->carpetaup) {
    $ruta = $this->rutarchivo . $this->carpetaup;
} else {
    $ruta = $this->rutarchivo . $this->carpeta;
}
$alineacionwc1 = 'right';
$alineacionhc1 = 'middle';
$alineacionwc2 = 'left';
$alineacionwc3 = 'center';
$alineacionhc2 = 'middle';
$prefijo = $this->prefijo;
$prefijo1 = $this->prefijo1;
$consulta = $this->db->query('SELECT eti_id as id, eti_nombre as nombre FROM etiko WHERE eti_estado="1" order by eti_nombre asc');
$resultado = $consulta->result_array();
$etikos[-1] = 'Seleccion al ETIKO';
foreach ($resultado as $row) {
    $etikos[$row['id']] = $row['nombre'];
}
?>
<br/>
<div align="center" style="color: #df0072; font-weight: bold;"><i>Los campos marcados con <span class="texto4">*</span> se publican en la parte del postulante.</i></div><br/>
<div id="cuerpo_form_admin">
    <?php echo form_open_multipart($action); ?>  
    <input type="hidden" class="rutabase" value="<?php echo base_url() . "admin.php/convocatoria/secciones"; ?>">
    <input type="hidden" name="<?php echo @$prefijo . 'id'; ?>" value="<?php echo set_value(@$prefijo . 'id', @$fila[$prefijo . 'id']); ?>">
    <input type="hidden" name="idp" value="<?php echo print_r(set_value(@$this->idp, @$this->idp)); ?>">
    <table id="form_admin">
        <tr>
            <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>" colspan="2">
                <?php echo form_label('', $prefijo . 'cliente'); ?>
				<p class="form-label-conv-21">* Cliente: </p>
				<SELECT class="form-select-21" name="cli_id" id="cli_id" >
                    <?php foreach ($cliente_array as $num => $row) { ?>
                        <OPTION VALUE="<?php echo $num; ?>" <?php
                        if ($num == $fila['cli_id']) {
                            echo 'selected';
                        }
                        ?> ><?php echo $row; ?></OPTION>
                            <?php } ?>
                </SELECT>
                <?php
                if (form_error('cli_id'))
                    echo '<div class="error">' . form_error('cli_id') . '</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>" colspan="2">
                <?php echo form_label('', $prefijo . 'cargo'); ?>
				<p class="form-label-conv-21">* Cargo: </p>
				<input id="con_cargo" name="con_cargo" size="80" class="input1" value="<?php echo $fila[$prefijo . 'cargo']; ?>"/>
                <?php
                if (form_error($prefijo . 'cargo'))
                    echo '<div class="error">' . form_error($prefijo . 'cargo') . '</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>" colspan="2">
				<?php echo form_label('', 'cargo_id'); ?>
				<p class="form-label-conv-21">* Cargos para el filtro: &nbsp;&nbsp;<span style="font-size: 12px;color: #737373;">(Solo visible para el usuario Etiko)</span> </p>
                
				<select class="form-select-21" align="<?php echo $alineacionwc2; ?>" name="cargo_id" id="catCargo">
                    <option value="">Seleccione una Unidad</option>
                    <?php
                    foreach ($catCargos as $key => $value) {
                        ?>
                        <option value="<?php echo $value['id']; ?>" <?php echo $fila['cargo_id'] == $value['id'] ? 'selected' : ''; ?> ><?php echo $value['nombre']; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <br>
                <?php
                if (form_error('cargo_id'))
                    echo '<div class="error">' . form_error('cargo_id') . '</div>';
                ?>
                <div class="contenedor-cargos">
                    <select name="sub_cargo_id" class="form-select-21 subCargos <?php echo $selectCargo; ?>">
                        <option value="">Seleccione un Cargo</option>
                        <?php
                        foreach ($subCargos as $key => $value) {
                            ?>
                            <option value="<?php echo $value['id']; ?>" <?php echo $fila['sub_cargo_id'] == $value['id'] ? 'selected' : ''; ?> ><?php echo $value['nombre']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <div class="<?php echo $textoOtro; ?>">

                        <?php
                        // if ($fila['sub_cargo_id'] != null && $fila['sub_cargo_id'] !=0) {
                        if ($fila['sub_cargo_id'] !=0) {
                            $cargo = $this->db->query('
                                            SELECT car_id as id, car_nombre as nombre
                                            FROM cargos where car_tipo=2 AND car_id=' . $fila['sub_cargo_id']);
                            $cargoOtro = $cargo->row_array('array');

                            $textoCargoOtro = $cargoOtro['nombre'];
                        }
                        ?>
                        <label>Cargo: </label> 
                        <input class='input1' name='<?php echo $prefijo."otro_cargo"?>' value='<?php echo @$fila[$prefijo.'otro_cargo']; ?>' onkeyup='mayuscula(this);' size='50'/><br/>
                        <b>Nota:</b> favor de escribir el cargo y unidad para futuros filtros.
                    </div>
                </div>    
                <?php
                if (form_error('sub_cargo_id'))
                    echo '<div class="error">' . form_error('sub_cargo_id') . '</div>';
                ?>
            </td>
        </tr>
		<tr>
			<td colspan="2">
				<table class="w-100">
					<tr>
						<td width="70%" align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc1; ?>">
						<?php $campo1 = 'id1'; ?>
						<?php echo form_label('', $prefijo . $campo1); ?>
						<p class="form-label-conv-21">Responsable ETIKO 1: </p>
						<?php
						echo form_dropdown($prefijo1 . $campo1, $etikos, set_value($prefijo1 . $campo1, $fila[$prefijo1 . $campo1]),'class="form-select2-21"');
						if (form_error($prefijo1 . $campo1))
							echo '<div class="error">' . form_error($prefijo1 . $campo1) . '</div>';
						?>
						</td>
						<td width="30%" style="padding-left:50px;" align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc1; ?>">
						<?php echo form_label('', $prefijo . 'porciento1'); ?>
						<p class="form-label-conv-21">Porcentaje del ETIKO 1: </p>
						<?php
						echo form_input(array(
							'name' => $prefijo . 'porciento1',
							'id' => $prefijo . 'porciento1',
							'size' => '10',
							'class' => 'input1',
							'value' => @set_value($prefijo . 'porciento1', $fila[$prefijo . 'porciento1'])
						)) . ' <b>%</b> ';
						if (form_error($prefijo . 'porciento1'))
							echo '<div class="error">' . form_error($prefijo . 'porciento1') . '</div>';
						?>
						</td>
					</tr>
				</table>
			</td>
        </tr>
		<tr>
			<td colspan="2">
				<table class="w-100">
					<tr>
						<td width="70%" align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc1; ?>">
						<?php $campo1 = 'id2'; ?>
						<?php echo form_label('', $prefijo . $campo1); ?>
						<p class="form-label-conv-21">Responsable ETIKO 2: </p>
						<?php
						echo form_dropdown($prefijo1 . $campo1, $etikos, set_value($prefijo1 . $campo1, $fila[$prefijo1 . $campo1]),'class="form-select2-21"');
						if (form_error($prefijo1 . $campo1))
							echo '<div class="error">' . form_error($prefijo1 . $campo1) . '</div>';
						?>
						</td>
						<td width="30%" style="padding-left:50px;" align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc1; ?>">
						<?php echo form_label('', $prefijo . 'porciento2'); ?>
						<p class="form-label-conv-21">Porcentaje del ETIKO 2: </p>
						<?php
						echo form_input(array(
							'name' => $prefijo . 'porciento2',
							'id' => $prefijo . 'porciento2',
							'size' => '10',
							'class' => 'input1',
							'value' => @set_value($prefijo . 'porciento2', $fila[$prefijo . 'porciento2'])
						)) . ' <b>%</b> ';
						if (form_error($prefijo . 'porciento2'))
							echo '<div class="error">' . form_error($prefijo . 'porciento2') . '</div>';
						?>
						</td>
					</tr>
				</table>
			</td>
        </tr>
        <tr>
			<td colspan="2">
				<table class="w-100">
					<tr>
					<td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc1; ?>">
						<p class="form-label-conv-21">Desde: </p>
					</td>
					<td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc1; ?>">
						<?php $fecha = 'desde'; ?>
						<?php echo form_label('', $prefijo . $fecha); ?>
						<?php
						if (!@$fila[$prefijo . $fecha]) {
							$fila[$prefijo . $fecha] = date('Y-m-d');
						}
						echo form_input(array(
							'name' => $prefijo . $fecha,
							'id' => $prefijo . $fecha,
							'class' => 'input1',
							'size' => '20',
							'maxlength' => '10',
							'value' => set_value($prefijo . $fecha, $fila[$prefijo . $fecha])
						));
						?>
						<span class="texto2">&nbsp;Año-mes-dia</span>
					</td>
					<td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc1; ?>">
						<p class="form-label-conv-21">Hasta: </p>
					</td>
					<td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc1; ?>">
						<?php $fecha = 'hasta'; ?>
						<?php 
						echo form_label('', $prefijo . $fecha); 
						?>
						<?php
						if (!@$fila[$prefijo . $fecha]) {
							$fila[$prefijo . $fecha] = sumaDia(date('Y-m-d'), 30);
						}
						echo form_input(array(
							'name' => $prefijo . $fecha,
							'id' => $prefijo . $fecha,
							'class' => 'input1',
							'size' => '20',
							'maxlength' => '10',
							'value' => set_value($prefijo . $fecha, $fila[$prefijo . $fecha])
						));
						?>
						<span class="texto2">&nbsp;Año-mes-dia</span>
					</td>
					</tr>
				</table>
			</td>
        </tr>
        <tr> 
			<td colspan="2" >
                <b>Nota.</b><br/>1. La "Fecha Hasta" es hasta donde se puede procesar las etapas de la convocatoria.<br/>2. Pasado los 15 dias de la "Fecha Hasta" se desvincula de la convocatoria (Libera el CV).
                <?php
                if (form_error($prefijo . 'desde'))
					{echo '<div class="error">' . form_error($prefijo . 'desde') . '</div>';}
                if (form_error($prefijo . 'hasta'))
					{echo '<div class="error">' . form_error($prefijo . 'hasta') . '</div>';}
                ?>
            </td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="w-100">
					<tr>
						<td width="50%" align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc1; ?>">
						<p class="form-label-conv-21">Monto a Cobrar: </p>
						<?php echo form_label('', $prefijo . 'monto'); ?>
						<?php
						echo form_input(array(
							'name' => $prefijo . 'monto',
							'id' => $prefijo . 'monto',
							'size' => '7',
							'class' => 'input1',
							'value' => @set_value($prefijo . 'monto', $fila[$prefijo . 'monto'])
						)) . ' en Bs.';

						if (form_error($prefijo . 'monto'))
							echo '<div class="error">' . form_error($prefijo . 'monto') . '</div>';
						?>
						</td>
						<td width="50%" align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc1; ?>">
						<p class="form-label-conv-21">Tipo de Facturación: </p>
						<?php
						$nombre = 'facturacion';
						echo form_label('', $prefijo . $nombre);
						?>
						<input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php
						if ($fila[$prefijo . $nombre] == 1) {
							echo 'checked';
						}
						?> /> <b>ETIKA</b>
						<input type="radio" name="<?php echo $prefijo . $nombre; ?>" value="2" <?php
							   if ($fila[$prefijo . $nombre] == 2) {
								   echo 'checked';
							   }
						?> /> <b>Consultor Individual</b>
							   <?php
							   if (form_error($prefijo . $nombre))
								   echo '<div class="error">' . form_error($prefijo . $nombre) . '</div>';
                       ?>
						</td>
					</tr>
				</table>
			</td>
        </tr>
		<tr>
			<td colspan="2">
				<table class="w-100">
					<tr>
						<td width="20%" style="padding-right:20px;" align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc1; ?>">
						<?php echo form_label('', $prefijo . 'sede'); ?>
						<p class="form-label-conv-21">* Sede: </p>
						<?php
						echo form_input(array(
							'name' => $prefijo . 'sede',
							'id' => $prefijo . 'sede',
							'size' => '20',
							'class' => 'input1',
							'value' => @set_value($prefijo . 'sede', $fila[$prefijo . 'sede'])
						));

						if (form_error($prefijo . 'sede'))
							echo '<div class="error">' . form_error($prefijo . 'sede') . '</div>';
						?>
						</td>
						<td width="70%" align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc1; ?>">
						<?php echo form_label('', 'sede_id'); ?>
						<p class="form-label-conv-21">* Sede para el Filtro: </p>
						<select class="form-select-21" name="sede_id">
							<option value="">Seleccione una Sede</option>
							<?php
							foreach ($sedesArray as $key => $value) {
								?>
								<option value="<?php echo $value['id']; ?>" <?php echo $fila['sede_id'] == $value['id'] ? 'selected' : ''; ?> ><?php echo $value['nombre']; ?></option>
								<?php
							}
							?>
						</select>
						<?php
						if (form_error('sede_id'))
							echo '<div class="error">' . form_error('sede_id') . '</div>';
						?>
						</td>
					</tr>
				</table>
			</td>
        </tr>
        
        <tr>
            <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>" colspan="2">
                          
            </td>
        </tr>
        <tr>
            <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
				
            </td>
        </tr>
		<tr>
			<td colspan="2">
				<table class="w-100">
					<tr>
						<td width="50%" align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc1; ?>">
						<p class="form-label-conv-21">* Fecha Tope de Postulación: </p>
						<?php
						$fecha = 'tope';
						echo form_label('', $prefijo . 'tope');
						?>
						<?php
						if (!@$fila[$prefijo . $fecha]) {
							$fila[$prefijo . $fecha] = sumaDia(date('Y-m-d'), 7);
						}
						echo form_input(array(
							'name' => $prefijo . $fecha,
							'id' => $prefijo . $fecha,
							'class' => 'input1',
							'size' => '20',
							'maxlength' => '10',
							'value' => set_value($prefijo . $fecha, $fila[$prefijo . $fecha])
						));
						if (form_error($prefijo . $fecha))
							echo '<div class="error">' . form_error($prefijo . $fecha) . '</div>';
						?>
						<span class="texto2">&nbsp;Año-mes-dia</span>  
						</td>

						

						<td width="50%" align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc1; ?>">
						<p class="form-label-conv-21">Evaluación Personalizada</p>
						<?php $nombre = 'interno'; ?>
						<?php echo form_label('', $prefijo . $nombre); ?>
						<input type="checkbox" name="<?php echo $prefijo . $nombre; ?>" value="1" <?php
						if ($fila[$prefijo . $nombre]) {
							echo 'checked';
						}
						?> />
						</td>
					</tr>
				</table>
			</td>
        </tr>
        <tr>
        	<td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>" colspan="2">
	            <?php echo form_label('', $prefijo . 'encabezado_redes'); ?>
				<p class="form-label-conv-21">Encabezado Redes Sociales: </p>
				<input id="con_encabezado_redes" name="con_encabezado_redes" size="80" class="input1" value="<?php echo @$fila[$prefijo . 'encabezado_redes']; ?>"/>
	            <?php
	            if (form_error($prefijo . 'encabezado_redes'))
	                echo '<div class="error">' . form_error($prefijo . 'encabezado_redes') . '</div>';
	            ?>
	        </td>
        </tr>
        <tr> 
			<td colspan="2" >
                <b>Nota.</b>
                <br/>1. Plantilla 1: Nuestro cliente Finilager, nos ha encomendado la búsqueda de un(a) profesional de alto nivel para ocupar el cargo de:
                <br/>2. Plantilla 2: Empresa multinacional líder a nivel nacional en el rubro de masivos, busca profesional con alto potencial para:
                <br/>3. Plantilla 3: Empresa líder en el sector financiero a nivel nacional, busca profesionales innovadores y alto potencial para el cargo de:
		</tr>
        <tr>
            <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                <?php echo form_label('', $prefijo . 'avance'); ?>
				<p class="form-label-conv-21">* Texto publicación RRSS: </p>
				<?php
                echo form_textarea($prefijo . 'avance',@$fila[$prefijo . 'avance'],array(
                    'rows' => '5',
                    'cols' => '40',
                    'class' => 'tinymcesimple',
					'style' => 'width:100%;'
                ));

                if (form_error($prefijo . 'avance'))
                    echo '<div class="error">' . form_error($prefijo . 'avance') . '</div>';
                ?>
            </td>
        </tr>
        <tr>
            <td align="<?php echo $alineacionwc2; ?>" valign="<?php echo $alineacionhc2; ?>">
                <?php echo form_label('', $prefijo . 'descripcion'); ?>
				<p class="form-label-conv-21">* Texto publicación web: </p>
				<?php
                echo form_textarea($prefijo . 'descripcion',@$fila[$prefijo . 'descripcion'],array(
                    'rows' => '90',
                    'cols' => '40',
                    'class' => 'tinymce',
					'style' => 'width:100%;'
                ));

                if (form_error($prefijo . 'descripcion'))
                    echo '<div class="error">' . form_error($prefijo . 'descripcion') . '</div>';
                ?>
            </td>
        </tr>
    </table>


    <br>
    <br>
    <input class="btn btn-etika" name="enviar" type="submit" value="  Guardar  " >

    <?php echo form_close() ?>
</div>
<br>
<br>
<script type="text/javascript">
    $(function () {
        $('textarea.tinymcesimple').tinymce({
            // Location of TinyMCE script
            script_url: '<?php echo $this->tool_entidad->sitio() ?>files/js/tinymce/tiny_mce.js',

            // General options
            theme: "simple",
            plugins: "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

            // Theme options
            theme_advanced_buttons1: "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
            theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
            //theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
            //theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
            theme_advanced_toolbar_location: "top",
            theme_advanced_toolbar_align: "left",
            theme_advanced_statusbar_location: "bottom",
            //theme_advanced_resizing : true,

            // Example content CSS (should be your site CSS)
            //content_css : "css/example.css",
            content_css: "<?php echo $this->tool_entidad->sitio(); ?>files/css/editor_tiny.css",

            // Drop lists for link/image/media/template dialogs
            template_external_list_url: "lists/template_list.js",
            external_link_list_url: "lists/link_list.js",
            external_image_list_url: "lists/image_list.js",
            media_external_list_url: "lists/media_list.js",

            // Replace values for the template plugin
            template_replace_values: {
                username: "Some User",
                staffid: "991234"
            }
        });
    });
</script>