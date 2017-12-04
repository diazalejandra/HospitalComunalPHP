-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3308
-- Tiempo de generación: 04-12-2017 a las 05:16:07
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbhospital`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consulta`
--

DROP TABLE IF EXISTS `consulta`;
CREATE TABLE IF NOT EXISTS `consulta` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_fecha` datetime DEFAULT NULL,
  `con_paciente` varchar(10) DEFAULT NULL,
  `con_medico` varchar(10) DEFAULT NULL,
  `con_estado` char(10) DEFAULT NULL,
  PRIMARY KEY (`con_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `consulta`
--

INSERT INTO `consulta` (`con_id`, `con_fecha`, `con_paciente`, `con_medico`, `con_estado`) VALUES
(1, '2017-12-07 00:00:00', '14567987-0', '12345668-9', 'Agendada'),
(2, '2017-12-16 00:00:00', '14567987-0', '12345668-9', 'Agendada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medico`
--

DROP TABLE IF EXISTS `medico`;
CREATE TABLE IF NOT EXISTS `medico` (
  `med_rut` varchar(10) NOT NULL,
  `med_nombre` varchar(30) DEFAULT NULL,
  `med_apellido` varchar(30) DEFAULT NULL,
  `med_contrato` datetime DEFAULT NULL,
  `med_especialidad` varchar(50) DEFAULT NULL,
  `med_valor` int(11) DEFAULT NULL,
  PRIMARY KEY (`med_rut`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `medico`
--

INSERT INTO `medico` (`med_rut`, `med_nombre`, `med_apellido`, `med_contrato`, `med_especialidad`, `med_valor`) VALUES
('12345668-9', 'Juan', 'Perez', '2014-12-31 00:00:00', 'Medico General', 40000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

DROP TABLE IF EXISTS `paciente`;
CREATE TABLE IF NOT EXISTS `paciente` (
  `pac_rut` varchar(10) NOT NULL,
  `pac_nombre` varchar(30) DEFAULT NULL,
  `pac_apellido` varchar(30) DEFAULT NULL,
  `pac_nacimiento` date DEFAULT NULL,
  `pac_sexo` char(1) DEFAULT NULL,
  `pac_direccion` varchar(50) DEFAULT NULL,
  `pac_telefono` int(11) DEFAULT NULL,
  PRIMARY KEY (`pac_rut`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`pac_rut`, `pac_nombre`, `pac_apellido`, `pac_nacimiento`, `pac_sexo`, `pac_direccion`, `pac_telefono`) VALUES
('14567987-0', 'Juan', 'Perez', NULL, 'M', 'Avenida Juan Perez 123, Santiago', 982345565);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

DROP TABLE IF EXISTS `perfil`;
CREATE TABLE IF NOT EXISTS `perfil` (
  `per_id` char(3) NOT NULL,
  `per_descripcion` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`per_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`per_id`, `per_descripcion`) VALUES
('DIR', 'Director'),
('ADM', 'Administrador'),
('SEC', 'Secretaria'),
('PAC', 'Paciente'),
('MED', 'Medico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `usu_id` varchar(10) NOT NULL,
  `usu_nombre` varchar(30) DEFAULT NULL,
  `usu_perfil` char(3) DEFAULT NULL,
  `usu_password` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`usu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usu_id`, `usu_nombre`, `usu_perfil`, `usu_password`) VALUES
('16470185-9', 'Alejandra Diaz', 'PAC', '1234'),
('12345678-9', 'Juan Perez', 'ADM', '12345'),
('14567987-9', 'Juan Perez', 'PAC', '1234'),
('14567987-0', 'Juan Perez', 'PAC', '1234'),
('12345668-9', 'Juan Perez', 'MED', '1234');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
