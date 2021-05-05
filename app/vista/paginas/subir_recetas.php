<?php ob_start() ?>
<body>
    <main>
        <div class="container">
            <form method="POST" action="index.php?ctl=subir_recetas" name="subir_recetas" enctype="multipart/form-data">
                <fieldset>
                    <legend>¡Sube tu receta aquí!</legend>
                    <label for="nomReceta">Título de la receta</label>
                    <input type="text" name="nomReceta" id="nomReceta" required>
                    <label for="tPrep">Tiempo preparación</label>
                    <input type="time" name="tPrep" id="tPrep" required>
                    <label for="ingredientes">Ingredientes</label>
                   <textarea name="ingredientes" id="" cols="30" rows="10" required></textarea>
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
                <label for="receta">Cuerpo de la receta</label>
                <textarea name="receta" id="" cols="30" rows="10" required></textarea>
                <label for="fotosreceta">Fotos de la receta</label>
                <input type="file" name="fotosreceta" id="fotosreceta" multiple>
                <input type="submit" name="enviar" value="Enviar">
               </fieldset>
            </form>
        </div>
    </main>
</body>

<?php $contenido = ob_get_clean() ?>
<?php include __DIR__.'/../layout.php' ?>
