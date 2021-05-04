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
  `pfp` varchar(255),
  `admin` TINYINT(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `recetas` (
  `idReceta` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nomReceta` varchar(100) NOT NULL,
  `receta` text NOT NULL UNIQUE,
  `tPrep` varchar(30) NOT NULL,
  `fecha_subida` datetime NOT NULL,
  `ingredientes` text NOT NULL,
  `aprobada` TINYINT(1) NOT NULL,
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  FOREIGN KEY (`idUser`) REFERENCES users(`idUser`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `alergenos` (
  `gluten` TINYINT(1) NOT NULL DEFAULT 0,
  `crustaceos` TINYINT(1) NOT NULL DEFAULT 0,
  `huevos` TINYINT(1) NOT NULL DEFAULT 0,
  `pescado` TINYINT(1) NOT NULL DEFAULT 0,
  `cacahuetes` TINYINT(1) NOT NULL DEFAULT 0,
  `soja` TINYINT(1) NOT NULL DEFAULT 0,
  `lactosa` TINYINT(1) NOT NULL DEFAULT 0,
  `frutosdecascara` TINYINT(1) NOT NULL DEFAULT 0,
  `apio` TINYINT(1) NOT NULL DEFAULT 0,
  `mostaza` TINYINT(1) NOT NULL DEFAULT 0,
  `sesamo` TINYINT(1) NOT NULL DEFAULT 0,
  `sulfitos` TINYINT(1) NOT NULL DEFAULT 0,
  `moluscos` TINYINT(1) NOT NULL DEFAULT 0,
  `altramuces` TINYINT(1) NOT NULL DEFAULT 0,
  `vegan` TINYINT(1) NOT NULL DEFAULT 0,
  `vegetarian` TINYINT(1) NOT NULL DEFAULT 0,
  `idUser` int(11),
  FOREIGN KEY (`idUser`) REFERENCES users(`idUser`) ON DELETE CASCADE,
  `idReceta` int(11),
  FOREIGN KEY (`idReceta`) REFERENCES recetas(`idReceta`) ON DELETE CASCADE
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
  