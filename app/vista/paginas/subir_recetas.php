<?php ob_start() ?>
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
        input[type=number],
        input[type=file] {
            margin-left: 1%;
            margin-right: 2%;
            margin-bottom: 3%;
        }
        textarea {
            margin-left: 1%;
            margin-bottom: 3%;
        }
        .alergias{
          padding-bottom: 2%;
        }
</style>
<script>
  window.onload = function(elEvento) {
    var evento = elEvento || window.event;
    document.forms["subir_recetas"].onsubmit = comprobarDatos;
  }

  function comprobarDatos(elEvento) {

    var evento = elEvento || window.event;

    var valorNomReceta = document.forms["subir_recetas"].elements["nomReceta"].value.trim();
    var valorTPrep = document.forms["subir_recetas"].elements["tPrep"].value.trim();
    var valorIngredientes = document.forms["subir_recetas"].elements["ingredientes"].value.trim();
    var valorReceta = document.forms["subir_recetas"].elements["receta"].value.trim();

    var error = false;
    var cadenaError = "";
    if (valorNomReceta == "") {
      cadenaError += "<li> El campo Título de la receta es obligatorio</li>";
      document.forms["subir_recetas"].elements["nomReceta"].className = "Error";
    }
    if (valorTPrep == "") {
      cadenaError += "<li> El campo Tiempo de preparación es obligatorio</li>";
      document.forms["subir_recetas"].elements["tPrep"].className = "Error";
    }
    if (valorIngredientes == "") {
      cadenaError += "<li> El campo Ingredientes es obligatorio</li>";
      document.forms["subir_recetas"].elements["ingredientes"].className = "Error";
    }
    if (valorReceta == "") {
      cadenaError += "<li> El campo Cuerpo de la receta es obligatorio</li>";
      document.forms["subir_recetas"].elements["receta"].className = "Error";
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
<body>
    <main>
        <div class="container">
            <form method="POST" action="index.php?ctl=subir_recetas" name="subir_recetas" enctype="multipart/form-data">
                <fieldset>
                    <legend>¡Sube tu receta aquí!</legend>
                    <label for="nomReceta">Título de la receta</label>
                    <input type="text" name="nomReceta" id="nomReceta" required><br>
                    <label for="tPrep">Tiempo preparación (en minutos)</label>
                    <input type="number" name="tPrep" id="tPrep" required><br>
                    <label for="ingredientes">Ingredientes</label><br>
                   <textarea name="ingredientes" id="" cols="30" rows="12" required></textarea>
                   <br>
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
                        </div><div class="pref">
                        <label for="alergias">Preferencias alimenticias: </label><br>
                        <input type="checkbox" id="vegan" name="vegan" value="vegan">
                            <label for="vegan">Vegano</label>
                            <input type="checkbox" id="vegetarian" name="vegetarian" value="vegetarian">
                            <label for="vegetarian">Vegetariano</label>
                        </div>
                <label for="receta">Cuerpo de la receta</label><br>
                <textarea name="receta" id="" cols="100" rows="15" required></textarea><br>
                <label for="fotosreceta">Fotos de la receta</label>
                <div class="file">
                <input type="file" name="fotosreceta" id="fotosreceta" multiple></div>
                <input type="submit" name="enviar" value="Enviar">
               </fieldset>
               <div id="errores"></div>
            </form>
        </div>
    </main>
</body>

<?php $contenido = ob_get_clean() ?>
<?php include __DIR__.'/../layout.php' ?>
