-- --------------------------------------------------------
-- Host:                         localhost
-- Server-Version:               8.2.0 - MySQL Community Server - GPL
-- Server-Betriebssystem:        Linux
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Exportiere Datenbank-Struktur für odin
CREATE DATABASE IF NOT EXISTS `odin` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `odin`;

-- Exportiere Struktur von Tabelle odin.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportiere Daten aus Tabelle odin.user: ~1 rows (ungefähr)
DELETE FROM `user`;
INSERT INTO `user` (`id`, `username`, `password`) VALUES
	(1, 'Flo', '%721342');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
INSERT INTO `user` (`id`, `username`, `password`) VALUES
	(1, 'Flo', '%721342');
INSERT INTO `user` (`id`, `username`, `password`) VALUES
	(1, 'Flo', '%721342');
INSERT INTO `user` (`id`, `username`, `password`) VALUES
	(1, 'Flo', '%721342');
INSERT INTO `odin`.`user` (`username`, `password`) VALUES ('Benny', '123');
INSERT INTO `odin`.`user` (`username`, `password`) VALUES ('Maxi', '123');
INSERT INTO `odin`.`user` (`username`, `password`) VALUES ('Test', '123');
INSERT INTO `odin`.`user` (`username`) VALUES ('Bene');
INSERT INTO `odin`.`user` (`username`, `password`) VALUES ('Bene', '123');
INSERT INTO `user` (`id`, `username`, `password`) VALUES
	(1, 'Flo', '%721342');
INSERT INTO `user` (`id`, `username`, `password`) VALUES
	(1, 'Flo', '%721342');
INSERT INTO `user` (`id`, `username`, `password`) VALUES
	(1, 'Flo', '%721342');
INSERT INTO `user` (`id`, `username`, `password`) VALUES
	(1, 'Flo', '%721342');
INSERT INTO `odin`.`user` (`username`, `password`) VALUES ('Benny', '123');
INSERT INTO `odin`.`user` (`username`, `password`) VALUES ('Maxi', '123');
INSERT INTO `odin`.`user` (`username`, `password`) VALUES ('Test', '123');
INSERT INTO `odin`.`user` (`username`) VALUES ('Bene');
INSERT INTO `odin`.`user` (`username`, `password`) VALUES ('Bene', '123');
