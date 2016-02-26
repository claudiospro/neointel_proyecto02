-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2016 at 05:14 PM
-- Server version: 10.0.21-MariaDB
-- PHP Version: 5.6.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `neointelperu_apps`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ventas_save` (`in_id` BIGINT, `in_campania` VARCHAR(600), `in_fecha` VARCHAR(100), `in_usuario` INT)  BEGIN
  DECLARE ou_id BIGINT;
  DECLARE pr_lineal_id BIGINT;
  DECLARE pr_asesor_venta_id BIGINT;
  
  DECLARE pr_supervisor_id BIGINT;
  DECLARE pr_coordinador_id BIGINT;
  
  IF in_id=0 THEN
     SELECT lineal_id INTO pr_lineal_id  FROM usu_usuario_lineal WHERE usuario_id= in_usuario LIMIT 1
     ;
     
     
     
     
     SELECT ul.usuario_id INTO pr_supervisor_id FROM usu_usuario_lineal ul
     LEFT JOIN usu_usuario_perfil up ON up.usuario_id=ul.usuario_id
     WHERE ul.lineal_id= pr_lineal_id and up.perfil_id=4
     ;
     SELECT ul.usuario_id INTO pr_coordinador_id FROM usu_usuario_lineal ul
     LEFT JOIN usu_usuario_perfil up ON up.usuario_id=ul.usuario_id
     WHERE ul.lineal_id= pr_lineal_id and up.perfil_id=6
     ;

     INSERT INTO venta
     (info_create_fecha, info_create_user, info_update_fecha,
      asesor_venta_id, supervisor_id, coordinador_id,
      campania, lineal_id)
     VALUES
     (in_fecha, in_usuario, in_fecha,
      in_usuario, pr_supervisor_id, pr_coordinador_id,
      in_campania, pr_lineal_id)
     ; 
     SELECT last_insert_id() INTO ou_id
     ;
  ELSE
     UPDATE venta SET
     info_update_user=in_usuario, info_update_fecha=in_fecha
     WHERE id=in_id
     ;
     SET ou_id = in_id;
  END IF
  ;
  SELECT ou_id
  ;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `campania`
--

CREATE TABLE `campania` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `info_update_user` int(11) DEFAULT NULL,
  `info_status` tinyint(1) DEFAULT '1',
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_unicode_ci,
  `indice` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `campania`
--

INSERT INTO `campania` (`info_create`, `info_create_user`, `info_update`, `info_update_user`, `info_status`, `id`, `nombre`, `indice`) VALUES
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 0, 1, 'Canal +', ''),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 0, 2, 'Movistar Fusión', ''),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 3, 'Vodafone One', 'campania_001'),
('2016-02-26 14:24:55', 1, '0000-00-00 00:00:00', NULL, 1, 4, 'Vodafone One Pymes', 'campania_002');

-- --------------------------------------------------------

--
-- Table structure for table `campania_history`
--

CREATE TABLE `campania_history` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_status` tinyint(1) DEFAULT '1',
  `id` int(11) NOT NULL,
  `history_id` int(11) DEFAULT NULL,
  `nombre` text COLLATE utf8_unicode_ci,
  `indice` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campania_lineal`
--

CREATE TABLE `campania_lineal` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `info_update_user` int(11) DEFAULT NULL,
  `info_status` tinyint(1) DEFAULT '1',
  `id` bigint(20) NOT NULL,
  `lineal_id` int(11) DEFAULT NULL,
  `campania_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `campania_lineal`
--

INSERT INTO `campania_lineal` (`info_create`, `info_create_user`, `info_update`, `info_update_user`, `info_status`, `id`, `lineal_id`, `campania_id`) VALUES
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 1, 1, 3),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 2, 2, 3),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 3, 3, 3),
('2016-02-26 15:20:11', 1, '0000-00-00 00:00:00', NULL, 1, 4, 5, 4),
('2016-02-26 15:43:29', 1, '0000-00-00 00:00:00', NULL, 1, 5, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `campania_lineal_history`
--

CREATE TABLE `campania_lineal_history` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_status` tinyint(1) DEFAULT '1',
  `id` bigint(20) NOT NULL,
  `history_id` bigint(20) DEFAULT NULL,
  `lineal_id` int(11) DEFAULT NULL,
  `campania_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lineal`
--

CREATE TABLE `lineal` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `info_update_user` int(11) DEFAULT NULL,
  `info_status` tinyint(1) DEFAULT '1',
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lineal`
--

INSERT INTO `lineal` (`info_create`, `info_create_user`, `info_update`, `info_update_user`, `info_status`, `id`, `nombre`) VALUES
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 1, 'Lineal 01'),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 2, 'Lineal 02'),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 3, 'Lineal 03'),
('2016-02-26 15:40:47', 1, '0000-00-00 00:00:00', NULL, 1, 4, 'Lineal 4 (temporal)'),
('2016-02-26 15:40:47', 1, '0000-00-00 00:00:00', NULL, 1, 5, 'Lineal 5');

-- --------------------------------------------------------

--
-- Table structure for table `lineal_history`
--

CREATE TABLE `lineal_history` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_status` tinyint(1) DEFAULT '1',
  `id` int(11) NOT NULL,
  `history_id` bigint(20) DEFAULT NULL,
  `nombre` text COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usu_perfil`
--

CREATE TABLE `usu_perfil` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usu_perfil`
--

INSERT INTO `usu_perfil` (`id`, `nombre`) VALUES
(1, 'Admin'),
(2, 'Gerencia'),
(3, 'Tramitacion'),
(4, 'Supervisor'),
(5, 'Asesor Comercial'),
(6, 'Coordinador');

-- --------------------------------------------------------

--
-- Table structure for table `usu_perfil_recurso`
--

CREATE TABLE `usu_perfil_recurso` (
  `id` bigint(20) NOT NULL,
  `perfil_id` int(11) NOT NULL,
  `recurso_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usu_perfil_recurso`
--

INSERT INTO `usu_perfil_recurso` (`id`, `perfil_id`, `recurso_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 3, 1),
(5, 4, 1),
(6, 5, 1),
(7, 6, 1),
(8, 1, 3),
(9, 2, 3),
(10, 3, 3),
(11, 6, 3),
(12, 1, 4),
(13, 2, 4),
(14, 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `usu_recurso`
--

CREATE TABLE `usu_recurso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usu_recurso`
--

INSERT INTO `usu_recurso` (`id`, `nombre`) VALUES
(1, 'Ventas'),
(2, 'Usuario'),
(3, 'Barrido'),
(4, 'Base');

-- --------------------------------------------------------

--
-- Table structure for table `usu_usuario`
--

CREATE TABLE `usu_usuario` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `info_update_user` int(11) DEFAULT NULL,
  `info_status` tinyint(1) DEFAULT '1',
  `id` bigint(20) NOT NULL,
  `nombre` text COLLATE utf8_unicode_ci,
  `nombre_corto` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `imagen` text COLLATE utf8_unicode_ci,
  `login` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pwd` varchar(50) COLLATE utf8_unicode_ci DEFAULT '$4nkNrBEK8ra2'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usu_usuario`
--

INSERT INTO `usu_usuario` (`info_create`, `info_create_user`, `info_update`, `info_update_user`, `info_status`, `id`, `nombre`, `nombre_corto`, `imagen`, `login`, `pwd`) VALUES
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 1, 'claudio rodriguez', '', NULL, 'crodriguez', '$4M4mpfilkNnU'),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 2, 'juan perez Gerencia', '', NULL, 'ger', '$4M4mpfilkNnU'),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 3, 'juan perez Tramitacion', '', NULL, 'tra', '$4M4mpfilkNnU'),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 4, 'juan perez Supervisor', 'Juan Sup', NULL, 'sup', '$4M4mpfilkNnU'),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 5, 'juan perez Asesor de Ventas', 'Juan Asesor', NULL, 'ase', '$4M4mpfilkNnU'),
('2016-01-21 17:57:34', 1, '0000-00-00 00:00:00', NULL, 1, 6, 'Juan Perez Coordinador', '', NULL, 'cor', '$4M4mpfilkNnU'),
('2016-02-26 20:19:02', 1, '0000-00-00 00:00:00', NULL, 1, 27, 'ase2', 'ase2', NULL, 'ase2', '$4M4mpfilkNnU'),
('2016-02-26 20:19:02', 1, '0000-00-00 00:00:00', NULL, 1, 26, 'sup2', 'sup2', NULL, 'sup2', '$4M4mpfilkNnU');

