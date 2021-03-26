<?php ob_start() ?>

<div class="row">

<h3> Ha habido un error </h3>

</div>
<?php $contenido = ob_get_clean() ?>

<?php include __DIR__ . '/../layout.php' ?>