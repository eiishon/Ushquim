<?php
include('validar/validate.php');
class Controller
{
    public function inicio()
    {
        ob_start();
        echo "<h1>Bienvenido a Ushquim </h1>";
        try{
            $db= new Model();
            $resultado=$db->getRecetas();
            if($resultado){
                echo "<h2>".$resultado["nomReceta"]."</h2><br>";
                echo $resultado["tPrep"]."<br>";
                echo "Fecha subida: ".$resultado["fecha_subida"]."<br>";
                if($resultado["gluten"] == 1 || $resultado["crustaceos"] == 1 || 
                $resultado["huevos"] == 1 || $resultado["pescado"] == 1 ||
                $resultado["cacahuetes"] == 1 || $resultado["soja"] == 1 ||
                $resultado["lactosa"] == 1 || $resultado["frutosdecascara"] == 1 ||
                $resultado["apio"] == 1 || $resultado["mostaza"] == 1 || 
                $resultado["sesamo"] == 1 || $resultado["sulfitos"] == 1 || 
                $resultado["moluscos"] == 1 || $resultado["altramuces"] == 1){
                echo "<h4>Alérgenos:</h4>";
                if($resultado["gluten"] == 1){
                    echo "Gluten <br>";
                }
                if($resultado["crustaceos"] == 1){
                    echo "Crustáceos <br>";
                }if($resultado["huevos"] == 1){
                    echo "Huevos<br>";
                }
                if($resultado["pescado"] == 1){
                    echo "Pescado<br>";
                }
                if($resultado["cacahuetes"] == 1){
                    echo "Cacahuetes<br>";
                }
                if($resultado["soja"] == 1){
                    echo "Soja<br>";
                }
                if($resultado["lactosa"] == 1){
                    echo "Lactosa <br>";
                }
                if($resultado["frutosdecascara"] == 1){
                    echo "Frutos de cáscara<br>";
                }
                if($resultado["apio"] == 1){
                    echo "Apio<br>";
                }
                if($resultado["mostaza"] == 1){
                    echo "Mostaza<br>";
                }
                if($resultado["sesamo"] == 1){
                    echo "Sésamo<br>";
                }
                if($resultado["sulfitos"] == 1){
                    echo "Sulfitos<br>";
                }
                if($resultado["moluscos"] == 1){
                    echo "Moluscos<br>";
                }
                if($resultado["altramuces"] == 1){
                    echo "Altramuces<br>";
                }
                
            }
                if($resultado["vegan"] == 1 || $resultado["vegetarian"] == 1){
                    
                    echo "<h4>Preferencias alimenticias:</h4>";

                    if($resultado["vegan"] == 1){
                        echo "Vegan<br>";
                    }
                    if($resultado["vegetarian"] == 1){
                        echo "Vegetarian<br>";
                    }    
                }
                echo "<h4>Ingredientes</h4>";
                echo $resultado["ingredientes"]."<br>";
                echo "<h4>Preparación</h4>";
                echo $resultado["receta"]."<br>";
            
        }
    }catch (Exception $e) {
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


                if(empty($errores)){
                //LO PASAMOS A EJECUTAR AL MODELO
                $db = new Model();
                $resultado = $db->setRegistro($name, $apellidos, $email, $user, $pwd, $bio,
                $gluten, $crustaceos, $huevos, $pescado, $cacahuetes, $soja, $lactosa, $frutosdecascara, 
                $apio, $mostaza, $sesamo, $sulfitos, $moluscos, $altramuces, $vegan, $vegetarian);
                
                if ($resultado) {
                
                    $_SESSION['user'] = $user;
                    $idUser = $db->getIdUser($user);
                    $_SESSION['idUser'] = $idUser;
                    $idUser = $_SESSION["idUser"];
                    header('Location: index.php?ctl=login');
                    
                }else{
                    $_SESSION['mensajeError'] = "Ha habido un fallo a la hora de registrarse";
                    throw new Exception("Ha habido un fallo a la hora de registrarse");
                }
            }else{
                foreach($errores as $error){
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
        try {
            $name = "";
            $apellidos = "";
            $user = "";
            $pwd = "";
            $reppwd="";
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
            $cont = 0;
            $pattern = "/^[a-zÃ±0-9*_+\-\$&\/\\\]+$/i";
            $errores[] ="";
            if (isset($_POST['enviar'])) {
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
                } 

                if (!empty($apellidos)) {
                    cText($apellidos, $errores);
                } 
                if (!empty($user)) {
                    validoPatron($pattern, $user, $errores);
                } 
                if (!empty($pwd) && !empty($reppwd)) {
                    validoPatron($pattern, $pwd, $errores);
                    validoPatron($pattern, $reppwd, $errores);
                } elseif((!empty($pwd) && empty($reppwd))|| (empty($pwd) && !empty($reppwd)) ){
                    $errores[] = " Debes repetir la contraseña. <br>";
                }

                if($pwd != $reppwd){
                    $errores[] = "La contraseñas deben coincidir. <br>";
                }

                if (!empty($email) && !empty($repemail)) {
                    validoEmail($email, $errores);
                    validoEmail($repemail, $errores);
                } elseif((!empty($email) && empty($repemail))|| (empty($email) && !empty($repemail)) ) {
                    $errores[] = "Debes repetir el email.<br>";
                }

                if($email != $repemail){
                    $errores[] = "Los emails deben coincidir. <br>";
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

               

                if(empty($errores)){
                //LO PASAMOS A EJECUTAR AL MODELO
                
                $db = new Model();
                $idUser = $_SESSION["idUser"];
                if(isset($_POST["borrarperfil"])){
                    $resultado=$db->borrarPerfil($idUser);
                }
                //CARGAMOS PERFIL Y ASIGNAMOS INFO
                $resultado = $db->getPerfil($idUser);
                if($name == ""){
                    $name =$resultado["name"];
                }
                if($apellidos == ""){
                    $apellidos = $resultado["apellidos"];
                }
                if($email == ""){
                    $email = $resultado["email"];
                }
                if($user == ""){
                    $user = $resultado["user"] ;
                }
                if($pwd ==""){
                    $pwd = $resultado["pwd"];
                }

                if($bio == ""){
                    $bio = $resultado["bio"];
                }

                if($gluten == 0){
                    $gluten =$resultado["gluten"];
                }
                if($crustaceos == 0){
                    $crustaceos =$resultado["crustaceos"];
                }
                if($huevos == 0){
                    $huevos =$resultado["huevos"];
                }
                if($pescado == 0){
                    $pescado =$resultado["pescado"];
                }
                if($cacahuetes == 0){
                    $cacahuetes =$resultado["cacahuetes"];
                }
                if($soja == 0){
                    $soja =$resultado["soja"];
                }
                if($lactosa == 0){
                    $lactosa =$resultado["lactosa"];
                }
                if($frutosdecascara == 0){
                    $frutosdecascara =$resultado["frutosdecascara"];
                }
                if($apio == 0){
                    $apio =$resultado["apio"];
                }
                if($mostaza == 0){
                    $mostaza =$resultado["mostaza"];
                }
                if($sesamo == 0){
                    $sesamo =$resultado["sesamo"];
                }
                if($sulfitos == 0){
                    $sulfitos =$resultado["sulfitos"];
                }
                if($moluscos == 0){
                    $name =$resultado["moluscos"];
                }
                if($altramuces == 0){
                    $altramuces =$resultado["altramuces"];
                }
                if($vegan == 0){
                    $vegan =$resultado["vegan"];
                }
                if($vegetarian == 0){
                    $vegetarian =$resultado["vegetarian"];
                }
                
                $resultado = $db->editarPerfil($name, $apellidos, $email, $user, $pwd, $bio,
                $gluten, $crustaceos, $huevos, $pescado, $cacahuetes, $soja, $lactosa, $frutosdecascara, 
                $apio, $mostaza, $sesamo, $sulfitos, $moluscos, $altramuces, $vegan, $vegetarian);
                
                if ($resultado) {
                    $_SESSION['user'] = $user;
                    header('Location: index.php?ctl=perfil');
                    
                }else{
                    $_SESSION['mensajeError'] = "Ha habido un fallo a la hora de editar el perfil.";
                    throw new Exception("Ha habido un fallo a la hora de editar el perfil.");
                }
            }else{
                foreach($errores as $error){
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

        require __DIR__ . '/../vista/paginas/editar_perfil.php';
    }

    public function gestion()
    {
        ob_start();
        echo "<h1>Gestión de Recetas </h1>";
        try{

            $db = new Model();
            $resultado = $db->getRecetasNoAprobadas();
            if($resultado){
                echo "<h2>".$resultado["nomReceta"]."</h2><br>";
                echo $resultado["tPrep"]."<br>";
                echo "Fecha subida: ".$resultado["fecha_subida"]."<br>";
                if($resultado["gluten"] == 1 || $resultado["crustaceos"] == 1 || 
                $resultado["huevos"] == 1 || $resultado["pescado"] == 1 ||
                $resultado["cacahuetes"] == 1 || $resultado["soja"] == 1 ||
                $resultado["lactosa"] == 1 || $resultado["frutosdecascara"] == 1 ||
                $resultado["apio"] == 1 || $resultado["mostaza"] == 1 || 
                $resultado["sesamo"] == 1 || $resultado["sulfitos"] == 1 || 
                $resultado["moluscos"] == 1 || $resultado["altramuces"] == 1){
                echo "<h4>Alérgenos:</h4>";
                if($resultado["gluten"] == 1){
                    echo "Gluten <br>";
                }
                if($resultado["crustaceos"] == 1){
                    echo "Crustáceos <br>";
                }if($resultado["huevos"] == 1){
                    echo "Huevos<br>";
                }
                if($resultado["pescado"] == 1){
                    echo "Pescado<br>";
                }
                if($resultado["cacahuetes"] == 1){
                    echo "Cacahuetes<br>";
                }
                if($resultado["soja"] == 1){
                    echo "Soja<br>";
                }
                if($resultado["lactosa"] == 1){
                    echo "Lactosa <br>";
                }
                if($resultado["frutosdecascara"] == 1){
                    echo "Frutos de cáscara<br>";
                }
                if($resultado["apio"] == 1){
                    echo "Apio<br>";
                }
                if($resultado["mostaza"] == 1){
                    echo "Mostaza<br>";
                }
                if($resultado["sesamo"] == 1){
                    echo "Sésamo<br>";
                }
                if($resultado["sulfitos"] == 1){
                    echo "Sulfitos<br>";
                }
                if($resultado["moluscos"] == 1){
                    echo "Moluscos<br>";
                }
                if($resultado["altramuces"] == 1){
                    echo "Altramuces<br>";
                }
                
            }
                if($resultado["vegan"] == 1 || $resultado["vegetarian"] == 1){
                    
                    echo "<h4>Preferencias alimenticias:</h4>";

                    if($resultado["vegan"] == 1){
                        echo "Vegan<br>";
                    }
                    if($resultado["vegetarian"] == 1){
                        echo "Vegetarian<br>";
                    }    
                }
                echo "<h4>Ingredientes</h4>";
                echo $resultado["ingredientes"]."<br>";
                echo "<h4>Preparación</h4>";
                echo $resultado["receta"]."<br>";
                echo " <form method=\"POST\" action=\"".$_SERVER["PHP_SELF"]."\" name=\"gestion\" enctype=\"multipart/form-data\">
                <button type= \"button\" name= \"aceptar\">Aceptar</button> 
                <button type = \"button\" name= \"rechazar\">Rechazar</button>
                </form>";
                $idReceta = $db->getIdReceta($resultado["receta"]);
                $_SESSION["idReceta"] = $idReceta;
                if(isset($_POST["aceptar"])){
                    echo "Aceptar receta";
                    $resultado = $db->aceptarReceta($idReceta);
                } elseif(isset($_POST["rechazar"])){
                    echo "Rechazar receta";
                    $resultado = $db->rechazarReceta($idReceta);
                }
            } else{
                $_SESSION['mensajeError']='No hay recetas para gestionar';
                throw new Exception("No hay recetas para gestionar");
              
            }

        }catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logException.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '/../vista/paginas/gestion.php';
    }
    public function guardados()
    {
        require __DIR__ . '/../vista/paginas/guardados.php';
    }
    public function perfil()
    {
        
        
        try{
            $db = new Model();
            $idUser = $_SESSION["idUser"];
            $resultado = $db->getPerfil($idUser);
            if($resultado){
                ob_start();
                echo "<h1> ".$_SESSION["user"]."</h1>"; 
                echo "Nombre: ".$resultado["nomUser"]." ";
                echo $resultado ["apUser"]."<br>";
                echo "Email: ".$resultado["email"]."<br>";
                echo "Nombre de usuario: ".$resultado["user"]."<br>";
                echo "Contraseña: ".$resultado["pwd"]."<br>";
                echo "Biografía: ".$resultado["bio"]."<br>";
                echo $resultado["pfp"]."<br>";
                if($resultado["gluten"] == 1 || $resultado["crustaceos"] == 1 || 
                $resultado["huevos"] == 1 || $resultado["pescado"] == 1 ||
                $resultado["cacahuetes"] == 1 || $resultado["soja"] == 1 ||
                $resultado["lactosa"] == 1 || $resultado["frutosdecascara"] == 1 ||
                $resultado["apio"] == 1 || $resultado["mostaza"] == 1 || 
                $resultado["sesamo"] == 1 || $resultado["sulfitos"] == 1 || 
                $resultado["moluscos"] == 1 || $resultado["altramuces"] == 1){
                echo "<h2>Alérgenos:</h2>";
                if($resultado["gluten"] == 1){
                    echo "Gluten <br>";
                }
                if($resultado["crustaceos"] == 1){
                    echo "Crustáceos <br>";
                }if($resultado["huevos"] == 1){
                    echo "Huevos<br>";
                }
                if($resultado["pescado"] == 1){
                    echo "Pescado<br>";
                }
                if($resultado["cacahuetes"] == 1){
                    echo "Cacahuetes<br>";
                }
                if($resultado["soja"] == 1){
                    echo "Soja<br>";
                }
                if($resultado["lactosa"] == 1){
                    echo "Lactosa <br>";
                }
                if($resultado["frutosdecascara"] == 1){
                    echo "Frutos de cáscara<br>";
                }
                if($resultado["apio"] == 1){
                    echo "Apio<br>";
                }
                if($resultado["mostaza"] == 1){
                    echo "Mostaza<br>";
                }
                if($resultado["sesamo"] == 1){
                    echo "Sésamo<br>";
                }
                if($resultado["sulfitos"] == 1){
                    echo "Sulfitos<br>";
                }
                if($resultado["moluscos"] == 1){
                    echo "Moluscos<br>";
                }
                if($resultado["altramuces"] == 1){
                    echo "Altramuces<br>";
                }
                
            }
                if($resultado["vegan"] == 1 || $resultado["vegetarian"] == 1){
                    
                    echo "<h2>Preferencias alimenticias:</h2>";

                    if($resultado["vegan"] == 1){
                        echo "Vegan<br>";
                    }
                    if($resultado["vegetarian"] == 1){
                        echo "Vegetarian<br>";
                    }    
                }
                
            }else{
                $_SESSION['mensajeError']='Ha habido un error a la hora de visualizar el contenido';
                throw new Exception("Ha habido un error a la hora de visualizar el contenido");
            }
        }catch (Exception $e) {
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
            $aprobada = 0;
            $cont = 0;
            $fecha_subida = date('Y-m-d H:i:s');
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
                
                //LO PASAMOS A EJECUTAR AL MODELO
                                  
                                
                $db = new Model();
                $idUser = $_SESSION["idUser"];
                
                $resultado = $db->setReceta($nomReceta, $receta, $tPrep, $fecha_subida, $ingredientes, $idUser, $aprobada, 
                $gluten, $crustaceos, $huevos, $pescado, $cacahuetes, $soja, $lactosa, $frutosdecascara, 
                $apio, $mostaza, $sesamo, $sulfitos, $moluscos, $altramuces, $vegan, $vegetarian);
                
                if ($resultado) {
                	header('Location: index.php?ctl=inicio');
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
