-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.6.16 - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para modulo_mapa
DROP DATABASE IF EXISTS `modulo_mapa`;
CREATE DATABASE IF NOT EXISTS `modulo_mapa` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `modulo_mapa`;


-- Volcando estructura para tabla modulo_mapa.local
DROP TABLE IF EXISTS `local`;
CREATE TABLE IF NOT EXISTS `local` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitud` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `latitud` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estado` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_carga` datetime NOT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `fecha_baja` datetime DEFAULT NULL,
  `usuario_id_carga` int(11) NOT NULL,
  `usuario_id_modificacion` int(11) DEFAULT NULL,
  `usuario_id_baja` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla modulo_mapa.local: ~0 rows (aproximadamente)
DELETE FROM `local`;
/*!40000 ALTER TABLE `local` DISABLE KEYS */;
/*!40000 ALTER TABLE `local` ENABLE KEYS */;


-- Volcando estructura para tabla modulo_mapa.usuario
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `clave` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_visible` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estado` char(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla modulo_mapa.usuario: ~1 rows (aproximadamente)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nombre`, `clave`, `nombre_visible`, `estado`) VALUES
	(1, '8b7258dd891a710d4880ea4edaeff224606a3417', 'ed4eac4202077080d1c73f6eccda26a3deef7457', 'Superadmin', 'A');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;


-- Volcando estructura para tabla modulo_mapa.usuario_acceso
DROP TABLE IF EXISTS `usuario_acceso`;
CREATE TABLE IF NOT EXISTS `usuario_acceso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_usuario_acceso_usuario` (`usuario_id`),
  CONSTRAINT `FK_usuario_acceso_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla modulo_mapa.usuario_acceso: ~0 rows (aproximadamente)
DELETE FROM `usuario_acceso`;
/*!40000 ALTER TABLE `usuario_acceso` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_acceso` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
