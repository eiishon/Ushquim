<!DOCTYPE html>
<html>

<head>
    <title>Ushquim</title>
</head>

<body>
    <header>
        <nav>
            <a href="index.php?ctl=inicio">inicio</a>
            <a href="index.php?ctl=recetas">recetas</a>
            <a href="index.php?ctl=subir_recetas">subir recetas</a>
            <a href="index.php?ctl=registro">registro</a>
            <a href="index.php?ctl=login">inicia sesión</a>
            <a href="index.php?ctl=error">error</a>
        </nav>
    </header>
    <div id="contenido">
        <?php echo $contenido ?>
    </div>
    <div id="pie">
        <div align="center">- Ushquim 2021 -</div>
    </div>
</body>

</html>