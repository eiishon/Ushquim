<?php ob_start() ?>
<h1>Gestión de Recetas </h1>

<?php $contenido = ob_get_clean() ?>
<?php include __DIR__.'/../layout.php' ?>