-- --------------------------------------------------------

--
-- Table structure for table `usu_usuario_history`
--

CREATE TABLE `usu_usuario_history` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_status` tinyint(1) DEFAULT '1',
  `id` bigint(20) NOT NULL,
  `history_id` bigint(20) DEFAULT NULL,
  `nombre` text COLLATE utf8_unicode_ci,
  `imagen` text COLLATE utf8_unicode_ci,
  `login` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pwd` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usu_usuario_lineal`
--

CREATE TABLE `usu_usuario_lineal` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `info_update_user` int(11) DEFAULT NULL,
  `info_status` tinyint(1) DEFAULT '1',
  `id` bigint(20) NOT NULL,
  `usuario_id` bigint(20) NOT NULL,
  `lineal_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usu_usuario_lineal`
--

INSERT INTO `usu_usuario_lineal` (`info_create`, `info_create_user`, `info_update`, `info_update_user`, `info_status`, `id`, `usuario_id`, `lineal_id`) VALUES
('2016-01-21 18:01:47', 1, '0000-00-00 00:00:00', NULL, 1, 6, 6, 1),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 2, 3, 1),
('2016-02-26 20:21:31', 1, '0000-00-00 00:00:00', NULL, 1, 9, 26, 5),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 4, 4, 1),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 5, 5, 1),
('2016-02-26 20:12:13', 1, '0000-00-00 00:00:00', NULL, 1, 8, 6, 5),
('2016-02-26 20:21:31', 1, '0000-00-00 00:00:00', NULL, 1, 10, 27, 5);

-- --------------------------------------------------------

--
-- Table structure for table `usu_usuario_lineal_history`
--

CREATE TABLE `usu_usuario_lineal_history` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_status` tinyint(1) DEFAULT '1',
  `id` bigint(20) NOT NULL,
  `history_id` bigint(20) DEFAULT NULL,
  `usuario_id` bigint(20) NOT NULL,
  `lineal_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usu_usuario_perfil`
--

CREATE TABLE `usu_usuario_perfil` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `info_update_user` int(11) DEFAULT NULL,
  `info_status` tinyint(1) DEFAULT '1',
  `id` bigint(20) NOT NULL,
  `usuario_id` bigint(20) NOT NULL,
  `perfil_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usu_usuario_perfil`
--

INSERT INTO `usu_usuario_perfil` (`info_create`, `info_create_user`, `info_update`, `info_update_user`, `info_status`, `id`, `usuario_id`, `perfil_id`) VALUES
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 1, 1, 1),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 2, 2, 2),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 3, 3, 3),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 4, 4, 4),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 5, 5, 5),
('2016-01-21 18:00:08', 1, '0000-00-00 00:00:00', NULL, 1, 6, 6, 6),
('2016-02-26 20:23:17', 1, '0000-00-00 00:00:00', NULL, 1, 7, 26, 4),
('2016-02-26 20:23:17', 1, '0000-00-00 00:00:00', NULL, 1, 8, 27, 5);

-- --------------------------------------------------------

--
-- Table structure for table `usu_usuario_perfil_history`
--

CREATE TABLE `usu_usuario_perfil_history` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_status` tinyint(1) DEFAULT '1',
  `id` bigint(20) NOT NULL,
  `history_id` bigint(20) DEFAULT NULL,
  `usuario_id` bigint(20) NOT NULL,
  `perfil_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `venta`
--

