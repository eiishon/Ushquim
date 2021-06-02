<?php ob_start() ?>
<style>
  .Error {
    border-color: red;
    background-color: rgba(255, 0, 0, 0.1);
    border-width: 2px;
  }
  input{
    padding: 2%;
    margin: 3%;
    text-align: center;
    border-radius: 10px;
    border: 1px dashed #2C5919;
  }
  
  input[type=submit]{
    width: 80%;
    margin-left: 10%;
    background-color:  rgba(167, 195, 155, 0.4);
    color: #2C5919;
    border: none;
    border-radius: 30px 30px 30px 5px;
  }
  .wrapper {
  display: flex;
  align-items: center;
  flex-direction: column; 
  justify-content: center;
  width: 100%;
  min-height: 100%;
  padding: 20px;
}

#formContent {
  display: inline-block;
  align-content: center;
  -webkit-border-radius: 10px 10px 10px 10px;
  border-radius: 10px 10px 10px 10px;
  padding: 30px;
  width: 45%;
  position: relative;
  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
}
.fadeInDown {
  -webkit-animation-name: fadeInDown;
  animation-name: fadeInDown;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}

@-webkit-keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

@keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

/* Simple CSS3 Fade-in Animation */
@-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

.fadeIn {
  opacity:0;
  -webkit-animation:fadeIn ease-in 1;
  -moz-animation:fadeIn ease-in 1;
  animation:fadeIn ease-in 1;

  -webkit-animation-fill-mode:forwards;
  -moz-animation-fill-mode:forwards;
  animation-fill-mode:forwards;

  -webkit-animation-duration:1s;
  -moz-animation-duration:1s;
  animation-duration:1s;
}

.fadeIn.first {
  -webkit-animation-delay: 0.4s;
  -moz-animation-delay: 0.4s;
  animation-delay: 0.4s;
}

.fadeIn.second {
  -webkit-animation-delay: 0.6s;
  -moz-animation-delay: 0.6s;
  animation-delay: 0.6s;
}

.fadeIn.third {
  -webkit-animation-delay: 0.8s;
  -moz-animation-delay: 0.8s;
  animation-delay: 0.8s;
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
<div class="wrapper fadeInDown">
  <div id="formContent">
<form name="inicioSesion" action="index.php?ctl=login" method="POST">
      <h3>Inicio sesión</h3>
      <input type="text" name="user" value="<?php $user ?>" class="fadeIn first" placeholder="nombre de usuario" />
      <input type="password" name="pwd" value="<?php $pwd ?>" class="fadeIn second" placeholder="contraseña" />
<br>
  <input type="submit" value="Enviar" name="enviar" class="fadeIn third"/>
  <div id="errores"></div>
</form>
  </div></div>
<?php $contenido = ob_get_clean() ?>
<?php include __DIR__ . '/../layout.php' ?>