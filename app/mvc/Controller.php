<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&display=swap');

    .receta {
        margin: 2% 5% 2% 5%;
        padding: 2%;
        /*border: 1px solid;
        border-color: #2C5919;*/
        width: 90%;
        background-color: rgba(167, 195, 155, 0.4);
        border-radius: 15px 50px 30px 5px;
    }

    .info {
        font-size: small;
        text-align: right;
    }

    .fit-image {
        width: 100%;
        object-fit: cover;
        max-height: 200px;
    }

    h1,
    h3 {
        font-family: 'Akaya Kanadaka', cursive;
        color: #2C5919;
        text-align: center;
        text-shadow: 1px 1px 2px #082b34;
        padding-top: 2%;
    }

    h5,
    h6 {
        font-family: 'Akaya Kanadaka', cursive;
        color: #2C5919;
        text-shadow: 1px 1px 2px grey;
        padding-top: 1%;
    }

    .gestion {
        width: 90%;
        padding-left: 10%;
    }

    input[type=button],
    input[type=submit] {
        margin-top: 3%;
        margin-bottom: 3%;
        width: 40%;
        margin-left: 7%;
        padding: 1%;
        background-color: rgba(167, 195, 155, 0.4);
        border: none;
        border-radius: 30px 30px 30px 5px;
        font-family: 'Akaya Kanadaka', cursive;
        color: #2C5919;
    }

    .perfil {
        width: 80%;
        margin-left: 10%;
        margin-top: 5%;
        margin-bottom: 5%;
        border: 1px dotted;
        background-color: white;
    }

    .infoper {
        margin-left: 5%;
    }
