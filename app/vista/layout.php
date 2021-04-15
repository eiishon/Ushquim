<!DOCTYPE html>
<html>

<head>
    <title>Ushquim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>

    <!-- USO BOOTSTRAP 
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php?ctl=inicio">inicio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php?ctl=recetas">Recetas</a>
        </li>
        <?php
        /*if ($_SESSION['user_lvl'] == 0) {
            ?>
        <li class="nav-item">
          <a class="nav-link" href="index.php?ctl=registro">Registro</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?ctl=login">Inicio Sesión</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?ctl=cerrarsesion">Cerrar sesion </a>
        </li>
        <?php
        } else {
          if ($_SESSION['user_lvl'] >= 1){
             
               
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           <?php  echo $_SESSION['user']; ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="index.php?ctl=perfil">Mi Perfil</a></li>
            <?php 
                            if($_SESSION['user_lvl'] == 2){ ?>
                            <li><a class="dropdown-item" href="index.php?ctl=gestion">Gestión</a></li>
                            <?php
                            }
                        ?>
            <li><a class="dropdown-item" href="index.php?ctl=editar_perfil">Editar perfil</a></li>
            <li><a class="dropdown-item" href="index.php?ctl=subir_recetas">Subir recetas</a></li>
            <li><a class="dropdown-item" href="index.php?ctl=guardados">Recetas guardadas</a></li>
            <li><a class="dropdown-item" href="index.php?ctl=cerrarsesion">Cerrar sesión</a></li>

          </ul>
        </li>
      </span>

      <?php 
                }
              }
            */
            ?>
    </div>
  </div>
</nav> -->



    <!-- SIN BOOTSTRAP -->
        <nav>
            <a href="index.php?ctl=inicio">inicio</a>
            <a href="index.php?ctl=recetas">recetas</a>
            <?php
            if ($_SESSION['user_lvl'] == 0) {
                echo '<a href="index.php?ctl=registro">registro</a>';
                echo '<a href="index.php?ctl=login">inicia sesión</a>';
            } else {
                if ($_SESSION['user_lvl'] >= 1) {
                  echo $_SESSION['user']; 
            ?>
                    <ul>
                        <li><a href="index.php?ctl=perfil">Ver perfil</a></li>
                        <li><a href="index.php?ctl=editar_perfil">Editar perfil</a></li>
                        <li><a href="index.php?ctl=subir_recetas">Subir recetas</a></li>
                        <li><a href="index.php?ctl=guardados">Recetas guardadas</a></li>
                        <li><a href="index.php?ctl=cerrarsesion">Cerrar Sesión</a></li>
                        <?php 
                           if($_SESSION['user_lvl'] == 2){ ?>
                                <li><a href="index.php?ctl=gestion">Gestionar recetas</a></li>
                                <?php
                            }
                        ?>
                        ?>
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