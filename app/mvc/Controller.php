<?php
include('validar/validate.php');
class Controller
{
    public function inicio()
    {
        require __DIR__ . '/../vista/paginas/inicio.php';
    }
    public function error()
    {
        require __DIR__ . '/../vista/paginas/error.php';
    }
    public function registro()
    {
        try {
            $name = "";
            $apellidos = "";
            $user = "";
            $pwd = "";
            $email = "";
            $bio = "";
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
            $cont = 0;
            $errores = [];
            $pattern = "/^[a-zÃ±0-9*_+\-\$&\/\\\]+$/i";
            if (isset($_POST['enviar'])) {
                $name = recoge('name');
                $apellidos = recoge('apellidos');
                $user = recoge('user');
                $pwd = recoge('pwd');
                $email = recoge('email');
                $bio = recoge('bio');
                //COMPROBAR QUE CAMPOS NO VACIOS Y VALIDAR DATOS
                if (!empty($name)) {
                    cName($name, $errores);
                } else {
                    $errores[] = "* El campo nombre es obligatorio. <br>";
                }

                if (!empty($apellidos)) {
                    cText($apellidos, $errores);
                } else {
                    $errores[] = "* El campo apellidos es obligatorio.<br>";
                }
                if (!empty($user)) {
                    validoPatron($pattern, $user, $errores);
                } else {
                    $errores[] = "* El campo usuario es obligatorio.<br>";
                }
                if (!empty($pwd)) {
                    validoPatron($pattern, $pwd, $errores);
                } else {
                    $errores[] = "* El campo contraseña es obligatorio.<br>";
                }
                if (!empty($email)) {
                    validoEmail($email, $errores);
                } else {
                    $errores[] = "* El campo email es obligatorio.<br>";
                }
                if (!empty($bio)) {
                    cText($bio, $errores);
                }

                //ALERGENOS
                if (isset($_POST['gluten'])) {
                    $gluten = 1;
                    $cont++;
                }
                if (isset($_POST['crustaceos'])) {
                    $crustaceos = 1;
                    $cont++;
                }
                if (isset($_POST['huevos'])) {
                    $huevos = 1;
                    $cont++;
                }
                if (isset($_POST['pescado'])) {
                    $pescado = 1;
                    $cont++;
                }
                if (isset($_POST['cacahuetes'])) {
                    $cacahuetes = 1;
                    $cont++;
                }
                if (isset($_POST['soja'])) {
                    $soja = 1;
                    $cont++;
                }
                if (isset($_POST['lactosa'])) {
                    $lactosa = 1;
                    $cont++;
                }
                if (isset($_POST['frutosdecascara'])) {
                    $frutosdecascara = 1;
                    $cont++;
                }
                if (isset($_POST["apio"])) {
                    $apio = 1;
                    $cont++;
                }
                if (isset($_POST["mostaza"])) {
                    $mostaza = 1;
                    $cont++;
                }
                if (isset($_POST["sesamo"])) {
                    $sesamo = 1;
                    $cont++;
                }
                if (isset($_POST["sulfitos"])) {
                    $sulfitos = 1;
                    $cont++;
                }
                if (isset($_POST["moluscos"])) {
                    $moluscos = 1;
                    $cont++;
                }
                if (isset($_POST["altramuces"])) {
                    $altramuces = 1;
                    $cont++;
                }
                if (isset($_POST["vegan"])) {
                    $vegan = 1;
                    $cont++;
                }
                if (isset($_POST["vegetarian"])) {
                    $vegetarian = 1;
                    $cont++;
                }
                if ($cont == 0) {
                    $errores[] = "* Al menos debes marcar una alergia o preferencia alimenticia.";
                }

                //FOTO DE PERFIL RECOGER Y MOVER
                $rutaPFP = __DIR__ . "/app/vista/paginas/img/pfp/";
                $extensionesValidas = ["image/jpeg", "image/gif"];
                if (isset($_FILES["pfp"]) && !empty($_FILES["pfp"])) {
                    $file = cfile("pfp", $rutaPFP, $extensionesValidas, $errores);
                    $_FILES["pfp"]["name"] =  $user . ".jpg";
                    $origen = $_FILES["pfp"]['tmp_name'];
                    $destino = $rutaPFP . $_FILES["pfp"]["name"];
                    move_uploaded_file($origen, $destino);
                }


                //LO PASAMOS A EJECUTAR AL MODELO
                $db = new Model();
                $resultado = $db->setRegistro($name, $apellidos, $email, $user, $pwd, $bio, $destino);
                if ($resultado) {
                    $_SESSION['user'] = $user;
                    $idUser = $db->getIdUser($user);
                    $_SESSION['idUser'] =$idUser;
                    $idUser = $_SESSION["idUser"];
                    $resultadoAlergenos = $db->setAlergenos(
                        $gluten,
                        $crustaceos,
                        $huevos,
                        $pescado,
                        $cacahuetes,
                        $soja,
                        $lactosa,
                        $frutosdecascara,
                        $apio,
                        $mostaza,
                        $sesamo,
                        $sulfitos,
                        $moluscos,
                        $altramuces,
                        $vegan,
                        $vegetarian,
                        $idUser
                    );
                    if($resultadoAlergenos){
                        $contenido = 'Se ha registrado correctamente. <a href="index.php?ctl=inicio">Volver al inicio.</a>';
                    }
                }else{
                    $_SESSION['mensajeError'] = "Ha habido un fallo a la hora de registrarse";
                    throw new Exception("Ha habido un fallo a la hora de registrarse");
                }
            }
        } catch (Exception $e) {
            $_SESSION['mensajeError'] = error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            $_SESSION['mensajeError'] = error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }



        require __DIR__ . '/../vista/paginas/registro.php';
    }

