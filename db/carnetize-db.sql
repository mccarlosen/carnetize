-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2014 a las 16:40:47
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `carnetize-db` 
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `connections`
--

CREATE TABLE IF NOT EXISTS `connections` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name_connection` varchar(25) NOT NULL,
  `name_db` varchar(15) NOT NULL,
  `host_db` varchar(40) NOT NULL,
  `user_db` varchar(15) NOT NULL,
  `pwd_db` varchar(15) NOT NULL,
  `name_table_db` varchar(15) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `connections`
--

INSERT INTO `connections` (`id`, `name_connection`, `name_db`, `host_db`, `user_db`, `pwd_db`, `name_table_db`, `status`) VALUES
(15, 'DS Profesores', 'demo', 'localhost', 'root', '', 'teachers', 1),
(16, 'DS Estudiantes', 'demo', 'localhost', 'root', '', 'students', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `designs`
--

CREATE TABLE IF NOT EXISTS `designs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_connection` int(11) unsigned NOT NULL,
  `name` varchar(25) NOT NULL,
  `url_design` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_connection` (`id_connection`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`) VALUES
(7, 'osen', '59d2b2a4e3cd855518193ed072d41b765b697c58', 'carnetizer', '2014-08-17 06:19:09', '2014-08-17 06:19:09'),
(8, 'joedoe', '59d2b2a4e3cd855518193ed072d41b765b697c58', 'carnetizer', '2014-08-17 06:48:21', '2014-08-17 06:48:21'),
(9, 'osenadmin', '4563b3bddf0293a1a6903cfafc4be7d0c89c7e4d', 'admin', '2014-08-17 17:48:19', '2014-08-17 17:48:19');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `designs`
--
ALTER TABLE `designs`
  ADD CONSTRAINT `designs_ibfk_1` FOREIGN KEY (`id_connection`) REFERENCES `connections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
