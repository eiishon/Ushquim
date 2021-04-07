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
    try{
    $name = "";
    $apellidos = "";
    $user = "";
    $pwd = "";
    $email = "";
    $bio = "";

    $errores = [];
    $pattern = "/^[a-zÃ±0-9*_+\-\$&\/\\\]+$/i";
        if(isset($_POST['enviar'])){
            $name = recoge('name');
            $apellidos = recoge('apellidos');
            $user = recoge('user');
            $pwd = recoge('pwd');
            $email = recoge('email');
            $bio = recoge('bio');

            //COMPROBAR QUE CAMPOS NO VACIOS Y VALIDAR DATOS
            if(!empty($name)){
                cName($name, $errores);
            } else {
                $errores[] = "* El campo nombre es obligatorio. <br>";
            }

            if(!empty($apellidos)){
                cText($apellidos, $errores);
            } else {
                $errores[] = "* El campo apellidos es obligatorio.<br>";
            }
            if(!empty($user)){
                validoPatron($pattern, $user, $errores);
            } else{
                $errores[] = "* El campo usuario es obligatorio.<br>";
            }
            if(!empty($pwd)){
                validoPatron($pattern, $pwd, $errores);
            } else{
                $errores[] = "* El campo contraseña es obligatorio.<br>";
            }
            if(!empty($email)){
                validoEmail($email, $errores);
            } else{
                $errores[] = "* El campo email es obligatorio.<br>";
            }
            if(!empty($bio)){
                cText($bio, $errores);
            }
            //FOTO DE PERFIL RECOGER Y MOVER
            $rutaPFP = __DIR__."/app/vista/paginas/img/pfp";
            $extensionesValidas=["image/jpeg","image/gif"];
            if(isset($_FILES["pfp"]) && !empty($_FILES["pfp"])){
                $file = cfile("pfp", $rutaPFP, $extensionesValidas, $errores);   
            }
            $_FILES["pfp"]["name"] =  $user.".jpg";
            $origen = $_FILES["pfp"]['tmp_name'];
            $destino = $rutaPFP.$_FILES["pfp"]["name"];
            move_uploaded_file($origen, $destino);

        }
        //LO PASAMOS A EJECUTAR AL MODELO
        $db = new Model();
        $resultado = $db->setRegistro($name, $apellidos, $user, $pwd, $email, $bio, $destino);

    }catch (Exception $e) {
        error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logException.txt");
        header('Location: index.php?ctl=error');
    } catch (Error $e) {
        error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
        header('Location: index.php?ctl=error');
    }
    try{
        $gluten = 0;
        $crustaceos = 0;
        $huevos = 0;
        $pescado = 0;
        $cacahuetes = 0;
        $soja = 0;
        $lactosa = 0;
        $frutosdecascara = 0;
        $apio = 0;
        $mostaza = 0;
        $sesamo = 0;
        $sulfitos = 0;
        $moluscos = 0;
        $altramuces = 0;
        $vegan = 0;
        $vegetarian = 0;
        
        $db = new Model();
        $idUser = $db->getIdUser($user);
        $resultadoAlergenos = $db->setAlergenos($gluten, $crustaceos, $huevos, $pescado, $cacahuetes, $soja,
        $lactosa, $frutosdecascara, $apio, $mostaza, $sesamo, $sulfitos, $moluscos, $altramuces, $vegan, $vegetarian,
        $idUser);

    }catch (Exception $e) {
        error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logException.txt");
        header('Location: index.php?ctl=error');
    } catch (Error $e) {
        error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
        header('Location: index.php?ctl=error');
    }
    if($resultado && $resultadoAlergenos){
        $contenido = 'Se ha registrado correctamente. <a href="index.php?ctl=inicio">Volver al inicio.</a>';
    }

    require __DIR__ .'/../vista/paginas/registro.php';
}

public function login()
{
    require __DIR__ .'/../vista/paginas/login.php';
    
    try {
        $user = "";
        $pwd = "";
        if(isset($_POST['enviar'])){
            $user = recoge('user');
            $pwd = recoge('pwd');
            
        
        $db = new Model();
        $resultado = $db->getLogin($user, $pwd);
        if ($resultado == true) {
                $_SESSION['user_lvl'] = 1;
                $_SESSION['user'] = $user;
                echo $_SESSION['user'];
                echo $_SESSION['user_lvl'];
                session_regenerate_id(true);
        } 
    } 
        
    } catch (Exception $e) {
        error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logException.txt");
        header('Location: index.php?ctl=error');
    } catch (Error $e) {
        error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
        header('Location: index.php?ctl=error');
    }
    
    
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
