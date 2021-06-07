<?php
include_once('Config.php');

class Model extends PDO
{

    protected $conexion;

    public function __construct()
    {
        $this->conexion = new PDO(
            'mysql:host=' . Config::$mvc_bd_hostname .
                ';dbname=' . Config::$mvc_bd_nombre . '',
            Config::$mvc_bd_usuario,
            Config::$mvc_bd_clave
        );
        $this->conexion->exec("set names utf8");
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    public function getLogin($user, $pwd)
    {
        $consulta = "select user, pwd from users where user=:user and pwd=:pwd";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':user', $user);
        $result->bindParam(':pwd', $pwd);
        $result->execute();
        $row = $result->fetch();
        if ($row == false) return false;
        else return true;
    }


    public function setRegistro(
        $nomUser,
        $apUser,
        $email,
        $user,
        $pwd,
        $bio = NULL,
        $gluten = 0,
        $crustaceos = 0,
        $huevos = 0,
        $pescado = 0,
        $cacahuetes = 0,
        $soja = 0,
        $lactosa = 0,
        $frutosdecascara = 0,
        $apio = 0,
        $mostaza = 0,
        $sesamo = 0,
        $sulfitos = 0,
        $moluscos = 0,
        $altramuces = 0,
        $vegan = 0,
        $vegetarian = 0
    ) {
        $consultaUsu = "insert into users (
        nomUser, apUser, email, user, pwd, bio,
        gluten, crustaceos, huevos, pescado, cacahuetes, soja, lactosa, frutosdecascara, 
        apio, mostaza, sesamo, sulfitos, moluscos, altramuces, vegan, vegetarian
        ) values (
        :nomUser, :apUser, :email, :user, :pwd, :bio,
        :gluten, :crustaceos, :huevos, :pescado, :cacahuetes, :soja, :lactosa, :frutosdecascara, 
        :apio, :mostaza, :sesamo, :sulfitos, :moluscos, :altramuces, :vegan, :vegetarian
        )";
        $result = $this->conexion->prepare($consultaUsu);
        $result->bindParam(':nomUser', $nomUser);
        $result->bindParam(':apUser', $apUser);
        $result->bindParam(':email', $email);
        $result->bindParam(':user', $user);
        $result->bindParam(':pwd', $pwd);
        $result->bindParam(':bio', $bio);
        $result->bindParam(':gluten', $gluten);
        $result->bindParam(':crustaceos', $crustaceos);
        $result->bindParam(':huevos', $huevos);
        $result->bindParam(':pescado', $pescado);
        $result->bindParam(':cacahuetes', $cacahuetes);
        $result->bindParam(':soja', $soja);
        $result->bindParam(':lactosa', $lactosa);
        $result->bindParam(':frutosdecascara', $frutosdecascara);
        $result->bindParam(':apio', $apio);
        $result->bindParam(':mostaza', $mostaza);
        $result->bindParam(':sesamo', $sesamo);
        $result->bindParam(':sulfitos', $sulfitos);
        $result->bindParam(':moluscos', $moluscos);
        $result->bindParam(':altramuces', $altramuces);
        $result->bindParam(':vegan', $vegan);
        $result->bindParam(':vegetarian', $vegetarian);
        $result->execute();
        $result->fetch();
        return $result;
    }

    public function setImg($idReceta, $img)
    {
        $consulta = "insert into fotosreceta(idReceta, rutafoto) values (:idReceta, :img)";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':idRecceta', $idReceta);
        $result->bindParam(':img', $img);
        $result->execute();
        $result->fetch();
        return $result;
    }

    public function getIdUser($user)
    {
        $consulta = "select idUser from users where user=:user";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':user', $user);
        $result->execute();
        $row = $result->fetch();
        return $row["idUser"];
    }

    public function getAdmin($user)
    {
        $consulta = "select admin from users where user=:user";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':user', $user);
        $result->execute();
        $row = $result->fetch();
        return $row["admin"];
    }

    public function setReceta(
        $nomReceta,
        $receta,
        $tPrep,
        $fecha_subida,
        $ingredientes,
        $idUser,
        $aprobada = 0,
        $gluten = 0,
        $crustaceos = 0,
        $huevos = 0,
        $pescado = 0,
        $cacahuetes = 0,
        $soja = 0,
        $lactosa = 0,
        $frutosdecascara = 0,
        $apio = 0,
        $mostaza = 0,
        $sesamo = 0,
        $sulfitos = 0,
        $moluscos = 0,
        $altramuces = 0,
        $vegan = 0,
        $vegetarian = 0
    ) {
        $consulta = "insert into recetas (
        nomReceta, receta, tPrep, fecha_subida, ingredientes, aprobada, idUser,
        gluten, crustaceos, huevos, pescado, cacahuetes, soja, lactosa, frutosdecascara, 
        apio, mostaza, sesamo, sulfitos, moluscos, altramuces, vegan, vegetarian
        ) values (
        :nomReceta, :receta, :tPrep, :fecha_subida, :ingredientes, :aprobada, :idUser,
        :gluten, :crustaceos, :huevos, :pescado, :cacahuetes, :soja, :lactosa, :frutosdecascara, 
        :apio, :mostaza, :sesamo, :sulfitos, :moluscos, :altramuces, :vegan, :vegetarian)";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':nomReceta', $nomReceta);
        $result->bindParam(':receta', $receta);
        $result->bindParam(':tPrep', $tPrep);
        $result->bindParam(':fecha_subida', $fecha_subida);
        $result->bindParam(':ingredientes', $ingredientes);
        $result->bindParam(':aprobada', $aprobada);
        $result->bindParam(':idUser', $idUser);
        $result->bindParam(':gluten', $gluten);
        $result->bindParam(':crustaceos', $crustaceos);
        $result->bindParam(':huevos', $huevos);
        $result->bindParam(':pescado', $pescado);
        $result->bindParam(':cacahuetes', $cacahuetes);
        $result->bindParam(':soja', $soja);
        $result->bindParam(':lactosa', $lactosa);
        $result->bindParam(':frutosdecascara', $frutosdecascara);
        $result->bindParam(':apio', $apio);
        $result->bindParam(':mostaza', $mostaza);
        $result->bindParam(':sesamo', $sesamo);
        $result->bindParam(':sulfitos', $sulfitos);
        $result->bindParam(':moluscos', $moluscos);
        $result->bindParam(':altramuces', $altramuces);
        $result->bindParam(':vegan', $vegan);
        $result->bindParam(':vegetarian', $vegetarian);
        $result->execute();
        $result->fetch();

        return $result;
    }

    public function getRecetasNoAprobadas()
    {
        $consulta = "SELECT `nomReceta`, `receta`, `tPrep`, `fecha_subida`, `ingredientes`, `aprobada`, `idUser`, `gluten`, `crustaceos`, `huevos`, `pescado`, `cacahuetes`, `soja`, `lactosa`, `frutosdecascara`, `apio`, `mostaza`, `sesamo`, `sulfitos`, `moluscos`, `altramuces`, `vegan`, `vegetarian` FROM `recetas` WHERE aprobada = 0 LIMIT 1";
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        $row = $result->fetchAll();
        return $row;
    }
    public function getRecetas()
    {
        $consulta = "SELECT `nomReceta`, `receta`, `tPrep`, `fecha_subida`, `ingredientes`, 
        `aprobada`, `idUser`, `gluten`, `crustaceos`, `huevos`, `pescado`, `cacahuetes`, `soja`, 
        `lactosa`, `frutosdecascara`, `apio`, `mostaza`, `sesamo`, `sulfitos`, `moluscos`, `altramuces`, 
        `vegan`, `vegetarian` FROM `recetas` WHERE aprobada = 1";
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        $row = $result->fetchAll();
        return $row;
    }
    public function getRecetasGluten()
    {
        $consulta = "SELECT `nomReceta`, `receta`, `tPrep`, `fecha_subida`, `ingredientes`, 
        `aprobada`, `idUser`, `gluten`, `crustaceos`, `huevos`, `pescado`, `cacahuetes`, `soja`, 
        `lactosa`, `frutosdecascara`, `apio`, `mostaza`, `sesamo`, `sulfitos`, `moluscos`, `altramuces`, 
        `vegan`, `vegetarian` FROM `recetas` WHERE aprobada = 1 AND gluten = 1";
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        $row = $result->fetchAll();
        return $row;
    }
    public function getRecetasCrustaceos()
    {
        $consulta = "SELECT `nomReceta`, `receta`, `tPrep`, `fecha_subida`, `ingredientes`, 
        `aprobada`, `idUser`, `gluten`, `crustaceos`, `huevos`, `pescado`, `cacahuetes`, `soja`, 
        `lactosa`, `frutosdecascara`, `apio`, `mostaza`, `sesamo`, `sulfitos`, `moluscos`, `altramuces`, 
        `vegan`, `vegetarian` FROM `recetas` WHERE aprobada = 1 AND crustaceos = 1";
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        $row = $result->fetchAll();
        return $row;
    }
    public function getRecetasHuevos()
    {
        $consulta = "SELECT `nomReceta`, `receta`, `tPrep`, `fecha_subida`, `ingredientes`, 
        `aprobada`, `idUser`, `gluten`, `crustaceos`, `huevos`, `pescado`, `cacahuetes`, `soja`, 
        `lactosa`, `frutosdecascara`, `apio`, `mostaza`, `sesamo`, `sulfitos`, `moluscos`, `altramuces`, 
        `vegan`, `vegetarian` FROM `recetas` WHERE aprobada = 1 AND huevos = 1";
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        $row = $result->fetchAll();
        return $row;
    }
    public function getRecetasPescado()
    {
        $consulta = "SELECT `nomReceta`, `receta`, `tPrep`, `fecha_subida`, `ingredientes`, 
        `aprobada`, `idUser`, `gluten`, `crustaceos`, `huevos`, `pescado`, `cacahuetes`, `soja`, 
        `lactosa`, `frutosdecascara`, `apio`, `mostaza`, `sesamo`, `sulfitos`, `moluscos`, `altramuces`, 
        `vegan`, `vegetarian` FROM `recetas` WHERE aprobada = 1 AND pescado = 1";
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        $row = $result->fetchAll();
        return $row;
    }
    public function getRecetasCacahuetes()
    {
        $consulta = "SELECT `nomReceta`, `receta`, `tPrep`, `fecha_subida`, `ingredientes`, 
        `aprobada`, `idUser`, `gluten`, `crustaceos`, `huevos`, `pescado`, `cacahuetes`, `soja`, 
        `lactosa`, `frutosdecascara`, `apio`, `mostaza`, `sesamo`, `sulfitos`, `moluscos`, `altramuces`, 
        `vegan`, `vegetarian` FROM `recetas` WHERE aprobada = 1 AND cacahuetes = 1";
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        $row = $result->fetchAll();
        return $row;
    }
    public function getRecetasSoja()
    {
        $consulta = "SELECT `nomReceta`, `receta`, `tPrep`, `fecha_subida`, `ingredientes`, 
        `aprobada`, `idUser`, `gluten`, `crustaceos`, `huevos`, `pescado`, `cacahuetes`, `soja`, 
        `lactosa`, `frutosdecascara`, `apio`, `mostaza`, `sesamo`, `sulfitos`, `moluscos`, `altramuces`, 
        `vegan`, `vegetarian` FROM `recetas` WHERE aprobada = 1 AND soja = 1";
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        $row = $result->fetchAll();
        return $row;
    }
    public function getRecetasLactosa()
    {
        $consulta = "SELECT `nomReceta`, `receta`, `tPrep`, `fecha_subida`, `ingredientes`, 
        `aprobada`, `idUser`, `gluten`, `crustaceos`, `huevos`, `pescado`, `cacahuetes`, `soja`, 
        `lactosa`, `frutosdecascara`, `apio`, `mostaza`, `sesamo`, `sulfitos`, `moluscos`, `altramuces`, 
        `vegan`, `vegetarian` FROM `recetas` WHERE aprobada = 1 AND lactosa = 1";
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        $row = $result->fetchAll();
        return $row;
    }
    public function getRecetasFrutosCascara()
    {
        $consulta = "SELECT `nomReceta`, `receta`, `tPrep`, `fecha_subida`, `ingredientes`, 
        `aprobada`, `idUser`, `gluten`, `crustaceos`, `huevos`, `pescado`, `cacahuetes`, `soja`, 
        `lactosa`, `frutosdecascara`, `apio`, `mostaza`, `sesamo`, `sulfitos`, `moluscos`, `altramuces`, 
        `vegan`, `vegetarian` FROM `recetas` WHERE aprobada = 1 AND frutosdecascara = 1";
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        $row = $result->fetchAll();
        return $row;
    }
    public function getRecetasApio()
    {
        $consulta = "SELECT `nomReceta`, `receta`, `tPrep`, `fecha_subida`, `ingredientes`, 
        `aprobada`, `idUser`, `gluten`, `crustaceos`, `huevos`, `pescado`, `cacahuetes`, `soja`, 
        `lactosa`, `frutosdecascara`, `apio`, `mostaza`, `sesamo`, `sulfitos`, `moluscos`, `altramuces`, 
        `vegan`, `vegetarian` FROM `recetas` WHERE aprobada = 1 AND apio = 1";
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        $row = $result->fetchAll();
        return $row;
    }
    public function getRecetasMostaza()
    {
        $consulta = "SELECT `nomReceta`, `receta`, `tPrep`, `fecha_subida`, `ingredientes`, 
        `aprobada`, `idUser`, `gluten`, `crustaceos`, `huevos`, `pescado`, `cacahuetes`, `soja`, 
        `lactosa`, `frutosdecascara`, `apio`, `mostaza`, `sesamo`, `sulfitos`, `moluscos`, `altramuces`, 
        `vegan`, `vegetarian` FROM `recetas` WHERE aprobada = 1 AND mostaza = 1";
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        $row = $result->fetchAll();
        return $row;
    }
    public function getRecetasSesamo()
    {
        $consulta = "SELECT `nomReceta`, `receta`, `tPrep`, `fecha_subida`, `ingredientes`, 
        `aprobada`, `idUser`, `gluten`, `crustaceos`, `huevos`, `pescado`, `cacahuetes`, `soja`, 
        `lactosa`, `frutosdecascara`, `apio`, `mostaza`, `sesamo`, `sulfitos`, `moluscos`, `altramuces`, 
        `vegan`, `vegetarian` FROM `recetas` WHERE aprobada = 1 AND sesamo = 1";
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        $row = $result->fetchAll();
        return $row;
    }
    public function getRecetasSulfitos()
    {
        $consulta = "SELECT `nomReceta`, `receta`, `tPrep`, `fecha_subida`, `ingredientes`, 
        `aprobada`, `idUser`, `gluten`, `crustaceos`, `huevos`, `pescado`, `cacahuetes`, `soja`, 
        `lactosa`, `frutosdecascara`, `apio`, `mostaza`, `sesamo`, `sulfitos`, `moluscos`, `altramuces`, 
        `vegan`, `vegetarian` FROM `recetas` WHERE aprobada = 1 AND sulfitos = 1";
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        $row = $result->fetchAll();
        return $row;
    }
    public function getRecetasMoluscos()
    {
        $consulta = "SELECT `nomReceta`, `receta`, `tPrep`, `fecha_subida`, `ingredientes`, 
        `aprobada`, `idUser`, `gluten`, `crustaceos`, `huevos`, `pescado`, `cacahuetes`, `soja`, 
        `lactosa`, `frutosdecascara`, `apio`, `mostaza`, `sesamo`, `sulfitos`, `moluscos`, `altramuces`, 
        `vegan`, `vegetarian` FROM `recetas` WHERE aprobada = 1 AND moluscos = 1";
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        $row = $result->fetchAll();
        return $row;
    }
    public function getRecetasAltramuces()
    {
        $consulta = "SELECT `nomReceta`, `receta`, `tPrep`, `fecha_subida`, `ingredientes`, 
        `aprobada`, `idUser`, `gluten`, `crustaceos`, `huevos`, `pescado`, `cacahuetes`, `soja`, 
        `lactosa`, `frutosdecascara`, `apio`, `mostaza`, `sesamo`, `sulfitos`, `moluscos`, `altramuces`, 
        `vegan`, `vegetarian` FROM `recetas` WHERE aprobada = 1 AND altramuces = 1";
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        $row = $result->fetchAll();
        return $row;
    }
    public function getRecetasVegan()
    {
        $consulta = "SELECT `nomReceta`, `receta`, `tPrep`, `fecha_subida`, `ingredientes`, 
        `aprobada`, `idUser`, `gluten`, `crustaceos`, `huevos`, `pescado`, `cacahuetes`, `soja`, 
        `lactosa`, `frutosdecascara`, `apio`, `mostaza`, `sesamo`, `sulfitos`, `moluscos`, `altramuces`, 
        `vegan`, `vegetarian` FROM `recetas` WHERE aprobada = 1 AND vegan = 1";
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        $row = $result->fetchAll();
        return $row;
    }
    public function getRecetasVegetarian()
    {
        $consulta = "SELECT `nomReceta`, `receta`, `tPrep`, `fecha_subida`, `ingredientes`, 
        `aprobada`, `idUser`, `gluten`, `crustaceos`, `huevos`, `pescado`, `cacahuetes`, `soja`, 
        `lactosa`, `frutosdecascara`, `apio`, `mostaza`, `sesamo`, `sulfitos`, `moluscos`, `altramuces`, 
        `vegan`, `vegetarian` FROM `recetas` WHERE aprobada = 1 AND vegetarian = 1";
        $result = $this->conexion->prepare($consulta);
        $result->execute();
        $row = $result->fetchAll();
        return $row;
    }



    public function getIdReceta($receta)
    {
        $consulta = "select idReceta from recetas where receta=:receta";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':receta', $receta);
        $result->execute();
        $row = $result->fetch();
        return $row["idReceta"];
    }

    public function aceptarReceta($idReceta)
    {
        $consulta = "update recetas set aprobada = 1 where idReceta=:idReceta";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(":idReceta", $idReceta);
        $result->execute();
        $result->fetch();
        return $result;
    }

    public function rechazarReceta($idReceta)
    {
        $consulta = "delete from recetas where idReceta=:idReceta";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(":idReceta", $idReceta);
        $result->execute();
        $result->fetch();
        return $result;
    }


    public function getPerfil($idUser)
    {
        $consulta = "select `nomUser`, `apUser`, `email`, `user`, `pwd`, `bio`, `gluten`, `crustaceos`, `huevos`, `pescado`, `cacahuetes`, `soja`, `lactosa`, `frutosdecascara`, `apio`, `mostaza`, `sesamo`, `sulfitos`, `moluscos`, `altramuces`, `vegan`, `vegetarian` from `users` WHERE idUser=:idUser";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':idUser', $idUser);
        $result->execute();
        $row = $result->fetch();
        return $row;
    }

    public function editarPerfil($dbdato, $dato, $idUser)
    {
        $consulta = "update users set ".$dbdato."=:dato where idUser=:idUser";

        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':dato', $dato);
        $result->bindParam(':idUser', $idUser);

        $result->execute();
        $result->fetch();
        return $result;
    }

    public function borrarPerfil($idUser)
    {
        $consulta = "delete from users where idUser=:idUser";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':idUser', $idUser);
        $result->execute();
        $result->fetch();
        return $result;
    }
}
