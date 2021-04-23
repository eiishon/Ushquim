<?php ob_start() ?>

<div class="row">

<h3> <?php echo $_SESSION['mensajeError'] ?> </h3>

</div>
<?php $contenido = ob_get_clean() ?>

<?php include __DIR__ . '/../layout.php' ?>