<?php ob_start();
session_destroy();

if($_SESSION["user_lvl"] >= 1){
    $contenido = 'Ha cerrado sesión correctamente. <a href="index.php?ctl=inicio">Volver al inicio.</a>';
}else{
    $contenido = 'No se ha podido cerrar sesión. <a href="index.php?ctl=cerrarsesion">Volver a intentarlo.</a>';
}

?>


<?php $content = ob_get_clean() ?>
<?php include __DIR__.'/../layout.php' ?>