<?php
include ('validar/validate.php');
class Controller
{
public function inicio()
{
    require __DIR__.'/../vista/paginas/inicio.php';
}
public function error()
{
    require __DIR__ .'/../vista/paginas/error.php';
}
public function registro()
{
    require __DIR__ .'/../vista/paginas/registro.php';
}

public function login()
{
    require __DIR__ .'/../vista/paginas/login.php';
}

public function cerrarsesion()
{
    require __DIR__ .'/../vista/paginas/cerrarsesion.php';
}

public function editar_perfil()
{
    require __DIR__ .'/../vista/paginas/editar_perfil.php';
}

public function gestion()
{
    require __DIR__ .'/../vista/paginas/gestion.php';
}
public function guardados()
{
    require __DIR__ .'/../vista/paginas/guardados.php';
}
public function perfil()
{
    require __DIR__ .'/../vista/paginas/perfil.php';
}
public function recetas()
{
    require __DIR__ .'/../vista/paginas/recetas.php';
}
public function subir_recetas()
{
    require __DIR__ .'/../vista/paginas/subir_recetas.php';
}
}

?>