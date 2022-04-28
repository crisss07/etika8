<table align="center" width="100%">
      <tr>
          <td class="enlaces_add_edit" align="left" width="100%">
               <?php
                          if(count($cabecera))
                          {
                          ?>
                      <table align="center">                            
                              <tr>
                                  <td>
                                     <?php
                                     if(!isset($this->notitulo))
                                     {
                                     ?>
                                      <?php
                                      if(isset($cabecera['titulo_general']))
                                          {
                                      ?>
                                      <span class="cabecera_titulo"> <?php echo $cabecera['titulo_general'];?></span>
                                      <br/>
                                      <?php
                                          }
                                      ?>
                                      <?php
                                      if($cabecera['titulo'])
                                          {
                                      ?>
                                      <span class="cabecera_titulo"> <?php echo $cabecera['titulo'];?></span>
                                      <?php
                                          }
                                      if(@$cabecera['accion'])
                                         {
                                      ?>
                                      <span class="flecha2">&rarr;</span>
                                      <span class="cabecera_accion"> <?php echo $cabecera['accion'];?></span>
                                      <?php
                                          }
                                     }
                                      ?>

                                  </td>
                              </tr>
                              <tr><td colspan="2"><div class="linea1"></div></td></tr>
                          </table>
                          <?php
                          }
                          ?>
          </td>

      </tr>
</table>

 <?php
if(isset($this->idp)){
?>
     <div id="cabecera_listado">
    <table width="100%">
        <tr>
            <td>
                <span class="text3">
                <?php  if(!$this->superior['titulonom']){ echo "Titulo :";} else{ echo $this->superior['titulonom'];}?>
                </span>
                <span class="text2"><?php echo $this->superior['titulop'];?></span>
                <?php if($this->superior['titulop1']){ ?>
                <br/><br/>
                <span class="text3">
                <?php  if(!$this->superior['titulonom1']){ echo "Titulo :";} else{ echo $this->superior['titulonom1'];}?>
                </span>
                <span class="text2"><?php echo $this->superior['titulop1'];?></span>
                <?php } ?>
                <?php if($this->superior['titulop2']){ ?>
                <br/><br/>
                <span class="text3">
                <?php  if(!$this->superior['titulonom2']){ echo "Titulo :";} else{ echo $this->superior['titulonom2'];}?>
                </span>
                <span class="text2"><?php echo $this->superior['titulop2'];?></span>
                <?php } ?>
                <?php if($this->superior['titulop3']){ ?>
                <br/><br/>
                <span class="text3">
                <?php  if(!$this->superior['titulonom3']){ echo "Titulo :";} else{ echo $this->superior['titulonom3'];}?>
                </span>
                <span class="text2"><?php echo $this->superior['titulop3'];?></span>
                <?php } ?>
            </td>
        </tr>
    </table>
    </div>
    

<?php
}
?>