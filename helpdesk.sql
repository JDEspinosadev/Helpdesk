-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-09-2026 a las 18:25:42
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `helpdesk`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `td_documento`
--

CREATE TABLE `td_documento` (
  `doc_id` int(11) NOT NULL,
  `tick_id` int(11) NOT NULL,
  `doc_nom` varchar(400) NOT NULL,
  `fech_crea` datetime NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `td_ticketdetalle`
--

CREATE TABLE `td_ticketdetalle` (
  `tickd_id` int(11) NOT NULL,
  `tick_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `tickd_descrip` mediumtext NOT NULL,
  `fech_crea` datetime NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `td_ticketdetalle`
--

INSERT INTO `td_ticketdetalle` (`tickd_id`, `tick_id`, `usu_id`, `tickd_descrip`, `fech_crea`, `est`) VALUES
(1, 10, 17, '<p>WYYTYERTYH</p>', '2026-02-05 12:42:19', 1),
(10, 0, 17, 'El ticket ha sido reabierto por el usuario.', '2026-02-06 09:22:28', 1),
(11, 10, 17, '<p>kjfaksjfaksjf</p>', '2026-02-06 09:23:12', 1),
(12, 11, 17, '<p>Se realizan las validaciones correspondientes y se procede a dar por cerrado el caso</p>', '2026-02-06 12:27:38', 1),
(13, 11, 17, '<p>jafsfas</p>', '2026-02-06 12:55:42', 1),
(14, 11, 17, '<p>hjhjkhkj</p>', '2026-02-06 14:35:15', 1),
(15, 10, 17, '<br><hr><p><strong>[Ticket reabierto el 6/2/2026, 19:04:52]</strong><br><strong>Motivo:</strong>ss<br><strong>Descripción</strong><p>jdjashajsd</p></p>', '2026-02-06 19:04:52', 1),
(16, 10, 17, '<p>kjaklsfksajfasdkf</p>', '2026-02-06 19:20:37', 1),
(17, 10, 17, '<p>msmmsmms</p>', '2026-02-06 19:24:20', 1),
(18, 10, 17, '<p>jkhkhk</p>', '2026-02-06 19:56:59', 1),
(19, 10, 17, 'Ticket Cerrado Correctamente', '2026-02-06 19:57:04', 1),
(20, 10, 17, '<br><hr><p><strong>[Ticket reabierto el 7/2/2026, 18:11:54]:</strong><br><strong>Motivo:</strong> msafas<br><strong>Descripción:</strong><p>xxczcz</p></p>', '2026-02-07 18:11:54', 1),
(21, 10, 17, '<p>djdjjd</p>', '2026-02-07 18:17:45', 1),
(22, 10, 17, 'Ticket Cerrado Correctamente', '2026-02-07 18:18:12', 1),
(23, 10, 17, 'El ticket ha sido reabierto por el usuario.', '2026-02-07 18:18:21', 1),
(24, 11, 17, '<p>jjjjj</p>', '2026-02-07 18:20:59', 1),
(25, 11, 17, 'Ticket Cerrado Correctamente', '2026-02-07 18:21:36', 1),
(26, 11, 17, 'El ticket ha sido reabierto por el usuario.', '2026-02-07 18:47:19', 1),
(27, 11, 17, '<br><hr><p><strong>[Ticket reabierto el 7/2/2026, 18:47:27]:</strong><br><strong>Motivo:</strong> ssafsadf<br><strong>Descripción:</strong><p>asffafafa</p></p>', '2026-02-07 18:47:27', 1),
(28, 11, 17, 'Ticket Cerrado Correctamente', '2026-02-07 18:47:58', 1),
(29, 10, 17, 'El ticket ha sido reasignado a un nuevo agente.', '2026-02-09 01:54:15', 1),
(30, 11, 17, 'El ticket ha sido reasignado a un nuevo agente.', '2026-02-09 01:54:35', 1),
(31, 11, 14, 'El ticket ha sido reabierto por el usuario.', '2026-02-09 02:05:37', 1),
(32, 11, 14, '<br><hr><p><strong>[Ticket reabierto el 9/2/2026, 2:05:53]:</strong><br><strong>Motivo:</strong> Seguimiento<br><strong>Descripción:</strong><p>Se realiza un nuevo hallazgo</p></p>', '2026-02-09 02:05:53', 1),
(33, 11, 14, 'Ticket Cerrado Correctamente', '2026-02-09 02:06:07', 1),
(34, 12, 14, 'El ticket ha sido reasignado a un nuevo agente.', '2026-02-12 08:38:37', 1),
(35, 12, 14, 'Ticket Cerrado Correctamente', '2026-02-12 15:51:56', 1),
(36, 10, 17, '<p>aeerrtdgsdfgsfdg4444422</p>', '2026-02-15 19:27:04', 1),
(37, 10, 17, 'Ticket Cerrado Correctamente', '2026-02-15 19:27:34', 1),
(38, 10, 17, 'El ticket ha sido reabierto por el usuario.', '2026-02-15 19:27:53', 1),
(39, 10, 17, '<br><hr><p><strong>[Ticket reabierto el 15/2/2026, 19:28:00]:</strong><br><strong>Motivo:</strong> jakasjklfjasdf<br><strong>Descripción:</strong><p>asdfasdfasdf</p></p>', '2026-02-15 19:28:00', 1),
(40, 18, 17, 'El ticket ha sido reasignado a un nuevo agente.', '2026-02-15 19:33:17', 1),
(41, 29, 17, 'El ticket ha sido reasignado a un nuevo agente.', '2026-02-20 13:51:15', 1),
(42, 29, 17, '<p>kllkaksjfas</p>', '2026-02-20 13:51:18', 1),
(43, 30, 17, 'Ticket reasignado al agente: Dairo Jair', '2026-02-20 15:09:41', 1),
(44, 30, 17, 'Ticket Cerrado Correctamente', '2026-02-20 15:10:10', 1),
(45, 30, 17, 'Ticket Cerrado Correctamente', '2026-02-20 15:10:13', 1),
(46, 30, 17, 'Ticket Cerrado Correctamente', '2026-02-20 15:10:26', 1),
(47, 30, 17, 'Ticket Cerrado Correctamente', '2026-02-20 15:10:26', 1),
(48, 30, 17, 'El ticket ha sido reabierto por el usuario.', '2026-02-20 15:13:17', 1),
(49, 30, 17, 'Ticket Cerrado Correctamente', '2026-02-20 15:13:23', 1),
(50, 31, 17, 'Ticket reasignado al agente: Yeimy Paola', '2026-02-20 15:41:50', 1),
(51, 19, 17, 'Ticket reasignado al agente: Brayam', '2026-02-20 15:43:28', 1),
(52, 32, 17, 'Ticket reasignado al agente: Daniel ', '2026-02-20 15:48:22', 1),
(53, 32, 17, 'Ticket reasignado al agente: Brayam', '2026-02-20 15:49:20', 1),
(54, 10, 17, 'Ticket Cerrado Correctamente', '2026-03-27 14:35:35', 1),
(55, 13, 17, 'Ticket Cerrado Correctamente', '2026-03-30 17:43:17', 1),
(56, 13, 17, 'Ticket reasignado al agente: Dairo Jair', '2026-03-30 17:48:00', 1),
(57, 13, 17, 'El ticket ha sido reabierto por el usuario.', '2026-03-30 17:48:13', 1),
(58, 13, 17, 'Ticket Cerrado Correctamente', '2026-03-30 17:48:22', 1),
(59, 14, 17, 'Ticket reasignado al agente: Brayam', '2026-03-30 17:52:18', 1),
(60, 33, 17, 'Ticket Cerrado Correctamente', '2026-03-31 12:40:24', 1),
(61, 34, 17, 'Ticket reasignado al agente: Dairo Jair', '2026-03-31 20:24:50', 1),
(62, 15, 17, 'Ticket reasignado al agente: Dairo Jair', '2026-04-05 19:31:56', 1),
(63, 37, 17, 'Ticket reasignado al agente: ', '2026-04-09 16:57:04', 1),
(64, 36, 17, 'Ticket reasignado al agente: Dairo Jair Cardenas Bayona', '2026-04-09 17:02:20', 1),
(65, 10, 17, 'El ticket ha sido reabierto por el usuario.', '2026-04-09 17:37:02', 1),
(66, 10, 17, 'Ticket reasignado al agente: Dairo Jair', '2026-04-09 17:37:15', 1),
(67, 17, 17, 'Ticket reasignado al agente: Brayam', '2026-04-10 12:33:14', 1),
(68, 16, 14, 'Ticket reasignado al agente: Yeimy Paola', '2026-04-10 12:57:38', 1),
(69, 40, 14, 'Ticket reasignado al agente: Yeimy Paola', '2026-04-10 14:22:37', 1),
(70, 0, 17, 'Ticket Cerrado Correctamente', '2026-04-10 16:32:34', 1),
(71, 0, 17, 'Ticket Cerrado Correctamente', '2026-04-10 16:33:21', 1),
(72, 0, 17, 'Ticket Cerrado Correctamente', '2026-04-10 16:35:15', 1),
(73, 0, 17, 'Ticket Cerrado Correctamente', '2026-04-10 17:13:18', 1),
(74, 0, 17, 'Ticket Cerrado Correctamente', '2026-04-10 17:13:36', 1),
(75, 10, 17, 'Ticket Cerrado Correctamente', '2026-04-10 18:14:56', 1),
(76, 0, 17, 'Ticket Cerrado Correctamente', '2026-04-11 09:45:49', 1),
(77, 20, 17, 'Ticket Cerrado Correctamente', '2026-04-11 10:03:21', 1),
(78, 20, 17, 'Ticket Cerrado Correctamente', '2026-04-11 10:03:48', 1),
(79, 10, 17, 'El ticket ha sido reabierto por el usuario.', '2026-04-11 10:56:42', 1),
(80, 10, 17, 'Ticket Cerrado Correctamente', '2026-04-11 10:56:51', 1),
(81, 30, 14, 'El ticket ha sido reabierto por el usuario.', '2026-04-11 10:57:56', 1),
(82, 18, 17, 'Ticket reasignado al agente: Yeimy Paola', '2026-04-11 10:59:33', 1),
(83, 37, 14, '<p>Este ticket debe ser atendido por Joshua Mendez</p>', '2026-04-13 17:01:51', 1),
(84, 37, 17, 'Ticket reasignado al agente: Joshua Andrey', '2026-04-13 17:02:45', 1),
(85, 38, 15, 'Ticket Cerrado Correctamente', '2026-04-13 17:06:54', 1),
(86, 37, 15, 'Ticket Cerrado Correctamente', '2026-04-13 17:07:17', 1),
(87, 41, 15, 'Ticket Cerrado Correctamente', '2026-04-13 17:07:26', 1),
(88, 39, 14, '<p>asfdsfadsf</p>', '2026-04-13 17:45:45', 1),
(89, 39, 14, 'Ticket Cerrado Correctamente', '2026-04-13 17:45:50', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_canal`
--

CREATE TABLE `tm_canal` (
  `canal_id` int(11) NOT NULL,
  `canal_nom` varchar(50) NOT NULL,
  `fech_crea` datetime DEFAULT current_timestamp(),
  `est` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_canal`
--

INSERT INTO `tm_canal` (`canal_id`, `canal_nom`, `fech_crea`, `est`) VALUES
(1, 'WhatsApp', '2026-02-18 00:58:11', 1),
(2, 'Google Chat', '2026-02-18 00:58:11', 1),
(3, 'Correo Electrónico', '2026-02-18 00:58:11', 1),
(4, 'Asignado Interno', '2026-02-18 00:58:11', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_division`
--

CREATE TABLE `tm_division` (
  `div_id` int(11) NOT NULL,
  `div_nom` varchar(155) NOT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_division`
--

INSERT INTO `tm_division` (`div_id`, `div_nom`, `est`) VALUES
(1, 'Bantracking', 1),
(2, 'Disatel', 1),
(3, 'Mosat ', 1),
(4, 'Satlock AVL', 1),
(5, 'Satlock Colombia', 1),
(6, 'Satlock Ecuador', 1),
(7, 'Satlock México', 1),
(8, 'Hardware Disatel', 1),
(9, 'Ultrack Colombia', 1),
(10, 'Ultrack Ecuador', 1),
(11, 'TMS', 1),
(12, 'Comercial', 1),
(13, 'Satlock Argentina', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_log`
--

CREATE TABLE `tm_log` (
  `log_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `log_accion` varchar(100) DEFAULT NULL,
  `log_tabla` varchar(50) DEFAULT NULL,
  `log_descripcion` text DEFAULT NULL,
  `fech_crea` datetime DEFAULT current_timestamp(),
  `est` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_log`
--

INSERT INTO `tm_log` (`log_id`, `usu_id`, `log_accion`, `log_tabla`, `log_descripcion`, `fech_crea`, `est`) VALUES
(1, 17, 'CREACION USUARIO', 'tm_usuario', 'Se creó nuevo usuario: Daniel  Guaqueta', '2026-02-20 15:47:01', 1),
(2, 17, 'REASIGNACION', 'tm_ticket', 'Se reasigno el ticket ID 32 al agente Brayam', '2026-02-20 15:49:20', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_log_acceso`
--

CREATE TABLE `tm_log_acceso` (
  `log_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `fech_acceso` datetime NOT NULL,
  `ip_acceso` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_log_ticket`
--

CREATE TABLE `tm_log_ticket` (
  `logt_id` int(11) NOT NULL,
  `usu_id` int(11) DEFAULT NULL,
  `tick_id` int(11) DEFAULT NULL,
  `logt_accion` varchar(50) DEFAULT NULL,
  `logt_detalle` text DEFAULT NULL,
  `fech_crea` datetime DEFAULT current_timestamp(),
  `faudit` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_log_ticket`
--

INSERT INTO `tm_log_ticket` (`logt_id`, `usu_id`, `tick_id`, `logt_accion`, `logt_detalle`, `fech_crea`, `faudit`) VALUES
(1, 17, 13, 'REASIGNACION', 'tm_ticket', '2026-03-30 17:48:00', '0000-00-00 00:00:00'),
(2, 17, 13, 'REAPERTURA', 'El ticket ha sido reabierto por el usuario.', '2026-03-30 17:48:13', '2026-03-31 00:48:13'),
(3, 17, 13, 'CIERRE', 'El ticket ha sido marcado como cerrado.', '2026-03-30 17:48:22', '2026-03-31 00:48:22'),
(4, 17, 14, 'REASIGNACION', 'Ticket transferido al agente: Brayam', '2026-03-30 17:52:18', '2026-03-31 00:52:18'),
(5, 17, 33, 'CREACION', 'El usuario generó un nuevo ticket de soporte.', '2026-03-30 17:52:48', '2026-03-31 00:52:48'),
(6, 17, 33, 'CIERRE', 'El ticket ha sido marcado como cerrado.', '2026-03-31 12:40:24', '2026-03-31 19:40:24'),
(7, 17, 34, 'CREACION', 'El usuario generó un nuevo ticket de soporte.', '2026-03-31 20:22:44', '2026-04-01 03:22:44'),
(8, 17, 34, 'REASIGNACION', 'Ticket transferido al agente: Dairo Jair', '2026-03-31 20:24:50', '2026-04-01 03:24:50'),
(9, 17, 15, 'REASIGNACION', 'Ticket transferido al agente: Dairo Jair', '2026-04-05 19:31:57', '2026-04-06 02:31:57'),
(10, 17, 35, 'CREACION', 'El usuario generó un nuevo ticket de soporte.', '2026-04-09 15:58:33', '2026-04-09 22:58:33'),
(11, 17, 36, 'CREACION', 'El usuario generó un nuevo ticket de soporte.', '2026-04-09 15:58:46', '2026-04-09 22:58:46'),
(12, 17, 37, 'CREACION', 'El usuario generó un nuevo ticket de soporte.', '2026-04-09 16:08:26', '2026-04-09 23:08:26'),
(13, 17, 37, 'REASIGNACION', 'Ticket transferido al agente: ', '2026-04-09 16:57:04', '2026-04-09 23:57:04'),
(14, 17, 36, 'REASIGNACION', 'Ticket transferido al agente: Dairo Jair Cardenas Bayona', '2026-04-09 17:02:20', '2026-04-10 00:02:20'),
(15, 17, 10, 'REAPERTURA', 'El ticket ha sido reabierto por el usuario.', '2026-04-09 17:37:02', '2026-04-10 00:37:02'),
(16, 17, 10, 'REASIGNACION', 'Ticket transferido al agente: Dairo Jair', '2026-04-09 17:37:15', '2026-04-10 00:37:15'),
(17, 17, 17, 'REASIGNACION', 'Ticket transferido al agente: Brayam', '2026-04-10 12:33:15', '2026-04-10 19:33:14'),
(18, 15, 38, 'CREACION', 'El usuario generó un nuevo ticket de soporte.', '2026-04-10 12:47:01', '2026-04-10 19:47:01'),
(19, 14, 16, 'REASIGNACION', 'Ticket transferido al agente: Yeimy Paola', '2026-04-10 12:57:38', '2026-04-10 19:57:38'),
(20, 14, 39, 'CREACION', 'El usuario generó un nuevo ticket de soporte.', '2026-04-10 12:59:00', '2026-04-10 19:59:00'),
(21, 14, 40, 'CREACION', 'El usuario generó un nuevo ticket de soporte.', '2026-04-10 13:01:21', '2026-04-10 20:01:21'),
(22, 14, 40, 'REASIGNACION', 'Ticket transferido al agente: Yeimy Paola', '2026-04-10 14:22:37', '2026-04-10 21:22:37'),
(23, 15, 41, 'CREACION', 'El usuario generó un nuevo ticket de soporte.', '2026-04-10 15:52:34', '2026-04-10 22:52:34'),
(24, 14, 42, 'CREACION', 'El usuario generó un nuevo ticket de soporte.', '2026-04-10 15:53:44', '2026-04-10 22:53:44'),
(25, 14, 43, 'CREACION', 'El usuario generó un nuevo ticket de soporte.', '2026-04-10 16:02:42', '2026-04-10 23:02:42'),
(26, 14, 44, 'CREACION', 'El usuario generó un nuevo ticket de soporte.', '2026-04-10 16:25:55', '2026-04-10 23:25:55'),
(27, 17, 0, 'CIERRE', 'El ticket ha sido marcado como cerrado.', '2026-04-10 16:32:34', '2026-04-10 23:32:34'),
(28, 17, 0, 'CIERRE', 'El ticket ha sido marcado como cerrado.', '2026-04-10 16:33:21', '2026-04-10 23:33:21'),
(29, 17, 0, 'CIERRE', 'El ticket ha sido marcado como cerrado.', '2026-04-10 16:35:15', '2026-04-10 23:35:15'),
(30, 17, 0, 'CIERRE', 'El ticket ha sido marcado como cerrado.', '2026-04-10 17:13:18', '2026-04-11 00:13:18'),
(31, 17, 0, 'CIERRE', 'El ticket ha sido marcado como cerrado.', '2026-04-10 17:13:37', '2026-04-11 00:13:37'),
(32, 17, 45, 'CREACION', 'El usuario generó un nuevo ticket de soporte.', '2026-04-10 17:15:20', '2026-04-11 00:15:20'),
(33, 17, 10, 'CIERRE', 'El ticket ha sido marcado como cerrado.', '2026-04-10 18:14:56', '2026-04-11 01:14:56'),
(34, 17, 0, 'CIERRE', 'El ticket ha sido marcado como cerrado.', '2026-04-11 09:45:49', '2026-04-11 16:45:49'),
(35, 17, 10, 'REAPERTURA', 'El ticket ha sido reabierto por el usuario.', '2026-04-11 10:56:42', '2026-04-11 17:56:42'),
(36, 14, 30, 'REAPERTURA', 'El ticket ha sido reabierto por el usuario.', '2026-04-11 10:57:56', '2026-04-11 17:57:56'),
(37, 17, 18, 'REASIGNACION', 'Ticket transferido al agente: Yeimy Paola', '2026-04-11 10:59:33', '2026-04-11 17:59:33'),
(38, 14, 37, 'COMENTARIO', 'Se añadio respuesta al ticket: <p>Este ticket debe ser atendido por Joshua Mendez</p>', '2026-04-13 17:01:51', '2026-04-14 00:01:51'),
(39, 17, 37, 'REASIGNACION', 'Ticket transferido al agente: Joshua Andrey', '2026-04-13 17:02:45', '2026-04-14 00:02:45'),
(40, 14, 39, 'COMENTARIO', 'Se añadio respuesta al ticket: <p>asfdsfadsf</p>', '2026-04-13 17:45:45', '2026-04-14 00:45:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_log_usuario`
--

CREATE TABLE `tm_log_usuario` (
  `logu_id` int(11) NOT NULL,
  `usu_id_realiza` int(11) DEFAULT NULL,
  `usu_id_afectado` int(11) DEFAULT NULL,
  `logu_accion` varchar(50) DEFAULT NULL,
  `logu_detalle` text DEFAULT NULL,
  `fech_crea` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_log_usuario`
--

INSERT INTO `tm_log_usuario` (`logu_id`, `usu_id_realiza`, `usu_id_afectado`, `logu_accion`, `logu_detalle`, `fech_crea`) VALUES
(1, 17, 17, 'CAMBIO PASSWORD', 'Actualización de credenciales de acceso.', '2026-03-27 19:08:05'),
(2, 17, 18, 'ACTUALIZACIÓN', 'Actualizacion de perfil.Se cambio la contraseña', '2026-03-27 20:36:26'),
(3, 14, 14, 'CAMBIO PASSWORD', 'Actualización de credenciales de acceso.', '2026-03-30 19:31:15'),
(4, 17, 30, 'ACTUALIZACIÓN', 'Actualizacion de perfil.Se cambio la contraseña', '2026-03-31 19:40:58'),
(5, 17, 17, 'ACTUALIZACIÓN', 'Actualizacion de perfil.', '2026-04-08 23:08:26'),
(6, 17, 17, 'ACTUALIZACIÓN', 'Actualizacion de perfil.', '2026-04-08 23:40:33'),
(7, 17, 17, 'ACTUALIZACIÓN', 'Actualizacion de perfil.', '2026-04-09 00:18:51'),
(8, 17, 15, 'ACTUALIZACIÓN', 'Actualizacion de perfil.Cambio de Rol de 3 a 2.', '2026-04-10 19:34:53'),
(9, 17, 15, 'ACTUALIZACIÓN', 'Actualizacion de perfil.', '2026-04-10 19:35:09'),
(10, 17, 16, 'ACTUALIZACIÓN', 'Actualizacion de perfil.', '2026-04-10 19:36:55'),
(11, 17, 16, 'ACTUALIZACIÓN', 'Actualizacion de perfil.', '2026-04-10 19:37:27'),
(12, 17, 15, 'ACTUALIZACIÓN', 'Actualizacion de perfil.', '2026-04-10 19:39:20'),
(13, 17, 15, 'ACTUALIZACIÓN', 'Actualizacion de perfil.', '2026-04-10 19:41:59'),
(14, 17, 14, 'ACTUALIZACIÓN', 'Actualizacion de perfil.', '2026-04-10 19:44:54'),
(15, 17, 15, 'ACTUALIZACIÓN', 'Actualizacion de perfil.', '2026-04-10 19:45:45'),
(16, 17, 15, 'ACTUALIZACIÓN', 'Actualizacion de perfil.Cambio de Rol de 1 a 2.', '2026-04-10 21:33:04'),
(17, 17, 15, 'ACTUALIZACIÓN', 'Actualizacion de perfil.', '2026-04-10 21:33:30'),
(18, 14, 14, 'CAMBIO PASSWORD', 'Actualización de credenciales de acceso.', '2026-04-13 17:59:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_novedades`
--

CREATE TABLE `tm_novedades` (
  `id_nov` int(11) NOT NULL,
  `novedad` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `div_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_novedades`
--

INSERT INTO `tm_novedades` (`id_nov`, `novedad`, `descripcion`, `div_id`) VALUES
(1, 'Problemas de ubicación', 'Unidad no reporta ubicación', 1),
(2, 'Unidad no ingresada en grupo', '', 1),
(3, 'Reinicio de Sim card', '', 1),
(4, 'Reporte atrasado', '', 1),
(5, 'Unidad no reporta GPS', '', 1),
(6, 'Soporte Plataforma', '', 1),
(7, 'Unidad no ingresada en grupo', '', 2),
(8, 'Validación de sim card', '', 2),
(9, 'Problemas de ubicación ', '', 2),
(10, 'Validación de Contenedores CMV', '', 2),
(11, 'Validación de problemas con la plataforma', '', 2),
(12, 'Quitar unidad del viaje', '', 2),
(13, 'Configuración de bodegas', '', 2),
(14, 'Reactivación de viajes', '', 2),
(15, 'Cambio de Cartografía', '', 2),
(16, 'Falla de posición', '', 3),
(17, 'Novedad pagos', '', 3),
(18, 'Soporte APP', '', 3),
(19, 'Desvinculación', '', 3),
(20, 'Ajuste de días', '', 3),
(21, 'Reinicio de Sim card', '', 3),
(22, 'Dudas', '', 3),
(23, 'Registro en ISU', '', 3),
(24, 'Unidad no existe', '', 3),
(25, 'Falla de unidad', '', 3),
(26, 'Falla Inmovilizar', '', 3),
(27, 'Unidad no transmite', '', 3),
(28, 'Sim con Sobreconsumo', '', 3),
(29, 'Novedades con el remolque', '', 3),
(30, 'Novedad con notificaciones', '', 3),
(31, 'Novedad Dataglobal', '', 3),
(32, 'Hibernacion', '', 3),
(33, 'Unidad no se visualiza en App', '', 3),
(34, 'Transferencia de Servicio', '', 3),
(35, 'Unidad no ingresada en grupo', '', 4),
(36, 'Unidad no actualiza posición', '', 4),
(37, 'Validación de sim card', '', 4),
(38, 'Problemas para ingresar a APP', '', 4),
(39, 'Soporte APP', '', 5),
(40, 'Entrega no subida', '', 5),
(41, 'Unidad no ingresada en grupo', '', 5),
(42, 'Unidad no actualiza posición', '', 5),
(43, 'Validación de sim card', '', 5),
(44, 'Cambio de tipo de unidad en plataforma', '', 5),
(45, 'Problemas para ingresar a APP', '', 5),
(46, 'Integración', '', 5),
(47, 'Caida general de Dataglobal', '', 5),
(48, 'Validación de estado de sellos (Mantenimiento Sellos)', '', 5),
(49, 'Cambio de bodega', '', 5),
(50, 'Problemas con la batería', '', 5),
(51, 'Falla con la unidad GPS', '', 5),
(52, 'Auditoria CMV', '', 5),
(53, 'Tracking Unidad', '', 5),
(54, 'Revisión de Usuario', '', 5),
(55, 'Formulario', '', 5),
(56, 'Validación de Reportes Satlock', '', 5),
(57, 'Validación Novedad CC D2D', '', 5),
(58, 'Bloqueo de Unidad ', '', 5),
(59, 'Desbloqueo de Unidad', '', 5),
(60, 'Retiro de Citas de un usuario', '', 5),
(61, 'Dudas', '', 5),
(62, 'Problemas de ingreso a la plataforma Satlock', '', 5),
(63, 'Reinicio de Sim card', '', 5),
(64, 'Soporte Plataforma Satlock', '', 5),
(65, 'Validación de Fotos', '', 5),
(66, 'Falla de Unidad', '', 5),
(67, 'Auditoria Subgrupos', '', 5),
(68, 'Recuperar tramas', '', 5),
(69, 'Soporte APP', '', 7),
(70, 'Entrega no subida', '', 7),
(71, 'Unidad no ingresada en grupo', '', 7),
(72, 'Unidad no actualiza posición', '', 7),
(73, 'Validación de sim card', '', 7),
(74, 'Cambio de tipo de unidad en plataforma', '', 7),
(75, 'Problemas para ingresar a APP', '', 7),
(76, 'Cambio de bodega', '', 7),
(77, 'Caida general de Dataglobal', '', 7),
(78, 'Problemas con la batería', '', 7),
(79, 'Agregar unidades', '', 7),
(80, 'Unidad no ingresada en grupo', '', 8),
(81, 'Unidad no actualiza posición', '', 8),
(82, 'Validación de sim card', '', 8),
(83, 'Cambio de bodega', '', 8),
(84, 'Reconfiguración de unidades', '', 8),
(85, 'Caida general de Dataglobal', '', 8),
(86, 'Problemas con la batería', '', 8),
(87, 'Problemas con la unidad', '', 8),
(88, 'Problemas con la Plataforma', '', 8),
(89, 'Ingreso de unidades a grupo', '', 8),
(90, 'Cambio de plan a Sim Card', '', 9),
(91, 'Unidad no se visualiza en CC', '', 9),
(92, 'Unidad no reporta ubicación', '', 9),
(93, 'EV-04 no reporta ubicación', '', 9),
(94, 'Cambio de clave a usuario', '', 9),
(95, 'Unidad genera eventos de pánico', '', 9),
(96, 'Unidad con sobreconsumo ', '', 9),
(97, 'Problemas para ingresar a APP', '', 9),
(98, 'Reinicio a unidad', '', 9),
(99, 'Cambio de empresa a dispositivo', '', 9),
(100, 'Unidad no reporta los eventos de pánico en CC', '', 9),
(101, 'Validación Imei Unidad', '', 9),
(102, 'Integración Cartón Colombia', '', 9),
(103, 'Creación de IP UNP', '', 9),
(104, 'Envio de Comandos desde Plataforma Administrativa', '', 9),
(105, 'Desvinculación de unidad', '', 9),
(106, 'Cambio de plan a Sim Card', '', 10),
(107, 'Unidad no se visualiza en CC', '', 10),
(108, 'Unidad no reporta ubicación', '', 10),
(109, 'EV-04 no reporta ubicación', '', 10),
(110, 'Cambio de clave a usuario', '', 10),
(111, 'Unidad genera eventos de pánico', '', 10),
(112, 'Unidad con sobreconsumo ', '', 10),
(113, 'Problemas para ingresar a APP', '', 10),
(114, 'Cambio de Estado de Pedido', '', 11),
(115, 'Pedido duplicado', '', 11),
(116, 'Materiales', '', 11),
(117, 'Validación TMS', '', 11),
(118, 'Ajuste en plataforma', '', 11),
(119, 'Novedad con credenciales de Academia Satlock', '', 12),
(120, 'Revisión de Indicadores en Plataforma Web', '', 12),
(121, 'Soporte APP', '', 12),
(122, 'Validación Plataforma', '', 12),
(123, 'Desasignar unidad', '', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_rol`
--

CREATE TABLE `tm_rol` (
  `rol_id` int(11) NOT NULL,
  `rol_nom` varchar(50) NOT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_rol`
--

INSERT INTO `tm_rol` (`rol_id`, `rol_nom`, `fech_crea`, `est`) VALUES
(1, 'SuperAdmin', '2026-01-20 16:46:36', 1),
(2, 'Soporte', '2026-01-19 23:26:32', 1),
(3, 'Usuario', '2026-01-19 23:26:32', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_ticket`
--

CREATE TABLE `tm_ticket` (
  `tick_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `id_nov` int(11) NOT NULL,
  `novedad` varchar(250) NOT NULL,
  `canal_id` int(11) DEFAULT NULL,
  `tick_descripcion` varchar(9000) DEFAULT NULL,
  `tick_estado` varchar(15) NOT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `usu_asig` int(11) DEFAULT NULL,
  `fech_asig` datetime DEFAULT NULL,
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_ticket`
--

INSERT INTO `tm_ticket` (`tick_id`, `usu_id`, `id_nov`, `novedad`, `canal_id`, `tick_descripcion`, `tick_estado`, `fech_crea`, `usu_asig`, `fech_asig`, `est`) VALUES
(8, 17, 13, 'Configuración de bodegas', NULL, '<p>xxxx</p>', 'Abierto', '2026-01-23 21:52:26', NULL, NULL, 2),
(9, 17, 52, 'Auditoria CMV', NULL, '<p>ggg</p>', 'Abierto', '2026-01-23 22:02:59', NULL, NULL, 2),
(10, 17, 38, 'Problemas para ingresar a APP', NULL, '<p>ss</p><br><hr><p><strong>[Ticket reabierto el 2026-02-06 15:18:05]:</strong><br>El ticket ha sido actualizado correctamente.</p><br><hr><p><strong>[Ticket reabierto el 2026-02-06 15:22:28]:</strong><br>El ticket ha sido actualizado correctamente.</p><br><hr><p><strong>[Ticket reabierto el 2026-02-06 15:45:40]:</strong><br>El ticket ha sido actualizado correctamente.</p><br><hr><p><strong>[Ticket reabierto el 2026-02-06 16:04:51]:</strong><br>El ticket ha sido actualizado correctamente.</p><br><hr><p><strong>[Ticket reasignado el día 09-02-2026 07:54:15]</strong><br>El ticket ha sido transferido a un nuevo agente responsable.</p><p>aeerrtdgsdfgsfdg4444422</p><br><hr><b>[Ticket Cerrado por el sistema]</b><br><hr><p><strong>[Ticket reabierto el 15/2/2026, 19:28:00]:</strong><br><strong>Motivo:</strong> jakasjklfjasdf<br><strong>Descripción:</strong><p>asdfasdfasdf</p></p><br><hr><b>[Ticket Cerrado por el sistema]</b><br><hr><p><strong>[Ticket reasignado el día 10-04-2026 00:37:14]</strong><br>El ticket ha sido transferido al agente: <b>Dairo Jair</b>.</p><br><hr><b>[Ticket Cerrado por el sistema]</b>', 'Cerrado', '2026-01-23 22:28:46', 14, '2026-04-09 17:37:14', 1),
(11, 17, 52, 'Auditoria CMV', NULL, '<p>XX</p><br><hr><p><strong>[Ticket reabierto el 2026-02-06 18:27:24]:</strong><br>El ticket ha sido actualizado correctamente.</p><br><hr><p><strong>[Ticket reabierto el 2026-02-06 18:27:58]:</strong><br>El ticket ha sido actualizado correctamente.</p><br><hr><p><strong>[Ticket reabierto el 2026-02-06 18:55:22]:</strong><br>Seguimiento</p><br><hr><p><strong>[Ticket reabierto el 2026-02-06 18:58:31]:</strong><br>seguimiento</p><br><hr><p><strong>[Ticket reabierto el 2026-02-06 20:35:26]:</strong><br><strong>Motivo:</strong>hjhjh<br><strong>Descripción:</strong><p><br></p></p><br><hr><p><strong>[Ticket reabierto el 7/2/2026, 18:47:27]:</strong><br><strong>Motivo:</strong> ssafsadf<br><strong>Descripción:</strong><p>asffafafa</p></p><br><hr><b>[Ticket Cerrado por el sistema]</b><br><hr><p><strong>[Ticket reasignado el día 09-02-2026 07:54:35]</strong><br>El ticket ha sido transferido a un nuevo agente responsable.</p><br><hr><p><strong>[Ticket reabierto el 9/2/2026, 2:05:53]:</strong><br><strong>Motivo:</strong> Seguimiento<br><strong>Descripción:</strong><p>Se realiza un nuevo hallazgo</p></p><br><hr><b>[Ticket Cerrado por el sistema]</b>', 'Cerrado', '2026-01-23 22:30:37', 16, '2026-02-09 01:54:35', 1),
(12, 17, 15, 'Cambio de Cartografía', NULL, '<p>HH</p><br><hr><p><strong>[Ticket reasignado el día 12-02-2026 14:38:37]</strong><br>El ticket ha sido transferido a un nuevo agente responsable.</p><br><hr><b>[Ticket Cerrado por el sistema]</b>', 'Cerrado', '2026-01-23 22:57:29', 16, '2026-02-12 08:38:37', 1),
(13, 14, 118, 'Ajuste en plataforma', NULL, '<p>fffff</p><br><hr><b>[Ticket Cerrado por el sistema]</b><br><hr><p><strong>[Ticket reasignado el día 31-03-2026 00:48:00]</strong><br>El ticket ha sido transferido al agente: <b>Dairo Jair</b>.</p><br><hr><b>[Ticket Cerrado por el sistema]</b>', 'Cerrado', '2026-01-27 10:10:15', 14, '2026-03-30 17:48:00', 1),
(14, 14, 118, 'Ajuste en plataforma', NULL, '<p>fffff</p><br><hr><p><strong>[Ticket reasignado el día 31-03-2026 00:52:18]</strong><br>El ticket ha sido transferido al agente: <b>Brayam</b>.</p>', 'Abierto', '2026-01-27 10:11:46', 18, '2026-03-30 17:52:18', 1),
(15, 17, 120, 'Revisión de Indicadores en Plataforma Web', NULL, 'Novedad<br><hr><p><strong>[Ticket reasignado el día 06-04-2026 02:31:56]</strong><br>El ticket ha sido transferido al agente: <b>Dairo Jair</b>.</p>', 'Abierto', '2026-01-29 12:32:40', 14, '2026-04-05 19:31:56', 1),
(16, 14, 94, 'Cambio de clave a usuario', NULL, '<p>mnkjho</p><br><hr><p><strong>[Ticket reasignado el día 10-04-2026 19:57:38]</strong><br>El ticket ha sido transferido al agente: <b>Yeimy Paola</b>.</p>', 'Abierto', '2026-01-29 18:08:57', 16, '2026-04-10 12:57:38', 1),
(17, 17, 110, 'Cambio de clave a usuario', NULL, '<br><hr><p><strong>[Ticket reasignado el día 10-04-2026 19:33:14]</strong><br>El ticket ha sido transferido al agente: <b>Brayam</b>.</p>', 'Abierto', '2026-02-06 11:46:52', 18, '2026-04-10 12:33:14', 1),
(18, 17, 114, 'Cambio de Estado de Pedido', NULL, '<p>se realiza el cambio de estado de un pedido</p><br><hr><p><strong>[Ticket reasignado el día 16-02-2026 01:33:17]</strong><br>El ticket ha sido transferido a un nuevo agente responsable.</p><br><hr><p><strong>[Ticket reasignado el día 11-04-2026 17:59:33]</strong><br>El ticket ha sido transferido al agente: <b>Yeimy Paola</b>.</p>', 'Abierto', '2026-02-15 19:32:58', 16, '2026-04-11 10:59:33', 1),
(19, 17, 123, 'Desasignar unidad', NULL, '<p>kkkdkdk</p><br><hr><p><strong>[Ticket reasignado el día 20-02-2026 21:43:28]</strong><br>El ticket ha sido transferido al agente: <b>Brayam</b>.</p>', 'Abierto', '2026-02-20 11:52:43', 18, '2026-02-20 15:43:28', 1),
(20, 17, 123, 'Desasignar unidad', NULL, '<p>kkkdkdk</p><br><hr><b>[Ticket Cerrado por el sistema]</b><br><hr><b>[Ticket Cerrado por el sistema]</b>', 'Abierto', '2026-02-20 11:52:47', NULL, NULL, 1),
(21, 17, 123, 'Desasignar unidad', NULL, '<p>kkkdkdk</p>', 'Abierto', '2026-02-20 11:53:21', NULL, NULL, 1),
(22, 17, 107, 'Unidad no se visualiza en CC', NULL, '', 'Abierto', '2026-02-20 11:55:57', NULL, NULL, 1),
(23, 17, 107, 'Unidad no se visualiza en CC', NULL, '<p>kkkkvjasdklfjasdkf</p>', 'Abierto', '2026-02-20 11:56:04', NULL, NULL, 1),
(24, 17, 119, 'Novedad con credenciales de Academia Satlock', NULL, '2', 'Abierto', '2026-02-20 12:02:26', NULL, NULL, 1),
(25, 17, 31, 'Novedad Dataglobal', NULL, '1', 'Abierto', '2026-02-20 12:27:37', NULL, NULL, 1),
(26, 17, 11, 'Validación de problemas con la plataforma', NULL, '1', 'Abierto', '2026-02-20 12:37:05', NULL, NULL, 1),
(27, 17, 61, 'Dudas', NULL, '2', 'Abierto', '2026-02-20 12:38:54', NULL, NULL, 1),
(28, 17, 108, 'Unidad no reporta ubicación', NULL, '3', 'Abierto', '2026-02-20 13:37:38', NULL, NULL, 1),
(29, 17, 119, 'Novedad con credenciales de Academia Satlock', 3, '<p><span style=\"background-color: rgb(255, 255, 0);\">kasfjasfkajsdfl</span></p><br><hr><p><strong>[Ticket reasignado el día 20-02-2026 19:51:14]</strong><br>El ticket ha sido transferido a un nuevo agente responsable.</p><p>kllkaksjfas</p>', 'Abierto', '2026-02-20 13:50:43', 14, '2026-02-20 13:51:14', 1),
(30, 17, 112, 'Unidad con sobreconsumo ', 4, '<p>afaksddjflkasjflasjflasfas</p><br><hr><p><strong>[Ticket reasignado el día 20-02-2026 20:03:43]</strong><br>El ticket ha sido transferido al agente: <b>Dairo Jair</b></p><br><hr><p><strong>[Ticket reasignado el día 20-02-2026 20:03:46]</strong><br>El ticket ha sido transferido al agente: <b>Dairo Jair</b></p><br><hr><p><strong>[Ticket reasignado el día 20-02-2026 20:18:35]</strong><br>El ticket ha sido transferido al agente: <b>Dairo Jair</b></p><br><hr><p><strong>[Ticket reasignado el día 20-02-2026 21:09:41]</strong><br>El ticket ha sido transferido al agente: <b>Dairo Jair</b>.</p><br><hr><b>[Ticket Cerrado por el sistema]</b><br><hr><b>[Ticket Cerrado por el sistema]</b><br><hr><b>[Ticket Cerrado por el sistema]</b><br><hr><b>[Ticket Cerrado por el sistema]</b><br><hr><b>[Ticket Cerrado por el sistema]</b>', 'Abierto', '2026-02-20 14:03:19', 14, '2026-02-20 15:09:41', 1),
(31, 17, 92, 'Unidad no reporta ubicación', 3, '<p>kadsfjsdlkfka</p><br><hr><p><strong>[Ticket reasignado el día 20-02-2026 21:41:50]</strong><br>El ticket ha sido transferido al agente: <b>Yeimy Paola</b>.</p>', 'Abierto', '2026-02-20 15:41:22', 16, '2026-02-20 15:41:50', 1),
(32, 17, 108, 'Unidad no reporta ubicación', 3, '<p>ajjajja</p><br><hr><p><strong>[Ticket reasignado el día 20-02-2026 21:48:22]</strong><br>El ticket ha sido transferido al agente: <b>Daniel </b>.</p><br><hr><p><strong>[Ticket reasignado el día 20-02-2026 21:49:20]</strong><br>El ticket ha sido transferido al agente: <b>Brayam</b>.</p>', 'Abierto', '2026-02-20 15:47:49', 18, '2026-02-20 15:49:20', 1),
(33, 17, 15, 'Cambio de Cartografía', 1, '<p>dasdfasdf</p><br><hr><b>[Ticket Cerrado por el sistema]</b>', 'Cerrado', '2026-03-30 17:52:48', NULL, NULL, 1),
(34, 17, 121, 'Soporte APP', 1, '<p>Usuario se comunica pidiendo soporte para la aplicacion&nbsp;</p><br><hr><p><strong>[Ticket reasignado el día 01-04-2026 03:24:50]</strong><br>El ticket ha sido transferido al agente: <b>Dairo Jair</b>.</p>', 'Abierto', '2026-03-31 20:22:44', 14, '2026-03-31 20:24:50', 1),
(35, 17, 15, 'Cambio de Cartografía', 1, '<p>Se solicita cambio de cartografia de unidad aaa123</p>', 'Abierto', '2026-04-09 15:58:32', NULL, NULL, 1),
(36, 17, 15, 'Cambio de Cartografía', 1, '<p>Se solicita cambio de cartografia de unidad aaa123</p><br><hr><p><strong>[Ticket reasignado el día 10-04-2026 00:02:20]</strong><br>El ticket ha sido transferido al agente: <b>Dairo Jair Cardenas Bayona</b>.</p>', 'Abierto', '2026-04-09 15:58:46', 14, '2026-04-09 17:02:20', 1),
(37, 17, 15, 'Cambio de Cartografía', 2, '<p>Se solicita cambio de cartografía de la unidad&nbsp;</p><br><hr><p><strong>[Ticket reasignado el día 09-04-2026 23:57:04]</strong><br>El ticket ha sido transferido al agente: <b></b>.</p>\n<p>Este ticket debe ser atendido por Joshua Mendez</p><br><hr><p><strong>[Ticket reasignado el día 14-04-2026 00:02:45]</strong><br>El ticket ha sido transferido al agente: <b>Joshua Andrey</b>.</p>', 'Cerrado', '2026-04-09 16:08:26', 15, '2026-04-13 17:02:45', 1),
(38, 15, 101, 'Validación Imei Unidad', 2, '<p>Solicitud de validacion de imei de unidad</p>', 'Cerrado', '2026-04-10 12:47:01', 15, NULL, 1),
(39, 14, 118, 'Ajuste en plataforma', 3, '<p>sddgasgadg</p>\n<p>asfdsfadsf</p>', 'Cerrado', '2026-04-10 12:59:00', 14, NULL, 1),
(40, 14, 114, 'Cambio de Estado de Pedido', 3, '<p>fgfhsghs</p><br><hr><p><strong>[Ticket reasignado el día 10-04-2026 21:22:37]</strong><br>El ticket ha sido transferido al agente: <b>Yeimy Paola</b>.</p>', 'Abierto', '2026-04-10 13:01:21', 16, '2026-04-10 14:22:37', 1),
(41, 15, 123, 'Desasignar unidad', 4, '<p>afasfasdfasd</p>', 'Cerrado', '2026-04-10 15:52:33', 15, NULL, 1),
(42, 14, 119, 'Novedad con credenciales de Academia Satlock', 2, '<p>asdfasfasdfasd</p>', 'Abierto', '2026-04-10 15:53:44', NULL, NULL, 1),
(43, 14, 118, 'Ajuste en plataforma', 2, '<p>sdagafdsga</p>', 'Abierto', '2026-04-10 16:02:42', NULL, NULL, 1),
(44, 14, 108, 'Unidad no reporta ubicación', 3, '<p>afdsffasdfasdf</p>', 'Abierto', '2026-04-10 16:25:55', NULL, NULL, 1),
(45, 17, 92, 'Unidad no reporta ubicación', 3, '<p>ghk</p>', 'Abierto', '2026-04-10 17:15:20', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_usuario`
--

CREATE TABLE `tm_usuario` (
  `usu_id` int(11) NOT NULL,
  `usu_nom` varchar(150) DEFAULT NULL,
  `usu_ap` varchar(150) DEFAULT NULL,
  `usu_correo` varchar(150) NOT NULL,
  `usu_img` varchar(255) DEFAULT NULL,
  `usu_telf` varchar(20) DEFAULT NULL,
  `usu_dep` varchar(50) DEFAULT NULL,
  `usu_pass` varchar(255) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `fech_crea` datetime DEFAULT NULL,
  `fech_modi` datetime DEFAULT NULL,
  `fech_elim` datetime DEFAULT NULL,
  `est` int(11) NOT NULL,
  `usu_token` text DEFAULT NULL,
  `usu_token_expira` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tm_usuario`
--

INSERT INTO `tm_usuario` (`usu_id`, `usu_nom`, `usu_ap`, `usu_correo`, `usu_img`, `usu_telf`, `usu_dep`, `usu_pass`, `rol_id`, `fech_crea`, `fech_modi`, `fech_elim`, `est`, `usu_token`, `usu_token_expira`) VALUES
(1, 'Juan David', 'Espinosa Quintero', 'juan.espinosa@satlock.com', NULL, NULL, NULL, '$2y$10$/3VHmA48/fRoqyo9U2gw4.yRRwOp6Sug2RDIEslj.9Ia6ELwqHTW2', 2, '2025-10-28 14:19:57', '2026-01-20 14:29:35', '2026-01-23 20:30:14', 0, 'fff2c1d3e6bb0dab17a4f995fd3b0c88', '2026-01-17 05:52:21'),
(14, 'Dairo Jair', 'Cardenas Bayona', 'dairo.cardenas@satlock.com', 'perfil_14.jpg', '3213333333', 'Soporte', '$2y$10$DpW7lcNDCK1y0Xfz.yUjQ.Q0BQjQaHnfYvmtZFuUQuFtON5jjupFK', 2, '2026-01-20 15:03:28', '2026-04-13 10:59:55', NULL, 1, NULL, NULL),
(15, 'Joshua Andrey', 'Mendez Acuna', 'joshua.mendez@satlock.com', NULL, '3012222222', 'Soporte', '$2y$10$ta/.HkxCVlMINh9242vGgObMxWhKyEsX.wisbHFC4FAVvcXEYeScC', 2, '2026-01-20 15:09:59', '2026-04-10 14:33:29', NULL, 1, NULL, NULL),
(16, 'Yeimy Paola', 'Quinche Agudelo', 'yeimy.quinche@satlock.com', NULL, '$2y$10$oHUVPuN0BGlDS', '3214656655', 'Soporte', 2, '2026-01-20 16:36:14', '2026-04-10 12:37:26', NULL, 1, NULL, NULL),
(17, 'Admin', 'General', 'admin@admin.com', 'perfil_17.jpg', '3213333333', 'Ingenieria', '$2y$10$kT4ezbMI/W5clFHAmMSzIeOBE4I0rQh5ZN16VTNNhueA/Q2HXRjSG', 1, '2026-01-20 16:48:38', '2026-04-08 17:18:51', NULL, 1, NULL, NULL),
(18, 'Brayam', 'Sierra', 'brayan.sierra@satlock.com', NULL, NULL, NULL, '$2y$10$xyZ9oeYURCfKAMpJvwHKp.G8bdkUpvo.SAXC2aafDJRFRiSs6rDFG', 2, '2026-01-23 15:57:02', '2026-03-27 14:36:26', NULL, 1, NULL, NULL),
(19, 'Juan', 'Espinosa', 'jdeq92@gmail.com', NULL, NULL, NULL, '$2y$10$QRBXoaOx5srhe4nTiNLdzuyQkTEwHztz9o/Ltd7W5vjYrkBZ0pC6i', 1, '2026-01-23 16:12:43', NULL, '2026-01-23 20:29:47', 0, NULL, NULL),
(20, 'Juan', 'Espinosa', 'jdeq92@gmail.com', NULL, NULL, NULL, '$2y$10$UyKt4pRogmxzF04fy/6paOEfiWJPfoGsKy8tHnhBjLQkPvollAlxG', 1, '2026-01-23 16:15:33', NULL, '2026-01-23 20:29:52', 0, NULL, NULL),
(21, 'Juan', 'Espinosa', 'jdeq92@gmail.com', NULL, NULL, NULL, '$2y$10$2YgwnGw2gwdSi1Q3ELXKGuOodPnjf1yQQKQRtbHyo6UxixMzKvBIm', 1, '2026-01-23 16:31:24', NULL, '2026-01-23 20:31:12', 0, NULL, NULL),
(22, 'Juan', 'Espinosa', 'jdeq92@gmail.com', NULL, NULL, NULL, '$2y$10$N2hXEY8D0fXcpV05O5V08OioLmhWvzMCpMK/HaG.MovY0ZsPdg272', 1, '2026-01-23 16:40:37', NULL, '2026-01-23 20:31:09', 0, NULL, NULL),
(23, 'Juan', 'Espinosa', 'jdeq92@gmail.com', NULL, NULL, NULL, '$2y$10$dEPjL5J9ps74STKeNx2kXOP848lXMDsljfowL0tCoxIwD2XuVFm5W', 1, '2026-01-23 17:28:24', NULL, '2026-01-23 20:31:06', 0, NULL, NULL),
(24, 'Juan', 'Espinosa', 'jdeq92@gmail.com', NULL, NULL, NULL, '$2y$10$jbBGXlu1hYckuKP8UhEA8OEwqeyqxSy4WgRcv1cyiq1CLWJ7aOB7m', 1, '2026-01-23 17:36:44', NULL, '2026-01-23 20:30:59', 0, NULL, NULL),
(25, 'Juan', 'Espinosa', 'jdeq92@gmail.com', NULL, NULL, NULL, '$2y$10$fa5/lZCs1m8/t/UiSgk.V.296vr050P1ATBHJz0IokVSnYuIu3BFm', 1, '2026-01-23 17:42:40', NULL, '2026-01-23 20:30:21', 0, NULL, NULL),
(26, 'Juan', 'Espinosa', 'jdeq92@gmail.com', NULL, NULL, NULL, '$2y$10$D.RqKjw71ErL2k1VpOmSp.PCAEIthdOrEXXnwI571rkZfxZI4Sygq', 2, '2026-01-23 17:49:39', NULL, '2026-01-23 20:30:11', 0, NULL, NULL),
(27, 'Juan', 'Espinosa', 'jdeq92@gmail.com', NULL, NULL, NULL, '$2y$10$Y0ZAAmaVpBmsfbTJYEjZD.e/O9C.6iEj0i3EoMy6zvz8R4yovFae2', 1, '2026-01-23 17:57:55', NULL, '2026-01-23 20:29:58', 0, NULL, NULL),
(28, 'Juan', 'Espinosa', 'jdeq92@gmail.com', NULL, NULL, NULL, '$2y$10$0r2qE3kDMpdq5uzM7xhR7e6ixq4sfBHCBzyQJ4NF4KO0QLM4QdWka', 1, '2026-01-23 18:01:54', NULL, '2026-01-23 20:30:02', 0, NULL, NULL),
(29, 'Juan', 'Espinosa', 'jdeq92@gmail.com', NULL, NULL, NULL, '$2y$10$He64U.zUjyWShDWohh0LHeCgaOWY/qX3EeviwHdBBYyHV0F.RgzCC', 1, '2026-01-23 18:06:48', NULL, '2026-01-23 20:30:06', 0, NULL, NULL),
(30, 'Daniel ', 'Guaqueta', 'daniel.guaqueta@satlock.com', NULL, NULL, NULL, '$2y$10$01flJ60ZyHTFeFfBl2i2dOwak/AZECg6bbARvGUCPp1Numnn0gzWG', 2, '2026-02-20 15:47:01', '2026-03-31 12:40:58', NULL, 1, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `td_documento`
--
ALTER TABLE `td_documento`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indices de la tabla `td_ticketdetalle`
--
ALTER TABLE `td_ticketdetalle`
  ADD PRIMARY KEY (`tickd_id`);

--
-- Indices de la tabla `tm_canal`
--
ALTER TABLE `tm_canal`
  ADD PRIMARY KEY (`canal_id`);

--
-- Indices de la tabla `tm_division`
--
ALTER TABLE `tm_division`
  ADD PRIMARY KEY (`div_id`);

--
-- Indices de la tabla `tm_log`
--
ALTER TABLE `tm_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indices de la tabla `tm_log_acceso`
--
ALTER TABLE `tm_log_acceso`
  ADD PRIMARY KEY (`log_id`);

--
-- Indices de la tabla `tm_log_ticket`
--
ALTER TABLE `tm_log_ticket`
  ADD PRIMARY KEY (`logt_id`);

--
-- Indices de la tabla `tm_log_usuario`
--
ALTER TABLE `tm_log_usuario`
  ADD PRIMARY KEY (`logu_id`);

--
-- Indices de la tabla `tm_novedades`
--
ALTER TABLE `tm_novedades`
  ADD PRIMARY KEY (`id_nov`),
  ADD KEY `fk_tm_division` (`div_id`);

--
-- Indices de la tabla `tm_rol`
--
ALTER TABLE `tm_rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `tm_ticket`
--
ALTER TABLE `tm_ticket`
  ADD PRIMARY KEY (`tick_id`),
  ADD KEY `fk_ticket_usuario` (`usu_id`),
  ADD KEY `fk_ticket_novedad` (`id_nov`);

--
-- Indices de la tabla `tm_usuario`
--
ALTER TABLE `tm_usuario`
  ADD PRIMARY KEY (`usu_id`),
  ADD KEY `FK_usuario_rol` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `td_ticketdetalle`
--
ALTER TABLE `td_ticketdetalle`
  MODIFY `tickd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de la tabla `tm_canal`
--
ALTER TABLE `tm_canal`
  MODIFY `canal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tm_division`
--
ALTER TABLE `tm_division`
  MODIFY `div_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tm_log`
--
ALTER TABLE `tm_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tm_log_acceso`
--
ALTER TABLE `tm_log_acceso`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tm_log_ticket`
--
ALTER TABLE `tm_log_ticket`
  MODIFY `logt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `tm_log_usuario`
--
ALTER TABLE `tm_log_usuario`
  MODIFY `logu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tm_novedades`
--
ALTER TABLE `tm_novedades`
  MODIFY `id_nov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT de la tabla `tm_rol`
--
ALTER TABLE `tm_rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tm_ticket`
--
ALTER TABLE `tm_ticket`
  MODIFY `tick_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `tm_usuario`
--
ALTER TABLE `tm_usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tm_novedades`
--
ALTER TABLE `tm_novedades`
  ADD CONSTRAINT `fk_tm_division` FOREIGN KEY (`div_id`) REFERENCES `tm_division` (`div_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tm_ticket`
--
ALTER TABLE `tm_ticket`
  ADD CONSTRAINT `fk_ticket_novedad` FOREIGN KEY (`id_nov`) REFERENCES `tm_novedades` (`id_nov`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ticket_usuario` FOREIGN KEY (`usu_id`) REFERENCES `tm_usuario` (`usu_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tm_usuario`
--
ALTER TABLE `tm_usuario`
  ADD CONSTRAINT `FK_usuario_rol` FOREIGN KEY (`rol_id`) REFERENCES `tm_rol` (`rol_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
