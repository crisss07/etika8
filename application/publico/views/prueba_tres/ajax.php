<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  // function guardar_tiempo(hora,min,seg){
    function guardar_tiempo(){
  
    // console.log(hora,min,seg,id_eval,id_grupo,id_pla);
    //console.log(hora,min,seg);
    var base_url='<?php echo base_url(); ?>';
    console.log(base_url);
    // alert('hola ');
    var id_pla=1;
  $.ajax({
    url: '<?php echo base_url();?>index.php/Prueba_tres/test_ajax',
    // url: "http://www.mydomain.com/inc/db_actions.php",
    type: 'post',
    data: {id_pla:id_pla},
    dataType: "json",
    success: function(data){ 
      console.log(data.msj);
      alert('paso por aca');
    }
  });
  // var projID=1;
  // $.ajax({
  //   type: "POST",
  //   url: "http://www.mydomain.com/inc/db_actions.php",
  //   data: "op=DeleteProject&delete="+projID,
  //   success: function(data){

  //   }
  // });
  
}

function myFunction() {
  
  alert('paso');
}
</script>



<!-- <button onclick="guardar_tiempo('9','3','5')"> -->
   <button onclick="guardar_tiempo();">Click me</button> 