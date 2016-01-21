-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 21, 2016 at 09:28 AM
-- Server version: 10.0.21-MariaDB
-- PHP Version: 5.6.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `neointelperu_apps2`
--

-- --------------------------------------------------------

--
-- Table structure for table `campania`
--

DROP TABLE IF EXISTS `campania`;
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
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 0, 1, 'Canal +', 'campania_002'),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 0, 2, 'Movistar Fusión', 'campania_003'),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 3, 'Ono-Vodafon', 'campania_001');

-- --------------------------------------------------------

--
-- Table structure for table `campania_history`
--

DROP TABLE IF EXISTS `campania_history`;
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

DROP TABLE IF EXISTS `campania_lineal`;
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
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 1, 1, 1),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 2, 2, 2),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 3, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `campania_lineal_history`
--

DROP TABLE IF EXISTS `campania_lineal_history`;
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

DROP TABLE IF EXISTS `lineal`;
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
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 3, 'Lineal 03');

-- --------------------------------------------------------

--
-- Table structure for table `lineal_history`
--

DROP TABLE IF EXISTS `lineal_history`;
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

DROP TABLE IF EXISTS `usu_perfil`;
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
(5, 'Asesor Comercial');

-- --------------------------------------------------------

--
-- Table structure for table `usu_perfil_recurso`
--

