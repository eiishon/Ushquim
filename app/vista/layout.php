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
            <?php

            if ($_SESSION['user_lvl'] == 0) {
                echo '<a href="index.php?ctl=registro">registro</a>';
                echo '<a href="index.php?ctl=login">inicia sesión</a>';
            } else {
                if ($_SESSION['user_lvl'] == 1) {
                    echo $user;
            ?>
                    <ul>
                        <li><a href="index.php?ctl=perfil">Ver perfil</a></li>
                        <li><a href="index.php?ctl=editar_perfil">Editar perfil</a></li>
                        <li><a href="index.php?ctl=subir_recetas">Subir recetas</a></li>
                        <li><a href="index.php?ctl=guardados">Recetas guardadas</a></li>
                        <li><a href="index.php?ctl=cerrarsesion">Cerrar Sesión</a></li>
                    </ul>
            <?php
                }
            }


            ?>
        </nav>
    </header>
    <div id="contenido">
        <?php echo $contenido ?>
    </div>
    <div id="pie">
        <div align="center">Ushquim 2021</div>
    </div>
</body>

</html>