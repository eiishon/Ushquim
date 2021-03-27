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
    
    try {
        $user = "";
        $pwd = "";
        if(isset($_POST['enviar'])){
            $user = recoge('user');
            $pwd = recoge('pwd');
        }
        $db = new Model();
        $resultado = "";
        if ($resultado == $db->getLogin($user, $pwd)) {
            if($_SESSION['nivel_usuario'] == 1){
                echo ('LVL USUARIO 1');
                session_regenerate_id(true);
                require __DIR__.'/../vista/paginas/inicio.php';
            }

        } 
    } catch (Exception $e) {
        error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logException.txt");
        header('Location: index.php?ctl=error');
    } catch (Error $e) {
        error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
        header('Location: index.php?ctl=error');
    }
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