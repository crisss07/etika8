<table width="100%" cellpadding="10">
      <tr>
          <td class="enlaces_add_edit" align="left" width="100%">
               <?php
                          if(@$cabecera)
                          {
                          ?>
                      <table align="left">                            
                              <tr>
                                  <td>
                                     <?php
                                     if(!@$this->notitulo)
                                     {
                                     ?>
                                      <?php
                                      if(@$cabecera['titulo_general'])
                                          {
                                      ?>
                                      <span class="cabecera_titulo"> <?php echo strtoupper(@$cabecera['titulo_general']);?></span>
                                      <br>
                                      <?php
                                          }
                                      ?>
                                      <?php
                                      if(@$cabecera['titulo'])
                                          {
                                      ?>
                                      <span class="cabecera_titulo"> <?php echo strtoupper(@$cabecera['titulo']);?></span>
                                      <?php
                                          }
                                      if(@$cabecera['sub_titulo'])
                                         {
                                      ?>
                                      <span class="flecha2">&raquo;</span>
                                      <span class="cabecera_accion"> <?php echo strtoupper(@$cabecera['sub_titulo']);?></span>
                                      <?php
                                          }
                                      if(@$cabecera['accion'])
                                         {
                                      ?>
                                      <span class="flecha2">&raquo;</span>
                                      <span class="cabecera_accion"> <?php echo strtoupper(@$cabecera['accion']);?></span>
                                      <?php
                                          }
                                     }
                                      ?>

                                  </td>
                              </tr>
                              <!--tr><td colspan="2"><div class="linea1"></div></td></tr-->
                      </table>
                          <?php
                          }
                          ?>
          </td>

      </tr>
</table>

 <?php
if(@$this->idp){
?>
     <div id="cabecera_listado">
      <table width="100%">
          <tr>
              <td>
                  <span class="text3">
                  <?php  if(!$this->superior['titulonom']){ echo "Titulo :";} else{ echo $this->superior['titulonom'];}?>
                  </span>
                  <span class="text2"><?php echo $this->superior['titulop'];?></span>
              </td>
          </tr>
      </table>
    </div>
    

<?php
}
?>
