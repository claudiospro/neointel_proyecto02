-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 02, 2016 at 04:19 PM
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
  `imagen` text COLLATE utf8_unicode_ci,
  `login` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pwd` varchar(50) COLLATE utf8_unicode_ci DEFAULT '$4nkNrBEK8ra2'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usu_usuario`
--

INSERT INTO `usu_usuario` (`info_create`, `info_create_user`, `info_update`, `info_update_user`, `info_status`, `id`, `nombre`, `imagen`, `login`, `pwd`) VALUES
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 1, 'claudio rodriguez', NULL, 'crodriguez', '$4M4mpfilkNnU'),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 2, 'juan perez Gerencia', NULL, 'ger', '$4M4mpfilkNnU'),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 3, 'juan perez Tramitacion', NULL, 'tra', '$4M4mpfilkNnU'),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 4, 'juan perez Supervisor', NULL, 'sup', '$4M4mpfilkNnU'),
('2016-01-20 19:47:48', 1, '0000-00-00 00:00:00', NULL, 1, 5, 'juan perez Asesor de Ventas', NULL, 'ase', '$4M4mpfilkNnU'),
('2016-01-21 17:57:34', 1, '0000-00-00 00:00:00', NULL, 1, 6, 'Juan Perez Coordinador', NULL, 'cor', '$4M4mpfilkNnU'),
('2016-02-02 19:37:53', 1, '0000-00-00 00:00:00', NULL, 1, 7, 'temploral', NULL, 'nombre.apellido', '$4nkNrBEK8ra2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usu_usuario`
--
ALTER TABLE `usu_usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usu_usuario`
--
ALTER TABLE `usu_usuario`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
