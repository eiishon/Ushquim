<?php ob_start() ?>
<br/>
<form name="inicioSesion" action="index.php?ctl=login" method="POST">
<table>
<tr>
<th>Usuario</th>
<th>Contraseña</th>
</tr>
<tr>
<td><input type="text" name="user" value="<?php  $user ?>" /></td>
<td><input type="password" name="pwd" value="<?php  $pwd ?>" /></td>
</tr>

</table>
<input type="submit" value="Enviar" name="enviar" />
</form>

<?php $contenido = ob_get_clean() ?>
<?php include __DIR__.'/../layout.php' ?>