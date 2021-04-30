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
  `admin` BIT NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `recetas` (
  `idReceta` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `nomReceta` varchar(100) NOT NULL,
  `receta` text NOT NULL UNIQUE,
  `tPrep` varchar(30) NOT NULL,
  `fecha_subida` date NOT NULL,
  `ingredientes` text NOT NULL,
  `aprobada` BIT NOT NULL,
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  FOREIGN KEY (`idUser`) REFERENCES users(`idUser`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `alergenos` (
  `gluten` BIT NOT NULL DEFAULT 0,
  `crustaceos` BIT NOT NULL DEFAULT 0,
  `huevos` BIT NOT NULL DEFAULT 0,
  `pescado` BIT NOT NULL DEFAULT 0,
  `cacahuetes` BIT NOT NULL DEFAULT 0,
  `soja` BIT NOT NULL DEFAULT 0,
  `lactosa` BIT NOT NULL DEFAULT 0,
  `frutosdecascara` BIT NOT NULL DEFAULT 0,
  `apio` BIT NOT NULL DEFAULT 0,
  `mostaza` BIT NOT NULL DEFAULT 0,
  `sesamo` BIT NOT NULL DEFAULT 0,
  `sulfitos` BIT NOT NULL DEFAULT 0,
  `moluscos` BIT NOT NULL DEFAULT 0,
  `altramuces` BIT NOT NULL DEFAULT 0,
  `vegan` BIT NOT NULL DEFAULT 0,
  `vegetarian` BIT NOT NULL DEFAULT 0,
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
  