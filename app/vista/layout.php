<!DOCTYPE html>
<html>

<head>
  <title>Ushquim</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="css/styles.css">
</head>

<body style="background-color: rgba(234, 240, 232, 0.3);">

  <!-- USO BOOTSTRAP  -->
  <header class="p-3" style="background-color: rgba(167, 195, 155, 0.8);">
    <div class="container-fluid">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
            <use xlink:href="#bootstrap" />
          </svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 link-dark">
          <li><a href="index.php?ctl=inicio" class="nav-link px-2" style="color: #2C5919;">Inicio</a></li>
          <li><a href="index.php?ctl=recetas" class="nav-link px-2" style="color: #2C5919;">Recetas</a></li>
        </ul>
        <div class="text-end">
          <?php
          if ($_SESSION['user_lvl'] == 0) {
          ?>
            <a type="button" class="btn" href="index.php?ctl=login" style="color: #2C5919;">Inicio sesión</a>
            <a type="button" class="btn" href="index.php?ctl=registro" style="color: #EAF0E8; background-color: rgb(95, 139, 76);">Registro</a>
            <?php
          } else {
            if ($_SESSION['user_lvl'] >= 1) {


            ?>
              <div class="dropdown text-end">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false"style="color: #2C5919;">
                  <?php echo $_SESSION['user']; ?>
                </a>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1" style="background-color: rgba(206, 223, 199, 0.8);">
                  <li><a class="dropdown-item" href="index.php?ctl=perfil" style="color: #2C5919;">Mi perfil</a></li>
                  <?php
                  if ($_SESSION['user_lvl'] == 2) { ?>
                    <li><a class="dropdown-item" href="index.php?ctl=gestion" style="color: #2C5919;">Gestión</a></li>
                  <?php
                  }
                  ?>
                  <li><a class="dropdown-item" href="index.php?ctl=editar_perfil" style="color: #2C5919;">Editar perfil</a></li>
                  <li><a class="dropdown-item" href="index.php?ctl=subir_recetas" style="color: #2C5919;">Subir recetas</a></li>
                  <li><a class="dropdown-item" href="index.php?ctl=guardados" style="color: #2C5919;">Recetas guardadas</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="index.php?ctl=cerrarsesion" style="color: #2C5919;">Cerrar sesión</a></li>

                </ul>
                </li>
                </span>

            <?php
            }
          }

            ?>

              </div>
        </div>
      </div>
  </header>




  </header>
  <div id="contenido">
    <?php echo $contenido ?>
  </div>
  <footer class="bg-light text-center text-lg-start">
    <!--<div class="text-center p-3" style="background-color: rgba(128, 165, 112, 0.8);">-->
    <div class="text-center p-3" style="background-color: rgba(167, 195, 155, 0.8);">
      <p style="color: #2C5919;">Ushquim. 2021</p>
    </div>
  </footer>
</body>

</html>