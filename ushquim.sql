SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE DATABASE IF NOT EXISTS `ushquim` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
use `ushquim`;


CREATE TABLE `users` (
  `idUser` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nomUser` varchar(30) NOT NULL,
  `apUser` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `user` varchar(15) NOT NULL UNIQUE,
  `pwd` varchar(15) NOT NULL,
  `bio` varchar(240),
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `gluten` tinyint(1) NOT NULL DEFAULT 0,
  `crustaceos` tinyint(1) NOT NULL DEFAULT 0,
  `huevos` tinyint(1) NOT NULL DEFAULT 0,
  `pescado` tinyint(1) NOT NULL DEFAULT 0,
  `cacahuetes` tinyint(1) NOT NULL DEFAULT 0,
  `soja` tinyint(1) NOT NULL DEFAULT 0,
  `lactosa` tinyint(1) NOT NULL DEFAULT 0,
  `frutosdecascara` tinyint(1) NOT NULL DEFAULT 0,
  `apio` tinyint(1) NOT NULL DEFAULT 0,
  `mostaza` tinyint(1) NOT NULL DEFAULT 0,
  `sesamo` tinyint(1) NOT NULL DEFAULT 0,
  `sulfitos` tinyint(1) NOT NULL DEFAULT 0,
  `moluscos` tinyint(1) NOT NULL DEFAULT 0,
  `altramuces` tinyint(1) NOT NULL DEFAULT 0,
  `vegan` tinyint(1) NOT NULL DEFAULT 0,
  `vegetarian` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `recetas` (
  `idReceta` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nomReceta` varchar(100) NOT NULL,
  `receta` text NOT NULL UNIQUE,
  `tPrep` varchar(30) NOT NULL,
  `fecha_subida` datetime NOT NULL,
  `ingredientes` text NOT NULL,
  `aprobada` tinyint(1) NOT NULL,
  `idUser` int(11),
   FOREIGN KEY (`idUser`) REFERENCES users(`idUser`) ON DELETE SET NULL,
  `gluten` tinyint(1) NOT NULL DEFAULT 0,
  `crustaceos` tinyint(1) NOT NULL DEFAULT 0,
  `huevos` tinyint(1) NOT NULL DEFAULT 0,
  `pescado` tinyint(1) NOT NULL DEFAULT 0,
  `cacahuetes` tinyint(1) NOT NULL DEFAULT 0,
  `soja` tinyint(1) NOT NULL DEFAULT 0,
  `lactosa` tinyint(1) NOT NULL DEFAULT 0,
  `frutosdecascara` tinyint(1) NOT NULL DEFAULT 0,
  `apio` tinyint(1) NOT NULL DEFAULT 0,
  `mostaza` tinyint(1) NOT NULL DEFAULT 0,
  `sesamo` tinyint(1) NOT NULL DEFAULT 0,
  `sulfitos` tinyint(1) NOT NULL DEFAULT 0,
  `moluscos` tinyint(1) NOT NULL DEFAULT 0,
  `altramuces` tinyint(1) NOT NULL DEFAULT 0,
  `vegan` tinyint(1) NOT NULL DEFAULT 0,
  `vegetarian` tinyint(1) NOT NULL DEFAULT 0  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `comentarios` (
  `idCom` INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `comentario` text NOT NULL,
  `idUser` int(11) NOT NULL,
  FOREIGN KEY (`idUser`) REFERENCES users(`idUser`) ON DELETE CASCADE,
  `idReceta` int(11) NOT NULL,
  FOREIGN KEY (`idReceta`) REFERENCES recetas(`idReceta`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `puntuaciones` (
  `puntuacion` INT(5) NOT NULL,
  `usuarios` INT(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  FOREIGN KEY (`idUser`) REFERENCES users(`idUser`) ON DELETE CASCADE,
  `idReceta` int(11) NOT NULL,
  FOREIGN KEY (`idReceta`) REFERENCES recetas(`idReceta`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `guardados` (
  `idUser` int(11) NOT NULL,
  FOREIGN KEY (`idUser`) REFERENCES users(`idUser`)ON DELETE CASCADE ,
  `idReceta` int(11) NOT NULL,
  FOREIGN KEY (`idReceta`) REFERENCES recetas(`idReceta`)ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `fotosreceta` (
  `rutafoto` varchar(255) NOT NULL,
  `idReceta` int(11) NOT NULL,
  FOREIGN KEY (`idReceta`) REFERENCES recetas(`idReceta`) ON DELETE CASCADE  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  