    public function login()
    {
        require __DIR__ . '/../vista/paginas/login.php';

        try {
            $user = "";
            $pwd = "";
            if (isset($_POST['enviar'])) {
                $user = recoge('user');
                $pwd = recoge('pwd');


                $db = new Model();
                $resultado = $db->getLogin($user, $pwd);
                if ($resultado === true) {
                    $esAdmin = $db->getAdmin($user);
                    if($esAdmin == 1){
                        $_SESSION['user_lvl'] = 2;
                    } else{
                        $_SESSION['user_lvl'] = 1;
                    }
                    $_SESSION['user'] = $user;
                    $idUser = $db->getIdUser($user);
                    $_SESSION['idUser'] = $idUser;
                    session_regenerate_id(true);
                    header('Location: index.php?ctl=inicio');
                } else {
                    $_SESSION['mensajeError']='El usuario o contraseña no son correctos';
                	throw new Exception("El usuario o contraseña no son correctos");
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
        require __DIR__ . '/../vista/paginas/cerrarsesion.php';
    }

    public function editar_perfil()
    {
        require __DIR__ . '/../vista/paginas/editar_perfil.php';
    }

    public function gestion()
    {
        require __DIR__ . '/../vista/paginas/gestion.php';
    }
    public function guardados()
    {
        require __DIR__ . '/../vista/paginas/guardados.php';
    }
    public function perfil()
    {
        require __DIR__ . '/../vista/paginas/perfil.php';
    }
    public function recetas()
    {
        require __DIR__ . '/../vista/paginas/recetas.php';
    }
    public function subir_recetas()
    {
        require __DIR__ . '/../vista/paginas/subir_recetas.php';
        try {
            $nomReceta = "";
            $tPrep = "";
            $ingredientes = "";
            $receta = "";
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
            $cont = 0;
            $fecha_subida = date("d  M  Y  H:i");
            $idUser = "";
            $errores = [];
            if (isset($_POST['enviar'])) {
                $nomReceta = recoge('nomReceta');
                $ingredientes = recoge('ingredientes');
                $receta = recoge('receta');
                if (!empty($nomReceta)) {
                    cName($nomReceta, $errores);
                } else {
                    $errores[] = "* El campo título de la receta es obligatorio. <br>";
                }
                if (empty($ingredientes)) {
                    $errores[] = "* El campo ingredientes es obligatorio. <br>";
                }

                if (empty($receta)) {
                    $errores[] = "* El campo receta es obligatorio. <br>";
                }
                if(empty($tPrep)){
                    $errores[] = "* El campo tiempo de preparación es obligatorio. <br>";
                }
                //ALERGENOS
                if (isset($_POST["gluten"])) {
                    $gluten = 1;
                    $cont++;
                }
                if (isset($_POST["crustaceos"])) {
                    $crustaceos = 1;
                    $cont++;
                }
                if (isset($_POST["huevos"])) {
                    $huevos = 1;
                    $cont++;
                }
                if (isset($_POST["pescado"])) {
                    $pescado = 1;
                    $cont++;
                }
                if (isset($_POST["cacahuetes"])) {
                    $cacahuetes = 1;
                    $cont++;
                }
                if (isset($_POST["soja"])) {
                    $lactosa = 1;
                    $cont++;
                }
                if (isset($_POST["lactosa"])) {
                    $lactosa = 1;
                    $cont++;
                }
                if (isset($_POST["frutosdecascara"])) {
                    $frutosdecascara = 1;
                    $cont++;
                }
                if (isset($_POST["apio"])) {
                    $apio = 1;
                    $cont++;
                }
                if (isset($_POST["mostaza"])) {
                    $mostaza = 1;
                    $cont++;
                }
                if (isset($_POST["sesamo"])) {
                    $sesamo = 1;
                    $cont++;
                }
                if (isset($_POST["sulfitos"])) {
                    $sulfitos = 1;
                    $cont++;
                }
                if (isset($_POST["moluscos"])) {
                    $moluscos = 1;
                    $cont++;
                }
                if (isset($_POST["altramuces"])) {
                    $altramuces = 1;
                    $cont++;
                }
                if (isset($_POST["vegan"])) {
                    $vegan = 1;
                    $cont++;
                }
                if (isset($_POST["vegetarian"])) {
                    $vegetarian = 1;
                    $cont++;
                }
                if ($cont == 0) {
                    $errores[] = "* Al menos debes marcar una alergia o preferencia alimenticia.";
                }
                                //LO PASAMOS A EJECUTAR AL MODELO
                $db = new Model();
                $idUser = "";
                $resultado = $db->setReceta($nomReceta, $receta, $tPrep, $fecha_subida, $ingredientes, $aprobada = 0,$idUser);
                $resultadoAlergenos = $db->setAlergenos(
                                    $gluten,
                                    $crustaceos,
                                    $huevos,
                                    $pescado,
                                    $cacahuetes,
                                    $soja,
                                    $lactosa,
                                    $frutosdecascara,
                                    $apio,
                                    $mostaza,
                                    $sesamo,
                                    $sulfitos,
                                    $moluscos,
                                    $altramuces,
                                    $vegan,
                                    $vegetarian,
                                    $idUser
                                );
                if ($resultado && $resultadoAlergenos) {
                                    $contenido = 'Se ha registrado correctamente la receta. <a href="index.php?ctl=inicio">Volver al inicio.</a>';
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
}
