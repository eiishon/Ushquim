<?php ob_start();

if($_SESSION['user_lvl'] >= 1) {
    
    session_destroy();
    header('Location: index.php?ctl=inicio');
}else{
    $_SESSION['mensajeError'] = 'No se ha podido cerrar sesión. <a href="index.php?ctl=cerrarsesion">Volver a intentarlo.</a>';
    header('Location: index.php?ctl=error');
}

?>


<?php $content = ob_get_clean() ?>
<?php include __DIR__.'/../layout.php' ?>