
<?php 
$prefijo = $this->prefijo;
$sitio = $this->tool_entidad->sitioindex();
?>
<br/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row ">
                <form action="/login.php" id="formulario" onsubmit="return formulario_prueba()">
                    <p>
                      Usuario: <input type="text" name="usuario" id="usuario">
                    </p>
                    <label id="error_usuario" style="color: red; margin-top: -10px; font-size: 10px;"></label>
                    <p>
                      Clave: <input type="text" name="clave" id="clave">
                    </p>
                    <label id="error_clave" style="color: red; margin-top: -10px; font-size: 10px;"></label>
                    <br>
                    <input type="submit" value="Entrar">
                </form>
            </div>
        </div>
    </div>
    <br/>
</div>
<script type="text/javascript">
    function formulario_prueba() {
        var usuario = document.getElementById('usuario').value;
        var clave = document.getElementById('clave').value;
        var cont = 0;
        // alert(usuario);

        if (usuario.length == 0) {
            $('#error_usuario').html('tiene que llenar este campo');
            cont++;
        } else {
            $('#error_usuario').html('');
        }

        if (clave.length < 6) {
            $('#error_clave').html('tiene que tener mas de 5 caracteres');
            cont++;
        } else {
            $('#error_clave').html('');
        }

        if (cont > 0) {
            return false;
        } else {
            return true;
        }

    }
</script>


