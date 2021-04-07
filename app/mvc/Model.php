<?php
include_once('Config.php');

class Model extends PDO
{

    protected $conexion;

    public function __construct()
    {
        $this->conexion = new PDO('mysql:host=' . Config::$mvc_bd_hostname . ';dbname=' . Config::$mvc_bd_nombre . '', Config::$mvc_bd_usuario, Config::$mvc_bd_clave);
        // Realiza el enlace con la BD en utf-8
        $this->conexion->exec("set names utf8");
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function getLogin($user, $pwd)
    {
        $consulta = "select user, pwd, admin from users where user=:user and pwd=:pwd";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':user', $user);
        $result->bindParam(':pwd', $pwd);
        $result->execute();
        $result->fetch();
        return $result;
    }
    public function setRegistro($nomUser, $apUser, $email, $user, $pwd, $bio = NULL, $pfp = NULL)
    {
        $consultaUsu = "insert into users (nomUser, apUser, email, user, pwd, bio, pfp) values (:nomUser, 
        :apUser, :email, :user, :pwd, :bio, :pfp)";
        $result = $this->conexion->prepare($consultaUsu);
        $result->bindParam(':nomUser', $nomUser);
        $result->bindParam(':apUser', $apUser);
        $result->bindParam(':email', $email);
        $result->bindParam(':user', $user);
        $result->bindParam(':pwd', $pwd);
        $result->bindParam(':bio', $bio);
        $result->bindParam(':pfp', $pfp);
        $result->execute();

        return $result->fetch();
    }

    public function setAlergenos($gluten = '0', $crustaceos = '0', $huevos = '0', $pescado = '0', $cacahuetes = '0',
    $soja = '0', $lactosa = '0', $frutosdecascara = '0', $apio = '0', $mostaza = '0', $sesamo = '0', $sulfitos = '0',
    $moluscos = '0', $altramuces = '0', $vegan = '0', $vegetarian='0', $idUser = null, $idReceta = null)
    {
        $consulta = "insert into alergenos (gluten, crustaceos, huevos, pescado, cacahuetes, soja, lactosa,
        frutosdecascara, apio, mostaza, sesamo, sulfitos, moluscos, altramuces, vegan, vegetarian, idUser,
        idReceta) values (:gluten, :crustaceos, :huevos, :pescado, :cacahuetes, :soja, :lactosa, :frutosdecascara, 
        :apio, :mostaza, :sesamo, :sulfitoa, :moluscos, :altramuces, :vegan, :vegetarian, :idUser, :idReceta)";
        $result = $this->conexion->prepare($consulta);
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
        $result->bindParam(':idUser', $idUser);
        $result->bindParam(':idReceta', $idReceta);
        $result->execute();
        return $result->fetch();
    }

    public function getIdUser($user){
        $consulta = "select idUser from users where user=:user";
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':user', $user);
        $result->execute();
        $result-> fetch();
        return $result;
    }
}
