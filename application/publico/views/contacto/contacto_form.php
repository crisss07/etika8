<?php
$this->load->view('cabecera');
$tabla = $this->tabla;
/* $consulta2 = $this->db->query('
  SELECT * FROM '.$tabla.' where '.$prefijo.'id="3"
  order by '.$prefijo.'orden asc
  ');
  $estatico=$consulta2->result_array(); */
?>

<div id="cuadro_intro">        

    <form method="post" action="<?php echo @$action; ?>" id="form_contacto">
    <!-- <form method="post" action="contacto/agregar" id="form_contacto"> -->
        <h2  style="font-size: 15px;color: #000;"><?php echo strtoupper($this->titulo_hoja); ?></h2>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">

<!--                <div class="titulo_contacto"><?php //echo strtoupper($this->titulo_hoja); ?></div>-->
                    <?php
                    if (@$mensaje_exito) { //var_dump($this->msje);
                        ?>
                        <br/>
                        <div align="center">
                            <div class="texto_msj">
                                <?php echo $this->msje; ?>
                            </div>
                        </div>
                        <br/>
                        <?php
                    }
                    ?>
                    <table align="center">
                        <?php if (@$this->departamentos) { ?>

                            <?php
                            $campo1 = 'departamento';
                            // echo form_label('Departamento: ', $prefijo . $campo1);
                            echo form_dropdown($campo1, $this->departamentos, @$fila['departamento'], "class='custom-select custom-select-sm input-etika'");
                            if (@$error[$campo1])
                                echo '<div class="error"><p>' . @$error[$campo1] . '</p></div>';
                            ?>
                        <?php } ?>

                        <?php
                        $campo1 = 'consulta';
//                                        echo form_label('Consulta: ', $prefijo . $campo1); 
                        echo form_textarea(array(
                            'name' => @$prefijo . $campo1,
                            'id' => @$prefijo . $campo1,
                            'rows' => '10',
                            'cols' => '40',
                            'class' => 'input-etika',
                            'placeholder' => 'CONSULTA:',
                            'value' => set_value(@$prefijo . @$campo1, @$fila[$prefijo . $campo1])
                        ));

                        if (@$error[$campo1])
                            echo '<div class="error"><p>' . @$error[$campo1] . '</p></div>';
                        ?>
                       
                        <!--
                        <?php //$campocap = 'captcha'; ?>
                        Código de imagen (sensible a mayúsculas y minúsculas)            
                        <br/>
                        <img src="<?php //echo base_url(); ?>files/captcha/securimage_show.php?sid=<?php //echo md5(uniqid(time())); ?>" id="image" align="absmiddle" />                                            
                        <div align="left">
                            <br/>
                            <?php
//                            echo form_label('Introduzca el codigo de imagen : ');
                            //echo form_input(array(
                             //   'name' => $campocap,
                             //   'id' => $campocap,
                             //   'size' => '28',
                             //   'class' => 'input-etika mayusculas',
                             //   'placeholder' => 'INTRODUZCA EL CÓDIGO DE IMAGEN',
                            //));

                            //if (@$error[$campocap])
                            //    echo '<div class="error" align=center><p>' . @$error[$campocap] . '</p></div>';
                            //if (@$error_codigo)
                            //    echo '<div class="error"><p>' . @$error_codigo . '</p></div>';
                            //?>
                        </div> -->                                  

                        <br/>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" name="enviar" value="  Enviar  " style="border: 0; background: transparent" class="boton_aceptar"><img src="<?php echo $this->tool_entidad->sitio() . 'files/img/maq/guardar.gif'; ?>" alt="submit" />ENVIAR</button>
                                <?php
                                echo anchor('ninicio', '<img border="0" src="' . $this->tool_entidad->sitio() . 'files/img/maq/cancelar.gif" /> CANCELAR', array('class' => 'boton_cancelar'));
                                ?>
                            </div>  
                        </div>  
                        <!--input type="submit" name="enviar" value="ENVIAR" class="boton2"/-->
                    <!-- </div> -->
                        </td>
                        </tr>
                    </table>  
                </div>
            </div>
        </div>
        <br/>

    </form>
    <div style="padding: 5px 50px; text-align: center; color: #2f627d;">
        <?php echo $this->parrafo; ?>        
    </div>           
</div>