DROP TABLE IF EXISTS `usu_perfil_recurso`;
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
(6, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usu_recurso`
--

DROP TABLE IF EXISTS `usu_recurso`;
CREATE TABLE `usu_recurso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usu_recurso`
--

INSERT INTO `usu_recurso` (`id`, `nombre`) VALUES
(1, 'Ventas'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Table structure for table `usu_usuario`
--

DROP TABLE IF EXISTS `usu_usuario`;
CREATE TABLE `usu_usuario` (
  `info_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `info_create_user` int(11) DEFAULT '1',
  `info_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `info_update_user` int(11) DEFAULT NULL,
  `info_status` tinyint(1) DEFAULT '1',
  `id` bigint(20) NOT NULL,
  `nombre` text COLLATE utf8_unicode_ci,
  `imagen` text COLLATE utf8_unicode_ci,
  `login` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pwd` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usu_usuario`
--

INSERT INTO `usu_usuario` (`info_create`, `info_create_user`, `info_update`, `info_update_user`, `info_status`, `id`, `nombre`, `imagen`, `login`, `pwd`) VALUES
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 1, 'claudio rodriguez', NULL, 'crodriguez', '$4M4mpfilkNnU'),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 2, 'juan perez 1', NULL, 'jperez1', '$4M4mpfilkNnU'),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 3, 'juan perez 2', NULL, 'jperez2', '$4M4mpfilkNnU'),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 4, 'juan perez 3', NULL, 'jperez3', '$4M4mpfilkNnU'),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 5, 'juan perez 4', NULL, 'jperez4', '$4M4mpfilkNnU');

-- --------------------------------------------------------

--
-- Table structure for table `usu_usuario_history`
--

DROP TABLE IF EXISTS `usu_usuario_history`;
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

DROP TABLE IF EXISTS `usu_usuario_lineal`;
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
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 1, 2, 1),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 2, 3, 1),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 3, 3, 2),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 4, 4, 1),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 5, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usu_usuario_lineal_history`
--

DROP TABLE IF EXISTS `usu_usuario_lineal_history`;
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

DROP TABLE IF EXISTS `usu_usuario_perfil`;
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
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 5, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `usu_usuario_perfil_history`
--

DROP TABLE IF EXISTS `usu_usuario_perfil_history`;
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

DROP TABLE IF EXISTS `venta`;
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
(1, '2016-01-20 21:40:33', 1, '2016-01-23 21:40:33', 0, 1, 5, 3, 4, 0, 'campania_001', 1);

-- --------------------------------------------------------

--
-- Table structure for table `venta_campania_001`
--

DROP TABLE IF EXISTS `venta_campania_001`;
CREATE TABLE `venta_campania_001` (
  `id` bigint(20) NOT NULL,
  `cliente_nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_tipo` bigint(20) NOT NULL,
  `cliente_documento_tipo` bigint(20) NOT NULL,
  `cliente_documento` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_nacimiento` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_correo` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
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
  `producto` bigint(20) NOT NULL,
  `estado` bigint(20) NOT NULL,
  `fecha_instalada` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_campania_001`
--

INSERT INTO `venta_campania_001` (`id`, `cliente_nombre`, `cliente_tipo`, `cliente_documento_tipo`, `cliente_documento`, `cliente_nacimiento`, `cliente_correo`, `cliente_contacto_fijo`, `cliente_contacto_movil`, `provincia`, `localidad`, `codigo_postal`, `direccion_tipo`, `direccion_nombre`, `direccion_numero`, `direccion_piso`, `direccion_puerta`, `producto`, `estado`, `fecha_instalada`) VALUES
(1, 'Juan Perez', 1, 1, '45460385D', '1987-10-10', 'profins@gmail.com', '959678300', '600230199\r\n', 1, 1, '28052', 1, 1, '20', '1', 'B', 1, 10, '2016-01-21 14:13:40');

-- --------------------------------------------------------

--
-- Table structure for table `venta_campania_001_campos`
--

DROP TABLE IF EXISTS `venta_campania_001_campos`;
CREATE TABLE `venta_campania_001_campos` (
  `id` bigint(20) NOT NULL,
  `grupo` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `grupo_etiqueta` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `etiqueta` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `tabla` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `diccionario` tinyint(2) NOT NULL,
  `tipo` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `perfiles` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `permisos` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'w, w, w, w ,w, w'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_campania_001_campos`
--

INSERT INTO `venta_campania_001_campos` (`id`, `grupo`, `grupo_etiqueta`, `nombre`, `etiqueta`, `orden`, `tabla`, `diccionario`, `tipo`, `perfiles`, `permisos`) VALUES
(1, '', '', 'cliente_nombre', 'Cliente', 1, 'cliente', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w ,w, w'),
(2, '', '', 'cliente_tipo', 'Tipo Cliente', 2, 'cliente', 2, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w ,w, w'),
(3, '', '', 'cliente_documento_tipo', 'Tipo de Documento', 3, 'cliente', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w ,w, w'),
(4, '', '', 'cliente_documento', 'Documento', 4, 'cliente', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w ,w, w'),
(5, '', '', 'cliente_nacimiento', 'Fecha de Nacimiento', 5, 'cliente', 0, 'TIMESTAMP', '1, 2, 3, 4, 5, 6', 'w, w, w, w ,w, w'),
(7, '', '', 'cliente_correo', 'Correo', 6, 'cliente', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w ,w, w'),
(8, 'cliente_contacto', 'Contacto', 'cliente_contacto_fijo', 'Fijo', 7, 'cliente', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w ,w, w'),
(9, 'cliente_contacto', 'Contacto', 'cliente_contacto_movil', 'Movil', 8, 'cliente', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w ,w, w'),
(10, '', '', 'provincia', 'Provincia', 9, 'venta', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w ,w, w'),
(11, '', '', 'localidad', 'Localidad', 10, 'venta', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w ,w, w'),
(12, 'direccion', 'Dirección', 'direccion_tipo', 'Tipo', 12, 'venta', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w ,w, w'),
(13, 'direccion', 'Dirección', 'direccion_nombre', 'Nombre', 13, 'venta', 1, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w ,w, w'),
(14, 'direccion', 'Dirección', 'direccion_numero', 'Número', 14, 'venta', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w ,w, w'),
(15, 'direccion', 'Dirección', 'direccion_piso', 'Piso', 15, 'venta', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w ,w, w'),
(16, 'direccion', 'Dirección', 'direccion_puerta', 'Puerta', 16, 'venta', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w ,w, w'),
(17, '', '', 'producto', 'Producto', 17, 'venta', 2, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w ,w, w'),
(18, '', '', 'estado', 'Estado', 18, 'venta', 2, 'VARCHAR', '1, 2, 3, 4, 5, 6', 'w, w, w, w ,w, w'),
(19, '', '', 'fecha_instalada', 'Fecha de Instalación', 19, 'venta', 0, 'TIMESTAMP', '1, 2, 3, 4, 5, 6', 'w, w, w, w ,w, w'),
(20, '', '', 'codigo_postal', 'Código Postal', 11, 'venta', 0, 'VARCHAR', '1, 2, 3, 4, 5, 6 ', 'w, w, w, w ,w, w');

-- --------------------------------------------------------

--
-- Table structure for table `venta_cliente_documento_tipo`
--

DROP TABLE IF EXISTS `venta_cliente_documento_tipo`;
CREATE TABLE `venta_cliente_documento_tipo` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_cliente_documento_tipo`
--

INSERT INTO `venta_cliente_documento_tipo` (`id`, `nombre`) VALUES
(1, 'NIF'),
(2, 'CIF'),
(3, 'NIE');

-- --------------------------------------------------------

--
-- Table structure for table `venta_cliente_tipo`
--

DROP TABLE IF EXISTS `venta_cliente_tipo`;
CREATE TABLE `venta_cliente_tipo` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_cliente_tipo`
--

INSERT INTO `venta_cliente_tipo` (`id`, `nombre`) VALUES
(1, 'Recidencial'),
(2, 'Autonomo o Empresa');

-- --------------------------------------------------------

--
-- Table structure for table `venta_direccion_nombre`
--

DROP TABLE IF EXISTS `venta_direccion_nombre`;
CREATE TABLE `venta_direccion_nombre` (
  `id` bigint(20) NOT NULL,
  `nombre` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_direccion_nombre`
--

INSERT INTO `venta_direccion_nombre` (`id`, `nombre`) VALUES
(1, 'de Aurora');

-- --------------------------------------------------------

--
-- Table structure for table `venta_direccion_tipo`
--

DROP TABLE IF EXISTS `venta_direccion_tipo`;
CREATE TABLE `venta_direccion_tipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_direccion_tipo`
--

INSERT INTO `venta_direccion_tipo` (`id`, `nombre`) VALUES
(1, 'Calle'),
(2, 'Avenida');

-- --------------------------------------------------------

--
-- Table structure for table `venta_estado`
--

DROP TABLE IF EXISTS `venta_estado`;
CREATE TABLE `venta_estado` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_estado`
--

INSERT INTO `venta_estado` (`id`, `nombre`) VALUES
(1, 'Pendiente'),
(2, 'Pendiente por Documentación'),
(3, 'Pendiente por instalación'),
(4, 'En Tramitación'),
(5, 'Cancelada Por Operador'),
(6, 'Cancelada Por Cliente'),
(7, 'Cancelada Por Incidencia del Cliente'),
(8, 'Cancelada por Asesor Comercial'),
(9, 'AutoInstalable'),
(10, 'Instalado');

-- --------------------------------------------------------

--
-- Table structure for table `venta_localidad`
--

DROP TABLE IF EXISTS `venta_localidad`;
CREATE TABLE `venta_localidad` (
  `id` bigint(20) NOT NULL,
  `nombre` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_localidad`
--

INSERT INTO `venta_localidad` (`id`, `nombre`) VALUES
(1, 'Tres Cantos');

-- --------------------------------------------------------

--
-- Table structure for table `venta_producto`
--

DROP TABLE IF EXISTS `venta_producto`;
CREATE TABLE `venta_producto` (
  `id` bigint(20) NOT NULL,
  `nombre` text COLLATE utf8_unicode_ci NOT NULL,
  `campania` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_producto`
--

INSERT INTO `venta_producto` (`id`, `nombre`, `campania`) VALUES
(1, 'One S 50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `venta_provincia`
--

DROP TABLE IF EXISTS `venta_provincia`;
CREATE TABLE `venta_provincia` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venta_provincia`
--

INSERT INTO `venta_provincia` (`id`, `nombre`) VALUES
(1, 'Madrid');

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
-- Indexes for table `venta_localidad`
--
ALTER TABLE `venta_localidad`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campania`
--
ALTER TABLE `campania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `campania_history`
--
ALTER TABLE `campania_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `campania_lineal`
--
ALTER TABLE `campania_lineal`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `campania_lineal_history`
--
ALTER TABLE `campania_lineal_history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lineal`
--
ALTER TABLE `lineal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lineal_history`
--
ALTER TABLE `lineal_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usu_perfil`
--
ALTER TABLE `usu_perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `usu_perfil_recurso`
--
ALTER TABLE `usu_perfil_recurso`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `usu_recurso`
--
ALTER TABLE `usu_recurso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usu_usuario`
--
ALTER TABLE `usu_usuario`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `usu_usuario_history`
--
ALTER TABLE `usu_usuario_history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usu_usuario_lineal`
--
ALTER TABLE `usu_usuario_lineal`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `usu_usuario_lineal_history`
--
ALTER TABLE `usu_usuario_lineal_history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usu_usuario_perfil`
--
ALTER TABLE `usu_usuario_perfil`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `usu_usuario_perfil_history`
--
ALTER TABLE `usu_usuario_perfil_history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `venta`
--
ALTER TABLE `venta`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `venta_campania_001_campos`
--
ALTER TABLE `venta_campania_001_campos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `venta_direccion_tipo`
--
ALTER TABLE `venta_direccion_tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `venta_estado`
--
ALTER TABLE `venta_estado`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `venta_localidad`
--
ALTER TABLE `venta_localidad`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `venta_producto`
--
ALTER TABLE `venta_producto`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `venta_provincia`
--
ALTER TABLE `venta_provincia`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
