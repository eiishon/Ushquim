<?php ob_start() ?>
<style>
  .Error {
    border-color: red;
    background-color: rgba(255, 0, 0, 0.1);
    border-width: 2px;
  }
</style>
<script>
  window.onload = function(elEvento) {
    var evento = elEvento || window.event;
    document.forms["inicioSesion"].onsubmit = comprobarDatos;
  }

  function comprobarDatos(elEvento) {

    var evento = elEvento || window.event;

    var valorUser = document.forms["inicioSesion"].elements["user"].value.trim();
    var valorPwd = document.forms["inicioSesion"].elements["pwd"].value.trim();
    var error = false;
    var cadenaError = "";
    if (valorUser == "") {
      cadenaError += "<li> El campo Nombre de usuario es obligatorio</li>";
      document.forms["inicioSesion"].elements["user"].className = "Error";
    }
    if (valorPwd == "") {
      cadenaError += "<li> El campo Contraseña es obligatorio</li>";
      document.forms["inicioSesion"].elements["pwd"].className = "Error";
    }
    if (cadenaError == "") error = false;
    else {
      error = true;
    }

    if (error == true) {
      evento.preventDefault();
      document.getElementById("errores").innerHTML =
        "<br><br><span><strong>Errores en el formulario</strong></span><ul>" + cadenaError + "</ul>";
    }
  }
</script>
<br />
<form name="inicioSesion" action="index.php?ctl=login" method="POST">
  <table>
    <tr>
      <th>Usuario</th>
      <th>Contraseña</th>
    </tr>
    <tr>
      <td><input type="text" name="user" value="<?php $user ?>" /></td>
      <td><input type="password" name="pwd" value="<?php $pwd ?>" /></td>
    </tr>

  </table>
  <input type="submit" value="Enviar" name="enviar" />
  <div id="errores"></div>
</form>

<?php $contenido = ob_get_clean() ?>
<?php include __DIR__ . '/../layout.php' ?>