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
    public function setRegistro($nomUser, $apUser, $email, $user, $pwd, $bio = 'NULL', $pfp = 'NULL')
    {
        $consultaUsu = "insert into users (nomUser, apUser, email, user, pwd, bio, pfp) values ($nomUser, 
        $apUser, $email, $user, $pwd, $bio, $pfp)";
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

    public function setAlergenos()
    {
    }
}
