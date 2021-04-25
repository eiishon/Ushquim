<?php ob_start() ?>
<h1><?php echo $_SESSION["user"]; ?></h1>

<?php $contenido = ob_get_clean() ?>
<?php include __DIR__.'/../layout.php' ?>
