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
        document.forms["editar_perfil"].onsubmit = comprobarDatos;
    }

    function comprobarDatos(elEvento) {

        var evento = elEvento || window.event;

        var valorPwd = document.forms["editar_perfil"].elements["pwd"].value.trim();
        var valorEmail = document.forms["editar_perfil"].elements["email"].value.trim().toLowerCase();
        var valorRepPwd = document.forms["editar_perfil"].elements["reppwd"].value.trim();
        var valorRepEmail = document.forms["editar_perfil"].elements["repemail"].value.trim().toLowerCase();

        var error = false;
        var cadenaError = "";

        if (evento.type == "submit") {
            if ((valorPwd != "" && valorRepPwd == "") || (valorPwd == "" && valorRepPwd != "")) {
                if (valorPwd == "") {
                    cadenaError += "<li> El campo Contraseña es obligatorio</li>";
                    document.forms["registro"].elements["pwd"].className = "Error";
                }
                if (valorRepPwd == "") {
                    cadenaError += "<li> El campo Repetir Contraseña es obligatorio</li>";
                    document.forms["registro"].elements["pwd"].className = "Error";
                }
            } else if(valorPwd != valorRepPwd){
                cadenaError += "<li>Los campos Contraseña y Repetir Contraseña no coinciden.</li>"
            }
            if((valorEmail != "" && valorRepEmail == "") || (valorEmail == "" && valorRepEmail != "")){
                if (valorEmail == "") {
                cadenaError += "<li> El campo Email es obligatorio</li>";
                document.forms["registro"].elements["email"].className = "Error";
            }

            if (valorRepEmail == "") {
                cadenaError += "<li> El campo Repetir Email es obligatorio</li>";
                document.forms["registro"].elements["email"].className = "Error";
            }
            }else if(valorEmail != valorRepEmail){
                cadenaError += "<li>Los campos Email y Repetir Email no coinciden.</li>";
            }
            


            if (cadenaError == "") error = false;
            else {
                error = true;
            }

            if (error == true) {
                evento.preventDefault();
                document.getElementById("errores").innerHTML =
                    "<br><br><span><strong>Errores en el formulario</strong></span><ul>" + cadenaError + "</ul>";
            } else {
                document.getElementById("errores").innerHTML = "";
                elementoError = null;
            }
        }
    }
</script>

<body>
    <main>
        <div class="container">
            <form method="POST" action="index.php?ctl=editar_perfil" name="editar_perfil" enctype="multipart/form-data">
                <fieldset>
                    <legend>¡Cambia tus datos!</legend>
                    <div class="uno">
                        <label for="name"> Nombre: </label>
                        <input type="text" name="name" id="name">
                        <label for="apellidos">Apellidos: </label>
                        <input type="text" name="apellidos" id="apellidos">
                        <div class="dos">
                            <label for="usuario">Nombre de usuario: </label>
                            <input type="text" name="user" id="user">
                            <label for="pwd">Contraseña: </label>
                            <input type="password" name="pwd" id="pwd">
                            <label for="reppwd">Repite tu contraseña: </label>
                            <input type="password" name="reppwd" id="reppwd">
                        </div>
                        <div class="tres">
                            <label for="email">Email: </label>
                            <input type="email" name="email" id="email">
                            <label for="repemail">Repite el email: </label>
                            <input type="email" name="repemail" id="repemail">
                            <label for="bio">Cuéntanos un poco sobre ti:</label>
                            <textarea id="bio" name="bio" rows="4" cols="40"></textarea>
                        </div>
                        <label for="alergias">Alergias: </label>
                        <div class="al">
                            <input type="checkbox" id="gluten" name="gluten" value="gluten">
                            <label for="gluten">Gluten</label>
                            <input type="checkbox" id="crustaceos" name="crustaceos" value="crustaceos">
                            <label for="crustaceos">Crustáceos</label>
                            <input type="checkbox" id="huevos" name="huevos" value="huevos">
                            <label for="huevos">Huevos</label>
                            <input type="checkbox" id="pescado" name="pescado" value="pescado">
                            <label for="pescado">Pescado</label>
                            <input type="checkbox" id="cacahuetes" name="cacahuetes" value="cacahuetes">
                            <label for="cacahuetes">Cacahuetes</label>
                            <input type="checkbox" id="soja" name="soja" value="soja">
                            <label for="soja">Soja</label>
                            <input type="checkbox" id="lactosa" name="lactosa" value="lactosa">
                            <label for="lactosa">Lactosa</label>
                        </div>
                        <div class="al">
                            <input type="checkbox" id="frutosdecascara" name="frutosdecascara" value="frutosdecascara">
                            <label for="frutosdecascara">Frutos de cáscara</label>
                            <input type="checkbox" id="apio" name="apio" value="apio">
                            <label for="apio">Apio</label>
                            <input type="checkbox" id="mostaza" name="mostaza" value="mostaza">
                            <label for="mostaza">Mostaza</label>
                            <input type="checkbox" id="sesamo" name="sesamo" value="sesamo">
                            <label for="sesamo">Sésamo</label>
                            <input type="checkbox" id="sulfitos" name="sulfitos" value="sulfitos">
                            <label for="sulfitos">Sulfitos</label>
                            <input type="checkbox" id="moluscos" name="moluscos" value="moluscos">
                            <label for="moluscos">Moluscos</label>
                            <input type="checkbox" id="altramuces" name="altramuces" value="altramuces">
                            <label for="altramuces">Altramuces</label>
                        </div>
                        <label for="alergias">Preferencias alimenticias: </label>
                        <input type="checkbox" id="vegan" name="vegan" value="vegan">
                        <label for="vegan">Vegano</label>
                        <input type="checkbox" id="vegetarian" name="vegetarian" value="vegetarian">
                        <label for="vegetarian">Vegetariano</label>
                    </div>
                    <div class="button">
                        <input type="submit" name="editar" value="Editar" id="editar">
                        <input type="button" name="borrar_perfil" value="Borrar perfil" id="borrar_perfil">
                    </div>
                </fieldset>
                <div id="errores"></div>
            </form>
        </div>
    </main>
</body>

<?php $contenido = ob_get_clean() ?>
<?php include __DIR__ . '/../layout.php' ?>