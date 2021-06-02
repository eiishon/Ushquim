<?php ob_start() ?>

<head>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .Error {
            border-color: red;
            background-color: rgba(255, 0, 0, 0.1);
            border-width: 2px;
        }

        .container {
            width: 80%;
            margin-left: 10%;
            margin-top: 5%;
            margin-bottom: 5%;
            border: 1px dotted;
            background-color: white;
            text-align: center;
        }

        legend {
            font-family: 'Akaya Kanadaka', cursive;
            color: #2C5919;
            text-align: center;
            text-shadow: 1px 1px 2px #082b34;
            padding-top: 2%;
            margin-bottom: 3%;
        }

        label {
            font-family: 'Akaya Kanadaka', cursive;
            color: #2C5919;
            padding-top: 1%;
        }

        input[type=text],
        input[type=password],
        input[type=email] {
            margin-left: 1%;
            margin-right: 2%;
            margin-bottom: 3%;
        }
        textarea {
            margin-left: 1%;
        }
        
    </style>
    <script>
        window.onload = function(elEvento) {
            var evento = elEvento || window.event;
            document.forms["registro"].onsubmit = comprobarDatos;
        }

        function comprobarDatos(elEvento) {

            var evento = elEvento || window.event;

            var valorNombre = document.forms["registro"].elements["name"].value.trim();
            var valorApellidos = document.forms["registro"].elements["apellidos"].value.trim();
            var valorUser = document.forms["registro"].elements["user"].value.trim();
            var valorPwd = document.forms["registro"].elements["pwd"].value.trim();
            var valorEmail = document.forms["registro"].elements["email"].value.trim().toLowerCase();

            var error = false;
            var cadenaError = "";

            if (evento.type == "submit") {
                if (valorNombre == "") {
                    cadenaError += "<li> El campo Nombre es obligatorio</li>";
                    document.forms["registro"].elements["nombre"].className = "Error";
                }
                if (valorApellidos == "") {
                    cadenaError += "<li> El campo Apellidos es obligatorio</li>";
                    document.forms["registro"].elements["apellidos"].className = "Error";
                }
                if (valorUser == "") {
                    cadenaError += "<li> El campo Nombre de usuario es obligatorio</li>";
                    document.forms["registro"].elements["user"].className = "Error";
                }
                if (valorPwd == "") {
                    cadenaError += "<li> El campo Contraseña es obligatorio</li>";
                    document.forms["registro"].elements["pwd"].className = "Error";
                }
                if (valorEmail == "") {
                    cadenaError += "<li> El campo Email es obligatorio</li>";
                    document.forms["registro"].elements["email"].className = "Error";
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
</head>

<body>

    <main>
        <div class="container">
            <form method="POST" action="index.php?ctl=registro" name="registro" enctype="multipart/form-data">
                <fieldset id="campoFieldset">
                    <legend>¡Regístrate!</legend>
                    <div class="uno">
                        <label for="name"> Nombre: *</label>
                        <input type="text" name="name" id="name">
                        <label for="apellidos">Apellidos: *</label>
                        <input type="text" name="apellidos" id="apellidos">
                        <div class="dos">
                            <label for="usuario">Nombre de usuario: *</label>
                            <input type="text" name="user" id="user">
                            <label for="pwd">Contraseña: *</label>
                            <input type="password" name="pwd" id="pwd">
                        </div>
                        <div class="tres">
                            <label for="email">Email: *</label>
                            <input type="email" name="email" id="email">
                        </div>
                        <div class="cuatro">
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
                        <input type="submit" name="enviar" value="Enviar">
                    </div>
                    <p>¿Ya tienes una cuenta? Inicia sesión <a href="index.php?ctl=login">aquí.</a></p>
                </fieldset>
                <div id="errores"></div>

            </form>

        </div>
    </main>
</body>

<?php $contenido = ob_get_clean() ?>
<?php include __DIR__ . '/../layout.php' ?>