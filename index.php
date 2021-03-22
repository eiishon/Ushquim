<?php
require_once __DIR__.'/app/mvc/Config.php';
require_once __DIR__.'/app/mvc/Model.php';
require_once __DIR__.'/app/mvc/Controller.php';
session_start();
$_SESSION['user_lvl'] = 0;

$map = array(
      'inicio' => array('controller' => 'Controller', 'action' => 'inicio', 'user_lvl' => 0),
      'recetas' => array('controller' => 'Controller', 'action' => 'recetas', 'user_lvl' => 0),
      'subir_recetas' => array('controller' => 'Controller', 'action' => 'subir_recetas', 'user_lvl' => 1),
      'registro' => array('controller' => 'Controller', 'action' => 'registro', 'user_lvl' => 0),
      'login' => array('controller' => 'Controller', 'action' => 'login', 'user_lvl' => 0),
      'perfil' => array('controller' => 'Controller', 'action' => 'perfil', 'user_lvl' => 1),
      'editar_perfil' => array('controller' => 'Controller', 'action' => 'editar_perfil', 'user_lvl' => 1),
      'guardados' => array('controller' => 'Controller', 'action' => 'guardados', 'user_lvl' => 1),
      'cerrarsesion' => array('controller' => 'Controller', 'action' => 'cerrarsesion', 'user_lvl' => 1),
      'error' => array('controller' => 'Controller', 'action' => 'error', 'user_lvl' => 0),
      'gestion' => array('controller' => 'Controller', 'action' => 'gestion', 'user_lvl' => 2)
);

//PARSEO RUTA
if(isset($_GET['ctl'])){
    if(isset($map[$_GET['ctl']])){
        $ruta = $_GET['ctl'];
    }
    else{
        header('Status: 404 Not Found');
        echo '<html><body><h1>Error 404: No existe la ruta <i>'.$_GET['ctl'].'</i> </h1></body></html>';
        exit;
    }
} else{
    $ruta = 'inicio';
}
$controlador = $map[$ruta];

if (method_exists($controlador['controller'],$controlador['action'])) {
    call_user_func(array(new $controlador['controller'],
        $controlador['action']));
} else {
    header('Status: 404 Not Found');
    echo '<html><body><h1>Error 404: El controlador <i>' .
        $controlador['controller'] .
        '->' .
        $controlador['action'] .
        '</i> no existe</h1></body></html>';
}
?>