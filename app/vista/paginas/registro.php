<?php ob_start() ?>

<body>
    <main>
        <div class="container">
            <form method="POST" action="index.php?ctl=registro" name="registro" enctype="multipart/form-data">
                <fieldset>
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
                            <label for="bio">Cuéntanos un poco sobre ti:</label>
                            <textarea id="bio" name="bio" rows="4" cols="40"></textarea>
                        <label for="pfp">Sube una foto de perfil:</label>
                        <input type="file" id="pfp" name="pfp"> <br>
                        </div>
                        <label for="alergias">Alergias: </label>
                        <div class="al">
                            <input type="checkbox" id="gluten" name="alergias[]" value="gluten">
                            <label for="gluten">Gluten</label>
                            <input type="checkbox" id="crustaceos" name="alergias[]" value="crustaceos">
                            <label for="crustaceos">Crustáceos</label>
                            <input type="checkbox" id="huevos" name="alergias[]" value="huevos">
                            <label for="huevos">Huevos</label>
                            <input type="checkbox" id="pescado" name="alergias[]" value="pescado">
                            <label for="pescado">Pescado</label>
                            <input type="checkbox" id="cacahuetes" name="alergias[]" value="cacahuetes">
                            <label for="cacahuetes">Cacahuetes</label>
                            <input type="checkbox" id="soja" name="alergias[]" value="soja">
                            <label for="soja">Soja</label>
                            <input type="checkbox" id="lactosa" name="alergias[]" value="lactosa">
                            <label for="lactosa">Lactosa</label>
                        </div>
                        <div class="al">
                            <input type="checkbox" id="frutosdecascara" name="alergias[]" value="frutosdecascara">
                            <label for="frutosdecascara">Frutos de cáscara</label>
                            <input type="checkbox" id="apio" name="alergias[]" value="apio">
                            <label for="apio">Apio</label>
                            <input type="checkbox" id="mostaza" name="alergias[]" value="mostaza">
                            <label for="mostaza">Mostaza</label>
                            <input type="checkbox" id="sesamo" name="alergias[]" value="sesamo">
                            <label for="sesamo">Sésamo</label>
                            <input type="checkbox" id="sulfitos" name="alergias[]" value="sulfitos">
                            <label for="sulfitos">Sulfitos</label>
                            <input type="checkbox" id="moluscos" name="alergias[]" value="moluscos">
                            <label for="moluscos">Moluscos</label>
                            <input type="checkbox" id="altramuces" name="alergias[]" value="altramuces">
                            <label for="altramuces">Altramuces</label>
                        </div>
                        <label for="alergias">Preferencias alimenticias: </label>
                        <input type="checkbox" id="vegan" name="alergias[]" value="vegan">
                            <label for="vegan">Vegano</label>
                            <input type="checkbox" id="vegetarian" name="alergias[]" value="vegetarian">
                            <label for="vegetarian">Vegetariano</label>
                        </div>
                        <div class="button">
                            <input type="submit" name="enviar" value="Enviar">
                        </div>
                        <p>¿Ya tienes una cuenta? Inicia sesión <a href="index.php?ctl=login">aquí.</a></p>
                </fieldset>
            </form>
        </div>
    </main>
</body>

<?php $contenido = ob_get_clean() ?>
<?php include __DIR__ . '/../layout.php' ?>