</style>
<?php
include('validar/validate.php');
class Controller
{
    public function inicio()
    {
        ob_start();
        echo "<h1>Bienvenido a Ushquim </h1>";
        try {
            $db = new Model();
            $resultados = $db->getRecetas();
            $rutaIMG = "app\\mvc\\img\\recetas\\";

            if ($resultados) {
                echo "<div class=\"receta\"><div class=\"row row-cols-1 row-cols-md-2 g-4\">";
                foreach ($resultados as $resultado) {
                    $idReceta = $db->getIdReceta($resultado["receta"]);
                    $img = $db->getImg($idReceta);
                    echo "<div class=\"col\"><div class=\" card h-100\"> 

                    <img src=\"" . $rutaIMG . $img . "\" class=\"card-img-top rounded mx-auto d-block img-fluid fit-image\" alt=\"IMAGEN RECETA\">

                    <div class=\"card-body\">";
                    echo "<h3 class=\"card-title\">" . $resultado["nomReceta"] . "</h3><br><p class=\"card-text\"><div class=\"info\">";
                    echo $resultado["tPrep"] . " minutos. <br>";
                    echo "Fecha subida: " . $resultado["fecha_subida"] . "</div><br>";
                    if (
                        $resultado["gluten"] == 1 || $resultado["crustaceos"] == 1 ||
                        $resultado["huevos"] == 1 || $resultado["pescado"] == 1 ||
                        $resultado["cacahuetes"] == 1 || $resultado["soja"] == 1 ||
                        $resultado["lactosa"] == 1 || $resultado["frutosdecascara"] == 1 ||
                        $resultado["apio"] == 1 || $resultado["mostaza"] == 1 ||
                        $resultado["sesamo"] == 1 || $resultado["sulfitos"] == 1 ||
                        $resultado["moluscos"] == 1 || $resultado["altramuces"] == 1
                    ) {
                        echo "<h5>Alérgenos:</h5>";
                        if ($resultado["gluten"] == 1) {
                            echo "Gluten <br>";
                        }
                        if ($resultado["crustaceos"] == 1) {
                            echo "Crustáceos <br>";
                        }
                        if ($resultado["huevos"] == 1) {
                            echo "Huevos<br>";
                        }
                        if ($resultado["pescado"] == 1) {
                            echo "Pescado<br>";
                        }
                        if ($resultado["cacahuetes"] == 1) {
                            echo "Cacahuetes<br>";
                        }
                        if ($resultado["soja"] == 1) {
                            echo "Soja<br>";
                        }
                        if ($resultado["lactosa"] == 1) {
                            echo "Lactosa <br>";
                        }
                        if ($resultado["frutosdecascara"] == 1) {
                            echo "Frutos de cáscara<br>";
                        }
                        if ($resultado["apio"] == 1) {
                            echo "Apio<br>";
                        }
                        if ($resultado["mostaza"] == 1) {
                            echo "Mostaza<br>";
                        }
                        if ($resultado["sesamo"] == 1) {
                            echo "Sésamo<br>";
                        }
                        if ($resultado["sulfitos"] == 1) {
                            echo "Sulfitos<br>";
                        }
                        if ($resultado["moluscos"] == 1) {
                            echo "Moluscos<br>";
                        }
                        if ($resultado["altramuces"] == 1) {
                            echo "Altramuces<br>";
                        }
                    }
                    if ($resultado["vegan"] == 1 || $resultado["vegetarian"] == 1) {

                        echo "<h5>Preferencias alimenticias:</h5>";

                        if ($resultado["vegan"] == 1) {
                            echo "Vegan<br>";
                        }
                        if ($resultado["vegetarian"] == 1) {
                            echo "Vegetarian<br>";
                        }
                    }
                    echo "<h5>Ingredientes</h5>";
                    echo $resultado["ingredientes"] . "<br>";
                    echo "<h5>Preparación</h5>";
                    echo $resultado["receta"] . "<br></p></div></div></div>";
                }
                echo "</div></div>";
            }
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }
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


                if (empty($errores)) {
                    //LO PASAMOS A EJECUTAR AL MODELO
                    $db = new Model();
                    $resultado = $db->setRegistro(
                        $name,
                        $apellidos,
                        $email,
                        $user,
                        $pwd,
                        $bio,
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
                        $vegetarian
                    );

                    if ($resultado) {

                        $_SESSION['user'] = $user;
                        $idUser = $db->getIdUser($user);
                        $_SESSION['idUser'] = $idUser;
                        $idUser = $_SESSION["idUser"];
                        header('Location: index.php?ctl=login');
                    } else {
                        $_SESSION['mensajeError'] = "Ha habido un fallo a la hora de registrarse";
                        throw new Exception("Ha habido un fallo a la hora de registrarse");
                    }
                } else {
                    foreach ($errores as $error) {
                        echo $error;
                    }
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
                    if ($esAdmin == 1) {
                        $_SESSION['user_lvl'] = 2;
                    } else {
                        $_SESSION['user_lvl'] = 1;
                    }
                    $_SESSION['user'] = $user;
                    $idUser = $db->getIdUser($user);
                    $_SESSION['idUser'] = $idUser;
                    header('Location: index.php?ctl=inicio');
                } else {
                    $_SESSION['mensajeError'] = 'El usuario o contraseña no son correctos';
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
        require __DIR__ . '/../vista/paginas/login.php';
    }

    public function cerrarsesion()
    {
        require __DIR__ . '/../vista/paginas/cerrarsesion.php';
    }

    public function editar_perfil()
    {
        try {
            $name = "";
            $apellidos = "";
            $user = "";
            $pwd = "";
            $reppwd = "";
            $email = "";
            $repemail = "";
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
            $idUser = $_SESSION["idUser"];
            $db = new Model();
            //CARGAMOS PERFIL Y ASIGNAMOS INFO
            $dbname = "nomUser";
            $dbapellidos = "apUser";
            $dbemail = "email";
            $dbuser = "user";
            $dbpwd = "pwd";
            $dbbio = "bio";
            $dbgluten = "gluten";
            $dbcrustaceos = "crustaceos";
            $dbhuevos = "huevos";
            $dbpescado = "pescado";
            $dbcacahuetes = "cacahuetes";
            $dbsoja = "soja";
            $dblactosa = "lactosa";
            $dbfrutosdecascara = "frutosdecascara";
            $dbapio = "apio";
            $dbmostaza = "mostaza";
            $dbsesamo = "sesamo";
            $dbsulfitos = "sulfitos";
            $dbmoluscos = "moluscos";
            $dbaltramuces = "altramuces";
            $dbvegan = "vegan";
            $dbvegetarian = "vegetarian";

            $pattern = "/^[a-zÃ±0-9*_+\-\$&\/\\\]+$/i";
            $errores[] = "";
            if (isset($_POST['editar'])) {
                $name = recoge('name');
                $apellidos = recoge('apellidos');
                $user = recoge('user');
                $pwd = recoge('pwd');
                $reppwd = recoge('reppwd');
                $email = recoge('email');
                $repemail = recoge('repemail');
                $bio = recoge('bio');
                //COMPROBAR QUE CAMPOS NO VACIOS Y VALIDAR DATOS
                if (!empty($name)) {
                    cName($name, $errores);
                    $resultado = $db->editarPerfil($dbname, $name, $idUser);
                }

                if ($apellidos != "") {
                    cText($apellidos, $errores);
                    $resultado = $db->editarPerfil($dbapellidos, $apellidos, $idUser);
                }

                if (!empty($user)) {
                    validoPatron($pattern, $user, $errores);
                    $resultado = $db->editarPerfil($dbuser, $apellidos, $idUser);
                }
                if (!empty($pwd) && !empty($reppwd)) {
                    validoPatron($pattern, $pwd, $errores);
                    validoPatron($pattern, $reppwd, $errores);
                    if ($pwd != $reppwd) {
                        $errores[] = "La contraseñas deben coincidir. <br>";
                    } else {
                        $resultado = $db->editarPerfil($dbpwd, $pwd, $idUser);
                    }
                } elseif ((!empty($pwd) && empty($reppwd)) || (empty($pwd) && !empty($reppwd))) {
                    $errores[] = " Debes repetir la contraseña. <br>";
                }



                if (!empty($email) && !empty($repemail)) {
                    validoEmail($email, $errores);
                    validoEmail($repemail, $errores);
                    if ($email != $repemail) {
                        $errores[] = "Los emails deben coincidir. <br>";
                    } else {
                        $resultado = $db->editarPerfil($dbemail, $email, $idUser);
                    }
                } elseif ((!empty($email) && empty($repemail)) || (empty($email) && !empty($repemail))) {
                    $errores[] = "Debes repetir el email.<br>";
                }



                if (!empty($bio)) {
                    $resultado = $db->editarPerfil($dbbio, $bio, $idUser);
                }

                //ALERGENOS
                if (isset($_POST['gluten'])) {
                    $resultado = $db->editarPerfil($dbgluten, $gluten, $idUser);
                }
                if (isset($_POST['crustaceos'])) {
                    $resultado = $db->editarPerfil($dbcrustaceos, $crustaceos, $idUser);
                }
                if (isset($_POST['huevos'])) {
                    $resultado = $db->editarPerfil($dbhuevos, $huevos, $idUser);
                }
                if (isset($_POST['pescado'])) {
                    $resultado = $db->editarPerfil($dbpescado, $pescado, $idUser);
                }
                if (isset($_POST['cacahuetes'])) {
                    $resultado = $db->editarPerfil($dbcacahuetes, $cacahuetes, $idUser);
                }
                if (isset($_POST['soja'])) {
                    $resultado = $db->editarPerfil($dbsoja, $soja, $idUser);
                }
                if (isset($_POST['lactosa'])) {
                    $resultado = $db->editarPerfil($dblactosa, $lactosa, $idUser);
                }
                if (isset($_POST['frutosdecascara'])) {
                    $resultado = $db->editarPerfil($dbfrutosdecascara, $frutosdecascara, $idUser);
                }
                if (isset($_POST["apio"])) {
                    $resultado = $db->editarPerfil($dbapio, $apio, $idUser);
                }
                if (isset($_POST["mostaza"])) {
                    $resultado = $db->editarPerfil($dbmostaza, $mostaza, $idUser);
                }
                if (isset($_POST["sesamo"])) {
                    $resultado = $db->editarPerfil($dbsesamo, $sesamo, $idUser);
                }
                if (isset($_POST["sulfitos"])) {
                    $resultado = $db->editarPerfil($dbsulfitos, $sulfitos, $idUser);
                }
                if (isset($_POST["moluscos"])) {
                    $resultado = $db->editarPerfil($dbmoluscos, $moluscos, $idUser);
                }
                if (isset($_POST["altramuces"])) {
                    $resultado = $db->editarPerfil($dbaltramuces, $altramuces, $idUser);
                }
                if (isset($_POST["vegan"])) {
                    $resultado = $db->editarPerfil($dbvegan, $vegan, $idUser);
                }
                if (isset($_POST["vegetarian"])) {
                    $resultado = $db->editarPerfil($dbvegetarian, $vegetarian, $idUser);
                }

                if (empty($errores)) {
                    $_SESSION['user'] = $user;
                    header('Location: index.php?ctl=perfil');
                } else {
                    foreach ($errores as $error) {
                        echo $error;
                    }
                }
            }
            if (isset($_POST['borrar_perfil'])) {
                $db = new Model();
                $idUser = $_SESSION["idUser"];
                echo $_SESSION["idUser"];
                $resultado = $db->borrarPerfil($idUser);
                if ($resultado) {
                    header('Location: index.php?ctl=inicio');
                    session_destroy();
                }
            }
        } catch (Exception $e) {
            $_SESSION['mensajeError'] = error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            $_SESSION['mensajeError'] = error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }

        require __DIR__ . '/../vista/paginas/editar_perfil.php';
    }

    public function gestion()
    {
        ob_start();
        echo "<h1>Gestión de Recetas </h1>";
        try {

            $db = new Model();
            $resultados = $db->getRecetasNoAprobadas();
            $rutaIMG = "app\\mvc\\img\\recetas\\";
            if ($resultados) {
                echo "<div class = \"gestion\">";
                foreach ($resultados as $resultado) {
                    $idReceta = $db->getIdReceta($resultado["receta"]);
                    $img = $db->getImg($idReceta);
                    echo "<div class=\"col\"><div class=\" card h-300\"> 

                    <img src=\"" . $rutaIMG . $img . "\" class=\"card-img-top rounded mx-auto d-block img-fluid fit-image\" alt=\"IMAGEN RECETA\">

                    <div class=\"card-body \">";
                    echo "<h3 class=\"card-title\">" . $resultado["nomReceta"] . "</h3><br><p class=\"card-text\"><div class=\"info\">";
                    echo $resultado["tPrep"] . " minutos. <br>";
                    echo "Fecha subida: " . $resultado["fecha_subida"] . "</div><br>";
                    if (
                        $resultado["gluten"] == 1 || $resultado["crustaceos"] == 1 ||
                        $resultado["huevos"] == 1 || $resultado["pescado"] == 1 ||
                        $resultado["cacahuetes"] == 1 || $resultado["soja"] == 1 ||
                        $resultado["lactosa"] == 1 || $resultado["frutosdecascara"] == 1 ||
                        $resultado["apio"] == 1 || $resultado["mostaza"] == 1 ||
                        $resultado["sesamo"] == 1 || $resultado["sulfitos"] == 1 ||
                        $resultado["moluscos"] == 1 || $resultado["altramuces"] == 1
                    ) {
                        echo "<h5>Alérgenos:</h5>";
                        if ($resultado["gluten"] == 1) {
                            echo "Gluten <br>";
                        }
                        if ($resultado["crustaceos"] == 1) {
                            echo "Crustáceos <br>";
                        }
                        if ($resultado["huevos"] == 1) {
                            echo "Huevos<br>";
                        }
                        if ($resultado["pescado"] == 1) {
                            echo "Pescado<br>";
                        }
                        if ($resultado["cacahuetes"] == 1) {
                            echo "Cacahuetes<br>";
                        }
                        if ($resultado["soja"] == 1) {
                            echo "Soja<br>";
                        }
                        if ($resultado["lactosa"] == 1) {
                            echo "Lactosa <br>";
                        }
                        if ($resultado["frutosdecascara"] == 1) {
                            echo "Frutos de cáscara<br>";
                        }
                        if ($resultado["apio"] == 1) {
                            echo "Apio<br>";
                        }
                        if ($resultado["mostaza"] == 1) {
                            echo "Mostaza<br>";
                        }
                        if ($resultado["sesamo"] == 1) {
                            echo "Sésamo<br>";
                        }
                        if ($resultado["sulfitos"] == 1) {
                            echo "Sulfitos<br>";
                        }
                        if ($resultado["moluscos"] == 1) {
                            echo "Moluscos<br>";
                        }
                        if ($resultado["altramuces"] == 1) {
                            echo "Altramuces<br>";
                        }
                    }
                    if ($resultado["vegan"] == 1 || $resultado["vegetarian"] == 1) {

                        echo "<h5>Preferencias alimenticias:</h5>";

                        if ($resultado["vegan"] == 1) {
                            echo "Vegan<br>";
                        }
                        if ($resultado["vegetarian"] == 1) {
                            echo "Vegetarian<br>";
                        }
                    }
                    echo "<h5>Ingredientes</h5>";
                    echo $resultado["ingredientes"] . "<br>";
                    echo "<h5>Preparación</h5>";
                    echo $resultado["receta"] . "<br></p></div></div></div>";
                    echo " <form method=\"POST\" action=\"index.php?ctl=gestion\" name=\"gestion\" enctype=\"multipart/form-data\">
                    <input type= \"submit\" name= \"aceptar\" value=\"Aceptar\" /> 
                    <input type = \"submit\" name= \"rechazar\" value =\"Rechazar\" />
                    </form>";
                }
                $idReceta = $db->getIdReceta($resultado["receta"]);
                $_SESSION["idReceta"] = $idReceta;
                if (isset($_POST["aceptar"])) {
                    $resultado = $db->aceptarReceta($idReceta);
                    if (!$resultado) {
                        $_SESSION['mensajeError'] = 'Ha habido un error a la hora de aceptar la receta';
                        throw new Exception("Ha habido un error a la hora de aceptar la receta");
                    }
                } elseif (isset($_POST["rechazar"])) {
                    $resultado = $db->rechazarReceta($idReceta);
                    if (!$resultado) {
                        $_SESSION['mensajeError'] = 'Ha habido un error a la hora de rechazar la receta';
                        throw new Exception("Ha habido un error a la hora de rechazar la receta");
                    }
                    echo "</div>";
                }
            } else {
                $_SESSION['mensajeError'] = 'No hay recetas para gestionar';
                throw new Exception("No hay recetas para gestionar");
            }
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '/../vista/paginas/gestion.php';
    }

    public function perfil()
    {


        try {
            $db = new Model();
            $idUser = $_SESSION["idUser"];
            $resultado = $db->getPerfil($idUser);
            if ($resultado) {
                ob_start();
                echo "<div class=\"perfil\">";
                echo "<h1> " . $_SESSION["user"] . "</h1> <br><div class=\"infoper\">";
                echo "<h6>Nombre:</h6> " . $resultado["nomUser"] . " ";
                echo $resultado["apUser"] . "<br>";
                echo "<h6>Email:</h6> " . $resultado["email"] . "<br>";
                echo "<h6>Nombre de usuario:</h6> " . $resultado["user"] . "<br>";
                echo "<h6>Contraseña:</h6> " . $resultado["pwd"] . "<br>";
                echo "<h6>Biografía:</h6> " . $resultado["bio"] . "<br>";
                if (
                    $resultado["gluten"] == 1 || $resultado["crustaceos"] == 1 ||
                    $resultado["huevos"] == 1 || $resultado["pescado"] == 1 ||
                    $resultado["cacahuetes"] == 1 || $resultado["soja"] == 1 ||
                    $resultado["lactosa"] == 1 || $resultado["frutosdecascara"] == 1 ||
                    $resultado["apio"] == 1 || $resultado["mostaza"] == 1 ||
                    $resultado["sesamo"] == 1 || $resultado["sulfitos"] == 1 ||
                    $resultado["moluscos"] == 1 || $resultado["altramuces"] == 1
                ) {
                    echo "<h5>Alérgenos:</h5>";
                    if ($resultado["gluten"] == 1) {
                        echo "Gluten <br>";
                    }
                    if ($resultado["crustaceos"] == 1) {
                        echo "Crustáceos <br>";
                    }
                    if ($resultado["huevos"] == 1) {
                        echo "Huevos<br>";
                    }
                    if ($resultado["pescado"] == 1) {
                        echo "Pescado<br>";
                    }
                    if ($resultado["cacahuetes"] == 1) {
                        echo "Cacahuetes<br>";
                    }
                    if ($resultado["soja"] == 1) {
                        echo "Soja<br>";
                    }
                    if ($resultado["lactosa"] == 1) {
                        echo "Lactosa <br>";
                    }
                    if ($resultado["frutosdecascara"] == 1) {
                        echo "Frutos de cáscara<br>";
                    }
                    if ($resultado["apio"] == 1) {
                        echo "Apio<br>";
                    }
                    if ($resultado["mostaza"] == 1) {
                        echo "Mostaza<br>";
                    }
                    if ($resultado["sesamo"] == 1) {
                        echo "Sésamo<br>";
                    }
                    if ($resultado["sulfitos"] == 1) {
                        echo "Sulfitos<br>";
                    }
                    if ($resultado["moluscos"] == 1) {
                        echo "Moluscos<br>";
                    }
                    if ($resultado["altramuces"] == 1) {
                        echo "Altramuces<br>";
                    }
                }
                if ($resultado["vegan"] == 1 || $resultado["vegetarian"] == 1) {

                    echo "<h5>Preferencias alimenticias:</h5> ";

                    if ($resultado["vegan"] == 1) {
                        echo "Vegan<br>";
                    }
                    if ($resultado["vegetarian"] == 1) {
                        echo "Vegetarian<br>";
                    }
                }
                echo "</p></div></div>";
            } else {
                $_SESSION['mensajeError'] = 'Ha habido un error a la hora de visualizar el contenido';
                throw new Exception("Ha habido un error a la hora de visualizar el contenido");
            }
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '/../vista/paginas/perfil.php';
    }
    public function recetas()
    {
        ob_start();
        try {
            $db = new Model();
            $resultadoGluten = $db->getRecetasGluten();
            $resultadoCrustaceos = $db->getRecetasCrustaceos();
            $resultadoHuevos = $db->getRecetasHuevos();
            $resultadoPescado = $db->getRecetasPescado();
            $resultadoCacahuetes = $db->getRecetasCacahuetes();
            $resultadoSoja = $db->getRecetasSoja();
            $resultadoLactosa = $db->getRecetasLactosa();
            $resultadoFrutosCascara = $db->getRecetasFrutosCascara();
            $resultadoApio = $db->getRecetasApio();
            $resultadoMostaza = $db->getRecetasMostaza();
            $resultadoSesamo = $db->getRecetasSesamo();
            $resultadoSulfitos = $db->getRecetasSulfitos();
            $resultadoMoluscos = $db->getRecetasMoluscos();
            $resultadoAltramuces = $db->getRecetasAltramuces();
            $resultadoVegano = $db->getRecetasVegan();
            $resultadoVegetariano = $db->getRecetasVegetarian();
            $rutaIMG = "app\\mvc\\img\\recetas\\";
            if ($resultadoGluten) {

                echo "<h1>Recetas con gluten:</h1><br/>";
                echo "<div class=\"receta\"><div class=\"row row-cols-1 row-cols-md-2 g-4\">";
                foreach ($resultadoGluten as $resultado) {
                    
                   
                    $idReceta = $db->getIdReceta($resultado["receta"]);
                    $img = $db->getImg($idReceta);
                    echo "<div class=\"col\"><div class=\" card h-100\"> 

                    <img src=\"" . $rutaIMG . $img . "\" class=\"card-img-top rounded mx-auto d-block img-fluid fit-image\" alt=\"IMAGEN RECETA\">

                    <div class=\"card-body\">";
                    echo "<h3 class=\"card-title\">" . $resultado["nomReceta"] . "</h3><br><p class=\"card-text\"><div class=\"info\">";
                    echo $resultado["tPrep"] . " minutos. <br>";
                    echo "Fecha subida: " . $resultado["fecha_subida"] . "</div><br>";
                    if (
                        $resultado["gluten"] == 1 || $resultado["crustaceos"] == 1 ||
                        $resultado["huevos"] == 1 || $resultado["pescado"] == 1 ||
                        $resultado["cacahuetes"] == 1 || $resultado["soja"] == 1 ||
                        $resultado["lactosa"] == 1 || $resultado["frutosdecascara"] == 1 ||
                        $resultado["apio"] == 1 || $resultado["mostaza"] == 1 ||
                        $resultado["sesamo"] == 1 || $resultado["sulfitos"] == 1 ||
                        $resultado["moluscos"] == 1 || $resultado["altramuces"] == 1
                    ) {
                        echo "<h5>Alérgenos:</h5>";
                        if ($resultado["gluten"] == 1) {
                            echo "Gluten <br>";
                        }
                        if ($resultado["crustaceos"] == 1) {
                            echo "Crustáceos <br>";
                        }
                        if ($resultado["huevos"] == 1) {
                            echo "Huevos<br>";
                        }
                        if ($resultado["pescado"] == 1) {
                            echo "Pescado<br>";
                        }
                        if ($resultado["cacahuetes"] == 1) {
                            echo "Cacahuetes<br>";
                        }
                        if ($resultado["soja"] == 1) {
                            echo "Soja<br>";
                        }
                        if ($resultado["lactosa"] == 1) {
                            echo "Lactosa <br>";
                        }
                        if ($resultado["frutosdecascara"] == 1) {
                            echo "Frutos de cáscara<br>";
                        }
                        if ($resultado["apio"] == 1) {
                            echo "Apio<br>";
                        }
                        if ($resultado["mostaza"] == 1) {
                            echo "Mostaza<br>";
                        }
                        if ($resultado["sesamo"] == 1) {
                            echo "Sésamo<br>";
                        }
                        if ($resultado["sulfitos"] == 1) {
                            echo "Sulfitos<br>";
                        }
                        if ($resultado["moluscos"] == 1) {
                            echo "Moluscos<br>";
                        }
                        if ($resultado["altramuces"] == 1) {
                            echo "Altramuces<br>";
                        }
                    }
                    if ($resultado["vegan"] == 1 || $resultado["vegetarian"] == 1) {

                        echo "<h5>Preferencias alimenticias:</h5>";

                        if ($resultado["vegan"] == 1) {
                            echo "Vegan<br>";
                        }
                        if ($resultado["vegetarian"] == 1) {
                            echo "Vegetarian<br>";
                        }
                    }
                    echo "<h5>Ingredientes</h5>";
                    echo $resultado["ingredientes"] . "<br>";
                    echo "<h5>Preparación</h5>";
                    echo $resultado["receta"] . "<br></p></div></div></div>";
                }
                echo "</div></div>";
            }

            if ($resultadoCrustaceos) {
                echo "<h1>Recetas con crustáceos:</h1><br/>";
                echo "<div class=\"receta\"><div class=\"row row-cols-1 row-cols-md-2 g-4\">";

                foreach ($resultadoCrustaceos as $resultado) {
                    $idReceta = $db->getIdReceta($resultado["receta"]);
                    $img = $db->getImg($idReceta);
                    echo "<div class=\"col\"><div class=\" card h-100\"> 

                    <img src=\"" . $rutaIMG . $img . "\" class=\"card-img-top rounded mx-auto d-block img-fluid fit-image\" alt=\"IMAGEN RECETA\">

                    <div class=\"card-body\">";
                    echo "<h3 class=\"card-title\">" . $resultado["nomReceta"] . "</h3><br><p class=\"card-text\"><div class=\"info\">";
                    echo $resultado["tPrep"] . " minutos. <br>";
                    echo "Fecha subida: " . $resultado["fecha_subida"] . "</div><br>";
                    if (
                        $resultado["gluten"] == 1 || $resultado["crustaceos"] == 1 ||
                        $resultado["huevos"] == 1 || $resultado["pescado"] == 1 ||
                        $resultado["cacahuetes"] == 1 || $resultado["soja"] == 1 ||
                        $resultado["lactosa"] == 1 || $resultado["frutosdecascara"] == 1 ||
                        $resultado["apio"] == 1 || $resultado["mostaza"] == 1 ||
                        $resultado["sesamo"] == 1 || $resultado["sulfitos"] == 1 ||
                        $resultado["moluscos"] == 1 || $resultado["altramuces"] == 1
                    ) {
                        echo "<h5>Alérgenos:</h5>";
                        if ($resultado["gluten"] == 1) {
                            echo "Gluten <br>";
                        }
                        if ($resultado["crustaceos"] == 1) {
                            echo "Crustáceos <br>";
                        }
                        if ($resultado["huevos"] == 1) {
                            echo "Huevos<br>";
                        }
                        if ($resultado["pescado"] == 1) {
                            echo "Pescado<br>";
                        }
                        if ($resultado["cacahuetes"] == 1) {
                            echo "Cacahuetes<br>";
                        }
                        if ($resultado["soja"] == 1) {
                            echo "Soja<br>";
                        }
                        if ($resultado["lactosa"] == 1) {
                            echo "Lactosa <br>";
                        }
                        if ($resultado["frutosdecascara"] == 1) {
                            echo "Frutos de cáscara<br>";
                        }
                        if ($resultado["apio"] == 1) {
                            echo "Apio<br>";
                        }
                        if ($resultado["mostaza"] == 1) {
                            echo "Mostaza<br>";
                        }
                        if ($resultado["sesamo"] == 1) {
                            echo "Sésamo<br>";
                        }
                        if ($resultado["sulfitos"] == 1) {
                            echo "Sulfitos<br>";
                        }
                        if ($resultado["moluscos"] == 1) {
                            echo "Moluscos<br>";
                        }
                        if ($resultado["altramuces"] == 1) {
                            echo "Altramuces<br>";
                        }
                    }
                    if ($resultado["vegan"] == 1 || $resultado["vegetarian"] == 1) {

                        echo "<h5>Preferencias alimenticias:</h5>";

                        if ($resultado["vegan"] == 1) {
                            echo "Vegan<br>";
                        }
                        if ($resultado["vegetarian"] == 1) {
                            echo "Vegetarian<br>";
                        }
                    }
                    echo "<h5>Ingredientes</h5>";
                    echo $resultado["ingredientes"] . "<br>";
                    echo "<h5>Preparación</h5>";
                    echo $resultado["receta"] . "<br></p></div></div></div>";
                }
                echo "</div></div>";
            }
            if ($resultadoHuevos) {
                echo "<h1>Recetas con huevo:</h1><br/>";
                echo "<div class=\"receta\"><div class=\"row row-cols-1 row-cols-md-2 g-4\">";

                foreach ($resultadoHuevos as $resultado) {
                    $idReceta = $db->getIdReceta($resultado["receta"]);
                    $img = $db->getImg($idReceta);
                    echo "<div class=\"col\"><div class=\" card h-100\"> 

                    <img src=\"" . $rutaIMG . $img . "\" class=\"card-img-top rounded mx-auto d-block img-fluid fit-image\" alt=\"IMAGEN RECETA\">

                    <div class=\"card-body\">";
                    echo "<h3 class=\"card-title\">" . $resultado["nomReceta"] . "</h3><br><p class=\"card-text\"><div class=\"info\">";
                    echo $resultado["tPrep"] . " minutos. <br>";
                    echo "Fecha subida: " . $resultado["fecha_subida"] . "</div><br>";
                    if (
                        $resultado["gluten"] == 1 || $resultado["crustaceos"] == 1 ||
                        $resultado["huevos"] == 1 || $resultado["pescado"] == 1 ||
                        $resultado["cacahuetes"] == 1 || $resultado["soja"] == 1 ||
                        $resultado["lactosa"] == 1 || $resultado["frutosdecascara"] == 1 ||
                        $resultado["apio"] == 1 || $resultado["mostaza"] == 1 ||
                        $resultado["sesamo"] == 1 || $resultado["sulfitos"] == 1 ||
                        $resultado["moluscos"] == 1 || $resultado["altramuces"] == 1
                    ) {
                        echo "<h5>Alérgenos:</h5>";
                        if ($resultado["gluten"] == 1) {
                            echo "Gluten <br>";
                        }
                        if ($resultado["crustaceos"] == 1) {
                            echo "Crustáceos <br>";
                        }
                        if ($resultado["huevos"] == 1) {
                            echo "Huevos<br>";
                        }
                        if ($resultado["pescado"] == 1) {
                            echo "Pescado<br>";
                        }
                        if ($resultado["cacahuetes"] == 1) {
                            echo "Cacahuetes<br>";
                        }
                        if ($resultado["soja"] == 1) {
                            echo "Soja<br>";
                        }
                        if ($resultado["lactosa"] == 1) {
                            echo "Lactosa <br>";
                        }
                        if ($resultado["frutosdecascara"] == 1) {
                            echo "Frutos de cáscara<br>";
                        }
                        if ($resultado["apio"] == 1) {
                            echo "Apio<br>";
                        }
                        if ($resultado["mostaza"] == 1) {
                            echo "Mostaza<br>";
                        }
                        if ($resultado["sesamo"] == 1) {
                            echo "Sésamo<br>";
                        }
                        if ($resultado["sulfitos"] == 1) {
                            echo "Sulfitos<br>";
                        }
                        if ($resultado["moluscos"] == 1) {
                            echo "Moluscos<br>";
                        }
                        if ($resultado["altramuces"] == 1) {
                            echo "Altramuces<br>";
                        }
                    }
                    if ($resultado["vegan"] == 1 || $resultado["vegetarian"] == 1) {

                        echo "<h5>Preferencias alimenticias:</h5>";

                        if ($resultado["vegan"] == 1) {
                            echo "Vegan<br>";
                        }
                        if ($resultado["vegetarian"] == 1) {
                            echo "Vegetarian<br>";
                        }
                    }
                    echo "<h5>Ingredientes</h5>";
                    echo $resultado["ingredientes"] . "<br>";
                    echo "<h5>Preparación</h5>";
                    echo $resultado["receta"] . "<br></p></div></div></div>";
                }
                echo "</div></div>";
            }
            if ($resultadoPescado) {
                echo "<h1>Recetas con pescado:</h1><br/>";
                echo "<div class=\"receta\"><div class=\"row row-cols-1 row-cols-md-2 g-4\">";

                foreach ($resultadoPescado as $resultado) {
                    $idReceta = $db->getIdReceta($resultado["receta"]);
                    $img = $db->getImg($idReceta);
                    echo "<div class=\"col\"><div class=\" card h-100\"> 

                    <img src=\"" . $rutaIMG . $img . "\" class=\"card-img-top rounded mx-auto d-block img-fluid fit-image\" alt=\"IMAGEN RECETA\">
 
                    <div class=\"card-body\">";
                    echo "<h3 class=\"card-title\">" . $resultado["nomReceta"] . "</h3><br><p class=\"card-text\"><div class=\"info\">";
                    echo $resultado["tPrep"] . " minutos. <br>";
                    echo "Fecha subida: " . $resultado["fecha_subida"] . "</div><br>";
                    if (
                        $resultado["gluten"] == 1 || $resultado["crustaceos"] == 1 ||
                        $resultado["huevos"] == 1 || $resultado["pescado"] == 1 ||
                        $resultado["cacahuetes"] == 1 || $resultado["soja"] == 1 ||
                        $resultado["lactosa"] == 1 || $resultado["frutosdecascara"] == 1 ||
                        $resultado["apio"] == 1 || $resultado["mostaza"] == 1 ||
                        $resultado["sesamo"] == 1 || $resultado["sulfitos"] == 1 ||
                        $resultado["moluscos"] == 1 || $resultado["altramuces"] == 1
                    ) {
                        echo "<h5>Alérgenos:</h5>";
                        if ($resultado["gluten"] == 1) {
                            echo "Gluten <br>";
                        }
                        if ($resultado["crustaceos"] == 1) {
                            echo "Crustáceos <br>";
                        }
                        if ($resultado["huevos"] == 1) {
                            echo "Huevos<br>";
                        }
                        if ($resultado["pescado"] == 1) {
                            echo "Pescado<br>";
                        }
                        if ($resultado["cacahuetes"] == 1) {
                            echo "Cacahuetes<br>";
                        }
                        if ($resultado["soja"] == 1) {
                            echo "Soja<br>";
                        }
                        if ($resultado["lactosa"] == 1) {
                            echo "Lactosa <br>";
                        }
                        if ($resultado["frutosdecascara"] == 1) {
                            echo "Frutos de cáscara<br>";
                        }
                        if ($resultado["apio"] == 1) {
                            echo "Apio<br>";
                        }
                        if ($resultado["mostaza"] == 1) {
                            echo "Mostaza<br>";
                        }
                        if ($resultado["sesamo"] == 1) {
                            echo "Sésamo<br>";
                        }
                        if ($resultado["sulfitos"] == 1) {
                            echo "Sulfitos<br>";
                        }
                        if ($resultado["moluscos"] == 1) {
                            echo "Moluscos<br>";
                        }
                        if ($resultado["altramuces"] == 1) {
                            echo "Altramuces<br>";
                        }
                    }
                    if ($resultado["vegan"] == 1 || $resultado["vegetarian"] == 1) {

                        echo "<h5>Preferencias alimenticias:</h5>";

                        if ($resultado["vegan"] == 1) {
                            echo "Vegan<br>";
                        }
                        if ($resultado["vegetarian"] == 1) {
                            echo "Vegetarian<br>";
                        }
                    }
                    echo "<h5>Ingredientes</h5>";
                    echo $resultado["ingredientes"] . "<br>";
                    echo "<h5>Preparación</h5>";
                    echo $resultado["receta"] . "<br></p></div></div></div>";
                }
                echo "</div></div>";
            }
            if ($resultadoCacahuetes) {
                echo "<h1>Recetas con cacahuetes:</h1><br/>";
                echo "<div class=\"receta\"><div class=\"row row-cols-1 row-cols-md-2 g-4\">";

                foreach ($resultadoCacahuetes as $resultado) {
                    $idReceta = $db->getIdReceta($resultado["receta"]);
                    $img = $db->getImg($idReceta);
                    echo "<div class=\"col\"><div class=\" card h-100\"> 

                    <img src=\"" . $rutaIMG . $img . "\" class=\"card-img-top rounded mx-auto d-block img-fluid fit-image\" alt=\"IMAGEN RECETA\">

                    <div class=\"card-body\">";
                    echo "<h3 class=\"card-title\">" . $resultado["nomReceta"] . "</h3><br><p class=\"card-text\"><div class=\"info\">";
                    echo $resultado["tPrep"] . " minutos. <br>";
                    echo "Fecha subida: " . $resultado["fecha_subida"] . "</div><br>";
                    if (
                        $resultado["gluten"] == 1 || $resultado["crustaceos"] == 1 ||
                        $resultado["huevos"] == 1 || $resultado["pescado"] == 1 ||
                        $resultado["cacahuetes"] == 1 || $resultado["soja"] == 1 ||
                        $resultado["lactosa"] == 1 || $resultado["frutosdecascara"] == 1 ||
                        $resultado["apio"] == 1 || $resultado["mostaza"] == 1 ||
                        $resultado["sesamo"] == 1 || $resultado["sulfitos"] == 1 ||
                        $resultado["moluscos"] == 1 || $resultado["altramuces"] == 1
                    ) {
                        echo "<h5>Alérgenos:</h5>";
                        if ($resultado["gluten"] == 1) {
                            echo "Gluten <br>";
                        }
                        if ($resultado["crustaceos"] == 1) {
                            echo "Crustáceos <br>";
                        }
                        if ($resultado["huevos"] == 1) {
                            echo "Huevos<br>";
                        }
                        if ($resultado["pescado"] == 1) {
                            echo "Pescado<br>";
                        }
                        if ($resultado["cacahuetes"] == 1) {
                            echo "Cacahuetes<br>";
                        }
                        if ($resultado["soja"] == 1) {
                            echo "Soja<br>";
                        }
                        if ($resultado["lactosa"] == 1) {
                            echo "Lactosa <br>";
                        }
                        if ($resultado["frutosdecascara"] == 1) {
                            echo "Frutos de cáscara<br>";
                        }
                        if ($resultado["apio"] == 1) {
                            echo "Apio<br>";
                        }
                        if ($resultado["mostaza"] == 1) {
                            echo "Mostaza<br>";
                        }
                        if ($resultado["sesamo"] == 1) {
                            echo "Sésamo<br>";
                        }
                        if ($resultado["sulfitos"] == 1) {
                            echo "Sulfitos<br>";
                        }
                        if ($resultado["moluscos"] == 1) {
                            echo "Moluscos<br>";
                        }
                        if ($resultado["altramuces"] == 1) {
                            echo "Altramuces<br>";
                        }
                    }
                    if ($resultado["vegan"] == 1 || $resultado["vegetarian"] == 1) {

                        echo "<h5>Preferencias alimenticias:</h5>";

                        if ($resultado["vegan"] == 1) {
                            echo "Vegan<br>";
                        }
                        if ($resultado["vegetarian"] == 1) {
                            echo "Vegetarian<br>";
                        }
                    }
                    echo "<h5>Ingredientes</h5>";
                    echo $resultado["ingredientes"] . "<br>";
                    echo "<h5>Preparación</h5>";
                    echo $resultado["receta"] . "<br></p></div></div></div>";
                }
                echo "</div></div>";
            }
            if ($resultadoSoja) {
                echo "<h1>Recetas con soja:</h1><br/>";
                echo "<div class=\"receta\"><div class=\"row row-cols-1 row-cols-md-2 g-4\">";

                foreach ($resultadoSoja as $resultado) {
                    $idReceta = $db->getIdReceta($resultado["receta"]);
                    $img = $db->getImg($idReceta);
                    echo "<div class=\"col\"><div class=\" card h-100\"> 

                    <img src=\"" . $rutaIMG . $img . "\" class=\"card-img-top rounded mx-auto d-block img-fluid fit-image\" alt=\"IMAGEN RECETA\">

                    <div class=\"card-body\">";
                    echo "<h3 class=\"card-title\">" . $resultado["nomReceta"] . "</h3><br><p class=\"card-text\"><div class=\"info\">";
                    echo $resultado["tPrep"] . " minutos. <br>";
                    echo "Fecha subida: " . $resultado["fecha_subida"] . "</div><br>";
                    if (
                        $resultado["gluten"] == 1 || $resultado["crustaceos"] == 1 ||
                        $resultado["huevos"] == 1 || $resultado["pescado"] == 1 ||
                        $resultado["cacahuetes"] == 1 || $resultado["soja"] == 1 ||
                        $resultado["lactosa"] == 1 || $resultado["frutosdecascara"] == 1 ||
                        $resultado["apio"] == 1 || $resultado["mostaza"] == 1 ||
                        $resultado["sesamo"] == 1 || $resultado["sulfitos"] == 1 ||
                        $resultado["moluscos"] == 1 || $resultado["altramuces"] == 1
                    ) {
                        echo "<h5>Alérgenos:</h5>";
                        if ($resultado["gluten"] == 1) {
                            echo "Gluten <br>";
                        }
                        if ($resultado["crustaceos"] == 1) {
                            echo "Crustáceos <br>";
                        }
                        if ($resultado["huevos"] == 1) {
                            echo "Huevos<br>";
                        }
                        if ($resultado["pescado"] == 1) {
                            echo "Pescado<br>";
                        }
                        if ($resultado["cacahuetes"] == 1) {
                            echo "Cacahuetes<br>";
                        }
                        if ($resultado["soja"] == 1) {
                            echo "Soja<br>";
                        }
                        if ($resultado["lactosa"] == 1) {
                            echo "Lactosa <br>";
                        }
                        if ($resultado["frutosdecascara"] == 1) {
                            echo "Frutos de cáscara<br>";
                        }
                        if ($resultado["apio"] == 1) {
                            echo "Apio<br>";
                        }
                        if ($resultado["mostaza"] == 1) {
                            echo "Mostaza<br>";
                        }
                        if ($resultado["sesamo"] == 1) {
                            echo "Sésamo<br>";
                        }
                        if ($resultado["sulfitos"] == 1) {
                            echo "Sulfitos<br>";
                        }
                        if ($resultado["moluscos"] == 1) {
                            echo "Moluscos<br>";
                        }
                        if ($resultado["altramuces"] == 1) {
                            echo "Altramuces<br>";
                        }
                    }
                    if ($resultado["vegan"] == 1 || $resultado["vegetarian"] == 1) {

                        echo "<h5>Preferencias alimenticias:</h5>";

                        if ($resultado["vegan"] == 1) {
                            echo "Vegan<br>";
                        }
                        if ($resultado["vegetarian"] == 1) {
                            echo "Vegetarian<br>";
                        }
                    }
                    echo "<h5>Ingredientes</h5>";
                    echo $resultado["ingredientes"] . "<br>";
                    echo "<h5>Preparación</h5>";
                    echo $resultado["receta"] . "<br></p></div></div></div>";
                }
                echo "</div></div>";
            }
            if ($resultadoLactosa) {
                echo "<h1>Recetas con lactosa:</h1><br/>";
                echo "<div class=\"receta\"><div class=\"row row-cols-1 row-cols-md-2 g-4\">";

                foreach ($resultadoLactosa as $resultado) {
                    $idReceta = $db->getIdReceta($resultado["receta"]);
                    $img = $db->getImg($idReceta);
                    echo "<div class=\"col\"><div class=\" card h-100\"> 

                    <img src=\"" . $rutaIMG . $img . "\" class=\"card-img-top rounded mx-auto d-block img-fluid fit-image\" alt=\"IMAGEN RECETA\">
 
                    <div class=\"card-body\">";
                    echo "<h3 class=\"card-title\">" . $resultado["nomReceta"] . "</h3><br><p class=\"card-text\"><div class=\"info\">";
                    echo $resultado["tPrep"] . " minutos. <br>";
                    echo "Fecha subida: " . $resultado["fecha_subida"] . "</div><br>";
                    if (
                        $resultado["gluten"] == 1 || $resultado["crustaceos"] == 1 ||
                        $resultado["huevos"] == 1 || $resultado["pescado"] == 1 ||
                        $resultado["cacahuetes"] == 1 || $resultado["soja"] == 1 ||
                        $resultado["lactosa"] == 1 || $resultado["frutosdecascara"] == 1 ||
                        $resultado["apio"] == 1 || $resultado["mostaza"] == 1 ||
                        $resultado["sesamo"] == 1 || $resultado["sulfitos"] == 1 ||
                        $resultado["moluscos"] == 1 || $resultado["altramuces"] == 1
                    ) {
                        echo "<h5>Alérgenos:</h5>";
                        if ($resultado["gluten"] == 1) {
                            echo "Gluten <br>";
                        }
                        if ($resultado["crustaceos"] == 1) {
                            echo "Crustáceos <br>";
                        }
                        if ($resultado["huevos"] == 1) {
                            echo "Huevos<br>";
                        }
                        if ($resultado["pescado"] == 1) {
                            echo "Pescado<br>";
                        }
                        if ($resultado["cacahuetes"] == 1) {
                            echo "Cacahuetes<br>";
                        }
                        if ($resultado["soja"] == 1) {
                            echo "Soja<br>";
                        }
                        if ($resultado["lactosa"] == 1) {
                            echo "Lactosa <br>";
                        }
                        if ($resultado["frutosdecascara"] == 1) {
                            echo "Frutos de cáscara<br>";
                        }
                        if ($resultado["apio"] == 1) {
                            echo "Apio<br>";
                        }
                        if ($resultado["mostaza"] == 1) {
                            echo "Mostaza<br>";
                        }
                        if ($resultado["sesamo"] == 1) {
                            echo "Sésamo<br>";
                        }
                        if ($resultado["sulfitos"] == 1) {
                            echo "Sulfitos<br>";
                        }
                        if ($resultado["moluscos"] == 1) {
                            echo "Moluscos<br>";
                        }
                        if ($resultado["altramuces"] == 1) {
                            echo "Altramuces<br>";
                        }
                    }
                    if ($resultado["vegan"] == 1 || $resultado["vegetarian"] == 1) {

                        echo "<h5>Preferencias alimenticias:</h5>";

                        if ($resultado["vegan"] == 1) {
                            echo "Vegan<br>";
                        }
                        if ($resultado["vegetarian"] == 1) {
                            echo "Vegetarian<br>";
                        }
                    }
                    echo "<h5>Ingredientes</h5>";
                    echo $resultado["ingredientes"] . "<br>";
                    echo "<h5>Preparación</h5>";
                    echo $resultado["receta"] . "<br></p></div></div></div>";
                }
                echo "</div></div>";
            }
            if ($resultadoFrutosCascara) {
                echo "<h1>Recetas con frutos de cáscara:</h1><br/>";
                echo "<div class=\"receta\"><div class=\"row row-cols-1 row-cols-md-2 g-4\">";

                foreach ($resultadoFrutosCascara as $resultado) {
                    $idReceta = $db->getIdReceta($resultado["receta"]);
                    $img = $db->getImg($idReceta);
                    echo "<div class=\"col\"><div class=\" card h-100\"> 

                    <img src=\"" . $rutaIMG . $img . "\" class=\"card-img-top rounded mx-auto d-block img-fluid fit-image\" alt=\"IMAGEN RECETA\">

                    <div class=\"card-body\">";
                    echo "<h3 class=\"card-title\">" . $resultado["nomReceta"] . "</h3><br><p class=\"card-text\"><div class=\"info\">";
                    echo $resultado["tPrep"] . " minutos. <br>";
                    echo "Fecha subida: " . $resultado["fecha_subida"] . "</div><br>";
                    if (
                        $resultado["gluten"] == 1 || $resultado["crustaceos"] == 1 ||
                        $resultado["huevos"] == 1 || $resultado["pescado"] == 1 ||
                        $resultado["cacahuetes"] == 1 || $resultado["soja"] == 1 ||
                        $resultado["lactosa"] == 1 || $resultado["frutosdecascara"] == 1 ||
                        $resultado["apio"] == 1 || $resultado["mostaza"] == 1 ||
                        $resultado["sesamo"] == 1 || $resultado["sulfitos"] == 1 ||
                        $resultado["moluscos"] == 1 || $resultado["altramuces"] == 1
                    ) {
                        echo "<h5>Alérgenos:</h5>";
                        if ($resultado["gluten"] == 1) {
                            echo "Gluten <br>";
                        }
                        if ($resultado["crustaceos"] == 1) {
                            echo "Crustáceos <br>";
                        }
                        if ($resultado["huevos"] == 1) {
                            echo "Huevos<br>";
                        }
                        if ($resultado["pescado"] == 1) {
                            echo "Pescado<br>";
                        }
                        if ($resultado["cacahuetes"] == 1) {
                            echo "Cacahuetes<br>";
                        }
                        if ($resultado["soja"] == 1) {
                            echo "Soja<br>";
                        }
                        if ($resultado["lactosa"] == 1) {
                            echo "Lactosa <br>";
                        }
                        if ($resultado["frutosdecascara"] == 1) {
                            echo "Frutos de cáscara<br>";
                        }
                        if ($resultado["apio"] == 1) {
                            echo "Apio<br>";
                        }
                        if ($resultado["mostaza"] == 1) {
                            echo "Mostaza<br>";
                        }
                        if ($resultado["sesamo"] == 1) {
                            echo "Sésamo<br>";
                        }
                        if ($resultado["sulfitos"] == 1) {
                            echo "Sulfitos<br>";
                        }
                        if ($resultado["moluscos"] == 1) {
                            echo "Moluscos<br>";
                        }
                        if ($resultado["altramuces"] == 1) {
                            echo "Altramuces<br>";
                        }
                    }
                    if ($resultado["vegan"] == 1 || $resultado["vegetarian"] == 1) {

                        echo "<h5>Preferencias alimenticias:</h5>";

                        if ($resultado["vegan"] == 1) {
                            echo "Vegan<br>";
                        }
                        if ($resultado["vegetarian"] == 1) {
                            echo "Vegetarian<br>";
                        }
                    }
                    echo "<h5>Ingredientes</h5>";
                    echo $resultado["ingredientes"] . "<br>";
                    echo "<h5>Preparación</h5>";
                    echo $resultado["receta"] . "<br></p></div></div></div>";
                }
                echo "</div></div>";
            }
            if ($resultadoApio) {
                echo "<h1>Recetas con apio:</h1><br/>";
                echo "<div class=\"receta\"><div class=\"row row-cols-1 row-cols-md-2 g-4\">";

                foreach ($resultadoApio as $resultado) {
                    $idReceta = $db->getIdReceta($resultado["receta"]);
                    $img = $db->getImg($idReceta);
                    echo "<div class=\"col\"><div class=\" card h-100\"> 

                    <img src=\"" . $rutaIMG . $img . "\" class=\"card-img-top rounded mx-auto d-block img-fluid fit-image\" alt=\"IMAGEN RECETA\">
 
                    <div class=\"card-body\">";
                    echo "<h3 class=\"card-title\">" . $resultado["nomReceta"] . "</h3><br><p class=\"card-text\"><div class=\"info\">";
                    echo $resultado["tPrep"] . " minutos. <br>";
                    echo "Fecha subida: " . $resultado["fecha_subida"] . "</div><br>";
                    if (
                        $resultado["gluten"] == 1 || $resultado["crustaceos"] == 1 ||
                        $resultado["huevos"] == 1 || $resultado["pescado"] == 1 ||
                        $resultado["cacahuetes"] == 1 || $resultado["soja"] == 1 ||
                        $resultado["lactosa"] == 1 || $resultado["frutosdecascara"] == 1 ||
                        $resultado["apio"] == 1 || $resultado["mostaza"] == 1 ||
                        $resultado["sesamo"] == 1 || $resultado["sulfitos"] == 1 ||
                        $resultado["moluscos"] == 1 || $resultado["altramuces"] == 1
                    ) {
                        echo "<h5>Alérgenos:</h5>";
                        if ($resultado["gluten"] == 1) {
                            echo "Gluten <br>";
                        }
                        if ($resultado["crustaceos"] == 1) {
                            echo "Crustáceos <br>";
                        }
                        if ($resultado["huevos"] == 1) {
                            echo "Huevos<br>";
                        }
                        if ($resultado["pescado"] == 1) {
                            echo "Pescado<br>";
                        }
                        if ($resultado["cacahuetes"] == 1) {
                            echo "Cacahuetes<br>";
                        }
                        if ($resultado["soja"] == 1) {
                            echo "Soja<br>";
                        }
                        if ($resultado["lactosa"] == 1) {
                            echo "Lactosa <br>";
                        }
                        if ($resultado["frutosdecascara"] == 1) {
                            echo "Frutos de cáscara<br>";
                        }
                        if ($resultado["apio"] == 1) {
                            echo "Apio<br>";
                        }
                        if ($resultado["mostaza"] == 1) {
                            echo "Mostaza<br>";
                        }
                        if ($resultado["sesamo"] == 1) {
                            echo "Sésamo<br>";
                        }
                        if ($resultado["sulfitos"] == 1) {
                            echo "Sulfitos<br>";
                        }
                        if ($resultado["moluscos"] == 1) {
                            echo "Moluscos<br>";
                        }
                        if ($resultado["altramuces"] == 1) {
                            echo "Altramuces<br>";
                        }
                    }
                    if ($resultado["vegan"] == 1 || $resultado["vegetarian"] == 1) {

                        echo "<h5>Preferencias alimenticias:</h5>";

                        if ($resultado["vegan"] == 1) {
                            echo "Vegan<br>";
                        }
                        if ($resultado["vegetarian"] == 1) {
                            echo "Vegetarian<br>";
                        }
                    }
                    echo "<h5>Ingredientes</h5>";
                    echo $resultado["ingredientes"] . "<br>";
                    echo "<h5>Preparación</h5>";
                    echo $resultado["receta"] . "<br></p></div></div></div>";
                }
                echo "</div></div>";
            }
            if ($resultadoMostaza) {
                echo "<h1>Recetas con mostaza:</h1><br/>";
                echo "<div class=\"receta\"><div class=\"row row-cols-1 row-cols-md-2 g-4\">";

                foreach ($resultadoMostaza as $resultado) {
                    $idReceta = $db->getIdReceta($resultado["receta"]);
                    $img = $db->getImg($idReceta);
                    echo "<div class=\"col\"><div class=\" card h-100\"> 

                    <img src=\"" . $rutaIMG . $img . "\" class=\"card-img-top rounded mx-auto d-block img-fluid fit-image\" alt=\"IMAGEN RECETA\">
 
                    <div class=\"card-body\">";
                    echo "<h3 class=\"card-title\">" . $resultado["nomReceta"] . "</h3><br><p class=\"card-text\"><div class=\"info\">";
                    echo $resultado["tPrep"] . " minutos. <br>";
                    echo "Fecha subida: " . $resultado["fecha_subida"] . "</div><br>";
                    if (
                        $resultado["gluten"] == 1 || $resultado["crustaceos"] == 1 ||
                        $resultado["huevos"] == 1 || $resultado["pescado"] == 1 ||
                        $resultado["cacahuetes"] == 1 || $resultado["soja"] == 1 ||
                        $resultado["lactosa"] == 1 || $resultado["frutosdecascara"] == 1 ||
                        $resultado["apio"] == 1 || $resultado["mostaza"] == 1 ||
                        $resultado["sesamo"] == 1 || $resultado["sulfitos"] == 1 ||
                        $resultado["moluscos"] == 1 || $resultado["altramuces"] == 1
                    ) {
                        echo "<h5>Alérgenos:</h5>";
                        if ($resultado["gluten"] == 1) {
                            echo "Gluten <br>";
                        }
                        if ($resultado["crustaceos"] == 1) {
                            echo "Crustáceos <br>";
                        }
                        if ($resultado["huevos"] == 1) {
                            echo "Huevos<br>";
                        }
                        if ($resultado["pescado"] == 1) {
                            echo "Pescado<br>";
                        }
                        if ($resultado["cacahuetes"] == 1) {
                            echo "Cacahuetes<br>";
                        }
                        if ($resultado["soja"] == 1) {
                            echo "Soja<br>";
                        }
                        if ($resultado["lactosa"] == 1) {
                            echo "Lactosa <br>";
                        }
                        if ($resultado["frutosdecascara"] == 1) {
                            echo "Frutos de cáscara<br>";
                        }
                        if ($resultado["apio"] == 1) {
                            echo "Apio<br>";
                        }
                        if ($resultado["mostaza"] == 1) {
                            echo "Mostaza<br>";
                        }
                        if ($resultado["sesamo"] == 1) {
                            echo "Sésamo<br>";
                        }
                        if ($resultado["sulfitos"] == 1) {
                            echo "Sulfitos<br>";
                        }
                        if ($resultado["moluscos"] == 1) {
                            echo "Moluscos<br>";
                        }
                        if ($resultado["altramuces"] == 1) {
                            echo "Altramuces<br>";
                        }
                    }
                    if ($resultado["vegan"] == 1 || $resultado["vegetarian"] == 1) {

                        echo "<h5>Preferencias alimenticias:</h5>";

                        if ($resultado["vegan"] == 1) {
                            echo "Vegan<br>";
                        }
                        if ($resultado["vegetarian"] == 1) {
                            echo "Vegetarian<br>";
                        }
                    }
                    echo "<h5>Ingredientes</h5>";
                    echo $resultado["ingredientes"] . "<br>";
                    echo "<h5>Preparación</h5>";
                    echo $resultado["receta"] . "<br></p></div></div></div>";
                }
                echo "</div></div>";
            }
            if ($resultadoSesamo) {
                echo "<h1>Recetas con sésamo:</h1><br/>";
                echo "<div class=\"receta\"><div class=\"row row-cols-1 row-cols-md-2 g-4\">";

                foreach ($resultadoSesamo as $resultado) {
                    $idReceta = $db->getIdReceta($resultado["receta"]);
                    $img = $db->getImg($idReceta);
                    echo "<div class=\"col\"><div class=\" card h-100\"> 

                    <img src=\"" . $rutaIMG . $img . "\" class=\"card-img-top rounded mx-auto d-block img-fluid fit-image\" alt=\"IMAGEN RECETA\">

                    <div class=\"card-body\">";
                    echo "<h3 class=\"card-title\">" . $resultado["nomReceta"] . "</h3><br><p class=\"card-text\"><div class=\"info\">";
                    echo $resultado["tPrep"] . " minutos. <br>";
                    echo "Fecha subida: " . $resultado["fecha_subida"] . "</div><br>";
                    if (
                        $resultado["gluten"] == 1 || $resultado["crustaceos"] == 1 ||
                        $resultado["huevos"] == 1 || $resultado["pescado"] == 1 ||
                        $resultado["cacahuetes"] == 1 || $resultado["soja"] == 1 ||
                        $resultado["lactosa"] == 1 || $resultado["frutosdecascara"] == 1 ||
                        $resultado["apio"] == 1 || $resultado["mostaza"] == 1 ||
                        $resultado["sesamo"] == 1 || $resultado["sulfitos"] == 1 ||
                        $resultado["moluscos"] == 1 || $resultado["altramuces"] == 1
                    ) {
                        echo "<h5>Alérgenos:</h5>";
                        if ($resultado["gluten"] == 1) {
                            echo "Gluten <br>";
                        }
                        if ($resultado["crustaceos"] == 1) {
                            echo "Crustáceos <br>";
                        }
                        if ($resultado["huevos"] == 1) {
                            echo "Huevos<br>";
                        }
                        if ($resultado["pescado"] == 1) {
                            echo "Pescado<br>";
                        }
                        if ($resultado["cacahuetes"] == 1) {
                            echo "Cacahuetes<br>";
                        }
                        if ($resultado["soja"] == 1) {
                            echo "Soja<br>";
                        }
                        if ($resultado["lactosa"] == 1) {
                            echo "Lactosa <br>";
                        }
                        if ($resultado["frutosdecascara"] == 1) {
                            echo "Frutos de cáscara<br>";
                        }
                        if ($resultado["apio"] == 1) {
                            echo "Apio<br>";
                        }
                        if ($resultado["mostaza"] == 1) {
                            echo "Mostaza<br>";
                        }
                        if ($resultado["sesamo"] == 1) {
                            echo "Sésamo<br>";
                        }
                        if ($resultado["sulfitos"] == 1) {
                            echo "Sulfitos<br>";
                        }
                        if ($resultado["moluscos"] == 1) {
                            echo "Moluscos<br>";
                        }
                        if ($resultado["altramuces"] == 1) {
                            echo "Altramuces<br>";
                        }
                    }
                    if ($resultado["vegan"] == 1 || $resultado["vegetarian"] == 1) {

                        echo "<h5>Preferencias alimenticias:</h5>";

                        if ($resultado["vegan"] == 1) {
                            echo "Vegan<br>";
                        }
                        if ($resultado["vegetarian"] == 1) {
                            echo "Vegetarian<br>";
                        }
                    }
                    echo "<h5>Ingredientes</h5>";
                    echo $resultado["ingredientes"] . "<br>";
                    echo "<h5>Preparación</h5>";
                    echo $resultado["receta"] . "<br></p></div></div></div>";
                }
                echo "</div></div>";
            }
            if ($resultadoSulfitos) {
                echo "<h1>Recetas con sulfitos:</h1><br/>";
                echo "<div class=\"receta\"><div class=\"row row-cols-1 row-cols-md-2 g-4\">";

                foreach ($resultadoSulfitos as $resultado) {
                    $idReceta = $db->getIdReceta($resultado["receta"]);
                    $img = $db->getImg($idReceta);
                    echo "<div class=\"col\"><div class=\" card h-100\"> 

                    <img src=\"" . $rutaIMG . $img . "\" class=\"card-img-top rounded mx-auto d-block img-fluid fit-image\" alt=\"IMAGEN RECETA\">
 
                    <div class=\"card-body\">";
                    echo "<h3 class=\"card-title\">" . $resultado["nomReceta"] . "</h3><br><p class=\"card-text\"><div class=\"info\">";
                    echo $resultado["tPrep"] . " minutos. <br>";
                    echo "Fecha subida: " . $resultado["fecha_subida"] . "</div><br>";
                    if (
                        $resultado["gluten"] == 1 || $resultado["crustaceos"] == 1 ||
                        $resultado["huevos"] == 1 || $resultado["pescado"] == 1 ||
                        $resultado["cacahuetes"] == 1 || $resultado["soja"] == 1 ||
                        $resultado["lactosa"] == 1 || $resultado["frutosdecascara"] == 1 ||
                        $resultado["apio"] == 1 || $resultado["mostaza"] == 1 ||
                        $resultado["sesamo"] == 1 || $resultado["sulfitos"] == 1 ||
                        $resultado["moluscos"] == 1 || $resultado["altramuces"] == 1
                    ) {
                        echo "<h5>Alérgenos:</h5>";
                        if ($resultado["gluten"] == 1) {
                            echo "Gluten <br>";
                        }
                        if ($resultado["crustaceos"] == 1) {
                            echo "Crustáceos <br>";
                        }
                        if ($resultado["huevos"] == 1) {
                            echo "Huevos<br>";
                        }
                        if ($resultado["pescado"] == 1) {
                            echo "Pescado<br>";
                        }
                        if ($resultado["cacahuetes"] == 1) {
                            echo "Cacahuetes<br>";
                        }
                        if ($resultado["soja"] == 1) {
                            echo "Soja<br>";
                        }
                        if ($resultado["lactosa"] == 1) {
                            echo "Lactosa <br>";
                        }
                        if ($resultado["frutosdecascara"] == 1) {
                            echo "Frutos de cáscara<br>";
                        }
                        if ($resultado["apio"] == 1) {
                            echo "Apio<br>";
                        }
                        if ($resultado["mostaza"] == 1) {
                            echo "Mostaza<br>";
                        }
                        if ($resultado["sesamo"] == 1) {
                            echo "Sésamo<br>";
                        }
                        if ($resultado["sulfitos"] == 1) {
                            echo "Sulfitos<br>";
                        }
                        if ($resultado["moluscos"] == 1) {
                            echo "Moluscos<br>";
                        }
                        if ($resultado["altramuces"] == 1) {
                            echo "Altramuces<br>";
                        }
                    }
                    if ($resultado["vegan"] == 1 || $resultado["vegetarian"] == 1) {

                        echo "<h5>Preferencias alimenticias:</h5>";

                        if ($resultado["vegan"] == 1) {
                            echo "Vegan<br>";
                        }
                        if ($resultado["vegetarian"] == 1) {
                            echo "Vegetarian<br>";
                        }
                    }
                    echo "<h5>Ingredientes</h5>";
                    echo $resultado["ingredientes"] . "<br>";
                    echo "<h5>Preparación</h5>";
                    echo $resultado["receta"] . "<br></p></div></div></div>";
                }
                echo "</div></div>";
            }
            if ($resultadoMoluscos) {
                echo "<h1>Recetas con moluscos:</h1><br/>";
                echo "<div class=\"receta\"><div class=\"row row-cols-1 row-cols-md-2 g-4\">";

                foreach ($resultadoMoluscos as $resultado) {
                    $idReceta = $db->getIdReceta($resultado["receta"]);
                    $img = $db->getImg($idReceta);
                    echo "<div class=\"col\"><div class=\" card h-100\"> 

                    <img src=\"" . $rutaIMG . $img . "\" class=\"card-img-top rounded mx-auto d-block img-fluid fit-image\" alt=\"IMAGEN RECETA\">
 
                    <div class=\"card-body\">";
                    echo "<h3 class=\"card-title\">" . $resultado["nomReceta"] . "</h3><br><p class=\"card-text\"><div class=\"info\">";
                    echo $resultado["tPrep"] . " minutos. <br>";
                    echo "Fecha subida: " . $resultado["fecha_subida"] . "</div><br>";
                    if (
                        $resultado["gluten"] == 1 || $resultado["crustaceos"] == 1 ||
                        $resultado["huevos"] == 1 || $resultado["pescado"] == 1 ||
                        $resultado["cacahuetes"] == 1 || $resultado["soja"] == 1 ||
                        $resultado["lactosa"] == 1 || $resultado["frutosdecascara"] == 1 ||
                        $resultado["apio"] == 1 || $resultado["mostaza"] == 1 ||
                        $resultado["sesamo"] == 1 || $resultado["sulfitos"] == 1 ||
                        $resultado["moluscos"] == 1 || $resultado["altramuces"] == 1
                    ) {
                        echo "<h5>Alérgenos:</h5>";
                        if ($resultado["gluten"] == 1) {
                            echo "Gluten <br>";
                        }
                        if ($resultado["crustaceos"] == 1) {
                            echo "Crustáceos <br>";
                        }
                        if ($resultado["huevos"] == 1) {
                            echo "Huevos<br>";
                        }
                        if ($resultado["pescado"] == 1) {
                            echo "Pescado<br>";
                        }
                        if ($resultado["cacahuetes"] == 1) {
                            echo "Cacahuetes<br>";
                        }
                        if ($resultado["soja"] == 1) {
                            echo "Soja<br>";
                        }
                        if ($resultado["lactosa"] == 1) {
                            echo "Lactosa <br>";
                        }
                        if ($resultado["frutosdecascara"] == 1) {
                            echo "Frutos de cáscara<br>";
                        }
                        if ($resultado["apio"] == 1) {
                            echo "Apio<br>";
                        }
                        if ($resultado["mostaza"] == 1) {
                            echo "Mostaza<br>";
                        }
                        if ($resultado["sesamo"] == 1) {
                            echo "Sésamo<br>";
                        }
                        if ($resultado["sulfitos"] == 1) {
                            echo "Sulfitos<br>";
                        }
                        if ($resultado["moluscos"] == 1) {
                            echo "Moluscos<br>";
                        }
                        if ($resultado["altramuces"] == 1) {
                            echo "Altramuces<br>";
                        }
                    }
                    if ($resultado["vegan"] == 1 || $resultado["vegetarian"] == 1) {

                        echo "<h5>Preferencias alimenticias:</h5>";

                        if ($resultado["vegan"] == 1) {
                            echo "Vegan<br>";
                        }
                        if ($resultado["vegetarian"] == 1) {
                            echo "Vegetarian<br>";
                        }
                    }
                    echo "<h5>Ingredientes</h5>";
                    echo $resultado["ingredientes"] . "<br>";
                    echo "<h5>Preparación</h5>";
                    echo $resultado["receta"] . "<br></p></div></div></div>";
                }
                echo "</div></div>";
            }
            if ($resultadoAltramuces) {
                echo "<h1>Recetas con altramuces:</h1><br/>";
                echo "<div class=\"receta\"><div class=\"row row-cols-1 row-cols-md-2 g-4\">";

                foreach ($resultadoAltramuces as $resultado) {
                    $idReceta = $db->getIdReceta($resultado["receta"]);
                    $img = $db->getImg($idReceta);
                    echo "<div class=\"col\"><div class=\" card h-100\"> 

                    <img src=\"" . $rutaIMG . $img . "\" class=\"card-img-top rounded mx-auto d-block img-fluid fit-image\" alt=\"IMAGEN RECETA\">

                    <div class=\"card-body\">";
                    echo "<h3 class=\"card-title\">" . $resultado["nomReceta"] . "</h3><br><p class=\"card-text\"><div class=\"info\">";
                    echo $resultado["tPrep"] . " minutos. <br>";
                    echo "Fecha subida: " . $resultado["fecha_subida"] . "</div><br>";
                    if (
                        $resultado["gluten"] == 1 || $resultado["crustaceos"] == 1 ||
                        $resultado["huevos"] == 1 || $resultado["pescado"] == 1 ||
                        $resultado["cacahuetes"] == 1 || $resultado["soja"] == 1 ||
                        $resultado["lactosa"] == 1 || $resultado["frutosdecascara"] == 1 ||
                        $resultado["apio"] == 1 || $resultado["mostaza"] == 1 ||
                        $resultado["sesamo"] == 1 || $resultado["sulfitos"] == 1 ||
                        $resultado["moluscos"] == 1 || $resultado["altramuces"] == 1
                    ) {
                        echo "<h5>Alérgenos:</h5>";
                        if ($resultado["gluten"] == 1) {
                            echo "Gluten <br>";
                        }
                        if ($resultado["crustaceos"] == 1) {
                            echo "Crustáceos <br>";
                        }
                        if ($resultado["huevos"] == 1) {
                            echo "Huevos<br>";
                        }
                        if ($resultado["pescado"] == 1) {
                            echo "Pescado<br>";
                        }
                        if ($resultado["cacahuetes"] == 1) {
                            echo "Cacahuetes<br>";
                        }
                        if ($resultado["soja"] == 1) {
                            echo "Soja<br>";
                        }
                        if ($resultado["lactosa"] == 1) {
                            echo "Lactosa <br>";
                        }
                        if ($resultado["frutosdecascara"] == 1) {
                            echo "Frutos de cáscara<br>";
                        }
                        if ($resultado["apio"] == 1) {
                            echo "Apio<br>";
                        }
                        if ($resultado["mostaza"] == 1) {
                            echo "Mostaza<br>";
                        }
                        if ($resultado["sesamo"] == 1) {
                            echo "Sésamo<br>";
                        }
                        if ($resultado["sulfitos"] == 1) {
                            echo "Sulfitos<br>";
                        }
                        if ($resultado["moluscos"] == 1) {
                            echo "Moluscos<br>";
                        }
                        if ($resultado["altramuces"] == 1) {
                            echo "Altramuces<br>";
                        }
                    }
                    if ($resultado["vegan"] == 1 || $resultado["vegetarian"] == 1) {

                        echo "<h5>Preferencias alimenticias:</h5>";

                        if ($resultado["vegan"] == 1) {
                            echo "Vegan<br>";
                        }
                        if ($resultado["vegetarian"] == 1) {
                            echo "Vegetarian<br>";
                        }
                    }
                    echo "<h5>Ingredientes</h5>";
                    echo $resultado["ingredientes"] . "<br>";
                    echo "<h5>Preparación</h5>";
                    echo $resultado["receta"] . "<br></p></div></div></div>";
                }
                echo "</div></div>";
            }
            if ($resultadoVegano) {
                echo "<h1>Recetas veganas:</h1><br/>";
                echo "<div class=\"receta\"><div class=\"row row-cols-1 row-cols-md-2 g-4\">";

                foreach ($resultadoVegano as $resultado) {
                    $idReceta = $db->getIdReceta($resultado["receta"]);
                    $img = $db->getImg($idReceta);
                    echo "<div class=\"col\"><div class=\" card h-100\"> 

                    <img src=\"" . $rutaIMG . $img . "\" class=\"card-img-top rounded mx-auto d-block img-fluid fit-image\" alt=\"IMAGEN RECETA\">

                    <div class=\"card-body\">";
                    echo "<h3 class=\"card-title\">" . $resultado["nomReceta"] . "</h3><br><p class=\"card-text\"><div class=\"info\">";
                    echo $resultado["tPrep"] . " minutos. <br>";
                    echo "Fecha subida: " . $resultado["fecha_subida"] . "</div><br>";
                    if (
                        $resultado["gluten"] == 1 || $resultado["crustaceos"] == 1 ||
                        $resultado["huevos"] == 1 || $resultado["pescado"] == 1 ||
                        $resultado["cacahuetes"] == 1 || $resultado["soja"] == 1 ||
                        $resultado["lactosa"] == 1 || $resultado["frutosdecascara"] == 1 ||
                        $resultado["apio"] == 1 || $resultado["mostaza"] == 1 ||
                        $resultado["sesamo"] == 1 || $resultado["sulfitos"] == 1 ||
                        $resultado["moluscos"] == 1 || $resultado["altramuces"] == 1
                    ) {
                        echo "<h5>Alérgenos:</h5>";
                        if ($resultado["gluten"] == 1) {
                            echo "Gluten <br>";
                        }
                        if ($resultado["crustaceos"] == 1) {
                            echo "Crustáceos <br>";
                        }
                        if ($resultado["huevos"] == 1) {
                            echo "Huevos<br>";
                        }
                        if ($resultado["pescado"] == 1) {
                            echo "Pescado<br>";
                        }
                        if ($resultado["cacahuetes"] == 1) {
                            echo "Cacahuetes<br>";
                        }
                        if ($resultado["soja"] == 1) {
                            echo "Soja<br>";
                        }
                        if ($resultado["lactosa"] == 1) {
                            echo "Lactosa <br>";
                        }
                        if ($resultado["frutosdecascara"] == 1) {
                            echo "Frutos de cáscara<br>";
                        }
                        if ($resultado["apio"] == 1) {
                            echo "Apio<br>";
                        }
                        if ($resultado["mostaza"] == 1) {
                            echo "Mostaza<br>";
                        }
                        if ($resultado["sesamo"] == 1) {
                            echo "Sésamo<br>";
                        }
                        if ($resultado["sulfitos"] == 1) {
                            echo "Sulfitos<br>";
                        }
                        if ($resultado["moluscos"] == 1) {
                            echo "Moluscos<br>";
                        }
                        if ($resultado["altramuces"] == 1) {
                            echo "Altramuces<br>";
                        }
                    }
                    if ($resultado["vegan"] == 1 || $resultado["vegetarian"] == 1) {

                        echo "<h5>Preferencias alimenticias:</h5>";

                        if ($resultado["vegan"] == 1) {
                            echo "Vegan<br>";
                        }
                        if ($resultado["vegetarian"] == 1) {
                            echo "Vegetarian<br>";
                        }
                    }
                    echo "<h5>Ingredientes</h5>";
                    echo $resultado["ingredientes"] . "<br>";
                    echo "<h5>Preparación</h5>";
                    echo $resultado["receta"] . "<br></p></div></div></div>";
                }
                echo "</div></div>";
            }
            if ($resultadoVegetariano) {
                echo "<h1>Recetas vegetarianas:</h1><br/>";
                echo "<div class=\"receta\"><div class=\"row row-cols-1 row-cols-md-2 g-4\">";

                foreach ($resultadoVegetariano as $resultado) {
                    $idReceta = $db->getIdReceta($resultado["receta"]);
                    $img = $db->getImg($idReceta);
                    echo "<div class=\"col\"><div class=\" card h-100\"> 

                    <img src=\"" . $rutaIMG . $img . "\" class=\"card-img-top rounded mx-auto d-block img-fluid fit-image\" alt=\"IMAGEN RECETA\">

                    <div class=\"card-body\">";
                    echo "<h3 class=\"card-title\">" . $resultado["nomReceta"] . "</h3><br><p class=\"card-text\"><div class=\"info\">";
                    echo $resultado["tPrep"] . " minutos. <br>";
                    echo "Fecha subida: " . $resultado["fecha_subida"] . "</div><br>";
                    if (
                        $resultado["gluten"] == 1 || $resultado["crustaceos"] == 1 ||
                        $resultado["huevos"] == 1 || $resultado["pescado"] == 1 ||
                        $resultado["cacahuetes"] == 1 || $resultado["soja"] == 1 ||
                        $resultado["lactosa"] == 1 || $resultado["frutosdecascara"] == 1 ||
                        $resultado["apio"] == 1 || $resultado["mostaza"] == 1 ||
                        $resultado["sesamo"] == 1 || $resultado["sulfitos"] == 1 ||
                        $resultado["moluscos"] == 1 || $resultado["altramuces"] == 1
                    ) {
                        echo "<h5>Alérgenos:</h5>";
                        if ($resultado["gluten"] == 1) {
                            echo "Gluten <br>";
                        }
                        if ($resultado["crustaceos"] == 1) {
                            echo "Crustáceos <br>";
                        }
                        if ($resultado["huevos"] == 1) {
                            echo "Huevos<br>";
                        }
                        if ($resultado["pescado"] == 1) {
                            echo "Pescado<br>";
                        }
                        if ($resultado["cacahuetes"] == 1) {
                            echo "Cacahuetes<br>";
                        }
                        if ($resultado["soja"] == 1) {
                            echo "Soja<br>";
                        }
                        if ($resultado["lactosa"] == 1) {
                            echo "Lactosa <br>";
                        }
                        if ($resultado["frutosdecascara"] == 1) {
                            echo "Frutos de cáscara<br>";
                        }
                        if ($resultado["apio"] == 1) {
                            echo "Apio<br>";
                        }
                        if ($resultado["mostaza"] == 1) {
                            echo "Mostaza<br>";
                        }
                        if ($resultado["sesamo"] == 1) {
                            echo "Sésamo<br>";
                        }
                        if ($resultado["sulfitos"] == 1) {
                            echo "Sulfitos<br>";
                        }
                        if ($resultado["moluscos"] == 1) {
                            echo "Moluscos<br>";
                        }
                        if ($resultado["altramuces"] == 1) {
                            echo "Altramuces<br>";
                        }
                    }
                    if ($resultado["vegan"] == 1 || $resultado["vegetarian"] == 1) {

                        echo "<h5>Preferencias alimenticias:</h5>";

                        if ($resultado["vegan"] == 1) {
                            echo "Vegan<br>";
                        }
                        if ($resultado["vegetarian"] == 1) {
                            echo "Vegetarian<br>";
                        }
                    }
                    echo "<h5>Ingredientes</h5>";
                    echo $resultado["ingredientes"] . "<br>";
                    echo "<h5>Preparación</h5>";
                    echo $resultado["receta"] . "<br></p></div></div></div>";
                }
                echo "</div></div>";
            }
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '/../vista/paginas/recetas.php';
    }
    public function subir_recetas()
    {
        require __DIR__ . '/../vista/paginas/subir_recetas.php';
        try {
            $nomReceta = "";
            $tPrep = 0;
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
            $aprobada = 0;
            $cont = 0;
            $fecha_subida = date('Y-m-d H:i:s');
            $idUser = "";
            $errores = [];

            if (isset($_POST['enviar'])) {

                $nomReceta = recoge('nomReceta');
                $ingredientes = recoge('ingredientes');
                $receta = recoge('receta');
                $tPrep = recoge('tPrep');
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
                if (empty($tPrep)) {
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
                    $soja = 1;
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

                $db = new Model();
                //LO PASAMOS A EJECUTAR AL MODELO


                $idUser = $_SESSION["idUser"];

                $resultado = $db->setReceta(
                    $nomReceta,
                    $receta,
                    $tPrep,
                    $fecha_subida,
                    $ingredientes,
                    $idUser,
                    $aprobada,
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
                    $vegetarian
                );

                $idReceta = $db->getIdReceta($receta);
                //CONFIGURACIÓN IMAGENES
                $rutaIMG = __DIR__ . "\img\\recetas\\";
                $extensionesValidas = ["image/jpeg", "image/gif"];
                $archivo = $_FILES['fotosreceta']['name'];
                if ($archivo != "") {
                    $file = cfile("fotosreceta", $rutaIMG, $extensionesValidas, $errores);
                    $archivo =  $idReceta . "-" . $_FILES['fotosreceta']['name'];
                    $origen = $_FILES["fotosreceta"]['tmp_name'];
                    $destino = $rutaIMG . $archivo;
                    if (move_uploaded_file($origen, $destino)) {
                        $resultado = $db->setImg($idReceta, $archivo);
                    } else {
                        $_SESSION["mensajeError"] = "Ha habido un error a la hora de subir la imagen";
                        throw new Exception("Ha habido un error a la hora de subir la imagen");
                    }
                } else {
                    $errores[] = "* Al menos debes subir una imagen";
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
?>