CREATE TABLE `venta` (
  `id` bigint(20) NOT NULL,
  `info_create_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` bigint(20) NOT NULL,
  `info_update_fecha` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `info_update_user` bigint(20) NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1',
  `asesor_venta_id` bigint(20) NOT NULL,
  `tramitacion_id` bigint(20) NOT NULL,
  `supervisor_id` bigint(20) NOT NULL,
  `coordinador_id` bigint(20) NOT NULL,
  `campania` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lineal_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta`
--

INSERT INTO `venta` (`id`, `info_create_fecha`, `info_create_user`, `info_update_fecha`, `info_update_user`, `info_status`, `asesor_venta_id`, `tramitacion_id`, `supervisor_id`, `coordinador_id`, `campania`, `lineal_id`) VALUES
(7, '2016-01-28 12:49:14', 5, '2016-02-18 18:39:24', 5, 1, 5, 3, 4, 6, 'campania_001', 1),
(10, '2016-02-01 15:00:56', 5, '2016-02-19 21:41:46', 6, 0, 5, 3, 4, 6, 'campania_001', 1),
(11, '2016-02-01 16:48:21', 5, '2016-02-22 21:59:49', 4, 1, 5, 3, 4, 6, 'campania_001', 1),
(16, '2016-02-01 18:16:44', 6, '2016-02-01 18:16:49', 6, 1, 6, 3, 4, 6, 'campania_001', 1),
(17, '2016-02-11 15:34:35', 5, '2016-02-19 21:41:19', 6, 1, 5, 3, 4, 6, 'campania_001', 1),
(18, '2016-02-11 15:44:44', 5, '2016-02-19 21:41:39', 6, 1, 5, 3, 4, 6, 'campania_001', 1),
(19, '2016-02-22 12:47:43', 5, '2016-02-22 12:47:43', 0, 1, 5, 0, 4, 6, 'campania_001', 1),
(20, '2016-02-23 13:33:51', 4, '2016-02-23 13:33:53', 4, 1, 4, 0, 4, 6, 'campania_001', 1),
(21, '2016-02-23 14:30:22', 3, '2016-02-23 14:30:22', 0, 1, 3, 0, 4, 6, 'campania_001', 1),
(22, '2016-02-26 20:23:56', 26, '2016-02-26 21:06:39', 1, 1, 26, 0, 26, 6, 'campania_002', 5);

-- --------------------------------------------------------

--
-- Table structure for table `venta_booleano`
--

CREATE TABLE `venta_booleano` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_booleano`
--

INSERT INTO `venta_booleano` (`id`, `nombre`, `info_status`) VALUES
(1, 'SI', 1),
(2, 'NO', 1);

-- --------------------------------------------------------

--
-- Table structure for table `venta_campania_001`
--

CREATE TABLE `venta_campania_001` (
  `id` bigint(20) NOT NULL,
  `cliente_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_tipo` bigint(20) NOT NULL,
  `cliente_documento_tipo` bigint(20) NOT NULL,
  `cliente_documento` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_documento_reverso` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_nacimiento` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_correo` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `cuenta_bancaria` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_contacto_fijo` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_contacto_movil` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `provincia` bigint(20) NOT NULL,
  `localidad` bigint(20) NOT NULL,
  `codigo_postal` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_tipo` bigint(20) NOT NULL,
  `direccion_nombre` bigint(20) NOT NULL,
  `direccion_numero` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_piso` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_puerta` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_id` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `producto` bigint(20) NOT NULL,
  `fijo_numero` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `fijo_modalidad` bigint(20) NOT NULL,
  `fijo_operador` bigint(20) NOT NULL,
  `fijo_titular` bigint(20) NOT NULL,
  `fijo_titular_documento` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `fijo_titular_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_numero` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_modalidad` bigint(20) NOT NULL,
  `movil_operador` bigint(20) NOT NULL,
  `movil_tarifa` bigint(20) NOT NULL,
  `movil_terminal` varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  `movil_titular` bigint(20) NOT NULL,
  `movil_titular_documento` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_titular_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_estado` bigint(20) NOT NULL,
  `movil_icc` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `producto_observacion` text COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_1_numero` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_1_modalidad` bigint(20) NOT NULL,
  `movil_adicional_1_operador` bigint(20) NOT NULL,
  `movil_adicional_1_tarifa` bigint(20) NOT NULL,
  `movil_adicional_1_terminal` varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_1_titular` bigint(20) NOT NULL,
  `movil_adicional_1_titular_documento` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_1_titular_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_1_estado` bigint(20) NOT NULL,
  `movil_adicional_1_icc` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_2_numero` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_2_modalidad` bigint(20) NOT NULL,
  `movil_adicional_2_operador` bigint(20) NOT NULL,
  `movil_adicional_2_tarifa` bigint(20) NOT NULL,
  `movil_adicional_2_terminal` varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_2_titular` bigint(20) NOT NULL,
  `movil_adicional_2_titular_documento` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_2_titular_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_2_estado` bigint(20) NOT NULL,
  `movil_adicional_2_icc` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `estado` bigint(20) NOT NULL DEFAULT '1',
  `estado_real` bigint(20) NOT NULL DEFAULT '1',
  `estado_observacion` text COLLATE utf8_unicode_ci NOT NULL,
  `aprobado_supervisor` bigint(20) NOT NULL DEFAULT '2',
  `fecha_instalada` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_campania_001`
--

INSERT INTO `venta_campania_001` (`id`, `cliente_nombre`, `cliente_tipo`, `cliente_documento_tipo`, `cliente_documento`, `cliente_documento_reverso`, `cliente_nacimiento`, `cliente_correo`, `cuenta_bancaria`, `cliente_contacto_fijo`, `cliente_contacto_movil`, `provincia`, `localidad`, `codigo_postal`, `direccion_tipo`, `direccion_nombre`, `direccion_numero`, `direccion_piso`, `direccion_puerta`, `direccion_id`, `producto`, `fijo_numero`, `fijo_modalidad`, `fijo_operador`, `fijo_titular`, `fijo_titular_documento`, `fijo_titular_nombre`, `movil_numero`, `movil_modalidad`, `movil_operador`, `movil_tarifa`, `movil_terminal`, `movil_titular`, `movil_titular_documento`, `movil_titular_nombre`, `movil_estado`, `movil_icc`, `producto_observacion`, `movil_adicional_1_numero`, `movil_adicional_1_modalidad`, `movil_adicional_1_operador`, `movil_adicional_1_tarifa`, `movil_adicional_1_terminal`, `movil_adicional_1_titular`, `movil_adicional_1_titular_documento`, `movil_adicional_1_titular_nombre`, `movil_adicional_1_estado`, `movil_adicional_1_icc`, `movil_adicional_2_numero`, `movil_adicional_2_modalidad`, `movil_adicional_2_operador`, `movil_adicional_2_tarifa`, `movil_adicional_2_terminal`, `movil_adicional_2_titular`, `movil_adicional_2_titular_documento`, `movil_adicional_2_titular_nombre`, `movil_adicional_2_estado`, `movil_adicional_2_icc`, `estado`, `estado_real`, `estado_observacion`, `aprobado_supervisor`, `fecha_instalada`) VALUES
(7, 'Carlos Garcia Lopez', 1, 1, '45460258-D', '8888888', '01-09-88', 'nodispone@outlook.es', '2100-3651-42-3564125685', '123456789', '639258741', 1, 0, '45630', 3, 3, '27', '4', 'B', '', 1, '999999999', 1, 3, 0, '', '', '', 2, 1, 3, '', 1, '', '', 2, '677777', 'aa', '123456789', 0, 0, 3, '', 0, '', '', 0, '', '', 0, 0, 3, 'aaaa', 0, '', '', 0, '', 1, 3, 'zz', 1, '2016-02-18 18:27:44'),
(10, 'Silvia Gimenez Camuñas', 0, 1, '35123532 - D', 'ssssssdfsdf', '12 - 05 - 99', 'silviag@outlook.es', '2100 - 5684 - 01 - 1235800479', '931411391', '627653712', 1, 1, '08100 ', 1, 4, '13', '3', 'F', '', 1, '123456789', 2, 9, 1, '35123562-D', 'Silvia Gimenez Camuñas', '627653712', 2, 3, 3, 'dfgdfgdf dfgd', 1, '35123562 - D', 'Silvia Gimenez Camuñas', 2, '', '', '659684571', 2, 7, 3, '', 2, 'C', 'Carlos sanchez garcia', 2, '', '', 0, 1, 3, '', 0, '', '', 0, '', 1, 3, '', 0, '2016-02-18 18:51:12'),
(11, 'Cristina maria monzon ramirez Perú', 1, 1, '35654512-R', '', '25-04-19', 'nodispone@gmail.com', '', '963258147', '654321987', 48, 0, 'Navarra', 1, 5, '2', '3', 'J', 'aaa', 8, '654235684', 1, 7, 2, '54612387-W', '', '654235651', 2, 2, 3, '', 1, '54612387-W', 'Jose diaz fernandez', 2, '', 'zzz', '', 0, 0, 3, '', 0, '', '', 0, '', '', 0, 0, 3, '', 0, '', '', 0, '', 1, 2, '', 0, '2016-02-12 05:00:00'),
(17, '', 0, 0, '', '', '', '', '', '', '', 0, 0, '', 0, 0, '', '', '', '', 13, '', 0, 0, 0, '', '', '', 0, 0, 3, '', 0, '', '', 0, '', 'aa', '', 0, 0, 3, '', 0, '', '', 0, '', '', 0, 0, 3, '', 0, '', '', 0, '', 1, 1, '', 1, '2016-02-12 18:42:31'),
(18, '', 0, 0, '', '', '', '', '', '', '', 0, 0, '', 0, 0, '', '', '', '', 13, '', 0, 0, 0, '', '', '', 0, 0, 3, '', 0, '', '', 0, '', 'aa', '', 0, 0, 3, '', 0, '', '', 0, '', '', 0, 0, 3, '', 0, '', '', 0, '', 1, 1, '', 2, '2016-02-12 18:42:19'),
(19, '', 0, 0, '', '4564576457456', '', '', '', '', '', 0, 0, '', 1, 7, '', '', '', '', 13, '', 1, 9, 2, '', '', '', 1, 9, 4, 'zxcvxdcv xcfg', 0, '', '', 0, '', '', '', 0, 0, 3, '', 0, '', '', 0, '', '', 0, 0, 3, '', 0, '', '', 0, '', 1, 1, '', 2, '2016-02-22 12:47:43'),
(20, 'aaa', 2, 2, 'sdfdfgdfg', 'aaaaa', 'aaaa', 'aaaa', 'aaa', '123456789', '123456788', 43, 10, '56456', 3, 4, '435345', '1', '2', '3', 1, '534534534', 1, 18, 1, '', '', '', 0, 0, 3, '', 0, '', '', 0, '', '', '', 0, 0, 3, '', 0, '', '', 0, '', '', 0, 0, 3, '', 0, '', '', 0, '', 0, 0, '', 0, '0000-00-00 00:00:00'),
(21, '', 0, 0, '', '', '', '', '', '', '', 0, 0, '', 0, 0, '', '', '', '', 13, '', 0, 0, 0, '', '', '', 0, 0, 3, '', 0, '', '', 0, '', '', '', 0, 0, 3, '', 0, '', '', 0, '', '', 0, 0, 3, '', 0, '', '', 0, '', 0, 0, '', 2, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `venta_campania_001_campos`
--

CREATE TABLE `venta_campania_001_campos` (
  `id` bigint(20) NOT NULL,
  `pestana` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `grupo` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `grupo_etiqueta` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `etiqueta` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `tabla` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `diccionario` tinyint(2) NOT NULL,
  `diccionario_dependencia` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `diccionario_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `diccionario_orden` tinyint(1) NOT NULL DEFAULT '1',
  `tipo` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `perfiles` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1, 2, 3, 4, 5, 6',
  `permisos` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'w, w, w, w, w, w'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_campania_001_campos`
--

INSERT INTO `venta_campania_001_campos` (`id`, `pestana`, `grupo`, `grupo_etiqueta`, `nombre`, `etiqueta`, `orden`, `tabla`, `diccionario`, `diccionario_dependencia`, `diccionario_nombre`, `diccionario_orden`, `tipo`, `perfiles`, `permisos`) VALUES
(1, 'Cliente', '', '', 'cliente_nombre', 'Cliente', 1, 'cliente', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(2, 'Cliente', '', '', 'cliente_tipo', 'Tipo Cliente', 2, 'cliente', 2, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(3, 'Cliente', 'cliente_documento', 'Documento', 'cliente_documento_tipo', 'Tipo', 3, 'cliente', 2, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(4, 'Cliente', 'cliente_documento', 'Documento', 'cliente_documento', 'Número', 4, 'cliente', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(5, 'Cliente', '', '', 'cliente_nacimiento', 'Fecha de Nacimiento', 6, 'cliente', 0, '', '', 1, 'TIMESTAMP-VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(7, 'Cliente', '', '', 'cliente_correo', 'Correo', 7, 'cliente', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(8, 'Cliente', 'cliente_contacto', 'Contacto', 'cliente_contacto_fijo', 'Fijo', 9, 'cliente', 0, '', '', 1, 'TELEFONO', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(9, 'Cliente', 'cliente_contacto', 'Contacto', 'cliente_contacto_movil', 'Movil', 10, 'cliente', 0, '', '', 1, 'TELEFONO', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(10, 'Cliente', 'ubigeo', 'Ubigeo', 'provincia', 'Provincia', 11, 'venta', 2, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(11, 'Cliente', 'ubigeo', 'Ubigeo', 'localidad', 'Localidad', 12, 'venta', 1, 'provincia', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(12, 'Cliente', 'direccion', 'Dirección', 'direccion_tipo', 'Tipo', 14, 'venta', 1, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(13, 'Cliente', 'direccion', 'Dirección', 'direccion_nombre', 'Nombre', 15, 'venta', 1, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(14, 'Cliente', 'direccion', 'Dirección', 'direccion_numero', 'Número', 16, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(15, 'Cliente', 'direccion', 'Dirección', 'direccion_piso', 'Planta(Piso, Bloque)', 17, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(16, 'Cliente', 'direccion', 'Dirección', 'direccion_puerta', 'Puerta', 18, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(17, 'Producto', '', '', 'producto', 'Producto', 20, 'venta', 3, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(18, 'Estados', 'estado_venta', 'Estado', 'estado', 'Estado', 58, 'venta', 2, '', '', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, r, w'),
(19, 'Estados', '', '', 'fecha_instalada', 'Fecha de Instalación', 62, 'venta', 0, '', '', 1, 'TIMESTAMP', '1, 2, 3, 4, 5, 6', 'w, w, w, w, r, w'),
(20, 'Cliente', 'ubigeo', 'Ubigeo', 'codigo_postal', 'Código Postal', 13, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(21, 'Cliente', '', '', 'cuenta_bancaria', 'Cuenta Bancaria', 8, 'cliente', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(22, 'Estados', 'estado_venta', 'Estado', 'estado_observacion', 'Observación', 60, 'venta', 0, '', '', 1, 'TEXT', '1, 2, 3, 4, 5, 6', 'w, w, w, r, r, w'),
(24, 'Producto', 'fijo', 'Fijo', 'fijo_numero', 'Número', 21, 'venta', 0, '', '', 1, 'TELEFONO', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(25, 'Producto', 'fijo', 'Fijo', 'fijo_modalidad', 'Modalidad', 22, 'venta', 2, '', 'modalidad', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(26, 'Producto', 'fijo', 'Fijo', 'fijo_operador', 'Operador', 23, 'venta', 1, '', 'operador', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(27, 'Producto', 'movil', 'Movil', 'movil_numero', 'Número', 27, 'venta', 0, '', '', 1, 'TELEFONO', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(28, 'Producto', 'movil', 'Movil', 'movil_modalidad', 'Modalidad', 28, 'venta', 2, '', 'modalidad', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(29, 'Producto', 'movil', 'Movil', 'movil_operador', 'Operador', 29, 'venta', 1, '', 'operador', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(30, 'Producto', 'movil', 'Movil', 'movil_tarifa', 'Tarifa', 30, 'venta', 3, '', 'tarifa_movil', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(31, 'Producto', 'movil', 'Movil', 'movil_titular', 'Mismo Titular', 32, 'venta', 2, '', 'titular', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(32, 'Producto', 'movil', 'Movil', 'movil_estado', 'Estado', 35, 'venta', 2, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(33, 'Producto', 'movil', 'Movil', 'movil_icc', 'ICC', 36, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(34, 'Moviles Adicionales', 'movil_adicional_1', 'Movil Adicional 1', 'movil_adicional_1_numero', 'Número', 38, 'venta', 0, '', '', 1, 'TELEFONO', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(35, 'Moviles Adicionales', 'movil_adicional_1', 'Movil Adicional 1', 'movil_adicional_1_modalidad', 'Modalidad', 39, 'venta', 2, '', 'modalidad', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(36, 'Moviles Adicionales', 'movil_adicional_1', 'Movil Adicional 1', 'movil_adicional_1_operador', 'Operador', 40, 'venta', 1, '', 'operador', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(37, 'Moviles Adicionales', 'movil_adicional_1', 'Movil Adicional 1', 'movil_adicional_1_tarifa', 'Tarifa', 41, 'venta', 3, '', 'tarifa_movil', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(38, 'Moviles Adicionales', 'movil_adicional_1', 'Movil Adicional 1', 'movil_adicional_1_titular', 'Mismo Titular', 43, 'venta', 2, '', 'titular', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(39, 'Moviles Adicionales', 'movil_adicional_1', 'Movil Adicional 1', 'movil_adicional_1_estado', 'Estado', 46, 'venta', 2, '', 'movil_estado', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(40, 'Moviles Adicionales', 'movil_adicional_1', 'Movil Adicional 1', 'movil_adicional_1_icc', 'ICC', 47, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(41, 'Moviles Adicionales', 'movil_adicional_2', 'Movil Adicional 2', 'movil_adicional_2_numero', 'Número', 48, 'venta', 0, '', '', 1, 'TELEFONO', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(42, 'Moviles Adicionales', 'movil_adicional_2', 'Movil Adicional 2', 'movil_adicional_2_modalidad', 'Modalidad', 49, 'venta', 2, '', 'modalidad', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(43, 'Moviles Adicionales', 'movil_adicional_2', 'Movil Adicional 2', 'movil_adicional_2_operador', 'Operador', 50, 'venta', 1, '', 'operador', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(44, 'Moviles Adicionales', 'movil_adicional_2', 'Movil Adicional 2', 'movil_adicional_2_tarifa', 'Tarifa', 51, 'venta', 3, '', 'tarifa_movil', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(45, 'Moviles Adicionales', 'movil_adicional_2', 'Movil Adicional 2', 'movil_adicional_2_titular', 'Mismo Titular', 53, 'venta', 2, '', 'titular', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(46, 'Moviles Adicionales', 'movil_adicional_2', 'Movil Adicional 2', 'movil_adicional_2_estado', 'Estado', 56, 'venta', 2, '', 'movil_estado', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(47, 'Moviles Adicionales', 'movil_adicional_2', 'Movil Adicional 2', 'movil_adicional_2_icc', 'ICC', 57, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(48, 'Cliente', 'cliente_documento', 'Documento', 'cliente_documento_reverso', 'Reverso', 5, 'cliente', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(49, 'Producto', 'fijo', 'Fijo', 'fijo_titular', 'Mismo Titular', 24, 'venta', 2, '', 'titular', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(50, 'Producto', 'fijo', 'Fijo', 'fijo_titular_documento', 'Documento del Titular', 25, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(51, 'Producto', 'fijo', 'Fijo', 'fijo_titular_nombre', 'Nombre del Titular', 26, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(52, 'Producto', 'movil', 'Movil', 'movil_titular_documento', 'Documento del Titular', 33, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(53, 'Producto', 'movil', 'Movil', 'movil_titular_nombre', 'Nombre del Titular', 34, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(54, 'Moviles Adicionales', 'movil_adicional_1', 'Movil Adicional 1', 'movil_adicional_1_titular_documento', 'Documento del Titular', 44, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(55, 'Moviles Adicionales', 'movil_adicional_1', 'Movil Adicional 1', 'movil_adicional_1_titular_nombre', 'Nombre del Titular', 45, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(56, 'Moviles Adicionales', 'movil_adicional_2', 'Movil Adicional 2', 'movil_adicional_2_titular_documento', 'Documento del Titular', 54, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(57, 'Moviles Adicionales', 'movil_adicional_2', 'Movil Adicional 2', 'movil_adicional_2_titular_nombre', 'Nombre del Titular', 55, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(58, 'Estados', 'estado_venta', 'Estado', 'estado_real', 'Estado Real', 59, 'venta', 2, '', '', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, h, w'),
(59, 'Cliente', 'direccion', 'Dirección', 'direccion_id', 'Dirección ID', 19, 'cliente', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(61, 'Estados', '', '', 'aprobado_supervisor', 'Aprobado por Supervisor', 61, 'venta', 2, '', 'booleano', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'r, r, r, w, r, r'),
(62, 'Producto', '', '', 'producto_observacion', 'Obserción', 37, 'venta', 0, '', '', 1, 'TEXT', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(63, 'Producto', 'movil', 'Movil', 'movil_terminal', 'Terminal', 31, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(64, 'Moviles Adicionales', 'movil_adicional_1', 'Movil Adicional 1', 'movil_adicional_1_terminal', 'Terminal', 42, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(65, 'Moviles Adicionales', 'movil_adicional_2', 'Movil Adicional 2', 'movil_adicional_2_terminal', 'Terminal', 52, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w');

-- --------------------------------------------------------

--
-- Table structure for table `venta_campania_002`
--

CREATE TABLE `venta_campania_002` (
  `id` bigint(20) NOT NULL,
  `cliente_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_documento` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `representante_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `representante_documento` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `representante_documento_reverso` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `representante_nacimiento` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `representante_correo` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `cuenta_bancaria` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_contacto_fijo` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_contacto_movil` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `provincia` bigint(20) NOT NULL,
  `localidad` bigint(20) NOT NULL,
  `codigo_postal` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_tipo` bigint(20) NOT NULL,
  `direccion_nombre` bigint(20) NOT NULL,
  `direccion_numero` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_piso` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_puerta` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `direccion_id` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `producto` bigint(20) NOT NULL,
  `fijo_numero` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `fijo_modalidad` bigint(20) NOT NULL,
  `fijo_operador` bigint(20) NOT NULL,
  `fijo_titular` bigint(20) NOT NULL,
  `fijo_titular_documento` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `fijo_titular_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_numero` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_modalidad` bigint(20) NOT NULL,
  `movil_operador` bigint(20) NOT NULL,
  `movil_tarifa` bigint(20) NOT NULL,
  `movil_terminal` varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  `movil_titular` bigint(20) NOT NULL,
  `movil_titular_documento` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_titular_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_estado` bigint(20) NOT NULL,
  `movil_icc` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `producto_observacion` text COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_1_numero` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_1_modalidad` bigint(20) NOT NULL,
  `movil_adicional_1_operador` bigint(20) NOT NULL,
  `movil_adicional_1_tarifa` bigint(20) NOT NULL,
  `movil_adicional_1_terminal` varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_1_titular` bigint(20) NOT NULL,
  `movil_adicional_1_titular_documento` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_1_titular_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_1_estado` bigint(20) NOT NULL,
  `movil_adicional_1_icc` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_2_numero` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_2_modalidad` bigint(20) NOT NULL,
  `movil_adicional_2_operador` bigint(20) NOT NULL,
  `movil_adicional_2_tarifa` bigint(20) NOT NULL,
  `movil_adicional_2_terminal` varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_2_titular` bigint(20) NOT NULL,
  `movil_adicional_2_titular_documento` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_2_titular_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `movil_adicional_2_estado` bigint(20) NOT NULL,
  `movil_adicional_2_icc` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `estado` bigint(20) NOT NULL DEFAULT '1',
  `estado_real` bigint(20) NOT NULL DEFAULT '1',
  `estado_observacion` text COLLATE utf8_unicode_ci NOT NULL,
  `aprobado_supervisor` bigint(20) NOT NULL DEFAULT '2',
  `fecha_instalada` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_campania_002`
--

INSERT INTO `venta_campania_002` (`id`, `cliente_nombre`, `cliente_documento`, `representante_nombre`, `representante_documento`, `representante_documento_reverso`, `representante_nacimiento`, `representante_correo`, `cuenta_bancaria`, `cliente_contacto_fijo`, `cliente_contacto_movil`, `provincia`, `localidad`, `codigo_postal`, `direccion_tipo`, `direccion_nombre`, `direccion_numero`, `direccion_piso`, `direccion_puerta`, `direccion_id`, `producto`, `fijo_numero`, `fijo_modalidad`, `fijo_operador`, `fijo_titular`, `fijo_titular_documento`, `fijo_titular_nombre`, `movil_numero`, `movil_modalidad`, `movil_operador`, `movil_tarifa`, `movil_terminal`, `movil_titular`, `movil_titular_documento`, `movil_titular_nombre`, `movil_estado`, `movil_icc`, `producto_observacion`, `movil_adicional_1_numero`, `movil_adicional_1_modalidad`, `movil_adicional_1_operador`, `movil_adicional_1_tarifa`, `movil_adicional_1_terminal`, `movil_adicional_1_titular`, `movil_adicional_1_titular_documento`, `movil_adicional_1_titular_nombre`, `movil_adicional_1_estado`, `movil_adicional_1_icc`, `movil_adicional_2_numero`, `movil_adicional_2_modalidad`, `movil_adicional_2_operador`, `movil_adicional_2_tarifa`, `movil_adicional_2_terminal`, `movil_adicional_2_titular`, `movil_adicional_2_titular_documento`, `movil_adicional_2_titular_nombre`, `movil_adicional_2_estado`, `movil_adicional_2_icc`, `estado`, `estado_real`, `estado_observacion`, `aprobado_supervisor`, `fecha_instalada`) VALUES
(22, 'xfvcv', '3456456', 'dfgdfg', '456456456456', '345345345', '25-12-1983', 'aa@sdfsdf.com', '45645645645', '234424234', '234234234', 43, 10, '3234', 2, 8, '23', '2', '1', '1', 14, '', 0, 0, 0, '', '', '', 0, 0, 7, '', 0, '', '', 0, '', '', '', 0, 0, 7, '', 0, '', '', 0, '', '', 0, 0, 7, '', 0, '', '', 0, '', 0, 0, '', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `venta_campania_002_campos`
--

CREATE TABLE `venta_campania_002_campos` (
  `id` bigint(20) NOT NULL,
  `pestana` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `grupo` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `grupo_etiqueta` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `etiqueta` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `tabla` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `diccionario` tinyint(2) NOT NULL,
  `diccionario_dependencia` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `diccionario_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `diccionario_orden` tinyint(1) NOT NULL DEFAULT '1',
  `tipo` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `perfiles` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1, 2, 3, 4, 5, 6',
  `permisos` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'w, w, w, w, w, w'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_campania_002_campos`
--

INSERT INTO `venta_campania_002_campos` (`id`, `pestana`, `grupo`, `grupo_etiqueta`, `nombre`, `etiqueta`, `orden`, `tabla`, `diccionario`, `diccionario_dependencia`, `diccionario_nombre`, `diccionario_orden`, `tipo`, `perfiles`, `permisos`) VALUES
(1, 'Cliente', '', '', 'cliente_nombre', 'Empresa', 1, 'cliente', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(4, 'Cliente', '', '', 'cliente_documento', 'Documento', 2, 'cliente', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(5, 'Cliente', 'representante', 'Representante', 'representante_nacimiento', 'Fecha de Nacimiento', 6, 'cliente', 0, '', '', 1, 'TIMESTAMP-VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(7, 'Cliente', 'representante', 'Representante', 'representante_correo', 'Correo', 7, 'cliente', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(8, 'Cliente', 'cliente_contacto', 'Contacto', 'cliente_contacto_fijo', 'Fijo', 9, 'cliente', 0, '', '', 1, 'TELEFONO', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(9, 'Cliente', 'cliente_contacto', 'Contacto', 'cliente_contacto_movil', 'Movil', 10, 'cliente', 0, '', '', 1, 'TELEFONO', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(10, 'Cliente', 'ubigeo', 'Ubigeo', 'provincia', 'Provincia', 11, 'venta', 2, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(11, 'Cliente', 'ubigeo', 'Ubigeo', 'localidad', 'Localidad', 12, 'venta', 1, 'provincia', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(12, 'Cliente', 'direccion', 'Dirección', 'direccion_tipo', 'Tipo', 14, 'venta', 1, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(13, 'Cliente', 'direccion', 'Dirección', 'direccion_nombre', 'Nombre', 15, 'venta', 1, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(14, 'Cliente', 'direccion', 'Dirección', 'direccion_numero', 'Número', 16, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(15, 'Cliente', 'direccion', 'Dirección', 'direccion_piso', 'Planta(Piso, Bloque)', 17, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(16, 'Cliente', 'direccion', 'Dirección', 'direccion_puerta', 'Puerta', 18, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(17, 'Producto', '', '', 'producto', 'Producto', 20, 'venta', 3, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(18, 'Estados', 'estado_venta', 'Estado', 'estado', 'Estado', 89, 'venta', 2, '', '', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, r, w'),
(19, 'Estados', '', '', 'fecha_instalada', 'Fecha de Instalación', 93, 'venta', 0, '', '', 1, 'TIMESTAMP', '1, 2, 3, 4, 5, 6', 'w, w, w, w, r, w'),
(20, 'Cliente', 'ubigeo', 'Ubigeo', 'codigo_postal', 'Código Postal', 13, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(21, 'Cliente', '', '', 'cuenta_bancaria', 'Cuenta Bancaria', 8, 'cliente', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(22, 'Estados', 'estado_venta', 'Estado', 'estado_observacion', 'Observación', 91, 'venta', 0, '', '', 1, 'TEXT', '1, 2, 3, 4, 5, 6', 'w, w, w, r, r, w'),
(24, 'Producto', 'fijo', 'Fijo', 'fijo_numero', 'Número', 21, 'venta', 0, '', '', 1, 'TELEFONO', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(25, 'Producto', 'fijo', 'Fijo', 'fijo_modalidad', 'Modalidad', 22, 'venta', 2, '', 'modalidad', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(26, 'Producto', 'fijo', 'Fijo', 'fijo_operador', 'Operador', 23, 'venta', 1, '', 'operador', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(27, 'Producto', 'movil', 'Movil', 'movil_numero', 'Número', 27, 'venta', 0, '', '', 1, 'TELEFONO', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(28, 'Producto', 'movil', 'Movil', 'movil_modalidad', 'Modalidad', 28, 'venta', 2, '', 'modalidad', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(29, 'Producto', 'movil', 'Movil', 'movil_operador', 'Operador', 29, 'venta', 1, '', 'operador', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(30, 'Producto', 'movil', 'Movil', 'movil_tarifa', 'Tarifa', 30, 'venta', 3, '', 'tarifa_movil', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(31, 'Producto', 'movil', 'Movil', 'movil_titular', 'Mismo Titular', 32, 'venta', 2, '', 'titular', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(32, 'Producto', 'movil', 'Movil', 'movil_estado', 'Estado', 35, 'venta', 2, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(33, 'Producto', 'movil', 'Movil', 'movil_icc', 'ICC', 36, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(34, 'Moviles Adicionales', 'movil_adicional_1', 'Movil Adicional 1', 'movil_adicional_1_numero', 'Número', 38, 'venta', 0, '', '', 1, 'TELEFONO', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(35, 'Moviles Adicionales', 'movil_adicional_1', 'Movil Adicional 1', 'movil_adicional_1_modalidad', 'Modalidad', 39, 'venta', 2, '', 'modalidad', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(36, 'Moviles Adicionales', 'movil_adicional_1', 'Movil Adicional 1', 'movil_adicional_1_operador', 'Operador', 40, 'venta', 1, '', 'operador', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(37, 'Moviles Adicionales', 'movil_adicional_1', 'Movil Adicional 1', 'movil_adicional_1_tarifa', 'Tarifa', 41, 'venta', 3, '', 'tarifa_movil', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(38, 'Moviles Adicionales', 'movil_adicional_1', 'Movil Adicional 1', 'movil_adicional_1_titular', 'Mismo Titular', 43, 'venta', 2, '', 'titular', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(39, 'Moviles Adicionales', 'movil_adicional_1', 'Movil Adicional 1', 'movil_adicional_1_estado', 'Estado', 46, 'venta', 2, '', 'movil_estado', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(40, 'Moviles Adicionales', 'movil_adicional_1', 'Movil Adicional 1', 'movil_adicional_1_icc', 'ICC', 47, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(41, 'Moviles Adicionales', 'movil_adicional_2', 'Movil Adicional 2', 'movil_adicional_2_numero', 'Número', 48, 'venta', 0, '', '', 1, 'TELEFONO', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(42, 'Moviles Adicionales', 'movil_adicional_2', 'Movil Adicional 2', 'movil_adicional_2_modalidad', 'Modalidad', 49, 'venta', 2, '', 'modalidad', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(43, 'Moviles Adicionales', 'movil_adicional_2', 'Movil Adicional 2', 'movil_adicional_2_operador', 'Operador', 50, 'venta', 1, '', 'operador', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(44, 'Moviles Adicionales', 'movil_adicional_2', 'Movil Adicional 2', 'movil_adicional_2_tarifa', 'Tarifa', 51, 'venta', 3, '', 'tarifa_movil', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(45, 'Moviles Adicionales', 'movil_adicional_2', 'Movil Adicional 2', 'movil_adicional_2_titular', 'Mismo Titular', 53, 'venta', 2, '', 'titular', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(46, 'Moviles Adicionales', 'movil_adicional_2', 'Movil Adicional 2', 'movil_adicional_2_estado', 'Estado', 56, 'venta', 2, '', 'movil_estado', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(47, 'Moviles Adicionales', 'movil_adicional_2', 'Movil Adicional 2', 'movil_adicional_2_icc', 'ICC', 57, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(48, 'Cliente', 'representante', 'Representante', 'representante_documento_reverso', 'Reverso', 5, 'cliente', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(49, 'Producto', 'fijo', 'Fijo', 'fijo_titular', 'Mismo Titular', 24, 'venta', 2, '', 'titular', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(50, 'Producto', 'fijo', 'Fijo', 'fijo_titular_documento', 'Documento del Titular', 25, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(51, 'Producto', 'fijo', 'Fijo', 'fijo_titular_nombre', 'Nombre del Titular', 26, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(52, 'Producto', 'movil', 'Movil', 'movil_titular_documento', 'Documento del Titular', 33, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(53, 'Producto', 'movil', 'Movil', 'movil_titular_nombre', 'Nombre del Titular', 34, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(54, 'Moviles Adicionales', 'movil_adicional_1', 'Movil Adicional 1', 'movil_adicional_1_titular_documento', 'Documento del Titular', 44, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(55, 'Moviles Adicionales', 'movil_adicional_1', 'Movil Adicional 1', 'movil_adicional_1_titular_nombre', 'Nombre del Titular', 45, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(56, 'Moviles Adicionales', 'movil_adicional_2', 'Movil Adicional 2', 'movil_adicional_2_titular_documento', 'Documento del Titular', 54, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(57, 'Moviles Adicionales', 'movil_adicional_2', 'Movil Adicional 2', 'movil_adicional_2_titular_nombre', 'Nombre del Titular', 55, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(58, 'Estados', 'estado_venta', 'Estado', 'estado_real', 'Estado Real', 90, 'venta', 2, '', '', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, h, w'),
(59, 'Cliente', 'direccion', 'Dirección', 'direccion_id', 'Dirección ID', 19, 'cliente', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(61, 'Estados', '', '', 'aprobado_supervisor', 'Aprobado por Supervisor', 92, 'venta', 2, '', 'booleano', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'r, r, r, w, r, r'),
(62, 'Producto', '', '', 'producto_observacion', 'Obserción', 37, 'venta', 0, '', '', 1, 'TEXT', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(63, 'Producto', 'movil', 'Movil', 'movil_terminal', 'Terminal', 31, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(64, 'Moviles Adicionales', 'movil_adicional_1', 'Movil Adicional 1', 'movil_adicional_1_terminal', 'Terminal', 42, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(65, 'Moviles Adicionales', 'movil_adicional_2', 'Movil Adicional 2', 'movil_adicional_2_terminal', 'Terminal', 52, 'venta', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(66, 'Cliente', 'representante', 'Representante', 'representante_nombre', 'Nombre', 3, 'cliente', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w'),
(67, 'Cliente', 'representante', 'Representante', 'representante_documento', 'Documento', 4, 'cliente', 0, '', '', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w, w, w');

-- --------------------------------------------------------

--
-- Table structure for table `venta_cliente_documento_tipo`
--

CREATE TABLE `venta_cliente_documento_tipo` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_cliente_documento_tipo`
--

INSERT INTO `venta_cliente_documento_tipo` (`id`, `nombre`, `info_status`) VALUES
(1, 'DNI o NIF', 1),
(2, 'CIF', 1),
(3, 'NIE', 1);

-- --------------------------------------------------------

--
-- Table structure for table `venta_cliente_tipo`
--

CREATE TABLE `venta_cliente_tipo` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_cliente_tipo`
--

INSERT INTO `venta_cliente_tipo` (`id`, `nombre`, `info_status`) VALUES
(1, 'Residencial', 1),
(2, 'Autonomo o Empresa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `venta_direccion_nombre`
--

CREATE TABLE `venta_direccion_nombre` (
  `id` bigint(20) NOT NULL,
  `nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_direccion_nombre`
--

INSERT INTO `venta_direccion_nombre` (`id`, `nombre`, `info_status`) VALUES
(1, 'de Aurora', 1),
(2, 'aa', 1),
(3, 'maestro garcia montes', 1),
(4, 'Joan Maragall', 1),
(5, 'santa pau', 1),
(6, 'la retama', 1),
(7, 'asdsd', 1),
(8, 'cvbvcbvb bvg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `venta_direccion_tipo`
--

CREATE TABLE `venta_direccion_tipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_direccion_tipo`
--

INSERT INTO `venta_direccion_tipo` (`id`, `nombre`, `info_status`) VALUES
(1, 'Calle', 1),
(2, 'Avenida', 1),
(3, 'Plaza', 1);

-- --------------------------------------------------------

--
-- Table structure for table `venta_estado`
--

CREATE TABLE `venta_estado` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_estado`
--

INSERT INTO `venta_estado` (`id`, `nombre`, `info_status`) VALUES
(1, 'En tramitacion', 1),
(2, 'Ok tramitado', 1),
(3, 'Ko cliente', 1);

-- --------------------------------------------------------

--
-- Table structure for table `venta_estado_real`
--

CREATE TABLE `venta_estado_real` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `estado_id` bigint(20) NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_estado_real`
--

INSERT INTO `venta_estado_real` (`id`, `nombre`, `estado_id`, `info_status`) VALUES
(1, 'Pendiente', 1, 1),
(2, 'En tramitacion', 1, 1),
(3, 'Ok tramitado', 2, 1),
(4, 'Autoinstalable', 1, 1),
(5, 'Incidencia cliente', 1, 1),
(6, 'Pendiente de instalación', 1, 1),
(7, 'Pendiente de documentación', 1, 1),
(8, 'Ko cliente', 3, 1),
(9, 'Desconectada', 1, 1),
(11, 'Pendiente por documentacion', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `venta_localidad`
--

CREATE TABLE `venta_localidad` (
  `id` bigint(20) NOT NULL,
  `nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `provincia` bigint(20) NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_localidad`
--

INSERT INTO `venta_localidad` (`id`, `nombre`, `provincia`, `info_status`) VALUES
(1, 'Tres Cantos', 1, 1),
(6, 'nuevo', 1, 1),
(7, 'aaaa', 50, 1),
(8, 'nuevoXD', 63, 1),
(9, 'Localidad 01', 52, 1),
(10, 'Mollet del valles', 43, 1),
(11, 'zaragoza', 22, 1),
(12, 'ejemplo', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `venta_modalidad`
--

CREATE TABLE `venta_modalidad` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_modalidad`
--

INSERT INTO `venta_modalidad` (`id`, `nombre`, `info_status`) VALUES
(1, 'Alta Nueva', 1),
(2, 'Portalidad', 1);

-- --------------------------------------------------------

--
-- Table structure for table `venta_movil_estado`
--

CREATE TABLE `venta_movil_estado` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_movil_estado`
--

INSERT INTO `venta_movil_estado` (`id`, `nombre`, `info_status`) VALUES
(1, 'Tarjeta', 1),
(2, 'Contrato', 1);

-- --------------------------------------------------------

--
-- Table structure for table `venta_operador`
--

CREATE TABLE `venta_operador` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_operador`
--

INSERT INTO `venta_operador` (`id`, `nombre`, `info_status`) VALUES
(1, 'Euskaltel', 1),
(2, 'Movistar', 1),
(3, 'Orange', 1),
(4, 'R(Telecomunicaciones)', 1),
(5, 'Telecable', 1),
(6, 'Vodafone', 1),
(7, 'Yoigo', 1),
(8, 'Telecom', 1),
(9, 'Jazztel', 1),
(10, 'Ya.Com', 1),
(11, 'Extratelecom', 1),
(12, 'Simyo', 1),
(13, 'Laicamovil', 1),
(14, 'Ptv(procono)', 1),
(15, 'Digi Movil', 1),
(16, 'Lebara', 1),
(17, 'Mas Movil', 1),
(18, '345345', 1);

-- --------------------------------------------------------

--
-- Table structure for table `venta_producto`
--

CREATE TABLE `venta_producto` (
  `id` bigint(20) NOT NULL,
  `nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `campania` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'campania_00',
  `info_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_producto`
--

INSERT INTO `venta_producto` (`id`, `nombre`, `campania`, `info_status`) VALUES
(1, 'Vodafone One L 300Mb ', 'campania_001', 1),
(2, 'Duo Fibra 50Mb', 'campania_001', 1),
(3, 'Vodafone One S 50Mb ', 'campania_001', 1),
(4, 'Vodafone One M 50Mb ', 'campania_001', 1),
(5, 'Vodafone One L 50Mb ', 'campania_001', 1),
(6, 'Duo Fibra 120Mb', 'campania_001', 1),
(7, 'Vodafone One S 120Mb ', 'campania_001', 1),
(8, 'Vodafone One M 120Mb ', 'campania_001', 1),
(9, 'Vodafone One L 120Mb ', 'campania_001', 1),
(10, 'Duo Fibra 300Mb', 'campania_001', 1),
(11, 'Vodafone One S 300Mb ', 'campania_001', 1),
(12, 'Duo fibra M 300Mb ', 'campania_001', 1),
(13, 'ADSL Max vellocidad(Autonomo)', 'campania_001', 1),
(14, 'temp22', 'campania_002', 1);

-- --------------------------------------------------------

--
-- Table structure for table `venta_provincia`
--

CREATE TABLE `venta_provincia` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_provincia`
--

INSERT INTO `venta_provincia` (`id`, `nombre`, `info_status`) VALUES
(1, 'Madrid', 1),
(2, 'Almeria', 1),
(3, 'Cadiz', 1),
(4, 'Cordoba', 1),
(5, 'Granada', 1),
(6, 'Huelva', 1),
(7, 'Jaen', 1),
(8, 'Malaga', 1),
(9, 'Sevilla', 1),
(10, 'Huesca', 1),
(11, 'Teruel', 1),
(22, 'Zaragoza', 1),
(23, 'Las palmas', 1),
(24, 'Santa cruz de tenerife', 1),
(25, 'Cantabria', 1),
(26, 'Albacete', 1),
(32, 'Guadalajara', 1),
(33, 'Toledo', 1),
(34, 'Burgos', 1),
(35, 'Leon', 1),
(36, 'Palencia', 1),
(37, 'Salamanca', 1),
(38, 'Segovia', 1),
(39, 'Soria', 1),
(40, 'Valladolid', 1),
(41, 'Zamora', 1),
(42, 'Avila', 1),
(43, 'Barcelona', 1),
(44, 'Gerona', 1),
(45, 'Lerida', 1),
(46, 'Tarragona', 1),
(47, 'Ceuta', 1),
(48, 'Navarra', 1),
(49, 'Alicante', 1),
(50, 'Castellon', 1),
(51, 'Valencia', 1),
(52, 'Badajoz ', 1),
(53, 'Caceres', 1),
(54, 'La acoruña', 1),
(55, 'Lugo', 1),
(56, 'Orense', 1),
(57, 'Pontevedra', 1),
(58, 'Islas baleares', 1),
(59, 'La rioja ', 1),
(60, 'Melilla', 1),
(61, 'Guipuzcoa', 1),
(62, 'Vizcaya', 1),
(63, 'Alava', 1),
(64, 'Asturias', 1),
(65, 'Murcia', 1),
(66, 'Cuidad real', 1),
(67, 'Cuenca', 1);

-- --------------------------------------------------------

--
-- Table structure for table `venta_tarifa_movil`
--

CREATE TABLE `venta_tarifa_movil` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `campania` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_tarifa_movil`
--

INSERT INTO `venta_tarifa_movil` (`id`, `nombre`, `campania`, `info_status`) VALUES
(1, 'S', 'campania_001', 1),
(2, 'M', 'campania_001', 1),
(3, 'L', 'campania_001', 1),
(4, 'Mini ', 'campania_001', 1),
(5, 'S', 'campania_002', 1),
(6, 'M', 'campania_002', 1),
(7, 'L', 'campania_002', 1);

-- --------------------------------------------------------

--
-- Table structure for table `venta_titular`
--

CREATE TABLE `venta_titular` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `info_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_titular`
--

INSERT INTO `venta_titular` (`id`, `nombre`, `info_status`) VALUES
(1, 'SI', 1),
(2, 'NO', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vista_usuarios`
--
CREATE TABLE `vista_usuarios` (
`id` bigint(20)
,`nombre` text
,`nombre_corto` varchar(500)
,`login` varchar(100)
,`clave` varchar(2)
,`perfil` varchar(100)
,`grupo_1` bigint(21)
,`grupo_2` bigint(21)
,`grupo_5` bigint(21)
);

-- --------------------------------------------------------

--
-- Structure for view `vista_usuarios`
--
DROP TABLE IF EXISTS `vista_usuarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_usuarios`  AS  select `u`.`id` AS `id`,`u`.`nombre` AS `nombre`,`u`.`nombre_corto` AS `nombre_corto`,`u`.`login` AS `login`,if((`u`.`pwd` = '$4nkNrBEK8ra2'),'No','Si') AS `clave`,`p`.`nombre` AS `perfil`,(select count(`usu_usuario_lineal`.`id`) from `usu_usuario_lineal` where ((`usu_usuario_lineal`.`usuario_id` = `u`.`id`) and (`usu_usuario_lineal`.`lineal_id` = 1))) AS `grupo_1`,(select count(`usu_usuario_lineal`.`id`) from `usu_usuario_lineal` where ((`usu_usuario_lineal`.`usuario_id` = `u`.`id`) and (`usu_usuario_lineal`.`lineal_id` = 2))) AS `grupo_2`,(select count(`usu_usuario_lineal`.`id`) from `usu_usuario_lineal` where ((`usu_usuario_lineal`.`usuario_id` = `u`.`id`) and (`usu_usuario_lineal`.`lineal_id` = 5))) AS `grupo_5` from ((`usu_usuario` `u` left join `usu_usuario_perfil` `up` on((`up`.`usuario_id` = `u`.`id`))) left join `usu_perfil` `p` on((`p`.`id` = `up`.`perfil_id`))) order by `u`.`id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campania`
--
ALTER TABLE `campania`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campania_history`
--
ALTER TABLE `campania_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campania_lineal`
--
ALTER TABLE `campania_lineal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campania_lineal_history`
--
ALTER TABLE `campania_lineal_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lineal`
--
ALTER TABLE `lineal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lineal_history`
--
ALTER TABLE `lineal_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usu_perfil`
--
ALTER TABLE `usu_perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usu_perfil_recurso`
--
ALTER TABLE `usu_perfil_recurso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usu_recurso`
--
ALTER TABLE `usu_recurso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usu_usuario`
--
ALTER TABLE `usu_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usu_usuario_history`
--
ALTER TABLE `usu_usuario_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usu_usuario_lineal`
--
ALTER TABLE `usu_usuario_lineal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usu_usuario_lineal_history`
--
ALTER TABLE `usu_usuario_lineal_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usu_usuario_perfil`
--
ALTER TABLE `usu_usuario_perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usu_usuario_perfil_history`
--
ALTER TABLE `usu_usuario_perfil_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta_booleano`
--
ALTER TABLE `venta_booleano`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta_campania_001`
--
ALTER TABLE `venta_campania_001`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta_campania_001_campos`
--
ALTER TABLE `venta_campania_001_campos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta_campania_002`
--
ALTER TABLE `venta_campania_002`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta_campania_002_campos`
--
ALTER TABLE `venta_campania_002_campos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta_cliente_documento_tipo`
--
ALTER TABLE `venta_cliente_documento_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta_cliente_tipo`
--
ALTER TABLE `venta_cliente_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta_direccion_nombre`
--
ALTER TABLE `venta_direccion_nombre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta_direccion_tipo`
--
ALTER TABLE `venta_direccion_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta_estado`
--
ALTER TABLE `venta_estado`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta_estado_real`
--
ALTER TABLE `venta_estado_real`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta_localidad`
--
ALTER TABLE `venta_localidad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta_modalidad`
--
ALTER TABLE `venta_modalidad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta_movil_estado`
--
ALTER TABLE `venta_movil_estado`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta_operador`
--
ALTER TABLE `venta_operador`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta_provincia`
--
ALTER TABLE `venta_provincia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta_tarifa_movil`
--
ALTER TABLE `venta_tarifa_movil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venta_titular`
--
ALTER TABLE `venta_titular`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campania`
--
ALTER TABLE `campania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `campania_history`
--
ALTER TABLE `campania_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `campania_lineal`
--
ALTER TABLE `campania_lineal`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `campania_lineal_history`
--
ALTER TABLE `campania_lineal_history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lineal`
--
ALTER TABLE `lineal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `lineal_history`
--
ALTER TABLE `lineal_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usu_perfil`
--
ALTER TABLE `usu_perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `usu_perfil_recurso`
--
ALTER TABLE `usu_perfil_recurso`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `usu_recurso`
--
ALTER TABLE `usu_recurso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `usu_usuario`
--
ALTER TABLE `usu_usuario`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `usu_usuario_history`
--
ALTER TABLE `usu_usuario_history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usu_usuario_lineal`
--
ALTER TABLE `usu_usuario_lineal`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `usu_usuario_lineal_history`
--
ALTER TABLE `usu_usuario_lineal_history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usu_usuario_perfil`
--
ALTER TABLE `usu_usuario_perfil`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `usu_usuario_perfil_history`
--
ALTER TABLE `usu_usuario_perfil_history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `venta`
--
ALTER TABLE `venta`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `venta_booleano`
--
ALTER TABLE `venta_booleano`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `venta_campania_001_campos`
--
ALTER TABLE `venta_campania_001_campos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `venta_campania_002_campos`
--
ALTER TABLE `venta_campania_002_campos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `venta_cliente_documento_tipo`
--
ALTER TABLE `venta_cliente_documento_tipo`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `venta_cliente_tipo`
--
ALTER TABLE `venta_cliente_tipo`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `venta_direccion_nombre`
--
ALTER TABLE `venta_direccion_nombre`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `venta_direccion_tipo`
--
ALTER TABLE `venta_direccion_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `venta_estado`
--
ALTER TABLE `venta_estado`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `venta_estado_real`
--
ALTER TABLE `venta_estado_real`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `venta_localidad`
--
ALTER TABLE `venta_localidad`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `venta_modalidad`
--
ALTER TABLE `venta_modalidad`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `venta_movil_estado`
--
ALTER TABLE `venta_movil_estado`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `venta_operador`
--
ALTER TABLE `venta_operador`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `venta_producto`
--
ALTER TABLE `venta_producto`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `venta_provincia`
--
ALTER TABLE `venta_provincia`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `venta_tarifa_movil`
--
ALTER TABLE `venta_tarifa_movil`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `venta_titular`
--
ALTER TABLE `venta_titular`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
