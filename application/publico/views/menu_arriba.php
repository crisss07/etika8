 <table align="center">
                    <tr>
                        <td>
                            <?php
                            if($boton==1){
                                $est='aenlace_activo';
                            }
                            else{
                                $est='aenlace';
                            }
                            ?>
                            <?php //echo anchor('qsomos/menu', '¿Que es la coordinadora?',array('class'=>$est)); ?>

                            <!-- <?php echo anchor('#', 'Que es la coordinadora?',array('class'=>'aenlace')); ?>-->
                            <?php
                            if($boton==1){ $est1='aenlace_activo'; }
                            else{$est1='aenlace';}
                            if($boton==2){ $est2='aenlace_activo'; }
                            else{$est2='aenlace';}
                            if($boton==3){ $est3='aenlace_activo'; }
                            else{$est3='aenlace';}
                            if($boton==4){ $est4='aenlace_activo'; }
                            else{$est4='aenlace';}
                            if($boton==5){ $est5='aenlace_activo'; }
                            else{$est5='aenlace';}
                            ?>
                            <?php echo anchor('tematica/menu/tem/1', 'Violencia',array('class'=>$est1)); ?>
                            <?php echo anchor('tematica/menu/tem/2', 'Participacion política',array('class'=>$est2)); ?>
                            <?php echo anchor('tematica/menu/tem/3', 'Tierras ',array('class'=>$est3)); ?>
                            <?php echo anchor('tematica/menu/tem/4', 'Seccion medios',array('class'=>$est4)); ?>
                            <?php echo anchor('tematica/menu/tem/5', 'Migracion',array('class'=>$est5)); ?>

                            <?php //echo anchor('#', 'Preguntas del mes ',array('class'=>'aenlace')); ?>
                            <?php //echo anchor('#', 'Suscribete ',array('class'=>'aenlace')); ?>
                            <?php //echo anchor('#', 'Participe ',array('class'=>'aenlace')); ?>
                            <?php //echo anchor('#', 'Boletines ',array('class'=>'aenlace')); ?>


                        </td>
                    </tr>
                </table>